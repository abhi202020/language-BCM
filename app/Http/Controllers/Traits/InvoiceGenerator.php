<?php

namespace App\Http\Controllers\Traits;

use Dompdf\Dompdf;
use Dompdf\Options;

class InvoiceGenerator {

    private $invoiceNumber; // Changed to private
    protected $items = [];
    protected $userData;

    public $taxData = null;
    public $discount = null;
    public $total = null;

    public function __construct($name = 'Invoice') {
        // Your constructor logic here
    }

    // Method to set customer data
    public function customer($userData) {
        $this->userData = $userData;
        // \Log::info('User data set: ' . json_encode($userData));
        return $this;
    }

    // Method to add tax data
    public function addTaxData($taxData) {
        $this->taxData = $taxData;
        // \Log::info('Tax data added: ' . json_encode($taxData));
        return $this;
    }

    // Method to add discount data
    public function addDiscountData($coupon) {
        $this->discount = number_format($coupon, 2);
        // \Log::info('Discount added: ' . $this->discount);
        return $this;
    }

    // Method to add total data
    public function addTotal($total) {
        \Log::info('Total added: ' . number_format($total, 2));
        return $this;
    }

    // Method to add item to the invoice
    public function addItem($title, $price, $quantity, $id) {
        $this->items[] = [
            'title' => $title,
            'price' => $price,
            'quantity' => $quantity,
            'id' => $id,
        ];

        // \Log::info('Item added to the invoice: ' . $title);
        return $this;
    }

    // Method to set the invoice number
    public function number($invoiceNumber) {
        $this->invoiceNumber = $invoiceNumber;
        return $this;
    }

    // Method to get the invoice number
    public function getInvoiceNumber() {
        return $this->invoiceNumber;
    }

    // Method to generate and save the PDF
    public function output($order, $invoice, $user) {
        \Log::info('Starting pdf generation');

        $currentDateTime = now();
       // Set the invoice number
        $invoice->number($order->invoiceNumber);

        // Pass $order along with $invoiceData to the Blade view
        $html = view('vendor.invoices.default', [
            'invoiceData' => $invoice,
            'order' => $order,
            'user' => $user,
            'data' => $order->items,
            'total' => $invoice->total,
            'discount' => $invoice->discount,
            'taxData' => $invoice->taxData,
            'orderTotal' => $order->amount, // Pass the total amount
        ])->render();

        // Create Dompdf instance with debugging options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfContent = $dompdf->output();
        \Log::info('Blade pdf rendered');

        // Save the PDF to storage
        $pdfFileName = 'invoice_' . $order->id . '.pdf';
        $pdfPath = storage_path('app/public/invoices/') . $pdfFileName;

        file_put_contents($pdfPath, $pdfContent);
        \Log::info('PDF invoice saved to: ' . $pdfPath . ' at ' . $currentDateTime);

        return $pdfContent;
    }
}