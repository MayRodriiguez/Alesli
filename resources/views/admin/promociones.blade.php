<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Promociones - Flores Florería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #fef5f7 0%, #fce4ec 50%, #f3e5f5 100%); min-height: 100vh; }
        
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
        }
        
        .sidebar-header {
            padding: 35px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            position: relative;
            overflow: hidden;
        }
        
        .sidebar-header::before {
            content: '🏷️';
            position: absolute;
            font-size: 80px;
            opacity: 0.1;
            bottom: -20px;
            right: -20px;
            transform: rotate(-10deg);
        }
        
        .sidebar-header i { font-size: 3.5rem; margin-bottom: 15px; animation: float 3s ease-in-out infinite; }
        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }
        .sidebar-header h3 { font-family: 'Dancing Script', cursive; font-size: 2rem; font-weight: 700; }
        .sidebar-header p { font-size: 0.7rem; opacity: 0.8; }
        
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
        
        .sidebar-menu a:hover::before, .sidebar-menu a.active::before { width: 100%; }
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
        }
        .logout-btn:hover { background: rgba(255,255,255,0.3); transform: translateY(-2px); }
        
        .main-content { margin-left: 280px; padding: 25px; animation: fadeIn 0.5s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        
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
        }
        
        .top-bar h2 {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
        }
        
        .card {
            border: none;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .card-header {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            color: white;
            padding: 18px 25px;
            font-weight: 600;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            border: none;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(194,24,91,0.4);
        }
        
        .promo-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-left: 4px solid #c2185b;
        }
        
        .promo-card:hover {
            transform: translateX(5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .btn-action {
            margin: 3px;
            border-radius: 10px;
            padding: 6px 12px;
        }
        
        .modal-content { border-radius: 25px; overflow: hidden; }
        .modal-header {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            color: white;
            border: none;
        }
        
        @media (max-width: 768px) {
            .sidebar { left: -280px; }
            .main-content { margin-left: 0; }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-header">
        <i class="fas fa-flower"></i>
        <h3>Flores</h3>
        <p>Panel de Administración</p>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i><span> Dashboard</span></a>
        <a href="{{ route('admin.inventario') }}"><i class="fas fa-boxes"></i><span> Inventario</span></a>
        <a href="{{ route('admin.personal') }}"><i class="fas fa-users"></i><span> Personal</span></a>
        <a href="{{ route('admin.asistencia') }}"><i class="fas fa-clock"></i><span> Asistencia</span></a>
        <a href="{{ route('admin.finanzas') }}"><i class="fas fa-chart-line"></i><span> Finanzas</span></a>
        <a href="{{ route('admin.clientes') }}"><i class="fas fa-user-friends"></i><span> Clientes</span></a>
        <a href="{{ route('admin.promociones') }}" class="active"><i class="fas fa-tags"></i><span> Promociones</span></a>
        <a href="{{ route('admin.cursos') }}"><i class="fas fa-graduation-cap"></i><span> Cursos</span></a>
        <a href="{{ route('admin.eventos') }}"><i class="fas fa-calendar-alt"></i><span> Eventos</span></a>
    </div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</button>
    </form>
</div>

<div class="main-content">
    <div class="top-bar">
        <div>
            <h2><i class="fas fa-tags"></i> Gestión de Promociones</h2>
            <p><i class="fas fa-percent"></i> Administra las ofertas y descuentos especiales</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPromocionModal">
            <i class="fas fa-plus"></i> Agregar Promoción
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list"></i> Lista de Promociones
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($promociones as $promocion)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="promo-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <i class="fas fa-tag" style="color: #c2185b;"></i>
                                <strong class="ms-2">{{ $promocion->titulo }}</strong>
                            </div>
                            <span class="badge {{ $promocion->estaActiva() ? 'bg-success' : 'bg-secondary' }}">
                                <i class="fas {{ $promocion->estaActiva() ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                                {{ $promocion->estaActiva() ? 'Activa' : 'Inactiva' }}
                            </span>
                        </div>
                        <p class="mt-2 mb-1 small">{{ $promocion->descripcion }}</p>
                        <div class="mt-2">
                            <span class="badge bg-info">
                                <i class="fas fa-percent"></i> {{ $promocion->descuento }}% OFF
                            </span>
                            @if($promocion->codigo)
                                <span class="badge bg-warning text-dark">
                                    <i class="fas fa-code"></i> {{ $promocion->codigo }}
                                </span>
                            @endif
                        </div>
                        <div class="mt-2 small text-muted">
                            <i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($promocion->fecha_inicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($promocion->fecha_fin)->format('d/m/Y') }}
                        </div>
                        @if($promocion->monto_minimo > 0)
                            <div class="small text-muted">
                                <i class="fas fa-dollar-sign"></i> Mínimo: Bs. {{ number_format($promocion->monto_minimo, 2) }}
                            </div>
                        @endif
                        <div class="mt-3">
                            <button class="btn btn-sm btn-warning btn-action" onclick="editPromocion({{ $promocion->id }})" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="/admin/promociones/{{ $promocion->id }}/toggle" 
                               class="btn btn-sm {{ $promocion->activo ? 'btn-secondary' : 'btn-success' }} btn-action"
                               title="{{ $promocion->activo ? 'Desactivar' : 'Activar' }}"
                               onclick="return confirmAction(event, this.href, '¿Cambiar estado de esta promoción?')">
                                <i class="fas {{ $promocion->activo ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                            </a>
                            <button class="btn btn-sm btn-danger btn-action" onclick="deletePromocion({{ $promocion->id }}, '{{ $promocion->titulo }}')" title="Eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-4">
                    <i class="fas fa-tags fa-3x text-muted mb-2 d-block"></i>
                    <p>No hay promociones registradas</p>
                    <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addPromocionModal">
                        <i class="fas fa-plus"></i> Crear primera promoción
                    </button>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Promoción -->
<div class="modal fade" id="addPromocionModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus"></i> Agregar Promoción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.promociones.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label><i class="fas fa-tag"></i> Título *</label>
                            <input type="text" name="titulo" class="form-control" placeholder="Ej: San Valentín" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label><i class="fas fa-align-left"></i> Descripción *</label>
                            <textarea name="descripcion" class="form-control" rows="2" placeholder="Describe la promoción..." required></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><i class="fas fa-percent"></i> Descuento (%) *</label>
                            <input type="number" name="descuento" class="form-control" step="0.01" min="0" max="100" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><i class="fas fa-code"></i> Código Promocional</label>
                            <input type="text" name="codigo" class="form-control" placeholder="Ej: FLORES10">
                            <small class="text-muted">Opcional</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><i class="fas fa-tag"></i> Tipo *</label>
                            <select name="tipo" class="form-control" required>
                                <option value="porcentaje">Porcentaje (%)</option>
                                <option value="fijo">Monto Fijo (Bs)</option>
                                <option value="envio_gratis">Envío Gratis</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fas fa-calendar-alt"></i> Fecha Inicio *</label>
                            <input type="date" name="fecha_inicio" class="form-control" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" required>
                            <small class="text-danger">⚠️ La fecha no puede ser anterior al día de hoy</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fas fa-calendar-check"></i> Fecha Fin *</label>
                            <input type="date" name="fecha_fin" class="form-control" value="{{ date('Y-m-d', strtotime('+30 days')) }}" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label><i class="fas fa-dollar-sign"></i> Monto Mínimo de Compra</label>
                            <input type="number" name="monto_minimo" class="form-control" step="0.01" value="0">
                            <small class="text-muted">0 = sin mínimo</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Promoción</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Promoción -->
<div class="modal fade" id="editPromocionModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit"></i> Editar Promoción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editPromocionForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label><i class="fas fa-tag"></i> Título *</label>
                            <input type="text" name="titulo" id="edit_titulo" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label><i class="fas fa-align-left"></i> Descripción *</label>
                            <textarea name="descripcion" id="edit_descripcion" class="form-control" rows="2" required></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><i class="fas fa-percent"></i> Descuento (%) *</label>
                            <input type="number" name="descuento" id="edit_descuento" class="form-control" step="0.01" min="0" max="100" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><i class="fas fa-code"></i> Código Promocional</label>
                            <input type="text" name="codigo" id="edit_codigo" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label><i class="fas fa-tag"></i> Tipo *</label>
                            <select name="tipo" id="edit_tipo" class="form-control" required>
                                <option value="porcentaje">Porcentaje (%)</option>
                                <option value="fijo">Monto Fijo (Bs)</option>
                                <option value="envio_gratis">Envío Gratis</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fas fa-calendar-alt"></i> Fecha Inicio *</label>
                            <input type="date" name="fecha_inicio" id="edit_fecha_inicio" class="form-control" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label><i class="fas fa-calendar-check"></i> Fecha Fin *</label>
                            <input type="date" name="fecha_fin" id="edit_fecha_fin" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label><i class="fas fa-dollar-sign"></i> Monto Mínimo de Compra</label>
                            <input type="number" name="monto_minimo" id="edit_monto_minimo" class="form-control" step="0.01">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Promoción</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function editPromocion(id) {
        $.get('/admin/promociones/' + id + '/edit', function(data) {
            $('#edit_titulo').val(data.titulo);
            $('#edit_descripcion').val(data.descripcion);
            $('#edit_descuento').val(data.descuento);
            $('#edit_codigo').val(data.codigo);
            $('#edit_tipo').val(data.tipo);
            $('#edit_fecha_inicio').val(data.fecha_inicio);
            $('#edit_fecha_fin').val(data.fecha_fin);
            $('#edit_monto_minimo').val(data.monto_minimo);
            $('#editPromocionForm').attr('action', '/admin/promociones/' + id);
            $('#editPromocionModal').modal('show');
        }).fail(function() {
            Swal.fire('Error', 'No se pudo cargar la promoción', 'error');
        });
    }
    
    function deletePromocion(id, titulo) {
        Swal.fire({
            title: '¿Eliminar promoción?',
            text: `¿Estás seguro de eliminar "${titulo}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d32f2f',
            cancelButtonColor: '#757575',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/promociones/' + id,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function() {
                        Swal.fire('Eliminado', 'Promoción eliminada correctamente', 'success')
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
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) window.location.href = url;
        });
        return false;
    }
</script>

</body>
</html>