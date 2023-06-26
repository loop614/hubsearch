HUBSEARCH := docker compose exec php_hubsearch
HUBSEARCHCOMPOSER := docker compose exec php_hubsearch /userland/path/composer
HUBSEARCHCODECEPT := $(HUBSEARCH) vendor/bin/codecept

build:
	docker compose build --no-cache
	docker compose up --remove-orphans

init:
	docker compose build --no-cache
	docker compose up --remove-orphans
	$(HUBSEARCHCOMPOSER) create-project symfony/skeleton:"6.2.*" .
	$(HUBSEARCH) chmod a+rwx -R .
	$(HUBSEARCHCOMPOSER) require predis/predis
	$(HUBSEARCHCOMPOSER) require guzzlehttp/guzzle
	$(HUBSEARCHCOMPOSER) require codeception/codeception --dev
	$(HUBSEARCHCOMPOSER) install

temp:
	$(HUBSEARCH) php vendor/bin/codecept generate:test Unit Score

php:
	$(HUBSEARCH) $(arg)

composer:
	$(HUBSEARCHCOMPOSER) $(arg)

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
