<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChapterContentsTable extends Migration
{
    public function up()
    {
        Schema::create('chapter_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('content');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
