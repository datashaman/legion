default:

fresh-database:
	php artisan migrate:fresh --seed

refresh-database:
	php artisan migrate:refresh --seed
