<?php namespace mvc\Controllers;

use core\MainController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use core\Database;
use mvc\Models\Main_Model;
use mvc\Models\Shop_Model;

class Excel extends MainController {

    public function __construct () {
        parent::__construct();      
    } 
    public function index () {
        $model = new Shop_Model();
        if(isset($_GET['table'])) {
            $table = htmlspecialchars($_GET['table']);
            $data['items'] = $model->getItems($table);
        }
        $data['links'] = ['name' => 'homepage'];
        $mainModel = new Main_Model();
        
        $data['tables'] = $mainModel->getAllTables();
        $this->view->renderView('excelTable', $data);
    } 

    public function export () {
        if(isset($_POST['export_excel'])) {
            ob_start();
            $output = '';
            $model = new Shop_Model();
            $table = htmlspecialchars($_POST['table']);
            $data['items'] = $model->getItems($table);
            $output .= '<table class="table" border="1"><tr>';
            foreach($data['items']['columnNames'] as $key => $val) {
                $output .= '<th>'.$val.'</th>';
            }
            unset($data['items']['columnNames']);
          $output .= '</tr>';
                foreach($data['items'] as $item) {
                    $output .= '<tr>';
                    foreach($item as $key => $val) {
                        $output .= '<td>'.$val.'</td>';
                    }
                    $output.= '</tr>';
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