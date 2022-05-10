<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_notification');

        $this->load->model('DartaChalaniBook/Mdl_darta');
        $this->load->model('DartaChalaniBook/Mdl_chalani');


        $this->load->model('Settings/Mdl_department');
        $this->load->helper('functions_helper');

    }
    /*--------------------------------------------------------------------------------------------------------*/
    /*------------ Get Notifications ----------*/
    /*--------------------------------------------------------------------------------------------------------*/
    public function getNotSeenNotification($department_id)
    {
        if($this->session->userdata('is_muncipality') != 1)
        {
            return FALSE;
        }
        $notifications = $this->Mdl_notification->getByToDepartmentIsSeen($department_id, '0');
        if($notifications != FALSE)
        {
            return $notifications;
        }
        else {
            return FALSE;
        }
    }
    /*--------------------------------------------------------------------------------------------------------*/
    /*--------------------------------------------------------------------------------------------------------*/
    public function notification_view()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("logout");
        }
        if(empty($this->session->userdata('department')))
        {
            redirect('index');
        }
        $this_depart = $this->Mdl_department->getById($this->session->userdata('department'));
        if($this_depart == FALSE)
        {
            redirect('logout');
        }
        $send['notifications']    = $this->Mdl_notification->getByToDepartment($this_depart->id);
        $header['title']    = "Notifications";
        $this->load->view('User/header',$header);
        $this->load->view('notification_page',$send);
        $this->load->view('User/footer');
    }
    /*--------------------------------------------------------------------------------------------------------*/
}
