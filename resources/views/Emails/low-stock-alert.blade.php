<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #ffc107;
            color: #000;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .alert {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .product-info {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .product-info p {
            margin: 10px 0;
        }
        .stock-critical {
            color: #dc3545;
            font-weight: bold;
            font-size: 1.2em;
        }
        .stock-low {
            color: #fd7e14;
            font-weight: bold;
            font-size: 1.2em;
        }
        .label {
            font-weight: bold;
            color: #666;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin: 0;">⚠️ Alerta de Stock Bajo</h1>
        </div>

        <div class="content">
            <div class="alert">
                <p><strong>Se ha detectado que el siguiente producto tiene stock por debajo del mínimo establecido:</strong></p>
            </div>

            <div class="product-info">
                <p><span class="label">📦 Producto:</span> {{ $productName }}</p>
                <p><span class="label">🏷️ SKU:</span> {{ $sku }}</p>
                <p>
                    <span class="label">📊 Stock actual:</span>
                    <span class="{{ $currentStock == 0 ? 'stock-critical' : 'stock-low' }}">
                        {{ $currentStock }} {{ $currentStock == 1 ? 'unidad' : 'unidades' }}
                    </span>
                </p>
                <p><span class="label">⚡ Stock mínimo:</span> {{ $minimumStock }} {{ $minimumStock == 1 ? 'unidad' : 'unidades' }}</p>
            </div>

            @if($currentStock == 0)
                <div style="background-color: #f8d7da; border-left: 4px solid #dc3545; padding: 15px; margin: 20px 0; border-radius: 4px;">
                    <p style="color: #721c24; font-weight: bold; margin: 0;">
                        🚨 ¡PRODUCTO SIN STOCK! Se requiere compra urgente.
                    </p>
                </div>
            @else
                <div style="background-color: #fff3cd; border-left: 4px solid #fd7e14; padding: 15px; margin: 20px 0; border-radius: 4px;">
                    <p style="color: #856404; font-weight: bold; margin: 0;">
                        ⚠️ Stock bajo. Se recomienda realizar pedido pronto.
                    </p>
                </div>
            @endif

            <p style="margin-top: 30px;">Por favor, procede a realizar la compra correspondiente para reponer el inventario.</p>
        </div>

        <div class="footer">
            <p>Este es un correo automático generado por el sistema de gestión de inventario.</p>
            <p>© {{ date('Y') }} {{ config('app.name') }}</p>
        </div>
    </div>
</body>
</html>
