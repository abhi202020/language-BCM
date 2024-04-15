<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ConfirmInvoice extends Mailable implements ShouldQueue{
    use Queueable, SerializesModels;

    public $subject;
    public $pdfContent;
    public $order;
    public $formattedDate;

    public function __construct($subject, $pdfContent, $order){
        $this->subject = $subject;
        $this->pdfContent = $pdfContent;
        $this->order = $order;
        $this->formattedDate = optional($order->created_at)->timezone('Australia/Sydney')->format('Y-m-d H:i:s');
    }

    public function build(){
        Log::info('Attaching PDF to email at: ' . now());

        return $this->subject($this->subject)
            ->markdown('emails.userOrderConfirmation', ['formattedDate' => $this->formattedDate])
            ->attachPdf();
    }

    public function attachPdf(){
        $pdfFileName = 'invoice_' . $this->order->invoiceNumber . '.pdf';
        $pdfPath = storage_path('app/public/invoices/') . $pdfFileName;

        return $this->attach(Storage::path('public/invoices/' . $pdfFileName), [
            'as' => 'invoice.pdf',
            'mime' => 'application/pdf',
        ]);
    }
}
