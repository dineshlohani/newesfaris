<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_suchi_darta extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    private $_tableName = "suchi_darta";
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
    public function getAll()
    {
        $this->db->order_by("darta_no", "desc");
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
    public function getMaxDartaNo($is_muncipality, $ward=0 )
    {
        $sql = "select MAX(darta_no) as max_id from ".$this->_tableName." where";
        if($is_muncipality == 1)
        {
            $sql .= " is_muncipality = '1'";
        }
        else
        {
            $sql .= " ward_login = ".$ward." and is_muncipality = '0'";
        }
        $query = $this->db->query($sql);

        if ($query->num_rows() == 1) {
            $result = $query->row();
            return $result->max_id;
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getAllByWard($ward)
    {
        $this->db->order_by("darta_no", "desc");
        $query = $this->db->get_where($this->_tableName,array('ward_login' => $ward, 'is_muncipality' => '0'));

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getAllByMuncipality()
    {
        $this->db->order_by("darta_no", "desc");
        $query = $this->db->get_where($this->_tableName,array('is_muncipality' => '1'));

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function searchByWord($match, $is_muncipality ,$ward=0)
    {
        $condition = "(";
        $array = array(
                'darta_no'  => $match,
                'nepali_darta_miti' => $match,
                'applicant_name'    => $match

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
        if($is_muncipality == 1)
        {
            $condition .= " AND is_muncipality = '1'";
        }
        elseif($is_muncipality == 0)
        {
            $condition .= " AND is_muncipality = '0' and ward_login =".$ward;
        }
        $this->db->order_by("darta_no", "desc");
        $this->db->where($condition);
        $query = $this->db->get($this->_tableName);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getByDates($start_date, $end_date, $is_muncipality, $ward=0)
    {
        $condition = "english_darta_miti BETWEEN " . "'" . $start_date . "'" . " AND " . "'" . $end_date . "'";
        if($is_muncipality == 1)
        {
            $condition .= " and is_muncipality = '1'";
        }
        elseif($is_muncipality == 0)
        {
            $condition .= " and is_muncipality = '0' and ward_login = ".$ward;
        }
        $this->db->order_by("darta_no", "desc");
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
                            'session_id' => 0,
                            'letter_subject'=>"",
                            'uri'=>"",
                            'is_muncipality' => '1'
                        );
        }
        else
        {
            $array = array('applicant_name'=>"",
                            'session_id' => 0,
                            'letter_subject'=>"",
                            'uri'=>"",
                            'ward_login' => $ward
                        );
        }

        $query = $this->db->get_where($this->_tableName,$array);
        // echo $this->db->last_query();exit;
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
   public function getReservedDartaNoByDate($date, $is_muncipality, $ward=0)
   {
       if($is_muncipality == 1)
       {
           $array = array('applicant_name'=>'',
                            'session_id' => 0,
                           'letter_subject'=>'',
                           'uri'=>'',
                           'is_muncipality' => '1',
                           'english_darta_miti' => $date
                       );
       }
       else
       {
           $array = array('applicant_name'=>'',
                            'session_id' => 0,
                           'letter_subject'=>'',
                           'uri'=>'',
                           'is_muncipality' => 0,
                           'english_darta_miti' => $date,
                           'ward_login' => $ward
                       );
       }
        $this->db->order_by("darta_no", "asc");
       $query = $this->db->get_where($this->_tableName,$array);
       if ($query->num_rows() >= 1) {
           return $query->result();
       } else {
           return FALSE;
       }
   }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getByDartaNo($darta_no, $is_muncipality, $ward=0)
    {
        $query = $this->db->get_where($this->_tableName, array('darta_no' => $darta_no, 'is_muncipality'=>$is_muncipality, 'ward' => $ward));
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getByFormId($id)
    {
        $query = $this->db->get_where($this->_tableName, array('form_id' => $id));
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    //------------ Maujuda Suchi Darta
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getAllMaujudaSuchi()
    {
        $query = $this->db->get_where($this->_tableName, array('maujuda_id!='=> 0));

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function searchMaujudaByWord($match, $is_muncipality ,$ward=0)
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
        if($is_muncipality == 1)
        {
            $condition .= " AND is_muncipality = '1' AND maujuda_id != 0" ;
        }
        elseif($is_muncipality == 0)
        {
            $condition .= " AND is_muncipality = '0' and ward_login =".$ward." AND maujuda_id != 0";
        }

        $this->db->where($condition);
        $query = $this->db->get($this->_tableName);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getMaujudaByDates($start_date, $end_date, $is_muncipality, $ward=0)
    {
        $condition = "english_darta_miti BETWEEN " . "'" . $start_date . "'" . " AND " . "'" . $end_date . "'";
        if($is_muncipality == 1)
        {
            $condition .= " and is_muncipality = '1'";
        }
        elseif($is_muncipality == 0)
        {
            $condition .= " and is_muncipality = '0' and ward_login = ".$ward." and maujuda_id != 0";
        }
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
}
