{{-- resources/views/cliente/mis-pedidos.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4" style="color: #8b008b;">
                <i class="fas fa-box"></i> Mis Pedidos
            </h1>
        </div>
    </div>

    @if($pedidos->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> No tienes pedidos aún
            <br>
            <a href="{{ route('cliente.catalogo') }}" class="btn btn-primary mt-3">
                <i class="fas fa-store"></i> Comprar Ahora
            </a>
        </div>
    @else
        @foreach($pedidos as $pedido)
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <i class="fas fa-hashtag"></i> Pedido #{{ $pedido->id }}
                    </div>
                    <div class="col-md-3">
                        <i class="fas fa-calendar"></i> {{ $pedido->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div class="col-md-3">
                        <i class="fas fa-money-bill"></i> ${{ number_format($pedido->total, 2) }}
                    </div>
                    <div class="col-md-3">
                        @if($pedido->estado == 'pendiente')
                            <span class="badge bg-warning">⏳ Pendiente</span>
                        @elseif($pedido->estado == 'pagado')
                            <span class="badge bg-success">✅ Pagado</span>
                        @elseif($pedido->estado == 'entregado')
                            <span class="badge bg-info">🚚 Entregado</span>
                        @else
                            <span class="badge bg-danger">❌ Cancelado</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong><i class="fas fa-map-marker-alt"></i> Dirección:</strong>
                        <p>{{ $pedido->direccion_entrega }}</p>
                        
                        <strong><i class="fas fa-clock"></i> Hora de Entrega:</strong>
                        <p>{{ $pedido->hora_entrega->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <strong><i class="fas fa-heart"></i> Tarjeta Personalizada:</strong>
                        <p>"{{ $pedido->tarjeta_personalizada }}"</p>
                        
                        <strong><i class="fas fa-credit-card"></i> Método de Pago:</strong>
                        <p>{{ ucfirst($pedido->metodo_pago) }}</p>
                    </div>
                </div>
                
                <hr>
                <strong>Productos:</strong>
                <table class="table table-sm mt-2">
                    <thead>
                        <tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th></tr>
                    </thead>
                    <tbody>
                        @foreach($pedido->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                            <td>${{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection