<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_sawari_pass extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    private $_tableName = "sawari_pass";
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
    public function getAll($ward)
    {
//        $this->db->order_by("id", "asc");
        $query = $this->db->get_where($this->_tableName,array('ward_login' => $ward));

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function getAllData()
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
    public function getByStatus($status,$ward)
    {
//        $this->db->where('type="fox" OR type="dog"');
        $query = $this->db->get_where($this->_tableName, array('status' => $status, 'ward_login' => $ward));

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
                'land_owner_name'          => $match,
                'kitta_no'          => $match,
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
        $query = $this->db->get($this->_tableName);
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
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getTableName()
    {
        return $this->_tableName;
    }
}
