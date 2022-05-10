<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class PropertyValuation extends MX_Controller {



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
        $this->load->model('Settings/Mdl_post');

        $this->load->helper('functions_helper');

        $this->load->model('User/Mdl_user');

        $this->load->model('English/Mdl_proverty_valuation');

        $this->load->helper('string');

        $this->load->helper('functions_helper');

    }



    /*------------------------------------------------------------------------------------------------------------------*/



    public function index()

    {  



        Modules::run("User/checkWardLogin");

        $data['title']  = "Property Valuation | Dashboard";

        $data['result']  = $this->Mdl_proverty_valuation->getAll();

        $this->load->view('User/header',$data);

        $this->load->view('property_valuation/list');

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

        $data1['title']         = "Property Valuation | Create";

        $this->load->view('User/header',$data1);

        $this->load->view('property_valuation/create',$data);

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

                'per_district'      => $per_dis,

                'per_ganapa'        => $per_gapana,

                'per_ward'          => $per_ward,

                'created_by'        => $this->session->userdata('id'),

                'created_at'        => date('Y-mm-dd H:i:s'),

                'ward_login'        => $this->session->userdata('ward_no')

            );

            if($id = $this->Mdl_proverty_valuation->save($save)) {

               $owner_name_new         = $this->input->post('owner_name');

                $desc_new               = $this->input->post('desc');

                $location_new           = $this->input->post('location');

                $plot_no_new            = $this->input->post('plot_no');

                $area_new               = $this->input->post('area');

                $amount_new             = $this->input->post('amount');

                $topic_details_new          = array();

                if(!empty($owner_name_new)) {

                    foreach ($owner_name_new as $key => $indexv) {

                        $topic_details[]    = array(

                            'owner_name'    => $owner_name_new[$key],

                            'descp'         => $desc_new[$key],

                            'location'      => $location_new[$key],

                            'plot_no'       => $plot_no_new[$key],

                            'area'          => $area_new[$key],

                            'amount'        => $amount_new[$key],

                            'main_id'       => $id

                        );

                    }
                $this->Mdl_proverty_valuation->saverels($topic_details);

                $this->session->set_flashdata('msg'," Success");
                redirect('property-valuation-en/detail/'.$id);
            }


            } else {

                $this->session->set_flashdata('err_msg'," समस्या आयो |");

                redirect('property-valuation-en/create');

            }

        }

    }



    public function darta_view() {

        $id = $this->uri->segment(3);

        if(empty($id)){

            redirect('annual_income-en');

        }

        Modules::run("User/checkWardLogin");

        $data['title']                  = "Property Valuation | Details";

        $data['page']                   = 'property_valuation/details';

        $data['states']                 = $this->Mdl_state->getAll();

        $data['districts']              = $this->Mdl_district->getAll();

        $data['locals']                 = $this->Mdl_local_body->getAll();

        $data['result']                 = $this->Mdl_proverty_valuation->getById($id);

        $data['sources']                 = $this->Mdl_proverty_valuation->getRelationShipDetails($id);
       // pp($data['sources']);

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

        $data['title']          = "Property Valuation | Details";

        $data['page']           = 'property_valuation/edit';

        $data['states']         = $this->Mdl_state->getAll();

        $data['districts']      = $this->Mdl_district->getAll();

        $data['locals']         = $this->Mdl_local_body->getAll();

        $data['wards']          = $this->Mdl_ward->getAll();

        $data['detail']         = $this->Mdl_proverty_valuation->getById($id);

        $data['sources']                 = $this->Mdl_proverty_valuation->getRelationShipDetails($id);

        $this->load->view('main', $data);

    }



    public function update() {

         if(isset($_POST['submit'])) {

            $id                     = $this->input->post('id');

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

            if($this->Mdl_proverty_valuation->update($id,$save)) {

                $rel_id                 = $this->input->post('rel_id');

                $owner_name             = $this->input->post('owner_name');

                $desc                   = $this->input->post('desc');

                $location               = $this->input->post('location');

                $plot_no                = $this->input->post('plot_no');

                $area                   = $this->input->post('area');

                $amount                 = $this->input->post('amount');

                $topic_details          = array();

                if(!empty($owner_name)) {

                    foreach ($owner_name as $key => $indexv) {

                        $topic_details[]    = array(

                            'id'        => $rel_id[$key],

                            'owner_name'    => $owner_name[$key],

                            'descp'         => $desc[$key],

                            'location'      => $location[$key],

                            'plot_no'       => $plot_no[$key],

                            'area'          => $area[$key],

                            'amount'        => $amount[$key],

                        );

                    }

                   $this->Mdl_proverty_valuation->updateMembers($rel_id,$topic_details);

                }

                // pp($rel_id);

                $owner_name_new         = $this->input->post('owner_name_new');

                $desc_new               = $this->input->post('desc_new');

                $location_new           = $this->input->post('location_new');

                $plot_no_new            = $this->input->post('plot_no_new');

                $area_new               = $this->input->post('area_new');

                $amount_new             = $this->input->post('amount_new');

                $topic_details_new          = array();

                if(!empty($owner_name_new)) {

                    foreach ($owner_name_new as $key => $indexv) {

                        $topic_details_new[]    = array(

                            'owner_name'    => $owner_name_new[$key],

                            'descp'         => $desc_new[$key],

                            'location'      => $location_new[$key],

                            'plot_no'       => $plot_no_new[$key],

                            'area'          => $area_new[$key],

                            'amount'        => $amount_new[$key],

                            'main_id'       => $id

                        );

                    }

                    $this->Mdl_proverty_valuation->saverels($topic_details_new);

                }

               // pp($topic_details_new);

                $this->session->set_flashdata('msg'," Success");

                redirect('property-valuation-en/edit/'.$id);

            } else {

                $this->session->set_flashdata('err_msg'," समस्या आयो |");

                redirect('property-valuation-en/create');

            }

        }

    }



    public function darta_details() {

        if(empty($this->uri->segment(3)))

        {

            $this->session->set_flashdata('err_msg',"समस्या आयो |");

            redirect("property-valuation-en");

        }

        $id         = $this->uri->segment(3);

        $result     = $this->Mdl_proverty_valuation->getById($id);

        if(empty($result))

        {

            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");

            redirect("property-valuation-en");

        }

        if($result->status == 2)

        {

            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");

            redirect("property-valuation-en");

        }

        if($result->status == 3)

        {

            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");

            redirect("annual_income-en");

        }

        $ward_login                 = $this->session->userdata('ward_no');
        $is_muncipality = $this->session->userdata('is_muncipality');
        $data['status']             = 2;

        $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward_login);

        $data['status']             = 2;

        $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;

        $data['darta_no']           = $save['darta_no'];

        $current_session            = Modules::run("Settings/getCurrentSession");

        if($this->Mdl_proverty_valuation->update($id,$data))

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

            redirect('property-valuation-en/detail/'.$id);

        }

    }



    public function chalani_details()

    {

        Modules::run("User/checkWardLogin");

        $id         = $this->uri->segment(3);

        $result     = $this->Mdl_proverty_valuation->getById($id);

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

        if($this->Mdl_proverty_valuation->update($id,$data))

        {

            $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");

            redirect("property-valuation-en/detail/".$id);

        }

        else

        {

            $this->session->set_flashdata('err_msg',"समस्या आयो |");

            redirect("annual_income-en");

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

        $data['result'] = $result   = $this->Mdl_proverty_valuation->getById($id);

        $data['sources']            = $this->Mdl_proverty_valuation->getRelationShipDetails($id);

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
        $this->load->view('property_valuation/print',$data);
        $this->load->view('letter_footer_np');
        $this->load->view('User/footer');

    }



    public function removeData($main_id,$id) {

        $result = $this->Mdl_proverty_valuation->deleteSource($id);

        if($result) {

            $this->session->set_flashdata('msg',"Success | ");

            redirect("property-valuation-en/edit/".$main_id);

        } else {

            $this->session->set_flashdata('err_msg',"fail");

            redirect("annual_income-en");

        }

    }

}

