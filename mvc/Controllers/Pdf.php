<?php namespace mvc\Controllers;

use core\MainController;
use Dompdf\Dompdf;

class Pdf extends MainController {

    public $dompdf;

    public function index () {
       $this->view->renderView('pdf');
    } 

    public function convert () {

        $html = '<h1>Exmpl</h1>';
        $html .= 'hello world';
        $this->dompdf = new Dompdf();
        $this->dompdf->loadHtml($html);
        $this->dompdf->render();
        $this->dompdf->stream('invoice.pdf', ["Attachment" => 0]);
        
    } 
}