<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
        });

        // TODO: remove faker and add <b>real</b> descriptions.
        $faker = Faker\Factory::create();
        DB::table('roles')->insert([
            'name'        => 'admin',
            'description' => $faker->paragraph(1),
        ]);

        DB::table('roles')->insert([
            'name'        => 'salesperson',
            'description' => $faker->paragraph(1),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
