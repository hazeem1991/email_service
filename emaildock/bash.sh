#!/bin/bash
docker-compose up --force-recreate   --remove-orphan -d mysql workspace php-fpm nginx
docker  exec -w /var/www/ EmailService_Core composer install
docker  exec -w /var/www/ EmailService_Core php artisan migrate
docker  exec -w /var/www/ EmailService_Core php artisan migrate --env=testing
docker  exec -w /var/www/ EmailService_Core php artisan cache:clear
docker  exec -w /var/www/ EmailService_Core php artisan queue:restart
docker  exec -w /var/www/ EmailService_Core service supervisor start
docker  exec -w /var/www/ EmailService_Core supervisorctl stop all
docker  exec -w /var/www/ EmailService_Core supervisorctl reread
docker  exec -w /var/www/ EmailService_Core supervisorctl update
docker  exec -w /var/www/ EmailService_Core supervisorctl start emailService-worker:*
docker  exec -w /var/www/resources/front EmailService_Core npm install
docker  exec -w /var/www/resources/front EmailService_Core npm run build
chmod 777 -R /var/www/storage
docker  exec -w /var/www/ EmailService_Core php artisan cache:clear
docker  exec -w /var/www/ EmailService_Core php artisan migrate:fresh --env=testing
docker  exec -w /var/www/ EmailService_Core ./vendor/bin/phpunit --testdox
