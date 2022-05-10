<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library("email");
        $this->load->helper("email_helper");
        
//        $this->load->library("encryption");

    }
    /*--------Add and Update-------*/
    public function email_send($sender,$receiver,$subject,$message,$website="")
    {
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'pdmtcom@gmail.com',
            'smtp_pass' => 'pdmt$$##123',
            'mailtype'  => 'html',
            'charset'   => 'utf-8'
        );
        $this->email->initialize($config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");

        $this->email->to($receiver);
        $this->email->from($sender,$website);
        $this->email->subject($subject);
        $this->email->message($message);

        //Send email
        if($this->email->send())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}