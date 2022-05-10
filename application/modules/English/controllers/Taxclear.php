<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TaxClear extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $this->load->model('Home/Mdl_print_details');
        $this->load->model('English/Mdl_tax');
        $this->load->model('DartaChalaniBook/Mdl_darta');
        $this->load->model('DartaChalaniBook/Mdl_chalani');
        $this->load->model('Settings/Mdl_office');
        $this->load->model('Settings/Mdl_state');
        $this->load->model('Settings/Mdl_district');
        $this->load->model('Settings/Mdl_local_body');
        $this->load->model('Settings/Mdl_ward');
        $this->load->model('Settings/Mdl_work');
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
        $this->load->model('Settings/Mdl_post');
        $this->load->helper('functions_helper');
        $this->load->model('User/Mdl_user');
        $this->load->model('User/Mdl_relation');

        $this->load->helper('string');
        $this->load->helper('functions_helper');
    }

    /*------------------------------------------------------------------------------------------------------------------*/

    public function index()
    {
     
        Modules::run("User/checkWardLogin");
        $data['title'] = "Relationship | Dashboard";
        $data['result']  = $this->Mdl_tax->getAll();
        
        $this->load->view('User/header',$data);
        $this->load->view('tax_clear/list');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*-------    cit Cert. Starts
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create()
    {
        
        Modules::run("User/checkWardLogin");
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['relation']       = $this->Mdl_relation->getAll();
        $data1['title'] = "नयाँ | नागरिकता प्रमाण पत्र ";
        $this->load->view('User/header',$data1);
        $this->load->view('tax_clear/create',$data);
        $this->load->view('User/footer');
    }

    public function saveDetails() {
        if(isset($_POST['submit'])) {
            $date                   = $this->input->post('nepali_date');
            $gender                 = $this->input->post('gender');
            $name                   = $this->input->post('applicant_name');
            $per_state              = $this->input->post('per_state');
            $per_dis                = $this->input->post('per_dis');
            $per_gapana             = $this->input->post('per_gapanapa');
            $per_ward               = $this->input->post('per_ward');
            $current_session        = Modules::run("Settings/getCurrentSession");
            $form_id                = Modules::run("Home/genFormId");
            $save = array(
                'date'              => $date,
                'form_id'           => $form_id,
                'session_id'        => $current_session->id,
                'status'            => 1,
                'gender'            => $gender,
                'app_name'          => $name,
                'per_state'         => $per_state,
                'per_district'      => $per_dis,
                'per_gapana'        => $per_gapana,
                'per_ward'          => $per_ward,
                'added_on'          => date('Y-mm-dd H:i:s'),
                'added_by'          => $this->session->userdata('id'),
                'added_ward'        => $this->session->userdata('ward_no')
            );
            if($id = $this->Mdl_tax->save($save)) {
                $this->session->set_flashdata('msg'," Success");
                redirect('tax-clearance-en/detail/'.$id);
            } else {
                $this->session->set_flashdata('err_msg'," समस्या आयो |");
                redirect('tax-clearance-en/create');
            }
        }
    }

    public function tax_details() {
        
        $id = $this->uri->segment(3);
        if(empty($id)){
            redirect('tax-clearance');
        }
        Modules::run("User/checkWardLogin");
        $data['title']              = "Birth Certificate | Details";
        $data['page']               = 'tax_clear/details';
        $data['detail']             = $this->Mdl_tax->getById($id);
        //pp(is_numeric($data['detail']->status))
        
        if($data['detail']->status == 3){
            $data['chalani_details']    = $this->Mdl_chalani->getByFormId($data['detail']->form_id);
        }
        $data['dis']                = $this->Mdl_district->getById($data['detail']->per_district);
        $data['gapa']               = $this->Mdl_local_body->getById($data['detail']->per_gapana);
        $data['state']              = $this->Mdl_state->getById($data['detail']->per_state);
        $data['current_session']        = Modules::run("Settings/getCurrentSession");
        if($this->session->userdata('is_muncipality') == 1 ) {
           $data['ward_worker'] = $this->Mdl_worker->getBypost(5);
        } else {
           $data['ward_worker']    = $this->Mdl_ward_worker->getByWardPost($this->session->userdata('ward_no'), 5);
        }
        $this->load->view('main', $data);
    }

    public function edit_details() {
        $id = $this->uri->segment(3);
        if(empty($id)){
            redirect('relationship');
        }
        Modules::run("User/checkWardLogin");
        $data['title']          = "TaxClear Verification | Edit";
        $data['page']           = 'tax_clear/edit';
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['detail']         = $this->Mdl_tax->getById($id);
        $data['relation']       = $this->Mdl_relation->getAll();
        $data['reldetail']      = $this->Mdl_tax->getRelationShipDetails($id);
        $this->load->view('main', $data);
    }

    public function update() {
        if(isset($_POST['submit'])) {
            $id                     = $this->input->post('id');
            $date                   = $this->input->post('nepali_date');
            $gender                 = $this->input->post('gender');
            $name                   = $this->input->post('applicant_name');
            $per_state              = $this->input->post('per_state');
            $per_dis                = $this->input->post('per_dis');
            $per_gapana             = $this->input->post('per_gapanapa');
            $per_ward               = $this->input->post('per_ward');
            $current_session        = Modules::run("Settings/getCurrentSession");
            $form_id                = Modules::run("Home/genFormId");
            $save = array(
                'date'              => $date,
                'session_id'        => $current_session->id,
                'status'            => 1,
                'gender'            => $gender,
                'app_name'          => $name,
                'per_state'         => $per_state,
                'per_district'      => $per_dis,
                'per_gapana'        => $per_gapana,
                'per_ward'          => $per_ward,
            );
            if($id = $this->Mdl_tax->update($id,$save)) {
              
                $this->session->set_flashdata('msg'," Success");
                redirect('tax-clearance-en/detail/'.$id);

                $this->session->set_flashdata('msg'," Success");
                redirect('tax-clearance-en/detail/'.$id);
            } else {
                $this->session->set_flashdata('err_msg'," समस्या आयो |");
                redirect('tax-clearance-en/create');
            }
        }
    }

    public function darta_details() {

        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("tax-clearance");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_tax->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("tax-clearance");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("tax-clearance");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("tax-clearance");
        }
        $is_muncipality = $this->session->userdata('is_muncipality');
        $ward_login                 = $this->session->userdata('ward_no');
        $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward_login);
        $data['status']             = 2;
        $data['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
        if($this->Mdl_tax->update($id,$data))
        {
            $save['type']               = 8;
            $save['applicant_name']     = $result->app_name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $save['sifaris_id']         = $id;
            $current_session            = Modules::run("Settings/getCurrentSession");
            $save['session_id']         = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $is_muncipality = $this->session->userdata('is_muncipality');
            $ward = $this->session->userdata('ward_no');
            if($is_muncipality == 0)
            {

                $save['is_muncipality'] = '0';
                $save['ward_login'] = $ward;
            }
            elseif($is_muncipality == 1)
            {
                $save['is_muncipality'] = '1';
                $save['department']     = $this->session->userdata('department');
            }
            $save['english_darta_miti'] = date("Y-m-d",time());
            $save['nepali_darta_miti']  = DateEngToNep($save['english_darta_miti']);
            $fiscal_year_end_date       = $this->Mdl_darta->getFiscalYearEndDate();

            $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
            //pp($save);
            $this->Mdl_darta->save($save);
            $this->session->set_flashdata('msg'," Success");
            redirect('tax-clearance-en/detail/'.$id);
        }
    }

    public function chalani_details()
    {
       
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_tax->getById($id);
        //pp($result);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("tax-clearance-en");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("tax-clearance-en");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("tax-clearance-en");
        }
       
        $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        $is_muncipality = $this->session->userdata('is_muncipality');
        $ward = $this->session->userdata('ward_no');
        if($is_muncipality == 0)
        {

            $save['is_muncipality'] = '0';
            $save['ward_login'] = $ward;
        }
        else if($is_muncipality == 1)
        {
            $save['is_muncipality'] = '1';
            $save['department']     = $this->session->userdata('department');
        }
        
        //$save['applicant_name']         = $result->app_name;
        $save['form_id']                = $result->form_id;
        $save['english_chalani_miti']   = date("Y-m-d",time());
        $save['nepali_chalani_miti']    = DateEngToNep($save['english_chalani_miti']);
        $save['applicant_name']         = $result->app_name;
        $save['ward_login']             = $this->session->userdata('ward_no');
        $save['uri']                    = $this->uri->segment(1);
        $current_session                = Modules::run("Settings/getCurrentSession");
        $save['session_id']             = $current_session->id;
        $save['user_id']                = $this->session->userdata('id');
        $chalani_no                       = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
        $save['chalani_no']     = $chalani_no==FALSE ? 1 : $chalani_no + 1;
        if(!empty($_POST['department']))
        {
            $save['department']     = $this->input->post('department');
        }
        if(!empty($_POST['department_other']))
        {
            $save['department_other'] = $this->input->post('department_other');
        }
        //pp($save);
        $this->Mdl_chalani->save($save);
        $data['status']     = 3;
        if($this->Mdl_tax->update($id,$data))
        {
            $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
            redirect("tax-clearance-en/detail/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("tax-clearance-en");
        }
       // }
        // $data['departments']    = $this->Mdl_department->getAll();
        // $data1['title']         = "Approve";
        // $this->load->view('User/header',$data1);
        // $this->load->view('chalani',$data);
        // $this->load->view('User/footer');
    }

    public function print() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("tax-clearance-en");
        }
        $id         = $this->uri->segment(3);
        $data['detail'] = $result     = $this->Mdl_tax->getById($id);

        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("tax-clearance-en");
        }
      
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri;
            $save['form_id'] = $result->form_id;
            $save['office_id'] = '';
            $save['worker_id'] = $_POST['ward_worker'];
            if($this_print == FALSE)
            {
                $save['created_at'] = date('Y-m-d H:i:sa');
                $this->Mdl_print_details->save($save);

            }
            else
            {
                $save['updated_at'] = date('Y-m-d H:i:sa');
                $this->Mdl_print_details->update($this_print->id , $save);
            }

        //------------------------------------------------
        $data['result_chalani'] = $this->Mdl_chalani->getByFormId($result->form_id);
        
        $data['form_id']    = $data['result_chalani']->form_id;
        $data['chalani_no'] =  $data['result_chalani']->chalani_no;
        $data['chalani_details']    = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['dis']                = $this->Mdl_district->getById($result->per_district);
        $data['gapa']               = $this->Mdl_local_body->getById($result->per_gapana);
        $data['state']              = $this->Mdl_state->getById($result->per_state);
       // $data['print_office']       = $this->Mdl_office->getById($_POST['office_id']);

        $data['print_details']          = $this->Mdl_print_details->getByURIandFormId($uri, $data['form_id']);
       // pp($data['print_details']);
        $data['worker_id']              = $this->Mdl_ward_worker->getById($data['print_details']->worker_id);
        $data['post']                   = $this->Mdl_post->getById($data['worker_id']->post_id);
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
       // if($this->session->userdata('is_muncipality') == 1 ) {
       //     $data['ward_worker'] = $this->Mdl_worker->getBypost(5);
       //  } else {
       //     $data['ward_worker']    = $this->Mdl_ward_worker->getByWardPost($this->session->userdata('ward_no'), 5);
       //  }
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head');
        $this->load->view('tax_clear/print',$data);
        $this->load->view('letter_footer_np');
        $this->load->view('User/footer');
    }
}
