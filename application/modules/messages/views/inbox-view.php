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
                <li class="active"><a href="<?php echo base_url('messages');?>"><i class="fa fa-inbox"></i> Inbox
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
          <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Direct Chat</h3>

                  <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="3 New Messages"><?php echo count($messages); ?></span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <!-- Conversations are loaded here -->
                  <div class="direct-chat-messages" style="height: 100% !important;">

                    <?php 

                        foreach ($messages as $message) {
                          if($message->from_id == $from_user->id){


                        
                    ?>
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left"><?php echo $from_user->first_name.' '.$from_user->last_name;?></span>
                        <span class="direct-chat-timestamp pull-right"><?php echo date('Y-m-d h:i:s A',strtotime($message->timestamp))?></span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="<?php echo base_url('uploads/profile_pictures/').$from_user->image;?>" alt="message user image">
                      <?php

                      $user_id = $message->from_id;
                      $login_status = $this->db->select('login_status')
                      ->get_where('users', array('id' => $user_id))
                      ->row()
                       ->login_status;
                       if($login_status=='1'){

                      ?>
                      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    <?php }else{ ?>
        <a href="#"><i class="fa fa-circle text-danger"></i> Offline</a>
                    <?php } ?>
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                       <?php if(!empty($message->file_path)&& !empty($message->message)){ ?>
                          <?php
                          $path = $message->file_path;
                          $full_path = base_url($path); ?>
                        <a href="<?php echo  $full_path ; ?>">Link</a>
                        <br>
                        <?php echo $message->message; ?>
                        <?php } else if(isset($message->file_path)){

                          $path = $message->file_path;
                          $full_path = base_url($path); ?>
                        <a href="<?php echo  $full_path ; ?>">Link</a>
                          <?php
                        }else{  ?>
                        <?php echo $message->message; }?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                    <?php 

                  }else{
                    ?>

                    <!-- Message to the right -->

                    <div class="direct-chat-msg right">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-right"><?php echo $this->session->userdata('logged_in')->first_name.' '.$this->session->userdata('logged_in')->last_name;?></span>
                        <span class="direct-chat-timestamp pull-left"><?php echo date('Y-m-d h:i:s A',strtotime($message->timestamp))?></span>
                      </div>
                      <!-- /.direct-chat-info -->

                      <img class="direct-chat-img" src="<?php echo base_url('uploads/profile_pictures/').$this->session->userdata('logged_in')->image;?>" alt="message user image">
                       <?php

                     
                      $user_id = $_SESSION['logged_in']->id;
                      $login_status = $this->db->select('login_status')
                      ->get_where('users', array('id' => $user_id))
                      ->row()
                       ->login_status;
                       if($login_status=='1'){

                      ?>
                      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    <?php }else{ ?>
              <a href="#"><i class="fa fa-circle text-danger"></i> Offline</a>
                    <?php } ?>
                      <style type="text/css">
                       .right #on{
                        margin-left: 600px !important;
                       }
                      </style>
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        <?php if(!empty($message->file_path)&& !empty($message->message)){ ?>
                          <?php
                          $path = $message->file_path;
                          $full_path = base_url($path); ?>
                        <a href="<?php echo  $full_path ; ?>">Link</a>
                        <br>
                        <?php echo $message->message; ?>
                        <?php } else if(isset($message->file_path)){

                          $path = $message->file_path;
                          $full_path = base_url($path); ?>
                        <a href="<?php echo  $full_path ; ?>">Link</a>
                          <?php
                        }else{  ?>
                        <?php echo $message->message; }?>
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                    <?php
                      }
                     }?>

                  </div>
                  <!--/.direct-chat-messages-->
                </div>
                <!-- /.box-body -->
           
                     <div class="box-footer">
                      <form action="<?php echo current_url();?>" method="post" enctype="multipart/form-data">
                        
                      <div class="input-group" style="width: 100%;">
                      
                      <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                      <input type="hidden" name="to_id" value="<?php echo $from_user->id;?>">
                      <input type="hidden" name="to_id" value="<?php echo $from_user->id;?>">
                                 
                         Upload:<input type="file" name="fileToUpload" id="fileToUpload"   >	
                         
   <button type="submit" class="btn btn-warning btn-flat" style=" margin-left: 235px;
    margin-top: -43px;
">Send</button>
                          	</div>
                        
                    
                  </form>
            </div>
                  <div class="sidenav">
               <!--  <form action="<?php //echo base_url('messages/fileshare');?>" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="to_id" value="<?php //echo $from_user->id;?>">
                  Upload:
                  <input type="file" name="fileToUpload" id="fileToUpload">
                  <input type="submit" value="Upload" name="submit">
              </form> -->

                    </div>
                </div>
                <!-- /.box-footer-->
              </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<script>
    

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
                  

   