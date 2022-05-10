<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Land extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_lalpurja_pratilipi');
        $this->load->model('Mdl_batokayam');
        $this->load->model('Mdl_purjamagharkayam');
        $this->load->model('Mdl_mohi_lagat_katta');
        $this->load->model('Mdl_charkilla');
        $this->load->model('Mdl_charkilla_details');
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
        $this->load->model('Settings/Mdl_document');
        $this->load->model('Settings/Mdl_patra_item');
        $this->load->model('Settings/Mdl_session');
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
        $data['title'] = "Land | Dashboard";
        $data['lalpurja_pratilipi']     = $this->Mdl_user->getTotalCount('lalpurja_pratilipi');
        $data['bato_kayam']             = $this->Mdl_user->getTotalCount('bato_kayam');
        $data['purjama_ghar_kayam']     = $this->Mdl_user->getTotalCount('ghar_kayam');
        $data['char_killa']    = $this->Mdl_user->getTotalCount('char_killa');
        $data['mohi_lagat_katta']     = $this->Mdl_user->getTotalCount('mohi_lagat');
        $this->load->view('User/header',$data);
        $this->load->view('dashboard');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*-------    Char Killa Starts
    /*------------------------------------------------------------------------------------------------------------------*/

    public function create_char_killa()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('applicant_name', '  जग्गाधनीको नाम ', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('char-killa/create');
            }
            else
            {
                unset($_POST['submit']);
                $path ='assets/documents/land/char_killa/';
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
                $data['applicant_name']    = $this->input->post('applicant_name');
                $data['district']          = $this->input->post('district');
                $data['local_body']        = $this->input->post('local_body');
                $data['state']             = $this->input->post('state');
                $data['s_state']           = $this->input->post('s_state');
                $data['s_local_body']      = $this->input->post('s_local_body');
                $data['s_district']        = $this->input->post('s_district');
                $data['s_ward']            = $this->input->post('s_ward');
                $data['cit_no']            = $this->input->post('cit_no');
                $data['con_no']            = $this->input->post('con_no');
                $data['gender_spec']       = $this->input->post('gender_spec');
                $data['ward']              = $this->input->post('ward');
                $data['status']                = 1;
                $data['documents']             = $file;
                $data['documents_type']        = $doc_type;
                $data['nepali_date']           = DateNepToEng($this->input->post('nepali_date'));
                $data['date']                  = DateNepToEng($this->input->post('nepali_date'));
                $data['created_at']            = date("Y-m-d h:i:sa",time());
                $data['ward_login']            = $this->session->userdata('ward_no');
                $current_session               = Modules::run("Settings/getCurrentSession");
                $data['session_id']            = $current_session->id;
                $data['land_type']             = $this->input->post('land_type');
                if($id = $this->Mdl_charkilla->save($data))
                {

                    for($i=0;$i<count($_POST['old_address']);$i++)
                    {                     
                        $data1['killa_id']       = $id;
                        $data1['old_address']    = $this->input->post('old_address')[$i];
                        $data1['new_address']    = $this->input->post('new_address')[$i];
                        $data1['map_sheet_no']   = $this->input->post('map_sheet_no')[$i];
                        $data1['kitta_no']       = $this->input->post('kitta_no')[$i];
                        $data1['biggha']         = $this->input->post('biggha')[$i];
                        $data1['kattha']         = $this->input->post('kattha')[$i];
                        $data1['dhur']           = $this->input->post('dhur')[$i];
                        if($_POST['land_type'] == 'hill')
                        {
                            $data1['paisa']      = $this->input->post('paisa')[$i];
                        }
                        else
                        {
                            $data1['paisa']      = 0;
                        }
                        $data1['road']           = $this->input->post('road')[$i];
                        $data1['road_type']      = $this->input->post('road_type')[$i];
                        $data1['east_piller']    = $this->input->post('east_piller')[$i];
                        $data1['west_piller']    = $this->input->post('west_piller')[$i];
                        $data1['north_piller']   = $this->input->post('north_piller')[$i];
                        $data1['south_piller']   = $this->input->post('south_piller')[$i];
                        $data1['description']    = $this->input->post('description')[$i];
                        $this->Mdl_charkilla_details->save($data1);
                    }

                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 3;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_charkilla->update($id,$save);
                    $this->session->set_flashdata('msg',"चार किल्ला प्रमाणित सिफारिस पेश गर्न सफल |");
                    redirect('char-killa/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('char-killa/create');

                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['offices']          = $this->Mdl_office->getAll();
        $data['road_type']          = $this->Mdl_road_type->getAll();
        $data['old_address']          = $this->Mdl_oldnew_address->getAll();
        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);
        $data1['title'] = "नयाँ |     चार किल्ला प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('create_char_killa',$data);
        $this->load->view('User/footer');
    }
     /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_char_killa()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("char-killa");
        }
       $id             =  $this->uri->segment(3);
       $result         = $data['result']     = $this->Mdl_charkilla->getById($id);
       $result1        = $data['land_details'] = $this->Mdl_charkilla_details->getBykillaId($id);
       $documents      = $data['documents'] = explode("+",$result->documents);
       $documents_type = $data['documents_type'] = explode("+",$result->documents_type);
       if(empty($result))
        {

            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("char-killa");
        }

        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("char-killa");
        }
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            //$this->form_validation->set_rules('office', 'कार्यालय  ', 'required');
            $this->form_validation->set_rules('applicant_name', '  जग्गाधनीको नाम ', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                //pp(validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('char-killa/edit/'.$id);

            }
            else
            {
                        unset($_POST['submit']);
                        $path = 'assets/documents/land/char_killa/';
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
                        $data2['applicant_name']    = $this->input->post('applicant_name');
                        $data2['office']    = $this->input->post('office');
                        $data2['district']    = $this->input->post('district');
                        $data2['local_body']    = $this->input->post('local_body');
                        $data2['state']    = $this->input->post('state');
                        $data2['ward']    = $this->input->post('ward');
                        $data2['status']                = 1;
                        $data2['documents']             = $file;
                        $data2['documents_type']        = $doc_type;
                        $data2['nepali_date']           = $this->input->post('nepali_date');
                        $data2['date']                  = DateNepToEng($this->input->post('nepali_date'));
                        $data2['land_type']             = $this->input->post('land_type');
                       if($this->Mdl_charkilla->update($id , $data2))
                        {
                            //---------Deleting old record and saving new one----
                            $this->Mdl_charkilla_details->deleteByKillaId($id);
                            for($i=0;$i<count($_POST['old_address']);$i++)
                    {
//                        echo "here";exit;
                        $data1['killa_id']       = $id;
                        $data1['old_address']    = $this->input->post('old_address')[$i];
                        $data1['new_address']    = $this->input->post('new_address')[$i];
                        $data1['map_sheet_no']   = $this->input->post('map_sheet_no')[$i];
                        $data1['kitta_no']       = $this->input->post('kitta_no')[$i];
                        $data1['biggha']         = $this->input->post('biggha')[$i];
                        $data1['kattha']         = $this->input->post('kattha')[$i];
                        $data1['dhur']           = $this->input->post('dhur')[$i];
                        if($_POST['land_type'] == "hill")
                        {
                            $data1['paisa']      = $this->input->post('hill')[$i];
                        }
                        else
                        {
                            $data1['paisa']      = 0;
                        }
                        $data1['road']           = $this->input->post('road')[$i];
                        $data1['road_type']      = $this->input->post('road_type')[$i];
                        $data1['east_piller']    = $this->input->post('east_piller')[$i];
                        $data1['west_piller']    = $this->input->post('west_piller')[$i];
                        $data1['north_piller']   = $this->input->post('north_piller')[$i];
                        $data1['south_piller']   = $this->input->post('south_piller')[$i];
                        $data1['description']    = $this->input->post('description')[$i];
                        $this->Mdl_charkilla_details->save($data1);
                    }
                            $this->session->set_flashdata('msg',"चार किल्ला प्रमाणित सिफारिस सम्पादन गर्न सफल |");
                            redirect('char-killa/details/'.$id);
                        }
                        else
                        {
                            $this->session->set_flashdata('err_msg',"समस्या आयो |");
                            redirect('char-killa/edit/'.$id);
                        }


                }
        }
        // print_r($result1);exit;
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['offices']          = $this->Mdl_office->getAll();
        $data['road_type']          = $this->Mdl_road_type->getAll();
        $data['old_address']          = $this->Mdl_oldnew_address->getAll();
        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);
        $data1['title'] = "नयाँ | चार किल्ला प्रमाणित ";
        $this->load->view('User/header',$data1);
        $this->load->view('create_char_killa',$data);
        $this->load->view('User/footer');
//         $this->load->model('Mdl_purjamagharkayam');
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------------------------------------------------*/
    public function char_killa_view()
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
                    $result         = $this->Mdl_charkilla->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_charkilla->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_charkilla->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."char-killa");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_charkilla->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-$month months", strtotime($end_date)));
                    $data['result'] = $this->Mdl_charkilla->getByDates($start_date,$end_date,$ward_login);
    //                print_r($data);exit;
                }

            }
            else
            {
                $data['result']     = $this->Mdl_charkilla->getByStatus(1,$ward_login);
            }
        }
        else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_charkilla->getTableName();
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
        $data1['title']     = "आवेदकको विवरणहरु  | चार किल्ला प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('Land/char_killa_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function char_killa_darta()
    {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
         Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("char-killa");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_charkilla->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("char-killa");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("char-killa/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("char-killa/details/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."char-killa/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/land/char_killa_darta";
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
            if($this->Mdl_charkilla->update($id,$data))
            {
                $save['type']               = 3;
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
                redirect(base_url()."char-killa/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."char-killa/details/".$id);
            }

        }
        $ward_login             = $this->session->userdata('ward_no');
        $data['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $data['result'] = $result;
        $this->load->view('User/header',$data1);
        $this->load->view('char_killa_darta',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function char_killa_details()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("char-killa");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_charkilla->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("char-killa");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | चार किल्ला प्रमाणित" ;
        $this->load->view('User/header',$data1);
        $this->load->view('char_killa_details',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function char_killa_chalani()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_charkilla->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("char-killa");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("char-killa/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("char-killa/details/".$id);
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
            $save['applicant_name']             = $result->applicant_name;
            $save['ward_login']                 = $this->session->userdata('ward_no');
            $save['uri']                        = $this->uri->segment(1);
            $current_session                    = Modules::run("Settings/getCurrentSession");
            $save['session_id']                 = $current_session->id;
            $save['user_id']                    = $this->session->userdata('id');
            $save['czn_no']                     = $result->citizenship_no;
            $save['type']                       = 3;
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
            if($this->Mdl_charkilla->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("char-killa/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("char-killa");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Land/char_killa_chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
     public function char_killa_print()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("char-killa");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_charkilla->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("char-killa");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("char-killa/details/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri;
            $save['form_id'] = $result->form_id;
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
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('Land/char_killa_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    /*-------    Char Killa Ends
    /*------------------------------------------------------------------------------------------------------------------*/


    /*------------------------------------------------------------------------------------------------------------------*/
    /*-------    Mohi lagat Starts
    /*------------------------------------------------------------------------------------------------------------------*/
     public function create_mohi_lagat_katta()
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
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('kitta_no', ' कित्ता नं', 'required');
            $this->form_validation->set_rules('biggha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('kattha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('dhur', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('land_owner_name', '  जग्गाधनीको नाम ', 'required');
            $this->form_validation->set_rules('mohi_name', '   मोहीको नाम ', 'required');
            $this->form_validation->set_rules('map_sheet_no', '    सिट नं. ', 'required');
            $this->form_validation->set_rules('nepali_visit_date', '    सर्जमिन मिति  ', 'required');
            if ($this->form_validation->run() == FALSE)
            {
//                $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('mohi-lagat-katta/create');

            }
            else
            {
                unset($_POST['submit']);
                $path ='assets/documents/land/mohi/';
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
                $_POST['english_visit_date']                  = DateNepToEng($this->input->post('nepali_visit_date'));
                $_POST['created_at']            = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']            = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_mohi_lagat_katta->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 3;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_mohi_lagat_katta->update($id,$save);
                    $this->session->set_flashdata('msg',"मोही लागत कट्टा सिफारिस पेश गर्न सफल |");
                    redirect('mohi-lagat-katta/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('mohi-lagat-katta/create');
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
        $data1['title'] = "नयाँ | मोही लागत कट्टा";
        $this->load->view('User/header',$data1);
        $this->load->view('create_mohi_lagat_katta',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_mohi_lagat_katta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("mohi-lagat-katta");
        }
       $id             =  $this->uri->segment(3);
       $result         = $data['result']     = $this->Mdl_mohi_lagat_katta->getById($id);
       $documents      = $data['documents'] = explode("+",$result->documents);
       $documents_type = $data['documents_type'] = explode("+",$result->documents_type);
       if(empty($result))
        {

            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("mohi-lagat-katta");
        }

        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("mohi-lagat-katta");
        }
        if(isset($_POST['submit']))
        {
                $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
                $this->form_validation->set_rules('state', 'प्रदेश', 'required');
                $this->form_validation->set_rules('district', 'जिल्ला', 'required');
                $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
                $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
                $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
                $this->form_validation->set_rules('kitta_no', ' कित्ता नं', 'required');
                $this->form_validation->set_rules('biggha', 'क्षेत्रफल', 'required');
                $this->form_validation->set_rules('kattha', 'क्षेत्रफल', 'required');
                $this->form_validation->set_rules('dhur', 'क्षेत्रफल', 'required');
                $this->form_validation->set_rules('land_owner_name', '  जग्गाधनीको नाम ', 'required');
                $this->form_validation->set_rules('mohi_name', '   मोहीको नाम ', 'required');
                $this->form_validation->set_rules('map_sheet_no', '    सिट नं. ', 'required');
                $this->form_validation->set_rules('nepali_visit_date', '    सर्जमिन मिति  ', 'required');
                if ($this->form_validation->run() == FALSE)
                {
//                    $this->session->set_flashdata('err_msg', validation_errors());
                    $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                    redirect('mohi-lagat-katta/edit/'.$id);

                }
                else
                {
                        unset($_POST['submit']);
                        $path = 'assets/documents/land/mohi/';
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
                        $_POST['english_visit_date']                  = DateNepToEng($this->input->post('nepali_visit_date'));
                        $_POST['date']                  = DateNepToEng($this->input->post('nepali_date'));
                       if($this->Mdl_mohi_lagat_katta->update($id , $this->input->post()))
                        {
        //                   $this->session->unset_userdata('temp_edit_id');
                            $this->session->set_flashdata('msg',"मोही लागत कट्टा सिफारिस सम्पादन गर्न सफल |");
                            redirect('mohi-lagat-katta/details/'.$id);
                        }
                        else
                        {
                            $this->session->set_flashdata('err_msg',"समस्या आयो |");
                            redirect('mohi-lagat-katta/edit/'.$id);
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
        $data1['title'] = "नयाँ | मोही लागत कट्टा";
        $this->load->view('User/header',$data1);
        $this->load->view('create_mohi_lagat_katta',$data);
        $this->load->view('User/footer');
         $this->load->model('Mdl_purjamagharkayam');
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------------------------------------------------*/
     public function mohi_lagat_katta_view()
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
                    $result         = $this->Mdl_mohi_lagat_katta->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_mohi_lagat_katta->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_mohi_lagat_katta->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."mohi-lagat-katta");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_mohi_lagat_katta->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-$month months", strtotime($end_date)));
                    $data['result'] = $this->Mdl_mohi_lagat_katta->getByDates($start_date,$end_date,$ward_login);
    //                print_r($data);exit;
                }

            }
            else
            {
                $data['result']     = $this->Mdl_mohi_lagat_katta->getByStatus(1,$ward_login);
            }
        }
        else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_mohi_lagat_katta->getTableName();
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
        $data1['title']     = "आवेदकको विवरणहरु  | मोही लागत कट्टा";
        $this->load->view('User/header',$data1);
        $this->load->view('Land/mohi_lagat_katta_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function mohi_lagat_katta_darta()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
         Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("mohi-lagat-katta");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_mohi_lagat_katta->getById($id);
//        print_r($result);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("mohi-lagat-katta");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("mohi-lagat-katta/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("mohi-lagat-katta/details/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."mohi-lagat-katta/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/land/mohi_darta";
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
            if($this->Mdl_mohi_lagat_katta->update($id,$data))
            {
                $save['type']               = 3;
                $save['applicant_name']     = $result->land_owner_name;
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
                redirect(base_url()."mohi-lagat-katta/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."mohi-lagat-katta/details/".$id);
            }

        }
        $ward_login             = $this->session->userdata('ward_no');
        $data['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $data['result'] = $result;
        $this->load->view('User/header',$data1);
        $this->load->view('mohi_lagat_katta_darta',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function mohi_lagat_katta_details()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("mohi-lagat-katta");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_mohi_lagat_katta->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("mohi-lagat-katta");
        }
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data1['title']     = "आवेदकको विवरण | मोही लागत कट्टा" ;
        $this->load->view('User/header',$data1);
        $this->load->view('mohi_lagat_katta_details',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function mohi_lagat_katta_chalani()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_mohi_lagat_katta->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("mohi-lagat-katta");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("mohi-lagat-katta/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("mohi-lagat-katta/details/".$id);
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
            $save['applicant_name']       = $result->land_owner_name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']            = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $save['type']               = 3;
            $save['czn_no']             = $result->cit_no;
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
            if($this->Mdl_mohi_lagat_katta->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("mohi-lagat-katta/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("mohi-lagat-katta");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Land/mohi_lagat_katta_chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
     public function mohi_lagat_katta_print()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("mohi-lagat-katta");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_mohi_lagat_katta->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("mohi-lagat-katta");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("mohi-lagat-katta/details/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
            $save['office_id'] = $_POST['office_id'];
            if($this_print == FALSE)
            {
                $save['uri'] = $uri;
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
        $this->load->view('Land/mohi_lagat_katta_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*-------    Mohi lagat Ends
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    /*-------    Purjama Ghar Starts
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_purjama_ghar_kayam()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('samyukta', 'संयुक्त दर्ता भएको ', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('kitta_no', ' कित्ता नं', 'required');
            $this->form_validation->set_rules('biggha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('kattha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('dhur', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('applicant_name', ' आबदेकको नाम ', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('purjama-ghar-kayam/create');
            }
            else
            {
                unset($_POST['submit']);
                $path ='assets/documents/land/ghar/';
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
                $_POST['created_at']            = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']            = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_purjamagharkayam->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 3;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_purjamagharkayam->update($id,$save);
                    $this->session->set_flashdata('msg',"बाटो कायम सिफारिस पेश गर्न सफल |");
                    redirect('purjama-ghar-kayam/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('purjama-ghar-kayam/create');
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
        $data1['title'] = "नयाँ | पुर्जामा घर कायम ";
        $this->load->view('User/header',$data1);
        $this->load->view('create_purjama_ghar_kayam',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_purjama_ghar_kayam()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("purjama-ghar-kayam");
        }
       $id             =  $this->uri->segment(3);
       $result         = $data['result']     = $this->Mdl_purjamagharkayam->getById($id);
       $documents      = $data['documents'] = explode("+",$result->documents);
       $documents_type = $data['documents_type'] = explode("+",$result->documents_type);
       if(empty($result))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("purjama-ghar-kayam");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("purjama-ghar-kayam");
        }
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('samyukta', 'संयुक्त दर्ता भएको ', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('kitta_no', ' कित्ता नं', 'required');
            $this->form_validation->set_rules('biggha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('kattha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('dhur', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('applicant_name', ' आबदेकको नाम ', 'required');
                if ($this->form_validation->run() == FALSE)
                {
                    // $this->session->set_flashdata('err_msg', validation_errors());
                    $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                    redirect('purjama-ghar-kayam/edit/'.$id);
                }
                else
                {
                        unset($_POST['submit']);
                        $path = 'assets/documents/land/ghar/';
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
                       if($this->Mdl_purjamagharkayam->update($id , $this->input->post()))
                        {
        //                   $this->session->unset_userdata('temp_edit_id');
                            $this->session->set_flashdata('msg',"पुर्जामा घर  सिफारिस सम्पादन गर्न सफल |");
                            redirect('purjama-ghar-kayam/details/'.$id);
                        }
                        else
                        {
                            $this->session->set_flashdata('err_msg',"समस्या आयो |");
                            redirect('purjama-ghar-kayam/edit/'.$id);
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
        $data1['title'] = "नयाँ | पुर्जामा घर कायम";
        $this->load->view('User/header',$data1);
        $this->load->view('create_purjama_ghar_kayam',$data);
        $this->load->view('User/footer');
         $this->load->model('Mdl_purjamagharkayam');
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------------------------------------------------*/
     public function purjama_ghar_kayam_view()
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
                    $result         = $this->Mdl_purjamagharkayam->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_purjamagharkayam->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_purjamagharkayam->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."purjama-ghar-kayam");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_purjamagharkayam->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-$month months", strtotime($end_date)));
                    $data['result'] = $this->Mdl_purjamagharkayam->getByDates($start_date,$end_date,$ward_login);
    //                print_r($data);exit;
                }

            }
            else
            {
                $data['result']     = $this->Mdl_purjamagharkayam->getByStatus(1,$ward_login);
            }
        }else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_purjamagharkayam->getTableName();
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
        $data1['title']     = "आवेदकको विवरणहरु  | पुर्जामा घर कायम";
        $this->load->view('User/header',$data1);
        $this->load->view('Land/purjama_ghar_kayam_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function purjama_ghar_kayam_darta()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
         Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("purjama-ghar-kayam");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_purjamagharkayam->getById($id);
//        print_r($result);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("purjama-ghar-kayam");
        }
        // if($result->status == 2)
        // {
        //     $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
        //     redirect("purjama-ghar-kayam/details/".$id);
        // }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("purjama-ghar-kayam/details/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."purjama-ghar-kayam/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/land/ghar_darta";
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
            if($this->Mdl_purjamagharkayam->update($id,$data))
            {
                $save['type']               = 3;
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
                redirect(base_url()."purjama-ghar-kayam/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."purjama-ghar-kayam/details/".$id);
            }
        }
        $ward_login             = $this->session->userdata('ward_no');
        $data['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $data['result'] = $result;
        $this->load->view('User/header',$data1);
        $this->load->view('purjama_ghar_kayam_darta',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function purjama_ghar_kayam_details()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("purjama-ghar-kayam");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_purjamagharkayam->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("purjama-ghar-kayam");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | पुर्जामा घर कायम " ;
        $this->load->view('User/header',$data1);
        $this->load->view('purjama_ghar_kayam_details',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function purjama_ghar_kayam_chalani()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_purjamagharkayam->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("purjama-ghar-kayam");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("purjama-ghar-kayam/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("purjama-ghar-kayam/details/".$id);
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
            $save['applicant_name']             = $result->applicant_name;
            $save['ward_login']                 = $this->session->userdata('ward_no');
            $save['uri']                        = $this->uri->segment(1);
            $current_session                    = Modules::run("Settings/getCurrentSession");
            $save['session_id']                 = $current_session->id;
            $save['user_id']                    = $this->session->userdata('id');
            $save['type']                       = 3;
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
            if($this->Mdl_purjamagharkayam->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("purjama-ghar-kayam/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("purjama-ghar-kayam");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Land/purjama_ghar_kayam_chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
     public function purjama_ghar_kayam_print()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("purjama-ghar-kayam");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_purjamagharkayam->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("purjama-ghar-kayam");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("purjama-ghar-kayam/details/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
            $save['office_id'] = $_POST['office_id'];
            if($this_print == FALSE)
            {
                $save['uri'] = $uri;
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
        $data['chalani_no']     = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('Land/purjama_ghar_kayam_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*-------    Purjama Ghar ends
    /*------------------------------------------------------------------------------------------------------------------*/


    /*------------------------------------------------------------------------------------------------------------------*/
    /*-------    Bato Kayam Starts
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_bato_kayam()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            // print_r($_FILES);exit;
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('kitta_no', ' कित्ता नं', 'required');
            $this->form_validation->set_rules('biggha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('kattha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('dhur', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('land_owner_name', ' जग्गाधनीको नाम ', 'required');
            $this->form_validation->set_rules('road_length', ' सडक लम्बाई ', 'required');
            $this->form_validation->set_rules('road_width', ' सडक चौडाई ', 'required');
            $this->form_validation->set_rules('direction', 'बाटो खोल्न चाहेको दिशा ', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                //$this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('bato-kayam/create');
            }
            else
            {
                unset($_POST['submit']);
                $path ='assets/documents/land/bato/';
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
                $_POST['created_at']            = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']            = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_batokayam->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 3;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_batokayam->update($id,$save);
                    $this->session->set_flashdata('msg',"बाटो कायम सिफारिस पेश गर्न सफल |");
                    redirect('bato-kayam/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('bato-kayam/create');
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
        $data1['title'] = "नयाँ | बाटो कायम ";
        $this->load->view('User/header',$data1);
        $this->load->view('create_bato_kayam',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_bato_kayam()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("bato-kayam");
        }
       $id             =  $this->uri->segment(3);
       $result         = $data['result']     = $this->Mdl_batokayam->getById($id);
       $documents      = $data['documents'] = explode("+",$result->documents);
       $documents_type = $data['documents_type'] = explode("+",$result->documents_type);
       if(empty($result))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("bato-kayam");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("bato-kayam");
        }
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('kitta_no', ' कित्ता नं', 'required');
            $this->form_validation->set_rules('biggha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('kattha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('dhur', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('land_owner_name', ' जग्गाधनीको नाम ', 'required');
            $this->form_validation->set_rules('road_length', ' सडक लम्बाई ', 'required');
            $this->form_validation->set_rules('road_width', ' सडक चौडाई ', 'required');
            $this->form_validation->set_rules('direction', 'बाटो खोल्न चाहेको दिशा ', 'required');
                if ($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                    redirect('bato-kayam/edit/'.$id);

                }
                else
                {
                        unset($_POST['submit']);
                        $path = 'assets/documents/land/bato/';
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
                       if($this->Mdl_batokayam->update($id , $this->input->post()))
                        {
        //                   $this->session->unset_userdata('temp_edit_id');
                            $this->session->set_flashdata('msg',"बाटो कायम  सिफारिस सम्पादन गर्न सफल |");
                            redirect('bato-kayam/details/'.$id);
                        }
                        else
                        {
                            $this->session->set_flashdata('err_msg',"समस्या आयो |");
                            redirect('bato-kayam/edit/'.$id);
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
        $this->load->view('create_bato_kayam',$data);
        $this->load->view('User/footer');
         $this->load->model('Mdl_batokayam');
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------------------------------------------------*/
    public function bato_kayam_view()
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
                    $result         = $this->Mdl_batokayam->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_batokayam->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_batokayam->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."bato-kayam");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_batokayam->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-$month months", strtotime($end_date)));
                    $data['result'] = $this->Mdl_batokayam->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_batokayam->getByStatus(1,$ward_login);
            }
        }else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_batokayam->getTableName();
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
        $data1['title']     = "आवेदकको विवरणहरु  | बाटो कायम ";
        $this->load->view('User/header',$data1);
        $this->load->view('Land/bato_kayam_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function bato_kayam_darta()
    {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
         Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("bato-kayam");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_batokayam->getById($id);
//        print_r($result);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("bato-kayam");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("bato-kayam/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("bato-kayam/details/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."bato-kayam/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/land/bato_darta";
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
            if($this->Mdl_batokayam->update($id,$data))
            {
                $save['type']               = 3;
                $save['applicant_name']     = $result->land_owner_name;
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
                redirect(base_url()."bato-kayam/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."bato-kayam/details/".$id);
            }

        }
        $ward_login             = $this->session->userdata('ward_no');
        $data['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $data['result'] = $result;
        $this->load->view('User/header',$data1);
        $this->load->view('bato_kayam_darta',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function bato_kayam_details()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("bato-kayam");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_batokayam->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("bato-kayam");
        }
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data1['title']     = "आवेदकको विवरण | बाटो कायम " ;
        $this->load->view('User/header',$data1);
        $this->load->view('bato_kayam_details',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function bato_kayam_chalani()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_batokayam->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("bato-kayam");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("bato-kayam/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("bato-kayam/details/".$id);
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
            $save['applicant_name']             = $result->land_owner_name;
            $save['ward_login']                 = $this->session->userdata('ward_no');
            $save['uri']                        = $this->uri->segment(1);
            $current_session                    = Modules::run("Settings/getCurrentSession");
            $save['session_id']                 = $current_session->id;
            $save['user_id']                    = $this->session->userdata('id');
            $save['type']                       = 3;
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
            if($this->Mdl_batokayam->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("bato-kayam/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("bato-kayam");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Land/bato_kayam_chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
     public function bato_kayam_print()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("bato-kayam");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_batokayam->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("bato-kayam");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("bato-kayam/details/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
            $save['office_id'] = $_POST['office_id'];
            if($this_print == FALSE)
            {
                $save['uri'] = $uri;
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
        $data['user']  = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('Land/bato_kayam_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------- Bato Kayam Ends here---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/


    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Lalpurja Pratilipi     ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_lalpurja_pratilipi()
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
            $this->form_validation->set_rules('applicant_name', 'आबदेकको नाम', 'required');
            $this->form_validation->set_rules('citizenship_no', 'नागरिकता नं ', 'required');
            $this->form_validation->set_rules('nep_citizenship_date', 'नागरिकता जारी मिती ', 'required');
            $this->form_validation->set_rules('father_name', 'बुवाको नाम', 'required');
            $this->form_validation->set_rules('grandfather_name', ' बाजेको नाम', 'required');
            $this->form_validation->set_rules('a_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('a_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('a_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('a_ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('a_old_place', 'आबदेकको साबिक ठेगाना', 'required');
            //$this->form_validation->set_rules('land_owner_name', ' जग्गा धनिको नाम  ', 'required');
            $this->form_validation->set_rules('kitta_no', ' कित्ता नं', 'required');
            $this->form_validation->set_rules('biggha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('kattha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('dhur', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('l_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('l_district', 'जिल्ला.', 'required');
            $this->form_validation->set_rules('l_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('l_ward_no', ' वडा नं', 'required');
            $this->form_validation->set_rules('l_old_place', 'जग्गा धनिको  साबिक ठेगाना', 'required');
//            $this->form_validation->set_rules('documents[]', 'कागजात', 'required');
            // $this->form_validation->set_rules('documents_type[]', 'कागजातको प्रकार ', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               $this->session->set_flashdata('err_msg', validation_errors());
                // $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('lalpurja-pratilipi/edit');

            }
            else
            {
                unset($_POST['submit']);
                $path ='assets/documents/land/lalpurja/';
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
                $_POST['eng_citizenship_date']    = DateNepToEng($this->input->post('nep_citizenship_date'));
                $_POST['created_at']            = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']            = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_lalpurja_pratilipi->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 3;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_lalpurja_pratilipi->update($id,$save);
                    $this->session->set_flashdata('msg',"जग्गाधनी लाल पुर्जा प्रतिलिपि सिफारिस पेश गर्न सफल |");
                    redirect('lalpurja-pratilipi/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('lalpurja-pratilipi/create');
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

        $data1['title']         = "नयाँ | जग्गाधनि लालपुर्जा  प्रतिलिपि ";
        $this->load->view('User/header',$data1);
        $this->load->view('lalpurja_pratilipi',$data);
        $this->load->view('User/footer');
    }
    /*--------------------------------------------------------------------------------------------------------------------*/

    public function edit_lalpurja_pratilipi()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("lalpurja-pratilipi");
        }
       $id             =  $this->uri->segment(3);
       $result         = $data['result']     = $this->Mdl_lalpurja_pratilipi->getById($id);
       $documents      = $data['documents'] = explode("+",$result->documents);
       $documents_type = $data['documents_type'] = explode("+",$result->documents_type);
       if(empty($result))
        {

            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("lalpurja-pratilipi");
        }

        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("lalpurja-pratilipi");
        }
        if(isset($_POST['submit']))
        {
                $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
                $this->form_validation->set_rules('applicant_name', 'आबदेकको नाम', 'required');
                $this->form_validation->set_rules('citizenship_no', 'नागरिकता नं ', 'required');
                $this->form_validation->set_rules('nep_citizenship_date', 'नागरिकता जारी मिती ', 'required');
                $this->form_validation->set_rules('father_name', 'बुवाको नाम', 'required');
                $this->form_validation->set_rules('grandfather_name', ' बाजेको नाम', 'required');
                $this->form_validation->set_rules('a_state', 'प्रदेश', 'required');
                $this->form_validation->set_rules('a_district', 'जिल्ला', 'required');
                $this->form_validation->set_rules('a_local_body', 'गा.वि.स./न.पा.', 'required');
                $this->form_validation->set_rules('a_ward', 'वडा नं.', 'required');
                $this->form_validation->set_rules('a_old_place', 'आबदेकको साबिक ठेगाना', 'required');
                $this->form_validation->set_rules('land_owner_name', ' जग्गा धनिको नाम  ', 'required');
                $this->form_validation->set_rules('kitta_no', ' कित्ता नं', 'required');
                $this->form_validation->set_rules('biggha', 'क्षेत्रफल', 'required');
                $this->form_validation->set_rules('kattha', 'क्षेत्रफल', 'required');
                $this->form_validation->set_rules('dhur', 'क्षेत्रफल', 'required');
                $this->form_validation->set_rules('l_state', 'प्रदेश', 'required');
                $this->form_validation->set_rules('l_district', 'जिल्ला.', 'required');
                $this->form_validation->set_rules('l_local_body', 'गा.वि.स./न.पा.', 'required');
                $this->form_validation->set_rules('l_ward_no', ' वडा नं', 'required');
                $this->form_validation->set_rules('l_old_place', 'जग्गा धनिको  साबिक ठेगाना', 'required');
                $this->form_validation->set_rules('documents_type[]', 'कागजातको प्रकार ', 'required');

                if ($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                    redirect('lalpurja-pratilipi/edit/'.$id);

                }
                else
                {
                        unset($_POST['submit']);
                        $path = 'assets/documents/land/lalpurja/';
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
                        $_POST['eng_citizenship_date']    = DateNepToEng($this->input->post('nep_citizenship_date'));
                       if($this->Mdl_lalpurja_pratilipi->update($id , $this->input->post()))
                        {
        //                   $this->session->unset_userdata('temp_edit_id');
                            $this->session->set_flashdata('msg',"जग्गाधनी लाल पुर्जा प्रतिलिपि सिफारिस सम्पादन गर्न सफल |");
                            redirect('lalpurja-pratilipi/details/'.$id);
                        }
                        else
                        {
                            $this->session->set_flashdata('err_msg',"समस्या आयो |");
                            redirect('lalpurja-pratilipi/edit/'.$id);
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
        $this->load->view('lalpurja_pratilipi',$data);
        $this->load->view('User/footer');
         $this->load->model('Mdl_lalpurja_pratilipi');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function pratilipi_view()
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
                    $result         = $this->Mdl_lalpurja_pratilipi->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_lalpurja_pratilipi->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_lalpurja_pratilipi->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."lalpurja-pratilipi");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_lalpurja_pratilipi->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-$month months", strtotime($end_date)));
                    $data['result'] = $this->Mdl_lalpurja_pratilipi->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_lalpurja_pratilipi->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_lalpurja_pratilipi->getTableName();
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
        $data1['title']     = "आवेदकको विवरणहरु  | जग्गाधनि लालपुर्जा प्रतिलिपि ";
        $this->load->view('User/header',$data1);
        $this->load->view('pratilipi_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
   public function lalpurja_pratilipi_darta()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
         Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("lalpurja-pratilipi");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_lalpurja_pratilipi->getById($id);
//        print_r($result);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("lalpurja-pratilipi");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("lalpurja-pratilipi/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("lalpurja-pratilipi/details/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."lalpurjapratilipi/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/land/land_pratilipi_darta";
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
            if($this->Mdl_lalpurja_pratilipi->update($id,$data))
            {
                $save['type']               = 3;
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
                redirect(base_url()."lalpurja-pratilipi/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."lalpurja-pratilipi/details/".$id);
            }

        }
        $ward_login             = $this->session->userdata('ward_no');
        $data['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $data['result'] = $result;
        $this->load->view('User/header',$data1);
        $this->load->view('lalpurja_pratilipi_darta',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function lalpurja_darta_details()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("lalpurja-pratilipi");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_lalpurja_pratilipi->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("lalpurja-pratilipi");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | व्यवसाय दर्ता प्रमाणपत्र" ;
        $this->load->view('User/header',$data1);
        $this->load->view('lalpurja_darta_details',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function lalpurja_pratiliti_chalani()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_lalpurja_pratilipi->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("lalpurja-pratilipi");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("lalpurja-pratilipi/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("lalpurja-pratilipi/details/".$id);
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
            $save['applicant_name']             = $result->applicant_name;
            $save['ward_login']                 = $this->session->userdata('ward_no');
            $save['uri']                        = $this->uri->segment(1);
            $current_session                    = Modules::run("Settings/getCurrentSession");
            $save['session_id']                 = $current_session->id;
            $save['user_id']                    = $this->session->userdata('id');
            $save['czn_no']                     = $result->citizenship_no;
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
            if($this->Mdl_lalpurja_pratilipi->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("lalpurja-pratilipi/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("lalpurja-pratilipi");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Land/lalpurja_pratiliti_chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
     public function lalpurja_pratiliti_print()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("lalpurja-pratilipi");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_lalpurja_pratilipi->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("lalpurja-pratilipi");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("lalpurja-pratilipi/details/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
            $save['office_id']  = $_POST['office_id'];
            if($this_print == FALSE)
            {
                $save['uri'] = $uri;
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
        $data['user']  = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('Land/lalpurja_pratilipi_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
   /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Lalpurja Pratilipi ends here    ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/

     public function getOldNew()
     {
            $res = [];
            $id = $_POST['id'];
            $old_address = $this->Mdl_oldnew_address->getById($id);
            $html = $old_address->new_name;
            $res['html']  = $html;
            echo json_encode($res);
     }
     public function getLandDocumentHTML()
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
    public function getCharKillaHTML()
     {
            $id = $_POST['count'];
            $land_type = $_POST['land_type'];
            $display = '';
            if($land_type=="terai")
            {
                $display = 'style="display:none;"';
            }
            $old_address = $this->Mdl_oldnew_address->getAll();
            $road_type= $this->Mdl_road_type->getAll();
            $html="";
            $html .= '<tr class="item" id="item-'.$id.'">
                                 <td>
                                    <select name="old_address[]" class="formset-field old-place" id="old_address-'.$id.'" style="width:97%">
                                        <option value="" selected>छान्नुहोस्</option>';
                                         foreach($old_address as $add){
                                        $html.='<option value="'.$add->id.'">'.$add->name.'</option>';
                                        }
                                $html .='</select>
                                </td>
                                <td>
                                    <input type="text" name="new_address[]" id="new_address-'.$id.'" readonly="true" class="new-name formset-field" style="width:97%">
                                </td>
                                <td>
                                    <input type="text" name="map_sheet_no[]" maxlength="16" class="formset-field map-sheet-no" id="map_sheet_no-'.$id.'" style="width:97%"/>
                                </td>
                                <td>
                                    <input type="text" name="kitta_no[]" maxlength="16" class="formset-field kitta-no" id="kitta_no-'.$id.'" style="width:97%" />
                                </td>
                                <td>
                                    <input type="number" name="biggha[]" value="0" class="formset-field biggha" id="biggha-'.$id.'" min="0" style="width:97%"/>
                                </td>
                                <td>
                                    <input type="number" name="kattha[]" value="0" class="formset-field kattha" id="kattha-'.$id.'" min="0" max="20" style="width:97%"/>
                                </td>
                                <td>
                                    <input type="number" name="dhur[]" value="0" class="formset-field dhur" id="dhur-'.$id.'" min="0" max="20" style="width:97%"/>
                                </td>
                                <td '. $display .' >
                                    <input type="number" name="paisa[]" value="0" class="formset-field paisa" id="paisa-'.$id.'" min="0" max="20" style="width:97%"/>
                                </td>
                                <td>
                                    <input type="checkbox" name="road[]" value="1" class="formset-field road-checkbox" id="road-'.$id.'" style="width:97%"/>
                                </td>
                                <td>
                                    <select name="road_type[]" class="formset-field  road-type" disabled id="road_type-'.$id.'" style="width:97%">
                                        <option value="" selected>छान्नुहोस्</option>';
                                     foreach($road_type as $data){
                                    $html .='    <option value="'.$data->id.'">'.$data->name.'</option>';
                                     }
                                    $html .='</select>
                                </td>
                                <td>
                                    <input type="text" name="east_piller[]" maxlength="132" class="east-piller formset-field" id="east_piller-'.$id.'" style="width:97%"/>
                                </td>
                                <td>
                                    <input type="text" name="west_piller[]" maxlength="132" class="formset-field west-piller" id="west_piller-'.$id.'" style="width:97%"/>
                                </td>
                                <td>
                                    <input type="text" name="north_piller[]" maxlength="132" class="formset-field north-piller" id="north_piller-'.$id.'" style="width:97%"/>
                                </td>
                                <td>
                                    <input type="text" name="south_piller[]" maxlength="132" class="formset-field south-piller" id="south_piller-'.$id.'" style="width:97%"/>
                                </td>

                                <td>
                                    <textarea name="description[]" cols="15" maxlength="264" class="formset-field" id="description-'.$id.'" rows="2" >
                                </textarea>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove"
                                            id="details-'.$id.'">
                                          <i class="fa fa-minus"></i>
                                    </button>
                                </td>
                            </tr>';
            $res = [];
            $res['html']  = $html;
            echo json_encode($res);
     }
     public function getDetais($id)
     {
           return $this->Mdl_charkilla_details->getBykillaId($id);

     }
     // -------------------------------------------------------------------------------------------

}
