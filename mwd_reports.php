
 <?php
  include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $unit = $_SESSION['Unit_Name'];
?>
<head>
  <title>Reports per Mo/W/Day</title>

</head> 
   <?php
    /*if( ($_SESSION['Unit_Name'] <> 'Enterprise Service Desk') || ($_SESSION['Unit_Name'] <> 'Workforce Management') ||($_SESSION['Unit_Name'] <>'Quality Management and Training')){*/
  $unit = $_SESSION['Unit_Name'];
$checkmes = sqlsrv_query( $con ,"SELECT [Unit_Name]
  FROM [Aya_Web_APP].[dbo].[employee]
  where Unit_Name  in 
  ( 'Enterprise Service Desk','Workforce Management','Quality Management and Training' ) and id = '$self' ");
$output = sqlsrv_fetch_array($checkmes );
   $Unit_Names = $output['Unit_Name'];

 if ($unit !== $Unit_Names ){
    echo'
<style>
.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
</style>

<div id="message" class="overlay">
    <div class="popup">
        <u><h2>Hi : '.$s_username.'</h2></u>
      <span class="error-code-bg text-bold" style="text-transform: uppercase;"><br> <i class="fa fa-exclamation-triangle"></i> Sorry You are not allowed to open this page. ('.$unit.')</span>
        </div>
    </div>';

?>

<script type="text/javascript">
  (function() {
  document.getElementById("message").style.display = "none";
});
</script>
<?php 
 }
  $unit = $_SESSION['Unit_Name'];
$checkme = sqlsrv_query( $con ,"SELECT [Unit_Name]
  FROM [Aya_Web_APP].[dbo].[employee]
  where Unit_Name in 
  ( 'Enterprise Service Desk','Workforce Management','Quality Management and Training' ) and id = '$self' ");
$output = sqlsrv_fetch_array($checkme );
   $Unit_Name = $output['Unit_Name'];


 if( $Unit_Name = $output['Unit_Name']){
      ?>
<div >
<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Old Kpi`s Reports</h2>
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
       color:white;">Here you can find all the data requerd for all old KPI's ( daily / Weekly / Monthly )</p>
    </aside>
  </div>
</center>
  
</div>
<br>
<br>

 <div class="content">
            <div class="animated fadeIn">
              <div class="row" style="width:100%; padding: 20px;">

                <div class="col-md-4">
                  
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Old Kpi`s</strong>
                        </div>
                        <a href="?GoDay" class="divlink">
                        <div class="card-body">
                          <p class="card-text">Yesterday</p>
                        </div>
                        </a>
                    </div>
                    
                </div>

              <div class="col-md-4">
                  <div class="card">
                      <div class="card-header">
                          <strong class="card-title">Old Kpi`s</strong>
                      </div>
                      <a href="?GoWeek"class="divlink">
                      <div class="card-body">
                          <p class="card-text">Per Week.</p>
                      </div>
                    </a>
                  </div>
              </div>

              <div class="col-md-4">
                  <div class="card">
                      <div class="card-header">
                          <strong class="card-title">Old Kpi`s</strong>
                      </div>
                      <a href="?GoMonth"class="divlink">
                      <div class="card-body">
                          <p class="card-text">Per Month </p>
                      </div>
                    </a>
                  </div>
              </div>

                  </div>
                </div>
              </div>


<?php
//kpi`s reports
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
  ?>

<style type="text/css">
  
</style>

  <?php 
  if ( isset($_GET['GoMonth']) || isset($_GET['GoMonth']) ) {
  ?>
<?php if($_SESSION['role_id'] > 0){
  echo'
  <div class="content">
  <div class="animated fadeIn">
      <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4" >
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;" > 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;" >
      <!---a href="" readonly="true" disabled="true"-->
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">MTD <samp style="color: orange;"> Monthly</samp></h2>
          <!--/a-->

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="mttrrawdata.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">MTTR RawData<samp style="color: orange;"> Monthly</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>


 <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="Repeated_NodeID_month.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Repeated NodeID <samp style="color: orange;"> Monthly</samp></h2>
          </a>
        </div>
      </div>
    </aside>
  </div>

        </div>
    </div>
</div>



<div class="content">
    <div class="animated fadeIn">
        <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="Summary_Per_month.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">Summary <samp style="color: orange;"> Monthly</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4" >
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="aht_per_month.php" >
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
             <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">AHT<samp style="color: orange;"> Monthly</samp></h2>
          </a>
          </div>
      </div>
    </aside>
  </div>


    <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="EmployeeViolation_pm.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">Employee Violation<samp style="color: orange;"> Monthly</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

</div>
</div>
</div>
 
 <div class="content">
    <div class="animated fadeIn">
        <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="AUT_pm.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">Absence/utiliz/Tasks <samp style="color: orange;"> Monthly</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="monthly_ticket_aht.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
             <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">AHT ticket<samp style="color: orange;"> Monthly</samp></h2>
          </a>
          </div>
      </div>
    </aside>
  </div>


    <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="wrong_nodeId.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">wrong node Id<samp style="color: orange;"> Monthly</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

</div>
</div>
</div>
  ';}
 //pointer-events: none;

if($_SESSION['role_id'] == 0){
   echo' 
<div class="content">
    <div class="animated fadeIn">
        <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4" >
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-dark" style="">
      <a href="aht_per_month.php" >
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">AHT <samp style="color: orange;"> Monthly</samp></h2>
          </a>
        </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-dark">
      <a href="EmployeeViolation_pm.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;
">Employee Violation <samp style="color: orange;"> Monthly</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>


 <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-dark">
      <a href="AUT_pm.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Absence/utiliz/Tasks <samp style="color: orange;"> Monthly</samp></h2>
          </a>
        </div>
      </div>
    </aside>
  </div>

        </div>
    </div>
</div>


<div class="content">
  <div class="animated fadeIn">
      <div class="row" style="width:100%; padding: 20px;">

  <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-dark">
      <a href="monthly_ticket_aht.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Ticket Aht <samp style="color: orange;"> Monthly</samp></h2>
          </a>
        </div>
      </div>
    </aside>
  </div>


  <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-dark">
      <a href="wrong_nodeId.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Wrong NodeId<samp style="color: orange;"> Monthly</samp></h2>
          </a>
        </div>
      </div>
    </aside>
  </div>


    </div>
    </div>
    </div>

';}
 ?>
  <?php 
}
  ?>
 
  <?php 
  if (isset($_GET['GoWeek']) || isset($_GET['GoWeek'])) {
  ?>
  <?php if($_SESSION['role_id'] > 0){
  echo'<div class="content">
  <div class="animated fadeIn">
      <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="ahtperweek.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">AHT <samp style="color: orange;"> Weekly</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="MTTRRD_week.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">MTTR RawData<samp style="color: orange;"> Weekly</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>


 <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="Repeated_NodeID_week.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Repeated NodeID <samp style="color: orange;"> Weekly</samp></h2>
          </a>
        </div>
      </div>
    </aside>
  </div>

        </div>
    </div>
</div>



<div class="content">
    <div class="animated fadeIn">
        <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="EmployeeViolation_week.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">Employee Violation <samp style="color: orange;"> Weekly</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="AUT_weeek.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
             <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">Absence/utiliz/Tasks <samp style="color: orange;"> Weekly</samp></h2>
          </a>
          </div>
      </div>
    </aside>
  </div>


    <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="weekly_ticket_aht.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">AHT Tickets<samp style="color: orange;"> Weekly</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

</div>
</div>
</div>';
}?>

<?php if($_SESSION['role_id'] == 0){
  echo'
  <div class="content">
            <div class="animated fadeIn">
                <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-dark" style="">
      <a href="ahtperweek.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;
">AHT <samp style="color: orange;"> Weekly</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-dark">
      <a href="EmployeeViolation_week.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;
">Employee Violation <samp style="color: orange;"> Weekly</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>


 <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-dark">
      <a href="AUT_weeek.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Absence/utiliz/Tasks <samp style="color: orange;"> Weekly</samp></h2>
          </a>
        </div>
      </div>
    </aside>
  </div>

        </div>
    </div>
</div>';
}?>

  <?php 
}
  ?>
  <?php 
  if (isset($_GET['GoDay']) || isset($_GET['GoDay'])) {
  ?>

  <?php if($_SESSION['role_id'] > 0){
  echo'<div class="content">
            <div class="animated fadeIn">
                <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="aht_yesterday.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">AHT <samp style="color: orange;"> Yesterday</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="EmployeeViolation_yesterday.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Employee Violation <samp style="color: orange;"> Yesterday</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>


 <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="AUT_yesterday.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Absence/utiliz/Tasks <samp style="color: orange;"> Yesterday</samp></h2>
          </a>
        </div>
      </div>
    </aside>
  </div>

        </div>
    </div>
</div>



<div class="content">
            <div class="animated fadeIn">
                <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="MTTrRawData_Yesterday.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">MTTrRawData <samp style="color: orange;"> Yesterday</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="Repeated_NodeID_yesterday.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Repeated NodeID<samp style="color: orange;"> Yesterday</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>


 <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="yesterday_ticket_aht.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Ticket Aht<samp style="color: orange;"> Yesterday</samp></h2>
          </a>
        </div>
      </div>
    </aside>
  </div>

        </div>
    </div>
</div>

';}

 if($_SESSION['role_id'] == 0){
  echo'
  <div class="content">
            <div class="animated fadeIn">
                <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-dark" style="">
      <a href="aht_yesterday.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">AHT <samp style="color: orange;"> Yesterday</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-dark">
      <a href="EmployeeViolation_yesterday.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Employee Violation <samp style="color: orange;"> Yesterday</samp></h2>
          </a>

          </div>
      </div>
    </aside>
  </div>


 <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-dark">
      <a href="AUT_yesterday.php">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Absence/utiliz/Tasks <samp style="color: orange;"> Yesterday</samp></h2>
          </a>
        </div>
      </div>
    </aside>
  </div>

        </div>
    </div>
</div>
';}


?>
  <?php 
}}
  ?>
</div>
</div>
</div>


  <?php

 include ("footer.html");

?>