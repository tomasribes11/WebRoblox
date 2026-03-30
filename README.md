# WebRoblox

Sitio web sobre Roblox con artículos, guías y noticias. Construido como proyecto de aprendizaje con tecnologías profesionales.

## Stack tecnológico

| Capa | Tecnología | Versión |
|------|-----------|---------|
| Servidor web | Nginx | 1.25 |
| Backend | PHP + Laravel | 8.2 / 11 |
| Base de datos | MySQL | 8.0 |
| Frontend | React + Vite | 18 / 5 |
| Estilos | Bootstrap | 5.3 |
| Contenedor | Docker | — |

## Requisitos previos

Solo necesitas dos cosas instaladas en tu ordenador:

1. **Docker Desktop** — descárgalo en [docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop/)
2. **Git** — para clonar el proyecto

Nada más. Node.js, PHP y MySQL corren **dentro de Docker**.

---

## Inicio rápido (primera vez)

### 1. Configurar las variables de entorno

```bash
# Copia el archivo de ejemplo
cp .env.example .env
```

Abre el `.env` que acabas de crear y cambia las contraseñas si quieres (opcional en local):

```
MYSQL_ROOT_PASSWORD=mi_password_seguro
MYSQL_PASSWORD=mi_password_app
```

### 2. Crear el archivo .env del backend

```bash
cp backend/.env.example backend/.env
```

> Asegúrate de que `DB_PASSWORD` en `backend/.env` coincide con `MYSQL_PASSWORD` en `.env`.

### 3. Arrancar todos los contenedores

```bash
docker compose up --build
```

La primera vez tarda unos minutos mientras descarga las imágenes de Docker y compila PHP. Las siguientes veces es mucho más rápido.

Cuando veas en la terminal algo como:
```
webroblox_node   | VITE ready in ...ms
webroblox_node   | ➜  Local: http://localhost:5173/
```
...significa que todo está funcionando.

### 4. Configurar la base de datos (solo la primera vez)

Abre **otra** terminal (sin cerrar la anterior) y ejecuta:

```bash
# Crear las tablas en la base de datos
docker compose exec php-fpm php artisan migrate

# Rellenar con datos de ejemplo (artículos, categorías)
docker compose exec php-fpm php artisan db:seed

# Generar la clave de seguridad de Laravel
docker compose exec php-fpm php artisan key:generate
```

### 5. Crear el usuario administrador

```bash
docker compose exec php-fpm php artisan make:filament-user
```

Te pedirá nombre, email y contraseña. Guárdalos — los necesitarás para entrar al panel de administración.

---

## Acceder a la aplicación

| Servicio | URL |
|---------|-----|
| **Sitio web** (React) | http://localhost |
| **Panel de admin** (Filament) | http://localhost/admin |
| **API REST** | http://localhost/api/v1 |
| **Base de datos** (GUI externa) | localhost:3306 |

---

## Uso diario

Una vez configurado, solo necesitas:

```bash
# Arrancar
docker compose up

# Parar
docker compose down

# Ver los logs en tiempo real
docker compose logs -f

# Ver solo los logs del backend
docker compose logs -f php-fpm
```

El código que modificas en `backend/` y `frontend/` se actualiza **automáticamente** en el navegador sin necesidad de reiniciar Docker.

---

## Estructura del proyecto

```
WebRoblox/
├── backend/          ← Código PHP/Laravel (API + admin)
├── frontend/         ← Código React (lo que ve el usuario)
├── docker/
│   ├── nginx/        ← Configuración del servidor web
│   └── php/          ← Dockerfile de PHP
├── legacy/           ← Sitio original estático (preservado)
├── docker-compose.yml
└── .env.example
```

Para más detalles sobre cada parte:
- **Backend**: lee [`backend/README.md`](backend/README.md)
- **Frontend**: lee [`frontend/README.md`](frontend/README.md)

---

## Solución de problemas

**El puerto 80 está ocupado**
```bash
# Averigua qué programa usa el puerto 80
sudo lsof -i :80
# Páralo, o cambia el puerto en docker-compose.yml (ej: "8080:80")
```

**El puerto 3306 está ocupado (MySQL local instalado)**
```bash
# Opción 1: Para tu MySQL local
sudo systemctl stop mysql   # Linux
brew services stop mysql    # macOS

# Opción 2: Cambia el puerto en docker-compose.yml a "3307:3306"
```

**Los contenedores no arrancan**
```bash
# Ver el error exacto
docker compose logs php-fpm
docker compose logs mysql
```

**Borrar todo y empezar de cero**
```bash
# ⚠️ Esto borra la base de datos y todos los datos
docker compose down -v
docker compose up --build
```
