<?php

class LandCategory extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("CommonModel");
        $this->module_code = 'LAND-CATEGORY';
        if(!$this->authlibrary->IsLoggedIn()) {
            $this->session->set_userdata('return_url', current_url());
            redirect('Login','location');
        }
    }

    /**
        * This function list all the land minimun rate
        * @param NULL
        * @return void
     */
    public function Index()
    {
        if($this->authlibrary->HasModulePermission($this->module_code, "VIEW")){
            $data['page'] = 'list_all';
            $data['datas'] = $this->CommonModel->getData('land_category','ASC');
            $this->load->view('main', $data);
        }else{
            $this->session->set_flashdata('MSG_ACCESS','तपाईंको अनुमति अस्वीकृत गरिएको छ');
            redirect('Dashboard');
        }
    }

    /**
        * This function on ajaxcall load add form in modal**
        * @param NULL
        * @return void
     */
    public function add() {
        if($this->input->is_ajax_request()) {
            $data['fiscal_year'] = $this->CommonModel->getData('fiscal_year','DESC');
            $this->load->view('add', $data);
        } else {
            exit('No direct script allowed!');
        }
        
    }

    /**
        * This function on ajaxcall submit land area type data
     */ 
    public function Save() {
        if($this->input->is_ajax_request()) {
            $category = $this->input->post('category');
            $post_data = array(
                'category'      => $category,
                'added_by'      => $this->session->userdata('PRJ_USER_ID'),
                'added_on'    => convertDate(date('Y-m-d')),
            );
            $result = $this->CommonModel->insertData('land_category',$post_data);
            if($result) {
                $response = array(
                    'status'      => 'success',
                    'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                    'message'     => 'success'
                );
                 header("Content-type: application/json");
                 echo json_encode($response);
                 exit;
            } else {
                
            }
        }
    }

    /**
        * This function on ajaxcall load add form in modal**
        * @param $id int
        * @return void
     */
    public function edit() {
        if($this->input->is_ajax_request()) {
            $post_id = $this->input->post('id');
            $data['pageTitle'] = 'जग्गाको क्षेत्रगत किसिम थप्नुहोस';
            $data['row'] = $this->CommonModel->getDataByID('land_category',$post_id);
            $this->load->view('edit', $data);
        } else {
            exit('No direct script allowed!');
        }
    }

    /**
        * This function on ajaxcall update land area type data
     */
    public function Update() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $category = $this->input->post('category');
            $post_data = array(
                'category'=>$category
            );
            $result = $this->CommonModel->UpdateData('land_category',$id,$post_data);
            if($result) {
                $response = array(
                    'status'      => 'success',
                    'data'         => "सफलतापूर्वक सम्मिलित गरियो",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            } else {
                $response = array(
                    'status'      => 'error',
                    'data'         => "Oops something goes worng!!! Please try again",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
        }
    }

    /**
        * This function delete data from database.
        * check proper id is in format of not.
        * @param $id int pk
        * @return boolean.
     */
    public function delete() {
        if($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $result = $this->CommonModel->remove($id,'land_category');
            if($result) {
                $response = array(
                    'status'      => 'success',
                    'data'         => "सफलतापूर्वक हटाइयो",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            } else {
                $response = array(
                    'status'      => 'error',
                    'data'         => "Oops something goes worng!!! Please try again",
                    'message'     => 'success'
                );
                header("Content-type: application/json");
                echo json_encode($response);
                exit;
            }
        } else {
            exit('no direct script allowed!!!');
        }
    }
}