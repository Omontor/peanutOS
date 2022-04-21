<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetReturnsTable extends Migration
{
    public function up()
    {
        Schema::create('asset_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
