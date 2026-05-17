<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mi Perfil - Personal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #fef5f7 0%, #fce4ec 100%); }
        .navbar { background: linear-gradient(135deg, #c2185b, #6a1b9a); padding: 15px 30px; }
        .navbar-brand { font-family: 'Dancing Script', cursive; font-size: 1.8rem; color: white !important; }
        .nav-link { color: white !important; transition: all 0.3s ease; }
        .nav-link:hover { transform: translateY(-2px); }
        .card { border: none; border-radius: 25px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); overflow: hidden; }
        .card-header { background: linear-gradient(135deg, #c2185b, #6a1b9a); color: white; padding: 18px 25px; font-weight: 600; }
        .btn-primary { background: linear-gradient(135deg, #c2185b, #6a1b9a); border: none; border-radius: 50px; padding: 12px 30px; font-weight: 600; transition: all 0.3s ease; }
        .btn-primary:hover { transform: translateY(-2px); }
        .info-item { display: flex; align-items: center; gap: 12px; padding: 12px 0; border-bottom: 1px solid #f0f0f0; }
        .info-item i { width: 30px; color: #c2185b; font-size: 1.1rem; }
        .footer { background: linear-gradient(135deg, #c2185b, #6a1b9a); color: white; text-align: center; padding: 20px; margin-top: 30px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('personal.dashboard') }}"><i class="fas fa-flower"></i> Flores</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('personal.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('personal.inventario') }}"><i class="fas fa-boxes"></i> Inventario</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('personal.perfil') }}"><i class="fas fa-user"></i> Mi Perfil</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn nav-link" style="background:none;border:none;"><i class="fas fa-sign-out-alt"></i> Salir</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-circle"></i> Mi Perfil
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <div class="info-item">
                        <i class="fas fa-user"></i>
                        <strong>Nombre completo:</strong>
                        <span>{{ $personal->nombre }} {{ $personal->apellido }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <strong>Email:</strong>
                        <span>{{ $personal->email }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-briefcase"></i>
                        <strong>Cargo:</strong>
                        <span>{{ $personal->cargo }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-calendar-alt"></i>
                        <strong>Fecha de contratación:</strong>
                        <span>{{ \Carbon\Carbon::parse($personal->fecha_contratacion)->format('d/m/Y') }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <strong>Horario laboral:</strong>
                        <span>{{ substr($personal->hora_entrada, 0, 5) }} - {{ substr($personal->hora_salida, 0, 5) }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-dollar-sign"></i>
                        <strong>Salario:</strong>
                        <span class="fw-bold" style="color: #c2185b;">Bs. {{ number_format($personal->salario, 2) }}</span>
                    </div>
                    
                    <hr>
                    
                    <form action="{{ route('personal.perfil.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label><i class="fas fa-phone"></i> Teléfono</label>
                            <input type="text" name="telefono" class="form-control" value="{{ $personal->telefono }}" required>
                            <small class="text-muted">Puedes actualizar tu número de teléfono</small>
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

<footer class="footer">
    <div class="container">
        <p class="mb-0">&copy; 2024 Flores - Florería Elegante</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>