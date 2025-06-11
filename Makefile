.PHONY: help build up down restart logs shell composer artisan npm test

# Default target
help: ## Show this help message
	@echo 'Usage: make [target]'
	@echo ''
	@echo 'Targets:'
	@egrep '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

build: ## Build all containers
	docker-compose build

up: ## Start all containers
	docker-compose up -d

down: ## Stop all containers
	docker-compose down

restart: ## Restart all containers
	docker-compose restart

logs: ## Show logs from all containers
	docker-compose logs -f

logs-app: ## Show logs from app container
	docker-compose logs -f app

logs-nginx: ## Show logs from nginx container
	docker-compose logs -f nginx

logs-mysql: ## Show logs from mysql container
	docker-compose logs -f mysql

shell: ## Access app container shell
	docker-compose exec app bash

shell-root: ## Access app container shell as root
	docker-compose exec --user root app bash

composer: ## Run composer install
	docker-compose exec app composer install

composer-update: ## Run composer update
	docker-compose exec app composer update

artisan: ## Run artisan command (usage: make artisan cmd="migrate")
	docker-compose exec app php artisan $(cmd)

migrate: ## Run database migrations
	docker-compose exec app php artisan migrate

migrate-fresh: ## Fresh migration with seeding
	docker-compose exec app php artisan migrate:fresh --seed

seed: ## Run database seeding
	docker-compose exec app php artisan db:seed

npm: ## Run npm command (usage: make npm cmd="install")
	docker-compose exec node npm $(cmd)

npm-install: ## Install npm dependencies
	docker-compose exec node npm install

npm-dev: ## Run npm dev
	docker-compose exec node npm run dev

npm-build: ## Build assets for production
	docker-compose exec node npm run build

test: ## Run PHP tests
	docker-compose exec app php artisan test

mysql: ## Access MySQL console
	docker-compose exec mysql mysql -u laravel -p laravel

redis: ## Access Redis console
	docker-compose exec redis redis-cli

clean: ## Clean up containers and volumes
	docker-compose down -v
	docker system prune -f

install: ## Initial setup - build, up, and install dependencies
	# cp .env.docker .env
	docker-compose build
	docker-compose up -d
	sleep 10
	docker-compose exec app composer install
	docker-compose exec node npm install
	@echo "Setup completed! Visit http://localhost"

reset: ## Reset everything - clean and install
	make clean
	make install