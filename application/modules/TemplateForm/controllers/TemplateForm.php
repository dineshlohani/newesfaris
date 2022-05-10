<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TemplateForm extends MX_Controller {
    private $_curr_session = array();
    function __construct()
    {
        parent::__construct();

        $this->load->model('Mdl_template_form');
        $this->load->model('Mdl_letter_subject');

        $this->load->model('DartaChalaniBook/Mdl_darta');
        $this->load->model('DartaChalaniBook/Mdl_chalani');

        $this->load->model('Home/Mdl_print_details');

        $this->load->model('Settings/Mdl_session');
        $this->load->model('Settings/Mdl_office');
        $this->load->model('Settings/Mdl_ward_worker');
        $this->load->model('Settings/Mdl_patra_item');
        $this->load->model('Settings/Mdl_patra_category');
        $this->load->model('User/Mdl_user');


        $this->load->helper('functions_helper');
        $this->_curr_session = Modules::run('Settings/getCurrentSession');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*-------Global Use ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getLetterByTypeJSON()
    {
        $type  = $_GET['letter_type'];
        $results = $this->Mdl_letter_subject->getByType($type);
        $this_letter_type = $this->Mdl_patra_item->getByCategoryId($type);
        //pp($this_letter_type);
        $res = [];
        if($this_letter_type != FALSE){
            $html = '';
            $html .='<option value ="">छान्नुहोस्</option>';
            foreach($this_letter_type as $result):
                $html .= '<option value="'.$result->id.'">'.$result->name.'</option>';
            endforeach;
            $res['err_msg'] = '';
            $res['html']  = $html;
            echo json_encode($res); die();
        }else{
            $res['err_msg'] = 'पत्रको विषय भेटिएन';
            echo json_encode($res);die();
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getContentBySubject()
    {
        $subject = $_GET['subject'];
    
        $this_letter = $this->Mdl_letter_subject->getByPatraId($subject);
       
        $letter_subject = $this->Mdl_patra_item->getById($subject);
       
        $res = [];
        if($letter_subject != FALSE)
        {
            $res['msg']     = 'TRUE';
            $res['letter_subject'] = $letter_subject->name;
            $res['content'] = $this_letter->content;
        }
        else {
            $res['msg']     = 'FALSE';
        }
        echo json_encode($res); die();
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/

    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Letter Subject ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function save_letter_subject()
    {
        if(isset($_POST['submit_subject']))
        {
            $res = [];
            if(empty($_POST['md_subject']))
            {
                $res['err_msg'] = 'error';
                print_r($res['err_msg']);
                exit;
            }
            $save['letter_type']    = $_POST['md_letter_type'];
            $save['subject']        = $_POST['md_subject'];
            $save['created_at']     = date('Y-m-d H:i:s');
            $save1['category_id']   = $_POST['md_letter_type'];
            $save1['name']          = $_POST['md_subject'];
            $save['content']       = $_POST['scontent'];
            $save1['uri']           = 'uri-'.Modules::run("Home/genFormId");
            $save1['model']         = '';
            $save1['image_link']    = '';
            $save1['flag']          = '1';
            $res = [];
            if($id = $this->Mdl_patra_item->save($save1))
            {
                $save['patra_id'] = $id;
                $this->Mdl_letter_subject->save($save);
                
                redirect('letter-form/create');
            }
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Template Form ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function save_template_form()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $id = $this->uri->segment(3);
        $t_data = $this->Mdl_template_form->getById($id);
        if($t_data != FALSE)
        {
            $result = $t_data;
        }

        if(isset($_POST['submit_form']))
        {
            $this->form_validation->set_rules('applicant_name','आवेदकको नाम','required');
            $this->form_validation->set_rules('nepali_date','आवेदन गरिएको मिति','required');
            $this->form_validation->set_rules('letter_subject','पत्रको विषय','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', validation_errors());
                if(isset($result)){
                    redirect(base_url().'letter-form/edit/'.$id);
                }else{
                    redirect(base_url().'letter-form/create');
                }
            }else {
                $path = 'assets/documents/template_form/';
                if (!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                $count  = count($_FILES['documents']['name']);
                $file = "";
                if(!empty($_FILES['documents']['name'][0]))
                {
                    if(isset($result) && !empty($result->documents))
                    {
                        $docs = explode("+", $result->documents);
                        foreach($docs as $doc)
                        {
                            unlink($path.$doc);
                        }
                    }
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
                    $save['documents']  = $file;
                }
                else {
                    if(isset($result))
                    {
                        $save['documents'] = $result->documents;
                    }
                }

                $this_subject           = $this->Mdl_letter_subject->getById($_POST['letter_subject']);
                $save['applicant_name'] = $_POST['applicant_name'];
                $save['nepali_date']    = $_POST['nepali_date'];
                $save['date']           = DateNeptoEng($_POST['nepali_date']);
                $save['letter_subject'] = $_POST['letter_subject'];
                $save['content']        = $_POST['content'];
                $save['content_sub']    = $_POST['subject'];
                $save['status']         = '1';
                $save['letter_type']    = $_POST['letter_type'];
                $save['form_id']        =   $chalani['form_id']    = Modules::run("Home/genFormId");
                $this->Mdl_chalani->save($chalani);

                $s_save['content']      = $_POST['content'];
                $s_save['updated_at']   = date('Y-m-d H:i:s');
                $this->Mdl_letter_subject->update($this_subject->id, $s_save);
                if(!isset($result))
                {
                    $save['ward_login']     = $this->session->userdata('ward_no');
                    $save['session_id']        = $this->_curr_session->id;
                    $save['created_at']     = date('Y-m-d H:i:s');
                    $id = $this->Mdl_template_form->save($save);
                }else {
                    $save['updated_at']     = date('Y-m-d H:i:s');
                    $this->Mdl_template_form->update($result->id, $save);
                }
                redirect(base_url().'letter-form/detail/'.$id);
            }
        }
        if(isset($result)){
            $send['result'] = $result;
            $send['subjects'] = $this->Mdl_letter_subject->getAll();
        }
        $send['letter_types']  = $this->Mdl_patra_category->getAll();

        $header['title']  = 'नयाँ सिफारिस';
        $this->load->view('User/header', $header);
        $this->load->view('template_form_page', $send);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_template_form()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $id     = $this->uri->segment(3);
        $result = $this->Mdl_template_form->getById($id);
        if($result == FALSE)
        {
            $this->session->set_flashdata('err_msg', 'सिफारिस भेटिएन');
            redirect(base_url().'letter-form-list');
        }

        $send['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $send['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $send['chalani_result'] = $chalani_result = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $send['chalani_no'] = $chalani_result->chalani_no;
        }
        $send['offices']    = $this->Mdl_office->getAll();
        $send['result']  = $this->Mdl_template_form->getById($id);
        $header['title'] = "सिफारिस विवरण";
        $this->load->view('User/header', $header);
        $this->load->view('template_detail_page', $send);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_template_form()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect(base_url()."letter-form");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_template_form->getById($id);
        // pp($result);
        $letter_uri = $this->Mdl_patra_item->getById($result->letter_subject);

        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect(base_url()."letter-form");
        }
        // if($result->status == 2)
        // {
        //     $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
        //     redirect("letter-form/detail/".$id);
        // }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("letter-form/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."letter-form/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/template_form/";
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
            $this_letter  = $this->Mdl_letter_subject->getById($result->letter_subject);
            $data['status']             = 2;
            $data['darta_documents']    = $filename;
            if($this->Mdl_template_form->update($id,$data))
            {

                $save['type']               = $result->letter_type;
                $save['applicant_name']     = $result->applicant_name;
                $save['ward_login']         = $this->session->userdata('ward_no');
                $save['letter_subject']     = $result->content_sub;
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
                    $save['uri'] = 'letter-form';
                    $this->Mdl_darta->save($save);
                }
                $this->session->set_flashdata('msg',"दर्ता हुन सफल |");
                redirect(base_url()."letter-form/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."letter-form/detail/".$id);
            }

        }
        $send = $header = [];
        $ward_login             = $this->session->userdata('ward_no');
        $send['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward_no'));
        $header['title']         = "Approve";
        $this->load->view('User/header',$header);
        $this->load->view('Home/darta',$send);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function chalani_template_form()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_template_form->getById($id);
        if($result == FALSE)
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("letter-form");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("letter-form/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("letter-form/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $this_letter    = $this->Mdl_letter_subject->getById($result->letter_subject);
            $chalani_result = $this->Mdl_chalani->getByFormId($result->form_id);
            $darta_result   = $this->Mdl_darta->getByFormId($result->form_id);
            //pp($darta_result);
            $is_muncipality = $this->session->userdata('is_muncipality');
            $ward = $this->session->userdata('ward_no');
            if($is_muncipality == 0)
            {

                $save['is_muncipality'] = '0';
                $save['ward_login'] = $ward;
            }
            else if($is_muncipality == 1)
            {
                $save['is_muncipality']     = '1';
                $save['department']         = $this->session->userdata('department');
            }
            $chalani_no                     = $this->Mdl_chalani->getMaxChalaniNo($is_muncipality, $ward);
            $save['chalani_no']             = $chalani_no == FALSE ? 1 : $chalani_no + 1;
            $save['english_chalani_miti']   = date("Y-m-d",time());
            $save['nepali_chalani_miti']    = DateEngToNep($save['english_chalani_miti']);
            $save['applicant_name']         = $result->applicant_name;
            $save['ward_login']             = $this->session->userdata('ward_no');
            $save['letter_subject']         = $darta_result->letter_subject;
            $save['uri']                    = 'letter-form';
            $current_session                = Modules::run("Settings/getCurrentSession");
            $save['session_id']             = $current_session->id;
            $save['user_id']                = $this->session->userdata('id');
            $save['type']                   = $result->letter_type;
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
            if($this->Mdl_template_form->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("letter-form/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("letter-form");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_template_form()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("letter-form");
        }
        $id         = $this->uri->segment(3);
        $send['result'] = $result = $this->Mdl_template_form->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("letter-form");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("letter-form/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
            $save['office_id'] = $_POST['post'];
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
        $send['print_office']         = $this->Mdl_office->getById($_POST['office_id']);
        $send['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $send['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $send['chalani_no']     = $result_chalani->chalani_no;
        $send['user'] = $this->Mdl_user->getById($this->session->userdata('id'));
        $header['title']        = "Print";
        $this->load->view('User/header1',$header);
        $this->load->view('letter_head_np');
        $this->load->view('template_print_page',$send);
        $this->load->view('letter_footer');
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_template_form()
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
                    $result         = $this->Mdl_template_form->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_template_form->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_template_form->getByStatus($status,$ward_login);
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
                    $data['result'] = $this->Mdl_template_form->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_template_form->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_template_form->getByStatus(1,$ward_login);
            }
        }
        else {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_template_form->getTableName();
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
        $data1['title']     = "सिफारिस विवरण";
        $this->load->view('User/header',$data1);
        $this->load->view('template_list_page',$data);
        $this->load->view('User/footer');
    }
}