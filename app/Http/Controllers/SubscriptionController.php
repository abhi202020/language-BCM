<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\Course;
use App\Models\Order;
use App\Models\Stripe\StripePlan;
use App\Models\Stripe\SubscribeBundle;
use App\Models\Stripe\SubscribeCourse;
use App\Models\Stripe\Subscription;
use App\Models\Stripe\UserCourses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    private $path;

    public function __construct()
    {
        $this->path = $this->setPath();
    }

    private function setPath()
    {
        $path = 'frontend';
        if (session()->has('display_type')) {
            $path = session('display_type') == 'rtl' ? 'frontend-rtl' : 'frontend';
        } elseif (config('app.display_type') == 'rtl') {
            $path = 'frontend-rtl';
        }
        return $path;
    }

    public function plans()
    {
        $plans = StripePlan::get();
        return view($this->path . '.subscription.plans', compact('plans'));
    }

    public function showForm(StripePlan $plan)
    {
        $intent = auth()->user()->createSetupIntent();
        return view($this->path . '.subscription.form', compact('plan', 'intent'));
    }

    public function subscribe(Request $request, StripePlan $plan)
    {
        try {
            $user = $request->user();
            $paymentMethod = $request->paymentMethod;

            $user->createOrGetStripeCustomer();

            $user->updateStripeCustomer([
                'email' => $request->stripeEmail,
                "address" => [
                    "city" => $request->city,
                    "country" => $request->country,
                    "line1" => $request->address,
                    "line2" => null,
                    "postal_code" => $request->postal_code,
                    "state" => $request->state,
                ]
            ]);

            $subscription = $user->newSubscription('default', $plan->plan_id)
                ->create($paymentMethod, ['email' => $user->email]);

            $order = $this->createOrder($user->id, $plan->id, $plan->amount);
            if (!empty($order)) {
                $this->checkSubscriptionCourseOrBundle($order, $plan->id);
            }

            \Session::flash('success', trans('labels.subscription.done'));
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ' for subscription plan ' . $plan->name . ' User Name: ' . $user->name . ' Id:' . $user->id);
            return redirect()->route('subscription.plans')->withErrors('Error creating subscription.');
        }
        return redirect()->route('subscription.status');
    }

    private function createOrder($userId, $planId, $amount)
    {
        $order = new Order();
        $order->user_id = $userId;
        $order->plan_id = $planId;
        $order->reference_no = str_random(8);
        $order->amount = $amount;
        $order->status = 1;
        $order->payment_type = 0;
        $order->order_type = 1;
        $order->save();
        return $order;
    }

    private function checkSubscriptionCourseOrBundle($order, $planId)
    {
        $planData = StripePlan::findOrFail($planId);
        $expire_at = UserCourses::where('plan_id', $planId)->value('expire_at');

        $courses = SubscribeCourse::where('stripe_id', $planId)->get();
        if ($courses->isNotEmpty()) {
            foreach ($courses as $course) {
                $id = $course->course_id;
                $returnDate = checkExistingUserSubcribtionDate($planData->interval, $planData->expire, $expire_at);
                UserCourses::create([
                    'user_id' => $order->user_id,
                    'plan_id' => $planId,
                    'course_id' => $id,
                    'expire_at' => $returnDate,
                ]);

                $order->items()->create([
                    'item_id' => $id,
                    'item_type' => Course::class,
                    'price' => 0,
                    'type' => 1
                ]);
            }
        }

        $bundles = SubscribeBundle::where('stripe_id', $planId)->get();
        if ($bundles->isNotEmpty()) {
            foreach ($bundles as $bundle) {
                $id = $bundle->bundle_id;
                $returnDate = checkExistingUserSubcribtionDate($planData->interval, $planData->expire, $expire_at);
                UserCourses::create([
                    'user_id' => $order->user_id,
                    'plan_id' => $planId,
                    'bundle_id' => $id,
                    'expire_at' => $returnDate,
                ]);

                $order->items()->create([
                    'item_id' => $id,
                    'item_type' => Bundle::class,
                    'price' => 0,
                    'type' => 1
                ]);
            }
        }

        foreach ($order->items as $orderItem) {
            if ($orderItem->item_type == Bundle::class) {
                foreach ($orderItem->item->courses as $course) {
                    $course->students()->attach($order->user_id);
                }
            }
            $orderItem->item->students()->attach($order->user_id);
        }
    }

    public function updateSubscription(Request $request, StripePlan $plan)
    {
        $user = $request->user();
        if ($user->subscribed('default') && $user->subscription('default')->onGracePeriod()) {
            if ($user->onPlan($plan->plan_id)) {
                $user->subscription('default')->resume();
            } else {
                $user->subscription('default')->resume()->swap($plan->plan_id);
            }
        } else {
            $user->subscription('default')->swap($plan->plan_id);
        }
        \Session::flash('success', trans('labels.subscription.update'));
        return redirect()->route('subscription.status');
    }

    public function status()
    {
        return view('frontend.subscription.status');
    }

    public function courseSubscribed(Request $request)
    {
        $user = $request->user();

        if ($user->subscription()->ended()) {
            return redirect()->back()->withDanger(trans('alerts.frontend.course.subscription_plan_expired'));
        }

        if (!$user->subscription()->cancelled()) {
            if ($user->subscription()->active()) {
                $plan = $this->getPlan($user->subscription()->stripe_plan);
                $message = $this->validateCourseOrBundle($request, $user, $plan);
                if ($message !== null) {
                    return redirect()->back()->withDanger($message);
                }

                $this->subscribeBundleOrCourse($request);
                $messageKey = $request->course_id ? 'alerts.frontend.course.sub_course_success' : 'alerts.frontend.course.sub_bundle_success';
                return redirect()->route('admin.dashboard')->withFlashSuccess(trans($messageKey));
            }
        } else {
            return redirect()->back()->withDanger(trans('alerts.frontend.course.subscription_plan_cancelled'));
        }
    }

    private function validateCourseOrBundle(Request $request, $user, $plan)
    {
        if ($request->course_id) {
            if ($plan->course == 99) {
                return trans('alerts.frontend.course.sub_course_not_access');
            }
            if ($plan->course != 0 && $user->subscribedCourse()->count() >= $plan->course) {
                return trans('alerts.frontend.course.sub_course_limit_over');
            }
        } else {
            if ($plan->bundle == 99) {
                return trans('alerts.frontend.course.sub_bundle_not_access');
            }
            if ($plan->bundle != 0 && $user->subscribedBundles()->count() >= $plan->bundle) {
                return trans('alerts.frontend.course.sub_bundle_limit_over');
            }
        }
        return null;
    }

    private function getPlan($planId)
    {
        return StripePlan::where('plan_id', $planId)->firstOrFail();
    }

    private function subscribeBundleOrCourse(Request $request)
    {
        $order = $this->createOrder(auth()->user()->id, $request->course_id ? $request->course_id : $request->bundle_id, 0);
        $type = $request->course_id ? Course::class : Bundle::class;
        $id = $request->course_id ? $request->course_id : $request->bundle_id;

        $order->items()->create([
            'item_id' => $id,
            'item_type' => $type,
            'price' => 0,
            'type' => 1
        ]);

        foreach ($order->items as $orderItem) {
            if ($orderItem->item_type == Bundle::class) {
                foreach ($orderItem->item->courses as $course) {
                    $course->students()->attach($order->user_id);
                }
            }
            $orderItem->item->students()->attach($order->user_id);
        }
    }
}
