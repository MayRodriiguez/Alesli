<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - Alesli - Naturalmente para ti</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100%;
            background: linear-gradient(180deg, #ff1493 0%, #8b008b 100%);
            color: white;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 2px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .sidebar-header i {
            font-size: 3rem;
            margin-bottom: 10px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .sidebar-header h3 {
            font-family: 'Dancing Script', cursive;
            font-size: 1.8rem;
            margin: 0;
        }

        .sidebar-header p {
            font-size: 0.75rem;
            opacity: 0.8;
            margin-top: 5px;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            margin: 5px 15px;
            border-radius: 12px;
        }

        .sidebar-menu a i {
            width: 30px;
            font-size: 1.2rem;
        }

        .sidebar-menu a span {
            margin-left: 10px;
        }

        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.2);
            transform: translateX(5px);
        }

        .sidebar-menu a.active {
            background: rgba(255,255,255,0.25);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .logout-btn {
            position: absolute;
            bottom: 20px;
            width: calc(100% - 30px);
            margin: 0 15px;
            background: rgba(255,255,255,0.15);
            border: none;
            color: white;
            padding: 12px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: rgba(255,255,255,0.3);
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 20px;
            transition: all 0.3s ease;
        }

        /* Top Bar */
        .top-bar {
            background: white;
            border-radius: 20px;
            padding: 15px 25px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .page-title h2 {
            font-size: 1.5rem;
            margin: 0;
            color: #333;
        }

        .page-title p {
            font-size: 0.85rem;
            color: #888;
            margin: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info .avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #ff1493, #8b008b);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
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
            background: linear-gradient(90deg, #ff1493, #8b008b);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ffd1dc, #9370db);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .stat-icon i {
            font-size: 1.8rem;
            color: #ff1493;
        }

        .stat-info h3 {
            font-size: 2rem;
            margin: 0;
            color: #333;
        }

        .stat-info p {
            color: #888;
            margin: 0;
            font-size: 0.85rem;
        }

        .stat-trend {
            margin-top: 10px;
            font-size: 0.8rem;
        }

        .trend-up { color: #28a745; }
        .trend-down { color: #dc3545; }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .chart-card h4 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Recent Activity */
        .activity-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .activity-icon i {
            color: #ff1493;
        }

        .activity-detail {
            flex: 1;
        }

        .activity-detail p {
            margin: 0;
            font-size: 0.9rem;
        }

        .activity-time {
            font-size: 0.7rem;
            color: #888;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                left: -280px;
            }
            .main-content {
                margin-left: 0;
            }
            .charts-section {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <i class="fas fa-flower"></i>
        <h3>Alesli</h3>
        <p>Panel de Administración</p>
    </div>
    
    <div class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}" class="active">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.inventario') }}">
            <i class="fas fa-boxes"></i>
            <span>Inventario</span>
        </a>
        <a href="{{ route('admin.personal') }}">
            <i class="fas fa-users"></i>
            <span>Personal</span>
        </a>
        <a href="{{ route('admin.asistencia') }}">
            <i class="fas fa-clock"></i>
            <span>Asistencia</span>
        </a>
        <a href="{{ route('admin.finanzas') }}">
            <i class="fas fa-chart-line"></i>
            <span>Finanzas</span>
        </a>
        <a href="{{ route('admin.clientes') }}">
            <i class="fas fa-user-friends"></i>
            <span>Clientes</span>
        </a>
        <a href="{{ route('admin.promociones') }}">
            <i class="fas fa-tags"></i>
            <span>Promociones</span>
        </a>
        <a href="{{ route('admin.cursos') }}">
            <i class="fas fa-graduation-cap"></i>
            <span>Cursos</span>
        </a>
        <a href="{{ route('admin.eventos') }}">
            <i class="fas fa-calendar-alt"></i>
            <span>Eventos</span>
        </a>
    </div>
    
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </button>
    </form>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="page-title">
            <h2>Dashboard</h2>
            <p>Bienvenido de vuelta, {{ auth()->user()->name }}</p>
        </div>
        <div class="user-info">
            <div class="avatar">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <strong>{{ auth()->user()->name }}</strong>
                <small class="d-block text-muted">Administrador</small>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-boxes"></i>
            </div>
            <div class="stat-info">
                <h3>24</h3>
                <p>Productos Totales</p>
            </div>
            <div class="stat-trend">
                <span class="trend-up"><i class="fas fa-arrow-up"></i> +5 este mes</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>3</h3>
                <p>Personal Activo</p>
            </div>
            <div class="stat-trend">
                <span class="trend-up"><i class="fas fa-arrow-up"></i> Equipo completo</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-info">
                <h3>15</h3>
                <p>Pedidos Hoy</p>
            </div>
            <div class="stat-trend">
                <span class="trend-up"><i class="fas fa-arrow-up"></i> +8 vs ayer</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="Bs."></i>
            </div>
            <div class="stat-info">
                <h3>Bs. 1,250</h3>
                <p>Ingresos Hoy</p>
            </div>
            <div class="stat-trend">
                <span class="trend-up"><i class="fas fa-arrow-up"></i> +15% vs ayer</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-info">
                <h3>Bs. 15,420</h3>
                <p>Ingresos Mensuales</p>
            </div>
            <div class="stat-trend">
                <span class="trend-up"><i class="fas fa-arrow-up"></i> +22% este mes</span>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="stat-info">
                <h3>156</h3>
                <p>Clientes Registrados</p>
            </div>
            <div class="stat-trend">
                <span class="trend-up"><i class="fas fa-arrow-up"></i> +12 nuevos</span>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-section">
        <div class="chart-card">
            <h4><i class="fas fa-chart-bar" style="color: #ff1493;"></i> Ventas del Mes</h4>
            <canvas id="salesChart" height="200"></canvas>
        </div>
        
        <div class="chart-card">
            <h4><i class="fas fa-chart-pie" style="color: #ff1493;"></i> Productos Más Vendidos</h4>
            <canvas id="productsChart" height="200"></canvas>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="activity-card">
        <h4><i class="fas fa-clock" style="color: #ff1493;"></i> Actividad Reciente</h4>
        <div class="activity-item">
            <div class="activity-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="activity-detail">
                <p><strong>Nuevo pedido</strong> - Ramo de Rosas Rojas</p>
                <small>Cliente: María González</small>
            </div>
            <div class="activity-time">Hace 5 min</div>
        </div>
        <div class="activity-item">
            <div class="activity-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <div class="activity-detail">
                <p><strong>Nuevo cliente registrado</strong> - Carlos López</p>
                <small>Se registró en la plataforma</small>
            </div>
            <div class="activity-time">Hace 15 min</div>
        </div>
        <div class="activity-item">
            <div class="activity-icon">
                <i class="fas fa-box"></i>
            </div>
            <div class="activity-detail">
                <p><strong>Stock actualizado</strong> - Arreglo de Orquídeas</p>
                <small>Quedan 8 unidades</small>
            </div>
            <div class="activity-time">Hace 1 hora</div>
        </div>
        <div class="activity-item">
            <div class="activity-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="activity-detail">
                <p><strong>Nueva inscripción</strong> - Curso de Arreglos</p>
                <small>Ana Torres se inscribió</small>
            </div>
            <div class="activity-time">Hace 2 horas</div>
        </div>
    </div>
</div>

<script>
    // Gráfico de ventas mensuales
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            datasets: [{
                label: 'Ventas (Bs)',
                data: [8500, 9200, 10100, 9800, 11200, 12500, 14200, 13800, 15100, 16200, 14800, 15420],
                borderColor: '#ff1493',
                backgroundColor: 'rgba(255, 20, 147, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Gráfico de productos más vendidos
    const ctx2 = document.getElementById('productsChart').getContext('2d');
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: ['Ramos de Rosas', 'Arreglos Orquídeas', 'Centros de Mesa', 'Cajas Sorpresa', 'Ramos Novia'],
            datasets: [{
                data: [35, 25, 20, 12, 8],
                backgroundColor: ['#ff1493', '#ff69b4', '#9370db', '#dc143c', '#8b008b'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>