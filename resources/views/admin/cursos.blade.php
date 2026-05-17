@extends('layouts.app')

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #c2185b, #6a1b9a);
        border-radius: 30px;
        padding: 40px;
        color: white;
        text-align: center;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }
    
    .page-header::before {
        content: '🎓';
        position: absolute;
        font-size: 150px;
        opacity: 0.1;
        bottom: -30px;
        right: -30px;
        transform: rotate(-15deg);
    }
    
    .page-header h1 {
        font-family: 'Dancing Script', cursive;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .curso-card {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        margin-bottom: 30px;
        height: 100%;
        position: relative;
    }
    
    .curso-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 45px rgba(0,0,0,0.15);
    }
    
    .curso-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #ff1493, #ff9800);
        color: white;
        padding: 5px 15px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 10;
    }
    
    .curso-img {
        height: 200px;
        overflow: hidden;
        position: relative;
    }
    
    .curso-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .curso-card:hover .curso-img img {
        transform: scale(1.1);
    }
    
    .curso-info {
        padding: 25px;
    }
    
    .curso-titulo {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2d2d2d;
        margin-bottom: 10px;
    }
    
    .curso-descripcion {
        color: #666;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 20px;
    }
    
    .curso-detalles {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 15px;
        margin-bottom: 20px;
    }
    
    .detalle-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        font-size: 0.85rem;
    }
    
    .detalle-item:last-child {
        margin-bottom: 0;
    }
    
    .detalle-item i {
        width: 25px;
        color: #c2185b;
    }
    
    .curso-precio {
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #c2185b, #6a1b9a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 15px;
    }
    
    .btn-inscribir {
        background: linear-gradient(135deg, #c2185b, #6a1b9a);
        border: none;
        border-radius: 30px;
        padding: 12px;
        color: white;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .btn-inscribir:hover {
        transform: scale(1.02);
        box-shadow: 0 8px 20px rgba(194,24,91,0.3);
    }
    
    .btn-inscribir:disabled {
        background: #ccc;
        cursor: not-allowed;
        transform: none;
    }
    
    .mis-cursos-section {
        margin-top: 60px;
    }
    
    .section-title {
        text-align: center;
        margin-bottom: 40px;
        position: relative;
    }
    
    .section-title h2 {
        font-family: 'Dancing Script', cursive;
        font-size: 2.5rem;
        background: linear-gradient(135deg, #c2185b, #6a1b9a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }
    
    .section-title::after {
        content: '🌸';
        font-size: 1.5rem;
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        opacity: 0.5;
    }
    
    .curso-inscrito-card {
        background: white;
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border-left: 4px solid #c2185b;
        transition: all 0.3s ease;
    }
    
    .curso-inscrito-card:hover {
        transform: translateX(5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .curso-card {
        animation: fadeInUp 0.6s ease forwards;
    }
</style>

<div class="container">
    <!-- Encabezado -->
    <div class="page-header" data-aos="fade-down">
        <i class="fas fa-graduation-cap fa-3x mb-3"></i>
        <h1>Cursos de Arreglos Florales</h1>
        <p class="lead mb-0">Aprende a crear hermosos arreglos florales los días sábados</p>
    </div>

    <!-- Cursos Disponibles -->
    <div class="section-title">
        <h2><i class="fas fa-book-open"></i> Cursos Disponibles</h2>
        <p class="text-muted">Inscríbete y aprende con los mejores</p>
    </div>

    <div class="row">
        @forelse($cursos as $curso)
        <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="curso-card">
                @if($curso->cuposDisponibles() <= 3 && $curso->cuposDisponibles() > 0)
                    <div class="curso-badge">⚠️ Últimos cupos</div>
                @elseif($curso->cuposDisponibles() == 0)
                    <div class="curso-badge" style="background: linear-gradient(135deg, #dc143c, #c62828);">❌ Completado</div>
                @endif
                
                <div class="curso-img">
                    @if($curso->imagen)
                        <img src="{{ asset($curso->imagen) }}" alt="{{ $curso->titulo }}">
                    @else
                        <img src="https://via.placeholder.com/600x300/fce4ec/c2185b?text=Alesli+Flores" alt="Curso">
                    @endif
                </div>
                
                <div class="curso-info">
                    <h3 class="curso-titulo">{{ $curso->titulo }}</h3>
                    <p class="curso-descripcion">{{ $curso->descripcion }}</p>
                    
                    <div class="curso-detalles">
                        <div class="detalle-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span><strong>Inicio:</strong> {{ \Carbon\Carbon::parse($curso->fecha_inicio)->format('d/m/Y') }}</span>
                        </div>
                        <div class="detalle-item">
                            <i class="fas fa-calendar-check"></i>
                            <span><strong>Fin:</strong> {{ \Carbon\Carbon::parse($curso->fecha_fin)->format('d/m/Y') }}</span>
                        </div>
                        <div class="detalle-item">
                            <i class="fas fa-users"></i>
                            <span><strong>Cupos:</strong> {{ $curso->inscritos }}/{{ $curso->capacidad_maxima }} disponibles</span>
                        </div>
                        <div class="detalle-item">
                            <i class="fas fa-clock"></i>
                            <span><strong>Duración:</strong> {{ $curso->duracion_horas }} horas</span>
                        </div>
                        <div class="detalle-item">
                            <i class="fas fa-chalkboard-user"></i>
                            <span><strong>Instructor:</strong> {{ $curso->instructor }}</span>
                        </div>
                    </div>
                    
                    <div class="curso-precio">Bs. {{ number_format($curso->precio, 2) }}</div>
                    
                    @php
                        $yaInscrito = $misCursos->contains('curso_id', $curso->id);
                    @endphp
                    
                    @if($yaInscrito)
                        <button class="btn-inscribir" disabled style="background: #28a745;">
                            <i class="fas fa-check-circle"></i> Ya estás inscrito
                        </button>
                    @elseif($curso->cuposDisponibles() <= 0)
                        <button class="btn-inscribir" disabled>
                            <i class="fas fa-ban"></i> Curso completo
                        </button>
                    @else
                        <form action="{{ route('cliente.inscribir-curso', $curso->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-inscribir">
                                <i class="fas fa-graduation-cap"></i> Inscribirme ahora
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
            <p>No hay cursos disponibles en este momento</p>
        </div>
        @endforelse
    </div>

    <!-- Mis Cursos -->
    @if($misCursos->count() > 0)
    <div class="mis-cursos-section">
        <div class="section-title">
            <h2><i class="fas fa-certificate"></i> Mis Cursos</h2>
            <p class="text-muted">Tu progreso en los cursos</p>
        </div>
        
        <div class="row">
            @foreach($misCursos as $inscripcion)
            <div class="col-md-6 mb-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="curso-inscrito-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">{{ $inscripcion->curso->titulo }}</h5>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-calendar-alt"></i> Inicio: {{ \Carbon\Carbon::parse($inscripcion->curso->fecha_inicio)->format('d/m/Y') }}
                            </p>
                        </div>
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle"></i> {{ ucfirst($inscripcion->estado) }}
                        </span>
                    </div>
                    <div class="mt-2">
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar" style="width: 30%; background: linear-gradient(135deg, #c2185b, #6a1b9a);"></div>
                        </div>
                        <small class="text-muted">Progreso: 30% completado</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection