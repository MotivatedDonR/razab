<?php  
/* echo'<pre>';
print_r($countings->non_login_visite);
die; */

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Client Guest Details<small>[By Numbers]</small>
        </h1>

        <h1>
            
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row" >
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner" style="padding:30px">
                    <div style="font-size:16px; font-weight:bold; margin-bottom:20px;">Client Name: <?php  echo $user->first_name.' '.$user->last_name; ?></div>
                        <h3>
                            <?php echo $suscribe_count; ?>
                        </h3>                      

                        <p>Guest Through Live Queue</p>
                    </div>
                    
                    <div class="icon">
                        <i class="fa fa fa-check"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner" style="padding:30px">
                    <div style="font-size:16px; font-weight:bold; margin-bottom:20px;">Client Name: <?php  echo $user->first_name.' '.$user->last_name; ?></div>
                        <h3>
                            <?php echo $complete_count; ?>
                        </h3>
                       
                        <p>Suscribed Guest</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bell-slash"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner" style="padding:30px">
                    <div style="font-size:16px; font-weight:bold; margin-bottom:20px;">Client Name: <?php  echo $user->first_name.' '.$user->last_name; ?></div>
                        <h3>
                            <?php echo $queue_count; ?>
                        </h3>
                       
                        <p>Guest In Queue</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-database"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>



<script>
    $('#example1').DataTable();

    $(document).ready(function () {
        $(".del").click(function () {
            if (!confirm("Do you want to delete")) {
                return false;
            }
        });
    });
</script>