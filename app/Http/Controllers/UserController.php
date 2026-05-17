<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function shop(Request $request)
    {
        $query = Producto::where('activo', true)
                         ->where('estado', '!=', 'agotado');

        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $productos = $query->orderBy('nombre')->get();
        $carrito   = session('carrito', []);
        $total     = collect($carrito)->sum('subtotal');

        return view('user.shop', compact('productos', 'carrito', 'total'));
    }
}