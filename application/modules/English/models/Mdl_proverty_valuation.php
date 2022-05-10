<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_proverty_valuation extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    //private $_tableName = "birth_certificate_en";
    /*------------------------------------------------------------------------------------------------------------------*/
    function __construct()
    {
        parent::__construct();
        $this->table = "property_valuation_en";
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*--------------------Save and Update Functions---------------------------------------------------------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
    public function save($data)
    {
       
        if ($query = $this->db->insert($this->table, $data)) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function update($id, $data)
    {

        if ($query = $this->db->update($this->table, $data, array('id' => $id))) {
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
        $query = $this->db->get_where($this->table, array('id' => $id));

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
        $ward = $this->session->userdata('ward_no');
        $query = $this->db->get_where($this->table,array('ward_login' => $ward));

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function delete($id)
    {
        if ($query = $this->db->delete($this->table, array('id' => $id))) {
            return true;
        } else {
            return false;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getByStatus($status)
    {
//        $this->db->where('type="fox" OR type="dog"');
        $query = $this->db->get_where($this->table, array('status' => $status));

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    public function searchByWord($match,$ward)
    {
        $condition = "(";
        $array = array(
                'form_id'           => $match,
                'owner_name'        => $match ,
                'org_name'          => $match,
                'darta_no'          => $match,
                'nepali_date'       => $match,
                'nepali_closed_date'=> $match
             );
            $count = count($array);
            $i=0;
        foreach($array as $key=>$value):
            if($i == $count-1) :

                $condition .= "`{$key}` LIKE '%".$match."%'";
            else:
                $condition .= "`{$key}` LIKE '%".$match."%' OR";
            endif;
            $i++;
        endforeach;
        $condition .= ") AND ward_login = {$ward}";

        $this->db->where($condition);
        $query = $this->db->get($this->table);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getByDates($start_date,$end_date,$ward)
    {

        $condition = "date BETWEEN " . "'" . $start_date . "'" . " AND " . "'" . $end_date . "' and ward_login = {$ward}";
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() >= 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getTableName()
    {
        return $this->table;
    }

    public function saverels($post_data) {

        $this->db->trans_start();

        $this->db->insert_batch('property_detail_en',$post_data);

        $this->db->trans_complete();        

        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;

    }
    public function getRelationShipDetails($id){
        $query = $this->db->get_where('property_detail_en', array('main_id' => $id));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function updateMembers($id, $post_array) {
        $this->db->trans_start();;
        $this->db->update_batch('property_detail_en',$post_array,'id');
        $this->db->trans_complete();
        // was there any update or error?
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            // any trans error?
            if ($this->db->trans_status() === FALSE) {
                return false;
            }
            return true;
        }
    }

    public function deleteSource($id)
    {
        if ($query = $this->db->delete('property_detail_en', array('id' => $id))) {
            return true;
        } else {
            return false;
        }
    }
}
