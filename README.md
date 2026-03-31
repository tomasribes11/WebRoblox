# WebRoblox

Sitio web sobre Roblox con artículos, guías y noticias. Construido como proyecto de aprendizaje con tecnologías profesionales.

---

## ¿Cómo funciona este proyecto?

Antes de instalarlo, es útil entender qué piezas lo componen y cómo se comunican entre sí.

### Las 4 piezas principales

```
Tu navegador (Chrome/Firefox)
        │
        ▼
    [Nginx] ← Servidor web. Recibe todas las peticiones y las reparte.
        │
        ├──── /api/*  y  /admin/*  ────▶  [Laravel]  ← Backend PHP. Gestiona datos y lógica.
        │                                      │
        │                                      ▼
        │                                  [MySQL]   ← Base de datos. Guarda artículos, usuarios, etc.
        │
        └──── /* (todo lo demás)  ────▶  [React]    ← Frontend. La página web que ves.
```

| Pieza | Tecnología | ¿Qué hace? |
|-------|-----------|------------|
| **Nginx** | Nginx 1.25 | Servidor web. Recibe tus peticiones y las dirige al sitio correcto |
| **Backend** | PHP 8.2 + Laravel 11 | Lógica del servidor: artículos, usuarios, autenticación |
| **Base de datos** | MySQL 8.0 | Almacena todos los datos (artículos, categorías, usuarios) |
| **Frontend** | React 18 + Vite 5 | La interfaz visual que ves en el navegador |
| **Docker** | Docker | "Caja mágica" que contiene y ejecuta todo lo anterior |

### Cómo reparte Nginx las peticiones

Nginx es el portero del proyecto. Cuando llega una petición, mira la URL y decide a quién mandársela:

```
Tu navegador (http://localhost/...)
        │
        ▼
    [Nginx :80]
        │
        ├── /api/*          → PHP (Laravel API — datos en JSON)
        ├── /admin/*        → PHP (Filament — panel de administración)
        ├── /filament/*     → PHP (rutas internas de Filament)
        ├── /livewire/*     → PHP (Livewire — formularios reactivos del admin)
        ├── /js/filament/*  → PHP public/ (JS del panel admin, pre-compilado)
        ├── /css/filament/* → PHP public/ (CSS del panel admin, pre-compilado)
        ├── /vendor/*       → PHP public/ (otros assets publicados)
        ├── /build/*        → PHP public/ (build de producción Vite)
        ├── /storage/*      → PHP public/ (imágenes y archivos subidos)
        └── /* (resto)      → React :5173 (Vite dev server, actualización en vivo)
```

> **¿Por qué importa esto?** Si Nginx no tiene configurada una ruta y la manda a React (Vite) por error, el navegador recibe HTML de React en vez del archivo correcto — lo que provoca errores como CSS/JS que no cargan o formularios que no funcionan.

### ¿Qué es Docker?

Imagina que cada pieza del proyecto (Nginx, PHP, MySQL, React) es un programa que necesita instalarse en tu ordenador. El problema es que cada uno tiene sus propias versiones y configuraciones, y pueden entrar en conflicto.

Docker resuelve esto creando **contenedores**: mini-ordenadores virtuales dentro de tu ordenador. Cada contenedor tiene su propio sistema operativo, sus propias versiones de software, y están aislados entre sí. Tú solo necesitas instalar Docker una vez, y él se encarga del resto.

### ¿Dónde está cada parte del código?

```
WebRoblox/
├── backend/          ← Todo el código PHP/Laravel
│   ├── app/
│   │   ├── Models/               ← Representan las tablas de la BD (Article, User, Category...)
│   │   ├── Http/Controllers/Api/ ← Responden a las peticiones /api/v1 del frontend
│   │   └── Filament/Resources/   ← Panel de administración visual
│   ├── database/
│   │   ├── migrations/           ← Crean las tablas en MySQL (como un historial de cambios de BD)
│   │   └── seeders/              ← Rellenan la BD con datos de ejemplo (15 artículos en ES/EN/FR)
│   └── routes/api.php            ← Define qué URL hace qué cosa en la API
│
├── frontend/         ← Todo el código React
│   ├── src/
│   │   ├── pages/        ← Una página = un archivo (HomePage, ArticlesPage, LoginPage...)
│   │   ├── components/   ← Piezas reutilizables (Navbar, Footer, ArticleCard...)
│   │   ├── api/          ← Funciones que llaman al backend (articles.js, auth.js)
│   │   ├── context/      ← Estado global (quién está logueado, tema claro/oscuro)
│   │   └── hooks/        ← Lógica reutilizable (useAuth, useArticles)
│   └── public/locales/   ← Traducciones (ES/EN/FR) en archivos JSON
│
├── docker/
│   ├── nginx/nginx.dev.conf  ← Configuración de Nginx (qué va a PHP, qué va a React)
│   └── php/Dockerfile        ← Instrucciones para construir el contenedor PHP
│
├── legacy/           ← Sitio original estático HTML/CSS (preservado, no tocar)
├── docker-compose.yml  ← Define y conecta los 4 contenedores
└── Makefile            ← Atajos de comandos frecuentes (make up, make migrate...)
```

### ¿Cómo fluye una petición?

**Ejemplo: el usuario abre la página de artículos**

1. Escribes `http://localhost/articulos` en el navegador
2. **Nginx** recibe la petición. Como no es `/api/` ni `/admin/`, la manda a **React**
3. **React** muestra el esqueleto de la página y pide los artículos a la API
4. React llama a `http://localhost/api/v1/articles` — esta vez **Nginx** la manda a **Laravel**
5. **Laravel** consulta **MySQL**, obtiene los artículos y los devuelve en formato JSON
6. React recibe el JSON y pinta las tarjetas de artículos en la pantalla

---

## Instalación en Windows (paso a paso para principiantes)

### Requisitos de sistema

- Windows 10 (versión 2004 o posterior) o Windows 11
- Procesador de 64 bits (x64)
- Al menos 8 GB de RAM
- Al menos 10 GB de espacio libre en disco

### Paso 1 — Activar WSL2 (subsistema Linux para Windows)

WSL2 es una función de Windows que instala un Linux real dentro de tu Windows. Lo necesitas porque Docker funciona mejor con él y te permite usar los mismos comandos que en Mac/Linux.

1. Abre **PowerShell como administrador** (clic derecho en el menú inicio → "Windows PowerShell (Administrador)")
2. Ejecuta este comando:

```powershell
wsl --install
```

3. Espera a que termine y **reinicia el ordenador** cuando te lo pida
4. Al reiniciar, se abrirá una ventana de Ubuntu pidiendo que crees un usuario. Pon un nombre de usuario (sin espacios, todo minúsculas) y una contraseña. **Apunta la contraseña** — la necesitarás después.

> Si el comando `wsl --install` da error, prueba: `wsl --install -d Ubuntu`

Para verificar que funciona:
```powershell
wsl --status
```
Debe mostrar "Versión predeterminada: 2".

### Paso 2 — Instalar Docker Desktop

1. Ve a [docker.com/products/docker-desktop](https://www.docker.com/products/docker-desktop/) y descarga **Docker Desktop para Windows**
2. Ejecuta el instalador. Durante la instalación, asegúrate de que está marcada la opción **"Use WSL 2 instead of Hyper-V"**
3. Al terminar, reinicia el ordenador si te lo pide
4. Abre Docker Desktop y espera a que aparezca el logo de la ballena en la barra de tareas (puede tardar 1-2 minutos la primera vez)
5. Si aparece un tutorial de introducción, puedes cerrarlo

Para verificar que funciona: abre Docker Desktop y comprueba que en la esquina inferior izquierda dice **"Engine running"**.

### Paso 3 — Instalar Git

1. Ve a [git-scm.com/download/win](https://git-scm.com/download/win) y descarga **Git para Windows**
2. Ejecuta el instalador. Puedes dejar todas las opciones por defecto y hacer clic en "Next" hasta que termine
3. Al finalizar, tienes instalado **Git Bash** (una terminal que habla Linux en Windows)

### Paso 4 — Abrir la terminal correcta

Para trabajar con este proyecto en Windows, vas a usar la **terminal de Ubuntu (WSL2)**. Es la más cómoda porque funciona exactamente igual que Linux.

Tienes dos formas de abrirla:
- Busca "Ubuntu" en el menú inicio y ábrela
- O abre Windows Terminal (si lo tienes) y selecciona "Ubuntu" en el desplegable de la barra de pestañas

Verás algo como esto:
```
tu_nombre@DESKTOP-XXXXX:~$
```

Esa `~` significa que estás en tu carpeta personal de Linux. A partir de ahora, **todos los comandos de este proyecto se ejecutan aquí**.

### Paso 5 — Clonar el proyecto

Dentro de la terminal de Ubuntu, ejecuta:

```bash
# Ir a tu carpeta de proyectos (créala si no existe)
mkdir -p ~/proyectos
cd ~/proyectos

# Clonar el repositorio
git clone <URL_DEL_REPOSITORIO> WebRoblox

# Entrar en la carpeta del proyecto
cd WebRoblox
```

> Sustituye `<URL_DEL_REPOSITORIO>` por la URL de GitHub/GitLab del proyecto.
> Si tienes el proyecto en un ZIP, en la terminal de Ubuntu ve a la carpeta donde está:
> `cd /mnt/c/Users/TuNombreDeUsuario/Downloads` (el disco C: está en `/mnt/c/` en WSL)

### Paso 6 — Configurar los archivos de entorno

Los archivos `.env` contienen contraseñas y configuraciones locales. Nunca se suben a Git (por eso hay archivos `.env.example` que sí se suben).

```bash
# Crear los 3 archivos de configuración a partir de los ejemplos
cp .env.example .env
cp backend/.env.example backend/.env
cp frontend/.env.example frontend/.env.local
```

Para desarrollo local **no necesitas cambiar nada** — los valores por defecto funcionan.

> **Opcional**: Si quieres cambiar las contraseñas de MySQL (recomendado si subes el proyecto a internet):
> Abre `.env` con un editor de texto y cambia `MYSQL_ROOT_PASSWORD` y `MYSQL_PASSWORD`.
> Luego abre `backend/.env` y asegúrate de que `DB_PASSWORD` tiene el mismo valor que `MYSQL_PASSWORD`.

### Paso 7 — Primera puesta en marcha

Este comando construye todos los contenedores, instala dependencias, crea la base de datos y la rellena con datos de ejemplo:

```bash
make setup
```

La primera vez **tarda entre 5 y 15 minutos** (dependiendo de tu conexión a internet) porque descarga imágenes de Docker y compila las dependencias. Las siguientes veces será casi instantáneo.

Verás mucho texto pasando. Es normal. Cuando aparezca algo como:

```
✅ Listo. Ahora ejecuta:
   make admin-user   → para crear el usuario administrador
   Abre http://localhost en el navegador
```

...significa que todo ha funcionado correctamente.

### Paso 8 — Crear el usuario administrador

```bash
make admin-user
```

Te pedirá tres cosas:
- **Name**: tu nombre o apodo (ej: `admin`)
- **Email**: tu email (ej: `admin@webroblox.com`)
- **Password**: una contraseña de al menos 8 caracteres

**Guarda estos datos** — los necesitas para entrar al panel de administración.

### Paso 9 — Abrir la aplicación

Abre tu navegador y ve a:

| ¿Qué quieres ver? | URL |
|------------------|-----|
| La web principal | http://localhost |
| El panel de administración | http://localhost/admin |
| La API (datos en JSON) | http://localhost/api/v1/articles |

¡Ya está! El proyecto está funcionando.

---

## Uso diario

Una vez configurado el proyecto (pasos anteriores son solo la primera vez), el uso diario es muy sencillo:

### Arrancar el proyecto

```bash
# Desde la carpeta del proyecto en la terminal Ubuntu
cd ~/proyectos/WebRoblox
docker compose up -d
```

La `-d` significa "en segundo plano" (daemon). El proyecto arrancará y podrás cerrar la terminal.

### Parar el proyecto

```bash
docker compose down
```

Esto para todos los contenedores pero **no borra los datos** de la base de datos.

### Ver qué está pasando (logs)

```bash
# Ver todos los logs en tiempo real (Ctrl+C para salir)
docker compose logs -f

# Ver solo los logs del backend PHP
docker compose logs -f php-fpm
```

### Atajos útiles (comandos `make`)

```bash
make up             # Arrancar los contenedores
make down           # Parar los contenedores
make logs           # Ver logs en tiempo real
make migrate        # Ejecutar nuevas migraciones de base de datos
make backend-shell  # Abrir una terminal dentro del contenedor PHP
make pint           # Corregir el estilo del código PHP automáticamente
make test-backend   # Ejecutar los tests automáticos del backend
make db-reset       # ⚠️ Borrar y recrear la BD (PIERDE TODOS LOS DATOS)
```

---

## Acceder a la aplicación

| Servicio | URL | Descripción |
|---------|-----|-------------|
| **Sitio web** | http://localhost | La web React que ven los usuarios |
| **Panel admin** | http://localhost/admin | Gestionar artículos, categorías y usuarios |
| **API REST** | http://localhost/api/v1 | Datos en formato JSON (para depuración) |
| **Base de datos** | localhost:3306 | Conectar con TablePlus/DBeaver para ver las tablas |

---

## Hacer cambios en el código

Una de las mejores partes de esta configuración: el código que cambias en tu ordenador se actualiza **automáticamente** en el navegador sin reiniciar Docker.

- Cambias un archivo en `frontend/src/` → el navegador se actualiza solo en menos de 1 segundo
- Cambias un archivo en `backend/` → la API devuelve los cambios inmediatamente

### Añadir un artículo nuevo

La forma más fácil es usando el panel de administración:

1. Ve a `http://localhost/admin`
2. Entra con el email y contraseña del administrador
3. Haz clic en "Articles" en el menú lateral
4. Botón "New Article" en la esquina superior derecha
5. Rellena el título, descripción y contenido en español, inglés y francés (hay pestañas para cada idioma)
6. Activa el toggle "Published" para que sea visible
7. Guarda

### Añadir una página nueva al frontend

1. Crea el archivo `frontend/src/pages/MiPagina.jsx`
2. Añade la ruta en `frontend/src/App.jsx`:
   ```jsx
   <Route path="/mi-pagina" element={<MiPagina />} />
   ```
3. Añade el enlace en `frontend/src/components/layout/Navbar.jsx` si quieres que aparezca en el menú

### Añadir una traducción

Los textos de la interfaz están en archivos JSON:
- `frontend/public/locales/es/common.json` — Español
- `frontend/public/locales/en/common.json` — Inglés
- `frontend/public/locales/fr/common.json` — Francés

Añade la misma clave en los tres archivos y úsala en el componente:
```jsx
const { t } = useTranslation();
// En el JSX:
<h1>{t('mi.clave')}</h1>
```

---

## Estructura de la base de datos

La base de datos tiene 4 tablas principales:

```
users               ← Usuarios registrados en el sitio
  id, name, email, password, role (user | admin)

categories          ← Categorías de artículos (trucos, noticias, guías...)
  id, slug, name_es, name_en, name_fr

articles            ← Artículos (sin el texto, solo metadatos)
  id, slug, category_id, is_published, view_count

article_translations  ← El texto real de cada artículo, en cada idioma
  id, article_id, locale (es|en|fr), title, description, content
```

Esta separación permite tener el mismo artículo en 3 idiomas sin duplicar metadatos.

---

## Solución de problemas — Panel de administración

### El formulario de login dice "Method Not Allowed"

**Síntoma:** Rellenas email y contraseña en `http://localhost/admin/login`, pulsas "Sign in" y aparece el error `MethodNotAllowedHttpException: The POST method is not supported for route admin/login`.

**Causa:** El JavaScript de Livewire (que gestiona el formulario) no se está cargando. Sin él, el formulario hace un envío HTML normal a la misma URL (`/admin/login`), que solo acepta GET.

**Solución:** Este problema ya está corregido — Nginx ahora enruta `/livewire/*` a PHP correctamente. Si reaparece, comprueba que el contenedor está actualizado:

```bash
docker compose restart nginx
```

**Verificación:** Abre las herramientas de desarrollador del navegador (F12 → pestaña "Network") y comprueba que `/livewire/livewire.js` devuelve código JavaScript (no una página HTML).

---

### El panel admin carga sin estilos (CSS/JS rotos)

**Síntoma:** La página `http://localhost/admin` carga pero se ve sin estilos — texto sin formato, sin colores, sin layout.

**Causa:** Los assets de Filament no están publicados o Nginx no los sirve correctamente.

**Solución:**

```bash
# 1. Publicar los assets de Filament
docker compose exec php-fpm php artisan filament:assets

# 2. Reiniciar nginx
docker compose restart nginx
```

**Verificación:**
```bash
curl -s http://localhost/js/filament/filament/app.js | head -c 50
# Debe mostrar código JS, no HTML
```

---

### "Access denied" al migrar (error de base de datos)

**Síntoma:** `php artisan migrate` falla con `Access denied for user`.

**Causas comunes y soluciones:**

1. **Contraseña con `#` sin comillas en `.env`:** El carácter `#` se interpreta como inicio de comentario. La contraseña `miPass#123` en `.env` equivale a `miPass`. Solución: añadir comillas dobles.
   ```env
   # MAL — el # y todo lo que sigue se ignoran
   DB_PASSWORD=miPass#123

   # BIEN — las comillas preservan el # como parte de la contraseña
   DB_PASSWORD="miPass#123"
   ```

2. **Caché de configuración desactualizada:** Después de cambiar `.env`, ejecuta:
   ```bash
   docker compose exec php-fpm php artisan config:clear
   ```

---

## Solución de problemas en Windows

### Cómo abrir la terminal correcta en Windows

Este proyecto requiere ejecutar comandos en la **terminal de Ubuntu (WSL2)**, no en PowerShell ni en CMD. Es importante porque los comandos `make`, `docker compose` y los scripts del proyecto están diseñados para Linux.

**Cómo abrir la terminal Ubuntu:**
- Abre el menú inicio y busca "Ubuntu"
- O abre **Windows Terminal** (si lo tienes instalado) y selecciona "Ubuntu" en el desplegable `∨` de la barra de pestañas
- O desde PowerShell, escribe `wsl` para entrar directamente

Verás el prompt:
```
tu_nombre@DESKTOP-XXXXX:~$
```

A partir de ahí, **todos los comandos de este README se ejecutan en esa ventana**.

---

### Primer uso — clonar el proyecto en WSL

Los archivos del proyecto deben estar **dentro del sistema de archivos de Linux (WSL)**, no en `C:\Users\...`. Trabajar desde `C:\` con WSL es muy lento y puede causar problemas de permisos.

```bash
# Desde la terminal Ubuntu:
mkdir -p ~/proyectos
cd ~/proyectos

# Opción A — clonar desde Git
git clone <URL_DEL_REPOSITORIO> WebRoblox
cd WebRoblox

# Opción B — si tienes el proyecto en un ZIP descargado en C:\Users\TuNombre\Downloads
cd /mnt/c/Users/TuNombre/Downloads    # el disco C: está en /mnt/c/ desde WSL
unzip WebRoblox.zip -d ~/proyectos/
cd ~/proyectos/WebRoblox
```

---

### El comando `make` no funciona

Si ves `make: command not found` o `'make' is not recognized`:

1. Asegúrate de estar en la **terminal Ubuntu (WSL2)**, no PowerShell ni CMD.
2. Si estás en Ubuntu y aun así falla, instala `make`:
   ```bash
   sudo apt update && sudo apt install make -y
   ```

---

### Docker Desktop no arranca o da error al iniciar

**Paso 1** — Comprueba que WSL2 está activo (PowerShell):
```powershell
wsl --status
# Debe mostrar: "Versión predeterminada: 2"
```

**Paso 2** — Activa la integración WSL en Docker Desktop:
- Docker Desktop → ⚙️ Settings → Resources → WSL Integration
- Activa el toggle de tu distribución Ubuntu
- Haz clic en "Apply & Restart"

**Paso 3** — Si Docker Desktop pide actualizar el kernel de WSL:
```powershell
# Ejecuta en PowerShell como administrador
wsl --update
wsl --shutdown
```
Luego vuelve a abrir Docker Desktop.

---

### `docker compose` no se reconoce en WSL

Docker Desktop en Windows instala el comando `docker` y `docker compose` en WSL automáticamente, pero solo si la integración está activada (ver apartado anterior).

Comprueba que funciona:
```bash
docker --version
docker compose version
```

Si no funcionan, cierra y vuelve a abrir la terminal Ubuntu después de activar la integración WSL en Docker Desktop.

---

### El puerto 80 está ocupado

En Windows, el puerto 80 puede estar ocupado por **IIS** (servidor web de Windows) o por **Skype**.

**Opción A** — Desactivar IIS temporalmente (PowerShell como administrador):
```powershell
net stop w3svc
```
Para volverlo a activar: `net start w3svc`

**Opción B** — Cambiar el puerto del proyecto (sin tocar Windows):
Abre `docker-compose.yml` y busca el servicio `nginx`. Cambia `"80:80"` por `"8080:80"`:
```yaml
ports:
  - "8080:80"   # antes era "80:80"
```
Luego accede a `http://localhost:8080` en vez de `http://localhost`.

---

### El puerto 3306 está ocupado (MySQL instalado en Windows)

Si tienes MySQL instalado directamente en Windows (no en Docker), ocupa el puerto 3306.

**Opción A** — Parar el MySQL de Windows:
- Abre el **Administrador de tareas** → pestaña "Servicios" → busca `MySQL` o `MySQL80` → clic derecho → "Detener"

**Opción B** — Cambiar el puerto en `docker-compose.yml`:
```yaml
# En el servicio mysql, cambia:
ports:
  - "3307:3306"   # antes era "3306:3306"
```

---

### Los contenedores no arrancan tras `make setup`

```bash
# Ver el estado de todos los contenedores
docker compose ps

# Ver el error exacto de cada servicio
docker compose logs php-fpm
docker compose logs mysql
docker compose logs nginx
```

El log suele indicar exactamente qué falta. Los errores más comunes y sus soluciones están en la sección "Solución de problemas — Panel de administración" de este mismo documento.

---

### `make setup` falla a mitad por timeout de MySQL

MySQL tarda en arrancar la primera vez. Si `make setup` falla con un error de conexión a la base de datos justo después de `docker compose up`, espera un poco y continúa manualmente:

```bash
# Esperar a que MySQL esté listo
sleep 20

# Continuar desde donde falló
docker compose exec php-fpm composer install
docker compose exec php-fpm php artisan key:generate
docker compose exec php-fpm php artisan migrate
docker compose exec php-fpm php artisan db:seed
docker compose exec php-fpm php artisan storage:link
docker compose exec php-fpm php artisan filament:assets
```

---

### Permisos denegados al ejecutar comandos en WSL

Si ves errores como `Permission denied` al ejecutar `make setup` o `docker compose exec`:

```bash
# Comprobar que eres el propietario del directorio del proyecto
ls -la ~/proyectos/

# Si los archivos son de root, arreglarlo:
sudo chown -R $USER:$USER ~/proyectos/WebRoblox
```

---

### Borrar todo y empezar de cero

```bash
# ⚠️ ATENCIÓN: esto borra todos los datos de la base de datos
docker compose down -v    # para contenedores Y borra los volúmenes (BD)
make setup                # reconstruye todo desde cero
make admin-user           # volver a crear el usuario administrador
```

---

### El navegador muestra "This site can't be reached"

1. Comprueba que los contenedores están corriendo:
   ```bash
   docker compose ps
   ```
   Todos deben aparecer con estado `running`. Si alguno aparece como `exited`, consulta sus logs.

2. Espera 30 segundos después de `docker compose up` — MySQL tarda un poco en arrancar la primera vez.

3. Comprueba que Docker Desktop sigue ejecutándose (icono de la ballena en la barra de tareas de Windows).

---

### Editar archivos del proyecto desde Windows

Puedes editar los archivos del proyecto con **VS Code** desde Windows, con acceso directo al sistema de archivos de WSL:

1. Instala la extensión **"WSL"** en VS Code
2. En la terminal Ubuntu, dentro de la carpeta del proyecto:
   ```bash
   code .
   ```
3. VS Code se abrirá con acceso al sistema de archivos de Linux. Los cambios que hagas se guardan directamente en WSL, sin problemas de permisos.

---

## Para más información

- **Backend (API y admin)**: lee [`backend/README.md`](backend/README.md)
- **Frontend (React)**: lee [`frontend/README.md`](frontend/README.md)
- **Comandos disponibles**: ejecuta `make help`
