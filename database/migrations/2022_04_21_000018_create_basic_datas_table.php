<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasicDatasTable extends Migration
{
    public function up()
    {
        Schema::create('basic_datas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->string('email');
            $table->string('rfc');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
