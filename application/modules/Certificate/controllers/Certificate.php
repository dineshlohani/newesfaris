<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certificate extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_certificate');
        $this->load->model('Mdl_certificate_pratilipi');
        $this->load->model('Mdl_citizenship_sifaris');
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
    }

    /*------------------------------------------------------------------------------------------------------------------*/

    public function index()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $data['title'] = "Certificate | Dashboard";
        $data['citizenship_sifaris']        = $this->Mdl_user->getTotalCount('citizenship_sifaris');
        $data['citizenship_certificate']    = $this->Mdl_user->getTotalCount('citizen_certificate');
        $data['citizenship_certificate_pratilipi']        = $this->Mdl_user->getTotalCount('citizen_certificate_pratilipi');
        $this->load->view('User/header',$data);
        $this->load->view('dashboard');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*-------    cit Cert. Starts
    /*------------------------------------------------------------------------------------------------------------------*/

    public function create_citizenship_certificate()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
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
                redirect('citizenship-certificate/create');

            }
            else
            {
                if(empty($_POST['father_name']) && empty($_POST['mother_name']) && empty($_POST['f_citizenship_no']) && empty($_POST['m_citizenship_no']))
                {
                    $this->session->set_flashdata('err_msg', "कृपया बुबा वा आमाको विवरण भर्नुहोस्");
                    redirect('citizenship-certificate/create');
                }
                unset($_POST['submit']);
                $path ='assets/documents/land/citcertificate/';
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
                if($id = $this->Mdl_certificate->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 1;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_certificate->update($id,$save);
                    $this->session->set_flashdata('msg'," नागरिकता प्रमाण पत्र सिफारिस पेश गर्न सफल ");
                    redirect('citizenship-certificate/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('citizenship-certificate/create');
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

        $data1['title'] = "नयाँ | नागरिकता प्रमाण पत्र ";
        $this->load->view('User/header',$data1);
        $this->load->view('create_citizenship_certificate',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_citizenship_certificate()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("citizenship-certificate");
        }
       $id             =  $this->uri->segment(3);
       $result         = $data['result']     = $this->Mdl_certificate->getById($id);
       $documents      = $data['documents'] = explode("+",$result->documents);
       $documents_type = $data['documents_type'] = explode("+",$result->documents_type);
       if(empty($result))
        {

            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("citizenship-certificate");
        }

        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("citizenship-certificate");
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
                    redirect('citizenship-certificate/edit/'.$id);

                }
                else
                {
                        unset($_POST['submit']);
                        $path = 'assets/documents/certificate/citcertificate/';
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
                            redirect('citizenship-certificate/');
                        }
                        else
                        {
                            $this->session->set_flashdata('err_msg',"समस्या आयो |");
                            redirect('citizenship-certificate/edit/'.$id);
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
        $this->load->view('create_citizenship_certificate',$data);
        $this->load->view('User/footer');
//         $this->load->model('Mdl_batokayam');
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------------------------------------------------*/
     public function citizenship_certificate_view()
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
                    $result         = $this->Mdl_certificate->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_certificate->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_certificate->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."citizenship-certificate");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_certificate->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-$month months", strtotime($end_date)));
                    $data['result'] = $this->Mdl_certificate->getByDates($start_date,$end_date,$ward_login);
    //                print_r($data);exit;
                }

            }
            else
            {
                $data['result']     = $this->Mdl_certificate->getByStatus(1,$ward_login);
            }
        }
        else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_certificate->getTableName();
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
        $data1['title']     = "आवेदकको विवरणहरु  | नागरिकता प्रमाण पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('citizenship_certificate_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function citizenship_certificate_darta()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
         Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("citizenship-certificate");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_certificate->getById($id);
//        print_r($result);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("citizenship-certificate");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("citizenship-certificate/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("citizenship-certificate/details/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."citizenship-certificate/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/certificate/citcertificate_darta";
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
            if($this->Mdl_certificate->update($id,$data))
            {
                $save['type']               = 1;
                $save['applicant_name']     = $result->nep_full_name." ".$result->nep_middle_name." ".$result->nep_last_name;
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
                redirect(base_url()."citizenship-certificate/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."citizenship-certificate/details/".$id);
            }

        }
        $ward_login             = $this->session->userdata('ward_no');
        $data['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $data['result'] = $result;
        $this->load->view('User/header',$data1);
        $this->load->view('citizenship_certificate_darta',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function citizenship_certificate_details()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("citizenship-certificate");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_certificate->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("citizenship-certificate");
        }
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण |  नागरिकता प्रमाण पत्र" ;
        $this->load->view('User/header',$data1);
        $this->load->view('citizenship_certificate_details',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function citizenship_certificate_chalani()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_certificate->getById($id);
        //
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("citizenship-certificate");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("citizenship-certificate/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("citizenship-certificate/details/".$id);
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
            $save['chalani_no']           = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti'] = date("Y-m-d",time());
            $save['nepali_chalani_miti']  = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']       = $result->nep_full_name." ".$result->nep_middle_name." ".$result->nep_last_name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']            = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $save['czn_no']             = $result->f_citizenship_no;
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
            if($this->Mdl_certificate->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("citizenship-certificate/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("citizenship-certificate");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('citizenship_certificate_chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function citizenship_certificate_print_full()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(4)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("citizenship-certificate");
        }
        $id         = $this->uri->segment(4);
        $data['result'] = $result     = $this->Mdl_certificate->getById($id);
//        print_r($result);exit;
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("citizenship-certificate");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("citizenship-certificate/details/".$id);
        }
        //-----saving printing details--------------------
        $uri = $this->uri->segment(1);
        $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
        $save['uri'] = $uri; $save['form_id'] = $result->form_id;
        $save['worker_id'] = $_POST['ward_worker'];
        //$save['office_id'] = $_POST['office_id'];
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
        $data['print_office']         = $this->Mdl_office->getById($_POST['office_id']);
        $data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        //$data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        // $this->load->view('letter_head_np');
        $this->load->view('citizenship_certificate_print_full',$data);
        // $this->load->view('letter_footer');
         $this->load->view('User/footer');
    }
    public function citizenship_certificate_print_second()
    {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(4)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("citizenship-certificate");
        }
        $id         = $this->uri->segment(4);
        $data['result'] = $result     = $this->Mdl_certificate->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("citizenship-certificate");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले चलानी गरिएको छैन | ");
            redirect("citizenship-certificate/details/".$id);
        }
        $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('citizenship_certificate_print_second',$data);
        $this->load->view('User/footer');
    }
    /*------- citizen Certificates Ends here---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/


    /*------- citizen Certificates Pratilipi Starts here---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/

    public function create_citizenship_certificate_pratilipi()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
//            print_r($_FILES);exit;
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            //$this->form_validation->set_rules('office', 'आवेदन गरिएको कार्यालय ', 'required');
            $this->form_validation->set_rules('nep_full_name', ' full Name In Nepali ', 'required');
            $this->form_validation->set_rules('nep_last_name', 'Last Name In Nepali', 'required');
            $this->form_validation->set_rules('eng_full_name', 'full Name In English', 'required');
            $this->form_validation->set_rules('gender', ' लिङ्ग (Gender) ', 'required');
            $this->form_validation->set_rules('nep_dob', ' जन्म मिति', 'required');
            if ($this->form_validation->run() == FALSE)
            {
//                $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('citizenship-certificate-pratilipi/create');

            }
            else
            {
                unset($_POST['submit']);
                $path ='assets/documents/certificate/citcertificate_pratilipi/';
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
                $_POST['date']                  = DateNepToEng($this->input->post('nepali_date'));
                $_POST['eng_dob']				= DateNepToEng($_POST['nep_dob']);
                $_POST['created_at']            = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']            = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_certificate_pratilipi->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 6;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_certificate_pratilipi->update($id,$save);
                    $this->session->set_flashdata('msg'," नागरिकता प्रमाण पत्र सिफारिस पेश गर्न सफल |");
                     redirect('citizenship-certificate-pratilipi/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                     redirect('citizenship-certificate-pratilipi/create');
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

        $data1['title'] = "नयाँ | नागरिकता प्रमाणको प्रतिलिपि  ";
        $this->load->view('User/header',$data1);
        $this->load->view('create_citizenship_certificate_pratilipi',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_citizenship_certificate_pratilipi()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("citizenship-certificate-pratilipi");
        }
       $id             =  $this->uri->segment(3);
       $result         = $data['result']     = $this->Mdl_certificate_pratilipi->getById($id);
       $documents      = $data['documents'] = explode("+",$result->documents);
       $documents_type = $data['documents_type'] = explode("+",$result->documents_type);
       if(empty($result))
        {

            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("citizenship-certificate-pratilipi");
        }

        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("citizenship-certificate-pratilipi");
        }
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            //$this->form_validation->set_rules('office', 'आवेदन गरिएको कार्यालय ', 'required');
            $this->form_validation->set_rules('nep_full_name', ' full Name In Nepali ', 'required');
            $this->form_validation->set_rules('nep_last_name', 'Last Name In Nepali', 'required');
            $this->form_validation->set_rules('eng_full_name', 'full Name In English', 'required');
            $this->form_validation->set_rules('gender', ' लिङ्ग (Gender) ', 'required');
            $this->form_validation->set_rules('nep_dob', ' जन्म मिति', 'required');

                if ($this->form_validation->run() == FALSE)
                {
//                    $this->session->set_flashdata('err_msg', validation_errors());
                    $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                    redirect('citizenship-certificate-pratilipi/edit/'.$id);

                }
                else
                {
                        unset($_POST['submit']);
                        $path = 'assets/documents/certificate/citcertificate_pratilipi/';
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
                       if($this->Mdl_certificate_pratilipi->update($id , $this->input->post()))
                        {
        //                   $this->session->unset_userdata('temp_edit_id');
                            $this->session->set_flashdata('msg',"नागरिकता प्रमाण पत्र सिफारिस सम्पादन गर्न सफल |");
                            redirect('citizenship-certificate-pratilipi/');
                        }
                        else
                        {
                            $this->session->set_flashdata('err_msg',"समस्या आयो |");
                            redirect('citizenship-certificate-pratilipi/edit/'.$id);
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

        $data1['title'] = "नयाँ | नागरिकता प्रमाणको प्रतिलिपि ";
        $this->load->view('User/header',$data1);
        $this->load->view('create_citizenship_certificate_pratilipi',$data);
        $this->load->view('User/footer');
//         $this->load->model('Mdl_batokayam');
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------------------------------------------------*/
     public function citizenship_certificate_pratilipi_view()
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
                    $result         = $this->Mdl_certificate_pratilipi->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_certificate_pratilipi->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_certificate_pratilipi->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."citizenship-certificate-pratilipi");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_certificate_pratilipi->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-$month months", strtotime($end_date)));
                    $data['result'] = $this->Mdl_certificate_pratilipi->getByDates($start_date,$end_date,$ward_login);
    //                print_r($data);exit;
                }

            }
            else
            {
                $data['result']     = $this->Mdl_certificate_pratilipi->getByStatus(1,$ward_login);
            }
        }else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_certificate_pratilipi->getTableName();
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
        // print_r($data);exit;
        $data1['title']     = "आवेदकको विवरणहरु  | नागरिकता प्रमाणको प्रतिलिपि";
        $this->load->view('User/header',$data1);
        $this->load->view('citizenship_certificate_pratilipi_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function citizenship_certificate_pratilipi_darta()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
         Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("citizenship-certificate-pratilipi");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_certificate_pratilipi->getById($id);
//        print_r($result);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("citizenship-certificate-pratilipi");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("citizenship-certificate-pratilipi/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("citizenship-certificate-pratilipi/details/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."citizenship-certificate-pratilipi/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/land/citcertificate_pratilipi_darta";
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
            if($this->Mdl_certificate_pratilipi->update($id,$data))
            {
                $save['type']               = 1;
                $save['applicant_name']     = $result->nep_full_name." ".$result->nep_middle_name." ".$result->nep_last_name;
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
                redirect(base_url()."citizenship-certificate-pratilipi/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."citizenship-certificate-pratilipi/details/".$id);
            }

        }
        $ward_login             = $this->session->userdata('ward_no');
        $data['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $data['result'] = $result;
        $this->load->view('User/header',$data1);
        $this->load->view('citizenship_certificate_pratilipi_darta',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function citizenship_certificate_pratilipi_details()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("citizenship-certificate-pratilipi");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_certificate_pratilipi->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("citizenship-certificate-pratilipi");
        }
        //$data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण |  नागरिकता प्रमाणको प्रतिलिपि" ;
        $this->load->view('User/header',$data1);
        $this->load->view('citizenship_certificate_pratilipi_details',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function citizenship_certificate_pratilipi_chalani()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_certificate_pratilipi->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("citizenship-certificate-pratilipi");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("citizenship-certificate-pratilipi/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("citizenship-certificate-pratilipi/details/".$id);
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
            $save['applicant_name']             = $result->nep_full_name." ".$result->nep_middle_name." ".$result->nep_last_name;
            $save['ward_login']                 = $this->session->userdata('ward_no');
            $save['uri']                        = $this->uri->segment(1);
            $save['czn_no']                     = $result->f_citizenship_no;
            $current_session                    = Modules::run("Settings/getCurrentSession");
            $save['session_id']                 = $current_session->id;
            $save['type']                      = 1;
            $save['user_id']                    = $this->session->userdata('id');
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
            if($this->Mdl_certificate_pratilipi->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("citizenship-certificate-pratilipi/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("citizenship-certificate-pratilipi");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('citizenship_certificate_pratilipi_chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
     public function citizenship_certificate_pratilipi_print()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("citizenship-certificate-pratilipi");
        }
       
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_certificate_pratilipi->getById($id);
//        print_r($result);exit;
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("citizenship-certificate-pratilipi");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("citizenship-certificate-pratilipi/details/".$id);
        }
        //-----saving printing details--------------------
        $data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $uri = $this->uri->segment(1);
        $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
        $save['uri'] = $uri; $save['form_id'] = $result->form_id;
        $save['worker_id'] = $_POST['ward_worker'];
        //$save['office_id'] = $_POST['office_id'];
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
        $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('citizenship_certificate_pratilipi_print',$data);
        $this->load->view('User/footer');
    }
    /*------- citizen Certificates Pratilipi Ends here---------------------*/

    /*------------------------------------------------------------------------------------------------------------------*/
    /* Nagarikta Sifaris*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_citizenship_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            //$this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'निवेदकको नाम', 'required');
            $this->form_validation->set_rules('name', 'नाम', 'required');
            $this->form_validation->set_rules('gender', 'लिङ्ग', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'स्थानीय तह', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं', 'required');
            $this->form_validation->set_rules('age', 'उमेर', 'required');
            $this->form_validation->set_rules('relation', 'नाता', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('err_msg', validation_errors());
//                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('citizenship-sifaris/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/certificate/citizenship_sifaris/';
                if (!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                $count  = count($_FILES['documents']['name']);
                $file = "";
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
                            $file .= $file_name;
                        }
                        else
                        {
                            $file .= $file_name."+";
                        }
                    }
                }
                $_POST['status']        = 1;
                $_POST['documents']     = $file;
                $_POST['documents_type'] = implode("+", $_POST['documents_type']);
                //$_POST['date']      = $this->input->post('nepali_date');
                //$_POST['janmamiti'] = $this->input->post('janmamiti');
                $_POST['created_at']    = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']    = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_citizenship_sifaris->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 6;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run('Home/genFormId');
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_citizenship_sifaris->update($id,$save);
                    $this->session->set_flashdata('msg',"नागरिकताको सिफारिस पेश गर्न सफल |");
                    redirect('citizenship-sifaris/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('citizenship-sifaris/create');
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
        $data1['title'] = "नयाँ | नागरिकता सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('citizenship_sifaris_form_page',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_citizenship_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_citizenship_sifaris->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"सिफारिस भेटिएन");
            redirect("citizenship-sifaris");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | नागरिकताको सिफारिस" ;
        $this->load->view('User/header',$data1);
        $this->load->view('citizenship_sifaris_detail_page',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_citizenship_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_citizenship_sifaris->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("citizenship-sifaris");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("citizenship-sifaris");
        }
        if(isset($_POST['submit'])) {
            //$this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            //$this->form_validation->set_rules('applicant_name', 'निवेदकको नाम', 'required');
            //$this->form_validation->set_rules('name', 'नाम', 'required');
            //$this->form_validation->set_rules('gender', 'लिङ्ग', 'required');
            // $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            // $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            // $this->form_validation->set_rules('local_body', 'स्थानीय तह', 'required');
            // $this->form_validation->set_rules('ward', 'वडा नं', 'required');
            // $this->form_validation->set_rules('age', 'उमेर', 'required');
            // $this->form_validation->set_rules('relation', 'नाता', 'required');

//             if ($this->form_validation->run() == FALSE)
//             {
//                  $this->session->set_flashdata('err_msg', validation_errors());
// //                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
//                 redirect('citizenship-sifaris/edit/'.$id);

//             }
//             else
//             {
                unset($_POST['submit']);
                $path = 'assets/documents/certificate/citizenship_sifaris/';
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
                if($this->Mdl_citizenship_sifaris->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('citizenship-sifaris/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('citizenship-sifaris/edit/'.$id);
                }

            //}
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
//        $data['old_new_addresses'] = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | फरक फरक अंग्रेजी हिज्जे";
        $this->load->view('User/header',$data1);
        $this->load->view('citizenship_sifaris_form_page',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_citizenship_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_citizenship_sifaris->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("citizenship-sifaris");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("citizenship-sifaris/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("citizenship-sifaris/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."citizenship-sifaris/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/certificate/citizenship_sifaris";
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
            if($this->Mdl_citizenship_sifaris->update($id,$data))
            {
                $save['type']               = 1;
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
                redirect(base_url()."citizenship-sifaris/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."citizenship-sifaris/detail/".$id);
            }

        }
        $result = [];
        $ward_login             = $this->session->userdata('ward_no');
        $result['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward_no'));
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/darta',$result);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function chalani_citizenship_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_citizenship_sifaris->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("citizenship-sifaris");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("citizenship-sifaris/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("citizenship-sifaris/detail/".$id);
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
                $save['is_muncipality']         = '1';
                $save['department']             = $this->session->userdata('department');
            }
            $chalani_no                         = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']                 = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']       = date("Y-m-d",time());
            $save['nepali_chalani_miti']        = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']             = $result->applicant_name;
            $save['ward_login']                 = $this->session->userdata('ward_no');
            $save['uri']                        = $this->uri->segment(1);
            $current_session                    = Modules::run("Settings/getCurrentSession");
            $save['session_id']                 = $current_session->id;
            $save['czn_no']                     = $result->cit_no_1;
            $save['user_id']                    = $this->session->userdata('id');
            $save['type']                       = 1;
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
            if($this->Mdl_citizenship_sifaris->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("citizenship-sifaris/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("citizenship-sifaris");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_citizenship_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        if(empty($_POST['check'])) {
            $this->session->set_flashdata('err_msg',"कागजातहरु प्रकार छान्नुहोस् | ");
            redirect("citizenship-sifaris/detail/".$id);
        }
        $data['result'] = $result     = $this->Mdl_citizenship_sifaris->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("citizenship-sifaris");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("citizenship-sifaris/detail/".$id);
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

        //-----------------------------------------------------------------------------------------
        $data['print_office']           = $this->Mdl_office->getById($_POST['office_id']);
        $data['ward_worker']            = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $data['chalani_result']         = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no']             = $result_chalani->chalani_no;
         $data['user']                  = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']                 = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('new/citizenship_sifaris_print_page',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_citizenship_sifaris()
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
                    $result         = $this->Mdl_citizenship_sifaris->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_citizenship_sifaris->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_citizenship_sifaris->getByStatus($status,$ward_login);
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
                    $data['result'] = $this->Mdl_citizenship_sifaris->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_citizenship_sifaris->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_citizenship_sifaris->getByStatus(1,$ward_login);
            }
        }
        else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_citizenship_sifaris->getTableName();
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
        $data1['title']     = "नागरिकता सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('citizenship_sifaris_view_page',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getConvertedDate()
     {
        $res = [];
        $nep_dob = $_POST['nep_dob'];
        $eng = DateNepToEng($nep_dob);
        $res['html'] = $eng;
       // pp($res);
        echo json_encode($res);exit;

     }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getCertificateDocumentHTML()
 {
        $id = $_POST['count'];
        $html = '<div class="mb-3 documents" id="doc_div_'.$id.'">
                        <input type="file" name="documents[]" id="documents_'.$id.'" />
                        <select name="documents_type[]" id="documents_type_'.$id.'">
                            <option value="" selected>प्रकार छान्नुहोस्</option>

                            <option value="1">nibedan</option>

                        </select>
                        <button type="button" class="float-right btn btn-danger delete-form doc_remove" id="documents_remove_'.$id.'" >
                            <i class="fa fa-times"></i>
                        </button>
                </div>';
        $res = [];
        $res['html']  = $html;
        echo json_encode($res);
 }
    /*------------------------------------------------------------------------------------------------------------------*/

}