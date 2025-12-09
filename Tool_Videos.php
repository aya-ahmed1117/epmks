
<!DOCTYPE html>
<html>
<head>
  <title>Tool Videos</title>
<link rel="icon" href="images/logo_we.jpg">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
  <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets2/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets2/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets2/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets2/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans:900|Merriweather&display=swap" rel="stylesheet">  <!-- Load Styles -->
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/font-awesome22.min.css">
  <link href="cssland/styles.css" rel="stylesheet">
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <link href="assets2/css/style.css" rel="stylesheet">
</head>

<style type="text/css">
 /*  .home {
    width: 100%;
    height: 5vh;
    background-position: center top;
  background-size:cover;
}
*/
.notification {
  background-color: #555;
  color: white;
  text-decoration: none;
  position: relative;
  border-radius: 50%;
  top: -14px;
  right: 10%;
  font-weight: bold;
  font-size: 15px;
}

.notification:hover {
  background: blue;
}

footer {
  display: block;
}

.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url(images/niceee.gif) center no-repeat #0E0E15;

}

#myDIV {
  -webkit-animation: mymove 5s infinite;
  animation: mymove 4s infinite;
}

@keyframes mymove {
  60% {text-shadow:10px 10px 20px yellow;}
  50% {color: red;}

}
.header {
  display: block;
    z-index: 5;
    padding: 80px 0 10px 0;
    background-color: rgb(0, 0,0,0.4);
}
.header.header-scrolled {
    background-color: rgb(0, 0,0,0.8);
     padding: 0; 
    box-shadow: 0px 2px 20px rgb(1 41 112 / 10%);
}
body {
    background: linear-gradient(to bottom, #37205f 0%, #006699 100%);
    /*(to top left, #37205f 0%, #852990 100%);*/
    font-family: 'Merriweather', serif;
    color: #fff;
}


section.your-active-class .landing__container::before {
     content: '';
    background: rgba(255, 255, 255, 0.9);
  
    animation: rotate 4s linear 0s infinite forwards;
}


</style>
<?php 
require_once("inc/config.inc");

  if($_SESSION['username'] == ''){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }
   $self = $_SESSION['id'];
   $role_id = $_SESSION['role_id'];
   $s_username = $_SESSION['username'];
   $unit = $_SESSION['Unit_Name'];

 if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 2000)) {
// last request was more than 30 minutes ago
session_unset();     // unset $_SESSION variable for the run-time 
session_destroy();   // destroy session data in storage
header("location: index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();
                    


if (isset($_SESSION['id'])) { $aya = $_SESSION['id']; }
$checkme = sqlsrv_query( $con ,"SELECT * FROM [employee] WHERE [id] = '$aya'");
$output = sqlsrv_fetch_array($checkme );
$Unit_Name = $output['Unit_Name'];
$username_id = $output['username_id'];

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
  <div class="se-pre-con"></div>
<div>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="home.php" class="logo d-flex align-items-center">
<img src="images/Untitled3-removebg-preview.png" 
style="margin-left: -45%;">
      </a>

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto " 
          style="font-size: 18px;margin-left: -10px;padding-right:30px;" href="home.php"><i class="fa fa-home"></i> Home</a></li>
           <?php
       if (($role_id > 0) && ($count > 0) ){
  echo'<li ><a id="myDIV" href="approve_request.php" >
        '.$count.' Requests</a></li>';
         }
        ?>
          <?php if($role_id > 0){?>
<li class="dropdown"><a href=""><span>Ticketing System</span> 
      <i class="bi bi-chevron-down"></i></a>
          <ul>
       <li><a href="Ticketing_system.php">Create Ticket <img src="images/helpdesk-ic.jpg" style="width:20px;">
            </a></li>
            <li><a href="Ticketingsys_history.php">View ticket 
             history <img src="images/helpdesk-ic.jpg" style="width:20px;">
           </a></li>
            </ul>
          </li>
<?php } ?>
<li class="dropdown"><a href="#">
  <span>Attendance</span> <i class="bi bi-chevron-down"></i></a>
      <ul>
<?php if($role_id == 0){
          ?>
        <li><a href="Create_Leaves.php">Create leaves
        <i class="fa fa-sign-out" ></i></a></li>
      <?php }?>
        <?php if($role_id >= 1){
          ?>
      <li class="dropdown"><a href="signing machine.php">
        <span>Create leaves</span> 
        <i class="bi bi-chevron-right"></i></a>
    <ul>
      <li><a href="Create_Leaves.php">Create leaves my self
      <img src="images/my_tasksss.png" style="width:25px;"></a></a></li>
      <li><a href="Create_team_Leaves.php">Create leaves my team
      <i class="fa fa-sign-out" ></i></a></li>
      </ul>
    </li>
    <?php }?>
    <li><a href="signing machine.php">Signing machine<img src="images/finger.png" style="width:20px;">
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

          <li class="dropdown"><a href="signing machine.php">
          <span>view History</span> 
          <i class="bi bi-chevron-right"></i></a>
            <ul>
            <li><a href="attendance_sch.php">Sign History
              <img src="images/finger.png" style="width:20px;"></a></li>
              <li><a href="Leaves_History.php">Leaves History
              <i class="fa fa-sign-out" ></i></a></li>
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
                <i class="fa fa-sign-out" ></i></a></li>
                <li><a href="team_deduction.php">Team Deduction History
                <img src="images/deduct.png" style="width:20px;"></a></li>
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
          <li><a href="Ticket_Process_Tracking.php">Process/No Process
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
          <li><a href="utiliz_Absence.php?Absence">Absenteeism
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
          <li><a href="TicketProcessTracking.php">Process/No Process
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
                </ul>
            </li>     

          <li><a href="Absence_perUser.php">Absenteeism per user
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>       
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
                <li><a href="TicketProcessTracking.php">Process/No Process
                <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li>
              </ul>
            </li>     
          <li><a href="Absence_perUser.php">Absenteeism per user
          <img src="images/free-pie-chart-icon.png" style="width:25px;"></a></li> 
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
        <img src="images/up-and-down.png" style="width:40px;"></a></li>
         <li><a href="Process_Page.php">Process Page
        <img src="images/processing.png" style="width:40px;">
      </a></li>
      <li><a href="Tool_Videos.php">Web tutorial
        <img src="images/Tool_Videos-icon.png" style="width:40px;">
      </a></li>

            </ul>
      </li>
       <?php 

$engineer_id = $_SESSION['id'];
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id  = 482 ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  //$output_engineers = $check_engineers->fetch_array()){
  $engineers_id = $output_engineers['id'];}
  
  $check_chat = sqlsrv_query( $con ,"WITH x AS (
SELECT 
      max([when_time])  when_time_chat
   
  FROM [Aya_Web_APP].[dbo].[chat_box]
  WHERE send_to = '$engineer_id' ),

  xs AS (


  SELECT
      max([when_time])  when_time_user
   
  FROM [Aya_Web_APP].[dbo].[chat_box]
  WHERE send_to = '482' AND dbo.chat_box.send_from = '$engineer_id')

  SELECT
 
  iif(when_time_user < when_time_chat ,'yes','no') [order]
  from x, xs");
  $output_query = sqlsrv_fetch_array($check_chat);
  $chating = $output_query['order'];
  if ($chating == 'yes'){
?>
<li>
 <a class="nav-link scrollto" title="Chating" 
          href="chating.php?engineer_id=482">
<span class="badge badge-light"></span><img src="images/giphy.gif" style="width:40px;">
 
</a>

</li>
<?php  } ?>
  
        <li title="Unit:<?php echo $output["Unit_Name"];?>">
          <a href="#" style="font-size:10px;">
          <span  class="glyphicon glyphicon-user"></span>
          Login<samp>:</samp>
          <?php echo $_SESSION["username"];?></a>
            </li>
          <li><a href="?logout"><span style="font-size:10px;">
            <i class="fa fa-sign-out"></i>
          </span>log out</a></li>

        </ul>
      </li>
        <i class="bi bi-list mobile-nav-toggle"></i>

        </li></ul> 
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
</div>

<body>
      <button onclick="topFunction()" id="UpBtn" title="Go Up">Go up</button>
  <header class="page__header">
    <nav class="navbar__menu">

      <ul id="navbar__list">
      	
      </ul>

    </nav>
  </header>
  <main>
    <header class="main__hero">
      <h1 style="font-family: 'Merriweather', serif;
    color: #fff;">Web tutorial</h1>
      
    </header>

    <section id="section1" data-nav="Attendance" class="your-active-class" >
      <div class="landing__container">
        <h2 style="font-family: 'Merriweather', serif;
    color: #fff;">Sign Machine</h2>
<div style="height:350px;" align="center">
    <video  controls style="width:600px;">
  <source src="../Tool Videos/Sign Machine.mp4" type="video/mp4">
  <source src="movie.ogg" type="video/ogg">
  Your browser does not support the video tag.
</video>
</div>
</div>
    </section>

    <section id="section2" data-nav="Create Leave"  >
      <div class="landing__container">
        <h2>Create Leaves</h2>
        <p>
          Here you can chosse for the list ( Annual leave - Permission - Offical mission.......etc) and then apply and wait for you manager approval
        </p>
<div style="height:350px;" align="center">
    <video  controls style="width:600px;">
  <source src="../Tool Videos/Create Leave.mp4" type="video/mp4">
  <source src="movie.ogg" type="video/ogg">
  Your browser does not support the video tag.
</video>
</div>
      </div>

    </section>
    <section id="section3" data-nav="Create Task">
      <div class="landing__container">
        <h2>Create Task</h2>
        <p>
        
      Here you can chosse for the list the tasks that you had worked on it to appy it for the task time after manager approval</p>
<div style="height:350px;" align="center">
    <video  controls style="width:600px;">
  <source src="../Tool Videos/Create Task.mp4" type="video/mp4">
  <source src="movie.ogg" type="video/ogg">
  Your browser does not support the video tag.
</video>
</div>
      </div>
    </section>
<section id="section4" data-nav="Create Deducation">
      <div class="landing__container">
        <h2>Create Deducation</h2>
        <p>This is a tool to remove any deduction that added to your profile after sumiting the refrance leave and manager approval</p>
<div style="height:350px;" align="center">
    <video  controls style="width:600px;">
  <source src="../Tool Videos/Create Deducation.mp4" type="video/mp4">
  <source src="movie.ogg" type="video/ogg">
  Your browser does not support the video tag.
</video>
</div>
      </div>
    </section>

    <section id="section5" data-nav="Create Swap">
      <div class="landing__container">
        <h2>Create Swap</h2>
        <p>
          This is a tool to swap your schedule with you colleages to match you needs
        </p>
     <div style="height:350px;" align="center">
    <video  controls style="width:600px;">
  <source src="../Tool Videos/Create Swap.mp4" type="video/mp4">
  <source src="movie.ogg" type="video/ogg">
  Your browser does not support the video tag.
</video>
</div>
      </div>
    </section>


    <section id="section6" data-nav="View History">
      <div class="landing__container">
        <h2>View History (Attedance)</h2>
<div style="height:350px;" align="center">
    <video  controls style="width:600px;">
  <source src="../Tool Videos/View History ( Attedance ).mp4" type="video/mp4">
  <source src="movie.ogg" type="video/ogg">
  Your browser does not support the video tag.
</video>
</div>
      </div>
    </section>


    <section id="section7" data-nav="View Schedual">
      <div class="landing__container">
        <h2>View Schedual</h2>
   <div style="height:350px;" align="center">
    <video  controls style="width:600px;">
  <source src="../Tool Videos/View Schedual.mp4" type="video/mp4">
  <source src="movie.ogg" type="video/ogg">
  Your browser does not support the video tag.
</video>
</div>
      </div>
    </section>


    <section id="section8" data-nav="Tasks History">
      <div class="landing__container">
        <h2>Tasks History</h2>
<div style="height:350px;" align="center">
    <video  controls style="width:600px;">
  <source src="../Tool Videos/Tasks History.mp4" type="video/mp4">
  <source src="movie.ogg" type="video/ogg">
  Your browser does not support the video tag.
</video>
</div>
      </div>
    </section>
  </main>
 
    <script src="jsland/app.js"></script>
    <script type="text/javascript">
    	
    </script>
<?php
 include ("footer.html");
 ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script type="text/javascript">
//paste this code under the head tag or in a separate js file.
    // Wait for window load
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
</script>
</body>
</html>

