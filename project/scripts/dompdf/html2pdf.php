<?php
	//
    // Mètodes de Dompdf --> https://gennco.com.co/ANT/dompdf/DOMPDF.html
    // Codi Font --> https://github.com/dompdf/dompdf
    //
    // Accedint al framework
    require_once '../../vendor/autoload.php'; //path relatiu al directori a on està el codi principal del projecte
    use Dompdf\Dompdf; // equivalent a  use Dompdf\Dompdf as Dompdf;
	//
	// Utilitzant la classe Dompdf del framework
    $dompdf = new Dompdf();
    $dompdf->setbasepath(realpath('/var/www/html/css/style.css'));
    //
    // Carregant el contigngut del document HTML
    $html = file_get_contents('http://'.$_SERVER['HTTP_HOST'].$_GET['file']);
    $dompdf->loadHtml($html);  // Alternativa -->  $dompdf->loadHtml('<h1>Conversor d'HTML a PDF</h1>'); 
    //
    // Renderitzant i mostrant el PDF
    // 
    $dompdf->setPaper('A4', 'landscape'); //Sets the paper size & orientation
    $dompdf->render(); // Renders the HTML to PDF
    $dompdf->stream("niceshipest", array("Attachment" => 0)); //Streams the PDF to the client (for example: browser)


?>