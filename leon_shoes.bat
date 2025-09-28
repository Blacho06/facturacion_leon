@echo off

REM Cambiar a la carpeta del proyecto
cd "C:\laragon\www\miapp"

REM Iniciar el servidor en segundo plano (oculto)
start /b php artisan serve >nul 2>&1

REM Esperar 3 segundos para que arranque
timeout /t 3 >nul

REM Abrir el navegador directamente a la página
start http://127.0.0.1:8000

REM Cerrar esta ventana automáticamente
exit