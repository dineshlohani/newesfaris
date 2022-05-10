<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class AnnualIncome extends MX_Controller {



    function __construct()

    {

        parent::__construct();



        if(Modules::run("User/is_logged_in") === FALSE)

        {

            redirect("login");

        }

        $this->load->model('Home/Mdl_print_details');

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

        $this->load->helper('functions_helper');

        $this->load->model('User/Mdl_user');

        $this->load->model('English/Mdl_annual_income');

        $this->load->helper('string');

        $this->load->helper('functions_helper');

    }



    /*------------------------------------------------------------------------------------------------------------------*/



    public function index()

    {  



        Modules::run("User/checkWardLogin");

        $data['title']  = "Address Verification | Dashboard";

        $data['result']  = $this->Mdl_annual_income->getAll();

        $this->load->view('User/header',$data);

        $this->load->view('annual_income/list');

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

        $data1['title']         = "Address Verification | Create";

        $this->load->view('User/header',$data1);

        $this->load->view('annual_income/create',$data);

        $this->load->view('User/footer');

    }



    public function saveDetails() {

        if(isset($_POST['submit'])) {

            $date                   = $this->input->post('nepali_date');

            $gender                 = $this->input->post('gender');

            $name                   = $this->input->post('applicant_name');

            $father_name            = $this->input->post('father_name');

            $mother_name            = $this->input->post('mother_name');

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

                'father_name'       => $father_name,

                'mother_name'       => $mother_name,

                'per_state'         => $per_state,

                'per_district'           => $per_dis,

                'per_ganapa'        => $per_gapana,

                'per_ward'          => $per_ward,

                'created_by'        => $this->session->userdata('id'),

                'created_date'      => date('Y-mm-dd H:i:s'),

                'ward_login'        => $this->session->userdata('ward_no')

            );

            if($id = $this->Mdl_annual_income->save($save)) {

                $income_source          = $this->input->post('income_source');

                $fy_i                   = $this->input->post('fy_i');

                $fy_ii                  = $this->input->post('fy_ii');

                $fy_iii                 = $this->input->post('fy_iii');

                $amount                 = $this->input->post('amount');

                $topic_details          = array();

                if(!empty($income_source)) {

                    foreach ($income_source as $key => $indexv) {

                        $topic_details[]    = array(

                            'main_id'       => $id,

                            'income_source' => $income_source[$key],

                            'fy_i'          => $fy_i[$key],

                            'fy_ii'         => $fy_ii[$key],

                            'fy_iii'        => $fy_iii[$key],

                        );

                    }

                }

                $this->Mdl_annual_income->saverels($topic_details);

                $this->session->set_flashdata('msg'," Success");

                redirect('annual-income-en/detail/'.$id);

            } else {

                $this->session->set_flashdata('err_msg'," समस्या आयो |");

                redirect('annual-income-en/create');

            }

        }

    }



    public function darta_view() {

        $id = $this->uri->segment(3);

        if(empty($id)){

            redirect('annual_income-en');

        }

        Modules::run("User/checkWardLogin");

        $data['title']                  = "Address Verification | Details";

        $data['page']                   = 'annual_income/details';

        $data['states']                 = $this->Mdl_state->getAll();

        $data['districts']              = $this->Mdl_district->getAll();

        $data['locals']                 = $this->Mdl_local_body->getAll();

        $data['result']                 = $this->Mdl_annual_income->getById($id);

        $data['sources']                 = $this->Mdl_annual_income->getRelationShipDetails($id);

        $data['wards']                  = $this->Mdl_ward->getAll();

        $data['per_state']              = $this->Mdl_state->getById($data['result']->per_state);

        $data['per_district']           = $this->Mdl_district->getById($data['result']->per_district);

        $data['per_gapa']               = $this->Mdl_local_body->getById($data['result']->per_ganapa);

        $current_session                = Modules::run("Settings/getCurrentSession");

        $data['current_session']        = $current_session;

        if($data['result']->status == 3){

            $data['chalani_details']    = $this->Mdl_chalani->getByFormId($data['result']->form_id);

        }

        if($this->session->userdata('is_muncipality') == 1 ) {
           $data['ward_worker'] = $this->Mdl_worker->getBypost(5);
        } else {
           $data['ward_worker']    = $this->Mdl_ward_worker->getByWardPost($this->session->userdata('ward_no'), 5);
        }
        // if($this->session->userdata('is_muncipality') == 1 ) {

        //    $data['ward_worker'] = $this->Mdl_worker->getBypost(5);

        // } else {

        //    $data['ward_worker']    = $this->Mdl_ward_worker->getByWardPost($this->session->userdata('ward_no'), 5);

        // }

        $this->load->view('main', $data);

    }



    public function edit_details() {

        $id = $this->uri->segment(3);

        if(empty($id)){

            redirect('annual_income-en');

        }

        Modules::run("User/checkWardLogin");

        $data['title']          = "Address Verification | Details";

        $data['page']           = 'annual_income/edit';

        $data['states']         = $this->Mdl_state->getAll();

        $data['districts']      = $this->Mdl_district->getAll();

        $data['locals']         = $this->Mdl_local_body->getAll();

        $data['wards']          = $this->Mdl_ward->getAll();

        $data['detail']         = $this->Mdl_annual_income->getById($id);

        $data['sources']                 = $this->Mdl_annual_income->getRelationShipDetails($id);

        $this->load->view('main', $data);

    }



    public function update() {

         if(isset($_POST['submit'])) {

            $id                     = $this->input->post('id');

            $date                   = $this->input->post('nepali_date');

            $gender                 = $this->input->post('gender');

            $name                   = $this->input->post('applicant_name');

            $father_name            = $this->input->post('father_name');

            $mother_name            = $this->input->post('mother_name');

            $per_state              = $this->input->post('per_state');

            $per_dis                = $this->input->post('per_dis');

            $per_gapana             = $this->input->post('per_gapanapa');

            $per_ward               = $this->input->post('per_ward');

            $current_session        = Modules::run("Settings/getCurrentSession");

            $form_id                = Modules::run("Home/genFormId");

            $save = array(

                'date'              => $date,

                'status'            => 1,

                'gender'            => $gender,

                'app_name'          => $name,

                'father_name'       => $father_name,

                'mother_name'       => $mother_name,

                'per_state'         => $per_state,

                'per_district'      => $per_dis,

                'per_ganapa'        => $per_gapana,

                'per_ward'          => $per_ward,

            );

            if($this->Mdl_annual_income->update($id,$save)) {

                $rel_id                 = $this->input->post('rel_id');

                $income_source          = $this->input->post('income_source');

                $fy_i                   = $this->input->post('fy_i');

                $fy_ii                  = $this->input->post('fy_ii');

                $fy_iii                 = $this->input->post('fy_iii');

                $topic_details          = array();

                if(!empty($income_source)) {

                    foreach ($income_source as $key => $indexv) {

                        $topic_details[]    = array(

                            'id'            => $rel_id[$key],

                            'income_source' => $income_source[$key],

                            'fy_i'          => $fy_i[$key],

                            'fy_ii'         => $fy_ii[$key],

                            'fy_iii'        => $fy_iii[$key],

                        );

                    }

                    $this->Mdl_annual_income->updateMembers($rel_id,$topic_details);

                }

                $income_source_new          = $this->input->post('income_source_new');

                $fy_i_new                   = $this->input->post('fy_i_new');

                $fy_ii_new                  = $this->input->post('fy_ii_new');

                $fy_iii_new                 = $this->input->post('fy_iii_new');

                $topic_details_new          = array();

                if(!empty($income_source_new)) {

                    foreach ($income_source_new as $key => $indexv) {

                        $topic_details_new[]    = array(

                            'main_id'       => $id,

                            'income_source' => $income_source_new[$key],

                            'fy_i'          => $fy_i_new[$key],

                            'fy_ii'         => $fy_ii_new[$key],

                            'fy_iii'        => $fy_iii_new[$key],

                        );

                    }

                    $this->Mdl_annual_income->saverels($topic_details_new);

                }

                $this->session->set_flashdata('msg'," Success");

                redirect('annual-income-en/detail/'.$id);

            } else {

                $this->session->set_flashdata('err_msg'," समस्या आयो |");

                redirect('annual-income-en/create');

            }

        }

    }



    public function darta_details() {

        if(empty($this->uri->segment(3)))

        {

            $this->session->set_flashdata('err_msg',"समस्या आयो |");

            redirect("annual-income-en");

        }

        $id         = $this->uri->segment(3);

        $result     = $this->Mdl_annual_income->getById($id);

        if(empty($result))

        {

            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");

            redirect("annual-income-en");

        }

        if($result->status == 2)

        {

            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");

            redirect("annual-income-en");

        }

        if($result->status == 3)

        {

            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");

            redirect("annual_income-en");

        }
        $is_muncipality = $this->session->userdata('is_muncipality');
        $ward_login                 = $this->session->userdata('ward_no');

        $data['status']             = 2;

        $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward_login);

        $data['status']             = 2;

        $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;

        $data['darta_no']           = $save['darta_no'];

        $current_session            = Modules::run("Settings/getCurrentSession");

        if($this->Mdl_annual_income->update($id,$data))

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

            if($is_muncipality == 0)

            {

                $save['is_muncipality'] = '0';

                $save['ward_login'] = $ward_login;

            }

            elseif($is_muncipality == 1)

            {

                $save['is_muncipality'] = '1';

                $save['department']     = $this->session->userdata('department');

            }

            $save['english_darta_miti'] = date("Y-m-d",time());

            $save['nepali_darta_miti']  = DateEngToNep($save['english_darta_miti']);

            

            $this->Mdl_darta->save($save);

            $this->session->set_flashdata('msg'," Success");

            redirect('annual-income-en/detail/'.$id);

        }

    }



    public function chalani_details()

    {

        Modules::run("User/checkWardLogin");

        $id         = $this->uri->segment(3);

        $result     = $this->Mdl_annual_income->getById($id);

        if(empty($result))

        {

            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");

            redirect("annual_income-en");

        }

        if($result->status == 1)

        {

            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");

            redirect("annual_income-en/detail/".$result->id);

        }

        if($result->status == 3)

        {

            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छ। | ");

             redirect("annual_income-en/detail/".$result->id);

        }

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

        $chalani_no                     = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);

        $save['chalani_no']             = $chalani_no==FALSE ? 1 : $chalani_no + 1;

        $save['form_id']                = $result->form_id;

        $save['english_chalani_miti']   = date("Y-m-d",time());

        $save['nepali_chalani_miti']    = DateEngToNep($save['english_chalani_miti']);

        $save['applicant_name']         = $result->app_name;

        $save['ward_login']             = $this->session->userdata('ward_no');

        $save['uri']                    = $this->uri->segment(1);

        $current_session                = Modules::run("Settings/getCurrentSession");

        $save['session_id']             = $current_session->id;

        $save['user_id']                = $this->session->userdata('id');

        $save['darta_id']               = $id;

        $save['type']                   = 8;

        if(!empty($_POST['department']))

        {

            $save['department']     = $this->input->post('department');

        }

        if(!empty($_POST['department_other']))

        {

            $save['department_other'] = $this->input->post('department_other');

        }

        $this->Mdl_chalani->save($save);

        $data['status']     = 3;

        if($this->Mdl_annual_income->update($id,$data))

        {

            $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");

            redirect("annual-income-en/detail/".$id);

        }

        else

        {

            $this->session->set_flashdata('err_msg',"समस्या आयो |");

            redirect("annual-income-en");

        }

    }



    public function print() {

        Modules::run("User/checkWardLogin");

        if(empty($this->uri->segment(3)))

        {

            $this->session->set_flashdata('err_msg',"समस्या आयो |");

            redirect("annual_income-en");

        }

        $id         = $this->uri->segment(3);

        $data['result'] = $result   = $this->Mdl_annual_income->getById($id);

        $data['sources']            = $this->Mdl_annual_income->getRelationShipDetails($id);

        if(empty($result))

        {

            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");

            redirect("annual_income-en");

        }

      

        //-----saving printing details--------------------

            $uri                = $this->uri->segment(1);

            $this_print         = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);

            $save['uri']        = $uri;

            $save['form_id']    = $result->form_id;

            $save['office_id']  = '';

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

        $data['result_chalani']         = $this->Mdl_chalani->getByFormId($result->form_id);

        $data['form_id']                = $data['result_chalani']->form_id;

        $data['chalani_no']             = $data['result_chalani']->chalani_no;

        $data['per_state']              = $this->Mdl_state->getById($data['result']->per_state);

        $data['per_district']           = $this->Mdl_district->getById($data['result']->per_district);

        $data['per_gapa']               = $this->Mdl_local_body->getById($data['result']->per_ganapa);

        $data['current_session']        = Modules::run("Settings/getCurrentSession");

        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));

        $data['print_details']          = $this->Mdl_print_details->getByURIandFormId($uri, $data['form_id']);
        $data['worker_id']              = $this->Mdl_ward_worker->getById($data['print_details']->worker_id);
        $data['post']                   = $this->Mdl_post->getById($data['worker_id']->post_id);

       // if($this->session->userdata('is_muncipality') == 1 ) {

       //     $data['ward_worker'] = $this->Mdl_worker->getBypost(5);

       //  } else {

       //     $data['ward_worker']    = $this->Mdl_ward_worker->getByWardPost($this->session->userdata('ward_no'), 5);

       //  }

        $data1['title']         = "Print";

        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head');
        $this->load->view('annual_income/print',$data);
        $this->load->view('letter_footer_np');
        $this->load->view('User/footer');

    }



    public function removeData($main_id,$id) {

        $result = $this->Mdl_annual_income->deleteSource($id);

        if($result) {

            $this->session->set_flashdata('msg',"Success | ");

            redirect("annual-income-en/edit/".$main_id);

        } else {

            $this->session->set_flashdata('err_msg',"fail");

            redirect("annual_income-en");

        }

    }

}

