<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTaskActionsTable extends Migration
{
    public function up()
    {
        Schema::table('task_actions', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id')->nullable();
            $table->foreign('task_id', 'task_fk_4164774')->references('id')->on('tasks');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_4164775')->references('id')->on('users');
            $table->unsignedBigInteger('asignee_id')->nullable();
            $table->foreign('asignee_id', 'asignee_fk_4164776')->references('id')->on('users');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_4164782')->references('id')->on('teams');
        });
    }
}
