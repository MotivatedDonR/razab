<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Client Documents
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">


      <?php 
        //Visible only for Admins

      $user_details = $this->session->userdata('logged_in');

      if($user_details->user_role == 1){

      ?>

      <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Document Upload</h3>
              </div>
            
            <?php echo form_open_multipart(current_url()); ?>
            <div class="box-body">
              <?php 
                    if($error){
                        echo '<div class="alert alert-danger">'.$error.'</div>';
                    }
                  ?>

                <div class="row clearfix">

                    <div class="col-md-4">
                        <label for="document_name" class="control-label"><span class="text-danger">*</span>Document Name</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="document_name"  required id="document_name"/>  
                        </div> 
                    </div>

                    <div class="col-md-4">
                        <label for="document_details" class="control-label">Document Details</label>
                        <div class="form-group">
                            <textarea type="text" class="form-control" name="document_details" id="document_details"></textarea>  
                        </div> 
                    </div>

                     <div class="col-md-4">
                        <label for="userfile" class="control-label"><span class="text-danger">*</span>Upload Document</label>
                        <div class="form-group">
                            <input type="file" class="form-control" name="userfile"  required id="userfile" />
                            
                        </div> 
                    </div>
                </div>
            </div>
                             
            <div class="box-footer">
                <button type="submit" class="btn btn-success" name="save" id="save">
                    <i class="fa fa-check"></i> Save
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
      <!-- /.box -->

      <?php 
        }
      ?>




        <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Uploaded Documents</h3>
              </div>
            <div class="box-body">
                
            </div>
                             
            <div class="box-footer">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Document Name</th>
                        <th>Document Details</th>
                        <th>Uploaded Date</th>
                        <th>View Document</th>
                        <?php 
                          if($user_details->user_role == 1){
                              echo "<th>Action</th>";
                          }
                        ?>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($documents as $document) {
                      
                        ?>
                        <tr>
                            <td><?php echo $document->document_name; ?></td>
                            <td><?php echo $document->document_details; ?></td>
                            <td><?php echo date('Y-m-d', strtotime($document->timestamp)); ?></td>
                            
                            <td><a target="_blank" class="btn btn-xs btn-info" href="<?php echo base_url('uploads/documents/').$document->file_name;?>"><i class="fa fa-search"></i> View / Download</a></td>
                            <?php 
                            if($user_details->user_role == 1){
                             
                            ?>
                            <td><a class="btn btn-xs btn-danger del" href="<?php echo base_url('sdocs/delete_document/').$document->id.'/'.$document->file_name;?>"><i class="fa fa-times"></i> Delete</a></td>
                            <?php 
                              }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Document Name</th>
                        <th>Document Details</th>
                        <th>Uploaded Date</th>
                        <th>View Document</th>
                        <?php 
                          if($user_details->user_role == 1){
                              echo "<th>Action</th>";
                          }
                        ?>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
      <!-- /.box -->
      
     

    </section>
    <!-- /.content -->
  </div>

  <script type="text/javascript">
    $(document).ready(function(){
        $(".del").click(function(){
            if (!confirm("Do you want to delete")){
                return false;
            }
        });
    });
  </script>