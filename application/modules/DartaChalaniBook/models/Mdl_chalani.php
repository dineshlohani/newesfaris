<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_chalani extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    private $_tableName = "chalani";
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
    public function updateByFormId($form_id, $data)
    {

        if ($query = $this->db->update($this->_tableName, $data, array('form_id' => $form_id))) {
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
        $this->db->order_by("chalani_no", "desc");
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
    public function getMaxChalaniNo($is_muncipality, $ward=0)
    {
        $sql = "select MAX(chalani_no) as max_id from ".$this->_tableName." where";
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
    public function getByDartaId($id,$type =NULL)
    {
      $query = $this->db->get_where($this->_tableName, array('darta_id' => $id));

      if ($query->num_rows() == 1) {
          return $query->row();
      } else {
          return FALSE;
      }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getAllByWard($ward, $by='chalani_no', $order='desc')
    {
        $this->db->order_by($by, $order);
        $query = $this->db->get_where($this->_tableName,array('ward_login' => $ward, 'is_muncipality' => '0'));

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
     /*------------------------------------------------------------------------------------------------------------------*/
    public function getReservedChalaniNos($is_muncipality, $ward=0)
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
         $this->db->order_by("chalani_no", "desc");
        $query = $this->db->get_where($this->_tableName,$array);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
   public function getReservedChalaniNoByDate($date, $is_muncipality, $ward=0)
   {
       if($is_muncipality == 1)
       {
           $array = array('applicant_name'=>"",
                           'session_id' => 0,
                           'letter_subject'=>"",
                           'uri'=>"",
                           'is_muncipality' => '1',
                           'english_chalani_miti'=> $date
                       );
       }
       else
       {
           $array = array('applicant_name'=>"",
                           'session_id' => 0,
                           'letter_subject'=>"",
                           'uri'=>"",
                           'ward_login' => $ward,
                           'english_chalani_miti' => $date
                       );
       }
       $this->db->order_by('chalani_no','asc');
       $query = $this->db->get_where($this->_tableName,$array);
       if ($query->num_rows() >= 1) {
           return $query->result();
       } else {
           return FALSE;
       }
   }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getByDepartment($department)
    {

        $query = $this->db->get_where($this->_tableName, array('department' => $department));

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    /*------------------------------------------------------------------------------------------------------------------*/
    public function getAllByDepartmentAndUri($department, $table_name,$uri)
    {
        $sql    ="select * from ".$this->_tableName." as a inner join ".$table_name." as b on a.darta_id = b.id where a.department =".$department." and a.uri= '".$uri."'";
        $query  = $this->db->query($sql);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function searchChalaniByWord($match, $is_muncipality ,$ward=0)
    {
        $condition = "(";
        $array = array(
                'chalani_no'  => $match,
                'nepali_chalani_miti' => $match,
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
         $this->db->order_by("chalani_no", "desc");
        $this->db->where($condition);
        $query = $this->db->get($this->_tableName);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getChalaniByDates($start_date, $end_date, $is_muncipality, $ward=0)
    {
        $condition = "english_chalani_miti BETWEEN " . "'" . $start_date . "'" . " AND " . "'" . $end_date . "'";
        if($is_muncipality == 1)
        {
            $condition .= " and is_muncipality = '1'";
        }
        elseif($is_muncipality == 0)
        {
            $condition .= " and is_muncipality = '0' and ward_login = ".$ward;
        }
         $this->db->order_by("chalani_no", "desc");
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
    public function getAllByMuncipality($order_by="desc")
    {
        $this->db->order_by("chalani_no", $order_by);
        $query = $this->db->get_where($this->_tableName,array('is_muncipality' => '1'));

        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    //------------------------join between table and chalani
    /*------------------------------------------------------------------------------------------------------------------*/
    public function searchByWord($match, $table_name, $department, $uri)
    {
        $sql   = "select * from ".$this->_tableName." as a inner join ".$table_name." as b on a.darta_id = b.id where b.form_id like '%".$match."%' and a.department = ".$department." and a.uri = '".$uri."'";
        $query = $this->db->query($sql);
        if($query->num_rows() >= 1)
        {
            return $query->result();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getByDates($start_date, $end_date, $table_name, $department, $uri)
    {

        $sql    = "select * from ".$this->_tableName." as a inner join ".$table_name." as b on a.darta_id = b.id where b.date between '".$start_date."' and '".$end_date."' and a.department =".$department." and a.uri = '".$uri."'";
        $query  = $this->db->query($sql);
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
    public function getByChalaniNo($chalani_no, $is_muncipality, $ward=0)
    {
        $query = $this->db->get_where($this->_tableName, array('chalani_no' => $chalani_no, 'is_muncipality'=>$is_muncipality, 'ward' => $ward));
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function getByFormIdType($form_id, $type)
    {
        $query = $this->db->get_where($this->_tableName, array('form_id' => $form_id, 'chalani_type' => $type));
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }


    public function getNewData($start_date,$date) {
        $this->db->select('count(id) as Total')->from($this->_tableName);
        $this->db->where('nepali_chalani_miti >=', $start_date);
        $this->db->where('nepali_chalani_miti <=', $date);
        $query = $this->db->get();
            return $query->row();
    }

    public function getNewChalaniNo($is_muncipality, $ward=0, $start_date,$date )
    {
        $sql = "select MAX(chalani_no) as max_id from ".$this->_tableName." where";
        if($is_muncipality == 1)
        {
            $sql .= " is_muncipality = '1'";
        }
        else
        {
            $sql .= " ward_login = ".$ward." and is_muncipality = '0'";
        }
        //$sql .= "and nepali_chalani_miti >= '".$date."'";
        $sql .= "and nepali_chalani_miti >= '".$start_date."'";
        $sql .= "and nepali_chalani_miti <= '".$date."'";

        $query = $this->db->query($sql);

        if ($query->num_rows() == 1) {
            $result = $query->row();
            return $result->max_id;
        } else {
            return FALSE;
        }
    }
}
