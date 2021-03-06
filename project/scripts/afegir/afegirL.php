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
            <title>Afegir Llibre</title>
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
        $ISBN = $_POST['isbn'];
        $TITOL = $_POST['titol'];
        $AUTOR = $_POST['autor'];

        $FILENAME = "../../files/llibres.csv";
        $FITXER = fopen($FILENAME, "a");
        $LLIBRE = new Llibre($ISBN, $TITOL, $AUTOR);
        $LINIA = array($LLIBRE->getISBN(), $LLIBRE->getTitol(),$LLIBRE->getAutor(),"false",0,0);
        
        fputcsv($FITXER,$LINIA);
        fclose($FITXER);
        ?>
        <div class="options-flex">
        <div class="option-list">
        <h3>El Llibre <?php echo $LLIBRE->getTitol()?> ha estat afegit correctament.</h3>
        <ul>
            <li><h3><strong>Resum</strong></h3></li>
            <li><strong>ISBN: </strong><?php echo $LLIBRE->getISBN()?></li>
            <li><strong>Títol: </strong><?php echo $LLIBRE->getTitol()?></li>
            <li><strong>Autor: </strong><?php echo $LLIBRE->getAutor()?></li>
            
        <?php
        }else{
            header("Location: ../../403.php");
        } 
        ?>
        </main>