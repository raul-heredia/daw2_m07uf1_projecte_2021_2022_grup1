<?php
    include '/var/www/html/scripts/global.php';
    session_start(); 
    if (isset($_SESSION['usuari'])) {
        $USERNAME = $_SESSION['usuari'][0];
        $USER = $_SESSION['usuari'][1];
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="/var/www/html/css/style.css" />
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
                integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
            <title>Les meves dades</title>
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
            <div class="options-flex">
                <div class="option-list">
            <?php
            if (($CLIENTS = fopen("../../files/clients.csv", "r")) !== FALSE) {
                while (($USUARIS = fgetcsv($CLIENTS, 1000, ",")) !== FALSE) {
                    if ($USERNAME == $USUARIS[0]){
                        ?>
                        <ul>
                            <li><strong>Nom Complet: </strong><?php echo $USER ?></li>
                            <li><strong>Direcció: </strong><?php echo $USUARIS[4] ?></li>
                            <li><strong>Direcció de Correu Electrònic: </strong><?php echo $USUARIS[5] ?></li>
                            <li><strong>Nª de telèfon: </strong><?php echo $USUARIS[6] ?></li>
                            
                            <?php
                                    if($USUARIS[7] == "true"){
                                        if (($LLIBRES = fopen("../../files/llibres.csv", "r")) !== FALSE) {
                                            while (($LLIBRE = fgetcsv($LLIBRES, 1000, ",")) !== FALSE) {
                                                if($LLIBRE[0] == $USUARIS[8]){
                                                    ?>
                                                    <li><strong>ISBN Llibre en préstec: </strong><?php echo $LLIBRE[0] ?></li> 
                                                    <li><strong>Nom del llibre en préstec: </strong><?php echo $LLIBRE[1] ?></li>
                                                    <li><strong>Data d'inici préstec: </strong><?php echo $USUARIS[9] ?></li> 
                                                    <?php
                                                }
                                            }fclose($LLIBRES);
                                            ?>
                                    <li><strong></strong></li>
                                    <?php
                            }
                        }
                    }
                }fclose($CLIENTS);
            }
            ?></div></div><?php
    }else{
        header("Location: ../../403.php");
    }
?>