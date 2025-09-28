<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>León Shoes - Factura #{{ $invoice->numero }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            .invoice-container { box-shadow: none !important; }
        }

        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border: 2px solid #2c3e50;
        }

        .invoice-header {
            background: linear-gradient(135deg, #e8f4f8 0%, #d4e4f7 100%);
            padding: 20px;
            border-bottom: 2px solid #2c3e50;
        }

        .company-info {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .company-logo {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-right: 15px;
        }

        .company-name {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2c3e50;
            margin: 0;
        }

        .header-info {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-top: 15px;
        }

        .info-field {
            border: 1px solid #2c3e50;
            padding: 8px;
            background: white;
        }

        .info-label {
            font-size: 0.9rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: bold;
            color: #000;
        }

        .tallas-section {
            padding: 20px;
            border-bottom: 2px solid #2c3e50;
        }

        .tallas-grid {
            display: grid;
            grid-template-columns: repeat(9, 1fr);
            gap: 1px;
            background: #2c3e50;
            border: 2px solid #2c3e50;
            margin-bottom: 10px;
        }

        .talla-cell {
            background: white;
            padding: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 0.9rem;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .talla-header {
            background: #f8f9fa;
            font-weight: bold;
            color: #2c3e50;
        }

        .total-section {
            background: #2c3e50;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .processes-section {
            padding: 20px;
        }

        .process-header {
            background: #2c3e50;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
            margin-bottom: 1px;
        }

        .process-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
            gap: 1px;
            background: #2c3e50;
            margin-bottom: 1px;
        }

        .process-cell {
            background: white;
            padding: 10px;
            border: none;
            font-weight: bold;
            color: #000;
        }

        .process-name {
            background: #f8f9fa;
            color: #2c3e50;
            font-weight: bold;
        }

        .process-number {
            color: #d63384;
            font-weight: bold;
        }

        .actions {
            padding: 20px;
            text-align: center;
            background: #f8f9fa;
        }
        .imagenlogo {
            height: 100px;
            width: auto;
            margin-right: 15px;
            object-fit: contain;
        }
        
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <div class="company-info">
               <img src="{{ asset('images/logoleon.jpg') }}" alt="León Shoes Logo" class="imagenlogo">
                <h1 class="company-name">LEÓN SHOES</h1>
                <div class="ms-auto">
                    <div class="info-field" style="width: 120px;">
                        <div class="info-label">No</div>
                        <div class="info-value" style="color: #d63384;">{{ $invoice->numero }}</div>
                    </div>
                </div>
            </div>
            
            <div class="header-info">
                <div class="info-field">
                    <div class="info-label">FECHA</div>
                    <div class="info-value">{{ $invoice->fecha->format('d/m/Y') }}</div>
                </div>
                <div class="info-field">
                    <div class="info-label">COD. REFERENCIA</div>
                    <div class="info-value">{{ $invoice->cod_referencia ?? '' }}</div>
                </div>
                <div class="info-field">
                    <div class="info-label">No. TAREA</div>
                    <div class="info-value">{{ $invoice->no_tarea ?? '' }}</div>
                </div>
            </div>
        </div>

        <!-- Tallas Section -->
        <div class="tallas-section">
            <!-- Primera fila de tallas (21-29) -->
            <div class="tallas-grid">
                @for($talla = 21; $talla <= 29; $talla++)
                    <div class="talla-cell talla-header">{{ $talla }}</div>
                @endfor
            </div>
            <div class="tallas-grid">
                @for($talla = 21; $talla <= 29; $talla++)
                    <div class="talla-cell">{{ $invoice->tallas[$talla] ?? 0 }}</div>
                @endfor
            </div>

            <!-- Segunda fila de tallas (30-38) -->
            <div class="tallas-grid">
                @for($talla = 30; $talla <= 38; $talla++)
                    <div class="talla-cell talla-header">{{ $talla }}</div>
                @endfor
            </div>
            <div class="tallas-grid">
                @for($talla = 30; $talla <= 38; $talla++)
                    <div class="talla-cell">{{ $invoice->tallas[$talla] ?? 0 }}</div>
                @endfor
            </div>

            <!-- Tercera fila de tallas (39-43) -->
            <div class="tallas-grid" style="grid-template-columns: repeat(5, 1fr) 2fr;">
                @for($talla = 39; $talla <= 43; $talla++)
                    <div class="talla-cell talla-header">{{ $talla }}</div>
                @endfor
                <div class="talla-cell talla-header">TOTAL</div>
            </div>
            <div class="tallas-grid" style="grid-template-columns: repeat(5, 1fr) 2fr;">
                @for($talla = 39; $talla <= 43; $talla++)
                    <div class="talla-cell">{{ $invoice->tallas[$talla] ?? 0 }}</div>
                @endfor
                <div class="total-section">{{ $invoice->total }}</div>
            </div>
        </div>

        <!-- Processes Section -->
        @if($invoice->processes->count() > 0)
            <div class="processes-section">
                <div class="process-header">PROCESOS</div>
                
                <div class="process-row">
                    <div class="process-cell process-name">PROCESO</div>
                    <div class="process-cell process-name">No.</div>
                    <div class="process-cell process-name">No. TAREA</div>
                    <div class="process-cell process-name">REF.</div>
                    <div class="process-cell process-name">CANT.</div>
                </div>

                @foreach($invoice->processes as $process)
                    <div class="process-row">
                        <div class="process-cell">{{ $process->proceso }}</div>
                        <div class="process-cell process-number">{{ $process->numero }}</div>
                        <div class="process-cell">{{ $process->no_tarea ?? '' }}</div>
                        <div class="process-cell">{{ $process->ref ?? '' }}</div>
                        <div class="process-cell">{{ $process->cant ?? '' }}</div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Actions -->
        <div class="actions no-print">
            <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-warning btn-lg me-2">
                <i class="fas fa-edit me-2"></i>Editar
            </a>
            <button onclick="window.print()" class="btn btn-info btn-lg me-2">
                <i class="fas fa-print me-2"></i>Imprimir
            </button>
            <a href="{{ route('invoices.index') }}" class="btn btn-secondary btn-lg">
                <i class="fas fa-arrow-left me-2"></i>Volver
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>