<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');


class Stores extends MY_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('users/auth'));
        }
        $this->load->model('store');
        $this->output->section('header','welcome/header');
        $this->output->section('sidebar','welcome/sidebar');
        $this->output->section('footer','welcome/footer');
        $this->output->set_template('admin');
    }

    function index() {
        //For Listing
    	$data['stores'] = $this->store->get_stores();
        $this->output->set_title('store Management');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('listing',$data);
    }

    function add(){
      if($this->store->verify_validation()) {
            //If it has post Request
		  $id=$this->session->userdata('logged_in')->id;
		  //print_r($id);die;
            $params = array(
                'status' => $this->input->post('status'),
                'name' => $this->input->post('name'),
                'address'=>$this->input->post('address'),
				'region'=>$this->input->post('region'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'country'=>$this->input->post('country'),
				'postal_code'=>$this->input->post('postal_code'),
				'lat'=>$this->input->post('lat'),
			    'lng'=>$this->input->post('lng'),
				'manager_name'=>$this->input->post('manager_name'),
				'web_link'=>$this->input->post('web_link'),	
				'fax' => $this->input->post('fax'),
				'user_id'=>$id
				
				
                
                
            );
            $this->store->add_store($params);
            redirect('stores/index');
        }
        else {
            //Show Add Page
            $this->output->set_title('New store');
            $this->load->view('add');
        }
    }


    function edit($id=0){

        // check if the row exists before trying to edit it
        $data['store'] = $this->store->get_store($id);
        if(isset($data['store']->id)) {

            if($this->store->verify_validation()) {
               // print_r($_POST);die;
                $params = array(
                'status' => $this->input->post('status'),
                'name' => $this->input->post('name'),
                'address'=>$this->input->post('address'),
				'region'=>$this->input->post('region'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'country'=>$this->input->post('country'),
				'postal_code'=>$this->input->post('postal_code'),
				'lat'=>$this->input->post('lat'),
				'manager_name'=>$this->input->post('manager_name'),
				'web_link'=>$this->input->post('web_link'),	
				'fax' => $this->input->post('fax'),
			    'lng'=>$this->input->post('lng')
                    
                    
                );

                $this->store->update_store($id,$params);
                redirect('stores/index');
            }
            else
            {
                //Show Edit Page
                $this->output->set_title('Edit store');
                $this->load->view('edit',$data);
            }
        }
        else{
            show_error('The Content you are trying to edit does not exist.');
        }
    }


    function delete($id=0){
        $data['store'] = $this->store->get_store($id);

        // check if the user exists before trying to delete it
        if(isset($data['store']->id)) {
            $this->store->delete_store($id);
            redirect('stores/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }
    }

    function togglestatus($id=0){
        $data['store'] = $this->store->get_store($id);
        if(isset($data['store']->id)) {
            $this->store->toggle_status($id);
            redirect('stores/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }

    }

}

