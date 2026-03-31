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

## Comandos de configuración inicial

Ejecuta estos comandos **dentro del contenedor Docker** (solo la primera vez):

```bash
# Generar la clave de la aplicación
docker compose exec php-fpm php artisan key:generate

# Crear todas las tablas en la base de datos
docker compose exec php-fpm php artisan migrate

# Rellenar con los 15 artículos iniciales
docker compose exec php-fpm php artisan db:seed

# Crear el usuario administrador
docker compose exec php-fpm php artisan make:filament-user
```

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
```
