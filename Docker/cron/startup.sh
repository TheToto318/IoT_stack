#!/bin/sh

# Startup script for the cron docker image, run every minutes the php script to get sensors data from the MQTT broker

echo "Starting startup.sh.."
echo "* * * * * php7 /sae23/mqtt_mysql.php" >> /etc/crontabs/root  
crontab -l