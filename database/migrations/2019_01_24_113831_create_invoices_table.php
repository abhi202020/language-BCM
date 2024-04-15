<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration{
    /**
     * Run the migrations.
     * @return void
     */
    public function up(){
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('user_id');
            $table->uuid('pdf_reference_uuid')->unique();
            $table->binary('pdf_content')->nullable();
            $table->string('url');
            $table->timestamps();
        });
    }    

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down(){
        Schema::dropIfExists('invoices');
    }
}
