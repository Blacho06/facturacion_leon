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
                                <i class="fas fa-shoe-prints fa-3x text-primary me-3"></i>
                                <div>
                                    <h3 class="mb-0 text-primary">LEÓN SHOES</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">No.</label>
                                    <input type="text" class="form-control" id="header_numero" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">FECHA</label>
                                    <input type="date" class="form-control" id="header_fecha" value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">COD. REFERENCIA</label>
                                    <input type="text" class="form-control" id="header_cod_referencia">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">COLOR</label>
                                    <input type="text" class="form-control" id="header_color">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">No. TAREA</label>
                                    <input type="text" class="form-control" id="header_no_tarea">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('invoices.store') }}">
                    @csrf
                    
                    <!-- Campos ocultos para copiar valores del header -->
                    <input type="hidden" name="numero" id="hidden_numero">
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
                                <div><strong>21</strong><input type="number" class="form-control talla-input" name="tallas[21]" min="0" placeholder="0"></div>
                                <div><strong>22</strong><input type="number" class="form-control talla-input" name="tallas[22]" min="0" placeholder="0"></div>
                                <div><strong>23</strong><input type="number" class="form-control talla-input" name="tallas[23]" min="0" placeholder="0"></div>
                                <div><strong>24</strong><input type="number" class="form-control talla-input" name="tallas[24]" min="0" placeholder="0"></div>
                                <div><strong>25</strong><input type="number" class="form-control talla-input" name="tallas[25]" min="0" placeholder="0"></div>
                                <div><strong>26</strong><input type="number" class="form-control talla-input" name="tallas[26]" min="0" placeholder="0"></div>
                                <div><strong>27</strong><input type="number" class="form-control talla-input" name="tallas[27]" min="0" placeholder="0"></div>
                                <div><strong>28</strong><input type="number" class="form-control talla-input" name="tallas[28]" min="0" placeholder="0"></div>
                                <div><strong>29</strong><input type="number" class="form-control talla-input" name="tallas[29]" min="0" placeholder="0"></div>
                            </div>
                            <div class="tallas-grid">
                                <div><strong>30</strong><input type="number" class="form-control talla-input" name="tallas[30]" min="0" placeholder="0"></div>
                                <div><strong>31</strong><input type="number" class="form-control talla-input" name="tallas[31]" min="0" placeholder="0"></div>
                                <div><strong>32</strong><input type="number" class="form-control talla-input" name="tallas[32]" min="0" placeholder="0"></div>
                                <div><strong>33</strong><input type="number" class="form-control talla-input" name="tallas[33]" min="0" placeholder="0"></div>
                                <div><strong>34</strong><input type="number" class="form-control talla-input" name="tallas[34]" min="0" placeholder="0"></div>
                                <div><strong>35</strong><input type="number" class="form-control talla-input" name="tallas[35]" min="0" placeholder="0"></div>
                                <div><strong>36</strong><input type="number" class="form-control talla-input" name="tallas[36]" min="0" placeholder="0"></div>
                                <div><strong>37</strong><input type="number" class="form-control talla-input" name="tallas[37]" min="0" placeholder="0"></div>
                                <div><strong>38</strong><input type="number" class="form-control talla-input" name="tallas[38]" min="0" placeholder="0"></div>
                            </div>
                            <div class="tallas-grid" style="grid-template-columns: repeat(6, 1fr);">
                                <div><strong>39</strong><input type="number" class="form-control talla-input" name="tallas[39]" min="0" placeholder="0"></div>
                                <div><strong>40</strong><input type="number" class="form-control talla-input" name="tallas[40]" min="0" placeholder="0"></div>
                                <div><strong>41</strong><input type="number" class="form-control talla-input" name="tallas[41]" min="0" placeholder="0"></div>
                                <div><strong>42</strong><input type="number" class="form-control talla-input" name="tallas[42]" min="0" placeholder="0"></div>
                                <div><strong>43</strong><input type="number" class="form-control talla-input" name="tallas[43]" min="0" placeholder="0"></div>
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

        // Sincronizar campos del header con campos ocultos
        document.addEventListener('DOMContentLoaded', function() {
            const headerInputs = [
                { header: 'header_numero', hidden: 'hidden_numero' },
                { header: 'header_fecha', hidden: 'hidden_fecha' },
                { header: 'header_cod_referencia', hidden: 'hidden_cod_referencia' },
                { header: 'header_color', hidden: 'hidden_color' },
                { header: 'header_no_tarea', hidden: 'hidden_no_tarea' }
            ];

            headerInputs.forEach(field => {
                const headerInput = document.getElementById(field.header);
                const hiddenInput = document.getElementById(field.hidden);
                
                headerInput.addEventListener('input', function() {
                    hiddenInput.value = this.value;
                });
                
                // Sincronizar valor inicial
                hiddenInput.value = headerInput.value;
            });

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