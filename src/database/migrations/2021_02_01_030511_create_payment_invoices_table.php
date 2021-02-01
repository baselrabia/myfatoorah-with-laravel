<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_invoices', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('order_id'); //CustomerReference
            $table->unsignedBigInteger('client_id'); // "UserDefinedField" => "321"

            $table->unsignedBigInteger('InvoiceId');
            $table->string('InvoiceStatus');
            $table->string('InvoiceValue');
            $table->string('Currency');
            $table->string('InvoiceDisplayValue');

            $table->unsignedBigInteger('TransactionId');
            $table->string('TransactionStatus');
            $table->string('PaymentGateway');
            $table->unsignedBigInteger('PaymentId');
            $table->string('CardNumber');

            $table->timestamps();
 
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_invoices');
    }
}
