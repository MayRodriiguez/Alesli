<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Obtener el carrito de la sesión.
     */
    private function getCart(): array
    {
        return session('carrito', []);
    }

    /**
     * Guardar el carrito en la sesión.
     */
    private function saveCart(array $cart): void
    {
        session(['carrito' => $cart]);
    }

    /**
     * Añadir un producto al carrito.
     */
    public function add(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($producto->estado === 'agotado' || $producto->stock < $request->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible.');
        }

        $cart = $this->getCart();
        $id   = $request->producto_id;

        if (isset($cart[$id])) {
            $nuevaCantidad = $cart[$id]['cantidad'] + $request->cantidad;

            if ($nuevaCantidad > $producto->stock) {
                return back()->with('error', 'No hay suficiente stock para esa cantidad.');
            }

            $cart[$id]['cantidad'] = $nuevaCantidad;
            $cart[$id]['subtotal'] = $nuevaCantidad * $producto->precio;
        } else {
            $cart[$id] = [
                'producto_id' => $producto->id,
                'nombre'      => $producto->nombre,
                'precio'      => $producto->precio,
                'imagen'      => $producto->imagen,
                'cantidad'    => $request->cantidad,
                'subtotal'    => $request->cantidad * $producto->precio,
            ];
        }

        $this->saveCart($cart);

        return back()->with('success', '¡Producto añadido al carrito!');
    }

    /**
     * Actualizar cantidad de un ítem del carrito.
     */
    public function update(Request $request, $productoId)
    {
        $request->validate(['cantidad' => 'required|integer|min:1']);

        $producto = Producto::findOrFail($productoId);
        $cart     = $this->getCart();

        if (isset($cart[$productoId])) {
            if ($request->cantidad > $producto->stock) {
                return back()->with('error', 'No hay suficiente stock.');
            }

            $cart[$productoId]['cantidad'] = $request->cantidad;
            $cart[$productoId]['subtotal'] = $request->cantidad * $producto->precio;
            $this->saveCart($cart);
        }

        return back()->with('success', 'Carrito actualizado.');
    }

    /**
     * Eliminar un ítem del carrito.
     */
    public function remove($productoId)
    {
        $cart = $this->getCart();
        unset($cart[$productoId]);
        $this->saveCart($cart);

        return back()->with('success', 'Producto eliminado del carrito.');
    }

    /**
     * Finalizar la compra y crear el pedido.
     */
    public function checkout(Request $request)
    {
        $cart = $this->getCart();

        if (empty($cart)) {
            return back()->with('error', 'Tu carrito está vacío.');
        }

        $request->validate([
            'direccion_entrega' => 'required|string|max:500',
            'notas'             => 'nullable|string|max:1000',
        ], [
            'direccion_entrega.required' => 'La dirección de entrega es obligatoria.',
        ]);

        $total = collect($cart)->sum('subtotal');

        $pedido = Pedido::create([
            'user_id'           => Auth::id(),
            'total'             => $total,
            'estado'            => 'pendiente',
            'direccion_entrega' => $request->direccion_entrega,
            'notas'             => $request->notas,
        ]);

        foreach ($cart as $item) {
            PedidoItem::create([
                'pedido_id'      => $pedido->id,
                'producto_id'    => $item['producto_id'],
                'cantidad'       => $item['cantidad'],
                'precio_unitario'=> $item['precio'],
                'subtotal'       => $item['subtotal'],
            ]);

            // Reducir stock
            $producto = Producto::find($item['producto_id']);
            if ($producto) {
                $producto->stock -= $item['cantidad'];
                $producto->actualizarEstado();
            }
        }

        // Vaciar carrito
        session()->forget('carrito');

        return redirect()->route('user.shop')->with('success', '¡Pedido realizado con éxito! Te contactaremos pronto.');
    }
}