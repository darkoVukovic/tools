<?php namespace mvc\Controllers;

use core\MainController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use core\Database;
use mvc\Models\Shop_Model;

// TODO:  i can prob use interface here no time to check now later OR just make single class for export and (what am exporitng) just praticing export for now

class Csv extends MainController {

    public function __construct () {
        parent::__construct();      

    } 

    public function index () {
        $model = new Shop_Model();
        $data['items'] = $model->getItems();

        $this->view->renderView('excelTable', $data);

    } 

    public function export () {
        if(isset($_POST['export_excel'])) {
            ob_start();
            $output = '';
            $model = new Shop_Model();
            $data['items'] = $model->getItems();
            $output .= '<table class="table" border="1"><tr><th>id</th><th>category name</th></tr>';
                foreach($data['items'] as $item) {
                $output.= '<tr><td>'.$item['id_shopCategory'].'</td><td>'.$item['name'].'</td></tr>';
            }
            $output .= '</table>';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment; filename=test.xlsx");
            header('Cache-Control: max-age=0');

            ob_end_flush();
            echo $output;

        }
    } 
}