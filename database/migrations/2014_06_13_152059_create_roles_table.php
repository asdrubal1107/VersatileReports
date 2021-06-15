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
            $table->id('id_rol');
            $table->string('nombre', 30);
            $table->boolean('estado')->default(1);
        });

        DB::table('roles')->insert([
            ['id_rol' => '1', 'nombre' => 'Administrador']
        ]);
        DB::table('roles')->insert([
            ['id_rol' => '2', 'nombre' => 'Contratista']
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
