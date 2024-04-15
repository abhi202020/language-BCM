<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Course;
use App\Models\Order;
use App\Models\Invoice;
use Hashids\Hashids;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InvoiceController extends Controller{
    /**
     * Get invoice list of current user
     * @param Request $request 
     */
    public function getIndex(){
        $userId = auth()->id();

        if (!$userId) {
            Log::warning('User is not authenticated');
            return abort(403);
        }
        try {
            $appCurrency = ['symbol' => '$'];
            $orders = Order::where('user_id', $userId)->get();

            Log::info("Number of orders for User ID $userId: " . count($orders));
            return view('backend.invoices.index', compact('orders', 'appCurrency'));
        } catch (\Exception $e) {
            Log::error('Error fetching orders: ' . $e->getMessage());
            return abort(500);
        }
    }   

    public function showInvoice(Request $request, $orderId){
        try {
            // Fetch the order based on the provided ID
            $order = Order::findOrFail($orderId);
            Log::warning("Fetching invoice for Order ID: $orderId");
    
            // Build the expected file name based on order ID
            $invoiceFileName = "invoice_{$orderId}.pdf";
            Log::info("Invoice file name: $invoiceFileName");
    
            // Check if the file exists in the specified path
            $filePath = storage_path("app/public/invoices/{$invoiceFileName}");
            if (!file_exists($filePath)) {
                // Handle the case where the file does not exist
                Log::warning("Invoice file not found: $invoiceFileName");
                return abort(404); // or return an appropriate response
            }
            // Log file path for further verification
            Log::info("File path: $filePath");
    
            // Return the invoice file as a response
            return response()->file($filePath);
        } catch (NotFoundHttpException $e) {
            // Catch specifically the NotFoundHttpException
            Log::warning('Invoice not found: ' . $e->getMessage());
            return abort(404); // or return an appropriate response for a 404 scenario
        } catch (\Exception $e) {
            // Log other exceptions
            Log::error('Error fetching invoice: ' . $e);
            return abort(500);
        }
    }
     
    public function downloadInvoice($orderId){
        try {
            \Log::info("Entering downloadInvoice method for Order ID: $orderId");
    
            // Fetch the order based on the provided ID
            $order = Order::findOrFail($orderId);
            \Log::warning("Fetched invoice ID: $orderId");
    
            // Build the expected file name based on order ID
            $invoiceFileName = "invoice_{$orderId}.pdf";
            \Log::info("Constructed invoice file name: $invoiceFileName");
    
            // Check if the file exists in the specified path
            $filePath = storage_path("app/public/invoices/{$invoiceFileName}");
            if (!file_exists($filePath)) {
                // Handle the case where the file does not exist
                \Log::warning("Invoice file not found: $invoiceFileName");
                return abort(404); // or return an appropriate response
            }
            \Log::info("File path: $filePath");
    
            // Return the invoice file as a response
            return response()->download($filePath);
        } catch (\Exception $e) {
            // Log any exceptions that may occur
            \Log::error('Error downloading invoice: ' . $e);
            return abort(500); // or return an appropriate response for a 500 scenario
        }
    }
    
}
