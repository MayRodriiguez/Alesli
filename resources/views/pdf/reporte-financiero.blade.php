{{-- resources/views/pdf/reporte-financiero.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Financiero - Flores</title>
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
        .logo {
            font-size: 24px;
            color: #ff1493;
        }
        h1 {
            color: #8b008b;
        }
        .summary {
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        .summary-item {
            display: inline-block;
            width: 30%;
            margin: 10px;
            padding: 10px;
            text-align: center;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .summary-item h3 {
            margin: 0;
            color: #ff1493;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: linear-gradient(135deg, #ff69b4, #9370db);
            color: white;
        }
        tr:hover {
            background: #ffd1dc;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #666;
        }
        .ingreso {
            color: green;
            font-weight: bold;
        }
        .egreso {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">🌸 Flores - Florería Elegante</div>
        <h1>Reporte Financiero</h1>
        <p>Generado: {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <h3>Ingresos Totales</h3>
            <p class="ingreso">${{ number_format($ingresos, 2) }}</p>
        </div>
        <div class="summary-item">
            <h3>Egresos Totales</h3>
            <p class="egreso">${{ number_format($egresos, 2) }}</p>
        </div>
        <div class="summary-item">
            <h3>Balance Total</h3>
            <p style="color: {{ $total >= 0 ? 'green' : 'red' }}; font-weight: bold;">
                ${{ number_format($total, 2) }}
            </p>
        </div>
    </div>

    <h2>Detalle de Transacciones</h2>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Concepto</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transacciones as $transaccion)
            <tr>
                <td>{{ $transaccion->fecha_transaccion->format('d/m/Y H:i') }}</td>
                <td>{{ ucfirst($transaccion->tipo) }}</td>
                <td>{{ $transaccion->concepto }}</td>
                <td class="{{ $transaccion->tipo == 'ingreso' ? 'ingreso' : 'egreso' }}">
                    ${{ number_format($transaccion->monto, 2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Flores - Emprendimiento familiar desde 2020</p>
        <p>Teléfono: +123 456 7890 | Email: info@flores.com</p>
    </div>
</body>
</html>