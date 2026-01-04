<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

<img width="1919" height="1031" alt="Screenshot 2026-01-03 231226" src="https://github.com/user-attachments/assets/c6eebefb-8494-487f-9d73-790004e7b213" />
# Clonar repositorio
[git clone https://github.com/Estebanhrze/vaulty.git]
cd vaulty

# Instalar dependencias
composer install
npm install

# Configurar
cp .env.example .env
php artisan key:generate

# Configurar base de datos en .env
# DB_DATABASE=vaulty

# Migrar
php artisan migrate

# Ejecutar
npm run dev
php artisan serve

# Características
-Generador de contraseñas personalizables (longitud 8-64, tipos de caracteres configurables)
-Almacenamiento encriptado automático con AES-256
-Análisis y detección de contraseñas débiles
-Dashboard con estadísticas en tiempo real
-Búsqueda instantánea por título o usuario
-Historial de contraseñas generadas
-Diseño responsive con Tailwind CSS
-Autenticación completa con Laravel Breeze

