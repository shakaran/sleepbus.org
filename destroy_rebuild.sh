#!/bin/bash

# source env vars to use in Docker run commands
. ./env-vars

# convenience script to destroy any running containers, rebuild (with cache) and output notifications from script watching/syncing source files
sudo docker rm -f sleepbussql
sudo docker rm -f sleepbusweb
sudo docker rm -f mailcatcher
sudo docker rm -f phpmyadmin
sudo docker build -t sleepbus/web:latest . 
sudo docker run -d -p 1080:1080 --name mailcatcher schickling/mailcatcher
sudo docker run --name sleepbussql -e MYSQL_ROOT_PASSWORD=$SLEEPBUS_DB_PASSWORD -d mariadb
sudo docker run --name sleepbusweb --link sleepbussql:mysql --link mailcatcher:mailcatcher --env-file ./env-vars -p 8080:80 -d -v $(pwd)/src/:/app sleepbus/web
sudo docker run --name phpmyadmin -d --link sleepbussql:db -p 3008:80 phpmyadmin/phpmyadmin
sudo docker exec sleepbusweb sh /post_launch.sh
sudo docker exec -it sleepbusweb sh /watch_source_files.sh
