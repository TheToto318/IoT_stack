#Building of the custom cron image in charge of recovering the sensors data from the MQTT broker to send it to the MySQL database.

#Use the last alpine image for the base image. 
FROM alpine:latest 

#Install requirement for the PHP script to run : PHP, MySQL plugin for PHP and the mosquitto client.
RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories && \
	apk update && \
	apk upgrade && \
	apk add --update php7 php7-mysqli mosquitto-clients tzdata

#Set the time zone, useful for logs.
RUN cp /usr/share/zoneinfo/Europe/Paris /etc/localtime
RUN echo "Europe/Paris" >  /etc/timezone

#Create directory '/sae23'
RUN mkdir /sae23

#Copy the retrival script to the 'sae23' directory
COPY mqtt_mysql.php /sae23/

#Copy the database login script to the 'sae23' directory
COPY mysql.php /sae23/

#Copy the startup script to the 'sae23' directory
COPY startup.sh /sae23/

#Run the startup script when the container start
CMD /sae23/startup.sh && crond -f -l 8
		
			
