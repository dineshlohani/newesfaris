<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_charkilla_details extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    private $_tableName = "charkilla_details";
    /*------------------------------------------------------------------------------------------------------------------*/
    function __construct()
    {
        parent::__construct();
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    /*--------------------Save and Update Functions---------------------------------------------------------------------*/
    /*------------------------------------------------------------------------------------------------------------------*/
   public function alertBox($alert_msg, $redirect_link)
    {
        $alert = '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>';
        $alert .= '<script type="text/javascript">alert("'.$alert_msg.'");';
        if(!empty($redirect_link)):
        $alert .='window.location="'.$redirect_link.'";';
        endif;
        $alert .='</script>;';
        return $alert;
    }
    public function base64url_encode($data) {
      return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
    public function base64url_decode($data) {
      return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
    public function save($data)
    {
//        print_r($data);exit;
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
     public function getBykillaId($status)
    {
//        $this->db->where('type="fox" OR type="dog"');
        $query = $this->db->get_where($this->_tableName, array('killa_id' => $status));
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getByStatus($status)
    {
//        $this->db->where('type="fox" OR type="dog"');
        $query = $this->db->get_where($this->_tableName, array('status' => $status));

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function searchByWord($match)
    {
        $array = array(
                'form_id'           => $match,
                'land_owner_name'          => $match,
                'kitta_no'          => $match,
                );
        $this->db->or_like($array);
        $query = $this->db->get($this->_tableName);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getByDates($start_date,$end_date)
    {

        $condition = "date BETWEEN " . "'" . $start_date . "'" . " AND " . "'" . $end_date . "'";
        $this->db->select('*');
        $this->db->from($this->_tableName);
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
    public function deleteByKillaId($id)
    {
        if ($query = $this->db->delete($this->_tableName, array('killa_id' => $id))) {
            return true;
        } else {
            return false;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getTableName()
    {
        return $this->_tableName;
    }
}
