<?php
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
    <link rel="stylesheet" href="./css/style.css" />
    <title>Document</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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
            <h1>Benvingut <strong><?php echo $USER?></strong></h1>
            <div class="options-flex">
                <a href="./scripts/llistar/clientD.php">
                <div class="option">
                    <i class="option-icon fas fa-user"></i>
                    <p class="option-p">Les meves dades</p>
                </div>
                </a>
                <a href="./scripts/llistar/llibresD.php">
                <div class="option">
                    <i class="option-icon fas fa-book"></i>
                    <p class="option-p">Llibres Disponibles</p>
                </div>
                </a>
            </div>
        </main>
    </body>
    </html>
<?php
}else{
    /* header("Location: ../../403.html"); */
}
?>
