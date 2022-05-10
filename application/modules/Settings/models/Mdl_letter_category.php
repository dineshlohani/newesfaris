<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_letter_category extends CI_Model
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
//        $this->db->order_by("id", "asc");
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
    public function getAllByDistrict($district)
    {
//        $this->db->order_by("id", "asc");
      $query = $this->db->get_where($this->_tableName, array('district_id' => $district));

      if ($query->num_rows() >= 1) {
          return $query->result();
      } else {
          return FALSE;
      }
    }

    public function getByLocalBody($district)
    {
      $query = $this->db->get_where($this->_tableName, array('id' => $district));

      if ($query->num_rows() >= 1) {
          return $query->row();
      } else {
          return FALSE;
      }
    }


    public function getAllMenusOrder($id = NULL, $level = 0, $first_call = true) {
     //  $this->menuList .=  $first_call == true ? '<ol class="sortable">' : '<ol>';
     //  $call = $first_call == true ? false : false;
     //  $id = isset($id) ? $id : 0;
     //  $objectMenu=array();
     //  $this->db->select('m.id,m.name,m.order');
     //  $this->db->from('sifaris_order m');
     //  $this->db->where('m.id',$id);
     // // $this->db->where('m.location !=','O');
     //  $this->db->order_by('m.sifaris_order','ASC');
     //  $query=$this->db->get();
     //  if($query->num_rows()>0)
     //  {
     //    $objectMenu=$query->result();
     //  }
     //  foreach($objectMenu as $key => $tbl_value) :
     //    $menu_id = $tbl_value->id;
     //    $menu_title = stripslashes($tbl_value->menu_title);
     //    $menu_order = $tbl_value->order;
     //    $this->menuList .= '<li id="list_'.$menu_id.'"><div><span class="disclose"><span></span></span>'.$menu_title.'</div>';
     //    $this->getAllMenusOrder($menu_id, $level+1, false);
     //    $this->menuList .= '</li>';
     //  endforeach;
     //  $this->menuList .=  '</ol>';
     //  return $this->menuList;     
    }
}
