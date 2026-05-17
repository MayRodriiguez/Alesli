<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Alesli - Naturalmente para ti</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome biblioteca de iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- AOS Animation para añadir movimiento y animaciones -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Google Fonts fuentes de las letras  -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* Colores personalizados */
        :root {
            --rosa-claro: #ffd1dc;
            --rosa: #ff69b4;
            --rosa-intenso: #ff1493;
            --rojo: #dc143c;
            --morado: #9370db;
            --morado-oscuro: #8b008b;
            --blanco: #ffffff;
            --negro: #2d2d2d;
        }
                /* Service Cards Mejorados */
        .service-card {
            background: white;
            border-radius: 24px;
            padding: 30px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            height: 100%;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255,105,180,0.1);
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--rosa), var(--morado), var(--rosa-intenso));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 45px rgba(255,20,147,0.15);
        }

        .service-icon {
            position: relative;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--rosa-claro), var(--morado));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            transition: all 0.3s ease;
        }

        .service-icon i {
            font-size: 2.5rem;
            color: var(--rosa-intenso);
            transition: all 0.3s ease;
        }

        .service-card:hover .service-icon {
            transform: rotate(10deg) scale(1.05);
        }

        .service-card:hover .service-icon i {
            transform: scale(1.1);
        }

        .service-badge {
            position: absolute;
            top: -10px;
            right: -10px;
            background: linear-gradient(135deg, var(--rosa-intenso), var(--rojo));
            color: white;
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .service-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--morado-oscuro);
            font-weight: 600;
        }

        .service-desc {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .service-features {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .service-features li {
            padding: 8px 0;
            color: #555;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .service-features li i {
            color: var(--rosa-intenso);
            font-size: 0.9rem;
        }

        .service-price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        .price {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--rosa-intenso);
        }

        .btn-service {
            background: linear-gradient(135deg, var(--rosa), var(--morado));
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-service:hover {
            transform: translateX(5px);
            background: linear-gradient(135deg, var(--rosa-intenso), var(--morado-oscuro));
            color: white;
        }

        /* Sección de Beneficios */
        .benefits-section {
            background: linear-gradient(135deg, rgba(255,209,220,0.3), rgba(147,112,219,0.3));
            padding: 60px 0;
            border-radius: 40px;
            margin: 60px 0;
        }

        .benefit-item {
            text-align: center;
            padding: 20px;
        }

        .benefit-icon {
            width: 70px;
            height: 70px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .benefit-item:hover .benefit-icon {
            transform: scale(1.1);
            box-shadow: 0 10px 25px rgba(255,20,147,0.2);
        }

        .benefit-icon i {
            font-size: 2rem;
            color: var(--rosa-intenso);
        }

        .benefit-item h4 {
            font-size: 1.1rem;
            margin-bottom: 10px;
            color: var(--morado-oscuro);
        }

        .benefit-item p {
            color: #666;
            font-size: 0.85rem;
        }

        /* Horario de atención */
        .hours-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .hours-card i {
            font-size: 3rem;
            color: var(--rosa-intenso);
            margin-bottom: 15px;
        }

        .hours-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .hours-list li {
            padding: 8px 0;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px dashed #eee;
        }

        .hours-list li span:first-child {
            font-weight: 500;
            color: #333;
        }

        .hours-list li span:last-child {
            color: var(--rosa-intenso);
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .service-card {
                margin-bottom: 20px;
            }
            
            .benefit-item {
                margin-bottom: 30px;
            }
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--rosa-intenso), var(--morado-oscuro));
            padding: 1rem 2rem;
            transition: all 0.5s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .navbar-scrolled {
            padding: 0.5rem 2rem;
            background: linear-gradient(135deg, var(--rosa-intenso), var(--morado-oscuro));
        }

        .navbar-brand {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            font-weight: bold;
            color: white !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .navbar-brand i {
            margin-right: 10px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 10px;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 2px;
            background: white;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 80%;
        }

        /* Hero Section con Carrusel */
        .hero-carousel {
            height: 90vh;
            position: relative;
            overflow: hidden;
        }

        .carousel-slide {
            position: relative;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Slider 1 - Fondo gradiente animado */
        .slide-1 {
            background: linear-gradient(135deg, var(--rosa-claro), var(--morado));
            position: relative;
        }

        .slide-1::before {
            content: '🌷';
            position: absolute;
            font-size: 300px;
            opacity: 0.1;
            bottom: 0;
            right: 0;
            animation: float 6s ease-in-out infinite;
        }

        /* Slider 2 */
        .slide-2 {
            background: linear-gradient(135deg, var(--rosa), var(--rosa-intenso));
        }

        .slide-2::before {
            content: '🌹';
            position: absolute;
            font-size: 300px;
            opacity: 0.1;
            top: 0;
            left: 0;
            animation: float 6s ease-in-out infinite reverse;
        }

        /* Slider 3 */
        .slide-3 {
            background: linear-gradient(135deg, var(--morado), var(--morado-oscuro));
        }

        .slide-3::before {
            content: '💐';
            position: absolute;
            font-size: 300px;
            opacity: 0.1;
            bottom: 0;
            left: 0;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }

        .hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: white;
            z-index: 10;
            width: 100%;
            padding: 0 20px;
        }

        .hero-content h1 {
            font-family: 'Dancing Script', cursive;
            font-size: 5rem;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.3);
        }

        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 30px;
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-hero {
            background: white;
            color: var(--rosa-intenso);
            border: none;
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: bold;
            margin: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 1.1rem;
        }

        .btn-hero-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 12px 35px;
            border-radius: 50px;
            font-weight: bold;
            margin: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-hero:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .btn-hero-outline:hover {
            background: white;
            color: var(--rosa-intenso);
            transform: scale(1.05);
        }

        /* Indicadores del carrusel */
        .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin: 0 5px;
        }

        .carousel-control-prev, .carousel-control-next {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            margin: 0 20px;
        }

        /* Secciones */
        .section-title {
            text-align: center;
            margin-bottom: 60px;
            position: relative;
        }

        .section-title h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 3rem;
            color: var(--morado-oscuro);
            display: inline-block;
            background: linear-gradient(135deg, var(--rosa-intenso), var(--morado));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .section-title::after {
            content: '🌷';
            font-size: 2rem;
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0.5;
        }

        /* Feature Cards */
        .feature-card {
            background: rgb(243, 239, 239);
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.4s ease;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--rosa), var(--morado));
            transition: left 0.4s ease;
        }

        .feature-card:hover::before {
            left: 0;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .feature-card i {
            font-size: 3.5rem;
            background: linear-gradient(135deg, var(--rosa-intenso), var(--morado));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: var(--negro);
        }

        .feature-card p {
            color: #666;
            line-height: 1.6;
        }

        /* Contador de estadísticas */
        .counter-section {
            background: linear-gradient(135deg, var(--rosa-intenso), var(--morado-oscuro));
            padding: 80px 0;
            margin: 80px 0;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .counter-section::before {
            content: '🌷🌻🌺🌹';
            position: absolute;
            font-size: 100px;
            opacity: 0.1;
            bottom: -20px;
            right: -20px;
            white-space: nowrap;
        }

        .counter-item {
            text-align: center;
        }

        .counter-item h3 {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .counter-item p {
            font-size: 1.2rem;
            margin: 0;
        }

        /* Testimonios */
        .testimonial-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
        }

        .testimonial-card i {
            font-size: 3rem;
            color: var(--rosa);
            opacity: 0.5;
            margin-bottom: 20px;
        }

        .testimonial-card p {
            font-style: italic;
            color: #666;
            line-height: 1.6;
        }

        .testimonial-card h5 {
            color: var(--morado-oscuro);
            margin-top: 20px;
            margin-bottom: 5px;
        }

        .testimonial-card .stars {
            color: #ffc107;
            font-size: 0.9rem;
        }

        /* Newsletter */
        .newsletter-section {
            background: linear-gradient(135deg, var(--rosa-claro), var(--morado));
            padding: 60px 0;
            border-radius: 30px;
            margin: 60px 0;
        }

        .newsletter-section h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: var(--morado-oscuro);
        }

        .newsletter-input {
            border: none;
            border-radius: 50px;
            padding: 15px 25px;
            width: 70%;
            max-width: 400px;
            margin-right: 10px;
        }

        .newsletter-btn {
            background: linear-gradient(135deg, var(--rosa-intenso), var(--morado-oscuro));
            border: none;
            border-radius: 50px;
            padding: 15px 30px;
            color: white;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .newsletter-btn:hover {
            transform: scale(1.05);
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--morado-oscuro), var(--rosa-intenso));
            color: white;
            padding: 60px 0 30px;
            margin-top: 60px;
        }

        .footer h5 {
            font-family: 'Dancing Script', cursive;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .footer a {
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer a:hover {
            opacity: 0.8;
            padding-left: 5px;
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .social-icons a:hover {
            background: white;
            color: var(--rosa-intenso);
            transform: translateY(-3px);
        }

        /* Animaciones */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-up.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .hero-content p {
                font-size: 1rem;
            }
            
            .btn-hero, .btn-hero-outline {
                padding: 8px 20px;
                font-size: 0.9rem;
            }
            
            .counter-item h3 {
                font-size: 2rem;
            }
            
            .newsletter-input {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-flower"></i> Alesli
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#home">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#servicios">Servicios</a></li>
                <li class="nav-item"><a class="nav-link" href="#productos">Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="#testimonios">Comentarios</a></li>
                <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">
                        <i class="fas fa-user-circle"></i> Iniciar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Carrusel -->
<div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
    </div>
    
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="slide-1" style="height: 100vh;">
                <div class="hero-content">
                    <h1>Alesli- Naturalmente para ti</h1>
                    <p>Arreglos florales únicos para tus momentos especiales</p>
                    <p class="small">✨ Emprendimiento familiar desde 2020 ✨</p>
                    <div>
                        <a href="/login" class="btn-hero">
                            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                        </a>
                        <a href="/register" class="btn-hero-outline">
                            <i class="fas fa-user-plus"></i> Registrarse
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="slide-2" style="height: 100vh;">
                <div class="hero-content">
                    <h1>🌹 Cursos de Arreglos Florales</h1>
                    <p>Aprende con nuestros expertos</p>
                    <a href="/register" class="btn-hero-outline">
                        <i class="fas fa-graduation-cap"></i> Inscríbete Ahora
                    </a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="slide-3" style="height: 100vh;">
                <div class="hero-content">
                    <h1>💐 Envíos a Domicilio</h1>
                    <p>Llevamos tus flores a donde las necesites</p>
                    <a href="/register" class="btn-hero-outline">
                        <i class="fas fa-truck"></i> Ordena Ahora
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Servicios Mejorados -->
<section id="servicios" class="py-5">
    <div class="container">
        <div class="section-title">
            <h2>🌸 Nuestros Servicios </h2>
            <p class="text-muted">Ofrecemos experiencias únicas con la más alta calidad</p>
        </div>
        
        <!-- Tarjetas Principales -->
        <div class="row">
            <!-- Servicio 1 - Arreglos Florales -->
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-birthday-cake"></i>
                        <div class="service-badge">Popular</div>
                    </div>
                    <h3>Arreglos Florales</h3>
                    <p class="service-desc">Creamos decoraciones únicas para cada ocasión especial</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check-circle"></i> Ramos personalizados</li>
                        <li><i class="fas fa-check-circle"></i> Centros de mesa</li>
                        <li><i class="fas fa-check-circle"></i> Coronas fúnebres</li>
                        <li><i class="fas fa-check-circle"></i> Arreglos en caja</li>
                    </ul>
                    <div class="service-price">
                        <span class="price"></span>
                        <a href="/register" class="btn-service">Ver más <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Servicio 2 - Cursos -->
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-chalkboard-user"></i>
                        <div class="service-badge">Certificado</div>
                    </div>
                    <h3>Cursos de Floristería</h3>
                    <p class="service-desc">Aprende técnicas profesionales de arreglos florales</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check-circle"></i> Nivel básico y avanzado</li>
                        <li><i class="fas fa-check-circle"></i> Clases los sábados</li>
                        <li><i class="fas fa-check-circle"></i> Materiales incluidos</li>
                        <li><i class="fas fa-check-circle"></i> Certificado al finalizar</li>
                    </ul>
                    <div class="service-price">
                        <span class="price"></span>
                        <a href="/register" class="btn-service">Inscribirme <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Servicio 3 - Envíos -->
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-truck-fast"></i>
                        <div class="service-badge"></div>
                    </div>
                    <h3>Envíos a Domicilio</h3>
                    <p class="service-desc">Entregamos tus flores donde las necesites</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check-circle"></i> Entrega el mismo día</li>
                        <li><i class="fas fa-check-circle"></i> Seguimiento </li>
                        <li><i class="fas fa-check-circle"></i> Empaque especial</li>
                    </ul>
                    <div class="service-price">
                        <span class="price">Envío 15Bs.</span>
                        <a href="/register" class="btn-service">Cotizar <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Segunda fila de servicios -->
        <div class="row mt-4">
            <!-- Servicio 4 - Tarjetas -->
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-hand-holding-heart"></i>
                        <div class="service-badge">Gratis</div>
                    </div>
                    <h3>Tarjeta Personalizada</h3>
                    <p class="service-desc">Incluye un mensaje especial con cada pedido</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check-circle"></i> Diseños exclusivos</li>
                        <li><i class="fas fa-check-circle"></i> Mensaje personalizados</li>
                        <li><i class="fas fa-check-circle"></i> Opción de sobre</li>
                        <li><i class="fas fa-check-circle"></i> Envío digital opcional</li>
                    </ul>
                    <div class="service-price">
                        <span class="price">Sin costo</span>
                        <a href="/register" class="btn-service">Personalizar <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Servicio 5 - Pagos -->
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="500">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-qrcode"></i>
                        <div class="service-badge">Seguro</div>
                    </div>
                    <h3>Múltiples Pagos</h3>
                    <p class="service-desc">Elige el método de pago que prefieras</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check-circle"></i> Efectivo </li>
                        <li><i class="fas fa-check-circle"></i> Código QR </li>
                        <li><i class="fas fa-check-circle"></i> Tarjeta de crédito/débito</li>
                        <li><i class="fas fa-check-circle"></i> Transferencia bancaria</li>
                    </ul>
                    <div class="service-price">
                        <span class="price">Sin comisión</span>
                        <a href="/register" class="btn-service">Ver métodos <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Servicio 6 - Eventos -->
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="600">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-calendar-alt"></i>
                        <div class="service-badge">Servicios</div>
                    </div>
                    <h3>Eventos Especiales</h3>
                    <p class="service-desc">Hacemos de tu evento un momento inolvidable</p>
                    <ul class="service-features">
                        <li><i class="fas fa-check-circle"></i> Bodas y XV años</li>
                        <li><i class="fas fa-check-circle"></i> Eventos corporativos</li>
                        <li><i class="fas fa-check-circle"></i> Decoración </li>
                        <li><i class="fas fa-check-circle"></i> Asesoría personalizada</li>
                    </ul>
                    <div class="service-price">
                        <span class="price">Cotiza gratis</span>
                        <a href="/register" class="btn-service">Solicitar <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Beneficios -->
<section class="benefits-section">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-12">
                <h2 style="color: var(--morado-oscuro); font-family: 'Dancing Script', cursive; font-size: 2.5rem;">
                     ¿Por qué elegirnos? 
                </h2>
                <p>Más de 5 años creando momentos especiales</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="benefit-item" data-aos="zoom-in" data-aos-delay="100">
                    <div class="benefit-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h4>Flores Frescas</h4>
                    <p>Productos de la más alta calidad, seleccionados diariamente</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="benefit-item" data-aos="zoom-in" data-aos-delay="200">
                    <div class="benefit-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>Garantía de Satisfacción</h4>
                    <p>Si algo sucede con tu pedido, te reembolsamos tu dinero</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="benefit-item" data-aos="zoom-in" data-aos-delay="300">
                    <div class="benefit-icon">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h4>Diseños Exclusivos</h4>
                    <p>Arreglos únicos que no encontrarás en ningún otro lugar</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="benefit-item" data-aos="zoom-in" data-aos-delay="400">
                    <div class="benefit-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4>Atención 24/7</h4>
                    <p>Soporte en línea para resolver tus dudas cualquier día</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contador de estadísticas -->
<section class="counter-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <div class="counter-item">
                    <h3><span class="counter-num" data-target="5">6</span>+</h3>
                    <p>Años de experiencia</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <div class="counter-item">
                    <h3><span class="counter-num" data-target="1500">0</span>+</h3>
                    <p>Clientes felices</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <div class="counter-item">
                    <h3><span class="counter-num" data-target="200">0</span>+</h3>
                    <p>Eventos decorados</p>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <div class="counter-item">
                    <h3><span class="counter-num" data-target="5000">0</span>+</h3>
                    <p>Arreglos entregados</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonios -->
<section id="testimonios" class="py-5">
    <div class="container">
        <div class="section-title">
            <h2>Lo que dicen nuestros clientes</h2>
        </div>
        <div class="row">
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="testimonial-card">
                    <i class="fas fa-quote-left"></i>
                    <p>"Excelente servicio, las flores llegaron frescas y hermosas. Definitivamente volveré a comprar."</p>
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <h5>Maria Gonzalez</h5>
                    <small>Cliente frecuente</small>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="testimonial-card">
                    <i class="fas fa-quote-left"></i>
                    <p>"Tomé el curso de arreglos y aprendí muchísimo. Los profesores son muy atentos y profesionales."</p>
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <h5>Carlos </h5>
                    <small>Alumno destacado</small>
                </div>
            </div>
            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="testimonial-card">
                    <i class="fas fa-quote-left"></i>
                    <p>"La decoración de mi boda fue espectacular. Superaron todas mis expectativas. Muchas gracias."</p>
                    <div class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <h5>Laura Martinez</h5>
                    <small>Novia feliz</small>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contacto">
    <div class="container">
        <div class="newsletter-section text-center">
            <i class="fas fa-envelope fa-3x" style="color: var(--rosa-intenso);"></i>
            <h3>¡Registrate y enterate de todas las promociones!</h3>
            <p>Recibe ofertas exclusivas y novedades directamente en tu correo</p>
            <form class="mt-4">
                <input type="email" class="newsletter-input" placeholder="Tu correo electrónico">
                <button type="submit" class="newsletter-btn">
                    <i class="fas fa-paper-plane"></i> Registrarme
                </button>
            </form>
            <small class="d-block mt-3">No compartimos tu información. Puedes cancelar cuando quieras.</small>
        </div>
    </div>
</section>

<!-- Horario de Atención -->
<section class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="hours-card" data-aos="flip-left">
                <i class="fas fa-clock"></i>
                <h3 style="color: var(--morado-oscuro);">Horario de atención en el local</h3>
                <ul class="hours-list">
                    <li><span>Lunes a Viernes</span><span>9:00 AM - 8:00 PM</span></li>
                    <li><span>Sábados</span><span>9:00 AM - 6:00 PM</span></li>
                    <li><span>Domingos</span><span>Cerrado - Solo envíos especiales</span></li>
                </ul>
                <div class="mt-3">
                    <span class="badge" style="background: linear-gradient(135deg, var(--rosa), var(--morado)); padding: 8px 15px;">
                        <i class="fas fa-phone-alt"></i> Atención inmediata: +591 77793200
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <h5><i class="fas fa-flower"></i> Alesli</h5>
                <p>Florería elegante con 5 años de experiencia creando momentos especiales a través de nuestras decoraciones.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
                <h5>Enlaces rápidos</h5>
                <ul class="list-unstyled">
                    <li><a href="#home">Inicio</a></li>
                    <li><a href="#servicios">Servicios</a></li>
                    <li><a href="/login">Iniciar Sesión</a></li>
                    <li><a href="/register">Registrarse</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contacto</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt"></i> La Paz, Bolivia</li>
                    <li><i class="fas fa-phone"></i> +591 77793200</li>
                    <li><i class="fas fa-envelope"></i> floreriaalesli@gmail.com</li>
                    <li><i class="fas fa-clock"></i> Siempre abierto </li>
                </ul>
            </div>
        </div>
        <hr class="my-4" style="background: rgba(255,255,255,0.3);">
        <div class="text-center">
            <p class="mb-0">&copy; 2020 Alesli - Naturalmente para ti. Todos los derechos reservados. 🌸</p>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    // Inicializar AOS (animaciones cuando hacemos scroll)
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });

    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });

    // Contador animado
    const counters = document.querySelectorAll('.counter-num');
    const speed = 200;

    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-target'));
        let count = 0;
        const increment = target / speed;
        
        const updateCount = () => {
            if (count < target) {
                count += increment;
                counter.innerText = Math.ceil(count);
                setTimeout(updateCount, 20);
            } else {
                counter.innerText = target;
            }
        };
        
        updateCount();
    };

    // Activa contadores cuando sean visibles
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                animateCounter(counter);
                observer.unobserve(counter);
            }
        });
    }, observerOptions);

    counters.forEach(counter => {
        observer.observe(counter);
    });

    // Smooth scroll para enlaces internos
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
</body>
</html>