<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mongodb')->create('invoices', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned();
            $table->json('user');
            $table->integer('company_id')->unsigned();
            $table->json('company');
            $table->integer('customer_id')->unsigned();
            $table->json('customer');
            $table->json('shipping_method');
            $table->json('products');

            $table->date('date');
            $table->date('delivery_date');
            $table->date('due_date');
            $table->string('payment_terms');

            $table->float('subtotal')->unsigned();
            $table->float('vat')->unsigned();
            $table->float('total')->unsigned();

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
        Schema::connection('mongodb')->drop('invoices');
    }
}
