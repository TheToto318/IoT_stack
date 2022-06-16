#Builing of the pre-provisionned grafana docker image.



#Use the latest grafana image for base image 
FROM grafana/grafana 

#Copy the provisionning folder into the '/etc/grafana/' path
#Provisionning folder contain the list of dashboard and data sources.
ADD ./provisioning /etc/grafana/provisioning

#Copy the grafana config file into the '/etc/grafana/' path
#Grafana config file contain setting such as the administrator password, the default path for provisionning (see above) and the path for the default dashboard (see below)
ADD ./grafana.ini /etc/grafana/grafana.ini

#Copy the dashboard folder into the '/var/lib/grafana/' path 
#Dashboard folder contain the dashboard .json file (IoT_Blagnac).
ADD ./dashboards /var/lib/grafana/dashboards
