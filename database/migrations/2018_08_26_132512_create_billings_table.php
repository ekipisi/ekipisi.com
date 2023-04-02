<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->index()->nullable();
            $table->integer('user_id')->index();
            $table->text('domain')->nullable();
            $table->string('invoice_no');
            $table->decimal('price');
            $table->integer('currency_id')->index();
            $table->date('payment_date');
            $table->boolean('status');
            $table->boolean('is_paid');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('billings');
    }
}
