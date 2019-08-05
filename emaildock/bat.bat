docker  exec -w /var/www/ EmailService_Core composer install
docker  exec -w /var/www/ EmailService_Core php artisan migrate
docker  exec -w /var/www/ EmailService_Core php artisan cache:clear
docker  exec -w /var/www/ EmailService_Core php artisan queue:restart
docker  exec -w /var/www/public/front EmailService_Core npm install
docker  exec -w /var/www/public/front EmailService_Core npm run build