<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Property extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_income_verification');
        $this->load->model('Mdl_income_verification_detail');
        $this->load->model('Mdl_property_valuation');
        $this->load->model('Mdl_property_valuation_detail');
        $this->load->model('Mdl_tax_clearance');

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
        $data['title'] = "Property | Dashboard";

        $data['income_verification'] = $this->Mdl_user->getTotalCount('income_verification');
        $data['property_valuation'] = $this->Mdl_user->getTotalCount('property_valuation');
        $data['tax_clearance'] = $this->Mdl_user->getTotalCount('tax_clearance');
        
        $this->load->view('User/header',$data);
        $this->load->view('dashboard');
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Income Verification    ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/

    public function create_income_verification()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'Applicated Date', 'required');
            $this->form_validation->set_rules('applicant_name', 'Full Name', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            $this->form_validation->set_rules('ward', 'Ward', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('relation[]', 'Relation with Applicant', 'required');
            $this->form_validation->set_rules('parties_name[]', 'Parties Name', 'required');
            $this->form_validation->set_rules('annual_income[]', 'Annual Income', 'required');


            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect("income-verification/create");
            }
            else
            {
                $flag = [];
                $this->db->trans_start();
                $save['nepali_date']    = $this->input->post('nepali_date');
                $save['date']           = DateNepToEng($save['nepali_date']);
                $save['applicant_name'] = $this->input->post('applicant_name');
                $save['state']          = $this->input->post('state');
                $save['district']       = $this->input->post('district');
                $save['local_body']     = $this->input->post('local_body');
                $save['ward']           = $this->input->post('ward');
                $save['status']         = 1;
                $save['created_at']     = date("Y-m-d h:i:sa");
                $save['ward_login']     = $this->session->userdata('ward_no');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $save['session_id']            = $current_session->id;

                $path               = 'assets/documents/property/income_verification/';
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
                if($id = $this->Mdl_income_verification->save($save))
                {
                    $count = count($this->input->post('relation'));

                    for ($i = 0; $i < $count; $i++)
                    {
                        $save1['relation']          = $this->input->post('relation')[$i];
                        $save1['parties_name']      = $this->input->post('parties_name')[$i];
                        $save1['annual_income']     = $this->input->post('annual_income')[$i];
                        $save1['remark']            = isset($_POST['remark'][$i]) ? $this->input->post('remark')[$i] : '';
                        $save1['darta_id']          = $id;
                        $save1['created_at']        = date("Y-m-d h:i:sa");
                        if($this->Mdl_income_verification_detail->save($save1))
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
                        redirect("income-verification/create");
                    }
                    else
                    {
                          $chalani['darta_id']   = $id;
                          $chalani['type']       = 3;
                          $form['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                          $this->Mdl_chalani->save($chalani);
                          $this->Mdl_income_verification->update($id,$form);
                          $this->db->trans_complete();
                          $this->session->set_flashdata('msg', "सिफारिस पेश गर्न सफल");
                          redirect("income-verification/detail/".$id);
                    }

                }
                else
                {
                    $this->session->set_flashdata('err_msg', "समस्या आयो");
                    redirect("income-verification/create");
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

        $data1['title'] = "नयाँ | वार्षिक आय प्रमाणीकरण";
        $this->load->view('User/header',$data1);
        $this->load->view('income_verification',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    public function detail_income_verification()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("income-verification");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_income_verification->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("income-verification");
        }
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['income_details'] = $this->Mdl_income_verification_detail->getByDartaId($id);
        $data1['title']         = "आवेदकको विवरण | वार्षिक आय प्रमाणीकरण" ;
        $this->load->view('User/header',$data1);
        $this->load->view('income_verification_detail',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_income_verification()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("income-verification");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_income_verification->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"डेटा भेटिएन | ");
            redirect("income-verification");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("income-verification");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'Applicated Date', 'required');
            $this->form_validation->set_rules('applicant_name', 'Full Name', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            $this->form_validation->set_rules('ward', 'Ward', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            $this->form_validation->set_rules('relation[]', 'Relation with Applicant', 'required');
            $this->form_validation->set_rules('parties_name[]', 'Parties Name', 'required');
            $this->form_validation->set_rules('annual_income[]', 'Annual Income', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect("income-verification/edit/".$id);
            }
            else
            {
                $flag = [];
                $this->db->trans_start();
                $save['nepali_date']    = $this->input->post('nepali_date');
                $save['date']           = DateNepToEng($save['nepali_date']);
                $save['applicant_name'] = $this->input->post('applicant_name');
                $save['state']          = $this->input->post('state');
                $save['district']       = $this->input->post('district');
                $save['local_body']     = $this->input->post('local_body');
                $save['ward']           = $this->input->post('ward');

                $path               = 'assets/documents/property/income_verification/';
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
                if($this->Mdl_income_verification->update($id,$save))
                {
                    //---------Deleting old record and saving new one----
                    $this->Mdl_income_verification_detail->deleteByDartaId($id);

                    $count = count($this->input->post('relation'));

                    for ($i = 0; $i < $count; $i++)
                    {
                        $save1['relation']          = $this->input->post('relation')[$i];
                        $save1['parties_name']      = $this->input->post('parties_name')[$i];
                        $save1['annual_income']     = $this->input->post('annual_income')[$i];
                        $save1['remark']            = isset($_POST['remark'][$i]) ? $this->input->post('remark')[$i] : '';
                        $save1['darta_id']          = $id;
                        $save1['created_at']        = date("Y-m-d h:i:sa");

                        if($this->Mdl_income_verification_detail->save($save1))
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
                        redirect("income-verification/edit/".$id);
                    }
                    else
                    {
                        $this->db->trans_complete();
                        $this->session->set_flashdata('msg', "सिफारिस सम्पादन गर्न सफल");
                    }
                    redirect("income-verification/detail/".$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg', "समस्या आयो");
                    redirect("income-verification/edit/".$id);
                }

            }
        }
        if(!empty($result->document))
        {
            $documents          = explode("+",$result->document);
        }
        $data['default']        = getDefault();
        $data['income_details'] = $this->Mdl_income_verification_detail->getByDartaId($id);
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $data['wards']          = $this->Mdl_ward->getAll();
        $data['relations']      = $this->Mdl_relation->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title'] = "नयाँ | वार्षिक आय प्रमाणीकरण";
        $this->load->view('User/header',$data1);
        $this->load->view('income_verification',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_income_verification()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("income-verification");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_income_verification->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("income-verification");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("income-verification/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("income-verification/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."income-verification/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/property/income_verification";
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
            if($this->Mdl_income_verification->update($id,$data))
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
                redirect(base_url()."income-verification/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."income-verification/detail/".$id);
            }

        }
        $result     = [];
        $ward_login             = $this->session->userdata('ward_no');
        $result['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/darta',$result);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function chalani_income_verification()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_income_verification->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("income-verification");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("income-verification/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("income-verification/detail/".$id);
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
            $save['type']               =3;
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
            if($this->Mdl_income_verification->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("income-verification/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("income-verification");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_income_verification()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("income-verification");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_income_verification->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("income-verification");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("income-verification/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
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
        $data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $data['income_details'] = $this->Mdl_income_verification_detail->getByDartaId($id);
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user']  = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('income_verification_print',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_income_verification()
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
                    $result         = $this->Mdl_income_verification->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_income_verification->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_income_verification->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."income-verification");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_income_verification->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_income_verification->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_income_verification->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_income_verification->getTableName();
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
        $data1['title']     = "वार्षिक आय प्रमाणिकरण";
        $this->load->view('User/header',$data1);
        $this->load->view('income_verification_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getIncomeVerificationHTML()
    {
        $i          = $this->input->post('count');
        $res        = [];
        $relations  = $this->Mdl_relation->getAll();
        $html       = '<tr class="item" id="div_'.$i.'">

                            <td>
                                <select name="relation[]" class="form-control" required id="relation_'.$i.'">
                                    <option value="">छान्नुहोस्</option>';
                                    foreach($relations as $relation) :
        $html      .=                '<option value="'.$relation->id.'">'.$relation->name.'</option>';
                                    endforeach;
        $html      .=          '</select>
                            </td>
                            <td>
                                <input type="text" name="parties_name[]" maxlength="128" class="form-control formset-field" id="parties_name_'.$i.'" required />
                            </td>
                            <td>
                                <input type="number" name="annual_income[]" class="form-control formset-field" id="annual_income_'.$i.'" min="0.1" step="0.01" required />
                            </td>
                            <td>
                                <textarea name="remark[]" class="form-control formset-field" id="remark_'.$i.'" cols="40" maxlength="512" rows="2">
                                </textarea>
                            </td>
                            <td>
                            <button type="button" class="btn btn-danger btn-sm remove"
                                    id="remove_'.$i.'" >
                                 <i class="fa fa-minus"></i>
                            </button>
                        </td>
                    </tr>' ;
        $res['html'] = $html;
        echo json_encode($res);exit;
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Property Valuation    ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/

    public function create_property_valuation()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        if(isset($_POST['submit'])) {
            $total = $this->input->post('total_forms');

            $this->form_validation->set_rules('nepali_date', 'Applicated Date', 'required');
            $this->form_validation->set_rules('applicant_name', 'Full Name', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            $this->form_validation->set_rules('ward', 'Ward', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            for($i=0 ; $i < $total; $i++)
            {
                $this->form_validation->set_rules('owner_'.$i, 'Owner', 'required');
                $this->form_validation->set_rules('plot_no_'.$i, 'Particular Plot No.', 'required');
                $this->form_validation->set_rules('biggha_'.$i, 'Biggha', 'required');
                $this->form_validation->set_rules('kattha_'.$i, 'Kattha', 'required');
                $this->form_validation->set_rules('dhur_'.$i, 'Dhur', 'required');
                $this->form_validation->set_rules('total_value_'.$i, 'Total Value', 'required');
            }

            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg',validation_errors());
                // $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect("property-valuation/create");
            }
            else
            {
                $flag = [];
               $this->db->trans_start();
                $save['nepali_date']    = $this->input->post('nepali_date');
                $save['date']           = DateNepToEng($save['nepali_date']);
                $save['applicant_name'] = $this->input->post('applicant_name');
                $save['state']          = $this->input->post('state');
                $save['district']       = $this->input->post('district');
                $save['local_body']     = $this->input->post('local_body');
                $save['ward']           = $this->input->post('ward');
                $save['status']         = 1;
                $save['created_at']     = date("Y-m-d h:i:sa");
                $save['ward_login']     = $this->session->userdata('ward_no');
                $save['land_type']      = $this->input->post('land_type');
                $current_session                = Modules::run("Settings/getCurrentSession");
                $save['session_id']            = $current_session->id;

                $path               = 'assets/documents/property/property_valuation/';
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
                if($id = $this->Mdl_property_valuation->save($save))
                {


                    for ($i = 0; $i < $total; $i++)
                    {
                        $save1['owner']             = $this->input->post('owner_'.$i);
                        $save1['plot_no']           = $this->input->post('plot_no_'.$i);
                        $save1['biggha']            = $this->input->post('biggha_'.$i);
                        $save1['kattha']            = $this->input->post('kattha_'.$i);
                        $save1['dhur']              = $this->input->post('dhur_'.$i);
                        if($_POST['land_type'] == "hill")
                        {
                            $save1['paisa']         = $this->input->post('paisa_'.$i);
                        }
                        else
                        {
                            $save1['paisa']         = 0;
                        }
                        $save1['remark']            = $this->input->post('remark_'.$i) ;
                        $save1['total_value']       = $this->input->post('total_value_'.$i);
                        $save1['darta_id']          = $id;
                        $save1['created_at']        = date("Y-m-d h:i:sa");
                        if($this->Mdl_property_valuation_detail->save($save1))
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
                        redirect("property-valuation/create");
                    }
                    else
                    {
                          $chalani['darta_id']   = $id;
                          $chalani['type']       = 3;
                          $form['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                          $this->Mdl_chalani->save($chalani);
                          $this->Mdl_property_valuation->update($id,$form);
                          $this->db->trans_complete();
                          $this->session->set_flashdata('msg', "सिफारिस पेश गर्न सफल");
                          redirect("property-valuation/detail/".$id);
                      }
                }
                else
                {
                    $this->session->set_flashdata('err_msg', "समस्या आयो");
                    redirect("property-valuation/create");
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

        $data1['title'] = "नयाँ | वार्षिक आय प्रमाणीकरण";
        $this->load->view('User/header',$data1);
        $this->load->view('property_valuation',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    public function detail_property_valuation()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("property-valuation");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_property_valuation->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("property-valuation");
        }
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['property_details'] = $this->Mdl_property_valuation_detail->getByDartaId($id);
        $data1['title']         = "आवेदकको विवरण | सम्पति मूल्यांकन" ;
        $this->load->view('User/header',$data1);
        $this->load->view('property_valuation_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_property_valuation()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");

        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("property-valuation");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_property_valuation->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"डेटा भेटिएन | ");
            redirect("property-valuation");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("property-valuation");
        }
        if(isset($_POST['submit'])) {
            $total = $this->input->post('total_forms');

            $this->form_validation->set_rules('nepali_date', 'Applicated Date', 'required');
            $this->form_validation->set_rules('applicant_name', 'Full Name', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            $this->form_validation->set_rules('ward', 'Ward', 'required');
            $this->form_validation->set_rules('local_body', 'गा.वि.स./न.पा.', 'required');
            for($i=0 ; $i < $total; $i++)
            {
                $this->form_validation->set_rules('owner_'.$i, 'Owner', 'required');
                $this->form_validation->set_rules('plot_no_'.$i, 'Particular Plot No.', 'required');
                $this->form_validation->set_rules('biggha_'.$i, 'Biggha', 'required');
                $this->form_validation->set_rules('kattha_'.$i, 'Kattha', 'required');
                $this->form_validation->set_rules('dhur_'.$i, 'Dhur', 'required');
                $this->form_validation->set_rules('total_value_'.$i, 'Total Value', 'required');
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
                $save['nepali_date']    = $this->input->post('nepali_date');
                $save['date']           = DateNepToEng($save['nepali_date']);
                $save['applicant_name'] = $this->input->post('applicant_name');
                $save['state']          = $this->input->post('state');
                $save['district']       = $this->input->post('district');
                $save['local_body']     = $this->input->post('local_body');
                $save['ward']           = $this->input->post('ward');

                $path               = 'assets/documents/property/property_valuation/';
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
                if($this->Mdl_property_valuation->update($id,$save))
                {
                    //---------Deleting old record and saving new one----
                    $this->Mdl_property_valuation_detail->deleteByDartaId($id);

                    for ($i = 0; $i < $total; $i++)
                    {
                        $save1['owner']             = $this->input->post('owner_'.$i);
                        $save1['plot_no']           = $this->input->post('plot_no_'.$i);
                        $save1['biggha']            = $this->input->post('biggha_'.$i);
                        $save1['kattha']            = $this->input->post('kattha_'.$i);
                        $save1['dhur']              = $this->input->post('dhur_'.$i);
                        $save1['remark']            = $this->input->post('remark_'.$i) ;
                        $save1['total_value']       = $this->input->post('total_value_'.$i);
                        $save1['darta_id']          = $id;
                        $save1['created_at']        = date("Y-m-d h:i:sa");

                        if($this->Mdl_property_valuation_detail->save($save1))
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
                        redirect("property-valuation/edit/".$id);
                    }
                    else
                    {
                        $this->db->trans_complete();
                        $this->session->set_flashdata('msg', "सिफारिस सम्पादन गर्न सफल");
                        redirect("property-valuation/detail/".$id);
                    }
                }
                else
                {
                    $this->session->set_flashdata('err_msg', "समस्या आयो");
                    redirect("property-valuation/edit/".$id);
                }

            }
        }
        if(!empty($result->document))
        {
            $documents              = explode("+",$result->document);
        }
        $data['default']        = getDefault();
        $data['property_details']   = $this->Mdl_property_valuation_detail->getByDartaId($id);
        $data['states']             = $this->Mdl_state->getAll();
        $data['districts']          = $this->Mdl_district->getAll();
        $data['locals']             = $this->Mdl_local_body->getAll();
        $data['wards']              = $this->Mdl_ward->getAll();

        $patra_url              = $this->uri->segment(1);
        $patra = $this->Mdl_patra_item->getByURI($patra_url);
        $data['patra_id']  = $patra->id;
        $data['documents']      = $this->Mdl_document->getByPatraId($patra->id);

        $data1['title']             = "नयाँ | सम्पति मूल्यांकन";
        $this->load->view('User/header',$data1);
        $this->load->view('property_valuation',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_property_valuation()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("property-valuation");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_property_valuation->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("property-valuation");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("property-valuation/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("property-valuation/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."property-valuation/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/property/property_valuation";
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
            if($this->Mdl_property_valuation->update($id,$data))
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
                redirect(base_url()."property-valuation/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."property-valuation/detail/".$id);
            }

        }
        $result     = [];
        $ward_login             = $this->session->userdata('ward_no');
        $result['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/darta',$result);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function chalani_property_valuation()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_property_valuation->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("property-valuation");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("property-valuation/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("property-valuation/detail/".$id);
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
            $save['type']               = 3;
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
            if($this->Mdl_property_valuation->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("property-valuation/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("property-valuation");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_property_valuation()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("property-valuation");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_property_valuation->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("property-valuation");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("property-valuation/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
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
        $data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $data['property_details']   = $this->Mdl_property_valuation_detail->getByDartaId($id);
        $data['chalani_result'] = $result_chalani = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no']         = $result_chalani->chalani_no;
        $data['user']  = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']             = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('property_valuation_print',$data);
        $this->load->view('User/footer');
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_property_valuation()
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
                    $result         = $this->Mdl_property_valuation->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_property_valuation->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_property_valuation->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."property-valuation");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_property_valuation->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_property_valuation->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_property_valuation->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_property_valuation->getTableName();
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
                $data['result']     = $this->Mdl_property_valuation->getAll($this->session->userdata('ward_no'));
            }
        }
        // echo "<pre>";
        // print_r($data); 
        // exit;
        $data1['title']     = "सम्पति मूल्यांकन";
        $this->load->view('User/header',$data1);
        $this->load->view('property_valuation_view',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getPropertyValuationHTML()
    {
        $i      = $this->input->post('count');
        $land_type = $_POST['land_type'];
        $display = '';
        if($land_type=="terai")
        {
            $display = 'style="display:none;"';
        }
        $res    = [];
        $html   = '<tr class="item" id="div_'.$i.'">
                <td>
                    <input type="text" name="owner_'.$i.'" maxlength="64" class="form-control formset-field" id="id_details-'.$i.'-owner" required/>
                </td>
                <td>
                    <input type="text" name="plot_no_'.$i.'" maxlength="16" class="form-control formset-field" id="id_details-'.$i.'-plot_no" required />
                </td>
                <td>
                    <input type="number" name="biggha_'.$i.'" value="0" class="form-control formset-field biggha" id="id_details-'.$i.'-biggha" min="0" required/>
                </td>
                <td>
                    <input type="number" name="kattha_'.$i.'" value="0" class="form-control formset-field kattha" id="id_details-'.$i.'-kattha" min="0" max="20" required/>
                </td>
                <td>
                    <input type="number" name="dhur_'.$i.'" value="0" class="form-control formset-field dhur" id="id_details-'.$i.'-dhur" min="0" max="20" required/>
                </td>
                <td '. $display .' >
                    <input type="number" name="paisa_'.$i.'" value="0" class="form-control formset-field paisa" id="id_details-'.$i.'-paisa" min="0" max="20" />
                </td>
                <td>
                    <input type="number" name="total_value_'.$i.'" class="form-control formset-field" id="id_details-'.$i.'-total_value" step="0.01" required/>
                </td>
                <td>
                    <textarea name="remark_'.$i.'" class="form-control formset-field " id="id_details-'.$i.'-remark" cols="40" maxlength="512" rows="2">
                    </textarea>
                </td>


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
    /*------------------------------------------------------------------------------------------------------------------*/
    /*------- Tax Clearance   ---------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function create_tax_clearance()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'Applicated Date', 'required');
            $this->form_validation->set_rules('applicant_name', 'Full Name', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            $this->form_validation->set_rules('ward', 'Ward No.', 'required');
            $this->form_validation->set_rules('local_body', 'Municipality/VDC', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('plot_no', 'Plot No.', 'required');
            $this->form_validation->set_rules('property_tax', 'Tax Amount', 'required');
            $this->form_validation->set_rules('property_ward', 'Property Ward No.', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               $this->session->set_flashdata('err_msg', validation_errors());
                // $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('tax-clearance/create');

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/property/tax_clearance/';
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
                if($id = $this->Mdl_tax_clearance->save($this->input->post()))
                {
                    $chalani['darta_id']   = $id;
                    $chalani['type']       = 3;
                    $save['form_id']       =   $chalani['form_id']    = Modules::run("Home/genFormId");
                    $this->Mdl_chalani->save($chalani);
                    $this->Mdl_tax_clearance->update($id,$save);
                    $this->session->set_flashdata('msg',"सिफारिस पेश गर्न सफल |");
                    redirect('tax-clearance/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('tax-clearance/create');
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

        $data1['title'] = "नयाँ | कर सावधानी प्रमाणपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('tax_clearance',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function detail_tax_clearance()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("tax-clearance");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_tax_clearance->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("tax-clearance");
        }
        $data['print_detail'] = $this->Mdl_print_details->getByURIandFormId($this->uri->segment(1), $result->form_id);
        $data['workers']       = $this->Mdl_ward_worker->getAllByWard($this->session->userdata('ward_no'));
        $data['chalani_result'] = $chalani_result     = $this->Mdl_chalani->getByFormId($result->form_id);
        if($result->status == 3)
        {
            $data['chalani_no'] = $chalani_result->chalani_no;
        }
        $data1['title']     = "आवेदकको विवरण | कर सावधानी प्रमाणपत्र" ;
        $this->load->view('User/header',$data1);
        $this->load->view('tax_clearance_detail',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function edit_tax_clearance()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो | ");
            redirect("tax-clearance");
        }
        $id         = $this->uri->segment(3);
        $result     = $data['result']     = $this->Mdl_tax_clearance->getById($id);
        if(empty($data['result']))
        {
            $this->session->set_flashdata("err_msg","समस्या आयो |");
            redirect("tax-clearance");
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata("err_msg","यो सिफारिस दर्ता या चलानीमा भई सक्यो|");
            redirect("tax-clearance");
        }
        if(isset($_POST['submit'])) {
            $this->form_validation->set_rules('nepali_date', 'Applicated Date', 'required');
            $this->form_validation->set_rules('applicant_name', 'Full Name', 'required');
            $this->form_validation->set_rules('district', 'District', 'required');
            $this->form_validation->set_rules('ward', 'Ward No.', 'required');
            $this->form_validation->set_rules('local_body', 'Municipality/VDC', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
            $this->form_validation->set_rules('plot_no', 'Plot No.', 'required');
            $this->form_validation->set_rules('property_tax', 'Tax Amount', 'required');
            $this->form_validation->set_rules('property_ward', 'Property Ward No.', 'required');

            if ($this->form_validation->run() == FALSE)
            {
               // $this->session->set_flashdata('err_msg', validation_errors());
                $this->session->set_flashdata('err_msg', "कृपया सबै (*) लगाएको डाटा भर्नुहोस् | ");
                redirect('tax-clearance/edit/'.$id);

            }
            else
            {
                unset($_POST['submit']);
                $path = 'assets/documents/property/tax_clearance/';
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
                if($this->Mdl_tax_clearance->update($id , $this->input->post()))
                {
                    $this->session->set_flashdata('msg',"सम्पादन गर्न सफल |");
                    redirect('tax-clearance/detail/'.$id);
                }
                else
                {
                    $this->session->set_flashdata('err_msg',"समस्या आयो |");
                    redirect('tax-clearance/edit/'.$id);
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

        $data1['title'] = "नयाँ | कर सावधानी प्रमाणपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('tax_clearance',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function darta_tax_clearance()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("tax-clearance");
        }
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_tax_clearance->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("tax-clearance");
        }
        if($result->status == 2)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छ। | ");
            redirect("tax-clearance/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("tax-clearance/detail/".$id);
        }
        if(isset($_POST['submit']))
        {
            $files = $_FILES;
            $dataInfo = [];
            $count = count($_FILES['documents']['name']);

            // if($_FILES['documents']['name'][0] == "")
            // {
            //     $this->session->set_flashdata('err_msg','निबेदन छनौट गर्नुहोस |');
            //     redirect(base_url()."tax-clearance/darta/".$id);
            // }
            $filename = "";
            $path  = "assets/documents/property/tax_clearance";
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
            if($this->Mdl_tax_clearance->update($id,$data))
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
                redirect(base_url()."tax-clearance/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect(base_url()."tax-clearance/detail/".$id);
            }

        }
        $result     = [];
        $ward_login             = $this->session->userdata('ward_no');
        $result['reserved_darta_nos']   = $this->Mdl_darta->getReservedDartaNos($this->session->userdata('is_muncipality'),$this->session->userdata('ward'));
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/darta',$result);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function chalani_tax_clearance()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        $id         = $this->uri->segment(3);
        $result     = $this->Mdl_tax_clearance->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("tax-clearance");
        }
        if($result->status == 1)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै दर्ता गरिएको छैन। | ");
            redirect("tax-clearance/detail/".$id);
        }
        if($result->status == 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानीमा गरिएको छ। | ");
            redirect("tax-clearance/detail/".$id);
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
            $save['type']               = 3;
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
            if($this->Mdl_tax_clearance->update($id,$data))
            {
                $this->session->set_flashdata('msg',"डेटा चलानी गर्न सफल | ");
                redirect("tax-clearance/detail/".$id);
            }
            else
            {
                $this->session->set_flashdata('err_msg',"समस्या आयो |");
                redirect("tax-clearance");
            }
        }
        $data['departments']    = $this->Mdl_department->getAll();
        $data1['title']         = "Approve";
        $this->load->view('User/header',$data1);
        $this->load->view('Home/chalani',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function print_tax_clearance()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        Modules::run("User/checkWardLogin");
        if(empty($this->uri->segment(3)))
        {
            $this->session->set_flashdata('err_msg',"समस्या आयो |");
            redirect("tax-clearance");
        }
        $id         = $this->uri->segment(3);
        $data['result'] = $result     = $this->Mdl_tax_clearance->getById($id);
        if(empty($result))
        {
            $this->session->set_flashdata('err_msg',"फारम भेटिएन | ");
            redirect("tax-clearance");
        }
        if($result->status != 3)
        {
            $this->session->set_flashdata('err_msg',"यो डेटा पहिले नै चलानी गरिएको छैन | ");
            redirect("tax-clearance/detail/".$id);
        }
        //-----saving printing details--------------------
            $uri = $this->uri->segment(1);
            $this_print = $this->Mdl_print_details->getByURIandFormId($uri, $result->form_id);
            $save['uri'] = $uri; $save['form_id'] = $result->form_id;
            $save['worker_id'] = $_POST['ward_worker'];
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
        $data['ward_worker']    = $this->Mdl_ward_worker->getById($_POST['ward_worker']);
        $data['chalani_result'] = $result_chalani     = $this->Mdl_chalani->getByFormId($result->form_id);
        $data['chalani_no'] = $result_chalani->chalani_no;
        $data['user']  = $this->Mdl_user->getById($this->session->userdata('id'));
        $data1['title']         = "Print";
        $this->load->view('User/header1',$data1);
        $this->load->view('tax_clearance_print',$data);
        $this->load->view('User/footer');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function view_tax_clearance()
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
                    $result         = $this->Mdl_tax_clearance->searchByWord($search,$ward_login);
                    $data['result'] = $result;
                }

                if(isset($_GET['status']))
                {
                    $status         = $this->input->get('status');
                    if($status == 0)
                    {
                        $data['result']     = $this->Mdl_tax_clearance->getAll($ward_login);
                    }
                    else
                    {
                        $data['result']     = $this->Mdl_tax_clearance->getByStatus($status,$ward_login);
                    }
                }

                if(isset($_GET['start_date_nep']) || isset($_GET['end_date_nep']))
                {
                    if(empty($this->input->get("start_date_nep")) || empty($this->input->get('end_date_nep')) )
                    {
                        $this->session->set_flashdata('err_msg',"तपाईले दिनु भएको मिति गलत छ। कृपया पूर्ण प्रयास गर्नुहोला ।");
                        redirect(base_url()."tax-clearance");
                    }
                    $start_date     = DateNepToEng($this->input->get('start_date_nep'));
                    $end_date       = DateNepToEng($this->input->get('end_date_nep'));
                    $data['result'] = $this->Mdl_tax_clearance->getByDates($start_date,$end_date,$ward_login);
                }
                if(isset($_GET['month']))
                {
                    $month      = $this->input->get('month');
                    $end_date   = date("Y-m-d");
                    $start_date = date('Y-m-d', strtotime("-{$month} months", strtotime($end_date)));

                    $data['result'] = $this->Mdl_tax_clearance->getByDates($start_date,$end_date,$ward_login);
                }

            }
            else
            {
                $data['result']     = $this->Mdl_tax_clearance->getByStatus(1,$ward_login);
            }
        }
        else
        {
            $url = $this->uri->segment(1);
            $department = $this->session->userdata('department');
            $table_name = $this->Mdl_tax_clearance->getTableName();
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
        $data1['title']     = "कर सावधानी प्रमाणपत्र";
        $this->load->view('User/header',$data1);
        $this->load->view('tax_clearance_view',$data);
        $this->load->view('User/footer');
    }
}
