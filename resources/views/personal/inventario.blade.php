<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inventario - Personal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #fef5f7 0%, #fce4ec 100%); }
        .navbar { background: linear-gradient(135deg, #c2185b, #6a1b9a); padding: 15px 30px; }
        .navbar-brand { font-family: 'Dancing Script', cursive; font-size: 1.8rem; color: white !important; }
        .nav-link { color: white !important; transition: all 0.3s ease; }
        .nav-link:hover { transform: translateY(-2px); }
        .card { border: none; border-radius: 25px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); margin-bottom: 30px; overflow: hidden; }
        .card-header { background: linear-gradient(135deg, #c2185b, #6a1b9a); color: white; padding: 18px 25px; font-weight: 600; }
        .table thead { background: linear-gradient(135deg, #fce4ec, #f3e5f5); }
        .product-img { width: 60px; height: 60px; object-fit: cover; border-radius: 12px; }
        .badge-disponible { background: #2e7d32; }
        .badge-stock_bajo { background: #ff9800; }
        .badge-agotado { background: #c62828; }
        .footer { background: linear-gradient(135deg, #c2185b, #6a1b9a); color: white; text-align: center; padding: 20px; margin-top: 30px; }
        @media (max-width: 768px) { .table-responsive { font-size: 0.8rem; } }
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
    <div class="card">
        <div class="card-header">
            <i class="fas fa-boxes"></i> Inventario de Productos
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <th>Precio (Bs)</th>
                            <th>Stock</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $producto)
                        <tr>
                            <td>
                                @if($producto->imagen)
                                    <img src="{{ asset($producto->imagen) }}" class="product-img">
                                @else
                                    <div class="product-img bg-light d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image text-muted fa-2x"></i>
                                    </div>
                                @endif
                            </td>
                            <td><strong>{{ $producto->nombre }}</strong></td>
                            <td>{{ Str::limit($producto->descripcion, 60) ?: 'Sin descripción' }}</td>
                            <td><span style="color: #c2185b; font-weight: 600;">Bs. {{ number_format($producto->precio, 2) }}</span></td>
                            <td>{{ $producto->stock }} unidades</span></td>
                            <td>
                                @if($producto->estado == 'disponible')
                                    <span class="badge badge-disponible">✅ Disponible</span>
                                @elseif($producto->estado == 'stock_bajo')
                                    <span class="badge badge-stock_bajo">⚠️ Stock Bajo</span>
                                @else
                                    <span class="badge badge-agotado">❌ Agotado</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-box-open fa-3x text-muted mb-2 d-block"></i>
                                <p>No hay productos registrados</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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
