HUBSEARCH := docker compose exec php_hubsearch
HUBSEARCHCOMPOSER := docker compose exec php_hubsearch /userland/path/composer

init:
	$(HUBSEARCHCOMPOSER) create-project symfony/skeleton:"6.2.*" .
	$(HUBSEARCH) chmod a+rwx -R .

install:
	$(HUBSEARCHCOMPOSER) require predis/predis
	$(HUBSEARCHCOMPOSER) require guzzlehttp/guzzle
	$(HUBSEARCHCOMPOSER) install

temp:
	$(HUBSEARCHCOMPOSER)

php:
	$(HUBSEARCH) $(arg)

composer:
	$(HUBSEARCHCOMPOSER) $(arg)

console:
	$(HUBSEARCH) bin/console $(arg)

per:
	$(HUBSEARCH) chmod a+rwx -R .

reinstall_composer:
	rm -rf vendor/*
	$(HUBSEARCHCOMPOSER) install
	$(HUBSEARCH) chmod a+rwx -R .

rebuild_docker:
	docker compose build --no-cache
	docker compose up --remove-orphans

nuke:
	$(HUBSEARCH) rm -rf /srv/www/
