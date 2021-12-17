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
        <div class="options-flex">
            <div class="option-list">
                <form action="../dompdf/html2pdf.php" method="GET">
                    <input type="text" class="hidden" name="file" value="/scripts/llistar/llistarB.php">
                    <input type="submit" id="sendpdf" value="Genera PDF">
                </form>
            </div>
        </div>
    <table>
        <tr>
            <th colspan="9" id="colspan"><h2>Llista de treballadors de la biblioteca</h2></th>
        <tr>
            <th>Admin</th>
            <th>Nom d'Usuari</th>
            <th>Nom Complet</th>
            <th>Direcció</th>
            <th>Correu Electrònic</th>
            <th>Telèfon</th>
            <th>Nº Seguretat Social</th>
            <th>Data de Contractació</th>
            <th>Salari</th>
        </tr>
<?php
if (($TREBALLADORS = fopen("../../files/bibliotecaris.csv", "r")) !== FALSE) {
    while (($BIBLIOTECARIS = fgetcsv($TREBALLADORS, 1000, ",")) !== FALSE) {
        ?>
        <tr>
            <?php
                if($BIBLIOTECARIS[2] == "false"){
                    ?>
                    <td><i class="fas fa-times"></i></td>
                    <?php
                }else if($BIBLIOTECARIS[2] == "true"){
                    ?>
                    <td><i class="fas fa-check"></i></td>
                    <?php
                }?>
            <td><?php echo $BIBLIOTECARIS[0] ?></td>
            <td><?php echo "$BIBLIOTECARIS[3] $BIBLIOTECARIS[4]" ?></td>
            <td><?php echo $BIBLIOTECARIS[5]?></td>
            <td><?php echo $BIBLIOTECARIS[6]?></td>
            <td><?php echo $BIBLIOTECARIS[7]?></td>
            <td><?php echo $BIBLIOTECARIS[8]?></td>
            <td><?php echo $BIBLIOTECARIS[9]?></td>
            <td><?php echo $BIBLIOTECARIS[10]?>€</td>
        </tr>
        </main>
        <?php
    }
    fclose($TREBALLADORS);
}
}else{
    header("Location: ../../403.php");
} 
?>
