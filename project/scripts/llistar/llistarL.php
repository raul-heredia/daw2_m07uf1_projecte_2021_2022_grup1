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
                <li><a href="../../scripts/tancarsessio.php"><i class="fas fa-power-off"></i></a></li>
                <li><a class="disabled"><i class="fas fa-user"></i><?php echo $USERNAME?></a></li>
                <li><a class="disabled"><strong>Sessió: </strong><?php echo session_id()?></a></li>
                <li><a href="../retornainici.php"><i class="fas fa-arrow-left"></i></a></li>
            </ul>
            </nav>
            <main>
                
            <?php
                $TAULA = "<table>
                <tr>
                    <th colspan=\"5\" id=\"colspan\"><h2>Llista de llibres de la biblioteca</h2></th>
                <tr>
                    <th>ISBN Del Llibre</th>
                    <th>Nom Del Llibre</th>
                    <th>Autor</th>
                    <th>Data d'Inici del préstec</th>
                    <th>Usuari del préstec</th>
                </tr>";
        
        if (($LLIBRES = fopen("../../files/llibres.csv", "r")) !== FALSE) {
            while (($LLIBRE = fgetcsv($LLIBRES, 1000, ",")) !== FALSE) {
                $TAULA .= "<tr>
                    <td> $LLIBRE[0] </td>
                    <td> $LLIBRE[1] </td>
                    <td> $LLIBRE[2]</td>";
                        if($LLIBRE[3] == "false"){
                            $TAULA.= "<td></td>
                            <td></td>";
                            
                        }else if($LLIBRE[3] == "true"){
                            $TAULA.= "<td> $LLIBRE[4]</td>
                            <td> $LLIBRE[5]</td></tr>";
                            
                        }
            }
            fclose($LLIBRES);
            $TAULA .= "</table>";
            echo $TAULA;
            $TAULAPDF = base64_encode(gzcompress($TAULA,9));
            ?>
            <div class="options-flex">
                <div class="option-list">
                <?php
                echo "<form action='../dompdf/html2pdf.php' method='POST'>
                        <input type='text' class='hidden' name='filename' value='llistallibres'>
                        <input type='text' class='hidden' name='file' value='$TAULAPDF'>
                        <input type='submit' id='pdf' value='Generar PDF'>
                    </form>";
                    ?>
                </div>
            </div>
        </main>
            <?php
        }
    }else{
        header("Location: ../../403.php");
    }
?>  


