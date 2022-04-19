<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDocumenationChaptersTable extends Migration
{
    public function up()
    {
        Schema::table('documenation_chapters', function (Blueprint $table) {
            $table->unsignedBigInteger('project_documentation_id')->nullable();
            $table->foreign('project_documentation_id', 'project_documentation_fk_6459731')->references('id')->on('project_documentations');
        });
    }
}
