<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpicUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('epic_user', function (Blueprint $table) {
            $table->unsignedBigInteger('epic_id');
            $table->foreign('epic_id', 'epic_id_fk_4164683')->references('id')->on('epics')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_4164683')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
