<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToChapterContentsTable extends Migration
{
    public function up()
    {
        Schema::table('chapter_contents', function (Blueprint $table) {
            $table->unsignedBigInteger('chapter_id')->nullable();
            $table->foreign('chapter_id', 'chapter_fk_6459740')->references('id')->on('documenation_chapters');
        });
    }
}
