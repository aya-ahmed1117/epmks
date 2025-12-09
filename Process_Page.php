
<!DOCTYPE html>
<html>
<head>
  <title>Prossess</title>
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

<app-language-selector _ngcontent-kpq-c507="" _nghost-kpq-c120=""><select _ngcontent-kpq-c120="" name="language" class="select ng-pristine ng-valid ng-touched"><option _ngcontent-kpq-c120="" value="en">EN</option><option _ngcontent-kpq-c120="" value="ar">AR</option></select></app-language-selector>
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

.navbar__menu .menu__link {
    display: block;
    padding: 7px;
    
    text-decoration: none;
    color: black;
    
    border-right:1.5px solid #32a1ce;

    /*border-bottom:1px solid #32a1ce;
    border-left:1px solid red;
    font-weight: bold;*/

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
  
 

<body >

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
    color: #fff;">Process</h1>
      About E-WFM Department 
     <p> E-WFM statement of direction:
Enterprise workforce management unit is a planning & performance based supporting function, our statement of direction is to provide high cost efficiency models to deliver high level of customer experience for enterprise WE customers. </p>

    </header>

    <section id="section1" data-nav="E-WFM Goals" class="your-active-class" >
      <div class="landing__container">
        <h2 style="font-family: 'Merriweather', serif;
    color: #fff;">E-WFM Goals:</h2>
    </div>
    <div style="padding: 10px;margin-top:-20px;">
   <p >
To maintain statement of direction we have to work on below strategic Goals:

<li> Maximize resources utilization</li>
<li> Maximize service level and service efficiency to meet customer expectations and agreed SLA’s</li>
<li> Create and consolidate solid capacity and resources plans, backup plans & what if scenarios on both long & short term</li>
<li> Create and maintain high level of Decision Support reports and deliver high level of DS reports scalability, availability & accessibility </li> 
<li> Maximize cost efficiency and minimize wasting margins through maintain solid hiring plans, attrition analysis </li>
<li> Maintain strong queuing system that can match customer expectations and SLA’s</li>
<li> Create and maintain strong KPIs systems that reflect our division goals and regular performance review</li>

</p>
</div>
    </section>
    <section id="section2" data-nav="E-WFM Objectives"  >
      <div class="landing__container">
        <h2>E-WFM Objectives:</h2>
      </div>
<div style="padding: 10px; margin-top: -25px;" lang="en">
   <p >
    <ol>
<li> Create and maintain Employee data base including all types of information related to the employee and his employment history, line managers, skills, trainings</li>
<li> Create and maintain solid attendance system </li>
<li> Create and maintain hiring plans and attrition analysis </li>
<li> Create capacity plans and  resources schedules [ manning, seats, PCs,…]</li>
<li> Create and maintain real time monitoring system to maintain plans adherence .</li>
<li> Create and maintain all types of information communication channels [ top down & vice versa ]  </li>
<li> Create and maintain transitions data base that can support strong reporting system for all levels & dimensions [ customer, customer segment , geographical segment,  problem type , employee , group ,..]</li>
<li> Design a KPIs for support division that reflect division goals and objectives</li>  
<li> Maintain monthly, quarterly performance review to revise the performance improvement and action items </li>
</ol>
</p>
</div>
    </section>
    <section id="section3" data-nav="Absenteeism">
      <div class="landing__container">
        <h2>How do we calculate absenteeism:</h2>
      </div>
        <div style="padding: 10px; margin-top: -35px;" lang="en">
   <p>
    Preparing the necessary data which is:
    <ol type="A">
<li>Schedule time: Total shift hours of the Engineer.
<li>Leaves: Which is unplanned leaves such as (Sick leaves – Permissions – Casual leaves).
<li>Deductions: Total deducted hours such as (Latency – Early leave – No Show) PS: We always exclude the (Forget to login/out).
<li>Then we deduct the Deductions + Leaves from the schedule time to get the Absenteeism percentage. PS: Absenteeism is done on Weekly, Quarter, Mid-year .</li>
</ol>
<li>
Absenteeism</li>
It is Absence Hours compared to scheduled hours.
Capacity plan should increase to cover the absenteeism ratio.
<li>Absence Hours:</li>
<span class="ti-arrow-right"></span> No show + Excuse + Latency + Sick + Casual.
 <li>Scheduled Hours:</li>
<span class="ti-arrow-right"></span> Your schedule before any vacation or absence or activity.


   
  </p>
      </div>
    </section>


<section id="section4" data-nav="Utilization"style="min-height: 10vh;">
      <div class="landing__container">
        <h2>Utilization</h2>
      </div>
<div style="padding: 10px; margin-top: -35px;" lang="">
   <p>
    <li>Utilization is commonly used to show how effectively engineers are being utilized and how much of their time is truly available to handle all of required tickets and phone calls.
Which calculated as (work duration / Paid time)</li>
</p>
<p>
  <li>The measurements:</li>
  <ol>
<li>The utilization considers all the tickets handled by Engineer on PSC or PSD + Avaya logins to cover the calls too.</li>
<li>The handling time should be at the same time of engineer's schedule frame.</li>
<li>Engineer supposed to change the status of ticket to in progress once he starts the work and change it to any other status once he finished it or transferred to another parties to make sure it will be counted for him.</li>
</ol>
</p>
      </div>
    </section>

 <section id="section14" data-nav="Wrong NID"style="min-height: 10vh;">
      <div class="landing__container">
        <h2>Wrong NID Review Tips</h2>
        </div>
<div style="padding: 10px; margin-top: -35px;" lang="">
        <p>
<iframe src="https://drive.google.com/file/d/1_o7W7fGF0RVJ23GU1SbQ4AWGayqDdhGF/preview"  
        width="100%" height="600px"></iframe>


</div>
    </section>
    <section id="section5" data-nav="Tickets"style="min-height: 10vh;">
      <div class="landing__container">
        <h2>Tickets</h2>
        </div>
<div style="padding: 10px; margin-top: -35px;" lang="">
        <p>
          <ol>
<li>No Process <span class="ti-arrow-right"></span> Mean that he didn't use process in all tickets or some.</li>
<li>No Ticket <span class="ti-arrow-right"></span> Mean that he hasn't input in any ticket or didn't change the status of the Ticket.</li>
<li>Normal <span class="ti-arrow-right"></span>Mean that he Use the Process normally.</li>
</ol>
And be noted that we will run a daily report concerning utilization less than 30% with the whole process to avoid any mistakes or abusing regarding utilization.
</p>

      </div>
    </section>


    <section id="section6" data-nav="Important Notes"style="min-height: 10vh;">
      <div class="landing__container">
        <h2>Important Notes</h2>     
      </div>
      <div style="padding: 10px; margin-top: -35px;" lang="">
        <p>
<li> Official missions will affect badly on your utilization as official mission is used for any meeting or customer visit without accessing our system or tools
So If he create it, engineer will not have paid time, thus will not have utilization.</li>
<li> Make sure that every engineer create his leaves and annual before the run of attendance to avoid any deductions will affect on his utilization too.</li>
<li> The number of tickets handled in every day and also the handling time should be reasonable and logic to get the right percentage of your utilization 
Ex: some engineers are handling only one ticket for the whole shift.</li>
        </p>
      </div>
    </section>


    <section id="section7" data-nav="Attendance" style="min-height: 10vh;">
      <div class="landing__container">
        <h2>Attendance:</h2>
</div>
<div style="padding: 10px; margin-top: -35px;" lang="">
        <p>
<li>Attendance deductions affect your salary.</li>
<li>You can only take 4 hours as permission per month after your direct manager approval.</li>
<li>You are eligible to take annual after completing 3 months and after your direct manager approval.</li>
<li>Total annual per year is 21 days.</li>
<li>Sick vacation are fully paid till 10 days, after that you are only paid 75% of your monthly salary.</li>
        </p>
      </div>
    </section>


    <section id="section8" data-nav="a.Important Notes" style="min-height:8vh;">
      <div class="landing__container">
        <h2>a.Important Notes</h2>
</div>
<div style="padding: 10px; margin-top: -35px;" lang="">
        <p>
<li> Check your schedule.</li>
<li> Sign in / out on tool & PSC.</li>
<li> update any leaves, tasks on tool day by day.</li>
<li> Check your deductions .</li>
<li> Complain about any deduction with a valid reason within the SLA of complaining which is 7 days and after that it returns to be in deduction history .</li>
        </p>
      </div>
    </section>


    <section id="section9" data-nav="Double Payment" style="min-height: 10vh;">
      <div class="landing__container">
        <h2>Double Payment</h2>
</div>
<div style="padding: 10px; margin-top: -35px;" lang="">
        <p>
<li>We send the names of employees that attended on any day was official vacation with double payment as per HR mails.</li>

        </p>
      </div>
    </section>



    <section id="section10" data-nav="VIP Notes" style="min-height: 10vh;">
      <div class="landing__container">
        <h2>VIP Notes</h2>
</div>
<div style="padding: 10px; margin-top: -35px;" lang="">
        <p>
Make sure to sign IN and OUT at the same time on PSC and Workforce tool.
Make sure that your schedule is updated and if you swap with another team member be sure that your manager approved it and re-update both of your schedules.
Make sure that all your leaves like( annual , permission and so on) are created on the tool before or within the leave day. 
Complain SLA 7 days.

        </p>
      </div>
    </section>



    <section id="section11" data-nav="Sizing" style="min-height:8vh;">
      <div class="landing__container">
        <h2>Sizing</h2>
</div>
<div style="padding: 10px; margin-top: -35px;" lang="">
        <p>
 <li>Sizing is to forecast how many engineers is needed for certain account or group.
It needs two major inputs:</li>
<span class="ti-control-stop"></span>Number of tickets for historical period and it is extracted by tracking symbol.<br>
<span class="ti-control-stop"></span>AHT per ticket to know the time spent by engineer on each category and this is based on following in progress .

        </p>
      </div>
    </section>

 <section id="section12" data-nav="On Call" style="min-height:8vh;">
      <div class="landing__container">
        <h2>On Call</h2>
</div>
<div style="padding: 10px; margin-top: -35px;" lang="">
        <p>
 <li>On call report extract from the system in 1st of every month:</li>
<span class="ti-arrow-right"></span>Employee has to add his / her on call dates before the end of the month.<br>
<span class="ti-arrow-right"></span>Sheet extract from the system and then transfer to another department to get approvals and added to the next payroll

        </p>
      </div>
    </section>



<section id="section13" data-nav="Kpi`s" style="min-height:8vh;">
      <div class="landing__container">
        <h2>Kpi`s</h2>
</div>
<div style="padding: 10px; margin-top: -35px;" lang="">
        <p>
  <li>MTT1_Inprogress :</li>
Duration between Creation time and 1st in progress added.

  <li>MTTI2_CATEGORY:</li> 
Duration between 1st in progress added and 1st category added.

  <li>MTTV:</li>
Duration from Last Resolved to last Closed ( last resolved not  captured if the previous status is closed.

  <li>AHT:</li> 
total Duration of ( In progress time ) in ticket 

  <li>MTTR:</li> 
Duration between creation time and ( last resolved  in case that this ticket is linked by PSD ) or  Last closed (All Tickets) ( 24 hour ).

  <li>MTTR_SD:</li> 
Duration between creation time and Last closed ( only ticket that served on PSC only ). ( 6 hour).

  <li>CORRECT NODE TICKETS:</li> 
node found on ECRM or add on PSC by Symbol considered by unit manager (SD) and WFM.

  <li>NOT ASSIGNED TICKETS:</li> 
Tickets that not assigned to any Eng.

        </p>
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
    // Wait for window loa d
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
</script>
</body>
</html>

