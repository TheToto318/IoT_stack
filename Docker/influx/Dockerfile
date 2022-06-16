#Building of the InfluxDB image provisionned with a default database ('capteurs') and user ('grafana 23')

#Use the InfluxDB 1.8 docker image for base image
FROM influxdb:1.8

#Copy the script including the database and user's  creation commands which will be started on the container startup 
COPY create_db_user.iql  /docker-entrypoint-initdb.d/