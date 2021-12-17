<?php
include 'global.php';

$NOMUSUARI = "foo";
$CONTRASENYA = "foo123";
$NOM = "foo";
$COGNOM = "bar lorem";
$ADRECA = "C/ Foo Bar 420";
$EMAIL = "foo@bar.com";
$TELEFON = 666778899;

$USUARI = new Client($NOMUSUARI,$CONTRASENYA,$NOM,$COGNOM,$ADRECA,$EMAIL,$TELEFON);
$LINIA = array($USUARI->getUserName(), $USUARI->getPassword(), $USUARI->getNom(), $USUARI->getCognom(), $USUARI->getAdreca(), $USUARI->getEmail(), $USUARI->getTelefon(),"false",0,0);

foreach ($LINIA as $CAMP) {
    echo "$CAMP </br>";
}

echo "<------------------------------------>";

$BIBLIOTECARI = new Treballador($NOMUSUARI,$CONTRASENYA,$NOM,$COGNOM,$ADRECA,$EMAIL,$TELEFON,6677889900,"25-5-1972",1200);
$LINIA2 = array($BIBLIOTECARI->getUserName(), $BIBLIOTECARI->getPassword(), $BIBLIOTECARI->getIsAdmin() ,$BIBLIOTECARI->getNom(), $BIBLIOTECARI->getCognom(), $BIBLIOTECARI->getAdreca(), $BIBLIOTECARI->getEmail(), $BIBLIOTECARI->getTelefon(),$BIBLIOTECARI->getNumSS(),$BIBLIOTECARI->getDataCon(),$BIBLIOTECARI->getSalari());

foreach ($LINIA2 as $CAMP2) {
    echo "$CAMP2 </br>";
}

?>