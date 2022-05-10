<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_letter_subject extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    private $_tableName = "settings_letter_subject";
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
    public function getByType($type, $order='created_at', $by= 'desc')
    {
        $this->db->order_by($order, $by);
        $query = $this->db->get_where($this->_tableName, array('letter_type' => $type));
        if($query->num_rows() >=1 )
        {
            return $query->result();
        }else {
            return FALSE;
        }
    }

     /*------------------------------------------------------------------------------------------------------------------*/
    public function getByPatraId($id)
    {
        //$this->db->where('type="fox" OR type="dog"');
        $query = $this->db->get_where($this->_tableName, array('patra_id' => $id));

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
}