<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $table = 'personal';
    
    protected $fillable = [
        'nombre', 'apellido', 'email', 'telefono', 'cargo', 
        'descripcion', 'foto', 'estado', 'salario', 
        'fecha_contratacion', 'hora_entrada', 'hora_salida'
    ];
    
    protected $casts = [
        'fecha_contratacion' => 'date',
        'salario' => 'decimal:2'
    ];
    
    public function getNombreCompletoAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }
}