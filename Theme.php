<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <link rel="icon" href="imag/logo.jpg">
  <meta charset="utf-8">
   <?php require_once("inc/config.inc");
  if($_SESSION['username'] == '' || $_SESSION['username'] == null ){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php");
     // session_unset(); 
    }?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Fira+Sans:900|Merriweather&display=swap" rel="stylesheet">
    <meta name="description" content="Learn how you can show or hide certain text or images for mobile devices.">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link href="/TEDataResources/images/te.ico" rel="shortcut icon" type="image/x-icon" />
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
 <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap2.min.js"></script>
<!--script src="js/snowflakes.js"></script-->
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/bootstrap2.min.css">
<link rel="stylesheet" href="css/bootstrap2.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style4.css">

  <style>
    /* Add a gray background color and some padding to the footer */
    /*footer {
      background-color: #f2f2f2;
      padding: 25px;
    }*/
/*
    .carousel-inner img {
      width: 100%; 
      min-height: 150%;
    }*/
    /* Hide the carousel text when the screen is less than 600 pixels wide */
    @media (max-width: 600px) {
      .carousel-caption {
        display: none; 
      }}
        .bg-light {
   /* background-color: hsl(296, 15%, 35%) !important;*/
    background: linear-gradient(to top left, #37205f 0%, #852990 100%);
 
    border-radius: 20px 20px 20px 20px;
  }
/*
   #snowflakeContainer {
    position: absolute;
    left: 0px;
    top: 0px;
    display: none;
  }

  .snowflake {
    position: fixed;
    #ccc 
    background-color: black;
    user-select: none;
    z-index: 1000;
    pointer-events: none;
    border-radius: 50%;
    width: 10px;
    height: 10px;
  }
*/
#myDIV {
  -webkit-animation: mymove 5s infinite;
  animation: mymove 2s infinite;
}
@-webkit-keyframes mymove {
  20% {text-shadow: 2px 5px 10px red;}
}
@keyframes mymove {
  70% {text-shadow: 2px 5px 10px red;}
}

html, body {
    height:auto;
}
</style> 
    <?php /*
    if($_SESSION['id'] == '311'){ 
    echo '<body>';}
    else{
      echo'';
    }
*/
   ?>
   <?php   
function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$ip = 'User Real IP - '.getUserIpAddr();
?>
   
<body>
   <!-- 
new year
  style="background-image: url(New_year/happy-new-year-2021-v.jpg); background-repeat: no-repeat;
   background-size: cover;"

    eid saeeeeeeed
   body style="background-image: url(eid/eidsaeed.gif); background-repeat: no-repeat;
   background-size: cover;height:100%; " -->

   
 <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <!--button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span->
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button-->

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
                    <!--button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span->
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                  <div id='img_div'><ul style=' margin-left:-48px; margin-top: -3%;'>";
     echo  "<img class='img-circle' style='margin-left:3px ;padding: 1px; padding-bottom: 1px; margin-right: 1px;width:8%; margin-bottom: -29px;' src='imag/logo.jpg' >
   -->
   <div class="col-sm-6" >
    <div id='img_div'>
      <?php 
      //background : rgba(0,0,0,.4);

if($_SESSION['username'] == 'belal.ezzat'){
      echo "<ul style=' margin-left:-48px; margin-top:3px;'>";
     echo  "<img class='img-circle' style='margin-left:-33px ;width:12%; margin-top: -25px;'  src='uploads/belal.ezzat1.jpg' >";
      "</ul>";}
      if($_SESSION['username'] == 'Ezzeldin.shehata'){
       echo "<ul style=' margin-left:-48px; margin-top:3px;'>";
     echo  "<img class='img-circle' style='margin-left:-33px ;width:12%; margin-top: -25px;' src='uploads/ezz.jpg' >";
      "</ul>";}
      if($_SESSION['username'] == 'amani.ahmed'){
  echo "<ul style=' margin-left:-48px; margin-top: -3%;'>";
  echo "<img class='img-circle' style='margin-left:-3px ;width:7%; margin-top: -12px;' src='imag/logo.jpg' >";
      }
      if($_SESSION['username'] == 'iman.makram'){
      echo "<ul style=' margin-left:-48px; margin-top: -3%;'>";
     echo "<img class='img-circle' style='margin-left:-3px ;width:7%; margin-top: -12px;' src='imag/logo.jpg' >";
      "</ul>";}
       if(($_SESSION['username'] == 'amr.mohamed')  || ($_SESSION['username'] =='aya.abdelfattah') || ($_SESSION['username'] =='Muhamed.sharshar')||($_SESSION['username'] =='dina.elleithy')

     || ($_SESSION['username'] =='noureldin.fawzy')||($_SESSION['username'] =='mohamed.bahaa') ){
     echo "<ul style=' margin-left:-48px; margin-top: -3%;'>";
     echo  "<img class='img-circle' style='margin-left:-3px ;width:7%; margin-top: -12px;' src='imag/logo.jpg' >";
      "</ul>";}?>
     
  <h2 style="padding-top:5%;margin-left:10%; margin-top:-15%;color: #eee;">WorkForce Managment Tool...</h2></div>
</div>
<!--div id="snowflakeContainer">
  <span class="snowflake"></span>
</div-->
                        <ul class="nav navbar-nav ml-auto">

                            <?php 

if (isset($_SESSION['id'])) { $aya = $_SESSION['id']; }
$checkme = sqlsrv_query( $con ,"SELECT * FROM [employee] WHERE [id] = '$aya'");
$output = sqlsrv_fetch_array($checkme );
$Unit_Name = $output['Unit_Name'];
$username_id = $output['username_id'];
///  style="color: #8B9DC3;">login As
      ?>
 <li ><a href="#" style="font-size: 9.5px;color: rgba(255,255,255,.8)!important;">
  <span class="glyphicon glyphicon-user" style="color: #8B9DC3;">login As </span><samp>:</samp>
       <samp style="color: #fff;"> <?php echo $_SESSION["username"];?></samp>
       <h6 style="color: #fff;font-size: 10px;text-align: justify;text-indent: 10px;letter-spacing: -.5px;line-height: 0.8;" >Unit<samp>:</samp><?php echo $output["Unit_Name"];?></h6></a></li>
                            <!--li class="nav-item active">
                                <a class="nav-link" href="#">Page</a>
                            </li!-->
                           
<li><a href="?logout" style="color:#666;  "><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>

                        </ul>

                    </div>
                </div>
                </nav>


<?php
/*
if($_SESSION['username'] == ''){
    echo '
      <audio controls autoplay>
  <source src="New_year/Kol SanaWentaTayeb.mp3" type="audio/ogg">
  <source src="New_year/Kol SanaWentaTayeb.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>';} 
*/
?>

<?php
//Mustafa.Sameh
  //if($_SESSION['username'] == 'aya.abdelfattah'){
  ?>
  <!--div-->
<?php
/*

 echo '
 <form method="post" style="box-shadow: 0 15px 25px rgb(0, 112, 119);width:45%;padding-bottom:10px; border-radius: 10px 10px 10px 10px;padding-top:13px;
     background-color: #001a66;opacity:.9;transform: translate(30px,-20px);" >';
  echo '<div class="content"> 
    <input style="display: none;" enable="false" class="nav-link disabled" tabindex="-1" type="text"name="username" value='.$_SESSION["username"].'</input>
<input type="submit" name="type" class="btn-success" value="in" style="padding: 6px ;
        font-size: 20px;
    font-weight: 400;
    line-height: 1.42857143;
    width: 30%;
transform: translate(50px,-15px);
    display: inline-block;
    border: 5px solid ;
font-style: normal; 
font-family: Century Gothic;
border: 1px solid transparent;
border-radius: 4px;"></input>

<input type="submit" name="type" class="btn-danger" value="out" style="padding: 6px ;
        font-size: 20px;
    font-weight: 400;
    line-height: 1.42857143;
    width: 30%;
   transform: translate(140px,-15px);
    display: inline-block;
    border: 5px solid ;
font-style: normal; 
font-family: Century Gothic;
border: 1px solid transparent;
border-radius: 4px;"></input>';
      
    echo  '<h3  style="display: none;" class="date" name="cur_date">  <?php
echo date("Y/m/d");?> </h3>';
  echo' <h3 style="display: none;" class="time" name="atime"> <?php
echo date("h:i:s"); ?>  </h3>';
 echo '</div>';

// if($_SESSION['username'] == 'aya.abdelfattah'){

if(isset($_POST['type'])) {
  $s_username = $_SESSION['username'];
   $engineer_id = $_SESSION['id'];
  if(isset($_POST['date'])){$date = $_POST['date'];}
  if(isset($_POST['type'])){$type = $_POST['type'];}
  if(isset($_POST['atime'])){$atime = $_POST['atime'];}

$ip = getUserIpAddr();
if(($_SESSION['username'] === '') || ($_SESSION['id'] === '')){
  echo '<h5 style="color:red; background-color:black; font-size:17px;">error</h5>';
}
else{
$insert_query = sqlsrv_query( $con ,"INSERT INTO in_and_out ([username], [engineer_id], [cur_date], [type], [atime] , [user_ip] )  VALUES ('$s_username', '$engineer_id' , CONVERT(date, GETDATE()) ,'$type', CONVERT(time, GETDATE()) , '$ip') ");
}}
   //if($_SESSION['username'] == 'aya.abdelfattah'){
  echo'
<div style="overflow:scroll; height:290px;overflow-x:hidden;">

 <table align="center" class="order-table table" style="color: gray; flex-wrap: wrap;position: relative;font-style: normal;
 border: 2px solid #eee; font-family: Century Gothic;">
    <thead style="background-color:gray;color: #eee;border: 2px solid #eee;">
           <th width="1%"style="border: 2px solid #eee;" > Username</th>
          <th width="1%"style="border: 2px solid ;">Type</th>
          <th width="1%"style="border: 2px solid ;" > Day</th>
          <th width="1%"style="border: 2px solid ;">Time </th>
        
</thead>
<tbody>';

   $engineer_id = $_SESSION['id'];
 $s_username = $_SESSION['username'];

$first_query = sqlsrv_query( $con ,"SELECT top 15 * FROM in_and_out WHERE  [engineer_id] = '$engineer_id'  order by 4 DESC ,5 desc ");
  while( $output_query = sqlsrv_fetch_array($first_query)){

$rows  ='<tr>';
$rows .='<td width="1%" style="display:none;background-color: #eee;">'.$output_query["engineer_id"].'</td>';
$rows .='<td width="1%" style="border: 1px solid ;font-size:12px;background-color: #eee;">'.$output_query["username"].'</td>';
$rows .='<td width="1%" style="border: 1px solid ;background-color: #eee;">'.$output_query["type"].'</td>';
$rows .='<td width="1%" style="border: 1px solid ;background-color: #eee;">'.$output_query["cur_date"]->format('Y-m-d').'</td>';
$rows .='<td width="1%" style="border: 1px solid ;background-color: #eee;">'.$output_query["atime"]->format('H:i:s').'</td>';

$rows .='</tr>';

echo $rows;
}
*/
?>
<!--/div>
</tbody>
</table>
</form>

</div>
</div-->
<?php //}
?>
<?php 

if( ($_SESSION['username'] == 'amr.mohamed' ) || ($_SESSION['username'] == 'aya.abdelfattah') ||
 ($_SESSION['username'] == 'belal.ezzat') || ($_SESSION['username'] == 'iman.makram') ||
  ($_SESSION['username'] == 'amani.ahmed') || ($_SESSION['username'] == 'Ezzeldin.shehata') ||
   ($_SESSION['username'] == 'Muhamed.sharshar') || ($_SESSION['username'] == 'dina.elleithy')  ){
  echo '<br>
<div class="container">
<div class="row">
  <div class="col-sm-5" style="margin-left:-7.5%;">
  
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
        <li data-target="#myCarousel" data-slide-to="4"></li>
      </ol>


      <div class="carousel-inner" role="listbox">


<div class="item active">
 <p style="color:#002060; font-weight:bold;font-size:25px;">KPI`s</p>
           <a href="mwd_reports.php" target="_blank">
           <img src="imag/reportsss.png" style="width: 48%;margin-left: 25%;"></a>
          <div class="carousel-caption">

          </div>      
        </div>


<div class="item ">
      <p style="font-weight:bold;font-size:25px;color:#002060;">tool indicator</p>
<a href="tool_indicator.php">
     <img src="imag/up-and-down-arrows.png" style="width: 40%;margin-left: 25%;" alt="Image"></a>
          <div class="carousel-caption">
          </div>      
        </div>

<div class="item ">
      <p style="font-weight:bold;font-size:25px;color:#002060;">Psc Reports</p>
<a href="psc_reports.php">
     <img src="imag/graph+infographic.png" style="width: 40%;margin-left: 25%;" alt="Image"></a>
          <div class="carousel-caption">
          </div>      
        </div>


      <div class="item ">
      <p style="font-weight:bold;font-size:25px;color:#002060;">Current Eng. today</p>
<a href="current_day2.php">
     <img src="imag/office-3295556__340.jpg" style="width: 40%;margin-left: 25%;" alt="Image"></a>
          <div class="carousel-caption">
          </div>      
        </div>



      <div class="item ">
         <p style="font-weight:bold;font-size:25px;color:#002060;">multiselect reports </p>
           <a href="multiselect_reports.php" target="_blank">
           <img src="imag/creatingreport.png" style="width: 48%;margin-left: 25%;"></a>
          <div class="carousel-caption">
           
          </div>      
        </div>



<div class="item">
<p style="font-weight:bold;font-size:25px;color:#002060;">Database</p>
<a href="testtable.php"><img src="imag/time-and-date.png"style="width:43.5%;margin-left: 25%;" alt="Image" >
 <div class="carousel-caption"></a>
          </div>      
        </div>


  </div>

      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

  <div class="col-sm-2" style="width:20%;margin-left:3%;">
    <div class="well" >
      <a a href="Employees.php"><img src="imag/Purple-Secure-Computing-Icon.png" style="width: 20%;float: right;margin-top:-5%;">  <p>Employee..</p></a>
    </div>
        

    <div class="well" >
      <a href="in&out_wfm.php" >
        <img src="imag/signed.png" style="width: 22%;float: right;margin-top: -6%;"> <p >Sign...</p></a>
    </div>

    <div class="well">
       <a href="alldeduction2.php">
        <img src="imag/deduct.png" style=" width: 22%;margin-top: -6px;
    border-radius: calc(.25rem - 1px); background-size: 280px 207px;float: right;"> <p>Deductions..</p></a>
    </div>

 <div class="well" >
   <a href="scheduleadmin.php"> 
<img src="imag/schedule-icon2.jpg" style="width:40px;margin-top: -10px;float: right;">
      <p >schedule ...</p></a>
       </div>

</div>
       <br>
     
  </div>

</div>
 <div class="col-sm-2" style="transform: translate(328%,-100%);">
  <div id="myDIV"  class="well" >
      <a href="welcomeadmin2.php"><img src="imag/data-pending.png" style="width: 20%;float: right;margin-top: -5%;">  <p>pending Requests..</p></a>
    </div>
    <div class="well" >
      <a  href="approve_request.php"><img src="imag/Open-folder-full.png" style="width: 20%;float: right;margin-top: -5%;"> 
       <p>  Ticketing system</p></a>
    </div>
    
     <div class="well" >
      <a a href="schedule_update.php"><img src="imag/update_w_b_tabs.png" style="width: 20%;float: right;margin-top: -5%;">  <p>schedule update..</p></a>
    </div>
    <div id="myDIV"  class="well" >
      <a a href="ticketing_updates.php"><img src="imag/closed-ticket-icon.png" style="width: 20%;float: right;margin-top: -5%;"> 
       <p>Update tickets</p></a>
    </div>

    
    </div>
 <div class="col-sm-2" style="transform: translate(348%,-100%);">

       <div class="well" >
      <a href="allsignView.php"><img src="imag/signinnn.png" style="width: 20%;float: right;margin-top: -5%;">
  <p>All sign..</p></a>
    </div>

     <div class="well" >
      <a a href="viewdeduction.php"><img src="imag/blog-absence.png" style="width: 20%;float: right;margin-top: -5%;">  <p>All deduction..</p></a>
    </div>


     <div class="well" >
      <a href="adminschedule.php">
      <img src="imag/scheduleicon.png" style="width: 20%;float: right;margin-top: -5%;">  
      <p>All schedule..</p></a>
    </div>

     <div class="well" >
      <a  href="allstatus2.php">
      <img src="imag/bellalarmpending.png" style="width: 20%;float: right;margin-top: -5%;"> 
       <p>History..</p></a>
    </div>
    

    </div>
    <br>
<div class="container text-center">    
  <div class="row">

    <div class="col-sm-3" style="margin-left:-45%;" >
      <a href="utilizationadmin2.php">
    <img src="imag/utilization4.png" class="img-responsive" style="width:50%;margin-left:-5%;" alt="Image"> </a>
      <p style="margin-left:-40%;" >Utilization</p>
    </div>

    <div class="col-sm-3" style="margin-left:-5%;" > 
<a href="registration_page.php">
      <img src="imag/imagessss.png" class="img-responsive" style="width:50%;margin-left: 5%;" alt="Image"></a>
      <p style="margin-left: -50%;">Register..</p> 
    </div>

<div class="col-sm-3"style="margin-left:-10%;"  >
      <a href="PMreports.php">
    <img src="imag/graph+infographic.png" class="img-responsive" style="width:50%;margin-left:12%;" alt="Image"> </a>
      <p style="margin-left: -35%;margin-right: 0;">Reports</p>
    </div>

    <div class="col-sm-3" style="margin-left:8%;">
      <a href="process.php">
    <img src="imag/downloadddd.png" class="img-responsive" style="width:50%;
    margin-left:-40%;padding-bottom:5%;" ></a>
      <p style="margin-left:-125%;margin-right: 0; ">Process...</p>
    </div>

    <div class="col-sm-3"style="margin-left:1.5%;" >
      <a href="Personal_info.php">
    <img src="imag/info1.png" class="img-responsive" style="width:50%;
    margin-left:-40%;padding-bottom:5%;" ></a>
      <p style="margin-left:-125%;">Personal info</p>
    </div>

    <div class="col-sm-3"style="margin-left:.5%;" >
      <a href="tracking_wfm.php">
    <img src="imag/Cookie_Tracking-512.png" class="img-responsive" style="width:50%;
    margin-left:-33%;padding-bottom:5%;" ></a>
      <p style="margin-left:-125%;">Tracking (77/76)</p>
    </div>
    </div></div>';
    
/*
if($_SESSION['username'] == 'dina.elleithy'){
    echo '
    <body style="background-image:url(new_year/dina3.jpg);background-repeat:no-repeat;
  height: auto;background-size:cover; ">
  <!--img src="new_year/vector_santa.jpg"  width="650" height="700" style="margin-top:-70%;margin-left:3%;"-->

<!--img src="new_year/happy-new-year2.png" style="max-width: 80%;
  height: auto; "-->';}*/
echo'<style>
.aya {
    width:80%;
    padding-right:0;
    padding-left:0px;
    margin-right: 0;
    margin-left: 0;
    float:left;
margin-top:-10%;
}</style>
<div class="aya">
        <div class="row">

          <a href="tasks_history.php">
          <div class="col-3" >
            <div class="small-box bg-info" style="border-radius: 10px 10px 10px 10px; "  >
              
              <div class="inner" style="padding: 16.5%;">
                                <h5>tasks_history</h5></div>
              <div class="icon">
                <i class="fas fa-history"></i></div>
              </a>
            </div>
          </div>
      
          <a href="all_daily_reports.php">
          <div class="col-3">
            <div class="small-box bg-warning" style="border-radius: 10px 10px 10px 10px; " >
              <div class="inner" style="padding: 16.5%;">
                <h5 >Daily reports</h5>

                <p style="color:#eee;"></p> </div>
              <div class="icon">
                <i class="fas fa-history"></i></div>
            </a>
            </div>
          </div>

          <a href="utilization_task_interval.php">
          <div class="col-3">
            <div class="small-box bg-success" style="border-radius: 10px 10px 10px 10px; " >
              <div class="inner" style="padding: 16.5%;">
                <h5 >utilization task interval</h5>

                <p style="color:#eee;"></p> </div>
              <div class="icon">
                <i class="fas fa-history"></i></div>
            </a>
            </div>
          </div>


<a href="utilization_less_abusing.php">
          <div class="col-3">
            <div class="small-box bg-danger" style="border-radius: 10px 10px 10px 10px;width:100%;" >
              <div class="inner" style="padding: 16.5%;">
                <h5  >utilization less than 30% abusing</h5>

                <p style="color:#eee;"></p> </div>
              <div class="icon">
                <i class="fas fa-history"></i></div>
            </a>
            </div>
          </div>

<a href="running.php">
          <div class="col-3">
            <div class="small-box bg-dark" style="border-radius: 10px 10px 10px 10px;width:100%;" >
              <div class="inner" style="padding: 16.5%;">
                <h5 style="color:white;" >Running Daily utilization</h5>

                <p style="color:#eee;"></p> </div>
              <div class="icon">
                <i class="fas fa-history"></i></div>
            </a>
            </div>
          </div>


          <a href="profile.php">
          <div class="col-3">
            <div class="small-box bg-primary" style="border-radius: 10px 10px 10px 10px;width:100%;" >
              <div class="inner" style="padding: 16.5%;">
                <h5 style="color:white;" >My Profile</h5>

                <p style="color:#eee;"></p> </div>
              <div class="icon">
                <i class="fas fa-history"></i></div>
            </a>
            </div>
          </div>

    </div>
    </div>';

       '<br>

    <!--<div class="col-md-5">
      <div class="well" >
        <a href="Personal_info.php">
    <img src="imag/info1.png" style="width:16%;float: right;margin-top: -20px;">
<p>Personal info</p></a>
      </div>

      <div class="well" style="width:80%;">
        <a href="allsignView.php">
    <img src="imag/signinnn.png" class="img-responsive" style="width:16%;float: right;margin-top: -20px;">
       <p>All sign..</p></a>
      </div>
    </div>
    <div class="col-md-5" >
      <div class="well">
        <a href="viewdeduction.php">
  <img src="imag/blog-absence.png" class="img-responsive" style="width:20%;float: right;margin-top: -20px;">
       <p>All deduction..</p></a>
      </div>
      <div class="well">
        <a href="adminschedule.php">
    <img src="imag/scheduleicon.png" class="img-responsive" style="width:22%;float: right;margin-top: -30px;">
<p>All schedule..</p></a>

       
      </div>
    </div>  
  </div-->
</div>';} ?>

 <style type="text/css">
 .content {
    min-height: 20px;}

.button1:hover{
  /* IN */
 background-color: #4CAF50;
  color: white;font-weight: bold;
   border: 10px solid #4CAF50;
   width:80%;
    height:90px;text-align: center;
    border-radius: 57px;
}

.button3:hover {
        /* OUT */
  background-color: #f44336;
  color: white;
   border: 10px solid #f44336;
   width:80%;
    height:90px;text-align: center;
    border-radius: 57px;

}
    </style>
<!--  noureldin +     bahaa -->
<?php 

if( ($_SESSION['username'] == 'noureldin.fawzy') || ($_SESSION['username'] == 'mohamed.bahaa') ){
  echo '
<div class="container">
<div class="row">
  <div class="col-sm-8">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>


      <div class="carousel-inner" role="listbox">

        <!--div class="item">
           <a href="dashboard.php" target="_blank">  <img src="imag/statistics.png" style="width: 48%;margin-left: 25%;"></a>
          <div class="carousel-caption">
           
            <p>Dashboard</p>
          </div>      
        </div-->

        <div class="item active">
 <p style="color:#002060; font-weight:bold;font-size:25px;">kPI`S Reports</p>
           <a href="mwd_reports.php" target="_blank">
           <img src="imag/reportsss.png" style="width: 38%;margin-left: 25%;"></a>
          <div class="carousel-caption">

          </div>      
        </div>

        <div class="item ">
        <a href="multiselect_reports.php"> <img src="imag/creatingreport.png" style="width:75%;margin-left:14%;" alt="Image">
          <div class="carousel-caption">
            <p style="color:orange; font-size:17px; font-width:bold;">Control report</p>
          </div>      
        </div>

        

        <!--div class="item">
 <p style="color:#002060; font-weight:bold;font-size:25px;">Real tickets</p>
           <a href="realticket.php" target="_blank">
           <img src="imag/reportatt.png" style="width: 48%;margin-left: 25%;"></a>
          <div class="carousel-caption">

          </div>      
        </div-->

            
            <div class="item">
        <a href="testtable.php"> 
        <img src="imag/table-line-new-512.png" style="width: 38%;margin-left: 25%;" alt="Image" ></a>
                  <div class="carousel-caption">

            <p style="color:orange; font-size:17px; font-width:bold;">Employee Table</p>
              </div>
              </div>   

<div class="item">
<a href="current_day.php">
     <img src="imag/office-3295556__340.jpg" style="width:68%;margin-left:16%;" alt="Image"></a>
        <div class="carousel-caption">
            <p style="color:orange; font-size:17px; font-width:bold;">Current Engineers</p>
          </div>      
        </div>

         

      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="well" >
      <a  href="testtable.php">
      <img src="imag/table-line-new-512.png" style="width: 20%;float: right;margin-top: -5%;">
      <p>Employess Dashboard Table..</p></a>
    </div>
         
    <div class="well" >
      <a href="Personal_info.php" >
        <img src="imag/info1.png" style="width: 20%;float: right;margin-top: -5%;"> <p >Employee Data...</p></a>
    </div>

    <div class="well">
       <a href="current_day2.php">
        <img src="imag/industry.png" style=" width: 20%;margin-top: -15px;
    border-radius: calc(.25rem - 1px); background-size: 280px 207px;float: right;"> <p>Daily report..</p></a>
    </div>

 <div class="well">
   <a href="multiselect_reports.php"> 
<img src="imag/graph+infographic.png" style="width: 58px;margin-top: -10px;float: right;">
      <p >Reports ...</p></a>
       
       <!--p>Visit Our Blog</p!
<img src="imag/scheduleicon.png" class="card-img"  style="width: 20%;
    border-radius: calc(60.25rem - 1px);margin-left: 7.5%;">
       -->
    </div>

    <div class="well">
       <a href="Resignation_Table.php">
        <img src="imag/resignImage.jpeg" style=" width: 20%;margin-top: -15px;
    border-radius: calc(.25rem - 1px); background-size: 280px 207px;float: right;"> <p>Resignation Table</p></a>
    </div>

  </div>
</div>


<hr>
</div>



<div class="container text-center" >    
  <br>
  <div class="row">

<div class="col-sm-3" >
      <a href="allstatus2.php">
    <img src="imag/customer-data.png" class="img-responsive" style="width:55%;margin-left:30%;" alt="Image"> </a>
    <br>
      <p style="margin-left:10%; color:#000066;">All History  ...</p>
    </div>

    
    <div class="col-sm-3"> 
<a href="welcomeadmin2.php">
<br>
      <img src="imag/Ticket-Management-.png" class="img-responsive" style="width:68%;margin-left: 20%;" alt="Image">
      <br>
      <br>
      <p style="margin-left: 2%; color:#000066;">Pending Requests</p>    
    </div>

<div class="col-sm-3" >
      <a href="Personal_info.php">
    <img src="imag/info1.png" class="img-responsive" style="width:50%;margin-left: 20%;" alt="Image"> 
      <p style="margin-left: 5%;margin-right: 0; color:#000066; ">All Employee data</p></a>
    </div>

<div class="col-sm-3" >
      <a href="utilizationadmin2.php">
    <img src="imag/utilization4.png" class="img-responsive" style="width:50%;margin-left:-15%;" alt="Image"> 
      <p style="margin-left:-90%;margin-right: 0; color:#000066;  ">Utilization</p></a>
    </div>



<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <!--div class="col-md-5" style="">
      <div class="well">
        <a href="Personal_info.php">
    <img src="imag/info1.png" class="img-responsive" style="width:16%;float: right;margin-top: -20px;"> 

       <p>Personal info</p></a>
      </div>

      <div class="well">
        <a href="allsignView.php">
       <p>All sign..</p></a>
      </div>
    </div>
    <div class="col-md-5">
      <div class="well">
        <a href="viewdeduction.php">
       <p>All deduction..</p></a>
      </div>
      <div class="well">
        <a href="adminschedule.php">
       <p>All schedule..</p></a>

       
      </div>
    </div>  
  </div>
  <hr>
</div-->';} ?>


<!--div class="container text-center">    
  <h3>Our Partners</h3>
  <br>
  <div class="row">
    <div class="col-sm-2">
      <img src="imag/time-and-date.png" class="img-responsive" style="width:100%" alt="Image">
     <a href="testtable.php"> <p>Partner 1</p></a>
    </div>
    <div class="col-sm-2"> 
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Partner 2</p>    
    </div>
    <div class="col-sm-2"> 
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Partner 3</p>
    </div>
    <div class="col-sm-2"> 
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Partner 4</p>
    </div> 
    <div class="col-sm-2"> 
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Partner 5</p>
    </div>     
    <div class="col-sm-2"> 
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Partner 6</p>
    </div> 
  </div>
</div!-->

<br>
</body>
</html>
