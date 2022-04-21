<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAssetReturnsTable extends Migration
{
    public function up()
    {
        Schema::table('asset_returns', function (Blueprint $table) {
            $table->unsignedBigInteger('rent_id')->nullable();
            $table->foreign('rent_id', 'rent_fk_6470663')->references('id')->on('rents');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_6470661')->references('id')->on('teams');
        });
    }
}
