<?php  
/* echo'<pre>';
print_r($countings->non_login_visite);
die; */

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard 
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $countings->non_login_visite; ?></h3>

              <p>Site Visited By Guest Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $countings->login_visite; ?></h3>

              <p>Site Visited By Logged In Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>            
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $clients; ?></h3>

              <p> Number of Clients</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
           </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $ads; ?></h3>

              <p>Number of Advertisements</p>
            </div>
            <div class="icon">
              <i class="fa fa-bullhorn"></i>
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

    $(document).ready(function(){
        $(".del").click(function(){
            if (!confirm("Do you want to delete")){
                return false;
            }
        });
    });


</script>