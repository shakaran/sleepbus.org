#!/bin/bash

cd /var/www/html

# wait for mysql container
# * wordpress image's default entrypoint will also take some time
echo 'awaiting mysql to be reachable'

while ! mysqladmin ping -h sleepbussql --silent; do
    printf "."
    sleep 1
done

# still requires buffer before accessible for wp cli
sleep 5

# import seed data
mysql -u $SLEEPBUS_DB_USER -h $SLEEPBUS_DB_HOST -p$SLEEPBUS_DB_PASSWORD -e "create database $SLEEPBUS_DB_NAME"
mysql -u $SLEEPBUS_DB_USER -h $SLEEPBUS_DB_HOST -p$SLEEPBUS_DB_PASSWORD $SLEEPBUS_DB_NAME < /seed_data/sleepbus_sample_data.sql

# get container IP address
containerIP=$(ip route get 1 | awk '{print $NF;exit}')


# install PHP libs via Composer
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

. /sync_sources.sh

# rm composer.lock if exists
rm /var/www/html/application/composer.lock || true
composer install -d /var/www/html/application

# OPTIONAL: run log apache errors
#tail -f /var/log/apache2/error.log

echo "CodeIgniter installed and accessible on $containerIP"
