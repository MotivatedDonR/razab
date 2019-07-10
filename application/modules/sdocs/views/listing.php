<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Client Document
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Document Management </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
						<th>Upload Documents</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($Sdocs as $Sdoc) {
                        $status_class = 'danger';
                        $status_text = 'Inactive';
                        if ($Sdoc->status){
                            $status_class = 'success';
                            $status_text = 'Active';
                        }
                         
                        ?>
                        <tr>
                            <td><?php echo $Sdoc->name; ?></td>
                            <td><?php echo $Sdoc->address; ?></td>
							<td><a href="<?php echo base_url().'sdocs/upload_documents/'.$Sdoc->id;?>" class="btn btn-success btn-xs">Documents</a></td>
                            <td><a href="<?php echo base_url().'Sdocs/togglestatus/'.$Sdoc->id;?>"><span class="label label-<?php echo $status_class;?>"><?php echo $status_text?></span></a> </td>
                            <td><div class="btn-group btn-group-xs"><a href="<?php echo base_url().'sdocs/edit/'.$Sdoc->id;?>" class="btn btn-info">Edit</a> <a href="<?php echo base_url().'sdocs/delete/'.$Sdoc->id;?>" class="btn btn-danger del">Delete</a></div> </td>
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