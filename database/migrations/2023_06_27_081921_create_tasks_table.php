<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('tag');
            $table->text('content');
            $table->boolean('status')->default(0);
            $table->integer('progress')->default(0)->unsigned()->nullable();
            $table->date('schedule')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('finish_time')->nullable();
            $table->integer('importance')->default(0)->unsigned();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}

