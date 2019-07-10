<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of users
 *
 * @author Sunil
 *
 */
class Auth extends MY_Controller {

    private $emailConfig = array();
    function __construct(){
        parent::__construct();
        $this->output->set_template('login');
        $this->output->set_title('Admin Area');
        $this->load->model('categories/category');

        $configQuery = $this->db->get('site_config');
        $configRes = $configQuery->result();
        
        foreach ($configRes as $conf) {
            $this->emailConfig[$conf->config_name] = $conf->value;
        }

    }

    function index() {
        if ($this->session->userdata('logged_in')){
            redirect(base_url('users'));
        }
        $this->load->model('user');
        $this->load->model('authmodel');
        $this->load->library('user_agent');
        if ($this->agent->referrer()){
            $data['referrer'] = base64_encode($this->agent->referrer());
        }

        $error = '';
        if ($this->input->method(TRUE) === 'POST'){
            if ($this->authmodel->verify_validation()){
                $email = $this->input->post('email',true);
                $password = $this->input->post('password');
               // echo $email;
               // die;
                if ($this->authmodel->check_login($email,$password)){
                    $user_data = $this->user->get_user($email);
                    //print_r($user_data);die;
                    $user_id=$user_data->id;
                    $result=$this->authmodel->check_right($user_id);
                    $status=$result->status;
                    if ($status!=0){
                        
                        if ($user_data != false) {
                            $this->session->set_userdata('logged_in', $user_data);
                            $this->session->set_flashdata('success', 'You have successfully logged in.');
                            //Store Login Info
                            $this->authmodel->store_login_info($email);
                            //Redirect
                            $ref_url = base64_decode($this->input->post('referrer'));
                            if($user_data->user_role == 1){
                                redirect(base_url('index.php/dashboards'));
                            }else{
                                $uid = $_SESSION['logged_in']->id;
                                $query = "SELECT * FROM `users` WHERE `id`=$uid";
                             $data = $this->db->query($query);
                                 $x  =  $data->result_array();                       
                                 $y =  $x[0]['singup'];
                                 if($y==1){
                                redirect(base_url('users'));
                            }else{
                                  $sess_array = array(
            'id' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
         redirect(base_url('users/auth'));
                            }
                            }
                            

                        }else{
                            $error = 'Error';
                        }
                    }else{
                        $error = 'You have no Right to login';
                    }
                }else{
                    $error = 'Invalid Username or Password';
                }
            }else{
                $error = validation_errors();
            }
        }
        $data['error'] = $error;

        $this->load->view('login',$data);
    }





    public function logout(){
        $sess_array = array(
            'id' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $this->session->set_flashdata('success', 'Successfully Logout');
        redirect(base_url('users/auth'));
    }


    public function register(){
        $this->load->model('user');
        $this->load->model('authmodel');
        
        // $this->output->section('header','welcome/header');
        // $this->output->section('sidebar','welcome/sidebar');
        // $this->output->section('footer','welcome/footer');
        // $this->output->set_template('admin');
        $this->output->js("https://www.google.com/recaptcha/api.js");
        $this->output->set_title('Registration');

        if($this->authmodel->verify_validation()) {
            
            // $image = $this->user->image_upload('image');
            // $data['image'] = $image['file_name'];
            
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $name=$first_name.' '.$last_name;
            $user_email = $this->input->post('email');

            $params = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'password' => $this->input->post('password'),
                'category_id'=>$this->input->post('category_id'),
                'user_role' => 2
             );
             
            $this->user->add_user($params);
            
            $users=$this->user->get_administrator();
            $adminMessage = '<h2>New successful Registration</h2><br><p><strong>Name: </strong>'.$this->input->post('first_name').' '.$this->input->post('last_name').'<br><strong>Email: </strong>'.$this->input->post('email').'<br></p><br><br><p>Powered by: <strong>'.$this->emailConfig['site_title'].'</strong></p>';

            $userMessage = '<h2>Registration Successful</h2><br><p><strong>Name: </strong>'.$this->input->post('first_name').' '.$this->input->post('last_name').'<br><strong>Email: </strong>'.$this->input->post('email').'<br><strong>Password: </strong>'.$this->input->post('password').'<br></p><br><br><p>Powered by: <strong>'.$this->emailConfig['site_title'].'</strong></p>';
                        
            foreach($users as $user){
                $email=$user->email;
                $this->user->send_mail($email,$name,$user_email, $adminMessage);
            }
            $this->user->send_mail($user_email,$name,$user_email,$userMessage );
            
            redirect('users/index');
        }else{
            $data['user_roles'] = $this->user->get_user_roles();
            $data['category_names'] = $this->category->get_category_names();
            
            $this->load->view('registration',$data);
        }
    }

    public function forgot(){
        $this->load->model('user');
        $this->load->model('authmodel');
        $error = '';
        $this->output->set_title('Reset Password');

        if($this->authmodel->verify_validation()) {
            $email = $this->input->post('email');
            $this->authmodel->send_password_reset_mail($email);
            redirect('users/index');
        }else{
            $data['error'] = $error;
            $this->load->view('reset_password',$data);
        }
    }



    public function reset_password(){
        $this->load->model('user');
        $this->load->model('authmodel');
        $error = '';
        $this->output->set_title('Reset Password');

        if($this->authmodel->verify_validation()) {
            $email = $this->input->post('email');
            $otp = $this->uri->segment(4);

            $password = $this->input->post('password');
            // echo $otp;
            // die;
            if($this->authmodel->reset_password($email,$otp,$password)){
                $this->session->set_flashdata("reset_password","Password has been chnged successfully."); 
                redirect('users/auth');
            }
            
        }else{
            $error = validation_errors();
            $data['error'] = $error;
            $this->load->view('reset_password_verify',$data);
        }
    }


    public function changepassword(){
        $this->output->unset_template();
        if ($this->session->userdata('logged_in')){
            $this->load->model('user');
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $user_id = $this->session->userdata('logged_in')->id;
            $params['password'] = $password;
            $this->db->where('id', $user_id);
            if($this->db->update('users', $params)){
                echo '1';
            }else{
                echo '0';
            }
        }else{
            show_404();
        }
    }



}

/* End of file AuthModel_model.php */
/* Location: ./application/modules/users/controllers/AuthModel_model.php */