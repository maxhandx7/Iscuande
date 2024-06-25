<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssistantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('assistants');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          // Puedes agregar el esquema para crear la tabla nuevamente si alguna vez quieres revertir esta migración
        Schema::create('assistants', function (Blueprint $table) {
            $table->id();
            // Agrega las columnas que tenía la tabla aquí
            $table->timestamps();
        });
    }
}
