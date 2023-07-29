HUBSEARCH := docker compose exec php_hubsearch
HUBSEARCHCOMPOSER := docker compose exec php_hubsearch /userland/path/composer
HUBSEARCHCODECEPT := $(HUBSEARCH) vendor/bin/codecept

build:
	docker compose build
	docker compose up

install:
	$(HUBSEARCH) chmod a+rwx -R .
	$(HUBSEARCHCOMPOSER) install

open:
	$(HUBSEARCH) /bin/bash

skeleton:
	$(HUBSEARCHCOMPOSER) create-project symfony/skeleton:"6.2.*" .

composer_require:
	$(HUBSEARCHCOMPOSER) require predis/predis
	$(HUBSEARCHCOMPOSER) require guzzlehttp/guzzle
	$(HUBSEARCHCOMPOSER) require --dev codeception/codeception
	$(HUBSEARCHCOMPOSER) require --dev squizlabs/php_codesniffer:"3.*"
	$(HUBSEARCHCOMPOSER) require --dev phpstan/phpstan

composer_install:
	$(HUBSEARCHCOMPOSER) install

temp:
	$(HUBSEARCH)

php:
	$(HUBSEARCH) $(arg)

composer:
	$(HUBSEARCHCOMPOSER) $(arg)

sniffer:
	$(HUBSEARCH) vendor/bin/phpcs -p --extensions=php src/
	$(HUBSEARCH) vendor/bin/phpcs -p --extensions=php tests/App/

snifferf:
	$(HUBSEARCH) vendor/bin/phpcbf -p --extensions=php src/
	$(HUBSEARCH) vendor/bin/phpcbf -p --extensions=php tests/App/

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
	rm -rf app/vendor/*
	$(HUBSEARCHCOMPOSER) install
	$(HUBSEARCH) chmod a+rwx -R .

rebuild:
	docker compose build --no-cache
	docker compose up --remove-orphans

cache:
	$(HUBSEARCHCOMPOSER) clear-cache
	rm -rf var/cache

nuke:
	$(HUBSEARCH) rm -rf /srv/www/

env:
	cp  app/.env app/.env.local
