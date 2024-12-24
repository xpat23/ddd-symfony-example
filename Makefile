
DOCKER_COMPOSE = cd docker && docker-compose

build:
	$(DOCKER_COMPOSE) up --build -d
up:
	$(DOCKER_COMPOSE) up -d

down:
	$(DOCKER_COMPOSE) down

ssh:
	$(DOCKER_COMPOSE) exec php bash

install:
	$(DOCKER_COMPOSE) run --rm --no-deps composer install

composer-dump:
	$(DOCKER_COMPOSE) run --rm --no-deps php composer dump-autoload

ps:
	$(DOCKER_COMPOSE) ps

env:
	cp .env.dist .env && cp docker/.env.dist docker/.env

cc:
	$(DOCKER_COMPOSE) exec php php bin/console cache:clear

db-diff:
	$(DOCKER_COMPOSE) exec php php bin/console doctrine:migrations:diff

db-migrate:
	$(DOCKER_COMPOSE) exec php php bin/console doctrine:migrations:migrate