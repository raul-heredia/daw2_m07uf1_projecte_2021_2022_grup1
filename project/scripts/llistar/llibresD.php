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
            <li><a href=""><i class="fas fa-arrow-left"></i></a></li>
        </ul>
        </nav>
            <main>
                <table>
                <tr>
                    <th colspan="3" id="colspan"><h2>Llista de llibres Disponibles</h2></th>
                <tr>
                    <th>ISBN Del Llibre</th>
                    <th>Nom Del Llibre</th>
                    <th>Autor</th>
                </tr>
            <?php
            if (($LLIBRES = fopen("../../files/llibres.csv", "r")) !== FALSE) {
                while (($LLIBRE = fgetcsv($LLIBRES, 1000, ",")) !== FALSE) {
                    if ($LLIBRE[3] == "false"){
                        ?>
                        <tr>
                            <td><?php echo $LLIBRE[0] ?></td>
                            <td><?php echo $LLIBRE[1] ?></td>
                            <td><?php echo $LLIBRE[2]?></td>
                        </tr>
                        <?php    
                    }  
                    
                }
                ?>
                </table>
                <?php
                fclose($LLIBRES);
            }?>
            <table>
                <tr>
                    <th colspan="3" id="colspan"><h2>Llista de llibres Reservats</h2></th>
                <tr>
                    <th>ISBN Del Llibre</th>
                    <th>Nom Del Llibre</th>
                    <th>Autor</th>
                </tr>
            <?php
            if (($LLIBRES = fopen("../../files/llibres.csv", "r")) !== FALSE) {
                while (($LLIBRE = fgetcsv($LLIBRES, 1000, ",")) !== FALSE) {
                    if ($LLIBRE[3] == "true"){
                        ?>
                        <tr>
                            <td><?php echo $LLIBRE[0] ?></td>
                            <td><?php echo $LLIBRE[1] ?></td>
                            <td><?php echo $LLIBRE[2]?></td>
                        </tr>
                        <?php    
                    }  
                    
                }
                ?>
                </main>
                <?php
                fclose($LLIBRES);
            }
    }else{
        echo "error";
    }
?>