<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    
    protected $fillable = [
        'nombre', 'descripcion', 'precio', 'stock', 'imagen', 'estado', 'activo'
    ];
    
    public function actualizarEstado()
    {
        if ($this->stock <= 0) {
            $this->estado = 'agotado';
        } elseif ($this->stock <= 5) {
            $this->estado = 'stock_bajo';
        } else {
            $this->estado = 'disponible';
        }
        $this->save();
    }
}