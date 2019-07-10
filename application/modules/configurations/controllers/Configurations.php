<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');


class Configurations extends MY_Controller {

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
        //For Listing
        $this->db->order_by('input_type','DESC');
        $data['configurations'] = $this->db->get('site_config')->result();

        if($this->input->method() == 'post') {
            $errors = array();
            $params = array();
            foreach ($_POST as $key => $value) {
                $params[$key] = $value;
            }
            
            foreach ($_FILES as $key => $value) {
                $image = $this->upload_images($key);
                if($image['status']){
                    $params[$key] = $image['file_name'];
                }else{
                    $errors[] = $image['error']; 
                }
            }

            foreach ($params as $key => $value) {
                $this->db->reset_query();
                $this->db->set('value', $value);
                $this->db->where('config_name', $key);
                $this->db->update('site_config');
            }

            $this->session->set_flashdata('error',$errors);
            $this->session->set_flashdata('success','Configuration settings has been updated');
            redirect('configurations/index');
        }
        else
        {
            
            $this->output->set_title('Edit configuration');
            $this->load->view('edit',$data);
        }
    } 

    function upload_images($name){
        $config['upload_path'] = './uploads/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1024;
        $config['file_name'] = $name;
        $config['overwrite'] = TRUE;
        if (!is_writable($config['upload_path'])) {
            chmod($config['upload_path'], 777);
        }
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($name)) {
            $ret['status'] = false;
            $ret['error'] = $this->upload->display_errors();
        } else {
            $data = $this->upload->data();
            $ret['status'] = true;
            $ret['file_name'] = $data['file_name'];
        }
        return $ret;
    }



}

