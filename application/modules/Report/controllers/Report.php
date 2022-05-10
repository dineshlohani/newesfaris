<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->model('Home/Mdl_home_recommend');
        $this->load->model('Home/Mdl_home_road_certify');
        $this->load->model('Home/Mdl_home_road_certify_land');
        $this->load->model('Home/Mdl_ghar_jagga_namsari');
        $this->load->model('Home/Mdl_kitta_kat_sifaris');
        $this->load->model('Home/Mdl_print_details');
        $this->load->model('DartaChalaniBook/Mdl_darta');
        $this->load->model('DartaChalaniBook/Mdl_chalani');
        $this->load->model('Settings/Mdl_office');
        $this->load->model('Settings/Mdl_state');
        $this->load->model('Settings/Mdl_district');
        $this->load->model('Settings/Mdl_local_body');
        $this->load->model('Settings/Mdl_ward');
        $this->load->model('Settings/Mdl_oldnew_address');
        $this->load->model('Settings/Mdl_road_type');
        $this->load->model('Settings/Mdl_home_type');
        $this->load->model('Settings/Mdl_direction');
        $this->load->model('Settings/Mdl_relation');
        $this->load->model('Settings/Mdl_department');
        $this->load->model('Settings/Mdl_session');
        $this->load->model('Settings/Mdl_document');
        $this->load->model('Settings/Mdl_patra_item');
        $this->load->model('Settings/Mdl_ward_worker');
        $this->load->model('Settings/Mdl_worker');
        $this->load->model('Settings/Mdl_patra_item');
        $this->load->model('Settings/Mdl_land_type');
        $this->load->model('User/Mdl_user');
        $this->load->model('Settings/Mdl_patra_category');

        $this->load->model('Mdl_report');

        $this->load->helper('functions_helper');

        $this->load->helper('string');
        $this->load->helper('functions_helper');
    }

    public function index() {}
    /*||----------------------------------------------------------------------------------------------
        ***************************************DARTA REPORT******************************************
    --------------------------------------------------------------------------------------------------||*/
    public function dartaReport() {
       if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $data['title']              = "सिफारिस | दर्ता रिपोर्ट";
        $data['ward']               = $this->Mdl_user->getWard();
        $data['patra']              = $this->Mdl_patra_item->getAll();
        $data['result']             = $this->Mdl_report->getDartaReport();
        // $items                      = array();
        // $i                          = 1;
        // if(!empty($data['result'])) {
        //     foreach($data['result'] as $key => $report) {
        //         $nestedData['sn']               = $i++;
        //         $count_sifaris                  = $this->Mdl_report->getDartaReport($patra->uri);
        //         $nestedData['id']               = $patra->id;
        //         $nestedData['uri']              = $patra->uri;
        //         $nestedData['name']             = $patra->name;
        //         $item_count[] = $nestedData;
        //     }
        // }
        // $data['item_count'] = $item_count;
        $this->load->view('User/header',$data);
        $this->load->view('darta_report', $data);
        $this->load->view('User/footer');
    }
    public function searchDartaReport() {
        if($this->input->is_ajax_request())
        {
            $from_date      = $this->input->post('from_date');
            $to_date        = $this->input->post('to_date');
            $ward_no        = $this->input->post('ward_no');
            $sifaris_type   = $this->input->post('sifaris_type');
            $data['result'] = $this->Mdl_report->getDartaReportBySearch($sifaris_type, $from_date,$to_date,$ward_no);
            // $item_count     = array();
            // $i = 1;
            // if(!empty($data['patra_item'])) {
            //     foreach($data['patra_item'] as $key => $patra) {
            //         $nestedData['sn']               = $i++;
            //         $nestedData['id']               = $patra->id;
            //         $nestedData['uri']              = $patra->uri;
            //         $nestedData['name']             = $patra->name;
            //         $count_sifaris                  = $this->Mdl_report->getDartaReportBySearch($patra->uri, $from_date,$to_date,$ward_no);
            //         $nestedData['totalcount']       = $count_sifaris->total;
            //         $item_count[] = $nestedData;
            //     }
            // }
            // $data['item_count'] = $item_count;
            $data_view = $this->load->view('darta_search', $data, true);
            $response                   = array(
                'status'                  => 'success',
                'data'                    => $data_view
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        } 
    }

    public function DartaSuchi($uri, $from_date =NULL , $to_date=NULL,$ward_no=NULL) {
        $data1['title']     = 'दर्ता किताब';
        $data['darta_list'] = $this->Mdl_report->getDartaList($uri,$from_date,$to_date,$ward_no);
        $this->load->view('User/header',$data1);
        $this->load->view('darta_book',$data);
        $this->load->view('User/footer');
    }

    //view darta details
    public function viewDartaBook($uri) {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $data['title']              = "सिफारिस | दर्ता रिपोर्ट";
        $data['ward']               = $this->Mdl_user->getWard();
        $data['patra']              = $this->Mdl_patra_item->getAll();
        $data['darta_list']             = $this->Mdl_darta->getByUri($uri);
        $data['uridetails']     = $this->Mdl_patra_item->getNameByUri($uri);
        $this->load->view('User/header',$data);
        $this->load->view('darta_book', $data);
        $this->load->view('User/footer');
    }

     /*||----------------------------------------------------------------------------------------------
        ***************************************CHALANI REPORT******************************************
    --------------------------------------------------------------------------------------------------||*/
    public function chalaniReport() {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $data['title'] = "सिफारिस | दर्ता रिपोर्ट";
        $data['ward'] = $this->Mdl_user->getWard();
        $data['patra'] = $this->Mdl_patra_item->getAll();
        $data['chalani'] = $this->Mdl_report->getChalaniReport();
    
        //$item_count = array();
        // $i = 1;
        // if(!empty($data['patra_item'])) {
        //     foreach($data['patra_item'] as $key => $patra) {
        //         $nestedData['sn']               = $i++;
        //         $nestedData['id']               = $patra->id;
        //         $nestedData['uri']              = $patra->uri;
        //         $nestedData['name']             = $patra->name;
        //         $category                       = $this->Mdl_patra_category->getById($patra->category_id);
        //         $nestedData['category']         = $category->name;
        //         $count_sifaris                  = $this->Mdl_report->getChalaniReport($patra->uri);
        //         $nestedData['totalcount']       = $count_sifaris->total;
        //         $item_count[] = $nestedData;
        //     }
        // }
        // $data['item_count'] = $item_count;
        $this->load->view('User/header',$data);
        $this->load->view('chalani_report', $data);
        $this->load->view('User/footer');
    }

    public function searchChalaniReport() {
        if($this->input->is_ajax_request())
        {
            $from_date      = $this->input->post('from_date');
            $to_date        = $this->input->post('to_date');
            $ward_no        = $this->input->post('ward_no');
            $sifaris_type   = $this->input->post('sifaris_type');
            $data['result'] = $this->Mdl_report->getChalaniReportBySearch($sifaris_type, $from_date,$to_date,$ward_no);
            $data_view = $this->load->view('chalani_search', $data, true);
            $response                   = array(
                'status'                  => 'success',
                'data'                    => $data_view
            );
            header("Content-type: application/json");
            echo json_encode($response);
            exit;
        }
    }

    public function viewChalaniBook($uri) {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $data['title']              = "सिफारिस | दर्ता रिपोर्ट";
        $data['ward']               = $this->Mdl_user->getWard();
        $data['patra']              = $this->Mdl_patra_item->getAll();
        $data['chalani_list']       = $this->Mdl_chalani->getByUri($uri);
        $data['uridetails']         = $this->Mdl_patra_item->getNameByUri($uri);
        $this->load->view('User/header',$data);
        $this->load->view('chalani_book', $data);
        $this->load->view('User/footer');
    }

    public function chalani_book_excel($uri)
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $ward_login         = $this->session->userdata('ward_no');
        $is_muncipality     = $this->session->userdata('is_muncipality');
        $data['result']       = $this->Mdl_chalani->getByUri($uri);
        $data['uridetails']         = $this->Mdl_patra_item->getNameByUri($uri);
        $html = $this->load->view('chalani_book_excel', $data, TRUE);
        $filename =$data['uridetails']->name.'_चलानी_किताब_'.date('Y-m-d H:i:s');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"');
        header('Cache-Control: max-age=0');
        echo $html;
        die();
    }

    public function darta_book_excel($uri)
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $ward_login             = $this->session->userdata('ward_no');
        $is_muncipality         = $this->session->userdata('is_muncipality');
        $data['darta_list']     = $this->Mdl_darta->getByUri($uri);
        $data['uridetails']     = $this->Mdl_patra_item->getNameByUri($uri);
        $html                   = $this->load->view('darta_book_excel', $data, TRUE);
        $filename               = $data['uridetails']->name.'_दर्ता_किताब_'.date('Y-m-d H:i:s');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"');
        header('Cache-Control: max-age=0');
        echo $html;
        die();
    }
}//end of class