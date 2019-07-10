<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add New page
        <small>Enter content and title</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">pages</a></li>
        <li class="active">Add</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">New Page</h3>
            </div>
            <?php echo form_open(current_url()); ?>
            <div class="box-body">
                <div class="row clearfix">

                    <div class="col-md-6">
                        <label for="name" class="control-label"><span class="text-danger">*</span>Title</label>
                        <div class="form-group">
                            <input type="text" name="title" value="<?php echo $this->input->post('title'); ?>" class="form-control" id="title" />
                            <span class="text-danger"><?php echo form_error('title');?></span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="name" class="control-label"><span class="text-danger">*</span>Slug</label>
                        <div class="form-group">
                            <input type="text" name="permalink" value="<?php echo $this->input->post('permalink'); ?>" class="form-control" id="permalink" />
                            <span class="text-danger"><?php echo form_error('permalink');?></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                      <textarea id="editor1" name="content" rows="10" cols="80"><?php echo $this->input->post('content'); ?></textarea>
                    </div>
              
                  
                     <div class="col-md-3">
                        <label for="status" class="control-label">Status</label>
                        <div class="form-group">
                        <input type="radio" name="status" class="minimal" value="1" id="status">Active
                        <input type="radio" name="status" class="minimal" value="0" id="status" checked>Inactive
                            
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
  $(function () {
    CKEDITOR.replace('editor1')
  });


  $('#title').blur(function(){
      var title = $(this).val();
      var permalink = filterStringForPermalink(title);
      $('#permalink').val(permalink);
  });


  function filterStringForPermalink(permalink) {
        permalink = permalink.replace(/[^a-zA-Z0-9]/g, " ");
        permalink = permalink.replace(/  +/g, ' ');
        permalink = permalink.trim();
        permalink = permalink.replace(/[ ]/g, '-');
        permalink = permalink.toLowerCase();
        return permalink;
    }
</script>
