@echo off
CLS

ECHO Iniciando aplicacion...

REM --- CONFIGURACION ---
set "LARAGON_EXE=C:\laragon\laragon.exe"
set "APP_URL=http://facturacion_pruebas2.test/invoices"
REM --- FIN DE LA CONFIGURACION ---


REM Paso 1: Abrir Laragon
start "" "%LARAGON_EXE%"

REM Paso 2: Dar un pequeño margen para que los servicios inicien
timeout /t 5 /nobreak >nul

REM Paso 3: Abrir la URL en el navegador
start "" "%APP_URL%"

REM Paso 4: Cerrar esta ventana
exit