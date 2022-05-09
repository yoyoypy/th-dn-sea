composer install
npm install
npm run dev

make db
copy env.example to .env
set DB_DATABASE

php artisan migrate
php artisan serve
