@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-circle"></i> Mi Perfil
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('cliente.perfil.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label>Nombre Completo</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" class="form-control" value="{{ auth()->user()->telefono }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label>Dirección</label>
                            <input type="text" name="direccion" class="form-control" value="{{ auth()->user()->direccion }}" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save"></i> Actualizar Perfil
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection