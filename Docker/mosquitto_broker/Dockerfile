FROM eclipse-mosquitto:latest

RUN apk add mysql-client bash
RUN mkdir /sae23
COPY mosquitto.conf /mosquitto/config/
COPY capteurs.sh /sae23/
COPY wrapper_script.sh /sae23/wrapper_script.sh
CMD /sae23/wrapper_script.sh