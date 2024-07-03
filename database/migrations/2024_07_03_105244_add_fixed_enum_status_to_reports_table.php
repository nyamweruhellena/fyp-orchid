<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFixedEnumStatusToReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->enum('status', ['In progress', 'done', 'Not done', 'fixed'])->after('property_id')->default('Not done');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->enum('status', ['In progress', 'done', 'Not done'])->after('property_id')->default('Not done');
        });
    }
}
