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
            <link rel="stylesheet" href="../../css/style.css" />
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
                integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
            <title>Llista de Llibres</title>
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
            <form action="../dompdf/html2pdf.php" method="GET">
                <input type="text" class="hidden" name="file" value="/scripts/llistar/llistarL.php">
                <input type="submit" value="Genera PDF">
            </form>
            <table>
                <tr>
                    <th colspan="5" id="colspan"><h2>Llista de llibres de la biblioteca</h2></th>
                <tr>
                    <th>ISBN Del Llibre</th>
                    <th>Nom Del Llibre</th>
                    <th>Autor</th>
                    <th>Data d'Inici del prèstec</th>
                    <th>Usuari del prèstec</th>
                </tr>
        <?php
        if (($LLIBRES = fopen("../../files/llibres.csv", "r")) !== FALSE) {
            while (($LLIBRE = fgetcsv($LLIBRES, 1000, ",")) !== FALSE) {
                ?>
                <tr>
                    <td><?php echo $LLIBRE[0] ?></td>
                    <td><?php echo $LLIBRE[1] ?></td>
                    <td><?php echo $LLIBRE[2]?></td>
                    <?php
                        if($LLIBRE[3] == "false"){
                            ?>
                            <td><i class="fas fa-times"></i></td>
                            <td><i class="fas fa-times"></i></td>
                            <?php
                        }else if($LLIBRE[3] == "true"){
                            ?>
                            <td><?php echo $LLIBRE[4]?></td>
                            <td><?php echo $LLIBRE[5]?></td>
                            <?php
                        }?>
                </tr>
                </main>
                <?php
            }
            fclose($LLIBRES);
        }
    }else{
        header("Location: ../../403.html");
    }
?>  


