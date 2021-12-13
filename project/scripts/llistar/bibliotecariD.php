<?php
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
            <li><a href=""><i class="fas fa-power-off"></i></a></li>
            <li><a class="disabled"><i class="fas fa-user"></i><?php echo $USERNAME?></a></li>
            <li><a class="disabled"><strong>Sessió: </strong><?php echo session_id()?></a></li>
            <li><a href=""><i class="fas fa-arrow-left"></i></a></li>
        </ul>
        </nav>
            <main>
            <div class="options-flex">
                <div class="option-list">
            <?php
           if (($TREBALLADORS = fopen("../../files/bibliotecaris.csv", "r")) !== FALSE) {
            while (($BIBLIOTECARIS = fgetcsv($TREBALLADORS, 1000, ",")) !== FALSE) {
                if ($USERNAME == $BIBLIOTECARIS[0]){
                    ?>
                    <ul>
                        <li><strong>Nom Complet: </strong><?php echo $USER ?></li>
                        <li><strong>Direcció: </strong><?php echo $BIBLIOTECARIS[5] ?></li>
                        <li><strong>Direcció de Correu Electrònic: </strong><?php echo $BIBLIOTECARIS[6] ?></li>
                        <li><strong>Nª de telèfon: </strong><?php echo $BIBLIOTECARIS[7] ?></li>
                        <li><strong>Nª Seguretat Social: </strong><?php echo $BIBLIOTECARIS[8] ?></li>  
                        <li><strong>Data de Contractació: </strong><?php echo $BIBLIOTECARIS[9] ?></li>  
                        <li><strong>Salari: </strong><?php echo $BIBLIOTECARIS[10] ?></li>                        
                      
                </main>
                <?php
            }
        }fclose($TREBALLADORS);
            ?></div></div><?php
    }
}else{
    echo "Error";
}
?>