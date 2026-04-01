---
description: Flujo de desarrollo Laravel con Docker
---

# Flujo de Trabajo: Desarrollo Laravel

## Comandos Esenciales

### Base de Datos
```bash
# Migraciones
docker compose exec php-fpm php artisan migrate

# Fresh migration con seeders
docker compose exec php-fpm php artisan migrate:fresh --seed

# Crear nueva migración
docker compose exec php-fpm php artisan make:migration create_table_name

# Crear modelo con migración
docker compose exec php-fpm php artisan make:model ModelName -m
```

### Desarrollo
```bash
# Terminal en contenedor PHP
docker compose exec php-fpm bash

# Ejecutar tests
docker compose exec php-fpm php artisan test

# Tests específicos
docker compose exec php-fpm php artisan test --filter TestName

# Code style
docker compose exec php-fpm ./vendor/bin/pint

# Cache
docker compose exec php-fpm php artisan optimize:clear
docker compose exec php-fpm php artisan config:cache
docker compose exec php-fpm php artisan route:cache
```

### Artisan Commands
```bash
# Crear controller
docker compose exec php-fpm php artisan make:controller Api/ControllerName

# Crear request
docker compose exec php-fpm php artisan make:request StoreRequest

# Crear resource
docker compose exec php-fpm php artisan make:resource ResourceName

# Crear seeder
docker compose exec php-fpm php artisan make:seeder SeederName
```

## Debug con Xdebug

1. **Configurar Xdebug en contenedor** (ya está configurado en Dockerfile)
2. **Usar configuración de launch.json** en Windsurf
3. **Breakpoints** en código PHP
4. **Iniciar debugging** con F5 o desde paleta de comandos

## Estructura de Tests

```bash
# Feature tests
docker compose exec php-fpm php artisan test tests/Feature/

# Unit tests  
docker compose exec php-fpm php artisan test tests/Unit/

# Coverage report
docker compose exec php-fpm php artisan test --coverage
```

## API Endpoints Testing

```bash
# Test endpoints con curl
curl -X GET http://localhost/api/v1/articles
curl -X GET http://localhost/api/v1/articles/slug
curl -X GET http://localhost/api/v1/categories

# Auth endpoints
curl -X POST http://localhost/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@webroblox.com","password":"password123"}'
```

## Filament Admin

1. **Acceso**: http://localhost/admin
2. **Credenciales**: admin@webroblox.com / admin123
3. **Recursos**: Articles, Categories, Users
4. **Customización**: backend/app/Filament/Resources/

## Code Style

- **PHP**: PSR-12 + Laravel Pint
- **JavaScript**: ES6+ con Prettier
- **CSS**: Bootstrap 5.3 + custom variables
- **Frontend**: React 18 con hooks

## Atajos Windsurf

- **Ctrl+Shift+M**: Migraciones
- **Ctrl+Shift+T**: Tests
- **Ctrl+Shift+F**: Fix code style
- **Ctrl+Shift+B**: Terminal PHP container
