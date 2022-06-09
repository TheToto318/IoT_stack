FROM alpine:latest 

RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories && \
	apk update && \
	apk upgrade && \
	apk add --update php7 php7-mysqli mosquitto-clients tzdata

RUN cp /usr/share/zoneinfo/Europe/Paris /etc/localtime
RUN echo "Europe/Paris" >  /etc/timezone
RUN mkdir /sae23
COPY mqtt_mysql.php /sae23/
COPY mysql.php /sae23/
COPY startup.sh /sae23/

CMD /sae23/startup.sh && crond -f -l 8
		
			
