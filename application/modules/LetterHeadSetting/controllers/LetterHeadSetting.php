<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LetterHeadSetting extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_LetterSetting');
        $this->load->model('DartaChalaniBook/Mdl_darta');
        $this->load->model('DartaChalaniBook/Mdl_chalani');
        $this->load->model('Settings/Mdl_department');
        $this->load->helper('functions_helper');

    }
    /*--------------------------------------------------------------------------------------------------------*/
    /*------------ Get Notifications ----------*/
    /*--------------------------------------------------------------------------------------------------------*/
    public function Settings() {
        if(Modules::run("User/is_logged_in") === FALSE)
            {
                redirect("login");
            }
            Modules::run("User/checkWardLogin");
            $data['title'] = "Letter Head | Settings";
            $data['letter_head'] = $this->Mdl_LetterSetting->get_letter_head();
            $this->load->view('User/header',$data);
            $this->load->view('list_setting');
            $this->load->view('User/footer');
    }
    public function create() {
        if(isset($_POST['submit'])){
            $result = $this->Mdl_LetterSetting->LetterHead();
            if($result == 1) {
                $this->session->set_flashdata('msg', ' updated Successfully');
                redirect('LetterHeadSetting/Settings');
            } else {
               $this->session->set_flashdata('err_msg', 'Error');
               redirect('LetterHeadSetting/Settings');
           }
        }
    }
    /*--------------------------------------------------------------------------------------------------------*/
}
