<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');


class Flyers extends MY_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('users/auth'));
        }
        $this->load->model('flyer');
        $this->output->section('header','welcome/header');
        $this->output->section('sidebar','welcome/sidebar');
        $this->output->section('footer','welcome/footer');
        $this->output->set_template('admin');
    }

    function index() {
        //For Listing
    	$data['flyers'] = $this->flyer->get_flyers($this->session->userdata('logged_in')->id);
        $this->output->set_title('flyer Management');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('listing',$data);
    }

	
	function user($user_id=null) {
        //For Listing
		if($user_id){
			$data['flyers'] = $this->flyer->get_flyers($user_id);
			$this->output->set_title('flyer Management');
			$this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
			$this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
			$this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
			$this->load->view('listing',$data);
		}
    }
	
	
    function add(){
        $data = array();
      if($this->flyer->verify_validation()) {
            //If it has post Request
		  $id=$this->session->userdata('logged_in')->id;
		  //print_r($id);die;
          

            $image_upload = $this->flyer->multiple_image_upload('userfile');
            if($image_upload['status']){
                $params = array(
                    'status' => $this->input->post('status'),
                    'image' => $image_upload['file_name'],
                    'expiry'=> date('Y-m-d', strtotime($this->input->post('expiry'))),
                    'user_id' =>  $this->input->post('user_id')
                );
                $this->flyer->add_flyer($params);
                if($this->session->userdata('logged_in')->user_role == 1){
                    redirect('flyers/user/'.$this->input->post('user_id'));
                }else{
                    redirect('flyers/index');
                }
                
            }else{
                $data['error'] = $image_upload['error'];
            }
            
        }

        $this->output->js('assets/themes/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        $this->output->set_title('New flyer');
        $this->load->view('add',$data);
        
    }


    function edit($id=0){

        // check if the row exists before trying to edit it
        $data['flyer'] = $this->flyer->get_flyer($id);
        if(isset($data['flyer']->id)) {

            if($this->flyer->verify_validation()) {
                $params = array(
                    'status' => $this->input->post('status'),
                    'expiry'=> date('Y-m-d', strtotime($this->input->post('expiry')))
                );
                $this->flyer->update_flyer($id,$params);
                redirect('flyers/index');
                
            }
            $this->output->js('assets/themes/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
            $this->output->set_title('Edit flyer');
            $this->load->view('edit',$data);
        }
        else{
            show_error('The Content you are trying to edit does not exist.');
        }
    }


    function delete($id=0){
        $data['flyer'] = $this->flyer->get_flyer($id);

        // check if the user exists before trying to delete it
        if(isset($data['flyer']->id)) {
            $this->flyer->delete_flyer($id);
            redirect('flyers/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }
    }

    function togglestatus($id=0){
        $data['flyer'] = $this->flyer->get_flyer($id);
        if(isset($data['flyer']->id)) {
            $this->flyer->toggle_status($id);
            redirect('flyers/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }

    }

}

