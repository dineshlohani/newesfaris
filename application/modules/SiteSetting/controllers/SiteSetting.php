<?php
class SiteSetting extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SiteSetting_mdl');
        $this->load->model('Settings/Mdl_state');
        $this->load->model('Settings/Mdl_district');
        $this->load->model('Settings/Mdl_local_body');
    }
    public function Index()
    { 
        redirect('SiteSetting/editSiteSetting');
    }

    public function editSiteSetting()
    {
        $query       = $this->SiteSetting_mdl->get_site_setting();
        $data['site_data']      = $query;
        $data['pagetitle']      = 'Site Setting';
        $data['title']          = 'Edit Site Setting';
        $data['page']           = 'editSiteSetting';
        $data['states']         = $this->Mdl_state->getAll();
        $data['districts']      = $this->Mdl_district->getAll();
        $data['locals']         = $this->Mdl_local_body->getAll();
        $this->load->view('User/header',$data);
        $this->load->view('editSiteSetting', $data);
        $this->load->view('User/footer');
    }

    public function update() {
        if(isset($_POST['submit'])){
            $result = $this->SiteSetting_mdl->update_site_settings();
            if($result == 1) {
                $this->session->set_flashdata('MSG_SUC_ADD', ' updated Successfully');
                redirect('SiteSetting');
            } else {
                 $this->session->set_flashdata('MSG_SUC_ADD', 'Error');
                redirect('SiteSetting');
            }
        }
    }

    public function RemovePalikaLogo() {
      //  pp('hello');
        $result = $this->SiteSetting_mdl->update_palika_logo();
        //pp($result);
        if($result == 1) {
            $this->session->set_flashdata('MSG_SUC_ADD', ' updated Successfully');
            redirect('SiteSetting');
        } else {
             $this->session->set_flashdata('MSG_SUC_ADD', 'Error');
            redirect('SiteSetting');
        }
    }
}
?>