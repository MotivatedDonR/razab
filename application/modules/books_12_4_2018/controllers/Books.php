<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class Books extends MY_Controller {

    function __construct() {
        parent::__construct();

        
        $this->load->model('Book');
        $this->load->model('categories/category');
        //$this->output->section('header', 'booking/header');
        //$this->output->section('sidebar', 'welcome/sidebar');
        //$this->output->section('footer', 'booking/footer');
       // $this->output->js('assets/themes/pages/vendor/jquery/jquery.min.js');
        
        

        $query=$this->db->get('site_config')->result();
        $this->db_config=new stdClass();

        foreach ($query as $conf) {
            $key=$conf->config_name;
            $this->db_config->$key=$conf->value;
        }
    }

    function index() {
        if ( !$this->session->userdata('logged_in')) {
            redirect(base_url('users/auth'));
        }
        //For Listing
        if($this->session->userdata('logged_in')->user_role == 2){
            $this->output->section('header', 'welcome/header');
            $this->output->section('sidebar', 'welcome/sidebar');
            $this->output->section('footer', 'welcome/footer');
            $this->output->set_template('admin');
            $login_id=$this->session->userdata('logged_in')->id;
            $data['queues']=$this->Book->get_queue($login_id);
            $this->output->set_title('Guest Management');
            $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
            $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
            $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
            $this->load->view('queue_listing', $data);
        }else{
            show_error('The Content you are trying to view does not exist.');
        }
    }

    function suscribe_guest() {

        if ( !$this->session->userdata('logged_in')) {
            redirect(base_url('users/auth'));
        }
        //For Listing
        if($this->session->userdata('logged_in')->user_role == 2){
            $this->output->section('header', 'welcome/header');
            $this->output->section('sidebar', 'welcome/sidebar');
            $this->output->section('footer', 'welcome/footer');
            $this->output->set_template('admin');
            $login_id=$this->session->userdata('logged_in')->id;
            $data['suscribes']=$this->Book->get_suscribe($login_id);
            $this->output->set_title('Guest Management');
            $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
            $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
            $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
            $this->load->view('suscribe_listing', $data);
        }else{
            show_error('The Content you are trying to view does not exist.');
        }
    }
    function complete_guest() {
        if ( !$this->session->userdata('logged_in')) {
            redirect(base_url('users/auth'));
        }
        //For Listing
        if($this->session->userdata('logged_in')->user_role == 2){
            $this->output->section('header', 'welcome/header');
            $this->output->section('sidebar', 'welcome/sidebar');
            $this->output->section('footer', 'welcome/footer');
            $this->output->set_template('admin');
            $login_id=$this->session->userdata('logged_in')->id;
            $data['guests_complete']=$this->Book->get_completed($login_id);
            $this->output->set_title('Guest Management');
            $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
            $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
            $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
            $this->load->view('completed_listing', $data);
        }else{
            show_error('The Content you are trying to view does not exist.');
        }
    }
    function update_guest_list(){
        $ids = $this->input->post('ids');
        $this->Book->update_guest_list($ids);
        echo"1";
       // echo'<pre>';
        //print_r($val);
        die;
    }

    function appointment() {        
        $client_id=$this->uri->segment(3);
        $ad_id=$this->uri->segment(4);
        $this->output->set_title('Book Appointment');
        $this->output->unset_template();
        $this->output->set_template('pages');

        if($client_id || $ad_id){      

            $data['client_id']= $client_id;
            $data['ad_id']= $ad_id;
            $this->load->view('add', $data);
            
        }else{
            show_error('Invalid Url');
        }
    }

    function get_date(){
        $client_id= $this->input->post('client_id');
        $ad_id=$this->input->post('ad_id');        
        $ads=$this->Book->fetch_add($client_id,$ad_id);
        $dates=json_decode($ads->appointment_date);        
        $dta=[];
        foreach($dates as $date){
            $s = strtotime($date);            
            //$dta[] = date('m/d/Y', $s);
            //$tem[] = date('H:i:s A', $s);
            if(!in_array(date('m/d/Y', $s), $dta)){
                $dta[] = date('m/d/Y', $s);
            }    
        }
        $data['dtas']=$dta;        
        $this->load->view('date_dropdown', $data);
    }
    
    function get_time(){
        $client_id= $this->input->post('client_id');
        $ad_id=$this->input->post('ad_id'); 
        $appo_date=$this->input->post('appo_date'); 

        $ads=$this->Book->fetch_add($client_id,$ad_id);
        $dates=json_decode($ads->appointment_date);        
        $tme=[];
        foreach($dates as $date){
            $s = strtotime($date);            
            $dt = date('m/d/Y', $s);
            if(strtotime($dt) == strtotime($appo_date)){
                $tme[] = date('h:i:s A', $s);
            }    
        }
        
        $data['tmes']=$tme;        
        $this->load->view('time_dropdown', $data);
    }

    function add_queue(){
        $params=array(
            'booking_person_name'=> $this->input->post('name'),
            'booking_person_email'=> $this->input->post('email'),
            'booking_person_number'=> $this->input->post('number'),     
            //'appointment_method'=> $appointment_method,                
            'user_id'=> $this->input->post('client_id'),
            'ad_id'=>$this->input->post('ad_id')
        );


        $this->Book->add_appointment_via_que($params);
            echo "1";
            die;            
    }

    function add_booking_via_payment(){
        $params=array(
            'booking_person_name'=> $this->input->post('name'),
            'booking_person_email'=> $this->input->post('email'),
            'booking_person_number'=> $this->input->post('number'),     
            //'appointment_method'=> $appointment_method,                
            'user_id'=> $this->input->post('client_id'),
            'ad_id'=>$this->input->post('ad_id')
        );
        $inserted_id=$this->Book->add_appointment_via_payment($params);
        echo $inserted_id;
        die;            
    }

    function payment_complete(){
        
        $last_id=$this->input->post('last_id');        
        $temp_booking=$this->Book->fetch_temp_booking($last_id);
        $params=array(
            'booking_person_name'=> $temp_booking->booking_person_name,
            'booking_person_email'=> $temp_booking->booking_person_email,
            'booking_person_number'=> $temp_booking->booking_person_number,    
            'appointment_method'=> 1,                
            'user_id'=> $temp_booking->user_id, 
            'ad_id'=>$temp_booking->ad_id
        );
        $this->Book->add_appointment_via_que($params);      
        $this->Book->delete_temp_booking($last_id);   
        echo"1";    
        die;
    }

    function guest_listing(){
        if ( !$this->session->userdata('logged_in')) {
            redirect(base_url('users/auth'));
        }
        if($this->session->userdata('logged_in')->user_role == 1){

            $this->output->section('header', 'welcome/header');
            $this->output->section('sidebar', 'welcome/sidebar');
            $this->output->section('footer', 'welcome/footer');
            $this->output->set_template('admin');

            $client_id=$this->uri->segment(3); 
            $data['queue_count']=$this->Book->get_guest_queue($client_id);   
            $data['suscribe_count']=$this->Book->get_guest_suscribe($client_id);  
            $data['complete_count']=$this->Book->get_guest_complete($client_id); 
            $data['user']=$this->Book->get_users($client_id); 
            $this->load->view('guest_listing', $data);
            
        }else{
            show_error('The Content you are trying to view does not exist.');
        }
    }


    

}