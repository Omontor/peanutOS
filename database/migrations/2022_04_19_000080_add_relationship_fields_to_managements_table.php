<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToManagementsTable extends Migration
{
    public function up()
    {
        Schema::table('managements', function (Blueprint $table) {
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->foreign('lead_id', 'lead_fk_4164676')->references('id')->on('users');
        });
    }
}
