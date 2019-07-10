<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**

 * User class.

 *

 * @extends CI_Model

 */

class Authmodel extends CI_Model {



    private $table = 'users';

    public function __construct() {

        parent::__construct();
        $this->load->library('form_validation');
        $this->form_validation->CI =& $this;

    }



    public function get_users(){

        $users[] = array(

            'name'  =>  'test 1',

            'email' =>  'test1@gmail.com'

        );

        $users[] = array(

            'name'  =>  'test 2',

            'email' =>  'test2@gmail.com'

        );

        return $users;

    }



    public function image_upload(){

        $config['upload_path']          = './uploads/profile_pictures/';

        $config['allowed_types']        = 'gif|jpg|png';

        $config['max_size']             = 1024;

        $config['file_name']            = time();

        if(!is_writable($config['upload_path'])){

            chmod($config['upload_path'], 777);

        }



        $this->load->library('upload', $config);



        if ( ! $this->upload->do_upload('image')){

            $ret['status'] = false;

            $ret['error'] = $this->upload->display_errors();

        }

        else{

            $data =  $this->upload->data();

            $ret['status'] = true;

            $ret['file_name'] = $data['file_name'];

        }

        return $ret;

    }





    //Backend Validation

    public function verify_validation(){

       

        $action =  $this->router->method;

        if ($action == 'index'){

            $this->form_validation->set_rules('email', 'Username', 'trim|required');

            $this->form_validation->set_rules('password', 'Password', 'trim|required');

        }
        if ($action == 'register') {
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[10]|max_length[15]|is_unique[users.phone]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
            $this->form_validation->set_rules('g-recaptcha-response','Captcha','callback_recaptcha');
            //$this->form_validation->set_rules('user_role', 'User Role', 'trim|required');
        }
        if($action == 'forgot'){
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        }

        if($action == 'reset_password'){
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            //$this->form_validation->set_rules('otp', 'OTP', 'trim|required');
            $this->form_validation->set_rules('password', 'Email', 'trim|required');
        }

        if ($this->form_validation->run() == FALSE) {

            return FALSE ;

        } else {

            return TRUE;

        }

    }


    public function recaptcha($str)
      {
    

        $google_url="https://www.google.com/recaptcha/api/siteverify";
          $secret='6Lf11ZAUAAAAABMUoqEUsPoR5UnmiRdbb5JspQu3';
          $ip=$_SERVER['REMOTE_ADDR'];
          $url=$google_url."?secret=".$secret."&response=".$str."&remoteip=".$ip;
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($curl, CURLOPT_TIMEOUT, 10);
          curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
          $res = curl_exec($curl);
          curl_close($curl);
          $res= json_decode($res, true);
          //reCaptcha success check
          if($res['success'])
          {
            return TRUE;
          }
          else
          {
            $this->form_validation->set_message('recaptcha', 'The reCAPTCHA field is telling me that you are a robot. Shall we give it another try?');
            return FALSE;
          }
      }


    public function send_password_reset_mail($email){
        $configQuery = $this->db->get('site_config');
        $configRes = $configQuery->result();
        $emailConfig = array();
        foreach ($configRes as $conf) {
            $emailConfig[$conf->config_name] = $conf->value;
        }

        $from_email= $emailConfig['admin_email'];
        $sender_name= $emailConfig['email_sender_name'];

        $query = $this->db->get_where('users',array('email' => $email));
        if($query){
            $user = $query->result();
            if(count($user) > 0){

                $otp = rand(1111,9999);

                $this->db->set('otp',$otp);
                $this->db->where('email',$email);
                $res = $this->db->update('users');
                if($res){
                    
                    $to_email = $email; 
                    $msg = '<h3>Password Reset</h3><br/><p>You have requested for password reset. </p><br/><p><strong><a href="'.base_url().'users/auth/reset_password/'.$otp.'">Click Here</a></strong> to Reset Password</p>';
                    
                    //Load email library 
                    $this->load->library('email'); 
                    $this->email->set_mailtype("html");
                    $this->email->from($from_email, $sender_name); 
                    $this->email->to($to_email);
                    $this->email->subject('Password Reset Email'); 
                    $this->email->message($msg); 
              
                    //Send mail 
                    if($this->email->send()) {
                        $this->session->set_flashdata("email_sent","Email sent successfully."); 
                        return TRUE;
                        //redirect('visitors/end');
                    }
                    else {
                        $this->session->set_flashdata("email_sent","Error in sending Email."); 
                        return TRUE;
                    } 
                }
            }
        }

    }


    public function reset_password($email,$otp,$password){
        $condition = array('otp' => $otp, 'email'=> $email);
        $this->db->set('password',$this->hash_password($password));
        $this->db->where($condition);
        return $this->db->update('users');

    }





    public function check_login($email,$password){

        $data['email'] = $email;

        $query = $this->db->get_where($this->table,$data);

        $userData = $query->row();

        if ($userData){

            if (password_verify($password,$userData->password)){

                return true;

            }else{

                return false;

            }

        }else{

            return false;

        }



    }


    public function check_right($user_id){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        return $query->row();

    }


    public function store_login_info($email){

        $ip = $this->input->ip_address();

        $time = date("Y-m-d H:i:s");

        $data['last_login_ip'] = $ip;

        $data['last_login_time'] = $time;

        $this->db->where('email', $email);

        $this->db->update($this->table, $data);

    }



    public function hash_password($password) {

        return password_hash($password, PASSWORD_BCRYPT);

    }



}