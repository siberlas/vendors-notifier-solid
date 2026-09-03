cs-fix:
	./vendor/bin/php-cs-fixer fix --diff

cs-check:
	./vendor/bin/php-cs-fixer fix --dry-run --diff

phpstan:
	./vendor/bin/phpstan analyse

test:
	./vendor/bin/phpunit

ci: cs-check phpstan test