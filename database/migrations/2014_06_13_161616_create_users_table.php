<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->foreignId('id_rol')->references('id_rol')->on('roles')->onUpdate('cascade');
            $table->string('tipo_documento', 5);
            $table->integer('documento')->unique();
            $table->string('email')->unique();
            $table->string('password', 100);
            $table->boolean('estado')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('usuarios')->insert([
            'id_rol' => '1',
            'tipo_documento' => 'CC',
            'documento' => 1000444493,
            'email' => 'jaog.11.2003@gmail.com',
            'password' => Hash::make('1000444493')
        ]);

        DB::table('usuarios')->insert([
            'id_rol' => '2',
            'tipo_documento' => 'CC',
            'documento' => 123456789,
            'email' => 'jaog.2003.11@gmail.com',
            'password' => Hash::make('123456789')
        ]);
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
