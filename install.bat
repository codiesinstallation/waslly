winget install -e --id Git.Git && git clone https://github.com/codiesinstallation/waslly.git && composer update --ignore-platform-req=ext-bolt && npm install && npm run prod && php artisan serve