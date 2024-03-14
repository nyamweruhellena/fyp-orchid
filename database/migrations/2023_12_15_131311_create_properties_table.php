<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serial_no');
            $table->string('name');
            $table->string('description')->nullable();
            // $table->string('location')->nullable();
            $table->enum('status', ['Okay','Not Okay','maintenanca']);
            $table->enum('type',['electrical','electronics','furniture','computing','plumbing']);
            $table->unsignedInteger('college_block_id');
            $table->timestamps();


            $table->foreign('college_block_id','college_block_property_fx')
            ->references('id')
            ->on('college_blocks')
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
        Schema::dropIfExists('properties');
    }
}
