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
    $BIBLIOTECARISTEMP = array();
    if( $_POST["method"] == "PUT" ){
        if (($TREBALLADORS = fopen("../../files/bibliotecaris.csv", "r")) !== FALSE) {
            while (($BIBLIOTECARIS = fgetcsv($TREBALLADORS, 1000, ",")) !== FALSE) {
                    if($BIBLIOTECARIS[0] == $_POST['username']){
                        if($_POST['newusername']){
                            $BIBLIOTECARIS[0] = $_POST['newusername'];
                        }
                        if($_POST['nom']){
                            $BIBLIOTECARIS[3] = $_POST['nom'];
                        }
                        if($_POST['contrasenya']){
                            $BIBLIOTECARIS[1] = $_POST['contrasenya'];
                        }
                        if($_POST['cognom']){
                            $BIBLIOTECARIS[4] = $_POST['cognom'];
                        }
                        if($_POST['adreca']){
                            $BIBLIOTECARIS[5] = $_POST['adreca'];
                        }
                        if($_POST['email']){
                            $BIBLIOTECARIS[6] = $_POST['email'];
                        }
                        if($_POST['telefon']){
                            $BIBLIOTECARIS[7] = $_POST['telefon'];
                        }
                        if($_POST['salari']){
                            $BIBLIOTECARIS[10] = $_POST['salari'];
                        }
                        if($_POST['isadmin']){
                            $BIBLIOTECARIS[2] = "true";
                          
                        }else{
                            $BIBLIOTECARIS[2] = "false";
                        }
                        $NOMUSUARI = $BIBLIOTECARIS[0];
                        $ISADMIN = $BIBLIOTECARIS[2];
                        $NOM = $BIBLIOTECARIS[3];
                        $COGNOMS = $BIBLIOTECARIS[4];
                        $ADRECA = $BIBLIOTECARIS[5];
                        $EMAIL = $BIBLIOTECARIS[6];
                        $TELEFON = $BIBLIOTECARIS[7];
                        $SALARI = $BIBLIOTECARIS[10];
                    }
                    $BIBLIOTECARISTEMP[] = $BIBLIOTECARIS;
                }
            }fclose($TREBALLADORS);
            $FP = fopen("../../files/bibliotecaris.csv", 'w');
            foreach($BIBLIOTECARISTEMP as $BIBLIOTECARI){
                fputcsv($FP, $BIBLIOTECARI);
            }
            fclose($FP);
        }
        ?>
        <div class="options-flex">
            <div class="option-list">
            <h3>L'usuari <?php echo $_POST['username']?> ha estat modificat correctament.</h3>
            <ul>
                <li><h3><strong>Resum</strong></h3></li>
                <li><strong>Nom d'Usuari: </strong><?php echo "$NOMUSUARI"?></li>
                <li><strong>Nom Complet: </strong><?php echo "$NOM $COGNOMS" ?></li>
                <li><strong>Direcció: </strong><?php echo $ADRECA ?></li>
                <li><strong>Direcció de Correu Electrònic: </strong><?php echo $EMAIL?></li>
                <li><strong>Nª de telèfon: </strong><?php echo $TELEFON ?></li>
                <li><strong>Salari: </strong><?php echo $SALARI ?>€</li>

        <a href="../retornainici.php">Retornar a inici</a>
        <?php
    }else{
        header("Location: ../../403.php");
    } 
?>
</main>