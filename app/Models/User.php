<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono',
        'direccion',
        'role',
        'theme',  // ← Agregado para modo oscuro/claro
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    // Relaciones
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
    
    // Métodos de ayuda para el tema
    public function getThemeAttribute($value)
    {
        return $value ?? 'light';
    }
    
    public function isDarkMode()
    {
        return $this->theme === 'dark';
    }
    
    public function isLightMode()
    {
        return $this->theme !== 'dark';
    }
}