# Backend — Laravel 11 API

REST API que alimenta el sitio WebRoblox. Expone artículos, categorías y autenticación. El panel de administración (Filament 3) permite gestionar el contenido sin tocar código.

## Tech Stack

- PHP 8.2 + Laravel 11
- MySQL 8.0
- Laravel Sanctum (API tokens)
- Filament 3 (panel de administración)

## Acceso

| Servicio | URL |
|---------|-----|
| API base | http://localhost/api/v1 |
| Admin panel | http://localhost/admin |

## Variables de entorno

Copia `.env.example` a `.env` antes de arrancar:

```bash
cp .env.example .env
```

| Variable | Descripción | Ejemplo |
|----------|-------------|---------|
| `APP_KEY` | Clave de cifrado Laravel | Generada por `php artisan key:generate` |
| `DB_HOST` | Host de MySQL | `mysql` (nombre del contenedor Docker) |
| `DB_DATABASE` | Nombre de la base de datos | `webroblox` |
| `DB_USERNAME` | Usuario MySQL | `webroblox_user` |
| `DB_PASSWORD` | Contraseña MySQL | Tu contraseña del `.env` raíz |
| `SANCTUM_TOKEN_EXPIRATION` | Minutos hasta expirar el token | `10080` (7 días) |

> **Importante:** Si la contraseña contiene el carácter `#`, debes ponerla entre comillas dobles en el archivo `.env`. Sin comillas, todo lo que va después del `#` se interpreta como comentario y la contraseña queda truncada:
> ```env
> # MAL — la contraseña efectiva sería solo "miPass"
> DB_PASSWORD=miPass#123
>
> # BIEN — la contraseña completa es "miPass#123"
> DB_PASSWORD="miPass#123"
> ```

## Comandos de configuración inicial

Ejecuta estos comandos **dentro del contenedor Docker** (solo la primera vez). El comando `make setup` los ejecuta todos automáticamente, pero si necesitas hacerlo paso a paso:

```bash
# 1. Instalar dependencias PHP (vendor/)
docker compose exec php-fpm composer install

# 2. Generar la clave de la aplicación
docker compose exec php-fpm php artisan key:generate

# 3. Crear todas las tablas en la base de datos
docker compose exec php-fpm php artisan migrate

# 4. Rellenar con los 15 artículos iniciales
docker compose exec php-fpm php artisan db:seed

# 5. Crear el enlace simbólico storage/ → public/storage/ (necesario para subir imágenes)
docker compose exec php-fpm php artisan storage:link

# 6. Publicar los assets CSS/JS del panel admin en public/
docker compose exec php-fpm php artisan filament:assets

# 7. Crear el usuario administrador (interactivo)
make admin-user
```

> Si añades nuevas dependencias a `composer.json`, ejecuta de nuevo `composer install` dentro del contenedor.

## API Reference

Todos los endpoints están bajo `/api/v1`.

### Autenticación

| Method | Endpoint | Body | Respuesta |
|--------|----------|------|-----------|
| POST | `/auth/register` | `{name, email, password, password_confirmation}` | `{token, user}` |
| POST | `/auth/login` | `{email, password}` | `{token, user}` |
| POST | `/auth/logout` | — | `{message}` |
| GET | `/auth/me` | — | `{id, name, email, role}` |

Los endpoints de logout y me requieren el header: `Authorization: Bearer <token>`

### Artículos

| Method | Endpoint | Query params | Respuesta |
|--------|----------|--------------|-----------|
| GET | `/articles` | `locale`, `category`, `page`, `per_page` | Lista paginada |
| GET | `/articles/{slug}` | `locale` | Artículo completo |

### Categorías

| Method | Endpoint | Query params | Respuesta |
|--------|----------|--------------|-----------|
| GET | `/categories` | `locale` | Lista de categorías |

**Ejemplo con curl:**

```bash
# Listar artículos en inglés de la categoría trucos
curl "http://localhost/api/v1/articles?locale=en&category=trucos"

# Artículo individual
curl "http://localhost/api/v1/articles/robux?locale=es"

# Login
curl -X POST http://localhost/api/v1/auth/login \
  -H "Content-Type: application/json" \
  -d '{"email":"tu@email.com","password":"tupassword"}'
```

## Panel de Administración

Accede a `http://localhost/admin` con las credenciales del usuario admin que creaste.

Desde el panel puedes:
- **Crear** nuevos artículos con contenido en ES/EN/FR (pestañas por idioma)
- **Editar** el título, descripción y cuerpo de cada artículo
- **Publicar/despublicar** artículos con un toggle
- **Ver estadísticas** de visitas por artículo

## Code Style

El proyecto usa Laravel Pint para mantener el código limpio:

```bash
# Verificar y corregir estilo automáticamente
docker compose exec php-fpm ./vendor/bin/pint
```

## Tests

```bash
docker compose exec php-fpm php artisan test
# O con el atajo:
make test-backend
```

---

## Problemas conocidos y soluciones

### El panel admin carga sin CSS/JS

Filament publica sus assets en `public/js/filament/` y `public/css/filament/`. Nginx debe servirlos directamente (no proxiarlos a Vite). Si los estilos no cargan:

```bash
# Re-publicar los assets
docker compose exec php-fpm php artisan filament:assets

# Reiniciar nginx
docker compose restart nginx
```

### El formulario de login devuelve "Method Not Allowed"

El panel de admin usa **Livewire** para el formulario de login. Si el JS de Livewire no carga, el formulario hace un POST HTML directo a `/admin/login` (que solo acepta GET). Nginx debe enrutar `/livewire/*` a PHP. Comprueba que la configuración de nginx incluye:

```nginx
location ^~ /livewire/ {
    try_files $uri /index.php?$query_string;
}
```

Reinicia nginx después de cualquier cambio en su configuración: `docker compose restart nginx`.

### El directorio `vendor/` no tiene permisos de escritura

Los volúmenes Docker se crean con propietario `root` por defecto. El contenedor PHP corre como `appuser` (UID 1000). Si `composer install` falla con errores de permisos:

```bash
docker compose exec --user root php-fpm chown -R appuser:appgroup /var/www/html/vendor
```

### `bootstrap/cache` no existe

Este directorio está en `.gitignore` y no se crea al clonar. Si `composer install` o `artisan` falla mencionando `bootstrap/cache`:

```bash
mkdir -p backend/bootstrap/cache
docker compose exec --user root php-fpm chown -R appuser:appgroup /var/www/html/bootstrap/cache
```
