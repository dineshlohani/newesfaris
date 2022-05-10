<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relationship extends MX_Controller {

    function __construct()
    {
        parent::__construct();

        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $this->load->model('Home/Mdl_print_details');
        $this->load->model('English/Mdl_relationship');
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
        $data['result']  = $this->Mdl_relationship->getAll();
        //pp($data['result']);
        $this->load->view('User/header',$data);
        $this->load->view('relationship/list');
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
        $data1['title']         = "Add New";
        $this->load->view('User/header',$data1);
        $this->load->view('relationship/create',$data);
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
            $relation               = $this->input->post('f_relation');
            $rem_ward               = $this->input->post('rem_ward');
            $current_session        = Modules::run("Settings/getCurrentSession");
            $form_id                = Modules::run("Home/genFormId");
            $save = array(
                'date'              => $date,
                'form_id'           => Modules::run("Home/genFormId"),
                'session_id'        => $current_session->id,
                'status'            => 1,
                'gender'            => $gender,
                'app_name'          => $name,
                'relation'          => $relation,
                'father_name'       => $father_name,
                'mother_name'       => $mother_name,
                'per_state'         => $per_state,
                'per_district'      => $per_dis,
                'per_gapana'        => $per_gapana,
                'per_ward'          => $per_ward,
                'rem_ward'          => $rem_ward,
                'added_on'          => date('Y-mm-dd H:i:s'),
                'added_by'          => $this->session->userdata('id'),
                'added_ward'        => $this->session->userdata('ward_no')
            );
            //pp($save);
            if($id = $this->Mdl_relationship->save($save)) {
                $rel_gender          = $this->input->post('rel_gender');
                $rel_name            = $this->input->post('rel_name');
                $relation            = $this->input->post('relation');
                $topic_details          = array();
                if(!empty($rel_name)) {
                    foreach ($rel_name as $key => $indexv) {
                        $topic_details[]    = array(
                            'main_id'       => $id,
                            'gender'        => $rel_gender[$key],
                            'name'         => $rel_name[$key],
                            'relation'     => $relation[$key],
                        );
                    }
                }
                //pp($rel_name);
               $this->Mdl_relationship->saverels($topic_details);
                $this->session->set_flashdata('msg'," Success");
                redirect('relationship/detail/'.$id);
                // $result = $this->Mdl_relationship->saverels($topic_details);
                // if($result) {
                //    ;
                // } else {
                //     echo 'i am in';
                // }
            } else {
                $this->session->set_flashdata('err_msg'," समस्या आयो |");
                redirect('relationship/create');
            }
        }
    }

    public function relationship_details() {
        $id = $this->uri->segment(3);
        if(empty($id)){
            redirect('relationship');
        }
        Modules::run("User/checkWardLogin");
        $data['title']              = "Relationship | Details";
        $data['page']               = 'relationship/details';
        $data['detail']             = $this->Mdl_relationship->getById($id);
        $data['members']            = $this->Mdl_relationship->getRelationShipDetails($id);
        $data['chalani_details']    = $this->Mdl_chalani->getByFormId($data['detail']->form_id);
        //pp($data['chalani_details']);
        $data['dis']                = $this->Mdl_district->getById($data['detail']->per_district);
        $data['gapa']               = $this->Mdl_local_body->getById($data['detail']->per_gapana);
        $data['state']              = $this->Mdl_state->getById($data['detail']->per_state);
        $data['current_session']    = Modules::run("Settings/getCurrentSession");
        if($this->session->userdata('is_muncipality') == 1 ) {
           $data['ward_worker'] = $this->Mdl_worker->getBypost(5);
        } else {
           $data['ward_worker']    = $this->Mdl_ward_worker->getByWardPost($this->session->userdata('ward_no'), 5);
        }
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($data['detail']->form_id);
        if($data['detail']->status == 3)
        {
            $data['chalani_no'] = $data['chalani_result']->chalani_no;
        }
       // pp($data['ward_worker']);
        $this->load->view('main', $data);
    }

    public function edit_details() {
        $id = $this->uri->segment(3);
        if(empty($id)){
            redirect('relationship');
        }
        Modules::run("User/checkWardLogin");
        $data['title']          = "Relationship Verification | Edit";
        $data['page']           = 'relationship/edit_new';
        $data['detail']         = $this->Mdl_relationship->getById($id);
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAllByState($data['detail']->per_state);
        $data['locals']         = $this->Mdl_local_body->getAllByDistrict($data['detail']->per_district);
        $data['wards']          = $this->Mdl_local_body->getById($data['detail']->per_gapana);
        $data['relation']       = $this->Mdl_relation->getAll();
        $data['members']      = $this->Mdl_relationship->getRelationShipDetails($id);
        $this->load->view('main', $data);
    }

    public function update() {
        if(isset($_POST['submit'])) {
            $uid                    = $this->input->post('id');
            $date                   = $this->input->post('date');
            $gender                 = $this->input->post('gender');
            $name                   = $this->input->post('applicant_name');
            $father_name            = $this->input->post('father_name');
            $mother_name            = $this->input->post('mother_name');
            $per_state              = $this->input->post('per_state');
            $per_dis                = $this->input->post('per_dis');
            $per_gapana             = $this->input->post('per_gapanapa');
            $per_ward               = $this->input->post('per_ward');
            $relation               = $this->input->post('f_relation');
            $rem_ward               = $this->input->post('rem_ward');
            $save = array(
                'date'              => $date,
                // 'status'            => 1,
                'gender'            => $gender,
                'app_name'          => $name,
                'relation'          => $relation,
                'father_name'       => $father_name,
                'mother_name'       => $mother_name,
                'per_state'         => $per_state,
                'per_district'      => $per_dis,
                'per_gapana'        => $per_gapana,
                'per_ward'          => $per_ward,
                'rem_ward'          => $rem_ward,
                'added_on'          => date('Y-mm-dd H:i:s'),
                'added_by'          => $this->session->userdata('id'),
                'added_ward'        => $this->session->userdata('ward_no')
            );
            if($id = $this->Mdl_relationship->update($uid,$save)) {
                $rel_id              = $this->input->post('rel_id');
                $rel_gender          = $this->input->post('rel_gender');
                $rel_name            = $this->input->post('rel_name');
                $relation            = $this->input->post('relation');
                $rel_updates          = array();
                if(!empty($rel_name)) {
                    foreach ($rel_name as $key => $indexv) {
                        $rel_updates[]    = array(
                            'id'            => $rel_id[$key],
                            'gender'        => $rel_gender[$key],
                            'name'          => $rel_name[$key],
                            'relation'      => $relation[$key],
                        );
                    }
                    $this->Mdl_relationship->updateMembers($rel_id,$rel_updates);
                }
                $rel_gender_new          = $this->input->post('rel_gender_new');
                $rel_name_new            = $this->input->post('rel_name_new');
                $relation_new            = $this->input->post('relation_new');
                $rel_new          = array();
                if(!empty($rel_name_new)) {
                    foreach ($rel_name_new as $key => $indexv) {
                        $rel_new[]    = array(
                            'main_id'       => $uid,
                            'gender'        => $rel_gender_new[$key],
                            'name'         => $rel_name_new[$key],
                            'relation'     => $relation_new[$key],
                        );
                    }
                    $this->Mdl_relationship->saverels($rel_new);
                }
                $this->session->set_flashdata('msg'," Success");
                redirect('relationship/detail/'.$uid);
            } else {
                $this->session->set_flashdata('err_msg'," समस्या आयो |");
                redirect('relationship/create');
            }
        }
    }

    public function darta_details() {

        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("relationship");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_relationship->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("relationship");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("relationship");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("relationship");
        }
        $is_muncipality = $this->session->userdata('is_muncipality');
        $ward_login                 = $this->session->userdata('ward_no');
        $data['status']             = 2;
        $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward_login);
        $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
        $data['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
        if($this->Mdl_relationship->update($id,$data))
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
            $save['form_id']            = $result->form_id;
            $this->Mdl_darta->save($save);
            $this->session->set_flashdata('msg'," Success");
            redirect('relationship/detail/'.$id);
        }
    }

    public function chalani_details()
    {
       
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_relationship->getById($id);
        //pp($result);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("relationship");
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
        $save['user_id']                = $this->session->userdata('id');
        $save['darta_id']               = $result->id;
        $save['type']                   = 8;
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
        $this->Mdl_chalani->save($save);
        $data['status'] = 3;
        if($this->Mdl_relationship->update($id,$data))
        {
            $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
            redirect("relationship/detail/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("relationship");
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
            redirect("relationship");
        }
        $id         = $this->uri->segment(3);
        $data['detail'] = $result     = $this->Mdl_relationship->getById($id);

        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("relationship");
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
        $data['result_chalani']     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['form_id']            = $result->form_id;
        $data['chalani_no']         = $data['result_chalani']->chalani_no;
        $data['reldetail']          = $this->Mdl_relationship->getRelationShipDetails($id);
        $data['chalani_details']    = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['dis']                = $this->Mdl_district->getById($result->per_district);
        $data['gapa']               = $this->Mdl_local_body->getById($result->per_gapana);
        $data['state']              = $this->Mdl_state->getById($result->per_state);
        $data['user']               = $this->Mdl_user->getById($this->session->userdata('id'));

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
        $this->load->view('relationship/print',$data);
        $this->load->view('letter_footer_np');
        $this->load->view('User/footer');
    }

    //remove members
    public function RemoveMembers($id, $main_id) {
        if(!empty($id)) {
            //echo $id;
            // $id = $this->uri->segment($id);

            $result = $this->Mdl_relationship->removeMember($id);
            if($result) {
                 $this->session->set_flashdata('msg'," Success");
                redirect('relationship/edit/'.$main_id);
            } else {
                $this->session->set_flashdata('msg'," Success");
                redirect('relationship/edit/'.$main_id);
            }
        }
    }
}
?>