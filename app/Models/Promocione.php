<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promocione extends Model
{
    protected $table = 'promociones';
    
    protected $fillable = [
        'titulo', 'descripcion', 'descuento', 'fecha_inicio', 'fecha_fin',
        'codigo', 'tipo', 'monto_minimo', 'activo'
    ];
    
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'descuento' => 'decimal:2',
        'monto_minimo' => 'decimal:2',
        'activo' => 'boolean'
    ];
    
    public function estaActiva()
    {
        $hoy = now()->startOfDay();
        return $this->activo && 
               $this->fecha_inicio <= $hoy && 
               $this->fecha_fin >= $hoy;
    }
}