<?php
if($email && $order_id && $ammount){

	echo"Your Eamil is:" .$email;
	echo"Your Order Id is:" .$order_id;
	echo"Ammount is:" .$ammount;
}else{
	echo $message;
}

?>
