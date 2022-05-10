<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FileUpload extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function set_upload_options($path,$file_type="")
    {
        //upload an image options
        $config = array();
        $config['upload_path']      = $path;
        if(!file_exists($config['upload_path']  ))
        {
            mkdir($config['upload_path']  , 0777, true);
        }
        if($file_type != "")
        {
            $config['allowed_types'] = $file_type;
            // image_type = 'gif|jpg|png';
        }
        else
        {
            $config['allowed_types'] = "*";
        }
        $config['max_size']         = '5000';
        $config['overwrite']        = FALSE;

        return $config;
    }
}