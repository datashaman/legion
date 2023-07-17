default:

fresh-database:
	rm -rf storage/app/public/avatars/*
	php artisan migrate:fresh --seed

refresh-database:
	rm -rf storage/app/public/avatars/*
	php artisan migrate:refresh --seed
