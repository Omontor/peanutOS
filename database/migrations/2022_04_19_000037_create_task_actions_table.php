<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskActionsTable extends Migration
{
    public function up()
    {
        Schema::create('task_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('content')->nullable();
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
