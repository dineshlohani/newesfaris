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
        
        $this->db->select('uri');
        
        $this->db->from('settings_patra_item');
        //$this->db->join('chalani a', 'g.uri = a.uri');
       // $this->db->join('vts_users u', 'b.vubg_vusr_id = u.vusr_id');
        //$this->db->group_by('g.uri');
        // $this->db->order_by('u.vusr_user','asc');
        $this->db->where('category_id',$category_id);
        $this->db->where('flag',1);
        $query = $this->db->get();
        //pp($this->db->last_query());
        return $query->result();
        
        
        // print_r($this->session->userdata());
        // $this->db->select('s.uri, count(a.uri) as Total');
        // $this->db->from('settings_patra_item s');
        // $this->db->join('chalani a ', 's.uri = a.uri', 'left');
        // if($this->session->userdata('mode') !='superadmin') {
        //     $this->db->where('a.ward_login', $this->session->userdata('ward_no'));
        // }
        // $query = $this->db->get();
        // return $query->result();
        
        
    //     if($this->session->userdata('mode')=="superadmin") {
    //         $where = '0';
    //     } else {
    //         $where = $this->session->userdata('ward_login');
    //     }
    //     $sql = "SELECT s.uri, COUNT(a.uri) AS Total
    //             FROM settings_patra_item s
    //             LEFT JOIN chalani a ON s.uri = a.uri
    //             where s.category_id =".$category_id."
    //             GROUP BY s.uri";
    //  $query = $this->db->query($sql);
     //return $query->result();
    }
    
   public function getNameByUri($uri) {
        $this->db->select('category_id, name,uri')->from('settings_patra_item');
        $this->db->where('uri', $uri);
        $query = $this->db->get();
        return $query->row();
    }
    
    public function getTotalSifirasCountByUri($uri) {
        $this->db->where('uri',$uri);
		if($this->session->userdata('mode') == 'user') {
			$this->db->where('ward_login', $this->session->userdata('ward_no'));
		}
        $this->db->from("chalani");
        return $this->db->count_all_results();
    }
    
}
