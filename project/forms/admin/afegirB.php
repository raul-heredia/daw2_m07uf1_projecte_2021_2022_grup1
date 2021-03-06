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
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
                integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>Afegir Bibliotecari</title>
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
        <h2 class="title">Afegir Bibliotecari</h2>
        <form autocomplete="off" action="../../scripts/afegir/afegirB.php" method="POST">
            <div class="field">
                <input id="nom" name="nom" type="text" required />
                <label>Nom</label>
            </div>
            <div class="field">
                <input id="cognoms" name="cognom" type="text" required />
                <label>Cognoms</label>
            </div>
            <div class="field">
                <input id="username" name="username" type="text" required />
                <label>Nom d'Usuari</label>
            </div>
            <div class="field">
                <input id="contrasenya" name="contrasenya" type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-?]).{8,}$" required />
                <label>Contrasenya</label>
            </div>
            <div class="field">
                <input id="adreca" name="adreca" type="text" required />
                <label>Adreça</label>
            </div>
            <div class="field">
                <input id="email" name="email" type="text" required />
                <label>Correu Electrònic</label>
            </div>
            <div class="field">
                <input id="numeross" name="numeross" type="text" required />
                <label>Nª Seguretat Social</label>
            </div>
            <div class="field">
                <input id="telefon" name="telefon" type="text" required />
                <label>Telèfon</label>
            </div>
            <div class="field">
                <input id="datacon" name="datacon" type="date" required />
            </div>
            <div class="field">
                <input id="salari" name="salari" type="text" required />
                <label>Salari</label>
            </div>
            <div class="field">
                <input id="isadmin" name="isadmin" type="checkbox" />
                <label>Es Administrador?</label>
            </div>
            <div class="field">
                <input type="submit" value="Afegir" />
            </div>
        </form>
    </div>
</body>
</html>
<?php
}else{
    header("Location: ../../403.php");
}