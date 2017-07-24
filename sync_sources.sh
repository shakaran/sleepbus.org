#!/bin/bash
echo 'syncing source files to plugin directory'

# run wp-cli cmds from wp install path
cd /var/www/html

# copy plugin source files to WP path (else changing ownership will change on host)
# ignore file ownership as we modify this post sync; ignore git folder
rsync -a --no-owner --exclude '.git/' --exclude '*.swp' /app/ /var/www/html

# www-data to own plugin src files 
chown -R www-data:www-data /var/www/html

