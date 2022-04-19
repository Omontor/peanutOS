<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('serial_number')->unique();
            $table->decimal('cost', 15, 2)->nullable();
            $table->decimal('day_price', 15, 2);
            $table->decimal('week_price', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
