<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');


class Pages extends MY_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('users/auth'));
        }
        $this->load->model('page');
        $this->output->section('header','welcome/header');
        $this->output->section('sidebar','welcome/sidebar');
        $this->output->section('footer','welcome/footer');
        $this->output->set_template('admin');
    }

    function index() {
        //For Listing
    	$data['pages'] = $this->page->get_pages();
        $this->output->set_title('page Management');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('listing',$data);
    }

    function add(){
      if($this->page->verify_validation()) {
            
            $params = array(
                'status' => $this->input->post('status'),
                'title' => $this->input->post('title'),
                'content'=>$this->input->post('content'),
                'permalink'=>$this->input->post('permalink')
                
            );
            $this->page->add_page($params);
            redirect('pages/index');
        }
        else {
            //Show Add Page
            $this->output->js('assets/themes/admin/bower_components/ckeditor/ckeditor.js');
            $this->output->set_title('New page');
            $this->load->view('add');
        }
    }


    function edit($id=0){

        // check if the row exists before trying to edit it
        $data['page'] = $this->page->get_page($id);
        if(isset($data['page']->id)) {

            if($this->page->verify_validation()) {
               // print_r($_POST);die;
                $params = array(
                   'status' => $this->input->post('status'),
                    'title' => $this->input->post('title'),
                    'content'=>$this->input->post('content'),
                    'permalink'=>$this->input->post('permalink')
                    
                );

                $this->page->update_page($id,$params);
                redirect('pages/index');
            }
            else
            {
                //Show Edit Page
                $this->output->js('assets/themes/admin/bower_components/ckeditor/ckeditor.js');
                $this->output->set_title('Edit page');
                $this->load->view('edit',$data);
            }
        }
        else{
            show_error('The Content you are trying to edit does not exist.');
        }
    }


    function delete($id=0){
        $data['page'] = $this->page->get_page($id);

        // check if the user exists before trying to delete it
        if(isset($data['page']->id)) {
            $this->page->delete_page($id);
            redirect('pages/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }
    }

    function togglestatus($id=0){
        $data['page'] = $this->page->get_page($id);
        if(isset($data['page']->id)) {
            $this->page->toggle_status($id);
            redirect('pages/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }

    }

}

