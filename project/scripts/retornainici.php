<?php 
session_start();
if (isset($_SESSION['administrador'])) {
    header("Location: ../admin.php");
}

if (isset($_SESSION['bibliotecari'])) {
    header("Location: ../bibliotecari.php");
}

if (isset($_SESSION['usuari'])) {
    header("Location: ../client.php");
}
?>