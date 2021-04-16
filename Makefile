up:
	docker-compose up -d
down:
	docker-compose down
build:
	docker-compose build
list:
	docker-compose ps

shell-php:
	docker-compose exec --user="1000" php bash