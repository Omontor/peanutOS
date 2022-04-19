<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEventDaysTable extends Migration
{
    public function up()
    {
        Schema::table('event_days', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id')->nullable();
            $table->foreign('event_id', 'event_fk_4164491')->references('id')->on('events');
            $table->unsignedBigInteger('venue_id')->nullable();
            $table->foreign('venue_id', 'venue_fk_4164502')->references('id')->on('venues');
        });
    }
}
