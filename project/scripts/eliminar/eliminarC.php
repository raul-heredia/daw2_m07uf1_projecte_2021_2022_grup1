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
    <title>Eliminar Client</title>
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
    $USUARISTEMP = array();
    if( $_POST["method"] == "DELETE" ){
        if (($CLIENTS = fopen("../../files/clients.csv", "r")) !== FALSE) {
            while (($USUARIS = fgetcsv($CLIENTS, 1000, ",")) !== FALSE) {
                    if($USUARIS[0]!==$_POST['username']){
                        $USUARISTEMP[] = $USUARIS;
                    }   
                }
            }fclose($CLIENTS);
            $FP = fopen("../../files/clients.csv", 'w');
            foreach($USUARISTEMP as $USER){
                fputcsv($FP, $USER);
            }
            fclose($FP);
        }
        ?>
        <h3>L'usuari <?php echo $_POST['username'] ?> ha estat esborrat correctament</h3>
        
        <?php
    }else{
        header("Location: ../../403.php");
    } 
?>
</main>