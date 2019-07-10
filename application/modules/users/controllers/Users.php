<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of users
 *
 * @author Uji Baba
 *
 */
class Users extends MY_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('users/auth'));
        }

        
        $this->load->model('user');
		$this->load->model('categories/category');
        $this->output->section('header','welcome/header');
        $this->output->section('sidebar','welcome/sidebar');
        $this->output->section('footer','welcome/footer');
        $this->output->set_template('admin');
    }



    function index() {
        $user_details=$this->session->userdata('logged_in');
        $user_role=$user_details->user_role;
        if($user_role!='1'){
            redirect('users/profile');
        }
        $data['users'] = $this->user->get_users();
        // echo"<pre>";
        // print_r($data['users']);
        // die;
        $this->output->set_title('Client');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->output->js('assets/themes/admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');
        

        $this->load->view('listing',$data);
    }


    function administrator_listing(){
        $user_details=$this->session->userdata('logged_in');
        $user_role=$user_details->user_role;
        if($user_role!='1'){
            redirect('users/profile');
        }
        $data['administrator'] = $this->user->get_administrator();
        // echo"<pre>";
        // print_r($data['administrator']);
        // die;
        $this->output->set_title('Administrator');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');       

        $this->load->view('administrator_listing',$data);

    }
	
	function adds_listing($client_id=0){
		$client_id = $this->input->get('client_id');
		$data['ads'] = $this->user->get_ads($client_id);
		$this->output->set_title('Ads Management');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('add_listing',$data);	
		
	}


    function profile(){

        $this->output->set_title('My Profile');
        $email = $this->session->userdata('logged_in')->email;
        $id = $this->session->userdata('logged_in')->id;

        $user_id=$this->session->userdata('logged_in')->id;
        $user_role=$this->session->userdata('logged_in')->user_role;
        $this->output->css('assets/vendors/dropzone/dropzone.css');
        $this->output->js('assets/vendors/dropzone/dropzone.js');

        if($this->user->verify_validation()) {
            $file_name1='';
            $n = $_FILES['userfile']['name'];
              
            if ($n !== "")
            {
                //$config2['file_name']='$n';
                $config2['upload_path'] = './uploads/profile_pictures/'; 

                        $config2['allowed_types'] = 'jpg|png|jpeg|gif';
                        $config2['max_size']    = '10000';
                        //$config2['max_width']  = '1024';
                        //$config2['max_height']  = '768';
                        $config2['overwrite']='true';
                        $config2['encrypt_name'] = TRUE;
                $this->load->library('upload', $config2);
                $this->upload->do_upload('userfile');
                $upload_data = $this->upload->data();
                $file_name1 = $upload_data['file_name']; 
            }
            // echo $file_name1;
            // die;

            $a=$this->session->userdata('logged_in');
            
            $params = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'region' => $this->input->post('region'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'country' => $this->input->post('country'),
                'image'=>$file_name1,
                'postal_code' => $this->input->post('postal_code'),
                'lat' => $this->input->post('lat'),
                'lng' => $this->input->post('lng')
            );

            
            
            $this->user->update_user($id,$params);
            $session = $this->session->userdata('logged_in');
            $user_data = $this->user->get_user($session->email);
            $this->session->set_userdata('logged_in', $user_data);
            redirect('users/profile');
        }else{
            
            
			$data['user'] = $this->user->get_user($email);
            $data['user_roles'] = $this->user->get_user_roles();
            $data['images']=$this->user->get_images($user_id);

            $data['certificate'] = $this->user->get_documents_by_user_id($user_id);
            $this->load->view('profile',$data);
        }
        

    }


    function dropzone_upload(){
        $user_details=$this->session->userdata('logged_in');
        if (!empty($_FILES)) {
        $tempFile = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $targetPath = getcwd() . '/uploads/gallery/';
        $targetFile = $targetPath . $fileName ;
        move_uploaded_file($tempFile, $targetFile);
        
        $this->db->insert('galleries',array('file_name' => $fileName, 'timestamp' => date('Y-m-d'), 'user_id' => $user_details->id));
        }
        $message = 'uploaded a new Photo';
        $this->notify_admin($message,$user_details->id);

    }

    function load_photos(){
        $this->output->unset_template();
        $user_details=$this->session->userdata('logged_in');
        if(isset($user_details->id)){
            $result  = $this->db->get_where('galleries',array('user_id' => $user_details->id));
            echo json_encode($result->result());
        }
        die;
    }


    function delete_photo(){
        $id = $this->input->post('id');
        $user_details=$this->session->userdata('logged_in');
        if($id){  
        $condition = array('id'=>$id,'user_id' => $user_details->id,'verified' => 0);  
        $result = $this->db->delete('galleries',$condition);
        if($result){
            echo "success";
        }else{
            echo "error";
        }

        }else{
            echo "error";
        }
    }


    function uploads($user_id){
        $this->output->set_title('Photo Manager');
        if($user_id){
            $data = array();
            $gallery = $this->user->get_images($user_id);
            if($gallery){
                $data['user_photos'] = $gallery;
                $this->load->view('listing_user_photos',$data);

            }else{
                show_404();
            }
        }else{
            show_404();
        }
    }



    function notify_admin($message,$created_by){
        if($message){
            $data = array(
                'title' => $message,
                'created' => date('Y-m-d'),
                'created_by' => $created_by
            );
            $this->db->insert('admin_notifications',$data);
        }
    }


    function get_admin_notifications(){
        $this->output->unset_template();
        $user_details=$this->session->userdata('logged_in');
        if($user_details->user_role == 1){
            //$condition = array('hidden' => 0);
            $this->db->select('users.first_name as first_name, users.last_name as last_name, users.id as uploader_id, admin_notifications.*');
            $this->db->from('admin_notifications');
            $this->db->join('users','users.id=admin_notifications.created_by');
            $query = $this->db->get();
            echo json_encode($query->result());
        }else{
            echo "";
        }
    }



    function mark_read_notifications(){
        $notification_ids = $this->input->post('ids');
        $this->db->where_in('id', $notification_ids);
        //$this->db->set('hidden',1);
        $result = $this->db->delete('admin_notifications');
        if($result){
            echo "success";
        }else{
            echo "error";
        }

    }



    function dashboard(){
        $user_details=$this->session->userdata('logged_in');
        $user_role=$user_details->user_role;
        if($user_role==1){
            redirect('users/index');
        }elseif($user_role==7){
            redirect('visitors/index');
        }elseif($user_role==8){
            redirect('accounts/index');
        }elseif($user_role==9){
            redirect('visas/index');
        }elseif($user_role==10){
            redirect('rooms/index');
        }elseif($user_role==11){
            redirect('flights/index');
        }
    }

    function add(){
        /*
        $user_details=$this->session->userdata('logged_in');
        $user_role=$user_details->user_role;
        if($user_role!='1'){
            show_404(); 
        }
        */
        $this->output->set_title('Add User');
        $data['category_names'] = $this->category->get_category_names();
        if($this->user->verify_validation()) {
            
            // $image = $this->user->image_upload('image');
            // $data['image'] = $image['file_name'];

            $params = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'password' => $this->input->post('password'),
                'user_role' => $this->input->post('user_role'),
                'category_id'=> $this->input->post('category_id'),
                'certificate_expiry'=>  date('Y-m-d H:i:s')
             );
            $this->user->add_user($params);
            redirect('users/index');
        }else{
            $data['user_roles'] = $this->user->get_user_roles();
            // echo"<pre>";
            // print_r($data);
            // die;
            $this->load->view('add',$data);
        }
    }







    function edit($id=0){
/*
        $user_details=$this->session->userdata('logged_in');
        $user_role=$user_details->user_role;
        if($user_role!='1'){
            show_404(); 
        }*/

        
        // echo"<pre>" ;
        // print_r($user_id);
        // die;
		
        $this->output->set_title('Edit User');
        // check if the row exists before trying to edit it  
		$data['category_names'] = $this->category->get_category_names();
        $data['users'] = $this->user->fetch_user($id);     

        if(isset($data['users']->id)) {

            if($this->user->verify_validation()) {
                // echo"entered";
                // die;
                // $image = $this->user->image_upload('image');
                // $data['image'] = $image['file_name'];
                        
                $params = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'user_role' => $this->input->post('user_role'),
                    'address' => $this->input->post('address'),
                    'region' => $this->input->post('region'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'country' => $this->input->post('country'),
                    'postal_code' => $this->input->post('postal_code'),
					'category_id' => $this->input->post('category_id'),
                    'lat' => $this->input->post('lat'),
                    'lng' => $this->input->post('lng')
                );

                $this->user->update_user($id,$params);

                
                redirect('users/index');
            }
            else
            {
                //Show Edit Page
                $data['user_roles'] = $this->user->get_user_roles();
                // echo"<pre>";
                // print_r($data);
                // die;
                $this->load->view('edit',$data);
            }
        }
        else{
            show_error('The Content you are trying to edit does not exist.');
        }
    }


    function client_documents($id=0){


    	$user_details=$this->session->userdata('logged_in');
	    $user_role=$user_details->user_role;
	    $user_id = $user_details->id;
	    
	    if($user_role > 1){
		    if($id != $user_id){
		    	show_404();
		    }
		}


    	$this->output->set_title('User Documents');

    	$error = '';

    	if($this->input->server('REQUEST_METHOD') == 'POST'){

    		$document_name = $this->input->post('document_name');
    		$document_details = $this->input->post('document_details');

    		$document_uploaded = $this->user->document_upload('userfile');

    		if($document_uploaded['status']){

    			$insertData = array(
    				'document_name' => $document_name,
    				'document_details' => $document_details,
    				'file_name'	=> $document_uploaded['file_name'],
    				'timestamp' => date('Y-m-d'),
    				'user_id' => $id
    			);


    			$this->user->add_documents($insertData);	

				redirect('users/client_documents/'.$id);

    		}else{
    			$error = $document_uploaded['error'];
    		}

    	}

    	$data['error'] = $error;

    	$data['documents'] = $this->user->get_documents_by_user_id($id);


    	$this->load->view('listing_user_documents',$data);		
		
    }



    function delete_document($id=0,$file_name=null){
    	if($id){
    		$user_details=$this->session->userdata('logged_in');
	        $user_role=$user_details->user_role;
	        if($user_role==1){
	        	//Delete document if current user is admin

	        	unlink('./uploads/documents/' . $file_name);
	        	$this->db->delete('documents', array('id' => $id));

	        	$this->load->library('user_agent');
		        redirect($this->agent->referrer());

	        }
    	}
    }




     function delete($id=0){

        

        $data['users'] = $this->user->fetch_user($id);

        // check if the user exists before trying to delete it
        if(isset($data['users']->id)) {
            $this->user->delete_user($id);
            redirect('users/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }
    }



    /**
     * Ajax Image Upload
     */
    function image_upload(){
        $this->output->unset_template();
        $uploaded = $this->user->image_upload('image');
        if ($uploaded['status']){
            $id = $this->session->userdata('logged_in')->id;
            $data['image'] = $uploaded['file_name'];
            $session = $this->session->userdata('logged_in');
            $session->image = $uploaded['file_name'];
            $this->session->set_userdata('logged_in',$session);
            $this->user->update_user($id,$data);
            redirect('users/profile');
        }
    }


    function togglestatus($id=0){
        
        $user_details=$this->session->userdata('logged_in');
        $user_role=$user_details->user_role;
        if($user_role!='1'){
            show_404(); 
        }

        $data['users'] = $this->user->fetch_user($id);
        if(isset($data['users']->id)) {
            $this->user->toggle_status($id);
            redirect('users/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }

    }



    function verifiedimagetoggle($photo_id=0){
        
        $user_details=$this->session->userdata('logged_in');
        $user_role=$user_details->user_role;
        if($user_role!='1'){
            show_404(); 
        }
        $this->user->toggle_photo_status($photo_id);
        $this->load->library('user_agent');
        redirect($this->agent->referrer());
    }



    function update_photo_comment(){
        $this->output->unset_template();
        $user_details=$this->session->userdata('logged_in');
        $user_role=$user_details->user_role;
        if($user_role!='1'){
            show_404(); 
        }

        $photo_id = $this->input->post('photo_id');
        $comment = $this->input->post('comment');

        if($this->user->update_photo_comment($comment,$photo_id)){
            echo "1";
        }else{
            echo "0";
        }
    }


    public function save_certificate_expiry(){
        $this->output->unset_template();
        $user_details=$this->session->userdata('logged_in');
        $user_role=$user_details->user_role;
        if($user_role!='1'){
            show_404(); 
        }


        $user_id = $this->input->post('user_id');
        $exp_date = $this->input->post('exp_date');

        $this->db->set('certificate_expiry',$exp_date);
        $this->db->where('id',$user_id);
        if($this->db->update('users')){
            echo "1";
        }else{
            echo "0";
        }

    }


   


}

/* End of file Users.php */
/* Location: ./application/modules/users/controllers/users.php */