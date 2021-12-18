<?php
    include '/var/www/html/scripts/global.php';
    session_start();
    if (isset($_SESSION['administrador'])) {
        $USERNAME = $_SESSION['administrador'][0];
        $USER = $_SESSION['administrador'][1];
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
        <li><a href="../retornainici.php"><i class="fas fa-arrow-left"></i></a></li>
    </ul>
    </nav>
    <main>
        <?php
        $TAULA = '<table>
        <tr>
            <th colspan="9" id="colspan"><h2>Llista de treballadors de la biblioteca</h2></th>
        <tr>
            <th>Admin</th>
            <th>Nom d\'Usuari</th>
            <th>Nom Complet</th>
            <th>Direcció</th>
            <th>Correu Electrònic</th>
            <th>Telèfon</th>
            <th>Nº Seguretat Social</th>
            <th>Data de Contractació</th>
            <th>Salari</th>
        </tr>';

if (($TREBALLADORS = fopen("../../files/bibliotecaris.csv", "r")) !== FALSE) {
    while (($BIBLIOTECARIS = fgetcsv($TREBALLADORS, 1000, ",")) !== FALSE) {
        
        $TAULA .= "<tr>";
                if($BIBLIOTECARIS[2] == "false"){
                    $TAULA .= "<td></td>";
                }else if($BIBLIOTECARIS[2] == "true"){
                    $TAULA .= "<td>Sí</td>";
                }
                $TAULA .= "<td>$BIBLIOTECARIS[0]</td>
                <td>$BIBLIOTECARIS[3] $BIBLIOTECARIS[4]</td>
                <td>$BIBLIOTECARIS[5]</td>
                <td>$BIBLIOTECARIS[6]</td>
                <td>$BIBLIOTECARIS[7]</td>
                <td>$BIBLIOTECARIS[8]</td>
                <td>$BIBLIOTECARIS[9]</td>
                <td>$BIBLIOTECARIS[10]€</td></tr>";
    }
    fclose($TREBALLADORS);
}
            $TAULA .= "</table>";
            echo $TAULA;
            $TAULAPDF = base64_encode(gzcompress($TAULA,9));
            ?>
            <div class="options-flex">
                <div class="option-list">
                <?php
                echo "<form action='../dompdf/html2pdf.php' method='POST'>
                        <input type='text' class='hidden' name='filename' value='listatreballadors'>
                        <input type='text' class='hidden' name='file' value='$TAULAPDF'>
                        <input type='submit' id='pdf' value='Generar PDF'>
                    </form>";?>
                    </div>
                </div>
            </main>
            <?php   
}else{
    header("Location: ../../403.php");
} 
?>
