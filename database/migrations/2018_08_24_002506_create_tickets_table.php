<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('status_id')->index();
            $table->integer('department_id')->index();
            $table->integer('service_id')->nullable()->index();
            $table->integer('priority_id')->index();
            $table->integer('type_id')->nullable()->index();
            $table->longText('title');
            $table->text('message');
            $table->text('notes');
            $table->longText('file');
            $table->string('ip');
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
        Schema::dropIfExists('tickets');
    }
}
