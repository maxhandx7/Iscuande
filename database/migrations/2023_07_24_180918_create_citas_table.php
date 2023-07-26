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
            $table->unsignedBigInteger('cupo_id');
            $table->string('FechaCita');
            $table->string('HoraCita');
            $table->string('cupos');
            $table->enum('estado',['ACTIVO', 'INACTIVO'])->default('ACTIVO');
            $table->timestamps();

            // Definir las relaciones con las tablas de pacientes y médicos
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cupo_id')->references('id')->on('cupos')->onDelete('cascade');
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
