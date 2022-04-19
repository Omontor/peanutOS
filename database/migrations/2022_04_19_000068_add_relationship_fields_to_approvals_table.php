<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToApprovalsTable extends Migration
{
    public function up()
    {
        Schema::table('approvals', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_4164420')->references('id')->on('users');
            $table->unsignedBigInteger('quotation_id')->nullable();
            $table->foreign('quotation_id', 'quotation_fk_4164421')->references('id')->on('quotations');
        });
    }
}
