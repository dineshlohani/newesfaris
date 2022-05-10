<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_user extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    private $_tableName = "user";
    /*------------------------------------------------------------------------------------------------------------------*/
    function __construct()
    {
        parent::__construct();
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*--------------------Save and Update Functions---------------------------------------------------------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function save($data)
    {
        if ($query = $this->db->insert($this->_tableName, $data)) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function update($id, $data)
    {
        if ($query = $this->db->update($this->_tableName, $data, array('id' => $id))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*--------------------Common Query Functions------------------------------------------------------------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getById($id)
    {
        $query = $this->db->get_where($this->_tableName, array('id' => $id));

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    public function check_login($user)
    {
//        $this->db->where('type="fox" OR type="dog"');
        $query = $this->db->get_where($this->_tableName, array('username' => $user));
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getAll()
    {
        //$this->db->where('department !=',99);
        $this->db->order_by('id','asc');
        $query = $this->db->get($this->_tableName);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function delete($id)
    {
        if ($query = $this->db->delete($this->_tableName, array('id' => $id))) {
            return true;
        } else {
            return false;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getUserByMuncipality($is_muncipality)
    {
        $this->db->order_by("created_at", "desc");
        $query = $this->db->get_where($this->_tableName,array('is_muncipality' => $is_muncipality ));

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else { 
            
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getAllSachibs($order='created_at', $by='desc')
    {
        $this->db->order_by($order, $by);
        $query = $this->db->get_where($this->_tableName,array('is_sachib' => '1'));
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getByCols($array, $order='created_at', $by='desc')
    {
        $this->db->order_by($order, $by);
        $query = $this->db->get_where($this->_tableName,$array);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getByUsername($username)
    {
        $query = $this->db->get_where($this->_tableName, array('username' => $username));
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    
     /*------------------------------------------------------------------------------------------------------------------*/
    public function getByDepartment($department)
    {
        $query = $this->db->get_where($this->_tableName, array('department' => $department));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function getByUsernameE($username, $id)
    {
        $this->db->select('username')->from($this->_tableName);
        $this->db->where('username', $username);
        $this->db->where('id !=', $id);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    
    /*---------------------------------------------------------------------------------------
    ---------------------------------------------------*/
    public function getTotalCount($table) {
        if($this->session->userdata('mode') === 'user') {
            $this->db->where('ward_login', $this->session->userdata('ward_no'));
        }
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    /*---------------------------------------------------------------------------------------
    ---------------------------------------------------*/
    public function getWard() {
        $this->db->distinct();
        $this->db->select('ward');
        $this->db->from($this->_tableName);
        $this->db->order_by('ward', 'ASC');
        $query =  $this->db->get();
        return $query->result();
    }

    //get chart data for palika login/department
    // public function getDartaChartForPalika() {

    // }
    
    public function getTotalDartaChart() {
        if($this->session->userdata('mode') == 'user') {
            $ward = $this->session->userdata('ward_no');
            $sql = 'SELECT count(*) as total, type from darta where ward_login = "'.$ward.'" group by type';
        } else if($this->session->userdata('mode')=='administrator') {
            $sql = 'SELECT count(*) as total, type from darta where ward_login = 0 group by type';
        } else {
            $sql = 'SELECT count(*) as total, type from darta group by type';
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getTotalChalaniChart() {

        if($this->session->userdata('mode') == 'user') {
            $ward = $this->session->userdata('ward_no');
            $sql = 'SELECT count(*) as total, type from darta where ward_login = "'.$ward.'" group by type';
        } else if($this->session->userdata('mode')=='administrator') {
            $sql = 'SELECT count(*) as total, type from darta where ward_login = 0 group by type';
        } else {
            $sql = 'SELECT count(*) as total, type from darta group by type';
        }
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function getDartaCount() {
        if($this->session->userdata('mode') === 'user') {
            $this->db->where('ward_login', $this->session->userdata('ward_no'));
        }
        if($this->session->userdata('mode') === 'administrator') {
            $this->db->where('department', $this->session->userdata('department'));
        }
        $this->db->from('darta');
        return $this->db->count_all_results();
    }

    public function getChalaniCount() {
        if($this->session->userdata('mode') === 'user') {
            $this->db->where('ward_login', $this->session->userdata('ward_no'));
        }
        $this->db->from('chalani');
        return $this->db->count_all_results();
    }
}