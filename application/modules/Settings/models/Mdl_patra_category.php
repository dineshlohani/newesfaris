<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_patra_category extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    private $_tableName = "settings_patra_category";
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
    public function save_data($data,$id=0)
    {
        if($id != 0)
        {
            $a =  $this->update($id,$data);
        }
        else
        {
            $a = $this->save($data);
        }
        return $a;
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*--------------------Common Query Functions------------------------------------------------------------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getById($id)
    {
//        $this->db->where('type="fox" OR type="dog"');
        $query = $this->db->get_where($this->_tableName, array('id' => $id));

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function getAll()
    {
        $this->db->order_by("id", "asc");
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

     public function getAllWardMenus($order) {
        $this->db->select('u.*,count(rh.type) as cnt');
        $this->db->from( 'settings_patra_category u');
        $this->db->join('chalani rh','rh.type = u.id', 'left');
        if(!empty($order)){
            $this->db->where('u.sifaris_order', $order);
        }
        $this->db->group_by('u.id');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getTotalSifirasCount($type) {
        $this->db->where('type',$type);
		if($this->session->userdata('mode') == 'user') {
			$this->db->where('ward_login', $this->session->userdata('ward_no'));
		}
        $this->db->from("chalani");
        return $this->db->count_all_results();
    }
    /*------------------------------------------------------------------------------------------------------------------*/

}
