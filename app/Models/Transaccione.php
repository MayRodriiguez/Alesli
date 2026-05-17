<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaccione extends Model
{
    protected $table = 'transacciones';
    
    protected $fillable = [
        'tipo', 'monto', 'concepto', 'pedido_id', 'fecha_transaccion'
    ];

    protected $casts = [
        'fecha_transaccion' => 'datetime'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}