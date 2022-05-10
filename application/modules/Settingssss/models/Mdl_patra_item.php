<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_patra_item extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    private $_tableName = "settings_patra_item";
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
    public function getAll($order_by=false)
    {
        $this->db->order_by('category_id', 'ASC');
        
        $query = $this->db->get($this->_tableName);

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function getAllByCategory($id)
    {
       // $this->db->order_by('category_id', 'ASC');
        $this->db->where('category_id', $id);
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
    public function getByURI($uri)
    {
        $query = $this->db->get_where($this->_tableName, array('uri' => $uri));

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getByCategoryId($category_id){
        $query = $this->db->get_where($this->_tableName, array('category_id' => $category_id));
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function getAllWardSubMenus($category_id) {

        $sql = "SELECT s.id, s.name, s.uri, COUNT(a.uri) AS Total
                FROM settings_patra_item s
                LEFT JOIN chalani a ON s.uri = a.uri
                where category_id ='$category_id'
                GROUP BY s.uri";
        // $this->db->select('u.id,u.uri,u.name, count(n.uri as ctn')->from('settings_patra_item u');
        // $this->db->join('chalani n','n.uri = u.uri','left');
        // $this->db->where('u.category_id', $category_id);
        // $this->db->group_by('u.uri');
        // $query=$this->db->get();
        // return $query->result();
    //     $sql = 'SELECT
    //     u.*, 
    //     COUNT(rh.type) AS cnt
    //     FROM
    //     settings_patra_item u
    //     LEFT JOIN
    //     chalani rh
    //     ON (rh.uri = u.uri)
    //     where category_id = '."$category_id".'
    //     GROUP BY
    //     u.uri
    //     ORDER BY
    //     u.id ASC';
     $query = $this->db->query($sql);
    //$result = $this->db->get();
     return $query->result();
    }

}
