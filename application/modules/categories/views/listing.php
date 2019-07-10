<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Category Management
            <small><a href="<?php echo base_url().'categories/add';?>" class="btn btn-primary btn-sm">Add New</a> </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="#">Categories</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Categories management Listing</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($categories as $category) {
                        $status_class = 'danger';
                        $status_text = 'Inactive';
                        if ($category->status){
                            $status_class = 'success';
                            $status_text = 'Active';
                        }
                         
                        ?>
                        <tr>
                            <td><?php echo $category->name; ?></td>
                            <td><?php echo $category->description; ?></td>
                            <td><a href="<?php echo base_url().'categories/togglestatus/'.$category->id;?>"><span class="label label-<?php echo $status_class;?>"><?php echo $status_text?></span></a> </td>
                            <td><div class="btn-group btn-group-xs"><a href="<?php echo base_url().'categories/edit/'.$category->id;?>" class="btn btn-info">Edit</a> <a href="<?php echo base_url().'categories/delete/'.$category->id;?>" class="btn btn-danger del">Delete</a></div> </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
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