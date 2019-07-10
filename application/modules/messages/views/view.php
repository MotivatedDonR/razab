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
              <h3 class="box-title">Read Message</h3>

              
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3>From: <?php echo $message->from_name;?></h3>
                <h4>For Store: <?php echo $message->store_name;?></h4>
                <h5>From Email: <?php echo $message->form_email;?>
                  <span class="mailbox-read-time pull-right"><?php echo date('Y-m-d h:i:s A',strtotime($message->timestamp));?></span></h5>
              </div>
              
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <?php echo $message->message;?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <!-- <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Reply</button> -->
              </div>
              <a href="#" class="btn btn-default del"><i class="fa fa-trash-o"></i> Delete</a>
            </div>
            <!-- /.box-footer -->
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


<script>
    

    $(".del").click(function(){
            if (!confirm("Do you want to delete")){
                return false;
            }else{
				var msg_id=<?php echo $message->id; ?>;			
				
				$.post("<?php echo base_url('messages/delete_msg');?>", {
					msg_id: msg_id
				})
				.done(function (data) {
					//console.log(data);
					//window.location = window.<?php echo base_url('messages/delete_msg'); ?>;
					window.location.href = "<?php echo base_url('messages/stores'); ?>";
				});
						
			}
        });
	
	



    $(document).ready(function(){
        getInbox();
    });

    function getInbox(){
        $.get('<?php echo base_url('messages/getInboxMessages');?>')
        .done(function(data){
            var messages = JSON.parse(data);
            $('#inbox-counter').html(messages.length);
        });

        $.get('<?php echo base_url('messages/getStoreMessages');?>')
        .done(function(data){
            //console.log(data);
            var messages = JSON.parse(data);
            $('#store-counter').html(messages.length);
        });
    }


</script>