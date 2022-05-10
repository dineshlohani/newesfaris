<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DartaChalaniBook extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_darta');
        $this->load->model('Mdl_chalani');
        $this->load->model('Mdl_maujuda_suchi');
        $this->load->model('Mdl_sachiwalaya_darta');
        $this->load->model('Mdl_suchi_darta');
        $this->load->model('Mdl_sachiwalaya_darta_detail');

        $this->load->model('Notification/Mdl_notification');
        $this->load->model('User/Mdl_user');
        $this->load->model('Settings/Mdl_state');
        $this->load->model('Settings/Mdl_district');
        $this->load->model('Settings/Mdl_local_body');
        $this->load->model('Settings/Mdl_ward');
        $this->load->model('Settings/Mdl_department');
        $this->load->model('Settings/Mdl_office');
        $this->load->model('Settings/Mdl_session');
        $this->load->model('Settings/Mdl_work');
        $this->load->model('Settings/Mdl_service');


        $this->load->helper('functions_helper');

    }
    /*--------------------------------------------------------------------------------------------------------*/
    /*------Global Use---------------*/
    /*--------------------------------------------------------------------------------------------------------*/
    public function getDartaByFormId($form_id)
    {
        $result = $this->Mdl_darta->getByFormId($form_id);
        return $result;
    }
    /*--------------------------------------------------------------------------------------------------------*/
    public function getSachiwalayaDartaByFormId($form_id)
    {
        $result = $this->Mdl_sachiwalaya_darta->getByFormId($form_id);
        return $result;
    }
    /*--------------------------------------------------------------------------------------------------------*/
    /*--------------------------------------------------------------------------------------------------------*/

    /*--------------------------------------------------------------------------------------------------------*/
    /*------Darta Kitab ---------------*/
    /*--------------------------------------------------------------------------------------------------------*/
    public function darta_book()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $ward_login        = $this->session->userdata('ward_no');
        $is_muncipality    = $this->session->userdata('is_muncipality');
        if(isset($_GET['submit']))
        {
            if(isset($_GET['search']))
            {
                $search         = $this->input->get('search');
                $result         = $this->Mdl_darta->searchByWord($search, $is_muncipality, $ward_login);
                $data['result'] = $result;
            }
            // print_r($result);
            if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
            {
                if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                {
                    $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                    redirect(base_url()."darta-book");
                }
                $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                $data['result'] = $this->Mdl_darta->getByDates($start_date, $end_date, $is_muncipality, $ward_login);
            }
            if(isset($_GET['month']))
            {
                $month      = $this->input->get('month');
                $end_date   = date("Y-m-d");
                $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));
                $data['result'] = $this->Mdl_darta->getByDates($start_date, $end_date, $is_muncipality, $ward_login);
            }
        }
        else
        {
            if($is_muncipality == 1 )
            {
                $data['result'] = $this->Mdl_darta->getAllByMuncipality();
            }
            else
            {
                $data['result']    = $this->Mdl_darta->getAllByWard($ward_login);
            }
        }

        $data1['title']     = 'विवरणहरु | चिठ्ठी पुर्जी दर्ता किताब';
        $this->load->view('User/header',$data1);
        $this->load->view('darta_book',$data);
        $this->load->view('User/footer');
    }
    /*--------------------------------------------------------------------------------------------------------*/
    public function darta_book_detail()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect(base_url()."chalani-book");
        }
        $id         = $this->uri->segment(3);
        $result = $data['result']     = $this->Mdl_darta->getById($id);
        $this_notify    = $this->Mdl_notification->getByFormIdToDepartment($result->form_id, $this->session->userdata('department'));
        if($this_notify != FALSE)
        {
            $save['is_seen']     = '1';
            $save['modified_at'] = date('Y-m-d H:i:sa');
            $this->Mdl_notification->update($this_notify->id, $save);
        }
        if($result->form_id != 0 )
        {
            $data['chalani_detail']   = $this->Mdl_chalani->getByFormId($result->form_id);
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "विवरण | चिठ्ठी पुर्जा दर्ता किताब";
        $this->load->view('User/header',$data1);
        $this->load->view('darta_book_detail',$data);
        $this->load->view('User/footer');
    }
    /*--------------------------------------------------------------------------------------------------------*/
    /*----- Darta No Reserve ------------*/
    /*--------------------------------------------------------------------------------------------------------*/
    public function fix_darta_no()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $allowed_roles = ['superadmin'];
        if(!in_array($this->session->userdata('mode'), $allowed_roles))
        {
            $this->session->set_flashdata('err_msg', 'Permission Denied');
            redirect(base_url().'index');
        }
        $ward_login = $this->session->userdata('ward_no');
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('number',"कति वोटा दर्ता रिजभ गर्नुहुन्छ","required");
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "validation_errors()");
                redirect(base_url()."darta/fix");
            }
            else
            {
                $count = $this->input->post('number');
                $this->db->trans_start();
                $flag = [];
                for($i=1; $i<=$count ; $i++)
                {
                    $is_muncipality = $this->session->userdata('is_muncipality');
                    if($is_muncipality == 1)
                    {
                        $save['is_muncipality'] = '1';
                    }
                    else
                    {
                        $save['is_muncipality'] = '0';
                        $save['ward_login']         = $ward_login;
                    }
                    $darta_no                   = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward_login);
                    $save['darta_no']           = $darta_no== FALSE ? 1 : $darta_no + 1;
                    $save['ward_login']         = $ward_login;
                    $save['english_darta_miti'] = DateNepToEng($_POST['nepali_darta_miti']);
                    $save['nepali_darta_miti']  = $_POST['nepali_darta_miti'];
                    if($this->Mdl_darta->save($save) == FALSE)
                    {
                        $this->session->set_flashdata('err_msg',"समस्या आयो");
                        redirect(base_url().'darta/fix');
                    }
                }
                $this->db->trans_complete();
                $this->session->set_flashdata('msg',"{$count} वोटा दर्ता नं रिजब गर्न सफल");

                redirect(base_url().'darta/fix');

            }
        }
        $data1['title']  = "दर्ता रिजभ";
        $this->load->view('User/header',$data1);
        $this->load->view("fix_darta_no");
        $this->load->view("User/footer");
    }
    /*--------------------------------------------------------------------------------------------------------*/
    /*----- Direct Darta  ------------*/
    /*--------------------------------------------------------------------------------------------------------*/

    public function direct_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $ward_login              = $this->session->userdata('ward_no');
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('applicant_name',"कार्यालयको नाम","required");
            $this->form_validation->set_rules('letter_subject',"पत्रको विषय","required");
            $this->form_validation->set_rules('patra_miti_nep',"पत्रको मिति","required");
            $this->form_validation->set_rules('department[]',"फाँट","required");
            $this->form_validation->set_rules('karmachari_name[]',"कर्मचारीको नाम","required");
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', validation_errors());
                redirect(base_url()."darta-direct");
            }
            else
            {
                unset($_POST['submit']);
                $files = $_FILES;
                $dataInfo = [];
                $count = count($_FILES['documents']['name']);


                $filename = "";
                if($count >= 1)
                {
                    $path  = "assets/documents/darta_direct";
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


                $_POST['ward_login']            = $ward_login;
                $_POST['darta_documents']       = $filename;
                $is_muncipality = $this->session->userdata('is_muncipality');
                $ward = $this->session->userdata('ward_no');
                if($is_muncipality == 0)
                {

                    $_POST['is_muncipality'] = '0';
                }
                elseif($is_muncipality == 1)
                {
                    $_POST['is_muncipality'] = '1';
                }
                $_POST['english_darta_miti']    = DateNepToEng($_POST['nepali_darta_miti']);
                if(isset($_POST['reserved_darta_no']) && !empty($_POST['reserved_darta_no']))
                {
                    $_POST['darta_no']   = $_POST['reserved_darta_no'];
                    $this_darta = $this->Mdl_darta->getByDartaNo($_POST['reserved_darta_no'],$is_muncipality);
                    if($this_darta !=FALSE)
                    {
                        $this->Mdl_darta->delete($this_darta->id);
                    }
                }
                else
                {
                    $darta_no                       = $this->Mdl_darta->getMaxDartaNo($is_muncipality, $ward);
                    $_POST['darta_no']              = $darta_no==FALSE ? 1 : $darta_no + 1;
                }
                unset($_POST['reserved_darta_no']);
                $_POST['form_id']               =   $chalani['form_id']    = Modules::run("Home/genFormId");
                $temp_departs                   =  $_POST['department'];
                $departments                    = implode("+",$_POST['department']);
                $_POST['department']           = $departments;
                $karmacharis                    = implode("+", $_POST['karmachari_name']);
                $_POST['karmachari_name']       = $karmacharis;
                if($_POST['letter_type'] == "deadlined")
                {
                    $_POST['deadline_eng']          = DateNepToEng($_POST['deadline_nep']);
                }

                $_POST['patra_miti_eng']        = DateNepToEng($_POST['patra_miti_nep']);
                $_POST['user_id']               = $this->session->userdata('id');
                $this->Mdl_chalani->save($chalani);

                if($id=$this->Mdl_darta->save($this->input->post()))
                {

                    foreach($temp_departs as $depart)
                    {
                        $save['form_id']            = $_POST['form_id'];
                        $save['from_department']    = $this->session->userdata('department');
                        $save['to_department']      = $depart;
                        $save['is_seen']            = '0';
                        $save['created_at']         = date('Y-m-d H:i:sa');
                        $this->Mdl_notification->save($save);
                    }
                    $this->session->set_flashdata('msg','दर्ता गर्न सफल');
                    redirect(base_url()."darta-book/detail/".$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg','समस्या आयो');
                    redirect(base_url()."darta-direct");
                }
            }

        }
        $data['reserved_nos']   = $this->Mdl_darta->getReservedDartaNoByDate(date('Y-m-d'), $this->session->userdata('is_muncipality'), $this->session->userdata('ward_no'));
        $data['departments']     = $this->Mdl_department->getAll();
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['sessions']       = $this->Mdl_session->getAll();
        $data['curr_session']   = Modules::run('Settings/getCurrentSession');
        $data1['title']         = "नयाँ दर्ता";
        $this->load->view('User/header',$data1);
        $this->load->view("direct_darta",$data);
        $this->load->view('User/footer');
    }
    /*--------------------------------------------------------------------------------------------------------*/
    /*----- Edit Direct Darta  ------------*/
    /*--------------------------------------------------------------------------------------------------------*/
    public function edit_direct_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $id = $this->uri->segment(2);
        $this_darta = $this->Mdl_darta->getById($id);
        if($this_darta == FALSE)
        {
            $this->session->set_flashdata('err_msg', 'दर्ता भेटिएन');
            redirect('darta-book');
        }
        $ward_login              = $this->session->userdata('ward_no');
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('applicant_name',"कार्यालयको नाम","required");
            $this->form_validation->set_rules('letter_subject',"पत्रको विषय","required");
            $this->form_validation->set_rules('patra_miti_nep',"पत्रको मिति","required");
            $this->form_validation->set_rules('department[]',"फाँट","required");
            $this->form_validation->set_rules('karmachari_name[]',"कर्मचारीको नाम","required");
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', validation_errors());
                redirect(base_url()."darta-direct");
            }
            else
            {
                unset($_POST['submit']);
                $files = $_FILES;
                $dataInfo = [];
                $count = count($_FILES['documents']['name']);


                $filename = "";
                if($count >= 1)
                {
                    $path  = "assets/documents/darta_direct";
                    if(!empty($this_darta->darta_documents))
                    {
                        $docs  = explode('+', $this_darta->darta_documents);
                        foreach($docs as $doc)
                        {
                            unlink($path.$doc);
                        }
                    }

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
                else
                {
                    $filename = $this_darta->darta_documents;
                }
                $_POST['ward_login']            = $ward_login;
                $_POST['darta_documents']       = $filename;
                $is_muncipality = $this->session->userdata('is_muncipality');
                $ward = $this->session->userdata('ward_no');
                if($is_muncipality == 0)
                {
                    $_POST['is_muncipality'] = '0';
                }
                elseif($is_muncipality == 1)
                {
                    $_POST['is_muncipality'] = '1';
                }
                $_POST['english_darta_miti']    = DateNepToEng($_POST['nepali_darta_miti']);
                $_POST['darta_no']              = $this_darta->darta_no;
                $_POST['form_id']               =   $chalani['form_id']    = Modules::run("Home/genFormId");
                $temp_departs                   =  $_POST['department'];
                $departments                    = implode("+",$_POST['department']);
                $_POST['department']            = $departments;
                $karmacharis                    = implode("+", $_POST['karmachari_name']);
                $_POST['karmachari_name']       = $karmacharis;
                if($_POST['letter_type'] == "deadlined")
                {
                    $_POST['deadline_eng']          = DateNepToEng($_POST['deadline_nep']);
                }

                $_POST['patra_miti_eng']        = DateNepToEng($_POST['patra_miti_nep']);
                $_POST['user_id']               = $this->session->userdata('id');
                $this->Mdl_chalani->updateByFormId($this_darta->form_id, $chalani);

                if($this->Mdl_darta->update($this_darta->id, $this->input->post()))
                {
                    $this->session->set_flashdata('msg','दर्ता सम्पादन गर्न सफल');
                    redirect(base_url()."darta-book/detail/".$this_darta->id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg','समस्या आयो');
                    redirect(base_url()."darta-direct");
                }
            }

        }
        $data['default']        = getDefault();
        $data['result']         = $this_darta;
        $data['reserved_nos']   = $this->Mdl_darta->getReservedDartaNoByDate(date('Y-m-d'), $this->session->userdata('is_muncipality'), $this->session->userdata('ward_no'));
        $data['departments']     = $this->Mdl_department->getAll();
        
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['sessions']       = $this->Mdl_session->getAll();
        $data['curr_session']   = Modules::run('Settings/getCurrentSession');
        $data1['title']         = "नयाँ दर्ता";
        $this->load->view('User/header',$data1);
        $this->load->view("direct_darta",$data);
        $this->load->view('User/footer');
    }
    /*--------------------------------------------------------------------------------------------------------*/
    /*----- Darta Transfer / Completion ------------*/
    /*--------------------------------------------------------------------------------------------------------*/
    public function darta_transfer_completion()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect('logout');
        }
        if($this->session->userdata('is_muncipality') != 1)
        {
            redirect('index');
        }
        $this_darta     = $this->Mdl_darta->getById($_POST['darta_id']);
        if($this_darta != FALSE)
        {
            $save1['department']     = $_POST['department'];
            if(isset($_POST['is_complete']))
            {
                $save1['is_complete']    = '1';
            }
            else {
                $save1['transfer_date_eng'] = date('Y-m-d');
                $save1['transfer_date_nep'] = DateEngToNep(date('Y-m-d'));
                $save1['is_complete']     = '0';
            }
            if($this->Mdl_darta->update($this_darta->id, $save1))
            {
                if(!empty($_POST['department']))
                {
                    $this_notify    = $this->Mdl_notification->getByFormIdToDepartment($result->form_id, $this->session->userdata('department'));
                    $save2['to_department']   = $_POST['department'];
                    $save2['from_department'] = $this->session->userdata('department');
                    $save2['form_id']         = $this_darta->form_id;
                    $save2['created_at']      = date('Y-m-d H:i:sa');
                    $save2['is_seen']         = '0';
                    if($this_notify !=FALSE)
                    {
                        $this->Mdl_notification->update($this_notify->id, $save2);
                    }
                    else {
                        $this->Mdl_notification->save($save2);
                    }

                }
                $this->session->set_flashdata('msg','सेभ हुन सफल |');
                redirect(base_url()."darta-book/detail/".$this_darta->id);
            }
        }
    }

    /*--------------------------------------------------------------------------------------------------------*/
    /*----- Direct Darta ko Chalani  ------------*/
    /*--------------------------------------------------------------------------------------------------------*/
    public function direct_chalani()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $ward_login              = $this->session->userdata('ward_no');
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('applicant_name',"कार्यालयको नाम","required");
            $this->form_validation->set_rules('letter_subject',"पत्रको विषय","required");
            $this->form_validation->set_rules('patra_miti_nep',"पत्रको मिति","required");
            $this->form_validation->set_rules('patra_wahak_naam',"पत्र वाहकको नाम","required");
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', validation_errors());
                redirect(base_url()."chalani-direct");
            }
            else
            {
                unset($_POST['submit']);
                $files = $_FILES;
                $dataInfo = [];
                $count = count($_FILES['documents']['name']);
                $filename = "";
                if($count >= 1)
                {

                    $path  = "assets/documents/chalani_direct";
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
                $_POST['chalani_documents'] = $filename;
                $_POST['ward_login']            = $ward_login;
                $is_muncipality = $this->session->userdata('is_muncipality');
                if($is_muncipality == 0)
                {
                    $ward = $this->session->userdata('ward_no');
                    $_POST['is_muncipality'] ='0';
                }
                else {
                     $ward = $this->session->userdata('ward_no');
                    $_POST['is_muncipality'] = '1';
                }
                $_POST['english_chalani_miti']    = DateNepToEng($_POST['nepali_chalani_miti']);
                if(isset($_POST['reserved_chalani_no']) && !empty($_POST['reserved_chalani_no']))
                {
                    $_POST['chalani_no']   = $_POST['reserved_chalani_no'];
                    $this_chalani = $this->Mdl_chalani->getByChalaniNo($_POST['reserved_chalani_no'],$is_muncipality);
                    if($this_darta !=FALSE)
                    {
                        $this->Mdl_chalani->delete($this_darta->id);
                    }
                }
                else
                {
                    $chalani_no                  = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
                    $_POST['chalani_no']         = $chalani_no==FALSE ? 1 : $chalani_no + 1;
                }
                unset($_POST['reserved_chalani_no']);
                $_POST['form_id']                 = Modules::run("Home/genFormId");
                $_POST['patra_miti_eng']          = DateNepToEng($_POST['patra_miti_nep']);
                if($id=$this->Mdl_chalani->save($this->input->post()))
                {
                    $this->session->set_flashdata('msg','चलानी गर्न सफल');
                    redirect(base_url()."chalani-book/detail/".$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg','समस्या आयो');
                    redirect(base_url()."chalani-direct");
                }
            }

        }
        $data['reserved_nos']   = $this->Mdl_chalani->getReservedChalaniNoByDate(date('Y-m-d'), $this->session->userdata('is_muncipality'), $this->session->userdata('ward_no'));
        $data['departments']     = $this->Mdl_department->getAll();
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['sessions']       = $this->Mdl_session->getAll();
        $data['curr_session']   = Modules::run('Settings/getCurrentSession');
        $header['title']         = "नयाँ चलानी";
        $this->load->view('User/header',$header);
        $this->load->view('direct_chalani',$data);
        $this->load->view('User/footer');
    }
    /*--------------------------------------------------------------------------------------------------------*/
    public function edit_direct_chalani()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $ward_login              = $this->session->userdata('ward_no');
        $id = $this->uri->segment(2);
        $result = $this->Mdl_chalani->getById($id);
        if($result == FALSE)
        {
            $this->session->set_flashdata('err_msg', 'चलानी पत्र भेटिएन !');
            redirect(base_url().'chalani-book');
        }
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('applicant_name',"कार्यालयको नाम","required");
            $this->form_validation->set_rules('letter_subject',"पत्रको विषय","required");
            $this->form_validation->set_rules('patra_miti_nep',"पत्रको मिति","required");
            $this->form_validation->set_rules('patra_wahak_naam',"पत्र वाहकको नाम","required");
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', validation_errors());
                redirect(base_url()."edit-chalani/".$id);
            }
            else
            {
                unset($_POST['submit']);
                unset($_POST['reserved_chalani_no']);
                $files = $_FILES;
                $dataInfo = [];
                $count = count($_FILES['documents']['name']);
                $filename = "";
                if($count >= 1)
                {

                    $path  = "assets/documents/chalani_direct";
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
                }else
                {
                    $filename = $result->darta_documents;
                }

                $_POST['chalani_documents'] = $filename;
                $_POST['ward_login']            = $ward_login;
                $is_muncipality = $this->session->userdata('is_muncipality');
                if($is_muncipality == 0)
                {
                    $ward = $this->session->userdata('ward_no');
                    $_POST['is_muncipality'] ='0';
                }
                else {
                     $ward = $this->session->userdata('ward_no');
                    $_POST['is_muncipality'] = '1';
                }
                $_POST['english_chalani_miti']    = DateNepToEng($_POST['nepali_chalani_miti']);
                $_POST['chalani_no']              = $result->chalani_no;
                $_POST['form_id']                 = $result->form_id;
                $_POST['patra_miti_eng']          = DateNepToEng($_POST['patra_miti_nep']);
                if($this->Mdl_chalani->update($result->id, $this->input->post()))
                {
                    $this->session->set_flashdata('msg','चलानी सम्पादन गर्न सफल');
                    redirect(base_url()."chalani-book/detail/".$result->id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg','समस्या आयो');
                    redirect(base_url()."edit-chalani/".$result->id);
                }
            }

        }
        $data['result']         = $result;
        $data['reserved_nos']   = $this->Mdl_chalani->getReservedChalaniNoByDate(date('Y-m-d'), $this->session->userdata('is_muncipality'), $this->session->userdata('ward_no'));
        $data['departments']    = $this->Mdl_department->getAll();
        $data['default']        = getDefault();
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['sessions']       = $this->Mdl_session->getAll();
        $data['curr_session']   = Modules::run('Settings/getCurrentSession');
        $header['title']         = "चलानी सम्पादन";
        $this->load->view('User/header',$header);
        $this->load->view('direct_chalani',$data);
        $this->load->view('User/footer');
    }

    /*--------------------------------------------------------------------------------------------------------*/
    /*------Chalani Kitab ---------------*/
    /*--------------------------------------------------------------------------------------------------------*/
    public function chalani_book()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $ward_login         = $this->session->userdata('ward_no');
        $is_muncipality     = $this->session->userdata('is_muncipality');
        if(isset($_GET['submit']))
        {
            if(isset($_GET['search']))
            {
                $search         = $this->input->get('search');
                $result         = $this->Mdl_chalani->searchChalaniByWord($search, $is_muncipality, $ward_login);
                $data['result'] = $result;
            }
            if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
            {
                if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                {
                    $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                    redirect(base_url()."chalani-book");
                }
                $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                $data['result'] = $this->Mdl_chalani->getChalaniByDates($start_date, $end_date, $is_muncipality, $ward_login);
            }
            if(isset($_GET['month']))
            {
                $month      = $this->input->get('month');
                $end_date   = date("Y-m-d");
                $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                $data['result'] = $this->Mdl_chalani->getChalaniByDates($start_date,$end_date, $is_muncipality, $ward_login);
            }

        }
        else
        {
            if($is_muncipality == 1)
            {
                $data['result']    = $this->Mdl_chalani->getAllByMuncipality();
            }
            else
            {
                $data['result']    = $this->Mdl_chalani->getAllByWard($ward_login);
            }

        }

        $data1['title']     = 'विवरणहरु | चिठ्ठी पुर्जी चलानी किताब';
        $this->load->view('User/header',$data1);
        $this->load->view('chalani_book',$data);
        $this->load->view('User/footer');
    }
    /*--------------------------------------------------------------------------------------------------------*/
    public function chalani_book_detail()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect(base_url()."chalani-book");
        }
        $id         = $this->uri->segment(3);
        $data['result']     = $this->Mdl_chalani->getById($id);
        $data1['title']     = "विवरण | चिठ्ठी पुर्जा चलानी किताब";
        $this->load->view('User/header',$data1);
        $this->load->view('chalani_book_detail',$data);
        $this->load->view('User/footer');
    }
     /*--------------------------------------------------------------------------------------------------------*/
    /*----- Chalani No Reserve ------------*/
    /*--------------------------------------------------------------------------------------------------------*/
    public function fix_chalani_no()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $allowed_roles = ['superadmin'];
        if(!in_array($this->session->userdata('mode'), $allowed_roles))
        {
            $this->session->set_flashdata('err_msg', 'Permission Denied');
            redirect(base_url().'index');
        }
        $ward_login = $this->session->userdata('ward_no');
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('number',"कति वोटा चलानी नं रिजभ गर्नुहुन्छ","required");
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "validation_errors()");
                redirect(base_url()."chalani/fix");
            }
            else
            {
                $count = $this->input->post('number');
                $this->db->trans_start();
                $flag = [];
                for($i=1; $i<=$count ; $i++)
                {
                    $is_muncipality = $this->session->userdata('is_muncipality');
                    if($is_muncipality == 1)
                    {
                        $save['is_muncipality'] = '1';
                    }
                    else
                    {
                        $save['is_muncipality'] = '0';
                        $save['ward_login']         = $ward_login;
                    }
                    $chalani_no                   = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward_login);
                    $save['chalani_no']           = $chalani_no== FALSE ? 1 : $chalani_no + 1;
                    $save['ward_login']           = $ward_login;
                    $save['english_chalani_miti'] = DateNepToEng($_POST['nepali_chalani_miti']);
                    $save['nepali_chalani_miti']  = $_POST['nepali_chalani_miti'];
                    if($this->Mdl_chalani->save($save) == FALSE)
                    {
                        $this->session->set_flashdata('err_msg',"समस्या आयो");
                        redirect(base_url().'chalani/fix');
                    }
                }
                $this->db->trans_complete();
                $this->session->set_flashdata('msg',"{$count} वोटा चलानी नं रिजब गर्न सफल");
                 redirect(base_url().'chalani/fix');

            }
        }
        $data1['title']  = "चलानी नं रिजभ";
        $this->load->view('User/header',$data1);
        $this->load->view("fix_chalani_no");
        $this->load->view("User/footer");
    }
    /*--------------------------------------------------------------------------------------------------------*/
  /*----- Maujuda Suchi ------------*/
  /*--------------------------------------------------------------------------------------------------------*/
  public function maujuda_suchi()
  {
     if(Modules::run("User/is_logged_in") === FALSE)
      {
          redirect("login");
      }
      if(isset($_POST['submit']))
      {
          $this->form_validation->set_rules('applicant_name',"व्यक्ति /फर्मको नाम","required");
          $this->form_validation->set_rules('contact_name',"सम्पर्क व्यक्तिको नाम","required");
          $this->form_validation->set_rules('contact_number',"सम्पर्क नं","required");


          if ($this->form_validation->run() == FALSE)
          {
              $this->session->set_flashdata('err_msg', validation_errors());
              redirect(base_url()."maujuda-suchi");
          }
          else
          {
              unset($_POST['submit']);
              $files = $_FILES;
              $dataInfo = [];
              $count = count($_FILES['documents']['name']);


              $filename = "";
              $path  = "assets/documents/darta_direct";
              if($count >= 1)
              {
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

              $save1['contact_name']   = $_POST['contact_name'];
              $save1['contact_number'] = $_POST['contact_number'];
              $save1['work_type']      = $_POST['work_type'];
              $save1['service_type']   = $_POST['service_type'];
              $save1['darta_type']     = $_POST['darta_type'];
              $save1['niwedan_darta_miti_nep'] = $_POST['niwedan_darta_miti_nep'];
              $save1['niwedan_darta_miti_eng'] = DateNepToEng($_POST['niwedan_darta_miti_nep']);
              $save1['sanstha_darta_no']       = $_POST['sanstha_darta_no'];
              $save1['darta_type']     = $_POST['darta_type'];
              $save1['pan_vat_no']     = $_POST['pan_vat_no'];
              $save1['is_renewed']     = $_POST['is_renewed'];
              $save1['karyanubhab']    = $_POST['karyanubhab'];
              $save1['lakshit_group']  = $_POST['lakshit_group'];

              $save1['created_at']     = date('Y-m-d H:i:sa');
              if($insert_id = $this->Mdl_maujuda_suchi->save($save1))
              {
                  $save2['session_id'] = $_POST['session_id'];
                  $is_muncipality = $this->session->userdata('is_muncipality');
                  $ward = $this->session->userdata('ward_no');
                  if($is_muncipality == 1)
                  {
                      $is_muncipality = 1;
                      $save2['is_muncipality'] = '1';
                      $save2['department']     = $this->session->userdata('department');
                  }
                  else
                  {
                      $save2['ward_login']     = $ward;
                  }

                  $save2['form_id']               =   $chalani['form_id']    = Modules::run("Home/genFormId");
                  $this->Mdl_chalani->save($chalani);
                  $save2['applicant_name']        = $_POST['applicant_name'];
                  $save2['state']                 = $_POST['state'];
                  $save2['district']              = $_POST['district'];
                  $save2['local_body']            = $_POST['local_body'];
                  $save2['ward']                  = $_POST['ward'];
                  $save2['nepali_darta_miti']     = $_POST['nepali_darta_miti'];
                  $save2['english_darta_miti']    = DateNepToEng($_POST['nepali_darta_miti']);
                  if(isset($_POST['reserved_darta_no']) && !empty($_POST['reserved_darta_no']))
                {
                    $save2['darta_no']   = $_POST['reserved_darta_no'];
                    $this_darta = $this->Mdl_suchi_darta->getByDartaNo($_POST['reserved_darta_no'],$is_muncipality);
                    if($this_darta !=FALSE)
                    {
                        $this->Mdl_darta->delete($this_darta->id);
                    }
                }
                else
                {
                    $darta_no                       = $this->Mdl_suchi_darta->getMaxDartaNo($is_muncipality, $ward);
                    $save2['darta_no']              = $darta_no==FALSE ? 1 : $darta_no + 1;
                }

                  $temp_departs                   =  $_POST['department'];
                $departments                    = implode("+",$_POST['department']);
                $save2['department']           = $departments;
                $karmacharis                    = implode("+", $_POST['karmachari_name']);
                $save2['karmachari_name']       = $karmacharis;


                  $save2['user_id']               = $this->session->userdata('id');
                  $save2['maujuda_id']            = $insert_id;
                  $save2['darta_documents']       = $filename;
                  $save2['description']    = $_POST['description'];
                  if($this->Mdl_suchi_darta->save($save2))
                  {
                      foreach($temp_departs as $depart)
                    {
                        $save3['form_id']            = $save2['form_id'];
                        $save3['from_department']    = $this->session->userdata('department');
                        $save3['to_department']      = $depart;
                        $save3['is_seen']            = '0';
                        $save3['created_at']         = date('Y-m-d H:i:sa');
                        $this->Mdl_notification->save($save3);
                    }
                      $this->session->set_flashdata('msg','डेटा सेभ हुनसफल');
                      redirect('maujuda-suchi');
                  }
              }
          }
      }
      $send['default']        = getDefault();
      $send['states']         = $this->Mdl_state->getAll();
      $send['districts']      = $this->Mdl_district->getAll();
      $send['locals']         = $this->Mdl_local_body->getAll();
      $send['wards']          = $this->Mdl_ward->getAll();
      $send['sessions']       = $this->Mdl_session->getAll();
      $send['curr_session']   = Modules::run('Settings/getCurrentSession');
      $send['departments']    = $this->Mdl_department->getAll();
      $send['works']          = $this->Mdl_work->getAll();
      $send['services']       = $this->Mdl_service->getAll();

      $header['title']  = "मौजुदा सुची";
      $this->load->view('User/header',$header);
      $this->load->view("maujuda_suchi_page",$send);
      $this->load->view("User/footer");
  }
  /*--------------------------------------------------------------------------------------------------------*/
  public function maujuda_suchi_detail()
  {
      if(Modules::run("User/is_logged_in") === FALSE)
      {
          redirect("login");
      }
      if(empty($this->uri->segment(3)))
      {
          $this->session->set_flashdata('err_msg',"समस्या आयो | ");
          redirect(base_url()."maujuda-darta-book");
      }
      $id         = $this->uri->segment(3);
      $this_darta = $this->Mdl_suchi_darta->getById($id);
      if($this_darta == FALSE)
      {
          $this->session->set_flashdata('err_msg','मौजुदा सुची भेटिएन');
          redirect('maujuda-book');
      }
      $send['result']         = $this_darta;
      $send['maujuda_detail'] = $this->Mdl_maujuda_suchi->getById($this_darta->maujuda_id);
      $header['title']         = "विवरण | मौजुदा सुची दर्ता किताब";
      $this->load->view('User/header',$header);
      $this->load->view('maujuda_suchi_detail_page',$send);
      $this->load->view('User/footer');
  }
    /*--------------------------------------------------------------------------------------------------------*/
    public function maujuda_darta_book()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $ward_login        = $this->session->userdata('ward_no');
        $is_muncipality    = $this->session->userdata('is_muncipality');
        if(isset($_GET['submit']))
        {
            if(isset($_GET['search']))
            {
                $search         = $this->input->get('search');
                $result         = $this->Mdl_suchi_darta->searchMaujudaByWord($search, $is_muncipality, $ward_login);
                $send['result'] = $result;
            }
            if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
            {
                if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                {
                    $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                    redirect(base_url()."darta-book");
                }
                $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                $send['result'] = $this->Mdl_suchi_darta->getMaujudaByDates($start_date, $end_date, $is_muncipality, $ward_login);
            }
            if(isset($_GET['month']))
            {
                $month      = $this->input->get('month');
                $end_date   = date("Y-m-d");
                $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                $send['result'] = $this->Mdl_suchi_darta->getMaujudaByDates($start_date, $end_date, $is_muncipality, $ward_login);
            }

        }
        else
        {
            $send['result']          = $this->Mdl_suchi_darta->getAllMaujudaSuchi();
        }

        $header['title']         = "मौजुदा सुची दर्ता किताब";
        $this->load->view('User/header',$header);
        $this->load->view('maujuda_book',$send);
        $this->load->view('User/footer');
    }
    /*--------------------------------------------------------------------------------------------------------*/
    /*-----------------------Sachiwalaya Darta----*/
    /*--------------------------------------------------------------------------------------------------------*/
    public function sachiwalaya_darta()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $is_sachib = $this->session->userdata('is_sachib');
        if($is_sachib != 1)
        {
            $this->session->set_flashdata('err_msg','Permission Denied');
            redirect('index');
        }
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('applicant_name',"कार्यालयको नाम","required");
            $this->form_validation->set_rules('letter_subject',"पत्रको विषय","required");
            $this->form_validation->set_rules('patra_miti_nep',"पत्रको मिति","required");
            $this->form_validation->set_rules('karmachari_name',"कर्मचारीको नाम","required");
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', validation_errors());
                redirect(base_url()."sachiwalaya-darta");
            }
            else
            {
                unset($_POST['submit']);
                $files = $_FILES;
                $dataInfo = [];
                $count = count($_FILES['documents']['name']);


                $filename = "";
                if($count >= 1)
                {
                    $path  = "assets/documents/sachiwalaya_darta";
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


                $_POST['darta_documents']       = $filename;
                $darta_no                       = $this->Mdl_sachiwalaya_darta->getMaxDartaNo();
                $_POST['darta_no']              = $darta_no==FALSE ? 1 : $darta_no + 1;
                $_POST['english_darta_miti']    = DateNepToEng($_POST['nepali_darta_miti']);
                if($_POST['letter_type'] == "deadlined")
                {
                    $_POST['deadline_eng']          = DateNepToEng($_POST['deadline_nep']);
                }
                $_POST['form_id']               =   $chalani['form_id']    = Modules::run("Home/genFormId");
                $_POST['patra_miti_eng']        = DateNepToEng($_POST['patra_miti_nep']);
                $_POST['user_id']               = $this->session->userdata('id');
                if($id=$this->Mdl_sachiwalaya_darta->save($this->input->post()))
                {   $this->Mdl_chalani->save($chalani);
                    $sachibs = $this->Mdl_user->getAllSachibs();
                    $this_user = $this->Mdl_user->getById($this->session->userdata('id'));
                    foreach($sachibs as $sachib)
                    {
                        if($sachib->id == $this_user->id)
                        {
                            continue;
                        }
                        $save['form_id']            = $_POST['form_id'];
                        $save['from_department']    = $this_user->id;
                        $save['to_department']      = $sachib->id;
                        $save['is_seen']            = '0';
                        $save['created_at']         = date('Y-m-d H:i:sa');
                        $this->Mdl_notification->save($save);
                    }

                    $this->session->set_flashdata('msg','दर्ता गर्न सफल');
                    redirect(base_url()."sachiwalaya-darta-detail/".$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg','समस्या आयो');
                    redirect(base_url()."sachiwalaya-darta");
                }
            }

        }
        $send['departments']     = $this->Mdl_department->getAll();
        $send['default']        = getDefault();
        $send['states']         = $this->Mdl_state->getAll();
        $send['districts']      = $this->Mdl_district->getAll();
        $send['locals']         = $this->Mdl_local_body->getAll();
        $send['wards']          = $this->Mdl_ward->getAll();
        $send['sessions']       = $this->Mdl_session->getAll();
        $send['curr_session']   = Modules::run('Settings/getCurrentSession');
        $send['title']         = "नयाँ सचिवालय दर्ता";
        $this->load->view('User/header',$data1);
        $this->load->view("sachiwalaya_darta_page",$send);
        $this->load->view('User/footer');
    }
    /*--------------------------------------------------------------------------------------------------------*/
    public function sachiwalaya_darta_detail()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $id         = $this->uri->segment(2);
        $result = $data['result']     = $this->Mdl_sachiwalaya_darta->getById($id);
        $sachiwalaya_result = $this->Mdl_sachiwalaya_darta_detail->getBySachiwalayId($result->id);
        if($sachiwalaya_result != FALSE)
        {
            $this_notify    = $this->Mdl_notification->getByFormIdToDepartment($result->form_id, $this->session->userdata('department'));
        }
        else {
            $this_notify    = $this->Mdl_notification->getByFormIdToDepartment($result->form_id, $this->session->userdata('id'));
        }
        if($this_notify != FALSE)
        {
            $save['is_seen']     = '1';
            $save['modified_at'] = date('Y-m-d H:i:sa');
            $this->Mdl_notification->update($this_notify->id, $save);
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "विवरण | सचिवालय दर्ता किताब";
        $this->load->view('User/header',$data1);
        $this->load->view('sachiwalaya_detail_page',$data);
        $this->load->view('User/footer');
    }
    /*--------------------------------------------------------------------------------------------------------*/
    public function sachiwalaya_darta_book()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $ward_login        = $this->session->userdata('ward_no');
        $is_muncipality    = $this->session->userdata('is_muncipality');
        if(isset($_GET['submit']))
        {
            if(isset($_GET['search']))
            {
                $search         = $this->input->get('search');
                $result         = $this->Mdl_sachiwalaya_darta->searchByWord($search);
                $data['result'] = $result;
            }
            if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
            {
                if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                {
                    $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                    redirect(base_url()."darta-book");
                }
                $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                $data['result'] = $this->Mdl_sachiwalaya_darta->getByDates($start_date, $end_date);
            }
            if(isset($_GET['month']))
            {
                $month      = $this->input->get('month');
                $end_date   = date("Y-m-d");
                $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                $data['result'] = $this->Mdl_sachiwalaya_darta->getByDates($start_date, $end_date);
            }

        }
        else
        {
            $data['result']     = $this->Mdl_sachiwalaya_darta->getAll();
        }

        $data1['title']     = 'विवरणहरु | सचिवालय दर्ता किताब';
        $this->load->view('User/header',$data1);
        $this->load->view('sachiwalaya_darta_book',$data);
        $this->load->view('User/footer');
    }
    /*--------------------------------------------------------------------------------------------------------*/
    public function sachiwalaya_transfer()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $id         = $this->uri->segment(2);
        $result     = $this->Mdl_sachiwalaya_darta->getById($id);
        if($result == FALSE)
        {
            $this->session->set_flashdata('err_msg','दर्ता फायल भेटिएन !');
            redirect(base_url().'sachiwalaya-darta-book');
        }
        $save['sachiwalaya_id'] = $id;
        $save['note']           = $_POST['note'];
        $save['sent_by']        = $this->session->userdata('id');
        $save['sent_to']        = $_POST['department'];
        $save['created_at']     = date('Y-m-d H:i:s');
        if($this->Mdl_sachiwalaya_darta_detail->save($save))
        {
            $save1['form_id']            = $result->form_id;
            $save1['from_department']    = $this->session->userdata('id');
            $save1['to_department']      = $_POST['department'];
            $save1['is_seen']            = '0';
            $save1['created_at']         = date('Y-m-d H:i:s');
            $this->Mdl_notification->save($save1);
            redirect(base_url().'sachiwalaya-darta-detail/'.$result->id);
        }
    }
    /*--------------------------------------------------------------------------------------------------------*/
    public function getReservedDartaNos()
    {
        $nepali_darta_miti  = $_POST['nepali_darta_miti'];
        $english_darta_miti = DateNepToEng($nepali_darta_miti);
        $is_muncipality = $this->session->userdata('is_muncipality');
        $ward_login     = $this->session->userdata('ward_no');
        $reserved_nos = $this->Mdl_darta->getReservedDartaNoByDate($english_darta_miti, $is_muncipality, $ward_login);
        $res = [];
        if($reserved_nos != FALSE)
        {
            $html = "<option value=''>छान्नुहोस्</option>";
            foreach($reserved_nos as $data):
                $html .= '<option value="'.$data->darta_no.'">'.$data->darta_no.'</option>';
            endforeach;

            $res['html'] = $html;
            $res['msg']  = 'true';
            echo json_encode($res);exit;
        }
        else
        {
            $res['msg'] = 'false';
            echo json_encode($res);exit;
        }

    }
    /*--------------------------------------------------------------------------------------------------------*/
    public function getReservedChalaniNos()
    {
        $nepali_chalani_miti  = $_POST['nepali_chalani_miti'];
        $english_chalani_miti = DateNepToEng($nepali_chalani_miti);
        $is_muncipality = $this->session->userdata('is_muncipality');
        $ward_login     = $this->session->userdata('ward_no');
        $reserved_nos = $this->Mdl_chalani->getReservedChalaniNoByDate($english_chalani_miti, $is_muncipality, $ward_login);
        $res = [];
        if($reserved_nos != FALSE)
        {
            $html = "<option value=''>छान्नुहोस्</option>";
            foreach($reserved_nos as $data):
                $html .= '<option value="'.$data->chalani_no.'">'.$data->chalani_no.'</option>';
            endforeach;

            $res['html'] = $html;
            $res['msg']  = 'true';
            echo json_encode($res);exit;
        }
        else
        {
            $res['msg'] = 'false';
            echo json_encode($res);exit;
        }

    }
    /*--------------------------------------------------------------------------------------------------------*/
    public function darta_book_excel()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $ward_login        = $this->session->userdata('ward_no');
        $is_muncipality    = $this->session->userdata('is_muncipality');
        if(isset($_GET['submit']))
        {
            if(isset($_GET['search']))
            {
                $search         = $this->input->get('search');
                $result         = $this->Mdl_darta->searchByWord($search, $is_muncipality, $ward_login);
                $data['result'] = $result;
            }
            if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
            {
                if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                {
                    $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                    redirect(base_url()."darta-book");
                }
                $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                $data['result'] = $this->Mdl_darta->getByDates($start_date, $end_date, $is_muncipality, $ward_login);
            }
            if(isset($_GET['month']))
            {
                $month      = $this->input->get('month');
                $end_date   = date("Y-m-d");
                $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                $data['result'] = $this->Mdl_darta->getByDates($start_date, $end_date, $is_muncipality, $ward_login);
            }

        }
        else
        {
            if($is_muncipality == 1 )
            {
                $data['result'] = $this->Mdl_darta->getAllByMuncipality('darta_no', 'asc');
            }
            else
            {
                $data['result']    = $this->Mdl_darta->getAllByWard($ward_login, 'darta_no', 'asc');
            }
        }

        $html = $this->load->view('darta_book_excel', $data, TRUE);
        $filename ='दर्ता किताब_'.date('Y-m-d H:i:s');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"');
        header('Cache-Control: max-age=0');
        echo $html;
        die();
    }
    /*--------------------------------------------------------------------------------------------------------*/
    public function darta_book_print()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $ward_login        = $this->session->userdata('ward_no');
        $is_muncipality    = $this->session->userdata('is_muncipality');
        if(isset($_GET['submit']))
        {
            if(isset($_GET['search']))
            {
                $search         = $this->input->get('search');
                $result         = $this->Mdl_darta->searchByWord($search, $is_muncipality, $ward_login);
                $data['result'] = $result;
            }
            if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
            {
                if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                {
                    $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                    redirect(base_url()."darta-book");
                }
                $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                $data['result'] = $this->Mdl_darta->getByDates($start_date, $end_date, $is_muncipality, $ward_login);
            }
            if(isset($_GET['month']))
            {
                $month      = $this->input->get('month');
                $end_date   = date("Y-m-d");
                $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                $data['result'] = $this->Mdl_darta->getByDates($start_date, $end_date, $is_muncipality, $ward_login);
            }

        }
        else
        {
            if($is_muncipality == 1 )
            {
                $data['result'] = $this->Mdl_darta->getAllByMuncipality('darta_no', 'asc');
            }
            else
            {
                $data['result']    = $this->Mdl_darta->getAllByWard($ward_login, 'darta_no', 'asc');
            }
        }

        $header['title'] = 'Print';
        $this->load->view('User/header1', $header);
        $this->load->view('darta_book_print', $data);
        $this->load->view('User/footer');
    }
    /*--------------------------------------------------------------------------------------------------------*/
    public function chalani_book_excel()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $ward_login         = $this->session->userdata('ward_no');
        $is_muncipality     = $this->session->userdata('is_muncipality');
        if(isset($_GET['submit']))
        {
            if(isset($_GET['search']))
            {
                $search         = $this->input->get('search');
                $result         = $this->Mdl_chalani->searchChalaniByWord($search, $is_muncipality, $ward_login);
                $data['result'] = $result;
            }
            if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
            {
                if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                {
                    $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                    redirect(base_url()."chalani-book");
                }
                $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                $data['result'] = $this->Mdl_chalani->getChalaniByDates($start_date, $end_date, $is_muncipality, $ward_login);
            }
            if(isset($_GET['month']))
            {
                $month      = $this->input->get('month');
                $end_date   = date("Y-m-d");
                $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                $data['result'] = $this->Mdl_chalani->getChalaniByDates($start_date,$end_date, $is_muncipality, $ward_login);
            }

        }
        else
        {
            if($is_muncipality == 1)
            {
                $data['result']    = $this->Mdl_chalani->getAllByMuncipality('asc');
            }
            else
            {
                $data['result']    = $this->Mdl_chalani->getAllByWard($ward_login, 'chalani_no', 'asc');
            }

        }

        $html = $this->load->view('chalani_book_excel', $data, TRUE);
        $filename ='दर्ता किताब_'.date('Y-m-d H:i:s');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xls"');
        header('Cache-Control: max-age=0');
        echo $html;
        die();
    }
    /*--------------------------------------------------------------------------------------------------------*/
    public function getDepartmentHTML()
    {
        $departments = $this->Mdl_department->getAll();
        $html = '<div class="department row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">
                            <span class="float-right">
                               फाँट<span class="text-danger">&nbsp;*</span>
                            </span>
                        </label>
                        <div class="col-sm-8">
                            <select name="department[]" class="form-control select2" required>
                                <option value="">छान्नुहोस्</option>';
                                if($departments != FALSE):
                                        foreach($departments as $department):
                $html.=               '<option value="'.$department->id.'">'.$department->name.'</option>';

                                        endforeach;
                                      endif;
            $html .=    '   </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">
                            <span class="float-right">
                               कर्मचारीको नाम<span class="text-danger">&nbsp;*</span>
                            </span>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" name="karmachari_name[]" class="form-control" value="" required>
                        </div>
                    </div>
                </div>
            </div>';
            $res = [];
            $res['html'] =$html;
            echo json_encode($res);exit;
    }

}
