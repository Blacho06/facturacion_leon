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
        
        .process-section {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            border-left: 4px solid #007bff;
        }
        
        .btn-add-process {
            background: #28a745;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .btn-remove-process {
            background: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
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
                                    <label class="form-label fw-bold">COD. REFERENCIA</label>
                                    <input type="text" class="form-control" id="header_cod_referencia" value="{{ $invoice->cod_referencia }}">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">No. TAREA</label>
                                    <input type="text" class="form-control" id="header_no_tarea" value="{{ $invoice->no_tarea }}">
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
                    <input type="hidden" name="no_tarea" id="hidden_no_tarea" value="{{ $invoice->no_tarea }}">

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

                    <!-- Sección de Procesos -->
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Procesos</h5>
                            <button type="button" class="btn-add-process" onclick="addProcess()">
                                <i class="fas fa-plus me-1"></i>Agregar Proceso
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="processes-container">
                                <!-- Los procesos existentes se cargarán aquí -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let processCount = 0;
        const processes = ['LIMPIADORA', 'MONTADA', 'GUARNECIDA', 'ESTAMPADO', 'PINTADA', 'CORTADA'];
        const existingProcesses = @json($invoice->processes);

        // Sincronizar campos del header con campos ocultos
        document.addEventListener('DOMContentLoaded', function() {
            const headerInputs = [
                { header: 'header_numero', hidden: 'hidden_numero' },
                { header: 'header_fecha', hidden: 'hidden_fecha' },
                { header: 'header_cod_referencia', hidden: 'hidden_cod_referencia' },
                { header: 'header_no_tarea', hidden: 'hidden_no_tarea' }
            ];

            headerInputs.forEach(field => {
                const headerInput = document.getElementById(field.header);
                const hiddenInput = document.getElementById(field.hidden);
                
                headerInput.addEventListener('input', function() {
                    hiddenInput.value = this.value;
                });
            });

            // Calcular total automáticamente
            const tallaInputs = document.querySelectorAll('.talla-input');
            tallaInputs.forEach(input => {
                input.addEventListener('input', calculateTotal);
            });

            // Cargar procesos existentes
            existingProcesses.forEach(process => {
                addExistingProcess(process);
            });

            // Agregar procesos disponibles que no están en uso
            const usedProcesses = existingProcesses.map(p => p.proceso);
            processes.forEach(proceso => {
                if (!usedProcesses.includes(proceso)) {
                    addProcess(proceso);
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

        function addExistingProcess(process) {
            const container = document.getElementById('processes-container');
            const processDiv = document.createElement('div');
            processDiv.className = 'process-section';
            processDiv.innerHTML = `
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">${process.proceso}</label>
                        <input type="hidden" name="processes[${processCount}][proceso]" value="${process.proceso}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">No.</label>
                        <input type="text" class="form-control" name="processes[${processCount}][numero]" value="${process.numero}" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">No. TAREA</label>
                        <input type="text" class="form-control" name="processes[${processCount}][no_tarea]" value="${process.no_tarea || ''}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">REF.</label>
                        <input type="text" class="form-control" name="processes[${processCount}][ref]" value="${process.ref || ''}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">CANT.</label>
                        <input type="text" class="form-control" name="processes[${processCount}][cant]" value="${process.cant || ''}">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn-remove-process" onclick="removeProcess(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(processDiv);
            processCount++;
        }

        function addProcess(proceso = '') {
            const container = document.getElementById('processes-container');
            const processDiv = document.createElement('div');
            processDiv.className = 'process-section';
            processDiv.innerHTML = `
                <div class="row align-items-center">
                    <div class="col-md-2">
                        <label class="form-label fw-bold">${proceso || 'PROCESO'}</label>
                        <input type="hidden" name="processes[${processCount}][proceso]" value="${proceso}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">No.</label>
                        <input type="text" class="form-control" name="processes[${processCount}][numero]" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">No. TAREA</label>
                        <input type="text" class="form-control" name="processes[${processCount}][no_tarea]">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">REF.</label>
                        <input type="text" class="form-control" name="processes[${processCount}][ref]">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">CANT.</label>
                        <input type="text" class="form-control" name="processes[${processCount}][cant]">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn-remove-process" onclick="removeProcess(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(processDiv);
            processCount++;
        }

        function removeProcess(button) {
            button.closest('.process-section').remove();
        }
    </script>
</body>
</html>