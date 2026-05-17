<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Asistencia - Flores Florería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #fef5f7 0%, #fce4ec 50%, #f3e5f5 100%); min-height: 100vh; }
        
        /* Sidebar */
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
            content: '⏰';
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
        
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover { transform: translateY(-5px); }
        .stat-icon { width: 50px; height: 50px; background: linear-gradient(135deg, #fce4ec, #f3e5f5); border-radius: 15px; display: flex; align-items: center; justify-content: center; }
        .stat-icon i { font-size: 1.5rem; color: #c2185b; }
        .stat-info h3 { font-size: 1.5rem; font-weight: 700; margin: 0; }
        .stat-info p { margin: 0; color: #888; font-size: 0.75rem; }
        
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
        
        .personal-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        .personal-card:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.15); }
        
        .personal-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 auto 10px;
            border: 3px solid #c2185b;
        }
        
        .badge-presente { background: linear-gradient(135deg, #2e7d32, #43a047); }
        .badge-tarde { background: linear-gradient(135deg, #ff9800, #f57c00); }
        .badge-ausente { background: linear-gradient(135deg, #c62828, #e53935); }
        .badge-justificado { background: linear-gradient(135deg, #1565c0, #1976d2); }
        
        .estado-icono {
            font-size: 2rem;
            margin-bottom: 10px;
        }
        
        .table { vertical-align: middle; }
        .table thead th { background: linear-gradient(135deg, #fce4ec, #f3e5f5); border: none; padding: 15px; }
        
        @media (max-width: 768px) {
            .sidebar { left: -280px; }
            .main-content { margin-left: 0; }
            .stats-row { grid-template-columns: repeat(2, 1fr); }
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
        <a href="{{ route('admin.asistencia') }}" class="active"><i class="fas fa-clock"></i><span> Asistencia</span></a>
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
            <h2><i class="fas fa-clock"></i> Control de Asistencia</h2>
            <p><i class="fas fa-calendar-day"></i> Visualización de asistencia del personal</p>
        </div>
        <div>
            <span class="badge badge-presente p-2 me-2"><i class="fas fa-check"></i> Presente</span>
            <span class="badge badge-tarde p-2 me-2"><i class="fas fa-clock"></i> Tarde</span>
            <span class="badge badge-ausente p-2 me-2"><i class="fas fa-times"></i> Ausente</span>
            <span class="badge badge-justificado p-2"><i class="fas fa-file-alt"></i> Justificado</span>
        </div>
    </div>

    @php
        $totalPersonal = count($personal);
        $presentes = $asistenciaHoy->where('estado', 'presente')->count();
        $tarde = $asistenciaHoy->where('estado', 'tarde')->count();
        $ausentes = $totalPersonal - $asistenciaHoy->count();
        $justificados = $asistenciaHoy->where('estado', 'justificado')->count();
    @endphp

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-users"></i></div>
            <div class="stat-info">
                <h3>{{ $totalPersonal }}</h3>
                <p>Total Personal</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <h3>{{ $presentes }}</h3>
                <p>Presentes Hoy</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-clock"></i></div>
            <div class="stat-info">
                <h3>{{ $tarde }}</h3>
                <p>Tarde</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fas fa-user-slash"></i></div>
            <div class="stat-info">
                <h3>{{ $ausentes }}</h3>
                <p>Ausentes</p>
            </div>
        </div>
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

    <!-- Resumen de Asistencia del Día -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-calendar-day"></i> Resumen de Asistencia - {{ now()->format('d/m/Y') }}
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($personal as $miembro)
                <div class="col-md-4 col-lg-3 mb-3">
                    <div class="personal-card">
                        @if($miembro->foto)
                            <img src="{{ asset($miembro->foto) }}" class="personal-img" alt="{{ $miembro->nombre }}">
                        @else
                            <div class="personal-img mx-auto d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #fce4ec, #f3e5f5);">
                                <i class="fas fa-user-circle fa-3x" style="color: #c2185b;"></i>
                            </div>
                        @endif
                        <h6 class="mb-1">{{ $miembro->nombre }} {{ $miembro->apellido }}</h6>
                        <small class="text-muted">{{ $miembro->cargo }}</small>
                        
                        @php
                            $registro = $asistenciaHoy[$miembro->id] ?? null;
                        @endphp
                        
                        <div class="mt-3">
                            @if($registro)
                                <div class="estado-icono">
                                    @if($registro->estado == 'presente')
                                        <i class="fas fa-check-circle" style="color: #2e7d32; font-size: 2rem;"></i>
                                    @elseif($registro->estado == 'tarde')
                                        <i class="fas fa-clock" style="color: #ff9800; font-size: 2rem;"></i>
                                    @elseif($registro->estado == 'justificado')
                                        <i class="fas fa-file-alt" style="color: #1565c0; font-size: 2rem;"></i>
                                    @else
                                        <i class="fas fa-question-circle" style="color: #9e9e9e; font-size: 2rem;"></i>
                                    @endif
                                </div>
                                <div class="small">
                                    @if($registro->hora_entrada)
                                        <div><strong>Entrada:</strong> {{ \Carbon\Carbon::parse($registro->hora_entrada)->format('h:i A') }}</div>
                                    @endif
                                    @if($registro->hora_salida)
                                        <div><strong>Salida:</strong> {{ \Carbon\Carbon::parse($registro->hora_salida)->format('h:i A') }}</div>
                                    @endif
                                    @if($registro->observacion)
                                        <div class="text-muted mt-1"><small>{{ $registro->observacion }}</small></div>
                                    @endif
                                </div>
                                <span class="badge {{ $registro->estado == 'presente' ? 'badge-presente' : ($registro->estado == 'tarde' ? 'badge-tarde' : 'badge-justificado') }} mt-2">
                                    {{ ucfirst($registro->estado) }}
                                </span>
                            @else
                                <div class="estado-icono">
                                    <i class="fas fa-question-circle" style="color: #9e9e9e; font-size: 2rem;"></i>
                                </div>
                                <span class="badge badge-ausente">Ausente</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Historial de Asistencia -->
    <div class="card">
        <div class="card-header">
            <i class="fas fa-history"></i> Historial de Asistencia
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="asistenciaTable">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Personal</th>
                            <th>Cargo</th>
                            <th>Hora Entrada</th>
                            <th>Hora Salida</th>
                            <th>Estado</th>
                            <th>Observación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registros as $registro)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}</td>
                            <td>{{ $registro->personal->nombre }} {{ $registro->personal->apellido }}</td>
                            <td>{{ $registro->personal->cargo }}</td>
                            <td>{{ $registro->hora_entrada ? \Carbon\Carbon::parse($registro->hora_entrada)->format('h:i A') : '--' }}</td>
                            <td>{{ $registro->hora_salida ? \Carbon\Carbon::parse($registro->hora_salida)->format('h:i A') : '--' }}</td>
                            <td>
                                @if($registro->estado == 'presente')
                                    <span class="badge badge-presente"> Presente</span>
                                @elseif($registro->estado == 'tarde')
                                    <span class="badge badge-tarde"> Tarde</span>
                                @elseif($registro->estado == 'ausente')
                                    <span class="badge badge-ausente"> Ausente</span>
                                @else
                                    <span class="badge badge-justificado"> Justificado</span>
                                @endif
                             </td>
                            <td>{{ $registro->observacion ?: '--' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-calendar-times fa-3x text-muted mb-2 d-block"></i>
                                <p>No hay registros de asistencia aún</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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
        // Verificar que la tabla existe y tiene datos
        var $table = $('#asistenciaTable');
        var $tbody = $table.find('tbody');
        var hasData = $tbody.find('tr').length > 0 && $tbody.find('td[colspan]').length === 0;
        
        if (hasData) {
            try {
                $table.DataTable({
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay datos disponibles en la tabla",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                        "infoEmpty": "Mostrando 0 registros",
                        "infoFiltered": "(filtrado de _MAX_ registros totales)",
                        "lengthMenu": "Mostrar _MENU_ registros",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "No se encontraron registros coincidentes",
                        "paginate": {
                            "first": "Primero",
                            "last": "Último",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        },
                        "aria": {
                            "sortAscending": ": activar para ordenar columna ascendente",
                            "sortDescending": ": activar para ordenar columna descendente"
                        }
                    },
                    order: [[0, 'desc']],
                    pageLength: 15,
                    responsive: true
                });
            } catch(e) {
                console.log('Error al inicializar DataTable:', e);
            }
        }
    });
</script>

</body>
</html>