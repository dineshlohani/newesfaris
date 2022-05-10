<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_report extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    function __construct()
    {
        parent::__construct();
    }
   
    public function getDartaReport($uri = NULL) {
        $this->db->select('count(*) as total')->from('darta');
        $this->db->where('uri', $uri);
        if($this->session->userdata('mode') == 'user') {
            $this->db->where('ward_login' ,$this->session->userdata('ward'));
        }
        $query = $this->db->get();
        return $query->row();
        // $this->db->select('count(t1.id) as total,t2.name as patra_name,t1.uri ')->from('darta t1');
        // $this->db->join('settings_patra_item t2','t2.uri = t1.uri','left');
        // $this->db->group_by('t1.uri');
        // // $this->db->where('uri', $uri);
        // if($this->session->userdata('mode') == 'user') {
        //     $this->db->where('t1.ward_login' ,$this->session->userdata('ward'));
        // }
        // $query = $this->db->get();
        // return $query->result_array();
    }

    public function getDartaReportBySearch($uri,$from_date =NULL,$to_date=NULL,$ward_no =NULL) {
        $this->db->select('count(*) as total')->from('darta');
        if(!empty($uri)) {
            $this->db->where('uri', $uri);
        }
        if(!empty($from_date)) {
            $this->db->where('nepali_darta_miti >=', $from_date);
        }
        if(!empty($to_date)) {
            $this->db->where('nepali_darta_miti <=', $to_date);
        }
        if(!empty($ward_no)) {
            $this->db->where('ward_login' ,$ward_no);
        }

        $query = $this->db->get();
        return $query->row();
    }
    /*-------------------------------------------------------------------------------------------------------*/
    public function getDartaList($uri,$from_date,$to_date,$ward_no) {
        $this->db->select('*')->from('darta');
        if(!empty($uri)) {
            $this->db->where('uri', $uri);
        }
        if(!empty($from_date)) {
            $this->db->where('nepali_darta_miti >=', $from_date);
        }
        if(!empty($to_date)) {
            $this->db->where('nepali_darta_miti <=', $to_date);
        }
        if(!empty($ward_no)) {
            $this->db->where('ward_login' ,$ward_no);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getChalaniReport($uri) {
        $this->db->select('count(*) as total')->from('chalani');
        $this->db->where('uri', $uri);
        if($this->session->userdata('mode') == 'user') {
            $this->db->where('ward_login' ,$this->session->userdata('ward'));
        }
        $query = $this->db->get();
        return $query->row();
    }
    public function getChalaniReportBySearch($uri,$from_date =NULL,$to_date=NULL,$ward_no =NULL) {
        $this->db->select('count(*) as total')->from('chalani');
        if(!empty($uri)) {
            $this->db->where('uri', $uri);
        }
        if(!empty($from_date)) {
            $this->db->where('nepali_chalani_miti >=', $from_date);
        }
        if(!empty($to_date)) {
            $this->db->where('nepali_chalani_miti <=', $to_date);
        }
        if(!empty($ward_no)) {
            $this->db->where('ward_login' ,$ward_no);
        }

        $query = $this->db->get();
        return $query->row();
    }
}
