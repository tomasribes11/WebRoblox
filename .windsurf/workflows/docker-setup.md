---
description: Configurar entorno Docker para desarrollo
---

# Flujo de Trabajo: Configuración Docker

## Pasos de Configuración

1. **Iniciar servicios Docker**
   ```bash
   docker compose up -d
   ```

2. **Verificar estado de contenedores**
   ```bash
   docker compose ps
   ```

3. **Ver logs si hay problemas**
   ```bash
   docker compose logs -f
   ```

4. **Ejecutar migraciones de Laravel**
   ```bash
   docker compose exec php-fpm php artisan migrate
   ```

5. **Cargar datos de prueba**
   ```bash
   docker compose exec php-fpm php artisan db:seed
   ```

6. **Ejecutar tests para verificar**
   ```bash
   docker compose exec php-fpm php artisan test
   ```

## Atajos de Teclado en Windsurf

- **Ctrl+Shift+D**: Iniciar servicios Docker
- **Ctrl+Shift+S**: Detener servicios Docker
- **Ctrl+Shift+L**: Ver logs Docker
- **Ctrl+Shift+M**: Ejecutar migraciones Laravel
- **Ctrl+Shift+T**: Ejecutar tests Laravel
- **Ctrl+Shift+F**: Fix code style PHP
- **Ctrl+Shift+B**: Abrir terminal en contenedor PHP

## Perfiles de Terminal Disponibles

1. **PowerShell**: Terminal principal en Windows
2. **WSL**: Terminal Ubuntu nativo
3. **Docker**: Terminal dentro del contenedor PHP-FPM

## URLs de Desarrollo

- Frontend: http://localhost:5173
- API Backend: http://localhost/api/v1
- Panel Admin: http://localhost/admin
- Base de datos: localhost:3306 (para GUI tools)

## Troubleshooting

Si los contenedores no inician:
1. Verificar Docker Desktop está corriendo
2. Ejecutar `docker compose down && docker compose up -d`
3. Revisar logs con `docker compose logs -f [servicio]`

Si hay problemas de conexión a DB:
1. Verificar contenedor mysql está healthy
2. Revisar variables en archivo .env
3. Limpiar caches: `docker compose exec php-fpm php artisan optimize:clear`
