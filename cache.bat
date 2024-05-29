@echo off
REM Change directory to the Laravel application root
cd /d "C:\path\to\your\laravel\project"

REM Clear application cache
php artisan cache:clear

REM Clear route cache
php artisan route:clear

REM Clear config cache
php artisan config:clear

REM Clear view cache
php artisan view:clear

REM Clear compiled classes
php artisan clear-compiled

REM Reoptimize the application
php artisan optimize:clear

echo All caches have been cleared...
