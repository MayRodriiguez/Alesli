<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';

    protected $fillable = [
        'user_id',
        'total',
        'estado',
        'direccion_entrega',
        'notas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(PedidoItem::class);
    }

    public function getEstadoBadgeAttribute(): string
    {
        return match ($this->estado) {
            'pendiente'   => '<span class="badge bg-warning text-dark">Pendiente</span>',
            'confirmado'  => '<span class="badge bg-info text-dark">Confirmado</span>',
            'en_camino'   => '<span class="badge bg-primary">En camino</span>',
            'entregado'   => '<span class="badge bg-success">Entregado</span>',
            'cancelado'   => '<span class="badge bg-danger">Cancelado</span>',
            default       => '<span class="badge bg-secondary">' . $this->estado . '</span>',
        };
    }
}