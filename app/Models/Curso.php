<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';
    
    protected $fillable = [
        'titulo', 'descripcion', 'contenido', 'precio', 'duracion_horas',
        'fecha_inicio', 'fecha_fin', 'capacidad_maxima', 'inscritos',
        'instructor', 'imagen', 'estado'
    ];
    
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'precio' => 'decimal:2'
    ];
    
    public function estaActivo()
    {
        return $this->estado == 'activo';
    }
    
    public function hayCupo()
    {
        return $this->inscritos < $this->capacidad_maxima;
    }
    
    public function cuposDisponibles()
    {
        return $this->capacidad_maxima - $this->inscritos;
    }
}