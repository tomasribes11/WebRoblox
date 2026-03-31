# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Comandos de desarrollo

```bash
# Primera vez (crea todo desde cero)
make setup

# Uso diario
docker compose up -d          # Arrancar
docker compose down           # Parar
docker compose logs -f        # Ver logs

# Backend (dentro del contenedor)
docker compose exec php-fpm php artisan migrate
docker compose exec php-fpm php artisan db:seed
docker compose exec php-fpm php artisan test
docker compose exec php-fpm ./vendor/bin/pint   # Code style

# Makefile shortcuts
make migrate        # Ejecutar migraciones
make db-reset       # ⚠️ Borrar y recrear BD
make backend-shell  # Terminal en contenedor PHP
make pint           # Arreglar estilo PHP
```

## Arquitectura

Stack dockerizado: nginx 1.25 → php-fpm 8.2 (Laravel 11) + node 20 (React/Vite) + mysql 8.0

```
[browser] → nginx:80
               ├── /api/* /admin/* → php-fpm:9000 (FastCGI)
               └── /*              → node:5173 (Vite HMR, dev)
```

## Estructura del proyecto

```
WebRoblox/
├── backend/         ← Laravel 11 (API REST + admin Filament)
│   ├── app/
│   │   ├── Filament/Resources/ArticleResource.php  ← Panel admin artículos
│   │   ├── Http/Controllers/Api/                   ← AuthController, ArticleController, CategoryController
│   │   └── Models/                                 ← User, Article, ArticleTranslation, Category
│   ├── database/
│   │   ├── migrations/                             ← users, categories, articles, article_translations
│   │   └── seeders/                                ← 15 artículos con 3 locales cada uno
│   └── routes/api.php                              ← Endpoints REST bajo /api/v1
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
│   │   └── styles/custom.css    ← Variables CSS sobre Bootstrap (accent colors, gradients)
│   └── public/locales/          ← Traducciones JSON (es/en/fr × common/articles)
├── docker/
│   ├── nginx/nginx.dev.conf     ← Proxy dev: /api/* → PHP, /* → Vite
│   └── php/Dockerfile           ← PHP 8.2-fpm + composer
├── legacy/          ← Sitio estático original (preservado, no tocar)
├── docker-compose.yml
└── Makefile
```

## Base de datos

4 tablas principales:
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

Todos los endpoints de artículos aceptan `?locale=es|en|fr`.

## Convenciones

- Idioma comunicación: español; código: inglés
- Auth: Sanctum Bearer tokens guardados en `localStorage` bajo clave `auth_token`
- Tema: Bootstrap 5.3 `data-bs-theme="dark|light"` en `<html>`, gestionado por ThemeContext
- i18n: `react-i18next`, namespaces `common` y `articles`, archivos en `frontend/public/locales/`
- Contenido de artículos viene de la API (no hardcodeado en JSON)
- Panel admin Filament 3 en `/admin`, solo usuarios con `role='admin'`
