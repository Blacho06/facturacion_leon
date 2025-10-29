<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>León Shoes - Nueva Factura</title>
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
        

        .auto-number {
            background: #e9ecef;
            color: #495057;
            font-weight: bold;
            font-size: 1.2rem;
            text-align: center;
            border: 2px solid #28a745;
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

        /* Estilos mejorados para validación */
        .alert-validation {
            border-radius: 10px;
            border-left: 4px solid #dc3545;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: slideInDown 0.3s ease;
        }

        .alert-validation .alert-heading {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #dc3545;
            font-weight: 500;
            animation: fadeIn 0.3s ease;
        }

        .form-control.is-invalid,
        .form-select.is-invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        /* Toast notifications */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        .toast-custom {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-left: 4px solid #dc3545;
            animation: slideInRight 0.3s ease;
            min-width: 300px;
        }

        .toast-custom.success {
            border-left-color: #28a745;
        }

        .toast-custom.warning {
            border-left-color: #ffc107;
        }

        .toast-custom.info {
            border-left-color: #17a2b8;
        }

        .toast-header-custom {
            background-color: transparent;
            border-bottom: 1px solid #dee2e6;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
        }

        .toast-body-custom {
            padding: 16px;
            color: #495057;
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">No.</label>
                                    <input type="text" class="form-control auto-number" value="{{ $nextNumber }}" readonly>
                                    <small class="text-info">
                                        <i class="fas fa-magic"></i> Número automático
                                    </small>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">FECHA</label>
                                    <input type="date" class="form-control" id="header_fecha" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">COD. REFERENCIA <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select id="header_ref_select" class="form-select" required>
                                            <option value="">Seleccione una referencia...</option>
                                        </select>
                                        <button type="button" class="btn btn-primary" id="btn_add_ref" title="Agregar referencia">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="header_ref_select_error" style="display: none;">
                                        Por favor, seleccione una referencia.
                                    </div>
                                    <div class="mt-1">
                                        <button type="button" class="btn btn-danger btn-sm" id="btn_delete_ref" title="Eliminar referencia seleccionada" style="display: none;">
                                            <i class="fas fa-trash-alt me-1"></i>Eliminar referencia
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">COLOR <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select id="header_color_select" class="form-select" required>
                                            <option value="">Seleccione un color...</option>
                                        </select>
                                        <button type="button" class="btn btn-primary" id="btn_add_color" title="Agregar color">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="invalid-feedback" id="header_color_select_error" style="display: none;">
                                        Por favor, seleccione un color.
                                    </div>
                                    <div class="mt-1">
                                        <button type="button" class="btn btn-danger btn-sm" id="btn_delete_color" title="Eliminar color seleccionado" style="display: none;">
                                            <i class="fas fa-trash-alt me-1"></i>Eliminar color
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">NOMBRE CLIENTE <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="header_no_tarea" required>
                                    <div class="invalid-feedback" id="header_no_tarea_error" style="display: none;">
                                        Por favor, ingrese el nombre del cliente.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('invoices.store') }}">
                    @csrf
                    
                    <!-- Campos ocultos para copiar valores del header -->
                    <!-- YA NO necesitamos campo hidden para numero porque es automático -->
                    <input type="hidden" name="fecha" id="hidden_fecha" value="{{ date('Y-m-d') }}">
                    <input type="hidden" name="cod_referencia" id="hidden_cod_referencia">
                    <input type="hidden" name="color" id="hidden_color">
                    <input type="hidden" name="no_tarea" id="hidden_no_tarea">
                    <input type="hidden" name="precio_total" id="hidden_precio_total">

                    @if ($errors->any())
                        <div class="alert alert-danger alert-validation mb-4">
                            <div class="alert-heading">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>Errores de Validación</span>
                            </div>
                            <hr>
                            <ul class="mb-0 ps-3">
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
                                <div><strong>21</strong><input type="number" class="form-control talla-input" name="tallas[21]" id="talla_21" min="0"></div>
                                <div><strong>22</strong><input type="number" class="form-control talla-input" name="tallas[22]" id="talla_22" min="0"></div>
                                <div><strong>23</strong><input type="number" class="form-control talla-input" name="tallas[23]" id="talla_23" min="0"></div>
                                <div><strong>24</strong><input type="number" class="form-control talla-input" name="tallas[24]" id="talla_24" min="0"></div>
                                <div><strong>25</strong><input type="number" class="form-control talla-input" name="tallas[25]" id="talla_25" min="0"></div>
                                <div><strong>26</strong><input type="number" class="form-control talla-input" name="tallas[26]" id="talla_26" min="0"></div>
                                <div><strong>27</strong><input type="number" class="form-control talla-input" name="tallas[27]" id="talla_27" min="0"></div>
                                <div><strong>28</strong><input type="number" class="form-control talla-input" name="tallas[28]" id="talla_28" min="0"></div>
                                <div><strong>29</strong><input type="number" class="form-control talla-input" name="tallas[29]" id="talla_29" min="0"></div>
                            </div>
                            <div class="tallas-grid">
                                <div><strong>30</strong><input type="number" class="form-control talla-input" name="tallas[30]" id="talla_30" min="0"></div>
                                <div><strong>31</strong><input type="number" class="form-control talla-input" name="tallas[31]" id="talla_31" min="0"></div>
                                <div><strong>32</strong><input type="number" class="form-control talla-input" name="tallas[32]" id="talla_32" min="0"></div>
                                <div><strong>33</strong><input type="number" class="form-control talla-input" name="tallas[33]" id="talla_33" min="0"></div>
                                <div><strong>34</strong><input type="number" class="form-control talla-input" name="tallas[34]" id="talla_34" min="0"></div>
                                <div><strong>35</strong><input type="number" class="form-control talla-input" name="tallas[35]" id="talla_35" min="0"></div>
                                <div><strong>36</strong><input type="number" class="form-control talla-input" name="tallas[36]" id="talla_36" min="0"></div>
                                <div><strong>37</strong><input type="number" class="form-control talla-input" name="tallas[37]" id="talla_37" min="0"></div>
                                <div><strong>38</strong><input type="number" class="form-control talla-input" name="tallas[38]" id="talla_38" min="0"></div>
                            </div>
                            <div class="tallas-grid" style="grid-template-columns: repeat(6, 1fr);">
                                <div><strong>39</strong><input type="number" class="form-control talla-input" name="tallas[39]" id="talla_39" min="0"></div>
                                <div><strong>40</strong><input type="number" class="form-control talla-input" name="tallas[40]" id="talla_40" min="0"></div>
                                <div><strong>41</strong><input type="number" class="form-control talla-input" name="tallas[41]" id="talla_41" min="0"></div>
                                <div><strong>42</strong><input type="number" class="form-control talla-input" name="tallas[42]" id="talla_42" min="0"></div>
                                <div><strong>43</strong><input type="number" class="form-control talla-input" name="tallas[43]" id="talla_43" min="0"></div>
                                <div class="text-center">
                                    <strong>TOTAL</strong>
                                    <div id="total-display" class="fw-bold fs-4 text-primary">0</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Precio Total -->
                    <div class="card mb-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0"><i class="fas fa-dollar-sign me-2"></i>Precio Total <span class="text-warning">*</span></h5>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text bg-dark text-white fw-bold">$</span>
                                        <input type="text" class="form-control" id="precio_total_input" placeholder="0" required>
                                    </div>
                                    <div class="invalid-feedback text-center" id="precio_total_input_error" style="display: none;">
                                        Por favor, ingrese el precio total de la factura.
                                    </div>
                                    <div class="form-text text-center">Ingrese el precio total de la factura</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Procesos Internos -->
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Procesos Internos</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-3">Cada proceso recibirá automáticamente el número de la factura</p>
                            
                            <!-- Procesos estáticos -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="process-item">
                                        <div class="card">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <strong>LIMPIADORA</strong>
                                                <span class="badge bg-secondary">FACTURA: {{ $nextNumber }}</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">REF.:</label>
                                                            <input type="text" class="form-control" name="processes[1][referencia]" placeholder="Auto-completar" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">CANT.:</label>
                                                            <input type="number" class="form-control" name="processes[1][cantidad]" min="0" value="0" readonly style="background-color: #f8f9fa;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="processes[1][proceso_nombre]" value="LIMPIADORA">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <div class="process-item">
                                        <div class="card">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <strong>MONTADA</strong>
                                                <span class="badge bg-secondary">FACTURA: {{ $nextNumber }}</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">REF.:</label>
                                                            <input type="text" class="form-control" name="processes[2][referencia]" placeholder="Auto-completar" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">CANT.:</label>
                                                            <input type="number" class="form-control" name="processes[2][cantidad]" min="0" value="0" readonly style="background-color: #f8f9fa;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="processes[2][proceso_nombre]" value="MONTADA">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <div class="process-item">
                                        <div class="card">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <strong>GUARNECIDA</strong>
                                                <span class="badge bg-secondary">FACTURA: {{ $nextNumber }}</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">REF.:</label>
                                                            <input type="text" class="form-control" name="processes[3][referencia]" placeholder="Auto-completar" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">CANT.:</label>
                                                            <input type="number" class="form-control" name="processes[3][cantidad]" min="0" value="0" readonly style="background-color: #f8f9fa;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="processes[3][proceso_nombre]" value="GUARNECIDA">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <div class="process-item">
                                        <div class="card">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <strong>ESTAMPADO</strong>
                                                <span class="badge bg-secondary">FACTURA: {{ $nextNumber }}</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">REF.:</label>
                                                            <input type="text" class="form-control" name="processes[4][referencia]" placeholder="Auto-completar" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">CANT.:</label>
                                                            <input type="number" class="form-control" name="processes[4][cantidad]" min="0" value="0" readonly style="background-color: #f8f9fa;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="processes[4][proceso_nombre]" value="ESTAMPADO">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <div class="process-item">
                                        <div class="card">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <strong>PINTADA</strong>
                                                <span class="badge bg-secondary">FACTURA: {{ $nextNumber }}</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">REF.:</label>
                                                            <input type="text" class="form-control" name="processes[5][referencia]" placeholder="Auto-completar" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">CANT.:</label>
                                                            <input type="number" class="form-control" name="processes[5][cantidad]" min="0" value="0" readonly style="background-color: #f8f9fa;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="processes[5][proceso_nombre]" value="PINTADA">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <div class="process-item">
                                        <div class="card">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                <strong>CORTADA</strong>
                                                <span class="badge bg-secondary">FACTURA: {{ $nextNumber }}</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">REF.:</label>
                                                            <input type="text" class="form-control" name="processes[6][referencia]" placeholder="Auto-completar" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">CANT.:</label>
                                                            <input type="number" class="form-control" name="processes[6][cantidad]" min="0" value="0" readonly style="background-color: #f8f9fa;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="processes[6][proceso_nombre]" value="CORTADA">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-4">
                        <button type="submit" class="btn btn-primary btn-lg me-3">
                            <i class="fas fa-save me-2"></i>Guardar Factura
                        </button>
                        <a href="{{ route('invoices.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Contenedor para notificaciones toast -->
    <div class="toast-container" id="toastContainer"></div>

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
                <div class="modal-header bg-dark text-white">
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
                    <button type="button" class="btn btn-dark" id="saveRefBtn">
                        <i class="fas fa-save me-1"></i>Guardar Referencia
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación personalizado -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Eliminación
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                    </div>
                    <h5 class="mb-3">¿Estás seguro?</h5>
                    <p id="confirmDeleteMessage" class="text-muted">Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="fas fa-trash-alt me-2"></i>Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/invoice-processes.js') }}"></script>
    <script>
        const nextNumber = '{{ $nextNumber }}'; // Número que será asignado

        // Función para confirmación personalizada
        function showConfirm(message, callback) {
            const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            const messageElement = document.getElementById('confirmDeleteMessage');
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            let confirmed = false;
            
            messageElement.textContent = message;
            
            // Limpiar eventos previos
            const newConfirmBtn = confirmBtn.cloneNode(true);
            confirmBtn.parentNode.replaceChild(newConfirmBtn, confirmBtn);
            
            newConfirmBtn.addEventListener('click', function() {
                confirmed = true;
                modal.hide();
            });
            
            // Ejecutar callback al cerrar
            const modalElement = document.getElementById('confirmDeleteModal');
            modalElement.addEventListener('hidden.bs.modal', function() {
                if (callback) callback(confirmed);
                confirmed = false;
            }, { once: true });
            
            modal.show();
        }

        // Función para mostrar notificaciones toast
        function showToast(message, type = 'error') {
            const toastContainer = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast-custom ${type} mb-3`;
            
            const icons = {
                'error': 'fa-exclamation-circle',
                'success': 'fa-check-circle',
                'warning': 'fa-exclamation-triangle',
                'info': 'fa-info-circle'
            };
            
            const colors = {
                'error': '#dc3545',
                'success': '#28a745',
                'warning': '#ffc107',
                'info': '#17a2b8'
            };
            
            toast.innerHTML = `
                <div class="toast-header-custom" style="color: ${colors[type]};">
                    <i class="fas ${icons[type]}"></i>
                    <span>${type === 'error' ? 'Error' : type === 'success' ? 'Éxito' : type === 'warning' ? 'Advertencia' : 'Información'}</span>
                    <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
                </div>
                <div class="toast-body-custom">
                    ${message}
                </div>
            `;
            
            toastContainer.appendChild(toast);
            
            // Auto remover después de 5 segundos
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.style.animation = 'slideInRight 0.3s ease reverse';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 5000);
        }

        // Sincronizar campos del header con campos ocultos
        document.addEventListener('DOMContentLoaded', function() {
            const headerInputs = [
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
            const deleteColorBtn = document.getElementById('btn_delete_color');

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

            function updateDeleteColorButton() {
                const current = colorSelect.value;
                const colors = loadColors();
                const canDelete = current && colors.includes(current);
                deleteColorBtn.style.display = canDelete ? 'block' : 'none';
            }

            function renderColorOptions(selectedValue = '') {
                const defaults = [];
                const custom = loadColors();
                const all = [...defaults, ...custom];
                colorSelect.innerHTML = '';
                // Placeholder
                const optPlaceholder = document.createElement('option');
                optPlaceholder.value = '';
                optPlaceholder.textContent = 'Seleccione un color...';
                colorSelect.appendChild(optPlaceholder);
                // Options
                all.forEach(c => {
                    const opt = document.createElement('option');
                    opt.value = c;
                    opt.textContent = c;
                    colorSelect.appendChild(opt);
                });
                // Select
                if (selectedValue) {
                    colorSelect.value = selectedValue;
                }
                // Propagar al hidden
                const hiddenColor = document.getElementById('hidden_color');
                hiddenColor.value = colorSelect.value;
                updateDeleteColorButton();
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
            renderColorOptions('');
            colorSelect.addEventListener('change', () => {
                document.getElementById('hidden_color').value = colorSelect.value;
                updateDeleteColorButton();
            });
            addColorBtn.addEventListener('click', addNewColor);
            deleteColorBtn.addEventListener('click', function() {
                const current = colorSelect.value;
                if (!current) {
                    showToast('Seleccione un color para eliminar.', 'warning');
                    return;
                }
                const colors = loadColors();
                if (!colors.includes(current)) {
                    showToast('Solo se pueden eliminar colores agregados por el usuario.', 'warning');
                    return;
                }
                showConfirm('¿Eliminar el color "' + current + '"?', function(confirmed) {
                    if (confirmed) {
                        const updated = colors.filter(c => c !== current);
                        saveColors(updated);
                        renderColorOptions('');
                        colorSelect.dispatchEvent(new Event('change'));
                        showToast('Color eliminado exitosamente.', 'success');
                    }
                });
            });

            // Gestionar referencias personalizadas con localStorage
            const STORAGE_KEY_REFS = 'customRefs';
            const refSelect = document.getElementById('header_ref_select');
            const addRefBtn = document.getElementById('btn_add_ref');
            const deleteRefBtn = document.getElementById('btn_delete_ref');

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

            function updateDeleteRefButton() {
                const current = refSelect.value;
                const refs = loadRefs();
                const canDelete = current && refs.includes(current);
                deleteRefBtn.style.display = canDelete ? 'block' : 'none';
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
                updateDeleteRefButton();
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
            renderRefOptions('');
            refSelect.addEventListener('change', () => {
                document.getElementById('hidden_cod_referencia').value = refSelect.value;
                updateDeleteRefButton();
            });
            addRefBtn.addEventListener('click', addNewRef);
            deleteRefBtn.addEventListener('click', function() {
                const current = refSelect.value;
                if (!current) {
                    showToast('Seleccione una referencia para eliminar.', 'warning');
                    return;
                }
                const refs = loadRefs();
                if (!refs.includes(current)) {
                    showToast('Solo se pueden eliminar referencias agregadas por el usuario.', 'warning');
                    return;
                }
                showConfirm('¿Eliminar la referencia "' + current + '"?', function(confirmed) {
                    if (confirmed) {
                        const updated = refs.filter(r => r !== current);
                        saveRefs(updated);
                        renderRefOptions('');
                        refSelect.dispatchEvent(new Event('change'));
                        showToast('Referencia eliminada exitosamente.', 'success');
                    }
                });
            });

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

            // El JavaScript para procesos se carga desde invoice-processes.js

            // Asegurar que campos vacíos se envíen como 0 y validar campos obligatorios
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                // Validar campos obligatorios
                const requiredFields = [
                    { id: 'header_fecha', name: 'Fecha', errorId: null },
                    { id: 'header_ref_select', name: 'Código de Referencia', errorId: 'header_ref_select_error' },
                    { id: 'header_color_select', name: 'Color', errorId: 'header_color_select_error' },
                    { id: 'header_no_tarea', name: 'Nombre del Cliente', errorId: 'header_no_tarea_error' },
                    { id: 'precio_total_input', name: 'Precio Total', errorId: 'precio_total_input_error' }
                ];

                let hasErrors = false;
                const errorMessages = [];

                requiredFields.forEach(field => {
                    const element = document.getElementById(field.id);
                    const errorElement = field.errorId ? document.getElementById(field.errorId) : null;
                    
                    if (!element.value || element.value.trim() === '') {
                        element.classList.add('is-invalid');
                        if (errorElement) {
                            errorElement.style.display = 'block';
                        }
                        hasErrors = true;
                        errorMessages.push(field.name);
                    } else {
                        element.classList.remove('is-invalid');
                        if (errorElement) {
                            errorElement.style.display = 'none';
                        }
                    }
                });

                if (hasErrors) {
                    e.preventDefault();
                    // Hacer scroll al primer error
                    const firstError = document.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstError.focus();
                    }
                    showToast('Por favor, complete todos los campos obligatorios marcados con *.', 'error');
                    return false;
                }

                // Asegurar que campos de tallas vacíos se envíen como 0
                const tallaInputs = document.querySelectorAll('.talla-input');
                tallaInputs.forEach(input => {
                    if (input.value === '' || input.value === null) {
                        input.value = '0';
                    }
                });
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