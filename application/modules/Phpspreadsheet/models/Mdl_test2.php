<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_test2 extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    private $_tableName = "test2";
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

    /*------------------------------------------------------------------------------------------------------------------*/
    /*--------------------Common Query Functions------------------------------------------------------------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getById($id)
    {
        $query = $this->db->get_where($this->_tableName, array('id' => $id));

        if ($query->num_rows() == 1) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getAll($order='created_at', $by='desc', $limit='', $offset='')
    {
        if (!empty($limit)) {
            $this->db->limit($limit);
        }
        if (!empty($offset)) {
            $this->db->offset($offset);
        }
        $this->db->order_by($order, $by);
        $query = $this->db->get($this->_tableName);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    /*--------------------Custom Query Functions------------------------------------------------------------------------*/
    public function getByCustom($query) // for only multiple query
    {
        $this->db->where($query);
        $query = $this->db->get($this->_tableName);

        if ($query->num_rows() >= 1) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*--------------------Delete Functions------------------------------------------------------------------------------*/
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
}
