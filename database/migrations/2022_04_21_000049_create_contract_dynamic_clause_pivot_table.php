<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractDynamicClausePivotTable extends Migration
{
    public function up()
    {
        Schema::create('contract_dynamic_clause', function (Blueprint $table) {
            $table->unsignedBigInteger('contract_id');
            $table->foreign('contract_id', 'contract_id_fk_6460125')->references('id')->on('contracts')->onDelete('cascade');
            $table->unsignedBigInteger('dynamic_clause_id');
            $table->foreign('dynamic_clause_id', 'dynamic_clause_id_fk_6460125')->references('id')->on('dynamic_clauses')->onDelete('cascade');
        });
    }
}
