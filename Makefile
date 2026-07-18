# =====================================
# Settings
# =====================================

MAKEFLAGS += --no-print-directory

CONSOLE=php bin/console
COMPOSE=docker compose
COMPOSE_EXEC=$(COMPOSE) exec php

.PHONY: up down rebuild bash install init-project cache-clear migrate create-database test-db test qa

# =====================================
# Docker
# =====================================

up:
	$(COMPOSE) up --build -d

down:
	$(COMPOSE) down

rebuild:
	$(COMPOSE) down -v --remove-orphans
	$(COMPOSE) up --build -d

bash:
	$(COMPOSE_EXEC) bash

# =====================================
# Initialisation
# =====================================

init:
	$(MAKE) up
	$(COMPOSE_EXEC) composer install
	$(COMPOSE_EXEC) $(CONSOLE) doctrine:database:drop --force --if-exists --env=dev
	$(COMPOSE_EXEC) $(CONSOLE) doctrine:database:create --env=dev
	$(COMPOSE_EXEC) $(CONSOLE) app:init-user-account --env=dev
	$(MAKE) cache-clear

# =====================================
# Symfony
# =====================================

cache-clear:
	$(COMPOSE_EXEC) $(CONSOLE) cache:clear

migration:
	$(COMPOSE_EXEC) $(CONSOLE) make:migration

migrate:
	$(COMPOSE_EXEC) $(CONSOLE) doctrine:migrations:migrate --no-interaction

# =====================================
# Database DEV
# =====================================

create-database:
	$(COMPOSE_EXEC) $(CONSOLE) doctrine:database:drop --force --if-exists --env=dev
	$(COMPOSE_EXEC) $(CONSOLE) doctrine:database:create --env=dev
	$(COMPOSE_EXEC) $(CONSOLE) doctrine:migrations:migrate --no-interaction --env=dev
	$(COMPOSE_EXEC) $(CONSOLE) app:init-user-account --env=dev
	$(COMPOSE_EXEC) $(CONSOLE) doctrine:fixtures:load --no-interaction --append --env=dev
	$(COMPOSE_EXEC) $(CONSOLE) cache:clear --env=dev

# =====================================
# Database TEST
# =====================================

test-db:
	$(COMPOSE_EXEC) $(CONSOLE) cache:clear --env=test
	$(COMPOSE_EXEC) $(CONSOLE) doctrine:database:drop --force --if-exists --env=test
	$(COMPOSE_EXEC) $(CONSOLE) doctrine:database:create --env=test
	$(COMPOSE_EXEC) $(CONSOLE) doctrine:migrations:migrate --no-interaction --env=test
	$(COMPOSE_EXEC) $(CONSOLE) app:init-user-account --env=test
	$(COMPOSE_EXEC) $(CONSOLE) doctrine:fixtures:load --no-interaction --append --env=test

# =====================================
# Tests
# =====================================

test:
	$(MAKE) test-db
	$(COMPOSE_EXEC) env XDEBUG_MODE=coverage php bin/phpunit --coverage-html var/coverage

# =====================================
# PHP CS Fixer
# =====================================

qa:
	./vendor/bin/php-cs-fixer fix --verbose
