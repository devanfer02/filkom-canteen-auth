include .env

.PHONY: help
help:
	@echo "Choose a command:"
	@echo "  make run            	- Run the PHP application"
	@echo "  make compose-up        - Spin up docker containers"
	@echo "  make compose-down      - Stop docker containers"

.PHONY: run
run:
	php -S localhost:$(APP_PORT) router.php

.PHONY: compose-up
compose-up:
ifndef file
	docker compose up -d
else
	docker compose -f $(file) up -d
endif 

.PHONY: compose-down
compose-down:
ifndef file
	docker compose down
else
	docker compose -f $(file) down 
endif 
