<?php
	$USER;
    session_start();
    ob_start();
    require_once '../../vendor/autoload.php'; //path relatiu al directori a on està el codi principal del projecte
    use Dompdf\Dompdf; // equivalent a  use Dompdf\Dompdf as Dompdf;
    if (isset($_SESSION['bibliotecari'])) {
        $USERNAME = $_SESSION['bibliotecari'][0];
        $USER = $_SESSION['bibliotecari'][1];
    }
    if (isset($_SESSION['administrador'])) {
        $USERNAME = $_SESSION['administrador'][0];
        $USER = $_SESSION['administrador'][1];
    }
    if($USER){
    $dompdf = new Dompdf();
    $dompdf->setbasepath(realpath('/var/www/html/css/style.css'));
    $html = file_get_contents('http://'.$_SERVER['HTTP_HOST'].$_GET['file']);
    $dompdf->loadHtml($html);  
    $dompdf->setPaper('A4', 'landscape'); 
    $dompdf->render(); 
    $dompdf->stream("niceshipest", array("Attachment" => 0));
    }else{
        header("Location: ../../403.php");
    } 
?>