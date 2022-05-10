<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settlement extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_sthai_basobas');
        $this->load->model('Mdl_asthai_basobas');
        $this->load->model('Mdl_antarik_basai_sarai');
        $this->load->model('Mdl_antarik_basai_sarai_detail');

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
        $this->load->helper('functions_helper');
        $this->load->model('User/Mdl_user');

        $this->load->helper('string');
        $this->load->helper('functions_helper');
    }

    /*------------------------------------------------------------------------------------------------------------------*/

    public function index()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $data['title'] = "Settlement | Dashboard";
        
        $data['sthai_basobas']              = $this->Mdl_user->getTotalCount('sthai_basobas');
        $data['asthai_basobas']             = $this->Mdl_user->getTotalCount('asthai_basobas');
        $data['antarik_basai_sarai']        = $this->Mdl_user->getTotalCount('antarik_basai_sarai');

        $this->load->view('User/header',$data);
        $this->load->view('dashboard');
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Sthai Basobas   ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_sthai_basobas()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            //$this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('resident_name', 'बसोबास गर्ने व्यक्तिको नाम', 'required');
            $this->form_validation->set_rules('citizenship_no', 'ना.प्र.प.नं.', 'required');
            $this->form_validation->set_rules('citizenship_district', 'ना.प्र.प. जारी जिल्लाि', 'required');
            $this->form_validation->set_rules('nepali_citizenship_date', 'ना.प्र.प. जारी मिति', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('nepali_permission_date', 'बसोबास सुरु गरेको मिति', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('tole', 'टोलको नाम', 'required');
            $this->form_validation->set_rules('road', 'बाटोको नाम', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('sthai-basobas/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/settlement/sthai_basobas/';
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
                $_POST['date']                  = DateNepToEng($this->input->post('nepali_date'));
                $_POST['english_citizenship_date']    = DateNepToEng($this->input->post('nepali_citizenship_date'));
                $_POST['english_permission_date'] = DateNepToEng($this->input->post('nepali_permission_date'));
                $_POST['created_at']            = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']            = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_sthai_basobas->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 5;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_sthai_basobas->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('sthai-basobas/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('sthai-basobas/create');
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']      = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | स्थायी बसोबास";
        $this->load->view('User/header',$data1);
        $this->load->view('sthai_basobas',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_sthai_basobas()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sthai-basobas");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_sthai_basobas->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sthai-basobas");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] =  $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | स्थायी बसोबास" ;
        $this->load->view('User/header',$data1);
        $this->load->view('sthai_basobas_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_sthai_basobas()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sthai-basobas");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_sthai_basobas->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("sthai-basobas");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("sthai-basobas");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('resident_name', 'बसोबास गर्ने व्यक्तिको नाम', 'required');
            $this->form_validation->set_rules('citizenship_no', 'ना.प्र.प.नं.', 'required');
            $this->form_validation->set_rules('citizenship_district', 'ना.प्र.प. जारी जिल्लाि', 'required');
            $this->form_validation->set_rules('nepali_citizenship_date', 'ना.प्र.प. जारी मिति', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('nepali_permission_date', 'बसोबास सुरु गरेको मिति', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('tole', 'टोलको नाम', 'required');
            $this->form_validation->set_rules('road', 'बाटोको नाम', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('sthai-basobas/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/settlement/sthai_basobas/';
                if (!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                $count  = count($_FILES['documents']['name']);
                $file = "";
                $doc_type = "";
                if(!empty($_FILES['documents']['name'][0]))
                {
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
                    $_POST['documents']             = $file;
                    $_POST['documents_type']        = $doc_type;
                }
                else
                {
                    $_POST['documents_type']        = $result->documents_type;
                }
                $_POST['date']                  = DateNepToEng($this->input->post('nepali_date'));
                $_POST['english_citizenship_date']    = DateNepToEng($this->input->post('nepali_citizenship_date'));
                $_POST['english_permission_date'] = DateNepToEng($this->input->post('nepali_permission_date'));
                if($this->Mdl_sthai_basobas->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"संस्था दर्ता प्रमाणपत्र सिफारिस सम्पादन गर्न सफल |");
                    redirect('sthai-basobas/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('sthai-basobas/edit/'.$id);
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']      = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | स्थाई बसोबास";
        $this->load->view('User/header',$data1);
        $this->load->view('sthai_basobas',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_sthai_basobas()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("sthai-basobas");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_sthai_basobas->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sthai-basobas");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("sthai-basobas/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("sthai-basobas/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."sthai-basobas/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/settlement/sthai_basobas";
            for($i = 0;$i<$count;$i++)
            {
                $ext = pathinfo($files['documents']['name'][$i], PATHINFO_EXTENSION);
                $_FILES['documents']['name']     = $files['documents']['name'][$i].".".$ext;
                $_FILES['documents']['type']     = $files['documents']['type'][$i];
                $_FILES['documents']['tmp_name'] = $files['documents']['tmp_name'][$i];
                $_FILES['documents']['error']    = $files['documents']['error'][$i];
                $_FILES['documents']['size']     = $files['documents']['size'][$i];
                $config = Modules::run("FileUpload/set_upload_options",$path);
                $this->upload->initialize($config);
                $this->upload->do_upload('documents');
                $dataInfo = $this->upload->data();
                if($i == $count-1 )
                {
                    $filename .= $dataInfo['file_name'];
                }
                else
                {
                    $filename  .= $dataInfo['file_name']."+";
                }

            }

            $data['status']             = 2;
            $data['darta_documents']    = $filename;
            if($this->Mdl_sthai_basobas->update($id,$data))
            {
                $save['type']               = 5;
                $save['applicant_name']     = $result->applicant_name;
                $save['ward_login']         = $this->session->userdata('ward_no');
                $save['uri']                = $this->uri->segment(1);
                $save['sifaris_id']         = $id;
                $current_session                = Modules::run("Settings/getCurrentSession");
                $save['session_id']            = $current_session->id;
                $save['user_id']            = $this->session->userdata('id');
                $save['darta_documents']    = $filename;
            //---------------------  darta id {  Mdl_darta ko autoincrement 'id' } -------------------------
                if(isset($_POST['darta_id']))
                {
                    $darta_id                   = $this->input->post('darta_id');
                    $darta_detail               = $this->Mdl_darta->getById($darta_id);
                    $save['darta_no']           = $darta_detail->darta_no;
                    $save['nepali_darta_miti']  = $darta_detail->nepali_darta_miti;
                    $save['english_darta_miti'] = $darta_detail->english_darta_miti;
                    $this->Mdl_darta->update($darta_id,$save);
                }
                else
                {
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

                    $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward);
                    $save['form_id']            = $result->form_id;
                    $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
                    $save['english_darta_miti'] = date("Y-m-d",time());
                    $save['nepali_darta_miti']  = DateEngToNep($save['english_darta_miti']);
                    $this->Mdl_darta->save($save);
                }
                $this->session->set_flashdata('msg',"दर्ता हुन सफल |");
                redirect(base_url()."sthai-basobas/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."sthai-basobas/detail/".$id);
            }

        }
        $result = [];
        $ward_login             = $this->session->userdata('ward_no');
        $result['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/darta',$result);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function chalani_sthai_basobas()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_sthai_basobas->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sthai-basobas");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("sthai-basobas/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("sthai-basobas/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $chalani_result         = $this->Mdl_chalani->getByFormId($result->form_id);
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
            $chalani_no                       = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']     = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti'] = date("Y-m-d",time());
            $save['nepali_chalani_miti']  = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']       = $result->applicant_name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']            = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $save['czn_no'] = $result->citizenship_no;
            if(!empty($_POST['department']))
            {
                $save['department']     = $this->input->post('department');
            }
            if(!empty($_POST['department_other']))
            {
                $save['department_other'] = $this->input->post('department_other');
            }
            $this->Mdl_chalani->update($chalani_result->id,$save);
            $data['status']         = 3;
            if($this->Mdl_sthai_basobas->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("sthai-basobas/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("sthai-basobas");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_sthai_basobas()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("sthai-basobas");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_sthai_basobas->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sthai-basobas");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("sthai-basobas/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
            $save['office_id'] = $_POST['office_id'];

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
        $data['print_office']         = $this->Mdl_office->getById($_POST['office_id']);
        $data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $data['chalani_result'] =  $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('sthai_basobas_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_sthai_basobas()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $ward_login = $this->session->userdata('ward_no');
        if($this->session->userdata('is_muncipality')==0)
        {
            if(isset($_GET['submit']))
            {
                if(isset($_GET['search']))
                {
                    $search         = $this->input->get('search');
                    $result         = $this->Mdl_sthai_basobas->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_sthai_basobas->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_sthai_basobas->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."sthai-basobas");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_sthai_basobas->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_sthai_basobas->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_sthai_basobas->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_sthai_basobas->getTableName();
            if(isset($_GET['submit']))
            {
                if(isset($_GET['search']))
                {
                    $search         = $this->input->get('search');
                    $result         = $this->Mdl_chalani->searchByWord($search, $table_name, $department, $url);
                    $data['result'] = $result;
                }
                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."sthai-basobas");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_chalani->getByDates($start_date, $end_date, $table_name, $department, $url);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_chalani->getByDates($start_date, $end_date, $table_name, $department, $url);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_chalani->getAllByDepartmentAndUri($department, $table_name, $url);
            }
        }
        $data1['title']     = "स्थायी बसोबास";
        $this->load->view('User/header',$data1);
        $this->load->view('sthai_basobas_view',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Asthai Basobas   ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_asthai_basobas()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('owner_name', 'बसोबास गर्ने व्यक्तिको नाम', 'required');
            $this->form_validation->set_rules('citizenship_no', 'ना.प्र.प.नं.', 'required');
            $this->form_validation->set_rules('citizenship_district', 'ना.प्र.प. जारी जिल्लाि', 'required');
            $this->form_validation->set_rules('nepali_citizenship_date', 'ना.प्र.प. जारी मिति', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('nepali_permission_date', 'बसोबास सुरु गरेको मिति', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('tole', 'टोलको नाम', 'required');
            $this->form_validation->set_rules('road', 'बाटोको नाम', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('asthai-basobas/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/settlement/asthai_basobas/';
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
                $_POST['date']                  = DateNepToEng($this->input->post('nepali_date'));
                $_POST['english_citizenship_date']    = DateNepToEng($this->input->post('nepali_citizenship_date'));
                $_POST['english_permission_date'] = DateNepToEng($this->input->post('nepali_permission_date'));
                $_POST['created_at']            = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']            = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_asthai_basobas->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 5;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_asthai_basobas->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('asthai-basobas/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('asthai-basobas/create');
                }
            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']      = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | अस्थायी बसोबास";
        $this->load->view('User/header',$data1);
        $this->load->view('asthai_basobas',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_asthai_basobas()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_asthai_basobas->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("asthai-basobas");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] =  $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | अस्थायी बसोबास" ;
        $this->load->view('User/header',$data1);
        $this->load->view('asthai_basobas_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_asthai_basobas()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("asthai-basobas");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_asthai_basobas->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("asthai-basobas");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("asthai-basobas");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('owner_name', 'बसोबास गर्ने व्यक्तिको नाम', 'required');
            $this->form_validation->set_rules('citizenship_no', 'ना.प्र.प.नं.', 'required');
            $this->form_validation->set_rules('citizenship_district', 'ना.प्र.प. जारी जिल्लाि', 'required');
            $this->form_validation->set_rules('nepali_citizenship_date', 'ना.प्र.प. जारी मिति', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('nepali_permission_date', 'बसोबास सुरु गरेको मिति', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('tole', 'टोलको नाम', 'required');
            $this->form_validation->set_rules('road', 'बाटोको नाम', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('asthai-basobas/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/settlement/asthai_basobas/';
                if (!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                $count  = count($_FILES['documents']['name']);
                $file = "";
                $doc_type = "";
                if(!empty($_FILES['documents']['name'][0]))
                {
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
                    $_POST['documents']             = $file;
                    $_POST['documents_type']        = $doc_type;
                }
                else
                {
                    $_POST['documents_type']        = $result->documents_type;
                }
                $_POST['date']                  = DateNepToEng($this->input->post('nepali_date'));
                $_POST['english_citizenship_date']    = DateNepToEng($this->input->post('nepali_citizenship_date'));
                $_POST['english_permission_date'] = DateNepToEng($this->input->post('nepali_permission_date'));
                if($this->Mdl_asthai_basobas->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"संस्था दर्ता प्रमाणपत्र सिफारिस सम्पादन गर्न सफल |");
                    redirect('asthai-basobas/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('asthai-basobas/edit/'.$id);
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']      = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | अस्थाई बसोबास";
        $this->load->view('User/header',$data1);
        $this->load->view('asthai_basobas',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_asthai_basobas()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("asthai-basobas");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_asthai_basobas->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("asthai-basobas");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("asthai-basobas/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("asthai-basobas/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."asthai-basobas/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/settlement/asthai_basobas";
            for($i = 0;$i<$count;$i++)
            {
                $ext = pathinfo($files['documents']['name'][$i], PATHINFO_EXTENSION);
                $_FILES['documents']['name']     = $files['documents']['name'][$i].".".$ext;
                $_FILES['documents']['type']     = $files['documents']['type'][$i];
                $_FILES['documents']['tmp_name'] = $files['documents']['tmp_name'][$i];
                $_FILES['documents']['error']    = $files['documents']['error'][$i];
                $_FILES['documents']['size']     = $files['documents']['size'][$i];
                $config = Modules::run("FileUpload/set_upload_options",$path);
                $this->upload->initialize($config);
                $this->upload->do_upload('documents');
                $dataInfo = $this->upload->data();
                if($i == $count-1 )
                {
                    $filename .= $dataInfo['file_name'];
                }
                else
                {
                    $filename  .= $dataInfo['file_name']."+";
                }

            }

            $data['status']             = 2;
            $data['darta_documents']    = $filename;
            if($this->Mdl_asthai_basobas->update($id,$data))
            {
                $save['type']               = 5;
                $save['applicant_name']     = $result->applicant_name;
                $save['ward_login']         = $this->session->userdata('ward_no');
                $save['uri']                = $this->uri->segment(1);
                $save['sifaris_id']         = $id;
                $current_session                = Modules::run("Settings/getCurrentSession");
                $save['session_id']            = $current_session->id;
                $save['user_id']            = $this->session->userdata('id');
                $save['darta_documents']    = $filename;
        //---------------------  darta id {  Mdl_darta ko autoincrement 'id' } -------------------------
                if(isset($_POST['darta_id']))
                {
                    $darta_id                   = $this->input->post('darta_id');
                    $darta_detail               = $this->Mdl_darta->getById($darta_id);
                    $save['darta_no']           = $darta_detail->darta_no;
                    $save['nepali_darta_miti']  = $darta_detail->nepali_darta_miti;
                    $save['english_darta_miti'] = $darta_detail->english_darta_miti;
                    $this->Mdl_darta->update($darta_id,$save);
                }
                else
                {
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

                    $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward);
                    $save['form_id']            = $result->form_id;
                    $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
                    $save['english_darta_miti'] = date("Y-m-d",time());
                    $save['nepali_darta_miti']  = DateEngToNep($save['english_darta_miti']);
                    $this->Mdl_darta->save($save);
                }
                $this->session->set_flashdata('msg',"दर्ता हुन सफल |");
                redirect(base_url()."asthai-basobas/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."asthai-basobas/detail/".$id);
            }

        }
        $result = [];
        $ward_login             = $this->session->userdata('ward_no');
        $result['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/darta',$result);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function chalani_asthai_basobas()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_asthai_basobas->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("asthai-basobas");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("asthai-basobas/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("asthai-basobas/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $chalani_result         = $this->Mdl_chalani->getByFormId($result->form_id);
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
            $chalani_no                       = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']     = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti'] = date("Y-m-d",time());
            $save['nepali_chalani_miti']  = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']       = $result->applicant_name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']            = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $save['type'] = 5;
            $save['czn_no'] = $result->citizenship_no;
            if(!empty($_POST['department']))
            {
                $save['department']     = $this->input->post('department');
            }
            if(!empty($_POST['department_other']))
            {
                $save['department_other'] = $this->input->post('department_other');
            }
            $this->Mdl_chalani->update($chalani_result->id,$save);
            $data['status']         = 3;
            if($this->Mdl_asthai_basobas->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("asthai-basobas/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("asthai-basobas");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_asthai_basobas()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("asthai-basobas");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_asthai_basobas->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("asthai-basobas");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("asthai-basobas/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
            $save['office_id'] = $_POST['office_id'];
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
        $data['print_office']         = $this->Mdl_office->getById($_POST['office_id']);
        $data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $data['chalani_result'] =  $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('asthai_basobas_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_asthai_basobas()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $ward_login = $this->session->userdata('ward_no');
        if($this->session->userdata('is_muncipality')==0)
        {
            if(isset($_GET['submit']))
            {
                if(isset($_GET['search']))
                {
                    $search         = $this->input->get('search');
                    $result         = $this->Mdl_asthai_basobas->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_asthai_basobas->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_asthai_basobas->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."asthai-basobas");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_asthai_basobas->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_asthai_basobas->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_asthai_basobas->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_asthai_basobas->getTableName();
            if(isset($_GET['submit']))
            {
                if(isset($_GET['search']))
                {
                    $search         = $this->input->get('search');
                    $result         = $this->Mdl_chalani->searchByWord($search, $table_name, $department, $url);
                    $data['result'] = $result;
                }
                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."sthai-basobas");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_chalani->getByDates($start_date, $end_date, $table_name, $department, $url);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_chalani->getByDates($start_date, $end_date, $table_name, $department, $url);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_chalani->getAllByDepartmentAndUri($department, $table_name, $url);
            }
        }
        $data1['title']     = "संस्था दर्ता प्रमाणपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('asthai_basobas_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Antarik Basai Sarai   ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_antarik_basai_sarai()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $total = $this->input->post('total_forms');

            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('father_name', 'बुवाको नाम', 'required');
            $this->form_validation->set_rules('mother_name', 'आमाको नाम', 'required');
            $this->form_validation->set_rules('from_nepali_date', 'पुरानो स्थानमा बसोबास गर्न थालेको मिति ', 'required');
            $this->form_validation->set_rules('old_district', 'पुरानो जिल्ला', 'required');
            $this->form_validation->set_rules('old_ward', 'पुरानो वडा नं.', 'required');
            $this->form_validation->set_rules('old_local_body', 'पुरानो गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_state', 'पुरानो प्रदेश', 'required');
            $this->form_validation->set_rules('old_tole', 'पुरानो टोलको नाम', 'required');
            $this->form_validation->set_rules('present_tole', 'हालको टोलको नाम', 'required');
            $this->form_validation->set_rules('present_district', 'हालको जिल्ला', 'required');
            $this->form_validation->set_rules('present_ward', 'हालको वडा नं.', 'required');
            $this->form_validation->set_rules('present_local_body', 'हालकोहालको गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('present_state', 'हालको प्रदेश', 'required');

            for($i=0 ; $i < $total; $i++)
            {
                $this->form_validation->set_rules('name_'.$i, 'नाम', 'required');
                $this->form_validation->set_rules('age_'.$i, 'उमेर', 'required');
                $this->form_validation->set_rules('relation_'.$i, 'नाता', 'required');
            }

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('antarik-basai-sarai/create');

            }
            else
            {

                $flag = [];
                $this->db->trans_start();
                $save['nepali_date']        = $this->input->post('nepali_date');
                $save['date']               = DateNepToEng($save['nepali_date']);
                $save['from_nepali_date']   = $this->input->post('from_nepali_date');
                $save['from_english_date']  = DateNepToEng($save['from_nepali_date']);
                $save['applicant_name']     = $this->input->post('applicant_name');
                $save['father_name']        = $this->input->post('father_name');
                $save['mother_name']        = $this->input->post('mother_name');
                $save['old_state']          = $this->input->post('old_state');
                $save['old_district']       = $this->input->post('old_district');
                $save['old_local_body']     = $this->input->post('old_local_body');
                $save['old_ward']           = $this->input->post('old_ward');
                $save['old_tole']           = $this->input->post('old_tole');
                $save['present_tole']           = $this->input->post('present_tole');
                $save['present_state']          = $this->input->post('present_state');
                $save['present_district']       = $this->input->post('present_district');
                $save['present_local_body']     = $this->input->post('present_local_body');
                $save['present_ward']           = $this->input->post('present_ward');
                $save['gender_spec']            = $this->input->post('gender_spec');
                $save['con_no']                 = $this->input->post('con_no');
                $save['cit_no']                 = $this->input->post('cit_no');
                $save['status']         = 1;
                $save['created_at']     = date("Y-m-d h:i:sa");
                $save['ward_login']     = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $save['session_id']            = $current_session->id;

                $path               = 'assets/documents/settlement/antarik_basaisarai/';
                if (!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                $count              = count($_FILES['documents']['name']);
                $files              = "";
                $files_type         = "";
                for($i = 0 ; $i < $count; $i++)
                {
                    if(!empty($_FILES['documents']['name'][$i]))
                    {
                        $temp_path      = $_FILES['documents']['tmp_name'][$i];
                        $source = $_FILES['documents']['name'][$i];
                        $ext = pathinfo($source, PATHINFO_EXTENSION);
                        $file_name      = md5(uniqid().time()).".".$ext;
                        $destination    = $path.$file_name;
                        move_uploaded_file($temp_path,$destination);
                        if($i == $count-1)
                        {
                            $files      .= $file_name;
                            $files_type .= $this->input->post('documents_type')[$i];
                        }
                        else
                        {
                            $files  .= $file_name."+";
                            $files_type .= $this->input->post('documents_type')[$i]."+";
                        }
                    }
                }
                $save['documents']           = $files;
                $save['documents_type']     = $files_type;
                if($id = $this->Mdl_antarik_basai_sarai->save($save))
                {


                    for ($i = 0; $i < $total; $i++)
                    {
                        $save1['name']              = $this->input->post('name_'.$i);
                        $save1['relation']          = $this->input->post('relation_'.$i);
                        $save1['citizenship_no']    = $this->input->post('citizenship_no_'.$i);
                        $save1['ghar_no']           = $this->input->post('ghar_no_'.$i);
                        $save1['road_name']         = $this->input->post('road_name_'.$i);
                        $save1['age']               = $this->input->post('age_'.$i) ;
                        $save1['darta_id']          = $id;
                        $save1['created_at']        = date("Y-m-d h:i:sa");
                        if($this->Mdl_antarik_basai_sarai_detail->save($save1))
                        {
                            array_push($flag , 1);
                        }
                        else
                        {
                            array_push($flag,0);
                        }

                    }

                    if(in_array(0,$flag))
                    {

                        $this->session->set_flashdata('err_msg', "समस्या आयो");
                        redirect("antarik-basai-sarai/create");
                    }
                    else
                    {
                          $chalani['darta_id']   = $id;
                          $chalani['type']       = 5;
                          $form['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                          $this->Mdl_chalani->save($chalani);
                          $this->Mdl_antarik_basai_sarai->update($id,$form);
                          $this->db->trans_complete();
                          $this->session->set_flashdata('msg', "सिफारिस पेश गर्न सफल");
                          redirect("antarik-basai-sarai/detail/".$id);
                    }
                }
                else
                {
                    $this->session->set_flashdata('err_msg', "समस्या आयो");
                    redirect("antarik-basai-sarai/create");
                }
            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['relations']      = $this->Mdl_relation->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | अन्तरिक बसाई सराई";
        $this->load->view('User/header',$data1);
        $this->load->view('antarik_basai_sarai',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_antarik_basai_sarai()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("antarik-basai-sarai");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_antarik_basai_sarai->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("antarik-basai-sarai");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['details']    = $this->Mdl_antarik_basai_sarai_detail->getByDartaId($id);
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | अन्तरिक बसाई सराई" ;
        $this->load->view('User/header',$data1);
        $this->load->view('antarik_basai_sarai_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_antarik_basai_sarai()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("antarik-basai-sarai");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_antarik_basai_sarai->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"डेटा भेटिएन | ");
            redirect("antarik-basai-sarai");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("antarik-basai-sarai");
        }
        if(isset($_POST['submit'])) {
            $total = $this->input->post('total_forms');

            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('father_name', 'बुवाको नाम', 'required');
            $this->form_validation->set_rules('mother_name', 'आमाको नाम', 'required');
            $this->form_validation->set_rules('from_nepali_date', 'पुरानो स्थानमा बसोबास गर्न थालेको मिति ', 'required');
            $this->form_validation->set_rules('old_district', 'पुरानो जिल्ला', 'required');
            $this->form_validation->set_rules('old_ward', 'पुरानो वडा नं.', 'required');
            $this->form_validation->set_rules('old_local_body', 'पुरानो गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_state', 'पुरानो प्रदेश', 'required');
            $this->form_validation->set_rules('old_tole', 'पुरानो टोलको नाम', 'required');
            $this->form_validation->set_rules('present_tole', 'हालको टोलको नाम', 'required');
            $this->form_validation->set_rules('present_district', 'हालको जिल्ला', 'required');
            $this->form_validation->set_rules('present_ward', 'हालको वडा नं.', 'required');
            $this->form_validation->set_rules('present_local_body', 'हालकोहालको गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('present_state', 'हालको प्रदेश', 'required');

            for($i=0 ; $i < $total; $i++)
            {
                $this->form_validation->set_rules('name_'.$i, 'नाम', 'required');
                $this->form_validation->set_rules('age_'.$i, 'उमेर', 'required');
                $this->form_validation->set_rules('relation_'.$i, 'नाता', 'required');
            }

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect("property-valuation/edit/".$id);
            }
            else
            {
                $flag = [];
                $this->db->trans_start();
                $save['nepali_date']        = $this->input->post('nepali_date');
                $save['date']               = DateNepToEng($save['nepali_date']);
                $save['from_nepali_date']   = $this->input->post('from_nepali_date');
                $save['from_english_date']  = DateNepToEng($save['from_nepali_date']);
                $save['applicant_name']     = $this->input->post('applicant_name');
                $save['father_name']        = $this->input->post('father_name');
                $save['mother_name']        = $this->input->post('mother_name');
                $save['old_state']          = $this->input->post('old_state');
                $save['old_district']       = $this->input->post('old_district');
                $save['old_local_body']     = $this->input->post('old_local_body');
                $save['old_ward']           = $this->input->post('old_ward');
                $save['old_tole']           = $this->input->post('old_tole');
                $save['present_tole']           = $this->input->post('present_tole');
                $save['present_state']          = $this->input->post('present_state');
                $save['present_district']       = $this->input->post('present_district');
                $save['present_local_body']     = $this->input->post('present_local_body');
                $save['present_ward']           = $this->input->post('present_ward');

                $path               = 'assets/documents/settlement/antarik_basaisarai/';
                if (!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                $count              = count($_FILES['documents']['name']);
                $files              = "";
                $files_type         = "";
                if($_FILES['documents']['name'][0] != "")
                {
                    for($i = 0 ; $i < $count; $i++)
                    {
                        if(!empty($_FILES['documents']['name'][$i]))
                        {
                            $temp_path      = $_FILES['documents']['tmp_name'][$i];
                            $source = $_FILES['documents']['name'][$i];
                            $ext = pathinfo($source, PATHINFO_EXTENSION);
                            $file_name      = md5(uniqid().time()).".".$ext;
                            $destination    = $path.$file_name;
                            move_uploaded_file($temp_path,$destination);
                            if($i == $count-1)
                            {
                                $files      .= $file_name;
                                $files_type .= $this->input->post('documents_type')[$i];
                            }
                            else
                            {
                                $files  .= $file_name."+";
                                $files_type .= $this->input->post('documents_type')[$i]."+";
                            }
                        }
                    }
                    $save['documents']           = $files;
                    $save['documents_type']     = $files_type;
                }
                if($this->Mdl_antarik_basai_sarai->update($id,$save))
                {
                    //---------Deleting old record and saving new one----
                    $this->Mdl_antarik_basai_sarai_detail->deleteByDartaId($id);

                    for ($i = 0; $i < $total; $i++)
                    {
                        $save1['name']              = $this->input->post('name_'.$i);
                        $save1['relation']          = $this->input->post('relation_'.$i);
                        $save1['citizenship_no']    = $this->input->post('citizenship_no_'.$i);
                        $save1['ghar_no']           = $this->input->post('ghar_no_'.$i);
                        $save1['road_name']         = $this->input->post('road_name_'.$i);
                        $save1['age']               = $this->input->post('age_'.$i) ;
                        $save1['darta_id']          = $id;
                        $save1['created_at']        = date("Y-m-d h:i:sa");

                        if($this->Mdl_antarik_basai_sarai_detail->save($save1))
                        {
                            array_push($flag , 1);
                        }
                        else
                        {
                            array_push($flag,0);
                        }

                    }
                    if(in_array(0,$flag))
                    {

                        $this->session->set_flashdata('err_msg', "समस्या आयो");
                        redirect("antarik-basai-sarai/edit/".$id);
                    }
                    else
                    {
                        $this->db->trans_complete();
                        $this->session->set_flashdata('msg', "सिफारिस सम्पादन गर्न सफल");
                    }
                    redirect("antarik-basai-sarai/detail/".$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg', "समस्या आयो");
                    redirect("antarik-basai-sarai/edit/".$id);
                }

            }
        }
        if(!empty($result->documents))
        {
            $documents              = explode("+",$result->documents);
        }
        $data['default']            = getDefault();
        $data['details']            = $this->Mdl_antarik_basai_sarai_detail->getByDartaId($id);
        $data['states']             = $this->Mdl_state->getAll();
        $data['districts']          = $this->Mdl_district->getAll();
        $data['locals']             = $this->Mdl_local_body->getAll();
        $data['wards']              = $this->Mdl_ward->getAll();
        $data['relations']          = $this->Mdl_relation->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title']             = "नयाँ | सम्पति मूल्यांकन";
        $this->load->view('User/header',$data1);
        $this->load->view('antarik_basai_sarai',$data);
        $this->load->view('User/footer');
    }


    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_antarik_basai_sarai()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("antarik-basai-sarai");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_antarik_basai_sarai->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("antarik-basai-sarai");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("antarik-basai-sarai/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("antarik-basai-sarai/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."antarik-basai-sarai/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/settlement/antarik_basaisarai";
            for($i = 0;$i<$count;$i++)
            {
                $ext = pathinfo($files['documents']['name'][$i], PATHINFO_EXTENSION);
                $_FILES['documents']['name']     = $files['documents']['name'][$i].".".$ext;
                $_FILES['documents']['type']     = $files['documents']['type'][$i];
                $_FILES['documents']['tmp_name'] = $files['documents']['tmp_name'][$i];
                $_FILES['documents']['error']    = $files['documents']['error'][$i];
                $_FILES['documents']['size']     = $files['documents']['size'][$i];
                $config = Modules::run("FileUpload/set_upload_options",$path);
                $this->upload->initialize($config);
                $this->upload->do_upload('documents');
                $dataInfo = $this->upload->data();
                if($i == $count-1 )
                {
                    $filename .= $dataInfo['file_name'];
                }
                else
                {
                    $filename  .= $dataInfo['file_name']."+";
                }

            }

            $data['status']             = 2;
            $data['darta_documents']    = $filename;
            if($this->Mdl_antarik_basai_sarai->update($id,$data))
            {
                $save['type']               = 5;
                $save['applicant_name']     = $result->applicant_name;
                $save['ward_login']         = $this->session->userdata('ward_no');
                $save['uri']                = $this->uri->segment(1);
                $save['sifaris_id']         = $id;
                $current_session                = Modules::run("Settings/getCurrentSession");
                $save['session_id']            = $current_session->id;
                $save['user_id']            = $this->session->userdata('id');
                $save['darta_documents']    = $filename;
        //---------------------  darta id {  Mdl_darta ko autoincrement 'id' } -------------------------
                if(isset($_POST['darta_id']))
                {
                    $darta_id                   = $this->input->post('darta_id');
                    $darta_detail               = $this->Mdl_darta->getById($darta_id);
                    $save['darta_no']           = $darta_detail->darta_no;
                    $save['nepali_darta_miti']  = $darta_detail->nepali_darta_miti;
                    $save['english_darta_miti'] = $darta_detail->english_darta_miti;
                    $this->Mdl_darta->update($darta_id,$save);
                }
                else
                {
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

                    $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward);
                    $save['form_id']            = $result->form_id;
                    $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
                    $save['english_darta_miti'] = date("Y-m-d",time());
                    $save['nepali_darta_miti']  = DateEngToNep($save['english_darta_miti']);
                    $this->Mdl_darta->save($save);
                }
                $this->session->set_flashdata('msg',"दर्ता हुन सफल |");
                redirect(base_url()."antarik-basai-sarai/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."antarik-basai-sarai/detail/".$id);
            }

        }
        $result = [];
        $ward_login             = $this->session->userdata('ward_no');
        $result['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/darta',$result);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function chalani_antarik_basai_sarai()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_antarik_basai_sarai->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("antarik-basai-sarai");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("antarik-basai-sarai/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("antarik-basai-sarai/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $chalani_result         = $this->Mdl_chalani->getByFormId($result->form_id);
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
            $chalani_no                       = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']     = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti'] = date("Y-m-d",time());
            $save['nepali_chalani_miti']  = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']       = $result->applicant_name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']            = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $save['tpye'] = 5;
            $save['czn_no'] = $result->cit_no;
            if(!empty($_POST['department']))
            {
                $save['department']     = $this->input->post('department');
            }
            if(!empty($_POST['department_other']))
            {
                $save['department_other'] = $this->input->post('department_other');
            }
            $this->Mdl_chalani->update($chalani_result->id,$save);
            $data['status']         = 3;
            if($this->Mdl_antarik_basai_sarai->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("antarik-basai-sarai/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("antarik-basai-sarai");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_antarik_basai_sarai()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("antarik-basai-sarai");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_antarik_basai_sarai->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("antarik-basai-sarai");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("antarik-basai-sarai/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
            $save['office_id'] = $_POST['office_id'];
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
        $data['print_office']         = $this->Mdl_office->getById($_POST['office_id']);
        $data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $data['details']    = $this->Mdl_antarik_basai_sarai_detail->getByDartaId($id);
        $data['chalani_result'] =  $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('antarik_basai_sarai_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_antarik_basai_sarai()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $ward_login = $this->session->userdata('ward_no');
        if($this->session->userdata('is_muncipality')==0)
        {
            if(isset($_GET['submit']))
            {
                if(isset($_GET['search']))
                {
                    $search         = $this->input->get('search');
                    $result         = $this->Mdl_antarik_basai_sarai->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_antarik_basai_sarai->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_antarik_basai_sarai->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."antarik-basai-sarai");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_antarik_basai_sarai->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_antarik_basai_sarai->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_antarik_basai_sarai->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_antarik_basai_sarai->getTableName();
            if(isset($_GET['submit']))
            {
                if(isset($_GET['search']))
                {
                    $search         = $this->input->get('search');
                    $result         = $this->Mdl_chalani->searchByWord($search, $table_name, $department, $url);
                    $data['result'] = $result;
                }
                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."sthai-basobas");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_chalani->getByDates($start_date, $end_date, $table_name, $department, $url);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_chalani->getByDates($start_date, $end_date, $table_name, $department, $url);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_chalani->getAllByDepartmentAndUri($department, $table_name, $url);
            }
        }
        $data1['title']     = "अन्तरिक बसाई सराई";
        $this->load->view('User/header',$data1);
        $this->load->view('antarik_basai_sarai_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    public function getAntarikBasaiSaraiHTML()
    {
        $i          = $this->input->post('count');
        $relations  = $this->Mdl_relation->getAll();
        $res        = [];
        $html = '<tr class="item" id="item_'.$i.'">
                    <td>
                        <input type="text" name="name_'.$i.'" maxlength="120" class="form-control formset-field" id="id_details-'.$i.'-name" required/>
                    </td>
                    <td>
                        <select name="relation_'.$i.'" class="form-control select2" required>
                            <option value="">छान्नुहोस्</option>';
                            foreach($relations as $relation):
    $html .=                    '<option value="'.$relation->id.'">'.$relation->name.'</option>';
                            endforeach;
    $html .=           '</select>
                    </td>
                    <td>
                        <input type="text" name="citizenship_no_'.$i.'" maxlength="32" class="form-control formset-field" id="id_details-'.$i.'-citizenship_no" />
                    </td>
                    <td><input type="text" name="ghar_no_'.$i.'" maxlength="16" class="form-control formset-field" id="id_details-'.$i.'-ghar_no" /></td>
                    <td><input type="text" name="road_name_'.$i.'" maxlength="128" class="form-control formset-field" id="id_details-'.$i.'-road_name" /></td>
                    <td><input type="number" name="age_'.$i.'" class="form-control formset-field" id="id_details-'.$i.'-age" min="1" required /></td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove"
                                id="remove_'.$i.'">
                                <i class="fa fa-minus"></i>
                        </button>
                    </td>
                </tr>';
        $res['html'] = $html;
        echo json_encode($res);exit;
    }
}
