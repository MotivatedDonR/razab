<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');


class Reportads extends MY_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('users/auth'));
        }
        $this->load->model('reportad');
        $this->output->section('header','welcome/header');
        $this->output->section('sidebar','welcome/sidebar');
        $this->output->section('footer','welcome/footer');
        $this->output->set_template('admin');
    }

    function index() {
        //For Listing
    	$data['reportads'] = $this->reportad->get_reportads();
        $this->output->set_title('reportad Management');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('listing',$data);
    }

    function add(){
      if($this->reportad->verify_validation()) {
            //If it has post Request
		  $id=$this->session->userdata('logged_in')->id;
		  //print_r($id);die;
            $params = array(
                'status' => $this->input->post('status'),
               'ad_message' => $this->input->post('ad_message'),
            );
            $this->reportad->add_reportad($params);
            redirect('reportads/index');
        }
        else {
            //Show Add Page
            $this->output->set_title('New reportad');
            $this->load->view('add');
        }
    }





    function edit($id=0){

        // check if the row exists before trying to edit it
        $data['reportad'] = $this->reportad->get_reportad($id);
        if(isset($data['reportad']->id)) {

            if($this->reportad->verify_validation()) {
               // print_r($_POST);die;
                $params = array(
                    'status' => $this->input->post('status'),
                    'ad_message' => $this->input->post('ad_message'),
                );

                $this->reportad->update_reportad($id,$params);
                redirect('reportads/index');
            }
            else
            {
                //Show Edit Page
                $this->output->set_title('Edit reportad');
                $this->load->view('edit',$data);
            }
        }
        else{
            show_error('The Content you are trying to edit does not exist.');
        }
    }


    function delete($id=0){
        $data['reportad'] = $this->reportad->get_reportad($id);

        // check if the user exists before trying to delete it
        if(isset($data['reportad']->id)) {
            $this->reportad->delete_reportad($id);
            redirect('reportads/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }
    }

    function togglestatus($id=0){
        $data['reportad'] = $this->reportad->get_reportad($id);
        if(isset($data['reportad']->id)) {
            $this->reportad->toggle_status($id);
            redirect('reportads/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }

    }

}

