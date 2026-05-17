<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'asistencia';
    
    protected $fillable = [
        'personal_id', 'fecha', 'hora_entrada', 'hora_salida', 'estado', 'observacion'
    ];
    
    protected $casts = [
        'fecha' => 'date',
        'hora_entrada' => 'datetime',
        'hora_salida' => 'datetime'
    ];
    
    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }
    
    public function marcarEntrada($hora = null)
    {
        $this->hora_entrada = $hora ?? now();
        $this->fecha = now();
        
        // Determinar estado basado en la hora
        $horaLimite = '09:15:00'; // Tolerancia de 15 minutos
        if ($this->hora_entrada->format('H:i:s') > $horaLimite) {
            $this->estado = 'tarde';
        } else {
            $this->estado = 'presente';
        }
        
        $this->save();
    }
    
    public function marcarSalida($hora = null)
    {
        $this->hora_salida = $hora ?? now();
        $this->save();
    }
}