install:
	composer install

lint:
	composer exec -- phpcs --standard=PSR12 app tests
	composer exec -- phpstan analyse

lint-fix:
	composer exec -- phpcbf --standard=PSR12 app tests

test:
	composer exec -- phpunit
