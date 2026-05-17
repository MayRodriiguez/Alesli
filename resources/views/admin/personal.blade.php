<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Personal - Flores Florería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #fef5f7 0%, #fce4ec 50%, #f3e5f5 100%); min-height: 100vh; }
        
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
            box-shadow: 5px 0 30px rgba(0,0,0,0.2);
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
            content: '👥';
            position: absolute;
            font-size: 80px;
            opacity: 0.1;
            bottom: -20px;
            right: -20px;
            transform: rotate(-10deg);
        }
        
        .sidebar-header i {
            font-size: 3.5rem;
            margin-bottom: 15px;
            animation: float 3s ease-in-out infinite;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.2));
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }
        
        .sidebar-header h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        
        .sidebar-header p {
            font-size: 0.7rem;
            opacity: 0.8;
            margin-top: 5px;
        }
        
        .sidebar-menu { padding: 25px 0; }
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 5px 15px;
            border-radius: 15px;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }
        
        .sidebar-menu a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: rgba(255,255,255,0.15);
            transition: width 0.3s ease;
        }
        
        .sidebar-menu a:hover::before,
        .sidebar-menu a.active::before {
            width: 100%;
        }
        
        .sidebar-menu a i { width: 30px; z-index: 1; }
        .sidebar-menu a span { z-index: 1; }
        .sidebar-menu a:hover, .sidebar-menu a.active { transform: translateX(5px); }
        
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
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Top Bar Premium */
        .top-bar {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 20px 30px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
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
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(194,24,91,0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(194,24,91,0.4);
        }
        
        /* Stats Cards Premium */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 35px;
        }
        
        .stat-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 20px 25px;
            display: flex;
            align-items: center;
            gap: 18px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.2);
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
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #fce4ec, #f3e5f5);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover .stat-icon {
            transform: scale(1.05) rotate(5deg);
        }
        
        .stat-icon i {
            font-size: 1.8rem;
            color: #c2185b;
        }
        
        .stat-info h3 {
            font-size: 2rem;
            font-weight: 800;
            margin: 0;
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-info p {
            margin: 0;
            color: #888;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        /* Personal Cards Premium */
        .personal-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            padding: 25px;
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            height: 100%;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            position: relative;
            overflow: hidden;
        }
        
        .personal-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #c2185b, #6a1b9a, #c2185b);
            transform: translateX(-100%);
            transition: transform 0.4s ease;
        }
        
        .personal-card:hover::before {
            transform: translateX(0);
        }
        
        .personal-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        }
        
        .personal-img {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 auto 18px;
            border: 4px solid transparent;
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            background-clip: padding-box;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .personal-img:hover {
            transform: scale(1.05);
            border-color: #c2185b;
        }
        
        .personal-card h4 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: #2d2d2d;
        }
        
        /* Badges Premium */
        .badge {
            padding: 6px 14px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
            margin: 3px;
        }
        
        .badge-cargo {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            color: white;
        }
        
        .badge-activo {
            background: linear-gradient(135deg, #2e7d32, #43a047);
            color: white;
        }
        
        .badge-inactivo {
            background: linear-gradient(135deg, #c62828, #e53935);
            color: white;
        }
        
        /* Info items */
        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 0;
            border-bottom: 1px dashed rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .info-item:hover {
            background: linear-gradient(90deg, #fce4ec, transparent);
            padding-left: 5px;
        }
        
        .info-item i {
            width: 25px;
            color: #c2185b;
            font-size: 0.9rem;
        }
        
        .info-item strong {
            font-weight: 600;
            color: #555;
        }
        
        .info-item span {
            color: #666;
            font-size: 0.85rem;
        }
        
        .salario-text {
            font-weight: 700;
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Botones de acción */
        .btn-action {
            margin: 3px;
            border-radius: 12px;
            padding: 8px 14px;
            transition: all 0.2s ease;
            font-weight: 500;
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #ff9800, #f57c00);
            border: none;
            color: white;
        }
        
        .btn-success {
            background: linear-gradient(135deg, #4caf50, #388e3c);
            border: none;
            color: white;
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #9e9e9e, #757575);
            border: none;
            color: white;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            border: none;
            color: white;
        }
        
        /* Modales Premium */
        .modal-content {
            border-radius: 30px;
            overflow: hidden;
            border: none;
            background: linear-gradient(135deg, #fff, #fef5f7);
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
            border-top: 1px solid rgba(0,0,0,0.05);
            padding: 20px 30px;
        }
        
        /* Formularios */
        .form-control, .form-select {
            border-radius: 15px;
            padding: 12px 18px;
            border: 2px solid #f0f0f0;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #c2185b;
            box-shadow: 0 0 0 3px rgba(194,24,91,0.1);
        }
        
        .form-label {
            font-weight: 600;
            color: #4a148c;
            margin-bottom: 8px;
        }
        
        /* Alertas */
        .alert {
            border-radius: 20px;
            border: none;
            padding: 15px 20px;
            animation: slideDown 0.5s ease;
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            color: #2e7d32;
            border-left: 4px solid #4caf50;
        }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
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
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar { left: -280px; }
            .main-content { margin-left: 0; }
            .stats-row { grid-template-columns: repeat(2, 1fr); }
            .top-bar { flex-direction: column; text-align: center; gap: 15px; }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <i class="fas fa-flower"></i>
        <h3>Alesli</h3>
        <p>Panel de Administración</p>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i><span> Dashboard</span></a>
        <a href="{{ route('admin.inventario') }}"><i class="fas fa-boxes"></i><span> Inventario</span></a>
        <a href="{{ route('admin.personal') }}" class="active"><i class="fas fa-users"></i><span> Personal</span></a>
        <a href="{{ route('admin.asistencia') }}"><i class="fas fa-clock"></i><span> Asistencia</span></a>
        <a href="{{ route('admin.finanzas') }}"><i class="fas fa-chart-line"></i><span> Finanzas</span></a>
        <a href="{{ route('admin.clientes') }}"><i class="fas fa-user-friends"></i><span> Clientes</span></a>
        <a href="{{ route('admin.promociones') }}"><i class="fas fa-tags"></i><span> Promociones</span></a>
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
    </form>
</div>

<div class="main-content">
    <div class="top-bar">
        <div>
            <h2><i class="fas fa-users"></i> Gestión de Personal</h2>
            <p><i class="fas fa-user-tie"></i> Administra al personal de la floreria</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPersonalModal">
            <i class="fas fa-plus"></i> Agregar Personal
        </button>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-user-friends"></i></div>
            <div class="stat-info">
                <h3 id="totalPersonal">0</h3>
                <p>Total Personal</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <h3 id="personalActivo">0</h3>
                <p>Personal Activo</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
            <div class="stat-info">
                <h3 id="nominaTotal">Bs. 0</h3>
                <p>Nómina Mensual</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row" id="personalGrid">
        @forelse($personal as $miembro)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="personal-card">
                @if($miembro->foto)
                    <img src="{{ asset($miembro->foto) }}" class="personal-img" alt="{{ $miembro->nombre }}">
                @else
                    <div class="personal-img mx-auto d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #fce4ec, #f3e5f5);">
                        <i class="fas fa-user-circle fa-4x" style="color: #c2185b;"></i>
                    </div>
                @endif
                <h4 class="mb-1">{{ $miembro->nombre }} {{ $miembro->apellido }}</h4>
                <div class="mb-2">
                    <span class="badge badge-cargo">
                        <i class="fas fa-briefcase"></i> {{ $miembro->cargo }}
                    </span>
                    <span class="badge {{ $miembro->estado == 'activo' ? 'badge-activo' : 'badge-inactivo' }}">
                        <i class="fas {{ $miembro->estado == 'activo' ? 'fa-check-circle' : 'fa-ban' }}"></i>
                        {{ $miembro->estado == 'activo' ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
                
                <div class="text-start mt-3">
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <span>{{ $miembro->email }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <span>{{ $miembro->telefono }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span><strong>Contratación:</strong> {{ \Carbon\Carbon::parse($miembro->fecha_contratacion)->format('d/m/Y') }}</span>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <span><strong>Horario:</strong> {{ \Carbon\Carbon::parse($miembro->hora_entrada)->format('h:i A') }} - {{ \Carbon\Carbon::parse($miembro->hora_salida)->format('h:i A') }}</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-comment-dots"></i>
                        <span>{{ $miembro->descripcion ?: 'Sin descripción' }}</span>
                    </div>
                </div>
                
                <div class="mt-3 d-flex justify-content-center gap-2">
                    <button class="btn btn-warning btn-action" onclick="editPersonal({{ $miembro->id }})" title="Editar">
                        <i class="fas fa-edit"></i>
                    </button>
                    <a href="{{ route('admin.personal.toggle', $miembro->id) }}" 
                       class="btn btn-action {{ $miembro->estado == 'activo' ? 'btn-secondary' : 'btn-success' }}"
                       onclick="return confirmAction(event, this.href, '¿Cambiar estado de este miembro del personal?')">
                        <i class="fas {{ $miembro->estado == 'activo' ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                    </a>
                    <button class="btn btn-danger btn-action" onclick="deletePersonal({{ $miembro->id }}, '{{ $miembro->nombre }}')" title="Eliminar">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-user-friends fa-4x text-muted mb-3"></i>
            <h5>No hay personal registrado</h5>
            <p>Haz clic en "Agregar Personal" para comenzar</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Agregar Personal con Horario -->
<div class="modal fade" id="addPersonalModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-user-plus"></i> Agregar Nuevo Personal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.personal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-user"></i> Nombre *</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-user"></i> Apellido *</label>
                            <input type="text" name="apellido" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-envelope"></i> Email *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-phone"></i> Teléfono *</label>
                            <input type="text" name="telefono" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-briefcase"></i> Cargo *</label>
                            <select name="cargo" class="form-select" required>
                                <option value="">Seleccionar...</option>
                                <option value="Atención al Cliente"> Atención al Cliente</option>
                                <option value="Instructor de Cursos"> Instructor de Cursos</option>
                                <option value="Decorador de Ramos"> Decorador de Ramos</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-coins"></i> Salario (Bs) *</label>
                            <input type="number" name="salario" class="form-control" step="0.01" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-calendar"></i> Fecha Contratación *</label>
                            <input type="date" name="fecha_contratacion" class="form-control" 
                                   min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-clock"></i> Hora de Entrada *</label>
                            <input type="time" name="hora_entrada" class="form-control" value="09:00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-clock"></i> Hora de Salida *</label>
                            <input type="time" name="hora_salida" class="form-control" value="18:00" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-image"></i> Foto</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label"><i class="fas fa-align-left"></i> Descripción</label>
                            <textarea name="descripcion" class="form-control" rows="2" placeholder="Funciones y responsabilidades..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Personal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Personal con Horario -->
<div class="modal fade" id="editPersonalModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit"></i> Editar Personal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editPersonalForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-user"></i> Nombre *</label>
                            <input type="text" name="nombre" id="edit_nombre" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-user"></i> Apellido *</label>
                            <input type="text" name="apellido" id="edit_apellido" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-envelope"></i> Email *</label>
                            <input type="email" name="email" id="edit_email" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-phone"></i> Teléfono *</label>
                            <input type="text" name="telefono" id="edit_telefono" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-briefcase"></i> Cargo *</label>
                            <select name="cargo" id="edit_cargo" class="form-select" required>
                                <option value="Atención al Cliente"> Atención al Cliente</option>
                                <option value="Instructor de Cursos"> Instructor de Cursos</option>
                                <option value="Decorador de Ramos"> Decorador de Ramos</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-coins"></i> Salario (Bs) *</label>
                            <input type="number" name="salario" id="edit_salario" class="form-control" step="0.01" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-calendar"></i> Fecha Contratación *</label>
                            <input type="date" name="fecha_contratacion" id="edit_fecha_contratacion" class="form-control" 
                                   min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-clock"></i> Hora de Entrada *</label>
                            <input type="time" name="hora_entrada" id="edit_hora_entrada" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-clock"></i> Hora de Salida *</label>
                            <input type="time" name="hora_salida" id="edit_hora_salida" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-image"></i> Cambiar Foto</label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label"><i class="fas fa-align-left"></i> Descripción</label>
                            <textarea name="descripcion" id="edit_descripcion" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Personal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function calcularEstadisticas() {
        const cards = document.querySelectorAll('.personal-card');
        let total = cards.length;
        let activos = 0;
        let nomina = 0;
        
        cards.forEach(card => {
            const estado = card.querySelector('.badge:nth-of-type(2)')?.innerText || '';
            if (estado.includes('Activo')) activos++;
            
            const salarioText = card.innerText.match(/Bs\. ([\d,]+\.?\d*)/);
            if (salarioText) {
                nomina += parseFloat(salarioText[1].replace(/,/g, ''));
            }
        });
        
        document.getElementById('totalPersonal').innerText = total;
        document.getElementById('personalActivo').innerText = activos;
        document.getElementById('nominaTotal').innerHTML = 'Bs. ' + nomina.toLocaleString('es-BO', {minimumFractionDigits: 2});
    }
    
    function editPersonal(id) {
        $.get('/admin/personal/' + id + '/edit', function(data) {
            $('#edit_nombre').val(data.nombre);
            $('#edit_apellido').val(data.apellido);
            $('#edit_email').val(data.email);
            $('#edit_telefono').val(data.telefono);
            $('#edit_cargo').val(data.cargo);
            $('#edit_salario').val(data.salario);
            $('#edit_fecha_contratacion').val(data.fecha_contratacion);
            $('#edit_hora_entrada').val(data.hora_entrada.substring(0,5));
            $('#edit_hora_salida').val(data.hora_salida.substring(0,5));
            $('#edit_descripcion').val(data.descripcion);
            $('#editPersonalForm').attr('action', '/admin/personal/' + id);
            $('#editPersonalModal').modal('show');
        });
    }
    
    function deletePersonal(id, nombre) {
        Swal.fire({
            title: '¿Eliminar personal?',
            text: `¿Estás seguro de eliminar a "${nombre}" del personal?`,
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
                    didOpen: () => { Swal.showLoading(); }
                });
                
                $.ajax({
                    url: '/admin/personal/' + id,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function() {
                        Swal.fire('Eliminado', 'Personal eliminado correctamente', 'success')
                            .then(() => location.reload());
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudo eliminar', 'error');
                    }
                });
            }
        });
    }
    
    function confirmAction(event, url, message) {
        event.preventDefault();
        Swal.fire({
            title: '¿Cambiar estado?',
            text: message,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#c2185b',
            cancelButtonColor: '#757575',
            confirmButtonText: 'Sí, cambiar',
            cancelButtonText: 'Cancelar',
            background: 'white'
        }).then((result) => {
            if (result.isConfirmed) window.location.href = url;
        });
        return false;
    }
    
    calcularEstadisticas();
</script>
</body>
</html>