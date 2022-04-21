<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientEvaluationsTable extends Migration
{
    public function up()
    {
        Schema::create('client_evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('rating', 4, 2);
            $table->longText('observations')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
