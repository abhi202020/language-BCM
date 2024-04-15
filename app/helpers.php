<?php

use App\Helpers\General\Timezone;
use App\Helpers\General\HtmlHelper;
use Carbon\Carbon;

// Global helpers file with misc functions.
if (!function_exists('app_name')) {
    /**
     * Helper to grab the application name.
     * @return mixed
     */
    function app_name(){
        return config('app.name');
    }
}

if (!function_exists('gravatar')) {
    // Access the gravatar helper.
    function gravatar(){
        return app('gravatar');
    }
}

if (!function_exists('timezone')) {
    // Access the timezone helper.
    function timezone(){
        return resolve(Timezone::class);
    }
}

if (!function_exists('include_route_files')) {
    /**
     * Loops through a folder and requires all PHP files
     * Searches sub-directories as well.
     * @param $folder
     */
    function include_route_files($folder){
        try {
            $rdi = new recursiveDirectoryIterator($folder);
            $it = new recursiveIteratorIterator($rdi);

            while ($it->valid()) {
                if (!$it->isDot() && $it->isFile() && $it->isReadable() && $it->current()->getExtension() === 'php') {
                    require $it->key();
                }
                $it->next();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

if (!function_exists('home_route')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     * @return string 
     */
    function home_route(){
        if (auth()->check()) {
            if (auth()->user()->can('view backend') && auth()->user()->isAdmin()) {
                return 'admin.dashboard';
            } else {
                return 'frontend.index';
            }
        }
        return 'frontend.index';
    }
}

if (!function_exists('style')) {
    /**
     * @param       $url
     * @param array $attributes
     * @param null $secure
     * @return mixed
     */
    function style($url, $attributes = [], $secure = null){
        return resolve(HtmlHelper::class)->style($url, $attributes, $secure);
    }
}

if (!function_exists('script')) {
    /**
     * @param       $url
     * @param array $attributes
     * @param null $secure
     * @return mixed
     */
    function script($url, $attributes = [], $secure = null){
        return resolve(HtmlHelper::class)->script($url, $attributes, $secure);
    }
}

if (!function_exists('form_cancel')) {
    /**
     * @param        $cancel_to
     * @param        $title
     * @param string $classes
     * @return mixed
     */
    function form_cancel($cancel_to, $title, $classes = 'btn btn-danger '){
        return resolve(HtmlHelper::class)->formCancel($cancel_to, $title, $classes);
    }
}

if (!function_exists('form_submit')) {
    /**
     * @param        $title
     * @param string $classes
     * @return mixed
     */
    function form_submit($title, $classes = 'btn btn-success pull-right'){
        return resolve(HtmlHelper::class)->formSubmit($title, $classes);
    }
}

if (!function_exists('camelcase_to_word')) {
    /**
     * @param $str
     * @return string
     */
    function camelcase_to_word($str){
        return implode(' ', preg_split('/
          (?<=[a-z])
          (?=[A-Z])
        | (?<=[A-Z])
          (?=[A-Z][a-z])
        /x', $str));
    }
}

if (!function_exists('contact_data')) {
    /**
     * @param $str
     * @return array
     */
    function contact_data($str){
        $newElements = [];
        $elements = json_decode($str);
        foreach ($elements as $key => $item) {
            $newElements[$item->name] = ['value' => $item->value, 'status' => $item->status];
        }
        return $newElements;
    }
}

if (!function_exists('section_filter')) {
    /**
     * @param $str
     * Filter according to type selected.
     * 1 = Popular Categories
     * 2 = Featured Course
     * 3 = Trending Courses
     * 4 = Popular Courses
     * 5 = Custom Links
     * @return array
     */
    function section_filter($section){
        $type = $section->type;
        $section_data = "";
        $section_title = "";
        $content = [];

        if ($type == 1) {
            $section_content = \App\Models\Category::has('courses', '>', 7)
                ->where('status', '=', 1)->get()->take(6);
            $section_title = trans('labels.frontend.footer.popular_categories');
            foreach ($section_content as $item) {
                $single_item = [
                    'label' => $item->name,
                    'link' => route('courses.category', ['category' => $item->slug])
                ];
                $content[] = $single_item;
            }

        } else if ($type == 2) {
            $section_content = \App\Models\Course::canDisableCourse()->where('featured', '=', 1)
                ->has('category')
                ->where('published', '=', 1)
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();
            $section_title = trans('labels.frontend.footer.featured_courses');
            foreach ($section_content as $item) {
                $single_item = [
                    'label' => $item->title,
                    'link' => route('courses.show', [$item->slug])
                ];
                $content[] = $single_item;
            }

        } else if ($type == 3) {
            $section_content = \App\Models\Course::canDisableCourse()->where('trending', '=', 1)
                ->has('category')
                ->where('published', '=', 1)
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();
            $section_title = trans('labels.frontend.footer.trending_courses');
            foreach ($section_content as $item) {
                $single_item = [
                    'label' => $item->title,
                    'link' => route('courses.show', [$item->slug])
                ];
                $content[] = $single_item;
            }

        } else if ($type == 4) {
            $section_content = \App\Models\Course::canDisableCourse()->where('popular', '=', 1)
                ->has('category')
                ->where('published', '=', 1)
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get();
            $section_title = trans('labels.frontend.footer.popular_courses');
            foreach ($section_content as $item) {
                $single_item = [
                    'label' => $item->title,
                    'link' => route('courses.show', [$item->slug])
                ];
                $content[] = $single_item;
            }

        } else if ($type == 5) {
            $section_title = trans('labels.frontend.footer.useful_links');
            $section_content = $section->links;
            foreach ($section_content as $item) {
                $single_item = [
                    'label' => $item->label,
                    'link' => $item->link
                ];
                $content[] = $single_item;
            }
        }
        return ['section_content' => $content, 'section_title' => $section_title];
    }
}

if (!function_exists('generateInvoice')) {
    function generateInvoice($order) {
        try {
            // Create an instance of InvoiceGenerator
            $invoice = new \App\Http\Controllers\Traits\InvoiceGenerator();
            $invoice->number($order->id);
            $user = \App\Models\Auth\User::find($order->user_id);

            // Log to check if the invoice generation has started
            \Log::info('Generating invoice for order ID: ' . $order->id);

            // Loop through order items and add them to the invoice
            foreach ($order->items as $item) {
                // Get item details
                $title = $item->item->title;
                $price = $item->item->price;
                $qty = 1;
                $id = 'prod-' . $item->item->id;
                $invoice->addItem($title, $price, $qty, $id);
            }

            // Calculate total price
            $total = $order->items->sum('price');
            $discount = 0;

            // Apply discount if a coupon is used
            $coupon = \App\Models\Coupon::find($order->coupon_id);
            if ($coupon != null) {
                $discount = number_format($total * $coupon->amount / 100, 2);
                $invoice->addDiscountData($discount);
                $total = $total - $discount;
            }

            // Fetch taxes and apply to the total
            $taxes = \App\Models\Tax::where('status', '=', 1)->get();
            $rateSum = \App\Models\Tax::where('status', '=', 1)->sum('rate');

            if ($taxes != null) {
                $taxData = [];
                foreach ($taxes as $tax) {
                    $taxData[] = ['name' => $tax->name, 'amount' => $total * $tax->rate / 100];
                }
                $invoice->addTaxData($taxData);
                $total = $total + ($total * $rateSum / 100);
            }

            // Set customer details for the invoice
            $invoice->customer([
                'name' => $user->full_name,
                'id' => $user->id,
                'email' => $user->email
            ]);

            // Get the PDF content
            $pdfContent = $invoice->output($order, $invoice, $user);
        } catch (\Exception $e) {
            // Log any exception during the invoice generation process
            \Log::error('Error in generateInvoice generating invoice for order ID ' . $order->id . ': ' . $e->getMessage());
        }
    }
}

if (!function_exists('trashUrl')) {
    /**
     * @param $str
     * @return array
     */
    function trashUrl($request){
        $currentQueries = $request->query();

        //Declare new queries you want to append to string:
        $newQueries = ['show_deleted' => 1];

        //Merge together current and new query strings:
        $allQueries = array_merge($currentQueries, $newQueries);

        //Generate the URL with all the queries:
        return $request->fullUrlWithQuery($allQueries);
    }
}

if (!function_exists('getCurrency')) {
    /**
     * @param $str
     * @return array
     */
    function getCurrency($short_code){
        $currencies = config('currencies');
        $currency = "";
            foreach ($currencies as $key => $val) {
                if ($val['short_code'] == $short_code) {
                    $currency = $val;
                }
            }
       return $currency;
    }
}

if (!function_exists('menuList')) {
    function menuList($array){
        $temp_array = array();
        foreach ($array as $item) {
            if ($item->getsons($item->id)->except($item->id)) {
                $item->subs = menuList($item->getsons($item->id)->except($item->id)); // here is the recursion
                $temp_array[] = $item;
            }
        }
        return $temp_array;
    }
}

if (!function_exists('checkCourseSubscribeOrNot')) {
    function checkCourseSubscribeOrNot($courseArr, $courseId){
        $matched = false;
        $matchedBundle = false;
        $matcheCoursedArr = [];
        if ($courseArr) {
            foreach ($courseArr[0] as $subPlan) {
                if ($subPlan) {
                    //course check
                    foreach ($subPlan->subcribeCourses as $planDetail) {
                        $matcheCoursedArr[] = $planDetail->course->id;
                    }
                    //bundle check course
                    foreach ($subPlan->subcribeBundle as $planDetail) {
                        $bundleCourse = App\Models\BundleCourses::where('bundle_id','=',$planDetail->bundle->id)->where('course_id','=',$courseId)->first();
                        if($bundleCourse && $bundleCourse!=null){
                            $matchedBundle = true;
                        }
                    }
                }
            }
            if (in_array($courseId, $matcheCoursedArr)){
                $matched = true;
            }
        }
        $checkArr = ["matched" => $matched,"matchedBundle"=>$matchedBundle];
        return $checkArr;
    }
}

if (!function_exists('checkBundleSubscribeOrNot')){
    function checkBundleSubscribeOrNot($bundleArr, $bundleId){
        $matched = false;
        $matcheBundledArr = [];
        if ($bundleArr) {
            foreach ($bundleArr[0] as $subPlan){
                if ($subPlan) {
                    foreach ($subPlan->subcribeBundle as $planDetail) {
                        $matcheBundledArr[] = $planDetail->bundle->id;
                    }
                }
            }
            if (in_array($bundleId, $matcheBundledArr)){
                $matched = true;
            }
        }
        return $matched;
    }
}

if (!function_exists('checkExistingUserSubcribtionDate')){
    function checkExistingUserSubcribtionDate($Interval,$expireDays,$ExpireDateExits){
        if ($Interval == 'day' && !empty($ExpireDateExits)) {
            $returnDate = date('Y-m-d\TH:i', strtotime('+' . $expireDays . ' day', strtotime($ExpireDateExits)));
        } else if ($Interval == 'day' && empty($ExpireDateExits) && !empty($expireDays)) {
            $returnDate = date('Y-m-d\TH:i', strtotime('+' . $expireDays . ' day'));
        } else if ($Interval == 'week' && !empty($ExpireDateExits)) {
            $returnDate = date('Y-m-d\TH:i', strtotime('+' . $expireDays . ' week', strtotime($ExpireDateExits)));
        } else if ($Interval == 'week' && empty($ExpireDateExits) && !empty($expireDays)) {
            $returnDate = date('Y-m-d\TH:i', strtotime('+' . $expireDays . ' week'));
        } else if ($Interval == 'month' && !empty($ExpireDateExits)) {
            $returnDate = date('Y-m-d\TH:i', strtotime('+' . $expireDays . ' month', strtotime($ExpireDateExits)));
        } else if ($Interval == 'month' && empty($ExpireDateExits) && !empty($expireDays)) {
            $returnDate = date('Y-m-d\TH:i', strtotime('+' . $expireDays . ' month'));
        } else if ($Interval == 'year' && !empty($ExpireDateExits)) {
            $returnDate = date('Y-m-d\TH:i', strtotime('+' . $expireDays . ' year', strtotime($ExpireDateExits)));
        } else if ($Interval == 'year' && empty($ExpireDateExits) && !empty($expireDays)) {
            $returnDate = date('Y-m-d\TH:i', strtotime('+' . $expireDays . ' year'));        
        } else {
            $returnDate='';
        }
        return $returnDate;
    }
}

if(!function_exists('courseOrBundlePlanExits')){
    function courseOrBundlePlanExits($courseId=null,$bundleId=null){
        $result = false;
        if($courseId){
            $Course = App\Models\stripe\SubscribeCourse::where('course_id','=',$courseId)->first();
            if($Course){
                $result = true;
            }
        }
        if($bundleId){
            $bundleCourse = App\Models\stripe\SubscribeBundle::where('bundle_id','=',$bundleId)->first();
            if($bundleCourse){
                $result = true;
            }
        }
        return $result;
    }
}

if(!function_exists('courseOrBundleExpire')){
    function courseOrBundleExpire($courseId=null,$bundleId=null){
        $result = true;
        if($courseId){
            $courseEx = App\Models\stripe\UserCourses::where('user_id',Auth::id())->where('course_id','=',$courseId)->whereDate('expire_at','>=',Carbon::now())->first();
            if($courseEx==null){
                $result = false;
            }
        }
        if($bundleId){
            $bundleEx = App\Models\stripe\UserCourses::where('user_id',Auth::id())->where('bundle_id','=',$bundleId)->whereDate('expire_at','>=',Carbon::now())->first();
            if($bundleEx==null){
                $result = false;
            }
        }
        return $result;
    }
}