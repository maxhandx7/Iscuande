<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellido');
            $table->string('tipo_documento');
            $table->string('no_documento')->unique();
            $table->string('telefono')->nullable();
            $table->string('email');
            $table->enum('tipo',['PACIENTE', 'ADMIN', 'MEDICO'])->default('PACIENTE');
            $table->enum('estado',['ACTIVO', 'INACTIVO'])->default('ACTIVO');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
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
