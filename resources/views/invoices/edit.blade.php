<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>León Shoes - Editar Factura #{{ $invoice->numero }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .invoice-header {
            border: 2px solid #2c3e50;
            background: linear-gradient(135deg, #e8f4f8 0%, #d4e4f7 100%);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .tallas-grid {
            display: grid;
            grid-template-columns: repeat(9, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .talla-input {
            text-align: center;
        }
        
        .imagenlogo {
            height: 100px;
            width: auto;
            margin-right: 15px;
            object-fit: contain;
        }

        /* Estilos para los modales personalizados */
        .modal-content {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            border: none;
        }

        .modal-header {
            border-radius: 15px 15px 0 0;
            border-bottom: none;
            padding: 20px 25px;
        }

        .modal-body {
            padding: 25px;
        }

        .modal-footer {
            border-top: none;
            padding: 20px 25px;
            border-radius: 0 0 15px 15px;
        }

        .modal-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .form-control-lg {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .form-control-lg:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
        }

        .form-control-lg.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220,53,69,0.25);
        }        
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="invoice-header">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/logoleon.jpg') }}" alt="León Shoes Logo" class="imagenlogo">
                                <div>
                                    <h3 class="mb-0 text-primary">LEÓN SHOES</h3>
                                    <small class="text-muted">Editando Factura</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">No.</label>
                                    <input type="text" class="form-control" id="header_numero" value="{{ $invoice->numero }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">FECHA</label>
                                    <input type="date" class="form-control" id="header_fecha" value="{{ $invoice->fecha->format('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">COD. REFERENCIA <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select id="header_ref_select" class="form-select" required>
                                            <option value="">Seleccione una referencia...</option>
                                        </select>
                                        <button type="button" class="btn btn-primary" id="btn_add_ref" title="Agregar referencia">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">COLOR <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select id="header_color_select" class="form-select" required>
                                            <option value="">Seleccione un color...</option>
                                        </select>
                                        <button type="button" class="btn btn-primary" id="btn_add_color" title="Agregar color">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">NOMBRE CLIENTE <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="header_no_tarea" value="{{ $invoice->no_tarea }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('invoices.update', $invoice->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <!-- Campos ocultos para copiar valores del header -->
                    <input type="hidden" name="numero" id="hidden_numero" value="{{ $invoice->numero }}">
                    <input type="hidden" name="fecha" id="hidden_fecha" value="{{ $invoice->fecha->format('Y-m-d') }}">
                    <input type="hidden" name="cod_referencia" id="hidden_cod_referencia" value="{{ $invoice->cod_referencia }}">
                    <input type="hidden" name="color" id="hidden_color" value="{{ $invoice->color ?? '' }}">
                    <input type="hidden" name="no_tarea" id="hidden_no_tarea" value="{{ $invoice->no_tarea }}">
                    <input type="hidden" name="precio_total" id="hidden_precio_total" value="{{ $invoice->precio_total ?? '' }}">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Sección de Tallas -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-ruler me-2"></i>Tallas</h5>
                        </div>
                        <div class="card-body">
                            <div class="tallas-grid">
                                @for($talla = 21; $talla <= 29; $talla++)
                                    <div><strong>{{ $talla }}</strong><input type="number" class="form-control talla-input" name="tallas[{{ $talla }}]" min="0" value="{{ $invoice->tallas[$talla] ?? 0 }}"></div>
                                @endfor
                            </div>
                            <div class="tallas-grid">
                                @for($talla = 30; $talla <= 38; $talla++)
                                    <div><strong>{{ $talla }}</strong><input type="number" class="form-control talla-input" name="tallas[{{ $talla }}]" min="0" value="{{ $invoice->tallas[$talla] ?? 0 }}"></div>
                                @endfor
                            </div>
                            <div class="tallas-grid" style="grid-template-columns: repeat(6, 1fr);">
                                @for($talla = 39; $talla <= 43; $talla++)
                                    <div><strong>{{ $talla }}</strong><input type="number" class="form-control talla-input" name="tallas[{{ $talla }}]" min="0" value="{{ $invoice->tallas[$talla] ?? 0 }}"></div>
                                @endfor
                                <div class="text-center">
                                    <strong>TOTAL</strong>
                                    <div id="total-display" class="fw-bold fs-4 text-primary">{{ $invoice->total }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Precio Total -->
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-dollar-sign me-2"></i>Precio Total <span class="text-warning">*</span></h5>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-success text-white fw-bold">$</span>
                                        <input type="text" class="form-control" id="precio_total_input" placeholder="0" value="{{ $invoice->precio_total ? number_format($invoice->precio_total, 0, ',', '.') : '' }}" required>
                                    </div>
                                    <div class="form-text text-center">Ingrese el precio total de la factura</div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="text-center mb-4">
                        <button type="submit" class="btn btn-success btn-lg me-3">
                            <i class="fas fa-save me-2"></i>Actualizar Factura
                        </button>
                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para agregar color -->
    <div class="modal fade" id="colorModal" tabindex="-1" aria-labelledby="colorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="colorModalLabel">
                        <i class="fas fa-palette me-2"></i>Agregar Nuevo Color
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="newColorInput" class="form-label fw-bold">Nombre del Color:</label>
                        <input type="text" class="form-control form-control-lg" id="newColorInput" placeholder="Ej: Rojo, Azul, Verde..." maxlength="50">
                        <div class="form-text">Ingresa el nombre del nuevo color que deseas agregar.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="button" class="btn btn-primary" id="saveColorBtn">
                        <i class="fas fa-save me-1"></i>Guardar Color
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar referencia -->
    <div class="modal fade" id="refModal" tabindex="-1" aria-labelledby="refModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="refModalLabel">
                        <i class="fas fa-barcode me-2"></i>Agregar Nueva Referencia
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="newRefInput" class="form-label fw-bold">Código de Referencia:</label>
                        <input type="text" class="form-control form-control-lg" id="newRefInput" placeholder="Ej: REF001, MODELO-A..." maxlength="50">
                        <div class="form-text">Ingresa el código de referencia que deseas agregar.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancelar
                    </button>
                    <button type="button" class="btn btn-success" id="saveRefBtn">
                        <i class="fas fa-save me-1"></i>Guardar Referencia
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sincronizar campos del header con campos ocultos
        document.addEventListener('DOMContentLoaded', function() {
            const headerInputs = [
                { header: 'header_numero', hidden: 'hidden_numero' },
                { header: 'header_fecha', hidden: 'hidden_fecha' },
                { header: 'header_ref_select', hidden: 'hidden_cod_referencia' },
                { header: 'header_color_select', hidden: 'hidden_color' },
                { header: 'header_no_tarea', hidden: 'hidden_no_tarea' },
                { header: 'precio_total_input', hidden: 'hidden_precio_total' }
            ];

            headerInputs.forEach(field => {
                const headerInput = document.getElementById(field.header);
                const hiddenInput = document.getElementById(field.hidden);
                
                const eventName = headerInput && headerInput.tagName === 'SELECT' ? 'change' : 'input';
                headerInput.addEventListener(eventName, function() {
                    hiddenInput.value = this.value;
                });
                
                // Sincronizar valor inicial
                hiddenInput.value = headerInput.value;
            });

            // Gestionar colores personalizados con localStorage
            const STORAGE_KEY_COLORS = 'customColors';
            const colorSelect = document.getElementById('header_color_select');
            const addColorBtn = document.getElementById('btn_add_color');

            function loadColors() {
                try {
                    const stored = JSON.parse(localStorage.getItem(STORAGE_KEY_COLORS) || '[]');
                    if (Array.isArray(stored)) return stored;
                    return [];
                } catch (e) {
                    return [];
                }
            }

            function saveColors(colors) {
                localStorage.setItem(STORAGE_KEY_COLORS, JSON.stringify(colors));
            }

            function renderColorOptions(selectedValue = '') {
                const defaults = [];
                const custom = loadColors();
                const all = [...defaults, ...custom];
                colorSelect.innerHTML = '';
                const optPlaceholder = document.createElement('option');
                optPlaceholder.value = '';
                optPlaceholder.textContent = 'Seleccione un color...';
                colorSelect.appendChild(optPlaceholder);
                all.forEach(c => {
                    const opt = document.createElement('option');
                    opt.value = c;
                    opt.textContent = c;
                    colorSelect.appendChild(opt);
                });
                if (selectedValue) {
                    colorSelect.value = selectedValue;
                }
                document.getElementById('hidden_color').value = colorSelect.value;
            }

            function addNewColor() {
                const colorModal = new bootstrap.Modal(document.getElementById('colorModal'));
                const newColorInput = document.getElementById('newColorInput');
                const saveColorBtn = document.getElementById('saveColorBtn');
                
                // Limpiar el input
                newColorInput.value = '';
                
                // Mostrar el modal
                colorModal.show();
                
                // Enfocar el input cuando se muestre el modal
                document.getElementById('colorModal').addEventListener('shown.bs.modal', function() {
                    newColorInput.focus();
                });
                
                // Función para guardar el color
                const saveColor = () => {
                    const newColor = newColorInput.value.trim();
                    if (!newColor) {
                        newColorInput.classList.add('is-invalid');
                        return;
                    }
                    
                    const colors = loadColors();
                    if (!colors.includes(newColor)) {
                        colors.push(newColor);
                        colors.sort((a,b) => a.localeCompare(b));
                        saveColors(colors);
                    }
                    renderColorOptions(newColor);
                    colorSelect.dispatchEvent(new Event('change'));
                    colorModal.hide();
                };
                
                // Event listeners
                saveColorBtn.onclick = saveColor;
                newColorInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        saveColor();
                    }
                });
                
                // Limpiar validación cuando el usuario escriba
                newColorInput.addEventListener('input', function() {
                    this.classList.remove('is-invalid');
                });
            }

            // Inicializar select de colores
            renderColorOptions('{{ $invoice->color ?? "" }}');
            colorSelect.addEventListener('change', () => {
                document.getElementById('hidden_color').value = colorSelect.value;
            });
            addColorBtn.addEventListener('click', addNewColor);

            // Gestionar referencias personalizadas con localStorage
            const STORAGE_KEY_REFS = 'customRefs';
            const refSelect = document.getElementById('header_ref_select');
            const addRefBtn = document.getElementById('btn_add_ref');

            function loadRefs() {
                try {
                    const stored = JSON.parse(localStorage.getItem(STORAGE_KEY_REFS) || '[]');
                    if (Array.isArray(stored)) return stored;
                    return [];
                } catch (e) {
                    return [];
                }
            }

            function saveRefs(refs) {
                localStorage.setItem(STORAGE_KEY_REFS, JSON.stringify(refs));
            }

            function renderRefOptions(selectedValue = '') {
                const defaults = [];
                const custom = loadRefs();
                const all = [...defaults, ...custom];
                refSelect.innerHTML = '';
                const optPlaceholder = document.createElement('option');
                optPlaceholder.value = '';
                optPlaceholder.textContent = 'Seleccione una referencia...';
                refSelect.appendChild(optPlaceholder);
                all.forEach(r => {
                    const opt = document.createElement('option');
                    opt.value = r;
                    opt.textContent = r;
                    refSelect.appendChild(opt);
                });
                if (selectedValue) {
                    refSelect.value = selectedValue;
                }
                document.getElementById('hidden_cod_referencia').value = refSelect.value;
            }

            function addNewRef() {
                const refModal = new bootstrap.Modal(document.getElementById('refModal'));
                const newRefInput = document.getElementById('newRefInput');
                const saveRefBtn = document.getElementById('saveRefBtn');
                
                // Limpiar el input
                newRefInput.value = '';
                
                // Mostrar el modal
                refModal.show();
                
                // Enfocar el input cuando se muestre el modal
                document.getElementById('refModal').addEventListener('shown.bs.modal', function() {
                    newRefInput.focus();
                });
                
                // Función para guardar la referencia
                const saveRef = () => {
                    const newRef = newRefInput.value.trim();
                    if (!newRef) {
                        newRefInput.classList.add('is-invalid');
                        return;
                    }
                    
                    const refs = loadRefs();
                    if (!refs.includes(newRef)) {
                        refs.push(newRef);
                        refs.sort((a,b) => a.localeCompare(b));
                        saveRefs(refs);
                    }
                    renderRefOptions(newRef);
                    refSelect.dispatchEvent(new Event('change'));
                    refModal.hide();
                };
                
                // Event listeners
                saveRefBtn.onclick = saveRef;
                newRefInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        saveRef();
                    }
                });
                
                // Limpiar validación cuando el usuario escriba
                newRefInput.addEventListener('input', function() {
                    this.classList.remove('is-invalid');
                });
            }

            // Inicializar select de referencias
            renderRefOptions('{{ $invoice->cod_referencia ?? "" }}');
            refSelect.addEventListener('change', () => {
                document.getElementById('hidden_cod_referencia').value = refSelect.value;
            });
            addRefBtn.addEventListener('click', addNewRef);

            // Calcular total automáticamente
            const tallaInputs = document.querySelectorAll('.talla-input');
            tallaInputs.forEach(input => {
                input.addEventListener('input', calculateTotal);
            });

            // Calcular total inicial
            // Función para formatear números con separadores de miles
            function formatNumberWithCommas(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // Función para limpiar el formato y obtener el número real
            function cleanNumber(formattedNumber) {
                return formattedNumber.replace(/\./g, '');
            }

            // Función mejorada para procesar el valor del input
            function processPriceInput(value) {
                // Remover todos los caracteres no numéricos
                let cleanValue = value.replace(/[^\d]/g, '');
                
                // Si hay números, formatear
                if (cleanValue) {
                    return formatNumberWithCommas(cleanValue);
                }
                return '';
            }

            // Formateo automático del precio total
            const precioTotalInput = document.getElementById('precio_total_input');
            precioTotalInput.addEventListener('input', function(e) {
                e.target.value = processPriceInput(e.target.value);
            });

            // Manejar cuando el usuario pega o escribe números con formato
            precioTotalInput.addEventListener('paste', function(e) {
                setTimeout(() => {
                    e.target.value = processPriceInput(e.target.value);
                }, 10);
            });

            // Al enviar el formulario, limpiar el formato para enviar solo números
            precioTotalInput.addEventListener('blur', function(e) {
                const hiddenInput = document.getElementById('hidden_precio_total');
                hiddenInput.value = cleanNumber(e.target.value);
            });

            calculateTotal();

            // Validar campos obligatorios antes de enviar
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const requiredFields = [
                    { id: 'header_fecha', name: 'Fecha' },
                    { id: 'header_ref_select', name: 'Código de Referencia' },
                    { id: 'header_color_select', name: 'Color' },
                    { id: 'header_no_tarea', name: 'Nombre del Cliente' },
                    { id: 'precio_total_input', name: 'Precio Total' }
                ];

                let hasErrors = false;
                requiredFields.forEach(field => {
                    const element = document.getElementById(field.id);
                    if (!element.value || element.value.trim() === '') {
                        element.classList.add('is-invalid');
                        hasErrors = true;
                    } else {
                        element.classList.remove('is-invalid');
                    }
                });

                if (hasErrors) {
                    e.preventDefault();
                    alert('Por favor, complete todos los campos obligatorios marcados con *');
                    return false;
                }
            });
        });

        function calculateTotal() {
            const tallaInputs = document.querySelectorAll('.talla-input');
            let total = 0;
            tallaInputs.forEach(input => {
                total += parseInt(input.value) || 0;
            });
            document.getElementById('total-display').textContent = total;
        }

    </script>
</body>
</html>