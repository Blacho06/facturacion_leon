/**
 * Funciones JavaScript para manejo de procesos de facturas
 * Archivo compartido entre create.blade.php y edit.blade.php
 */

// Auto-completar procesos con información de la factura
function autoCompleteProcesses() {
    const codReferencia = document.getElementById('header_ref_select').value;
    const totalTallas = calculateTotalTallas();
    
    // Auto-completar REF. y CANT. en todos los procesos
    for (let i = 1; i <= 6; i++) {
        const refInput = document.querySelector(`input[name="processes[${i}][referencia]"]`);
        const cantInput = document.querySelector(`input[name="processes[${i}][cantidad]"]`);
        
        if (refInput) {
            refInput.value = codReferencia;
        }
        if (cantInput) {
            cantInput.value = totalTallas;
        }
    }
}

// Calcular total de tallas
function calculateTotalTallas() {
    let total = 0;
    for (let i = 21; i <= 43; i++) {
        const input = document.getElementById(`talla_${i}`);
        if (input) {
            total += parseInt(input.value) || 0;
        }
    }
    return total;
}

// Configurar event listeners para procesos
function setupProcessListeners() {
    // Escuchar cambios en el campo de referencia para auto-completar
    const refSelect = document.getElementById('header_ref_select');
    if (refSelect) {
        refSelect.addEventListener('change', autoCompleteProcesses);
    }

    // Escuchar cambios en las tallas para actualizar cantidad
    for (let i = 21; i <= 43; i++) {
        const tallaInput = document.getElementById(`talla_${i}`);
        if (tallaInput) {
            tallaInput.addEventListener('input', autoCompleteProcesses);
        }
    }

    // Auto-completar al cargar la página si ya hay valores
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(autoCompleteProcesses, 100);
    });
}

// Formatear número con comas para precio
function formatNumberWithCommas(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

// Limpiar número para envío
function cleanNumber(str) {
    return str.replace(/[^\d]/g, '');
}

// Procesar input de precio
function processPriceInput(input) {
    const value = input.value;
    const cleanValue = cleanNumber(value);
    
    if (cleanValue) {
        input.value = formatNumberWithCommas(cleanValue);
    } else {
        input.value = '';
    }
}

// Configurar formateo de precio
function setupPriceFormatting() {
    const precioTotalInput = document.getElementById('precio_total_input');
    const hiddenInput = document.getElementById('hidden_precio_total');
    
    if (precioTotalInput && hiddenInput) {
        precioTotalInput.addEventListener('input', function(e) {
            processPriceInput(e.target);
            hiddenInput.value = cleanNumber(e.target.value);
        });

        precioTotalInput.addEventListener('paste', function(e) {
            setTimeout(() => {
                processPriceInput(e.target);
                hiddenInput.value = cleanNumber(e.target.value);
            }, 10);
        });

        precioTotalInput.addEventListener('blur', function(e) {
            hiddenInput.value = cleanNumber(e.target.value);
        });
    }
}

// Inicializar todo cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    setupProcessListeners();
    setupPriceFormatting();
});
