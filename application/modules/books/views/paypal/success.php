<div class="col-lg-12">
    <h4 class="success">Thank you! Your payment was successful.</h4>
    <p>Your ID : <span><?php echo $payer_id; ?></span></p>
    <p>TXN ID : <span><?php echo $txn_id; ?></span></p>
    <p>Amount Paid : <span>$<?php echo $payment_amt.' '.$currency_code; ?></span></p>
    <p>Payment Status : <span><?php echo $status; ?></span></p>
    
    <a href="<?php echo base_url(); ?>">Back to Home</a>
</div>

