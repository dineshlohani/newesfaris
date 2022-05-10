<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_sanstha_darta_pramanpatra');
        $this->load->model('Mdl_bebasaya_darta');
        $this->load->model('Mdl_bebasaya_banda');
        $this->load->model('Mdl_sanstha_darta');
        $this->load->model('Mdl_sanstha_nabikaran');
        $this->load->model('Mdl_bebasaya_sifaris');

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
        $this->load->model("Settings/Mdl_department");
        $this->load->model("Settings/Mdl_session");
        $this->load->model('Settings/Mdl_document');
        $this->load->model('Settings/Mdl_patra_item');
        $this->load->model('Settings/Mdl_ward_worker');
        $this->load->model('Settings/Mdl_post');
        $this->load->helper('functions_helper');
        $this->load->helper('string');
        $this->load->helper('functions_helper');
        $this->load->model('User/Mdl_user');
    }

    /*------------------------------------------------------------------------------------------------------------------*/

    public function index()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $data['title'] = "Business | Dashboard";
        $data['sanstha_darta_pramanpatra'] = $this->Mdl_user->getTotalCount('sanstha_darta_pramanpatra');
        $data['bebasaya_sifaris'] = $this->Mdl_user->getTotalCount('bebasaya_sifaris');
        $data['bebasaya_darta'] = $this->Mdl_user->getTotalCount('bebasaya_darta');
        $data['bebasaya_banda'] = $this->Mdl_user->getTotalCount('bebasaya_banda');
        $data['sanstha_darta'] = $this->Mdl_user->getTotalCount('sanstha_darta');
        $data['sanstha_nabikaran'] = $this->Mdl_user->getTotalCount('sanstha_nabikaran');
        $this->load->view('User/header',$data);
        $this->load->view('dashboard');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Sanstha Darta Pramanpatra     ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_sanstha_darta_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $is_logged_in = Modules::run("User/is_logged_in");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('org_name', 'संस्थाको नाम', 'required');
            $this->form_validation->set_rules('subjected_area', 'विषयगत क्षेत्र', 'required');
            $this->form_validation->set_rules('darta_no', 'दर्ता नं', 'required');
            $this->form_validation->set_rules('nepali_darta_miti', 'दर्ता मिति', 'required');
            $this->form_validation->set_rules('org_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('org_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('org_ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('org_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('org_email', 'संस्थाको ईमेल', 'required');
            $this->form_validation->set_rules('org_contact_no', 'संस्थाको सम्पर्क नं', 'required');
            $this->form_validation->set_rules('nationality', 'स्वदेशी / प्रदेशी ', 'required');
            $this->form_validation->set_rules('nepali_transact_date', 'कारोबार सुरु भएको मिति', 'required');
            $this->form_validation->set_rules('owner_name', 'संचालकको नाम', 'required');
            $this->form_validation->set_rules('own_email', 'संचालकको ईमेल', 'required');
            $this->form_validation->set_rules('own_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('own_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('own_ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('own_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('own_contact_no', 'संचालकको सम्पर्क नं', 'required');

            if ($this->form_validation->run() == false)
            {
                //pp(validation_errors());
               $this->session->set_flashdata('err_msg', validation_errors());
               //  $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
               redirect('sanstha-darta-pramanpatra/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/business/sanstha_darta_pramanpatra/';
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
                $_POST['english_darta_miti']    = DateNepToEng($this->input->post('nepali_darta_miti'));
                $_POST['english_transact_date'] = DateNepToEng($this->input->post('nepali_transact_date'));
                $_POST['ward_login']            = $this->session->userdata('ward_no');
                $_POST['created_at']            = date("Y-m-d h:i:sa",time());
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_sanstha_darta_pramanpatra->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 4;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_sanstha_darta_pramanpatra->update($id,$save);
                    $this->session->set_flashdata('msg',"संस्था दर्ता प्रमाणपत्र सिफारिस पेश गर्न सफल |");
                    redirect('sanstha-darta-pramanpatra/detail/'.$id);

                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('sanstha-darta-pramanpatra/create');
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

        $data1['title'] = "नयाँ | संस्था दर्ता प्रमाणपत्र";
        if($is_logged_in === TRUE)
        {
            $this->load->view('User/header',$data1);
        }
        else
        {
            $this->load->view('User/userheader',$data1);
        }
        $data['is_logged_in'] = $is_logged_in;
        $this->load->view('sanstha_darta_pramanpatra',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_sanstha_darta_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sanstha-darta-pramanpatra");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_sanstha_darta_pramanpatra->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sanstha-darta-pramanpatra");
        }
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data1['title']     = "आवेदकको विवरण | संस्था दर्ता प्रमाणपत्र" ;
        $is_logged_in = Modules::run("User/is_logged_in");
        $data['is_logged_in'] = $is_logged_in;
        if($is_logged_in === TRUE)
        {
            $this->load->view('User/header',$data1);
        }
        else
        {
            $this->load->view('User/userheader',$data1);
        }
        $this->load->view('sanstha_darta_pramanpatra_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_sanstha_darta_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sanstha-darta-pramanpatra");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_sanstha_darta_pramanpatra->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("sanstha-darta-pramanpatra");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("sanstha-darta-pramanpatra");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('org_name', 'संस्थाको नाम', 'required');
            $this->form_validation->set_rules('subjected_area', 'विषयगत क्षेत्र', 'required');
            $this->form_validation->set_rules('darta_no', 'दर्ता नं', 'required');
            $this->form_validation->set_rules('nepali_darta_miti', 'दर्ता मिति', 'required');
            $this->form_validation->set_rules('org_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('org_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('org_ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('org_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('org_email', 'संस्थाको ईमेल', 'required');
            $this->form_validation->set_rules('org_contact_no', 'संस्थाको सम्पर्क नं', 'required');
            $this->form_validation->set_rules('nationality', 'स्वदेशी / प्रदेशी ', 'required');
            $this->form_validation->set_rules('nepali_transact_date', 'कारोबार सुरु भएको मिति', 'required');
            $this->form_validation->set_rules('owner_name', 'संचालकको नाम', 'required');
            $this->form_validation->set_rules('own_email', 'संचालकको ईमेल', 'required');
            $this->form_validation->set_rules('own_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('own_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('own_ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('own_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('own_contact_no', 'संचालकको सम्पर्क नं', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('sanstha-darta-pramanpatra/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/business/sanstha_darta_pramanpatra/';
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
                $_POST['english_darta_miti']    = DateNepToEng($this->input->post('nepali_darta_miti'));
                $_POST['english_transact_date'] = DateNepToEng($this->input->post('nepali_transact_date'));
                if($this->Mdl_sanstha_darta_pramanpatra->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"संस्था दर्ता प्रमाणपत्र सिफारिस सम्पादन गर्न सफल |");
                    redirect('sanstha-darta-pramanpatra/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('sanstha-darta-pramanpatra/edit/'.$id);
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

        $data1['title'] = "नयाँ | संस्था दर्ता प्रमाणपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('sanstha_darta_pramanpatra',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_sanstha_darta_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("sanstha-darta-pramanpatra");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_sanstha_darta_pramanpatra->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sanstha-darta-pramanpatra");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("sanstha-darta-pramanpatra/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("sanstha-darta-pramanpatra/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."sanstha-darta-pramanpatra/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/business/sanstha_darta_pramanpatra";
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
            if($this->Mdl_sanstha_darta_pramanpatra->update($id,$data))
            {
                $save['type']               = 4;
                $save['applicant_name']     = $result->org_name;
                $save['ward_login']         = $this->session->userdata('ward_no');
                $save['uri']                = $this->uri->segment(1);
                $save['sifaris_id']         = $id;
                $current_session            = Modules::run("Settings/getCurrentSession");
                $save['session_id']         = $current_session->id;
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
                redirect(base_url()."sanstha-darta-pramanpatra/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."sanstha-darta-pramanpatra/detail/".$id);
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
    public function chalani_sanstha_darta_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_sanstha_darta_pramanpatra->getById($id);
        //pp($result);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sanstha-darta-pramanpatra");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("sanstha-darta-pramanpatra/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("sanstha-darta-pramanpatra/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $chalani_result         = $this->Mdl_chalani->getByFormId($result->form_id);
            $is_muncipality         = $this->session->userdata('is_muncipality');
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
            $chalani_no                         = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']                 = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']       = date("Y-m-d",time());
            $save['nepali_chalani_miti']        = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']             = $result->org_name;
            $save['czn_no']                     = $result->cit_no;
            $save['ward_login']                 = $this->session->userdata('ward_no');
            $save['uri']                        = $this->uri->segment(1);
            $current_session                    = Modules::run("Settings/getCurrentSession");
            $save['session_id']                 = $current_session->id;
            $save['user_id']                    = $this->session->userdata('id');
            $save['type']                       = 4;
            $save['czn_no'] = $result->cit-no;
            if(!empty($_POST['department']))
            {
                $save['department']             = $this->input->post('department');
            }
            if(!empty($_POST['department_other']))
            {
                $save['department_other']       = $this->input->post('department_other');
            }
            $this->Mdl_chalani->update($chalani_result->id,$save);
            $data['status']         = 3;
            if($this->Mdl_sanstha_darta_pramanpatra->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("sanstha-darta-pramanpatra/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("sanstha-darta-pramanpatra");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_sanstha_darta_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("sanstha-darta-pramanpatra");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_sanstha_darta_pramanpatra->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sanstha-darta-pramanpatra");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("sanstha-darta-pramanpatra/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
            $save['office_id'] = $_POST['office_id'];
            if($this_print == FALSE)
            {
                $save['uri'] = $uri; $save['form_id'] = $result->form_id;
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('sanstha_darta_pramanpatra_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_sanstha_darta_pramanpatra()
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
                    $result         = $this->Mdl_sanstha_darta_pramanpatra->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_sanstha_darta_pramanpatra->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_sanstha_darta_pramanpatra->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."sanstha-darta-pramanpatra");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_sanstha_darta_pramanpatra->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_sanstha_darta_pramanpatra->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_sanstha_darta_pramanpatra->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_sanstha_darta_pramanpatra->getTableName();
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
        $this->load->view('sanstha_darta_pramanpatra_view',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Bebasaya Darta Pramanpatra     ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/

    public function create_bebasaya_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('certificate_no', 'प्रमाणपत्र नं', 'required');
            $this->form_validation->set_rules('org_name', 'संस्थाको नाम', 'required');
            $this->form_validation->set_rules('owner_name', 'व्यवसायीको नाम', 'required');
            $this->form_validation->set_rules('org_type', 'व्यवसायीको प्रकार', 'required');
            $this->form_validation->set_rules('org_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('org_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('org_ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('org_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('org_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('org_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('org_ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('org_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('tole', 'टोलको नाम', '');
            $this->form_validation->set_rules('road_name', 'बाटोको नाम', '');
            $this->form_validation->set_rules('org_email', 'संस्थाको ईमेल', '');
            $this->form_validation->set_rules('org_contact_no', 'व्यवसायीको सम्पर्क नं', 'required');
            $this->form_validation->set_rules('house_own_name', 'घरधनीको नाम', 'required');
            $this->form_validation->set_rules('home_no', 'घर नं', '');

            if ($this->form_validation->run() == FALSE)
            {
               $this->session->set_flashdata('err_msg', validation_errors());
                redirect('bebasaya-darta/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/business/bebasaya_darta/';
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
                $_POST['status']                    = 1;
                $_POST['documents']                 = $file;
                $_POST['documents_type']            = $doc_type;
                $_POST['date']                      = DateNepToEng($this->input->post('nepali_date'));
                $_POST['ward_login']                = $this->session->userdata('ward_no');
                $_POST['created_at']                = date("Y-m-d h:i:sa",time());
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_bebasaya_darta->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 4;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_bebasaya_darta->update($id,$save);
                    $this->session->set_flashdata('msg',"व्यवसाय दर्ता प्रमाणपत्र सिफारिस पेश गर्न सफल |");
                    redirect('bebasaya-darta/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('bebasaya-darta/create');
                }

            }

        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $patra_url              = $this->uri->segment(1);
        $patra                  = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']       = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $is_logged_in           = Modules::run("User/is_logged_in");
        $data['is_logged_in']   = $is_logged_in;

        $data1['title'] = "नयाँ | व्यवसाय दर्ता प्रमाणपत्र";
        if($is_logged_in === TRUE){
            $this->load->view('User/header',$data1);
        }
        else
        {
            $this->load->view('User/userheader',$data1);
        }
        $this->load->view('bebasaya_darta',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_bebasaya_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("bebasaya-darta");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_bebasaya_darta->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("bebasaya-darta");
        }
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
            $data['this_darta']     = $this->Mdl_darta->getByFormId($result->form_id);
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $is_logged_in           = Modules::run("User/is_logged_in");
        $data['is_logged_in']   = $is_logged_in;

        $data1['title']     = "आवेदकको विवरण | व्यवसाय दर्ता प्रमाणपत्र" ;
        if($is_logged_in === TRUE){
            $this->load->view('User/header',$data1);
        }
        else
        {
            $this->load->view('User/userheader',$data1);
        }
        $this->load->view('bebasaya_darta_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_bebasaya_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("bebasaya-darta");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_bebasaya_darta->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("bebasaya-darta");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("bebasaya-darta");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('org_name', 'संस्थाको नाम', 'required');
            $this->form_validation->set_rules('owner_name', 'व्यवसायीको नाम', 'required');
            $this->form_validation->set_rules('org_type', 'व्यवसायीको प्रकार', 'required');
            $this->form_validation->set_rules('org_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('org_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('org_ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('org_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('tole', 'टोलको नाम', '');
            $this->form_validation->set_rules('road_name', 'बाटोको नाम', '');
            $this->form_validation->set_rules('org_email', 'संस्थाको ईमेल', '');
            $this->form_validation->set_rules('org_contact_no', 'व्यवसायीको सम्पर्क नं', 'required');
            $this->form_validation->set_rules('house_own_name', 'घरधनीको नाम', 'required');
            $this->form_validation->set_rules('home_no', 'घर नं', '');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('bebasaya-darta/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/business/bebasaya_darta/';
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

                if($this->Mdl_bebasaya_darta->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"व्यवसाय दर्ता प्रमाणपत्र सिफारिस सम्पादन गर्न सफल |");
                    redirect('bebasaya-darta/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('bebasaya-darta/edit/'.$id);
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

        $data1['title'] = "नयाँ | व्यवसाय दर्ता प्रमाणपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('bebasaya_darta',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_bebasaya_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("bebasaya-darta");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_bebasaya_darta->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("bebasaya-darta");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("bebasaya-darta/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("bebasaya-darta/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."bebasaya-darta/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/business/bebasaya_darta";
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
            if($this->Mdl_bebasaya_darta->update($id,$data))
            {
                $save['type']               = 4;
                $save['applicant_name']     = $result->org_name;
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
                redirect(base_url()."bebasaya-darta/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."bebasaya-darta/detail/".$id);
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
    public function chalani_bebasaya_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_bebasaya_darta->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("bebasaya-darta");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("bebasaya-darta/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("bebasaya-darta/detail/".$id);
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
            $chalani_no                         = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']                 = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']       = date("Y-m-d",time());
            $save['nepali_chalani_miti']        = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']             = $result->org_name;
            $save['ward_login']                 = $this->session->userdata('ward_no');
            $save['uri']                        = $this->uri->segment(1);
            $current_session                    = Modules::run("Settings/getCurrentSession");
            $save['session_id']                 = $current_session->id;
            $save['user_id']                    = $this->session->userdata('id');
            $save['type']                       = 4;
            $save['czn_no']                     = $result->citizenship_no;
            if(!empty($_POST['department']))
            {
                $save['department']             = $this->input->post('department');
            }
            if(!empty($_POST['department_other']))
            {
                $save['department_other']       = $this->input->post('department_other');
            }
            $this->Mdl_chalani->update($chalani_result->id,$save);
            $data['status']                     = 3;
            if($this->Mdl_bebasaya_darta->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("bebasaya-darta/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("bebasaya-darta");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_bebasaya_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("bebasaya-darta");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_bebasaya_darta->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("bebasaya-darta");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("bebasaya-darta/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = isset($_POST['ward_worker'])?$_POST['ward_worker']:'';
            $save['office_id'] = isset($_POST['office_id'])?$_POST['office_id']:'';
            if($this_print == FALSE)
            {
                $save['uri'] = $uri; $save['form_id'] = $result->form_id;
                $save['created_at'] = date('Y-m-d H:i:sa');
                $this->Mdl_print_details->save($save);

            }
            else
            {
                $save['updated_at'] = date('Y-m-d H:i:sa');
                $this->Mdl_print_details->update($this_print->id , $save);
            }

        //------------------------------------------------
        $data['this_darta']     = $this->Mdl_darta->getByFormId($result->form_id);
        //$data['print_office']   = $this->Mdl_office->getById($_POST['office_id']);
        //$data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        //$this->load->view('letter_head_np');
        $this->load->view('bebasaya_darta_print',$data);
        $this->load->view('letter_footer');
        //$this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_bebasaya_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $ward_login     = $this->session->userdata('ward_no');
        if($this->session->userdata('is_muncipality')==0)
        {
            if(isset($_GET['submit']))
            {

                if(isset($_GET['search']))
                {
                    $search         = $this->input->get('search');
                    $result         = $this->Mdl_bebasaya_darta->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_bebasaya_darta->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_bebasaya_darta->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."bebasaya-darta");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_bebasaya_darta->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_bebasaya_darta->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_bebasaya_darta->getByStatus(1,$ward_login);
            }
        }
        else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_bebasaya_darta->getTableName();
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
        $data1['title']     = "व्यवसाय दर्ता";
        $this->load->view('User/header',$data1);
        $this->load->view('bebasaya_darta_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Bebasaya Banda     ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/

    public function create_bebasaya_banda()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('org_name', 'संस्थाको नाम', 'required');
            $this->form_validation->set_rules('owner_name', 'व्यवसायीको नाम', 'required');
            $this->form_validation->set_rules('org_size', 'व्यवसायीको प्रकृति', 'required');
            $this->form_validation->set_rules('darta_no', 'दर्ता नं', 'required');
            $this->form_validation->set_rules('org_type', 'व्यवसायीको प्रकार', 'required');
            $this->form_validation->set_rules('org_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('org_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('org_ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('org_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_new_address', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('new_place', 'हाल ठेगानाi', 'required');
            $this->form_validation->set_rules('tole', 'टोलको नाम', 'required');
            $this->form_validation->set_rules('road_name', 'बाटोको नाम', 'required');
            $this->form_validation->set_rules('old_new_address', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('new_place', 'हालको ठेगाना', 'required');
            // $this->form_validation->set_rules('home_no', 'घर नं', 'required');
            $this->form_validation->set_rules('nepali_closed_date', 'व्यवसाय बन्द गरिएको मिति', 'required');
            $this->form_validation->set_rules('nepali_observed_date', 'सर्जमिन गरेको मिति', 'required');
            if ($this->form_validation->run() == FALSE)
            {
               $this->session->set_flashdata('err_msg', validation_errors());
                // $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('bebasaya-banda/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/business/bebasaya_banda/';
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
                $_POST['status']                    = 1;
                $_POST['documents']                 = $file;
                $_POST['documents_type']            = $doc_type;
                $_POST['date']                      = DateNepToEng($this->input->post('nepali_date'));
                $_POST['english_closed_date']       = DateNepToEng($this->input->post('nepali_closed_date'));
                $_POST['english_observed_date'] = DateNepToEng($this->input->post('nepali_observed_date'));
                $_POST['created_at']                = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']                = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_bebasaya_banda->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 4;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_bebasaya_banda->update($id,$save);
                    redirect('bebasaya-banda/detail/'.$id);
                    $this->session->set_flashdata('msg',"व्यवसाय बन्द बारे सिफारिस पेश गर्न सफल |");
                }
                else
                {
                    redirect('bebasaya-banda/create');
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                }

            }

        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']       = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | व्यवसाय बन्द बारे";

        $is_logged_in           = Modules::run("User/is_logged_in");
        $data['is_logged_in']   = $is_logged_in;

        if($is_logged_in === TRUE){
            $this->load->view('User/header',$data1);
        }
        else
        {
            $this->load->view('User/userheader',$data1);
        }
        $this->load->view('bebasaya_banda',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_bebasaya_banda()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("bebasaya-banda");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_bebasaya_banda->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("bebasaya-banda");
        }
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data1['title']     = "आवेदकको विवरण | व्यवसाय बन्द बारे " ;

        $is_logged_in           = Modules::run("User/is_logged_in");
        $data['is_logged_in']   = $is_logged_in;

        if($is_logged_in === TRUE){
            $this->load->view('User/header',$data1);
        }
        else
        {
            $this->load->view('User/userheader',$data1);
        }
        $this->load->view('bebasaya_banda_detail',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/

    public function edit_bebasaya_banda()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("bebasaya-darta");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_bebasaya_banda->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("bebasaya-banda");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("bebasaya-banda");
        }
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('org_name', 'संस्थाको नाम', 'required');
            $this->form_validation->set_rules('owner_name', 'व्यवसायीको नाम', 'required');
            $this->form_validation->set_rules('org_size', 'व्यवसायीको प्रकृति', 'required');
            $this->form_validation->set_rules('darta_no', 'दर्ता नं', 'required');
            $this->form_validation->set_rules('org_type', 'व्यवसायीको प्रकार', 'required');
            $this->form_validation->set_rules('org_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('org_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('org_ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('org_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_new_address', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('new_place', 'हाल ठेगानाi', 'required');
            $this->form_validation->set_rules('tole', 'टोलको नाम', 'required');
            $this->form_validation->set_rules('road_name', 'बाटोको नाम', 'required');
            $this->form_validation->set_rules('old_new_address', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('new_place', 'हालको ठेगाना', 'required');
            // $this->form_validation->set_rules('home_no', 'घर नं', 'required');
            $this->form_validation->set_rules('nepali_closed_date', 'व्यवसाय बन्द गरिएको मिति', 'required');
            $this->form_validation->set_rules('nepali_observed_date', 'सर्जमिन गरेको मिति', 'required');
            if ($this->form_validation->run() == FALSE)
            {
               $this->session->set_flashdata('err_msg', validation_errors());
                // $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('bebasaya-banda/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/business/bebasaya_banda/';
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
                    $_POST['documents']                 = $file;
                    $_POST['documents_type']            = $doc_type;
                }
                else
                {
                    $_POST['documents']             = $result->documents;
                    $_POST['documents_type']        = $result->documents_type;
                }
                $_POST['status']                    = 1;

                $_POST['date']                      = DateNepToEng($this->input->post('nepali_date'));
                $_POST['english_closed_date']       = DateNepToEng($this->input->post('nepali_closed_date'));
                $_POST['english_observed_date'] = DateNepToEng($this->input->post('nepali_observed_date'));
                if($this->Mdl_bebasaya_banda->update($id, $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('bebasaya-banda/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('bebasaya-banda/edit/'.$id);
                }

            }

        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']       = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | व्यवसाय बन्द बारे";
        $this->load->view('User/header',$data1);
        $this->load->view('bebasaya_banda',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_bebasaya_banda()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("bebasaya-banda");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_bebasaya_banda->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("bebasaya-banda");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("bebasaya-banda/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("bebasaya-banda/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."bebasaya-banda/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/business/bebasaya_banda";
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
            if($this->Mdl_bebasaya_banda->update($id,$data))
            {
                $save['type']               = 4;
                $save['applicant_name']     = $result->org_name;
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
                $this->Mdl_darta->save($save);
                $this->session->set_flashdata('msg',"दर्ता हुन सफल |");
                redirect(base_url()."bebasaya-banda/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."bebasaya-banda/detail/".$id);
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
    public function chalani_bebasaya_banda()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_bebasaya_banda->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("bebasaya-banda");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("bebasaya-banda/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("bebasaya-banda/detail/".$id);
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
            $chalani_no                     = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']             = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']   = date("Y-m-d",time());
            $save['nepali_chalani_miti']    = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']         = $result->org_name;
            $save['ward_login']             = $this->session->userdata('ward_no');
            $save['uri']                    = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']             = $current_session->id;
            $save['user_id']                = $this->session->userdata('id');
            $save['type']                   = 4;
            $save['czn_no']                 = $result->cit_no;
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
            if($this->Mdl_bebasaya_banda->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("bebasaya-banda/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("bebasaya-darta");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_bebasaya_banda()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("bebasaya-banda");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_bebasaya_banda->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("bebasaya-banda");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("bebasaya-banda/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
            $save['office_id'] = $_POST['office_id'];
            if($this_print == FALSE)
            {
                $save['uri'] = $uri; $save['form_id'] = $result->form_id;
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('bebasaya_banda_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_bebasaya_banda()
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
                    $result         = $this->Mdl_bebasaya_banda->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_bebasaya_banda->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_bebasaya_banda->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."bebasaya-banda");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_bebasaya_banda->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_bebasaya_banda->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_bebasaya_banda->getByStatus(1,$ward_login);
            }
        }
        else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_bebasaya_banda->getTableName();
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
        $data1['title']     = "व्यवसाय बन्द बारे";
        $this->load->view('User/header',$data1);
        $this->load->view('bebasaya_banda_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Sanstha Darta    ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/

    public function create_sanstha_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('org_name', 'संस्थाको नाम', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_new_address', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('sanstha-darta/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/business/sanstha_darta/';
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
                $_POST['status']                    = 1;
                $_POST['documents']                 = $file;
                $_POST['documents_type']            = $doc_type;
                $_POST['date']                      = DateNepToEng($this->input->post('nepali_date'));
                $_POST['created_at']                = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']                = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_sanstha_darta->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 4;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_sanstha_darta->update($id,$save);
                    $this->session->set_flashdata('msg',"संस्था दर्ता सिफारिस पेश गर्न सफल |");
                    redirect('sanstha-darta/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('sanstha-darta/create');
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

        $data1['title'] = "नयाँ | संस्था दर्ता";

        $is_logged_in           = Modules::run("User/is_logged_in");
        $data['is_logged_in']   = $is_logged_in;

        if($is_logged_in === TRUE){
            $this->load->view('User/header',$data1);
        }
        else
        {
            $this->load->view('User/userheader',$data1);
        }
        $this->load->view('sanstha_darta',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_sanstha_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sanstha-darta");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_sanstha_darta->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sanstha-darta");
        }
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data1['title']     = "आवेदकको विवरण | संस्था दर्ता बारे" ;

        $is_logged_in           = Modules::run("User/is_logged_in");
        $data['is_logged_in']   = $is_logged_in;

        if($is_logged_in === TRUE){
            $this->load->view('User/header',$data1);
        }
        else
        {
            $this->load->view('User/userheader',$data1);
        }
        $this->load->view('sanstha_darta_detail',$data);
        $this->load->view('User/footer');
    }
    public function edit_sanstha_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sanstha-darta");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_sanstha_darta->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("sanstha-darta");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("sanstha-darta");
        }
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('org_name', 'संस्थाको नाम', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_new_address', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('sanstha-darta/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/business/sanstha_darta/';
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
                    $_POST['documents']                 = $file;
                    $_POST['documents_type']            = $doc_type;
                }
                else
                {
                    $_POST['documents']             = $result->documents;
                    $_POST['documents_type']        = $result->documents_type;
                }
                $_POST['date']                      = DateNepToEng($this->input->post('nepali_date'));
                if($this->Mdl_sanstha_darta->update($id, $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('sanstha-darta/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('sanstha-darta/edit/'.$id);
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

        $data1['title'] = "नयाँ | संस्था दर्ता";
        $this->load->view('User/header',$data1);
        $this->load->view('sanstha_darta',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_sanstha_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("sanstha-darta");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_sanstha_darta->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sanstha-darta");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("sanstha-darta/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("sanstha-darta/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."sanstha-darta/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/business/sanstha_darta";
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
            if($this->Mdl_sanstha_darta->update($id,$data))
            {
                $save['type']               = 4;
                $save['applicant_name']     = $result->org_name;
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
                        $save['ward_login'] = $this->session->userdata('ward_no');
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
                redirect(base_url()."sanstha-darta/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."sanstha-darta/detail/".$id);
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
    public function chalani_sanstha_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_sanstha_darta->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sanstha-darta");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("sanstha-darta/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("sanstha-darta/detail/".$id);
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
            $chalani_no                         = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']                 = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']       = date("Y-m-d",time());
            $save['nepali_chalani_miti']        = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']             = $result->org_name;
            $save['ward_login']                 = $this->session->userdata('ward_no');
            $save['uri']                        = $this->uri->segment(1);
            $current_session                    = Modules::run("Settings/getCurrentSession");
            $save['session_id']                 = $current_session->id;
            $save['user_id']                    = $this->session->userdata('id');
            $save['type']                       = 4;
            //$save['czn_no']                     = $result->
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
            if($this->Mdl_sanstha_darta->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("sanstha-darta/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("sanstha-darta");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_sanstha_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("sanstha-darta");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_sanstha_darta->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sanstha-darta");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("sanstha-darta/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
            $save['office_id'] = $_POST['office_id'];
            if($this_print == FALSE)
            {
                $save['uri'] = $uri; $save['form_id'] = $result->form_id;
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
         $data['user']  = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('sanstha_darta_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_sanstha_darta()
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
                    $result         = $this->Mdl_sanstha_darta->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_sanstha_darta->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_sanstha_darta->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."sanstha-darta");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_sanstha_darta->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_sanstha_darta->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_sanstha_darta->getByStatus(1,$ward_login);
            }
        }
        else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_sanstha_darta->getTableName();
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
        $data1['title']     = "संस्था दर्ता";
        $this->load->view('User/header',$data1);
        $this->load->view('sanstha_darta_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Sanstha Nabikaran  ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/

    public function create_sanstha_nabikaran()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('org_name', 'संस्थाको नाम', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_new_address', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('sanstha-nabikaran/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/business/sanstha_nabikaran/';
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
                $_POST['status']                    = 1;
                $_POST['documents']                 = $file;
                $_POST['documents_type']            = $doc_type;
                $_POST['date']                      = DateNepToEng($this->input->post('nepali_date'));
                $_POST['created_at']                = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']                = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_sanstha_nabikaran->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 4;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_sanstha_nabikaran->update($id,$save);
                    $this->session->set_flashdata('msg',"संस्था नबिकरण सिफारिस पेश गर्न सफल |");
                    redirect('sanstha-nabikaran/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('sanstha-nabikaran/create');
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

        $data1['title'] = "नयाँ | संस्था नबिकरण";
        $is_logged_in           = Modules::run("User/is_logged_in");
        $data['is_logged_in']   = $is_logged_in;

        if($is_logged_in === TRUE){
            $this->load->view('User/header',$data1);
        }
        else
        {
            $this->load->view('User/userheader',$data1);
        }
        $this->load->view('sanstha_nabikaran',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_sanstha_nabikaran()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sanstha-darta");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_sanstha_nabikaran->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sanstha-darta");
        }
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['users']    = $this->Mdl_user->getAll();
        $data1['title']     = "आवेदकको विवरण | संस्था नबिकरण बारे" ;
        $is_logged_in           = Modules::run("User/is_logged_in");
        $data['is_logged_in']   = $is_logged_in;

        if($is_logged_in === TRUE){
            $this->load->view('User/header',$data1);
        }
        else
        {
            $this->load->view('User/userheader',$data1);
        }
        $this->load->view('sanstha_nabikaran_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    public function edit_sanstha_nabikaran()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sanstha-nabikaran");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_sanstha_nabikaran->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("sanstha-nabikaran");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("sanstha-nabikaran");
        }
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('org_name', 'संस्थाको नाम', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_new_address', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('sanstha-nabikaran/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/business/sanstha_nabikaran/';
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
                    $_POST['documents']                 = $file;
                    $_POST['documents_type']            = $doc_type;
                }
                else
                {
                    $_POST['documents']             = $result->documents;
                    $_POST['documents_type']        = $result->documents_type;
                }
                $_POST['date']                      = DateNepToEng($this->input->post('nepali_date'));
                if($this->Mdl_sanstha_nabikaran->update($id, $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('sanstha-nabikaran/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('sanstha-nabikaran/edit/'.$id);
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

        $data1['title'] = "नयाँ | संस्था दर्ता";
        $this->load->view('User/header',$data1);
        $this->load->view('sanstha_nabikaran',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_sanstha_nabikaran()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("sanstha-nabikaran");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_sanstha_nabikaran->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sanstha-nabikaran");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("sanstha-nabikaran/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("sanstha-nabikaran/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."sanstha-nabikaran/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/business/sanstha_nabikaran";
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
            if($this->Mdl_sanstha_nabikaran->update($id,$data))
            {
                $save['type']               = 4;
                $save['applicant_name']     = $result->org_name;
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
                        $save['ward_login'] = $this->session->userdata('ward_no');
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
                $this->Mdl_darta->save($save);
                $this->session->set_flashdata('msg',"दर्ता हुन सफल |");
                redirect(base_url()."sanstha-nabikaran/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."sanstha-nabikaran/detail/".$id);
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
    public function chalani_sanstha_nabikaran()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_sanstha_nabikaran->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sanstha-nabikaran");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("sanstha-nabikaran/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("sanstha-nabikaran/detail/".$id);
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
            $chalani_no                     = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']             = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']   = date("Y-m-d",time());
            $save['nepali_chalani_miti']    = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']         = $result->org_name;
            $save['ward_login']             = $this->session->userdata('ward_no');
            $save['uri']                    = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']             = $current_session->id;
            $save['user_id']                = $this->session->userdata('id');
            $save['type']                   = 4;
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
            if($this->Mdl_sanstha_nabikaran->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("sanstha-nabikaran/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("sanstha-nabikaran");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_sanstha_nabikaran()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("sanstha-nabikaran");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_sanstha_nabikaran->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sanstha-nabikaran");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("sanstha-nabikaran/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
            $save['office_id']  = $_POST['office_id'];
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
         $data['user']  = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('sanstha_nabikaran_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_sanstha_nabikaran()
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
                    $result         = $this->Mdl_sanstha_nabikaran->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_sanstha_nabikaran->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_sanstha_nabikaran->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."sanstha-nabikaran");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_sanstha_nabikaran->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_sanstha_nabikaran->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_sanstha_nabikaran->getByStatus(1,$ward_login);
            }
        }else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_sanstha_nabikaran->getTableName();
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
        $data1['title']     = "संस्था दर्ता";
        $this->load->view('User/header',$data1);
        $this->load->view('sanstha_nabikaran_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Bebasaya Darta Sifaris    ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/

    public function create_bebasaya_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('org_name', 'व्यवसायको नाम', 'required');
            $this->form_validation->set_rules('org_type', 'व्यवसायीको प्रकार', 'required');
            $this->form_validation->set_rules('org_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('org_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('org_ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('org_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('org_road_name', 'सडकको नाम', 'required');
            $this->form_validation->set_rules('org_home_no', 'व्यवसायको घर नं', '');
            $this->form_validation->set_rules('org_type', 'व्यवसायको किसिम', 'required');
            $this->form_validation->set_rules('org_phone', 'व्यवसायको फोन नं', 'required');
            $this->form_validation->set_rules('org_establish_nep_date', 'संचालन मिति', 'required');
            $this->form_validation->set_rules('org_punji', 'कुल पुँजी रकम', 'required');
            $this->form_validation->set_rules('org_ownership', 'व्यवसायको स्वामित्व', 'required');
            $this->form_validation->set_rules('home_owner', 'घरधनीको नाम', 'required');
            $this->form_validation->set_rules('home_owner_phone', 'घरधनीको फोन नं', 'required');
            $this->form_validation->set_rules('home_fare', 'मासिक भाडा रकम', '');
            $this->form_validation->set_rules('kitta_no', 'कित्ता नं', '');
            $this->form_validation->set_rules('biggha', 'बिग्घा', '');
            $this->form_validation->set_rules('kattha', 'कट्ठा', '');
            $this->form_validation->set_rules('dhur', 'धुर', '');
            $this->form_validation->set_rules('prop_name', 'संचालकको नाम', 'required');
            $this->form_validation->set_rules('prop_phone', 'संचालकको फोन नं', 'required');
            $this->form_validation->set_rules('prop_state', 'संचालकको प्रदेश', 'required');
            $this->form_validation->set_rules('prop_district', 'संचालकको जिल्ला', 'required');
            $this->form_validation->set_rules('prop_local_body', 'संचालकको गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('prop_ward', 'संचालकको वडा', 'required');
            $this->form_validation->set_rules('prop_road_nam', 'संचालकको बाटोको नाम', '');
            $this->form_validation->set_rules('prop_home_no', 'संचालकको घर नं', '');
            $this->form_validation->set_rules('applicant_name', 'निवेदकको नाम', 'required');
            $this->form_validation->set_rules('applicant_phone', 'निवेदकको फोन नं', 'required');
            $this->form_validation->set_rules('applicant_address', 'निवेदकको ठेगाना', 'required');
            if ($this->form_validation->run() == FALSE)
            {
               $this->session->set_flashdata('err_msg', validation_errors());
                // $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('bebasaya-sifaris/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/business/bebasaya_sifaris/';
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
                $_POST['status']                    = 1;
                $_POST['documents']                 = $file;
                $_POST['documents_type']            = $doc_type;
                $_POST['date']                      = DateNepToEng($this->input->post('nepali_date'));
                $_POST['org_establish_eng_date']    = DateNepToEng($this->input->post('org_establish_nep_date'));
                $_POST['ward_login']                = $this->session->userdata('ward_no');
                $_POST['created_at']                = date("Y-m-d h:i:sa",time());
                $current_session                    = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']                = $current_session->id;
                if($id = $this->Mdl_bebasaya_sifaris->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 4;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_bebasaya_sifaris->update($id,$save);
                    $this->session->set_flashdata('msg',"व्यवसाय दर्ता सिफारिस पेश गर्न सफल |");
                    redirect('bebasaya-sifaris/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('bebasaya-sifaris/create');
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

        $is_logged_in           = Modules::run("User/is_logged_in");
        $data['is_logged_in']   = $is_logged_in;

        $data1['title'] = "नयाँ | व्यवसाय दर्ता सिफारिस";
        if($is_logged_in === TRUE){
            $this->load->view('User/header',$data1);
        }
        else
        {
            $this->load->view('User/userheader',$data1);
        }
        $this->load->view('bebasaya_sifaris_form',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_bebasaya_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_bebasaya_sifaris->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("bebasaya-sifaris");
        }
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result1'] = $chalani_result1     = $this->Mdl_chalani->getByFormIdType($result->form_id, '1');
        $data['chalani_result2'] = $chalani_result2     = $this->Mdl_chalani->getByFormIdType($result->form_id, '2');
        if($result->status == 3)
        {
            $data['chalani_no1'] = $chalani_result1->chalani_no;
            $data['chalani_no2'] = $chalani_result2->chalani_no;
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $is_logged_in           = Modules::run("User/is_logged_in");
        $data['is_logged_in']   = $is_logged_in;
        $data['user']  = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']     = "आवेदकको विवरण | व्यवसाय दर्ता सिफारिस" ;
        if($is_logged_in === TRUE){
            $this->load->view('User/header',$data1);
        }
        else
        {
            $this->load->view('User/userheader',$data1);
        }
        $this->load->view('bebasaya_sifaris_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_bebasaya_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_bebasaya_sifaris->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("bebasaya-sifaris");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("bebasaya-sifaris");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('org_name', 'व्यवसायको नाम', 'required');
            $this->form_validation->set_rules('org_type', 'व्यवसायीको प्रकार', 'required');
            $this->form_validation->set_rules('org_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('org_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('org_ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('org_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('org_road_name', 'सडकको नाम', 'required');
            $this->form_validation->set_rules('org_home_no', 'व्यवसायको घर नं', '');
            $this->form_validation->set_rules('org_type', 'व्यवसायको किसिम', 'required');
            $this->form_validation->set_rules('org_phone', 'व्यवसायको फोन नं', 'required');
            $this->form_validation->set_rules('org_establish_nep_date', 'संचालन मिति', 'required');
            $this->form_validation->set_rules('org_punji', 'कुल पुँजी रकम', 'required');
            $this->form_validation->set_rules('org_ownership', 'व्यवसायको स्वामित्व', 'required');
            $this->form_validation->set_rules('home_owner', 'घरधनीको नाम', 'required');
            $this->form_validation->set_rules('home_owner_phone', 'घरधनीको फोन नं', 'required');
            $this->form_validation->set_rules('home_fare', 'मासिक भाडा रकम', '');
            $this->form_validation->set_rules('kitta_no', 'कित्ता नं', '');
            $this->form_validation->set_rules('biggha', 'बिग्घा', '');
            $this->form_validation->set_rules('kattha', 'कट्ठा', '');
            $this->form_validation->set_rules('dhur', 'धुर', '');
            $this->form_validation->set_rules('prop_name', 'संचालकको नाम', 'required');
            $this->form_validation->set_rules('prop_phone', 'संचालकको फोन नं', 'required');
            $this->form_validation->set_rules('prop_state', 'संचालकको प्रदेश', 'required');
            $this->form_validation->set_rules('prop_district', 'संचालकको जिल्ला', 'required');
            $this->form_validation->set_rules('prop_local_body', 'संचालकको गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('prop_ward', 'संचालकको वडा', 'required');
            $this->form_validation->set_rules('prop_road_nam', 'संचालकको बाटोको नाम', '');
            $this->form_validation->set_rules('prop_home_no', 'संचालकको घर नं', '');
            $this->form_validation->set_rules('applicant_name', 'निवेदकको नाम', 'required');
            $this->form_validation->set_rules('applicant_phone', 'निवेदकको फोन नं', 'required');
            $this->form_validation->set_rules('applicant_address', 'निवेदकको ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('bebasaya-sifaris/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/business/bebasaya_sifaris/';
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
                $_POST['org_establish_eng_date']    = DateNepToEng($this->input->post('org_establish_nep_date'));
                if($this->Mdl_bebasaya_sifaris->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"व्यवसाय दर्ता सिफारिस सम्पादन गर्न सफल |");
                    redirect('bebasaya-sifaris/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('bebasaya-sifaris/edit/'.$id);
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

        $data1['title'] = "नयाँ | व्यवसाय दर्ता सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('bebasaya_sifaris_form',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_bebasaya_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("bebasaya-sifaris");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_bebasaya_sifaris->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("bebasaya-sifaris");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("bebasaya-sifaris/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("bebasaya-sifaris/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."bebasaya-sifaris/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/business/bebasaya_sifaris";
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
            if($this->Mdl_bebasaya_sifaris->update($id,$data))
            {
                $save['type']               = 4;
                $save['applicant_name']     = $result->org_name;
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
                redirect(base_url()."bebasaya-sifaris/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."bebasaya-sifaris/detail/".$id);
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
    public function chalani_bebasaya_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_bebasaya_sifaris->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("bebasaya-sifaris");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("bebasaya-sifaris/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("bebasaya-sifaris/detail/".$id);
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
            $chalani_no                         = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']                 = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']       = date("Y-m-d",time());
            $save['nepali_chalani_miti']        = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']             = $result->org_name;
            $save['ward_login']                 = $this->session->userdata('ward_no');
            $save['uri']                        = $this->uri->segment(1);
            $current_session                    = Modules::run("Settings/getCurrentSession");
            $save['session_id']                 = $current_session->id;
            $save['user_id']                    = $this->session->userdata('id');
            if(!empty($_POST['department']))
            {
                $save['department']     = $this->input->post('department');
            }
            if(!empty($_POST['department_other']))
            {
                $save['department_other'] = $this->input->post('department_other');
            }
            $save['chalani_type']    = '1';
            $save['type']            = 4;
            $save['czn_no']         = $result->cit_no;
            $this->Mdl_chalani->update($chalani_result->id,$save);

            $save['form_id'] = $chalani_result->form_id;
            $chalani_no                       = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']     = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['chalani_type']    = '2';
            $this->Mdl_chalani->save($save);
            $data['status']         = 3;
            if($this->Mdl_bebasaya_sifaris->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("bebasaya-sifaris/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("bebasaya-sifaris");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_bebasaya_sifaris_first()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        $id         = $this->uri->segment(4);
        $data['result'] = $result     = $this->Mdl_bebasaya_sifaris->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("bebasaya-sifaris");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("bebasaya-sifaris/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
            $save['office_id'] = $_POST['office_id'];
            if($this_print == FALSE)
            {
                $save['uri'] = $uri; $save['form_id'] = $result->form_id;
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
        $data['chalani_result1'] = $result_chalani1     = $this->Mdl_chalani->getByFormIdType($result->form_id,'1');
        $data['chalani_no1'] = $result_chalani1->chalani_no;
        $data['user']  = $this->Mdl_user->getById($this->session->userdata('id'));

        //pp($data['user']) ;
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('bebasaya_sifaris_print_first',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_bebasaya_sifaris_second()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        $id         = $this->uri->segment(4);
        $data['result'] = $result     = $this->Mdl_bebasaya_sifaris->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("bebasaya-sifaris");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("bebasaya-sifaris/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
            $save['office_id'] = $_POST['office_id'];
            if($this_print == FALSE)
            {
                $save['uri'] = $uri; $save['form_id'] = $result->form_id;
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
        $data['chalani_result2'] = $result_chalani1     = $this->Mdl_chalani->getByFormIdType($result->form_id,'2');
        $data['chalani_no2'] = $result_chalani1->chalani_no;
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('bebasaya_sifaris_print_second',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_bebasaya_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $ward_login     = $this->session->userdata('ward_no');
        if($this->session->userdata('is_muncipality')==0)
        {
            if(isset($_GET['submit']))
            {

                if(isset($_GET['search']))
                {
                    $search         = $this->input->get('search');
                    $result         = $this->Mdl_bebasaya_sifaris->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_bebasaya_sifaris->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_bebasaya_sifaris->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."bebasaya-sifaris");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_bebasaya_sifaris->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_bebasaya_sifaris->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_bebasaya_sifaris->getByStatus(1,$ward_login);
            }
        }
        else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_bebasaya_sifaris->getTableName();
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
                        redirect(base_url()."bebasaya-sifaris");
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
        $data1['title']     = "व्यवसाय दर्ता";
        $this->load->view('User/header',$data1);
        $this->load->view('bebasaya_sifaris_view',$data);
        $this->load->view('User/footer');
    }
}
