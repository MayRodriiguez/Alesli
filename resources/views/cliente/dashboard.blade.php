@extends('layouts.app')

@section('content')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #c2185b, #6a1b9a);
        border-radius: 30px;
        padding: 40px;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 40px;
    }
    
    .welcome-card::before {
        content: '🌸';
        position: absolute;
        font-size: 150px;
        opacity: 0.1;
        bottom: -30px;
        right: -30px;
        transform: rotate(-15deg);
    }
    
    .welcome-card h1 {
        font-family: 'Dancing Script', cursive;
        font-size: 2.5rem;
        font-weight: 700;
    }
    
    .stat-card {
        background: white;
        border-radius: 25px;
        padding: 25px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #c2185b, #6a1b9a);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover::before {
        transform: scaleX(1);
    }
    
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.12);
    }
    
    .stat-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #fce4ec, #f3e5f5);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover .stat-icon {
        transform: scale(1.05) rotate(5deg);
    }
    
    .stat-icon i {
        font-size: 2rem;
        color: #c2185b;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #2d2d2d;
        margin: 10px 0;
    }
    
    .menu-card {
        background: white;
        border-radius: 25px;
        padding: 30px 20px;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        text-decoration: none;
        display: block;
        height: 100%;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
    }
    
    .menu-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 0;
        background: linear-gradient(135deg, #c2185b, #6a1b9a);
        transition: height 0.3s ease;
        z-index: 0;
    }
    
    .menu-card:hover::after {
        height: 100%;
    }
    
    .menu-card * {
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }
    
    .menu-card i {
        font-size: 2.5rem;
        margin-bottom: 15px;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .menu-card h5 {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .menu-card small {
        font-size: 0.8rem;
        opacity: 0.8;
    }
    
    .menu-card:hover i,
    .menu-card:hover h5,
    .menu-card:hover small {
        color: white !important;
    }
    
    .menu-card:hover i {
        transform: scale(1.1);
    }
    
    .product-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        height: 100%;
    }
    
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .product-img {
        height: 200px;
        overflow: hidden;
        position: relative;
    }
    
    .product-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .product-card:hover .product-img img {
        transform: scale(1.1);
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
    
    .stat-card, .menu-card, .product-card {
        animation: fadeInUp 0.6s ease forwards;
    }
</style>

<div class="container">
    <!-- Tarjeta de Bienvenida -->
    <div class="welcome-card" data-aos="fade-down">
        <div class="row align-items-center">
            <div class="col-md-8">
                <i class="fas fa-flower fa-2x mb-3"></i>
                <h1>🌸 ¡Bienvenido, {{ auth()->user()->name }}!</h1>
                <p class="lead mb-0">Disfruta de nuestros arreglos florales exclusivos y encuentra el regalo perfecto para cada ocasión.</p>
            </div>
            <div class="col-md-4 text-center">
                <img src="https://via.placeholder.com/150x150/fce4ec/c2185b?text=🌸" alt="Flor" style="border-radius: 50%; width: 120px; height: 120px; object-fit: cover; border: 3px solid white;">
            </div>
        </div>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="row mb-5">
        <div class="col-md-3 col-6 mb-3" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="stat-number">{{ $pedidosCount ?? 0 }}</div>
                <p class="text-muted mb-0">Pedidos Realizados</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stat-number">{{ $cursosCount ?? 0 }}</div>
                <p class="text-muted mb-0">Cursos Inscritos</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-number">{{ $favoritosCount ?? 0 }}</div>
                <p class="text-muted mb-0">Productos Favoritos</p>
            </div>
        </div>
        <div class="col-md-3 col-6 mb-3" data-aos="fade-up" data-aos-delay="400">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-tag"></i>
                </div>
                <div class="stat-number">{{ $promocionesCount ?? 0 }}</div>
                <p class="text-muted mb-0">Promociones Activas</p>
            </div>
        </div>
    </div>

    <!-- Menú Rápido -->
    <div class="section-title">
        <h2><i class="fas fa-compass"></i> Accesos Rápidos</h2>
        <p class="text-muted">Explora nuestras secciones</p>
    </div>

    <div class="row mb-5">
        <div class="col-lg-3 col-md-6 mb-3" data-aos="zoom-in" data-aos-delay="100">
            <a href="{{ route('cliente.catalogo') }}" class="menu-card" style="color: #2d2d2d;">
                <i class="fas fa-store" style="color: #ff1493;"></i>
                <h5>Catálogo</h5>
                <small>Ver todos los productos</small>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-3" data-aos="zoom-in" data-aos-delay="200">
            <a href="{{ route('cliente.carrito') }}" class="menu-card" style="color: #2d2d2d;">
                <i class="fas fa-shopping-cart" style="color: #ff1493;"></i>
                <h5>Mi Carrito</h5>
                <small>Ver mis productos</small>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-3" data-aos="zoom-in" data-aos-delay="300">
            <a href="{{ route('cliente.cursos') }}" class="menu-card" style="color: #2d2d2d;">
                <i class="fas fa-graduation-cap" style="color: #ff1493;"></i>
                <h5>Cursos</h5>
                <small>Inscríbete a cursos</small>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 mb-3" data-aos="zoom-in" data-aos-delay="400">
            <a href="{{ route('perfil') }}" class="menu-card" style="color: #2d2d2d;">
                <i class="fas fa-user-circle" style="color: #ff1493;"></i>
                <h5>Mi Perfil</h5>
                <small>Actualizar datos</small>
            </a>
        </div>
    </div>

    <!-- Productos Destacados -->
    <div class="section-title">
        <h2><i class="fas fa-star"></i> Productos Destacados</h2>
        <p class="text-muted">Los más vendidos de esta semana</p>
    </div>

    <div class="row">
        @forelse($productosDestacados ?? [] as $producto)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="product-card">
                <div class="product-img">
                    @if($producto->imagen)
                        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->nombre }}">
                    @else
                        <img src="https://via.placeholder.com/300x200/fce4ec/c2185b?text=Flores" alt="Flor">
                    @endif
                </div>
                <div class="p-3">
                    <h5 class="mb-1">{{ $producto->nombre }}</h5>
                    <p class="text-muted small">{{ Str::limit($producto->descripcion, 60) ?: 'Hermoso arreglo floral' }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <span class="h5 mb-0" style="color: #c2185b;">Bs. {{ number_format($producto->precio, 2) }}</span>
                        <a href="{{ route('cliente.catalogo') }}" class="btn btn-sm" style="background: linear-gradient(135deg, #c2185b, #6a1b9a); color: white; border-radius: 20px;">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
            <p>Próximamente más productos...</p>
        </div>
        @endforelse
    </div>

    <!-- Banner de Promoción -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #c2185b, #ff1493);">
                <div class="card-body text-center text-white py-5">
                    <i class="fas fa-gift fa-3x mb-3"></i>
                    <h2 class="mb-3">¡Ofertas Especiales!</h2>
                    <p class="mb-3">Lleva 2 arreglos y recibe un 20% de descuento en tu próxima compra</p>
                    <a href="{{ route('cliente.catalogo') }}" class="btn btn-light rounded-pill px-4">
                        <i class="fas fa-shopping-bag"></i> Comprar Ahora
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection