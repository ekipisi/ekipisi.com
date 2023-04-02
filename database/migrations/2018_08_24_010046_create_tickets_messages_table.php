<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ticket_id')->index();
            $table->integer('assign_id')->index();
            $table->integer('user_id')->index();
            $table->text('message');
            $table->longText('file')->nullable();
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
        Schema::dropIfExists('tickets_messages');
    }
}
