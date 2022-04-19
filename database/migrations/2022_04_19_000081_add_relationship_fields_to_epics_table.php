<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEpicsTable extends Migration
{
    public function up()
    {
        Schema::table('epics', function (Blueprint $table) {
            $table->unsignedBigInteger('reporter_id')->nullable();
            $table->foreign('reporter_id', 'reporter_fk_4164686')->references('id')->on('users');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_4164695')->references('id')->on('epic_statuses');
        });
    }
}
