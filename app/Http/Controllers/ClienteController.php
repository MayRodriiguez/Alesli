<?php
// app/Http/Controllers/ClienteController.php
namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pedido;
use App\Models\PedidoDetalle;
use App\Models\Curso;
use App\Models\Inscripcion;
use App\Models\Transaccione;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;



class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'cliente') {
                abort(403, 'No autorizado');
            }
            return $next($request);
        });
    }

    public function dashboard()
{
    try {
        $pedidosCount = \App\Models\Pedido::where('user_id', auth()->id())->count();
    } catch (\Exception $e) {
        $pedidosCount = 0;
    }
    
    try {
        $cursosCount = \App\Models\Inscripcion::where('user_id', auth()->id())->count();
    } catch (\Exception $e) {
        $cursosCount = 0;
    }
    
    try {
        $productosDestacados = \App\Models\Producto::where('activo', true)
            ->where('visible_cliente', true)
            ->limit(4)
            ->get();
    } catch (\Exception $e) {
        $productosDestacados = collect();
    }
    
    $favoritosCount = 0;
    $promocionesCount = \App\Models\Promocione::where('activo', true)->count() ?? 0;
    
    return view('cliente.dashboard', compact('pedidosCount', 'cursosCount', 'favoritosCount', 'promocionesCount', 'productosDestacados'));
}
    public function catalogo()
    {
        $productos = Producto::where('visible_cliente', true)
            ->where('estado', '!=', 'agotado')
            ->paginate(12);
        
        return view('cliente.catalogo', compact('productos'));
    }

    public function carrito()
    {
        $carrito = session()->get('carrito', []);
        $total = 0;
        
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        
        return view('cliente.carrito', compact('carrito', 'total'));
    }

    public function addToCart(Request $request)
    {
        $producto = Producto::findOrFail($request->producto_id);
        
        $carrito = session()->get('carrito', []);
        
        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad']++;
        } else {
            $carrito[$producto->id] = [
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'cantidad' => 1,
                'imagen' => $producto->imagen
            ];
        }
        
        session()->put('carrito', $carrito);
        
        return response()->json(['success' => true, 'message' => 'Producto agregado al carrito']);
    }

    public function removeFromCart(Request $request)
    {
        $carrito = session()->get('carrito', []);
        
        if (isset($carrito[$request->producto_id])) {
            unset($carrito[$request->producto_id]);
            session()->put('carrito', $carrito);
        }
        
        return response()->json(['success' => true]);
    }

    public function checkout()
    {
        $carrito = session()->get('carrito', []);
        
        if (empty($carrito)) {
            return redirect()->route('cliente.catalogo')->with('error', 'Carrito vacío');
        }
        
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        
        $user = Auth::user();
        
        return view('cliente.checkout', compact('carrito', 'total', 'user'));
    }

    public function procesarPedido(Request $request)
    {
        $request->validate([
            'direccion_entrega' => 'required|string|max:255',
            'hora_entrega' => 'required|date',
            'tarjeta_personalizada' => 'required|string|max:500',
            'metodo_pago' => 'required|in:efectivo,qr,tarjeta'
        ]);
        
        $carrito = session()->get('carrito', []);
        
        if (empty($carrito)) {
            return redirect()->route('cliente.catalogo')->with('error', 'Carrito vacío');
        }
        
        DB::beginTransaction();
        
        try {
            $total = 0;
            foreach ($carrito as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }
            
            $pedido = Pedido::create([
                'user_id' => Auth::id(),
                'direccion_entrega' => $request->direccion_entrega,
                'hora_entrega' => $request->hora_entrega,
                'tarjeta_personalizada' => $request->tarjeta_personalizada,
                'metodo_pago' => $request->metodo_pago,
                'total' => $total,
                'estado' => 'pendiente'
            ]);
            
            foreach ($carrito as $producto_id => $item) {
                $producto = Producto::find($producto_id);
                
                PedidoDetalle::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $producto_id,
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                    'subtotal' => $item['precio'] * $item['cantidad']
                ]);
                
                $producto->stock -= $item['cantidad'];
                $producto->actualizarEstado();
                $producto->save();
            }
            
            Transaccione::create([
                'tipo' => 'ingreso',
                'monto' => $total,
                'concepto' => "Pedido #{$pedido->id}",
                'pedido_id' => $pedido->id,
                'fecha_transaccion' => now()
            ]);
            
            session()->forget('carrito');
            
            DB::commit();
            
            return redirect()->route('cliente.mis-pedidos')->with('success', 'Pedido realizado con éxito');
            
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al procesar el pedido');
        }
    }

    public function misPedidos()
    {
        $pedidos = Pedido::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('cliente.mis-pedidos', compact('pedidos'));
    }
    public function cursos()
{
    // Obtener cursos disponibles
    try {
        if (Schema::hasColumn('cursos', 'estado')) {
            $cursos = Curso::where('estado', 'activo')
                ->orderBy('fecha_inicio', 'asc')
                ->get();
        } else {
            $cursos = Curso::orderBy('fecha_inicio', 'asc')->get();
        }
    } catch (\Exception $e) {
        $cursos = collect();
    }
    
    // Obtener cursos del usuario
    try {
        $misCursos = Inscripcion::where('user_id', auth()->id())
            ->with('curso')
            ->get();
    } catch (\Exception $e) {
        $misCursos = collect();
    }
    
    return view('cliente.cursos', compact('cursos', 'misCursos'));
}

    public function inscribirCurso(Curso $curso)
    {
        $existe = Inscripcion::where('user_id', Auth::id())
            ->where('curso_id', $curso->id)
            ->exists();
        
        if ($existe) {
            return back()->with('error', 'Ya estás inscrito en este curso');
        }
        
        $inscritos = Inscripcion::where('curso_id', $curso->id)->count();
        
        if ($inscritos >= $curso->capacidad_maxima) {
            return back()->with('error', 'El curso está lleno');
        }
        
        Inscripcion::create([
            'user_id' => Auth::id(),
            'curso_id' => $curso->id,
            'fecha_inscripcion' => now(),
            'estado' => 'inscrito'
        ]);
        
        return back()->with('success', 'Inscripción exitosa');
    }

    public function perfil()
    {
        $user = Auth::user();
        return view('cliente.perfil', compact('user'));
    }

    public function updatePerfil(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'direccion' => 'required|string|max:255'
        ]);
        
        $user = Auth::user();
        User::where('id', $user->id)->update($request->only(['name', 'telefono', 'direccion']));
        return back()->with('success', 'Perfil actualizado');
    }

    public function chatbot()
    {
        return view('cliente.chatbot');
    }

    public function chatbotMessage(Request $request)
    {
        $message = strtolower($request->message);
        
        $respuestas = [
            'horario' => 'Nuestro horario de atención es de Lunes a Sábado de 9:00 a 20:00 horas.',
            'envío' => 'Realizamos envíos a toda la ciudad. El costo varía según la zona.',
            'pago' => 'Aceptamos pagos en efectivo, transferencia y tarjetas de crédito/débito.',
            'devolución' => 'Las devoluciones se aceptan dentro de las 24 horas posteriores a la entrega.',
            'personalizado' => 'Sí, hacemos arreglos personalizados según tus necesidades.',
            'curso' => 'Los cursos se dictan los sábados. Inscríbete en nuestra sección de cursos.',
            'garantía' => 'Todos nuestros productos tienen garantía de frescura por 3 días.',
            'mayorista' => 'Ofrecemos precios especiales para pedidos al por mayor. Contáctanos.',
            'default' => 'Gracias por tu mensaje. Un asesor te responderá pronto. Puedes contactarnos al WhatsApp: 123-456-7890'
        ];
        
        $respuesta = $respuestas['default'];
        
        foreach ($respuestas as $key => $value) {
            if (strpos($message, $key) !== false) {
                $respuesta = $value;
                break;
            }
        }
        
        return response()->json(['respuesta' => $respuesta]);
    }
}