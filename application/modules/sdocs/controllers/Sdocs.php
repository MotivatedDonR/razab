<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');


class Sdocs extends MY_Controller {

    function __construct(){
        parent::__construct();
        if (!$this->session->userdata('logged_in')){
            redirect(base_url('users/auth'));
        }
        $this->load->model('sdoc');
        $this->output->section('header','welcome/header');
        $this->output->section('sidebar','welcome/sidebar');
        $this->output->section('footer','welcome/footer');
        $this->output->set_template('admin');
    }

    function index($client_id=0) {		
		
        //For Listing
		$client_id = $this->input->get('client_id');
		$data['client_id']=$client_id;
    	$data['Sdocs'] = $this->sdoc->get_Sdocs($client_id);
        $this->output->set_title('Sdoc Management');
        $this->output->css('assets/themes/admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        $this->output->js('assets/themes/admin/bower_components/datatables.net/js/jquery.dataTables.min.js');
        $this->output->js('assets/themes/admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        $this->load->view('listing',$data);
    }

    function add(){
      if($this->Sdoc->verify_validation()) {
            //If it has post Request
		  $id=$this->session->userdata('logged_in')->id;
		  //print_r($id);die;
            $params = array(
                'status' => $this->input->post('status'),
                'name' => $this->input->post('name'),
                'address'=>$this->input->post('address'),
				'region'=>$this->input->post('region'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'country'=>$this->input->post('country'),
				'postal_code'=>$this->input->post('postal_code'),
				'lat'=>$this->input->post('lat'),
			    'lng'=>$this->input->post('lng'),
				'user_id'=>$id
				
				
                
                
            );
            $this->Sdoc->add_Sdoc($params);
            redirect('Sdocs/index');
        }
        else {
            //Show Add Page
            $this->output->set_title('New Sdoc');
            $this->load->view('add');
        }
    }


    function edit($id=0){
		
        // check if the row exists before trying to edit it
        $data['Sdoc'] = $this->Sdoc->get_Sdoc($id);
        if(isset($data['Sdoc']->id)) {

            if($this->Sdoc->verify_validation()) {
               // print_r($_POST);die;
                $params = array(
                'status' => $this->input->post('status'),
                'name' => $this->input->post('name'),
                'address'=>$this->input->post('address'),
				'region'=>$this->input->post('region'),
				'city'=>$this->input->post('city'),
				'state'=>$this->input->post('state'),
				'country'=>$this->input->post('country'),
				'postal_code'=>$this->input->post('postal_code')
                    
                    
                );

                $this->Sdoc->update_Sdoc($id,$params);
                redirect('Sdocs/index');
            }
            else
            {
                //Show Edit Page
                $this->output->set_title('Edit Sdoc');
                $this->load->view('edit',$data);
            }
        }
        else{
            show_error('The Content you are trying to edit does not exist.');
        }
    }


    function delete($id=0){
        $data['Sdoc'] = $this->sdoc->get_Sdoc($id);
		print_r($data);
		die;
        // check if the user exists before trying to delete it
        if(isset($data['Sdoc']->id)) {
            $this->sdoc->delete_Sdoc($id);
            redirect('sdocs/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }
    }

    function togglestatus($id=0){
        $data['Sdoc'] = $this->Sdoc->get_Sdoc($id);
        if(isset($data['Sdoc']->id)) {
            $this->Sdoc->toggle_status($id);
            redirect('Sdocs/index');
        }
        else {
            show_error('The content you are trying to delete does not exist.');
        }

    }
	
	function upload_documents($id=0){


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

    		$document_uploaded = $this->sdoc->document_upload('userfile');

    		if($document_uploaded['status']){

    			$insertData = array(
    				'document_name' => $document_name,
    				'document_details' => $document_details,
    				'file_name'	=> $document_uploaded['file_name'],
    				'timestamp' => date('Y-m-d'),
    				'store_id' => $id
    			);


    			$this->sdoc->add_documents($insertData);	

				redirect('sdocs/upload_documents/'.$id);

    		}else{
    			$error = $document_uploaded['error'];
    		}

    	}

    	$data['error'] = $error;

    	$data['documents'] = $this->sdoc->get_documents_by_store_id($id);


    	$this->load->view('listing_client_documents.php',$data);		
		
    }
	
	function delete_document($id=0,$file_name=null){
    	if($id){
    		$user_details=$this->session->userdata('logged_in');
	        $user_role=$user_details->user_role;
	        if($user_role==1){
	        	//Delete document if current user is admin

	        	unlink('./uploads/documents/' . $file_name);
	        	$this->db->delete('sdocs', array('id' => $id));

	        	$this->load->library('user_agent');
		        redirect($this->agent->referrer());

	        }
    	}
    }
	

}

