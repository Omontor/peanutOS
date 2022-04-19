<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationRentalClausePivotTable extends Migration
{
    public function up()
    {
        Schema::create('quotation_rental_clause', function (Blueprint $table) {
            $table->unsignedBigInteger('quotation_id');
            $table->foreign('quotation_id', 'quotation_id_fk_4164339')->references('id')->on('quotations')->onDelete('cascade');
            $table->unsignedBigInteger('rental_clause_id');
            $table->foreign('rental_clause_id', 'rental_clause_id_fk_4164339')->references('id')->on('rental_clauses')->onDelete('cascade');
        });
    }
}
