<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Book Appointment</h3>
            </div>
            <div id="suc_msg"></div>
            <?php echo form_open(current_url()); ?>
            <div class="box-body">
                <div class="row clearfix">

                    <div class="col-md-6">
                        <label for="name" class="control-label">Name</label>
                        <div class="form-group">
                            <input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control"
                                id="name" />
                            <div id="verify_name"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="control-label">Email</label>
                        <div class="form-group">
                            <input type="text" name="email" value="<?php echo $this->input->post('email'); ?>" class="form-control"
                                id="email" />
                            <div id="verify_email"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="number" class="control-label">Phone Number</label>
                        <div class="form-group">
                            <input type="text" name="number" value="<?php echo $this->input->post('number'); ?>" class="form-control"
                                id="number" />
                            <div id="verify_number"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="number" class="control-label">Appointment Date</label>
                        <div class="form-group">
                            
                                <div id="show_date"></div>
                            
                        </div>
                    </div>
                    <div class="col-md-3">   
                        <label for="number" class="control-label" id="appointment_label">Appointment Time</label>
                        <div class="form-group">                         
                            <div id="show_time"></div>   
                        </div>                         
                    </div>
                    <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id; ?>">
                    <input type="hidden" name="ad_id" id="ad_id" value="<?php echo $ad_id; ?>">
                </div>
            </div>
            <div class="box-footer">
                <button type="button" class="btn btn-success queue"> Enter Live Queue </button>
                <button type="button" class="btn btn-info via_payment"> Schedule Appointment via Payment </button>
                <button type="button" class="btn btn-success payment_complete"> Completed </button>
                <button type="button" class="btn btn-danger payment_pending"> Pending </button>
                <!-- <a href="<?php echo base_url().'books/payment/'.$client_id.'/'.$ad_id;?>" class="btn btn-info">Appointment</a> -->
                <!-- <a href="<?php echo base_url()?>" class="btn btn-info">Appointment</a> -->
            </div>
            <div class="last_id" style="display:none;"></div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
    $('document').ready(function () {
        $('.payment_complete').hide();
        $('.payment_pending').hide();
        $('#appointment_label').hide();
        
        show_date();

    });

    function show_date(){
        var client_id = $('#client_id').val();
        var ad_id = $('#ad_id').val();

            

        $.post("<?php echo base_url('books/get_date');?>", {
                client_id: client_id,
                ad_id: ad_id
            })
            .done(function (data) {
                //console.log(data);
                $('#show_date').append(data);

            });
    }

    

    


    $('.queue').click(function () {
        var vali_flag=0;
        validation(vali_flag);
    });

    function validation(vali_flag) {

        var name = $('#name').val();
        var email = $('#email').val();
        var number = $('#number').val();

        var name_flag = 0;
        var email_flag = 0;
        var number_flag = 0;

        if (name == '') {
            $('#verify_name').html('<div style="color:red;">Please Fillup The Name Field .</div>');
        } else {
            name_flag = 1;
            $('#verify_name').html('');
        }

        var re = /\S+@\S+\.\S+/;
        if (!(re.test(email))) {
            $('#verify_email').html('<div style="color:red;">Please Enter a Valid Email.</div>');
        } else {
            email_flag = 1;
            $('#verify_email').html('');
        }

        if (!(number.match(/^-?\d+$/))) {
            $('#verify_number').html('<div style="color:red;">Please Enter a Valid Number.</div>');
        } else {
            number_flag = 1;
            $('#verify_number').html('');
        }

        if ((email_flag == 1) && (number_flag == 1) && (name_flag == 1)) {
            if(vali_flag==0){
                in_queue();
            }else{
                via_payment();
            }
            
        }
    }
    //


    function in_queue() {

        var name = $('#name').val();
        var email = $('#email').val();
        var number = $('#number').val();
        var client_id = $('#client_id').val();
        var ad_id = $('#ad_id').val();

        $.post("<?php echo base_url('books/add_queue');?>", {
                name: name,
                email: email,
                number: number,
                client_id: client_id,
                ad_id: ad_id
            })
            .done(function (data) {
                if (data == '1') {
                    $('#suc_msg').html(
                        '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> You Have Successfully Entered in Queue.</div>'
                    );
                    //alert('Value Inserted');
                    $('.via_payment').hide();
                    $('#verify_number').html('');
                }

            });



    }

    $('.via_payment').click(function () {
        var vali_flag=1;
        //via_payment();
        validation(vali_flag);
    });

    function via_payment() {

        var name = $('#name').val();
        var email = $('#email').val();
        var number = $('#number').val();
        var client_id = $('#client_id').val();
        var ad_id = $('#ad_id').val();


        $.post("<?php echo base_url('books/add_booking_via_payment');?>", {
                name: name,
                email: email,
                number: number,
                client_id: client_id,
                ad_id: ad_id
            })
            .done(function (data) {
                console.log(data);

                if (data) {
                    $('#suc_msg').html(
                        '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Your Details Has Successfully Stored.</div>'
                    );
                    $('.last_id').html(data);
                    //alert('Value Inserted');
                    $('.queue').hide();
                    $('.via_payment').hide();
                    $('.payment_complete').show();
                    $('.payment_pending').show();
                }

            });

    }


    $('.payment_complete').click(function () {
        payment_complete();
    });

    function payment_complete() {

        var last_id = $('.last_id').text();

        $.post("<?php echo base_url('books/payment_complete');?>", {
                last_id: last_id
            })
            .done(function (data) {
                console.log(data);

                if (data) {
                    $('#suc_msg').html(
                        '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> Payment Completed Successfully.</div>'
                    );
                    $('.payment_pending').hide();
                }

            });

    }

    $('.payment_pending').click(function () {
        $('.payment_complete').hide();
    });
</script>