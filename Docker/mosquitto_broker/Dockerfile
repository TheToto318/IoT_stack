#Building of the custom msoquitto broker image with the metric generator included.

#Take the eclipse-mosquitto docker image for base
FROM eclipse-mosquitto:latest

#Install the required packages to connect to the MYSQL database and run the script (bash).
RUN apk add mysql-client bash

#Create the 'sae23' directory
RUN mkdir /sae23

#Copy the config file for the mosquitto broker inside the path made for this purpose.
COPY mosquitto.conf /mosquitto/config/

#Add the metric generator script inside the 'sae23' directory
COPY capteurs.sh /sae23/

#Add the wrapper script inside the 'sae23' directory
COPY wrapper_script.sh /sae23/wrapper_script.sh

#Run the wrapper script on the container starting
CMD /sae23/wrapper_script.sh