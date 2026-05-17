<?php
// app/Models/Evento.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = [
        'titulo', 'descripcion', 'fecha', 'ubicacion'
    ];

    protected $casts = [
        'fecha' => 'date'
    ];
}