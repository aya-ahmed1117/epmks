
 <?php
  include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $unit = $_SESSION['Unit_Name'];
?>
<head>
  <title>Tracking PSC & PSD</title>

</head> 
   <?php


    $check_all = sqlsrv_query( $con ,"SELECT 
                b.[username]
            FROM [Aya_Web_APP].[dbo].[employee] b
            left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
            where unit <> 17 and b.username = '$s_username'  ");
          $out_all = sqlsrv_fetch_array($check_all );
          $all_username = $out_all['username'];
         
            if($all_username){
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
 $check_all = sqlsrv_query( $con ,"SELECT 
                b.[username]
            FROM [Aya_Web_APP].[dbo].[employee] b
            left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
            where unit = 17 and b.username = '$s_username'  ");
          $out_all = sqlsrv_fetch_array($check_all );
          $all_username = $out_all['username'];
         
            if($all_username){

 //if( $Unit_Name = $output['Unit_Name']){
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
              <h2 class="text-dark display-12" >PSC & PSD Tracking SYS</h2>
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
       color:white;">here you can manage data on server 77 and 76</p>
    </aside>
  </div>
</center>
  
</div>
<br>
<br>

 <div class="content">
            <div class="animated fadeIn">
              <div class="row" style="width:100%; padding: 20px;">
              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header">
                          <strong class="card-title">Tracking</strong>
                      </div>
                      <a href="?PSC"class="divlink">
                      <div class="card-body">
                          <p class="card-text">PSC</p>
                      </div>
                    </a>
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="card">
                      <div class="card-header">
                          <strong class="card-title">Tracking</strong>
                      </div>
                      <a href="?PSD"class="divlink">
                      <div class="card-body">
                          <p class="card-text">PSD</p>
                      </div>
                    </a>
                  </div>
              </div>

                  </div>
                </div>
              </div>

<?php 
if(isset($_GET['PSC'])){
    echo'<div class="content">
            <div class="animated fadeIn">
                <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="tracking_wfm2.php?pscNew">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;">Missing  <samp style="color: orange;"> psc New</samp> PSC</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<!--div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="tracking_wfm2.php?MissHistorypsc">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;">Missing  <samp style="color: orange;"> history</samp> PSC</h2>
          </a>

          </div>
      </div>
    </aside>
  </div-->

        </div>
    </div>
</div>

';}
    ?>

<?php
if(isset($_GET['PSD'])){
  echo'<div class="content">
            <div class="animated fadeIn">
                <div class="row" style="width:100%; padding: 20px;">

<div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg-" style="background-color:#55608f;">
      <a href="PSD_new.php?PsdNew">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3 " style="width:75px; height:75px; background-color: light;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height:2.5; font-size:20px;font-weight: bold;"><samp style="color: orange;"> </samp> PSD</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>

<!--div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg" style="background-color:#55608f;">
      <a href="tracking_wfm2.php?PSDsummary">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;"><samp style="color: orange;"> Summary</samp> PSD</h2>
          </a>

          </div>
      </div>
    </aside>
  </div>


 <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="tracking_wfm2.php?PSDMissing">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;"><samp style="color: orange;">Missing summary</samp> PSD</h2>
          </a>
        </div>
      </div>
    </aside>
  </div>

<br><br>
<br>
<br>
<br>
<br>

   <div class="col-md-4">
  <aside class="profile-nav alt" style="border: 2px solid orange; border-radius:4px;"> 
     <div class="card-header user-header alt bg"style="background-color:#55608f;">
      <a href="tracking_wfm2.php?MissHistory">
        <div class="media">
          <img class="align-self-center rounded-circle mr-3" style="width:75px; height:75px;" src="images/utilization-icon.jpg"/>
            <h2 class="text-light" style="text-align:center;float: right;line-height: 2.5; font-size:20px;font-weight: bold;"><samp style="color: orange;">Missing</samp> <samp style="color: orange;"> History</samp> PSD</h2>
          </a>
        </div>
      </div>
    </aside>
  </div-->

        </div>
    </div>
</div>

';
}

?>

   

</div>
</div>
</div>
<?php }
?>

  <?php

 include ("footer.html");

?>