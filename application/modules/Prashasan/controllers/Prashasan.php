<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Prashasan extends MX_Controller {
    function __construct()
    {
        parent::__construct();
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $this->load->helper('string');
        $this->load->helper('functions_helper');
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
        $this->load->model('Settings/Mdl_yain');
        $this->load->model('Settings/Mdl_bodartha');
        $this->load->model('Prashasan/Mdl_upgrade_position');
        $this->load->model('Prashasan/Mdl_salary_verify');
        $this->load->model('Prashasan/Mdl_niyukti');
        $this->load->model('Prashasan/Mdl_sawari_pass');
        
        $this->load->model('Prashasan/Mdl_hajiri');
        $this->load->model('Prashasan/Mdl_kaam_kaz');
        $this->load->model('Prashasan/Mdl_karar_niyukti');
        $this->load->model('Prashasan/Mdl_approve_wiwaran');
        
        $this->load->model('User/Mdl_user');
        $this->load->model('English/Mdl_address_verification_en');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function index() {}

/*------------------------------------------------------------------------------------------------------------------
    //sthia niyukti patra
------------------------------------------------------------------------------------------------------------------*/
    public function sthai_niyukti()
    {
        Modules::run("User/checkWardLogin");

        //$ward_login = $this->session->userdata('ward_no');
        // if($this->session->userdata('is_muncipality')==0)
        // {
        //     if(isset($_GET['submit']))
        //     {
        //         if(isset($_GET['search']))
        //         {
        //             $search         = $this->input->get('search');
        //             $result         = $this->Mdl_upgrade_position->searchByWord($search,$ward_login);
        //             $data['result'] = $result;
        //         }

        //         if(isset($_GET['status']))
        //         {
        //             $status         = $this->input->get('status');
        //             if($status == 0)
        //             {
        //                 $data['result']     = $this->Mdl_upgrade_position->getAll($ward_login);
        //             }
        //             else
        //             {
        //                 $data['result']     = $this->Mdl_upgrade_position->getByStatus($status,$ward_login);
        //             }
        //         }

        //         if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
        //         {
        //             if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
        //             {
        //                 $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
        //                 redirect(base_url()."sanstha-darta-pramanpatra");
        //             }
        //             $start_date     = DateNepToEng($this->input->get('start_date_nep'));
        //             $end_date       = DateNepToEng($this->input->get('end_date_nep'));
        //             $data['result'] = $this->Mdl_upgrade_position->getByDates($start_date,$end_date,$ward_login);
        //         }
        //         if(isset($_GET['month']))
        //         {
        //             $month      = $this->input->get('month');
        //             $end_date   = date("Y-m-d");
        //             $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

        //             $data['result'] = $this->Mdl_upgrade_position->getByDates($start_date,$end_date,$ward_login);
        //         }

        //     }
        //     else
        //     {
        //         $data['result']     = $this->Mdl_upgrade_position->getByStatus(1,$ward_login);
        //     }
        // }
        // else
        // {
        $url = $this->uri->segment(1);
        $department = $this->session->userdata('department');
        $table_name = $this->Mdl_niyukti->getTableName();
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
            //$data['result']     = $this->Mdl_chalani->getAllByDepartmentAndUri($department, $table_name, $url);
            $data['result'] = $this->Mdl_niyukti->getAllData();
        }

        // $data['default']        = getDefault();
        // $data['states']         = $this->Mdl_state->getAll();
        // $data['districts']      = $this->Mdl_district->getAll();
        // $data['locals']         = $this->Mdl_local_body->getAll();
        // $data['wards']          = $this->Mdl_ward->getAll();
        $data1['title']         = "स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('sthai_niyukti/list',$data);
        $this->load->view('User/footer');
    }

    public function sthai_niyukti_create()
    {
        Modules::run("User/checkWardLogin");
         if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            // $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            // $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            // $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('name', '  जग्गाधनीको नाम ', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('sthai_niyukti/create');
            }
            else
            {
                unset($_POST['submit']);
                $data['date']                   = $this->input->post('nepali_date');
                $data['gender']                 = $this->input->post('gender');
                $data['name']                   = $this->input->post('name');
                $data['state']                  = $this->input->post('state');
                $data['district']               = $this->input->post('district');
                $data['ganapa']                 = $this->input->post('ganapa');
                $data['ward']                   = $this->input->post('ward');
                $data['status']                 = 1;
                $data['cit_no']                 = $this->input->post('cit_no');
                $data['loksewa_office']         = $this->input->post('loksewa_office');
                $data['loksewaoffice_address']  = $this->input->post('loksewaoffice_address');
                $data['add_no']                 = $this->input->post('add_no');
                $data['add_date']               = $this->input->post('add_date');
                $data['office_chalani_no']      = $this->input->post('office_chalani_no');
                $data['office_chalani_date']    = $this->input->post('office_chalani_date');
                $data['yain']                   = $this->input->post('yain');
                $data['gapa_miti']              = $this->input->post('gapa_miti');
                $data['lagu_miti']              = $this->input->post('lagu_miti');
                $data['sewa']                   = $this->input->post('sewa');
                $data['samuha']                 = $this->input->post('samuha');
                $data['taha']                   = $this->input->post('taha');
                $data['position']               = $this->input->post('position');
                $data['created_at']             = date("Y-m-d h:i:sa",time());
                $data['ward_login']             = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $data['session_id']             = $current_session->id;
                $data['form_id']                = Modules::run("Home/genFormId");
                if($id = $this->Mdl_niyukti->save($data))
                {
                    // $chalani['darta_id']   = $id;
                    // $chalani['type']       = 3;
                    // $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    // $this->Mdl_chalani->save($chalani);
                    // $this->Mdl_charkilla->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('sawari-pass/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('sawari-pass/create');

                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();

        $data1['title']         = "स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('sthai_niyukti/create',$data);
        $this->load->view('User/footer');
    }

     public function sthai_niyukti_edit()
    {
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_niyukti->getById($id);
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('state', 'प्रदेश', 'required');
            // $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            // $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            // $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('name', '  जग्गाधनीको नाम ', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('sthai_niyukti/create');
            }
            else
            {
                unset($_POST['submit']);
                $save['date']                   = $this->input->post('nepali_date');
                $save['gender']                 = $this->input->post('gender');
                $save['name']                   = $this->input->post('name');
                $save['state']                  = $this->input->post('state');
                $save['district']               = $this->input->post('district');
                $save['ganapa']                 = $this->input->post('ganapa');
                $save['ward']                   = $this->input->post('ward');
                $save['cit_no']                 = $this->input->post('cit_no');
                $save['loksewa_office']         = $this->input->post('loksewa_office');
                $save['loksewaoffice_address']  = $this->input->post('loksewaoffice_address');
                $save['add_no']                 = $this->input->post('add_no');
                $save['add_date']               = $this->input->post('add_date');
                $save['office_chalani_no']      = $this->input->post('office_chalani_no');
                $save['office_chalani_date']    = $this->input->post('office_chalani_date');
                $save['yain']                   = $this->input->post('yain');
                $save['gapa_miti']              = $this->input->post('gapa_miti');
                $save['lagu_miti']              = $this->input->post('lagu_miti');
                $save['sewa']                   = $this->input->post('sewa');
                $save['samuha']                 = $this->input->post('samuha');
                $save['taha']                   = $this->input->post('taha');
                $save['position']               = $this->input->post('position');
                // $data['created_at']             = date("Y-m-d h:i:sa",time());
                // $data['ward_login']             = $this->session->userdata('ward_no');
                // $current_session                = Modules::run("Settings/getCurrentSession");
                // $data['session_id']             = $current_session->id;
                // $data['form_id']                = Modules::run("Home/genFormId");
                if($this->Mdl_niyukti->update($id,$save))
                {
                    // $chalani['darta_id']   = $id;
                    // $chalani['type']       = 3;
                    // $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    // $this->Mdl_chalani->save($chalani);
                    // $this->Mdl_charkilla->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('sthai-niyukti/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('sthai-niyukti/create');

                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();

        $data1['title']         = "स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('sthai_niyukti/create',$data);
        $this->load->view('User/footer');
    }

    //detail
    public function sthai_niyukti_detail($id = NULL) {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sawari-pass");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_niyukti->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sawari-pass");
        }
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['offices']                = $this->Mdl_office->getAll();
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getAll();
        $data['bodartha']               = $this->Mdl_bodartha->getAll();
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data1['title']                 = "आवेदकको विवरण | स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('sthai_niyukti/detail',$data);
        $this->load->view('User/footer');
    }

    public function sthai_niyukti_darta() {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
           redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("sthai_niyukti");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_niyukti->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sthai_niyukti");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("sthai_niyukti/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("sthai_niyukti/details/".$id);
        }

        $data['status']             = 2;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_niyukti->update($id,$data))
        {
            $save['type']               = 13;
            $save['applicant_name']     = $result->name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $save['sifaris_id']         = $id;
            $current_session            = Modules::run("Settings/getCurrentSession");
            $save['session_id']         = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward);
            $save['form_id']            = $result->form_id;
            $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
            $save['english_darta_miti'] = date("Y-m-d",time());
            $save['is_muncipality']     = '1';
            $save['department']         = $this->session->userdata('department');
            $save['nepali_darta_miti']  = DateEngToNep($save['english_darta_miti']);
            $this->Mdl_darta->save($save);
            $this->session->set_flashdata('msg',"दर्ता हुन सफल |");
            redirect(base_url()."sawari-pass/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."sawari-pass/details/".$id);
        }

    }

    public function sthai_niyukti_chalani() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("sthai_niyukti");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_niyukti->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sthai_niyukti");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("sawari-pass/details/".$id);
        }

        $data['status']             = 3;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_niyukti->update($id,$data))
        {

            $chalani_result                 = $this->Mdl_chalani->getByFormId($result->form_id);
            $is_muncipality                 = $this->session->userdata('is_muncipality');
            $ward                           = $this->session->userdata('ward_no');
            $save['is_muncipality']         = '1';
            $save['department']             = $this->session->userdata('department');
            $save['form_id']                = $result->form_id;
            $save['darta_id']               = $id;
            $chalani_no                     = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']             = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']   = date("Y-m-d",time());
            $save['nepali_chalani_miti']    = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']         = $result->name;
            $save['ward_login']             = $this->session->userdata('ward_no');
            $save['uri']                    = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']             = $current_session->id;
            $save['user_id']                = $this->session->userdata('id');
            $save['type']                   = 13;
            $data['status']                 = 3;
            $this->Mdl_chalani->save($save);
            $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
            redirect("sawari-pass/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."sawari-pass/details/".$id);
        }
    }

    public function sthai_niyukti_print() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sawari-pass");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_niyukti->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sawari-pass");
        }


        //-----saving printing details--------------------
        $uri                = $this->uri->segment(1);
        $this_print         = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
        $save['uri']        = $uri; 
        $save['form_id']    = $result->form_id;
        $save['worker_id']  = $_POST['office_worker'];
        //$save['office_id']  = $_POST['office_post'];
        $bd                 = $this->input->post('bd');
        $bodartha           = implode(',',$bd);
        $update['bodartha']   = $bodartha;
        $this->Mdl_niyukti->update($id,$update);
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

        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = isset($chalani_result) ? $chalani_result->chalani_no:'';
        }
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['bod']                    = $this->Mdl_bodartha->getPrintBod($result->bodartha);
        $data['offices']                = $this->Mdl_office->getAll();
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getById($data['print_detail']->worker_id);
        $data['post']                   = $this->Mdl_post->getById($data['workers']->post_id);
        $data1['title']                 = "आवेदकको विवरण | स्थायी नियुक्ति पत्र";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('sthai_niyukti/print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
/*------------------------------------------------------------------------------------------------------------------
    //sawari pass
------------------------------------------------------------------------------------------------------------------*/
    public function sawari_pass()
    {
        Modules::run("User/checkWardLogin");

        //$ward_login = $this->session->userdata('ward_no');
        // if($this->session->userdata('is_muncipality')==0)
        // {
        //     if(isset($_GET['submit']))
        //     {
        //         if(isset($_GET['search']))
        //         {
        //             $search         = $this->input->get('search');
        //             $result         = $this->Mdl_upgrade_position->searchByWord($search,$ward_login);
        //             $data['result'] = $result;
        //         }

        //         if(isset($_GET['status']))
        //         {
        //             $status         = $this->input->get('status');
        //             if($status == 0)
        //             {
        //                 $data['result']     = $this->Mdl_upgrade_position->getAll($ward_login);
        //             }
        //             else
        //             {
        //                 $data['result']     = $this->Mdl_upgrade_position->getByStatus($status,$ward_login);
        //             }
        //         }

        //         if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
        //         {
        //             if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
        //             {
        //                 $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
        //                 redirect(base_url()."sanstha-darta-pramanpatra");
        //             }
        //             $start_date     = DateNepToEng($this->input->get('start_date_nep'));
        //             $end_date       = DateNepToEng($this->input->get('end_date_nep'));
        //             $data['result'] = $this->Mdl_upgrade_position->getByDates($start_date,$end_date,$ward_login);
        //         }
        //         if(isset($_GET['month']))
        //         {
        //             $month      = $this->input->get('month');
        //             $end_date   = date("Y-m-d");
        //             $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

        //             $data['result'] = $this->Mdl_upgrade_position->getByDates($start_date,$end_date,$ward_login);
        //         }

        //     }
        //     else
        //     {
        //         $data['result']     = $this->Mdl_upgrade_position->getByStatus(1,$ward_login);
        //     }
        // }
        // else
        // {
        $url = $this->uri->segment(1);
        $department = $this->session->userdata('department');
        $table_name = $this->Mdl_sawari_pass->getTableName();
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
            //$data['result']     = $this->Mdl_chalani->getAllByDepartmentAndUri($department, $table_name, $url);
            $data['result'] = $this->Mdl_sawari_pass->getAllData();
        }
        // $data['default']        = getDefault();
        // $data['states']         = $this->Mdl_state->getAll();
        // $data['districts']      = $this->Mdl_district->getAll();
        // $data['locals']         = $this->Mdl_local_body->getAll();
        // $data['wards']          = $this->Mdl_ward->getAll();
        // $data1['title']         = "स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('sawari_pass/list',$data);
        $this->load->view('User/footer');
    }

    public function sawari_pass_create()
    {
        Modules::run("User/checkWardLogin");
         if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            //$this->form_validation->set_rules('state', 'प्रदेश', 'required');
            // $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            // $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            // $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('name', '  जग्गाधनीको नाम ', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('sawari-pass/create');
            }
            else
            {
                unset($_POST['submit']);
                $data['date']                   = $this->input->post('nepali_date');
                $data['name']                   = $this->input->post('name');
                $data['destination']            = $this->input->post('destination');
                $data['vehicle_no']             = $this->input->post('vehicle_no');
                $data['from_date']              = $this->input->post('from_date');
                $data['to_date']                = $this->input->post('to_date');
                $data['driver_name']            = $this->input->post('driver_name');
                $data['status']                 = 1;
                $data['created_at']             = date("Y-m-d h:i:sa",time());
                $data['ward_login']             = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $data['session_id']             = $current_session->id;
                $data['form_id']                = Modules::run("Home/genFormId");
                if($id = $this->Mdl_sawari_pass->save($data))
                {
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('sawari-pass/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('sawari-pass/create');

                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();

        $data1['title']         = "स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('sawari_pass/create',$data);
        $this->load->view('User/footer');
    }

    public function sawari_pass_edit()
    {
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $data['result'] = $this->Mdl_sawari_pass->getById($id);
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            //$this->form_validation->set_rules('state', 'प्रदेश', 'required');
            // $this->form_validation->set_rules('district', 'जिल्ला', 'required');
            // $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            // $this->form_validation->set_rules('ward', 'वडा नं.', 'required');
            $this->form_validation->set_rules('name', '  जग्गाधनीको नाम ', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('sawari-pass/create');
            }
            else
            {
                unset($_POST['submit']);
                $save['date']                   = $this->input->post('nepali_date');
                $save['name']                   = $this->input->post('name');
                $save['destination']            = $this->input->post('destination');
                $save['vehicle_no']             = $this->input->post('vehicle_no');
                $save['from_date']              = $this->input->post('from_date');
                $save['to_date']                = $this->input->post('to_date');
                $save['driver_name']            = $this->input->post('driver_name');
                //$data['status']                 = 1;
               // $data['created_at']             = date("Y-m-d h:i:sa",time());
                // $data['ward_login']             = $this->session->userdata('ward_no');
                // $current_session                = Modules::run("Settings/getCurrentSession");
                // $data['session_id']             = $current_session->id;
                // $data['form_id']                = Modules::run("Home/genFormId");
                if($this->Mdl_sawari_pass->update($id,$save))
                {
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('sawari-pass/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('sawari-pass/create');

                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();

        $data1['title']         = "स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('sawari_pass/create',$data);
        $this->load->view('User/footer');
    }

    //detail
    public function sawari_pass_detail($id = NULL) {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sawari-pass");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_sawari_pass->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sawari-pass");
        }
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['offices']                = $this->Mdl_office->getAll();
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getAll();
        $data['bodartha']               = $this->Mdl_bodartha->getAll();
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data1['title']                 = "आवेदकको विवरण | स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('sawari_pass/detail',$data);
        $this->load->view('User/footer');
    }

    public function sawari_pass_darta() {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
           redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("sawari_pass");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_sawari_pass->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sawari_pass");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("sawari_pass/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("sawari_pass/details/".$id);
        }

        $data['status']             = 2;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_sawari_pass->update($id,$data))
        {
            $save['type']               = 13;
            $save['applicant_name']     = $result->name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $save['sifaris_id']         = $id;
            $current_session            = Modules::run("Settings/getCurrentSession");
            $save['session_id']         = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward);
            $save['form_id']            = $result->form_id;
            $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
            $save['english_darta_miti'] = date("Y-m-d",time());
            $save['is_muncipality']     = '1';
            $save['department']         = $this->session->userdata('department');
            $save['nepali_darta_miti']  = DateEngToNep($save['english_darta_miti']);
            $this->Mdl_darta->save($save);
            $this->session->set_flashdata('msg',"दर्ता हुन सफल |");
            redirect(base_url()."sawari-pass/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."sawari-pass/details/".$id);
        }

    }

    public function sawari_pass_chalani() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("sawari_pass");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_sawari_pass->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("sawari_pass");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("sawari-pass/details/".$id);
        }

        $data['status']             = 3;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_sawari_pass->update($id,$data))
        {

            $chalani_result                 = $this->Mdl_chalani->getByFormId($result->form_id);
            $is_muncipality                 = $this->session->userdata('is_muncipality');
            $ward                           = $this->session->userdata('ward_no');
            $save['is_muncipality']         = '1';
            $save['department']             = $this->session->userdata('department');
            $save['form_id']                = $result->form_id;
            $save['darta_id']               = $id;
            $chalani_no                     = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']             = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']   = date("Y-m-d",time());
            $save['nepali_chalani_miti']    = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']         = $result->name;
            $save['ward_login']             = $this->session->userdata('ward_no');
            $save['uri']                    = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']             = $current_session->id;
            $save['user_id']                = $this->session->userdata('id');
            $save['type']                   = 13;
            $data['status']                 = 3;
            $this->Mdl_chalani->save($save);
            $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
            redirect("sawari-pass/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."sawari-pass/details/".$id);
        }
    }

    public function sawari_pass_print() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sawari-pass");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_sawari_pass->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("sawari-pass");
        }


        //-----saving printing details--------------------
        $uri                = $this->uri->segment(1);
        $this_print         = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
        $save['uri']        = $uri; 
        $save['form_id']    = $result->form_id;
        $save['worker_id']  = $_POST['office_worker'];
        $save['office_id']  = $_POST['office_id'];

        //$bd                 = $this->input->post('bd');
        //$bodartha           = implode(',',$bd);
       // $update['bodartha']   = $bodartha;
        //$this->Mdl_sawari_pass->update($id,$update);
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

        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['bod']                    = $this->Mdl_bodartha->getPrintBod($result->bodartha);
        $data['office']                = $this->Mdl_office->getByID($data['print_detail']->office_id);
        //pp($data['office']);
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getById($data['print_detail']->worker_id);
        $data['post']                   = $this->Mdl_post->getById($data['workers']->post_id);
       // pp($data['post']);
        $data1['title']                 = "आवेदकको विवरण | स्थायी नियुक्ति पत्र";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('sawari_pass/print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }

/*------------------------------------------------------------------------------------------------------------------
    salary verify
------------------------------------------------------------------------------------------------------------------*/
    public function salary_verify()
    {
        // Modules::run("User/checkWardLogin");
        // $data['default']        = getDefault();
        // $data['states']         = $this->Mdl_state->getAll();
        // $data['districts']      = $this->Mdl_district->getAll();
        // $data['locals']         = $this->Mdl_local_body->getAll();
        // $data['wards']          = $this->Mdl_ward->getAll();
        // $data1['title']         = "स्थायी नियुक्ति पत्र";
        // $this->load->view('User/header',$data1);
        // $this->load->view('salary_verify/list',$data);
        // $this->load->view('User/footer');

        Modules::run("User/checkWardLogin");
        //$ward_login = $this->session->userdata('ward_no');
        // if($this->session->userdata('is_muncipality')==0)
        // {
        //     if(isset($_GET['submit']))
        //     {
        //         if(isset($_GET['search']))
        //         {
        //             $search         = $this->input->get('search');
        //             $result         = $this->Mdl_upgrade_position->searchByWord($search,$ward_login);
        //             $data['result'] = $result;
        //         }

        //         if(isset($_GET['status']))
        //         {
        //             $status         = $this->input->get('status');
        //             if($status == 0)
        //             {
        //                 $data['result']     = $this->Mdl_upgrade_position->getAll($ward_login);
        //             }
        //             else
        //             {
        //                 $data['result']     = $this->Mdl_upgrade_position->getByStatus($status,$ward_login);
        //             }
        //         }

        //         if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
        //         {
        //             if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
        //             {
        //                 $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
        //                 redirect(base_url()."sanstha-darta-pramanpatra");
        //             }
        //             $start_date     = DateNepToEng($this->input->get('start_date_nep'));
        //             $end_date       = DateNepToEng($this->input->get('end_date_nep'));
        //             $data['result'] = $this->Mdl_upgrade_position->getByDates($start_date,$end_date,$ward_login);
        //         }
        //         if(isset($_GET['month']))
        //         {
        //             $month      = $this->input->get('month');
        //             $end_date   = date("Y-m-d");
        //             $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

        //             $data['result'] = $this->Mdl_upgrade_position->getByDates($start_date,$end_date,$ward_login);
        //         }

        //     }
        //     else
        //     {
        //         $data['result']     = $this->Mdl_upgrade_position->getByStatus(1,$ward_login);
        //     }
        // }
        // else
        // {
        $url = $this->uri->segment(1);
        $department = $this->session->userdata('department');
        $table_name = $this->Mdl_salary_verify->getTableName();
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
            //$data['result']     = $this->Mdl_chalani->getAllByDepartmentAndUri($department, $table_name, $url);
            $data['result'] = $this->Mdl_salary_verify->getAllData();
        }
        //}
        $data1['title']     = "स्तर वृद्धि सम्वन्धमा ";
        $this->load->view('User/header',$data1);
        $this->load->view('salary_verify/list',$data);
        $this->load->view('User/footer');

    }

    public function salary_verify_create()
    {
        Modules::run("User/checkWardLogin");
         if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('name', '  ', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('salary-verify/create');
            }
            else
            {
                unset($_POST['submit']);
                $data['date']                   = $this->input->post('nepali_date');
                $data['gender']                 = $this->input->post('gender');
                $data['name']                   = $this->input->post('name');
                $data['cit_no']                 = $this->input->post('cit_no');
                $data['taha']                   = $this->input->post('taha');
                $data['position']               = $this->input->post('position');
                $data['basic_salary']           = $this->input->post('basic_salary');
                $data['grade']                  = $this->input->post('grade');
                $data['bhatta']                 = $this->input->post('bhatta');
                $data['local_bhatta']           = $this->input->post('local_bhatta');
                $data['pf']                     = $this->input->post('pf');
                $data['bima']                   = $this->input->post('bima');
                $data['status']                 = 1;
                $data['created_at']             = date("Y-m-d h:i:sa",time());
                $data['ward_login']             = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $data['session_id']             = $current_session->id;
                $data['form_id']                = Modules::run("Home/genFormId");
                if($id = $this->Mdl_salary_verify->save($data))
                {
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('salary-verify/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('salary-verify/create');

                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();

        $data1['title']         = "स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('salary_verify/create',$data);
        $this->load->view('User/footer');
    }

    public function salary_verify_edit()
    {
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_salary_verify->getById($id);
         if(isset($_POST['submit']))
        {
            //$this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('name', '  ', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('sawari-pass/create');
            }
            else
            {
                unset($_POST['submit']);
                $save['date']                   = $this->input->post('nepali_date');
                $save['gender']                 = $this->input->post('gender');
                $save['name']                   = $this->input->post('name');
                $save['cit_no']                 = $this->input->post('cit_no');
                $save['taha']                   = $this->input->post('taha');
                $save['position']               = $this->input->post('position');
                $save['basic_salary']           = $this->input->post('basic_salary');
                $save['grade']                  = $this->input->post('grade');
                $save['bhatta']                 = $this->input->post('bhatta');
                $save['local_bhatta']           = $this->input->post('local_bhatta');
                $save['pf']                     = $this->input->post('pf');
                $save['bima']                   = $this->input->post('bima');
                $save['status']                 = 1;
               // $save['created_at']             = date("Y-m-d h:i:sa",time());
                //$save['ward_login']             = $this->session->userdata('ward_no');
               // $current_session                = Modules::run("Settings/getCurrentSession");
                //$data['session_id']             = $current_session->id;
                //$data['form_id']                = Modules::run("Home/genFormId");
                if($this->Mdl_salary_verify->update($id,$save))
                {
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('salary-verify/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('salary-verify/create');

                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();

        $data1['title']         = "स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('salary_verify/create',$data);
        $this->load->view('User/footer');
    }

    //detail
    public function salary_verify_detail($id = NULL) {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("salary-verify");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_salary_verify->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("salary-verify");
        }
        if($result->status == 3)
        {
            $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
            $data['chalani_no'] = isset($chalani_result) ? $chalani_result->chalani_no:'';
        }
        // if($result->status == 3)
        // {
        //     $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        //     $data['chalani_no'] = $data['chalani_result']->chalani_no;
        // }
        $data['offices']                = $this->Mdl_office->getAll();
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getAll();
        $data['bodartha']               = $this->Mdl_bodartha->getAll();
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data1['title']                 = "आवेदकको विवरण | स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('salary_verify/detail',$data);
        $this->load->view('User/footer');
    }

    public function salary_verify_darta() {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
           redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("salary_verify");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_salary_verify->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("salary_verify");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("salary_verify/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("salary_verify/details/".$id);
        }

        $data['status']             = 2;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_salary_verify->update($id,$data))
        {
            $save['type']               = 13;
            $save['applicant_name']     = $result->name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $save['sifaris_id']         = $id;
            $current_session            = Modules::run("Settings/getCurrentSession");
            $save['session_id']         = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward);
            $save['form_id']            = $result->form_id;
            $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
            $save['english_darta_miti'] = date("Y-m-d",time());
            $save['is_muncipality']     = '1';
            $save['department']         = $this->session->userdata('department');
            $save['nepali_darta_miti']  = DateEngToNep($save['english_darta_miti']);
            $this->Mdl_darta->save($save);
            $this->session->set_flashdata('msg',"दर्ता हुन सफल |");
            redirect(base_url()."salary-verify/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."salary-verify/details/".$id);
        }

    }

    public function salary_verify_chalani() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("salary_verify");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_salary_verify->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("salary_verify");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("salary-verify/details/".$id);
        }

        $data['status']             = 3;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_salary_verify->update($id,$data))
        {

            $chalani_result                 = $this->Mdl_chalani->getByFormId($result->form_id);
            $is_muncipality                 = $this->session->userdata('is_muncipality');
            $ward                           = $this->session->userdata('ward_no');
            $save['is_muncipality']         = '1';
            $save['department']             = $this->session->userdata('department');
            $save['form_id']                = $result->form_id;
            $save['darta_id']               = $id;
            $chalani_no                     = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']             = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']   = date("Y-m-d",time());
            $save['nepali_chalani_miti']    = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']         = $result->name;
            $save['ward_login']             = $this->session->userdata('ward_no');
            $save['uri']                    = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']             = $current_session->id;
            $save['user_id']                = $this->session->userdata('id');
            $save['type']                   = 13;
            $data['status']                 = 3;
            $this->Mdl_chalani->save($save);
            $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
            redirect("salary-verify/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."salary-verify/details/".$id);
        }
    }

    public function salary_verify_print() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("salary-verify");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_salary_verify->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("salary-verify");
        }


        //-----saving printing details--------------------
        $uri                = $this->uri->segment(1);
        $this_print         = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
        $save['uri']        = $uri; 
        $save['form_id']    = $result->form_id;
        $save['worker_id']  = $_POST['office_worker'];
        $save['office_id']  = !empty($_POST['office_id'])?$_POST['office_id']:'';
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

        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['bod']                    = $this->Mdl_bodartha->getPrintBod($result->bodartha);
        $data['office']                = $this->Mdl_office->getByID($data['print_detail']->office_id);
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getById($data['print_detail']->worker_id);
        $data['post']                   = $this->Mdl_post->getById($data['workers']->post_id);
        $data1['title']                 = "आवेदकको विवरण | स्थायी नियुक्ति पत्र";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('salary_verify/print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }

/*------------------------------------------------------------------------------------------------------------------
    upgrade position
------------------------------------------------------------------------------------------------------------------*/
    public function upgrade_position()
    {
        Modules::run("User/checkWardLogin");
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data1['title']         = "स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('upgrade_position/list',$data);
        $this->load->view('User/footer');
    }

    public function upgrade_position_create()
    {
        Modules::run("User/checkWardLogin");
         if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('name', '  ', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('upgrade-position/create');
            }
            else
            {
                unset($_POST['submit']);
                $data['date']                   = $this->input->post('nepali_date');
                $data['gender']                 = $this->input->post('gender');
                $data['name']                   = $this->input->post('name');
                $data['cit_no']                 = $this->input->post('cit_no');
                $data['working_office']         = $this->input->post('working_office');
                $data['taha']                   = $this->input->post('taha');
                $data['position']               = $this->input->post('position');
                $data['from_date']              = $this->input->post('from_date');
                $data['start_date']             = $this->input->post('start_date');
                $data['period']                 = $this->input->post('period');
                $data['period_date']            = $this->input->post('period_date');
                $data['upgrade_taha']           = $this->input->post('upgrade_taha');
                $data['upgrade_position']       = $this->input->post('upgrade_position');
                $data['status']                 = 1;
                $data['created_at']             = date("Y-m-d h:i:sa",time());
                $data['ward_login']             = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $data['session_id']             = $current_session->id;
                $data['form_id']                = Modules::run("Home/genFormId");
                if($id = $this->Mdl_upgrade_position->save($data))
                {
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('upgrade-position/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('upgrade-position/create');

                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();
        $data1['title']         = "स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('upgrade_position/create',$data);
        $this->load->view('User/footer');
    }


    public function upgrade_position_edit()
    {
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_upgrade_position->getById($id);
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('name', '  ', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('upgrade-position/edit/'.$id);
            }
            else
            {
                unset($_POST['submit']);
                $save['date']                   = $this->input->post('nepali_date');
                $save['gender']                 = $this->input->post('gender');
                $save['name']                   = $this->input->post('name');
                $save['cit_no']                 = $this->input->post('cit_no');
                $save['working_office']         = $this->input->post('working_office');
                $save['taha']                   = $this->input->post('taha');
                $save['position']               = $this->input->post('position');
                $save['from_date']              = $this->input->post('from_date');
                $save['start_date']             = $this->input->post('start_date');
                $save['period']                 = $this->input->post('period');
                $save['period_date']            = $this->input->post('period_date');
                $save['upgrade_taha']           = $this->input->post('upgrade_taha');
                $save['upgrade_position']       = $this->input->post('upgrade_position');
                //$data['status']                 = 1;
                //$data['modified_at']             = date("Y-m-d h:i:sa",time());
                //$data['ward_login']             = $this->session->userdata('ward_no');
                //$current_session                = Modules::run("Settings/getCurrentSession");
                //$data['session_id']             = $current_session->id;
                //$data['form_id']                = Modules::run("Home/genFormId");
                if($this->Mdl_upgrade_position->update($id,$save))
                {
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('upgrade-position/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('upgrade-position/create');

                }

            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();
        $data1['title']         = "स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('upgrade_position/create',$data);
        $this->load->view('User/footer');
    }

    //detail
    public function upgrade_position_detail($id = NULL) {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("upgrade-position");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_upgrade_position->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("upgrade-position");
        }
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['offices']                = $this->Mdl_office->getAll();
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getAll();
        $data['bodartha']               = $this->Mdl_bodartha->getAll();
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data1['title']                 = "आवेदकको विवरण | स्थायी नियुक्ति पत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('upgrade_position/detail',$data);
        $this->load->view('User/footer');
    }

    public function upgrade_position_darta() {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
           redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("upgrade_position");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_upgrade_position->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("upgrade_position");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("upgrade_position/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("upgrade_position/details/".$id);
        }

        $data['status']             = 2;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_upgrade_position->update($id,$data))
        {
            $save['type']               = 13;
            $save['applicant_name']     = $result->name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $save['sifaris_id']         = $id;
            $current_session            = Modules::run("Settings/getCurrentSession");
            $save['session_id']         = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward);
            $save['form_id']            = $result->form_id;
            $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
            $save['english_darta_miti'] = date("Y-m-d",time());
            $save['is_muncipality']     = '1';
            $save['department']         = $this->session->userdata('department');
            $save['nepali_darta_miti']  = DateEngToNep($save['english_darta_miti']);
            $this->Mdl_darta->save($save);
            $this->session->set_flashdata('msg',"दर्ता हुन सफल |");
            redirect(base_url()."upgrade-position/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."upgrade-position/details/".$id);
        }

    }

    public function upgrade_position_chalani() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("upgrade_position");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_upgrade_position->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("upgrade_position");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("upgrade-position/details/".$id);
        }

        $data['status']             = 3;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_upgrade_position->update($id,$data))
        {

            $chalani_result                 = $this->Mdl_chalani->getByFormId($result->form_id);
            $is_muncipality                 = $this->session->userdata('is_muncipality');
            $ward                           = $this->session->userdata('ward_no');
            $save['is_muncipality']         = '1';
            $save['department']             = $this->session->userdata('department');
            $save['form_id']                = $result->form_id;
            $save['darta_id']               = $id;
            $chalani_no                     = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']             = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']   = date("Y-m-d",time());
            $save['nepali_chalani_miti']    = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']         = $result->name;
            $save['ward_login']             = $this->session->userdata('ward_no');
            $save['uri']                    = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']             = $current_session->id;
            $save['user_id']                = $this->session->userdata('id');
            $save['type']                   = 13;
            $data['status']                 = 3;
            $this->Mdl_chalani->save($save);
            $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
            redirect("upgrade-position/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."upgrade-position/details/".$id);
        }
    }

    public function upgrade_position_print() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("upgrade-position");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_upgrade_position->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("upgrade-position");
        }


        //-----saving printing details--------------------
        $uri                = $this->uri->segment(1);
        $this_print         = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
        $save['uri']        = $uri; 
        $save['form_id']    = $result->form_id;
        $save['worker_id']  = $_POST['office_worker'];
        $save['office_id']  = !empty($_POST['office_id'])?$_POST['office_id']:'';
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

        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['bod']                    = $this->Mdl_bodartha->getPrintBod($result->bodartha);
        $data['office']                 = $this->Mdl_office->getByID($data['print_detail']->office_id);
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getById($data['print_detail']->worker_id);
        $data['post']                   = $this->Mdl_post->getById($data['workers']->post_id);
        $data1['title']                 = "आवेदकको विवरण | स्थायी नियुक्ति पत्र";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('upgrade_position/print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }

    public function upgrade_position_view()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        //$ward_login = $this->session->userdata('ward_no');
        // if($this->session->userdata('is_muncipality')==0)
        // {
        //     if(isset($_GET['submit']))
        //     {
        //         if(isset($_GET['search']))
        //         {
        //             $search         = $this->input->get('search');
        //             $result         = $this->Mdl_upgrade_position->searchByWord($search,$ward_login);
        //             $data['result'] = $result;
        //         }

        //         if(isset($_GET['status']))
        //         {
        //             $status         = $this->input->get('status');
        //             if($status == 0)
        //             {
        //                 $data['result']     = $this->Mdl_upgrade_position->getAll($ward_login);
        //             }
        //             else
        //             {
        //                 $data['result']     = $this->Mdl_upgrade_position->getByStatus($status,$ward_login);
        //             }
        //         }

        //         if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
        //         {
        //             if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
        //             {
        //                 $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
        //                 redirect(base_url()."sanstha-darta-pramanpatra");
        //             }
        //             $start_date     = DateNepToEng($this->input->get('start_date_nep'));
        //             $end_date       = DateNepToEng($this->input->get('end_date_nep'));
        //             $data['result'] = $this->Mdl_upgrade_position->getByDates($start_date,$end_date,$ward_login);
        //         }
        //         if(isset($_GET['month']))
        //         {
        //             $month      = $this->input->get('month');
        //             $end_date   = date("Y-m-d");
        //             $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

        //             $data['result'] = $this->Mdl_upgrade_position->getByDates($start_date,$end_date,$ward_login);
        //         }

        //     }
        //     else
        //     {
        //         $data['result']     = $this->Mdl_upgrade_position->getByStatus(1,$ward_login);
        //     }
        // }
        // else
        // {
        $url = $this->uri->segment(1);
        $department = $this->session->userdata('department');
        $table_name = $this->Mdl_upgrade_position->getTableName();
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
            //$data['result']     = $this->Mdl_chalani->getAllByDepartmentAndUri($department, $table_name, $url);
            $data['result'] = $this->Mdl_upgrade_position->getAllData();
        }
        //}
        $data1['title']     = "स्तर वृद्धि सम्वन्धमा ";
        $this->load->view('User/header',$data1);
        $this->load->view('upgrade_position/view',$data);
        $this->load->view('User/footer');
    }
    
    /*------------------------------------------------------------------------------------------------------------------
    haijiri
------------------------------------------------------------------------------------------------------------------*/
    public function hajiri()
    {
        Modules::run("User/checkWardLogin");

                //$ward_login = $this->session->userdata('ward_no');
        // if($this->session->userdata('is_muncipality')==0)
        // {
        //     if(isset($_GET['submit']))
        //     {
        //         if(isset($_GET['search']))
        //         {
        //             $search         = $this->input->get('search');
        //             $result         = $this->Mdl_hajiri->searchByWord($search,$ward_login);
        //             $data['result'] = $result;
        //         }

        //         if(isset($_GET['status']))
        //         {
        //             $status         = $this->input->get('status');
        //             if($status == 0)
        //             {
        //                 $data['result']     = $this->Mdl_hajiri->getAll($ward_login);
        //             }
        //             else
        //             {
        //                 $data['result']     = $this->Mdl_hajiri->getByStatus($status,$ward_login);
        //             }
        //         }

        //         if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
        //         {
        //             if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
        //             {
        //                 $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
        //                 redirect(base_url()."sanstha-darta-pramanpatra");
        //             }
        //             $start_date     = DateNepToEng($this->input->get('start_date_nep'));
        //             $end_date       = DateNepToEng($this->input->get('end_date_nep'));
        //             $data['result'] = $this->Mdl_hajiri->getByDates($start_date,$end_date,$ward_login);
        //         }
        //         if(isset($_GET['month']))
        //         {
        //             $month      = $this->input->get('month');
        //             $end_date   = date("Y-m-d");
        //             $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

        //             $data['result'] = $this->Mdl_hajiri->getByDates($start_date,$end_date,$ward_login);
        //         }

        //     }
        //     else
        //     {
        //         $data['result']     = $this->Mdl_hajiri->getByStatus(1,$ward_login);
        //     }
        // }
        // else
        // {
        $url = $this->uri->segment(1);
        $department = $this->session->userdata('department');
        $table_name = $this->Mdl_hajiri->getTableName();
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
            //$data['result']     = $this->Mdl_chalani->getAllByDepartmentAndUri($department, $table_name, $url);
            $data['result'] = $this->Mdl_hajiri->getAllData();
        }
        //}

        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data1['title']         = "पदस्थापन तथा हाजिर ";
        $this->load->view('User/header',$data1);
        $this->load->view('hajiri/list',$data);
        $this->load->view('User/footer');
    }

    public function hajiri_create()
    {
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('name', '  ', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('hajiri/create');
            }
            else
            {
                unset($_POST['submit']);
                $data['date']                   = $this->input->post('nepali_date');
                $data['gender']                 = $this->input->post('gender');
                $data['name']                   = $this->input->post('name');
                $data['sewa']                   = $this->input->post('sewa');
                $data['cit_no']                 = $this->input->post('cit_no');
                $data['samuha']                 = $this->input->post('samuha');
                $data['taha']                   = $this->input->post('taha');
                $data['position']               = $this->input->post('position');
                $data['status']                 = 1;
                $data['partachar_office']       = $this->input->post('partachar_office');
                $data['patrachar_date']         = $this->input->post('patrachar_date');
                $data['yain']                   = $this->input->post('yain');
                $data['ramana_office']          = $this->input->post('ramana_office');
                $data['ramana_office_address']  = $this->input->post('ramana_office_address');
                $data['working_position']       = $this->input->post('working_position');
                $data['ramana_chalani_no']      = $this->input->post('ramana_chalani_no');
                $data['ramana_miti']            = $this->input->post('ramana_miti');
                $data['nirnaya_miti']           = $this->input->post('nirnaya_miti');
                $data['lagu_miti']              = $this->input->post('lagu_miti');
                $data['created_at']             = date("Y-m-d h:i:sa",time());
                $data['ward_login']             = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $data['session_id']             = $current_session->id;
                $data['form_id']                = Modules::run("Home/genFormId");
                if($id = $this->Mdl_hajiri->save($data))
                {
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('hajiri/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('upgrade-position/create');
                }
            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();
        $data['bodartha']       = $this->Mdl_bodartha->getAll();
        $data1['title']         = "पदस्थापन तथा हाजिर";
        $this->load->view('User/header',$data1);
        $this->load->view('hajiri/create',$data);
        $this->load->view('User/footer');
    }


    public function hajiri_edit()
    {
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_hajiri->getById($id);
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('name', '  ', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('hajiri/edit/'.$id);
            }
            else
            {
                unset($_POST['submit']);
                $save['date']                   = $this->input->post('nepali_date');
                $save['gender']                 = $this->input->post('gender');
                $save['name']                   = $this->input->post('name');
                $save['sewa']                   = $this->input->post('sewa');
                $save['cit_no']                 = $this->input->post('cit_no');
                $save['samuha']                 = $this->input->post('samuha');
                $save['taha']                   = $this->input->post('taha');
                $save['position']               = $this->input->post('position');
                $save['status']                 = 1;
                $save['partachar_office']       = $this->input->post('partachar_office');
                $save['patrachar_date']         = $this->input->post('patrachar_date');
                $save['yain']                   = $this->input->post('yain');
                $save['ramana_office']          = $this->input->post('ramana_office');
                $save['ramana_office_address']  = $this->input->post('ramana_office_address');
                $save['working_position']       = $this->input->post('working_position');
                $save['ramana_chalani_no']      = $this->input->post('ramana_chalani_no');
                $save['ramana_miti']            = $this->input->post('ramana_miti');
                $save['nirnaya_miti']           = $this->input->post('nirnaya_miti');
                $save['lagu_miti']              = $this->input->post('lagu_miti');
                if($this->Mdl_hajiri->update($id,$save))
                {
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('hajiri/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('hajiri/edit/'.$id);
                }
            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();
        $data['bodartha']       = $this->Mdl_bodartha->getAll();
        $data1['title']         = "पदस्थापन तथा हाजिर ";
        $this->load->view('User/header',$data1);
        $this->load->view('hajiri/create',$data);
        $this->load->view('User/footer');
    }

    //detail
    public function hajiri_detail($id = NULL) {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("upgrade-position");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_hajiri->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("hajiri");
        }
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['offices']                = $this->Mdl_office->getAll();
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getAll();
        $data['bodartha']               = $this->Mdl_bodartha->getAll();
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data1['title']                 = "पदस्थापन तथा हाजिर ";
        $this->load->view('User/header',$data1);
        $this->load->view('hajiri/detail',$data);
        $this->load->view('User/footer');
    }

    public function hajiri_darta() {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
           redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("hajiri");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_hajiri->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("hajiri");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("hajiri/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("hajiri/details/".$id);
        }

        $data['status']             = 2;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_hajiri->update($id,$data))
        {
            $save['type']               = 13;
            $save['applicant_name']     = $result->name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $save['sifaris_id']         = $id;
            $current_session            = Modules::run("Settings/getCurrentSession");
            $save['session_id']         = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward);
            $save['form_id']            = $result->form_id;
            $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
            $save['english_darta_miti'] = date("Y-m-d",time());
            $save['is_muncipality']     = '1';
            $save['department']         = $this->session->userdata('department');
            $save['nepali_darta_miti']  = DateEngToNep($save['english_darta_miti']);
            $this->Mdl_darta->save($save);
            $this->session->set_flashdata('msg',"दर्ता हुन सफल |");
            redirect(base_url()."upgrade-position/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."hajiri/details/".$id);
        }

    }

    public function hajiri_chalani() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("hajiri");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_hajiri->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("hajiri");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("hajiri/details/".$id);
        }

        $data['status']             = 3;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_hajiri->update($id,$data))
        {

            $chalani_result                 = $this->Mdl_chalani->getByFormId($result->form_id);
            $is_muncipality                 = $this->session->userdata('is_muncipality');
            $ward                           = $this->session->userdata('ward_no');
            $save['is_muncipality']         = '1';
            $save['department']             = $this->session->userdata('department');
            $save['form_id']                = $result->form_id;
            $save['darta_id']               = $id;
            $chalani_no                     = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']             = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']   = date("Y-m-d",time());
            $save['nepali_chalani_miti']    = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']         = $result->name;
            $save['ward_login']             = $this->session->userdata('ward_no');
            $save['uri']                    = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']             = $current_session->id;
            $save['user_id']                = $this->session->userdata('id');
            $save['type']                   = 13;
            $data['status']                 = 3;
            $this->Mdl_chalani->save($save);
            $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
            redirect("hajiri/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."upgrade-position/details/".$id);
        }
    }

    public function hajiri_print() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("hajiri");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_hajiri->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("hajiri");
        }
        //-----saving printing details--------------------
        $uri                = $this->uri->segment(1);
        $this_print         = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
        $save['uri']        = $uri; 
        $save['form_id']    = $result->form_id;
        $save['worker_id']  = $_POST['office_worker'];
        $save['office_id']  = !empty($_POST['office_id'])?$_POST['office_id']:'';
        $bd                 = $this->input->post('bd');
        $bodartha           = implode(',',$bd);
        $update['bodartha']   = $bodartha;
        $this->Mdl_hajiri->update($id,$update);
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

        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['bod']                    = $this->Mdl_bodartha->getPrintBod($result->bodartha);
        //pp($result->bodartha);
        $data['office']                 = $this->Mdl_office->getByID($data['print_detail']->office_id);
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getById($data['print_detail']->worker_id);
        $data['post']                   = $this->Mdl_post->getById($data['workers']->post_id);
        $data1['title']                 = "पदस्थापन तथा हाजिर ";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('hajiri/print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }

/*------------------------------------------------------------------------------------------------------------------
  kaam kaaz
------------------------------------------------------------------------------------------------------------------*/
    public function kaam_kaz()
    {
        Modules::run("User/checkWardLogin");

                //$ward_login = $this->session->userdata('ward_no');
        // if($this->session->userdata('is_muncipality')==0)
        // {
        //     if(isset($_GET['submit']))
        //     {
        //         if(isset($_GET['search']))
        //         {
        //             $search         = $this->input->get('search');
        //             $result         = $this->Mdl_kaam_kaz->searchByWord($search,$ward_login);
        //             $data['result'] = $result;
        //         }

        //         if(isset($_GET['status']))
        //         {
        //             $status         = $this->input->get('status');
        //             if($status == 0)
        //             {
        //                 $data['result']     = $this->Mdl_kaam_kaz->getAll($ward_login);
        //             }
        //             else
        //             {
        //                 $data['result']     = $this->Mdl_kaam_kaz->getByStatus($status,$ward_login);
        //             }
        //         }

        //         if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
        //         {
        //             if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
        //             {
        //                 $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
        //                 redirect(base_url()."sanstha-darta-pramanpatra");
        //             }
        //             $start_date     = DateNepToEng($this->input->get('start_date_nep'));
        //             $end_date       = DateNepToEng($this->input->get('end_date_nep'));
        //             $data['result'] = $this->Mdl_kaam_kaz->getByDates($start_date,$end_date,$ward_login);
        //         }
        //         if(isset($_GET['month']))
        //         {
        //             $month      = $this->input->get('month');
        //             $end_date   = date("Y-m-d");
        //             $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

        //             $data['result'] = $this->Mdl_kaam_kaz->getByDates($start_date,$end_date,$ward_login);
        //         }

        //     }
        //     else
        //     {
        //         $data['result']     = $this->Mdl_kaam_kaz->getByStatus(1,$ward_login);
        //     }
        // }
        // else
        // {
        $url = $this->uri->segment(1);
        $department = $this->session->userdata('department');
        $table_name = $this->Mdl_kaam_kaz->getTableName();
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
            //$data['result']     = $this->Mdl_chalani->getAllByDepartmentAndUri($department, $table_name, $url);
            $data['result'] = $this->Mdl_kaam_kaz->getAllData();
        }
        //}
        
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data1['title']         = "कामकाज गर्न खटाईएको";
        $this->load->view('User/header',$data1);
        $this->load->view('kaam_kaz/list',$data);
        $this->load->view('User/footer');
    }

    public function kaam_kaz_create()
    {
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('name', '  ', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('kaam_kaz/create');
            }
            else
            {
                unset($_POST['submit']);
                $data['date']                   = $this->input->post('nepali_date');
                $data['gender']                 = $this->input->post('gender');
                $data['name']                   = $this->input->post('name');
                $data['cit_no']                 = $this->input->post('cit_no');
                $data['sewa']                   = $this->input->post('sewa');
                $data['samuha']                 = $this->input->post('samuha');
                $data['taha']                   = $this->input->post('taha');
                $data['position']               = $this->input->post('position');
                $data['status']                 = 1;

                $data['working_sakha']       = $this->input->post('working_sakha');
                $data['other_sakha']         = $this->input->post('other_sakha');
                $data['transfer_office']                   = $this->input->post('transfer_office');
                $data['transer_position']          = $this->input->post('transer_position');
                $data['karya_office']  = $this->input->post('karya_office');
                $data['karya_post']       = $this->input->post('karya_post');
                $data['jimma_name']      = $this->input->post('jimma_name');
                $data['jimma_address']            = $this->input->post('jimma_address');
                $data['jimma_position']           = $this->input->post('jimma_position');
                $data['jimma_sewa']              = $this->input->post('jimma_sewa');
                //$data['jimma_sewa']              = $this->input->post('jimma_sewa');

                $data['nirnaya_miti']              = $this->input->post('nirnaya_miti');
               // $data['jimma_sewa']              = $this->input->post('jimma_sewa');

                $data['created_at']             = date("Y-m-d h:i:sa",time());
                $data['ward_login']             = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $data['session_id']             = $current_session->id;
                $data['form_id']                = Modules::run("Home/genFormId");
                if($id = $this->Mdl_kaam_kaz->save($data))
                {
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('kaam-kaz/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('kaam-kaz/create');
                }
            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();
        $data['bodartha']       = $this->Mdl_bodartha->getAll();
        $data1['title']         = "कामकाज गर्न खटाईएको";
        $this->load->view('User/header',$data1);
        $this->load->view('kaam_kaz/create',$data);
        $this->load->view('User/footer');
    }


    public function kaam_kaz_edit()
    {
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_kaam_kaz->getById($id);
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('name', '  ', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('kaam-kaz/edit/'.$id);
            }
            else
            {
                unset($_POST['submit']);

                $save['date']                   = $this->input->post('nepali_date');
                $save['gender']                 = $this->input->post('gender');
                $save['name']                   = $this->input->post('name');
                $save['cit_no']                 = $this->input->post('cit_no');
                $save['sewa']                   = $this->input->post('sewa');
                $save['samuha']                 = $this->input->post('samuha');
                $save['taha']                   = $this->input->post('taha');
                $save['position']               = $this->input->post('position');
                $save['working_sakha']          = $this->input->post('working_sakha');
                $save['other_sakha']            = $this->input->post('other_sakha');
                $save['transfer_office']        = $this->input->post('transfer_office');
                $save['transer_position']       = $this->input->post('transer_position');
                $save['karya_office']           = $this->input->post('karya_office');
                $save['karya_post']             = $this->input->post('karya_post');
                $save['jimma_name']             = $this->input->post('jimma_name');
                $save['jimma_address']          = $this->input->post('jimma_address');
                $save['jimma_position']         = $this->input->post('jimma_position');
                $save['jimma_sewa']             = $this->input->post('jimma_sewa');
                $save['nirnaya_miti']              = $this->input->post('nirnaya_miti');

                if($this->Mdl_kaam_kaz->update($id,$save))
                {
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('kaam-kaz/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('kaam-kaz/edit/'.$id);
                }
            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();
        $data['bodartha']       = $this->Mdl_bodartha->getAll();
        $data1['title']         = "कामकाज गर्न खटाईएको";
        $this->load->view('User/header',$data1);
        $this->load->view('kaam_kaz/create',$data);
        $this->load->view('User/footer');
    }

    //detail
    public function kaam_kaz_detail($id = NULL) {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("kaam-kaz");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_kaam_kaz->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("kaam_kaz");
        }
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['offices']                = $this->Mdl_office->getAll();
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getAll();
        $data['bodartha']               = $this->Mdl_bodartha->getAll();
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['selected_workers']                = $this->Mdl_worker->getById($data['print_detail']->worker_id);
        $data['selected_post']                   = $this->Mdl_post->getById($data['selected_workers']->post_id);
        $data1['title']                 = "कामकाज गर्न खटाईएको";
        $this->load->view('User/header',$data1);
        $this->load->view('kaam_kaz/detail',$data);
        $this->load->view('User/footer');
    }

    public function kaam_kaz_darta() {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
           redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("kaam_kaz");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_kaam_kaz->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("kaam-kaz");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("kaam-kaz/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("kaam-kaz/details/".$id);
        }

        $data['status']             = 2;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_kaam_kaz->update($id,$data))
        {
            $save['type']               = 13;
            $save['applicant_name']     = $result->name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $save['sifaris_id']         = $id;
            $current_session            = Modules::run("Settings/getCurrentSession");
            $save['session_id']         = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward);
            $save['form_id']            = $result->form_id;
            $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
            $save['english_darta_miti'] = date("Y-m-d",time());
            $save['is_muncipality']     = '1';
            $save['department']         = $this->session->userdata('department');
            $save['nepali_darta_miti']  = DateEngToNep($save['english_darta_miti']);
            $this->Mdl_darta->save($save);
            $this->session->set_flashdata('msg',"दर्ता हुन सफल |");
            redirect(base_url()."kaam-kaz/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."kaam-kaz/details/".$id);
        }

    }

    public function kaam_kaz_chalani() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("kaam-kaz");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_kaam_kaz->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("kaam-kaz");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("kaam-kaz/details/".$id);
        }

        $data['status']             = 3;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_kaam_kaz->update($id,$data))
        {

            $chalani_result                 = $this->Mdl_chalani->getByFormId($result->form_id);
            $is_muncipality                 = $this->session->userdata('is_muncipality');
            $ward                           = $this->session->userdata('ward_no');
            $save['is_muncipality']         = '1';
            $save['department']             = $this->session->userdata('department');
            $save['form_id']                = $result->form_id;
            $save['darta_id']               = $id;
            $chalani_no                     = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']             = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']   = date("Y-m-d",time());
            $save['nepali_chalani_miti']    = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']         = $result->name;
            $save['ward_login']             = $this->session->userdata('ward_no');
            $save['uri']                    = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']             = $current_session->id;
            $save['user_id']                = $this->session->userdata('id');
            $save['type']                   = 13;
            $data['status']                 = 3;
            $this->Mdl_chalani->save($save);
            $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
            redirect("kaam-kaz/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."kaam-kaz/details/".$id);
        }
    }

    public function kaam_kaz_print() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("kaam-kaz");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_kaam_kaz->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("kaam-kaz");
        }
        //-----saving printing details--------------------
        $uri                    = $this->uri->segment(1);
        $this_print             = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
        $save['uri']            = $uri; 
        $save['form_id']        = $result->form_id;
        $save['worker_id']      = $_POST['office_worker'];
        $save['office_id']      = !empty($_POST['office_id'])?$_POST['office_id']:'';
        $bd                     = $this->input->post('bd');
        $bodartha               = implode(',',$bd);
        $update['bodartha']     = $bodartha;
        $this->Mdl_kaam_kaz->update($id,$update);
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

        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['bod']                    = $this->Mdl_bodartha->getPrintBod($result->bodartha);
        $data['office']                 = $this->Mdl_office->getByID($data['print_detail']->office_id);
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getById($data['print_detail']->worker_id);
        $data['post']                   = $this->Mdl_post->getById($data['workers']->post_id);
        $data1['title']                 = "कामकाज गर्न खटाईएको ";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('kaam_kaz/print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }


/*------------------------------------------------------------------------------------------------------------------
  karar niyukti
------------------------------------------------------------------------------------------------------------------*/
    public function karar_niyukti()
    {
        Modules::run("User/checkWardLogin");

        //$ward_login = $this->session->userdata('ward_no');
        // if($this->session->userdata('is_muncipality')==0)
        // {
        //     if(isset($_GET['submit']))
        //     {
        //         if(isset($_GET['search']))
        //         {
        //             $search         = $this->input->get('search');
        //             $result         = $this->Mdl_karar_niyukti->searchByWord($search,$ward_login);
        //             $data['result'] = $result;
        //         }

        //         if(isset($_GET['status']))
        //         {
        //             $status         = $this->input->get('status');
        //             if($status == 0)
        //             {
        //                 $data['result']     = $this->Mdl_karar_niyukti->getAll($ward_login);
        //             }
        //             else
        //             {
        //                 $data['result']     = $this->Mdl_karar_niyukti->getByStatus($status,$ward_login);
        //             }
        //         }

        //         if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
        //         {
        //             if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
        //             {
        //                 $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
        //                 redirect(base_url()."sanstha-darta-pramanpatra");
        //             }
        //             $start_date     = DateNepToEng($this->input->get('start_date_nep'));
        //             $end_date       = DateNepToEng($this->input->get('end_date_nep'));
        //             $data['result'] = $this->Mdl_karar_niyukti->getByDates($start_date,$end_date,$ward_login);
        //         }
        //         if(isset($_GET['month']))
        //         {
        //             $month      = $this->input->get('month');
        //             $end_date   = date("Y-m-d");
        //             $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

        //             $data['result'] = $this->Mdl_karar_niyukti->getByDates($start_date,$end_date,$ward_login);
        //         }

        //     }
        //     else
        //     {
        //         $data['result']     = $this->Mdl_karar_niyukti->getByStatus(1,$ward_login);
        //     }
        // }
        // else
        // {
        $url = $this->uri->segment(1);
        $department = $this->session->userdata('department');
        $table_name = $this->Mdl_karar_niyukti->getTableName();
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
            //$data['result']     = $this->Mdl_chalani->getAllByDepartmentAndUri($department, $table_name, $url);
            $data['result'] = $this->Mdl_karar_niyukti->getAllData();
        }
        //}
        
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data1['title']         = "सेवा करार नियुक्ति ";
        $this->load->view('User/header',$data1);
        $this->load->view('karar_niyukti/list',$data);
        $this->load->view('User/footer');
    }

    public function karar_niyukti_create()
    {
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            //$this->form_validation->set_rules('name', '  ', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('karar-niyukti/create');
            }
            else
            {
                unset($_POST['submit']);
                $data['date']                   = $this->input->post('nepali_date');
                $data['gender']                 = $this->input->post('gender');
                $data['name']                   = $this->input->post('name');
                // $data['cit_no']                 = $this->input->post('cit_no');
                $data['position']               = $this->input->post('position');
                $data['status']                 = 1;
                $data['reason_for']             = $this->input->post('reason_for');
                $data['yain']                   = $this->input->post('yain');
                $data['responsbility']          = $this->input->post('responsbility');
                $data['assigned_sakha']         = $this->input->post('assigned_sakha');
                $data['sakha_address']          = $this->input->post('sakha_address');
                $data['niyukta_miti']           = $this->input->post('niyukta_miti');
                $data['karar_period']           = $this->input->post('karar_period');

                $data['created_at']             = date("Y-m-d h:i:sa",time());
                $data['ward_login']             = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $data['session_id']             = $current_session->id;
                $data['form_id']                = Modules::run("Home/genFormId");
                if($id = $this->Mdl_karar_niyukti->save($data))
                {
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('karar-niyukti/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('karar-niyukti/create');
                }
            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();
        $data['bodartha']       = $this->Mdl_bodartha->getAll();
        $data1['title']         = "सेवा करार नियुक्ति ";
        $this->load->view('User/header',$data1);
        $this->load->view('karar_niyukti/create',$data);
        $this->load->view('User/footer');
    }


    public function karar_niyukti_edit()
    {
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_karar_niyukti->getById($id);
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('name', '  ', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('karar-niyukti/edit/'.$id);
            }
            else
            {
                unset($_POST['submit']);

                $save['date']                   = $this->input->post('nepali_date');
                $save['gender']                 = $this->input->post('gender');
                $save['name']                   = $this->input->post('name');
                $save['cit_no']                 = $this->input->post('cit_no');
                $save['sewa']                   = $this->input->post('sewa');
                $save['samuha']                 = $this->input->post('samuha');
                $save['taha']                   = $this->input->post('taha');
                $save['position']               = $this->input->post('position');
                $save['working_sakha']          = $this->input->post('working_sakha');
                $save['other_sakha']            = $this->input->post('other_sakha');
                $save['transfer_office']        = $this->input->post('transfer_office');
                $save['transer_position']       = $this->input->post('transer_position');
                $save['karya_office']           = $this->input->post('karya_office');
                $save['karya_post']             = $this->input->post('karya_post');
                $save['jimma_name']             = $this->input->post('jimma_name');
                $save['jimma_address']          = $this->input->post('jimma_address');
                $save['jimma_position']         = $this->input->post('jimma_position');
                $save['jimma_sewa']             = $this->input->post('jimma_sewa');
                $save['nirnaya_miti']              = $this->input->post('nirnaya_miti');

                if($this->Mdl_karar_niyukti->update($id,$save))
                {
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('karar-niyukti/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('karar-niyukti/edit/'.$id);
                }
            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();
        $data['bodartha']       = $this->Mdl_bodartha->getAll();
        $data1['title']         = "सेवा करार नियुक्ति ";
        $this->load->view('User/header',$data1);
        $this->load->view('karar_niyukti/create',$data);
        $this->load->view('User/footer');
    }

    //detail
    public function karar_niyukti_detail($id = NULL) {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("karar-niyukti");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_karar_niyukti->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("karar-niyukti");
        }
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['offices']                = $this->Mdl_office->getAll();
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getAll();
        $data['bodartha']               = $this->Mdl_bodartha->getAll();
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['selected_workers']       = $this->Mdl_worker->getById($data['print_detail']->worker_id);
        $data['selected_post']          = $this->Mdl_post->getById($data['selected_workers']->post_id);
        $data1['title']                 = "सेवा करार नियुक्ति";
        $this->load->view('User/header',$data1);
        $this->load->view('karar_niyukti/detail',$data);
        $this->load->view('User/footer');
    }

    public function karar_niyukti_darta() {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
           redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("karar-niyukti");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_karar_niyukti->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("karar-niyukti");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("karar-niyukti/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("karar-niyukti/details/".$id);
        }

        $data['status']             = 2;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_karar_niyukti->update($id,$data))
        {
            $save['type']               = 13;
            $save['applicant_name']     = $result->name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $save['sifaris_id']         = $id;
            $current_session            = Modules::run("Settings/getCurrentSession");
            $save['session_id']         = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward);
            $save['form_id']            = $result->form_id;
            $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
            $save['english_darta_miti'] = date("Y-m-d",time());
            $save['is_muncipality']     = '1';
            $save['department']         = $this->session->userdata('department');
            $save['nepali_darta_miti']  = DateEngToNep($save['english_darta_miti']);
            $this->Mdl_darta->save($save);
            $this->session->set_flashdata('msg',"दर्ता हुन सफल |");
            redirect(base_url()."karar-niyukti/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."karar-niyukti/details/".$id);
        }

    }

    public function karar_niyukti_chalani() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("karar-niyukti");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_karar_niyukti->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("karar-niyukti");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("karar-niyukti/details/".$id);
        }

        $data['status']             = 3;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_karar_niyukti->update($id,$data))
        {

            $chalani_result                 = $this->Mdl_chalani->getByFormId($result->form_id);
            $is_muncipality                 = $this->session->userdata('is_muncipality');
            $ward                           = $this->session->userdata('ward_no');
            $save['is_muncipality']         = '1';
            $save['department']             = $this->session->userdata('department');
            $save['form_id']                = $result->form_id;
            $save['darta_id']               = $id;
            $chalani_no                     = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']             = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']   = date("Y-m-d",time());
            $save['nepali_chalani_miti']    = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']         = $result->name;
            $save['ward_login']             = $this->session->userdata('ward_no');
            $save['uri']                    = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']             = $current_session->id;
            $save['user_id']                = $this->session->userdata('id');
            $save['type']                   = 13;
            $data['status']                 = 3;
            $this->Mdl_chalani->save($save);
            $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
            redirect("karar-niyukti/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."karar-niyukti/details/".$id);
        }
    }

    public function karar_niyukti_print() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("karar-niyukti");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_karar_niyukti->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("karar-niyukti");
        }
        //-----saving printing details--------------------
        $uri                    = $this->uri->segment(1);
        $this_print             = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
        $save['uri']            = $uri; 
        $save['form_id']        = $result->form_id;
        $save['worker_id']      = $_POST['office_worker'];
        $save['office_id']      = !empty($_POST['office_id'])?$_POST['office_id']:'';
        $bd                     = $this->input->post('bd');
        $bodartha               = implode(',',$bd);
        $update['bodartha']     = $bodartha;
        $this->Mdl_karar_niyukti->update($id,$update);
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

        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['bod']                    = $this->Mdl_bodartha->getPrintBod($result->bodartha);
        $data['office']                 = $this->Mdl_office->getByID($data['print_detail']->office_id);
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getById($data['print_detail']->worker_id);
        $data['post']                   = $this->Mdl_post->getById($data['workers']->post_id);
        $data1['title']                 = "सेवा करार नियुक्ति";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('karar_niyukti/print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
/*------------------------------------------------------------------------------------------------------------------
  approve wiwaran
------------------------------------------------------------------------------------------------------------------*/
    public function approve_wiwaran()
    {
        Modules::run("User/checkWardLogin");

        //$ward_login = $this->session->userdata('ward_no');
        // if($this->session->userdata('is_muncipality')==0)
        // {
        //     if(isset($_GET['submit']))
        //     {
        //         if(isset($_GET['search']))
        //         {
        //             $search         = $this->input->get('search');
        //             $result         = $this->Mdl_approve_wiwaran->searchByWord($search,$ward_login);
        //             $data['result'] = $result;
        //         }

        //         if(isset($_GET['status']))
        //         {
        //             $status         = $this->input->get('status');
        //             if($status == 0)
        //             {
        //                 $data['result']     = $this->Mdl_approve_wiwaran->getAll($ward_login);
        //             }
        //             else
        //             {
        //                 $data['result']     = $this->Mdl_approve_wiwaran->getByStatus($status,$ward_login);
        //             }
        //         }

        //         if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
        //         {
        //             if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
        //             {
        //                 $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
        //                 redirect(base_url()."sanstha-darta-pramanpatra");
        //             }
        //             $start_date     = DateNepToEng($this->input->get('start_date_nep'));
        //             $end_date       = DateNepToEng($this->input->get('end_date_nep'));
        //             $data['result'] = $this->Mdl_approve_wiwaran->getByDates($start_date,$end_date,$ward_login);
        //         }
        //         if(isset($_GET['month']))
        //         {
        //             $month      = $this->input->get('month');
        //             $end_date   = date("Y-m-d");
        //             $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

        //             $data['result'] = $this->Mdl_approve_wiwaran->getByDates($start_date,$end_date,$ward_login);
        //         }

        //     }
        //     else
        //     {
        //         $data['result']     = $this->Mdl_approve_wiwaran->getByStatus(1,$ward_login);
        //     }
        // }
        // else
        // {
        $url = $this->uri->segment(1);
        $department = $this->session->userdata('department');
        $table_name = $this->Mdl_approve_wiwaran->getTableName();
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
            //$data['result']     = $this->Mdl_chalani->getAllByDepartmentAndUri($department, $table_name, $url);
            $data['result'] = $this->Mdl_approve_wiwaran->getAllData();
        }
        //}
        
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data1['title']         = "विवरण प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('approve_wiwaran/list',$data);
        $this->load->view('User/footer');
    }

    public function approve_wiwaran_create()
    {
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            //$this->form_validation->set_rules('name', '  ', 'required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('approve-wiwaran/create');
            }
            else
            {
                unset($_POST['submit']);
                $data['status']                 = 1;
                $data['date']                   = $this->input->post('nepali_date');
                $data['gender']                 = $this->input->post('gender');
                $data['name']                   = $this->input->post('name');
                $data['cit_no']                 = $this->input->post('cit_no');
                $data['sewa']                   = $this->input->post('sewa');
                $data['samuha']                 = $this->input->post('samuha');
                $data['taha']                   = $this->input->post('taha');
                $data['position']               = $this->input->post('position');
                $data['yain']                   = $this->input->post('yain');
                $data['working_office']         = $this->input->post('working_office');
                $data['from_date']              = $this->input->post('from_date');
                $data['end_date']               = $this->input->post('end_date');
                $data['retirement_type']        = $this->input->post('retirement_type');
                $data['other_details']          = $this->input->post('other_details');
                $data['created_at']             = date("Y-m-d h:i:sa",time());
                $data['ward_login']             = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $data['session_id']             = $current_session->id;
                $data['form_id']                = Modules::run("Home/genFormId");
                if($id = $this->Mdl_approve_wiwaran->save($data))
                {
                    $tapasil            = array();
                    $bida_wiwaran       = $this->input->post('bida_wiwaran');
                    $jamma_din          = $this->input->post('jamma_din');
                    $kharcha            = $this->input->post('kharcha');
                    $baki               = $this->input->post('baki');
                    $remarks            = $this->input->post('remarks');
                    if(!empty($bida_wiwaran)) {
                        foreach ($bida_wiwaran as $key => $indexv) {
                            $tapasil[]    = array(
                                'bida_wiwaran'          => $bida_wiwaran[$key],
                                'jamma_din'             => $jamma_din[$key],
                                'kharcha'               => $kharcha[$key],
                                'baki'                  => $baki[$key],
                                'remarks'               => $remarks[$key],
                                'wiwaran_id'            => $id,
                            );
                        }
                        $this->Mdl_approve_wiwaran->saveTapasil($tapasil);
                    }
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('approve-wiwaran/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('approve-wiwaran/create');
                }
            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();
        $data['bodartha']       = $this->Mdl_bodartha->getAll();
        $data1['title']         = "विवरण प्रमाणित";
        $this->load->view('User/header',$data1);
        $this->load->view('approve_wiwaran/create',$data);
        $this->load->view('User/footer');
    }


    public function approve_wiwaran_edit()
    {
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_approve_wiwaran->getById($id);
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('nepali_date', 'आवेदन दिएको मिति', 'required');
            $this->form_validation->set_rules('name', '  ', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('approve-wiwaran/edit/'.$id);
            }
            else
            {
                unset($_POST['submit']);

                $save['date']                   = $this->input->post('nepali_date');
                $save['gender']                 = $this->input->post('gender');
                $save['name']                   = $this->input->post('name');
                $save['cit_no']                 = $this->input->post('cit_no');
                $save['sewa']                   = $this->input->post('sewa');
                $save['samuha']                 = $this->input->post('samuha');
                $save['taha']                   = $this->input->post('taha');
                $save['position']               = $this->input->post('position');
                $save['yain']                   = $this->input->post('yain');
                $save['working_office']         = $this->input->post('working_office');
                $save['from_date']              = $this->input->post('from_date');
                $save['end_date']               = $this->input->post('end_date');
                $save['retirement_type']        = $this->input->post('retirement_type');
                $save['other_details']          = $this->input->post('other_details');

                if($this->Mdl_approve_wiwaran->update($id,$save))
                {
                    $tapasil_update     = array();
                    $tapasi_update_id   = $this->input->post('tapasi_update_id');
                    $bida_wiwaran       = $this->input->post('bida_wiwaran');
                    $jamma_din          = $this->input->post('jamma_din');
                    $kharcha            = $this->input->post('kharcha');
                    $baki               = $this->input->post('baki');
                    $remarks            = $this->input->post('remarks');
                    if(!empty($bida_wiwaran)) {
                        foreach ($bida_wiwaran as $key => $indexv) {
                            $tapasil_update[]    = array(
                                'id'                    => $tapasi_update_id[$key],
                                'bida_wiwaran'          => $bida_wiwaran[$key],
                                'jamma_din'             => $jamma_din[$key],
                                'kharcha'               => $kharcha[$key],
                                'baki'                  => $baki[$key],
                                'remarks'               => $remarks[$key]
                            );
                        }
                        $this->Mdl_approve_wiwaran->updateTapasil($tapasil_update);
                    }

                    $tapasil_save           = array();
                    $bida_wiwaran_new       = $this->input->post('bida_wiwaran_new');
                    $jamma_din_new          = $this->input->post('jamma_din_new');
                    $kharcha_new            = $this->input->post('kharcha_new');
                    $baki_new               = $this->input->post('baki_new');
                    $remarks_new            = $this->input->post('remarks_new');
                    if(!empty($bida_wiwaran_new)) {
                        foreach ($bida_wiwaran_new as $key => $indexv) {
                            $tapasil_save[]    = array(
                                'id'                    => $tapasi_update_id_new[$key],
                                'bida_wiwaran'          => $bida_wiwaran_new[$key],
                                'jamma_din'             => $jamma_din_new[$key],
                                'kharcha'               => $kharcha_new[$key],
                                'baki'                  => $baki_new[$key],
                                'remarks'               => $remarks_new[$key]
                            );
                        }
                        $this->Mdl_approve_wiwaran->saveTapasil($tapasil_save);
                    }

                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('approve-wiwaran/details/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg'," समस्या आयो |");
                    redirect('approve-wiwaran/edit/'.$id);
                }
            }
        }
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['yain']           = $this->Mdl_yain->getAll();
        $data['bodartha']       = $this->Mdl_bodartha->getAll();
        $data['tapasil']                = $this->Mdl_approve_wiwaran->getByTapasil($id);
        $data1['title']         = "सेवा करार नियुक्ति ";
        $this->load->view('User/header',$data1);
        $this->load->view('approve_wiwaran/edit',$data);
        $this->load->view('User/footer');
    }

    //detail
    public function approve_wiwaran_detail($id = NULL) {
        
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("approve-wiwaran");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_approve_wiwaran->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("approve-wiwaran");
        }
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['offices']                = $this->Mdl_office->getAll();
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getAll();
        $data['bodartha']               = $this->Mdl_bodartha->getAll();
        $data['tapasil']                = $this->Mdl_approve_wiwaran->getByTapasil($id);
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['selected_workers']       = $this->Mdl_worker->getById($data['print_detail']->worker_id);
        $data['selected_post']          = $this->Mdl_post->getById($data['selected_workers']->post_id);
        $data1['title']                 = "सेवा करार नियुक्ति";
        $this->load->view('User/header',$data1);
        $this->load->view('approve_wiwaran/detail',$data);
        $this->load->view('User/footer');
    }

    public function approve_wiwaran_darta() {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
           redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("approve-wiwaran");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_approve_wiwaran->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("approve-wiwaran");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("approve-wiwaran/details/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("approve-wiwaran/details/".$id);
        }

        $data['status']             = 2;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_approve_wiwaran->update($id,$data))
        {
            $save['type']               = 13;
            $save['applicant_name']     = $result->name;
            $save['ward_login']         = $this->session->userdata('ward_no');
            $save['uri']                = $this->uri->segment(1);
            $save['sifaris_id']         = $id;
            $current_session            = Modules::run("Settings/getCurrentSession");
            $save['session_id']         = $current_session->id;
            $save['user_id']            = $this->session->userdata('id');
            $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward);
            $save['form_id']            = $result->form_id;
            $save['darta_no']           = $darta_no==FALSE ? 1 : $darta_no + 1;
            $save['english_darta_miti'] = date("Y-m-d",time());
            $save['is_muncipality']     = '1';
            $save['department']         = $this->session->userdata('department');
            $save['nepali_darta_miti']  = DateEngToNep($save['english_darta_miti']);
            $this->Mdl_darta->save($save);
            $this->session->set_flashdata('msg',"दर्ता हुन सफल |");
            redirect(base_url()."approve-wiwaran/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."approve-wiwaran/details/".$id);
        }

    }

    public function approve_wiwaran_chalani() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("approve-wiwaran");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_approve_wiwaran->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("approve-wiwaran");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("approve-wiwaran/details/".$id);
        }

        $data['status']             = 3;
        $is_muncipality = $this->session->userdata('is_muncipality');
        if($this->Mdl_approve_wiwaran->update($id,$data))
        {

            $chalani_result                 = $this->Mdl_chalani->getByFormId($result->form_id);
            $is_muncipality                 = $this->session->userdata('is_muncipality');
            $ward                           = $this->session->userdata('ward_no');
            $save['is_muncipality']         = '1';
            $save['department']             = $this->session->userdata('department');
            $save['form_id']                = $result->form_id;
            $save['darta_id']               = $id;
            $chalani_no                     = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']             = $chalani_no==FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']   = date("Y-m-d",time());
            $save['nepali_chalani_miti']    = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']         = $result->name;
            $save['ward_login']             = $this->session->userdata('ward_no');
            $save['uri']                    = $this->uri->segment(1);
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']             = $current_session->id;
            $save['user_id']                = $this->session->userdata('id');
            $save['type']                   = 13;
            $data['status']                 = 3;
            $this->Mdl_chalani->save($save);
            $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
            redirect("approve-wiwaran/details/".$id);
        }
        else
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."approve-wiwaran/details/".$id);
        }
    }

    public function approve_wiwaran_print() {
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("approve-wiwaran");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_approve_wiwaran->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("approve-wiwaran");
        }
        //-----saving printing details--------------------
        $uri                    = $this->uri->segment(1);
        $this_print             = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
        $save['uri']            = $uri; 
        $save['form_id']        = $result->form_id;
        $save['worker_id']      = $_POST['office_worker'];
        $save['office_id']      = !empty($_POST['office_id'])?$_POST['office_id']:'';
        $bd                     = $this->input->post('bd');
        $bodartha               = implode(',',$bd);
        $update['bodartha']     = $bodartha;
        $this->Mdl_approve_wiwaran->update($id,$update);
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

        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['print_detail']           = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['office']                = $this->Mdl_office->getByID($data['print_detail']->office_id);
        $data['tapasil']                = $this->Mdl_approve_wiwaran->getByTapasil($id);
        $data['bod']                    = $this->Mdl_bodartha->getPrintBod($result->bodartha);
        $data['office']                 = $this->Mdl_office->getByID($data['print_detail']->office_id);
        $data['local_body']             = Modules::run("Settings/getLocal",$result->ganapa);
        $data['state']                  = Modules::run("Settings/getState",$result->state);
        $data['district']               = Modules::run("Settings/getDistrict",$result->district);
        $data['current_session']        = Modules::run('Settings/getCurrentSession',$result->session_id);
        $data['workers']                = $this->Mdl_worker->getById($data['print_detail']->worker_id);
        $data['post']                   = $this->Mdl_post->getById($data['workers']->post_id);
        $data1['title']                 = "विवरण प्रमाणित";
        $this->load->view('User/header1',$data1);
        $this->load->view('letter_head_np');
        $this->load->view('approve_wiwaran/print',$data);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }

}
