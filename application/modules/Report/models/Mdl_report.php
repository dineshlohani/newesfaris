<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_report extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    function __construct()
    {
        parent::__construct();
    }
   
    public function getDartaReport() {

        $this->db->select('uri, count(uri) as total_sifaris')->from('darta');
       // pp($this->session->userdata('ward_no'));
        if($this->session->userdata('mode') === 'user') {
            $this->db->where('ward_login', $this->session->userdata('ward_no'));
        }
        $this->db->group_by('uri');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDartaReportBySearch($uri=NULL,$from_date =NULL,$to_date=NULL,$ward_no =NULL) {
        $this->db->select('uri, count(uri) as total_sifaris')->from('darta');
        if(!empty($uri)) {
            $this->db->where('uri', $uri);
        }
        if(!empty($from_date)) {
            $this->db->where('nepali_darta_miti >=', $from_date);
        }
        if(!empty($to_date)) {
            $this->db->where('nepali_darta_miti <=', $to_date);
        }

        if($this->session->userdata('mode') == 'user') {
            $this->db->where('ward_login', $this->session->userdata('ward_no'));
        } else {
            if(!empty($ward_no)) {
                $this->db->where('ward_login' ,$ward_no);
            }
        }
        
        $this->db->group_by('uri');
        $query = $this->db->get();
        return $query->result();
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

    public function getChalaniReport() {

        $this->db->select('uri, count(uri) as total_sifaris')->from('chalani');
        if($this->session->userdata('mode') === 'user') {
            $this->db->where('ward_login', $this->session->userdata('ward_no'));
        }
         $this->db->group_by('uri');
         $query = $this->db->get();
         return $query->result();

        // $this->db->select('count(*) as total')->from('chalani');
        // $this->db->where('uri', $uri);
        // if($this->session->userdata('mode') == 'user') {
        //     $this->db->where('ward_login' ,$this->session->userdata('ward'));
        // }
        // $query = $this->db->get();
        // return $query->row();
    }
    public function getChalaniReportBySearch($uri = NULL,$from_date =NULL,$to_date=NULL,$ward_no =NULL) {
        $this->db->select('uri, count(uri) as total_sifaris')->from('chalani');
        if(!empty($uri)) {
            $this->db->where('uri', $uri);
        }
        if(!empty($from_date)) {
            $this->db->where('nepali_chalani_miti >=', $from_date);
        }
        if(!empty($to_date)) {
            $this->db->where('nepali_chalani_miti <=', $to_date);
        }

        if($this->session->userdata('mode') == 'user') {
            $this->db->where('ward_login', $this->session->userdata('ward_no'));
        } else {
            if(!empty($ward_no)) {
                $this->db->where('ward_login' ,$ward_no);
            }
        }
        
        $this->db->group_by('uri');
        $query = $this->db->get();
        return $query->result();
    }
}
