#!/bin/bash
DOCKER=0
COMPOSE=0

if [ "${EUID}" -ne 0 ]
then 
    echo "Executa amb permisos d'administrador";
    exit
fi

docker -v > /dev/null 2>&1

if [[ ${?} -ne 0 ]];
then
    DOCKER=1;
fi

docker-compose -v > /dev/null 2>&1

if [[ $? -ne 0 ]];
then
    COMPOSE=1;
fi

if [[ ${DOCKER} -eq 1  || ${COMPOSE} -eq 1 ]];
then
echo "Instalant Docker i Docker-compose"
apt-get update > /dev/null 2>&1
apt-get install docker-ce docker-ce-cli containerd.io -y > /dev/null 2>&1
if [[ $? -eq 0 ]];
then
    echo "[OK] Docker Instalat"
else
    echo "[Error] No s'ha pogut instalar Docker"
fi
usermod -aG docker $USER > /dev/null 2>&1
if [[ $? -eq 0 ]];
then
    echo "[OK] Docker-Compose Instalat"
else
    echo "[Error] No s'ha pogut instalar Docker-Compose"
fi
fi

docker build -t php-7-4-composer-carbonell-heredia . > /dev/null 2>&1 && echo "[OK] S'ha construit la imatge" || echo "[ERROR] No s'ha pogut construir la imatge"

docker run --name m07uf1projecte -p 80:80 --restart unless-stopped -v ${PWD}/project:/var/www/html -d php-7-4-composer-carbonell-heredia > /dev/null 2>&1 && echo "[OK] S'ha desplegat el contenidor" || echo "[ERROR] No s'ha pogut crear el contenidor, comprova que els ports no estiguin en ús"

