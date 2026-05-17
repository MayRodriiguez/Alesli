<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('telefono');
            $table->string('cargo');
            $table->text('descripcion')->nullable();
            $table->string('foto')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->decimal('salario', 10, 2);
            $table->date('fecha_contratacion');
            $table->time('hora_entrada')->default('09:00:00');
            $table->time('hora_salida')->default('18:00:00');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('personal');
    }
};
