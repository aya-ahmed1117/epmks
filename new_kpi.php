
 <?php
  include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
 $unit = $_SESSION['Unit_Name'];


?>
<head>
  <title>New Kpi`s per M/W/Day</title>

</head> 
   <?php
   /*

    $check_all = sqlsrv_query( $con ,"SELECT 
                b.[username]
            FROM [Aya_Web_APP].[dbo].[employee] b
            left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
            where unit not in (12,17) and b.username = '$s_username'  ");
          $out_all = sqlsrv_fetch_array($check_all );
          $all_username = $out_all['username'];
         
            if($all_username){ 
              */
    if( ($_SESSION['Unit_Name'] <> 'Enterprise Service Desk') &&
     ($_SESSION['Unit_Name'] <> 'Workforce Management') ){
  
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
      <span class="error-code-bg text-bold" style="text-transform: uppercase;"><br> <i class="fa fa-exclamation-triangle"></i> Sorry You are not allowed to open this page.</span>
        </div>
    </div>

';
 }
    else{
      if( ($_SESSION['Unit_Name'] == 'Enterprise Service Desk') || ($_SESSION['Unit_Name'] == 'Workforce Management') ){
?>

<script type="text/javascript">
  (function() {
  document.getElementById("message").style.display = "none";
});
</script>
<div >
<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Reports Per Month / Week / Day</h2>
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
       color:white;">Here you can find all the data requerd for all new KPI's ( daily / Weekly / Monthly </p>
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
                            <strong class="card-title">New Kpi`s</strong>
                        </div>
                        <a href="?GoDay" class="divlink">
                        <div class="card-body">
                          <p class="card-text">Daily</p>
                        </div>
                        </a>
                    </div>
                    
                </div>

              <div class="col-md-4">
                  <div class="card">
                      <div class="card-header">
                          <strong class="card-title">New Kpi`s</strong>
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
                          <strong class="card-title">New Kpi`s</strong>
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
  if (isset($_GET['GoDay']) || isset($_GET['GoDay'])) {
  ?>

  <?php if($_SESSION['role_id'] > 0){
  echo'<div class="content">
            <div class="animated fadeIn">
                <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="kpi_PerUser.php?GoDay">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/human_male.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">Daily Per Username</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="kpi_perGroup.php?GoDay">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/icon_human_resources.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Daily Per Group</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>


 <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="kpi_perSubGroup.php?GoDay">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/subgroup.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Daily Per  Sub groups</h2>
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
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="Rawdata_per_D_W_M.php?GoDay">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/rawdata.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Raw data</h2>
          </a>
        </div>
      </div>
    </aside>
  </div>

        </div>
    </div>
</div>';}

 if($_SESSION['role_id'] == 0){
  echo'
  <div class="content">
      <div class="animated fadeIn">
          <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="kpi_PerUser.php?GoDay">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/human_male.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">Daily Per Username</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="kpi_perGroup.php?GoDay">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/icon_human_resources.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Daily Per  Group</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>


 <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="kpi_perSubGroup.php?GoDay">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/subgroup.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Daily Per  Sub groups</h2>
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
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="Rawdata_per_D_W_M.php?GoDay">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" 
          src="images/rawdata.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Raw data</h2>
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
</div>
</div>
</div>

  <?php 
  if (isset($_GET['GoWeek']) || isset($_GET['GoWeek'])) {
  ?>
  <?php if($_SESSION['role_id'] > 0){
  echo'
   <div class="content">
            <div class="animated fadeIn">
                <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="kpi_PerUser.php?GoWeek">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/human_male.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">Weekly Per Username</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="kpi_perGroup.php?GoWeek">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/icon_human_resources.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Weekly Per Group</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>


 <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="kpi_perSubGroup.php?GoWeek">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/subgroup.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Weekly Per Sub groups</h2>
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
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="Rawdata_per_D_W_M.php?GoWeek">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/rawdata.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Raw data</h2>
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
  echo'<div class="content">
            <div class="animated fadeIn">
                <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="kpi_PerUser.php?GoWeek">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/human_male.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">Weekly Per Username</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="kpi_perGroup.php?GoWeek">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/icon_human_resources.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Weekly Per Group</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>


 <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="kpi_perSubGroup.php?GoWeek">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/subgroup.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Weekly Per Sub groups</h2>
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
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="Rawdata_per_D_W_M.php?GoWeek">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/rawdata.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Raw data</h2>
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
  if ( isset($_GET['GoMonth']) || isset($_GET['GoMonth']) ) {
  ?>
<?php if($_SESSION['role_id'] > 0){
  echo'<div class="content">
            <div class="animated fadeIn">
                <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="kpi_PerUser.php?GoMonth">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/human_male.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">Monthly Per Username</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="kpi_perGroup.php?GoMonth">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/icon_human_resources.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Monthly Per Group</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>


 <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="kpi_perSubGroup.php?GoMonth">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/subgroup.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Monthly Per Sub groups</h2>
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
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="Rawdata_per_D_W_M.php?GoMonth">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/rawdata.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Raw data</h2>
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
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="kpi_PerUser.php?GoMonth">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/human_male.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">Monthly Per Username</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="kpi_perGroup.php?GoMonth">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/icon_human_resources.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Monthly Per Group</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>


 <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="kpi_perSubGroup.php?GoMonth">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/subgroup.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Monthly Per Sub groups</h2>
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
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="Rawdata_per_D_W_M.php?GoMonth">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/rawdata.png"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Raw data</h2>
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

 include ("footer.html");
}}
 ?>
<?php
  if( ($_SESSION['Unit_Name'] <> 'Enterprise Service Desk') && ($_SESSION['Unit_Name'] <> 'Workforce Management') ){
include ("footer.html");
  }
?>