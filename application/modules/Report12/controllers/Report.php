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
        $data['patra_item']         = $this->Mdl_patra_item->getAll();
        $item_count = array();
        $i = 1;
        if(!empty($data['patra_item'])) {
            foreach($data['patra_item'] as $key => $patra) {
                $nestedData['sn']               = $i++;
                $count_sifaris                  = $this->Mdl_report->getDartaReport($patra->uri);
                $nestedData['id']               = $patra->id;
                $nestedData['uri']              = $patra->uri;
                $nestedData['name']             = $patra->name;
                $category                       = $this->Mdl_patra_category->getById($patra->category_id);
                $nestedData['category']         = $category->name;
                $nestedData['totalcount']       = $count_sifaris->total;
                $item_count[] = $nestedData;
            }
        }
        $data['item_count'] = $item_count;
        $this->load->view('User/header',$data);
        $this->load->view('darta_report', $data);
        $this->load->view('User/footer');
    }
    public function searchDartaReport() {
        if($this->input->is_ajax_request())
        {
            $data['patra_item'] = $this->Mdl_patra_item->getAll();
            $from_date      = $this->input->post('from_date');
            $to_date        = $this->input->post('to_date');
            $ward_no        = $this->input->post('ward_no');
            $item_count     = array();
            $i = 1;
            if(!empty($data['patra_item'])) {
                foreach($data['patra_item'] as $key => $patra) {
                    $nestedData['sn']               = $i++;
                    $nestedData['id']               = $patra->id;
                    $nestedData['uri']              = $patra->uri;
                    $nestedData['name']             = $patra->name;
                    $count_sifaris                  = $this->Mdl_report->getDartaReportBySearch($patra->uri, $from_date,$to_date,$ward_no);
                    $nestedData['totalcount']       = $count_sifaris->total;
                    $item_count[] = $nestedData;
                }
            }
            $data['item_count'] = $item_count;
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
        $data['patra_item'] = $this->Mdl_patra_item->getAll();
        $item_count = array();
        $i = 1;
        if(!empty($data['patra_item'])) {
            foreach($data['patra_item'] as $key => $patra) {
                $nestedData['sn']               = $i++;
                $nestedData['id']               = $patra->id;
                $nestedData['uri']              = $patra->uri;
                $nestedData['name']             = $patra->name;
                $category                       = $this->Mdl_patra_category->getById($patra->category_id);
                $nestedData['category']         = $category->name;
                $count_sifaris                  = $this->Mdl_report->getChalaniReport($patra->uri);
                $nestedData['totalcount']       = $count_sifaris->total;
                $item_count[] = $nestedData;
            }
        }
        $data['item_count'] = $item_count;
        $this->load->view('User/header',$data);
        $this->load->view('chalani_report', $data);
        $this->load->view('User/footer');
    }

    public function searchChalaniReport() {
        if($this->input->is_ajax_request())
        {
            $data['patra_item'] = $this->Mdl_patra_item->getAll();
            $from_date      = $this->input->post('from_date');
            $to_date        = $this->input->post('to_date');
            $ward_no        = $this->input->post('ward_no');
            $item_count     = array();
            $i = 1;
            if(!empty($data['patra_item'])) {
                foreach($data['patra_item'] as $key => $patra) {
                    $nestedData['sn']               = $i++;
                    $nestedData['id']               = $patra->id;
                    $nestedData['uri']              = $patra->uri;
                    $nestedData['name']             = $patra->name;
                    $count_sifaris                  = $this->Mdl_report->getChalaniReportBySearch($patra->uri, $from_date,$to_date,$ward_no);
                    $nestedData['totalcount']       = $count_sifaris->total;
                    $item_count[] = $nestedData;
                }
            }
            $data['item_count'] = $item_count;
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
}//end of class