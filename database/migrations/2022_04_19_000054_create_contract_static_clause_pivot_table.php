<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractStaticClausePivotTable extends Migration
{
    public function up()
    {
        Schema::create('contract_static_clause', function (Blueprint $table) {
            $table->unsignedBigInteger('contract_id');
            $table->foreign('contract_id', 'contract_id_fk_6460124')->references('id')->on('contracts')->onDelete('cascade');
            $table->unsignedBigInteger('static_clause_id');
            $table->foreign('static_clause_id', 'static_clause_id_fk_6460124')->references('id')->on('static_clauses')->onDelete('cascade');
        });
    }
}
