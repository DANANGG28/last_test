.PHONY: up down restart setup fresh test dev logs

# Start Docker containers (PostgreSQL & Redis)
up:
	docker compose up -d

# Stop Docker containers
down:
	docker compose down

# Restart Docker containers
restart:
	docker compose down && docker compose up -d

# Full project setup (run after cloning)
setup: up
	cp -n .env.example .env || true
	composer install
	php artisan key:generate
	sleep 3
	php artisan migrate --seed
	npm install
	npm run build
	@echo ""
	@echo "Setup selesai! Jalankan 'make dev' untuk mulai development."

# Fresh migrate + seed
fresh:
	php artisan migrate:fresh --seed

# Run tests
test:
	php artisan test

# Start development server
dev:
	composer dev

# View Docker container logs
logs:
	docker compose logs -f
