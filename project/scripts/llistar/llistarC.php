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
    <title>Llista de Clients</title>
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
            <form action="../dompdf/html2pdf.php" method="GET">
                <input type="text" class="hidden" name="file" value="/scripts/llistar/llistarC.php">
                <input type="submit" value="Genera PDF">
            </form>
        </div>
    </div>
    <table>
        <tr>
            <th colspan="7" id="colspan"><h2>Llista de clients de la biblioteca</h2></th>
        <tr>
            <th>Nom d'usuari</th>
            <th>Nom Complet</th>
            <th>Direcció</th>
            <th>Correu Electrònic</th>
            <th>Telèfon</th>
            <th>ISBN Llibre en prestec</th>
            <th>Data d'inici prèstec</th>
        </tr>
<?php
if (($CLIENTS = fopen("../../files/clients.csv", "r")) !== FALSE) {
    while (($USUARIS = fgetcsv($CLIENTS, 1000, ",")) !== FALSE) {
        ?>
        <tr>
            <td><?php echo $USUARIS[0] ?></td>
            <td><?php echo "$USUARIS[2] $USUARIS[3]" ?></td>
            <td><?php echo $USUARIS[4]?></td>
            <td><?php echo $USUARIS[5]?></td>
            <td><?php echo $USUARIS[6]?></td>
            <?php
                if($USUARIS[7] == "false"){
                    ?>
                    <td><i class="fas fa-times"></i></td>
                    <td><i class="fas fa-times"></i></td>
                    <?php
                }else if($USUARIS[7] == "true"){
                    ?>
                    <td><?php echo $USUARIS[8]?></td>
                    <td><?php echo $USUARIS[9]?></td>
                    <?php
                }?>
        </tr>
        <?php
    }
    fclose($CLIENTS);
}
    }else{
        header("Location: ../../403.php");
    } 
?>
</main>