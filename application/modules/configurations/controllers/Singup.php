<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');


class Singup extends MY_Controller {

    function __construct(){
        parent::__construct();
        
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('users/auth'));
        }
        if($this->session->userdata('logged_in')->user_role != 1){
            show_404();
        }
        
        $this->output->section('header','welcome/header');
        $this->output->section('sidebar','welcome/sidebar');
        $this->output->section('footer','welcome/footer');
        $this->output->set_template('admin');
    }

    function index() {

          
            $this->load->model('Mysing');
            $data['value']=$this->Mysing->foo();      
            $this->load->view('configurations/singup',$data);
       
    } 
      public function updatebtn(){  
        
         // $this->db->set('value','0',false);
         //    $this->db->where('id','1');
         //    $this->db->update('singup');
       // $query = $this->db
       //  ->select('value')
       //  ->from('singup')->get();
        $id = json_decode( $_POST['uid']);
       // $id =  $_GET['uid'];
         $query = "SELECT * FROM `users` WHERE `id` = $id ";
          $data = $this->db->query($query);
         $x  =  $data->result_array();
            // print_r($x);
             $y =  $x[0]['singup'];
           //  print_r($y);
           //echo $y ;
        if($y==0){
            $this->db->set('singup','1',false);
            $this->db->where('id',$id);
            $this->db->update('users');

        }else{
             $this->db->set('singup','0',false);
            $this->db->where('id',$id);
            $this->db->update('users');
        }


    //       $data['value']=$this->select->select();
    // $this->db->like('name', $kode); 
    // $query = $this->db->get("products");
    //     $this->load->model('Page');
    //     $this->Page->update_btn();


    }

   


    

}

