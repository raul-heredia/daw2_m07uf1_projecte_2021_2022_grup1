<?php
    $USUARI = $_POST['username'];
    $PASSWORD = $_POST['passwd'];
    $NOTFOUND = true;

    if (($CLIENTS = fopen("../../files/clients.csv", "r")) !== FALSE) {
        while (($USUARIS = fgetcsv($CLIENTS, 1000, ",")) !== FALSE) {
            if ($USUARI == $USUARIS[0]   && $PASSWORD == $USUARIS[1]){
                $NOTFOUND = false;
                fclose($CLIENTS);
                session_name('usuari');
			    session_start();
			    $_SESSION['usuari'] = $USUARI;
                header("Location: ../../client.php");
            }
        }
        fclose($CLIENTS);
    } 
    if (($TREBALLADORS = fopen("../../files/bibliotecaris.csv", "r")) !== FALSE) {
        while (($BIBLIOTECARIS = fgetcsv($TREBALLADORS, 1000, ",")) !== FALSE) {
            if($USUARI == $BIBLIOTECARIS[0]   && $PASSWORD == $BIBLIOTECARIS[1] && $BIBLIOTECARIS[2] == "true"){
                fclose($TREBALLADORS);
                $NOTFOUND = false;
                session_name('administrador');
			    session_start();
                $_SESSION['administrador'] = $USUARI;
                header("Location: ../../admin.php");
            }else if ($USUARI == $BIBLIOTECARIS[0]   && $PASSWORD == $BIBLIOTECARIS[1]){
                fclose($TREBALLADORS);
                $NOTFOUND = false;
                session_name('bibliotecari');
			    session_start();
                $_SESSION['bibliotecari'] = $USUARI;
                header("Location: ../../bibliotecari.php");
            }
        }
        fclose($TREBALLADORS);
    }
    if($NOTFOUND){
        header("Location: ../../404.html");
    }
?>