<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Helpers\General\EarningHelper;
use App\Models\Bundle;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Ramsey\Uuid\Uuid;

class OrderController extends Controller
{
    /**
     * Display a listing of Orders.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info('Showing orders at: ' . now());
        $orders = Order::get();
        return view('backend.orders.index', compact('orders'));
    }

    /**
     * Display a listing of Orders via ajax DataTable.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        Log::info('Fetching order data at: ' . now());
        if (request('offline_requests') == 1) {
            $orders = Order::query()->where('payment_type', '=', 3)->orderBy('updated_at', 'desc');
        } else {
            $orders = Order::query()->orderBy('updated_at', 'desc');
        }

        return DataTables::of($orders)
            ->addIndexColumn()
            ->addColumn('actions', function ($q) use ($request) {
                $view = "";

                $view = view('backend.datatable.action-view')
                    ->with(['route' => route('admin.orders.show', ['order' => $q->id])])->render();

                if ($q->status == 0) {
                    $complete_order = view('backend.datatable.action-complete-order')
                        ->with(['route' => route('admin.orders.complete', ['order' => $q->id])])
                        ->render();
                    $view .= $complete_order;
                }

                if ($q->status == 0) {
                    $delete = view('backend.datatable.action-delete')
                    ->with(['route' => route('admin.orders.destroy', ['order' => $q->id])])
                    ->render();

                    $view .= $delete;
                }
                return $view;
            })
            ->addColumn('items', function ($q) {
                $items = "";
                foreach ($q->items as $key => $item) {
                    if($item->item != null){
                        $key++;
                        $items .= $key . '. ' . $item->item->title . "<br>";
                    }
                }
                return $items;
            })
            ->addColumn('user_email', function ($q) {
                return $q->user->email;
            })
            ->addColumn('date', function ($q) {
                return $q->updated_at->diffforhumans();
            })
            ->addColumn('payment', function ($q) {
                if ($q->status == 0) {
                    $payment_status = trans('labels.backend.orders.fields.payment_status.pending');
                } elseif ($q->status == 1) {
                    $payment_status = trans('labels.backend.orders.fields.payment_status.completed');
                } else {
                    $payment_status = trans('labels.backend.orders.fields.payment_status.failed');
                }
                return $payment_status;
            })
            ->editColumn('price', function ($q) {
                return '$' . floatval($q->price);
            })
            ->rawColumns(['items', 'actions'])
            ->make();
    }

    /**
     * Complete Order manually once payment received.
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function complete(Request $request)
    {
        Log::info('Completing order at: ' . now());
        $order = Order::findOrfail($request->order);
        $order->status = 1;
        $order->save();

        (new EarningHelper)->insert($order);

        generateInvoice($order);

        foreach ($order->items as $orderItem) {
            // Bundle Entries
            if($orderItem->item_type == Bundle::class){
               foreach ($orderItem->item->courses as $course){
                   $course->students()->attach($order->user_id);
               }
            }
            $orderItem->item->students()->attach($order->user_id);
        }
        return back()->withFlashSuccess(trans('alerts.backend.general.updated'));
    }

    /**
     * Show Order from storage.
     * 
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::info('Showing order details at: ' . now());
        $order = Order::findOrFail($id);
        return view('backend.orders.show', compact('order'));
    }

    /**
     * Remove Order from storage.
     * 
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::info('Deleting order at: ' . now());
        $order = Order::findOrFail($id);
        $order->items()->delete();
        $order->delete();
        return redirect()->route('admin.orders.index')->withFlashSuccess(trans('alerts.backend.general.deleted'));
    }

    /**
     * Delete all selected Orders at once.
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(Request $request)
    {
        Log::info('Deleting multiple orders at: ' . now());
        if (!Gate::allows('course_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Order::whereIn('id', $request->input('ids'))->get();
            foreach ($entries as $entry) {
                if ($entry->status == 1) {
                    foreach ($entry->items as $item) {
                        $item->course->students()->detach($entry->user_id);
                    }
                    $entry->items()->delete();
                    $entry->delete();
                }
            }
        }
    }

    /**
     * Generate order content.
     * 
     * @param  Order $order
     * @return array
     */
    private function generateOrderContent($order)
    {
        $content = [];
        $items = [];
        $counter = 0;

        // Iterate over cart items
        foreach (Cart::session(auth()->user()->id)->getContent() as $key => $cartItem) {
            $counter++;
            // Generate UUID for each item
            $itemId = Uuid::uuid4()->toString();
            $items[] = [
                'id' => $itemId,
                'number' => $counter,
                'name' => $cartItem->name,
                'price' => $cartItem->price,
            ];
        }

        // Populate content array
        $content['items'] = $items;
        $content['total'] = number_format(Cart::session(auth()->user()->id)->getTotal(), 2);
        $content['reference_no'] = $order->reference_no;

        // Log the content for debugging
        \Log::info('Generated Order Content:', $content);

        return $content;
    }
}
