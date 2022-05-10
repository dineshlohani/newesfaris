<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Mdl_user');
        $this->load->model('Settings/Mdl_ward');
        $this->load->model('Settings/Mdl_department');
        $this->load->model('Settings/Mdl_patra_item');
        $this->load->model('Settings/Mdl_patra_category');
    }
    /*------------------------------------------------------------------------------------------------------------------*/
    public function index()
    {
        if($this->is_logged_in() === FALSE)
        {
            redirect('login');
        }
        if(($this->session->userdata('mode') == 'superadmin') && !empty($this->uri->segment(1)))
        {
            $depart_id      = $this->uri->segment(2);
            $this_depart    = $this->Mdl_department->getById($depart_id);
            if($this_depart != FALSE)
            {
                $userdata   = array('department' => $depart_id);
                $this->session->set_userdata($userdata);
                redirect('index');
            }
        }
        if($this->session->userdata('mode') == 'user') {
            $order = 1;
        } elseif($this->session->userdata('mode')=='admin'){
            $order = 1;
        } else {
            $order = '';
        }
        $data['patra_name']     = $this->Mdl_patra_category->getAllWardMenus($order);
        $data['darta_count']    = $this->Mdl_user->getDartaCount();
        $data['chalani_count']  = $this->Mdl_user->getChalaniCount();
        $data['total_darta']    = $this->Mdl_user->getTotalDartaChart();
        //pp($data['total_darta']);
        $chart_data = array();
         if(!empty($data['total_darta'])) {
            foreach ($data['total_darta'] as $key => $value) {
                $patra_name = $this->Mdl_patra_category->getById($value->type);
                $chart_data[] = array(
                    'total' => $value->total,
                    'letter_subject' => !empty($patra_name)?$patra_name->name:'',
                );
            }
        }
        $data['total_chalani'] = $this->Mdl_user->getTotalChalaniChart();
        $chalani_chart = array();
        if(!empty($data['total_chalani'])) {
            foreach ($data['total_chalani'] as $key => $chalani) {
                $patra_name = $this->Mdl_patra_category->getById($chalani->type);
                $chalani_chart[] = array(
                    'total'          => $chalani->total,
                    'letter_subject' => !empty($patra_name)?$patra_name->name:'',
                );
            }
        }
        $data['dartajson'] = json_encode($chart_data);
        $data['chalanijson'] = json_encode($chalani_chart);
        $data['title'] = "Dashboard";
        $this->load->view('header',$data);
        // if($this->session->userdata('is_muncipality') == 1 ) {
        //     $this->load->view('dashboard');
        // } else {
        //     $this->load->view('ward_dashboard');
        // }
        // print_r($this->session->userdata());
        // exit;
        $this->load->view('dashboard');
        $this->load->view('footer');
    }
    /*-----------------------------------Login--------------------------------------------------*/
    public function login()
    {
        if(isset($_POST['submit']))
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user =$this->Mdl_user->check_login($username);
            if($user)
            {
                if(password_verify($password, $user->password))
                {
                    $this_ward = Modules::run('Settings/getWard',$user->ward);
                    $user_data = array(
                        'id'                => $user->id,
                        'username'          => $user->username,
                        'mode'              => $user->mode,
                        'ward_no'           => $user->ward,
                        'phone'             => $user->phone,
                        'email'             => $user->email,
                        'is_muncipality'    => $user->is_muncipality,
                        'department'        => $user->department,
                        'is_sachib'         => $user->is_sachib,
                        'address'           => !empty($this_ward->address)?$this_ward->address:'',
                        'address_eng'       => !empty($this_ward->address_eng)?$this_ward->address_eng:'',
                        'logged_in'         => TRUE
                    );
                    $this->session->set_userdata($user_data);
                    Modules::run('Settings/currency', 'FALSE');
                    //$this->session->set_flashdata('msg', 'Login Successfull');
                    redirect('index');
                }
                else
                {
                    $this->session->set_flashdata('err_msg', 'Username and Password mismatched');
                    redirect('login');
                }
            }
            else
            {
                $this->session->set_flashdata('err_msg', 'Username not found');
                redirect('login');

            }
        }
        $data['title'] = "Login";
        $this->load->view("userheader",$data);
        $this->load->view('login');
        $this->load->view("footer");
    }
    /*-----------------------------------Check Login--------------------------------------------------*/
    public function is_logged_in()
    {
        $user_data = ['id','username','mode','logged_in'];
        if($this->session->userdata('logged_in') != TRUE)
        {
            $this->session->unset_userdata($user_data);
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
    /*-----------------------------------Check Login--------------------------------------------------*/
    public function checkWardLogin()
    {
        // if($this->session->userdata('ward') == FALSE)
        // {
        //     $this->session->unset_userdata('ward');
        //     redirect('index');
        // }
        // else
        // {
        //     return TRUE;
        // }
    }
    /*-----------------------------------Log Out--------------------------------------------------*/
    public function logout()
    {
        $user_data = ['id','username','mode','email','ward','phone','logged_in'];
        $this->session->unset_userdata($user_data);
        redirect('login');
    }
    /*-----------------------------------Register and Change Password--------------------------------------------------*/
    public function register()
    {
        if($this->is_logged_in() === FALSE)
        {
            redirect('login');
        }
        if(isset($_POST['submit']))
        {
            $this->form_validation->set_rules('username','Username','required');
            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('name','Full Name','required');
            $this->form_validation->set_rules('repassword','Re-Password','required');
            $this->form_validation->set_rules('phone','Phone Number','required');

            $this->form_validation->set_rules('mode','User Mode','required');
            if( $_POST['is_muncipality'] == 1)
            {
                if($_POST['is_sachib'] == 1)
                {
                    $this->form_validation->set_rules('is_sachib','सचिवालय युजर हो / होइन','required');
                }
                else
                {
                    $this->form_validation->set_rules('department','Department','required');
                }
            }
            else
            {
                $this->form_validation->set_rules('ward','Ward','required');
            }
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg', validation_errors());
                redirect('register');

            }
            else
            {
                if($this->input->post('password')!= $this->input->post('repassword'))
                {
                    $this->session->set_flashdata('err_msg', 'Password Mismatched');
                    redirect('register');
                }
                $this_user = $this->Mdl_user->getByUsername($_POST['username']);
                if($this_user != FALSE)
                {
                    $this->session->set_flashdata('err_msg', 'Username already taken');
                    redirect(base_url().'register');
                }
                $data['name']        = $this->input->post('name');
                $data['username']    = $this->input->post('username');
                $data['password']    = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                $data['ward']        = $this->input->post('ward');
                $data['is_muncipality']    = $this->input->post('is_muncipality');
                if($_POST['is_muncipality'] == 1 && !empty($_POST['department']))
                {
                    $data['department']    = $this->input->post('department');
                    $data['is_sachib']    = '0';
                }
                else if($_POST['is_muncipality'] == 1 && empty($_POST['department']))
                {
                    $data['is_sachib']     = '1';
                }
                $data['phone']      = $this->input->post('phone');
                $data['email']      = $this->input->post('email');
                $data['mode']       = $this->input->post('mode');
                $data['created_at']  = date('Y-m-d H:i:sa');
                if ($this->Mdl_user->save($data))
                {
                    $this->session->set_flashdata('msg', 'Registered Succesfull');
                    redirect('register');
                }


            }
        }
        $send['departments']    = $this->Mdl_department->getAll();
        $send['wards'] = $this->Mdl_ward->getAll();
        $header['title'] = 'Register';
        $this->load->view('header',$header);
        $this->load->view('register',$send);
        $this->load->view('footer');
    }
    /*-----------------------------------Change Password----------------------------------------------------------------*/
    public function change_password()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("login");
        }
        $id = $this->uri->segment(2);
        if(!empty($id))
        {
            $mode = $this->session->userdata('mode');
            if($mode != 'superadmin')
            {
                $this->session->set_flashdata('err_msg', 'Permission Denied!');
                redirect(base_url().'dashboard');
            }
        }
        if(isset($_POST['submit']))
        {
            if(empty($id))
            {
                $this->form_validation->set_rules('old_password','Old Password','required');
            }

            $this->form_validation->set_rules('password','Password','required');
            $this->form_validation->set_rules('confirm','Re-Password','required');
            if($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('err_msg',validation_errors());
            }
            else
            {
                if($_POST['password']!= $_POST['confirm'])
                {
//                    echo alertBox("Password Mismatched","change_password");
                    $this->session->set_flashdata('err_msg', 'Password Mismatched');
                    redirect('change-password');
                }
                $old_password       = password_hash($this->input->post('old_password'), PASSWORD_BCRYPT);
                $data['password']   = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                if(!empty($id))
                {
                    $user = $this->Mdl_user->getById($id);
                }else
                {
                    $user = $this->getUser();
                }

                if ($user)
                {
                    if(!empty($id))
                    {
                        $this->Mdl_user->update($user->id,$data);
                        $this->session->set_flashdata('msg', 'Password Changed Successfully');
                        redirect(base_url().'user-view');
                    }
                    else
                    {
                        if (password_verify($this->input->post('old_password'),$user->password))
                        {
                            $this->Mdl_user->update($user->id,$data);
                            $user_data = array(
                                'id'        => $user->id,
                                'username'  => $user->username,
                                'mode'      => $user->mode,
                                'ward_no'   => $user->ward,
                                'phone'     => $user->phone,
                                'email'     => $user->email,
                                'is_muncipality' => $user->is_muncipality,
                                'department'    => $user->department,
                                'is_sachib'     => $user->is_sachib,
                                'logged_in' => TRUE
                            );
                            $this->session->set_userdata($user_data);
                            $this->session->set_flashdata('msg', 'Password Changed Successfully');
                            redirect('change-password');
                        }
                        else
                        {
                            $this->session->set_flashdata('err_msg', 'Old Password did not match');
                            redirect('change-password');
                        }
                    }

                }
                else
                {
                    $this->session->set_flashdata('err_msg', 'User not found');
                    redirect('change-password');
                }
            }
        }
        $header['title'] = 'User | Change Password';
        $this->load->view('header',$header);
        $this->load->view('change_password');
        $this->load->view('footer');
    }
    /*----------------------------------- All User View----------------------------------------------------------------*/
    public function user_view()
    {
        if(Modules::run("User/is_logged_in") === FALSE)
        {
            redirect("logout");
        }
        $usermode = $this->session->userdata('mode');
        if($usermode != "superadmin")
        {
            redirect('index');
        }
        $send['users']      = $this->Mdl_user->getAll();
        $header['title']    = 'Users';
        $this->load->view('header',$header);
        $this->load->view('user_view_page',$send);
        $this->load->view('footer');
    }
    /*-----------------------------------Get User----------------------------------------------------------------*/
    public function getUser($id = '')
    {
        if(empty($id))
        {
            $id     = $this->session->userdata('id');
        }

        $user   = $this->Mdl_user->getById($id);
        return $user;

    }
    /*----------------------------------------Get User Mode---------------------------------------------------------*/
    public function getUserMode()
    {
        $mode = $this->session->userdata('mode');
        return $mode;

    }
    /*------------------------------------------------------------------------------------------------------------------*/
     /*-----------------------------------edit user details----------------------------------------------------------------*/
    public function editUser($id)
    {
        if ($this->is_logged_in() === FALSE) {
            redirect('login');
        }
        $send['userdetail']     = $this->Mdl_user->getById($id);
        $send['departments']    = $this->Mdl_department->getAll();
        $send['wards']          = $this->Mdl_ward->getAll();
        $header['title']        = 'Edit User Details';
        $this->load->view('header', $header);
        $this->load->view('edit', $send);
        $this->load->view('footer');
    }
    public function updateuser()
    {
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('name', 'Full Name', 'required');
            $this->form_validation->set_rules('phone', 'Phone Number', 'required');

            $this->form_validation->set_rules('mode', 'User Mode', 'required');
            if ($_POST['is_muncipality'] == 1) {
                if ($_POST['is_sachib'] == 1) {
                    $this->form_validation->set_rules('is_sachib', 'सचिवालय युजर हो / होइन', 'required');
                } else {
                    $this->form_validation->set_rules('department', 'Department', 'required');
                }
            } else {
                $this->form_validation->set_rules('ward', 'Ward', 'required');
            }
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('err_msg', validation_errors());
                redirect('user-edit/'. $_POST['id']);
            } else {
                // if($this->input->post('password')!= $this->input->post('repassword'))
                // {
                //     $this->session->set_flashdata('err_msg', 'Password Mismatched');
                //     redirect('register');
                // }
                $this_user = $this->Mdl_user->getByUsernameE($_POST['username'], $_POST['id']);
                if ($this_user != FALSE) {
                    $this->session->set_flashdata('err_msg', 'Username already taken');
                    redirect(base_url() . 'register');
                }
                $data['name']        = $this->input->post('name');
                $data['username']    = $this->input->post('username');
                //$data['password']    = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                $data['ward']        = $this->input->post('ward');
                $data['is_muncipality']    = $this->input->post('is_muncipality');
                if ($_POST['is_muncipality'] == 1 && !empty($_POST['department'])) {
                    $data['department']    = $this->input->post('department');
                    $data['is_sachib']    = '0';
                } else if ($_POST['is_muncipality'] == 1 && empty($_POST['department'])) {
                    $data['is_sachib']     = '1';
                }
                $data['phone']      = $this->input->post('phone');
                $data['email']      = $this->input->post('email');
                $data['mode']       = $this->input->post('mode');
                $data['created_at']  = date('Y-m-d H:i:sa');

                if ($this->Mdl_user->update($_POST['id'], $data)) {
                    $this->session->set_flashdata('msg', 'Updated Succesfull');
                    redirect('user-view');
                }
            }
        }
    }
    /*------------------------------------------------------------------------------------------------------------------*/
}