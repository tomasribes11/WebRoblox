# WINDSURF.md

This file provides guidance to Windsurf (Cascade) when working with code in this repository.

## Development Commands

```bash
# First time setup (creates everything from scratch)
make setup

# Daily usage
docker compose up -d          # Start services
docker compose down           # Stop services
docker compose logs -f        # View logs

# Backend (inside container)
docker compose exec php-fpm php artisan migrate
docker compose exec php-fpm php artisan db:seed
docker compose exec php-fpm php artisan test
docker compose exec php-fpm ./vendor/bin/pint   # Code style

# Makefile shortcuts
make migrate        # Run migrations
make db-reset       # ⚠️ Delete and recreate database
make backend-shell  # Terminal in PHP container
make pint           # Fix PHP code style
```

## Architecture

Dockerized stack: nginx 1.25 → php-fpm 8.2 (Laravel 11) + node 20 (React/Vite) + mysql 8.0

```
[browser] → nginx:80
               ├── /api/* /admin/* → php-fpm:9000 (FastCGI)
               └── /*              → node:5173 (Vite HMR, dev)
```

## Project Structure

```
WebRoblox/
├── backend/         ← Laravel 11 (REST API + Filament admin)
│   ├── app/
│   │   ├── Filament/Resources/ArticleResource.php  ← Admin panel for articles
│   │   ├── Http/Controllers/Api/                   ← AuthController, ArticleController, CategoryController
│   │   └── Models/                                 ← User, Article, ArticleTranslation, Category
│   ├── database/
│   │   ├── migrations/                             ← users, categories, articles, article_translations
│   │   └── seeders/                                ← 15 articles with 3 locales each
│   └── routes/api.php                              ← REST endpoints under /api/v1
├── frontend/        ← React 18 + Vite + Bootstrap 5.3
│   ├── src/
│   │   ├── api/                 ← axios.js (interceptors), auth.js, articles.js
│   │   ├── context/             ← AuthContext (user/login/logout), ThemeContext (dark/light)
│   │   ├── hooks/               ← useAuth, useArticles
│   │   ├── components/
│   │   │   ├── layout/          ← Layout, Navbar, Footer
│   │   │   ├── articles/        ← ArticleCard, ArticleGrid
│   │   │   ├── auth/            ← LoginForm, RegisterForm
│   │   │   └── ui/              ← LoadingSpinner, ErrorMessage, LanguageSwitcher
│   │   ├── pages/               ← HomePage, ArticlesPage, ArticleDetailPage, LoginPage, RegisterPage
│   │   └── styles/custom.css    ← CSS variables over Bootstrap (accent colors, gradients)
│   └── public/locales/          ← JSON translations (es/en/fr × common/articles)
├── docker/
│   ├── nginx/nginx.dev.conf     ← Dev proxy: /api/* → PHP, /* → Vite
│   └── php/Dockerfile           ← PHP 8.2-fpm + composer
├── legacy/          ← Original static site (preserved, do not touch)
├── docker-compose.yml
└── Makefile
```

## Database

4 main tables:
- `users` — role: enum('user','admin')
- `categories` — slug + name_es/en/fr
- `articles` — slug, category_id, is_published, view_count
- `article_translations` — article_id + locale + title + description + content (UNIQUE article_id+locale)

## API Endpoints (`/api/v1`)

| Method | Path | Auth |
|--------|------|------|
| POST | /auth/register | No |
| POST | /auth/login | No |
| POST | /auth/logout | Bearer |
| GET | /auth/me | Bearer |
| GET | /articles | No |
| GET | /articles/{slug} | No |
| GET | /categories | No |

All article endpoints accept `?locale=es|en|fr`.

## Conventions

- Communication language: Spanish; code: English
- Auth: Sanctum Bearer tokens stored in `localStorage` under key `auth_token`
- Theme: Bootstrap 5.3 `data-bs-theme="dark|light"` on `<html>`, managed by ThemeContext
- i18n: `react-i18next`, namespaces `common` and `articles`, files in `frontend/public/locales/`
- Article content comes from API (not hardcoded in JSON)
- Filament 3 admin panel at `/admin`, only users with `role='admin'`

## Windsurf-Specific Guidelines

### Model Recommendation
- **SWE-1.5** is recommended for this project due to:
  - Strong debugging capabilities for complex Laravel + React stack
  - Better understanding of Dockerized environments
  - More robust error handling and root cause analysis
  - Superior for maintaining existing codebases with multiple technologies

### Development Workflow
1. Use `make setup` for initial environment setup
2. Run `docker compose up -d` before starting development
3. Use the existing Makefile shortcuts for common tasks
4. Test API endpoints with Postman or similar tools
5. Frontend development happens at `http://localhost:5173`
6. Admin panel available at `http://localhost/admin`

### Windsurf Configuration (Docker + WSL + PowerShell 7)

#### Perfiles de Terminal Configurados:
- **PowerShell**: Terminal principal Windows (pwsh.exe)
- **WSL**: Terminal Ubuntu nativo (wsl.exe -d Ubuntu)
- **Docker**: Terminal dentro contenedor PHP-FPM

#### Atajos de Teclado:
- **Ctrl+Shift+D**: Iniciar servicios Docker
- **Ctrl+Shift+S**: Detener servicios Docker  
- **Ctrl+Shift+L**: Ver logs Docker
- **Ctrl+Shift+M**: Ejecutar migraciones Laravel
- **Ctrl+Shift+T**: Ejecutar tests Laravel
- **Ctrl+Shift+F**: Fix code style PHP
- **Ctrl+Shift+B**: Abrir terminal PHP container

#### Tasks Automatizados:
- Docker: Start/Stop/View Logs
- Laravel: Migrations/Tests/Code Style/Shell
- Node: Install dependencies/Build frontend
- Make: Project setup

#### Debug Configurado:
- Xdebug integrado con contenedor PHP
- Path mappings para /var/www/html → backend/
- Configuraciones para Laravel Artisan y Tests

#### Workflows Disponibles:
- `/docker-setup`: Configuración completa entorno Docker
- `/laravel-development`: Flujo desarrollo Laravel
- `/react-development`: Flujo desarrollo React

### Code Style Guidelines
- PHP: Follow PSR-12, use Laravel Pint (`make pint`)
- JavaScript/React: Use ES6+ syntax, functional components with hooks
- CSS: Bootstrap 5.3 classes with custom CSS variables in `styles/custom.css`
- Database: Use Laravel migrations and seeders, never modify database directly

### Testing Strategy
- Backend: Use Laravel PHPUnit tests (`php artisan test`)
- Frontend: Test components manually, consider adding Jest/React Testing Library
- API: Test all endpoints with different locales
- Admin: Verify Filament panel functionality

### Common Issues
- If containers won't start: check Docker Desktop, run `docker compose down && docker compose up -d`
- Database connection issues: ensure MySQL container is running, check `.env` file
- Frontend not updating: check Vite HMR, ensure port 5173 is available
- Admin panel 403: ensure user has `role='admin'` in database
