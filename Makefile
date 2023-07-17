default:

fresh-database:
	php artisan migrate:fresh --seed
	rm -rf storage/app/public/avatars/*

refresh-database:
	php artisan migrate:refresh --seed
	rm -rf storage/app/public/avatars/*
