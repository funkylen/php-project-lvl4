install:
	composer install

test-setup:
	composer install
	php artisan key:gen --ansi
	php artisan migrate --seed
	npm ci
	npm run build

lint:
	composer exec -- phpcs --standard=PSR12 app tests
	composer exec -- phpstan analyse

lint-fix:
	composer exec -- phpcbf --standard=PSR12 app tests

test:
	composer exec -- phpunit

test-coverage:
	XDEBUG_MODE=coverage composer exec -- phpunit --coverage-clover=build/logs/clover.xml
