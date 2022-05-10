<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_approve_wiwaran extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    private $_tableName = "approve_wiwaran";
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


    public function getByTapasil($id)
    {
        $query = $this->db->get_where('approval_tapasil', array('wiwaran_id' => $id));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function saveTapasil($post_data) {

        $this->db->trans_start();

        $this->db->insert_batch('approval_tapasil',$post_data);

        $this->db->trans_complete();        

        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;

    }

    public function RemoveTapasil($id)
    {
        if ($query = $this->db->delete('approval_tapasil', array('id' => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTapasil($post_array) {
        
        $this->db->trans_start();
        $this->db->update_batch('approval_tapasil',$post_array,'id');
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
}
