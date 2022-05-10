<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class GeneralSettings {
    public function __construct()
	{
		$this->ci =& get_instance();
		$this->referer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "";
		$this->onpage = $_SERVER['REQUEST_URI'];
		$site_info = $this->get_site_settings_info();
		$letter_head = $this->get_letter_head_info();
		$ward_info = $this->getWardInfo();
		if(empty($site_info)) {
			echo " !!!! Invalid Access !!!";
			exit;
		}
		/*-------------------------------------------------
		english constants
		---------------------------------------------------*/
		// define('SITE_OFFICE'       ,$site_info['state_np']);
		// define('SITE_WARD_OFFICE'  ,"नं वडा कार्यालय");
		// define('SITE_OFFICE'       ,$site_info['state_np']);
		// define('SITE_OFFICE'       ,$site_info['state_np']);
		// define('SITE_OFFICE'       ,$site_info['state_np']);
		// define('SITE_OFFICE'       ,$site_info['state_np']);
		// define('SITE_OFFICE'      ,$site_info['state_np']);
		// print_r($this->ci->session->userdata('ward_no'));
		// exit;
		define('SITE_OFFICE'       	 ,$site_info['palika_name']);

		define('SITE_WARD_OFFICE'  	 ,"नं वडा कार्यालय");

		define('SITE_SUB_ADD'  		 ,"");

		define('SITE_PALIKA'         ,$site_info['karay_palika_np']);

		define('SITE_ADDRESS'        , "");

		define('SITE_STATE'          , $site_info['state_np']);

		define('SITE_OFFICE_TYPE'    , 'गाउँपालिका');

		define('SITE_DISTRICT'       , $site_info['district_np']);

		define('SITE_SLOGAN'         , $site_info['palika_slogan']);

		if(empty($site_info['palika_logo'])) {
			$palika_logo = 'n/a';
			//define('SITE_SLOGAN', $ward_info['nara']);
		} else {
			$palika_logo = $site_info['palika_logo'];
			//define('SITE_SLOGAN', $site_info['palika_slogan']);
		}
		define('SITE_PALIKA_LOGO', $palika_logo);
		define('SITE_OFFICE_ENG'        ,$site_info['palika_name_en']);

		define('SITE_WARD_OFFICE_ENG'  	 ,"No. Ward Office");

		define('SITE_PALIKA_ENG'        	 , $site_info['karay_palika_en']);

		define('SITE_ADDRESS_ENG'            ,"Lamkhet");

		define('SITE_STATE_ENG'              ,$site_info['state_en']);

		define('SITE_OFFICE_TYPE_ENG'        , 'Rural Municipality');

		define('SITE_DISTRICT_ENG'           ,$site_info['district_en']);

		define('SITE_SLOGAN_ENG'            ,$site_info['palika_slogan_en']);

		// if($this->ci->session->userdata('mode') == 'user') {
		// 	define('SITE_SLOGAN_ENG', $ward_info['slogan']);
		// } else {
		// 	define('SITE_SLOGAN_ENG', $site_info['palika_slogan_en']);
		// }

		if($this->ci->session->userdata('mode') == 'user') {
			define('SITE_EMAIL', $ward_info['email']);
		} else {
			define('SITE_EMAIL', $site_info['email']);
		}
		define('SITE_WEBSITE', $site_info['website']);

		if($this->ci->session->userdata('mode') == 'user') {
			define('SITE_PHONE', $ward_info['phone_no']);
		} else {
			define('SITE_PHONE', $site_info['phone_no']);
		}

		//define('SITE_PHONE', $site_info['phone_no']);

		define('SITE_FB', $site_info['facebook']);

		define('SITE_OFFICE_FONT', $letter_head['site_office']);

		define('SITE_PALIKA_FONT', $letter_head['site_palika']);

		define('SITE_WEBSITE_FONT', $letter_head['site_website']);

		define('SITE_EMAIL_FONT', $letter_head['site_email']);

		define('SITE_SLOGAN_FONT', $letter_head['site_slogan']);
		
		define('SITE_WEBSITE_ALIGNMENT', $letter_head['site_website_alignment']);

		define('SITE_EMAIL_ALIGNMENT', $letter_head['site_email_alignment']);

		define('SITE_SLOGAN_ALIGMENT', $letter_head['site_slogan_alignment']);

		define('SITE_PHONE_ALIGNMENT', $letter_head['site_phone_alignment']);


		define('SITE_OFFICE_FONT_ENG', $letter_head['site_office_en']);

		define('SITE_PALIKA_FONT_ENG', $letter_head['site_palika_en']);

		define('SITE_WEBSITE_FONT_ENG', $letter_head['site_website_en']);

		define('SITE_EMAIL_FONT_ENG', $letter_head['site_email_en']);

		define('SITE_SLOGAN_FONT_ENG', $letter_head['site_slogan_en']);
		
		define('SITE_WEBSITE_ALIGNMENT_ENG', $letter_head['site_website_alignment_en']);

		define('SITE_EMAIL_ALIGNMENT_ENG', $letter_head['site_email_alignment_en']);

		define('SITE_SLOGAN_ALIGMENT_ENG', $letter_head['site_slogan_alignment_en']);

		define('SITE_PHONE_ALIGNMENT_ENG', $letter_head['site_phone_alignment_en']);
	} 
	

    public function get_site_settings_info()
	{
		$query = $this->ci->db->get("set_up");
		if ($query->num_rows() > 0) 
		{
			$data=$query->row_array();				
		}		
		$query->free_result();
		return $data;
	}

	public function get_letter_head_info() {
		$query = $this->ci->db->get("letter_head");
		if ($query->num_rows() > 0) 
		{
			$data=$query->row_array();				
		}		
		$query->free_result();
		return $data;
	}

	public function getWardInfo() {
		$this->ci->db->select('*')->from('settings_ward');
		$this->ci->db->where('name', $this->ci->session->userdata('ward_no'));
		$query = $this->ci->db->get();
		if($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}
}