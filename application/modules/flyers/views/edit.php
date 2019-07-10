<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Flyer
        <small>Fill up the form bellow</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Flyers</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Flyer Edit</h3>
            </div>
            <?php echo form_open_multipart(current_url()); ?>
            <div class="box-body">
                <div class="row clearfix">

                   <!-- <div class="col-md-6">
                        <label for="userfile" class="control-label"><span class="text-danger">*</span>Image</label>
                        <div class="form-group">
                            <input type="file" name="userfile" class="form-control" id="userfile" multiple="multiple" />
                            <span class="text-danger"><?php if(isset($error)) echo $error;?></span>
                        </div>
                    </div> -->
                     <div class="form-group col-md-6">
                        <label>Expiry Date:</label>

                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" value="<?php echo date('Y-m-d',strtotime($flyer->expiry))?>" name="expiry" class="form-control pull-right" id="datepicker">
                        </div>
                        <!-- /.input group -->
                        <span class="text-danger"><?php echo form_error('expiry');?></span>
                      </div>
                    <div class="col-md-6">
                      <img class="img-responsive" height="100px" width="100px" src="<?php echo base_url('uploads/flyers/').$flyer->image; ?>" />
                    </div>
                     
                   
                     <div class="col-md-3">
                        <label for="status" class="control-label">Status</label>
                        <div class="form-group">
                        <input type="radio" name="status" class="minimal" value="1" id="status" <?php if($flyer->status=='1')echo "checked";?>>Active
                        <input type="radio" name="status" class="minimal" value="0" id="status"<?php if($flyer->status=='0')echo "checked";?>>Inactive
                            
                            <span class="text-danger"><?php echo form_error('status');?></span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-check"></i> Save
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  
 <script type="text/javascript">
    $('#datepicker').datepicker({
      format: "yyyy-mm-dd"
    });
  </script>
  