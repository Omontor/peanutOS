<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTaskMailsTable extends Migration
{
    public function up()
    {
        Schema::table('task_mails', function (Blueprint $table) {
            $table->unsignedBigInteger('title_id')->nullable();
            $table->foreign('title_id', 'title_fk_4164812')->references('id')->on('task_actions');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_4164816')->references('id')->on('teams');
        });
    }
}
