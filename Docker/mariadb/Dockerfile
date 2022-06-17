#Building of the MariaDB image provisionned with a default database ('sae23')

#Use the last MariaDB docker image for base image
FROM mariadb:latest

#Copy the database creation script which will be launched at the container startup
COPY DB.sql /docker-entrypoint-initdb.d/