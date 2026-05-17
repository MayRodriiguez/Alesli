<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion');
            $table->text('contenido')->nullable();
            $table->decimal('precio', 10, 2);
            $table->integer('duracion_horas')->default(0);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('capacidad_maxima')->default(10);
            $table->integer('inscritos')->default(0);
            $table->string('instructor');
            $table->string('imagen')->nullable();
            $table->enum('estado', ['activo', 'inactivo', 'completado'])->default('activo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cursos');
    }
};