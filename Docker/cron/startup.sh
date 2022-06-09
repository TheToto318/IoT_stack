#!/bin/sh

echo "Starting startup.sh.."
echo "* * * * * php7 /sae23/mqtt_mysql.php" >> /etc/crontabs/root
crontab -l