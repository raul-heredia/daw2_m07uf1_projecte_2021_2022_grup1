<?php
    include '/var/www/html/scripts/global.php';
    $USER;
    session_start();
    if (isset($_SESSION['administrador'])) {
        $USERNAME = $_SESSION['administrador'][0];
        $USERNAME = $_SESSION['administrador'][1];
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
            <title>Llista de Bibliotecaris</title>
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
            <li><a href=""><i class="fas fa-arrow-left"></i></a></li>
        </ul>
        </nav>
        <main>
        <?php
        $USERNAME = $_POST['username'];
        $NOM = $_POST['nom'];
        $COGNOM = $_POST['cognom'];
        $ADRECA = $_POST['adreca'];
        $EMAIL = $_POST['email'];
        $NUMSS = $_POST['numeross'];
        $TELEFON = $_POST['telefon'];
        $DATACON = $_POST['datacon'];
        $SALARI = $_POST['salari'];


        
        $FILENAME = "../../files/bibliotecaris.csv";
        $FITXER = fopen($FILENAME, "a");
        $LINIA = array($USERNAME,1234,$NOM,$COGNOM,$ADRECA,$EMAIL,$TELEFON,$NUMSS,$DATACON,$SALARI);
        fputcsv($FITXER,$LINIA);
        fclose($FITXER);

        }else{
            header("Location: ../../403.html");
        } 
        ?>
        