<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Códigos de Barras</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            margin: 15mm;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        .variant-group {
            page-break-inside: avoid;
            margin-bottom: 20px;
        }

        .variant-header {
            background-color: #f3f4f6;
            padding: 10px 15px;
            margin-bottom: 15px;
            border-left: 4px solid #3b82f6;
            page-break-after: avoid;
        }

        .variant-name {
            font-size: 14px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 3px;
        }

        .variant-features {
            font-size: 10px;
            color: #6b7280;
        }

        .barcodes-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .barcode-item {
            text-align: center;
            padding: 10px;
            border: 1px solid #e5e7eb;
            border-radius: 4px;
            page-break-inside: avoid;
            background-color: #ffffff;
        }

        .barcode-image {
            margin: 8px auto;
            display: block;
            max-width: 100%;
            height: auto;
        }

        .sku-text {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1.5px;
            margin-top: 5px;
            color: #111827;
            font-family: 'Courier New', monospace;
        }

        .page-break {
            page-break-before: always;
        }

        /* Alternativa: 5 columnas si prefieres más códigos por fila */
        /* .barcodes-grid {
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
        } */
    </style>
</head>
<body>
    @foreach($barcodes as $barcodeGroup)
        <div class="variant-group">
            <!-- Header de la variante (solo una vez) -->
            <div class="variant-header">
                <div class="variant-name">{{ $barcodeGroup['variant_name'] }}</div>
                @if(!empty($barcodeGroup['features']))
                    <div class="variant-features">{{ $barcodeGroup['features'] }}</div>
                @endif
            </div>

            <!-- Grid de códigos de barras -->
            <div class="barcodes-grid">
                @for($i = 0; $i < $barcodeGroup['quantity']; $i++)
                    <div class="barcode-item">
                        <img src="data:image/png;base64,{{ $barcodeGroup['barcode'] }}"
                             alt="Código de barras"
                             class="barcode-image">
                        <div class="sku-text">{{ $barcodeGroup['sku'] }}</div>
                    </div>
                @endfor
            </div>
        </div>
    @endforeach
</body>
</html>
