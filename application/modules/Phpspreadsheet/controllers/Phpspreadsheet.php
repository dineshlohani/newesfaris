<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Phpspreadsheet extends MX_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_test1');
        $this->load->model('Mdl_test2');
        $this->load->model('Mdl_test3');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    private function import($files, $parent_cols=array(), $item_cols=array(), $parent_table, $child_table, $parent_criteria, $child_criteria, $parent_fk, $break_col='', $break_table='', $break_fk=''){
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if(isset($files['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
            $arr_file = explode('.', $files['upload_file']['name']);
            $extension = end($arr_file);
            if('csv' == $extension){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($files['upload_file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $flag = 0;
            if(!empty($parent_cols) && !empty($item_cols))
            {
                foreach($sheetData as $data)
                {
                    if($data[1] == $child_criteria)
                    {
                        $flag = 1;
                        continue;
                    }
                    elseif($data[1] == $parent_criteria)
                    {
                        $flag = 0;
                        continue;
                    }
                    if($flag == 1)
                    {
                        $idata = array();
                        $bdata = array();
                        $idata[$parent_fk]      = $parent_id;
                        $break_col_status = 0;
                        $i = 1;
                        foreach ($item_cols as $key => $item_col) {
                            if (empty($break_col) || ($break_col == $item_col)) {
                                $break_col_status = 1;
                            }
                            if ($break_col_status == 0) {
                                $idata[$item_col] = $data[$i];
                            } elseif ($break_col_status == 1) {
                                $bdata[$item_col] = $data[$i];
                            }
                            $i++;
                        }
                        $child_id = $this->$child_table->save($idata);
                        $bdata[$break_fk] = $child_id;
                        $this->$break_table->save($bdata);
                    }
                    elseif($flag == 0) {
                        $pdata = array();
                        for($i=0; $i< count($parent_cols); $i++)
                        {
                            $pdata[$parent_cols[$i]] = $data[$i + 1];
                        }
                        $parent_id = $this->$parent_table->save($pdata);
                    }
                }return TRUE;
            }else {
                return FALSE;
            }
        }else {
            return FALSE;
        }

    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function index(){
        $this->load->view('spreadsheet');
    }
/*------------------------------------------------------------------------------------------------------------------*/
    public function export($html, $filename)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', $html);
        $writer = new Xlsx($spreadsheet);


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function import_excel()
    {
        if(isset($_FILES))
        {
            $parent_cols  = array('name', 'price');
            $child_cols   = array('item_id', 'stock', 'status', 'lost', 'demand');
            $parent_table = 'Mdl_test1';
            $child_table  = 'Mdl_test2';
            $break_table  = 'Mdl_test3';
            $break_column = 'lost';
            $break_fk     = 'item_id';

            $this->import($_FILES, $parent_cols, $child_cols, $parent_table, $child_table, 'Bname', 'ItemID', 'book_id', $break_column, $break_table, $break_fk);
        }

    }

}
