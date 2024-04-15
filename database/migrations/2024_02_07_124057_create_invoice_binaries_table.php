<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceBinariesTable extends Migration{
    public function up(){
        Schema::create('invoice_binaries', function (Blueprint $table) {
            $table->id();
            $table->uuid('pdf_reference_uuid')->unique();
            $table->binary('pdf_content');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('invoice_binaries');
    }
}
