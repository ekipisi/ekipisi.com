<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partnerships', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('assign_id')->nullable();
            $table->string('channel');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone');
            $table->longText('company');
            $table->string('message')->nullable();
            $table->boolean('status');
            $table->boolean('called');
            $table->boolean('paid');
            $table->decimal('price')->nullable();
            $table->text('note')->nullable();
            $table->datetime('paid_at')->nullable();
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
        Schema::dropIfExists('partnerships');
    }
}
