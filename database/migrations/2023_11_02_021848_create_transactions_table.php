<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code');
            $table->integer('contact_id')->unsigned();
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->decimal('total_amount', 22, 4)->default(0);
            $table->dateTime('transaction_date');
            $table->enum('transaction_type', ['purchase', 'sell', 'order'])->default('sell');
            $table->decimal('payment_amount', 22, 4)->default(0);
            $table->enum('payment_type', ['cash', 'online', 'both'])->default('cash');
            $table->enum('payment_status', ['debit', 'paid_off', 'due', 'partial'])->default('paid_off');
            $table->dateTime('payment_date_ends')->nullable();
            $table->json('details_payment')->nullable();
            $table->string('code_invoice_discount')->nullable();
            $table->string('note')->nullable();
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('transactions');
    }
}
