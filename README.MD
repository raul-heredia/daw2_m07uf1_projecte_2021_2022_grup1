## Desplegament de l'Aplicació
Per a desplegar-la només haurem d'executar el script [deploy.sh](deploy.sh) com a usuari root que el que farà es instal·lar docker en cas de que no estigui instal·lat al sistema, canviar els permisos de la carpeta ./project/files a www-data.www-data per a que php pugui modificar els arxius que necessita, després construirà una imatge a partir del arxiu Dockerfile, a partir de la imatge [php:7.4-apache-bullseye](https://hub.docker.com/layers/php/library/php/7.4-apache-bullseye/images/sha256-2d2ac8ee0ea5bd1c0b5b39e42c45b8ac95f56edacaeb37eec307cf23f483cb42?context=explore), després instal·lará git, ja que serà necessari que el contenidor tingui git més endavant, un cop fet això instal·larà composer a partir del instal·lador de la seva pàgina oficial.Un cop construida la imatge crearà un contenidor de nom m07uf1projecte amb la imatge que acaba de crear que utilitza el port 80 de la màquina física, crearà un volum de la carpeta [project](project/) a la carpeta /var/www/html/ del contenidor, finalment executarà una comanda dintre del contenidor per a requerir dompdf, això farà que composer descarregui tot el necessari per a que dompdf funcioni i crearà les carpetes i fitxers adients.

En cas de voler canviar el port del contenidor, caldrà canviar a la línia 42 del script el primer 80 després del -p per el número de port que volguem utilitzar:

```bash
$ docker run --name m07uf1projecte -p 80:80 --restart unless-stopped -v ${PWD}/project:/var/www/html -d php-7-4-composer-carbonell-heredia
```

**Nota:** en cas de que el port seleccionat estigui en ús donarà error

Per executar el script simplement fem el següent:
```bash
$ chmod +x deploy.sh
$ sudo ./deploy.sh
```
