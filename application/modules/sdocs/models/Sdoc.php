<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sdoc extends CI_Model {
    private $table = 'stores';
    public function __construct() {
        parent::__construct();

    }

    public function get_Sdocs($client_id){
        $query = $this->db->get($this->table);
		$condition['user_id'] = $client_id;
		$query = $this->db->get_where($this->table,$condition);
        return $query->result();
    }

    public function get_Sdoc($id){
        $condition['id'] = $id;
        $query = $this->db->get_where('stores',$condition);
        $result = $query->row();
        if ($result){
            return $result;
        }
        return false;
    }
	
	
	public function document_upload($name)
    {
        $config['upload_path'] = './uploads/documents/';
        $config['allowed_types'] = 'png|pdf|doc|docx|jpeg|jpg';
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
	
	public function add_documents($datas){
        $this->db->insert('sdocs', $datas);
    }
	
	public function get_documents_by_store_id($store_id)
    {   
        $this->db->select('*');
        $this->db->from('sdocs');
        $this->db->where('store_id',$store_id);
        $this->db->order_by('timestamp','DESC');
        $query = $this->db->get();
        return $query->result();
    }
	
	
	public function get_Sdoc_names()
    {   
        
        $this->db->select('*');
        $this->db->from('Sdocs');
        //$this->db->where('id', 25);
        $query = $this->db->get();
        return $query->result();
    }

   
    public function add_Sdoc($params){
        $params = array_filter($params,'strlen');
		
        $this->db->insert($this->table,$params);
    }


    public function update_Sdoc($id,$params){
        $params = array_filter($params,'strlen');
        $params['modified'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        return $this->db->update($this->table,$params);
    }

    
    public function delete_Sdoc($id){
        return $this->db->delete('stores',array('id'=>$id));
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
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('region', 'Region', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'State', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('postal_code', 'Postal Code', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');

        }
        if ($action == 'edit'){
           $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('region', 'Region', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state', 'State', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('postal_code', 'Postal Code', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            
        }
        if ($this->form_validation->run() == FALSE) {
            return FALSE ;
        } else {
            return TRUE;
        }
    }


}