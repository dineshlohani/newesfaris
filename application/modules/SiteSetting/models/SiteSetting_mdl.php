<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class SiteSetting_mdl extends CI_Model 
{
	public function __construct() 
	{
		parent::__construct();
	}

	public function get_site_setting()
	{	$this->db->where('id',1);
		$query = $this->db->get('set_up');
		if ($query->num_rows() > 0)
		{
		   return $query->row();
		} 
		return false;
	}

	public function update_site_settings($id = NULL)
	{ 
		$id 				 	= $this->input->post('id');
		$palika_logo         	= $_FILES['palika_logo']['name'];
        $sarkar_logo         	= $_FILES['sarkar_logo']['name'];
        $old_palika_logo 	    = $this->input->post('old_palika_logo');
        $old_sarkar_logo 	    = $this->input->post('old_sarkar_logo');
        $upload_path 		 	= "assets/images/icons/";

        if(!empty($_FILES['palika_logo']['name'])) {
        	$p_logo = $palika_logo;
        } else {
        	$p_logo = $old_palika_logo;
        }

        if(!empty($_FILES['sarkar_logo']['name'])) {
        	$s_logo = $sarkar_logo;
        } else {
        	$s_logo = $old_sarkar_logo;
        }

       	// echo $p_logo;
       	// pp($s_logo);
        if(!empty($_FILES['palika_logo']['name'])) {

        	$config = array(
        		'upload_path'=>$upload_path,
        		'allowed_types'=> "jpg|png|gif|PNG|png",
        		'overwrite' => TRUE,
        		'file_name' => $p_logo,
        	);
        	$this->load->library('upload');
        	$this->upload->initialize($config);
        	if(!$this->upload->do_upload('palika_logo')) {
        		$error =  'Could Not upload'.$this->upload->display_errors();
        		$this->session->set_flashdata('ERR_UPLOAD',$error);
        		redirect('SiteSetting/editSiteSetting');
        	} else{
        		$this->upload->do_upload();
        	}
        }

        if(!empty($_FILES['sarkar_logo']['name'])) {
        	$config = array(
        		'upload_path'=>$upload_path,
        		'allowed_types'=> "jpg|png|gif|PNG|png",
        		'overwrite' => TRUE,
        		'file_name' => $s_logo,
        	);
        	$this->load->library('upload');
        	$this->upload->initialize($config);
        	if(!$this->upload->do_upload('sarkar_logo')) {
        		$error =  'Could Not upload'.$this->upload->display_errors();
        		$this->session->set_flashdata('ERR_UPLOAD',$error);
        		redirect('SiteSetting/editSiteSetting');
        	} else{
        		$this->upload->do_upload();
        	}
        }

		$data = array(
            'palika_name' 			=> $this->input->post('palika_name_np'),
			'palika_name_en' 		=> $this->input->post('palika_name_en'),	
			'karay_palika_np' 		=> $this->input->post('karay_palika_np'),		   
			'karay_palika_en' 		=> $this->input->post('karay_palika_en'),
			'state_np' 				=> $this->input->post('state_np'),
			'state_en' 				=> $this->input->post('state_en'),
			'district_np' 			=> $this->input->post('district_np'),
			'district_en' 			=> $this->input->post('district_en'),
			'sarkar_logo' 			=> $s_logo,
			'palika_logo' 			=> $p_logo,
			'palika_slogan' 		=> $this->input->post('palika_slogan'),
			'palika_slogan_en' 		=> $this->input->post('palika_slogan_en'),
			'website' 				=> $this->input->post('website'),
			'phone_no' 				=> $this->input->post('phone_no'),
			'email' 				=> $this->input->post('email'),
			'facebook' 				=> $this->input->post('facebook'),
			'created_at' 			=> date('Y-m-d h:i:sa')
        );
       	if(empty($id)) {
			$this->db->insert('set_up', $data); 
       	} else {
       		$this->db->where('id', $id);
			$this->db->update('set_up', $data); 

       	}
		return true;
	}

    public function update_palika_logo($id = NULL)
    { 
        $data = array(
            'palika_logo'           => '',
        );
        $this->db->where('id', 1);
        $this->db->update('set_up', $data); 
        return true;
    }

}

