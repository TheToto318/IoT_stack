<h1 align="center">Welcome to IoT_Stack 👋</h1>
<p>
  <img alt="Version" src="https://img.shields.io/badge/version-1.0.0-blue.svg?cacheSeconds=2592000" />
  <a href="https://github.com/TheToto318/IoT_stack/blob/main/README.md" target="_blank">
    <img alt="Documentation" src="https://img.shields.io/badge/documentation-yes-brightgreen.svg" />
  </a>
  <a href="https://github.com/TheToto318/IoT_stack/graphs/commit-activity" target="_blank">
    <img alt="Maintenance" src="https://img.shields.io/badge/Maintained%3F-yes-green.svg" />
  </a>
  <a href="https://github.com/TheToto318/IoT_stack/blob/main/LICENSE" target="_blank">
    <img alt="License: MIT" src="https://img.shields.io/github/license/TheToto318/IoT_Stack" />
  </a>
</p>

> IoT_stack that generate metrics values for buildings for visualization with Grafana and a HTML/PHP/JS dynamic website

### 🏠 [Homepage](https://github.com/TheToto318/IoT_stack)

## Project details 

Project scripts are based in the fallowing languages/tools : 
- Dynamic website : HTML/PHP/JS
- Metrics generator script : Bash
- MQTT metric parser : PHP and NodeRed
- Databases :
  - NodeRed : InfluxDB 1.8
  - Dynamic website : MariaDB

This project was made for an final assesement exam the 'SAE 23' of the BUT Réseaux et Télécoms by four students of the Blagnac college.


## Workflow

![Workflow](https://github.com/TheToto318/IoT_stack/blob/main/Diagramm/Workflow%20IoT_Stack.drawio.png)



## Install with docker-compose

```sh
git clone https://github.com/TheToto318/IoT_stack.git
docker compose -p "SAE 23" up -d
```

## Default credentials
- Grafana :
  - User : sae23
  - Password : grafana23
- InfluxDB :
  - Hostname : influxdb
  - Database : capteurs
  - User : grafana
  - Password : grafana23
- MariaDB :
  - Hostname : db
  - Database : sae23
  - User : sae23
  - Password : sae23pass

## Usage
Services are accessible by the following ports :
- Grafana : 3000 (TCP)
- NodeRed : 1880 (TCP)
- PHPMyAdmin : 1140 (TCP)
- Apache : 4443 (TCP)


## Debugging
Find the service name in the docker-compose.yml file and run :

```sh
docker-compose -f logs <service_name>
eg: docker-compose -f logs db
```

Or with the container name :

```sh
docker logs -f <container_name>
eg: docker logs -f logs db
```

## Grafana dashboard

![Grafana dashboard](https://github.com/TheToto318/IoT_stack/blob/main/Screenshots/Grafana.png)

### Specs 
Adaptative dashboard including : 
- New panel for each buildings
- Filter by :
  - Sensors type
  - Building
  - Floor
  - Room
- Direct, Min, Max and Average values of all sensors type.
- Graphs for all sensors type. 

## Flow NodeRED

![Flow NodeRED](https://github.com/TheToto318/IoT_stack/blob/main/Screenshots/NodeRED.png)

### Specs 
- Listen to all topics (iut/#)
- Parsing :
  - Sensor type
  - Building
  - Floor
  - Room
- Add unit to value.
- Insert value into the matching measurement table

## phpMyAdmin dashboard ( sae 23 database )

![phpmyadmin](https://github.com/TheToto318/IoT_stack/blob/main/Screenshots/phpmyadmin.png)

### sae23 database table specs 
- 'Administration' : Admin user and password (MD5 encrypted).
- 'Batiment' : Building name, login and password for the building manager.
- 'capteur' : Sensors type, building, floor, room, MQTT topic
- 'mesure' : measure date and time
- 'valeur' : value returned by sensors

Tables are linked by the fallowing foreign_key :
- 'valeur': id_mesure and id_capteur with 'id' column of table 'mesure' and 'capteur'.
- 'capteur' : 'batiment' column with the 'id' column of the 'batiment' table.

![conceptor_view](https://github.com/TheToto318/IoT_stack/blob/main/Screenshots/Conceptor_view_sae23.png)



## Author

👤 **Thomas Roux** (Backend developper)

* Github: [@TheToto318](https://github.com/TheToto318)

👤 **Clement Roques** (Frontend developper)

* Github: [@ClementRqs](https://github.com/ClementRqs)

👤 **Mattieu Naissant** (Frontend developper)

* Github: [@Snip31](https://github.com/Snip31)

## 🤝 Contributing

Contributions, issues and feature requests are welcome!<br />Feel free to check [issues page](https://github.com/TheToto318/IoT_stack/issues). You can also take a look at the [contributing guide](https://github.com/kefranabg/readme-md-generator/blob/master/CONTRIBUTING.md).

## Show your support

Give a ⭐️ if this project helped you!

## 📝 License

Copyright © 2022 [Thomas Roux](https://github.com/TheToto318).<br />
This project is [MIT](https://github.com/kefranabg/readme-md-generator/blob/master/LICENSE) licensed.

***
_This README was generated with ❤️ by [readme-md-generator](https://github.com/kefranabg/readme-md-generator)_
