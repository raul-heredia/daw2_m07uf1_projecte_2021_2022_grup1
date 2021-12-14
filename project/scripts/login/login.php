<?php
    $USUARI = $_POST['username'];
    $PASSWORD = $_POST['passwd'];
    $SESSIONDATA = [];
    $NOTFOUND = true;

    if (($CLIENTS = fopen("../../files/clients.csv", "r")) !== FALSE) {
        while (($USUARIS = fgetcsv($CLIENTS, 1000, ",")) !== FALSE) {
            if ($USUARI == $USUARIS[0] && $PASSWORD == $USUARIS[1]){
                $NOTFOUND = false;
                $SESSIONDATA = ["$USUARI","$USUARIS[2] $USUARIS[3]"];
                fclose($CLIENTS);
                //session_name('usuari');
			    session_start();
			    $_SESSION['usuari'] = $SESSIONDATA;
                header("Location: ../../client.php");
            }
        }fclose($CLIENTS);
    } 
    if (($TREBALLADORS = fopen("../../files/bibliotecaris.csv", "r")) !== FALSE) {
        while (($BIBLIOTECARIS = fgetcsv($TREBALLADORS, 1000, ",")) !== FALSE) {
            if($USUARI == $BIBLIOTECARIS[0] && $PASSWORD == $BIBLIOTECARIS[1] && $BIBLIOTECARIS[2] == "true"){
                fclose($TREBALLADORS);
                $NOTFOUND = false;
                $SESSIONDATA = ["$USUARI","$BIBLIOTECARIS[3] $BIBLIOTECARIS[4]"];
                //session_name('administrador');
			    session_start();
                $_SESSION['administrador'] = $SESSIONDATA;
                header("Location: ../../admin.php");
            }else if ($USUARI == $BIBLIOTECARIS[0] && $PASSWORD == $BIBLIOTECARIS[1] && $BIBLIOTECARIS[2] == "false"){
                fclose($TREBALLADORS);
                $NOTFOUND = false;
                $SESSIONDATA = ["$USUARI","$BIBLIOTECARIS[3] $BIBLIOTECARIS[4]"];
                //session_name('bibliotecari');
			    session_start();
                $_SESSION['bibliotecari'] = $SESSIONDATA;
                header("Location: ../../bibliotecari.php");
            }
        }fclose($TREBALLADORS); // Tanquem treballadors ja que es l'ultim
    }
    if($NOTFOUND){
        header("Location: ../../404.php");
    }
?>