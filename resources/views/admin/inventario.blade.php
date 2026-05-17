<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inventario - Flores Florería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #fef5f7 0%, #fce4ec 50%, #f3e5f5 100%);
            min-height: 100vh;
        }

        /* Sidebar Premium */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100%;
            background: linear-gradient(180deg, #c2185b 0%, #6a1b9a 50%, #4a148c 100%);
            color: white;
            z-index: 1000;
            box-shadow: 5px 0 25px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 35px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            position: relative;
            overflow: hidden;
        }

        .sidebar-header::before {
            content: '🌸';
            position: absolute;
            font-size: 80px;
            opacity: 0.1;
            bottom: -20px;
            right: -20px;
            transform: rotate(-15deg);
        }

        .sidebar-header i {
            font-size: 3.5rem;
            margin-bottom: 15px;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.3));
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .sidebar-header h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 2px;
        }

        .sidebar-header p {
            font-size: 0.7rem;
            opacity: 0.8;
            margin-top: 5px;
            letter-spacing: 1px;
        }

        .sidebar-menu {
            padding: 25px 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 5px 15px;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
            font-weight: 500;
        }

        .sidebar-menu a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 0;
            background: rgba(255,255,255,0.2);
            transition: width 0.3s ease;
            z-index: 0;
        }

        .sidebar-menu a:hover::before,
        .sidebar-menu a.active::before {
            width: 100%;
        }

        .sidebar-menu a i {
            width: 30px;
            z-index: 1;
            font-size: 1.1rem;
        }

        .sidebar-menu a span {
            z-index: 1;
        }

        .sidebar-menu a:hover {
            transform: translateX(5px);
        }

        .sidebar-menu a.active {
            background: rgba(255,255,255,0.25);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .logout-btn {
            position: absolute;
            bottom: 25px;
            width: calc(100% - 30px);
            margin: 0 15px;
            background: rgba(255,255,255,0.15);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            backdrop-filter: blur(10px);
        }

        .logout-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 25px;
        }

        /* Top Bar Premium */
        .top-bar {
            background: white;
            border-radius: 25px;
            padding: 20px 30px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid rgba(255,20,147,0.1);
            backdrop-filter: blur(10px);
        }

        .top-bar h2 {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0;
        }

        .top-bar p {
            color: #888;
            margin: 0;
            font-size: 0.85rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            border: none;
            border-radius: 50px;
            padding: 12px 28px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(194,24,91,0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(194,24,91,0.4);
            background: linear-gradient(135deg, #d81b60, #7b1fa2);
        }

        /* Cards de estadísticas Premium */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card-mini {
            background: white;
            border-radius: 25px;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255,20,147,0.1);
        }

        .stat-card-mini::before {
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

        .stat-card-mini:hover::before {
            transform: scaleX(1);
        }

        .stat-card-mini:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        }

        .stat-icon-mini {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #fce4ec, #f3e5f5);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .stat-card-mini:hover .stat-icon-mini {
            transform: scale(1.05) rotate(5deg);
        }

        .stat-icon-mini i {
            font-size: 1.8rem;
            color: #c2185b;
        }

        .stat-info-mini h3 {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
            color: #2d2d2d;
        }

        .stat-info-mini p {
            margin: 0;
            color: #888;
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* Card principal */
        .card {
            border: none;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            background: white;
        }

        .card-header {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            color: white;
            padding: 20px 25px;
            font-weight: 600;
            font-size: 1.1rem;
            border: none;
        }

        .card-header i {
            margin-right: 10px;
        }

        /* Tabla Premium */
        .table {
            vertical-align: middle;
            margin: 0;
        }

        .table thead th {
            background: linear-gradient(135deg, #fce4ec, #f3e5f5);
            color: #4a148c;
            font-weight: 700;
            border: none;
            padding: 18px 15px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
        }

        .table tbody tr:hover {
            background: linear-gradient(90deg, #fce4ec, #ffffff);
            transform: scale(1.01);
        }

        .product-img {
            width: 55px;
            height: 55px;
            object-fit: cover;
            border-radius: 15px;
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }

        .product-img:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }

        /* Badges Premium */
        .badge {
            padding: 6px 14px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .badge-disponible {
            background: linear-gradient(135deg, #2e7d32, #388e3c);
            color: white;
        }

        .badge-stock_bajo {
            background: linear-gradient(135deg, #ff8f00, #f57c00);
            color: white;
        }

        .badge-agotado {
            background: linear-gradient(135deg, #c62828, #d32f2f);
            color: white;
        }

        .badge-activo {
            background: linear-gradient(135deg, #00897b, #26a69a);
            color: white;
        }

        .badge-inactivo {
            background: linear-gradient(135deg, #546e7a, #607d8b);
            color: white;
        }

        /* Botones de acción Premium */
        .btn-action {
            margin: 0 3px;
            border-radius: 12px;
            transition: all 0.2s ease;
            width: 34px;
            height: 34px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-action:hover {
            transform: scale(1.1);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ff9800, #f57c00);
            border: none;
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #4caf50, #388e3c);
            border: none;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #9e9e9e, #757575);
            border: none;
        }

        .btn-danger {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            border: none;
        }

        /* Modales Premium */
        .modal-content {
            border-radius: 30px;
            overflow: hidden;
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            color: white;
            border: none;
            padding: 20px 25px;
        }

        .modal-header .btn-close {
            filter: invert(1);
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            padding: 8px;
            transition: all 0.3s ease;
        }

        .modal-header .btn-close:hover {
            transform: rotate(90deg);
            background: rgba(255,255,255,0.3);
        }

        .modal-body {
            padding: 30px;
        }

        .modal-footer {
            border-top: 1px solid #f0f0f0;
            padding: 20px 30px;
        }

        /* Formularios */
        .form-control {
            border-radius: 15px;
            padding: 12px 18px;
            border: 2px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #c2185b;
            box-shadow: 0 0 0 3px rgba(194,24,91,0.1);
        }

        .form-label {
            font-weight: 600;
            color: #4a148c;
            margin-bottom: 8px;
        }

        /* DataTables */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 20px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 25px;
            padding: 8px 20px;
            border: 2px solid #f0f0f0;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 50px !important;
            margin: 0 3px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, #c2185b, #6a1b9a) !important;
            border: none;
            color: white !important;
        }

        /* Alertas */
        .alert {
            border-radius: 20px;
            border: none;
            padding: 15px 20px;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            color: #2e7d32;
            border-left: 4px solid #4caf50;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                left: -280px;
            }
            .main-content {
                margin-left: 0;
            }
            .stats-row {
                grid-template-columns: repeat(2, 1fr);
            }
            .top-bar {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
        }

        /* Animaciones adicionales */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card, .stat-card-mini {
            animation: fadeIn 0.5s ease-out;
        }

        /* Scrollbar personalizada */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            border-radius: 10px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <i class="fas fa-flower"></i>
        <h3>Flores</h3>
        <p>Panel de Administración</p>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i><span> Dashboard</span></a>
        <a href="{{ route('admin.inventario') }}" class="active"><i class="fas fa-boxes"></i><span> Inventario</span></a>
        <a href="{{ route('admin.personal') }}"><i class="fas fa-users"></i><span> Personal</span></a>
        <a href="{{ route('admin.asistencia') }}"><i class="fas fa-clock"></i><span> Asistencia</span></a>
        <a href="{{ route('admin.finanzas') }}"><i class="fas fa-chart-line"></i><span> Finanzas</span></a>
        <a href="{{ route('admin.clientes') }}"><i class="fas fa-user-friends"></i><span> Clientes</span></a>
        <a href="{{ route('admin.promociones') }}"><i class="fas fa-tags"></i><span> Promociones</span></a>
        <a href="{{ route('admin.cursos') }}"><i class="fas fa-graduation-cap"></i><span> Cursos</span></a>
        <a href="{{ route('admin.eventos') }}"><i class="fas fa-calendar-alt"></i><span> Eventos</span></a>
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
    </form>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="top-bar">
        <div>
            <h2><i class="fas fa-boxes"></i> Gestión de Inventario</h2>
            <p><i class="fas fa-chart-line"></i> Administra tus productos, stock y precios en Bolivianos</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductoModal">
            <i class="fas fa-plus"></i> Agregar Producto
        </button>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="stats-row">
        <div class="stat-card-mini">
            <div class="stat-icon-mini"><i class="fas fa-box"></i></div>
            <div class="stat-info-mini">
                <h3 id="totalProductos">0</h3>
                <p>Productos Totales</p>
            </div>
        </div>
        <div class="stat-card-mini">
            <div class="stat-icon-mini"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info-mini">
                <h3 id="productosActivos">0</h3>
                <p>Productos Activos</p>
            </div>
        </div>
        <div class="stat-card-mini">
            <div class="stat-icon-mini"><i class="fas fa-exclamation-triangle"></i></div>
            <div class="stat-info-mini">
                <h3 id="stockBajo">0</h3>
                <p>Stock Bajo</p>
            </div>
        </div>
        <div class="stat-card-mini">
            <div class="stat-icon-mini"><i class="fas fa-chart-line"></i></div>
            <div class="stat-info-mini">
                <h3 id="valorInventario">Bs. 0</h3>
                <p>Valor del Inventario</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list"></i> Lista de Productos
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="productosTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Producto</th>
                            <th>Descripción</th>
                            <th>Precio (Bs)</th>
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Visible</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>
                                @if($producto->imagen)
                                    <img src="{{ asset($producto->imagen) }}" class="product-img" alt="{{ $producto->nombre }}" onclick="verImagen('{{ asset($producto->imagen) }}', '{{ $producto->nombre }}')">
                                @else
                                    <div class="product-img bg-light d-flex align-items-center justify-content-center" style="cursor: pointer; background: linear-gradient(135deg, #fce4ec, #f3e5f5);">
                                        <i class="fas fa-image fa-2x text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td><strong>{{ $producto->nombre }}</strong></td>
                            <td>{{ Str::limit($producto->descripcion, 40) ?: 'Sin descripción' }}</td>
                            <td><span style="font-weight: 700; color: #c2185b;">Bs. {{ number_format($producto->precio, 2) }}</span></td>
                            <td>
                                <span class="badge {{ $producto->stock <= 0 ? 'bg-danger' : ($producto->stock <= 5 ? 'bg-warning' : 'bg-info') }}">
                                    {{ $producto->stock }} unidades
                                </span>
                            </td>
                            <td>
                                @if($producto->estado == 'disponible')
                                    <span class="badge badge-disponible"><i class="fas fa-check"></i> Disponible</span>
                                @elseif($producto->estado == 'stock_bajo')
                                    <span class="badge badge-stock_bajo"><i class="fas fa-exclamation"></i> Stock Bajo</span>
                                @else
                                    <span class="badge badge-agotado"><i class="fas fa-times"></i> Agotado</span>
                                @endif
                            </td>
                            <td>
                                @if($producto->activo)
                                    <span class="badge badge-activo"><i class="fas fa-eye"></i> Activo</span>
                                @else
                                    <span class="badge badge-inactivo"><i class="fas fa-eye-slash"></i> Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-warning btn-action" onclick="editProducto({{ $producto->id }})" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.inventario.toggle', $producto->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="btn btn-action {{ $producto->activo ? 'btn-secondary' : 'btn-success' }}"
                                            title="{{ $producto->activo ? 'Desactivar' : 'Activar' }}"
                                            onclick="return confirm('¿Cambiar estado de este producto?')">
                                        <i class="fas {{ $producto->activo ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
                                </form>
                                <button class="btn btn-danger btn-action" onclick="deleteProducto({{ $producto->id }}, '{{ $producto->nombre }}')" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5">
                                <i class="fas fa-box-open fa-4x text-muted mb-3 d-block"></i>
                                <h5>No hay productos registrados</h5>
                                <p>Haz clic en "Agregar Producto" para comenzar</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Producto -->
<div class="modal fade" id="addProductoModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus-circle"></i> Agregar Nuevo Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.inventario.store') }}" method="POST" enctype="multipart/form-data" id="addProductoForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-tag"></i> Nombre del Producto *</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Ej: Ramo de Rosas Rojas" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-dollar-sign"></i> Precio (Bs) *</label>
                            <input type="number" name="precio" class="form-control" step="0.01" placeholder="0.00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-box"></i> Stock Inicial *</label>
                            <input type="number" name="stock" class="form-control" value="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-image"></i> Imagen del Producto</label>
                            <input type="file" name="imagen" class="form-control" accept="image/*" id="imagenInput">
                            <small class="text-muted">Formatos: JPG, PNG, GIF (Máx. 2MB)</small>
                            <div class="mt-2" id="imagenPreview" style="display: none;">
                                <img id="preview" src="" style="max-width: 100px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label"><i class="fas fa-align-left"></i> Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="3" placeholder="Describe el producto..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Producto -->
<div class="modal fade" id="editProductoModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit"></i> Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editProductoForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-tag"></i> Nombre del Producto *</label>
                            <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-dollar-sign"></i> Precio (Bs) *</label>
                            <input type="number" name="precio" id="edit_precio" class="form-control" step="0.01" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-box"></i> Stock *</label>
                            <input type="number" name="stock" id="edit_stock" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-image"></i> Cambiar Imagen</label>
                            <input type="file" name="imagen" class="form-control" accept="image/*">
                            <small class="text-muted">Dejar vacío para mantener la imagen actual</small>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label"><i class="fas fa-align-left"></i> Descripción</label>
                            <textarea name="descripcion" id="edit_descripcion" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ver Imagen -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-image"></i> <span id="imageTitle"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" style="max-width: 100%; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#productosTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
            },
            pageLength: 10,
            responsive: true,
            dom: '<"top"lf>rt<"bottom"ip><"clear">'
        });
        
        calcularEstadisticas();
    });
    
    function calcularEstadisticas() {
        setTimeout(() => {
            const rows = document.querySelectorAll('#productosTable tbody tr');
            let total = rows.length;
            let activos = 0;
            let stockBajo = 0;
            let valorTotal = 0;
            
            rows.forEach(row => {
                if (row.cells[7] && row.cells[7].innerText.includes('Activo')) activos++;
                
                let stock = 0;
                if (row.cells[5]) {
                    const stockText = row.cells[5].innerText || '';
                    const stockMatch = stockText.match(/(\d+)/);
                    if (stockMatch) stock = parseInt(stockMatch[0]);
                }
                
                if (stock > 0 && stock <= 5) stockBajo++;
                
                let precio = 0;
                if (row.cells[4]) {
                    const precioText = row.cells[4].innerText || '';
                    const precioMatch = precioText.match(/(\d+(?:\.\d+)?)/);
                    if (precioMatch) precio = parseFloat(precioMatch[0]);
                }
                
                valorTotal += precio * stock;
            });
            
            document.getElementById('totalProductos').innerText = total;
            document.getElementById('productosActivos').innerText = activos;
            document.getElementById('stockBajo').innerText = stockBajo;
            document.getElementById('valorInventario').innerHTML = 'Bs. ' + valorTotal.toLocaleString('es-BO', {minimumFractionDigits: 2});
        }, 300);
    }
    
    function verImagen(src, title) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageTitle').innerText = title;
        new bootstrap.Modal(document.getElementById('imageModal')).show();
    }
    
    function editProducto(id) {
        $.get('/admin/inventario/' + id + '/edit', function(producto) {
            $('#edit_nombre').val(producto.nombre);
            $('#edit_precio').val(producto.precio);
            $('#edit_stock').val(producto.stock);
            $('#edit_descripcion').val(producto.descripcion);
            $('#editProductoForm').attr('action', '/admin/inventario/' + id);
            $('#editProductoModal').modal('show');
        }).fail(function() {
            Swal.fire('Error', 'No se pudo cargar el producto', 'error');
        });
    }
    
    function deleteProducto(id, nombre) {
        Swal.fire({
            title: '¿Eliminar producto?',
            text: `¿Estás seguro de eliminar "${nombre}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d32f2f',
            cancelButtonColor: '#757575',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            background: 'white',
            backdrop: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Eliminando...',
                    text: 'Por favor espera',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                $.ajax({
                    url: '/admin/inventario/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        Swal.fire('Eliminado', 'Producto eliminado correctamente', 'success')
                            .then(() => location.reload());
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudo eliminar el producto', 'error');
                    }
                });
            }
        });
    }
    
    document.getElementById('imagenInput')?.addEventListener('change', function(e) {
        const preview = document.getElementById('preview');
        const previewDiv = document.getElementById('imagenPreview');
        if (e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(event) {
                preview.src = event.target.result;
                previewDiv.style.display = 'block';
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
</body>
</html>