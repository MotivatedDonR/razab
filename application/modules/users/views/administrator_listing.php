<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Administrator Management
            <small><a href="<?php echo base_url().'users/add';?>" class="btn btn-primary btn-sm">Add New</a> </small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Administrator Listing</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name </th>
                        <th>Email</th>
                        <th>phone</th>
                        <th>User Role</th>
                        <th>Status</th>
                        <th>Edit/Delete?</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($administrator as $user) {
                        $status_class = 'danger';
                        $status_text = 'Inactive';
                        if ($user->status){
                            $status_class = 'success';
                            $status_text = 'Active';
                        }

                       // $admin_class = 'info';
                        //$admin_text = 'Advertiser';
                        /*if ($user->admin){
                            $admin_class = 'danger';
                            $admin_text = 'Administrator';
                        }*/
                        ?>
                        <tr>
                            <td><?php echo $user->first_name.''.$user->last_name ; ?></td>
                            <td><?php echo $user->email; ?></td>
                            <td><?php echo $user->phone; ?></td>
                            <td><?php echo $user->role; ?></td>
                            <td><a href="<?php echo base_url().'users/togglestatus/'.$user->id;?>"><span class="label label-<?php echo $status_class;?>"><?php echo $status_text?></span></a> </td>
                            <td><div class="btn-group btn-group-xs"><a href="<?php echo base_url().'users/edit/'.$user->id;?>" class="btn btn-info">Edit</a> <a href="<?php echo base_url().'users/delete/'.$user->id;?>" class="btn btn-danger del">Delete</a></div> </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name </th>
                        <th>Email</th>
                        <th>phone</th>
                        <th>User Role</th>
                        <th>Status</th>
                        <th>Edit/Delete?</th>
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