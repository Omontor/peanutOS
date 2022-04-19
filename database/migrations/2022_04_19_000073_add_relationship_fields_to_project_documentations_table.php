<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProjectDocumentationsTable extends Migration
{
    public function up()
    {
        Schema::table('project_documentations', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id', 'project_fk_6459722')->references('id')->on('projects');
        });
    }
}
