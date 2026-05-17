<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('cliente')->after('email');
            }
            if (!Schema::hasColumn('users', 'cliente_tipo')) {
                $table->string('cliente_tipo')->nullable()->after('role');
            }
            if (!Schema::hasColumn('users', 'telefono')) {
                $table->string('telefono')->nullable()->after('cliente_tipo');
            }
            if (!Schema::hasColumn('users', 'direccion')) {
                $table->string('direccion')->nullable()->after('telefono');
            }
            if (!Schema::hasColumn('users', 'salario')) {
                $table->decimal('salario', 10, 2)->nullable()->after('direccion');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'cliente_tipo', 'telefono', 'direccion', 'salario']);
        });
    }
};