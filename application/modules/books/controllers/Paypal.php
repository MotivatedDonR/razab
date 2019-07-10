<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class Paypal extends MY_Controller {

     function  __construct(){
        parent::__construct();
        
        // Load paypal library & product model
        $this->load->library('paypal_lib');
        $this->load->model('product');
		$this->load->model('Book');
     }
     
    function success(){
		
		 
		
        // Get the transaction data
        //$paypalInfo = $this->input->get();
		$paypalInfo = $_POST;

        $data['payer_id']      = $paypalInfo['payer_id'];
        $data['txn_id']         = $paypalInfo["txn_id"];
        $data['payment_amt']    = $paypalInfo["payment_gross"];
        $data['currency_code']  = $paypalInfo["mc_currency"];
        $data['status']         = $paypalInfo["payment_status"];
        
        $this->load->view('paypal/success', $data);
    }
     
     function cancel(){
        // Load payment failed view
		$data['client_id']=$this->uri->segment(4);
        $data['ad_id']=$this->uri->segment(5);
        $this->load->view('paypal/cancel',$data);
     }
     
     function ipn(){
        // Paypal posts the transaction data
		
		$last_id=$this->uri->segment(4);
        $temp_booking=$this->Book->fetch_temp_booking($last_id);
        $params=array(
            'booking_person_name'=> $temp_booking->booking_person_name,
            'booking_person_email'=> $temp_booking->booking_person_email,
            'booking_person_number'=> $temp_booking->booking_person_number,    
			'appointment_date'=> $temp_booking->appointment_date,
            'appointment_method'=> 1,                
            'user_id'=> $temp_booking->user_id, 
            'ad_id'=>$temp_booking->ad_id
        );
        $last_booking_id=$this->Book->add_appointment_via_que($params);      
        $this->Book->delete_temp_booking($last_id);
		
        $paypalInfo = $this->input->post();
		
		
        if(!empty($paypalInfo)){
            // Validate and get the ipn response
            $ipnCheck = $this->paypal_lib->validate_ipn($paypalInfo);

            // Check whether the transaction is valid
            if($ipnCheck){
                // Insert the transaction data in the database
				$data['booking_person_id']        = $last_booking_id;
                $data['txn_id']        = $paypalInfo["txn_id"];
                //$data['payment_gross']        = $paypalInfo["payment_gross"];
				$data['payment_gross']        = $paypalInfo["mc_gross"];
                $data['currency_code']            = $paypalInfo["mc_currency"];
                $data['payer_email']    = $paypalInfo["payer_email"];
                $data['payment_status'] = $paypalInfo["payment_status"];

                $result=$this->product->insertTransaction($data);
				if($result){
					return $result;
				}else{
					return 0;
				}
					
            }
        }
    }
}