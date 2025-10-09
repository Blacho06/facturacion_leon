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
            
            /* Colores sólidos para impresión que sí funcionan */
            .talla-header {
                background: #007bff !important;
                color: #ffffff !important;
                border: 2px solid #0056b3 !important;
                font-weight: bold !important;
            }
            
            .talla-value {
                background: #f8f9fa !important;
                color: #2c3e50 !important;
                border: 2px solid #dee2e6 !important;
                font-weight: bold !important;
            }
            
            .total-section {
                background: #28a745 !important;
                color: #ffffff !important;
                border: 2px solid #1e7e34 !important;
                font-weight: bold !important;
            }
            
            .info-value {
                color: #000000 !important;
                font-weight: bold !important;
            }
            
            .company-name {
                color: #000000 !important;
                font-weight: bold !important;
            }

            .price-container {
                background: #007bff !important;
                border: 2px solid #004085 !important;
                box-shadow: none !important;
            }

            .price-label {
                color: #ffffff !important;
                font-weight: bold !important;
            }

            .currency-symbol {
                color: #ffffff !important;
                font-weight: bold !important;
                text-shadow: none !important;
            }

            .price-input {
                background: #ffffff !important;
                border: 2px solid #000000 !important;
                color: #000000 !important;
                font-weight: bold !important;
                box-shadow: none !important;
            }
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
            gap: 10px;
            margin-bottom: 20px;
        }

        .talla-cell {
            background: white;
            padding: 15px 8px;
            text-align: center;
            font-weight: bold;
            font-size: 1rem;
            min-height: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .talla-header {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            border: 2px solid #007bff;
            box-shadow: 0 2px 4px rgba(0,123,255,0.3);
        }

        .talla-value {
            background: #f8f9fa;
            color: #2c3e50;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .total-section {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 1.4rem;
            font-weight: bold;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(40,167,69,0.3);
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

        .price-section {
            padding: 20px;
            border-bottom: 2px solid #2c3e50;
        }

        .price-container {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: 2px solid #004085;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,123,255,0.3);
            max-width: 400px;
            margin: 0 auto;
        }

        .price-label {
            color: #ffffff;
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .price-input-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .currency-symbol {
            color: #ffffff;
            font-size: 1.2rem;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .price-input {
            background: rgba(255,255,255,0.95);
            border: 2px solid #ffffff;
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 1.2rem;
            font-weight: bold;
            text-align: center;
            color: #2c3e50;
            width: 180px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.2);
        }

        .price-input:focus {
            outline: none;
            border-color: #ffc107;
            box-shadow: 0 0 0 3px rgba(255,193,7,0.3);
        }

        .price-input::placeholder {
            color: #6c757d;
            font-weight: normal;
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
                    <div class="info-label">COLOR</div>
                    <div class="info-value">{{ $invoice->color ?? '' }}</div>
                </div>
            </div>
            <div class="header-info mt-2">
                <div class="info-field">
                    <div class="info-label">NOMBRE CLIENTE</div>
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
                    <div class="talla-cell talla-value">{{ $invoice->tallas[$talla] ?? 0 }}</div>
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
                    <div class="talla-cell talla-value">{{ $invoice->tallas[$talla] ?? 0 }}</div>
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
                    <div class="talla-cell talla-value">{{ $invoice->tallas[$talla] ?? 0 }}</div>
                @endfor
                <div class="total-section">{{ $invoice->total }}</div>
            </div>
        </div>


        <!-- Sección de Precio Total -->
        <div class="price-section">
            <div class="price-container">
                <div class="price-label">PRECIO TOTAL:</div>
                <div class="price-input-container">
                    <span class="currency-symbol">$</span>
                    <input type="text" id="total-price" class="price-input" placeholder="0" maxlength="15" value="{{ $invoice->precio_total ? number_format($invoice->precio_total, 0, ',', '.') : '' }}">
                </div>
            </div>
        </div>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceInput = document.getElementById('total-price');
            
            // Función para formatear número con puntos
            function formatNumber(num) {
                // Remover todos los caracteres que no sean números
                const cleanNum = num.replace(/\D/g, '');
                
                // Formatear con puntos cada 3 dígitos
                return cleanNum.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
            
            // Función para obtener el valor numérico limpio
            function getCleanValue(formattedValue) {
                return formattedValue.replace(/\./g, '');
            }
            
            // Evento para formatear mientras el usuario escribe
            priceInput.addEventListener('input', function(e) {
                const cursorPosition = e.target.selectionStart;
                const oldValue = e.target.value;
                const oldLength = oldValue.length;
                
                // Formatear el valor
                const formattedValue = formatNumber(e.target.value);
                
                // Actualizar el input
                e.target.value = formattedValue;
                
                // Ajustar la posición del cursor
                const newLength = formattedValue.length;
                const lengthDiff = newLength - oldLength;
                const newCursorPosition = cursorPosition + lengthDiff;
                
                // Posicionar el cursor
                setTimeout(() => {
                    e.target.setSelectionRange(newCursorPosition, newCursorPosition);
                }, 0);
            });
            
            // Prevenir que se pegue texto no numérico
            priceInput.addEventListener('paste', function(e) {
                e.preventDefault();
                const paste = (e.clipboardData || window.clipboardData).getData('text');
                const cleanPaste = paste.replace(/\D/g, '');
                if (cleanPaste) {
                    const formattedPaste = formatNumber(cleanPaste);
                    e.target.value = formattedPaste;
                }
            });
            
            // Solo permitir números y backspace
            priceInput.addEventListener('keydown', function(e) {
                // Permitir: backspace, delete, tab, escape, enter, home, end, left, right, up, down
                if ([8, 9, 27, 13, 46, 35, 36, 37, 38, 39, 40].indexOf(e.keyCode) !== -1 ||
                    // Permitir Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                    (e.keyCode === 65 && e.ctrlKey === true) ||
                    (e.keyCode === 67 && e.ctrlKey === true) ||
                    (e.keyCode === 86 && e.ctrlKey === true) ||
                    (e.keyCode === 88 && e.ctrlKey === true)) {
                    return;
                }
                // Asegurar que es un número
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>