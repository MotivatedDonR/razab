<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Model {
    private $table = 'messages';
    public function __construct() {
        parent::__construct();

    }

    public function get_messages(){
        $query = $this->db->get($this->table);
		//$condition['user_id'] = $this->session->userdata('logged_in')->id;
		$query = $this->db->get_where($this->table);
        return $query->result();
    }

    public function getInbox($user_id){
        $query = $this->db->query('select user_msg.*, m.message as last_message from (select users.first_name, users.last_name, msg.* from users inner join (SELECT from_id,to_id,count(from_id) as msg_count,max(timestamp) as last_message_time from messages GROUP BY from_id,to_id HAVING from_id != 0 AND to_id='.$user_id.') msg on users.id=msg.from_id) user_msg INNER JOIN messages m on m.timestamp=user_msg.last_message_time WHERE m.to_id=user_msg.to_id ORDER BY user_msg.last_message_time DESC');
        return $query->result();
    }

    public function getStore($user_id){
        $this->db->select('messages.*,stores.name as store_name');
        $this->db->where('to_id',$user_id);
        $this->db->where('from_id',0);
        $this->db->order_by('timestamp','DESC');
        $this->db->from('messages');
        //$this->db->join('stores','stores.id=messages.store_id');
		$this->db->join('stores','stores.id=messages.store_id','left');
        $query = $this->db->get();
        //print_r($query->result());die;
        return $query->result();
    }

    public function get_message($id){
        $condition['messages.id'] = $id;
        $this->db->select('messages.*,stores.name as store_name');
        $this->db->from('messages');
        $this->db->join('stores','stores.id=messages.store_id','left');
        $this->db->where($condition);
        $query = $this->db->get();
        $result = $query->row();
        if ($result){
            return $result;
        }
        return false;
    }


    public function get_messages_by_from_id_to_id($from_id,$to_id=NULL){
        if(!$to_id){
            $to_id = $this->session->userdata('logged_in')->id;
        }

        $query = $this->db->query('SELECT * from messages WHERE (from_id='.$from_id.' AND to_id ='.$to_id.') OR (to_id='.$from_id.' AND from_id='.$to_id.') ORDER BY timestamp');
        return $query->result();
    }
	
	public function get_message_names()
    {   
        
        $this->db->select('*');
        $this->db->from('messages');
        //$this->db->where('id', 25);
        $query = $this->db->get();
        return $query->result();
    }

   
    public function add_message($params){
        $params = array_filter($params,'strlen');
	
        $params['timestamp'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table,$params);
    }


    public function update_message($id,$params){
        $params = array_filter($params,'strlen');
        $params['modified'] = date('Y-m-d H:i:s');
        $this->db->where('id',$id);
        return $this->db->update($this->table,$params);
    }

    
    public function delete_msg($msg_id){
		
		$this->db->where('id',$msg_id);
		$this->db->delete('messages');
    }
	
	public function delete_message($from_id,$to_id){
		
		
		//$this->db->where('from_id',$from_id);
		$this->db->where('(from_id='.$from_id.' AND to_id='.$to_id.') OR (from_id='.$to_id.' AND to_id='.$from_id.')');
		$this->db->delete('messages');
		echo $this->db->last_query();
		
		/* $this->db->where('from_id',$to_id);
		$this->db->where('to_id',$from_id);
		$this->db->delete('messages', $data); */
		echo"delete";
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
           // $this->form_validation->set_rules('form_id', 'From', 'trim|required');
            $this->form_validation->set_rules('to_id', 'To', 'trim|required');
			$this->form_validation->set_rules('message', 'Message', 'trim|required');
			//$this->form_validation->set_rules('form_email', 'Email', 'trim|required');
			

        }
        if ($action == 'edit'){
           //$this->form_validation->set_rules('form_id', 'From', 'trim|required');
            $this->form_validation->set_rules('to_id', 'To', 'trim|required');
			$this->form_validation->set_rules('message', 'Message', 'trim|required');
			//$this->form_validation->set_rules('form_email', 'Email', 'trim|required');
            
        }
        if ($this->form_validation->run() == FALSE) {
            return FALSE ;
        } else {
            return TRUE;
        }
    }


    function sendMail($to_id, $messages, $from_name=null,$storeEmail=NULL){

        $userData = $this->db->get_where('users', array('id'=>$to_id))->row();

        $configQuery = $this->db->get('site_config');
        $configRes = $configQuery->result();
        $emailConfig = array();
        foreach ($configRes as $conf) {
            $emailConfig[$conf->config_name] = $conf->value;
        }

        $from_email= $emailConfig['admin_email'];
        $sender_name= $emailConfig['email_sender_name'];


        $to_email = $userData->email;

        $name = $this->session->userdata('logged_in')->first_name.' '.$this->session->userdata('logged_in')->last_name;
        if($from_name){
            $name = $from_name;
        }
        $messageToSend = '<strong>'.$name.'</strong> has sent you a message. Bellow is the message you got.<br/><br/>'.$messages;
        if($storeEmail && $from_name){
            $messageToSend = 'You have received a Store Message.<br/><b/><strong>Name: </strong>'.$name.'<br/><strong>Email: </strong>'.$storeEmail.'<br/><strong>Message: </strong>'.$messages;
        }
        
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'xxx',
            'smtp_pass' => 'xxx',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
            );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        // Set to, from, message, etc.
        
        $this->email->from($from_email, $sender_name);
        $this->email->set_header('Content-Type', 'text/html');
        $this->email->to($to_email); 
        
        $this->email->subject('New Message from'.' '.$name. ' | '.$emailConfig['site_title']);
        //$this->email->subject('Email Test');
        $this->email->message($messageToSend);

        $result = $this->email->send();
    }


}