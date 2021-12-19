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
            <link rel="stylesheet" href="/var/www/html/css/style.css" />
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
                integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
            <title>Les meves dades</title>
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
            <?php
           if (($TREBALLADORS = fopen("../../files/bibliotecaris.csv", "r")) !== FALSE) {
            while (($BIBLIOTECARIS = fgetcsv($TREBALLADORS, 1000, ",")) !== FALSE) {
                if ($USERNAME == $BIBLIOTECARIS[0]){
                    
                    $LLISTA = "<ul>
                        <li><strong>Nom Complet: </strong>$USER</li>
                        <li><strong>Direcció: </strong>$BIBLIOTECARIS[5]</li>
                        <li><strong>Direcció de Correu Electrònic: </strong>$BIBLIOTECARIS[6]</li>
                        <li><strong>Nª de telèfon: </strong>$BIBLIOTECARIS[7]</li>
                        <li><strong>Nª Seguretat Social: </strong>$BIBLIOTECARIS[8]</li>  
                        <li><strong>Data de Contractació: </strong>$BIBLIOTECARIS[9] </li>  
                        <li><strong>Salari: </strong>$BIBLIOTECARIS[10]€</li></ul>";                   
                      
               
                
            }
        }fclose($TREBALLADORS);
            echo "$LLISTA";
            $LLISTAPDF = base64_encode(gzcompress($LLISTA,9));
            echo "<form action='../dompdf/html2pdf.php' method='GET'>
                    <input type='text' class='hidden' name='filename' value='dades$USERNAME'>
                    <input type='text' class='hidden' name='file' value='$LLISTAPDF'>
                    <input type='submit' id='pdf' value='Generar PDF'>
                </form>";
            ?>
            </div></div></main>
            <?php
    }
}else{
    header("Location: ../../403.php");
}
?>