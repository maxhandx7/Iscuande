<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('turno_id');
            $table->unsignedBigInteger('especialidad_id');
            $table->string('FechaCita');
            $table->string('HoraCita');
            $table->enum('estado',['PENDIENTE', 'ACEPTADA', 'RECHAZADA'])->default('PENDIENTE');
            $table->timestamps();

            // Definir las relaciones con las tablas de pacientes y médicos
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('turno_id')->references('id')->on('turnos')->onDelete('cascade');
            $table->foreign('especialidad_id')->references('id')->on('especialidads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}
