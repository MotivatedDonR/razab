<?php 
$usr_id = $this->uri->segment(3);
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            My Flyers
            <small><a href="<?php echo base_url().'flyers/add/'.$usr_id;?>" class="btn btn-primary btn-sm">Add New</a> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="#">Flyers</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Flyers Management </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Expiry Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($flyers as $flyer) {
                        $status_class = 'danger';
                        $status_text = 'Inactive';
                        if ($flyer->status){
                            $status_class = 'success';
                            $status_text = 'Active';
                        }
                         
                        ?>
                        <tr>
                            <td><img class="img-responsive" height="100px" width="100px" src="<?php echo base_url('uploads/flyers/').$flyer->image; ?>" /></td>
                            <td><?php echo date('Y-m-d',strtotime($flyer->expiry)); ?></td>
                            <td><a href="<?php echo base_url().'flyers/togglestatus/'.$flyer->id;?>"><span class="label label-<?php echo $status_class;?>"><?php echo $status_text?></span></a> </td>
                            <td><div class="btn-group btn-group-xs"><a href="<?php echo base_url().'flyers/edit/'.$flyer->id;?>" class="btn btn-info">Edit</a> <a href="<?php echo base_url().'flyers/delete/'.$flyer->id;?>" class="btn btn-danger del">Delete</a></div> </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
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



<script>
    $('#example1').DataTable();

    $(document).ready(function(){
        $(".del").click(function(){
            if (!confirm("Do you want to delete")){
                return false;
            }
        });
    });


</script>