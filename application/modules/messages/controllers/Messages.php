<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');


class Messages extends MY_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('users/auth'));
        }
		$this->load->library('email');
        $this->load->model('message');
        $this->output->section('header','welcome/header');
        $this->output->section('sidebar','welcome/sidebar');
        $this->output->section('footer','welcome/footer');
        $this->output->set_template('admin');
    }

    function index() {
        //For Listing
    	$data['messages'] = $this->message->get_messages();
        $this->output->set_title('message Management');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('listing',$data);
    }

    function add(){
		
      if($this->message->verify_validation()) {
            //If it has post Request
		  //$id=$this->session->userdata('logged_in')->id;
		  //print_r($id);die;
		 // print_r($_POST);die;
            $params = array(
                'status' =>$this->input->post('status'),
                'form_id' =>$this->input->post('form_id'),
                'to_id' =>$this->input->post('to_id'),
				'message' =>$this->input->post('message'),
				'form_email' =>$this->input->post('form_email')
                
            );
		  
		 
            $this->message->add_message($params);
            redirect('messages/index');
        }
        else {
            //Show Add Page
            $this->output->set_title('New message');
            $this->load->view('add');
        }
    }


    function edit($id=0){

        // check if the row exists before trying to edit it
        $data['message'] = $this->message->get_message($id);
        if(isset($data['message']->id)) {

            if($this->message->verify_validation()) {
               // print_r($_POST);die;
                $params = array(
                'status' => $this->input->post('status'),
                'form_id' => $this->input->post('form_id'),
                'to_id'=>$this->input->post('to_id'),
			    'message'=>$this->input->post('message'),
				'form_email'=>$this->input->post('form_email')
                    
                    
                );

                $this->message->update_message($id,$params);
                redirect('messages/index');
            }
            else
            {
                //Show Edit Page
                $this->output->set_title('Edit message');
                $this->load->view('edit',$data);
            }
        }
        else{
            show_error('The Content you are trying to edit does not exist.');
        }
    }


    function stores(){
        $data['messages'] = $this->message->get_messages();
		/* echo'<pre>';
		print_r($data['messages']);
		die; */
        $this->output->set_title('message Management');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('listing-store',$data);
    }




    function getInboxMessages(){
        $this->output->unset_template();
        $user_id = $this->session->userdata('logged_in')->id;
        $messages = $this->message->getInbox($user_id);

        // foreach ($messages as $message) {
        //     echo '<tr>
                    
        //             <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
        //             <td class="mailbox-name"><a href="read-mail.html">'.$message->first_name.' '.$message->last_name.'</a></td>
        //             <td class="mailbox-subject">'.substr($message->last_message,0,60).'</td>
        //             <td class="mailbox-date">'.date('Y-m-d',strtotime($message->last_message_time)).'</td>
        //           </tr>';
        // }


        echo json_encode($messages);
    }


    function getStoreMessages(){
        $this->output->unset_template();
        $user_id = $this->session->userdata('logged_in')->id;
        $messages = $this->message->getStore($user_id);

	
        echo json_encode($messages);
    }

    function view($id){
        $data['message'] = $this->message->get_message($id);
		/* echo'<pre>';
		print_r($data['message']);
		die; */

        // check if the message exists before trying to delete it
        if(isset($data['message']->id)) {
            $this->load->view('view',$data);
        }
        else {
            show_error('The content you are trying to access does not exist.');
        }
    }


    function inboxView($from_id){
        if(!$from_id){
            show_404();
        }
        if($this->input->method() == 'post'){
            
            if(!empty($_FILES['fileToUpload']['name'])){

        $target_dir = "uploads/chatsharing/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
     if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
        $url = $_SERVER['HTTP_REFERER'];
           // redirect($url);
         
    echo "<script>location.href='$url'</script>";
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
     $url = $_SERVER['HTTP_REFERER'];
           // redirect($url);
         
    echo "<script>location.href='$url'</script>";
         
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    $url = $_SERVER['HTTP_REFERER'];
           // redirect($url);
         
    echo "<script>location.href='$url'</script>";
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "exe") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    $url = $_SERVER['HTTP_REFERER'];
           // redirect($url);
         
    echo "<script>location.href='$url'</script>";
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
   
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        
        $file_path = 'uploads/chatsharing/'.$_FILES["fileToUpload"]["name"];
         $to_id = $this->input->post('to_id');
        //$file_path = $this->input->post('fileToUpload');
        $from_id = $this->session->userdata('logged_in')->id;
        $date = date('Y-m-d H:i:s');
         $message = $this->input->post('message');

        $data = array(
            'to_id' => $to_id,
            'file_path' => $file_path,
            'from_id' => $from_id,
            'timestamp' => $date,
            'message' => $message
        );

        
        
        if($this->db->insert('messages',$data)){
            echo "1";
        }
           $url = $_SERVER['HTTP_REFERER'];
           // redirect($url);
         
    echo "<script>location.href='$url'</script>";
      //  header( "refresh:2;url=/chat" );
    } else {
        echo "Sorry, there was an error uploading your file.";
         $url = $_SERVER['HTTP_REFERER'];
           // redirect($url);
         
    echo "<script>location.href='$url'</script>";
    }
}


            


            }else{





            $message = $this->input->post('message');
            $to_id = $this->input->post('to_id');
            $from_id = $this->session->userdata('logged_in')->id;

            $data = array('message' => $message,'to_id'=>$to_id,'from_id'=>$from_id,'timestamp' => date('Y-m-d H:i:s'));
            $this->db->insert('messages',$data);
            $this->message->sendMail($to_id, $message);
            redirect(current_url());

        }
    }
        $query = $this->db->get_where('users',array('id' => $from_id));
        $data['from_user'] = $query->row();

        $data['messages'] = $this->message->get_messages_by_from_id_to_id($from_id);
        $this->load->view('inbox-view',$data);
    }


    function delete(){
		$from_id = $this->input->post('from_id');
		$to_id=$this->session->userdata('logged_in')->id;
		/* echo $from_id;
		echo $to_id;
		die; */
        if($from_id || $to_id) {
            $this->message->delete_message($from_id,$to_id);
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }
    }

    function togglestatus($id=0){
        $data['message'] = $this->message->get_message($id);
        if(isset($data['message']->id)) {
            $this->message->toggle_status($id);
            redirect('messages/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }

    }
	
	function delete_msg($msg_id=0){
		$msg_id =$this->input->post('msg_id');
		$this->message->delete_msg($msg_id);
		die;
	}


    function get_total_messages_count(){
        $this->output->unset_template();
        $this->db->distinct();
        $this->db->select('from_id');
        $this->db->where('to_id',$this->session->userdata('logged_in')->id);
        $query = $this->db->get('messages');
        echo count($query->result());
    }
	
	function get_messages_count(){
        $this->output->unset_template();
        $this->db->distinct();
        $this->db->select('from_id');
        $this->db->where('to_id',$this->session->userdata('logged_in')->id);
		$this->db->where('from_id !=0');
        $query = $this->db->get('messages');
        $inbox_count=count($query->result());
		
		$user_id = $this->session->userdata('logged_in')->id;
        $messages = $this->message->getStore($user_id);
		$store_count=count($messages);
		$total_msg_count=$inbox_count+ $store_count;
		echo $total_msg_count; 
    }
	

    function sendclientmessage(){
        $this->output->unset_template();
        $to_id = $this->input->post('to_id');
        $message = $this->input->post('message');
        $from_id = $this->session->userdata('logged_in')->id;
        $date = date('Y-m-d H:i:s');

        $data = array(
            'to_id' => $to_id,
            'message' => $message,
            'from_id' => $from_id,
            'timestamp' => $date
        );

        
        
        if($this->db->insert('messages',$data)){
            echo "1";
        }
        $this->message->sendMail($to_id, $message);

    }


    function sendMesageToAdmin(){
        $this->output->unset_template();
        $message = $this->input->post('message');
        $from_id = $this->session->userdata('logged_in')->id;
        $date = date('Y-m-d H:i:s');
        $admin_query = $this->db->get_where('users',array('user_role'=>1));
        foreach ($admin_query->result() as $row) {
            $data = array(
                'to_id' => $row->id,
                'message' => $message,
                'from_id' => $from_id,
                'timestamp' => $date
            );
            $this->db->insert('messages',$data);

            $this->message->sendMail($row->id, $message);
        }
        
        
        echo "1";

    }
	
	function send_mail(){
		
		$to_email = $this->input->post('to_email');
        $message = $this->input->post('message');
		$from_email = $this->session->userdata('logged_in')->email;
		$name = $this->session->userdata('logged_in')->first_name.' '.$this->session->userdata('logged_in')->last_name;
		
		
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
			
			$this->email->from($from_email, $name);
			$this->email->to($to_email); 
			
			$this->email->subject('Message by'.' '.$name);
			//$this->email->subject('Email Test');
			$this->email->message($message);

			$result = $this->email->send();
		
	}
    public function fileshare(){

        
        $target_dir = "uploads/chatsharing/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
     if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
        $url = $_SERVER['HTTP_REFERER'];
           // redirect($url);
         
    echo "<script>location.href='$url'</script>";
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
     $url = $_SERVER['HTTP_REFERER'];
           // redirect($url);
         
    echo "<script>location.href='$url'</script>";
         
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
    $url = $_SERVER['HTTP_REFERER'];
           // redirect($url);
         
    echo "<script>location.href='$url'</script>";
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" && $imageFileType != "exe") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
    $url = $_SERVER['HTTP_REFERER'];
           // redirect($url);
         
    echo "<script>location.href='$url'</script>";
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
   
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        
        $file_path = 'uploads/chatsharing/'.$_FILES["fileToUpload"]["name"];
         $to_id = $this->input->post('to_id');
        //$file_path = $this->input->post('fileToUpload');
        $from_id = $this->session->userdata('logged_in')->id;
        $date = date('Y-m-d H:i:s');

        $data = array(
            'to_id' => $to_id,
            'file_path' => $file_path,
            'from_id' => $from_id,
            'timestamp' => $date
        );

        
        
        if($this->db->insert('messages',$data)){
            echo "1";
        }
           $url = $_SERVER['HTTP_REFERER'];
           // redirect($url);
         
    echo "<script>location.href='$url'</script>";
      //  header( "refresh:2;url=/chat" );
    } else {
        echo "Sorry, there was an error uploading your file.";
         $url = $_SERVER['HTTP_REFERER'];
           // redirect($url);
         
    echo "<script>location.href='$url'</script>";
    }
}
    }

}

?>