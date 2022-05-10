<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends MX_Controller {
    private $_curr_session = array();
    function __construct() 
    {
        parent::__construct();
        // $this->load->model('Mdl_certificate');
        // $this->load->model('Mdl_certificate_pratilipi');
        // $this->load->model('Mdl_citizenship_sifaris');
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
        $this->load->model('Settings/Mdl_post');
        $this->load->helper('functions_helper');
        $this->load->model('User/Mdl_user');
        $this->load->helper('string');
        $this->load->helper('functions_helper');
        $this->load->helper('functions_helper');
        $this->_curr_session = Modules::run('Settings/getCurrentSession');
    }

    public function new_template() {
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);
        $this->load->view('User/header');
        $this->load->view('view_1',$data);
       
        $this->load->view('User/footer');
        
    } 

    public function getChildData()
    {
       
        $html = '<tr class="child_remove">
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><button type="button" class="float-right btn btn-danger delete-form child_remove_one"'.$id.'" >
                    <i class="fa fa-times"></i>
                </button></td>
                </tr>';
        $res = [];
        $res['html']  = $html;
        echo json_encode($res);
    }
   
    public function getLifeData()
    {
       
        $html = '<tr class="life_remove">
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><input type="text" class="form-control"></td>
                    <td><button type="button" class="float-right btn btn-danger delete-form row_remove_two"'.$id.'" >
                    <i class="fa fa-times"></i>
                </button></td>
                </tr>';
        $res = [];
        $res['html']  = $html;
        echo json_encode($res);
    }

    public function Templates(){
       
        if(isset($_POST['submit']))
        {
            $date = $this->input->post('eng_first_name');
            
        }
    }

    public function FirstPage() {
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);
        $this->load->view('User/header');
        $this->load->view('view_1',$data);
       
        $this->load->view('User/footer');
    }
      public function submitFirstPage() 
      {
          
        //            print_r($_FILES);exit;
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            // $this->form_validation->set_rules('office', 'आवेदन गरिएको कार्यालय ', 'required');
            $this->form_validation->set_rules('nep_full_name', ' full Name In Nepali ', 'required');
            $this->form_validation->set_rules('eng_full_name', 'full Name In English', 'required');
            $this->form_validation->set_rules('gender', ' लिङ्ग (Gender) ', 'required');
            $this->form_validation->set_rules('nep_dob', ' जन्म मिति', 'required');
            if ($this->form_validation->run() == FALSE)
            {
            // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('Templates');

            }
            else
            {
                if(empty($_POST['father_name']) && empty($_POST['mother_name']) && empty($_POST['f_citizenship_no']) && empty($_POST['m_citizenship_no']))
                {
                    $this->session->set_flashdata('err_msg', "कृपया बुबा वा आमाको विवरण भर्नुहोस्");
                    redirect('Templates');
                }
                unset($_POST['submit']);
                $path ='Templates';
                if (!file_exists($path))
                {
                    mkdir($path, 0777, true);
//                    echo "here";exit;
                }
                $count  = count($_FILES['documents']['name']);
//                echo $count."<br>";
                $file = "";
                $doc_type = "";
                for($i = 0 ;$i < $count ;$i++)
                {
                    if (!empty($_FILES['documents']['name'][$i]))
                    {
                        $temp_path = $_FILES['documents']['tmp_name'][$i];
                        $source = $_FILES['documents']['name'][$i];
//                        echo $temp_path;exit;
                        $ext = pathinfo($source, PATHINFO_EXTENSION);
                        $file_name = md5(uniqid() . time()) . "." . $ext;
                        $destination = $path . $file_name;
                        move_uploaded_file($temp_path, $destination);
//                        file_put_contents($destination, $temp_path);
                        if($i == $count-1)
                        {
                            $file       .= $file_name;
                            $doc_type   .= $this->input->post('documents_type')[$i];
                        }
                        else
                        {
                            $file       .= $file_name."+";
                            $doc_type   .= $this->input->post('documents_type')[$i]."+";
                        }
                    }

                }
//                echo $file_name;exit;
                $_POST['status']                = 1;
                $_POST['documents']             = $file;
                $_POST['documents_type']        = $doc_type;
              	$_POST['eng_dob']				= DateNepToEng($_POST['nep_dob']);
                $_POST['date']                  = DateNepToEng($this->input->post('nepali_date'));
                $_POST['created_at']            = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']            = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_template->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 1;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_certificate->update($id,$save);
                    $this->session->set_flashdata('msg'," नागरिकता प्रमाण पत्र सिफारिस पेश गर्न सफल ");
                    redirect('Templates/submitFirstPage'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('Templates/submitFirstPage');
                }

            }
        //}
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | नागरिकता प्रमाण पत्र ";
        $this->load->view('User/header',$data1);
        $this->load->view('view_1',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_citizenship_certificate()
    {
        
       $id             =  $this->uri->segment(3);
       $result         = $data['result']     = $this->Mdl_certificate->getById($id);
       $documents      = $data['documents'] = explode("+",$result->documents);
       $documents_type = $data['documents_type'] = explode("+",$result->documents_type);
       if(empty($result))
        {

            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("tamplates/submitFirstPage");
        }

        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("Templates");
        }
        if(isset($_POST['submit']))
        {

            pp($this->input->post('nepali_date'));
            
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('office', 'आवेदन गरिएको कार्यालय ', 'required');
            $this->form_validation->set_rules('nep_full_name', ' full Name In Nepali ', 'required');
            $this->form_validation->set_rules('eng_full_name', 'full Name In English', 'required');
            $this->form_validation->set_rules('gender', ' लिङ्ग (Gender) ', 'required');
            $this->form_validation->set_rules('nep_dob', ' जन्म मिति', 'required');

                if ($this->form_validation->run() == FALSE)
                {
//                    $this->session->set_flashdata('err_msg', validation_errors());
                    $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                    redirect('view_1'.$id);

                }
                else
                {
                        unset($_POST['submit']);
                        $path = 'Templates';
                        if (!file_exists($path))
                        {
                            mkdir($path, 0777, true);
                        }
                        $count  = count($_FILES['documents']['name']);

                        $file = "";
                        $doc_type = "";
                        for($i = 0 ;$i < $count ;$i++)
                        {
                            if (!empty($_FILES['documents']['name'][$i]))
                            {
                                $temp_path = $_FILES['documents']['tmp_name'][$i];
                                $source = $_FILES['documents']['name'][$i];
                                $ext = pathinfo($source, PATHINFO_EXTENSION);
                                $file_name = md5(uniqid() . time()) . "." . $ext;
                                $destination = $path . $file_name;
                                move_uploaded_file($temp_path, $destination);

                                if($i == $count-1)
                                {
                                    $file       .= $file_name;
                                    $doc_type   .= $this->input->post('documents_type')[$i];
                                }
                                else
                                {
                                    $file       .= $file_name."+";
                                    $doc_type   .= $this->input->post('documents_type')[$i]."+";
                                }
                            }

                        }
                        $_POST['status']                = 1;
                        $_POST['documents']             = $file;
                        $_POST['documents_type']        = $doc_type;
                        //$_POST['date']                  = DateNepToEng($this->input->post('nepali_date'));

                        
                       if($this->Mdl_certificate->update($id , $this->input->post()))
                        {
        //                   $this->session->unset_userdata('temp_edit_id');
                            $this->session->set_flashdata('msg',"नागरिकता प्रमाण पत्र सिफारिस सम्पादन गर्न सफल |");
                            redirect('Templates');
                        }
                        else
                        {
                            $this->session->set_flashdata('err_msg',"समस्या आयो |");
                            redirect('Templates/edit/'.$id);
                        }


                }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | नागरिकता प्रमाण पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('Templates',$data);
        $this->load->view('User/footer');
        $this->load->view('view_1',$data);
    

      
    }
}
