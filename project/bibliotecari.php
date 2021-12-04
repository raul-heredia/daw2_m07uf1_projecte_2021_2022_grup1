<?php
session_start(); 
if (isset($_SESSION['bibliotecari'])) {
    $USER = $_SESSION['bibliotecari'];
?>    
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css" />
    <title>Panell de Bibliotecari</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <nav>
    <ul>
        <li><a href=""><i class="fas fa-power-off"></i></a></li>
        <li><a class="disabled"><i class="fas fa-user"></i><?php echo $USER?></a></li>
        <li><a href="">Enrere</a></li>
    </ul>
    </nav>
    <main>
        <h1>Benvingut <?php echo $USER ?></h1>
        <h1 class="option-title">Llibres</h1>
        <div class="options-flex">
            <a href="./scripts/llistar/llistarL.php">
                <div class="option">
                    <i class="option-icon fas fa-books"></i>
                    <p class="option-p">Visualitzar Llibres</p>
                </div>
            </a>
            <a class="afegir" href="./forms/llibre/afegirL.html">
                <div class="option">
                    <i class="option-icon fas fa-book"></i>
                    <p class="option-p">Afegir Llibre</p>
                </div>
            </a>
            <a class="modificar" href="#">
                <div class="option">
                    <i class="option-icon fas fa-book"></i>
                    <p class="option-p">Modificar Llibre</p>
                </div>
            </a>
            <a class="elimina" href="./forms/llibre/eliminaL.html">
                <div class="option">
                    <i class="option-icon fas fa-book"></i>
                    <p class="option-p">Eliminar Llibre</p>
                </div>
            </a>
        </div>
        <h1 class="option-title">Usuaris</h1>
        <div class="options-flex">
        <a href="./scripts/llistar/llistarC.php"> 
            <div class="option">
                <i class="option-icon fas fa-users"></i>
                <p class="option-p">Visualitzar Usuaris</p>
            </div>
        </a>   
            <a class="afegir" href="forms/bibliotecari/afegir.html">
                <div class="option">
                    <i class="option-icon fas fa-user-minus"></i>
                    <p class="option-p">Afegir Usuari</p>
                </div>
            </a>
            <a class="modificar" href="#">
                <div class="option">
                    <i class="option-icon fas fa-user-edit"></i>
                    <p class="option-p">Modificar Usuari</p>
                </div>
            </a>
            <a class="elimina" href="./forms/bibliotecari/esborra.html">
                <div class="option">
                    <i class="option-icon fas fa-user-minus"></i>
                    <p class="option-p">Eliminar Usuari</p>
                </div>
        </div>
    </main>
</body>

</html>
<?php
}else{
    header("Location: ../../403.html");
}
?>
