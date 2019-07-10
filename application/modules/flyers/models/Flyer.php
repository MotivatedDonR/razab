<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flyer extends CI_Model {
    private $table = 'flyers';
    public function __construct() {
        parent::__construct();

    }

    public function get_flyers($user_id){
        $query = $this->db->get($this->table);
		$condition['user_id'] = $user_id;
		$query = $this->db->get_where($this->table,$condition);
        return $query->result();
    }

    public function get_flyer($id){
        $condition['id'] = $id;
        $query = $this->db->get_where($this->table,$condition);
        $result = $query->row();
        if ($result){
            return $result;
        }
        return false;
    }
	
	public function get_flyer_names()
    {   
        
        $this->db->select('*');
        $this->db->from('flyers');
        //$this->db->where('id', 25);
        $query = $this->db->get();
        return $query->result();
    }

   
    public function add_flyer($params){
        $params = array_filter($params,'strlen');
		
        $this->db->insert($this->table,$params);
    }


    public function update_flyer($id,$params){
        $params = array_filter($params,'strlen');
        $params['modified'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        return $this->db->update($this->table,$params);
    }

    
    public function delete_flyer($id){
        return $this->db->delete($this->table,array('id'=>$id));
    }

    public function toggle_status($id){
        $this->db->set('status', '1-status', FALSE);
        $this->db->where('id',$id);
        return $this->db->update($this->table);
    }


    
    public function verify_validation(){
        $this->load->library('form_validation');
        $action =  $this->router->method;
        if ($action == 'add'){
            $this->form_validation->set_rules('expiry', 'Expiry', 'trim|required');
            //$this->form_validation->set_rules('address', 'Address', 'trim|required');

        }
        if ($action == 'edit'){
           $this->form_validation->set_rules('expiry', 'Expiry', 'trim|required');
           // $this->form_validation->set_rules('address', 'Address', 'trim|required');
            
        }
        if ($this->form_validation->run() == FALSE) {
            return FALSE ;
        } else {
            return TRUE;
        }
    }


    public function image_upload($name)
    {

        $config['upload_path'] = './uploads/flyers/';
        $config['allowed_types'] = 'png|jpeg|jpg';
        //$config['max_size'] = 102400;
        $config['file_name'] = time();
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



    public function multiple_image_upload()
    {       
        $this->load->library('upload');
        $dataInfo = array();
        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        //echo $cpt;die;
        for($i=0; $i<$cpt; $i++)
        {           
            $_FILES['userfile']['name']= $files['userfile']['name'][$i];
            $_FILES['userfile']['type']= $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']= $files['userfile']['error'][$i];
            $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload();
            $dataInfo[] = $this->upload->data();
        }

        $ret = array();
        $file_names = array();
        $ret['status'] = false;

        foreach ($dataInfo as $image) {
            $file_names[] = $image['file_name'];
            $ret['status'] = true;
        }

        $ret['file_name'] = implode("#", $file_names);
        return $ret;
    }

    private function set_upload_options()
    {   
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/flyers/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite']     = FALSE;
        $config['file_name'] = time().rand(10,100);

        return $config;
    }





}