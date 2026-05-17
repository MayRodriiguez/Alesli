{{-- resources/views/cliente/checkout.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4" style="color: #8b008b;">
                <i class="fas fa-clipboard-list"></i> Finalizar Pedido
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user"></i> Datos de Entrega
                </div>
                <div class="card-body">
                    <form action="{{ route('cliente.procesar-pedido') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Nombre Completo</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label>Dirección de Entrega *</label>
                            <input type="text" name="direccion_entrega" class="form-control" value="{{ $user->direccion }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Hora de Entrega *</label>
                            <input type="datetime-local" name="hora_entrega" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Tarjeta Personalizada *</label>
                            <textarea name="tarjeta_personalizada" class="form-control" rows="3" required placeholder="Escribe el mensaje que llevará tu tarjeta..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Método de Pago *</label>
                            <select name="metodo_pago" class="form-control" required>
                                <option value="">Seleccione...</option>
                                <option value="efectivo">💵 Efectivo</option>
                                <option value="qr">📱 QR (Mercado Pago)</option>
                                <option value="tarjeta">💳 Tarjeta de Crédito/Débito</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-check-circle"></i> Confirmar Pedido
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-shopping-cart"></i> Resumen del Pedido
                </div>
                <div class="card-body">
                    @foreach($carrito as $item)
                    <div class="mb-2">
                        <strong>{{ $item['nombre'] }}</strong>
                        <span class="float-end">{{ $item['cantidad'] }} x ${{ number_format($item['precio'], 2) }}</span>
                    </div>
                    @endforeach
                    <hr>
                    <div class="mb-2">
                        <strong>Total:</strong>
                        <strong class="float-end">${{ number_format($total, 2) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection