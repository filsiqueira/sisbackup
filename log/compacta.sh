#!/bin/bash

data=`date +%d-%m-%Y`

cd /var/www/html/sisbackup/log

zip -r $data $data

chown -R www-data:www-data *
chmod -R 777 *
