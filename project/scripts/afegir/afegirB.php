<?php
    include '/var/www/html/scripts/global.php';
    session_start();
    if (isset($_SESSION['administrador'])) {
        $USERNAME = $_SESSION['administrador'][0];
        $USER = $_SESSION['administrador'][1];
    
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
            <title>Afegir Bibliotecari</title>
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
        $CONTRASENYA = $_POST['contrasenya'];
        $NOM = $_POST['nom'];
        $COGNOM = $_POST['cognom'];
        $ADRECA = $_POST['adreca'];
        $EMAIL = $_POST['email'];
        $TELEFON = $_POST['telefon'];
        $NUMSS = $_POST['numeross'];
        $DATACON = $_POST['datacon'];
        $SALARI = $_POST['salari'];
        IF($_POST['isadmin']){
            $ISADMIN = "true";
        }else{
            $ISADMIN = "false";
        }

        $FILENAME = "../../files/bibliotecaris.csv";
        $FITXER = fopen($FILENAME, "a");
        $BIBLIOTECARI = new Treballador($NOMUSUARI,$ISADMIN,$CONTRASENYA,$NOM,$COGNOM,$ADRECA,$EMAIL,$TELEFON,$NUMSS,$DATACON,$SALARI);
        $LINIA = array($BIBLIOTECARI->getUserName(), $BIBLIOTECARI->getPassword(), $BIBLIOTECARI->getIsAdmin() ,$BIBLIOTECARI->getNom(), $BIBLIOTECARI->getCognom(), $BIBLIOTECARI->getAdreca(), $BIBLIOTECARI->getEmail(), $BIBLIOTECARI->getTelefon(),$BIBLIOTECARI->getNumSS(),$BIBLIOTECARI->getDataCon(),$BIBLIOTECARI->getSalari());
        fputcsv($FITXER,$LINIA);
        fclose($FITXER);
        ?>
        <div class="options-flex">
        <div class="option-list">
        <h3>El Bibliotecari <?php echo $BIBLIOTECARI->getUserName()?> ha estat afegit correctament.</h3>
        <ul>
            <li><h3><strong>Resum</strong></h3></li>
            <li><strong>Nom Complet: </strong><?php echo "{$BIBLIOTECARI->getNom()} {$BIBLIOTECARI->getCognom()}"?></li>
            <li><strong>Direcció: </strong><?php echo $BIBLIOTECARI->getAdreca() ?></li>
            <li><strong>Direcció de Correu Electrònic: </strong><?php echo $BIBLIOTECARI->getEmail() ?></li>
            <li><strong>Nª de telèfon: </strong><?php echo $BIBLIOTECARI->getTelefon() ?></li>
            <li><strong>Nº Seguretat Social: </strong><?php echo $BIBLIOTECARI->getNumSS() ?></li>
            <li><strong>Data de Contractació: </strong><?php echo $BIBLIOTECARI->getDataCon() ?></li>
            <li><strong>Salari: </strong><?php echo $BIBLIOTECARI->getSalari() ?></li>
        <?php
        }else{
            header("Location: ../../403.php");
        } 
        ?>
        