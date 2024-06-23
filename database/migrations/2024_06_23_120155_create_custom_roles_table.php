<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCustomRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_roles', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('custom_roles')->insert([
            [
                "slug" => "admin",
                "name" => "Admin"
            ],
            [
                "slug" => "root",
                "name" => "Root"
            ],
            [
                "slug" => "officer",
                "name" => "Officer"
            ],
            [
                "slug" => "user",
                "name" => "User"
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_roles');
    }
}
