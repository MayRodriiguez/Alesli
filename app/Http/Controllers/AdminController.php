<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Personal;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // ==========================================
    // GESTIÓN DE INVENTARIO
    // ==========================================

    public function inventario()
    {
        $productos = Producto::orderBy('created_at', 'desc')->get();
        return view('admin.inventario', compact('productos'));
    }

    public function storeProducto(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('uploads/productos'), $nombreImagen);
            $producto->imagen = 'uploads/productos/' . $nombreImagen;
        }
        
        $producto->actualizarEstado();
        $producto->save();
        
        return redirect()->route('admin.inventario')->with('success', 'Producto agregado correctamente');
    }

    public function editProducto($id)
    {
        $producto = Producto::findOrFail($id);
        return response()->json($producto);
    }

    public function updateProducto(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        
        if ($request->hasFile('imagen')) {
            if ($producto->imagen && file_exists(public_path($producto->imagen))) {
                unlink(public_path($producto->imagen));
            }
            
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('uploads/productos'), $nombreImagen);
            $producto->imagen = 'uploads/productos/' . $nombreImagen;
        }
        
        $producto->actualizarEstado();
        $producto->save();
        
        return redirect()->route('admin.inventario')->with('success', 'Producto actualizado correctamente');
    }

    public function toggleEstado($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->activo = !$producto->activo;
        $producto->save();
        
        $mensaje = $producto->activo ? 'activado' : 'desactivado';
        return redirect()->route('admin.inventario')->with('success', "Producto {$mensaje} correctamente");
    }

    public function destroyProducto($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            
            if ($producto->imagen && file_exists(public_path($producto->imagen))) {
                unlink(public_path($producto->imagen));
            }
            
            $producto->delete();
            
            return redirect()->route('admin.inventario')->with('success', 'Producto eliminado correctamente');
        } catch (\Exception $e) {
            return redirect()->route('admin.inventario')->with('error', 'Error al eliminar el producto: ' . $e->getMessage());
        }
    }

    public function productosStats()
    {
        $productos = Producto::all();
        return response()->json([
            'total' => $productos->count(),
            'activos' => $productos->where('activo', true)->count(),
            'stock_bajo' => $productos->where('stock', '>', 0)->where('stock', '<=', 5)->count(),
            'valor_total' => $productos->sum(function($p) { return $p->precio * $p->stock; })
        ]);
    }

    // ==========================================
    // GESTIÓN DE PERSONAL (CON HORARIO)
    // ==========================================

    public function personal()
    {
        $personal = \App\Models\Personal::orderBy('created_at', 'desc')->get();
        return view('admin.personal', compact('personal'));
    }

    public function storePersonal(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:personal',
            'telefono' => 'required|string|max:15',
            'cargo' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0',
            'fecha_contratacion' => 'required|date|after_or_equal:today',
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salida' => 'required|date_format:H:i|after:hora_entrada',
            'descripcion' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $personal = new \App\Models\Personal();
        $personal->nombre = $request->nombre;
        $personal->apellido = $request->apellido;
        $personal->email = $request->email;
        $personal->telefono = $request->telefono;
        $personal->cargo = $request->cargo;
        $personal->salario = $request->salario;
        $personal->fecha_contratacion = $request->fecha_contratacion;
        $personal->hora_entrada = $request->hora_entrada;
        $personal->hora_salida = $request->hora_salida;
        $personal->descripcion = $request->descripcion;
        
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nombreFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads/personal'), $nombreFoto);
            $personal->foto = 'uploads/personal/' . $nombreFoto;
        }
        
        $personal->save();
        
        return redirect()->route('admin.personal')->with('success', 'Personal agregado correctamente');
    }

    public function editPersonal($id)
    {
        $personal = \App\Models\Personal::findOrFail($id);
        return response()->json($personal);
    }

    public function updatePersonal(Request $request, $id)
    {
        $personal = \App\Models\Personal::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:personal,email,' . $id,
            'telefono' => 'required|string|max:15',
            'cargo' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0',
            'fecha_contratacion' => 'required|date|after_or_equal:today',
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salida' => 'required|date_format:H:i|after:hora_entrada',
            'descripcion' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $personal->nombre = $request->nombre;
        $personal->apellido = $request->apellido;
        $personal->email = $request->email;
        $personal->telefono = $request->telefono;
        $personal->cargo = $request->cargo;
        $personal->salario = $request->salario;
        $personal->fecha_contratacion = $request->fecha_contratacion;
        $personal->hora_entrada = $request->hora_entrada;
        $personal->hora_salida = $request->hora_salida;
        $personal->descripcion = $request->descripcion;
        
        if ($request->hasFile('foto')) {
            if ($personal->foto && file_exists(public_path($personal->foto))) {
                unlink(public_path($personal->foto));
            }
            $foto = $request->file('foto');
            $nombreFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads/personal'), $nombreFoto);
            $personal->foto = 'uploads/personal/' . $nombreFoto;
        }
        
        $personal->save();
        
        return redirect()->route('admin.personal')->with('success', 'Personal actualizado correctamente');
    }

    public function togglePersonalEstado($id)
    {
        $personal = \App\Models\Personal::findOrFail($id);
        $personal->estado = $personal->estado == 'activo' ? 'inactivo' : 'activo';
        $personal->save();
        
        $mensaje = $personal->estado == 'activo' ? 'activado' : 'desactivado';
        return redirect()->route('admin.personal')->with('success', "Personal {$mensaje} correctamente");
    }

    public function destroyPersonal($id)
    {
        $personal = \App\Models\Personal::findOrFail($id);
        
        if ($personal->foto && file_exists(public_path($personal->foto))) {
            unlink(public_path($personal->foto));
        }
        
        $personal->delete();
        
        return redirect()->route('admin.personal')->with('success', 'Personal eliminado correctamente');
    }

    // ==========================================
    // OTRAS SECCIONES
    // ==========================================

    // ==========================================
// GESTIÓN DE ASISTENCIA
// ==========================================

public function asistencia()
{
    $personal = \App\Models\Personal::where('estado', 'activo')->get();
    $asistenciaHoy = \App\Models\Asistencia::whereDate('fecha', today())->get()->keyBy('personal_id');
    $registros = \App\Models\Asistencia::with('personal')
        ->orderBy('fecha', 'desc')
        ->orderBy('id', 'desc')
        ->paginate(50);
    
    return view('admin.asistencia', compact('personal', 'asistenciaHoy', 'registros'));
}
    public function getClientesData()
{
    $clientes = \App\Models\User::where('role', 'cliente')
        ->withCount('pedidos')
        ->get();
    return response()->json($clientes);
}


    public function finanzas()
    {
        return view('admin.finanzas');
    }

    public function clientes()
    {
        return view('admin.clientes');
    }

    // ==========================================
// GESTIÓN DE PROMOCIONES
// ==========================================

public function promociones()
{
    $promociones = \App\Models\Promocione::orderBy('created_at', 'desc')->get();
    return view('admin.promociones', compact('promociones'));
}

public function storePromocion(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'descuento' => 'required|numeric|min:0|max:100',
        'fecha_inicio' => 'required|date|after_or_equal:today',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'codigo' => 'nullable|string|max:50',
        'tipo' => 'required|string',
        'monto_minimo' => 'nullable|numeric|min:0'
    ]);

    $promocion = new \App\Models\Promocione();
    $promocion->titulo = $request->titulo;
    $promocion->descripcion = $request->descripcion;
    $promocion->descuento = $request->descuento;
    $promocion->fecha_inicio = $request->fecha_inicio;
    $promocion->fecha_fin = $request->fecha_fin;
    $promocion->codigo = $request->codigo;
    $promocion->tipo = $request->tipo;
    $promocion->monto_minimo = $request->monto_minimo ?? 0;
    $promocion->activo = true;
    $promocion->save();

    return redirect()->route('admin.promociones')->with('success', 'Promoción creada correctamente');
}

public function editPromocion($id)
{
    $promocion = \App\Models\Promocione::findOrFail($id);
    return response()->json($promocion);
}

public function updatePromocion(Request $request, $id)
{
    $promocion = \App\Models\Promocione::findOrFail($id);
    
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'descuento' => 'required|numeric|min:0|max:100',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'codigo' => 'nullable|string|max:50|unique:promociones,codigo,' . $id,
        'tipo' => 'required|in:porcentaje,fijo,envio_gratis',
        'monto_minimo' => 'nullable|numeric|min:0'
    ]);

    $promocion->update($request->all());

    return redirect()->route('admin.promociones')->with('success', 'Promoción actualizada correctamente');
}

public function togglePromocionEstado($id)
{
    $promocion = \App\Models\Promocione::findOrFail($id);
    $promocion->activo = !$promocion->activo;
    $promocion->save();
    
    $estado = $promocion->activo ? 'activada' : 'desactivada';
    return redirect()->route('admin.promociones')->with('success', "Promoción {$estado} correctamente");
}

public function destroyPromocion($id)
{
    $promocion = \App\Models\Promocione::findOrFail($id);
    $promocion->delete();
    
    return redirect()->route('admin.promociones')->with('success', 'Promoción eliminada correctamente');
}
    // ==========================================
// GESTIÓN DE CURSOS
// ==========================================

public function cursos()
{
    $cursos = \App\Models\Curso::orderBy('created_at', 'desc')->get();
    return view('admin.cursos', compact('cursos'));
}

public function storeCurso(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'contenido' => 'nullable|string',
        'precio' => 'required|numeric|min:0',
        'duracion_horas' => 'required|integer|min:1',
        'fecha_inicio' => 'required|date|after_or_equal:today',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'capacidad_maxima' => 'required|integer|min:1',
        'instructor' => 'required|string|max:255',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $curso = new \App\Models\Curso();
    $curso->titulo = $request->titulo;
    $curso->descripcion = $request->descripcion;
    $curso->contenido = $request->contenido;
    $curso->precio = $request->precio;
    $curso->duracion_horas = $request->duracion_horas;
    $curso->fecha_inicio = $request->fecha_inicio;
    $curso->fecha_fin = $request->fecha_fin;
    $curso->capacidad_maxima = $request->capacidad_maxima;
    $curso->instructor = $request->instructor;
    
    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen');
        $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
        $imagen->move(public_path('uploads/cursos'), $nombreImagen);
        $curso->imagen = 'uploads/cursos/' . $nombreImagen;
    }
    
    $curso->save();

    return redirect()->route('admin.cursos')->with('success', 'Curso creado correctamente');
}

public function editCurso($id)
{
    $curso = \App\Models\Curso::findOrFail($id);
    return response()->json($curso);
}

public function updateCurso(Request $request, $id)
{
    $curso = \App\Models\Curso::findOrFail($id);
    
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'contenido' => 'nullable|string',
        'precio' => 'required|numeric|min:0',
        'duracion_horas' => 'required|integer|min:1',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'capacidad_maxima' => 'required|integer|min:1',
        'instructor' => 'required|string|max:255',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    $curso->titulo = $request->titulo;
    $curso->descripcion = $request->descripcion;
    $curso->contenido = $request->contenido;
    $curso->precio = $request->precio;
    $curso->duracion_horas = $request->duracion_horas;
    $curso->fecha_inicio = $request->fecha_inicio;
    $curso->fecha_fin = $request->fecha_fin;
    $curso->capacidad_maxima = $request->capacidad_maxima;
    $curso->instructor = $request->instructor;
    
    if ($request->hasFile('imagen')) {
        if ($curso->imagen && file_exists(public_path($curso->imagen))) {
            unlink(public_path($curso->imagen));
        }
        $imagen = $request->file('imagen');
        $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
        $imagen->move(public_path('uploads/cursos'), $nombreImagen);
        $curso->imagen = 'uploads/cursos/' . $nombreImagen;
    }
    
    $curso->save();

    return redirect()->route('admin.cursos')->with('success', 'Curso actualizado correctamente');
}

public function toggleCursoEstado($id)
{
    $curso = \App\Models\Curso::findOrFail($id);
    $curso->estado = $curso->estado == 'activo' ? 'inactivo' : 'activo';
    $curso->save();
    
    $estado = $curso->estado == 'activo' ? 'activado' : 'desactivado';
    return redirect()->route('admin.cursos')->with('success', "Curso {$estado} correctamente");
}

public function destroyCurso($id)
{
    $curso = \App\Models\Curso::findOrFail($id);
    
    if ($curso->imagen && file_exists(public_path($curso->imagen))) {
        unlink(public_path($curso->imagen));
    }
    
    $curso->delete();
    
    return redirect()->route('admin.cursos')->with('success', 'Curso eliminado correctamente');
}
    public function eventos()
    {
        return view('admin.eventos');
    }
}