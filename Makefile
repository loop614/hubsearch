HUBSEARCH := docker compose exec php_hubsearch
HUBSEARCHCOMPOSER := docker compose exec php_hubsearch /userland/path/composer
HUBSEARCHCODECEPT := $(HUBSEARCH) vendor/bin/codecept

build:
	docker compose build --no-cache
	docker compose up --remove-orphans

install:
	$(HUBSEARCHCOMPOSER) create-project symfony/skeleton:"6.2.*" .
	$(HUBSEARCHCOMPOSER) require predis/predis
	$(HUBSEARCHCOMPOSER) require guzzlehttp/guzzle
	$(HUBSEARCHCOMPOSER) require --dev codeception/codeception
	$(HUBSEARCHCOMPOSER) require --dev squizlabs/php_codesniffer:"3.*"
	$(HUBSEARCHCOMPOSER) require --dev phpstan/phpstan

init:
	docker compose build --no-cache
	docker compose up --remove-orphans
	$(HUBSEARCH) chmod a+rwx -R .

composer_install:
	$(HUBSEARCHCOMPOSER) install

temp:
	$(HUBSEARCH) vendor/bin/phpstan analyse src tests

php:
	$(HUBSEARCH) $(arg)

composer:
	$(HUBSEARCHCOMPOSER) $(arg)

sniffer:
	$(HUBSEARCH) vendor/bin/phpcs -p --extensions=php src/
	$(HUBSEARCH) vendor/bin/phpcs -p --extensions=php tests/App/

phpstan:
	$(HUBSEARCH) vendor/bin/phpstan analyse src tests

console:
	$(HUBSEARCH) bin/console $(arg)

test_init:
	$(HUBSEARCH) php vendor/bin/codecept init App
	$(HUBSEARCH) php vendor/bin/codecept generate:suite app

test:
	$(HUBSEARCHCODECEPT) run --steps

per:
	$(HUBSEARCH) chmod a+rwx -R .

reinstall_composer:
	rm -rf vendor/*
	$(HUBSEARCHCOMPOSER) install
	$(HUBSEARCH) chmod a+rwx -R .

rebuild:
	docker compose build --no-cache
	docker compose up --remove-orphans

nuke:
	$(HUBSEARCH) rm -rf /srv/www/
