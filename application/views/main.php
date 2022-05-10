<?php
$this->load->view('User/header');
(isset($page))?$this->load->view($page):'';
 $this->load->view('User/footer');