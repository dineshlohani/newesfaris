<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Others extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_apanga_pramanpatra');
        $this->load->model('Mdl_add_classroom');
        $this->load->model('Mdl_ghar_patala');
        $this->load->model('Mdl_arthik_saheta');
        $this->load->model('Mdl_prabhidik_mulyankan');
        $this->load->model('Mdl_scholarship');
        $this->load->model('Mdl_scholarship_detail');
        $this->load->model('Mdl_nata_pramanit');
        $this->load->model('Mdl_nata_pramanit_detail');
        $this->load->model('Mdl_kotha_khali_suchana');
        $this->load->model('Mdl_court_fee');
        $this->load->model('Mdl_hakdar_pramanit');
        $this->load->model('Mdl_sadak_khanne_swikriti');
        $this->load->model('Mdl_farak_nam_thar');
        $this->load->model('Mdl_jet_machine');
        $this->load->model('Mdl_bibaha_pramanit');
        $this->load->model('Mdl_khanepani_jadan');
        $this->load->model('Mdl_biduth_jadan');
        $this->load->model('Mdl_abibhahit_pramanpatra');
        $this->load->model('Mdl_janma_miti_pramanit');
        $this->load->model('Mdl_nabalak_pramanit');
        $this->load->model('Mdl_mirtyu_darta');
        $this->load->model('Mdl_tin_pusta_pramanit');
        $this->load->model('Mdl_tin_pusta_pramanit_detail');
        $this->load->model('Mdl_farak_janma_miti');
        $this->load->model('Mdl_farak_hijje');

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
        $this->load->model('Settings/Mdl_disable_type');
        $this->load->model('Settings/Mdl_eutype');
        $this->load->model('Settings/Mdl_department');
        $this->load->model('Settings/Mdl_session');
        $this->load->model('Settings/Mdl_marriage_type');
        $this->load->model('Settings/Mdl_ward_worker');

        $this->load->model('Settings/Mdl_document');
        $this->load->model('Settings/Mdl_patra_item');
        $this->load->model('User/Mdl_user');

        $this->load->helper('functions_helper');

        $this->load->helper('string');
        $this->load->helper('functions_helper');
    }

    /*------------------------------------------------------------------------------------------------------------------*/

    public function index()
    {
        Modules::run("User/checkWardLogin");
        $data['title'] = "Others | Dashboard";
        $data['bibaha_pramanit']            = $this->Mdl_user->getTotalCount('bibaha_pramanit');
        $data['khanepani_jadan']            = $this->Mdl_user->getTotalCount('khanepani_jadan');
        $data['biduth_jadan']               = $this->Mdl_user->getTotalCount('bidhut_jadan');
        $data['mirtyu_darta']               = $this->Mdl_user->getTotalCount('mirtyu_darta');
        $data['abibhahit_pramanpatra']      = $this->Mdl_user->getTotalCount('abibhahit_pramanpatra');
        $data['khanepani_jadan']            = $this->Mdl_user->getTotalCount('khanepani_jadan');
        $data['janma_miti_pramanit']        = $this->Mdl_user->getTotalCount('janma_miti_pramanit');
        $data['jet_machine']                = $this->Mdl_user->getTotalCount('jet_machine');
        $data['tin_pusta_pramanit']         = $this->Mdl_user->getTotalCount('tin_pusta_pramanit');
        $data['farak_nam_thar']             = $this->Mdl_user->getTotalCount('farak_nam_thar');
        $data['farak_janma_miti']           = $this->Mdl_user->getTotalCount('farak_janma_miti');
        $data['farak_hijje']                = $this->Mdl_user->getTotalCount('farak_hijje');
        $data['sadak_khanne_swikriti']      = $this->Mdl_user->getTotalCount('sadak_khanne_swikriti');
        $data['hakdar_pramanit']            = $this->Mdl_user->getTotalCount('hakdar_pramanit');
        $data['nabalak_pramanit']           = $this->Mdl_user->getTotalCount('nabalak_pramanit');
        $data['court_fee']                  = $this->Mdl_user->getTotalCount('court_fee');
        $data['kotha_khali_suchana']        = $this->Mdl_user->getTotalCount('kotha_khali_suchana');
        $data['nata_pramanit']              = $this->Mdl_user->getTotalCount('nata_pramanit');
        $data['scholarship']                = $this->Mdl_user->getTotalCount('scholarship');
        $data['prabhidik_mulyankan']        = $this->Mdl_user->getTotalCount('prabhidik_mulyankan');
        $data['arthik_saheta']              = $this->Mdl_user->getTotalCount('arthik_saheta');
        $data['ghar_patala']                = $this->Mdl_user->getTotalCount('ghar_patala');
        $data['add_classroom']              = $this->Mdl_user->getTotalCount('add_classroom');
        $data['apanga_pramanpatra']          = $this->Mdl_user->getTotalCount('apanga_pramanpatra');
        $this->load->view('User/header',$data);
        $this->load->view('dashboard');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Mirtyu Darta     ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_mirtyu_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('death_person_name', 'मृतकको नाम', 'required');
            $this->form_validation->set_rules('gender', 'मृतकको लिङ्ग', 'required');
            $this->form_validation->set_rules('age', 'मृतकको उमेर', 'required');
            $this->form_validation->set_rules('father_name', 'बुवाको नाम', 'required');
            $this->form_validation->set_rules('mother_name', 'आमाको नाम', 'required');
            $this->form_validation->set_rules('grandfather_name', 'बाजेको नाम', 'required');
            $this->form_validation->set_rules('nep_dod', 'मृत्यु भएको मिति', 'required');
            $this->form_validation->set_rules('eng_dod', 'मृत्यु भएको मिति (A.D.)', 'required');
            $this->form_validation->set_rules('death_district', 'मृत्यु भएको जिल्ला', 'required');
            $this->form_validation->set_rules('death_ward', 'मृत्यु भएको वडा नं.', 'required');
            $this->form_validation->set_rules('death_local_body', 'मृत्यु भएको गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('death_state', 'मृत्यु भएको प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');


            if ($this->form_validation->run() == FALSE)
            {
               $this->session->set_flashdata('err_msg', validation_errors());
                // $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('mirtyu-darta/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/mirtyu_darta/';
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
                if(!empty($_POST['citizenship_no']))
                {
                    $_POST['citizenship_eng_date'] = DateNepToEng($this->input->post('citizenship_nep_date'));
                }
                else
                {
                    unset($_POST['citizenship_district']);
                }
                if($id = $this->Mdl_mirtyu_darta->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 7;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_mirtyu_darta->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('mirtyu-darta/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('mirtyu-darta/create');
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

        $data1['title'] = "नयाँ | मृत्यु दर्ता";
        $this->load->view('User/header',$data1);
        $this->load->view('mirtyu_darta',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_mirtyu_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("mirtyu-darta");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_mirtyu_darta->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"मृत्यु दर्ता भेटिएन");
            redirect("mirtyu-darta");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | मृत्यु दर्ता" ;
        $this->load->view('User/header',$data1);
        $this->load->view('mirtyu_darta_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    public function edit_mirtyu_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("mirtyu-darta");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_mirtyu_darta->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","मृत्यु दर्ता भेटिएन |");
            redirect("mirtyu-darta");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("mirtyu-darta");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('death_person_name', 'मृतकको नाम', 'required');
            $this->form_validation->set_rules('gender', 'मृतकको लिङ्ग', 'required');
            $this->form_validation->set_rules('age', 'मृतकको उमेर', 'required');
            $this->form_validation->set_rules('father_name', 'बुवाको नाम', 'required');
            $this->form_validation->set_rules('mother_name', 'आमाको नाम', 'required');
            $this->form_validation->set_rules('grandfather_name', 'बाजेको नाम', 'required');
            $this->form_validation->set_rules('nep_dod', 'मृत्यु भएको मिति', 'required');
            $this->form_validation->set_rules('eng_dod', 'मृत्यु भएको मिति (A.D.)', 'required');
            $this->form_validation->set_rules('death_district', 'मृत्यु भएको जिल्ला', 'required');
            $this->form_validation->set_rules('death_ward', 'मृत्यु भएको वडा नं.', 'required');
            $this->form_validation->set_rules('death_local_body', 'मृत्यु भएको गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('death_state', 'मृत्यु भएको प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               $this->session->set_flashdata('err_msg', validation_errors());
                // $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('mirtyu-darta/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/mirtyu_darta/';
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
                if(!empty($_POST['citizenship_no']))
                {
                    $_POST['citizenship_eng_date'] = DateNepToEng($this->input->post('citizenship_nep_date'));
                }
                else
                {
                    unset($_POST['citizenship_district']);
                }
                $_POST['date']                  = DateNepToEng($this->input->post('nepali_date'));
                if($this->Mdl_mirtyu_darta->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('mirtyu-darta/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('mirtyu-darta/edit/'.$id);
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

        $data1['title'] = "नयाँ | मृत्यु दर्ता";
        $this->load->view('User/header',$data1);
        $this->load->view('mirtyu_darta',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_mirtyu_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("mirtyu-darta");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_mirtyu_darta->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("mirtyu-darta");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("mirtyu-darta/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("mirtyu-darta/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            if($_FILES['documents']['name'][0] == "")
            {
                $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
                redirect(base_url()."mirtyu-darta/darta/".$id);
            }
            $filename = "";
            $path  = "assets/documents/others/mirtyu_darta";
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
            if($this->Mdl_mirtyu_darta->update($id,$data))
            {
                $save['type']               = 7;
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
                redirect(base_url()."mirtyu-darta/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."mirtyu-darta/detail/".$id);
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
    public function chalani_mirtyu_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_mirtyu_darta->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("mirtyu-darta");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("mirtyu-darta/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("mirtyu-darta/detail/".$id);
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
            if($this->Mdl_mirtyu_darta->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("mirtyu-darta/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("mirtyu-darta");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_mirtyu_darta()
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
                    $result         = $this->Mdl_mirtyu_darta->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_mirtyu_darta->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_mirtyu_darta->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."mirtyu-darta");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_mirtyu_darta->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_mirtyu_darta->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_mirtyu_darta->getByStatus(1,$ward_login);
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
        $data1['title']     = "मृत्यु दर्ता";
        $this->load->view('User/header',$data1);
        $this->load->view('mirtyu_darta_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_mirtyu_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("mirtyu-darta");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_mirtyu_darta->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("mirtyu-darta");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("mirtyu-darta/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('mirtyu_darta_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Apanga Pramanpatra     ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_apanga_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('gender', 'लिङ्ग', 'required');
            $this->form_validation->set_rules('disable_type', 'अपाङ्गताको किसिम', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('apanga-pramanpatra/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/apanga_pramanpatra/';
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
                if($id = $this->Mdl_apanga_pramanpatra->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 6;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_apanga_pramanpatra->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('apanga-pramanpatra/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('apanga-pramanpatra/create');
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']      = $this->Mdl_oldnew_address->getAll();
        $data['disables']       = $this->Mdl_disable_type->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | अपाङ्ग प्रमाणपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('apanga_pramanpatra',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_apanga_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("apanga-pramanpatra");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_apanga_pramanpatra->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("apanga-pramanpatra");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | अपाङ्ग प्रमाणपत्र" ;
        $this->load->view('User/header',$data1);
        $this->load->view('apanga_pramanpatra_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_apanga_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("apanga-pramanpatra");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_apanga_pramanpatra->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("apanga-pramanpatra");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("apanga-pramanpatra");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('gender', 'लिङ्ग', 'required');
            $this->form_validation->set_rules('disable_type', 'अपाङ्गताको किसिम', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('apanga-pramanpatra/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/apanga_pramanpatra/';
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
                if($this->Mdl_apanga_pramanpatra->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('apanga-pramanpatra/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('apanga-pramanpatra/edit/'.$id);
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']      = $this->Mdl_oldnew_address->getAll();
        $data['disables']       = $this->Mdl_disable_type->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | अपाङ्ग प्रमाणपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('apanga_pramanpatra',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_apanga_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("apanga-pramanpatra");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_apanga_pramanpatra->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("apanga-pramanpatra");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("apanga-pramanpatra/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("apanga-pramanpatra/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."apanga-pramanpatra/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/apanga_pramanpatra";
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
            if($this->Mdl_apanga_pramanpatra->update($id,$data))
            {
                $save['type']               = 6;
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
                redirect(base_url()."apanga-pramanpatra/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."apanga-pramanpatra/detail/".$id);
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
    public function chalani_apanga_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_apanga_pramanpatra->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("apanga-pramanpatra");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("apanga-pramanpatra/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("apanga-pramanpatra/detail/".$id);
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
            $save['czn_no'] =  $result->cit_no;
            $save['user_id']            = $this->session->userdata('id');
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
            if($this->Mdl_apanga_pramanpatra->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("apanga-pramanpatra/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("apanga-pramanpatra");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_apanga_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("apanga-pramanpatra");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_apanga_pramanpatra->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("apanga-pramanpatra");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("apanga-pramanpatra/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('apanga_pramanpatra_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_apanga_pramanpatra()
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
                    $result         = $this->Mdl_apanga_pramanpatra->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_apanga_pramanpatra->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_apanga_pramanpatra->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."apanga-pramanpatra");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_apanga_pramanpatra->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_apanga_pramanpatra->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_apanga_pramanpatra->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_apanga_pramanpatra->getTableName();
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
        $this->load->view('apanga_pramanpatra_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Classroom Addition   ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_add_classroom()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('school_name', 'विद्यालयको नाम', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('add-classroom/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/add_classroom/';
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
                if($id = $this->Mdl_add_classroom->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 8;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_add_classroom->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('add-classroom/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('add-classroom/create');
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

        $data1['title'] = "नयाँ | कक्षा कोठा थप";
        $this->load->view('User/header',$data1);
        $this->load->view('add_classroom',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_add_classroom()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("add-classroom");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_add_classroom->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("add-classroom");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | कक्षा कोठा थप" ;
        $this->load->view('User/header',$data1);
        $this->load->view('add_classroom_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_add_classroom()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("add-classroom");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_add_classroom->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("add-classroom");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("add-classroom");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('school_name', 'विद्यालयको नाम', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('add-classroom/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/add_classroom/';
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
                if($this->Mdl_add_classroom->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('add-classroom/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('add-classroom/edit/'.$id);
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

        $data1['title'] = "नयाँ | कक्षा कोठा थप";
        $this->load->view('User/header',$data1);
        $this->load->view('add_classroom',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_add_classroom()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("add-classroom");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_add_classroom->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("add-classroom");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("add-classroom/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("add-classroom/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."add-classroom/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/add_classroom";
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
            if($this->Mdl_add_classroom->update($id,$data))
            {
                $save['type']               = 8;
                $save['applicant_name']     = $result->school_name;
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
                redirect(base_url()."add-classroom/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."add-classroom/detail/".$id);
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
    public function chalani_add_classroom()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_add_classroom->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("add-classroom");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("add-classroom/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("add-classroom/detail/".$id);
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
            $save['applicant_name']       = $result->school_name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']            = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
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
            if($this->Mdl_add_classroom->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("add-classroom/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("add-classroom");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_add_classroom()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("add-classroom");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_add_classroom->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("add-classroom");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("add-classroom/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
         $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('add_classroom_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_add_classroom()
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
                    $result         = $this->Mdl_add_classroom->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_add_classroom->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_add_classroom->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."add-classroom");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_add_classroom->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_add_classroom->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_add_classroom->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_add_classroom->getTableName();
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
        $data1['title']     = "कक्षा कोठा थप";
        $this->load->view('User/header',$data1);
        $this->load->view('add_classroom_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Ghar Patala   ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_ghar_patala()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('kitta_no', 'कित्ता', 'required');
            $this->form_validation->set_rules('biggha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('kattha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('dhur', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('ghar-patala/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/ghar_patala/';
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
                if($id = $this->Mdl_ghar_patala->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 9;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_ghar_patala->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('ghar-patala/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('ghar-patala/create');
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

        $data1['title'] = "नयाँ | घर पाताल भएको";
        $this->load->view('User/header',$data1);
        $this->load->view('ghar_patala',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_ghar_patala()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("ghar-patala");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_ghar_patala->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("ghar-patala");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | घर पाताल भएको" ;
        $this->load->view('User/header',$data1);
        $this->load->view('ghar_patala_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_ghar_patala()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("ghar-patala");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_ghar_patala->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("ghar-patala");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("ghar-patala");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('kitta_no', 'कित्ता', 'required');
            $this->form_validation->set_rules('biggha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('kattha', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('dhur', 'क्षेत्रफल', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');


            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('ghar-patala/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/ghar_patala/';
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
                if($this->Mdl_ghar_patala->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('ghar-patala/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('ghar-patala/edit/'.$id);
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

        $data1['title'] = "नयाँ | घर पाताल भएको";
        $this->load->view('User/header',$data1);
        $this->load->view('ghar_patala',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_ghar_patala()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("ghar-patala");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_ghar_patala->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("ghar-patala");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("ghar-patala/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("ghar-patala/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."ghar-patala/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/ghar_patala";
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
            if($this->Mdl_ghar_patala->update($id,$data))
            {
                $save['type']               = 9;
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
                redirect(base_url()."ghar-patala/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."ghar-patala/detail/".$id);
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
    public function chalani_ghar_patala()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_ghar_patala->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("ghar-patala");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("ghar-patala/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("ghar-patala/detail/".$id);
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
            if($this->Mdl_ghar_patala->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("ghar-patala/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("ghar-patala");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_ghar_patala()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("ghar-patala");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_ghar_patala->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("ghar-patala");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("ghar-patala/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('ghar_patala_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_ghar_patala()
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
                    $result         = $this->Mdl_ghar_patala->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_ghar_patala->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_ghar_patala->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."ghar-patala");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_ghar_patala->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_ghar_patala->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_ghar_patala->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_ghar_patala->getTableName();
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
        $data1['title']     = "घर पाताल भएको";
        $this->load->view('User/header',$data1);
        $this->load->view('ghar_patala_view',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Arthik Saheta     ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_arthik_saheta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('culprit_name', 'अपराधीको नाम', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('arthik-saheta/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/arthik_saheta/';
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
                if($id = $this->Mdl_arthik_saheta->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 9;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_arthik_saheta->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('arthik-saheta/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('arthik-saheta/create');
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

        $data1['title'] = "नयाँ | आर्थिक सहायता";
        $this->load->view('User/header',$data1);
        $this->load->view('arthik_saheta',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_arthik_saheta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("arthik-saheta");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_arthik_saheta->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("arthik-saheta");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | आर्थिक सहायता" ;
        $this->load->view('User/header',$data1);
        $this->load->view('arthik_saheta_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_arthik_saheta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("arthik-saheta");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_arthik_saheta->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("arthik-saheta");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("arthik-saheta");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('culprit_name', 'अपराधीको नाम', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('arthik-saheta/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/arthik_saheta/';
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
                if($this->Mdl_arthik_saheta->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('arthik-saheta/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('apanga-pramanpatra/edit/'.$id);
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

        $data1['title'] = "नयाँ | आर्थिक सहायता";
        $this->load->view('User/header',$data1);
        $this->load->view('arthik_saheta',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_arthik_saheta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("arthik-saheta");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_arthik_saheta->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("arthik-saheta");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("arthik-saheta/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("arthik-saheta/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."arthik-saheta/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/arthik_saheta";
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
            if($this->Mdl_arthik_saheta->update($id,$data))
            {
                $save['type']               = 9;
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
                redirect(base_url()."arthik-saheta/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."arthik-saheta/detail/".$id);
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
    public function chalani_arthik_saheta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_arthik_saheta->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("arthik-saheta");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("arthik-saheta/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("arthik-saheta/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $chalani_result         = $this->Mdl_chalani->getByFormId($result->form_id);
            $ward = $this->session->userdata('ward_no');
            $is_muncipality = $this->session->userdata('is_muncipality');
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
            if($this->Mdl_arthik_saheta->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("arthik-saheta/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("arthik-saheta");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_arthik_saheta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("arthik-saheta");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_arthik_saheta->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("arthik-saheta");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("arthik-saheta/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('arthik_saheta_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_arthik_saheta()
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
                    $result         = $this->Mdl_arthik_saheta->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_arthik_saheta->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_arthik_saheta->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."arthik-saheta");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_arthik_saheta->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_arthik_saheta->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_arthik_saheta->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_arthik_saheta->getTableName();
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
        $data1['title']     = "आर्थिक सहायता";
        $this->load->view('User/header',$data1);
        $this->load->view('arthik_saheta_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Prabhibik mulyankan   ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_prabhidik_mulyankan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('nepali_chalani_date', 'अदालतको मिति', 'required');
            $this->form_validation->set_rules('chalani_no', 'चलानी नं', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('prabhidik-mulyankan/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/prabhidik_mulyankan/';
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
                $_POST['english_chalani_date']  = DateNepToEng($this->input->post('nepali_chalani_date'));
                $_POST['created_at']            = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']            = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_prabhidik_mulyankan->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 11;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_prabhidik_mulyankan->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('prabhidik-mulyankan/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('prabhidik-mulyankan/create');
                }

            }
        }
        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);
        $data['default']        = getDefault();
        $data1['title'] = "नयाँ | प्राविधिक मुल्यांकन";
        $this->load->view('User/header',$data1);
        $this->load->view('prabhidik_mulyankan',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_prabhidik_mulyankan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("prabhidik-mulyankan");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_prabhidik_mulyankan->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("prabhidik-mulyankan");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | प्राविधिक मुल्यांकन" ;
        $this->load->view('User/header',$data1);
        $this->load->view('prabhidik_mulyankan_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_prabhidik_mulyankan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("prabhidik-mulyankan");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_prabhidik_mulyankan->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("prabhidik-mulyankan");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("prabhidik-mulyankan");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('nepali_chalani_date', 'अदालतको मिति', 'required');
            $this->form_validation->set_rules('chalani_no', 'चलानी नं', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('prabhidik-mulyankan/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/prabhidik_mulyankan/';
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
                $_POST['english_chalani_date']  = DateNepToEng($this->input->post('nepali_chalani_date'));
                if($this->Mdl_prabhidik_mulyankan->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('prabhidik-mulyankan/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('add-classroom/edit/'.$id);
                }

            }
        }
        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);
        $data['default']        = getDefault();
        $data1['title'] = "नयाँ | प्राविधिक मुल्यांकन";
        $this->load->view('User/header',$data1);
        $this->load->view('prabhidik_mulyankan',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_prabhidik_mulyankan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("prabhidik-mulyankan");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_prabhidik_mulyankan->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("prabhidik-mulyankan");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("prabhidik-mulyankan/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("prabhidik-mulyankan/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."prabhidik-mulyankan/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/prabhidik_mulyankan";
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
            if($this->Mdl_prabhidik_mulyankan->update($id,$data))
            {
                $save['type']               = 11;
                $save['applicant_name']     = "-";
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
                redirect(base_url()."prabhidik-mulyankan/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."prabhidik-mulyankan/detail/".$id);
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
    public function chalani_prabhidik_mulyankan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_prabhidik_mulyankan->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("prabhidik-mulyankan");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("prabhidik-mulyankan/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("prabhidik-mulyankan/detail/".$id);
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
            $save['applicant_name']       = "-";
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']            = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
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
            if($this->Mdl_prabhidik_mulyankan->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("prabhidik-mulyankan/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("prabhidik-mulyankan");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_prabhidik_mulyankan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("prabhidik-mulyankan");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_prabhidik_mulyankan->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("prabhidik-mulyankan");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("prabhidik-mulyankan/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('prabhidik_mulyankan_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_prabhidik_mulyankan()
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
                    $result         = $this->Mdl_prabhidik_mulyankan->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_prabhidik_mulyankan->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_prabhidik_mulyankan->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."prabhidik-mulyankan");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_prabhidik_mulyankan->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_prabhidik_mulyankan->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_prabhidik_mulyankan->getByStatus(1,$ward_login);
            }
        }
        else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_prabhidik_mulyankan->getTableName();
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
        $data1['title']     = "प्राविधिक मुल्यांकन";
        $this->load->view('User/header',$data1);
        $this->load->view('prabhidik_mulyankan_view',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Scholarship    ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/

    public function create_scholarship()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        if(isset($_POST['submit'])) {
            $total = $this->input->post('total_forms');

            $this->form_validation->set_rules('nepali_date', 'Applicated Date', 'required');
            $this->form_validation->set_rules('father_name', 'बुवाको नाम', 'required');
            $this->form_validation->set_rules('mother_name', 'आमाको नाम', 'required');
            $this->form_validation->set_rules('resident_type', 'बसोबासको किसिम', 'required');
            $this->form_validation->set_rules('finance_condition', 'आर्थिक अवस्था', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            $this->form_validation->set_rules('ward', 'Ward', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            for($i=0 ; $i < $total; $i++)
            {
                $this->form_validation->set_rules('name_'.$i, 'छोरा/छोरीको नाम', 'required');
                $this->form_validation->set_rules('relation_'.$i, 'नाता', 'required');
            }

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg',validation_errors());
                // $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect("scholarship/create");
            }
            else
            {
                $flag = [];
               $this->db->trans_start();
                $save['nepali_date']        = $this->input->post('nepali_date');
                $save['date']               = DateNepToEng($save['nepali_date']);
                $save['father_name']        = $this->input->post('father_name');
                $save['mother_name']        = $this->input->post('mother_name');
                $save['resident_type']      = $this->input->post('resident_type');
                $save['finance_condition']  = $this->input->post('finance_condition');
                $save['state']              = $this->input->post('state');
                $save['district']           = $this->input->post('district');
                $save['local_body']         = $this->input->post('local_body');
                $save['ward']               = $this->input->post('ward');
                $save['old_place']          = $this->input->post('old_place');
                $save['status']             = 1;
                $save['created_at']         = date("Y-m-d h:i:sa");
                $save['ward_login']         = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $save['session_id']            = $current_session->id;

                $path               = 'assets/documents/others/scholarship/';
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
                if($id = $this->Mdl_scholarship->save($save))
                {


                    for ($i = 0; $i < $total; $i++)
                    {
                        $save1['darta_id']          = $id;
                        $save1['name']              = $this->input->post('name_'.$i);
                        $save1['relation']          = $this->input->post('relation_'.$i);
                        $save1['ghar_no']           = $this->input->post('ghar_no_'.$i);
                        $save1['created_at']        = date("Y-m-d h:i:sa");
                        if($this->Mdl_scholarship_detail->save($save1))
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
                        redirect("scholarship/create");
                    }
                    else
                    {
                          $chalani['darta_id']   = $id;
                          $chalani['type']       = 8;
                          $form['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                          $this->Mdl_chalani->save($chalani);
                          $this->Mdl_scholarship->update($id,$form);
                          $this->db->trans_complete();
                          $this->session->set_flashdata('msg', "सिफारिस पेश गर्न सफल");
                          redirect("scholarship/detail/".$id);
                    }

                }
                else
                {
                    $this->session->set_flashdata('err_msg', "समस्या आयो");
                    redirect("scholarship/create");
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['relations']      = $this->Mdl_relation->getAll();
        $data['addresses']      = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | छात्रवृत्ति सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('scholarship',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    public function detail_scholarship()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("scholarship");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_scholarship->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("scholarship");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['details'] = $this->Mdl_scholarship_detail->getByDartaId($id);
        $data1['title']         = "आवेदकको विवरण | छात्रवृत्ति सिफारिस" ;
        $this->load->view('User/header',$data1);
        $this->load->view('scholarship_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_scholarship()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("scholarship");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_scholarship->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"डेटा भेटिएन | ");
            redirect("scholarship");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("scholarship");
        }
        if(isset($_POST['submit'])) {
            $total = $this->input->post('total_forms');

            $this->form_validation->set_rules('nepali_date', 'Applicated Date', 'required');
            $this->form_validation->set_rules('father_name', 'बुवाको नाम', 'required');
            $this->form_validation->set_rules('mother_name', 'आमाको नाम', 'required');
            $this->form_validation->set_rules('resident_type', 'बसोबासको किसिम', 'required');
            $this->form_validation->set_rules('finance_condition', 'आर्थिक अवस्था', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            $this->form_validation->set_rules('ward', 'Ward', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            for($i=0 ; $i < $total; $i++)
            {
                $this->form_validation->set_rules('name_'.$i, 'छोरा/छोरीको नाम', 'required');
                $this->form_validation->set_rules('relation_'.$i, 'नाता', 'required');
            }

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect("scholarship/edit/".$id);
            }
            else
            {
                $flag = [];
                $this->db->trans_start();
                $save['nepali_date']        = $this->input->post('nepali_date');
                $save['date']               = DateNepToEng($save['nepali_date']);
                $save['father_name']        = $this->input->post('father_name');
                $save['mother_name']        = $this->input->post('mother_name');
                $save['resident_type']      = $this->input->post('resident_type');
                $save['finance_condition']  = $this->input->post('finance_condition');
                $save['state']              = $this->input->post('state');
                $save['district']           = $this->input->post('district');
                $save['local_body']         = $this->input->post('local_body');
                $save['ward']               = $this->input->post('ward');
                $save['old_place']          = $this->input->post('old_place');


                $path               = 'assets/documents/others/scholarship/';
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
                if($this->Mdl_scholarship->update($id,$save))
                {
                    //---------Deleting old record and saving new one----
                    $this->Mdl_scholarship_detail->deleteByDartaId($id);

                    for ($i = 0; $i < $total; $i++)
                    {
                        $save1['darta_id']          = $id;
                        $save1['name']              = $this->input->post('name_'.$i);
                        $save1['relation']          = $this->input->post('relation_'.$i);
                        $save1['ghar_no']           = $this->input->post('ghar_no_'.$i);
                        $save1['created_at']        = date("Y-m-d h:i:sa");

                        if($this->Mdl_scholarship_detail->save($save1))
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
                        redirect("scholarship/edit/".$id);
                    }
                    else
                    {
                        $this->db->trans_complete();
                        $this->session->set_flashdata('msg', "सिफारिस सम्पादन गर्न सफल");
                        redirect("scholarship/detail/".$id);
                    }
                }
                else
                {
                    $this->session->set_flashdata('err_msg', "समस्या आयो");
                    redirect("scholarship/edit/".$id);
                }

            }
        }
        if(!empty($result->document))
        {
            $documents              = explode("+",$result->document);
        }
        $data['default']        = getDefault();
        $data['details']            = $this->Mdl_scholarship_detail->getByDartaId($id);
        $data['states']             = $this->Mdl_state->getAll();
        $data['districts']          = $this->Mdl_district->getAll();
        $data['locals']             = $this->Mdl_local_body->getAll();
        $data['wards']              = $this->Mdl_ward->getAll();
        $data['addresses']          = $this->Mdl_oldnew_address->getAll();
        $data['relations']          = $this->Mdl_relation->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title']             = "नयाँ | छात्रवृत्ति सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('scholarship',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getScholarshipHTML()
    {
        $i = $this->input->post('count');
        $res = [];
        $relations = $this->Mdl_relation->getAll();
        $html ='<tr class="item" id="div_'.$i.'">
                    <td>
                        <input type="text" name="name_'.$i.'" maxlength="120" class="form-control formset-field" id="id_details-0-name" required />
                    </td>
                    <td>
                        <select name="relation_'.$i.'" class="form-control select2">
                            <option value="">छान्नुहोस्</option>';
                            foreach($relations as $relation):
        $html.=             '<option value="'.$relation->id.'">'.$relation->name.'</option>';
                             endforeach;
        $html.=         '</select>
                    </td>
                    <td><input type="text" name="ghar_no_'.$i.'" maxlength="16" class="form-control formset-field" id="id_details-0-ghar_no" /></td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove"
                                id="remove_'.$i.'">
                                <i class="fa fa-close"></i>
                        </button>
                    </td>
                </tr>';
        $res['html'] = $html;
        echo json_encode($res);exit;
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_scholarship()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("scholarship");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_scholarship->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("scholarship");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("scholarship/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("scholarship/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."scholarship/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/scholarship";
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
            if($this->Mdl_scholarship->update($id,$data))
            {
                $save['type']               = 8;
                $save['applicant_name']     = $result->father_name;
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
                redirect(base_url()."scholarship/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."scholarship/detail/".$id);
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
    public function chalani_scholarship()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_scholarship->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("scholarship");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("scholarship/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("scholarship/detail/".$id);
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
            $save['applicant_name']       = $result->father_name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']            = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
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
            if($this->Mdl_scholarship->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("scholarship/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("scholarship");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_scholarship()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("scholarship");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_scholarship->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("scholarship");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("scholarship/detail/".$id);
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
        $data['details']            = $this->Mdl_scholarship_detail->getByDartaId($id);
        $data['chalani_result'] = $result_chalani             = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no']         = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']             = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('scholarship_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_scholarship()
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
                    $result         = $this->Mdl_scholarship->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_scholarship->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_scholarship->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."scholarship");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_scholarship->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_scholarship->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_scholarship->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_scholarship->getTableName();
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
        $data1['title']     = "छात्रवृत्ति सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('scholarship_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Nata Pramanit    ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/

    public function create_nata_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        if(isset($_POST['submit'])) {


            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            $this->form_validation->set_rules('ward', 'Ward', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('name[]', 'व्यक्तिको नाम', 'required');
            $this->form_validation->set_rules('relation[]', 'नाता', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg',validation_errors());
                // $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect("nata-pramanit/create");
            }
            else
            {
                $flag = [];
                $this->db->trans_start();
                $save['applicant_name']      = $this->input->post('applicant_name');
                $save['nepali_date']        = $this->input->post('nepali_date');
                $save['date']               = DateNepToEng($save['nepali_date']);
                $save['state']              = $this->input->post('state');
                $save['district']           = $this->input->post('district');
                $save['local_body']         = $this->input->post('local_body');
                $save['ward']               = $this->input->post('ward');
                $save['gender_spec']        = $this->input->post('gender_spec');
                $save['cit_no']             = $this->input->post('cit_no');
                $save['status']             = 1;
                $save['created_at']         = date("Y-m-d h:i:sa");
                $save['ward_login']         = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $save['session_id']            = $current_session->id;

                $path               = 'assets/documents/others/nata_pramanit/';
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
                if($id = $this->Mdl_nata_pramanit->save($save))
                {

                    $total = count($_POST['name']);
                    for ($i = 0; $i < $total; $i++)
                    {
                        $save1['darta_id']          = $id;
                        $save1['name']              = $this->input->post('name')[$i];
                        $save1['relation']          = $this->input->post('relation')[$i];
                        $save1['add_cit_no']        = $this->input->post('add_cit_no')[$i];
                        $save1['created_at']        = date("Y-m-d h:i:sa");
                        if($this->Mdl_nata_pramanit_detail->save($save1))
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
                        redirect("nata-pramanit/create");
                    }
                    else
                    {
                          $chalani['darta_id']   = $id;
                          $chalani['type']       = 6;
                          $form['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                          $this->Mdl_chalani->save($chalani);
                          $this->Mdl_nata_pramanit->update($id,$form);
                          $this->db->trans_complete();
                          $this->session->set_flashdata('msg', "सिफारिस पेश गर्न सफल");
                          redirect("nata-pramanit/detail/".$id);
                    }
                }
                else
                {
                    $this->session->set_flashdata('err_msg', "समस्या आयो");
                    redirect("nata-pramanit/create");
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

        $data1['title'] = "नयाँ | नाता प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('nata_pramanit',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getNataPramanitHTML()
    {
        $i = $this->input->post('count');
        $res = [];
        $relations = $this->Mdl_relation->getAll();
        $html ='<tr class="item" id="div_'.$i.'">
                    <td>
                        <input type="text" name="name[]" maxlength="120" class="form-control formset-field" id="id_details-0-name" required />
                    </td>
                    <td>
                        <select name="relation[]" class="form-control select2">
                            <option value="">छान्नुहोस्</option>';
                            foreach($relations as $relation):
        $html.=             '<option value="'.$relation->id.'">'.$relation->name.'</option>';
                             endforeach;
        $html.=         '</select>
                    </td>
                    <td>
                    <input type="text" name="add_cit_no[]" maxlength="120" class="form-control formset-field" id="id_cit_no" required />
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove"
                                id="remove_'.$i.'">
                                <i class="fa fa-close"></i>
                        </button>
                    </td>
                </tr>';
        $res['html'] = $html;
        echo json_encode($res);exit;
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    public function detail_nata_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("nata-pramanit");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_nata_pramanit->getById($id);
       
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("nata-pramanit");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
       
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        //pp($data['chalani_no']);
        $data['details'] = $this->Mdl_nata_pramanit_detail->getByDartaId($id);
        $data1['title']         = "आवेदकको विवरण | नाता प्रमाणित" ;
        $this->load->view('User/header',$data1);
        $this->load->view('nata_pramanit_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_nata_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("nata-pramanit");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_nata_pramanit->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"डेटा भेटिएन | ");
            redirect("nata-pramanit");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("nata-pramanit");
        }
        if(isset($_POST['submit'])) {


            $this->form_validation->set_rules('nepali_date', 'Applicated Date', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            $this->form_validation->set_rules('ward', 'Ward', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('name[]', 'छोरा/छोरीको नाम', 'required');
            $this->form_validation->set_rules('relation[]', 'नाता', 'required');


            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect("nata-pramanit/edit/".$id);
            }
            else
            {
                $flag = [];
                $this->db->trans_start();
                $save['nepali_date']        = $this->input->post('nepali_date');
                $save['date']               = DateNepToEng($save['nepali_date']);
                $save['applicant_name']     = $this->input->post('applicant_name');
                $save['state']              = $this->input->post('state');
                $save['district']           = $this->input->post('district');
                $save['local_body']         = $this->input->post('local_body');
                $save['ward']               = $this->input->post('ward');


                $path               = 'assets/documents/others/nata_pramanit/';
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
                if($this->Mdl_nata_pramanit->update($id,$save))
                {
                    //---------Deleting old record and saving new one----
                    $this->Mdl_nata_pramanit_detail->deleteByDartaId($id);
                    $total = count($_POST['name']);
                    for ($i = 0; $i < $total; $i++)
                    {
                        $save1['darta_id']          = $id;
                        $save1['name']              = $this->input->post('name')[$i];
                        $save1['relation']          = $this->input->post('relation')[$i];
                        $save1['created_at']        = date("Y-m-d h:i:sa");

                        if($this->Mdl_nata_pramanit_detail->save($save1))
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
                        redirect("nata-pramanit/edit/".$id);
                    }
                    else
                    {
                        $this->db->trans_complete();
                        $this->session->set_flashdata('msg', "सिफारिस सम्पादन गर्न सफल");
                    }
                    redirect("nata-pramanit/detail/".$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg', "समस्या आयो");
                    redirect("nata-pramanit/edit/".$id);
                }

            }
        }
        if(!empty($result->document))
        {
            $documents              = explode("+",$result->document);
        }
        $data['default']        = getDefault();
        $data['details']            = $this->Mdl_nata_pramanit_detail->getByDartaId($id);
        $data['states']             = $this->Mdl_state->getAll();
        $data['districts']          = $this->Mdl_district->getAll();
        $data['locals']             = $this->Mdl_local_body->getAll();
        $data['wards']              = $this->Mdl_ward->getAll();
        $data['relations']          = $this->Mdl_relation->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title']             = "नयाँ | नाता प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('nata_pramanit',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_nata_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("nata-pramanit");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_nata_pramanit->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("nata-pramanit");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("nata-pramanit/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("nata-pramanit/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."nata-pramanit/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/nata_pramanit";
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
            if($this->Mdl_nata_pramanit->update($id,$data))
            {
                $save['type']               = 6;
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
                redirect(base_url()."nata-pramanit/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."nata-pramanit/detail/".$id);
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
    public function chalani_nata_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_nata_pramanit->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("nata-pramanit");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("nata-pramanit/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("nata-pramanit/detail/".$id);
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
            if($this->Mdl_nata_pramanit->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("nata-pramanit/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("nata-pramanit");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_nata_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("nata-pramanit");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_nata_pramanit->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("nata-pramanit");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("nata-pramanit/detail/".$id);
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
        $data['details']            = $this->Mdl_nata_pramanit_detail->getByDartaId($id);
        $data['chalani_result'] = $result_chalani             = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no']         = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']             = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('nata_pramanit_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_nata_pramanit()
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
                    $result         = $this->Mdl_nata_pramanit->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_nata_pramanit->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_nata_pramanit->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."nata-pramanit");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_nata_pramanit->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_nata_pramanit->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_nata_pramanit->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_nata_pramanit->getTableName();
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
        $data1['title']     = "नाता प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('nata_pramanit_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Kotha Khali Suchana  ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_kotha_khali_suchana()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('kotha-khali-suchana/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/kotha_khali_suchana/';
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
                if($id = $this->Mdl_kotha_khali_suchana->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 11;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_kotha_khali_suchana->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('kotha-khali-suchana/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('kotha-khali-suchana/create');
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

        $data1['title'] = "नयाँ | कोठा खाली सूचना";
        $this->load->view('User/header',$data1);
        $this->load->view('kotha_khali_suchana',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_kotha_khali_suchana()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("kotha-khali-suchana");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_kotha_khali_suchana->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("kotha-khali-suchana");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | कोठा खाली सूचना" ;
        $this->load->view('User/header',$data1);
        $this->load->view('kotha_khali_suchana_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_kotha_khali_suchana()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("kotha-khali-suchana");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_kotha_khali_suchana->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("kotha-khali-suchana");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("kotha-khali-suchana");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('kotha-khali-suchana/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/kotha_khali_suchana/';
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
                if($this->Mdl_kotha_khali_suchana->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('kotha-khali-suchana/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('kotha-khali-suchana/edit/'.$id);
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

        $data1['title'] = "नयाँ | कोठा खाली सूचना";
        $this->load->view('User/header',$data1);
        $this->load->view('kotha_khali_suchana',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_kotha_khali_suchana()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("kotha-khali-suchana");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_kotha_khali_suchana->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("kotha-khali-suchana");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("kotha-khali-suchana/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("kotha-khali-suchana/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."kotha-khali-suchana/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/kotha_khali_suchana";
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
            if($this->Mdl_kotha_khali_suchana->update($id,$data))
            {
                $save['type']               = 11;
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
                redirect(base_url()."kotha-khali-suchana/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."kotha-khali-suchana/detail/".$id);
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
    public function chalani_kotha_khali_suchana()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_kotha_khali_suchana->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("kotha-khali-suchana");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("kotha-khali-suchana/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("kotha-khali-suchana/detail/".$id);
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
            if($this->Mdl_kotha_khali_suchana->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("kotha-khali-suchana/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("kotha-khali-suchana");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_kotha_khali_suchana()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("kotha-khali-suchana");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_kotha_khali_suchana->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("kotha-khali-suchana");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("kotha-khali-suchana/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('kotha_khali_suchana_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_kotha_khali_suchana()
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
                    $result         = $this->Mdl_kotha_khali_suchana->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_kotha_khali_suchana->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_kotha_khali_suchana->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."kotha-khali-suchana");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_kotha_khali_suchana->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_kotha_khali_suchana->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_kotha_khali_suchana->getByStatus(1,$ward_login);
            }
        }else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_kotha_khali_suchana->getTableName();
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
        $data1['title']     = "कोठा खाली सूचना";
        $this->load->view('User/header',$data1);
        $this->load->view('kotha_khali_suchana_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Adalat sulka minha  ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_court_fee()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('gender', 'लिङ्ग', 'required');
            $this->form_validation->set_rules('husband_wife_name', 'पति/पत्नीको नाम', 'required');
            $this->form_validation->set_rules('court_name', 'अदालतको नाम', 'required');
            $this->form_validation->set_rules('case_type', 'मुद्धाको प्रकार', 'required');
            $this->form_validation->set_rules('nepali_visit_date', 'सर्जिमानको मिति', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('court-fee/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/court_fee/';
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
                if($id = $this->Mdl_court_fee->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 9;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_court_fee->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('court-fee/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('court-fee/create');
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['addresses']      = $this->Mdl_oldnew_address->getAll();
        $data['old_new_addresses'] = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | अदालत सुल्क मिन्हा";
        $this->load->view('User/header',$data1);
        $this->load->view('court_fee',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_court_fee()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("court-fee");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_court_fee->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("court-fee");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | कोठा खाली सूचना" ;
        $this->load->view('User/header',$data1);
        $this->load->view('court_fee_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_court_fee()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("court-fee");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_court_fee->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("court-fee");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("court-fee");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('court-fee/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/court_fee/';
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
                if($this->Mdl_court_fee->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('court-fee/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('court-fee/edit/'.$id);
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

        $data1['title'] = "नयाँ | अदालतको शुल्क मिन्हा";
        $this->load->view('User/header',$data1);
        $this->load->view('court_fee',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_court_fee()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("court-fee");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_court_fee->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("court-fee");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("court-fee/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("court-fee/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."court-fee/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/court_fee";
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
            if($this->Mdl_court_fee->update($id,$data))
            {
                $save['type']               = 9;
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
                redirect(base_url()."court-fee/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."court-fee/detail/".$id);
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
    public function chalani_court_fee()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_court_fee->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("court-fee");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("court-fee/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("court-fee/detail/".$id);
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
            if($this->Mdl_court_fee->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("court-fee/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("court-fee");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_court_fee()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("court-fee");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_court_fee->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("court-fee");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("court-fee/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('court_fee_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_court_fee()
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
                    $result         = $this->Mdl_court_fee->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_court_fee->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_court_fee->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."court-fee");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_court_fee->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_court_fee->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_court_fee->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_court_fee->getTableName();
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
        $data1['title']     = "अदालतको शुल्क मिन्हा";
        $this->load->view('User/header',$data1);
        $this->load->view('court_fee_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Hakdar Pramanit   ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_hakdar_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('mritak_ko_name', 'मृतकको नाम', 'required');
            $this->form_validation->set_rules('hakdar_ko_no', 'हकदारको संख्या', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('hakdar_ko_name', 'हकदारको नाम', 'required');
            $this->form_validation->set_rules('citizenship_no', 'हकदारको ना.नं.', 'required');
            $this->form_validation->set_rules('relation', 'नाता', 'required');
            $this->form_validation->set_rules('father_husband_name', 'बुवा / पतिको नाम', 'required');
            // $this->form_validation->set_rules('ghar_no', 'घर नं', 'required');
            $this->form_validation->set_rules('kitta_no', 'कित्ता नं.', 'required');
            $this->form_validation->set_rules('home_type', 'घरको प्रकार', 'required');
            $this->form_validation->set_rules('nep_darta_date', 'दर्ता मिति', 'required');
            $this->form_validation->set_rules('darta_no', 'दर्ता नं.', 'required');


            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('hakdar-pramanit/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/hakdar_pramanit/';
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
                $_POST['eng_darta_date']        = DateNepToEng($this->input->post('nep_darta_date'));
                $_POST['created_at']            = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']            = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_hakdar_pramanit->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 6;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_hakdar_pramanit->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('hakdar-pramanit/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('hakdar-pramanit/create');
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['relations']      = $this->Mdl_relation->getAll();
        $data['home_types']     = $this->Mdl_home_type->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | हकदार प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('hakdar_pramanit',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_hakdar_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("hakdar-pramanit");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_hakdar_pramanit->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("hakdar-pramanit");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | हकदार प्रमाणित" ;
        $this->load->view('User/header',$data1);
        $this->load->view('hakdar_pramanit_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_hakdar_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("hakdar-pramanit");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_hakdar_pramanit->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("hakdar-pramanit");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("hakdar-pramanit");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('mritak_ko_name', 'मृतकको नाम', 'required');
            $this->form_validation->set_rules('hakdar_ko_no', 'हकदारको संख्या', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('hakdar_ko_name', 'हकदारको नाम', 'required');
            $this->form_validation->set_rules('citizenship_no', 'हकदारको ना.नं.', 'required');
            $this->form_validation->set_rules('relation', 'नाता', 'required');
            $this->form_validation->set_rules('father_husband_name', 'बुवा / पतिको नाम', 'required');
            // $this->form_validation->set_rules('ghar_no', 'घर नं', 'required');
            $this->form_validation->set_rules('kitta_no', 'कित्ता नं.', 'required');
            $this->form_validation->set_rules('home_type', 'घरको प्रकार', 'required');
            $this->form_validation->set_rules('nep_darta_date', 'दर्ता मिति', 'required');
            $this->form_validation->set_rules('darta_no', 'दर्ता नं.', 'required');


            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('hakdar-pramanit/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/hakdar_pramanit/';
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
                $_POST['eng_darta_date']        = DateNepToEng($this->input->post('nep_darta_date'));
                if($this->Mdl_hakdar_pramanit->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('hakdar-pramanit/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('hakdar-pramanit/edit/'.$id);
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['relations']      = $this->Mdl_relation->getAll();
        $data['home_types']     = $this->Mdl_home_type->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | हकदार प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('hakdar_pramanit',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_hakdar_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("hakdar-pramanit");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_hakdar_pramanit->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("hakdar-pramanit");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("hakdar-pramanit/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("hakdar-pramanit/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."hakdar-pramanit/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/hakdar_pramanit";
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
            if($this->Mdl_hakdar_pramanit->update($id,$data))
            {
                $save['type']               = 6;
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
                redirect(base_url()."hakdar-pramanit/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."hakdar-pramanit/detail/".$id);
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
    public function chalani_hakdar_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_hakdar_pramanit->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("hakdar-pramanit");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("hakdar-pramanit/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("hakdar-pramanit/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $chalani_result         = $this->Mdl_chalani->getByFormId($result->form_id);
            $ward = $this->session->userdata('ward_no');
            $is_muncipality = $this->session->userdata('is_muncipality');
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
            if($this->Mdl_hakdar_pramanit->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("hakdar-pramanit/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("hakdar-pramanit");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_hakdar_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("hakdar-pramanit");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_hakdar_pramanit->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("hakdar-pramanit");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("hakdar-pramanit/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('hakdar_pramanit_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_hakdar_pramanit()
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
                    $result         = $this->Mdl_hakdar_pramanit->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_hakdar_pramanit->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_hakdar_pramanit->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."hakdar-pramanit");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_hakdar_pramanit->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_hakdar_pramanit->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_hakdar_pramanit->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_hakdar_pramanit->getTableName();
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
        $data1['title']     = "हकदार प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('hakdar_pramanit_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Sadak Khanne Swikriti ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_sadak_khanne_swikriti()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            //$this->form_validation->set_rules('gender', 'आवेदकको लिङ्ग', 'required');
            $this->form_validation->set_rules('nep_applicated_date', 'निवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            // $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('completion_time', 'कार्य सम्पन्न गर्नुपर्ने दिन', 'required');
            $this->form_validation->set_rules('road_name', 'स्वीकृत गरिएको सडकको नाम', 'required');
            $this->form_validation->set_rules('road_quantity', 'स्वीकृत गरिएको इकाई', 'required');
            $this->form_validation->set_rules('refundable_amount', 'धरौटी रकम', 'required');


            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('sadak-khanne-swikriti/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/sadak_khanne_swikriti/';
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
                $_POST['eng_applicated_date']   = DateNepToEng($this->input->post('nep_applicated_date'));
                $_POST['created_at']            = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']            = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_sadak_khanne_swikriti->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 7;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_sadak_khanne_swikriti->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                     redirect('sadak-khanne-swikriti/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                     redirect('sadak-khanne-swikriti/create');
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['relations']      = $this->Mdl_relation->getAll();
        $data['home_types']     = $this->Mdl_home_type->getAll();
        $data['old_new_addresses'] = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | सडक खन्ने स्वीकृति";
        $this->load->view('User/header',$data1);
        $this->load->view('sadak_khanne_swikriti',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_sadak_khanne_swikriti()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sadak-khanne-swikriti");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_sadak_khanne_swikriti->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sadak-khanne-swikriti");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail']   = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']        = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | सडक खन्ने स्वीकृती" ;
        $this->load->view('User/header',$data1);
        $this->load->view('sadak_khanne_swikriti_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_sadak_khanne_swikriti()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sadak-khanne-swikriti");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_sadak_khanne_swikriti->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("sadak-khanne-swikriti");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("sadak-khanne-swikriti");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('gender', 'आवेदकको लिङ्ग', 'required');
            $this->form_validation->set_rules('nep_applicated_date', 'निवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            // $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('completion_time', 'कार्य सम्पन्न गर्नुपर्ने दिन', 'required');
            $this->form_validation->set_rules('road_name', 'स्वीकृत गरिएको सडकको नाम', 'required');
            $this->form_validation->set_rules('road_quantity', 'स्वीकृत गरिएको इकाई', 'required');
            $this->form_validation->set_rules('refundable_amount', 'धरौटी रकम', 'required');


            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('sadak-khanne-swikriti/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/sadak_khanne_swikriti/';
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
                $_POST['eng_applicated_date']   = DateNepToEng($this->input->post('nep_applicated_date'));
                if($this->Mdl_sadak_khanne_swikriti->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('sadak-khanne-swikriti/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('sadak-khanne-swikriti/edit/'.$id);
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

        $data1['title'] = "नयाँ | सडक खन्ने स्वीकृति";
        $this->load->view('User/header',$data1);
        $this->load->view('sadak_khanne_swikriti',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_sadak_khanne_swikriti()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("sadak-khanne-swikriti");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_sadak_khanne_swikriti->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sadak-khanne-swikriti");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("sadak-khanne-swikriti/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("sadak-khanne-swikriti/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."sadak-khanne-swikriti/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/sadak_khanne_swikriti";
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
            if($this->Mdl_sadak_khanne_swikriti->update($id,$data))
            {
                $save['type']               = 7;
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
                redirect(base_url()."sadak-khanne-swikriti/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."sadak-khanne-swikriti/detail/".$id);
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
    public function chalani_sadak_khanne_swikriti()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_sadak_khanne_swikriti->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sadak-khanne-swikriti");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("sadak-khanne-swikriti/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("sadak-khanne-swikriti/detail/".$id);
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
            if($this->Mdl_sadak_khanne_swikriti->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("sadak-khanne-swikriti/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("sadak-khanne-swikriti");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_sadak_khanne_swikriti()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("sadak-khanne-swikriti");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_sadak_khanne_swikriti->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sadak-khanne-swikriti");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("sadak-khanne-swikriti/detail/".$id);
        }
        $page   = $this->uri->segment(4);
        if(!in_array($page,[1,2]))
        {
            $this->session->set_flashdata('err_msg',"प्रिन्ट पृष्ट छान्नुहोस् |");
            redirect("sadak-khanne-swikriti/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            if(isset($_POST['worker_id']))
            {
                $save['worker_id'] = $_POST['ward_worker'];
            }

            if(isset($_POST['office_id']))
            {
                $save['office_id'] = $_POST['office_id'];
            }

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
        
        
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        if($page == 1)
        {
            $data['print_office']         = $this->Mdl_office->getById($_POST['office_id']);
            $this->load->view('sadak_khanne_swikriti_print1',$data);
        }
        else
        {
            $data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
            $this->load->view('sadak_khanne_swikriti_print2',$data);
        }
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_sadak_khanne_swikriti()
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
                    $result         = $this->Mdl_sadak_khanne_swikriti->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_sadak_khanne_swikriti->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_sadak_khanne_swikriti->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."sadak-khanne-swikriti");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_sadak_khanne_swikriti->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_sadak_khanne_swikriti->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_sadak_khanne_swikriti->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_sadak_khanne_swikriti->getTableName();
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
        $data1['title']     = "सडक खन्ने स्वीकृती";
        $this->load->view('User/header',$data1);
        $this->load->view('sadak_khanne_swikriti_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Farak Name Thar  ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_farak_nam_thar()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('farak_name', 'फरक भएको', 'required');
            $this->form_validation->set_rules('farak_bhayeko_document', 'फरक भएको कागजात', 'required');
            $this->form_validation->set_rules('thik_bhayeko_document', 'ठिक भएको कागजात', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('farak-nam-thar/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/farak_nam_thar/';
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
                if($id = $this->Mdl_farak_nam_thar->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 6;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_farak_nam_thar->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('farak-nam-thar/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('farak-nam-thar/create');
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

        $data1['title'] = "नयाँ |  फरक नाम र थर सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('farak_nam_thar',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_farak_nam_thar()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("farak-nam-thar");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_farak_nam_thar->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("farak-nam-thar");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail']   = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']        = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | फरक नाम र थर सिफारिस" ;
        $this->load->view('User/header',$data1);
        $this->load->view('farak_nam_thar_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_farak_nam_thar()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("farak-nam-thar");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_farak_nam_thar->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("farak-nam-thar");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("farak-nam-thar");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('farak_name', 'फरक भएको', 'required');
            $this->form_validation->set_rules('farak_bhayeko_document', 'फरक भएको कागजात', 'required');
            $this->form_validation->set_rules('thik_bhayeko_document', 'ठिक भएको कागजात', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');


            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('farak-nam-thar/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/farak_nam_thar/';
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
                if($this->Mdl_farak_nam_thar->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('farak-nam-thar/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('farak-nam-thar/edit/'.$id);
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

        $data1['title'] = "नयाँ | फरक नाम र थर सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('farak_nam_thar',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_farak_nam_thar()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("farak-nam-thar");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_farak_nam_thar->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("farak-nam-thar");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("farak-nam-thar/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("farak-nam-thar/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."farak-nam-thar/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/farak_nam_thar";
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
            if($this->Mdl_farak_nam_thar->update($id,$data))
            {
                $save['type']               = 6;
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
                redirect(base_url()."farak-nam-thar/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."farak-nam-thar/detail/".$id);
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
    public function chalani_farak_nam_thar()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_farak_nam_thar->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("farak-nam-thar");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("farak-nam-thar/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("farak-nam-thar/detail/".$id);
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
            if($this->Mdl_farak_nam_thar->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("farak-nam-thar/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("farak-nam-thar");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_farak_nam_thar()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("farak-nam-thar");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_farak_nam_thar->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("farak-nam-thar");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("farak-nam-thar/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('farak_nam_thar_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_farak_nam_thar()
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
                    $result         = $this->Mdl_farak_nam_thar->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_farak_nam_thar->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_farak_nam_thar->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."farak-nam-thar");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_farak_nam_thar->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_farak_nam_thar->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_farak_nam_thar->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_farak_nam_thar->getTableName();
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
        $data1['title']     = "फरक नाम र थर सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('farak_nam_thar_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Jet Machine   ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_jet_machine()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('machine_dine_tham', 'मेशिन उपलब्द गराउनुपर्ने स्थान', 'required');
            $this->form_validation->set_rules('road_name', 'बाटोको नाम', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                // $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                $this->session->set_flashdata('err_msg', validation_errors());
                redirect('jet-machine/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/jet_machine/';
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
                if($id = $this->Mdl_jet_machine->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 7;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_jet_machine->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('jet-machine/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('jet-machine/create');
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

        $data1['title']         = "नयाँ | जेट मेशिन";
        $this->load->view('User/header',$data1);
        $this->load->view('jet_machine',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_jet_machine()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("jet-machine");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_jet_machine->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("jet-machine");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail']   = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']        = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | जेट मेशिन" ;
        $this->load->view('User/header',$data1);
        $this->load->view('jet_machine_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_jet_machine()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("jet-machine");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_jet_machine->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("jet-machine");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("jet-machine");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('machine_dine_tham', 'मेशिन उपलब्द गराउनुपर्ने स्थान', 'required');
            $this->form_validation->set_rules('road_name', 'बाटोको नाम', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('jet-machine/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/jet_machine/';
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
                if($this->Mdl_jet_machine->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('jet-machine/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('jet-machine/edit/'.$id);
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

        $data1['title'] = "नयाँ | जेट मेशिन";
        $this->load->view('User/header',$data1);
        $this->load->view('jet_machine',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_jet_machine()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("jet-machine");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_jet_machine->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("jet-machine");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("jet-machine/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("jet-machine/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."jet-machine/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/jet_machine";
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
            if($this->Mdl_jet_machine->update($id,$data))
            {
                $save['type']               = 7;
                $save['applicant_name']     = "-";
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
                redirect(base_url()."jet-machine/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."jet-machine/detail/".$id);
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
    public function chalani_jet_machine()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_jet_machine->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("jet-machine");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("jet-machine/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("jet-machine/detail/".$id);
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
            $save['applicant_name']       = "-";
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']            = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
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
            if($this->Mdl_jet_machine->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("jet-machine/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("jet-machine");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_jet_machine()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("jet-machine");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_jet_machine->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("jet-machine");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("jet-machine/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('jet_machine_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_jet_machine()
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
                    $result         = $this->Mdl_jet_machine->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_jet_machine->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_jet_machine->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."jet_machine");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_jet_machine->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_jet_machine->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_jet_machine->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_jet_machine->getTableName();
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
        $data1['title']     = "कक्षा कोठा थप";
        $this->load->view('User/header',$data1);
        $this->load->view('jet_machine_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
   /*------- Bibaha Pramanit Pramanpatra     ---------------------*/
   /*------------------------------------------------------------------------------------------------------------------*/
    public function view_bibaha_pramanit()
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
                   $result         = $this->Mdl_bibaha_pramanit->searchByWord($search,$ward_login);
                   $data['result'] = $result;
               }

               if(isset($_GET['status']))
               {
                   $status         = $this->input->get('status');
                   if($status == 0)
                   {
                       $data['result']     = $this->Mdl_bibaha_pramanit->getAll($ward_login);
                   }
                   else
                   {
                       $data['result']     = $this->Mdl_bibaha_pramanit->getByStatus($status,$ward_login);
                   }
               }

               if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
               {
                   if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                   {
                       $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                       redirect(base_url()."bibaha_pramanit");
                   }
                   $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                   $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                   $data['result'] = $this->Mdl_bibaha_pramanit->getByDates($start_date,$end_date,$ward_login);
               }
               if(isset($_GET['month']))
               {
                   $month      = $this->input->get('month');
                   $end_date   = date("Y-m-d");
                   $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                   $data['result'] = $this->Mdl_bibaha_pramanit->getByDates($start_date,$end_date,$ward_login);
               }

           }
           else
           {
               $data['result']     = $this->Mdl_bibaha_pramanit->getByStatus(1,$ward_login);
           }
       }
       else
       {
           $url = $this->uri->segment(1);
           $department = $this->session->userdata('department');
           $table_name = $this->Mdl_bibaha_pramanit->getTableName();
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
       $data1['title']     = "विवाह प्रमाणित";
       $this->load->view('User/header',$data1);
       $this->load->view('bibaha_pramanit_view',$data);
       $this->load->view('User/footer');
    }

    public function create_bibaha_pramanit()
    {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
       Modules::run("User/checkWardLogin");
       if(isset($_POST['submit']))
       {
           $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
           $this->form_validation->set_rules('marriage_date_nepali', 'विवाह भएको मिति', 'required');
           $this->form_validation->set_rules('marriage_type', 'विवाह प्रकार', 'required');
           $this->form_validation->set_rules('g_name', 'नाम', 'required');
           $this->form_validation->set_rules('g_citizenship_no', 'दुलाहाको नागरिकता/राहदानी नं', 'required');
           $this->form_validation->set_rules('g_grand_father_name', 'हजुर बुवाको नाम', 'required');
           $this->form_validation->set_rules('g_father_name', 'बुवाको नाम', 'required');
           $this->form_validation->set_rules('g_mother_name', 'आमाको नाम', 'required');
           $this->form_validation->set_rules('g_state', 'प्रदेश', 'required');
           $this->form_validation->set_rules('g_district', 'जिल्ला', 'required');
           $this->form_validation->set_rules('g_local_body', 'गा.वि.स./न.पा.', 'required');
           $this->form_validation->set_rules('g_ward', 'वडा नं', 'required');
           $this->form_validation->set_rules('g_old_address', 'साबिक ठेगाना', 'required');
           $this->form_validation->set_rules('b_name', 'नाम', 'required');
           $this->form_validation->set_rules('b_citizenship_no', 'दुलहीको नागरिकता/राहदानी नं', 'required');
           $this->form_validation->set_rules('b_grand_father_name', 'हजुर बुवाको नाम', 'required');
           $this->form_validation->set_rules('b_father_name', 'बुवाको नाम', 'required');
           $this->form_validation->set_rules('b_mother_name', 'आमाको नाम', 'required');
           $this->form_validation->set_rules('b_state', 'प्रदेश', 'required');
           $this->form_validation->set_rules('b_district', 'जिल्ला', 'required');
           $this->form_validation->set_rules('b_local_body', 'गा.वि.स./न.पा.', 'required');
           $this->form_validation->set_rules('b_ward', 'वडा नं', 'required');
           $this->form_validation->set_rules('b_old_address', 'साबिक ठेगाना', 'required');

           if ($this->form_validation->run() == FALSE)
           {
              // $this->session->set_flashdata('err_msg', validation_errors());
               $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
               redirect('bibaha-pramanit/create');

           }
           else
           {
               unset($_POST['submit']);
               $path = 'assets/documents/others/bibaha_pramanit/';
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
               $_POST['marriage_date']             = DateNepToEng($this->input->post('marriage_date_nepali'));
               $_POST['created_at']                = date("Y-m-d h:i:sa",time());
               $_POST['ward_login']                = $this->session->userdata('ward_no');
               $current_session                = Modules::run("Settings/getCurrentSession");
               $_POST['session_id']            = $current_session->id;
               if($id = $this->Mdl_bibaha_pramanit->save($this->input->post()))
               {
                   $chalani['darta_id']   = $id;
                   $chalani['type']       = 6;
                   $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                   $this->Mdl_chalani->save($chalani);
                   $this->Mdl_bibaha_pramanit->update($id,$save);
                   $this->session->set_flashdata('msg',"विबाह प्रमाणित प्रमाणपत्र सिफारिस पेश गर्न सफल |");
                   redirect('bibaha-pramanit/detail/'.$id);
               }
               else
               {
                   $this->session->set_flashdata('err_msg',"समस्या आयो |");
                   redirect('bibaha-pramanit/create');
               }

           }

       }
       $data['default']        = getDefault();
       $data['states']         = $this->Mdl_state->getAll();
       $data['districts']      = $this->Mdl_district->getAll();
       $data['locals']         = $this->Mdl_local_body->getAll();
     //  print_r($data['locals']);exit;
       $data['wards']          = $this->Mdl_ward->getAll();
       $data['old_new']        = $this->Mdl_oldnew_address->getAll();
       $data['marriage_types'] = $this->Mdl_marriage_type->getAll();

       $patra_url              = $this->uri->segment(1);
       $patra = $this->Mdl_patra_item->getByURI($patra_url);
       $data['patra_id']  = $patra->id;
       $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

       $data1['title'] = "नयाँ | विबाह प्रमाणित दर्ता प्रमाणपत्र";
       $this->load->view('User/header',$data1);
       $this->load->view('bibaha_pramanit',$data);
       $this->load->view('User/footer');
    }
   /*---------------------------------------------------------------------------------------------------------------------------------*/
   public function edit_bibaha_pramanit()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
       Modules::run("User/checkWardLogin");
       if(empty($this->uri->segment(3)))
       {
           $this->session->set_flashdata('err_msg',"समस्या आयो | ");
           redirect("bibaha-pramanit");
       }
       $id         = $this->uri->segment(3);
       $result     = $data['result']     = $this->Mdl_bibaha_pramanit->getById($id);
       if(empty($data['result']))
       {
           $this->session->set_flashdata("err_msg","समस्या आयो |");
           redirect("bibaha-pramanit");
       }
       if($result->status == 3)
       {
           $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
           redirect("bibaha-pramanit");
       }
       if(isset($_POST['submit'])) {
           $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
           $this->form_validation->set_rules('marriage_date_nepali', 'विवाह भएको मिति', 'required');
           $this->form_validation->set_rules('marriage_type', 'विवाह प्रकार', 'required');
           $this->form_validation->set_rules('g_name', 'नाम', 'required');
           $this->form_validation->set_rules('g_grand_father_name', 'हजुर बुवाको नाम', 'required');
           $this->form_validation->set_rules('g_father_name', 'बुवाको नाम', 'required');
           $this->form_validation->set_rules('g_mother_name', 'आमाको नाम', 'required');
           $this->form_validation->set_rules('g_state', 'प्रदेश', 'required');
           $this->form_validation->set_rules('g_district', 'जिल्ला', 'required');
           $this->form_validation->set_rules('g_local_body', 'गा.वि.स./न.पा.', 'required');
           $this->form_validation->set_rules('g_ward', 'वडा नं', 'required');
           $this->form_validation->set_rules('g_old_address', 'साबिक ठेगाना', 'required');
           $this->form_validation->set_rules('b_name', 'नाम', 'required');
           $this->form_validation->set_rules('b_grand_father_name', 'हजुर बुवाको नाम', 'required');
           $this->form_validation->set_rules('b_father_name', 'बुवाको नाम', 'required');
           $this->form_validation->set_rules('b_mother_name', 'आमाको नाम', 'required');
           $this->form_validation->set_rules('b_state', 'प्रदेश', 'required');
           $this->form_validation->set_rules('b_district', 'जिल्ला', 'required');
           $this->form_validation->set_rules('b_local_body', 'गा.वि.स./न.पा.', 'required');
           $this->form_validation->set_rules('b_ward', 'वडा नं', 'required');
           $this->form_validation->set_rules('b_old_address', 'साबिक ठेगाना', 'required');

           if ($this->form_validation->run() == FALSE)
           {
              // $this->session->set_flashdata('err_msg', validation_errors());
               $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
               redirect('bibaha-pramanit/edit/'.$id);

           }
           else
           {
               unset($_POST['submit']);
               $path = 'assets/documents/others/bibaha_pramanit/';
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

               $_POST['date']                      = DateNepToEng($this->input->post('nepali_date'));
               $_POST['marriage_date']             = DateNepToEng($this->input->post('marriage_date_nepali'));

               if($this->Mdl_bibaha_pramanit->update($id , $this->input->post()))
               {
                   $this->session->set_flashdata('msg',"व्यवसाय दर्ता प्रमाणपत्र सिफारिस सम्पादन गर्न सफल |");
                   redirect('bibaha-pramanit/detail/'.$id);
               }
               else
               {
                   $this->session->set_flashdata('err_msg',"समस्या आयो |");
                   redirect('bibaha-pramanit/edit/'.$id);
               }

           }
       }
       $data['default']        = getDefault();
       $data['states']         = $this->Mdl_state->getAll();
       $data['districts']      = $this->Mdl_district->getAll();
       $data['locals']         = $this->Mdl_local_body->getAll();
       $data['wards']          = $this->Mdl_ward->getAll();
       $data['old_new']        = $this->Mdl_oldnew_address->getAll();
       $data['marriage_types'] = $this->Mdl_marriage_type->getAll();

       $patra_url              = $this->uri->segment(1);
       $patra = $this->Mdl_patra_item->getByURI($patra_url);
       $data['patra_id']  = $patra->id;
       $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

      $data1['title'] = "नयाँ | विबाह प्रमाणित दर्ता प्रमाणपत्र";
       $this->load->view('User/header',$data1);
       $this->load->view('bibaha_pramanit',$data);
       $this->load->view('User/footer');
   }
  /*---------------------------------------------------------------------------------------------*/

   public function detail_bibaha_pramanit()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
       Modules::run("User/checkWardLogin");
       if(empty($this->uri->segment(3)))
       {
           $this->session->set_flashdata('err_msg',"समस्या आयो | ");
           redirect("bibaha-pramanit");
       }
       $id         = $this->uri->segment(3);
       $result     = $data['result']     = $this->Mdl_bibaha_pramanit->getById($id);
       if(empty($data['result']))
       {
           $this->session->set_flashdata('err_msg',"समस्या आयो | ");
           redirect("bibaha-pramanit");
       }
       $data['offices']    = $this->Mdl_office->getAll();
       $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
       $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
       $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
       if($result->status == 3)
       {
           $data['chalani_no'] = $chalani_result->chalani_no;
       }
       $data1['title']     = "आवेदकको विवरण | विवाह प्रमाणित प्रमाणपत्र" ;
       $this->load->view('User/header',$data1);
       $this->load->view('bibaha_pramanit_detail',$data);
       $this->load->view('User/footer');
   }

  /*---------------------------------------------------------------------------------------------------------*/
   public function darta_bibaha_pramanit()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
       Modules::run("User/checkWardLogin");
       if(empty($this->uri->segment(3)))
       {
           $this->session->set_flashdata('err_msg',"समस्या आयो |");
           redirect("bibaha-pramanit");
       }
       $id         = $this->uri->segment(3);
       $result     = $this->Mdl_bibaha_pramanit->getById($id);
       if(empty($result))
       {
           $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
           redirect("bibaha-pramanit");
       }
       if($result->status == 2)
       {
           $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
           redirect("bibaha-pramanit/detail/".$id);
       }
       if($result->status == 3)
       {
           $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
           redirect("bibaha-pramanit/detail/".$id);
       }
       if(isset($_POST['submit']))
       {
           $files = $_FILES;
           $dataInfo = [];
           $count = count($_FILES['documents']['name']);

        //   if($_FILES['documents']['name'][0] == "")
        //   {
        //       $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
        //       redirect(base_url()."bibaha-pramanit/darta/".$id);
        //   }
           $filename = "";
           $path  = "assets/documents/others/bibaha_pramanit";
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
           if($this->Mdl_bibaha_pramanit->update($id,$data))
           {
               $save['type']               = 6;
               $save['applicant_name']     = $result->g_name;
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
               redirect(base_url()."bibaha-pramanit/detail/".$id);
           }
           else
           {
               $this->session->set_flashdata('err_msg',"समस्या आयो |");
               redirect(base_url()."bibaha-pramanit/detail/".$id);
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
  /*---------------------------------------------------------------------------------------------------*/
  public function chalani_bibaha_pramanit()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
       Modules::run("User/checkWardLogin");
       $id         = $this->uri->segment(3);
       $result     = $this->Mdl_bibaha_pramanit->getById($id);
       if(empty($result))
       {
           $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
           redirect("bibaha-pramanit");
       }
       if($result->status == 1)
       {
           $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
           redirect("bibaha-pramanit/detail/".$id);
       }
       if($result->status == 3)
       {
           $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
           redirect("bibaha-pramanit/detail/".$id);
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

           $data['status']         = 3;
           if($this->Mdl_bibaha_pramanit->update($id,$data))
           {
               $save['english_chalani_miti'] = date("Y-m-d",time());
               $save['nepali_chalani_miti']  = DateEngToNep($save['english_chalani_miti']);
               $save['applicant_name']       = $result->g_name;
               $save['ward_login']         = $this->session->userdata('ward_no');
               $save['uri']                = $this->uri->segment(1);
               $current_session                = Modules::run("Settings/getCurrentSession");
               $save['session_id']            = $current_session->id;
               $save['user_id']            = $this->session->userdata('id');
               $save['czn_no'] = $result->g_citizenship_no;
               if(!empty($_POST['department']))
               {
                   $save['department']     = $this->input->post('department');
               }
               if(!empty($_POST['department_other']))
               {
                   $save['department_other'] = $this->input->post('department_other');
               }
               $this->Mdl_chalani->update($chalani_result->id,$save);
               $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
               redirect("bibaha-pramanit/detail/".$id);
           }
           else
           {
               $this->session->set_flashdata('err_msg',"समस्या आयो |");
               redirect("bibaha-pramanit");
           }
       }
       $data['departments']     = $this->Mdl_department->getAll();
       $data1['title']         = "Approve";
       $this->load->view('User/header',$data1);
       $this->load->view('Home/chalani',$data);
       $this->load->view('User/footer');
   }
  /*------------------------------------------------------------------------------------------------------------------*/
   public function print_bibaha_pramanit()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
       Modules::run("User/checkWardLogin");
       if(empty($this->uri->segment(3)))
       {
           $this->session->set_flashdata('err_msg',"समस्या आयो |");
           redirect("bibaha-pramanit");
       }
       $id         = $this->uri->segment(3);
       $data['result'] = $result     = $this->Mdl_bibaha_pramanit->getById($id);
       if(empty($result))
       {
           $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
           redirect("bibaha-pramanit");
       }
       if($result->status != 3)
       {
           $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
           redirect("bibaha-pramanit/detail/".$id);
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
       $this->load->view('bibaha_pramanit_print',$data);
       $this->load->view('letter_footer');
       $this->load->view('User/footer');
   }
   /*------------------------------------------------------------------------------------------------*/
   /*----------------------------------Khanepani Jadan------------------------------------------------*/
    /*------------------------------------------------------------------------------------------------*/
    public function view_khanepani_jadan()
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
                    $result         = $this->Mdl_khanepani_jadan->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_khanepani_jadan->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_khanepani_jadan->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."khanepani_jadan");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_khanepani_jadan->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_khanepani_jadan->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_khanepani_jadan->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_khanepani_jadan->getTableName();
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
        $data1['title']     = "खानेपानी जडान";
        $this->load->view('User/header',$data1);
        $this->load->view('khanepani_jadan_view',$data);
        $this->load->view('User/footer');
    }



    public function create_khanepani_jadan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन गरिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'नाम', 'required');
            $this->form_validation->set_rules('nepali_permission_date', 'निर्माण स्विकृती लिएको मिति', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('ward_no', 'वडा नं', 'required');
            $this->form_validation->set_rules('old_address', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('kitta_no', 'कित्ता नम्बर', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('khanepani-jadan/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/khanepani_jadan/';
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
                $_POST['permission_date']             = DateNepToEng($this->input->post('nepali_permission_date'));
                $_POST['created_at']                = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']                = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_khanepani_jadan->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 7;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_khanepani_jadan->update($id,$save);
                    $this->session->set_flashdata('msg',"खानेपानी जडान प्रमाणपत्र सिफारिस पेश गर्न सफल |");
                    redirect('khanepani-jadan/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('khanepani-jadan/create');
                }

            }

        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
      //  print_r($data['locals']);exit;
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['old_new']        = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | खानेपानी जडान दर्ता प्रमाणपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('khanepani_jadan',$data);
        $this->load->view('User/footer');
    }
    /*---------------------------------------------------------------------------------------------------------------------------------*/
    public function edit_khanepani_jadan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("khanepani-jadan");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_khanepani_jadan->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("khanepani-jadan");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("khanepani-jadan");
        }
        if(isset($_POST['submit'])) {
             $this->form_validation->set_rules('nepali_date', 'आवेदन गरिएको मिति', 'required');
             $this->form_validation->set_rules('applicant_name', 'नाम', 'required');
            $this->form_validation->set_rules('nepali_permission_date', 'निर्माण स्विकृती लिएको मिति', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('ward_no', 'वडा नं', 'required');
            $this->form_validation->set_rules('old_address', 'साबिक ठेगाना', 'required');
            $this->form_validation->set_rules('kitta_no', 'कित्ता नम्बर', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('khanepani-jadan/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/khanepani_jadan/';
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

                $_POST['date']                      = DateNepToEng($this->input->post('nepali_date'));
                $_POST['permission_date']             = DateNepToEng($this->input->post('nepali_permission_date'));

                if($this->Mdl_khanepani_jadan->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"खानेपानी जडान प्रमाणपत्र सिफारिस सम्पादन गर्न सफल |");
                    redirect('khanepani-jadan/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('khanepani-jadan/edit/'.$id);
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
         $data['old_new']        = $this->Mdl_oldnew_address->getAll();

         $patra_url              = $this->uri->segment(1);
         $patra = $this->Mdl_patra_item->getByURI($patra_url);
         $data['patra_id']  = $patra->id;
         $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | खानेपानी जडान प्रमाणपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('khanepani_jadan',$data);
        $this->load->view('User/footer');
    }
   /*---------------------------------------------------------------------------------------------*/

    public function detail_khanepani_jadan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("khanepani-jadan");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_khanepani_jadan->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("khanepani-jadan");
        }
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data1['title']     = "आवेदकको विवरण | खानेपानी जडान प्रमाणपत्र" ;
        $this->load->view('User/header',$data1);
        $this->load->view('khanepani_jadan_detail',$data);
        $this->load->view('User/footer');
    }

   /*---------------------------------------------------------------------------------------------------------*/
    public function darta_khanepani_jadan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("khanepani-jadan");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_khanepani_jadan->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("khanepani-jadan");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("khanepani-jadan/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("khanepani-jadan/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."khanepani-jadan/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/khanepani_jadan";
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
            if($this->Mdl_khanepani_jadan->update($id,$data))
            {
                $save['type']               = 7;
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
                redirect(base_url()."khanepani-jadan/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."khanepani-jadan/detail/".$id);
            }

        }
        $result = [];
        $ward_login             = $this->session->userdata('ward_no');
        $result['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('Home/darta',$result);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
   /*---------------------------------------------------------------------------------------------------*/
    public function chalani_khanepani_jadan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_khanepani_jadan->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("khanepani-jadan");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("khanepani-jadan/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("khanepani-jadan/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $chalani_result         = $this->Mdl_chalani->getByFormId($result->form_id);
            $ward = $this->session->userdata('ward_no');
            $is_muncipality = $this->session->userdata('is_muncipality');
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
            if($this->Mdl_khanepani_jadan->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("khanepani-jadan/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("khanepani-jadan");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
   /*------------------------------------------------------------------------------------------------------------------*/
    public function print_khanepani_jadan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("khanepani-jadan");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_khanepani_jadan->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("khanepani-jadan");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("khanepani-jadan/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('khanepani_jadan_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*----------------------------------------------------------------------------------------------*/
    /*----------------------------------Biduth Jadan------------------------------------------------*/
    /*----------------------------------------------------------------------------------------------*/
    public function view_biduth_jadan()
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
                    $result         = $this->Mdl_biduth_jadan->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_biduth_jadan->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_biduth_jadan->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."biduth_jadan");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_biduth_jadan->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_biduth_jadan->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_biduth_jadan->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_biduth_jadan->getTableName();
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
        $data1['title']     = "बिधुत जडान";
        $this->load->view('User/header',$data1);
        $this->load->view('biduth_jadan_view',$data);
        $this->load->view('User/footer');
    }



    public function create_biduth_jadan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
       // $default = getDefault();
        //print_r($provinces);exit;
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन गरिएको मिति', 'required');
            $this->form_validation->set_rules('name', 'नाम', 'required');
            $this->form_validation->set_rules('land_type', 'जग्गाको स्वामित्व', 'required');
            $this->form_validation->set_rules('electricity_use_type', 'बिधुत प्रयोजन', 'required');
            $this->form_validation->set_rules('house_type', 'घरको प्रकार', 'required');
            $this->form_validation->set_rules('ampere', 'एम्पियर क्षमता', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('ward_no', 'वडा नं', 'required');
            $this->form_validation->set_rules('kitta_no', 'कित्ता नम्बर', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('biduth-jadan/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/biduth_jadan/';
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
                if($id = $this->Mdl_biduth_jadan->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 7;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_biduth_jadan->update($id,$save);
                    $this->session->set_flashdata('msg',"बिधुत जडान प्रमाणपत्र सिफारिस पेश गर्न सफल |");
                    redirect('biduth-jadan/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('biduth-jadan/create');
                }

            }

        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
      //  print_r($data['locals']);exit;
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['old_new']        = $this->Mdl_oldnew_address->getAll();
        $data['house_type']     = $this->Mdl_home_type->getAll();
        $data['eutype']        = $this->Mdl_eutype->getAll();
       // $data['default']       = $default;
       $patra_url              = $this->uri->segment(1);
       $patra = $this->Mdl_patra_item->getByURI($patra_url);
       $data['patra_id']  = $patra->id;
       $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | बिधुत जडान दर्ता प्रमाणपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('biduth_jadan',$data);
        $this->load->view('User/footer');
    }
    /*---------------------------------------------------------------------------------------------------------------------------------*/
    public function edit_biduth_jadan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("biduth-jadan");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_biduth_jadan->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("biduth-jadan");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("biduth-jadan");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन गरिएको मिति', 'required');
            $this->form_validation->set_rules('name', 'नाम', 'required');
            $this->form_validation->set_rules('land_type', 'जग्गाको स्वामित्व', 'required');
            $this->form_validation->set_rules('electricity_use_type', 'बिधुत प्रयोजन', 'required');
            $this->form_validation->set_rules('house_type', 'घरको प्रकार', 'required');
            $this->form_validation->set_rules('ampere', 'एम्पियर क्षमता', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('ward_no', 'वडा नं', 'required');
            $this->form_validation->set_rules('kitta_no', 'कित्ता नम्बर', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('biduth-jadan/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/biduth_jadan/';
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

                $_POST['date']                      = DateNepToEng($this->input->post('nepali_date'));

                if($this->Mdl_biduth_jadan->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"बिधुत जडान प्रमाणपत्र सिफारिस सम्पादन गर्न सफल |");
                    redirect('biduth-jadan/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('biduth-jadan/edit/'.$id);
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
         $data['old_new']        = $this->Mdl_oldnew_address->getAll();
         $data['house_type']     = $this->Mdl_home_type->getAll();
         $data['eutype']          = $this->Mdl_eutype->getAll();

         $patra_url              = $this->uri->segment(1);
         $patra = $this->Mdl_patra_item->getByURI($patra_url);
         $data['patra_id']  = $patra->id;
         $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | बिधुत जडान प्रमाणपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('biduth_jadan',$data);
        $this->load->view('User/footer');
    }
   /*---------------------------------------------------------------------------------------------*/

    public function detail_biduth_jadan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("biduth-jadan");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_biduth_jadan->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("biduth-jadan");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | बिधुत जडान प्रमाणपत्र" ;
        $this->load->view('User/header',$data1);
        $this->load->view('biduth_jadan_detail',$data);
        $this->load->view('User/footer');
    }

   /*---------------------------------------------------------------------------------------------------------*/
    public function darta_biduth_jadan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("biduth-jadan");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_biduth_jadan->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("biduth-jadan");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("biduth-jadan/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("biduth-jadan/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."biduth-jadan/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/biduth_jadan";
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
            if($this->Mdl_biduth_jadan->update($id,$data))
            {
                $save['type']               = 7;
                $save['applicant_name']     = "-";
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
                redirect(base_url()."biduth-jadan/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."biduth-jadan/detail/".$id);
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
   /*---------------------------------------------------------------------------------------------------*/
   public function chalani_biduth_jadan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_biduth_jadan->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("biduth-jadan");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("biduth-jadan/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("biduth-jadan/detail/".$id);
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
            $save['applicant_name']       = "-";
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']            = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
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
            if($this->Mdl_biduth_jadan->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("biduth-jadan/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("biduth-jadan");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
   /*------------------------------------------------------------------------------------------------------------------*/
    public function print_biduth_jadan()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("biduth-jadan");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_biduth_jadan->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("biduth-jadan");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("biduth-jadan/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('biduth_jadan_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Abibhahit Pramanpatra     ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_abibhahit_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('child_name', 'बच्चाको नाम', 'required');
            $this->form_validation->set_rules('father_name', 'बुवाको नाम', 'required');
            $this->form_validation->set_rules('mother_name', 'आमाको नाम', 'required');
            $this->form_validation->set_rules('gender', 'लिंङ्ग', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('abibhahit-pramanpatra/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/abibhahit_pramanpatra/';
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
                if($id = $this->Mdl_abibhahit_pramanpatra->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 7;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_abibhahit_pramanpatra->update($id,$save);
                    $this->session->set_flashdata('msg',"अविवाहित प्रमाणपत्र सिफारिस पेश गर्न सफल |");
                     redirect('abibhahit-pramanpatra/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                     redirect('abibhahit-pramanpatra/create');
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

        $data1['title'] = "नयाँ | अविवाहित प्रमाणपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('abibhahit_pramanpatra',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_abibhahit_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("abibhahit-pramanpatra");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_abibhahit_pramanpatra->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("abibhahit-pramanpatra");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | अविवाहित प्रमाणपत्र" ;
        $this->load->view('User/header',$data1);
        $this->load->view('abibhahit_pramanpatra_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_abibhahit_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("abibhahit-pramanpatra");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_abibhahit_pramanpatra->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("abibhahit-pramanpatra");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("abibhahit-pramanpatra");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('child_name', 'बच्चाको नाम', 'required');
            $this->form_validation->set_rules('father_name', 'बुवाको नाम', 'required');
            $this->form_validation->set_rules('mother_name', 'आमाको नाम', 'required');
            $this->form_validation->set_rules('gender', 'लिंङ्ग', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('abibhahit-pramanpatra/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/abibhahit_pramanpatra/';
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
                if($this->Mdl_abibhahit_pramanpatra->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('abibhahit-pramanpatra/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('abibhahit-pramanpatra/edit/'.$id);
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

        $data1['title'] = "नयाँ | अविवाहित प्रमाणपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('abibhahit_pramanpatra',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_abibhahit_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("abibhahit-pramanpatra");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_abibhahit_pramanpatra->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("abibhahit-pramanpatra");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("abibhahit-pramanpatra/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("abibhahit-pramanpatra/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."abibhahit-pramanpatra/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/abibhahit_pramanpatra";
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
            if($this->Mdl_abibhahit_pramanpatra->update($id,$data))
            {
                $save['type']               = 7;
                $save['applicant_name']     = $result->father_name;
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
                redirect(base_url()."abibhahit-pramanpatra/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."abibhahit-pramanpatra/detail/".$id);
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
    public function chalani_abibhahit_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_abibhahit_pramanpatra->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("abibhahit-pramanpatra");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("abibhahit-pramanpatra/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("abibhahit-pramanpatra/detail/".$id);
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
            $save['applicant_name']       = $result->father_name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']            = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
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
            if($this->Mdl_abibhahit_pramanpatra->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("abibhahit-pramanpatra/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("abibhahit-pramanpatra");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_abibhahit_pramanpatra()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("abibhahit-pramanpatra");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_abibhahit_pramanpatra->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("abibhahit-pramanpatra");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("abibhahit-pramanpatra/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('abibhahit_pramanpatra_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_abibhahit_pramanpatra()
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
                    $result         = $this->Mdl_abibhahit_pramanpatra->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_abibhahit_pramanpatra->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_abibhahit_pramanpatra->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."abibhahit-pramanpatra");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_abibhahit_pramanpatra->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_abibhahit_pramanpatra->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_abibhahit_pramanpatra->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_abibhahit_pramanpatra->getTableName();
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
        $this->load->view('abibhahit_pramanpatra_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Janma Miti Pramanit     ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_janma_miti_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('child_name', 'बच्चाको नाम', 'required');
            $this->form_validation->set_rules('nepali_dob', 'जन्म मिति', 'required');
            $this->form_validation->set_rules('birth_place', 'जन्म स्थान', 'required');
            $this->form_validation->set_rules('father_name', 'बुवाको नाम', 'required');
            $this->form_validation->set_rules('mother_name', 'आमाको नाम', 'required');
            $this->form_validation->set_rules('suchak_name', 'सुचकको नाम', 'required');
            $this->form_validation->set_rules('father_citizenship_no', 'बुवाको नागरिकता / राहदानी नं', 'required');
            $this->form_validation->set_rules('mother_citizenship_no', 'आमाको नागरिकता / राहदानी नं', 'required');
            $this->form_validation->set_rules('suchak_citizenship_no', 'सुचकको नागरिकता / राहदानी नं', 'required');
            $this->form_validation->set_rules('gender', 'लिंङ्ग', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('janma-miti-pramanit/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/janma_miti_pramanit/';
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
                $_POST['english_dob']           = DateNepToEng($this->input->post('nepali_dob'));
                $_POST['created_at']            = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']            = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_janma_miti_pramanit->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 6;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_janma_miti_pramanit->update($id,$save);
                    $this->session->set_flashdata('msg',"जन्म मिति प्रमाणित सिफारिस पेश गर्न सफल |");
                    redirect('janma-miti-pramanit/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('janma-miti-pramanit/create');
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

        $data1['title'] = "नयाँ | जन्म मिति प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('janma_miti_pramanit',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_janma_miti_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("janma-miti-pramanit");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_janma_miti_pramanit->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("janma-miti-pramanit");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | जन्म मिति प्रमाणित" ;
        $this->load->view('User/header',$data1);
        $this->load->view('janma_miti_pramanit_detail',$data);
        $this->load->view('User/footer');
    }
     /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_janma_miti_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("janma-miti-pramanit");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_janma_miti_pramanit->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("janma-miti-pramanit");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("janma-miti-pramanit");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('child_name', 'बच्चाको नाम', 'required');
            $this->form_validation->set_rules('nepali_dob', 'जन्म मिति', 'required');
            $this->form_validation->set_rules('birth_place', 'जन्म स्थान', 'required');
            $this->form_validation->set_rules('father_name', 'बुवाको नाम', 'required');
            $this->form_validation->set_rules('mother_name', 'आमाको नाम', 'required');
            $this->form_validation->set_rules('suchak_name', 'सुचकको नाम', 'required');
            $this->form_validation->set_rules('father_citizenship_no', 'बुवाको नागरिकता / राहदानी नं', 'required');
            $this->form_validation->set_rules('mother_citizenship_no', 'आमाको नागरिकता / राहदानी नं', 'required');
            $this->form_validation->set_rules('suchak_citizenship_no', 'सुचकको नागरिकता / राहदानी नं', 'required');
            $this->form_validation->set_rules('gender', 'लिंङ्ग', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('old_place', 'साबिक ठेगाना', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('janma-miti-pramanit/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/janma_miti_pramanit/';
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
                $_POST['english_dob']           = DateNepToEng($this->input->post('nepali_dob'));
                if($this->Mdl_janma_miti_pramanit->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('janma-miti-pramanit/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('janma-miti-pramanit/edit/'.$id);
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

        $data1['title'] = "नयाँ | जन्म मिति प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('janma_miti_pramanit',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_janma_miti_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("janma-miti-pramanit");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_janma_miti_pramanit->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("janma-miti-pramanit");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("janma-miti-pramanit/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("janma-miti-pramanit/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."janma-miti-pramanit/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/janma_miti_pramanit";
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
            if($this->Mdl_janma_miti_pramanit->update($id,$data))
            {
                $save['type']               = 6;
                $save['applicant_name']     = $result->father_name;
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
                redirect(base_url()."janma-miti-pramanit/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."janma-miti-pramanit/detail/".$id);
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
    public function chalani_janma_miti_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_janma_miti_pramanit->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("janma-miti-pramanit");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("janma-miti-pramanit/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("janma-miti-pramanit/detail/".$id);
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
            $save['applicant_name']       = $result->father_name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']            = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $save['type'] = $result->father_citizenship_no;
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
            if($this->Mdl_janma_miti_pramanit->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("janma-miti-pramanit/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("janma-miti-pramanit");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_janma_miti_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("janma-miti-pramanit");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_janma_miti_pramanit->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("janma-miti-pramanit");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("janma-miti-pramanit/detail/".$id);
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
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('janma_miti_pramanit_print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_janma_miti_pramanit()
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
                    $result         = $this->Mdl_janma_miti_pramanit->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_janma_miti_pramanit->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_janma_miti_pramanit->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."janma-miti-pramanit");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_janma_miti_pramanit->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_janma_miti_pramanit->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_janma_miti_pramanit->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_janma_miti_pramanit->getTableName();
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
        $data1['title']     = "जन्म मिति प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('janma_miti_pramanit_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*-------    Nabalak Pramanit
    /*------------------------------------------------------------------------------------------------------------------*/

    public function create_nabalak_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {

            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'निवेदकको  नाम', 'required');
            $this->form_validation->set_rules('relationship', ' नाता ', 'required');
            $this->form_validation->set_rules('p_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('p_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('p_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('j_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('j_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('j_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('p_ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('j_ward', 'वडा नं.', 'required');
            // $this->form_validation->set_rules('birthplace_nep', 'जन्मस्थान (Place Of Birth) ', 'required');
            // $this->form_validation->set_rules('birthplace_eng', 'जन्मस्थान (Place Of Birth) ', 'required');
            $this->form_validation->set_rules('nep_first_name', ' First Name In Nepali ', 'required');
            $this->form_validation->set_rules('nep_last_name', 'Last Name In Nepali', 'required');
            $this->form_validation->set_rules('eng_first_name', 'First Name In English', 'required');
            $this->form_validation->set_rules('eng_last_name', 'Last Name In English', 'required');
            $this->form_validation->set_rules('gender', ' लिङ्ग (Gender) ', 'required');
            $this->form_validation->set_rules('nep_dob', ' जन्म मिति', 'required');
            $this->form_validation->set_rules('father_name_nep', 'बुबाको नाम (Father Name) ', 'required');
            $this->form_validation->set_rules('mother_name_nep', ' आमाको नाम', 'required');
            $this->form_validation->set_rules('gurdians_name_nep', ' संरक्षकको विवरण (Name) ', 'required');
            if ($this->form_validation->run() == FALSE)
            {
//                $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('nabalak-pramanit/create');

            }
            else
            {
                unset($_POST['submit']);
                $path ='assets/documents/others/nabalak_pramanit/';
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
                $_POST['created_at']            = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']            = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_nabalak_pramanit->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 7;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_nabalak_pramanit->update($id,$save);
                    $this->session->set_flashdata('msg'," नागरिकता प्रमाण पत्र सिफारिस पेश गर्न सफल |");
                     redirect('nabalak-pramanit/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                     redirect('nabalak-pramanit/create');
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
        $data['relations']      = $this->Mdl_relation->getAll();

        $data1['title'] = "नयाँ | नाबालक परिचयपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('create_nabalak_pramanit',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_nabalak_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("nabalak-pratilipi-bibaran");
        }
       $id             =  $this->uri->segment(3);
       $result         = $data['result']     = $this->Mdl_nabalak_pramanit->getById($id);
       $documents      = $data['documents'] = explode("+",$result->documents);
       $documents_type = $data['documents_type'] = explode("+",$result->documents_type);
       if(empty($result))
        {

            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("nabalak-pratilipi-bibaran");
        }

        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("nabalak-pratilipi-bibaran");
        }
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'निवेदकको  नाम', 'required');
            $this->form_validation->set_rules('relationship', ' नाता ', 'required');
            $this->form_validation->set_rules('p_state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('p_district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('p_local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('p_ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('birthplace_nep', 'जन्मस्थान (Place Of Birth) ', 'required');
            $this->form_validation->set_rules('birthplace_eng', 'जन्मस्थान (Place Of Birth) ', 'required');
            $this->form_validation->set_rules('nep_first_name', ' First Name In Nepali ', 'required');
            $this->form_validation->set_rules('nep_last_name', 'Last Name In Nepali', 'required');
            $this->form_validation->set_rules('eng_first_name', 'First Name In English', 'required');
            $this->form_validation->set_rules('eng_last_name', 'Last Name In English', 'required');
            $this->form_validation->set_rules('gender', ' लिङ्ग (Gender) ', 'required');
            $this->form_validation->set_rules('nep_dob', ' जन्म मिति', 'required');
            $this->form_validation->set_rules('father_name_nep', 'बुबाको नाम (Father Name) ', 'required');
            $this->form_validation->set_rules('mother_name_nep', ' आमाको नाम', 'required');
            $this->form_validation->set_rules('gurdians_name_nep', ' संरक्षकको विवरण (Name) ', 'required');

                if ($this->form_validation->run() == FALSE)
                {
//                    $this->session->set_flashdata('err_msg', validation_errors());
                    $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                    redirect('nabalak-pratilipi/edit/'.$id);

                }
                else
                {
                        unset($_POST['submit']);
                        $path = 'assets/documents/others/nabalak_pramanit';
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
                       if($this->Mdl_nabalak_pramanit->update($id , $this->input->post()))
                        {
        //                   $this->session->unset_userdata('temp_edit_id');
                            $this->session->set_flashdata('msg',"नाबालक परिचयपत्र सिफारिस सम्पादन गर्न सफल |");
                            redirect('nabalak-pramanit/');
                        }
                        else
                        {
                            $this->session->set_flashdata('err_msg',"समस्या आयो |");
                            redirect('nabalak-pramanit/edit/'.$id);
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

        $data1['title'] = "नयाँ | नाबालक परिचयपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('create_nabalak_pramanit',$data);
        $this->load->view('User/footer');
//         $this->load->model('Mdl_batokayam');
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------------------------------------------------*/
     public function nabalak_pramanit_view()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $ward_login  = $this->session->userdata('ward_no');
        if(isset($_GET['submit']))
        {
            if(isset($_GET['search']))
            {
                $search         = $this->input->get('search');
                $result         = $this->Mdl_nabalak_pramanit->searchByWord($search,$ward_login);
                $data['result'] = $result;
            }

            if(isset($_GET['status']))
            {
                $status         = $this->input->get('status');
                if($status == 0)
                {
                    $data['result']     = $this->Mdl_nabalak_pramanit->getAll($ward_login);
                }
                else
                {
                    $data['result']     = $this->Mdl_nabalak_pramanit->getByStatus($status,$ward_login);
                }
            }

            if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
            {
                if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                {
                    $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                    redirect(base_url()."nabalak-pratilipi-bibaran");
                }
                $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                $data['result'] = $this->Mdl_nabalak_pramanit->getByDates($start_date,$end_date,$ward_login);
            }
            if(isset($_GET['month']))
            {
                $month      = $this->input->get('month');
                $end_date   = date("Y-m-d");
                $start_date = date('Y-m-d', strtotime("-$month months", strtotime($end_date)));
                $data['result'] = $this->Mdl_nabalak_pramanit->getByDates($start_date,$end_date,$ward_login);
//                print_r($data);exit;
            }

        }
        else
        {
            $data['result']     = $this->Mdl_nabalak_pramanit->getByStatus(1,$ward_login);
        }
        $data1['title']     = "आवेदकको विवरणहरु  | नाबालक परिचयपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('nabalak_pramanit_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function nabalak_pramanit_darta()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
         Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("nabalak-pramanit");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_nabalak_pramanit->getById($id);
//        print_r($result);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("nabalak-pramanit");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("nabalak-pramanit/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("nabalak-pramanit/details/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."nabalak-pramanit/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/nabalak_pratilipi_darta";
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
            if($this->Mdl_nabalak_pramanit->update($id,$data))
            {
                $save['type']               = 7;
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
                redirect(base_url()."nabalak-pramanit/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."nabalak-pramanit/details/".$id);
            }

        }
        $ward_login             = $this->session->userdata('ward_no');
        $data['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $data['result'] = $result;
        $this->load->view('User/header',$data1);
        $this->load->view('nabalak_pramanit_darta',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function nabalak_pramanit_details()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("nabalak-pratilipi-bibaran");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_nabalak_pramanit->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("nabalak-pratilipi-bibaran");
        }
         $data['offices']    = $this->Mdl_office->getAll();
         $data['print_detail']   = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
         $data['workers']        = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण |  नाबालक परिचयपत्र" ;
        $this->load->view('User/header',$data1);
        $this->load->view('nabalak_pramanit_details',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function nabalak_pramanit_chalani()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_nabalak_pramanit->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("nabalak-pratilipi-bibaran");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("nabalak-pratilipi/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("nabalak-pratilipi/details/".$id);
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
            if($this->Mdl_nabalak_pramanit->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("nabalak-pramanit/details/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("nabalak-pramanit");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('nabalak_pramanit_chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
     public function nabalak_pramanit_print_first()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(4)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("nabalak-pramanit");
        }
        $id         = $this->uri->segment(4);
        $data['result'] = $result     = $this->Mdl_nabalak_pramanit->getById($id);
//        print_r($result);exit;
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("nabalak-pramanit");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("nabalak-pramanit/details/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri;
            $save['form_id'] = $result->form_id;
//            $save['worker_id'] = $_POST['ward_worker'];
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
//        $data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data['chalani_result'] = $result_chalani;
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('nabalak_pramanit_print_first',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
      public function nabalak_pramanit_print_second()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(4)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("nabalak-pramanit");
        }
        $id         = $this->uri->segment(4);
        $data['result'] = $result     = $this->Mdl_nabalak_pramanit->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("nabalak-pramanit");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले चलानी गरिएको छैन | ");
            redirect("nabalak-pramanit/details/".$id);
        }
          //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri;
            $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
//            $save['office_id'] = $_POST['office_id'];
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
//        $data['print_office']         = $this->Mdl_office->getById($_POST['office_id']);
        $data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('nabalak_pramanit_print_second',$data);
        $this->load->view('User/footer');
    }
    /*------- nanalak pratilipi Ends here---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------------------------------------------------*/
    /*|   Tin pusta pramanit
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_tin_pusta_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            //$this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            //$this->form_validation->set_rules('name', 'नाम', 'required');
            $this->form_validation->set_rules('gender', 'लिङ्ग', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('ward', 'वार्ड', 'required');
            $this->form_validation->set_rules('name_1', 'पुस्ताको नाम', 'required');
            $this->form_validation->set_rules('name_2', 'पुस्ताको नाम', 'required');
            $this->form_validation->set_rules('name_3', 'पुस्ताको नाम', 'required');
            $this->form_validation->set_rules('relation_1', 'पुस्ताको नाता', 'required');
            $this->form_validation->set_rules('relation_2', 'पुस्ताको नाता', 'required');
            $this->form_validation->set_rules('relation_3', 'पुस्ताको नाता', 'required');
            $this->form_validation->set_rules('citizenship_no_1', 'नागरिकता नं', 'required');
            $this->form_validation->set_rules('citizenship_no_2', 'नागरिकता नं', 'required');
            $this->form_validation->set_rules('citizenship_no_3', 'नागरिकता नं', 'required');
            $this->form_validation->set_rules('citizenship_date_1', 'जारी मिति', 'required');
            $this->form_validation->set_rules('citizenship_date_2', 'जारी मिति', 'required');
            $this->form_validation->set_rules('citizenship_date_3', 'जारी मिति', 'required');
            $this->form_validation->set_rules('citizenship_district_1', 'जारी जिल्ला', 'required');
            $this->form_validation->set_rules('citizenship_district_2', 'जारी जिल्ला', 'required');
            $this->form_validation->set_rules('citizenship_district_3', 'जारी जिल्ला', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', validation_errors());
                // $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('tin-pusta-pramanit/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/tin_pusta_pramanit/';
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
                $data['applicant_name']     = $this->input->post('applicant_name');
                $data['district']           = $this->input->post('district');
                $data['local_body']         = $this->input->post('local_body');
                $data['state']              = $this->input->post('state');
                $data['ward']               = $this->input->post('ward');
                //$data['name']               = $_POST['name'];
                $data['gender']             = $_POST['gender'];
                $data['old_new_address']    = $_POST['old_new_address'];
                $data['name_1']             = $_POST['name_1'];
                $data['relation_1']         = $_POST['relation_1'];
                $data['citizenship_no_1']   = $_POST['citizenship_no_1'];
                $data['citizenship_district_1'] = $_POST['citizenship_district_1'];
                $data['citizenship_date_1'] = $_POST['citizenship_date_1'];
                $data['name_2']             = $_POST['name_2'];
                $data['relation_2']         = $_POST['relation_2'];
                $data['citizenship_no_2']   = $_POST['citizenship_no_2'];
                $data['citizenship_district_2'] = $_POST['citizenship_district_2'];
                $data['citizenship_date_2'] = $_POST['citizenship_date_2'];
                $data['name_3']             = $_POST['name_3'];
                $data['relation_3']         = $_POST['relation_3'];
                $data['citizenship_no_3']   = $_POST['citizenship_no_3'];
                $data['citizenship_district_3'] = $_POST['citizenship_district_3'];
                $data['citizenship_date_3'] = $_POST['citizenship_date_3'];
                $data['status']                = 1;
                $data['documents']             = $file;
                $data['documents_type']        = $doc_type;
                $data['nepali_date']           = $this->input->post('nepali_date');
                $data['date']                  = DateNepToEng($this->input->post('nepali_date'));
                $data['created_at']            = date("Y-m-d h:i:sa",time());
                $data['ward_login']            = $this->session->userdata('ward_no');
                $current_session               = Modules::run("Settings/getCurrentSession");
                $data['session_id']            = $current_session->id;
                $data['land_type']             = $this->input->post('land_type');
                if($id = $this->Mdl_tin_pusta_pramanit->save($data))
                {

                    for($i=0;$i<count($_POST['kitta_no']);$i++)
                    {
                        $data1 = array();
                        $data1['detail_id']      = $id;
                        $data1['sheet_no']       = $this->input->post('sheet_no')[$i];
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
                        $this->Mdl_tin_pusta_pramanit_detail->save($data1);
                    }

                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 7;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_tin_pusta_pramanit->update($id,$save);
                    $this->session->set_flashdata('msg',"तीन पुस्ता प्रमाणित सिफारिस पेश गर्न सफल |");
                    redirect('tin-pusta-pramanit/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('tin-pusta-pramanit/create');

                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['old_new_addresses'] = $this->Mdl_oldnew_address->getAll();
        $data['relations']      = $this->Mdl_relation->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | तीन पुस्ता प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('tin_pusta_form_page',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_tin_pusta_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("tin-pusta-pramanit");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_tin_pusta_pramanit->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"मृत्यु दर्ता भेटिएन");
            redirect("tin-pusta-pramanit");
        }
        $details = $this->Mdl_tin_pusta_pramanit_detail->getByDetailId($result->id);
        if($details != FALSE)
        {
            $data['details'] = $details;
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | तीन पुस्ता प्रमाणित" ;
        $this->load->view('User/header',$data1);
        $this->load->view('tin_pusta_pramanit_detail_page',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_tin_pusta_pramanit()
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
        $result     = $data['result']     = $this->Mdl_tin_pusta_pramanit->getById($id);
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
            $this->form_validation->set_rules('applicant_name', 'आवेदकको नाम', 'required');
            $this->form_validation->set_rules('name', 'नाम', 'required');
            $this->form_validation->set_rules('gender', 'लिङ्ग', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('ward', 'वार्ड', 'required');
            $this->form_validation->set_rules('name_1', 'पुस्ताको नाम', 'required');
            $this->form_validation->set_rules('name_2', 'पुस्ताको नाम', 'required');
            $this->form_validation->set_rules('name_3', 'पुस्ताको नाम', 'required');
            $this->form_validation->set_rules('relation_1', 'पुस्ताको नाता', 'required');
            $this->form_validation->set_rules('relation_2', 'पुस्ताको नाता', 'required');
            $this->form_validation->set_rules('relation_3', 'पुस्ताको नाता', 'required');
            $this->form_validation->set_rules('citizenship_no_1', 'नागरिकता नं', 'required');
            $this->form_validation->set_rules('citizenship_no_2', 'नागरिकता नं', 'required');
            $this->form_validation->set_rules('citizenship_no_3', 'नागरिकता नं', 'required');
            $this->form_validation->set_rules('citizenship_date_1', 'जारी मिति', 'required');
            $this->form_validation->set_rules('citizenship_date_2', 'जारी मिति', 'required');
            $this->form_validation->set_rules('citizenship_date_3', 'जारी मिति', 'required');
            $this->form_validation->set_rules('citizenship_district_1', 'जारी जिल्ला', 'required');
            $this->form_validation->set_rules('citizenship_district_2', 'जारी जिल्ला', 'required');
            $this->form_validation->set_rules('citizenship_district_3', 'जारी जिल्ला', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect("home-road-certify/edit".$id);
            }
            else
            {
                $flag = [];
                $this->db->trans_start();

                $path               = 'assets/documents/others/tin_pusta_pramanit/';
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
                $save['applicant_name']     = $this->input->post('applicant_name');
                $save['district']           = $this->input->post('district');
                $save['local_body']         = $this->input->post('local_body');
                $save['state']              = $this->input->post('state');
                $save['ward']               = $this->input->post('ward');
                $save['name']               = $_POST['name'];
                $save['gender']             = $_POST['gender'];
                $save['old_new_address']    = $_POST['old_new_address'];
                $save['name_1']             = $_POST['name_1'];
                $save['relation_1']         = $_POST['relation_1'];
                $save['citizenship_no_1']   = $_POST['citizenship_no_1'];
                $save['citizenship_district_1'] = $_POST['citizenship_district_1'];
                $save['citizenship_date_1'] = $_POST['citizenship_date_1'];
                $save['name_2']             = $_POST['name_2'];
                $save['relation_2']         = $_POST['relation_2'];
                $save['citizenship_no_2']   = $_POST['citizenship_no_2'];
                $save['citizenship_district_2'] = $_POST['citizenship_district_2'];
                $save['citizenship_date_2'] = $_POST['citizenship_date_2'];
                $save['name_3']             = $_POST['name_3'];
                $save['relation_3']         = $_POST['relation_3'];
                $save['citizenship_no_3']   = $_POST['citizenship_no_3'];
                $save['citizenship_district_3'] = $_POST['citizenship_district_3'];
                $save['citizenship_date_3'] = $_POST['citizenship_date_3'];
                $save['status']                = 1;
                $save['nepali_date']           = $this->input->post('nepali_date');
                $save['date']                  = DateNepToEng($this->input->post('nepali_date'));
                if($this->Mdl_tin_pusta_pramanit->update($id,$save))
                {
                    //---------Deleting old record and saving new one----
                    $this->Mdl_tin_pusta_pramanit_detail->deleteByDetailId($id);

                    for($i=0;$i<count($_POST['kitta_no']);$i++)
                    {
                        $data1 = array();
                        $data1['detail_id']      = $id;
                        $data1['sheet_no']       = $this->input->post('sheet_no')[$i];
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
                        $this->Mdl_tin_pusta_pramanit_detail->save($data1);
                    }
                    $this->db->trans_complete();
                    $this->session->set_flashdata('msg', "सिफारिस सम्पादन गर्न सफल");
                    redirect("tin-pusta-pramanit/detail/".$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg', "समस्या आयो");
                    redirect("tin-pusta-pramanit/edit/".$id);
                }

            }
        }
        if(!empty($result->document))
        {
            $documents          = explode("+",$result->document);
        }
        $data['details']        = $this->Mdl_tin_pusta_pramanit_detail->getByDetailId($id);
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['old_new_addresses'] = $this->Mdl_oldnew_address->getAll();
        $data['relations']      = $this->Mdl_relation->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | तीन पुस्ता प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('tin_pusta_form_page',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_tin_pusta_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("tin-pusta-pramanit");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_tin_pusta_pramanit->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("tin-pusta-pramanit");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("tin-pusta-pramanit/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("tin-pusta-pramanit/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."tin-pusta-pramanit/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/tin_pusta_pramanit/";
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
            if($this->Mdl_tin_pusta_pramanit->update($id,$data))
            {
                $save['type']               = 7;
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
                redirect(base_url()."tin-pusta-pramanit/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."tin-pusta-pramanit/detail/".$id);
            }

        }
        $result = [];
        $ward_login = $this->session->userdata('ward_no');
        $result['reserved_darta_nos']  = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/darta',$result);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function chalani_tin_pusta_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_tin_pusta_pramanit->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("tin-pusta-pramanit");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("tin-pusta-pramanit/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("tin-pusta-pramanit/detail/".$id);
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
            $save['chalani_no']     = ($chalani_no == FALSE) ? 1 : $chalani_no + 1;
            $save['english_chalani_miti'] = date("Y-m-d");
            $save['nepali_chalani_miti']  = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']       = $result->applicant_name;
            $save['ward_login']           = $this->session->userdata('ward_no');
            $save['uri']                  = $this->uri->segment(1);
            $current_session              = Modules::run("Settings/getCurrentSession");
            $save['session_id']           = $current_session->id;
            $save['user_id']              = $this->session->userdata('id');
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
            if($this->Mdl_tin_pusta_pramanit->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("tin-pusta-pramanit/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("tin-pusta-pramanit");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_tin_pusta_pramanit()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("tin-pusta-pramanit");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_tin_pusta_pramanit->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("tin-pusta-pramanit");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("tin-pusta-pramanit/detail/".$id);
        }
        //-----saving printing details--------------------
        $uri = $this->uri->segment(1);
        $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
        $save['uri'] = $uri;
        $save['form_id'] = $result->form_id;
        $save['office_id'] = $_POST['office_id'];
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
        $data['print_office']   = $this->Mdl_office->getById($_POST['office_id']);
        $data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $data['details']        = $this->Mdl_tin_pusta_pramanit_detail->getByDetailId($id);
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['form_id']        = $result_chalani->form_id;
        $data['chalani_no']     = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('tin_pusta_pramanit_print_page',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_tin_pusta_pramanit()
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
                    $result         = $this->Mdl_tin_pusta_pramanit->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_tin_pusta_pramanit->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_tin_pusta_pramanit->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."farak-nam-thar");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_tin_pusta_pramanit->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_tin_pusta_pramanit->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_tin_pusta_pramanit->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_tin_pusta_pramanit->getTableName();
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
        $data1['title']     = "फरक जन्म मिति सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('tin_pusta_pramanit_view_page',$data);
        $this->load->view('User/footer');
    }
    /*|--------------------------------------------------------------------------------------------*/
    /*| Farak janma miti */
    /*-----------------------------------------------------------------------------------------------*/
    public function create_farak_janma_miti()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            //$this->form_validation->set_rules('applicant_name', 'निवेदकको नाम', 'required');
            $this->form_validation->set_rules('name', 'नाम', 'required');
            $this->form_validation->set_rules('gender', 'लिङ्ग', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'स्थानीय तह', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं', 'required');
            $this->form_validation->set_rules('wrong_birthdate', 'फरक भएको जन्म मिति', 'required');
            $this->form_validation->set_rules('right_birthdate', 'हुनु पर्ने जन्म मिति', 'required');
            $this->form_validation->set_rules('wrong_document', 'फरक भएको कागजात', 'required');
            if ($this->form_validation->run() == FALSE) {
                // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('farak-janma-miti/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/farak_janma_miti/';
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
                $_POST['date']      = $this->input->post('nepali_date');
                $_POST['created_at']    = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']    = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_farak_janma_miti->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 6;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run('Home/genFormId');
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_farak_janma_miti->update($id,$save);
                    $this->session->set_flashdata('msg',"फरक जन्म मिति सिफारिस पेश गर्न सफल |");
                    redirect('farak-janma-miti/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('farak-janma-miti/create');
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['old_new_addresses'] = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | फरक जन्म मिति";
        $this->load->view('User/header',$data1);
        $this->load->view('farak_janma_miti_form_page',$data);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------------*/
    public function detail_farak_janma_miti()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("farak-janma-miti");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_farak_janma_miti->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"सिफारिस भेटिएन");
            redirect("farak-janma-miti");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | फरक जन्म मिति" ;
        $this->load->view('User/header',$data1);
        $this->load->view('farak_janma_miti_detail_page',$data);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------------*/
    public function edit_farak_janma_miti()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("farak-janma-miti");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_farak_janma_miti->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("farak-janma-miti");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("farak-janma-miti");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'निवेदकको नाम', 'required');
            $this->form_validation->set_rules('name', 'नाम', 'required');
            $this->form_validation->set_rules('gender', 'लिङ्ग', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'स्थानीय तह', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं', 'required');
            $this->form_validation->set_rules('wrong_birthdate', 'फरक भएको जन्म मिति', 'required');
            $this->form_validation->set_rules('right_birthdate', 'हुनु पर्ने जन्म मिति', 'required');
            $this->form_validation->set_rules('wrong_document', 'फरक भएको कागजात', 'required');


            if ($this->form_validation->run() == FALSE)
            {
                // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('farak-janma-miti/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/farak_janma_miti/';
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
                if($this->Mdl_farak_janma_miti->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('farak-janma-miti/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('farak-janma-miti/edit/'.$id);
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['old_new_addresses'] = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | फरक जन्म मिति";
        $this->load->view('User/header',$data1);
        $this->load->view('farak_janma_miti_form_page',$data);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------------*/
    public function darta_farak_janma_miti()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("farak-janma-miti");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_farak_janma_miti->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("farak-janma-miti");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("farak-janma-miti/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("farak-janma-miti/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."farak-janma-miti/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/farak_janma_miti";
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
            if($this->Mdl_farak_janma_miti->update($id,$data))
            {
                $save['type']               = 6;
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
                redirect(base_url()."farak-janma-miti/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."farak-janma-miti/detail/".$id);
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
    /*-----------------------------------------------------------------------------------------------*/
    public function chalani_farak_janma_miti()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_farak_janma_miti->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("farak-janma-miti");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("farak-janma-miti/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("farak-janma-miti/detail/".$id);
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
            if($this->Mdl_farak_janma_miti->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("farak-janma-miti/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("farak-janma-miti");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------------*/
    public function print_farak_janma_miti()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("farak-janma-miti");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_farak_janma_miti->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("farak-janma-miti");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("farak-janma-miti/detail/".$id);
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
        $data['print_office']         = $this->Mdl_office->getById($_POST['office_id']);
        $data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('farak_janma_miti_print_page',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------------*/
    public function view_farak_janma_miti()
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
                    $result         = $this->Mdl_farak_janma_miti->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_farak_janma_miti->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_farak_janma_miti->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."farak-nam-thar");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_farak_janma_miti->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_farak_janma_miti->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_farak_janma_miti->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_farak_janma_miti->getTableName();
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
        $data1['title']     = "फरक जन्म मिति सिफारिस";
        $this->load->view('User/header',$data1);
        $this->load->view('farak_janma_miti_view_page',$data);
        $this->load->view('User/footer');
    }
    /*|--------------------------------------------------------------------------------------------*/
    /*| Farak farak hijje */
    /*-----------------------------------------------------------------------------------------------*/
    public function create_farak_hijje()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            //$this->form_validation->set_rules('applicant_name', 'निवेदकको नाम', 'required');
            //$this->form_validation->set_rules('applicant_name', 'नाम', 'required');
            $this->form_validation->set_rules('gender', 'लिङ्ग', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'स्थानीय तह', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं', 'required');
            $this->form_validation->set_rules('wrong_spelling', 'फरक अंग्रेजी हिज्जे', 'required');
            $this->form_validation->set_rules('right_spelling', 'हुनु पर्ने अंग्रेजी हिज्जे', 'required');
            $this->form_validation->set_rules('wrong_document', 'फरक भएको कागजात', 'required');
            if ($this->form_validation->run() == FALSE) {
                 $this->session->set_flashdata('err_msg', validation_errors());
//                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('farak-hijje/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/farak_hijje/';
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
                $_POST['date']      = $this->input->post('nepali_date');
                $_POST['created_at']    = date("Y-m-d h:i:sa",time());
                $_POST['ward_login']    = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $_POST['session_id']            = $current_session->id;
                if($id = $this->Mdl_farak_hijje->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 6;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run('Home/genFormId');
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_farak_hijje->update($id,$save);
                    $this->session->set_flashdata('msg',"फरक जन्म मिति सिफारिस पेश गर्न सफल |");
                    redirect('farak-hijje/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('farak-hijje/create');
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['old_new_addresses'] = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | फरक फरक हिज्जे";
        $this->load->view('User/header',$data1);
        $this->load->view('farak_hijje_form_page',$data);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------------*/
    public function detail_farak_hijje()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("farak-hijje");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_farak_hijje->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"सिफारिस भेटिएन");
            redirect("farak-hijje");
        }
        $data['offices']    = $this->Mdl_office->getAll();
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | फरक फरक अंग्रेजी हिज्जे" ;
        $this->load->view('User/header',$data1);
        $this->load->view('farak_hijje_detail_page',$data);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------------*/
    public function edit_farak_hijje()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_farak_hijje->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("farak-hijje");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("farak-hijje");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('applicant_name', 'निवेदकको नाम', 'required');
            $this->form_validation->set_rules('name', 'नाम', 'required');
            $this->form_validation->set_rules('gender', 'लिङ्ग', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            $this->form_validation->set_rules('local_body', 'स्थानीय तह', 'required');
            $this->form_validation->set_rules('ward', 'वडा नं', 'required');
            $this->form_validation->set_rules('wrong_spelling', 'फरक अंग्रेजी हिज्जे', 'required');
            $this->form_validation->set_rules('right_spelling', 'हुनु पर्ने अंग्रेजी हिज्जे', 'required');
            $this->form_validation->set_rules('wrong_document', 'फरक भएको कागजात', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('farak-hijje/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/others/farak_hijje/';
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
                if($this->Mdl_farak_hijje->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('farak-hijje/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('farak-hijje/edit/'.$id);
                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['old_new_addresses'] = $this->Mdl_oldnew_address->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | फरक फरक अंग्रेजी हिज्जे";
        $this->load->view('User/header',$data1);
        $this->load->view('farak_hijje_form_page',$data);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------------*/
    public function darta_farak_hijje()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_farak_hijje->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("farak-hijje");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("farak-hijje/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("farak-hijje/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."farak-hijje/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/others/farak_hijje";
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
            if($this->Mdl_farak_hijje->update($id,$data))
            {
                $save['type']               = 6;
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
                redirect(base_url()."farak-hijje/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."farak-hijje/detail/".$id);
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
    /*-----------------------------------------------------------------------------------------------*/
    public function chalani_farak_hijje()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_farak_hijje->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("farak-hijje");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("farak-hijje/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("farak-hijje/detail/".$id);
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
            if($this->Mdl_farak_hijje->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("farak-hijje/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("farak-hijje");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------------*/
    public function print_farak_hijje()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_farak_hijje->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("farak-hijje");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("farak-hijje/detail/".$id);
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
        $data['print_office']         = $this->Mdl_office->getById($_POST['office_id']);
        $data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
         $data['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('farak_hijje_print_page',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------------*/
    public function view_farak_hijje()
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
                    $result         = $this->Mdl_farak_hijje->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_farak_hijje->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_farak_hijje->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."farak-hijje");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_farak_hijje->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_farak_hijje->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_farak_hijje->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_farak_hijje->getTableName();
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
        $data1['title']     = "फरक फरक अंग्रेजी हिज्जे";
        $this->load->view('User/header',$data1);
        $this->load->view('farak_hijje_view_page',$data);
        $this->load->view('User/footer');
    }
    /*-----------------------------------------------------------------------------------------------*/
    /*-----------------------------------------------------------------------------------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getTinPustaHTML()
    {
        $id = $_POST['count'];
        $land_type = $_POST['land_type'];
        $display = '';
        if($land_type=="terai")
        {
            $display = 'style="display:none;"';
        }
        $html="";
        $html = '<tr class="tin_pusta" id="tin_pusta_'.$id.'">
                    <td>
                        <input class="form-control" type="text" name="kitta_no[]" required>
                    </td>
                    <td>
                        <input class="form-control" type="text" name="sheet_no[]" required>
                    </td>
                    <td>
                        <input type="number" name="biggha[]" value="0" class="form-control biggha"  min="0" />
                    </td>
                    <td>
                        <input type="number" name="kattha[]" value="0" class="form-control kattha" min="0" max="20" />
                    </td>
                    <td>
                        <input type="number" name="dhur[]" value="0" class="form-control dhur"  min="0" max="20" />
                    </td>
                    <td '. $display .'>
                        <input type="number" name="paisa[]" value="0" class="form-control paisa"  min="0" max="4"  />
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove" id="remove_'.$id.'"  >
                            <i class="fa fa-minus"></i>
                        </button>
                    </td>
                </tr>';
        $res = [];
        $res['html']  = $html;
        echo json_encode($res);
    }
    /*------------------------------------------------------------------------------------------------------------------*/
     public function getConvertedDate()
     {
         $res =[];
         $nep_dob= $_POST['nep_dob'];
         $eng = DateNepToEng($nep_dob);
         $res['html'] = $eng;
         echo json_encode($res);exit;

     }
    /*------------------------------------------------------------------------------------------------------------------*/
     public function getOthersDocumentHTML()
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

}
