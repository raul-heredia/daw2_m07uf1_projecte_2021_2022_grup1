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
        $LNOEXISTEIX = true;
        if( $_POST["method"] == "PUT" ){
            if (($LLIBRES = fopen("../../files/llibres.csv", "r")) !== FALSE) {
                    while (($LLIBRE = fgetcsv($LLIBRES, 1000, ",")) !== FALSE) {
                            if($LLIBRE[0] == $_POST['isbn']){
                                $LNOEXISTEIX = false;
                                if($LLIBRE[3] == "true"){
                                    $LLIBRE[3] = "false";
                                    $LLIBRE[4] = 0;
                                    $LLIBRE[5] = 0;
                                }else{
                                    echo "<h3><strong>Error</strong>, el llibre amb ISBN <strong>".$_POST['isbn']."</strong> no es troba en préstec.</h3>";
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
                                if($USUARIS[8] == $_POST['isbn'] && !$LNOEXISTEIX){
                                    if($USUARIS[7] == "true"){
                                        $USUARIS[7] = "false";
                                        $USUARIS[8] = 0;
                                        $USUARIS[9] = 0;
                                        echo "<h3>El usuari <strong>$USUARIS[0]</strong> ha retornat el llibre amb ISBN <strong>".$_POST['isbn']."</strong> correctament.</h3>";
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
            if($LNOEXISTEIX){
                echo "<h3><strong>Error</strong>, el llibre amb ISBN ".$_POST['isbn']." no existeix.</h3>";
            }  
        }else{
            header("Location: ../../403.php");
        } 
        ?>
        </main>