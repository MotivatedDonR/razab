<?php
    $cert='';
    if(isset($_GET['certificate'])){

        $cert=$_GET['certificate'];
    }
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Client Management
            <small><a href="<?php echo base_url().'users/add';?>" class="btn btn-primary btn-sm">Add New</a> </small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="box-body ">Clients & Advertisements</h3>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Select Filter</label>
                          <div class="col-sm-9">
                              <select class="form-control certificate_filter" id="filter">
                                <option value="">View All</option>
                                <option <?php echo $cert=='active'?'selected':''; ?> value="active">Active Certificates</option>
                                <option <?php echo $cert=='expired'?'selected':''; ?> value="expired">Expired Certificates</option>
                              </select>
                          </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name </th>
                        <th>Email & Phone</th>
						<th>Client Advertisements</th>
                        <th>Guests</th>
                        <th>Upload Documents</th>
                        <th>Certificate Expiry Date</th> 
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($users as $user) {
                        $status_class = 'danger';
                        $status_text = 'Inactive';
                        if ($user->status){
                            $status_class = 'success';
                            $status_text = 'Active';
                        }

                       // $admin_class = 'info';
                        //$admin_text = 'Advertiser';
                        /*if ($user->admin){
                            $admin_class = 'danger';
                            $admin_text = 'Administrator';
                        }*/
                        ?>
                        <tr>
                            <td><?php echo $user->first_name.''.$user->last_name ; ?></td>
                            <td><i class="fa fa-envelope-o"></i>  <?php echo $user->email; ?><br/>
                                <i class="fa fa-phone"></i>  +<?php echo $user->phone; ?>
                            </td>
                            
							<td>
                                <a href="<?php echo base_url().'users/adds_listing?client_id='.$user->id;?>" class="btn btn-success btn-xs">Advertisements</a>
                                
                            </td>
                            <td>
                                <a href="<?php echo base_url().'books/guest_listing/'.$user->id;?>" class="btn btn-success btn-xs">Guests</a>
                                
                            </td>
                            <td><a href="<?php echo base_url().'users/client_documents/'.$user->id;?>" class="btn btn-success btn-xs">Documents</a></td>
                            <td style="width:15%">
                                <div class="input-group date">
                                    <input readonly type="text" value="<?php echo date('Y-m-d',strtotime($user->certificate_expiry)); ?>" class="form-control datepicker">
                                  <span class="input-group-btn">
                                    <button data-id="<?php echo $user->id;?>" class="btn btn-success save-expiry-btn" type="button"><i class="fa fa-save"></i></button>
                                  </span>                                  
                                </div>                                
                            </td> 
                            <td><a href="<?php echo base_url().'users/togglestatus/'.$user->id;?>"><span class="label label-<?php echo $status_class;?>"><?php echo $status_text?></span></a> </td>
                            <td style="width:12%"><div class="btn-group btn-group-xs"><a href="javascript:sendMessage('<?php echo $user->id;?>','<?php echo $user->email;?>')" class="btn btn-warning"><i class="fa fa-envelope-o"></i></a><a href="<?php echo base_url().'users/edit/'.$user->id;?>" class="btn btn-info"><i class="fa fa-edit"></i></a> <a href="<?php echo base_url().'users/delete/'.$user->id;?>" class="btn btn-danger del"><i class="fa fa-times"></i></a></div> </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name </th>
                        <th>Email & Phone</th>
                        <th>Client Advertisements</th>
                        <th>Guest</th>
                        <th>Upload Documents</th>
                        <th>Certificate Expiry Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>


<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Send Message</h4>
              </div>
              <div class="modal-body">
                
                  <div class="form-group">
                    <label for="message" class="col-form-label">Message:</label>
                    <textarea class="form-control" id="message"></textarea>
                  </div>
                  <input type="hidden" name="to_id" id="to_id" value="">
				  <input type="hidden" name="to_email" id="to_email" value="">
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button id="send-msg" type="button" class="btn btn-primary">Send</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->



<script>
    $('#example1').DataTable()
    .on('draw.dt', function () { 
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            startDate: '-0d',
            todayHighlight:'TRUE',
            autoclose: true,
        });

        $('.save-expiry-btn').click(function(){
            var user_id = $(this).attr('data-id');
            var exp_date = $(this).parent().siblings('.datepicker').val();
            //console.log(exp_date);

            $.post("<?php echo base_url('users/save_certificate_expiry');?>",{user_id:user_id,exp_date:exp_date})
            .done(function(data){
                if(data == '1'){
                    alert('Expiry Date Saved');
                }

            });
        });


    });
    
    $(document).ready(function(){
        $(".del").click(function(){
            if (!confirm("Do you want to delete")){
                return false;
            }
        });
    });


    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-0d',
        todayHighlight:'TRUE',
        autoclose: true,
    });


    $('.save-expiry-btn').click(function(){
        var user_id = $(this).attr('data-id');
        var exp_date = $(this).parent().siblings('.datepicker').val();
        //console.log(exp_date);

        $.post("<?php echo base_url('users/save_certificate_expiry');?>",{user_id:user_id,exp_date:exp_date})
        .done(function(data){
            if(data == '1'){
                alert('Expiry Date Saved');
            }

        });
    });



    // function save_expiry(user_id,e){
    //     console.log($(this));
    //     //var user_id = $(this).attr('data-id');
    //     var exp_date = e.parent().siblings('.datepicker').val();
    //     //console.log(exp_date);

    //     $.post("<?php echo base_url('users/save_certificate_expiry');?>",{user_id:user_id,exp_date:exp_date})
    //     .done(function(data){
    //         if(data == '1'){
    //             alert('Expiry Date Saved');
    //         }

    //     });
    // }


    $('.certificate_filter').change(function(){

     var filter_value = $(this).val();;

        // console.log(filter_value);

        window.location.href = "<?php echo base_url('users/index');?>?certificate="+filter_value;

     });


    function sendMessage(to_id,to_email){
		$('#to_email').val(to_email);
        $('#to_id').val(to_id);
        $('#modal-default').modal('show');
    }


    $('#send-msg').click(function(){
        var to_id = $('#to_id').val();
        var message = $('#message').val();
		var to_email = $('#to_email').val();
        
        $.post('<?php echo base_url('messages/sendclientmessage') ?>',{to_id:to_id,message:message})
        .done(function(data){
            if(data == '1'){
                console.log(data);
                alert('Message Sent');
                $('#modal-default').modal('hide');
            }
        });
    });
	
	
	


</script>