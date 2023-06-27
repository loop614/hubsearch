## Description
- example symfony project
- search Github issues and display number of rocks/sucks words with 1-10 grade
- has redis cache

## Requirements
- make
- docker with compose

## Quick start
- make sure to add .env.local to app/ containing mygithubtoken
- make init
- make composer_install (in separate terminal)
- open localhost:12345/score?term=somethingelse on your favourite browser
- for later runs just use docker compose up

## Run tests
- make test_init
- make test

## Run code quality tools
- make phpstan
- make sniffer

## TODOs
- fix phpcodesniffer
- setup cli
