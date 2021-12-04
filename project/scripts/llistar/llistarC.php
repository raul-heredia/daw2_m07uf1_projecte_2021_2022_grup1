<?php
    $USER;
    session_start();
    if (isset($_SESSION['bibliotecari'])) {
        $USER = $_SESSION['bibliotecari'];
    }
    if (isset($_SESSION['administrador'])) {
        $USER = $_SESSION['administrador'];
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
</head>

<body>
    <nav>
    <ul>
        <li><a href=""><i class="fas fa-power-off"></i></a></li>
        <li><a class="disabled"><i class="fas fa-user"></i><?php echo $USER?></a></li>
        <li><a href="">Enrere</a></li>
    </ul>
    </nav>>
    <table>
        <tr>
            <th colspan="7"><h2>Llista de clients de la biblioteca</h2></th>
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
        header("Location: ../../403.html");
    } 
?>

