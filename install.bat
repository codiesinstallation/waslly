git clone https://github.com/codiesinstallation/waslly.git && cd waslly && composer update --ignore-platform-req=ext-bolt && php artisan mysql:createdb waslly && php artisan migrate:fresh && php artisan db:seed --class=BranchSeeder && php artisan db:seed --class=UserSeeder && php artisan db:seed --class=CitiesSeeder && npm install && npm run prod && php artisan serve --port=8085