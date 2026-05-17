<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('personal', function (Blueprint $table) {
            if (!Schema::hasColumn('personal', 'hora_entrada')) {
                $table->time('hora_entrada')->default('09:00:00');
            }
            if (!Schema::hasColumn('personal', 'hora_salida')) {
                $table->time('hora_salida')->default('18:00:00');
            }
        });
    }

    public function down()
    {
        Schema::table('personal', function (Blueprint $table) {
            $table->dropColumn(['hora_entrada', 'hora_salida']);
        });
    }
};