  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Messages
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Messages</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <?php if($this->session->userdata('logged_in')->user_role !=1){?>
          <a href="javascript:sendMessage();" class="btn btn-primary btn-block margin-bottom">Compose</a>
          <?php }?>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-danger pull-right" id="inbox-counter"></span></a></li>
                <li><a href="<?php echo base_url('messages/stores');?>"><i class="fa fa-envelope-o"></i> Store Messages
                    <span class="label label-primary pull-right" id="store-counter"></span></a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <!-- <input type="text" class="form-control input-sm" placeholder="Search Mail"> -->
                  <!-- <span class="glyphicon glyphicon-search form-control-feedback"></span> -->
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th><button type="button" class="btn btn-default btn-sm refresh-msg"><i class="fa fa-refresh"></i></button></th>
                            <th>Sender</th>
                            <th>Last Message</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                  <tbody id="messages-content">
                  
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                
                <button type="button" class="btn btn-default btn-sm refresh-msg"><i class="fa fa-refresh"></i></button>
                
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Send Message to Admin</h4>
              </div>
              <div class="modal-body">
                
                  <div class="form-group">
                    <label for="message" class="col-form-label">Message:</label>
                    <textarea class="form-control" id="message"></textarea>
                  </div>
               
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
    $('#example1').DataTable();

    $(document).ready(function(){
        $(".del").click(function(){
            if (!confirm("Do you want to delete")){
                return false;
            }
        });
    });



    $(document).ready(function(){
        getInbox();
    });

    $('.refresh-msg').click(function(){
        $('.fa-refresh').addClass('fa-spin');
        getInbox();
        setTimeout(function(){ 
            $('.fa-refresh').removeClass('fa-spin');
        }, 2000);
        
    });

    function getInbox(){
        $.get('<?php echo base_url('messages/getInboxMessages');?>')
        .done(function(data){
            var messages = JSON.parse(data);
			console.log(messages);
            var inboxData = '';
            messages.forEach(function(message){
                inboxData += '<tr><td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td><td class="mailbox-name"><a href="<?php echo base_url('messages/inboxview/'); ?>'+message.from_id+'">'+message.first_name+' '+message.last_name+'</a></td><td class="mailbox-subject">'+message.last_message.substring(0,70)+'</td><td class="mailbox-date">'+new Date(message.last_message_time).toLocaleString().split(',')[0]+'</td><td style="width:12%"><div class="btn-group btn-group-xs"><button type="button" class="btn btn-danger del_message" onClick="delete_message('+message.from_id+');" >Delete</button></div> </td></tr>';
            });
                            
            $('#messages-content').html(inboxData);
            $('#inbox-counter').html(messages.length);
        });

        $.get('<?php echo base_url('messages/getStoreMessages');?>')
        .done(function(data){
            console.log(data);
            var messages = JSON.parse(data);
            $('#store-counter').html(messages.length);
        });
    }

	
	function delete_message(from_id=0){
		
			//return alert(from_id);
				if (!confirm("Do you want to delete")){
					return false;
				}else{		
					$.post('<?php echo base_url('messages/delete') ?>',{from_id:from_id})
					.done(function(data){
						alert('Message Delete');
						getInbox();
					});
				}
	}

    function sendMessage(){
      $('#modal-default').modal('show');
    }

    $('#send-msg').click(function(){
      
        var message = $('#message').val();
        
        $.post('<?php echo base_url('messages/sendMesageToAdmin') ?>',{message:message})
        .done(function(data){
            if(data == '1'){
                alert('Message Sent');
                $('#modal-default').modal('hide');
            }
        });
    });

</script>