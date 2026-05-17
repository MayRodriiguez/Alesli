{{-- resources/views/cliente/carrito.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4" style="color: #8b008b;">
                <i class="fas fa-shopping-cart"></i> Mi Carrito
            </h1>
        </div>
    </div>

    @if(empty($carrito))
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> Tu carrito está vacío
            <br>
            <a href="{{ route('cliente.catalogo') }}" class="btn btn-primary mt-3">
                <i class="fas fa-store"></i> Ver Catálogo
            </a>
        </div>
    @else
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-list"></i> Productos
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carrito as $id => $item)
                                <tr>
                                    <td>{{ $item['nombre'] }}</td>
                                    <td>${{ number_format($item['precio'], 2) }}</td>
                                    <td>{{ $item['cantidad'] }}</td>
                                    <td>${{ number_format($item['precio'] * $item['cantidad'], 2) }}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="removeFromCart({{ $id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td><strong>${{ number_format($total, 2) }}</strong></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-credit-card"></i> Resumen del Pedido
                    </div>
                    <div class="card-body">
                        <h4>Total: ${{ number_format($total, 2) }}</h4>
                        <a href="{{ route('cliente.checkout') }}" class="btn btn-primary w-100 mt-3">
                            <i class="fas fa-check"></i> Proceder al Pago
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
function removeFromCart(productoId) {
    fetch('{{ route("cliente.cart.remove") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ producto_id: productoId })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            location.reload();
        }
    });
}
</script>
@endsection