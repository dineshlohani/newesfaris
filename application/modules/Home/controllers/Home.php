<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_home_recommend');
        $this->load->model('Mdl_home_road_certify');
        $this->load->model('Mdl_home_road_certify_land');
        $this->load->model('Mdl_ghar_jagga_namsari');
        $this->load->model('Mdl_kitta_kat_sifaris');
        $this->load->model('Mdl_print_details');
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
        $this->load->model('Settings/Mdl_post');
        $this->load->model('Settings/Mdl_land_type');
        $this->load->model('User/Mdl_user');
        $this->load->helper('functions_helper');
        $this->load->helper('string');
        $this->load->helper('functions_helper');
        // status {
        //         1: "new data",
        //         2: "darta bhaeko data"
        //         3: "chalani bhaeko data"
        //     }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function index()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $data['title'] = "Home Dashboard";
        $data['home_recommend']         = $this->Mdl_user->getTotalCount('home_recommend');
        $data['home_road_certify']      = $this->Mdl_user->getTotalCount('home_road_certify');
        $data['ghar_jagga_namsari']     = $this->Mdl_user->getTotalCount('ghar_jagga_namsari');
        $data['kitta_kat_sifaris']      = $this->Mdl_user->getTotalCount('kitta_kat_sifaris');
        $this->load->view('User/header',$data);
        $this->load->view('dashboard');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------
    |       Create Home Recommend ( Ghar kayam )
    |
    ------------------------------------------------------------------------------------------------------------------*/
    public function create_homeRecommend()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            unset($_POST['submit']);
            $_POST['date']          = DateNepToEng($_POST['nepali_date']);
            $_POST['created_at']    = date("Y-m-d h:i:sa",time());
            $_POST['status']        = 1;
            $_POST['ward_login']    = $this->session->userdata('ward_no');
            $current_session        = Modules::run("Settings/getCurrentSession");
            $_POST['session_id']    = $current_session->id;
            if($id = $this->Mdl_home_recommend->save($this->input->post()))
            {
                $save['darta_id']   = $id;
                $save['type']       = 1;
                $save['form_id']    = $save1['form_id'] =  $this->genFormId();
                $this->Mdl_chalani->save($save);
                $this->Mdl_home_recommend->update($id, $save1);
                $this->session->set_flashdata('msg',"पेश गर्न सफल");
                redirect('home-recommend/detail/'.$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो");
                redirect('home-recommend/create');
            }
        }
        $data['default']        = getDefault();
        $data['offices']        = $this->Mdl_office->getAll();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']      = $this->Mdl_oldnew_address->getAll();
        $data['home_types']     = $this->Mdl_home_type->getAll();
        $data1['title']         = "नया | घर कायमको सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('home_recommend',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function details_home_recommend()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("home-recommend/create");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_home_recommend->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("home-recommend");
        }
        //$data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByDartaId($result->id,1);
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
       // pp($data['chalani_result']);
        $data['form_id']    = $result_chalani->form_id;
        if($result->status == 3)
        {

          $data['chalani_no'] = $result_chalani->chalani_no;
        }
        $data['id']         = $id;
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data1['title']     = "अवादेकको विवरण | घर कायमको सिफारिस";
        $data['offices']    = $this->Mdl_office->getAll();
        $this->load->view('User/header',$data1);
        $this->load->view('home_recommend_detail',$data);
        $this->load->view('User/footer');
    }
/*------------------------------------------------------------------------------------------------------------------*/
    public function view_home_recommends()
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
                    $result         = $this->Mdl_home_recommend->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_home_recommend->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_home_recommend->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."home-recommend");
                    }
                    $start_date = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date   = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_home_recommend->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_home_recommend->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']         = $this->Mdl_home_recommend->getByStatus(1,$ward_login);
            }
        }
        else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_home_recommend->getTableName();
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
        $data1['title']         = "अवादेकको विवरण | घर कायमको सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('home_recommends',$data);
        $this->load->view('User/footer');
    }
/*------------------------------------------------------------------------------------------------------------------*/
    public function edit_home_recommend()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("home-recommend/create");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_home_recommend->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("home-recommend");
        }
        if($result->status == 3 )
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता चलानीमा भई सक्यो|");
            redirect("home-recommend");
        }
        if(isset($_POST['submit']))
        {
            unset($_POST['submit']);
            $_POST['date']          = DateNepToEng($_POST['nepali_date']);
            $_POST['status']        = 1;
            if($this->Mdl_home_recommend->update($id,$this->input->post()))
            {
                $this->session->set_flashdata('msg',"सम्पादन गर्न सफल");
                redirect('home-recommend/detail/'.$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो");
                redirect('home-recommend/edit/'.$id);
            }
        }
        $data['default']        = getDefault();
        $data['offices']        = $this->Mdl_office->getAll();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']      = $this->Mdl_oldnew_address->getAll();
        $data['home_types']     = $this->Mdl_home_type->getAll();
        $data1['title']         = "नया | घर कायमको सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('home_recommend',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_home_recommend()
    {

        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("home-recommend");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_home_recommend->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("home-recommend");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("home-recommend");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("home-recommend");
        }

        $ward_login                 = $this->session->userdata('ward_no');
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."home-recommend/darta/".$id);
            // }
            if(!empty($_FILES['documents']['name'])) {
                $filename = "";
                $path  = "assets/documents/home/home_recommend";
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
            }

            $data['status']             = 2;
            $data['darta_documents']    = $filename;

            if($this->Mdl_home_recommend->update($id,$data))
            {
                $save['type']               = 2;
                $save['applicant_name']     = $result->applicant_name;
                $save['ward_login']         = $this->session->userdata('ward_no');
                $save['uri']                = $this->uri->segment(1);
                $save['sifaris_id']         = $id;
                $current_session            = Modules::run("Settings/getCurrentSession");
                $save['session_id']         = $current_session->id;
                $save['user_id']            = $this->session->userdata('id');
                $save['user_ward']          = $this->session->userdata('ward_no');
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
                    elseif($is_muncipality == 1)
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
                redirect(base_url()."home-recommend/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."home-recommend/detail/".$id);
            }

        }
        $result = [];
        $result['reserved_darta_nos'] = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']               = "Approve";
        $this->load->view('User/userheader',$data1);
        $this->load->view('darta',$result);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function chalani_home_recommend()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_home_recommend->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("home-recommend");
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
        if(isset($_POST['submit']))
        {
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
            $chalani_no                         = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']                 = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']       = date("Y-m-d",time());
            $save['nepali_chalani_miti']        = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']             = $result->applicant_name;
            $save['ward_login']                 = $this->session->userdata('ward_no');
            $save['uri']                        = $this->uri->segment(1);
            $current_session                    = Modules::run("Settings/getCurrentSession");
            $save['session_id']                 = $current_session->id;
            $save['user_id']                    = $this->session->userdata('id');
            $save['czn_no']                     = $result->cit_no;
            $save['type']                       = 2;
            if(!empty($_POST['department']))
            {
                $save['department']     = $this->input->post('department');
            }
            if(!empty($_POST['department_other']))
            {
                $save['department_other'] = $this->input->post('department_other');
            }
            $this->Mdl_chalani->update($chalani_result->id,$save);
            $data['status']     = 3;
            if($this->Mdl_home_recommend->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("home-recommend/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("home-recommend");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_home_recommend()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_home_recommend->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("home-recommend");
        }
        if($result->status !=3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा चलानी गरिएको छैन। | ");
            redirect("home-recommend");
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri;
            $save['form_id'] = $result->form_id;
            //print_r($save['form_id']);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['form_id']    = $result_chalani->form_id;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        if($result->status == 3)
        {

          $data['chalani_no'] = $result_chalani->chalani_no;
        }


        $data['result'] = $result;
        $data1['title'] = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('home_recommend_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------
    |       Create Road Certify ( ghar bato pramanit )
    |
    ------------------------------------------------------------------------------------------------------------------*/
    public function create_road_certify()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'जग्गा धनिको नाम', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_new_address[]', 'साबिक गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('map_sheet_no[]', 'नक्सा सि.नं', 'required');
            $this->form_validation->set_rules('kitta_no[]', 'कि.नं', 'required');
            $this->form_validation->set_rules('biggha[]', 'बिग्घा', 'required');
            $this->form_validation->set_rules('kattha[]', 'कट्ठा', 'required');
            $this->form_validation->set_rules('dhur[]', 'धुर', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect("home-road-certify/create");
            }
            else
            {
                $flag = [];
                $this->db->trans_start();
                $save['nepali_date']    = $this->input->post('nepali_date');
                $save['date']           = DateNepToEng($save['nepali_date']);
                $save['applicant_name'] = $this->input->post('applicant_name');
                $save['office']         = $this->input->post('office');
                $save['state']          = $this->input->post('state');
                $save['district']       = $this->input->post('district');
                $save['local_body']     = $this->input->post('local_body');
                $save['cit_no']         = $this->input->post('cit_no');
                $save['gender_spec']    = $this->input->post('gender_spec');
                $save['con_no']         = $this->input->post('con_no');
                $save['ward']           = $this->input->post('ward');
                $save['status']         = 1;
                $save['created_at']     = date("Y-m-d h:i:sa");
                $save['ward_login']     = $this->session->userdata('ward_no');
                $current_session        = Modules::run("Settings/getCurrentSession");
                $save['session_id']     = $current_session->id;
                $save['land_type']      = $this->input->post('land_type');
                $path                   = 'assets/documents/home/road/';
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
                $save['document']           = $files;
                $save['document_type']     = $files_type;
                if($id = $this->Mdl_home_road_certify->save($save))
                {
                    $count = count($this->input->post('old_new_address'));

                    for ($i = 0; $i < $count; $i++)
                    {
                        $save1['old_new_address']   = $this->input->post('old_new_address')[$i];
                        $save1['map_sheet_no']      = $this->input->post('map_sheet_no')[$i];
                        $save1['kitta_no']          = $this->input->post('kitta_no')[$i];
                        $save1['biggha']            = $this->input->post('biggha')[$i];
                        $save1['kattha']            = $this->input->post('kattha')[$i];
                        $save1['dhur']              = $this->input->post('dhur')[$i];
                        $save1['land_area_type']    = $this->input->post('land_area_type')[$i];
                        if($_POST['land_type'] == "hill")
                        {
                            $save1['paisa']         = $this->input->post('paisa')[$i];
                        }
                        else
                        {
                            $save1['paisa']         = 0;
                        }
                        $save1['home']              = $this->input->post('home')[$i];
                        $save1['darta_id']          = $id;
                        $save1['created_at']     = date("Y-m-d h:i:sa");
                        if($this->input->post('home')[$i] == 1)
                        {
                            $save1['home_type'] = $this->input->post('home_type_'.$i);
                            $save1['estimated_cost'] = $this->input->post('estimated_cost_'.$i);
                        }
                        $save1['road'] = $this->input->post('road')[$i];
                        if($this->input->post('road')[$i] == 1)
                        {
                            $save1['road_type'] = $this->input->post('road_type_'.$i);
                        }
                        $save1['description']       = isset($_POST['description'][$i]) ? $this->input->post('description')[$i] : '';

                        if($this->Mdl_home_road_certify_land->save($save1))
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
                        redirect("home-road-certify/create");
                    }
                    else
                    {
                          $chalani['darta_id']   = $id;
                          $chalani['type']       = 2;
                          $chalani['form_id']    = $form['form_id'] = $this->genFormId();
                          $this->Mdl_chalani->save($chalani);
                          $this->Mdl_home_road_certify->update($id,$form);
                          $this->db->trans_complete();
                          $this->session->set_flashdata('msg', "सिफारिस पेश गर्न सफल");
                          redirect("home-road-certify/detail/".$id);
                    }
                }
                else
                {
                    $this->session->set_flashdata('err_msg', "समस्या आयो");
                    redirect("home-road-certify/create");
                }
            }
        }
        $data['default']        = getDefault();
        $data['offices']        = $this->Mdl_office->getAll();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']      = $this->Mdl_oldnew_address->getAll();
        $data['road_types']     = $this->Mdl_road_type->getAll();
        $data['home_types']     = $this->Mdl_home_type->getAll();
        $data['land_types']     = $this->Mdl_land_type->getAll();
        $patra_url              = $this->uri->segment(1);
        $patra                  = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']       = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);
        $data1['title']         = "नया | घर बाटो प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('home_road_certify',$data);
        $this->load->view('User/footer');

    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function details_road_certify()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("home-road-certify");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_home_road_certify->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("home-road-certify");
        }
        $data['land_details']   = $this->Mdl_home_road_certify_land->getByDartaId($id);
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['form_id']    = $result_chalani->form_id;
        if($result->status == 3)
        {
          $data['chalani_no'] = $result_chalani->chalani_no;
        }
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        if($this->session->userdata('is_muncipality') == 1 ) {
           $data['workers'] = $this->Mdl_user->getByDepartment($this->session->userdata('department'));
           $data['department'] = $this->Mdl_department->getById($this->session->userdata('department'));
        } else {
            $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        }
      
        $data1['title']         = "आबेदकको विवरण | घर बाटो प्रमाणित";
        $data['offices']    = $this->Mdl_office->getAll();
       
        $this->load->view('User/header',$data1);
        $this->load->view('home_road_certify_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_road_certify()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("home-road-certify");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_home_road_certify->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"डेटा भेटिएन | ");
            redirect("home-road-certify");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("home-road-certify");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('office', 'कार्यालय', 'required');
            $this->form_validation->set_rules('applicant_name', 'जग्गा धनिको नाम', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_new_address[]', 'साबिक गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('map_sheet_no[]', 'नक्सा सि.नं', 'required');
            $this->form_validation->set_rules('kitta_no[]', 'कि.नं', 'required');
            $this->form_validation->set_rules('biggha[]', 'बिग्घा', 'required');
            $this->form_validation->set_rules('kattha[]', 'कट्ठा', 'required');
            $this->form_validation->set_rules('dhur[]', 'धुर', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect("home-road-certify/edit".$id);
            }
            else
            {
                $flag = [];
               $this->db->trans_start();
                $save['nepali_date']    = $this->input->post('nepali_date');
                $save['date']           = DateNepToEng($save['nepali_date']);
                $save['applicant_name'] = $this->input->post('applicant_name');
                $save['office']         = $this->input->post('office');
                $save['state']          = $this->input->post('state');
                $save['district']       = $this->input->post('district');
                $save['local_body']     = $this->input->post('local_body');
                $save['ward']           = $this->input->post('ward');
                $save['status']         = 1;

                $path               = 'assets/documents/home/road/';
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
                    $save['document']           = $files;
                    $save['document_type']     = $files_type;
                }
                if($this->Mdl_home_road_certify->update($id,$save))
                {
                    //---------Deleting old record and saving new one----
                    $this->Mdl_home_road_certify_land->deleteByDartaId($id);

                    $count = count($this->input->post('old_new_address'));

                    for ($i = 0; $i < $count; $i++)
                    {
                        $save1['old_new_address']   = $this->input->post('old_new_address')[$i];
                        $save1['map_sheet_no']      = $this->input->post('map_sheet_no')[$i];
                        $save1['kitta_no']          = $this->input->post('kitta_no')[$i];
                        $save1['biggha']            = $this->input->post('biggha')[$i];
                        $save1['kattha']            = $this->input->post('kattha')[$i];
                        $save1['dhur']              = $this->input->post('dhur')[$i];
                        $save1['home']              = $this->input->post('home')[$i];
                        $save1['darta_id']          = $id;
                        $save1['created_at']        = date("Y-m-d h:i:sa");
                        if($this->input->post('home')[$i] == 1)
                        {
                            $save1['home_type']         = $this->input->post('home_type_'.$i);
                            $save1['estimated_cost']    = $this->input->post('estimated_cost_'.$i);
                        }
                        else
                        {
                            $save1['home_type']         = 0;
                            $save1['estimated_cost']    = 0;
                        }
                        $save1['road'] = $this->input->post('road')[$i];
                        if($this->input->post('road')[$i] == 1)
                        {
                            $save1['road_type']     = $this->input->post('road_type_'.$i);
                        }
                        else
                        {
                            $save1['road_type']     = 0;
                        }
                        $save1['description']       = isset($_POST['description'][$i]) ? $this->input->post('description')[$i] : '';

                        if($this->Mdl_home_road_certify_land->save($save1))
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
                        redirect("home-road-certify/edit/".$id);
                    }
                    else
                    {
                        $this->db->trans_complete();
                        $this->session->set_flashdata('msg', "सिफारिस सम्पादन गर्न सफल");
                    }
                    redirect("home-road-certify/detail/".$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg', "समस्या आयो");
                    redirect("home-road-certify/edit/".$id);
                }

            }
        }
        if(!empty($result->document))
        {
            $documents          = explode("+",$result->document);
        } else {
            $documents          = "";
        }
        $data['default']        = getDefault();
        $data['document']       = $documents;
        $data['offices']        = $this->Mdl_office->getAll();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']      = $this->Mdl_oldnew_address->getAll();
        $data['road_types']     = $this->Mdl_road_type->getAll();
        $data['home_types']     = $this->Mdl_home_type->getAll();
        $data['land_types']     = $this->Mdl_land_type->getAll();
        //pp($data['land_types']);
       //pp($data['home_types']);
        $data['land_details']   = $this->Mdl_home_road_certify_land->getByDartaId($id);
        $patra_url              = $this->uri->segment(1);
        $patra                  = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']       = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title']         = "सम्पादन | घर बाटो प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('home_road_certify',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_road_certify()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("home-road-certify");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_home_road_certify->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("home-road-certify");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("home-road-certify/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("home-road-certify/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."home-road-certify/darta/".$id);
            // }
            $filename = "";
            if(!empty($_FILES['documents']['name'])) {
                $path  = "assets/documents/home/road";
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
            }
            $data['status']             = 2;
            $data['darta_documents']    = $filename;
            if($this->Mdl_home_road_certify->update($id,$data))
            {
                $save['type']               = 2;
                $save['applicant_name']     = $result->applicant_name;
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
                redirect(base_url()."home-road-certify/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."home-road-certify/detail/".$id);
            }

        }
        $result = [];
        $ward_login = $this->session->userdata('ward_no');
        $result['reserved_darta_nos']  = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('darta',$result);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function chalani_road_certify()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_home_road_certify->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("home-road-certify");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("home-road-certify/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("home-road-certify/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $chalani_result         = $this->Mdl_chalani->getByDartaId($id,2);
            //pp ($chalani_result);
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
            //pp ("$chalani_no");
            $save['chalani_no']     = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti'] = date("Y-m-d",time());
            $save['nepali_chalani_miti']  = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']       = $result->applicant_name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']            = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $save['type']               = 2;
            $save['czn_no']                     = $result->cit_no;
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
            if($this->Mdl_home_road_certify->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("home-road-certify/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("home-road-certify");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_road_certify()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("home-road-certify");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_home_road_certify->getById($id);
        //pp($data['result']);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("home-road-certify");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("home-road-certify/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri;
            $save['form_id'] = $result->form_id;
            $save['office_id'] = $_POST['office_id'];
            $save['worker_id'] = $_POST['ward_worker'];
           // print_r($save); exit;
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
        $data['print_office']           = $this->Mdl_office->getById($_POST['office_id']);
        
        if($this->session->userdata('is_muncipality') == 1 ) {
           $data['ward_worker']         = $this->Mdl_user->getById($_POST['ward_worker']);
           $data['department']          = $this->Mdl_department->getById($this->session->userdata('department'));
        } else {
           $data['ward_worker']         = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        }
        $data['land_details']           = $this->Mdl_home_road_certify_land->getByDartaId($id);
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        //$data['chalani_result']         = $result_chalani     = $this->Mdl_chalani->getByDartaId($result->id,2);
        $data['form_id']                = $result_chalani->form_id;
        $data['chalani_no']             = $result_chalani->chalani_no;
        $data['user']                   = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']                 = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('home_road_certify_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_road_certify()
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
                    $result         = $this->Mdl_home_road_certify->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_home_road_certify->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_home_road_certify->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."home-road-certify");
                    }
                    $start_date = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date   = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_home_road_certify->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_home_road_certify->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_home_road_certify->getByStatus(1,$ward_login);
            }
        }
        else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_home_road_certify->getTableName();
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
        $data1['title']     = "घर बाटो प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('home_road_certifications',$data);
        $this->load->view('User/footer');

    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getRoadCertifyHTML()
    {
        $id = $_POST['count'];
        $land_type = $_POST['land_type'];
        //print_r($land_types);
        $display = '';
        if($land_type=="terai")
        {
            $display = 'style="display:none;"';
        }
        $addresses      = $this->Mdl_oldnew_address->getAll();
        $road_types     = $this->Mdl_road_type->getAll();
        $home_types     = $this->Mdl_home_type->getAll();
        $land_types     = $this->Mdl_land_type->getAll();
        //$land_types     = $this->Mdl_home_road_certify->getAll();
        
        $html = '<tr class="item" id="item-'.$id.'">
                        <td>
                        <select name="old_new_address[]" class=" select2 old-place" id="old_new_address_'.$id.'">
                            <option value="" selected>छान्नुहोस्</option>';
                        foreach($addresses as $address)
                        {
        $html .=           '<option value="'.$address->id.'">'.$address->name.'</option>';
                        }

        $html .=        '</select>
                        </td>
                        <td>
                            <input type="text" id="new_place_'.$id.'" disabled class="new-name">
                        </td>
        
                        <td>
                        <select name="land_area_type[]" class=" select2 old-place" id="land_area_type_'.$id.'">
                            <option value="" selected>छान्नुहोस्</option>';
                        foreach($land_types as $type)
                        {
        $html .=           '<option value="'.$type->id.'">'.$type->name.'</option>';
                        }

        $html .=        '</select>
                        </td>
                        <td>
                            <input type="text" name="map_sheet_no[]" class=" map-sheet-no" id="map_sheet_no_'.$id.'" maxlength="32" />
                        </td>
                        <td>
                            <input type="text" name="kitta_no[]" class="kitta-no" id="kitta_no'.$id.'" maxlength="32" />
                        </td>
                        <td>
                            <input type="number" name="biggha[]" value="0" class="biggha" min="0" id="biggha'.$id.'" />
                        </td>
                        <td>
                            <input type="number" name="kattha[]" value="0" class="kattha" min="0" max="20" id="kattha'.$id.'" />
                        </td>
                        <td>
                            <input type="number" name="dhur[]" value="0" class="dhur" min="0" max="20" id="dhur'.$id.'" />
                        </td>
                        <td '. $display .' >
                            <input type="number" name="paisa[]" value="0" class="formset-field paisa" id="paisa-'.$id.'" min="0" max="20" style="width:97%"/>
                        </td>
                        <td>
                            <input type="checkbox" value="1" class="home-checkbox" id="home_check_'.$id.'" />
                            <input type="hidden" name="home[]" value="1" id="home_'.$id.'" />
                        </td>
                        <td>
                            <select name="home_type_'.$id.'" class="home-type" disabled id="home_type_'.$id.'">
                                <option value="" selected>छान्नुहोस्</option>';
                        foreach($home_types as $type)
                        {
            $html .=                '<option value = "'.$type->id.'" >'.$type->name.'</option >';
                        }
            $html .=    '</select>
                        </td>
                        <td>
                            <input type="number" name="estimated_cost_'.$id.'" class="" disabled  id="estimated_cost_'.$id.'" />
                        </td>
                        <td>
                            <input type="checkbox" value="1" class="road-checkbox" id="road_check_'.$id.'" />
                            <input type="hidden" name="road[]"  id="road_'.$id.'" />
                        </td>
                        <td>
                            <select name="road_type_'.$id.'" class="road-type" disabled id="road_type_'.$id.'">
                                <option value="" selected>छान्नुहोस्</option>';

                                  foreach($road_types as $type)
                        {
        $html .=                '<option value = "'.$type->id.'" >'.$type->name.'</option >';
                        }

        $html .=            '</select>
                        </td>
                        <td>
                                <textarea name="description[]" rows="2" class="formset-field description" cols="10" maxlength="250" id="description[]"></textarea>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove"
                                    id="remove-'.$id.'">
                                <input type="hidden" name="details-0-id" class="formset-field" id="id_details-'.$id.'-id" />
                                <i class="fa fa-minus"></i>
                            </button>
                        </td>
                    </tr>';
        $res = [];
        $res['html'] = $html;
        echo json_encode($res);exit;
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getRoadDocumentHTML()
    {
        $patra_id = $_POST['patra_id'];
        $id = $_POST['count'];
        $documents = $this->Mdl_document->getByPatraId($patra_id);
        $html = '<div class="mb-3 documents" id="doc_div_'.$id.'">
                        <input type="file" name="documents[]" id="documents_'.$id.'" />
                        <select name="documents_type[]" id="documents_type_'.$id.'">
                            <option value="" selected>प्रकार छान्नुहोस्</option>';
                        if(!empty($documents)):
                            foreach($documents as $document):
        $html .=            '<option value="'.$document->id.'">'.$document->name.'</option>';
                            endforeach;
                        endif;
        $html .=         '</select>
                        <button type="button" class="float-right btn btn-danger delete-form doc_remove" id="documents_remove_'.$id.'" >
                            <i class="fa fa-times"></i>
                        </button>
                </div>';
        $res = [];
        $res['html']  = $html;
        echo json_encode($res);
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getHaalAddress()
     {
         $sabik = $_POST['sabik'];
         $oldnew = Modules::run("Settings/getOldNewAddress",$sabik);
         $res = [];
         $res['haal'] = $oldnew->new_name;
         echo json_encode($res);exit;

     }
    /*|--------------------------------------------------------------------------------------------*/
    /*| Ghar Jagga Namsari */
    /*-----------------------------------------------------------------------------------------------*/
    public function create_ghar_jagga_namsari()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'निवेदकको नाम', 'required');
            $this->form_validation->set_rules('applicant_relation', 'नाता', 'required');
            $this->form_validation->set_rules('owner_name', 'जग्गा धनीको नाम', 'required');
            $this->form_validation->set_rules('nepali_dod', 'मृत्यु भएको मिति', 'required');

            // $this->form_validation->set_rules('hakdar_ko_name[]', 'हकदारको नाम', 'required');
            // $this->form_validation->set_rules('hakdar_ko_nata[]', 'मृतक संगको नाता ', 'required');
            // $this->form_validation->set_rules('father_husband_name[]', 'बुवा / पिताको नाम', 'required');
            // $this->form_validation->set_rules('citizenship_no[]', 'नागरिकता नं', 'required');
            // // $this->form_validation->set_rules('home_no', 'घर नं.', 'required');
            // $this->form_validation->set_rules('kitta[]', 'कित्ता', 'required');
            // $this->form_validation->set_rules('biggha[]', 'बिग्घा', 'required');
            // $this->form_validation->set_rules('kattha[]', 'कट्ठा', 'required');
            // $this->form_validation->set_rules('dhur[]', 'धुर', 'required');
            // $this->form_validation->set_rules('map_sheet_no[]', 'नक्शा सिट नं.', 'required');
            // $this->form_validation->set_rules('kitta_no[]', 'कित्ता नं.', 'required');
            // $this->form_validation->set_rules('road_name[]', 'बाटोको नाम', 'required');
            // $this->form_validation->set_rules('road_type[]', 'बाटोको प्रकार', 'required');
            // $this->form_validation->set_rules('ward[]', 'वडा नं', 'required');
            if ($this->form_validation->run() == FALSE) {
                // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('ghar-jagga-namsari/create');
                //pp(validation_errors());

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/home/ghar_jagga_namsari/';
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
                //$data['']

                $data['status']                 = 1;
                $data['documents']              = $file;
                $data['date']                   = $this->input->post('nepali_date');
                $data['english_dod']            = DateNepToEng($this->input->post('nepali_dod'));
                $data['created_at']             = date("Y-m-d h:i:sa",time());
                $data['ward_login']             = $this->session->userdata('ward_no');
                $data['form_id']                = $this->genFormId();
                $data['gender_spec']            = $this->input->post('gender_spec');
                $data['con_no']                 = $this->input->post('con_no');
                $data['applicant_name']         = $this->input->post('applicant_name');
                $data['applicant_relation']     = $this->input->post('applicant_relation');
                $data['cit_no']                 = $this->input->post('cit_no');
                $data['owner_name']             = $this->input->post('owner_name');
                $data['map_sheet_no']             = $this->input->post('map_sheet_no')[$i];
                $data['kitta_no']             = $this->input->post('kitta_no')[$i];
                $data['nepali_date']            = $this->input->post('nepali_date');
                $data['nepali_dod']             = $this->input->post('nepali_dod');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $data['session_id']             = $current_session->id;
                if($id = $this->Mdl_ghar_jagga_namsari->save($data))
                {
                    //pp($id);
                    for($i=0;$i<count($_POST['hakdar_ko_name']);$i++)
                    {
                        $data1['hakdar_ko_name']        = $this->input->post('hakdar_ko_name')[$i];
                        $data1['hakdar_ko_nata']        = $this->input->post('hakdar_ko_nata')[$i];
                        $data1['father_husband_name']   = $this->input->post('father_husband_name')[$i];
                        $data1['citizenship_no']        = $this->input->post('citizenship_no')[$i];
                        $data1['entry_id']              = $id;
                        $data1['form_id']               = '';
                       // pp($data['form_id']);
                        $this->Mdl_ghar_jagga_namsari->saveHakdar($data1);
                    }

                    for($i=0;$i<count($_POST['kitta']);$i++)
                    {
                        // pp($id);
                        $data2['map_sheet_no']      = $this->input->post('map_sheet_no')[$i];
                        $data2['kitta']             = $this->input->post('kitta')[$i];
                        $data2['home_no']           = $this->input->post('home_no')[$i];
                        $data2['biggha']            = $this->input->post('biggha')[$i];
                        $data2['kattha']            = $this->input->post('kattha')[$i];
                        $data2['paisa']             = $this->input->post('paisa')[$i];
                        $data2['dhur']              = $this->input->post('dhur')[$i];
                        $data2['road_name']         = $this->input->post('road_name')[$i];
                        $data2['road_type']         = $this->input->post('road_type')[$i];
                        $data2['ward']              = $this->input->post('ward')[$i];
                        $data2['entry_id']          = $id;
                        $data2['form_id']           = '';
                        $this->Mdl_ghar_jagga_namsari->saveJaggaWiwarn($data2);
                    }

                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 3;
                    $save['form_id']       =   $chalani['form_id']    = $this->genFormId();
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_ghar_jagga_namsari->update($id,$save);
                    $this->session->set_flashdata('msg',"घर जग्गा नामसारी पेश गर्न सफल |");
                    redirect('ghar-jagga-namsari/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('ghar-jagga-namsari/create');
                }

            }
        }
        $data['default']        = getDefault();
        $data['relations']  = $this->Mdl_relation->getAll();
        $data['wards']      = $this->Mdl_ward->getAll();
        $data['roads']      = $this->Mdl_road_type->getAll();


        $data1['title']     = "नया | घर जग्गा नामसारी" ;
        $this->load->view('User/header',$data1);
        $this->load->view('ghar_jagga_namsari',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_ghar_jagga_namsari()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("ghar-jagga-namsari");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_ghar_jagga_namsari->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("ghar-jagga-namsari");
        }
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['hakdar']       = $this->Mdl_ghar_jagga_namsari->getAllHakdar($id);
        $data['jaggawiwaran']       = $this->Mdl_ghar_jagga_namsari->getAllJaggaWiwarn($id);

        //getAllHakdar
        //getAllJaggaWiwarn
        $data['form_id']    = $chalani_result->form_id;
        $data['offices']    = $this->Mdl_office->getAll();
        $data1['title']     = "नया | घर जग्गा नामसारी" ;
        $this->load->view('User/header',$data1);
        $this->load->view('ghar_jagga_namsari_detail',$data);
        $this->load->view('User/footer');
    }
    public function edit_ghar_jagga_namsari()
    {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("ghar-jagga-namsari");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_ghar_jagga_namsari->getById($id);
        // echo "<pre>";
        // print_r($result);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("ghar-jagga-namsari");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("ghar-jagga-namsari");
        }
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'निवेदकको नाम', 'required');
            $this->form_validation->set_rules('applicant_relation', 'नाता', 'required');
            $this->form_validation->set_rules('owner_name', 'जग्गा धनीको नाम', 'required');
            $this->form_validation->set_rules('nepali_dod', 'मृत्यु भएको मिति', 'required');

            // $this->form_validation->set_rules('hakdar_ko_name', 'हकदारको नाम', 'required');
            // $this->form_validation->set_rules('hakdar_ko_nata', 'मृतक संगको नाता ', 'required');
            // $this->form_validation->set_rules('father_husband_name', 'बुवा / पिताको नाम', 'required');
            // $this->form_validation->set_rules('citizenship_no', 'नागरिकता नं', 'required');
            // $this->form_validation->set_rules('home_no', 'घर नं.', 'required');
            // $this->form_validation->set_rules('kitta', 'कित्ता', 'required');
            // $this->form_validation->set_rules('biggha', 'बिग्घा', 'required');
            // $this->form_validation->set_rules('kattha', 'कट्ठा', 'required');
            // $this->form_validation->set_rules('dhur', 'धुर', 'required');
            // $this->form_validation->set_rules('map_sheet_no', 'नक्शा सिट नं.', 'required');
            // $this->form_validation->set_rules('kitta_no', 'कित्ता नं.', 'required');
            // $this->form_validation->set_rules('road_name', 'बाटोको नाम', 'required');
            // $this->form_validation->set_rules('road_type', 'बाटोको प्रकार', 'required');
            // $this->form_validation->set_rules('ward', 'वडा नं', 'required');
            if ($this->form_validation->run() == FALSE) {
                // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('ghar-jagga-namsari/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/home/ghar_jagga_namsari/';
                if (!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                $count  = count($_FILES['documents']['name']);
                $file = "";
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
                                $file .= $file_name;
                            }
                            else
                            {
                                $file .= $file_name."+";
                            }
                        }
                    }
                    $data['documents']     = $file;
                }
                // $_POST['date']      = $this->input->post('nepali_date');
                // $_POST['english_dod']   = DateNepToEng($this->input->post('nepali_dod'));
               // $data['status']                 = 1;
                //$data['documents']              = $file;

                $datau['date']                   = $this->input->post('nepali_date');
                $datau['english_dod']            = DateNepToEng($this->input->post('nepali_dod'));
                //$data['created_at']             = date("Y-m-d h:i:sa",time());
                //$data['ward_login']             = $this->session->userdata('ward_no');
                //$data['form_id']                = $this->genFormId();
                $datau['gender_spec']            = $this->input->post('gender_spec');
                $datau['con_no']                 = $this->input->post('con_no');
                $datau['applicant_name']         = $this->input->post('applicant_name');
                $datau['applicant_relation']     = $this->input->post('applicant_relation');
                $datau['cit_no']                 = $this->input->post('cit_no');
                $datau['owner_name']             = $this->input->post('owner_name');
                $datau['nepali_dod']             = $this->input->post('nepali_dod');
              //  pp($datau);
                // $current_session                = Modules::run("Settings/getCurrentSession");
                // $datau['session_id']             = $current_session->id;

                if($this->Mdl_ghar_jagga_namsari->update($id,$datau))
                {
                    /*-----------------------------------------------------
                    ------------------------------------------------------*/
                    $hakdar_id             = $this->input->post('hakdar_id');
                    $hakdar_ko_name        = $this->input->post('hakdar_ko_name');
                    $hakdar_ko_nata        = $this->input->post('hakdar_ko_nata');
                    $father_husband_name   = $this->input->post('father_husband_name');
                    $citizenship_no        = $this->input->post('citizenship_no');
                    $hakdar_updates        = array();
                    if(!empty($hakdar_ko_name)) {
                        foreach ($hakdar_ko_name as $key => $indexv) {
                            $hakdar_updates[]    = array(
                                'id'                    => $hakdar_id[$key],
                                'hakdar_ko_name'        => $hakdar_ko_name[$key],
                                'hakdar_ko_nata'        => $hakdar_ko_nata[$key],
                                'father_husband_name'   => $father_husband_name[$key],
                                'citizenship_no'        => $citizenship_no[$key],
                            );
                        }
                        $this->Mdl_ghar_jagga_namsari->updateHakdar($hakdar_id,$hakdar_updates);
                    }
                    $hakdar_ko_name_new        = $this->input->post('hakdar_ko_name_new');
                    $hakdar_ko_nata_new        = $this->input->post('hakdar_ko_nata_new');
                    $father_husband_name_new   = $this->input->post('father_husband_name_new');
                    $citizenship_no_new        = $this->input->post('citizenship_no_new');
                    $hakdar_new          = array();
                    if(!empty($hakdar_ko_name_new)) {
                        foreach ($hakdar_ko_name_new as $key => $indexv) {
                            $hakdar_new[]    = array(
                                'entry_id'              => $id,
                                'hakdar_ko_name'        => $hakdar_ko_name_new[$key],
                                'hakdar_ko_nata'        => $hakdar_ko_nata_new[$key],
                                'father_husband_name'   => $father_husband_name_new[$key],
                                'citizenship_no'        => $citizenship_no_new[$key],
                            );
                        }
                        $this->Mdl_ghar_jagga_namsari->savehakdars($hakdar_new);
                    }

                    /*-----------------------------------------------------
                    ------------------------------------------------------*/

                    $jagga_id           = $this->input->post('jagga_id');
                    $map_sheet_no       = $this->input->post('map_sheet_no');
                    $kitta              = $this->input->post('kitta');
                    $home_no            = $this->input->post('home_no');
                    $biggha             = $this->input->post('biggha');
                    $kattha             = $this->input->post('kattha');
                    $paisa              = $this->input->post('paisa');
                    $dhur               = $this->input->post('dhur');
                    $road_name          = $this->input->post('road_name');
                    $road_type          = $this->input->post('road_type');
                    $ward               = $this->input->post('ward');

                    $jagga_updates        = array();
                    if(!empty($map_sheet_no)) {
                        foreach ($map_sheet_no as $key => $indexv) {
                            $jagga_updates[]    = array(
                                'id'                    => $jagga_id[$key],
                                'map_sheet_no'          => $map_sheet_no[$key],
                                'kitta'                 => $kitta[$key],
                                'home_no'               => $home_no[$key],
                                'biggha'                => $biggha[$key],
                                'kattha'                => $kattha[$key],
                                'paisa'                 => $paisa[$key],
                                'dhur'                  => $dhur[$key],
                                'road_name'             => $road_name[$key],
                                'road_type'             => $road_type[$key],
                                'ward'                  => $ward[$key],
                            );
                        }
                        $this->Mdl_ghar_jagga_namsari->updateJaggas($jagga_id,$jagga_updates);
                    }
                    $jagga_id              = $this->input->post('jagga_id');
                    $map_sheet_no_new       = $this->input->post('map_sheet_no_new');
                    $kitta_new              = $this->input->post('kitta_new');
                    $home_no_new            = $this->input->post('home_no_new');
                    $biggha_new             = $this->input->post('biggha_new');
                    $kattha_new             = $this->input->post('kattha_new');
                    $paisa_new              = $this->input->post('paisa_new');
                    $dhur_new               = $this->input->post('dhur_new');
                    $road_name_new          = $this->input->post('road_name_new');
                    $road_type_new          = $this->input->post('road_type_new');
                    $ward_new               = $this->input->post('ward_new');

                    $jaggas_new          = array();
                    if(!empty($map_sheet_no_new)) {
                        foreach ($map_sheet_no_new as $key => $indexv) {
                            $jaggas_new[]    = array(
                                'map_sheet_no'          => $map_sheet_no_new[$key],
                                'kitta'                 => $kitta_new[$key],
                                'home_no'               => $home_no_new[$key],
                                'biggha'                => $biggha_new[$key],
                                'kattha'                => $kattha_new[$key],
                                'paisa'                 => $paisa_new[$key],
                                'dhur'                  => $dhur_new[$key],
                                'road_name'             => $road_name_new[$key],
                                'road_type'             => $road_type_new[$key],
                                'ward'                  => $ward_new[$key],
                                'entry_id'              => $id,
                            );
                        }
                        $this->Mdl_ghar_jagga_namsari->saveJaggas($jaggas_new);
                    }
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('ghar-jagga-namsari/edit/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('ghar-jagga-namsari/edit/'.$id);
                }

            }
        }
        $data['hakdar']       = $this->Mdl_ghar_jagga_namsari->getAllHakdar($id);
        $data['jaggawiwaran']       = $this->Mdl_ghar_jagga_namsari->getAllJaggaWiwarn($id);
        $data['default']        = getDefault();
        $data['relations']  = $this->Mdl_relation->getAll();
        $data['wards']      = $this->Mdl_ward->getAll();
        $data['roads']      = $this->Mdl_road_type->getAll();
        $data1['title']     = "नया | घर जग्गा नामसारी" ;
        $this->load->view('User/header',$data1);
        $this->load->view('ghar_jagga_namsari_edit',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_ghar_jagga_namsari()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("ghar-jagga-namsari");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_ghar_jagga_namsari->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("ghar-jagga-namsari");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("ghar-jagga-namsari/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("ghar-jagga-namsari/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."ghar-jagga-namsari/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/home/ghar_jagga_namsari";
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
            if($this->Mdl_ghar_jagga_namsari->update($id,$data))
            {
                $save['type']               = 2;
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
                redirect(base_url()."ghar-jagga-namsari/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."ghar-jagga-namsari/detail/".$id);
            }

        }
        $result = [];
        $ward_login             = $this->session->userdata('ward_no');
        $result['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('darta',$result);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function chalani_ghar_jagga_namsari()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_ghar_jagga_namsari->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("ghar-jagga-namsari");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("ghar-jagga-namsari/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("ghar-jagga-namsari/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $chalani_result         = $this->Mdl_chalani->getByFormId($result->form_id);
            //pp($chalani_result);
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
            //pp($save['chalani_no']);
            $save['english_chalani_miti']       = date("Y-m-d",time());
            $save['nepali_chalani_miti']        = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']             = $result->applicant_name;
            $save['ward_login']                 = $this->session->userdata('ward_no');
            $save['uri']                        = $this->uri->segment(1);
            $current_session                    = Modules::run("Settings/getCurrentSession");
            $save['session_id']                 = $current_session->id;
            $save['user_id']                    = $this->session->userdata('id');
            $save['type']                       = 2;
            $save['czn_no']                     = $result->cit_no;
            if(!empty($_POST['department']))
            {
                $save['department']     = $this->input->post('department');
            }
            if(!empty($_POST['department_other']))
            {
                $save['department_other'] = $this->input->post('department_other');
            }
            //pp($save);
            $this->Mdl_chalani->update($chalani_result->id,$save);
            $data['status']         = 3;
            if($this->Mdl_ghar_jagga_namsari->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("ghar-jagga-namsari/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("ghar-jagga-namsari");
            }
        }
        $data['department']     = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_ghar_jagga_namsari()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("ghar-jagga-namsari");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_ghar_jagga_namsari->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("ghar-jagga-namsari");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("ghar-jagga-namsari/detail/".$id);
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
        $data['hakdar']       = $this->Mdl_ghar_jagga_namsari->getAllHakdar($id);
        $data['jaggawiwaran']       = $this->Mdl_ghar_jagga_namsari->getAllJaggaWiwarn($id);
        $data['form_id']                = $result_chalani->form_id;
        $data['chalani_no']             = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data['form_id']    = $result_chalani->form_id;
        $data['chalani_no'] = $result_chalani->chalani_no;

        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('ghar_jagga_namsari_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_ghar_jagga_namsari()
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
                    $result         = $this->Mdl_ghar_jagga_namsari->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_ghar_jagga_namsari->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_ghar_jagga_namsari->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."ghar-jagga-namsari");
                    }
                    $start_date = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date   = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_ghar_jagga_namsari->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_ghar_jagga_namsari->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_ghar_jagga_namsari->getByStatus(1,$ward_login);
            }
        }
        else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_ghar_jagga_namsari->getTableName();
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
        $data1['title']     = "घर जग्गा नामसारी";
        $this->load->view('User/header',$data1);
        $this->load->view('ghar_jagga_namsari_view',$data);
        $this->load->view('User/footer');

    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getGharJaggaDocumentHTML()
    {
        $id = $this->input->post('count');
        $html = '<div class="mb-3 documents" id="doc_div_'.$id.'" >
                    <input type="file" name="documents[]" id="document_'.$id.'" />

                    <button type="button" class="float-right btn btn-danger doc_remove" id="document_'.$id.'">
                        <i class="fa fa-times"></i></button>

                  </div>';
        $res = [];
        $res['html'] = $html;
        echo json_encode($res);exit;
    }

    /*-------------------------------------------------------------------------------------------------------------*/
    public function getHakdarDetails() {
        $id     = $this->input->post('count');
        $html   = '<tr><td><input type="text" name="hakdar_ko_name" class="form-control" id="id_hakdar_ko_name_'.$id.'" value="" required /></td>
                    <td>
                                                    <select name="hakdar_ko_nata" class="form-control" id="hakdar_ko_nata_'.$id.'">
                                                        <option value="">छान्नुहोस्</option>
                                                        
                                                        </select>
                                                </td>
                                                <td><input type="text" name="father_husband_name" class="form-control" id="id_father_husband_name_'.$id.'" value="" required /></td>

                                                <td><input type="text" name="citizenship_no" class="form-control" id="id_citizenship_no_'.$id.'" value="" maxlength="32" required /></td>
                                                <td>
                                                    <button type="button" id="hakdar_'.$id.'" class="btn btn-success"><i
                                                class="fa fa-plus"></i></button>
                                                    <button type="button" class="btn btn-danger hakdar_remove" id="hakdar_rm_"'.$id.'">
                                                    <i class="fa fa-times"></i></button>
                                                </td>
                    <tr>';
        $es = [];
        $res['html'] = $html;
        echo json_encode($res);
    }
    /*-------------------------------------------------------------------------------------------------------------*/
    /*|--------------------------------------------------------------------------------------------*/
    /*|                                     kitta kaat Sifaris                                      */
    /*-----------------------------------------------------------------------------------------------*/
    public function create_kitta_kat_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('owner_name', 'जग्गा धनीको नाम', 'required');
            $this->form_validation->set_rules('kittakat_area', 'जग्गा मिलन गर्नुपर्ने क्षेत्रफल', 'required');
            $this->form_validation->set_rules('direction', 'कित्ता मिलान गर्न चाहेको दिशा', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('kitta_no', 'कित्ता', 'required');
            $this->form_validation->set_rules('biggha', 'बिग्घा', 'required');
            $this->form_validation->set_rules('kattha', 'कट्ठा', 'required');
            $this->form_validation->set_rules('dhur', 'धुर', 'required');
            $this->form_validation->set_rules('map_sheet_no', 'नक्शा सिट नं.', 'required');
            $this->form_validation->set_rules('kitta_no', 'कित्ता नं.', 'required');
            $this->form_validation->set_rules('ghar_area', 'घरको जम्मा क्षेत्रफल', 'required');
            $this->form_validation->set_rules('first_floor_home_area', 'घरको भुई तल्लाको क्षेत्रफल', 'required');
            $this->form_validation->set_rules('paune_far', 'पाउने फार', 'required');
            $this->form_validation->set_rules('reason', 'सिफारिस दिन मिल्ने कारण', 'required');
            $this->form_validation->set_rules('technician_name', 'प्राबिधिकको नाम', 'required');

            if ($this->form_validation->run() == FALSE)
            {
            //                $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('kitta-kat-sifaris/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/home/kitta_kat_sifaris/';
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
                $_POST['status']            = 1;
                $_POST['documents']         = $file;
                $_POST['documents_type']    = $doc_type;
                $_POST['date']              = DateNepToEng($this->input->post('nepali_date'));
                $_POST['created_at']        = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']        = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_kitta_kat_sifaris->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 1;
                    $save['form_id']       =   $chalani['form_id']    = $this->genFormId();
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_kitta_kat_sifaris->update($id,$save);
                    $this->session->set_flashdata('msg',"कित्ताकट सिफारिस पेश गर्न सफल |");
                    redirect('kitta-kat-sifaris/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('kitta-kat-sifaris/create');
                }

            }
        }
        $data['default']        = getDefault();
        $data['offices']        = $this->Mdl_office->getAll();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']      = $this->Mdl_oldnew_address->getAll();
        $data['directions']     = $this->Mdl_direction->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title']         = "नया | कित्ताकाट सिफारिस" ;
        $this->load->view('User/header',$data1);
        $this->load->view('kitta_kat_sifaris',$data);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------*/
    public function detail_kitta_kat_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("kitta-kat-sifaris");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_kitta_kat_sifaris->getById($id);

        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("kitta-kat-sifaris");
        }
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['print_detail']   = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['form_id']        = $result->form_id;
        $data['offices']        = $this->Mdl_office->getAll();
        $data1['title']         = "आवेदकको विवरण | घर जग्गा नामसारी" ;
        $this->load->view('User/header',$data1);
        $this->load->view('kitta_kat_sifaris_detail',$data);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------*/

    public function edit_kitta_kat_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("kitta-kat-sifaris");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_kitta_kat_sifaris->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("kitta-kat-sifaris");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("kitta-kat-sifaris");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('owner_name', 'जग्गा धनीको नाम', 'required');
            $this->form_validation->set_rules('kittakat_area', 'जग्गा मिलन गर्नुपर्ने क्षेत्रफल', 'required');
            $this->form_validation->set_rules('direction', 'कित्ता मिलान गर्न चाहेको दिशा', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('kitta_no', 'कित्ता', 'required');
            $this->form_validation->set_rules('biggha', 'बिग्घा', 'required');
            $this->form_validation->set_rules('kattha', 'कट्ठा', 'required');
            $this->form_validation->set_rules('dhur', 'धुर', 'required');
            $this->form_validation->set_rules('map_sheet_no', 'नक्शा सिट नं.', 'required');
            $this->form_validation->set_rules('kitta_no', 'कित्ता नं.', 'required');
            $this->form_validation->set_rules('ghar_area', 'घरको जम्मा क्षेत्रफल', 'required');
            $this->form_validation->set_rules('first_floor_home_area', 'घरको भुई तल्लाको क्षेत्रफल', 'required');
            $this->form_validation->set_rules('paune_far', 'पाउने फार', 'required');
            $this->form_validation->set_rules('reason', 'सिफारिस दिन मिल्ने कारण', 'required');
            $this->form_validation->set_rules('technician_name', 'प्राबिधिकको नाम', 'required');

            if ($this->form_validation->run() == FALSE)
            {
            //                $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('kitta-kat-sifaris/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/home/kitta_kat_sifaris/';
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
                    $_POST['documents']         = $file;
                    $_POST['documents_type']    = $doc_type;
                }
                else
                {
                    $_POST['documents_type']    = $result->documents_type;
                }
                $_POST['status']            = 1;
                $_POST['date']              = DateNepToEng($this->input->post('nepali_date'));
                if($this->Mdl_kitta_kat_sifaris->update($id, $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"कित्ताकट सिफारिस सम्पादन गर्न सफल |");
                    redirect('kitta-kat-sifaris/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('kitta-kat-sifaris/edit/'.$id);
                }

            }
        }
        $data['default']        = getDefault();
        $data['offices']        = $this->Mdl_office->getAll();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']      = $this->Mdl_oldnew_address->getAll();
        $data['directions']     = $this->Mdl_direction->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title']         = "नया | कित्ताकाट सिफारिस" ;
        $this->load->view('User/header',$data1);
        $this->load->view('kitta_kat_sifaris',$data);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------*/

    public function darta_kitta_kat_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("kitta-kat-sifaris");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_kitta_kat_sifaris->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("kitta-kat-sifaris");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("kitta-kat-sifaris/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("kitta-kat-sifaris/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."kitta-kat-sifaris/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/home/kitta_kat_sifaris";
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
            if($this->Mdl_kitta_kat_sifaris->update($id,$data))
            {
                $save['type']               = 2;
                $save['applicant_name']     = $result->owner_name;
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
                redirect(base_url()."kitta-kat-sifaris/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."kitta-kat-sifaris/detail/".$id);
            }

        }
        $result = [];
        $ward_login             = $this->session->userdata('ward_no');
        $result['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('darta',$result);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------*/
    public function chalani_kitta_kat_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_kitta_kat_sifaris->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("kitta-kat-sifaris");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("kitta-kat-sifaris/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("kitta-kat-sifaris/detail/".$id);
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
            $save['applicant_name']       = $result->owner_name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']            = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $save['type']               = 2;
            $save['czn_no']                     = $result->cit_no;
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
            if($this->Mdl_kitta_kat_sifaris->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("kitta-kat-sifaris/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("kitta-kat-sifaris");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('chalani',$data);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------*/
    public function print_kitta_kat_sifaris()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("kitta-kat-sifaris");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_kitta_kat_sifaris->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("kitta-kat-sifaris");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("kitta-kat-sifaris/detail/".$id);
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
        $data['print_office']           = $this->Mdl_office->getById($_POST['office_id']);
        $data['ward_worker']            = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $data['chalani_result']         = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no']             = $result_chalani->chalani_no;
        $data['user']                   = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']                 = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('kitta_kat_sifaris_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('footer');
        $this->load->view('User/footer');
    }
    public function view_kitta_kat_sifaris()
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
                    $result         = $this->Mdl_kitta_kat_sifaris->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_kitta_kat_sifaris->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_kitta_kat_sifaris->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."kitta-kat-sifaris");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_kitta_kat_sifaris->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_kitta_kat_sifaris->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_kitta_kat_sifaris->getByStatus(1,$ward_login);
            }
        }
        else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_kitta_kat_sifaris->getTableName();
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
        $data1['title']     = "कित्ताकाट सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('kitta_kat_sifaris_view',$data);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------- Generate Form Id -----------------------------------------*/
    public function genFormId(){
        $form_id            = random_string("numeric",10);
        if($this->Mdl_chalani->getByFormId($form_id) != FALSE)
        {
          genFormId();
        }
        return $form_id;
    }
    /*-----------------------------------------------------------------------------------------*/
    /*----------------------------- Get Form Id -----------------------------------------*/
    public function getFormId($id,$type)
    {
        $result   = $this->Mdl_chalani->getByDartaId($id,$type);
        return $result->form_id;
    }
    /*----------------------------- Sambodhan JSON -----------------------------------------*/
    public function getSambodhanJSON()
    {
        $offices = $this->Mdl_office->getAll();
        $html = '<div class="col-md-3">
                    <div class="row" style="margin-bottom:10px;">
                        <input type="text" id="office_sambodhan" class="form-control">
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <select name="office_id" id="office_id" class="select2 form-control">
                            <option value="">छान्नुहोस्</option>';
                foreach($offices as $office):
        $html .= '<option value="'.$office->id.'">'.$office->name.'</option>';
                endforeach;

        $html .=    '    </select>
                    </div>
                    <div class="row" style="margin-bottom:10px;">
                        <input type="text" id="office_address" class="form-control">
                    </div>
                </div>';
        $res['html'] = $html;
        echo json_encode($res);exit;
    }
    /*----------------------------- Sambodhan & Address JSON -----------------------------------------*/
    public function getSambodhanAddressJSON()
    {
        $this_office = $this->Mdl_office->getById($_POST['office_id']);
        if($this_office != FALSE)
        {
            echo json_encode($this_office);exit;
        }
        else {
            echo '0';
            exit;
        }
    }

    public function RemoveHakdar($id, $main_id) {
        if(!empty($id)) {
            $result = $this->Mdl_ghar_jagga_namsari->RemoveHakdar($id);
            if($result) {
                 $this->session->set_flashdata('msg'," Success");
                redirect('ghar-jagga-namsari/edit/'.$main_id);
            } else {
                $this->session->set_flashdata('msg'," Success");
                redirect('ghar-jagga-namsari/edit/'.$main_id);
            }
        }
    }

    public function RemoveJagga($id, $main_id) {
        if(!empty($id)) {
            $result = $this->Mdl_ghar_jagga_namsari->RemoveJagga($id);
            if($result) {
                 $this->session->set_flashdata('msg'," Success");
                redirect('ghar-jagga-namsari/edit/'.$main_id);
            } else {
                $this->session->set_flashdata('msg'," Success");
                redirect('ghar-jagga-namsari/edit/'.$main_id);
            }
        }
    }
}
