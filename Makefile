# Makefile — Comandos de desarrollo para WebRoblox
# Uso: make <comando>

.PHONY: help setup up down logs backend-setup backend-shell frontend-shell db-reset pint

## Muestra esta ayuda
help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-20s\033[0m %s\n", $$1, $$2}'

## ─── PRIMERA VEZ ──────────────────────────────────────────────────────────

setup: ## Configuración completa (ejecutar una sola vez)
	@echo "📦 Copiando archivos de entorno..."
	@cp -n .env.example .env || true
	@cp -n backend/.env.example backend/.env || true
	@cp -n frontend/.env.example frontend/.env.local || true
	@echo "🐳 Construyendo e iniciando contenedores..."
	docker compose up -d --build
	@echo "⏳ Esperando a que MySQL esté listo..."
	@sleep 15
	@echo "📦 Instalando dependencias PHP..."
	docker compose exec php-fpm composer install
	@echo "🔑 Generando clave de aplicación Laravel..."
	docker compose exec php-fpm php artisan key:generate
	@echo "🗃️ Ejecutando migraciones..."
	docker compose exec php-fpm php artisan migrate
	@echo "🌱 Sembrando datos iniciales..."
	docker compose exec php-fpm php artisan db:seed
	@echo "🔗 Creando enlace simbólico de storage..."
	docker compose exec php-fpm php artisan storage:link
	@echo "🎨 Publicando assets de Filament..."
	docker compose exec php-fpm php artisan filament:assets
	@echo ""
	@echo "✅ Listo. Ahora ejecuta:"
	@echo "   make admin-user   → para crear el usuario administrador"
	@echo "   Abre http://localhost en el navegador"

admin-user: ## Crea el usuario administrador de Filament
	docker compose exec php-fpm php artisan make:filament-user

## ─── USO DIARIO ────────────────────────────────────────────────────────────

up: ## Inicia todos los contenedores
	docker compose up -d

down: ## Para todos los contenedores
	docker compose down

logs: ## Ver logs en tiempo real (Ctrl+C para salir)
	docker compose logs -f

logs-backend: ## Ver solo logs del backend PHP
	docker compose logs -f php-fpm

## ─── BACKEND ───────────────────────────────────────────────────────────────

backend-shell: ## Abre una terminal dentro del contenedor PHP
	docker compose exec php-fpm bash

migrate: ## Ejecuta las migraciones pendientes
	docker compose exec php-fpm php artisan migrate

db-reset: ## ⚠️  Borra y recrea toda la base de datos
	docker compose exec php-fpm php artisan migrate:fresh --seed

pint: ## Corrige el estilo del código PHP
	docker compose exec php-fpm ./vendor/bin/pint

test-backend: ## Ejecuta los tests de PHP
	docker compose exec php-fpm php artisan test

## ─── FRONTEND ──────────────────────────────────────────────────────────────

frontend-shell: ## Abre una terminal dentro del contenedor Node
	docker compose exec node sh

## ─── LIMPIEZA ──────────────────────────────────────────────────────────────

clean: ## ⚠️  Borra todos los contenedores y volúmenes (PIERDE LA BD)
	docker compose down -v
