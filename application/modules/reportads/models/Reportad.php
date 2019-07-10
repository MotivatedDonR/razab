<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportad extends CI_Model {
    private $table = 'report_ads';
    public function __construct() {
        parent::__construct();

    }

    public function get_reportads(){
        $query = $this->db->get($this->table);
		//$condition['user_id'] = $this->session->userdata('logged_in')->id;
		$query = $this->db->get_where($this->table);
        return $query->result();
    }

    public function get_reportad($id){
        $condition['id'] = $id;
        $query = $this->db->get_where($this->table,$condition);
        $result = $query->row();
        if ($result){
            return $result;
        }
        return false;
    }
	
	public function get_reportad_names()
    {   
        
        $this->db->select('*');
        $this->db->from('reportads');
        //$this->db->where('id', 25);
        $query = $this->db->get();
        return $query->result();
    }

   
    public function add_reportad($params){
        $params = array_filter($params,'strlen');
        $params['created'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table,$params);
    }


    public function update_reportad($id,$params){
        $params = array_filter($params,'strlen');
        $params['modified'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        return $this->db->update($this->table,$params);
    }

    
    public function delete_reportad($id){
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
            $this->form_validation->set_rules('ad_message', 'Ad Message', 'trim|required');


        }
        if ($action == 'edit'){
           $this->form_validation->set_rules('ad_message', 'Ad Message', 'trim|required');

            
        }
        if ($this->form_validation->run() == FALSE) {
            return FALSE ;
        } else {
            return TRUE;
        }
    }


}