<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');


class Dashboards extends MY_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('logged_in')->user_role != 1){
            redirect(base_url('users/auth'));
        }
        $this->load->model('Dashboard');
        $this->output->section('header','welcome/header');
        $this->output->section('sidebar','welcome/sidebar');
        $this->output->section('footer','welcome/footer');
        $this->output->set_template('admin');
    }

    function index() {
        //For Listing
    	$data['countings'] = $this->Dashboard->get_dashboards();
		$data['ads'] = $this->Dashboard->get_ads();
		$data['clients'] = $this->Dashboard->get_clients();
		/* echo'<pre>';
		//echo count($ads);
		print_r($data['dashboards']);
		die; */
        $this->output->set_title('Dashboard Management');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('listing',$data);
    }

    function add(){
      if($this->dashboard->verify_validation()) {
            
            $params = array(
                'status' => $this->input->post('status'),
                'title' => $this->input->post('title'),
                'content'=>$this->input->post('content'),
                'permalink'=>$this->input->post('permalink')
                
            );
            $this->dashboard->add_dashboard($params);
            redirect('dashboards/index');
        }
        else {
            //Show Add dashboard
            $this->output->js('assets/themes/admin/bower_components/ckeditor/ckeditor.js');
            $this->output->set_title('New dashboard');
            $this->load->view('add');
        }
    }


    function edit($id=0){

        // check if the row exists before trying to edit it
        $data['dashboard'] = $this->dashboard->get_dashboard($id);
        if(isset($data['dashboard']->id)) {

            if($this->dashboard->verify_validation()) {
               // print_r($_POST);die;
                $params = array(
                   'status' => $this->input->post('status'),
                    'title' => $this->input->post('title'),
                    'content'=>$this->input->post('content'),
                    'permalink'=>$this->input->post('permalink')
                    
                );

                $this->dashboard->update_dashboard($id,$params);
                redirect('dashboards/index');
            }
            else
            {
                //Show Edit dashboard
                $this->output->js('assets/themes/admin/bower_components/ckeditor/ckeditor.js');
                $this->output->set_title('Edit dashboard');
                $this->load->view('edit',$data);
            }
        }
        else{
            show_error('The Content you are trying to edit does not exist.');
        }
    }


    function delete($id=0){
        $data['dashboard'] = $this->dashboard->get_dashboard($id);

        // check if the user exists before trying to delete it
        if(isset($data['dashboard']->id)) {
            $this->dashboard->delete_dashboard($id);
            redirect('dashboards/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }
    }

    function togglestatus($id=0){
        $data['dashboard'] = $this->dashboard->get_dashboard($id);
        if(isset($data['dashboard']->id)) {
            $this->dashboard->toggle_status($id);
            redirect('dashboards/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }

    }

}

