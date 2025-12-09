<!DOCTYPE html>
<html lang="en">

<head>
  <title>Home</title>
  <link rel="icon" href="images/wee-Logo-d.png">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
  <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets2/vendor/bootstrap-icons/bootstrap-icons.css"rel="stylesheet">
  <link href="assets2/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets2/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets2/vendor/swiper/swiper-bundle.min.css"rel="stylesheet">
  <link href="assets2/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
  <link href="assets2/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="assets2/css/stylee.css">
  <script src="js/snowflakes.js"></script>
  <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  
   <script>
      window.onload = function() {
        var context = new AudioContext();
      }
      </script>


<?php 
require_once("inc/config.inc");

  if($_SESSION['username'] == ''){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }
     $self = $_SESSION['id'];
$role_id = $_SESSION['role_id'];
$s_username = $_SESSION['username'];

     if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 2000)) {
// last request was more than 30 minutes ago
session_unset();     // unset $_SESSION variable for the run-time 
session_destroy();   // destroy session data in storage
 header("location: index.php"); 
}
$_SESSION['LAST_ACTIVITY'] = time();
                    
 if($_SESSION['role_id'] == 7){

 header('location: chat.php');
    }

if (isset($_SESSION['id'])) { $aya = $_SESSION['id']; }
$checkme = sqlsrv_query( $con ,"SELECT * FROM [employee] WHERE [id] = '$aya'");
$output = sqlsrv_fetch_array($checkme );
$Unit_Name = $output['Unit_Name'];
$username_id = $output['username_id'];
$unit = $_SESSION['Unit_Name'];
 /* if($orders_num > 0){*/
$self = $_SESSION['id'];
$check_request = sqlsrv_query($con,"SELECT * FROM employee_web_table
  where manager = '$self'");
while($outputing = sqlsrv_fetch_array($check_request)){
$employees = $outputing['id'];
}
$query = sqlsrv_query($con ,"with x as (

SELECT count(distinct deduction.[id]) as test   FROM deduction
      left join [dbo].[employee_web_table] on [dbo].[employee_web_table].id = deduction.[engineer_id]
 
  WHERE  [status] ='pending'and [manager] ='$self'
   
   union all

SELECT count(distinct leaves.[id]) as test  FROM leaves
        left join [dbo].[employee_web_table] on [dbo].[employee_web_table].id = leaves.[engineer_id]

 WHERE [status] ='pending'  and [manager] ='$self'
  union all

SELECT  count(distinct [s_id]) as test  FROM create_task 
      left join [dbo].[employee_web_table] on [dbo].[employee_web_table].id = create_task.[engineer_id]
  
  WHERE  [status] ='pending'and [manager] ='$self'
    union all

  SELECT  count(distinct [oncall_sd].[id]) as test  FROM  [dbo].[oncall_sd]
      left join [dbo].[employee_web_table] on [dbo].[employee_web_table].id = [oncall_sd].[engineer_id]

  WHERE  [status] ='pending'and [manager] ='$self'
    union all
  SELECT  count(distinct [swaping].[id]) as test  FROM  [dbo].[swaping]
      left join [dbo].[employee_web_table] on [dbo].[employee_web_table].id = [swaping].[engineer_id]
  
  WHERE  [status] ='pending'and [manager] ='$self'
  
  )
  SELECT sum(test) as counting from x");

 while($query_out = sqlsrv_fetch_array($query)){
 $count = $query_out['counting'];

}
?>
</head>

<body>
  <style type="text/css">
   section {
  padding: 70px 0 0 0;
  display: block;
  overflow: hidden;
}
 
.navbar{
  display: block;

}
div.table-responsive>div.dataTables_wrapper>div.row{margin:auto;}
body{
 /* background-image: url('images/professional-images-for-websit.jpg');*/
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  max-width: 100%;
  right: 0;
  margin: auto;
  padding: auto;
  height: auto;

 }
.notification {
  color: white;
  text-decoration: none;
  position: relative;
  border-radius: 50%;
  top: -8px;
  font-weight: bold;
  font-size: 15px;
}

.notification:hover {
  background: blue;
}
 
 .carousel-indicators li {
    display: inline-block;
    width: 15px;
    height: 15px;
    margin: 1px;
    text-indent: -999px;
    cursor: pointer;
    background-color: #fff;
    border: 1px solid #fff;
    border-radius: 10px;
}
.carousel{
  /*top: 150px;*/
}

/*#myDIV {
  -webkit-animation: mymove 5s infinite;
  animation: mymove 4s infinite;
}

@keyframes mymove {
  60% {text-shadow:10px 10px 20px yellow;}
  50% {color: red;}

}*/

#myDIV {
 /* border: 1px solid black;
  width: 300px;*/
  color: orange;
  animation: mymove 5s infinite;
}

@keyframes mymove {
  50% {color: blue;}
  20% {color: yellow;}

}


.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
  .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
  tr:nth-child(even) {
  background-color: lightgray;
}

        .tableFixHead       
 { 
   height:210px;overflow-y: auto;
   overflow-x: hidden;
 }
.tableFixHead thead th 
{ 
  position: sticky; top: 0; 
  z-index:4;
  vertical-align: top;
  background-color: #55608f; 
  color: white;
}
.containers {
  position: relative;
  text-align: center;
  color: white;
}
.centereds {
  position: absolute;
  top: 55%;
  left: 3%;
  /*transform: translate(-50%, -50%);*/
}
#snowflakeContainer {
    position: absolute;
    left: 0px;
    top: 0px;
    display: none;
  }

  .snowflake {
    position: fixed;
    user-select: none;
    z-index: 1000;
    pointer-events: none;
    border-radius: 50%;
    width: 10px;
    height: 10px;
  }
  /*.vh-100{
    height:80vh;
  }*/
  </style>
 <!--  <div id="snowflakeContainer">
  <span class="snowflake"><img src="images/confetti.png" width="20"></span>
</div> -->
<div>
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
      <a href="home.php" class="logo d-flex ">
        <img src="images/Untitled3-removebg-preview.png" style="margin-left: -45%;">
      </a>
      <nav id="navbar" class="navbar">
        <ul>      
  <?php
  if($role_id ==1){
  $query = sqlsrv_query($con ,"with x as (

SELECT count(distinct deduction.[id]) as test   FROM deduction
      left join [dbo].[employee_web_table] on [dbo].[employee_web_table].id = deduction.[engineer_id]
 
  WHERE  [status] in 
  ('SENIOR APPROVE','super approve','section approve','Unit Approve') 
   
   union all

SELECT count(distinct leaves.[id]) as test  FROM leaves
        left join [dbo].[employee_web_table] on [dbo].[employee_web_table].id = leaves.[engineer_id]

 WHERE [status] in 
  ('SENIOR APPROVE','super approve','section approve','Unit Approve')   
  union all

SELECT  count(distinct [s_id]) as test  FROM create_task 
      left join [dbo].[employee_web_table] on [dbo].[employee_web_table].id = create_task.[engineer_id]
  
  WHERE  [status] in 
  ('SENIOR APPROVE','super approve','section approve','Unit Approve') 
  )
  SELECT sum(test) as counting from x");

 while($query_out = sqlsrv_fetch_array($query)){
 $wfm_count = $query_out['counting'];}
    if($wfm_count >0){   
  echo'<li ><a id="myDIV" href="Admin_approve.php" >
        '.$wfm_count.' Requests</a></li>';
      }
       echo'<li class="dropdown"><a href=""><span>WFM</span> 
      <i class="bi bi-chevron-down"></i></a>
          <ul>    
            <li><a href="Tracking_wfm.php">Tracking
              <img src="images/un_Tracking.png" style="width:20px;"></a></li>
            <li><a href="approve_tickets.php">Approve Ticketing system
              <img src="images/Tickets-icon.png" style="width:20px;"></a></li>
            <li><a href="ticketing_updates.php">Update Tickets
              <img src="images/helpdesk-ic.jpg" style="width:20px;"></a></li>
            <li><a href="schedule_update.php">Update Schedule
              <img src="images/schedule-icon2.jpg" style="width:20px;"></a></li>
            <li><a href="employee_info_wfm.php">Employees Database
              <img src="images/person-with.png" style="width:20px;"></a></li>
            <li><a href="Employees.php">Edit Employee
              <img src="images/0cd88fcc8b.png" style="width:20px;"></a></li>
            <li><a href="allstatus2.php">All views
              <img src="images/history_o.png" style="width:20px;"></a></li>
            </ul>
          </li>';
        }
        if($_SESSION['username'] == 'mohamed.bahaa'){
           echo'<li class="dropdown"><a href=""><span>Bahaa</span> 
      <i class="bi bi-chevron-down"></i></a>
          <ul>    
            <li><a href="Resignation_Table.php">Resignation Table
              <img src="images/resignationss.jfif" style="width:20px;"></a></li>
            <li><a href="summary_headcount.php">summary headcount
              <img src="images/con-headcount.png" style="width:20px;"></a></li>
            <li><a href="ticketing_updates.php">Update Tickets
              <img src="images/helpdesk-ic.jpg" style="width:20px;"></a></li>
            <li><a href="schedule_update.php">Update Schedule
              <img src="images/schedule-icon2.jpg" style="width:20px;"></a></li>
            </ul>
          </li>';

        }

        ?>

            <?php
       if (($role_id > 0) && ($count > 0) ){
  echo'<li ><a id="myDIV" href="approve_request.php" >
        '.$count.' Requests</a></li>';
         }
        ?>
 <?php if(($role_id >= 1) && ($_SESSION['username'] <> 'mohamed.bahaa') ){

  ?>
      <li class="dropdown"><a href=""><span>Ticket System</span> 
      <i class="bi bi-chevron-down"></i></a>
          <ul>    
            <li><a href="Ticketing_system.php">Create Ticket <img src="images/helpdesk-ic.jpg" style="width:20px;">
              
            </a></li>
            <li><a href="Ticketingsys_history.php">View ticket 
             history <img src="images/helpdesk-ic.jpg" style="width:20px;">
           </a></li>
            </ul>
          </li>
      <?php }?>
<li class="dropdown"><a href="#">
  <span>Attendance</span> <i class="bi bi-chevron-down"></i></a>
      <ul>
<?php if($role_id == 0){
          ?>
        <li><a href="Create_Leaves.php">Create leaves<i class="fa fa-sign-out" ></i></a></li>
      <?php }?>
        <?php if($role_id >= 1){
          ?>
      <li class="dropdown"><a href="signing_machine.php">
        <span>Create leaves</span> 
        <i class="bi bi-chevron-right"></i></a>
    <ul>
      <li><a href="Create_Leaves.php">Create my leaves 
        <i class="fa fa-sign-out" ></i>
      </a></li>
      <li><a href="Create_team_Leaves.php">Create leaves my team 
      <i class="fa fa-sign-out" ></i></a></li>
      </ul>
    </li>
    <?php }?>
      <li><a href="signing_machine.php">Signing machine<img src="images/finger.png" style="width:20px;">
      </a>
      </li>
   
      <li><a href="create_deduction.php"> Create deduction<img src="images/deduct.png" style="width:20px;">

      </a></li>
      <li><a href="create_swap.php"> Create Swap<img src="images/swapinggg.png" style="width:20px;">
       </a></li>


        <li class="dropdown">
      <a href=""><span>Schedule</span> 
      <i class="bi bi-chevron-right"></i></a>
          <ul>
            <li><a href="my_schedule.php">My Schedule
            <i class="fa fa-calendar"></i>
          </a></li>
            <li><a href="my_team_schedule.php">Team Schedule
            <i class="fa fa-calendar"></i>
          </a></li>
          <?php 
          if($role_id >=1){
    // $new_querys= sqlsrv_query( $con ,"exec view_add_edit_sch_username 
    //  @username =  '$s_username'");
    //         $out_new = sqlsrv_fetch_array($new_querys);
    //         $my_username = $out_new['username'];
    //// resedint 
          /*  $new_querys2= sqlsrv_query( $con ,"SELECT distinct manager_name
from [Employess_DB].[dbo].[tbl_Personal_info]
where sub_Group=2 and Employee_Status='active' and grade='l8' and unit=12");
            $resedint_new = sqlsrv_fetch_array($new_querys2);
            $resedint_user = $resedint_new['manager_name'];*/
   
          //  if(($my_username) || ($resedint_user) ){

         // if($role_id <> 0){
            //if($my_username){
             $new_querys= sqlsrv_query( $con , "exec view_add_edit_sch_username  @username =  '$s_username'");
              $out_new = sqlsrv_fetch_array($new_querys);
            $my_username = $out_new['username'];
         
            if($my_username){
          ?>
          <li><a href="edit_team_schedule.php">Add & Edit Schedule
            <i class="fa fa-calendar"></i>
          </a></li>
          <?php
        }
      }
        ?>
         </ul>
       </li>

           <li class="dropdown">
          <a href=""><span>view History</span> 
          <i class="bi bi-chevron-right"></i></a>
            <ul>
              <li><a href="attendance_sch.php">Sign History
              <img src="images/finger.png" style="width:20px;"></a></li>
              <li><a href="Leaves_History.php">Leaves History
              <i class="fa fa-sign-out" ></i>
              </a></li>
              <li><a href="deduction_view.php">Deduction History
              <img src="images/deduct.png" style="width:20px;"></a></li>
              <li><a href="swap_view.php">Swap History 
              <img src="images/swapinggg.png" style="width:20px;"></a></li>
              </ul>
          </li>
     
        <?php if($role_id >= 1){
          ?>
          <li class="dropdown">
            <a href=""><span>My Team History</span> 
            <i class="bi bi-chevron-right"></i></a>
              <ul>
                <li><a href="team_sign.php">Team Sign History
                <img src="images/finger.png" style="width:20px;"></a></li>
                <li><a href="Team_Leaves.php">Team Leaves History
                <i class="fa fa-sign-out" ></i>
              <!--   <span class="badge pull-right" id="myDIV" style="font-size:28px;">*</span> -->
              </a></li>
                <li><a href="team_deduction.php">Team Deduction History
                <img src="images/deduct.png" style="width:20px;">
              </a></li>
                <li><a href="Team_Swap.php">Team Swap History
                <img src="images/swapinggg.png" style="width:20px;"></a></li>
                </ul>
            </li>        
          <?php
        }
        ?>
         </ul>
        </li>

    <li class="dropdown"><a href=""><span>Activities</span> 
      <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="Create_tasks.php">Create Tasks
              <img src="images/my_tasksss.png" style="width:25px;"></a>
            </li> 
            <?php 
   $check_all = sqlsrv_query( $con ,"SELECT 
                b.[username]
            FROM [Aya_Web_APP].[dbo].[employee] b
            left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
            where unit in (12, 13 ,14, 15 ,16 ,17) and b.username = '$s_username'  ");
          $out_all = sqlsrv_fetch_array($check_all );
          $all_username = $out_all['username'];
         
            if($all_username){ 
  ?>     
            <li><a href="Create_OnCall.php">Create OnCall
            <img src="images/oncall_preview.png" style="width:25px;">
          </a></li>
<?php }
?>
              <li class="dropdown"><a href="#"><span>View History</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="Create_task_view.php">Tasks hitory
                  <img src="images/my_tasksss.png" style="width:25px;">
                </a></li>
                          <?php 
/*
Units_ID  Units
12  Enterprise Service Desk
13  Enterprise Support Systems
14  Onsite Problem Management
15  Problem Management and Service Optimization
16  Quality Management and Training
17  Workforce Management
   $output = sqlsrv_fetch_array($checkme );
          $Unit_Name = $output['Unit_Name'];
          if ($unit == $Unit_Name ){
*/

          $check_all = sqlsrv_query( $con ,"SELECT 
                b.[username]
            FROM [Aya_Web_APP].[dbo].[employee] b
            left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
            where unit in (12, 13 ,14, 15 ,16 ,17) and b.username = '$s_username'  ");
          $out_all = sqlsrv_fetch_array($check_all );
          $all_username = $out_all['username'];
         
            if($all_username){ 
       
  ?>
                  <li><a href="OnCall_view.php">On call history
                  <img src="images/oncall_preview.png" style="width:20px;">
                </a></li>
                <?php }
?>
                </ul>
              </li>

               <?php if($role_id >0 ){
          ?>

          <li class="dropdown">
            <a href=""><span>My Team History</span> 
            <i class="bi bi-chevron-right"></i></a>
              <ul>
                <li><a href="team_task.php">Team Tasks History
                <img src="images/my_tasksss.png" style="width:25px;"></a></li>
                         <?php 
   $check_all = sqlsrv_query( $con ,"SELECT 
                b.[username]
            FROM [Aya_Web_APP].[dbo].[employee] b
            left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
            where unit in (12, 13 ,14, 15 ,16 ,17) and b.username = '$s_username'  ");
          $out_all = sqlsrv_fetch_array($check_all );
          $all_username = $out_all['username'];
         
            if($all_username){ 
              ?>
                <li><a href="Team_OnCall.php">Team On call History
                <img src="images/oncall_preview.png" style="width:20px;"></a></li>
                <?php }
                    ?>
                </ul>
            </li>        
          <?php
        }
        ?>
             
            </ul>
          </li>
         
          <li class="dropdown"><a href="#"><span>Reports</span>
           <i class="bi bi-chevron-down"></i></a>
            <ul>
              <?php 
              if($role_id >= 0){
              //16  Quality Management and Training
               $checkme = sqlsrv_query( $con ,"SELECT 
                b.[username]
            FROM [Aya_Web_APP].[dbo].[employee] b
            left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
            where unit in(16,17) and b.username = '$s_username'  ");
          $out_new = sqlsrv_fetch_array($checkme );
          $Q_username = $out_new['username'];
         
            if($Q_username){          

            ?>
            <li><a href="Quality.php">Quality Reports 
          <img src="images/dashbordssss.png" style="width:25px;"></a></li>
              <?php 
            }}
            ?>
          
              <?php if($role_id == 0){
                //12  Enterprise Service Desk
                $checkme_SD = sqlsrv_query( $con ,"SELECT 
                b.[username]
            FROM [Aya_Web_APP].[dbo].[employee] b
            left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
            where unit = 12 and b.username = '$s_username'  ");
          $out_new = sqlsrv_fetch_array($checkme_SD );
          $SD_username = $out_new['username'];
         
            if($SD_username){  
          ?>
          <li><a href="Charts.php">Dashboards
          <img src="images/dashbordssss.png" style="width:25px;"></a></li>
          <li><a href="mwd_reports.php">KPI`S
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
          <li><a href="utiliz_Absence.php?utiliz">utilization
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
          <li><a href="utiliz_Absence.php?Absence">Absenteeism
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
          <li><a href="Ticket_Process_Tracking.php">Process/No Process
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>

           <?php 
         }}
         if($role_id == 0){
            //14  Onsite Problem Management
               $checkme_On = sqlsrv_query( $con ,"SELECT 
                b.[username]
            FROM [Aya_Web_APP].[dbo].[employee] b
            left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
            where unit =14 and b.username = '$s_username'  ");
          $out_new = sqlsrv_fetch_array($checkme_On );
          $On_username = $out_new['username'];
         
            if($On_username){
         ?>

          <li><a href="utiliz_Absence.php?utiliz">utilization
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
          <li><a href="Ticket_Process_Tracking.php">Process/No Process
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
          <li><a href="utiliz_Absence.php?Absence">Absenteeism
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
          <?php 
        }}
        ?>
         <?php
         if($role_id <> 0) {

            $checkme_wfm = sqlsrv_query( $con ,"SELECT 
                b.[username]
            FROM [Aya_Web_APP].[dbo].[employee] b
            left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
            where unit in(17,12) and b.username = '$s_username'  ");
          $out_wfm = sqlsrv_fetch_array($checkme_wfm );
          $wfm_username = $out_wfm['username'];
         
            if($wfm_username){ 
          ?>
          <li><a href="Team_Reports.php">Dashboards
          <img src="images/dashbordssss.png" style="width:25px;"></a></li>
          <li><a href="Daily_reports.php">Daily Reports
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
          <li><a href="psc_reports.php">PSC Reports
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
        <li class="dropdown"><a href="#"><span>KPI`S Reports</span>
        <i class="bi bi-chevron-right"></i></a>  
            <ul>
              <li><a href="mwd_reports.php">Old KPI`S
              <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
              <li><a href="new_kpi.php">New KPI`S 
             <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
             <li><a href="Summary_kpi.php">Summary KPI`S 
             <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>

              </ul>
          </li> 
        <?php
        }}
        ?>
        <?php
         if($s_username == 'Ahmed.AbdelFattah') {

          ?>
          <li><a href="Team_Reports.php">Dashboards
          <img src="images/dashbordssss.png" style="width:25px;"></a></li>
          <li><a href="Daily_reports.php">Daily Reports
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
          <li><a href="psc_reports.php">PSC Reports
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
        <li class="dropdown"><a href="#"><span>KPI`S Reports</span>
        <i class="bi bi-chevron-right"></i></a>  
            <ul>
              <li><a href="mwd_reports.php">Old KPI`S
              <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
              <li><a href="new_kpi.php">New KPI`S 
             <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
             <li><a href="Summary_kpi.php">Summary KPI`S 
             <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>

              </ul>
          </li> 

           <li class="dropdown"><a href=""><span>Utilization</span> 
            <i class="bi bi-chevron-right"></i></a>
              <ul>
                <li><a href="utilization_less_abusing.php">Utilization <30%
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                <li><a href="tasks_utilizations.php">Tasks utilization
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                <li><a href="utiliz_perUser.php">utilization per user
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                <li><a href="utiliz_Absence_groups.php?Utilizgroup">utilization per group
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                <li><a href="TicketProcessTracking.php">Process/No Process
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
              </ul>
            </li>  
        <?php
        }
        ?>
      <?php
      if($role_id <> 0){
        if($unit !== $Q_username){
          $checkme_wfm = sqlsrv_query( $con ,"SELECT 
                b.[username]
            FROM [Aya_Web_APP].[dbo].[employee] b
            left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
            where unit in(17,12) and b.username = '$s_username'  ");
          $out_wfm = sqlsrv_fetch_array($checkme_wfm );
          $wfm_username = $out_wfm['username'];     
            if($wfm_username){
    
        ?>
           <li class="dropdown"><a href=""><span>Utilization</span> 
            <i class="bi bi-chevron-right"></i></a>
              <ul>
                <li><a href="utilization_less_abusing.php">Utilization <30%
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                <li><a href="tasks_utilizations.php">Tasks utilization
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                <li><a href="utiliz_perUser.php">utilization per user
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                <li><a href="utiliz_Absence_groups.php?Utilizgroup">utilization per group
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                <li><a href="TicketProcessTracking.php">Process/No Process
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
              </ul>
            </li>     

           <li class="dropdown"><a href=""><span>Absenteeism</span> 
            <i class="bi bi-chevron-right"></i></a>
              <ul>
                <li><a href="Absence_perUser.php">Absenteeism per user
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                <li><a href="utiliz_Absence_groups.php?Absence">Absenteeism per group
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                </ul>
            </li>     
          <?php
        }}}
        if($role_id >= 1){
            //14  Onsite Problem Management
               $checkme_On = sqlsrv_query( $con ,"SELECT 
                b.[username]
            FROM [Aya_Web_APP].[dbo].[employee] b
            left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
            where unit =14 and b.username = '$s_username'  ");
          $out_new = sqlsrv_fetch_array($checkme_On );
          $On_username = $out_new['username'];
         
            if($On_username){
        ?>
        <li class="dropdown"><a href=""><span>Utilization</span> 
            <i class="bi bi-chevron-right"></i></a>
              <ul>
                <li><a href="utilization_less_abusing.php">Utilization <30%
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                <li><a href="tasks_utilizations.php">Tasks utilization
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                <li><a href="utiliz_perUser.php">utilization per user
                 <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                <li><a href="utiliz_Absence_groups.php?Utilizgroup">utilization per group
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                <li><a href="TicketProcessTracking.php">Process/No Process
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                </ul>
            </li>     

           <li class="dropdown"><a href=""><span>Absenteeism</span> 
            <i class="bi bi-chevron-right"></i></a>
              <ul>
                <li><a href="Absence_perUser.php">Absenteeism per user
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                <li><a href="utiliz_Absence_groups.php?Absence">Absenteeism per group
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                </ul>
            </li> 
          <?php 
        }}
        ?>
        </ul>
      </li>

          <li class="dropdown"><a href="#">More Info
          <i class="bi bi-chevron-down"></i></a>
            <ul>
        <li><a href="profile.php">My Profile
          <img src="images/human_male.png" style="width:40px;"></a></li>
          <li><a href="update_info.php">Update my Info
          <img src="images/human_male.png" style="width:40px;"></a></li>
          <?php 
          if($role_id >= 1) {
            ?>
          <li><a class="nav-link scrollto" href="Employee_info.php">
        My Team Info<img src="images/personal_infooo.png" style="width:30px;">
      </a></li>
      <?php }

$engineer_id = $_SESSION['id'];

$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id  = 482 ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  //$output_engineers = $check_engineers->fetch_array()){
  $engineers_id = $output_engineers['id'];
  
  $check_orders = sqlsrv_query( $con ,"SELECT * FROM chat_box WHERE [send_to] = '$engineers_id'" , array() , array('Scrollable' =>'static') );
  $orders_num = sqlsrv_num_rows($check_orders);
  $sqltime = date ("Y-m-d H:i:s");
     $time =['when_time'];

 
  $check_orders2 = sqlsrv_query( $con ,"SELECT * FROM chat_box WHERE [send_from] = '$engineers_id'" , array() , array('Scrollable' =>'static') );
  $orders_num2 = sqlsrv_num_rows($check_orders2);

  //$max = $orders_num2 - $orders_num;
   if($max = $orders_num2 >= $orders_num ){
  echo'<label class="glyphicon glyphicon-bell" align="center"style="color:#FBBC05;font-size:22px;  height: 35px;text-align:center;
  width: 35px;border-radius: 60%;"></label>' ;}

}

?>
<li >
  <a class="nav-link scrollto" 
  href="chating.php?engineer_id=<?php echo $engineers_id;?>">
      Chating <img src="images/giphy.gif" style="width:40px;">
  </a>
</li>

      <li><a class="nav-link scrollto" href="change_password.php">
        Change password<img src="images/reset-password.jpg" style="width:30px;">
      </a></li>
        <li><a href="Indicator.php">Tool Indicator
        <img src="images/up-and-down.png" style="width:40px;">
      </a></li>
       <li><a href="Process_Page.php">Process Page
        <img src="images/processing.png" style="width:40px;">
      </a></li>
      <li><a href="Tool_Videos.php">Web tutorial
        <img src="images/Tool_Videos-icon.png" style="width:40px;">
      </a></li>
            </ul>
      </li>
     
                 <?php 
     $Notification = sqlsrv_query($con ,"EXEC  Notifications @username  = '$s_username'");
   $Notifi_query = sqlsrv_fetch_array($Notification);
   $Notifi_num = $Notifi_query['num']; 
                ?>

<span> <div class="dropdown for-notification">     
    <li>
<button class="btn btn-primary btn-md"type="button" id="notification" data-toggle="modal" data-target="#largeModal" aria-haspopup="true" aria-expanded="false"><span class="count"><?php echo  $Notifi_num;?></span><i class="fa fa-bell"></i></button>
      </li>
</div></span>
          <li title="Unit:<?php echo $output["Unit_Name"];?>">
          <a href="#" style="font-size:10px;">
          <span  class="glyphicon glyphicon-user"></span>
          Login<samp>:</samp>
          <?php echo $_SESSION["username"];?>
          </a></li>
          <li><a href="?logout"><span style="font-size:10px;">
            <i class="fa fa-sign-out"></i>
          </span>log out</a></li>
        </ul>
       <i class="bi bi-list mobile-nav-toggle"></i>

      </nav><!-- .navbar -->
    </div>


  </header>
</div>
   <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">Notifications</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
<style type="text/css">
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
  .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
  tr:nth-child(even) {
  background-color: lightgray;
}

        .tableFixHead       
 { 
   height:210px;overflow-y: auto;
   overflow-x: hidden;
 }
.tableFixHead thead th 
{ 
  position: sticky; top: 0; 
  z-index:4;
  vertical-align: top;
  background-color: #55608f; 
  color: white;
}
.containers {
  position: relative;
  text-align: center;
  color: white;
}
.centereds {
  position: absolute;
  top: 55%;
  left: 3%;
  /*transform: translate(-50%, -50%);*/
}
.topright {
        background: transparent;
        position: absolute;
        width: 32.5%;
    top: 0;
    right: 0;
    left: 0;
    z-index: 100;
      }

  /*.zoom:hover{
    transform: scale(1.5);
  }
  .apixu-weather-cover .zoom {
    width: 170%;
    max-height: 150%;
    background-size: cover;
    padding-bottom: 60%;
    display: block;
    background-repeat: no-repeat;
    background-position: center;}
    .apixu-weather-cover {
    width: 100%;
    max-height: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;}*/
    .parent {
display: grid;
grid-template-columns: repeat(5, 1fr);
grid-template-rows: repeat(4, 1fr);
grid-column-gap: 9px;
grid-row-gap: 0px;
}

.div1 { grid-area: 1 / 1 / 5 / 4; }
.div2 { grid-area: 1 / 4 / 5 / 6; }

 .middles {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color:#fff;
    width: 100%;
    z-index: 10;
    padding-left: 10px;
    padding-right: 10px;

        }

</style>
          

<div class="col-sm-12 tableFixHead">

  <table class="card-table table" >
     <thead style="color: white;font-size:15px;background-color:#55608f; ">
        <tr>
          <th scope="col">RequestID</th>
          <th scope="col">Date</th>
          <th scope="col">Info</th>
          <th scope="col">Type</th>
          <th scope="col">Action</th>
      </tr>
</thead>
<tbody >
<?php
       $Notifica = sqlsrv_query( $con ,"EXEC  Notifications_tbl_data @username  ='$s_username'");
      //while($output_query = sqlsrv_fetch_array($events_query)){ 
   while($Notifica_query = sqlsrv_fetch_array($Notifica)){
   $Notifica_id = $Notifica_query['Request_id']; 
   $Notifica_date = $Notifica_query['date']; 
   $Notifica_info = $Notifica_query['info']; 
   $Notifica_type = $Notifica_query['type']; 
   $Notifica_Action = $Notifica_query['Action']; 
    $rows ='<tr>';
      $rows .='<td style="border:3px solid #eee;">'.$Notifica_id.'</td>';
      $rows .='<td style="border:3px solid #eee;">'.$Notifica_date.'</td>';
      $rows .='<td style="border:3px solid #eee;">'.$Notifica_info.'</td>';
      $rows .='<td style="border:3px solid #eee;">'.$Notifica_type.'</td>';
      $rows .='<td style="border:3px solid #eee;">'.$Notifica_Action.'</td>';
    $rows .='</tr>';
echo $rows ; 
          } 
    ?> 
         </tbody>
        </table> 
      </div>
    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok
                </button>     
            </div>
        </div>
    </div>
</div>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <div class="u-background-video u-expanded">
        <div class="embed-responsive embed-responsive-1" 
        style="filter: brightness(0.5);">
          <video id="video-bg-elem" preload="auto" autoplay muted loop 
          width="1350"> 
            <source src="images/ramadan/videoplayback.mp4">
        </video>
        </div>
      <!--   <div  class="middles">
          <h3 >
            اللهم بلغنا رمضان وبارك لنا فيه، وارزقنا التوبة النصوحة، وأعنا فيه على ذكرك وشكرك وحسن عبادتك.

            </h3>
          <br>
          <p>
رمضــــــــان كريـــــــم        </p>
        </div> -->
      </div>


<!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> -->
  <?php// if($_SESSION['username'] == 'aya.abdelfattah'){
    ?>
  
<!--     <img src="images/clipart-ftlin.png" id="canvas" class="topright">
 -->
  <!--   
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
  </ol>
  <div class="carousel-inner">
    
  

    <div class="carousel-item active">
      <img class="d-block w-100" height="610" 
      src="images/ramadan/ramazan-33348.mp4">
    </div> -->

    <!-- <div class="carousel-item ">
      <img class="d-block w-100" height="610"src="images/Homepage-Banner-1700Wx651H-En.jpg" alt="Four slide">
    </div>
  

    <div class="carousel-item ">
      <img class="d-block w-100" height="610" src="images/WE-Access-Business-TE-ENG.jpg" alt="Five slide">
    </div> -->

 <!--  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<br>  
<br>
<br>  
<hr>
</div>
</div> -->
<br>  
<hr>
</div>

<div class="parent">
        <div class="div1">
          <?php //include('ramadan_2021.php');?> 
        </div>
  <div class="div2"> 

  


<?php
         /*
           <img src='images/4438162.png' width='60'>
           13=1
           14=2
           15=3
           16=4
           17=5
           18=6
           19=7
           20=8
           *s
    $time = date("H:i");
    if ($time < "12:30" ) {
     echo"<div class='containers'>";
             echo'<video id="video-bg-elem"  autoplay muted controls   style="background-size: cover;background-repeat: no-repeat;height:350px;" width="100%"> 
            <source src="images/ramadan/videoplayback_ramadan.mp4">
        </video>';
             echo"
                <div class='centereds'>
                <!--h4 style='font-size:20px;'>Good night : $s_username</h4-->
                </div></div>";
           }
           if ($time >= "12:30"  &&  $time < "17") {
            echo "<div class='containers'>
              <img class='card-img-top'src='images/ramadan/pngtree-hand-drawn.jpg' style='background-size: cover;background-repeat: no-repeat;height:350px;'>
                <div class='centereds'>
              
                </div></div>";

           
         }
    if ($time >= "17" && $time < "17:30") {
             echo "<div class='containers'>
              <img class='card-img-top'src='images/ramadan/fetar2.gif' style='background-size: cover;background-repeat: no-repeat;height:350px;'>
                <div class='centereds'>
              
                </div></div>";
              }
    if ($time > "17:30" && $time < "18") {
             echo"<div class='containers'>
             <img class='card-img-top'src='images/ramadan/fetar2.gif' style='background-size: cover;background-repeat: no-repeat;height:350px;'>
              <div class='centereds'>
              <h4 class='card-title mb-3' style='font-weight: bold; font-size:30px;color:gray;margin-top:-190px; text-align:center;left:-50px;' dir='rtl'>$s_username 
اقترب موعد الافطار
              </h4>
              </div></div>";
              }
    if ($time >= "18:15" && $time < "19:45") {
                echo"<div class='containers'>
              <img class='card-img-top'src='images/ramadan/prayer-breakfast-ramadan.jpg' style='background-size: cover;background-repeat: no-repeat;height:350px;'>
                <div class='centereds'>
                <!--h4 class='card-title mb-3' style='font-weight: bold; font-size:30px;color:gray;margin-top:-190px; text-align:center;'>Good afternoon: $s_username</h4-->
                </div></div>";
            }
  if ($time >= "19:45" && $time < "23:59") {
                 echo"<div class='containers'>
              <img class='card-img-top'src='images/ramadan/istockphoto-1.jpg' style='background-size: cover;background-repeat: no-repeat;height:350px;'>
                <div class='centereds' >
                <h4 class='card-title mb-3' style='font-weight: bold; font-size:30px;color:gray;margin-top:-190px; text-align:center;left:-50px;' dir='rtl'>$s_username
                صلاة التراويح  </h4>
                </div></div>";

           }
   if ($time >=  "23:59") {
               // shoot.jpeg
                echo"<div class='containers'>
           <img class='card-img-top'src='images/ramadan/fool.gif' style='background-size: cover;background-repeat: no-repeat;height:350px;'>
              <div class='centereds'>
                <h4 class='card-title mb-3' 
                style='font-weight: bold; font-size:25px;'>سحور: $s_username</h4>
                </div>
              </div>";
              }*/
                ?>         
                    
           <!-- </div> 
           </div> -->
          <!-- </div>
        </div>
      </div>
 -->
      </div>
</div>

  <div class="content">
      <div class="animated fadeIn">
          <div class="row" style="width:100%; padding: 20px;">

  <div class="col-md-4" >
      <div class="card" style=" padding: 0 0 5px 0;">
          <div class="card-header">
              <strong class="card-title">Prayer Times in EGYPT</strong>
          </div>
          <div class="card-body" >
            <div >
              <center >
              <iframe src="https://timesprayer.com/widgets.php?frame=2&amp;lang=en&amp;name=egypt&amp;time=0&amp;fcolor=45637d&amp;tcolor=26B5BF&amp;frcolor=fef598" style="top: 0;bottom: 0; overflow: hidden; overflow-y: hidden;height:250px; "></iframe>
              </center>
            </div>
          </div>
      </div>
  </div>

    <div class="col-md-4">
          <div class="card" style="padding-bottom: auto;">
              <div class="card-header">
                  <strong class="card-title">Daily tips</strong>
              </div>
              <div class="card-body">
                    <center>
                      <img class="card-img" src='images/oWrYb.jpg' style='background-size: contain;background-repeat: no-repeat;'>
                
                  </center>
              </div>
          </div>
      </div>

        
      <div class="col-md-4">
        <div class="card" style=" padding: 0 0 45px 0;">
            <div class="card-header">
                <strong class="card-title">Daily Quotes</strong>
              </div>
              <div class="card-body" >
    <img src="images/bg-preview.png" style="width:100%;"/>
      <div class="centered">
              <p class="card-text" >
                    <?php
      $first_query = sqlsrv_query( $con ,"SELECT Quotes  from [Aya_Web_APP].[dbo].[Tbl_Daily_Quotes]
  where dayy = DATEPART(day,getdate())");
      $output_query = sqlsrv_fetch_array($first_query);  

 echo $rows ='<p>'.$output_query["Quotes"].'</p>';
                    ?>
              </div>
           </div>
        </div>
      </div>



    </div>
    </div>
    </div>
  
 <div class="content">
      <div class="animated fadeIn">
        <div class="row" style="width:100%; padding: 20px;">

          <div class="col-md-4 ">
              <div class="card">
                  <div class="card-header">
                      <strong class="card-title">Online Courses </strong>
                  </div>

                  <div class="card-body">
      <ul class="list-group list-group-flush">
          <li class="list-group-item">
              <a href="https://www.edx.org/"> <i rel="icon" ><img rel="icon" src="images/EdX_Logo.png" style="width:20px;"/></i>
                <span> EDX</span></a>
          </li>
          <li class="list-group-item">
              <a href="https://www.coursera.org/courses?query=free"> <i rel="icon" ><img rel="icon" src="images/coursera.png" style="width:20px;"/></i>Coursera</a>
          </li>
          <li class="list-group-item">
              <a href="https://www.udemy.com"> <i class="icon"><img rel="icon" src="images/udemy.png" style="width:20px;"/></i> Udemy</a>
          </li>
          <li class="list-group-item">
              <a href="https://www.futurelearn.com/courses"> <i class="icon"><img rel="icon" src="images/future-learn5.png" style="width:9%;"/>FutureLearn</a></i>
              
          </li>
          <li class="list-group-item">
              <a href="https://www.udacity.com/"> <i class="icon"><img rel="icon" src="images/udacity-icon.png" style="width:20px;"/></i> Udacity</a>
          </li>
      </ul>
                      
                  </div>
              </div>
          </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Events</strong>
                        </div>
          <div class="card-body">

    <div class="tableFixHead">
    <table class="card-table table" >
          <thead style="color: white;font-size: 15px;background-color: #55608f; ">
            <tr>
              <th scope="col">Event</th>
              <th scope="col">Description</th>
            </tr>
          </thead>
          <tbody>
<?php
       $events_query = sqlsrv_query( $con ,"SELECT TOP (1000) [Event]
      ,[description]
  FROM [Aya_Web_APP].[dbo].[Tbl_event_table]
  where [year] = year(getdate()) and [month] >= month(getdate())");
      while($output_query = sqlsrv_fetch_array($events_query)){ 
$rows ='<tr>';
$rows .='<td class="hovers" style="border: 3px solid #eee;">'.$output_query["Event"].'</td>';
$rows .='<td class="hovers" style="border: 3px solid #eee;">'.$output_query["description"].'</td>';
$rows .='</tr>';
echo $rows ; 
          } 
    ?> 
         </tbody>
        </table> 
      </div>
    </div>
    </div>
  </div>
                  
         <div class="col-md-4">
              <div class="card zoom apixu-weather-cover">
                  <div class="card-header" >
                      <strong class="card-title" >Games</strong>
                  </div>
                <div  class="card-body " style="background-size: cover;"><iframe class="vh-100" width="100%"  src="https://www.addictinggames.com/embed/html5-games/24682" ></iframe>
              </div>
          </div>
         
  
        </div>

        </div>
      </div>
    </div>

<style type="text/css">
  .awe_wide .apixu_descr {
    padding-top: 1px;
}
</style>
  <div class="content">
      <div class="animated fadeIn">
        <div class="row" style="width: 100%; padding: 20px; margin-top:-30%;">  
     <div class="col-md-4">
              <div class="card">
                  <div class="card-header">
                      <strong class="card-title"height="150%">Online Weather </strong>
                  </div>

                  <div class="card-body" >
          <div id="wwo-weather-widget-2"></div>
          <script type='text/javascript' src='https://www.worldweatheronline.com/widget/v5/weather-widget.ashx?loc=683802&wid=2&tu=1&div=wwo-weather-widget-2' async></script>
          <noscript ><a href="https://www.worldweatheronline.com/cairo-weather/al-qahirah/eg.aspx" alt="Hour by hour Cairo, Al Qahirah weather">Cairo, Al Qahirah weather forecast hourly</a></noscript>
            </div>
           </div>
          </div>

          <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Employee Evaluation</strong>
                </div>
                  <div class="card-body">
           <div class="overlay"> Comming Soon...
            <i class="fa fa-refresh fa-spin"></i>
          </div>
            </div>
           </div>
          </div>


                  </div>
                </div>
              </div>
<!---img src="img_snowtops.jpg" style="width:30%;cursor:zoom-in"
  onclick="document.getElementById('modal01').style.display='block'">

  <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
    <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
    <div class="w3-modal-content w3-animate-zoom">
      <img src="img_snowtops.jpg" style="width:100%"-->
<!--br>
       <div class="content">
            <div class="animated fadeIn" style="width:100%; padding: 20px; margin-top:-40px;">
                    <div class="col-md-12 col-sm-4 display-cell">
                        <div class="card">
                            <div class="card-header">
                                <h4>Games</h4>
                            </div>
                            <div class="card-body">
                                <iframe width="100%" height="200" src="https://www.addictinggames.com/embed/html5-games/24682" ></iframe>
                            </div>
                        </div>
                    </div>
                  </div>
                </div-->
                    <!-- /# column -->
  <div id="snowflakeContainer">
    <span class="snowflake">
      <img src="images/balloon.png" width="15"></span>
  </div>
<hr>
<?php
////////////// happy B day/////////// 
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
    
$self = $_SESSION['id'];
$check_engineers1 = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id = '$self' ");
     while( $output_engineers = sqlsrv_fetch_array($check_engineers1)){

  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];
  $username_id = $output_engineers['username_id'];


$check_engineers = sqlsrv_query( $con1 ,"SELECT distinct [ID]
      ,[Employee_Name]
      ,[UserName],[Birth_Date],[Gender]
 FROM [Employess_DB].[dbo].[tbl_Personal_info] where [UserName] = '$s_username'  ");
$output_query = sqlsrv_fetch_array($check_engineers);
  $date = $output_query["Birth_Date"];
  $user = $output_query['UserName'];
  $gender = $output_query['Gender'];
  $maxDate = date('d-m', strtotime($date));
 
  '<br/>';
  '<br/>';
  $currentDate = date('d-m');

 if ($maxDate == $currentDate){
 /*if($_SESSION["role_id"] == 4){
  '<img src="new_year/giphy222.gif"  width="42%" > ';}
  */

   if($_SESSION["role_id"] >= 0){
echo '<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="mediumModalLabel"><p style="font-family:  cursive;">Happy BirthDay '.$s_username.'</p>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                         <center>
 <img src="images/hpday2.gif"style="background-repeat:no-repeat;
   background-size:cover; width:80%; "> 
   <audio controls >
  <source src="images/sounds/Waled.Tawfik.mp3" type="audio/ogg">
  <source src="images/sounds/Waled.Tawfik.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
</center>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
          </div>
      </div>
  </div>
</div>'; }

 }
 }

 ////////////// happy B day////////////
 //// OnCall 
//?if($_SESSION['username'] == 'aya.abdelfattah'){
   //$currentDate = date('d-m-Y');
   $dates = date('d');
      $currentDate = date('d-m-Y');
      $startdate = date('10-m-Y');
      $enddate = date('12-m-Y');
      $months = date('m');
      $this_year = date('Y');

    if(($currentDate >= $startdate) && ($currentDate <= $enddate)) {
 echo'<div class="modal fade" id="mediumModal2" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="mediumModalLabel" dir="rtl">
                  Payroll
        </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
    <center>
 <img src="images/WhatsApp-Image.jpeg"style="background-repeat:no-repeat;
   background-size:cover; width:90%;hight:70%; "> 
</center>
<br>
 Dears,<br>
        kindly be informed that the payroll of this month will be sent to the HR, so kindly let your engineers under your supervision create all their deduction complains and their leaves and tasks to be handled on WFM tool to avoid any deductions by maximum 10-'.$months.'-'.$this_year.'
         (12:00 PM)..
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>';
}
// vacations
 /* $currentDate = date('d-m-Y');
   $dates = date('d');
 //if ($dates  )  {
 
  $startdate = date('10-m-Y');
  $vcation_day = date('10-m-Y');
*
    //if($startdate = $currentDate && $currentDate <= $enddate) {

if($_SESSION['username'] == 'aya.abdelfattah'){
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);

      $check_engineers = sqlsrv_query( $con1 ," SELECT distinct [ID],[Gender]
      FROM [Employess_DB].[dbo].[tbl_Personal_info]
      where UserName ='$s_username' and Gender like '%emale'");
      $output_query = sqlsrv_fetch_array($check_engineers);

      $Gender = $output_query['Gender'];

      //if(($Gender =='female')|| ($Gender =='Female')){
   '<style type="text/css">
.modal-titles {
    margin: 0;
    line-height: 1.42857143;
}
.modal-contents, #caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}
.modal-contents {   
    background-image:url("images/giphy13.gif");
    background-repeat: no-repeat;
  background-position: center;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #888;
    width:45%;
    position: static;
    z-index: 10;
}

label {
display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
}

h1, h2, h3, h4, h5, h6 {
    font-family: "Nunito", sans-serif;
}
.h5, h5 {
    font-size: 1.25rem;
    font-weight: 500;

}

.modal-footers {
    display: flex;
    flex-wrap: wrap;
    flex-shrink: 0;
    align-items: center;
    justify-content: flex-end;
    padding: 0.75rem;
    border-top: 1px solid #dee2e6;
    border-bottom-right-radius: calc(0.3rem - 1px);
    border-bottom-left-radius: calc(0.3rem - 1px);
}
button:not(:disabled) {
    cursor: pointer;
}


.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
  float:right;
}

.close2 {
    float: right;
    font-size: 21px;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: .2;
}

</style>
<div id="dataModal" tabindex="-1" role="dialog" >
    <div>
     <div class="modal" id="message21"style="isplay: block;background: rgba(0, 0, 0, 0.2);">
      <div id="myOut" class="modal-contents" >
<div class="modal-titles" style="color:white; font-weight:bold" >
        Happy Mothers Day For All Lovely Moms and Girls 
         <button class="close" style="float:right;" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" >×</span>
           </button>
           </div>
           <div class="modal-body">
           <center>
                <img src="images/Mothers-Day-PNG-Picture"style="background-repeat:no-repeat;
    background-size:cover; width:50%;backdrop-filter: blur(4.5px);"> 
    
      </center>
      </div>
        <br>
          <div class="modal-footers">
          </label>
             <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    <!--/div-->
    <script type="text/javascript">
      $(".close").click(function () {
    //close action
      document.getElementById("message21").style.display = "none";
          });
    </script>';
     "<script >
     $(window).on('load', function() {
        document.getElementById('message21').style.display = 'block';
    });
</script>";
*/   //if($currentDate ){
  // if($_SESSION['username'] == 'aya.abdelfattah'){
    $today = date('22-03-2023');
    //if($today <= $currentDate ){

   
      $ramadan_notes = sqlsrv_query( $con ,"SELECT  [id]
      ,[ramadan_note]
  FROM [Aya_Web_APP].[dbo].[ramadan_notes]
  where id = DATEPART(day,getdate())");
      $ramadan = sqlsrv_fetch_array($ramadan_notes); 
      $ramadanN =$ramadan["ramadan_note"]; 

$repramadanN = str_replace('”' , "`", $ramadanN);

  echo '<div class="modal fade" id="mediumModal3" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true" >
   <div id="snowflakeContainer">
  <span class="snowflake"><img src="images/ramadan/fanoos202.png" width="15"></span>
</div>
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content"style="background-image: url(images/ramadan/kalfya22.jpg); background-repeat:no-repeat;
          background-size:cover;  ">
              <div class="modal-header" style="background-color: rgba(0, 0, 0, 0.6);">
                  <h5 class="modal-title" id="mediumModalLabel" style="text-align:center; color:#fff; font-size:25px;
                  font-weight:bold; " >
                   <i ><img rel="icon" src="images/ramadan/lamp20.gif" style="width:10%;filter: brightness(0.9);"/> 
                   </i>
رمضـــــــان كريــــــم
                   <img rel="icon" src="images/ramadan/lamp20.gif" style="width:10%;filter: brightness(0.9);"/> 
                    </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>
              </button>
             
          </div>
              <div class="modal-body"style="background-color: rgba(0, 0, 0, 0.6);">
    <center>

 <div style="text-align: left; color:#eee;
 height:250px;padding:10px;text-align: center;">
<br>
<br>

  <h2 height:"250" >'.$repramadanN.'</h2>
<br>
<!--br>
<audio controls >
  <source src="images/ramadan/Wahawy_Ya_Wahawy.mp3" type="audio/ogg">
  <source src="images/ramadan/Wahawy_Ya_Wahawy.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio-->
 </div>

       </div>

          <div class="modal-footer"style="background-color: rgba(0, 0, 0, 0.6);">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>

          </center>
      </div>
  </div>
</div>';//}
 
 ?>

    <script type="text/javascript">
      $(window).on('load', function() {
        $('#mediumModal').modal('show');
    });
</script>

<script type="text/javascript">
      $(window).on('load', function() {
        $('#mediumModal2').modal('show');
    });
</script>

<script type="text/javascript">
      $(window).on('load', function() {
        $('#mediumModal3').modal('show');
    });
</script>
 
  <!-- Vendor JS Files >
  <script src="js/jquery-3.3.1.min.js"></script-->  
  <script src="js/jquery-3.6.0.min.js"></script>
  <script src="js/snowflakes.js"></script>
  <script src="assets2/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="assets2/vendor/aos/aos.js"></script>
  <script src="assets2/vendor/php-email-form/validate.js"></script>
  <script src="assets2/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets2/vendor/purecounter/purecounter.js"></script>
  <script src="assets2/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets2/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets2/js/main.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="jQuery/bootstrap.min.js"></script>
  <script src="jQuery/jquery-2.2.4.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
<?php
  include ("footer.html");
 ?>
<!-- <footer class="text-center text-white" 
style="background: linear-gradient(to bottom, #45637d 0%, #006699 100%);
 ">
  <div class="container">
      <div class="row d-flex justify-content-center">
       <div class="col item social">
       <img src="images/man-woman-businesspreview.png" style="width: 40%;"/>
       <i style="font-size: 50px;" class="fa fa-long-arrow-right"></i>
       <img src="images/Banner-imageremovebg-preview.png" style="width: 40%;"/>
  </div>

      </div>
      WE Develop more ... to Achieve more
  </div>
<br>
  <div class="text-center p-3"style="background-color: rgba(0, 0, 0, 0.2);">
    © Copyrights 2021 Enterprice Workforce 
    <a class="text-white">Management</a>
  </div>
</footer> -->


</html>