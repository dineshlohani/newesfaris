<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_office');
        $this->load->model('Mdl_state');
        $this->load->model('Mdl_district');
        $this->load->model('Mdl_local_body');
        $this->load->model('Mdl_ward');
        $this->load->model('Mdl_oldnew_address');
        $this->load->model('Mdl_road_type');
        $this->load->model('Mdl_home_type');
        $this->load->model('Mdl_direction');
        $this->load->model('Mdl_relation');
        $this->load->model('Mdl_disable_type');
        $this->load->model('Mdl_eutype');
        $this->load->model('Mdl_patra_category');
        $this->load->model('Mdl_patra_item');
        $this->load->model('Mdl_department');
        $this->load->model('Mdl_session');
        $this->load->model('Mdl_marriage_type');
        $this->load->model('Mdl_document');
        $this->load->model('Mdl_work');
        $this->load->model('Mdl_service');
        $this->load->model('Mdl_post');
        $this->load->model('Mdl_worker');
        $this->load->model('Mdl_ward_worker');
        $this->load->model('Mdl_land_type');
        $this->load->model('Mdl_letter_category');

        $this->load->helper("functions_helper");


    }
    /*----------------------------------------------------------------------*/
    /*|             Gloabal USE                   */
    /*----------------------------------------------------------------------*/
    public function getWardPostByIdJSON($worker_id='')
    {
        if(isset($_GET['worker_id']))
        {
            $worker_id = $_GET['worker_id'];
        }
        if(!empty($worker_id))
        {
            $this_worker = $this->Mdl_ward_worker->getById($worker_id);
            if($this_worker != FALSE)
            {
                $this_post = $this->Mdl_post->getById($this_worker->post_id);
                if(isset($worker_id))
                {
                    echo json_encode($this_post);exit;
                }
                else {
                    return $this_post;
                }
            }
        }
        if(isset($worker_id))
        {
            echo '0';exit;
        }
        else {
            return FALSE;
        }
    }
    /*----------------------------------------------------------------------*/
    public function getWardWorkerByPost($ward='', $post_id='')
    {
        if(isset($_GET['post_id']) && $_GET['ward'])
        {
            $post_id = $_GET['post_id'];
            $ward = $_GET['ward'];
        }
        if(!empty($post_id) && !empty($ward))
        {
            $this_worker = $this->Mdl_ward_worker->getByWardPost($ward, $post_id);
            if($this_worker != FALSE)
            {
                echo json_encode($this_worker);exit;
            }
        }
        echo '0';
        exit;
    }
    /*----------------------------------------------------------------------*/
    /*----------------------------------------------------------------------*/

    /*----------------------------------------------------------------------*/
    /*|Settings for Currency Rate                                               */
    /*----------------------------------------------------------------------*/

    public function convertCurrency($amount,$from_currency,$to_currency)
    {
          $apikey = '206b67779d76d4a5dc5a';
          $from_Currency = urlencode($from_currency);
          $to_Currency = urlencode($to_currency);
          $query =  "{$from_Currency}_{$to_Currency}";
          $json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");
          $obj = json_decode($json, true);
          $val = floatval($obj["$query"]);
          $total = $val * $amount;
          return number_format($total, 2, '.', '');
    }
    /*-----------------------------------------------------------------------------------------------*/
    public function currency($redirect = 'TRUE')
    {
        $rate   = $this->convertCurrency(1,'USD','NPR');
        if($rate != 0)
        {
            $cookie = [
                    'name'      => 'currency_rate',
                    'value'     => $rate,
                    'expire'    => 604800

            ];
            $this->input->set_cookie($cookie);
            if($redirect == 'TRUE'){
                $this->session->set_flashdata('msg',"Successfully Updated Currency Rate");
            }
            else {
                return TRUE;
            }

        }
        else
        {
            $this->session->set_flashdata('err_msg',"Failed to Update Currency Rate");
        }

        redirect(base_url()."dashboard");
    }
    /*---------------------------------------------------------------------------------------------------*/
    /*----------------------------------------------------------------------*/
    /*|Settings for Documents                                                */
    /*----------------------------------------------------------------------*/
    public function add_document()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_document->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','कागजातको नाम','required');
            $this->form_validation->set_rules('parta_id','पत्रको नाम','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
            }
//            unset($this->input->post('submit'));
            if($this->Mdl_document->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("documents");
        }
        $data['documents']  = $this->Mdl_document->getAll();
        $data['patras']     = $this->Mdl_patra_item->getAll();
        $data1['title'] = "Settings | Documents";
        $this->load->view("User/header",$data1);
        $this->load->view("documents",$data);


    }

    public function view_document()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['documents'] = $this->Mdl_document->getAll();
        $data['patras']     = $this->Mdl_patra_item->getAll();
        $data1['title']  = "Settings | Documents";
        $this->load->view("User/header",$data1);
        $this->load->view("documents",$data);


    }
    public function delete_document()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_document->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("documents");
        }
    }
   public function getDocument($id)
   {
       return $this->Mdl_document->getById($id);
   }
   /*-------------------------------------------------------------------------------------------*/

    /*----------------------------------------------------------------------*/
    /*|Settings for Office                                                  */
    /*----------------------------------------------------------------------*/
    public function add_office()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_office->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','कार्यालयको नाम','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
            }
//            unset($this->input->post('submit'));
            if($this->Mdl_office->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("office");
        }
        $data['states']  = $this->Mdl_state->getAll();
        $data['districts']  = $this->Mdl_district->getAll();
        $data['locals']  = $this->Mdl_local_body->getAll();
        $data['wards']  = $this->Mdl_ward->getAll();
        $data['offices'] = $this->Mdl_office->getAll();
        $data1['title'] = "Settings | Office";
        $this->load->view("User/header",$data1);
        $this->load->view("office",$data);


    }

    public function view_office()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['states']  = $this->Mdl_state->getAll();
        $data['districts']  = $this->Mdl_district->getAll();
        $data['locals']  = $this->Mdl_local_body->getAll();
        $data['wards']  = $this->Mdl_ward->getAll();
        $data['offices'] = $this->Mdl_office->getAll();
        $data1['title']  = "Settings | Office";
        $this->load->view("User/header",$data1);
        $this->load->view("office",$data);


    }
    public function delete_office()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_office->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("office");
        }
    }
   public function getOffice($id)
   {
       return $this->Mdl_office->getById($id);
   }

   public function addOfficeJSON()
   {
       $save['name']    = $_POST['office'];
       $save['address'] = $_POST['address'];
       $save['sambodhan'] = $_POST['sambodhan'];
       $res = [];
       if($id = $this->Mdl_office->save($save))
       {
           $res['msg'] = "TRUE";
           $offices = $this->Mdl_office->getAll();
           $html = '<option value="">छान्नुहोस्</option>';
           foreach($offices as $office):
               $html .= '<option value="'.$office->id.'" >'.$office->name.'</option>';
           endforeach;
           $res['html'] = $html;
           $res['insert_id'] = $id;
           echo json_encode($res);
           die();
       }
       else {
           $res['msg'] = "FALSE";
           echo json_encode($res);
           die();
       }
   }
    /*----------------------------------------------------------------------*/
    /*|Settings for State                                                 */
    /*----------------------------------------------------------------------*/
    public function add_state()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_state->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','प्रदेशको नाम','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
            }
//            unset($this->input->post('submit'));
            if($this->Mdl_state->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("state");
        }
        $data['states'] = $this->Mdl_state->getAll();
        $data1['title'] = "Settings | State";
        $this->load->view("User/header",$data1);
        $this->load->view("state",$data);


    }

    public function view_state()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['states'] = $this->Mdl_state->getAll();
        $data1['title']  = "Settings | State";
        $this->load->view("User/header",$data1);
        $this->load->view("state",$data);


    }
    public function delete_state()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_state->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("state");
        }
    }
    public function getState($id)
    {
        return $this->Mdl_state->getById($id);
    }
    /*--------------------------------------------------------------------------------------
    |   Settings for District
    |---------------------------------------------------------------------------------------*/
    public function add_district()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_district->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','जिल्लाको नाम','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
            }
//            unset($this->input->post('submit'));
            if($this->Mdl_district->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("district");
        }
        $data['districts'] = $this->Mdl_district->getAll();
        $data1['title'] = "Settings | District";
        $this->load->view("User/header",$data1);
        $this->load->view("district",$data);


    }

    public function view_district()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['districts'] = $this->Mdl_district->getAll();
        $data1['title']  = "Settings | District";
        $this->load->view("User/header",$data1);
        $this->load->view("district",$data);


    }
    public function delete_district()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_district->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("district");
        }
    }
    public function getDistrict($id)
    {
        return $this->Mdl_district->getById($id);
    }

    public function getdistrictHTML()
    {
        $res= array();
        $state = $_POST['state'];
        $id    = $_POST['id'];
        $html='';
        $result = $this->Mdl_district->getAllByState($state);
        $html .="<option value=''>जिल्ला</option>";
        foreach($result as $data):
         $html.='<option value="'.$data->id.'">'.$data->name.'</option>';
        endforeach;
        $res['html']= $html;
        echo json_encode($res);
    }

    public function getdistrictHTMLEN()
    {
        $res= array();
        $state = $_POST['state'];
        $id    = $_POST['id'];
        $html='';
        $result = $this->Mdl_district->getAllByState($state);
        $html .="<option value=''>--Select District--</option>";
        foreach($result as $data):
         $html.='<option value="'.$data->id.'">'.$data->english_name.'</option>';
        endforeach;
        $res['html']= $html;
        echo json_encode($res);
    }

    /*--------------------------------------------------------------------------------------
    |   Settings for Local Body
    |---------------------------------------------------------------------------------------*/
    public function add_local()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_local_body->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','गा.वि.स./न.पा. को नाम','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
            }
//            unset($this->input->post('submit'));
            if($this->Mdl_local_body->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("local");
        }
        $data['locals'] = $this->Mdl_local_body->getAll();
        $data1['title'] = "Settings | Local Body";
        $this->load->view("User/header",$data1);
        $this->load->view("local_body",$data);


    }

    public function view_local()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['locals']     = $this->Mdl_local_body->getAll();
        $data1['title']     = "Settings | Local Body";
        $this->load->view("User/header",$data1);
        $this->load->view("local_body",$data);


    }
    public function delete_local()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_local_body->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("local");
        }
    }
    public function getLocal($id)
    {
        return $this->Mdl_local_body->getById($id);
    }
    public function getlocalbodyHTML()
    {
        $res= array();
        $district = $_POST['district'];
        $id    = $_POST['id'];
        $html='';
        $result = $this->Mdl_local_body->getAllByDistrict($district);
        $html .="<option value=''>गा.वि.स./न.पा </option>";
        foreach($result as $data):
         $html.='<option value="'.$data->id.'">'.$data->name.'</option>';
        endforeach;

        $res['html']= $html;
        echo json_encode($res);
    }

    public function getlocalbodyHTMLEN()
    {
        $res= array();
        $district = $_POST['district'];
        $id    = $_POST['id'];
        $html='';
        $result = $this->Mdl_local_body->getAllByDistrict($district);
        $html .="<option value=''>--select gapa/napa--</option>";
        foreach($result as $data):
         $html.='<option value="'.$data->id.'">'.$data->english_name.'</option>';
        endforeach;

        $res['html']= $html;
        echo json_encode($res);
    }

    public function getlocalbodyWard()
    {
        $res= array();
        $district = $_POST['district'];
        $id    = $_POST['id'];
        $html='';
        $result = $this->Mdl_local_body->getByLocalBody($district);
        $html .="<option value=''>--Select Ward--</option>";
        for ($x = 1; $x <= $result->no_of_ward; $x++) {
            //echo "The number is: $x <br>";
            $html.= '<option value="'.$x.'">'.$x.'</option>';
        }
        
        // foreach($result as $data):
        //  $html.='<option value="'.$data->id.'">'.$data->english_name.'</option>';
        // endforeach;

        $res['html']= $html;
        echo json_encode($res);
    }

    /*--------------------------------------------------------------------------------------
    |   Settings for Ward
    |---------------------------------------------------------------------------------------*/
    public function add_ward()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_ward->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','वडा नं.','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
            }
//            unset($this->input->post('submit'));
            if($this->Mdl_ward->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("ward");
        }
        $data['wards'] = $this->Mdl_ward->getAll();
        $data1['title'] = "Settings | Ward No.";
        $this->load->view("User/header",$data1);
        $this->load->view("ward",$data);


    }

    public function view_ward()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['wards']     = $this->Mdl_ward->getAll();
        $data1['title']     = "Settings | Ward No.";
        $this->load->view("User/header",$data1);
        $this->load->view("ward",$data);


    }
    public function delete_ward()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_ward->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("ward");
        }
    }
    public function getWard($id)
    {
        return $this->Mdl_ward->getById($id);
    }

    /*--------------------------------------------------------------------------------------
    |   Settings for Old New Address
    |---------------------------------------------------------------------------------------*/
    public function add_oldnew_address()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_oldnew_address->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','साबिक ठेगाना','required');
            $this->form_validation->set_rules('new_name','हाल ठेगाना','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
            }
//            unset($this->input->post('submit'));
            if($this->Mdl_oldnew_address->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("old_new_address");
        }
        $data['addresses'] = $this->Mdl_oldnew_address->getAll();
        //print_r($data['addresses']);
        $data1['title'] = "Settings | साबिक ठेगाना";
        $this->load->view("User/header",$data1);
        $this->load->view("old_new_address",$data);


    }

    public function view_oldnew_address()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['addresses']     = $this->Mdl_oldnew_address->getAll();
        $data1['title']     = "Settings | Ward No.";
        $this->load->view("User/header",$data1);
        $this->load->view("old_new_address",$data);


    }
    public function delete_oldnew_address()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
                if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_oldnew_address->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("old_new_address");
        }
    }
    public function getOldNewAddress($id)
    {
        return $this->Mdl_oldnew_address->getById($id);
    }
    public function getNewAddress()
    {
        $id = $this->input->post('id');
        $res = [];
        $result =  $this->Mdl_oldnew_address->getById($id);
        $res['new_place'] = $result->new_name;
        echo json_encode($res);exit;
    }
    /*--------------------------------------------------------------------------------------
    |   Settings for Road Type
    |---------------------------------------------------------------------------------------*/
    public function add_road_type()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_road_type->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','वडा नं.','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
            }
            if($this->Mdl_road_type->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("road_type");
        }
        $data['roads'] = $this->Mdl_road_type->getAll();
        $data1['title'] = "Settings | सडकको प्रकार";
        $this->load->view("User/header",$data1);
        $this->load->view("road_type",$data);


    }

    public function view_road_type()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['roads']     = $this->Mdl_road_type->getAll();
        $data1['title']     = "Settings | सडकको प्रकार";
        $this->load->view("User/header",$data1);
        $this->load->view("road_type",$data);


    }
    public function delete_road_type()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_road_type->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("road_type");
        }
    }
    public function getRoadType($id)
    {
        return $this->Mdl_road_type->getById($id);
    }
    /*--------------------------------------------------------------------------------------
   |   Settings for Home Type
   |---------------------------------------------------------------------------------------*/
    public function add_home_type()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_home_type->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','वडा नं.','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
                redirect("home_type");
            }
            if($this->Mdl_home_type->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("home_type");
        }
        $data['homes'] = $this->Mdl_home_type->getAll();
        $data1['title'] = "Settings | घरको प्रकार";
        $this->load->view("User/header",$data1);
        $this->load->view("home_type",$data);


    }

    public function view_home_type()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['homes']     = $this->Mdl_home_type->getAll();
        $data1['title']     = "Settings | घरको प्रकार";
        $this->load->view("User/header",$data1);
        $this->load->view("home_type",$data);


    }
    public function delete_home_type()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_home_type->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("home_type");
        }
    }
    public function getHomeType($id)
    {
        return $this->Mdl_home_type->getById($id);
    }
    /*--------------------------------------------------------------------------------------
   |   Settings for Direction
   |---------------------------------------------------------------------------------------*/
    public function add_direction()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_direction->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','दिशा','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
                redirect("direction");
            }
            if($this->Mdl_direction->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("direction");
        }
        $data['directions'] = $this->Mdl_direction->getAll();
        $data1['title'] = "Settings | दिशा";
        $this->load->view("User/header",$data1);
        $this->load->view("direction",$data);


    }

    public function view_direction()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['directions']     = $this->Mdl_direction->getAll();
        $data1['title'] = "Settings | दिशा";
        $this->load->view("User/header",$data1);
        $this->load->view("direction",$data);


    }
    public function delete_direction()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_direction->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("direction");
        }
    }
    public function getDirection($id)
    {
        return $this->Mdl_direction->getById($id);
    }
    /*--------------------------------------------------------------------------------------
   |   Settings for Relation
   |---------------------------------------------------------------------------------------*/
    public function add_relation()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_relation->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','नाता','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
                redirect("relation");
            }
            if($this->Mdl_relation->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("relation");
        }
        $data['relations'] = $this->Mdl_relation->getAll();
        $data1['title'] = "Settings | नाता";
        $this->load->view("User/header",$data1);
        $this->load->view("relation",$data);


    }

    public function view_relation()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['relations']     = $this->Mdl_relation->getAll();
        $data1['title'] = "Settings | नाता";
        $this->load->view("User/header",$data1);
        $this->load->view("relation",$data);


    }
    public function delete_relation()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_relation->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("relation");
        }
    }
    public function getRelation($id)
    {
        return $this->Mdl_relation->getById($id);
    }
    /*--------------------------------------------------------------------------------------
   |   Settings for Disable Type
   |---------------------------------------------------------------------------------------*/
   public function add_disable_type()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
        if(!empty($this->uri->segment(2)))
       {
           $id = $this->uri->segment(2);
           $data['result'] = $this->Mdl_disable_type->getById($id);
       }
       else
       {
           $id = 0;
       }
       $user = Modules::run("User/getUser");
       if(isset($_POST['submit']))
       {
           unset($data['result']);
           unset($_POST['submit']);
           $this->form_validation->set_rules('name','अपाङ्ग','required');
           if ($this->form_validation->run() == FALSE)
           {
               $this->session->set_flashdata('msg', validation_errors());
               redirect("disable-type");
           }
           if($this->Mdl_disable_type->save_data($this->input->post(),$id))
           {
               if($id != 0)
               {
                   $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
               }
               else
               {
                   $this->session->set_flashdata('msg', 'थप गर्न सफल');
               }
           }
           else
           {
               $this->session->set_flashdata('err_msg', 'समस्या आयो');
           }
           redirect("disable-type");
       }
       $data['disables'] = $this->Mdl_disable_type->getAll();
       $data1['title'] = "Settings | अपाङ्गको किसिम";
       $this->load->view("User/header",$data1);
       $this->load->view("disable_type",$data);


   }

   public function view_disable_type()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
       $data['disables']     = $this->Mdl_disable_type->getAll();
       $data1['title'] = "Settings | अपाङ्गको किसिम";
       $this->load->view("User/header",$data1);
       $this->load->view("disable_type",$data);


   }
   public function delete_disable_type()
   {
       if(Modules::run("User/is_logged_in") === FALSE)
       {
           redirect("login");
       }
       if(!empty($this->uri->segment(2)))
       {
           $id = $this->uri->segment(2);
           if($this->Mdl_disable_type->delete($id))
           {
               $this->session->set_flashdata('msg', 'हटाउन सफल');
           }
           else
           {
               $this->session->set_flashdata('err_msg', 'समस्या आयो');
           }
           redirect("disable-type");
       }
   }
   public function getDisableType($id)
   {
       return $this->Mdl_disable_type->getById($id);
   }
   /*--------------------------------------------------------------------------------------
   |   Settings for Electricity Use Type
   |---------------------------------------------------------------------------------------*/
    public function add_eutype()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_eutype->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','बिधुत प्रयोजन','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
                redirect("eutype");
            }
            if($this->Mdl_eutype->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("eutype");
        }
        $data['eutypes'] = $this->Mdl_eutype->getAll();
        $data1['title'] = "Settings | बिधुत प्रयोजन";
        $this->load->view("User/header",$data1);
        $this->load->view("eutype",$data);


    }

    public function view_eutype()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['eutypes']     = $this->Mdl_eutype->getAll();
        $data1['title'] = "Settings | बिधुत प्रयोजन";
        $this->load->view("User/header",$data1);
        $this->load->view("eutype",$data);


    }
    public function delete_eutype()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_eutype->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("eutype");
        }
    }
    public function getEutype($id)
    {
        return $this->Mdl_eutype->getById($id);
    }
    /*--------------------------------------------------------------------------------------
   |   Settings for Patra Category
   |---------------------------------------------------------------------------------------*/
    public function add_patra_category()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_patra_category->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','दिशा','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
                redirect("patra-category");
            }
            if($this->Mdl_patra_category->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("patra-category");
        }
        $data['categories'] = $this->Mdl_patra_category->getAll();
        $data1['title'] = "Settings | पत्रको वर्ग";
        $this->load->view("User/header",$data1);
        $this->load->view("patra_category",$data);


    }

    public function view_patra_category()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['categories']     = $this->Mdl_patra_category->getAll();
        $data1['title'] = "Settings | पत्रको वर्ग";
        $this->load->view("User/header",$data1);
        $this->load->view("patra_category",$data);


    }
    public function delete_patra_category()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_patra_category->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("patra-category");
        }
    }
    public function getPatraCategory($id)
    {
        return $this->Mdl_patra_category->getById($id);
    }

    /*--------------------------------------------------------------------------------------
   |   Settings for Patra Item
   |---------------------------------------------------------------------------------------*/
    public function add_patra_item()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_patra_item->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','पत्रको विषय','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
                redirect("patra-item");
            }
            if($this->Mdl_patra_item->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("patra-item");
        }
        $data['categories'] = $this->Mdl_patra_category->getAll();
        $data['items']      = $this->Mdl_patra_item->getAll();
        $data1['title']     = "Settings | पत्रको विषय";
        $this->load->view("User/header",$data1);
        $this->load->view("patra_item",$data);


    }

    public function view_patra_item()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['categories'] = $this->Mdl_patra_category->getAll();
        $data['items']     = $this->Mdl_patra_item->getAll();
        $data1['title'] = "Settings | पत्रको विषय";
        $this->load->view("User/header",$data1);
        $this->load->view("patra_item",$data);


    }
    public function delete_patra_item()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_patra_item->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("patra-item");
        }
    }
    public function getPatraItem($id)
    {
        return $this->Mdl_patra_item->getById($id);
    }
    public function getPatraItemByURI($uri)
    {
        return $this->Mdl_patra_item->getByURI($uri);
    }

 /*|-------------------------------------------------------------------------------------
   |   Settings for Department ( Faat )
   |---------------------------------------------------------------------------------------*/
    public function add_department()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            $data['result'] = $this->Mdl_department->getById($id);
        }
        else
        {
            $id = 0;
        }
        $user = Modules::run("User/getUser");
        if(isset($_POST['submit']))
        {
            unset($data['result']);
            unset($_POST['submit']);
            $this->form_validation->set_rules('name','पत्रको विषय','required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('msg', validation_errors());
                redirect("department");
            }
            if($this->Mdl_department->save_data($this->input->post(),$id))
            {
                if($id != 0)
                {
                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                }
                else
                {
                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("department");
        }
        $data['departments'] = $this->Mdl_department->getAll();
        $data1['title']     = "Settings | फाँटहरु";
        $this->load->view("User/header",$data1);
        $this->load->view("department",$data);


    }

    public function view_department()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $data['departments'] = $this->Mdl_department->getAll();
        $data1['title'] = "Settings | पत्रको विषय";
        $this->load->view("User/header",$data1);
        $this->load->view("department",$data);


    }
    public function delete_department()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {
            $id = $this->uri->segment(2);
            if($this->Mdl_department->delete($id))
            {
                $this->session->set_flashdata('msg', 'हटाउन सफल');
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'समस्या आयो');
            }
            redirect("department");
        }
    }
    public function getDepartment($id)
    {
        return $this->Mdl_department->getById($id);
    }
    /*|-------------------------------------------------------------------------------------
      |   Settings for SessionYear
      |---------------------------------------------------------------------------------------*/
       public function add_session()
       {
           if(Modules::run("User/is_logged_in") === FALSE)
           {
               redirect("login");
           }
           if(!empty($this->uri->segment(2)))
           {
               $id = $this->uri->segment(2);
               $data['result'] = $this->Mdl_session->getById($id);
           }
           else
           {
               $id = 0;
           }
           $user = Modules::run("User/getUser");
           if(isset($_POST['submit']))
           {
               unset($data['result']);
               unset($_POST['submit']);
               $this->form_validation->set_rules('name','आर्थिक वर्ष','required');
               if ($this->form_validation->run() == FALSE)
               {
                   $this->session->set_flashdata('msg', validation_errors());
                   redirect("session");
               }
               if($this->Mdl_session->save_data($this->input->post(),$id))
               {
                   if($id != 0)
                   {
                       $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                   }
                   else
                   {
                       $this->session->set_flashdata('msg', 'थप गर्न सफल');
                   }
               }
               else
               {
                   $this->session->set_flashdata('err_msg', 'समस्या आयो');
               }
               redirect("session");
           }
           $data['current_session'] = $this->Mdl_session->getCurrentSession();
           $data['sessions'] = $this->Mdl_session->getAll();
           $data1['title']     = "Settings | आर्थिक वर्ष";
           $this->load->view("User/header",$data1);
           $this->load->view("session",$data);


       }

       public function view_session()
       {
           if(Modules::run("User/is_logged_in") === FALSE)
           {
               redirect("login");
           }
           $data['current_session'] = $this->Mdl_session->getCurrentSession();
           $data['sessions'] = $this->Mdl_session->getAll();
           $data1['title'] = "Settings | आर्थिक वर्ष";
           $this->load->view("User/header",$data1);
           $this->load->view("session",$data);


       }
       public function delete_session()
       {
           if(Modules::run("User/is_logged_in") === FALSE)
           {
               redirect("login");
           }
           if(!empty($this->uri->segment(2)))
           {
               $id = $this->uri->segment(2);
               if($this->Mdl_session->delete($id))
               {
                   $this->session->set_flashdata('msg', 'हटाउन सफल');
               }
               else
               {
                   $this->session->set_flashdata('err_msg', 'समस्या आयो');
               }
               redirect("session");
           }
       }
       public function getSession($id)
       {
           return $this->Mdl_session->getById($id);
       }

       public function getCurrentSession()
       {
           return $this->Mdl_session->getCurrentSession();
       }

       public function update_current_session()
       {
           if(Modules::run("User/is_logged_in") === FALSE)
           {
               redirect("login");
           }
           if(isset($_POST['submit']))
           {
               $this->form_validation->set_rules('session_id',"आर्थिक वर्ष",'required');
               if ($this->form_validation->run() == FALSE)
               {
                   $this->session->set_flashdata('err_msg', validation_errors());
                   redirect("session");
               }
               else
               {
                   $current_session     = $this->Mdl_session->getCurrentSession();
                   $old['is_current']   = 0;
                   $this->Mdl_session->update($current_session->id,$old);
                   $session_id          = $this->input->post('session_id');
                   $new['is_current']   = 1;
                   if($this->Mdl_session->update($session_id,$new))
                   {
                       $this->session->set_flashdata('msg','आर्थिक वर्ष अपडेट गर्न सफल |');
                       redirect(base_url().'session');
                   }
               }
           }
        }
        /*|-------------------------------------------------------------------------------------
          |   Settings for Marriage Types
          |---------------------------------------------------------------------------------------*/
           public function add_marriage_type()
           {
               if(Modules::run("User/is_logged_in") === FALSE)
               {
                   redirect("login");
               }
               if(!empty($this->uri->segment(2)))
               {
                   $id = $this->uri->segment(2);
                   $data['result'] = $this->Mdl_marriage_type->getById($id);
               }
               else
               {
                   $id = 0;
               }
               $user = Modules::run("User/getUser");
               if(isset($_POST['submit']))
               {
                   unset($data['result']);
                   unset($_POST['submit']);
                   $this->form_validation->set_rules('name','विवाहको प्रकार','required');
                   if ($this->form_validation->run() == FALSE)
                   {
                       $this->session->set_flashdata('msg', validation_errors());
                       redirect("marriage-type");
                   }
                   if($this->Mdl_marriage_type->save_data($this->input->post(),$id))
                   {
                       if($id != 0)
                       {
                           $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                       }
                       else
                       {
                           $this->session->set_flashdata('msg', 'थप गर्न सफल');
                       }
                   }
                   else
                   {
                       $this->session->set_flashdata('err_msg', 'समस्या आयो');
                   }
                   redirect("marriage-type");
               }
               $data['marriage_types'] = $this->Mdl_marriage_type->getAll();
               $data1['title']     = "Settings | विवाहको प्रकार";
               $this->load->view("User/header",$data1);
               $this->load->view("marriage_type",$data);


           }

           public function view_marriage_type()
           {
               if(Modules::run("User/is_logged_in") === FALSE)
               {
                   redirect("login");
               }
               $data['marriage_types'] = $this->Mdl_marriage_type->getAll();
               $data1['title'] = "Settings | विवाहको प्रकार";
               $this->load->view("User/header",$data1);
               $this->load->view("marriage_type",$data);


           }
           public function delete_marriage_type()
           {
               if(Modules::run("User/is_logged_in") === FALSE)
               {
                   redirect("login");
               }
               if(!empty($this->uri->segment(2)))
               {
                   $id = $this->uri->segment(2);
                   if($this->Mdl_marriage_type->delete($id))
                   {
                       $this->session->set_flashdata('msg', 'हटाउन सफल');
                   }
                   else
                   {
                       $this->session->set_flashdata('err_msg', 'समस्या आयो');
                   }
                   redirect("marriage-type");
               }
           }
           public function getMarriageType($id)
           {
               return $this->Mdl_marriage_type->getById($id);
           }
            /*|-------------------------------------------------------------------------------------
         |   Settings for Work Types
         |---------------------------------------------------------------------------------------*/
          public function add_work_type()
          {
              if(Modules::run("User/is_logged_in") === FALSE)
              {
                  redirect("login");
              }
              if(!empty($this->uri->segment(2)))
              {
                  $id = $this->uri->segment(2);
                  $data['result'] = $this->Mdl_work->getById($id);
              }
              else
              {
                  $id = 0;
              }
              $user = Modules::run("User/getUser");
              if(isset($_POST['submit']))
              {
                  unset($data['result']);
                  unset($_POST['submit']);
                  $this->form_validation->set_rules('name','कामको प्रकार','required');
                  if ($this->form_validation->run() == FALSE)
                  {
                      $this->session->set_flashdata('msg', validation_errors());
                      redirect("work-type");
                  }
                  if($this->Mdl_work->save_data($this->input->post(),$id))
                  {
                      if($id != 0)
                      {
                          $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                      }
                      else
                      {
                          $this->session->set_flashdata('msg', 'थप गर्न सफल');
                      }
                  }
                  else
                  {
                      $this->session->set_flashdata('err_msg', 'समस्या आयो');
                  }
                  redirect("work-type");
              }
              $data['works'] = $this->Mdl_work->getAll();
              $data1['title']     = "Settings | कामको प्रकार";
              $this->load->view("User/header",$data1);
              $this->load->view("work_type",$data);


          }

          public function view_work_type()
          {
              if(Modules::run("User/is_logged_in") === FALSE)
              {
                  redirect("login");
              }
              $data['works'] = $this->Mdl_work->getAll();
              $data1['title'] = "Settings | कामको प्रकार";
              $this->load->view("User/header",$data1);
              $this->load->view("work_type",$data);


          }
          public function delete_work_type()
          {
              if(Modules::run("User/is_logged_in") === FALSE)
              {
                  redirect("login");
              }
              if(!empty($this->uri->segment(2)))
              {
                  $id = $this->uri->segment(2);
                  if($this->Mdl_work->delete($id))
                  {
                      $this->session->set_flashdata('msg', 'हटाउन सफल');
                  }
                  else
                  {
                      $this->session->set_flashdata('err_msg', 'समस्या आयो');
                  }
                  redirect("work-type");
              }
          }
          public function getWork($id)
          {
              return $this->Mdl_work->getById($id);
          }
          /*|-------------------------------------------------------------------------------------
            |   Settings for Service
            |---------------------------------------------------------------------------------------*/
             public function add_service_type()
             {
                 if(Modules::run("User/is_logged_in") === FALSE)
                 {
                     redirect("login");
                 }
                 if(!empty($this->uri->segment(2)))
                 {
                     $id = $this->uri->segment(2);
                     $data['result'] = $this->Mdl_service->getById($id);
                 }
                 else
                 {
                     $id = 0;
                 }
                 $user = Modules::run("User/getUser");
                 if(isset($_POST['submit']))
                 {
                     unset($data['result']);
                     unset($_POST['submit']);
                     $this->form_validation->set_rules('name','सेवाको प्रकार','required');
                     if ($this->form_validation->run() == FALSE)
                     {
                         $this->session->set_flashdata('msg', validation_errors());
                         redirect("service-type");
                     }
                     if($this->Mdl_service->save_data($this->input->post(),$id))
                     {
                         if($id != 0)
                         {
                             $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                         }
                         else
                         {
                             $this->session->set_flashdata('msg', 'थप गर्न सफल');
                         }
                     }
                     else
                     {
                         $this->session->set_flashdata('err_msg', 'समस्या आयो');
                     }
                     redirect("service-type");
                 }
                 $data['services'] = $this->Mdl_service->getAll();
                 $data1['title']     = "Settings | सेवाको प्रकार";
                 $this->load->view("User/header",$data1);
                 $this->load->view("service_type",$data);


             }

             public function view_service_type()
             {
                 if(Modules::run("User/is_logged_in") === FALSE)
                 {
                     redirect("login");
                 }
                 $data['services'] = $this->Mdl_service->getAll();
                 $data1['title'] = "Settings | सेवाको प्रकार";
                 $this->load->view("User/header",$data1);
                 $this->load->view("service_type",$data);


             }
             public function delete_service_type()
             {
                 if(Modules::run("User/is_logged_in") === FALSE)
                 {
                     redirect("login");
                 }
                 if(!empty($this->uri->segment(2)))
                 {
                     $id = $this->uri->segment(2);
                     if($this->Mdl_service->delete($id))
                     {
                         $this->session->set_flashdata('msg', 'हटाउन सफल');
                     }
                     else
                     {
                         $this->session->set_flashdata('err_msg', 'समस्या आयो');
                     }
                     redirect("service-type");
                 }
             }
             public function getService($id)
             {
                 return $this->Mdl_service->getById($id);
             }
             /*|-------------------------------------------------------------------------------------
             |   Settings for  Karmachari Post
             |---------------------------------------------------------------------------------------*/
              public function add_post()
              {
                  if(Modules::run("User/is_logged_in") === FALSE)
                  {
                      redirect("login");
                  }
                  if(!empty($this->uri->segment(2)))
                  {
                      $id = $this->uri->segment(2);
                      $data['result'] = $this->Mdl_post->getById($id);
                  }
                  else
                  {
                      $id = 0;
                  }
                  $user = Modules::run("User/getUser");
                  if(isset($_POST['submit']))
                  {
                      unset($data['result']);
                      unset($_POST['submit']);
                      $this->form_validation->set_rules('name','पद','required');
                      $this->form_validation->set_rules('designation','english name', 'required');
                      if ($this->form_validation->run() == FALSE)
                      {
                          $this->session->set_flashdata('msg', validation_errors());
                          redirect("post");
                      }
                      if($this->Mdl_post->save_data($this->input->post(),$id))
                      {
                          if($id != 0)
                          {
                              $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                          }
                          else
                          {
                              $this->session->set_flashdata('msg', 'थप गर्न सफल');
                          }
                      }
                      else
                      {
                          $this->session->set_flashdata('err_msg', 'समस्या आयो');
                      }
                      redirect("post");
                  }
                  $data['posts'] = $this->Mdl_post->getAll();
                  $data1['title']     = "Settings | पद";
                  $this->load->view("User/header",$data1);
                  $this->load->view("post",$data);


              }

              public function view_post()
              {
                  if(Modules::run("User/is_logged_in") === FALSE)
                  {
                      redirect("login");
                  }
                  $data['posts'] = $this->Mdl_post->getAll();
                  $data1['title'] = "Settings | पद";
                  $this->load->view("User/header",$data1);
                  $this->load->view("post",$data);


              }
              public function getPost($id)
              {
                  return $this->Mdl_post->getById($id);
              }
              /*|-------------------------------------------------------------------------------------
                |   Settings for Worker
                |---------------------------------------------------------------------------------------*/
                 public function add_worker()
                 {
                     if(Modules::run("User/is_logged_in") === FALSE)
                     {
                         redirect("login");
                     }
                     if(!empty($this->uri->segment(2)))
                     {
                         $id = $this->uri->segment(2);
                         $data['result'] = $this->Mdl_worker->getById($id);
                     }
                     else
                     {
                         $id = 0;
                     }
                     $user = Modules::run("User/getUser");
                     if(isset($_POST['submit']))
                     {
                         unset($data['result']);
                         unset($_POST['submit']);
                         $this->form_validation->set_rules('name','कर्मचारी','required');
                         $this->form_validation->set_rules('department_id','फाँट','required');
                         $this->form_validation->set_rules('post_id','पद','required');
                         if ($this->form_validation->run() == FALSE)
                         {
                             $this->session->set_flashdata('msg', validation_errors());
                             redirect("worker");
                         }
                         if($this->Mdl_worker->save_data($this->input->post(),$id))
                         {
                             if($id != 0)
                             {
                                 $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                             }
                             else
                             {
                                 $this->session->set_flashdata('msg', 'थप गर्न सफल');
                             }
                         }
                         else
                         {
                             $this->session->set_flashdata('err_msg', 'समस्या आयो');
                         }
                         redirect("worker");
                     }
                     $data['departments'] = $this->Mdl_department->getAll();
                     $data['posts']       = $this->Mdl_post->getAll();
                     $data['workers'] = $this->Mdl_service->getAll();
                     $data1['title']     = "Settings | कर्मचारी";
                     $this->load->view("User/header",$data1);
                     $this->load->view("worker",$data);


                 }

                 public function view_worker()
                 {
                     if(Modules::run("User/is_logged_in") === FALSE)
                     {
                         redirect("login");
                     }
                     $data['departments'] = $this->Mdl_department->getAll();
                     $data['posts']       = $this->Mdl_post->getAll();
                     $data['workers'] = $this->Mdl_worker->getAll();
                     $data1['title'] = "Settings | कर्मचारी";
                     $this->load->view("User/header",$data1);
                     $this->load->view("worker",$data);


                 }
                 public function delete_worker()
                 {
                     if(Modules::run("User/is_logged_in") === FALSE)
                     {
                         redirect("login");
                     }
                     if(!empty($this->uri->segment(2)))
                     {
                         $id = $this->uri->segment(2);
                         if($this->Mdl_worker->delete($id))
                         {
                             $this->session->set_flashdata('msg', 'हटाउन सफल');
                         }
                         else
                         {
                             $this->session->set_flashdata('err_msg', 'समस्या आयो');
                         }
                         redirect("worker");
                     }
                 }
                 public function getWorker($id)
                 {
                     return $this->Mdl_worker->getById($id);
                 }
                 /*|-------------------------------------------------------------------------------------
                   |   Settings for Ward Worker
                   |---------------------------------------------------------------------------------------*/
                    public function add_ward_worker()
                    {
                        if(Modules::run("User/is_logged_in") === FALSE)
                        {
                            redirect("login");
                        }
                        if(!empty($this->uri->segment(2)))
                        {
                            $id = $this->uri->segment(2);
                            $data['result'] = $this->Mdl_ward_worker->getById($id);
                        }
                        else
                        {
                            $id = 0;
                        }
                        $user = Modules::run("User/getUser");
                        if(isset($_POST['submit']))
                        {
                            //exit('i am in');
                            unset($data['result']);
                            unset($_POST['submit']);
                            $this->form_validation->set_rules('name','कर्मचारी','required');
                            $this->form_validation->set_rules('english_name','कर्मचारीको नाम अंग्रेजीमा','required');
                            $this->form_validation->set_rules('ward','वार्ड','required');
                            $this->form_validation->set_rules('post_id','पद','required');
                            if ($this->form_validation->run() == FALSE)
                            {
                                $this->session->set_flashdata('msg', validation_errors());
                                redirect("ward-worker");
                            }
                            if($this->Mdl_ward_worker->save_data($this->input->post(),$id))
                            {
                                if($id != 0)
                                {
                                    $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
                                }
                                else
                                {
                                    $this->session->set_flashdata('msg', 'थप गर्न सफल');
                                }
                            }
                            else
                            {
                                $this->session->set_flashdata('err_msg', 'समस्या आयो');
                            }
                            redirect("ward-worker");
                        }
                        $data['wards'] = $this->Mdl_ward->getAll();
                        $data['posts']       = $this->Mdl_post->getAll();
                        $data['workers'] = $this->Mdl_ward_worker->getAll();
                        //$data['']
                        $data1['title']     = "Settings | वडा कर्मचारी";
                        $this->load->view("User/header",$data1);
                        $this->load->view("ward_worker",$data);


                    }

                    public function view_ward_worker()
                    {
                        if(Modules::run("User/is_logged_in") === FALSE)
                        {
                            redirect("login");
                        }
                        $data['wards'] = $this->Mdl_ward->getAll();
                        $data['posts']       = $this->Mdl_post->getAll();
                        $data['workers'] = $this->Mdl_ward_worker->getAll();
                        $data1['title'] = "Settings | वडा कर्मचारी";
                        $this->load->view("User/header",$data1);
                        $this->load->view("ward_worker",$data);
                    }
                    public function delete_ward_worker()
                    {
                        if(Modules::run("User/is_logged_in") === FALSE)
                        {
                            redirect("login");
                        }
                        if(!empty($this->uri->segment(2)))
                        {
                            $id = $this->uri->segment(2);
                            if($this->Mdl_ward_worker->delete($id))
                            {
                                $this->session->set_flashdata('msg', 'हटाउन सफल');
                            }
                            else
                            {
                                $this->session->set_flashdata('err_msg', 'समस्या आयो');
                            }
                            redirect("ward-worker");
                        }
                    }
                    public function getWardWorker($id)
                    {
                        return $this->Mdl_ward_worker->getById($id);
                    }
                    
                    /**------------------------------------------------------
------------------------------------------------------
land type---------------------*/
public function landType() {
     if(Modules::run("User/is_logged_in") === FALSE)
        {
           redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {

           $id = $this->uri->segment(2);
           $data['result'] = $this->Mdl_land_type->getById($id);
        }
        else
        {
           $id = 0;
        }
       $user = Modules::run("User/getUser");
       if(isset($_POST['submit']))
       {
           unset($data['result']);
           unset($_POST['submit']);
           $this->form_validation->set_rules('category','जग्गाको किसिम/वर्ग','required');
           if ($this->form_validation->run() == FALSE)
           {
               $this->session->set_flashdata('msg', validation_errors());
               redirect("land-type");
           }
           if($this->Mdl_land_type->save_data($this->input->post(),$id))
           {
               if($id != 0)
               {
                   $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
               }
               else
               {
                   $this->session->set_flashdata('msg', 'थप गर्न सफल');
               }
           }
           else
           {
               $this->session->set_flashdata('err_msg', 'समस्या आयो');
           }
           redirect("land-type");
       }
       $data['landtype'] = $this->Mdl_land_type->getAll();
       $data1['title']     = "Settings | जग्गाको किसिम/वर्ग";
       $this->load->view("User/header",$data1);
       $this->load->view("land_type_list",$data);
    }

    public function EditLandType() {
   
     if(Modules::run("User/is_logged_in") === FALSE)
        {
           redirect("login");
        }
        if(!empty($this->uri->segment(2)))
        {

           $id = $this->uri->segment(2);
           $data['result'] = $this->Mdl_land_type->getById($id);
        }
        else
        {
           $id = 0;
        }
       $user = Modules::run("User/getUser");
       if(isset($_POST['submit']))
       {
           unset($data['result']);
           unset($_POST['submit']);
           $this->form_validation->set_rules('category','जग्गाको किसिम/वर्ग','required');
           if ($this->form_validation->run() == FALSE)
           {
               $this->session->set_flashdata('msg', validation_errors());
               redirect("land-type");
           }
           if($this->Mdl_land_type->save_data($this->input->post(),$id))
           {
               if($id != 0)
               {
                   $this->session->set_flashdata('msg', 'परिमार्जन गर्न सफल');
               }
               else
               {
                   $this->session->set_flashdata('msg', 'थप गर्न सफल');
               }
           }
           else
           {
               $this->session->set_flashdata('err_msg', 'समस्या आयो');
           }
           redirect("land-type");
       }
       $data['landtype'] = $this->Mdl_land_type->getAll();
       $data1['title']     = "Settings | जग्गाको किसिम/वर्ग";
       $this->load->view("User/header",$data1);
       $this->load->view("land_type_list",$data);
    }

    public function delete_land_type()
    {
         if(Modules::run("User/is_logged_in") === FALSE)
         {
             redirect("login");
         }
         if(!empty($this->uri->segment(2)))
         {
             $id = $this->uri->segment(2);
             if($this->Mdl_land_type->delete($id))
             {
                 $this->session->set_flashdata('msg', 'हटाउन सफल');
             }
             else
             {
                 $this->session->set_flashdata('err_msg', 'समस्या आयो');
             }
             redirect("land-type");
         }
    }

    //get_post_by_worker_id
    public function get_post_by_worker_id() {
        $worker_id = $this->input->post('worker');
        //echo $worker_id;
       $workers = $this->Mdl_ward_worker->getById($worker_id);
      // pp($workers);
        $post    = $this->Mdl_post->getById($workers->post_id);
        echo $post->designation;
       //echo $post->name;
        // $res= array();
        // $district = $_POST['district'];
        // $id    = $_POST['id'];
        // $html='';
        // $result = $this->Mdl_local_body->getByLocalBody($district);
        // $html .="<option value=''>--Select Ward--</option>";
        // for ($x = 1; $x <= $result->no_of_ward; $x++) {
        //     //echo "The number is: $x <br>";
        //     $html.= '<option value="'.$x.'">'.$x.'</option>';
        // }
        
        // // foreach($result as $data):
        // //  $html.='<option value="'.$data->id.'">'.$data->english_name.'</option>';
        // // endforeach;

        // $res['html']= $html;
        // echo json_encode($res);
    }

    public function getSifarisType() {
        // $data['documents']  = $this->Mdl_document->getAll();
        // $data['patras']     = $this->Mdl_patra_item->getAll();
        $data1['title'] = "Settings | Letter Category";
        $data['parta_type'] = $this->Mdl_letter_category->getAll();
        $this->load->view("User/header",$data1);
        $this->load->view("letter_type_category",$data);
    }
}

