<?php
    include '/var/www/html/scripts/global.php';
    $USER;
    session_start();
    if (isset($_SESSION['bibliotecari'])) {
        $USERNAME = $_SESSION['bibliotecari'][0];
        $USER = $_SESSION['bibliotecari'][1];
    }
    if (isset($_SESSION['administrador'])) {
        $USERNAME = $_SESSION['administrador'][0];
        $USER = $_SESSION['administrador'][1];
    }
    if($USER){
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../../css/style.css" />
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
                integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
            <title>Afegir Clients</title>
            <style>
                <?php 
                include '/var/www/html/css/style.css'; // Per a que dompdf carregui el css correctament
                ?>
            </style>
        </head>

        <body>
        <nav>
        <ul>
            <li><a href="../../scripts/tancarsessio.php"><i class="fas fa-power-off"></i></a></li>
            <li><a class="disabled"><i class="fas fa-user"></i><?php echo $USERNAME?></a></li>
            <li><a class="disabled"><strong>Sessió: </strong><?php echo session_id()?></a></li>
            <li><a href="../retornainici.php"><i class="fas fa-arrow-left"></i></a></li>
        </ul>
        </nav>
            <main>
        <?php
        $NOMUSUARI = $_POST['username'];
        $NOM = $_POST['nom'];
        $COGNOM = $_POST['cognom'];
        $ADRECA = $_POST['adreca'];
        $EMAIL = $_POST['email'];
        $TELEFON = $_POST['telefon'];

        $FILENAME = "../../files/clients.csv";
        $FITXER = fopen($FILENAME, "a");
        
        $USUARI = new Client($NOMUSUARI,$NOM,$COGNOM,$ADRECA,$EMAIL,$TELEFON);
        $LINIA = array($USUARI->getUserName(), $USUARI->getPassword(), $USUARI->getNom(), $USUARI->getCognom(), $USUARI->getAdreca(), $USUARI->getEmail(), $USUARI->getTelefon(),"false",0,0);
        fputcsv($FITXER,$LINIA);
        fclose($FITXER);


        ?>
        <div class="options-flex">
            <div class="option-list">
            <h3>L'usuari <?php echo $USUARI->getUserName()?> ha estat afegit correctament.</h3>
            <ul>
                <li><h3><strong>Resum:</strong></h3></li>
                <li><strong>Nom Complet: </strong><?php echo "{$USUARI->getNom()} {$USUARI->getCognom()}"?></li>
                <li><strong>Direcció: </strong><?php echo $USUARI->getAdreca() ?></li>
                <li><strong>Direcció de Correu Electrònic: </strong><?php echo $USUARI->getEmail() ?></li>
                <li><strong>Nª de telèfon: </strong><?php echo $USUARI->getTelefon() ?></li>
                <?php
        }else{
            header("Location: ../../403.php");
        } 
        ?>
        </main>