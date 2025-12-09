
<?php 
include ("pages.php");


      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      if(isset($_POST['username'])){$usernames = $_POST['username'];}
     
    ?>
    <head>
      <title>Quality Tools</title>
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
    padding: 10px 70px 10px 70px;
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
          <h2 class="text-dark display-12" >Quality Reports</h2>
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
       color:white;">0...0 </p>
  </aside>
</div>
</center>
<div style="padding:20px;">
 <div class="animated fadeIn">

    <!-- Widgets  -->
    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                  <a href="Quality_q2.php?login">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <i class="pe-7s-browser"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"></div>
                                <div class="stat-heading">login & extension for all enterprise support engineers</div>
                            </div>
                        </div>
                    </div>
                  </a>
                </div>
            </div>
        </div>
    <div class="col-lg-3 col-md-6">
        <div class="card bg-flat-color-3">
            <div class="card-body">
                <a href="Quality_q2.php?PSCPSD">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-9">
                        <i class="pe-7s-browser"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-heading"style="font-weight: bold;font-size:15px;color: white;">
                            PSC & PSD accounts for SD and onsite team members</div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
</div>
    <div class="col-lg-3 col-md-6">
        <div class="card bg-flat-color-13">
            <div class="card-body">
                <a href="Quality_q2.php?Resi">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-9">
                        <i class="pe-7s-browser"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-heading"style="font-weight: bold;font-size:15px;color: white;">Employee Resignation</div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card bg-flat-color-11">
            <div class="card-body">
                <a href="Quality_q2.php?Outsource_Staff">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-9">
                        <i class="pe-7s-browser"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-heading"style="font-weight: bold;font-size:15px;color: white;" >Employee Transfer Outsource to Staff</div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
</div>
<br>
<div class="row">
     <div class="col-lg-3 col-md-6">
        <div class="card bg-flat-color-9">
            <div class="card-body">
                <a href="Quality_q2.php?groups">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-9">
                        <i class="pe-7s-browser"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            
                            <div class="stat-heading"style="font-weight: bold;font-size:15px;color: white;">Headcount Per Unit</div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>


     <div class="col-lg-3 col-md-6">
        <div class="card bg-flat-color-5">
            <div class="card-body">
                <a href="Quality_q2.php?structure">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-9">
                        <i class="pe-7s-browser"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-text"></div>
                            <div class="stat-heading"style="font-weight: bold;font-size:15px;color: white;">Employee Structure</div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>

     <div class="col-lg-3 col-md-6">
        <div class="card bg-flat-color-6">
            <div class="card-body">
                <a href="Quality_q2.php?Onsite">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-9">
                        <i class="pe-7s-browser"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-heading"style="font-weight: bold;font-size:15px;color: white;">Onsite teams monthly schedules</div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>

     <div class="col-lg-3 col-md-6">
        <div class="card bg-flat-color-2" >
            <div class="card-body">
                <a href="Quality_q2.php?ProblemM">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-9">
                        <i class="pe-7s-browser"></i>
                    </div>
                     <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-heading"style="font-size:15px;color: white;">Problem Management & Service Optimization monthly schedules</div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
     <div class="col-lg-3 col-md-6">
        <div class="card bg-flat-color-1">
            <div class="card-body">
                <a href="Quality_q2.php?SDschedule">
                <div class="stat-widget-five">
                    <div class="stat-icon dib flat-color-9">
                        <i class="pe-7s-browser"></i>
                    </div>
                    <div class="stat-content">
                        <div class="text-left dib">
                            <div class="stat-heading"style="font-weight: bold;font-size:15px;color: white;">SD teams monthly schedules</div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
</div>
<!-- /Widgets -->
</div>
</div>
   <?php
 include ("footer.html");
 ?>