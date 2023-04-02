<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_products', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('status');
            $table->integer('user_id')->index();
            $table->integer('product_id')->nullable()->index();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->decimal('price')->nullable();
            $table->decimal('price_renewal')->nullable();
            $table->string('payment_type');
            $table->integer('currency_id');
            $table->integer('period_id');
            $table->integer('cpanel_uid')->nullable();
            $table->date('payment_date')->nullable();
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
        Schema::dropIfExists('users_products');
    }
}
