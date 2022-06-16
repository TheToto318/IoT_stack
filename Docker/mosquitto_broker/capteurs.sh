#!/bin/bash

broker="localhost"
#user="student"
#pass="student"

sql="SELECT capteur.salle FROM capteur;";                                                       
i=0
while IFS=$'\t' read salle ;do
    salles[$i]=$salle                                                                                       #Get all the sensors room to put them into the 'salles' array which will be used to generate sensors values 
    ((i++))
done  < <(mysql -D 'sae23' --default-character-set=utf8 -u sae23 -psae23pass -h db -N -e "$sql")

sql="SELECT capteur.topic FROM capteur;";
i=0
while IFS=$'\t' read topic ;do
    topics[$i]=$topic                                                                                       #Get all the topics values to put them into the 'topics' array which will be used to generate sensors values 
    ((i++))
done  < <(mysql -D 'sae23' --default-character-set=utf8 -u sae23 -psae23pass -h db -N -e "$sql")

tailleSalles=$(echo ${#salles[@]})
tailleTopics=$(echo ${#topics[@]})
declare -A valTemp
declare -A valLum
declare -A valCo2
maxTemp=25
minTemp=18
maxLum=80
minLum=40
maxCo2=900
minCo2=300

for ((n=0;n<$tailleSalles;n++))
do
    valTemp[${salles[$n]}]=$(($RANDOM%($maxTemp -$minTemp + 1) + $minTemp ))
    valLum[${salles[$n]}]=$(($RANDOM%($maxLum -$minLum + 1) + $minLum ))
    valCo2[${salles[$n]}]=$(($RANDOM%($maxCo2 -$minCo2 + 1) + $minCo2 ))
done

while true
do
    for ((n=0;n<$tailleSalles;n++))
    do
        newTemp=$(($RANDOM%($maxTemp -$minTemp + 1) + $minTemp ))
        newLum=$(($RANDOM%($maxLum -$minLum + 1) + $minLum ))
        newCo2=$(($RANDOM%($maxCo2 -$minCo2 + 1) + $minCo2 ))

        diffTemp=$(($newTemp - valTemp[${salles[$n]}]))
        diffTemp2=$(echo $diffTemp | tr -d -)
        diffLum=$(($newLum - valLum[${salles[$n]}]))
        diffLum2=$(echo $diffLum | tr -d -)
        diffCo2=$(($newCo2 - valCo2[${salles[$n]}]))
        diffCo22=$(echo $diffCo2 | tr -d -)    
        while [ $diffTemp2 -ge 2 ]
        do
            newTemp=$(($RANDOM%($maxTemp -$minTemp + 1) + $minTemp ))      
            diffTemp=$(($newTemp - valTemp[${salles[$n]}]))
            diffTemp2=$(echo $diffTemp | tr -d -)       
        done
        while [ $diffLum2 -ge 20 ]
        do
            newLum=$(($RANDOM%($maxLum -$minLum + 1) + $minLum ))   
            diffLum=$(($newLum - valLum[${salles[$n]}]))
            diffLum2=$(echo $diffLum | tr -d -)  
        done
        while [ $diffCo22 -ge 100 ]
        do
            newCo2=$(($RANDOM%($maxCo2 -$minCo2 + 1) + $minCo2 ))       
            diffCo2=$(($newCo2 - valCo2[${salles[$n]}]))
            diffCo22=$(echo $diffCo2 | tr -d -)        
        done
        valTemp[${salles[$n]}]=$newTemp
        valLum[${salles[$n]}]=$newLum
        valCo2[${salles[$n]}]=$newCo2
    done

    for ((n=0;n<$tailleTopics;n++))
    do
        topic=$(echo ${topics[$n]})
        room=$(echo $topic | cut -d "/" -f 4)
        sensor=$(echo $topic | cut -d "/" -f 5)   
        if [ $sensor == "temperature" ]
        then
            val=$(echo ${valTemp[$room]})
        elif [ $sensor == "co2" ]
        then
            val=$(echo ${valCo2[$room]})
        else
            val=$(echo ${valLum[$room]})
        fi   
        mosquitto_pub -h $broker -t $topic -m $val
        sleep 5
    done
    sleep 10
    sql="SELECT capteur.salle FROM capteur;";
    i=0
    while IFS=$'\t' read salle ;do
        salles[$i]=$salle
        ((i++))
    done  < <(mysql -D 'sae23' --default-character-set=utf8 -u sae23 -psae23pass -h db -N -e "$sql")

    sql="SELECT capteur.topic FROM capteur;";
    i=0
    while IFS=$'\t' read topic ;do                                                                                    #Check after each values generated for new rooms or topics
        topics[$i]=$topic
        ((i++))
    done  < <(mysql -D 'sae23' --default-character-set=utf8 -u sae23 -psae23pass -h db -N -e "$sql")

    tailleSalles=$(echo ${#salles[@]})
    tailleTopics=$(echo ${#topics[@]})

    for ((n=0;n<$tailleSalles;n++))
    do
        valTemp[${salles[$n]}]=$(($RANDOM%($maxTemp -$minTemp + 1) + $minTemp ))
        valLum[${salles[$n]}]=$(($RANDOM%($maxLum -$minLum + 1) + $minLum ))
        valCo2[${salles[$n]}]=$(($RANDOM%($maxCo2 -$minCo2 + 1) + $minCo2 ))
    done
done
