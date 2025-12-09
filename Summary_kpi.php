
<?php 
include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      if(isset($_POST['username'])){$usernames = $_POST['username'];}
     
    ?>
    <head>
      <title>Summary Kpi`s</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets2/css/stylee.css">
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  </head>
  <style type="text/css">
.body{
    padding: 10px 50px 10px 50px;
    height:100%;
  }
 .stat-icon{
  font-size: 60px;
  }
  .flat-color-1 {
    color: #00c292;   
}
.flat-color-2 {
color: #6610f2;
  }
.icon:hover{
  content: "";
transform: scale(1.5);
}
 i .fa-heartbeat{
font-size: 4em;
right: 0;
left: 0;
bottom: 0;
top: 0;

}

.bg-flat-color-9{
	background-color: #0067a5;
}

.bg-flat-color-11{
    background-color: #f6a600;
}

.bg-flat-color-13{
    background-color: #d0748b;
}

.bg-flat-color-14{
    background-color: #5490c4;
}
.flat-color-9{
    color:white;
}
</style>
<center>
  
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
        <div class="card-header user-header alt bg-light"
        style="border-radius: 20px 20px 0 0 ;">
        <div class="media">
        <div class="media-body">
          <h2 class="text-dark display-12" >Summary Kpi`s Reports</h2>
          <p style="color:lightgray;"> <?php
              $time = date("H");
              if ($time < "12") {
        echo "<img src='images/morning.png' style='width:50px;' > Good morning : $s_username";
    }if ($time >= "12" && $time < "17") {
        echo "<img src='images/afternoon.png' style='width:50px;margin-top:-15px;' > Good afternoon : $s_username";
    }if ($time >= "17" && $time < "19") {
        echo "<img src='images/evening.png' style='width:50px;' > Good evening : $s_username";
    } if ($time >= "19") {
        echo "<img src='images/night.png' style='width:50px;' > Good night : $s_username";
    }
  ?></p>
          </div>
      </div>
  </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This Reports is Shown the Summary for KPIs ( Old / New ) based on the current Year ( per month )</p>
  </aside>
</div>
</center>
<div style="padding:50px;">
 <div class="animated fadeIn">

    <!-- Widgets  -->
    <div class="row">

    <div class="col-md-6">
        <div class="card bg-flat-color-8">
            <div class="card-body">
              <a href="monthly_subGroup.php?group">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-1">
                        <i class="pe-7s-chart-pay"></i>
                   <img src="images/icon_human_resources.png"style="width:75px; height:75px; background-color: light;">
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text" style="color: gray;text-indent: 50px;">Summary Kpi`s</div>
                            <div class="stat-heading" style="text-indent: 50px;">Per Group</div>
                        </div>
                    </div>
                </div>
              </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card bg-flat-color-9">
            <div class="card-body">
              <a href="monthly_subGroup.php?Sub_group">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-9">
                        <i class="pe-7s-chart-pay"></i>
                   <img src="images/subgroup.png"style="width:75px; height:75px;">
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text" style="color: white;text-indent: 50px;">Summary Kpi`s</div>
                            <div class="stat-heading" style="color: lightgray;text-indent: 50px;"> Per Sub group</div>
                                </div>
                            </div>
                        </div>
                      </a>
                    </div>
                </div>
            </div>
        </div><!--row-->
      </div>
    </div>
<?php if(($_SESSION['role_id'] == 1) || ($_SESSION['role_id'] >= 3)){
        //     if(($_SESSION['username'] == 'ahmed.akef') || 
        // ($_SESSION['role_id'] == 1)
           
            ?>
<div style="padding:50px;padding-top:2px;">
 <div class="animated fadeIn">
    <!-- Widgets  -->
    <div class="row">
<?php //if($_SESSION['role_id'] == 1){ ?>
        <div class="col-md-6">
            <div class="card bg-flat-color-8" style="background-color: #447aaf;">
                <div class="card-body">
                  <a href="KPI_rawdata.php">
                    <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-1">
                        <i class="pe-7s-chart-pay"></i>
                       <img src="images/rise.png"style="width:75px; height:75px; background-color: light;">
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text" style="color: #eee;text-indent: 50px;">KPI Raw Data </div>
                                </div>
                            </div>
                        </div>
                      </a>
                    </div>
                </div>
            </div>
        <?php //} ?>
<br>
        <div class="col-md-6">
            <div class="card bg-flat-color-8" style="background-color: #28426b;">
                <div class="card-body">
                  <a href="KPI2024_SD.php">
                    <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-1">
                        <i class="pe-7s-chart-pay"></i>
                       <img src="images/rise.png"style="width:75px; height:75px; background-color: light;">
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text" style="color: #eee;text-indent: 50px;">SD KPI 2024 </div>
                                <!-- <div class="stat-heading" style="text-indent: 50px;">Per Group</div> -->
                                </div>
                            </div>
                        </div>
                      </a>
                    </div>
                </div>
            </div>
        </div><!--row-->
<br>
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-flat-color-8" style="background-color: #8295a1;">
                <div class="card-body">
                  <a href="performance_2024.php">
                    <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-1">
                        <i class="pe-7s-chart-pay"></i>
                       <img src="images/rise.png"style="width:75px; height:75px; background-color: light;">
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text" style="color: #eee;text-indent: 50px;">Performance 2024 </div>
                               
                                </div>
                            </div>
                        </div>
                      </a>
                    </div>
                </div>
            </div>
   <!-- Electricity -->
   <div class="col-md-6">
            <div class="card bg-flat-color-2" >
                <div class="card-body">
                  <a href="Electricity.php">
                    <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-1">
                        <i class="pe-7s-chart-pay"></i>
                       <img src="images/electricity.png"style="width:75px; height:75px; background-color: light;">
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text" style="color: #eee;text-indent: 50px;">Electricity 2024 </div>
                               
                                </div>
                            </div>
                        </div>
                      </a>
                    </div>
                </div>
            </div>


        </div>

    </div>
</div>
    

    <!--div class="col-md-6">
        <div class="card bg-flat-color-9">
            <div class="card-body">
              <a href="monthly_subGroup.php?Sub_group">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-9">
                        <i class="pe-7s-chart-pay"></i>
                   <img src="images/subgroup.png"style="width:75px; height:75px;">
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text" style="color: white;text-indent: 50px;">abc</div>

                        </div>
                    </div>
                </div>
              </a>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div-->
<?php }
            ?>
       <?php if(
        ($_SESSION['username'] == 'ahmed.akef') || 
        ($_SESSION['username'] =='Ahmed.AbdelFattah' )||
        ($_SESSION['role_id'] == 1)
            ){
            ?>
            <div style="padding:50px;padding-top:2px;">
 <div class="animated fadeIn">
    <div class="row">

     <div class="col-md-6">
        <div class="card bg-flat-color-8">
            <div class="card-body">
              <a href="performance.php">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-1">
                            <i class="pe-7s-chart-pay"></i>
                       <img src="images/kpi-iconremovebg-preview.png"style="width:75px; height:75px; background-color: light;">
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text" style="color: gray;text-indent: 50px;">NEW performance</div>
                                <div class="stat-heading" style="color: lightgray;text-indent: 50px;">NEW</div>
                            </div>
                        </div>
                    </div>
                  </a>
                </div>
            </div>
        </div>
            
          <div class="col-md-6">
            <div class="card bg-flat-color-8">
                <div class="card-body">
                  <a href="monthly_report.php">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <i class="pe-7s-chart-pay"></i>
                       <img src="images/kpi-iconremovebg-preview.png"style="width:75px; height:75px; background-color: light;">
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text" style="color: gray;text-indent: 50px;">Summary Kpi`s</div>
                                <div class="stat-heading" style="color: lightgray;text-indent: 50px;">Per SD</div>
                            </div>
                        </div>
                    </div>
                  </a>
                </div>
            </div>
        </div>
            

</div>
</div>
</div>
  <?php }
            ?>
 



   <?php
 include ("footer.html");
 ?>