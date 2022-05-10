<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_LetterSetting extends CI_Model
{
    public function get_letter_head()
    {   $this->db->where('id',1);
        $query = $this->db->get('letter_head');
        if ($query->num_rows() > 0)
        {
           return $query->row();
        } 
        return false;
    }

    public function LetterHead(){
        $id = $this->input->post('id');
        $data = array(
            'site_office'                   => $this->input->post('site_office'),   
            'site_palika'                   => $this->input->post('site_palika'), 
            'site_website'                  => $this->input->post('site_website'),
            'site_website_alignment'        => $this->input->post('site_website_alignment'),
            'site_email'                    => $this->input->post('site_email'),
            'site_email_alignment'          => $this->input->post('site_email_alignment'),
            'site_slogan'                   => $this->input->post('site_slogan'),
            'site_slogan_alignment'         => $this->input->post('site_slogan_alignment'),
            'site_phone'                    => $this->input->post('site_phone'),
            'site_phone_alignment'          => $this->input->post('site_phone_alignment'),
            //for english format.
            'site_office_en'                   => $this->input->post('site_office_en'),   
            'site_palika_en'                   => $this->input->post('site_palika_en'), 
            'site_website_en'                  => $this->input->post('site_website_en'),
            'site_website_alignment_en'        => $this->input->post('site_website_alignment_en'),
            'site_email_en'                    => $this->input->post('site_email_en'),
            'site_email_alignment_en'          => $this->input->post('site_email_alignment_en'),
            'site_slogan_en'                   => $this->input->post('site_slogan_en'),
            'site_slogan_alignment_en'         => $this->input->post('site_slogan_alignment_en'),
            'site_phone_en'                    => $this->input->post('site_phone_en'),
            'site_phone_alignment_en'          => $this->input->post('site_phone_alignment_en'),
            'created_at'                    => date('Y-m-d h:i:sa')
        );
        if(empty($id)) {
            $this->db->insert('letter_head', $data); 
        } else {
            $this->db->where('id', $id);
            $this->db->update('letter_head', $data); 

        }
        return true;
    }
}
