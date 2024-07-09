<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntosGpsTable extends Migration
{
    public function up()
    {
        Schema::create('puntos_gps', function (Blueprint $table) {
            $table->id();
            $table->string('dispositivo');
            $table->string('imei');
            $table->dateTime('tiempo');
            $table->string('placa');
            $table->string('version');
            $table->decimal('longitud', 10, 6);
            $table->decimal('latitud', 10, 6);
            $table->dateTime('fecha_recepcion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('puntos_gps');
    }
}
