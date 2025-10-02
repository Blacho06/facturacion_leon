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
        
        .process-section {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            border-left: 4px solid #007bff;
        }
        
        .btn-remove-process {
            background: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
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
                                    <small class="text-success">
                                        <i class="fas fa-magic"></i> Número automático
                                    </small>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">FECHA</label>
                                    <input type="date" class="form-control" id="header_fecha" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">COD. REFERENCIA</label>
                                    <div class="input-group">
                                        <select id="header_ref_select" class="form-select"></select>
                                        <button type="button" class="btn btn-primary" id="btn_add_ref" title="Agregar referencia">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">COLOR</label>
                                    <div class="input-group">
                                        <select id="header_color_select" class="form-select"></select>
                                        <button type="button" class="btn btn-primary" id="btn_add_color" title="Agregar color">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">NOMBRE CLIENTE</label>
                                    <input type="text" class="form-control" id="header_no_tarea">
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
                                <div><strong>21</strong><input type="number" class="form-control talla-input" name="tallas[21]" min="0" value="0"></div>
                                <div><strong>22</strong><input type="number" class="form-control talla-input" name="tallas[22]" min="0" value="0"></div>
                                <div><strong>23</strong><input type="number" class="form-control talla-input" name="tallas[23]" min="0" value="0"></div>
                                <div><strong>24</strong><input type="number" class="form-control talla-input" name="tallas[24]" min="0" value="0"></div>
                                <div><strong>25</strong><input type="number" class="form-control talla-input" name="tallas[25]" min="0" value="0"></div>
                                <div><strong>26</strong><input type="number" class="form-control talla-input" name="tallas[26]" min="0" value="0"></div>
                                <div><strong>27</strong><input type="number" class="form-control talla-input" name="tallas[27]" min="0" value="0"></div>
                                <div><strong>28</strong><input type="number" class="form-control talla-input" name="tallas[28]" min="0" value="0"></div>
                                <div><strong>29</strong><input type="number" class="form-control talla-input" name="tallas[29]" min="0" value="0"></div>
                            </div>
                            <div class="tallas-grid">
                                <div><strong>30</strong><input type="number" class="form-control talla-input" name="tallas[30]" min="0" value="0"></div>
                                <div><strong>31</strong><input type="number" class="form-control talla-input" name="tallas[31]" min="0" value="0"></div>
                                <div><strong>32</strong><input type="number" class="form-control talla-input" name="tallas[32]" min="0" value="0"></div>
                                <div><strong>33</strong><input type="number" class="form-control talla-input" name="tallas[33]" min="0" value="0"></div>
                                <div><strong>34</strong><input type="number" class="form-control talla-input" name="tallas[34]" min="0" value="0"></div>
                                <div><strong>35</strong><input type="number" class="form-control talla-input" name="tallas[35]" min="0" value="0"></div>
                                <div><strong>36</strong><input type="number" class="form-control talla-input" name="tallas[36]" min="0" value="0"></div>
                                <div><strong>37</strong><input type="number" class="form-control talla-input" name="tallas[37]" min="0" value="0"></div>
                                <div><strong>38</strong><input type="number" class="form-control talla-input" name="tallas[38]" min="0" value="0"></div>
                            </div>
                            <div class="tallas-grid" style="grid-template-columns: repeat(6, 1fr);">
                                <div><strong>39</strong><input type="number" class="form-control talla-input" name="tallas[39]" min="0" value="0"></div>
                                <div><strong>40</strong><input type="number" class="form-control talla-input" name="tallas[40]" min="0" value="0"></div>
                                <div><strong>41</strong><input type="number" class="form-control talla-input" name="tallas[41]" min="0" value="0"></div>
                                <div><strong>42</strong><input type="number" class="form-control talla-input" name="tallas[42]" min="0" value="0"></div>
                                <div><strong>43</strong><input type="number" class="form-control talla-input" name="tallas[43]" min="0" value="0"></div>
                                <div class="text-center">
                                    <strong>TOTAL</strong>
                                    <div id="total-display" class="fw-bold fs-4 text-primary">0</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección de Procesos -->
                    <div class="card mb-4">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>Procesos</h5>
                            <small>Cada proceso recibirá automáticamente el número {{ $nextNumber }}</small>
                        </div>
                        <div class="card-body">
                            <div id="processes-container">
                                <!-- Los procesos se agregarán aquí dinámicamente -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let processCount = 0;
        const processes = ['LIMPIADORA', 'MONTADA', 'GUARNECIDA', 'ESTAMPADO', 'PINTADA', 'CORTADA'];
        const nextNumber = '{{ $nextNumber }}'; // Número que será asignado

        // Sincronizar campos del header con campos ocultos
        document.addEventListener('DOMContentLoaded', function() {
            const headerInputs = [
                { header: 'header_fecha', hidden: 'hidden_fecha' },
                { header: 'header_ref_select', hidden: 'hidden_cod_referencia' },
                { header: 'header_color_select', hidden: 'hidden_color' },
                { header: 'header_no_tarea', hidden: 'hidden_no_tarea' }
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
            }

            function addNewColor() {
                const newColor = prompt('Ingrese el nuevo color:');
                if (!newColor) return;
                const color = newColor.trim();
                if (!color) return;
                const colors = loadColors();
                if (!colors.includes(color)) {
                    colors.push(color);
                    colors.sort((a,b) => a.localeCompare(b));
                    saveColors(colors);
                }
                renderColorOptions(color);
                colorSelect.dispatchEvent(new Event('change'));
            }

            // Inicializar select de colores
            renderColorOptions('');
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
                const newRef = prompt('Ingrese el nuevo código de referencia:');
                if (!newRef) return;
                const ref = newRef.trim();
                if (!ref) return;
                const refs = loadRefs();
                if (!refs.includes(ref)) {
                    refs.push(ref);
                    refs.sort((a,b) => a.localeCompare(b));
                    saveRefs(refs);
                }
                renderRefOptions(ref);
                refSelect.dispatchEvent(new Event('change'));
            }

            // Inicializar select de referencias
            renderRefOptions('');
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
            calculateTotal();

            // Agregar procesos iniciales
            processes.forEach(proceso => addProcess(proceso));
        });

        function calculateTotal() {
            const tallaInputs = document.querySelectorAll('.talla-input');
            let total = 0;
            tallaInputs.forEach(input => {
                total += parseInt(input.value) || 0;
            });
            document.getElementById('total-display').textContent = total;
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
                        <input type="text" class="form-control auto-number" value="${nextNumber}" readonly>
                        <input type="hidden" name="processes[${processCount}][numero]" value="${nextNumber}">
                        <small class="text-success">Automático</small>
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