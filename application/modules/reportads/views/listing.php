<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            My Reportads
            <small><a href="<?php echo base_url().'reportads/add';?>" class="btn btn-primary btn-sm">Add New</a> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="#">Reportads</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Reportads Management </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Ad Message</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($reportads as $reportad) {
                        $status_class = 'danger';
                        $status_text = 'Inactive';
                        if ($reportad->status){
                            $status_class = 'success';
                            $status_text = 'Active';
                        }
                         
                        ?>
                        <tr>
                            <td><?php echo $reportad->ad_message; ?></td>
                            <td><a href="<?php echo base_url().'reportads/togglestatus/'.$reportad->id;?>"><span class="label label-<?php echo $status_class;?>"><?php echo $status_text?></span></a> </td>
                            <td><div class="btn-group btn-group-xs"><a href="<?php echo base_url().'reportads/edit/'.$reportad->id;?>" class="btn btn-info">Edit</a> <a href="<?php echo base_url().'reportads/delete/'.$reportad->id;?>" class="btn btn-danger del">Delete</a></div> </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Ad Message</th>
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