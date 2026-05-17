<?php
// database/migrations/2024_01_01_000004_create_pedidos_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('direccion_entrega');
            $table->datetime('hora_entrega');
            $table->string('tarjeta_personalizada');
            $table->enum('metodo_pago', ['efectivo', 'qr', 'tarjeta']);
            $table->decimal('total', 10, 2);
            $table->enum('estado', ['pendiente', 'pagado', 'entregado', 'cancelado'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
};