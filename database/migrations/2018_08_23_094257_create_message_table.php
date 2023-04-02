<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->tinyInteger('type');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('subject');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->text('message')->nullable();
            $table->text('note')->nullable();
            $table->boolean('newsletter');
            $table->boolean('read');
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
        Schema::dropIfExists('message');
    }
}
