<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetQuotationPivotTable extends Migration
{
    public function up()
    {
        Schema::create('asset_quotation', function (Blueprint $table) {
            $table->unsignedBigInteger('quotation_id');
            $table->foreign('quotation_id', 'quotation_id_fk_4164328')->references('id')->on('quotations')->onDelete('cascade');
            $table->unsignedBigInteger('asset_id');
            $table->foreign('asset_id', 'asset_id_fk_4164328')->references('id')->on('assets')->onDelete('cascade');
        });
    }
}
