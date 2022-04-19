<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticClausesTable extends Migration
{
    public function up()
    {
        Schema::create('static_clauses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('content');
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
