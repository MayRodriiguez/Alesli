<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel Personal - Alesli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #fef5f7 0%, #fce4ec 100%); min-height: 100vh; }
        
        .navbar {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            padding: 15px 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-family: 'Dancing Script', cursive;
            font-size: 1.8rem;
            color: white !important;
        }
        
        .navbar-brand i { margin-right: 10px; }
        .nav-link { color: white !important; font-weight: 500; transition: all 0.3s ease; }
        .nav-link:hover { transform: translateY(-2px); }
        
        .main-content { padding: 30px; min-height: calc(100vh - 80px); }
        
        .welcome-card {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            border-radius: 25px;
            padding: 35px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.15); }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #fce4ec, #f3e5f5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }
        
        .stat-icon i { font-size: 1.8rem; color: #c2185b; }
        .stat-card h3 { font-size: 1.8rem; font-weight: 700; color: #c2185b; margin: 0; }
        .stat-card p { color: #888; margin: 0; font-size: 0.8rem; }
        
        .card {
            border: none;
            border-radius: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 30px;
            overflow: hidden;
        }
        
        .card-header {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            color: white;
            padding: 18px 25px;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .btn-entrada {
            background: linear-gradient(135deg, #2e7d32, #43a047);
            border: none;
            border-radius: 50px;
            padding: 14px 30px;
            font-weight: 600;
            width: 100%;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .btn-salida {
            background: linear-gradient(135deg, #c62828, #e53935);
            border: none;
            border-radius: 50px;
            padding: 14px 30px;
            font-weight: 600;
            width: 100%;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .btn-entrada:hover, .btn-salida:hover { transform: translateY(-2px); }
        
        .badge-presente { background: #2e7d32; }
        .badge-tarde { background: #ff9800; }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .info-item i { width: 30px; color: #c2185b; font-size: 1.1rem; }
        .info-item strong { color: #555; }
        .info-item span { color: #888; }
        
        .table { vertical-align: middle; }
        .table thead { background: linear-gradient(135deg, #fce4ec, #f3e5f5); }
        
        .footer {
            background: linear-gradient(135deg, #c2185b, #6a1b9a);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 30px;
        }
        
        @media (max-width: 768px) {
            .main-content { padding: 15px; }
            .stats-row { grid-template-columns: repeat(2, 1fr); }
            .welcome-card { padding: 20px; text-align: center; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('personal.dashboard') }}">
            <i class="fas fa-flower"></i> Flores
        </a>
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

<div class="main-content">
    <div class="container">
        <!-- Tarjeta de bienvenida -->
        <div class="welcome-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2><i class="fas fa-smile-wink"></i> ¡Hola, {{ $personal->nombre }}!</h2>
                    <p class="mb-0">Bienvenido a tu panel de trabajo. Registra tu asistencia diaria.</p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="fas fa-user-circle fa-4x"></i>
                    <p class="mb-0 mt-2"><strong>{{ $personal->cargo }}</strong></p>
                </div>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                <h3>{{ $totalDias }}</h3>
                <p>Días Trabajados</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <h3>{{ $diasPresente }}</h3>
                <p>Días Presente</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-times-circle"></i></div>
                <h3>{{ $diasAusente }}</h3>
                <p>Días Ausente</p>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-clock"></i></div>
                <h3>{{ $horasTrabajadas }}</h3>
                <p>Horas Trabajadas</p>
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

        <div class="row">
            <!-- Registro de Asistencia -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-clock"></i> Registro de Asistencia
                    </div>
                    <div class="card-body text-center">
                        @if(!$asistenciaHoy)
                            <form action="{{ route('personal.marcar-entrada') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-entrada">
                                    <i class="fas fa-sign-in-alt"></i> Marcar Entrada
                                </button>
                            </form>
                            <p class="text-muted mt-3 small">
                                Horario: {{ substr($personal->hora_entrada, 0, 5) }} - {{ substr($personal->hora_salida, 0, 5) }}
                            </p>
                        @elseif(!$asistenciaHoy->hora_salida)
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> 
                                Entrada registrada: <strong>{{ \Carbon\Carbon::parse($asistenciaHoy->hora_entrada)->format('h:i A') }}</strong>
                                <br>
                                <span class="badge {{ $asistenciaHoy->estado == 'presente' ? 'badge-presente' : 'badge-tarde' }} mt-2">
                                    {{ $asistenciaHoy->estado == 'presente' ? ' A tiempo' : ' Llegaste tarde' }}
                                </span>
                            </div>
                            <form action="{{ route('personal.marcar-salida') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-salida">
                                    <i class="fas fa-sign-out-alt"></i> Marcar Salida
                                </button>
                            </form>
                        @else
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> Jornada completada<br>
                                <small>Entrada: {{ \Carbon\Carbon::parse($asistenciaHoy->hora_entrada)->format('h:i A') }}</small><br>
                                <small>Salida: {{ \Carbon\Carbon::parse($asistenciaHoy->hora_salida)->format('h:i A') }}</small>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Información Personal -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-id-card"></i> Mi Información
                    </div>
                    <div class="card-body">
                        <div class="info-item">
                            <i class="fas fa-user"></i>
                            <strong>Nombre:</strong>
                            <span>{{ $personal->nombre }} {{ $personal->apellido }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-envelope"></i>
                            <strong>Email:</strong>
                            <span>{{ $personal->email }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-phone"></i>
                            <strong>Teléfono:</strong>
                            <span>{{ $personal->telefono }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-briefcase"></i>
                            <strong>Cargo:</strong>
                            <span>{{ $personal->cargo }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-calendar-alt"></i>
                            <strong>Contratación:</strong>
                            <span>{{ \Carbon\Carbon::parse($personal->fecha_contratacion)->format('d/m/Y') }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-dollar-sign"></i>
                            <strong>Salario:</strong>
                            <span class="fw-bold" style="color: #c2185b;">Bs. {{ number_format($personal->salario, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historial de Asistencia de la Semana -->
        @if($asistenciaSemana->count() > 0)
        <div class="card">
            <div class="card-header">
                <i class="fas fa-history"></i> Asistencia de la Semana
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($asistenciaSemana as $registro)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($registro->fecha)->format('d/m/Y') }}</td>
                                <td>{{ $registro->hora_entrada ? \Carbon\Carbon::parse($registro->hora_entrada)->format('h:i A') : '--' }}</td>
                                <td>{{ $registro->hora_salida ? \Carbon\Carbon::parse($registro->hora_salida)->format('h:i A') : '--' }}</td>
                                <td>
                                    @if($registro->estado == 'presente')
                                        <span class="badge badge-presente"> Presente</span>
                                    @elseif($registro->estado == 'tarde')
                                        <span class="badge badge-tarde"> Tarde</span>
                                    @else
                                        <span class="badge bg-secondary"> Ausente</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="mb-0">&copy; 2020 Alesli - Naturalmente para ti. Todos los derechos reservados.</p>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>