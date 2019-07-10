<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Model {
    private $table = 'booking_person';
    public function __construct() {
        parent::__construct();

    }

    public function get_ads(){
        $query = $this->db->get($this->table);
		$condition['user_id'] = $this->session->userdata('logged_in')->id;
		$query = $this->db->get_where($this->table,$condition);
        return $query->result();
    }

    public function get_ad($id){
        $condition['id'] = $id;
        $query = $this->db->get_where($this->table,$condition);
        $result = $query->row();
        if ($result){
            return $result;
        }
        return false;
    }
	
	
	
	public function fetch_ad_images($cid)
	{ 
        $match = $cid; 
        $this->db->where('ad_id' , $match);
		
        $this->db->select('ad_image');
        $query = $this->db->get('ad_gallery');
        return $query->result();	
	}
	
	

    public function update_guest_list($ids)
    {   
        
        $data = [
            'Status'=>1,
         ];
         
         //array of ids to update
         //$ids = [1,2];
         
         $this->db->where_in('id', $ids)->update('booking_person', $data);
    }

   
    

	public function add_ad_img($params1){
		  $params = array_filter($params1,'strlen');
        $this->db->insert('ad_gallery',$params1);
    }
	
	public function update_ad_img($params1,$cid){
		$this->db->where('ad_id',$cid);
        return $this->db->update('ad_gallery',$params1);
    }

    public function upload_video($name,$type,$video_size){
        $video_size=$video_size*1024;
        $ret['status'] = false;
        $config['upload_path']          = './uploads/'.$type.'/';
        $config['allowed_types']        = '*';
        $config['max_size']             = $video_size;
        $config['file_name']            = time();

        if(!is_writable($config['upload_path'])){
            chmod($config['upload_path'], 777);
        }

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload($name)){
            $ret['status'] = 'error';
            $ret['error'] = $this->upload->display_errors();
        }
        else{
            $data =  $this->upload->data();
            $ret['status'] = 'success';
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
        //echo"in model";
        

        if (!$files['userfile']['name'][0]) {
            return NULL;
        } else {
            
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
    }
	
	 private function set_upload_options()
    {   
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/documents/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite']     = FALSE;
        $config['file_name'] = time().rand(10,100);

        return $config;
    }
	
	


    public function update_Document($id,$params){
        $params = array_filter($params,'strlen');

        $condition = "id = '" . $id . "'";
        $this->db->select('image');
        $this->db->from($this->table);
        $this->db->where($condition);
        $image=$this->db->get()->row();

        $image = json_decode(json_encode($image), True);

        $str = implode(" ",$image);

        if(isset($params['image']))
        {
            unlink('./uploads/documents/'.$str);
        }
        $params['modified'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        return $this->db->update($this->table,$params);
    }




    public function update_ad($id,$params){
        //$params = array_filter($params,'strlen');
        $params['modified'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        return $this->db->update($this->table,$params);
    }

    
    public function delete_ad($id){
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
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[booking_person.booking_person_email]');
            $this->form_validation->set_rules('number', 'Number', 'trim|required|min_length[10]|max_length[15]|is_unique[booking_person.booking_person_number]');
			/* $this->form_validation->set_rules('fax', 'Fax', 'trim|required'); */
        }
        if ($action == 'edit'){
            $this->form_validation->set_rules('adtitle', 'Title', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');
            $this->form_validation->set_rules('choose', 'Choose', 'trim|required');
			/* $this->form_validation->set_rules('fax', 'Fax', 'trim|required'); */
            
        }
        if ($this->form_validation->run() == FALSE) {
            return FALSE ;
        } else {
            return TRUE;
        }
    }

    public function get_queue($login_id)
    {           
        $this->db->select('*');
        $this->db->from('booking_person');
        $this->db->where('status', 0);
        $this->db->where('user_id', $login_id);
        $this->db->where('appointment_method', 0);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_suscribe($login_id)
    {   
        
        $this->db->select('*');
        $this->db->from('booking_person');
        $this->db->where('status', 0);
        $this->db->where('user_id', $login_id);
        $this->db->where('appointment_method', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_completed($login_id)
    {   
        
        $this->db->select('*');
        $this->db->from('booking_person');
        $this->db->where('user_id', $login_id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function add_appointment_via_que($params){
        $params = array_filter($params,'strlen');
        $params ['created'] = date('Y-m-d H:i:s');
        $params ['modified'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table,$params);
		//$last_id=return $this->db->insert_id();
    }
    
    public function add_appointment_via_payment($params){
        $params = array_filter($params,'strlen');
        $params ['created'] = date('Y-m-d H:i:s');
        $params ['modified'] = date('Y-m-d H:i:s');
        $this->db->insert('temp_booking',$params);

        $insert_id = $this->db->insert_id();
        return  $insert_id;
		//$last_id=return $this->db->insert_id();
    }

    public function fetch_temp_booking($last_id)
    {   
        
        $this->db->select('*');
        $this->db->from('temp_booking');
        $this->db->where('id', $last_id);
        $query = $this->db->get();
        return $query->row();
    }


    public function delete_temp_booking($last_id){
        return $this->db->delete('temp_booking',array('id'=>$last_id));
    }

    public function get_guest_queue($login_id)
    {   
        
        $this->db->select('*');
        $this->db->from('booking_person');
        $this->db->where('status', 0);
        $this->db->where('user_id', $login_id);
        $this->db->where('appointment_method', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_guest_suscribe($login_id)
    {   
        
        $this->db->select('*');
        $this->db->from('booking_person');
        $this->db->where('status', 0);
        $this->db->where('user_id', $login_id);
        $this->db->where('appointment_method', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_guest_complete($login_id)
    {   
        
        $this->db->select('*');
        $this->db->from('booking_person');
        $this->db->where('status', 1);
        $this->db->where('user_id', $login_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_users($login_id)
    {   
        
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $login_id);
        $query = $this->db->get();
        return $query->row();
    }

    public function fetch_add($client_id,$ad_id)
    {   
        
        $this->db->select('*');
        $this->db->from('ads');
        $this->db->where('user_id', $client_id);
        $this->db->where('id', $ad_id);
        $query = $this->db->get();
        return $query->row();
    }

}