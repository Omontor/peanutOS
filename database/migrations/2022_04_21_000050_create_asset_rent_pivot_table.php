<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetRentPivotTable extends Migration
{
    public function up()
    {
        Schema::create('asset_rent', function (Blueprint $table) {
            $table->unsignedBigInteger('rent_id');
            $table->foreign('rent_id', 'rent_id_fk_4164322')->references('id')->on('rents')->onDelete('cascade');
            $table->unsignedBigInteger('asset_id');
            $table->foreign('asset_id', 'asset_id_fk_4164322')->references('id')->on('assets')->onDelete('cascade');
        });
    }
}
