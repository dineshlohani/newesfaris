<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_ghar_jagga_namsari extends CI_Model
{
    /*------------------------------------------------------------------------------------------------------------------*/
    private $_tableName = "ghar_jagga_namsari";
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
                'applicant_name'    => $match,
                'owner_name'        => $match ,
                'hakdar_ko_name'    => $match,
                'kitta_no'          => $match,
                'biggha'            => $match,
                'kattha'            => $match,
                'dhur'              => $match,
                'nepali_date'       => $match
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
    /*---------------------------------------------------------------------------------------------
    hakdar ko details
    ----------------------------------------------------------------------------------------------*/
    public function saveHakdar($data)
    {
        if ($query = $this->db->insert('ghar_jagga_hakdar', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function getHakdarById($id)
    {
        $query = $this->db->get_where('ghar_jagga_hakdar', array('id' => $id));

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

   
    public function getAllHakdar($id)
    {
        $query = $this->db->get_where('ghar_jagga_hakdar',array('entry_id' => $id));

        if ($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function saveJaggaWiwarn($data)
    {
        if ($query = $this->db->insert('naamsari_jagga_wiwaran', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getJaggaWiwarnById($id)
    {
        $query = $this->db->get_where('naamsari_jagga_wiwaran', array('id' => $id));

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

   
    public function getAllJaggaWiwarn($id)
    {
        $query = $this->db->get_where('naamsari_jagga_wiwaran',array('entry_id' => $id));

        if ($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function updateHakdar($id, $post_array) {
        $this->db->trans_start();;
        $this->db->update_batch('ghar_jagga_hakdar',$post_array,'id');
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

    public function savehakdars($post_data) {

        $this->db->trans_start();

        $this->db->insert_batch('ghar_jagga_hakdar',$post_data);

        $this->db->trans_complete();        

        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;

    }

    public function RemoveHakdar($id)
    {
        if ($query = $this->db->delete('ghar_jagga_hakdar', array('id' => $id))) {
            return true;
        } else {
            return false;
        }
    }

    //RemoveJagga
    public function RemoveJagga($id)
    {
        if ($query = $this->db->delete('naamsari_jagga_wiwaran', array('id' => $id))) {
            return true;
        } else {
            return false;
        }
    }


    public function updateJaggas($id, $post_array) {
        $this->db->trans_start();;
        $this->db->update_batch('naamsari_jagga_wiwaran',$post_array,'id');
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

    public function saveJaggas($post_data) {

        $this->db->trans_start();

        $this->db->insert_batch('naamsari_jagga_wiwaran',$post_data);

        $this->db->trans_complete();        

        return ($this->db->trans_status() === FALSE)? FALSE:TRUE;

    }
}
