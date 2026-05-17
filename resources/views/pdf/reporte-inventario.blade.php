{{-- resources/views/pdf/reporte-inventario.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Inventario - Flores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #ff69b4;
        }
        h1 {
            color: #8b008b;
        }
        .stats {
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        .stat-box {
            display: inline-block;
            width: 23%;
            margin: 10px;
            padding: 10px;
            text-align: center;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: linear-gradient(135deg, #ff69b4, #9370db);
            color: white;
        }
        .disponible {
            color: green;
            font-weight: bold;
        }
        .agotado {
            color: red;
            font-weight: bold;
        }
        .reserva {
            color: orange;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">🌸 Flores - Florería Elegante</div>
        <h1>Reporte de Inventario</h1>
        <p>Generado: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="stats">
        <div class="stat-box">
            <h3>Total Productos</h3>
            <p>{{ $productos->count() }}</p>
        </div>
        <div class="stat-box">
            <h3>Disponibles</h3>
            <p class="disponible">{{ $productos->where('estado', 'disponible')->count() }}</p>
        </div>
        <div class="stat-box">
            <h3>Agotados</h3>
            <p class="agotado">{{ $productos->where('estado', 'agotado')->count() }}</p>
        </div>
        <div class="stat-box">
            <h3>En Reserva</h3>
            <p class="reserva">{{ $productos->where('estado', 'reserva')->count() }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Stock Mínimo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ Str::limit($producto->descripcion, 60) }}</td>
                <td>${{ number_format($producto->precio, 2) }}</td>
                <td>{{ $producto->stock }}</td>
                <td>{{ $producto->stock_minimo }}</td>
                <td class="{{ $producto->estado }}">
                    {{ ucfirst($producto->estado) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Flores - Arreglos florales para toda ocasión</p>
        <p>* Este reporte es confidencial solo para administradores *</p>
    </div>
</body>
</html>