HUBSEARCH := docker compose exec php_hubsearch
HUBSEARCHCOMPOSER := docker compose exec php_hubsearch /userland/path/composer

init:
	$(HUBSEARCHCOMPOSER) create-project symfony/skeleton:"6.2.*" .
	$(HUBSEARCH) chmod a+rwx -R src/
	$(HUBSEARCH) chmod a+rwx -R config/

install:
	$(HUBSEARCHCOMPOSER) require symfony/orm-pack
	$(HUBSEARCHCOMPOSER) require dazzle-php/dazzle
	$(HUBSEARCHCOMPOSER) install

hsphp:
	$(HUBSEARCH) $(arg)

hscomposer:
	$(HUBSEARCHCOMPOSER) $(arg)

console:
	$(HUBSEARCH) bin/console $(arg)

rebuild:
	docker compose build --no-cache
	docker compose up --remove-orphans

clean:
	find app/* -type f,d -exec rm -rf {} \;
