

 <?php
        require_once("inc/config.inc");
        
  if($_SESSION['username'] == ''){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }

      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
         $usernames="";
      if(isset($_POST['username'])){$usernames = $_POST['username'];}
        $mydate ="";
        $mydate2 ="";
        $countLeaves ="";
        $Sick ="";
        $permission ="";
        $Official ="";
      ?>

<!DOCTYPE html>
<html>

<head>
  <title>Current day</title>
   <link rel="icon" href="imag/logo.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="theme-color" content="#33b5e5">
    <link rel="manifest" href="/manifest.json">
     <script src="js/prettify.min.js"></script>
  <script src="lib/example.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="js/jquery.min.js"></script>
  <script src="js/raphael-min.js"></script>
  <script src="js/morris.js"></script>
  <script src="js/Chart.min"></script>
    <script src="js/prettify.min.js"></script>
  <script src="lib/example.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
<script src="js/exporting.js"></script>
    
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="report1.css">
      <link rel="stylesheet" type="text/css" href="css/morris.css">

  <link rel="stylesheet" type="text/css" href="css/prettify.min.css">

  <link rel="stylesheet" href="css/bootstrap22.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/font-awesome22.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="css/ionicons.min.css">
  <!-- Morris charts -->
  <link rel="stylesheet" href="css/morris22.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/bootstrap2.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style4.css">
</head>
<body style="background-color:#3a4e5f;">
       
        <!-- Sidebar  -->

    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>WFM </h3>
                <strong>WFM</strong>
            </div>

            <ul class="list-unstyled components">
              
                <li>
                    <!--a href="senior_home.php">
                    <i class="fas fa-home"></i>
                        Home
                    </a-->
                    <?php if(($_SESSION['role_id'] == 2) || ($_SESSION['role_id'] == 3) || ($_SESSION['role_id'] == 4)
                      || ($_SESSION['role_id'] == 5)|| ($_SESSION['role_id'] == 6)){
          echo'

       <li>
                    <a href="senior_home.php">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>';}
                if ($_SESSION['role_id'] == 1){
          echo'

       <li>
                    <a href="theme.php">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>';}
                ?>
            <?php
            if($_SESSION['role_id'] == 0) {
              echo'<li class="active">
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-copy"></i>
                        Create new
                    </a>
                    <li>
                    <a href="senior_home.php">
                    <i class="fas fa-home"></i>
                        Home
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">

                     <li>
                           <a href="leaves2.php">Create New leaves</a>
                        </li>
                        <li>
                            <a href="deductions2.php">Create Deduction Complain</a>
                        </li>
                        <li>
                            <a href="create_task2.php">Create New Task</a>
                        </li>
                        
                    </ul>
                </li>';}?>

           <?php
  if(($_SESSION['role_id'] == 1) || ($_SESSION['role_id'] == 2) || ($_SESSION['role_id'] == 3) || ($_SESSION['role_id'] == 4)){
          echo'

                   <li>
                    <a href="allstatus2">
                        <i class="fas fa-copy"></i>
                        All views
                    </a>
                </li>
                <li>
                    <a href="create_task2.php">
                        <i class="fas fa-tasks"></i>
                        Create Task
                    </a>
                </li>
                <li>
                            <a href="employee_info2.php"><i class="fas fa-users"></i>Employee view</a>
                        </li>
                <li>
                    <a href="welcomeadmin2.php" >
                        <i class="fas fa-copy"></i>
                        Check request
                    </a>
                </li> ';}?>

                      <?php
        if($_SESSION['role_id'] == 0) {
          echo'
                  <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-briefcase"></i>
                        View History
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="signview2.php">Sign Log History view</a>
                        </li>
                        <li>
                            <a href="leavesview2.php">leaves History view</a>
                        </li>
              
                        <li>
                            <a href="deductionview2">Deduction History view</a>
                        </li>
                         <li>
                    <a href="welcomeadmin2.php">
                        <i class="fas fa-copy"></i>
                        Tasks History view
                    </a>
                </li>
                      
                    </ul>
                </li>';}?>
                
                      <?php
        if($_SESSION['role_id'] == 0){
echo'

                <li>
                    <a href="utilization2.php">
                        <i class="fas fa-image"></i>
                        My utilization
                    </a>
                </li>
                <li>
                    <a href="schedule2.php">
                        <i class="fas fa-copy"></i>
                        My schedule
                    </a>
                </li>';}?>
  <li ><a  style="color: #eee;" href="edit_password2.php"><span class="glyphicon glyphicon-user"></span>Change Password</a></li>

    

      <li><a href="?logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
            </ul>

            <ul class="list-unstyled CTAs">
                <!--li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                </li>
                <li>
                    <a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a>
                </li-->
            </ul>
     
    
        </nav>

   <style>
     #sidebar {
    min-width:3px;
    max-width: 250px;
    /*background: #7386D5;*/
    background-image: initial;
    background-position-x: initial;
    background-position-y: initial;
    background-size: initial;
    background-repeat-x: initial;
    background-repeat-y: initial;
    background-attachment: initial;
    background-origin: initial;
    background-clip: initial;
    background-color: #092834;
    color: #fff;}
  #sidebar .sidebar-header{
    background-color: #092834;

            }
.sidebar, .main-panel {
    overflow-x:  hidden;
    overflow-y:  hidden;
    
}
/*
#Area_Chart1,#Line_Chart1,#Bar_Chart{
  display: none;
}*/
.content {
    min-height: 50px;}

    </style>

 <div id="content">

 <nav class="navbar navbar-expand-lg navbar-light bg-light " style="font-size: 15px; backface-visibility: hidden; 
 border-radius: 0px 10px 10px 0px; margin-left:-1.5%; width: 105%; margin-top:-1.5%;">
<div class="container-fluid">
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">

     <ul>
  <img src="imag/logo.jpg" alt="logo.jpg"  style="
   width: 25px; margin-bottom: 3px; margin-left: -28%;">
  <span style="font-size:15px;font-family: Century Gothic; margin-right: 1px; ">
  WorkForce Managment Tool</span></ul> 
                        <ul class="nav navbar-nav ml-auto">
  
    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

      

 <li ><a href="#" style="font-size: 9.5px;"><span class="glyphicon glyphicon-user"></span> login as <samp>:</samp>
        <?php echo $_SESSION["username"];?><h6 style="color: orange;font-size: 10px;text-align: justify;text-indent: 10px;letter-spacing: -.5px;line-height: 0.8;" ></h6></a></li>
        
<li><a href="?logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>

                        </ul>
                    </div>
                    </div>
            </nav>
            <style>
.clock {
    position: absolute;
    left:50%;
    transform: translateX(50%) translateY(15%);
    color: #17D4FE;
    font-size: 60px;
    font-family: Orbitron;
    letter-spacing: 7px;}
    </style>
    <?php
if(isset($_POST['schedule_date'])){
$start = $_POST['schedule_date'];}

if(isset($_POST['schedule_date2'])){$end = $_POST['schedule_date2'];}


?>
 <div id="Display" class="clock" >
              <?php
             echo date('d/M/Y'); ?></div>

             <form method="post" >

            
      <!-- Default input -->
 <input  type='date' id="dates" class='dateFilter' name='schedule_date' title="schedule_date" required style="padding:4px;width: 35%;"
      value='<?php if(isset($_POST['schedule_date'])) echo $_POST['schedule_date']; ?>'/>

<input  type='date' id="dates" class='dateFilter' name='schedule_date2' title="covering_date_to" 
 style="display: none;"
      value='<?php if(isset($_POST['schedule_date2'])) echo $_POST['schedule_date2']; ?>'/>


 <br>
 <br>

<div class="input-group" style="width:85%;">
  <br>

       <span class="input-group-append">
           <button type='submit' name='submit' value="Get data"  class="btn btn-info">Get data</button>
      </span> 
</div>

           
<?php
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
sqlsrv_query( $con1 , "SET NAMES 'utf8'"); 
sqlsrv_query( $con1 ,'SET CHARACTER SET utf8' );
if(isset($_POST['submit'])){
  echo '<style>
  #Display{
  display:none;
}
   .clock2{
    position: absolute; top:10%;
    left:50%;
    transform: translateX(50%) translateY(15%);
    color: #17D4FE;
    font-size: 60px;
    font-family: Orbitron;
    letter-spacing: 7px
   }
    </style>
  <div id="MyClockDisplay" class="clock2" >
            
        '.$start.'</div>';

$selected = sqlsrv_query($con1,"with x1 as (

SELECT [schedule_date]
      ,[username]
      ,cast([shift_start] as datetime) + cast([schedule_date] as datetime) Shift_start
      ,case
         when (cast([shift_end] as datetime) +  cast([schedule_date] as datetime)) < 
         cast([shift_start] as datetime) + cast([schedule_date] as datetime) 
         then 
         (cast([shift_end] as datetime) +  DATEADD(day,1,cast([schedule_date] as datetime)))
         else 
cast([shift_end] as datetime) +  cast([schedule_date] as datetime)
end Shift_end
      ,[senior]
      ,[super]
      ,[section]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  where schedule_date = '$start' and shift_start <> 'OFF'),

  x2 as (SELECT [username]
  FROM [Aya_Web_APP].[dbo].[leaves]
  where '$start' between [adate] and bdate and [status]  = 'E-workforce and senior approve' 
  and [type] not in ('Permission')),
x3 as (SELECT Groups , case
       when DATEDIFF(hour,shift_start,shift_end) > 8 then 'Sch_shift'
       else 'Reguler'
       end
       
        Duration
       ,Count(x1.[username]) Count_employee
       from x1
         left join [Employess_DB].dbo.tbl_Personal_info on x1.username = tbl_Personal_info.username
         left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
          
         where Unit in (12,13,14,15,16,17) and x1.username not in ( 'rana.youssry','Yasmin.m.Ahmed') and x1.username not in (SELECT * from x2) and   Groups in ('BS' ,'GDS(Global Partner)','ICT','Private KAM','Resident','TAM','Banking'
         ,'GOV')
         
         group by x1.[username],
         case
       when DATEDIFF(hour,shift_start,shift_end) > 8 then 'Sch_shift'
       else 'Reguler'
       end
       ,Groups),

       x22 as (  SELECT Groups , count([schedule_table].[username]) [OFF]
      from [Aya_Web_APP].[dbo].[schedule_table]
         left join [Employess_DB].dbo.tbl_Personal_info on [schedule_table].username = tbl_Personal_info.username
         left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
          
         where Unit in (12,13,14,15,16,17) and [schedule_table].username not in ( 'rana.youssry','Yasmin.m.Ahmed') and shift_end = 'OFF'
           and  schedule_date = '$start'
             group by Groups),
x99 as (
       SELECT * from x3
 pivot(count(Count_employee)
                    for Duration in (Reguler,Sch_shift)) as pivot_table),
       x109 as ( SELECT 
      groups,
      count([leaves].[username]) Leaves
   
  FROM [Aya_Web_APP].[dbo].[leaves]
         left join [Employess_DB].dbo.tbl_Personal_info on [leaves].username = tbl_Personal_info.username
         left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where '$start' between [adate] and bdate and [status]  = 'E-workforce and senior approve' 
  and [type] not in ('Permission')
  group by groups)

         SELECT  sum(x99.Reguler) Reguler
         ,Sum(x99.Sch_shift) sch_shift
         ,Sum(iif(x22.[OFF] is null , 0,x22.[OFF])) [OFF]
         ,Sum(iif(Leaves is null , 0 , Leaves)) Leaves
         from x99
         left join x22 on x22.Groups = x99.groups
         left join x109 on x109.Groups = x99.Groups");
  $output_query = sqlsrv_fetch_array($selected);

  $Reguler = $output_query['Reguler'];
  $Sch_shift = $output_query['sch_shift'];
  $OFF = $output_query['OFF'];
  $Leaves  = $output_query['Leaves'];
  $total = ($Reguler+$Sch_shift+$OFF+$Leaves);

   // act as leader
  /*
      
Mega Projects

TAM
Resident
KAM
NULL
ESLM
PRI
Unmanaged
ICT & Domain - Mail
GDS
*/

  $leader = sqlsrv_query($con1," SELECT count([ID]) Shift_leader
    FROM [Employess_DB].[dbo].[tbl_Personal_info]
  where note is not null and Employee_Status = 'active' and Unit = 12 and Grade ='L8' ");
  
  $act_leader = sqlsrv_fetch_array($leader);
   $acting = $act_leader['Shift_leader'];

  ?>
           
   <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3> <?php echo $Reguler;?><sup style="font-size: 20px;">person</sup></h3>

                <p style="color:#eee;">Eng. reguler</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <!--a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a-->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3> <?php echo $Sch_shift;?> <sup style="font-size: 20px;">person</sup></h3>

                <p style="color:#eee;">Eng. Shift</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <!--a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a-->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $OFF;?> <sup style="font-size: 20px;">person</sup></h3>

                <p style="color:#eee;">Eng. OFF</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <!--a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a-->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $Leaves;?> <sup style="font-size: 20px;">person</sup></h3>

                <p style="color:#eee;">Total Leaves today</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <!--a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a-->
            </div>
          </div>
          <!-- ./col -->
        </div>
</section>

    <div class="table-wrapper"style="width:95%;">

  <div class="table-title" style="">       
<label  class="small-box bg-success"  style="width:20%;font-size:20px;float: right;">Acting as Leader<samp>:
          <?php  echo $acting ; ?></samp></label>
    <h2 style="margin-left: 10%;" align="center">   
      
Schedule per group<!--a href="testtable.php"> <b>Default table</b></a--></h2>
<label  class="small-box bg-warning"  style="width:17%;font-size:20px;margin-top: -3%;">Total<samp>:<?php  echo $total ; ?>
  
</samp></label>

        </div>

<?php
 $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
//}
////////
//if(isset($_POST['submit'])){
  echo  '<form method="post">';
echo'<div data-status="all" style="width:100%;">';
echo'<table class="table table-striped table-hover" data-status="all">
            <thead data-status="all">
                <tr data-status="all">
                    <th>Groups</th>
                    <th>Reguler</th>
                    <th>Shift</th>
                    <th>OFF</th>
                    <th>Leaves</th>
                </tr>
            </thead>
      <tbody data-status="all">
<input enable="false" class="nav-link disabled" tabindex="-1" type="text" name="Units" style="display: none;"></input>';
$my_select = sqlsrv_query($con1,"with x1 as (

SELECT [schedule_date]
      ,[username]
      ,cast([shift_start] as datetime) + cast([schedule_date] as datetime) Shift_start
      ,case
         when (cast([shift_end] as datetime) +  cast([schedule_date] as datetime)) < 
         cast([shift_start] as datetime) + cast([schedule_date] as datetime) 
         then 
         (cast([shift_end] as datetime) +  DATEADD(day,1,cast([schedule_date] as datetime)))
         else 
cast([shift_end] as datetime) +  cast([schedule_date] as datetime)
end Shift_end
      ,[senior]
      ,[super]
      ,[section]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  where schedule_date = '$start' and shift_start <> 'OFF'),

  x2 as (SELECT [username]
  FROM [Aya_Web_APP].[dbo].[leaves]
  where cast(getdate() as date) = '$start'  and [status] = 'E-workforce and senior approve' 
  and [type] not in ('Permission')),
x3 as (SELECT Groups , case
       when DATEDIFF(hour,shift_start,shift_end) > 8 then 'Sch_shift'
       else 'Reguler'
       end
       
        Duration
       ,Count(x1.[username]) Count_employee
       from x1
         left join [Employess_DB].dbo.tbl_Personal_info on x1.username = tbl_Personal_info.username
         left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
          
         where Unit in (12,13,14,15,16,17) and x1.username not in ( 'rana.youssry','Yasmin.m.Ahmed') and x1.username not in (SELECT * from x2) and   Groups in ('BS' ,'GDS(Global Partner)','ICT','Private KAM','Resident','TAM','Banking'
         ,'GOV')
         
         group by x1.[username],
         case
       when DATEDIFF(hour,shift_start,shift_end) > 8 then 'Sch_shift'
       else 'Reguler'
       end
       ,Groups),

       x22 as (  SELECT Groups , count([schedule_table].[username]) [OFF]
      from [Aya_Web_APP].[dbo].[schedule_table]
         left join [Employess_DB].dbo.tbl_Personal_info on [schedule_table].username = tbl_Personal_info.username
         left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
          
         where Unit in (12,13,14,15,16,17) and [schedule_table].username not in ( 'rana.youssry','Yasmin.m.Ahmed') and shift_end = 'OFF'
           and  schedule_date = '$start'
             group by Groups),
x99 as (
       SELECT * from x3
 pivot(count(Count_employee)
                    for Duration in (Reguler,Sch_shift)) as pivot_table),
       x109 as ( SELECT 
      groups,
      count([leaves].[username]) Leaves
   
  FROM [Aya_Web_APP].[dbo].[leaves]
         left join [Employess_DB].dbo.tbl_Personal_info on [leaves].username = tbl_Personal_info.username
         left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where '$start'  between [adate] and bdate and [status] = 'E-workforce and senior approve' 
  and [type] not in ('Permission')
  group by groups)

          SELECT 
         x99.Groups
         ,x99.Reguler
         ,x99.Sch_shift
         ,iif(x22.[OFF] is null , 0,x22.[OFF]) [OFF]
         ,iif(Leaves is null , 0 , Leaves) Leaves
         from x99
         left join x22 on x22.Groups = x99.groups
         left join x109 on x109.Groups = x99.Groups");

while ( $output_query = sqlsrv_fetch_array($my_select)){
$rows  ='<tr data-status="all">';
$rows .='<td width="59%" style="border: 1px solid #eee;">'.$output_query["Groups"].'</td>';
$rows .='<td width="5%" style="border: 1px solid #eee;"><!--a href=""-->'.$output_query["Reguler"].'</td>';
$rows .='<td width="5%" style="border: 1px solid #eee;"><!--a href=""-->'.$output_query["Sch_shift"].'</td>';
$rows .='<td width="5%" style="border: 1px solid #eee;"><!--a href=""-->'.$output_query["OFF"].'</td>';
$rows .='<td width="5%" style="border: 1px solid #eee;"><!--a href=""-->'.$output_query["Leaves"].'</td>';

  $rows.="</tr>";
  echo $rows;
  echo '</tbody>';
}
/////////////
}
else{

$selected = sqlsrv_query($con1,"with x1 as (

SELECT [schedule_date]
      ,[username]
      ,cast([shift_start] as datetime) + cast([schedule_date] as datetime) Shift_start
      ,case
         when (cast([shift_end] as datetime) +  cast([schedule_date] as datetime)) < 
         cast([shift_start] as datetime) + cast([schedule_date] as datetime) 
         then 
         (cast([shift_end] as datetime) +  DATEADD(day,1,cast([schedule_date] as datetime)))
         else 
cast([shift_end] as datetime) +  cast([schedule_date] as datetime)
end Shift_end
      ,[senior]
      ,[super]
      ,[section]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  where schedule_date = cast(getdate() as date) and shift_start <> 'OFF'),

  x2 as (SELECT [username]
  FROM [Aya_Web_APP].[dbo].[leaves]
  where cast(getdate() as date) between [adate] and bdate and [status] = 'E-workforce and senior approve' 
  and [type] not in ('Permission')),

x3 as (SELECT Groups ,case
       when DATEDIFF(hour,shift_start,shift_end) > 8 then 'Sch_shift'
       else 'Reguler'
       end
       
        Duration
       ,Count(x1.[username]) Count_employee
       
      
         from x1
         left join [Employess_DB].dbo.tbl_Personal_info on x1.username = tbl_Personal_info.username
         left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
          
         where Unit in (12,13,14,15,16,17) and x1.username not in ( 'rana.youssry','Yasmin.m.Ahmed') and x1.username not in (SELECT * from x2) and   Groups in ('BS' ,'GDS(Global Partner)','ICT','Private KAM','Resident','TAM','Banking'
         ,'GOV')
         
         group by x1.[username],
         case
       when DATEDIFF(hour,shift_start,shift_end) > 8 then 'Sch_shift'
       else 'Reguler'
       end
       ,Groups),

       x22 as (  SELECT Groups

     , count([schedule_table].[username]) [OFF]
       
      
         from [Aya_Web_APP].[dbo].[schedule_table]
         left join [Employess_DB].dbo.tbl_Personal_info on [schedule_table].username = tbl_Personal_info.username
         left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
          
         where Unit in (12,13,14,15,16,17) and [schedule_table].username not in ( 'rana.youssry','Yasmin.m.Ahmed') and shift_end = 'OFF'
           and  schedule_date = cast(getdate() as date) 
             group by Groups),
x99 as (
       SELECT * from x3
   
       pivot(count(Count_employee)
                    for Duration in (Reguler,Sch_shift)
                    ) as pivot_table
         ),
       x109 as ( SELECT 
      groups
         ,
      count([leaves].[username]) Leaves
   
  FROM [Aya_Web_APP].[dbo].[leaves]
         left join [Employess_DB].dbo.tbl_Personal_info on [leaves].username = tbl_Personal_info.username
         left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where cast(getdate() as date) between [adate] and bdate and [status] = 'E-workforce and senior approve' 
  and [type] not in ('Permission')
  group by groups)

         SELECT  sum(x99.Reguler) Reguler
         ,Sum(x99.Sch_shift) sch_shift
         ,Sum(iif(x22.[OFF] is null , 0,x22.[OFF])) [OFF]
         ,Sum(iif(Leaves is null , 0 , Leaves)) Leaves
         from x99
         left join x22 on x22.Groups = x99.groups
         left join x109 on x109.Groups = x99.Groups");
  $output_query = sqlsrv_fetch_array($selected);

  $Reguler = $output_query['Reguler'];
  $Sch_shift = $output_query['sch_shift'];
  $OFF = $output_query['OFF'];
  $Leaves  = $output_query['Leaves'];
  $total = ($Reguler+$Sch_shift+$OFF+$Leaves);


  $leader = sqlsrv_query($con1," SELECT count([ID]) Shift_leader
    FROM [Employess_DB].[dbo].[tbl_Personal_info]
  where note is not null and Employee_Status = 'active' and Unit = 12 and Grade ='L8' ");
  
  $act_leader = sqlsrv_fetch_array($leader);
   $acting = $act_leader['Shift_leader'];

 echo'
           
   <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>'.$Reguler.'<sup style="font-size: 20px;">person</sup></h3>

                <p style="color:#eee;">Eng. reguler</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>'.$Sch_shift.'<sup style="font-size: 20px;">person</sup></h3>

                <p style="color:#eee;">Eng. Shift</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>'.$OFF.'<sup style="font-size: 20px;">person</sup></h3>

                <p style="color:#eee;">Eng. OFF</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>'.$Leaves.'<sup style="font-size: 20px;">person</sup></h3>

                <p style="color:#eee;">Total Leaves today</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
            </div>
          </div>
        </div>
</section>
<div class="table-wrapper"style="width:95%;">

  <div class="table-title" style="">       
<label  class="small-box bg-success"  style="width:20%;font-size:20px;float: right;">
Acting as Leader<samp>:'.$acting.'</samp></label>
    <h2 style="margin-left: 10%;" align="center">   
      
Schedule per group<!--a href="testtable.php"> <b>Default table</b></a--></h2>
<label  class="small-box bg-warning"  style="width:17%;font-size:20px;margin-top: -3%;">Total<samp>:'.$total.'
  
</samp></label>
        </div>';


  echo'<form method="post">
<div data-status="all" style="width:100%;">';
echo '<table class="table table-striped table-hover" data-status="all">
            <thead data-status="all">
                <tr data-status="all">
                    <th>Groups</th>
                    <th>Reguler</th>
                    <th>Shift</th>
                    <th>OFF</th>
                    <th>Leaves</th>
                </tr>
            </thead>
      <tbody data-status="all">
<input enable="false" class="nav-link disabled" tabindex="-1" type="text" name="Units" style="display: none;"></input>';
$my_selected = sqlsrv_query($con1,"with x1 as (

SELECT [schedule_date]
      ,[username]
      ,cast([shift_start] as datetime) + cast([schedule_date] as datetime) Shift_start
      ,case
         when (cast([shift_end] as datetime) +  cast([schedule_date] as datetime)) < 
         cast([shift_start] as datetime) + cast([schedule_date] as datetime) 
         then 
         (cast([shift_end] as datetime) +  DATEADD(day,1,cast([schedule_date] as datetime)))
         else 
cast([shift_end] as datetime) +  cast([schedule_date] as datetime)
end Shift_end
      ,[senior]
      ,[super]
      ,[section]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  where schedule_date = cast(getdate() as date) and shift_start <> 'OFF'),

  x2 as (SELECT 
      [username]
   
  FROM [Aya_Web_APP].[dbo].[leaves]
  where cast(getdate() as date) between [adate] and bdate and [status] = 'E-workforce and senior approve' 
  and [type] not in ('Permission')),



  x3 as (SELECT Groups,case
       when DATEDIFF(hour,shift_start,shift_end) > 8 then 'Sch_shift'
       else 'Reguler'
       end
       Duration
       ,Count(x1.[username]) Count_employee
       
      
         from x1
         left join [Employess_DB].dbo.tbl_Personal_info on x1.username = tbl_Personal_info.username
         left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
          
         where Unit in (12,13,14,15,16,17) and x1.username not in ( 'rana.youssry','Yasmin.m.Ahmed') and x1.username not in (SELECT * from x2) and   Groups in ('BS' ,'GDS(Global Partner)','ICT','Private KAM','Resident','TAM','Banking'
         ,'GOV')
         
         group by x1.[username],
         case
       when DATEDIFF(hour,shift_start,shift_end) > 8 then 'Sch_shift'
       else 'Reguler'
       end
       ,Groups),

       x22 as (  SELECT Groups , count([schedule_table].[username]) [OFF]
       
      
         from [Aya_Web_APP].[dbo].[schedule_table]
         left join [Employess_DB].dbo.tbl_Personal_info on [schedule_table].username = tbl_Personal_info.username
         left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
          
         where Unit in (12,13,14,15,16,17) and [schedule_table].username not in ( 'rana.youssry','Yasmin.m.Ahmed') and shift_end = 'OFF'
           and  schedule_date = cast(getdate() as date) 
             group by Groups),
x99 as (
       SELECT * from x3

       pivot(count(Count_employee)
                    for Duration in (Reguler,Sch_shift)
                    ) as pivot_table),
       x109 as ( SELECT 
      groups,
      count([leaves].[username]) Leaves
   
  FROM [Aya_Web_APP].[dbo].[leaves]
         left join [Employess_DB].dbo.tbl_Personal_info on [leaves].username = tbl_Personal_info.username
         left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where cast(getdate() as date) between [adate] and bdate and [status] = 'E-workforce and senior approve' 
  and [type] not in ('Permission')
  group by groups)

         SELECT 
         x99.Groups
         ,x99.Reguler
         ,x99.Sch_shift
         ,iif(x22.[OFF] is null , 0,x22.[OFF]) [OFF]
         ,iif(Leaves is null , 0 , Leaves) Leaves
         from x99
         left join x22 on x22.Groups = x99.groups
         left join x109 on x109.Groups = x99.Groups");


while ( $output_query = sqlsrv_fetch_array($my_selected)){
$rows  ='<tr data-status="all">';
$rows .='<td width="59%" style="border: 1px solid #eee;">'.$output_query["Groups"].'</td>';
$rows .='<td width="5%" style="border: 1px solid #eee;"><!--a href=""-->'.$output_query["Reguler"].'</td>';
$rows .='<td width="5%" style="border: 1px solid #eee;"><!--a href=""-->'.$output_query["Sch_shift"].'</td>';
$rows .='<td width="5%" style="border: 1px solid #eee;"><!--a href=""-->'.$output_query["OFF"].'</td>';
$rows .='<td width="5%" style="border: 1px solid #eee;"><!--a href=""-->'.$output_query["Leaves"].'</td>';

 
  $rows.="</tr>";
  echo $rows;

echo'</tbody>';}

}
?>
</div>
</form>
       <script type="text/javascript">
     $('.popover-dismiss').popover({
  trigger: 'focus'
})
     $('#example').popover(options)
$('#element').popover('show')
$('#myPopover').on('hidden.bs.popover', function () {
  // do something…
})
   </script> 

<script type="text/javascript">
$(document).ready(function(){
  $(".btn-group .btn").click(function(){
    var inputValue = $(this).find("input").val();
    if(inputValue != 'test'){
      var target = $('table [data-status="' + inputValue + '"]');
      $("table  tr  ").not(target).hide();
      target.fadeIn();
    } else {
      $("table  tr  ").fadeIn();
    }
  });
  // Changing the class of status label to support Bootstrap 4
    var bs = $.fn.tooltip.Constructor.VERSION;
    var str = bs.split(".");
    if(str[0] == 4){
        $(".label").each(function(){
          var classStr = $(this).attr("class");
            var newClassStr = classStr.replace(/label/g, "badge");
            $(this).removeAttr("class").addClass(newClassStr);
        });
    }
});
</script>
    <script type="text/javascript">
      function showTime(){
    var date = new Date();
    var day =  date.getdate();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time =h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    
    setTimeout(showTime, 1000);
    
}

showTime();
    </script>

<!-- jQuery 3 -->
<script src="js/jquery22.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="js/bootstrap22.min.js"></script>
<!-- Morris.js charts -->
<script src="js/raphael22.min.js"></script>
<script src="js/morris22.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick22.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte22.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo22.js"></script>
      

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </div>
</body>
</html>                             		                            
