<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Producto;
use App\Models\Curso;
use App\Models\Promocione;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Usuario Admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@flores.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'telefono' => '123456789',
            'direccion' => 'Oficina Central'
        ]);
        
        // Usuario Personal
        User::create([
            'name' => 'María Flores',
            'email' => 'personal@flores.com',
            'password' => Hash::make('personal123'),
            'role' => 'personal',
            'salario' => 1500,
            'telefono' => '987654321',
            'direccion' => 'Calle Principal 123'
        ]);
        
        User::create([
            'name' => 'Juan Pérez',
            'email' => 'personal2@flores.com',
            'password' => Hash::make('personal123'),
            'role' => 'personal',
            'salario' => 1400,
            'telefono' => '987654322',
            'direccion' => 'Calle Secundaria 456'
        ]);
        
        User::create([
            'name' => 'Ana García',
            'email' => 'personal3@flores.com',
            'password' => Hash::make('personal123'),
            'role' => 'personal',
            'salario' => 1450,
            'telefono' => '987654323',
            'direccion' => 'Avenida Principal 789'
        ]);
        
        // Cliente frecuente
        User::create([
            'name' => 'Cliente Frecuente',
            'email' => 'cliente@flores.com',
            'password' => Hash::make('cliente123'),
            'role' => 'cliente',
            'cliente_tipo' => 'frecuente',
            'telefono' => '555123456',
            'direccion' => 'Calle Cliente 123'
        ]);
        
        // Productos
        $productos = [
            ['nombre' => 'Ramo de Rosas Rojas', 'descripcion' => 'Hermoso ramo de 12 rosas rojas', 'precio' => 35.00, 'stock' => 20],
            ['nombre' => 'Arreglo Orquídeas', 'descripcion' => 'Elegante arreglo con orquídeas moradas', 'precio' => 55.00, 'stock' => 10],
            ['nombre' => 'Centro de Mesa', 'descripcion' => 'Centro de mesa para eventos especiales', 'precio' => 45.00, 'stock' => 15],
            ['nombre' => 'Ramo Novia', 'descripcion' => 'Ramo de novia personalizado', 'precio' => 85.00, 'stock' => 5],
            ['nombre' => 'Caja Sorpresa', 'descripcion' => 'Caja con flores variadas', 'precio' => 40.00, 'stock' => 8],
            ['nombre' => 'Arreglo Girasoles', 'descripcion' => 'Alegre arreglo con girasoles', 'precio' => 30.00, 'stock' => 12],
        ];
        
        foreach ($productos as $producto) {
            $prod = Producto::create($producto);
            $prod->actualizarEstado();
        }
        
        // Cursos
        Curso::create([
            'titulo' => 'Curso Básico de Arreglos Florales',
            'descripcion' => 'Aprende las técnicas básicas para crear hermosos arreglos',
            'fecha_inicio' => now()->addDays(7),
            'fecha_fin' => now()->addDays(35),
            'capacidad_maxima' => 15,
            'precio' => 120.00
        ]);
        
        Curso::create([
            'titulo' => 'Curso Avanzado de Floristería',
            'descripcion' => 'Técnicas profesionales para eventos y bodas',
            'fecha_inicio' => now()->addDays(14),
            'fecha_fin' => now()->addDays(42),
            'capacidad_maxima' => 10,
            'precio' => 200.00
        ]);
        
        // Promociones
        Promocione::create([
            'titulo' => 'San Valentín',
            'descripcion' => '10% de descuento en ramos de rosas',
            'descuento' => 10,
            'fecha_inicio' => now(),
            'fecha_fin' => now()->addDays(30),
            'activo' => true
        ]);
        
        Promocione::create([
            'titulo' => 'Día de la Madre',
            'descripcion' => '15% de descuento en arreglos especiales',
            'descuento' => 15,
            'fecha_inicio' => now()->addDays(15),
            'fecha_fin' => now()->addDays(45),
            'activo' => true
        ]);
    }
}