<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Birth extends MX_Controller {
    function __construct()
    {
        parent::__construct();
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $this->load->model('Home/Mdl_print_details');
        $this->load->model('English/Mdl_birth');
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
        $this->load->model('Settings/Mdl_post');
        $this->load->model('Settings/Mdl_worker');
        $this->load->helper('functions_helper');
        $this->load->model('User/Mdl_user');
        $this->load->helper('string');
        $this->load->helper('functions_helper');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function index()
    {
        Modules::run("User/checkWardLogin");
        $data['title'] = "Birth Certificate | Dashboard";
        $data['result'] = $this->Mdl_birth->getAll();
        $this->load->view('User/header',$data);
        $this->load->view('birth_certificate/list',$data);
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
        $data1['title']         = "English | Birth Certificate";

        $this->load->view('User/header',$data1);

        $this->load->view('birth_certificate/create',$data);

        $this->load->view('User/footer');

    }



    public function saveDetails() {

        if(isset($_POST['submit'])) {

            $date                   = $this->input->post('nepali_date');

            $gender                 = $this->input->post('gender');

            $name                   = $this->input->post('applicant_name');

            $son_daughter           = $this->input->post('son_daughter');

            $father_name            = $this->input->post('father_name');

            $mother_name            = $this->input->post('mother_name');

            $born_state             = $this->input->post('born_state');

            $born_dis               = $this->input->post('born_district');

            $birth_gapana           = $this->input->post('born_gapanapa');

            $born_ward              = $this->input->post('born_ward');

            $per_state              = $this->input->post('per_state');

            $per_dis                = $this->input->post('per_dis');

            $per_gapana             = $this->input->post('per_gapanapa');

            $per_ward               = $this->input->post('per_ward');

            $nep_dob                = $this->input->post('nep_dob');

            $eng_dob                = $this->input->post('eng_dob');

            $current_session        = Modules::run("Settings/getCurrentSession");

            $form_id                = Modules::run("Home/genFormId");

            $path = 'assets/documents/english/birth_certificate/';

            // if (!file_exists($path))

            // {

            //     mkdir($path, 0777, true);

            // }

            // $count  = count($_FILES['documents']['name']);

            // $file = "";

            // $doc_type = "";

            // for($i = 0 ;$i < $count ;$i++)

            // {

            //     if (!empty($_FILES['documents']['name'][$i]))

            //     {

            //         $temp_path = $_FILES['documents']['tmp_name'][$i];

            //         $source = $_FILES['documents']['name'][$i];

            //         $ext = pathinfo($source, PATHINFO_EXTENSION);

            //         $file_name = md5(uniqid() . time()) . "." . $ext;

            //         $destination = $path . $file_name;

            //         move_uploaded_file($temp_path, $destination);



            //         if($i == $count-1)

            //         {

            //             $file       .= $file_name;

            //             $doc_type   .= $this->input->post('documents_type')[$i];

            //         }

            //         else

            //         {

            //             $file       .= $file_name."+";

            //             $doc_type   .= $this->input->post('documents_type')[$i]."+";

            //         }

            //     }



            // }

            $save = array(

                'date'              => $date,

                'form_id'           => $form_id,

                'session_id'        => $current_session->id,

                'status'            => 1,

                'login_id'          => $this->session->userdata('id'),

                'gender'            => $gender,

                'app_name'          => $name,

                'son_daughter'      => $gender,

                'gender_f'          => 'MR',

                'father_name'       => $father_name,

                'gender_m'          => 'MRS',

                'mother_name'       => $mother_name,

                'birth_state'       => '',

                'birth_district'    => $born_dis,

                'birth_gapana'      => $birth_gapana,

                'birth_ward'        => $born_ward,

                'per_state'         => $per_state,

                'per_district'      => $per_dis,

                'per_gapana'        => $per_gapana,

                'per_ward'          => $per_ward,

                'dob_np'            => $nep_dob,

                'dob_en'            => $eng_dob,

                'added_date'        => date('Y-m-d H:i:s'),

                'added_by'          => $this->session->userdata('id'),

                'ward_login'        => $this->session->userdata('ward_no')

            );

            

            if($id = $this->Mdl_birth->save($save)) {



                $this->session->set_flashdata('msg'," Success");

                redirect('birth-certificate/detail/'.$id);

            } else {

                $this->session->set_flashdata('err_msg'," समस्या आयो |");

                redirect('birth-certificate/create');

            }

        }

    }



    public function birth_certificate_details() {

        $id = $this->uri->segment(3);

        if(empty($id)){

            redirect('birth-certificate');

        }

        Modules::run("User/checkWardLogin");

        $data['title']                  = "Birth Certificate | Details";

        $data['page']                   = 'birth_certificate/details';

        $data['default']                = getDefault();

        $data['states']                 = $this->Mdl_state->getAll();

        $data['districts']              = $this->Mdl_district->getAll();

        $data['locals']                 = $this->Mdl_local_body->getAll();

        $data['wards']                  = $this->Mdl_ward->getAll();

        $data['result']                 = $this->Mdl_birth->getById($id);

        $data['chalani_details']        = $this->Mdl_chalani->getByFormId($data['result']->form_id);

        $data['born_dis']               = $this->Mdl_district->getById($data['result']->birth_district);

        $data['born_gapa']              = $this->Mdl_local_body->getById($data['result']->birth_gapana);

        $data['per_gapa']               = $this->Mdl_local_body->getById($data['result']->per_gapana);

        $data['per_state']              = $this->Mdl_state->getById($data['result']->per_state);

        $data['per_district']           = $this->Mdl_district->getById($data['result']->per_district);

        $current_session                = Modules::run("Settings/getCurrentSession");

        $data['current_session']        = $current_session;

        $data['print_office']           = $this->Mdl_office->getById(5);

        if($this->session->userdata('is_muncipality') == 1 ) {

           $data['ward_worker']         = $this->Mdl_worker->getBypost(1);

        } else {

           $data['ward_worker']         = $this->Mdl_ward_worker->getByWardPost($this->session->userdata('ward_no'));

        }
        $data['title'] = "नयाँ | नागरिकता प्रमाण पत्र ";

        $this->load->view('User/header',$data);

        $this->load->view('birth_certificate/details',$data);

        $this->load->view('User/footer');

    }



    public function edit_details() {

        $id = $this->uri->segment(3);

        if(empty($id)){

            redirect('birth-certificate');

        }

        Modules::run("User/checkWardLogin");

        $data['title'] = "Birth Certificate | Details";

        $data['page']  = 'birth_certificate/edit';

        $data['states']         = $this->Mdl_state->getAll();

        $data['districts']      = $this->Mdl_district->getAll();

        $data['locals']         = $this->Mdl_local_body->getAll();

        $data['wards']          = $this->Mdl_ward->getAll();

        $data['detail'] = $this->Mdl_birth->getById($id);

        $this->load->view('main', $data);

    }



    public function update() {

        if(isset($_POST['submit'])) {

            $id                     = $this->input->post('id');

           

            $date                   = $this->input->post('nepali_date');

            $gender                 = $this->input->post('gender');

            $name                   = $this->input->post('applicant_name');

            $son_daughter           = $this->input->post('son_daughter');

            $father_name            = $this->input->post('father_name');

            $mother_name            = $this->input->post('mother_name');

            $born_state             = $this->input->post('born_state');

            $born_dis               = $this->input->post('born_district');

            $birth_gapana           = $this->input->post('born_gapanapa');

            $born_ward              = $this->input->post('born_ward');

            $per_state              = $this->input->post('per_state');

            $per_dis                = $this->input->post('per_dis');

            $per_gapana             = $this->input->post('per_gapanapa');

            $per_ward               = $this->input->post('per_ward');

            $nep_dob                = $this->input->post('nep_dob');

            $eng_dob                = $this->input->post('eng_dob');

            $current_session        = Modules::run("Settings/getCurrentSession");

            $form_id                = Modules::run("Home/genFormId");

            $save = array(

                

                'status'            => 1,

                'login_id'          => $this->session->userdata('id'),

                'gender'            => $gender,

                'app_name'          => $name,

                'son_daughter'      => $son_daughter,

                'gender_f'          => 'MR',

                'father_name'       => $father_name,

                'gender_m'          => 'MRS',

                'mother_name'       => $mother_name,

                'birth_state'       => '',

                'birth_district'    => $born_dis,

                'birth_gapana'      => $birth_gapana,

                'birth_ward'        => $born_ward,

                'per_state'         => $per_state,

                'per_district'      => $per_dis,

                'per_gapana'        => $per_gapana,

                'per_ward'          => $per_ward,

                'dob_np'            => $nep_dob,

                'dob_en'            => $eng_dob,

               

            );

            //pp($save);

            if($this->Mdl_birth->update($id,$save)) {

                $this->session->set_flashdata('msg'," Success");

                redirect('birth-certificate/detail/'.$id);

            } else {

                $this->session->set_flashdata('err_msg'," समस्या आयो |");

                redirect('birth-certificate/create');

            }

        }

    }



    public function darta_details() {

        if(empty($this->uri->segment(3)))

        {

            $this->session->set_flashdata('err_msg',"समस्या आयो |");

            redirect("birth-certificate");

        }

        $id         = $this->uri->segment(3);

        $result     = $this->Mdl_birth->getById($id);

        if(empty($result))

        {

            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");

            redirect("birth-certificate");

        }

        if($result->status == 2)

        {

            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");

            redirect("birth-certificate");

        }

        if($result->status == 3)

        {

            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");

            redirect("birth-certificate");

        }

        $is_muncipality = $this->session->userdata('is_muncipality');

        $ward_login                 = $this->session->userdata('ward_no');

        $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward_login);

        $data['status']             = 2;

        $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;

        $data['darta_no']           = $save['darta_no'];

        $current_session            = Modules::run("Settings/getCurrentSession");

        if($this->Mdl_birth->update($id,$data))

        {

            $save['type']               = 8;

            $save['applicant_name']     = $result->app_name;

            $save['ward_login']         = $this->session->userdata('ward_no');

            $save['uri']                = $this->uri->segment(1);

            $save['sifaris_id']         = $id;

            $save['session_id']         = $current_session->id;

            $save['user_id']            = $this->session->userdata('id');

            

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

            

            $save['form_id']            = $result->form_id;

            $this->Mdl_darta->save($save);

            $this->session->set_flashdata('msg'," Success");

            redirect('birth-certificate/detail/'.$id);

        }

    }



    public function chalani_details()

    {

        Modules::run("User/checkWardLogin");

        $id         = $this->uri->segment(3);

        $result     = $this->Mdl_birth->getById($id);

        //pp($result);

        if(empty($result))

        {

            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");

            redirect("birth-certificate");

        }

        if($result->status == 1)

        {

            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");

            redirect("home-recommend");

        }

        if($result->status == 3)

        {

            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");

            redirect("home-recommend");

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

        $save['form_id']                = $result->form_id;

        $save['english_chalani_miti']   = date("Y-m-d",time());

        $save['nepali_chalani_miti']    = DateEngToNep($save['english_chalani_miti']);

        $save['applicant_name']         = $result->app_name;

        $save['ward_login']             = $this->session->userdata('ward_no');

        $save['uri']                    = $this->uri->segment(1);

        $current_session                = Modules::run("Settings/getCurrentSession");

        $save['session_id']             = $current_session->id;

        $save['darta_id']               = $result->id;

        $save['user_id']                = $this->session->userdata('id');

        $chalani_no                     = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);

        $save['chalani_no']             = $chalani_no==FALSE ? 1 : $chalani_no + 1;

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

        if($this->Mdl_birth->update($id,$data))

        {

            $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");

            redirect("birth-certificate/detail/".$id);

        }

        else

        {

            $this->session->set_flashdata('err_msg',"समस्या आयो |");

            redirect("birth-certificate");

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
            redirect("home-road-certify");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_birth->getById($id);
       // pp($data['result']);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("birth-certificate");
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
        //pp($data['result_chalani']);
        $data['form_id']                = $data['result_chalani']->form_id;
        $data['chalani_no']             =  $data['result_chalani']->chalani_no;
        $data['born_dis']               = $this->Mdl_district->getById($result->birth_district);
        $data['born_gapa']              = $this->Mdl_local_body->getById($result->birth_gapana);
        $data['per_gapa']               = $this->Mdl_local_body->getById($data['result']->per_gapana);
        $data['per_state']              = $this->Mdl_state->getById($data['result']->per_state);
        $data['per_district']           = $this->Mdl_district->getById($data['result']->per_district);
        $data['user']                   = $this->Mdl_user->getById($this->session->userdata('id'));
        $data['print_details']          = $this->Mdl_print_details->getByURIandFormId($uri, $data['form_id']);
        $data['worker_id']              = $this->Mdl_ward_worker->getById($data['print_details']->worker_id);
        $data['post']                   = $this->Mdl_post->getById($data['worker_id']->post_id); 
        // if($this->session->userdata('is_muncipality') == 1 ) {
        //    $data['ward_worker'] = $this->Mdl_worker->getBypost(3);
        // } else {
        //    $data['ward_worker']    = $this->Mdl_ward_worker->getByWardPost($this->session->userdata('ward_no'), 3);
        // }
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head');
        $this->load->view('birth_certificate/print',$data);
        $this->load->view('letter_footer_np');
        $this->load->view('User/footer');

    }

}

