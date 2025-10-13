 <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>León Shoes - Facturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .header-section {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .company-logo {
            font-size: 3rem;
            margin-right: 1rem;
        }

        .stats-card {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .invoice-card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .invoice-card:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .invoice-number {
            background: #e74c3c;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
        }

        .total-badge {
            background: #27ae60;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
        }

        .action-buttons .btn {
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .search-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }

        .imagenlogo {
            height: 100px;
            width: auto;
            margin-right: 15px;
            object-fit: contain;
        }

        /* Estilos mejorados para la paginación */
        .pagination-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 20px;
            border-radius: 10px;
            margin-top: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .pagination-info {
            color: #495057;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .pagination-info .font-medium {
            color: #007bff;
            font-weight: 600;
        }

        .pagination-nav {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .pagination-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 2px solid #dee2e6;
            background: white;
            color: #6c757d;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .pagination-btn:hover {
            background: #007bff;
            color: white;
            border-color: #007bff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,123,255,0.3);
        }

        .pagination-btn.active {
            background: #28a745;
            color: white;
            border-color: #28a745;
            font-weight: 600;
        }

        .pagination-btn.disabled {
            background: #f8f9fa;
            color: #adb5bd;
            border-color: #e9ecef;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .pagination-btn svg {
            width: 16px;
            height: 16px;
        }

        /* Ocultar elementos no deseados */
        .cursor-default.relative.inline-flex.items-center,
        .ml-3.relative.inline-flex.items-center,
        a.relative.inline-flex.items-center:first-child,
        span.relative.inline-flex.items-center:last-child {
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="header-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/logoleon.jpg') }}" alt="León Shoes Logo" class="imagenlogo">
                        <div>
                            <h1 class="mb-0">LEÓN SHOES</h1>
                            <p class="mb-0">Sistema de Gestión de Facturas</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('invoices.create') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-plus me-2"></i>Nueva Factura
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Estadísticas -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-card text-center">
                    <i class="fas fa-file-invoice fa-2x mb-2"></i>
                    <h3>{{ $invoices->total() }}</h3>
                    <p class="mb-0">Total Facturas</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card text-center"
                    style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);">
                    <i class="fas fa-calendar fa-2x mb-2"></i>
                    <h3>{{ date('d/m/Y') }}</h3>
                    <p class="mb-0">Hoy</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card text-center"
                    style="background: linear-gradient(135deg, #27ae60 0%, #219a52 100%);">
                    <i class="fas fa-shoe-prints fa-2x mb-2"></i>
                    <h3>{{ $invoices->sum(function ($invoice) {
    return $invoice->total; }) }}</h3>
                    <p class="mb-0">Pares Totales</p>
                </div>
            </div>
        </div>

        <!-- Buscador -->
        <div class="search-section">
            <form method="GET" action="{{ route('invoices.index') }}">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="search" placeholder="Buscar por número..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="fecha_desde" value="{{ request('fecha_desde') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" name="fecha_hasta" value="{{ request('fecha_hasta') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-info me-2">
                            <i class="fas fa-search me-1"></i>Buscar
                        </button>
                        <a href="{{ route('invoices.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Limpiar
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Lista de Facturas -->
        <div class="row">
            @forelse($invoices as $invoice)
                <div class="col-md-12">
                    <div class="invoice-card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="invoice-number">
                                        #{{ $invoice->numero }}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <strong>Fecha:</strong><br>
                                    {{ $invoice->fecha->format('d/m/Y') }}
                                </div>
                                <div class="col-md-3">
                                    <strong>Referencia:</strong><br>
                                    {{ $invoice->cod_referencia ?? 'N/A' }}
                                </div>
                                <div class="col-md-3">
                                    <strong>Total Pares:</strong><br>
                                    <span class="total-badge">{{ $invoice->total }}</span>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="action-buttons text-end">
                                        <a href="{{ route('invoices.show', $invoice->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('invoices.edit', $invoice->id) }}"
                                            class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button onclick="confirmDelete({{ $invoice->id }})"
                                            class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-5x text-muted mb-3"></i>
                        <h4>No hay facturas disponibles</h4>
                        <p class="text-muted">Crea tu primera factura para comenzar</p>
                        <a href="{{ route('invoices.create') }}" class="btn btn-info btn-lg">
                            <i class="fas fa-plus me-2"></i>Crear Primera Factura
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Paginación mejorada -->
        <div class="pagination-container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="pagination-info">
                        Mostrando
                        <span class="font-medium">{{ $invoices->firstItem() }}</span>
                        a
                        <span class="font-medium">{{ $invoices->lastItem() }}</span>
                        de
                        <span class="font-medium">{{ $invoices->total() }}</span>
                        resultados
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end">
                        <nav aria-label="Navegación de páginas">
                            <div class="pagination-nav">
                                @if ($invoices->onFirstPage())
                                    <span class="pagination-btn disabled">
                                        <svg fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                @else
                                    <a href="{{ $invoices->previousPageUrl() }}" class="pagination-btn">
                                        <svg fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                @endif

                                @foreach ($invoices->getUrlRange(1, $invoices->lastPage()) as $page => $url)
                                    @if ($page == $invoices->currentPage())
                                        <span class="pagination-btn active">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}" class="pagination-btn">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if ($invoices->hasMorePages())
                                    <a href="{{ $invoices->nextPageUrl() }}" class="pagination-btn">
                                        <svg fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                @else
                                    <span class="pagination-btn disabled">
                                        <svg fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                @endif
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación de eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta factura? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete(invoiceId) {
            const form = document.getElementById('deleteForm');
            form.action = `/invoices/${invoiceId}`;
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }
    </script>
</body>
</html>
