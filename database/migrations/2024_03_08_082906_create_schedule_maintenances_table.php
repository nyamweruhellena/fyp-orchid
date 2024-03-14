<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_maintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['maintained','not maintained']);
            $table->unsignedInteger('property_id');
            $table->string('last_maintenance');
            $table->string('next_maintenance');
            $table->timestamps();


            $table->foreign('property_id','property_schedule_maintenance_fx')
            ->references('id')
            ->on('properties')
            ->onDelete('no action')
            ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_maintenances');
    }
}
