{{-- resources/views/cliente/cursos.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-4" style="color: #8b008b;">
                <i class="fas fa-graduation-cap"></i> Cursos de Arreglos Florales
            </h1>
            <p class="text-center">Aprende a crear hermosos arreglos florales los días sábados</p>
        </div>
    </div>

    <!-- Cursos Disponibles -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="mb-4">📚 Cursos Disponibles</h2>
        </div>
        @foreach($cursos as $curso)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <i class="fas fa-flower fa-3x mb-3" style="color: #ff1493;"></i>
                    <h5 class="card-title">{{ $curso->titulo }}</h5>
                    <p class="card-text">{{ $curso->descripcion }}</p>
                    <p><strong>📅 Inicio:</strong> {{ $curso->fecha_inicio->format('d/m/Y') }}</p>
                    <p><strong>⏰ Fin:</strong> {{ $curso->fecha_fin->format('d/m/Y') }}</p>
                    <p><strong>🎓 Capacidad:</strong> {{ $curso->capacidad_maxima }} alumnos</p>
                    <p><strong>💰 Precio:</strong> ${{ number_format($curso->precio, 2) }}</p>
                    
                    <form action="{{ route('cliente.inscribir-curso', $curso->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-check-circle"></i> Inscribirme
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Mis Cursos -->
    @if($misCursos->count() > 0)
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">⭐ Mis Cursos</h2>
        </div>
        @foreach($misCursos as $inscripcion)
        <div class="col-md-4 mb-4">
            <div class="card bg-light">
                <div class="card-body">
                    <i class="fas fa-certificate fa-3x mb-3" style="color: #ffd700;"></i>
                    <h5 class="card-title">{{ $inscripcion->curso->titulo }}</h5>
                    <p>Estado: <span class="badge bg-success">{{ ucfirst($inscripcion->estado) }}</span></p>
                    <p>Inscrito: {{ $inscripcion->fecha_inscripcion->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection