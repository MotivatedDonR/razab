<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');


class Categories extends MY_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('users/auth'));
        }
        $this->load->model('category');
        $this->output->section('header','welcome/header');
        $this->output->section('sidebar','welcome/sidebar');
        $this->output->section('footer','welcome/footer');
        $this->output->set_template('admin');
    }

    function index() {
        //For Listing
    	$data['categories'] = $this->category->get_categories();
        $this->output->set_title('Category Management');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('listing',$data);
    }

    function add(){
      if($this->category->verify_validation()) {
            //If it has post Request
            $params = array(
                'status' => $this->input->post('status'),
                'name' => $this->input->post('name'),
                'description'=>$this->input->post('description')
                
                
            );
            $this->category->add_category($params);
            redirect('categories/index');
        }
        else {
            //Show Add Page
            $this->output->set_title('New category');
            $this->load->view('add');
        }
    }


    function edit($id=0){

        // check if the row exists before trying to edit it
        $data['category'] = $this->category->get_category($id);
        if(isset($data['category']->id)) {

            if($this->category->verify_validation()) {
               // print_r($_POST);die;
                $params = array(
                    'status' => $this->input->post('status'),
                    'name' => $this->input->post('name'),
                    'description'=>$this->input->post('description')
                    
                    
                );

                $this->category->update_category($id,$params);
                redirect('categories/index');
            }
            else
            {
                //Show Edit Page
                $this->output->set_title('Edit category');
                $this->load->view('edit',$data);
            }
        }
        else{
            show_error('The Content you are trying to edit does not exist.');
        }
    }


    function delete($id=0){
        $data['category'] = $this->category->get_category($id);

        // check if the user exists before trying to delete it
        if(isset($data['category']->id)) {
            $this->category->delete_category($id);
            redirect('categories/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }
    }

    function togglestatus($id=0){
        $data['category'] = $this->category->get_category($id);
        if(isset($data['category']->id)) {
            $this->category->toggle_status($id);
            redirect('categories/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }

    }

}

