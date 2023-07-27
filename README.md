## Description
- symfony project example
- search Github issues and display number of rocks/sucks words with 1-10 grade
- has redis cache


## Requirements
- make
- docker with compose


## Quick start
```console
$ make env
$ make build
$ make install # while docker compose running
```
- open localhost:12345/score?term=somethingelse


## Run tests
- make test_init
- make test


## Run code quality tools
- make phpstan
- make sniffer


## TODOs
- fix phpcodesniffer
- setup cli
