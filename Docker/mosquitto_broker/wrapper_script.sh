#!/bin/bash
#Script made to run two process in the same time when the container start (source : docker.com)


# Start the first process
/usr/sbin/mosquitto -c /mosquitto/config/mosquitto.conf &
  
# Start the second process
/sae23/capteurs.sh &
  
# Wait for any process to exit
wait -n
  
# Exit with status of process that exited first
exit $?
