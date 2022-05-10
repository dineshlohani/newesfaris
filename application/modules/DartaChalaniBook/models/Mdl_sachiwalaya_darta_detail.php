<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_sachiwalaya_darta_detail extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    private $_tableName = "sachiwalaya_darta_details";
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
    public function getAll($order_by='desc')
    {
        $this->db->order_by('darta_no', $order_by);
        $query = $this->db->get_where($this->_tableName);
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
    public function getMaxDartaNo( )
    {
        $sql = "select MAX(darta_no) as max_id from ".$this->_tableName;

        $query = $this->db->query($sql);

        if ($query->num_rows() == 1) {
            $result = $query->row();
            return $result->max_id;
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/

    public function searchByWord($match, $order_by="desc")
    {
        $condition = "(";
        $array = array(
                'darta_no'  => $match,
                'nepali_darta_miti' => $match,
                'applicant_name'    => $match,
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
        $condition .= ")";
        $this->db->order_by('darta_no', $order_by);
        $this->db->where($condition);
        $query = $this->db->get($this->_tableName);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getByDates($start_date, $end_date, $order_by="desc")
    {
        $condition = "english_darta_miti BETWEEN " . "'" . $start_date . "'" . " AND " . "'" . $end_date . "'";
        $this->db->order_by('darta_no', $order_by);
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
     /*------------------------------------------------------------------------------------------------------------------*/
    public function getReservedDartaNos($is_muncipality, $ward=0)
    {
        if($is_muncipality == 1)
        {
            $array = array('applicant_name'=>"",
                            'letter_type'=>"",
                            'letter_subject'=>"",
                            'uri'=>"",
                            'is_muncipality' => '1'
                        );
        }
        else
        {
            $array = array('applicant_name'=>"",
                            'letter_type'=>"",
                            'letter_subject'=>"",
                            'uri'=>"",
                            'ward_login' => $ward
                        );
        }

        $query = $this->db->get_where($this->_tableName,$array);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getBySachiwalayId($id)
    {
        $query = $this->db->get_where($this->_tableName, array('sachiwalaya_id' => $id));
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

}
