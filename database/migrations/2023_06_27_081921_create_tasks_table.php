<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('my_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 15);
            $table->string('tag');
            $table->text('content', 30);
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

