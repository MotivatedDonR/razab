<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Reportad
        <small>Fill up the form bellow</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Reportads</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Reportad Edit</h3>
            </div>
            <?php echo form_open(current_url()); ?>
            <div class="box-body">
                <div class="row clearfix">

                    <div class="col-md-6">
                        <label for="ad_message" class="control-label"><span class="text-danger">*</span>Ad essage</label>
                        <div class="form-group">
                            <input type="text" name="ad_message" value="<?php echo $reportad->ad_message; ?>" class="form-control" id="ad_message" />
                            <span class="text-danger"><?php echo form_error('ad_message');?></span>
                        </div>
                    </div>

                    
                   
                     <div class="col-md-3">
                        <label for="status" class="control-label">Status</label>
                        <div class="form-group">
                        <input type="radio" name="status" class="minimal" value="1" id="status" <?php if($reportad->status=='1')echo "checked";?>>Active
                        <input type="radio" name="status" class="minimal" value="0" id="status"<?php if($reportad->status=='0')echo "checked";?>>Inactive
                            
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
  
