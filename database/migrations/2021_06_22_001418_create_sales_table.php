<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('customer_id')->nullable();
            $table->date('sale_date')->nullable();
            $table->double('total',12,2)->nullable();
            $table->double('iva')->default(0);
            $table->double('ivar')->default(0);
            $table->boolean('state')->nullable();
            $table->double('subtotal')->nullable();
            $table->string('document_number')->nullable();
            $table->UnsignedBigInteger('user_id')->nullable();
            $table->integer('correlative');
            $table->UnsignedBigInteger('receipt_id');
            //$table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('sales');
    }
}
