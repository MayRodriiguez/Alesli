<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Clientes - Flores Florería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
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
            content: '👥';
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
        
        .info-box {
            background: linear-gradient(135deg, #fce4ec, #f3e5f5);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
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
        <h3>Alesli</h3>
        <p>Panel de Administración</p>
    </div>
    <div class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i><span> Dashboard</span></a>
        <a href="{{ route('admin.inventario') }}"><i class="fas fa-boxes"></i><span> Inventario</span></a>
        <a href="{{ route('admin.personal') }}"><i class="fas fa-users"></i><span> Personal</span></a>
        <a href="{{ route('admin.asistencia') }}"><i class="fas fa-clock"></i><span> Asistencia</span></a>
        <a href="{{ route('admin.finanzas') }}"><i class="fas fa-chart-line"></i><span> Finanzas</span></a>
        <a href="{{ route('admin.clientes') }}" class="active"><i class="fas fa-user-friends"></i><span> Clientes</span></a>
        <a href="{{ route('admin.promociones') }}"><i class="fas fa-tags"></i><span> Promociones</span></a>
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
            <h2><i class="fas fa-user-friends"></i> Gestión de Clientes</h2>
            <p><i class="fas fa-chart-line"></i> Administra los clientes de la florería</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClienteModal">
            <i class="fas fa-plus"></i> Agregar Cliente
        </button>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="fas fa-list"></i> Lista de Clientes
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="clientesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Tipo</th>
                            <th>Pedidos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se cargarán los clientes dinámicamente -->
                    </tbody>
                </table>
            </div>
            <div class="info-box mt-4">
                <i class="fas fa-info-circle fa-3x" style="color: #c2185b;"></i>
                <h5 class="mt-3">Módulo de Clientes</h5>
                <p>Los clientes se registran automáticamente desde la página principal.</p>
                <p class="text-muted">Para registrar un cliente, los usuarios deben crear una cuenta en:</p>
                <code>http://127.0.0.1:8000/register</code>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Cliente -->
<div class="modal fade" id="addClienteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-user-plus"></i> Agregar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Los clientes se registran automáticamente desde la página principal.
                </div>
                <p>Para registrar un cliente, los usuarios deben crear una cuenta en:</p>
                <code class="d-block p-2 bg-light rounded">http://127.0.0.1:8000/register</code>
                <hr>
                <p><strong>Tipos de clientes:</strong></p>
                <ul>
                    <li><span class="badge bg-info">Nuevo</span> - Registro reciente</li>
                    <li><span class="badge bg-success">Frecuente</span> - Más de 3 compras</li>
                    <li><span class="badge bg-warning">Potencial</span> - Interacción alta</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <a href="{{ url('/register') }}" class="btn btn-primary" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Ir a Registro
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Cargar clientes desde la API
    $(document).ready(function() {
        $.get('/admin/clientes/data', function(data) {
            var tbody = $('#clientesTable tbody');
            tbody.empty();
            
            if (data.length > 0) {
                $.each(data, function(index, cliente) {
                    var row = `<tr>
                        <td>${cliente.id}</td>
                        <td><strong>${cliente.name}</strong></td>
                        <td>${cliente.email}</td>
                        <td>${cliente.telefono || '--'}</td>
                        <td>${cliente.direccion || '--'}</td>
                        <td><span class="badge ${cliente.cliente_tipo == 'frecuente' ? 'bg-success' : (cliente.cliente_tipo == 'potencial' ? 'bg-warning' : 'bg-info')}">${cliente.cliente_tipo || 'nuevo'}</span></td>
                        <td><span class="badge bg-primary">${cliente.pedidos_count || 0} pedidos</span></td>
                        <td>
                            <button class="btn btn-sm btn-info" onclick="verCliente(${cliente.id})"><i class="fas fa-eye"></i></button>
                        </td>
                    </tr>`;
                    tbody.append(row);
                });
            } else {
                tbody.html('<tr><td colspan="8" class="text-center py-4"><i class="fas fa-users fa-3x text-muted mb-2 d-block"></i><p>No hay clientes registrados aún</p><small>Los clientes aparecerán aquí cuando se registren desde la página principal</small></td></tr>');
            }
        });
    });
    
    function verCliente(id) {
        alert('Ver detalles del cliente ID: ' + id + ' - Próximamente');
    }
</script>

</body>
</html>