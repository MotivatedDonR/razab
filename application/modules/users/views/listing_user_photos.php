<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Photo Manager
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Manage Uploads of <?php ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Uploaded Photo</th>
                        <th>Date</th>
                        <th>Admin Comments</th>
                        <th>Verified Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($user_photos as $photo) {
                        $status_class = 'danger';
                        $status_text = 'Not Verified';
                        if ($photo->verified){
                            $status_class = 'success';
                            $status_text = 'Verified';
                        }
                        ?>
                        <tr>
                            <td><img src="<?php echo base_url().'uploads/gallery/'.$photo->file_name; ?>" height="200" width="200"/></td>
                            <td><?php echo date('Y-m-d',strtotime($photo->timestamp));?></td>
                            <td><div class="comment_section"><textarea class="form-control comment_text" placeholder="Write your comments here" rows="6"><?php echo $photo->comment;?></textarea><button data-id="<?php echo $photo->id;?>" type="button" class="btn btn-primary btn-sm comment_btn pull-right">Update</button></div></td>
                            <td><a href="<?php echo base_url().'users/verifiedimagetoggle/'.$photo->id;?>"><span class="label label-<?php echo $status_class;?>"><?php echo $status_text?></span></a> </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Uploaded Photo</th>
                        <th>Date</th>
                        <th>Admin Comments</th>
                        <th>Verified Status</th>
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



<script>
    //$('#example1').DataTable();
    
    $(document).ready(function(){
        $(".del").click(function(){
            if (!confirm("Do you want to delete")){
                return false;
            }
        });
    });



    $('.comment_btn').click(function(){
        var button = $(this);
        button.html('<i class="fa fa-refresh fa-spin"></i>');
        var photo_id = button.attr('data-id');
        var comment_section = button.parent();
        var comment = comment_section.find('textarea').val();
        $.post("<?php echo base_url();?>users/update_photo_comment",{photo_id:photo_id,comment:comment})
            .done(function(res){
                if(res == '1'){
                    console.log('Comment Updated');
                    button.html('Updated <i class="fa fa-right"></i>');

                }else{
                    console.log('ERROR Updating comment');
                }
                
            })
    })


</script>