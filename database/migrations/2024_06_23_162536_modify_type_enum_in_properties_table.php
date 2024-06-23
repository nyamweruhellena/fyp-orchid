<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTypeEnumInPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            // Drop the existing 'type' column
            $table->dropColumn('type');
        });

        Schema::table('properties', function (Blueprint $table) {
            // Add the new 'type' column with the updated enum values and default value
            $table->enum('type', ['electrical', 'electronics', 'furniture', 'computing', 'plumbing', 'mechanical', 'others'])
                ->default('others');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            // Drop the new 'type' column
            $table->dropColumn('type');
        });

        Schema::table('properties', function (Blueprint $table) {
            // Add the original 'type' column with the original enum values
            $table->enum('type', ['electrical', 'electronics', 'furniture', 'computing', 'plumbing']);
        });
    }
}
