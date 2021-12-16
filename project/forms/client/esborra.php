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
    <title>Esborrar Client</title>
</head>

<body id="index">
    <nav>
    <ul>
        <li><a href="../../scripts/tancarsessio.php"><i class="fas fa-power-off"></i></a></li>
        <li><a class="disabled"><i class="fas fa-user"></i><?php echo $USERNAME?></a></li>
        <li><a class="disabled"><strong>Sessió: </strong><?php echo session_id()?></a></li>
        <li><a href="../../scripts/retornainici.php"><i class="fas fa-arrow-left"></i></a></li>
    </ul>
    </nav>
    <div class="wrapper">
        <h2 class="title">Esborrar Usuari</h2>
        <form autocomplete="off" action="../../scripts/eliminar/eliminarC.php" method="POST">
            <input type="text" name="method" value="DELETE" class="hidden">
            <div class="field">
                <input id="Username" name="username" type="text" required />
                <label>Nom d'Usuari</label>
            </div>
            <div class="field">
                <input type="submit" value="Esborra" />
            </div>
        </form>
    </div>
</body>

</html>
<?php
}else{
    header("Location: ../../403.php");
}