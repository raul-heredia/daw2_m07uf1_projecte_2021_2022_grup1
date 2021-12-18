<?php
    require '../../vendor/autoload.php'; //path relatiu al directori a on està el codi principal del projecte
    include 'estil.php';
    use Dompdf\Dompdf; // equivalent a  use Dompdf\Dompdf as Dompdf;
    session_start();
    if (!isset($_SESSION['bibliotecari']) && !isset($_SESSION['administrador'])) {
        header("Location: ../../403.php");
    }
    $TODAY = date('Ymd');
    $PDFNAME = $_GET["filename"]."_".$TODAY;
    $dompdf = new Dompdf();
    $dompdf->setbasepath(realpath('/var/www/html/css/style.css'));
    $html = $estil.gzuncompress(base64_decode($_GET["file"]));
    $dompdf->setPaper('A3', 'landscape'); 
    $dompdf->loadHtml($html);  
    $dompdf->render(); 
    $dompdf->stream($PDFNAME, array("Attachment" => 0));
?>