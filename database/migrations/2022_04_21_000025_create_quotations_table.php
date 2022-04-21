<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->decimal('total', 15, 2);
            $table->date('from')->nullable();
            $table->date('to')->nullable();
            $table->integer('validity')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
