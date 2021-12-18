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
            <title>Modificar Llibre</title>
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
        $TODAY = date('d-m-Y');
        $USUARIPRESTEC = false;
        $NOEXISTEIX = false;

        if( $_POST["method"] == "PUT" ){
            if (($CLIENTS = fopen("../../files/clients.csv", "r")) !== FALSE) {
                while (($USUARIS = fgetcsv($CLIENTS, 1000, ",")) !== FALSE) {
                        if($USUARIS[0] == $_POST['username']){
                            if($USUARIS[7] == "true"){
                                $USUARIPRESTEC = true;
                            }else{
                                $NOEXISTEIX = true;
                            }
                        }
                    }
                }fclose($CLIENTS);
            if (($LLIBRES = fopen("../../files/llibres.csv", "r")) !== FALSE) {
                    while (($LLIBRE = fgetcsv($LLIBRES, 1000, ",")) !== FALSE) {
                            if($LLIBRE[0] == $_POST['isbn']){
                                if($LLIBRE[3] != "true" && !$USUARIPRESTEC && !$NOEXISTEIX){
                                    $LLIBRE[3] = "true";
                                    $LLIBRE[4] = $TODAY;
                                    $LLIBRE[5] = $_POST['username'];
                                }else{
                                    $ISPRESTAT = true;
                                }
                            }
                            $LLIBRESTEMP[] = $LLIBRE;
                        }
                    }fclose($LLIBRES);
                    $FP = fopen("../../files/llibres.csv", 'w');
                    foreach($LLIBRESTEMP as $LLIBRE){
                        fputcsv($FP, $LLIBRE);
                    }
                    fclose($FP);
                    if (($CLIENTS = fopen("../../files/clients.csv", "r")) !== FALSE) {
                        while (($USUARIS = fgetcsv($CLIENTS, 1000, ",")) !== FALSE) {
                                if($USUARIS[0] == $_POST['username']){
                                    if(!$USUARIPRESTEC && !$ISPRESTAT && !$NOEXISTEIX){
                                        $USUARIS[7] = "true";
                                        $USUARIS[8] = $_POST['isbn'];
                                        $USUARIS[9] = $TODAY;
                                    }else{
                                        echo "Error, comprova que l'usuari existeixi, que no tingui cap llibre en préstec i/o que el llibre seleccionat no es trobi en préstec";
                                    }
                                }
                                $USUARISTEMP[] = $USUARIS;
                            }
                        }fclose($CLIENTS);
                        $FP = fopen("../../files/clients.csv", 'w');
                        foreach($USUARISTEMP as $USER){
                            fputcsv($FP, $USER);
                        }
                        fclose($FP);
            }
        }else{
            header("Location: ../../403.php");
        } 
        ?>
        </main>