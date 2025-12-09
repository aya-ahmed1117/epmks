
 <?php
        require_once("inc/config.inc");
        set_time_limit(650);
  if($_SESSION['username'] == ''){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];

      $usernames="";
      if(isset($_POST['username'])){$usernames = $_POST['username'];}
      $ticket_group="";
      if(isset($_POST['ticket_group'])){$ticket_group = $_POST['ticket_group'];}
      /////////////
   date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkforceDB_indexed";
  
  $connectionInfo = array( "Database"=>"WorkforceDB_indexed" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $connect = sqlsrv_connect($DBhost, $connectionInfo);


      ?>
<!DOCTYPE html>
<html>

<head>
      <title>Utilization/task Daily</title>
      <link rel="icon" href="imag/logo.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://davidstutz.de/bootstrap-multiselect/docs/js/bootstrap-3.3.2.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
<link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
<link rel="stylesheet" href="css/bootstrap22.min.css">
<link rel="stylesheet" href="css/font-awesome22.min.css">
<link rel="stylesheet" href="css/AdminLTE.min.css">
<link rel="stylesheet" href="css/_all-skins.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/bootstrap2.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style4.css">
<link rel="stylesheet" href="css/bootstrap-3.1.1.min.css" type="text/css" />
<link href="css/bootstrap-multiselect.css" rel="stylesheet"/>

</head>
<body >
	<div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
        <ul style="margin-left: -5%;"><img src="imag/logo.jpg" alt="logo.jpg" style="padding-top: 1px; padding-left: 1px; width: 25px; margin-bottom: 3px; "><span style="font-size:15px;font-family: Century Gothic; ">WorkForce Managment Tool</span></ul>
      <a href="senior_home.php">
      <button type="button" id="sidebarCollapse" class="btn btn-info" style="margin-left:11%;" >
                        Home
                    </button></a>
                                        <a href="All_daily_reports.php">

     <button type="button" id="sidebarCollapse" class="btn btn-warning" style="margin-left:11%;" >
                      <i class="fas fa-backward"></i>  Back
                    </button></a>
  
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
     
                        <ul class="nav navbar-nav ml-auto">

 <li ><a href="#" style="font-size: 9.5px;"><span class="glyphicon glyphicon-user"></span> login as <samp>:</samp>
        <?php echo $_SESSION["username"];?><h6 style="color: orange;font-size: 10px;text-align: justify;text-indent: 10px;letter-spacing: -.5px;line-height: 0.8;" ></h6></a></li>
                          
<li><a href="?logout"><span class="glyphicon glyphicon-log-in "></span> Logout</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
     <style type="text/css">
           	.head{
           		font-size: 20px;
           		background-color:#002060;border: 1px solid #666;color:white;
           	}
           	.heads{
           		background-color:#002060;
           	}
           	.wrapper {
    height: 100%;
    position: relative;
     overflow-y: hidden; 
     overflow-x: auto; 
}
.tableFixHead         
 { 
 	overflow-y: auto; height:500px; overflow-x: auto; 
 }
.tableFixHead thead th 
{ 
	position: sticky; top: 0; 
}

.popup {

  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  border-radius: 5px;
  width: 100%;
  position: fixed;
  background: rgba(0, 0, 0, 0.7);
}
.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}

.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  background-color: #eee;
  width: 39%;
  margin: 200px 0 10px 30%;
  text-align: center;
  padding: 45px;
  border: 2px solid rgba(0, 0, 10, 0.7);
  border-radius: 20px/50px;
  font-size: 40px;
  color: black;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  
  .popup{
    width: 70%;
  }
}
/*
.buttonload {
  background-color: #4CAF50; /* Green background *
  border: none; /* Remove borders *
  color: white; /* White text *
  padding: 12px 24px; /* Some padding *
  font-size: 16px; /* Set a font-size *
}

/* Add a right margin to each icon *
.fa {
  margin-left: -12px;
  margin-right: 8px;
}*/
</style> 
           <form method="post" >
 


  <!--a role="button" id="btnExport" value="Export to Excel"  onclick="Export()">
    <img src="imag/excel2.png" style="width:7%;float:right;transform: translate(0,-10px);"></a-->

<div class="form-group">
   <label  style=" font-weight: bold;font-size: 20px;" >Daily <spam style="color: orange;"> Utilization</spam></label>
  
</div>
            
 <input type='date' id="dates"class='dateFilter' name='date' title="date" required style="padding:4px;width:25%;"
      value='<?php if(isset($_POST['date'])) echo $_POST['date']; ?>'/>
<br/>
<br/>

<div class="input-group" style="width:70%;">


<button  type='submit' name='submit' value="Get data" 
class="btn btn-info btn-circle btn-circle-xl m-1">Get Total_Utilization /1</button>
<br/>
<br/>
<br/>
<br/>

</div>
<br/>

<div class="input-group" style="width:70%;">
<button  type='submit' name='save' value="Get data" 
class="btn btn-dark btn-circle btn-circle-xl m-1">Get Task_Interval_Utiliz /2</button>
<br/>
<br/>
<br/>
<br/>

</div>
<br/>

<div class="input-group" style="width:70%;">
<button  type='submit' name='send' value="Get data" 
class="btn btn-warning btn-circle btn-circle-xl m-1">Get Task_Interval_Utiliz_Onsite /3</button>
<br/>
<br/>
<br/>
<br/>

</div> 


 <?php
//Total_Utilization_Daily
if(isset($_POST['date'])){
$mydate = $_POST['date'];

   if(isset($_POST['submit'])){


 $run_utilization =sqlsrv_query( $con ,"exec [Total_Utilization_Daily_new] 
  @date = '$mydate'   " );

  /*echo'<button class="buttonload" id ="buttonload">
  <i class="fas fa-sync-alt"></i>Loading
</button>';*/

 if($run_utilization){
 echo '
  <div class="popup" id="message">
<div class="content" name="done" ><h2>Total Utilization Done  <i class="fas fa-thumbs-up"></i> </h2></div>
</div>
 ';}

else{
  echo'error in Total Utilization';
}


}}
?>

<script type="text/javascript">

   /*setTimeout(function() {
  document.getElementById("buttonload").style.display = 'none';
}, 5000);
  //buttonload*/

  setTimeout(function() {
  document.getElementById("message").style.display = 'none';
}, 5000);
</script>

<?php
//Task_Interval_Utilization_Dailly
if(isset($_POST['date'])){
$mydate = $_POST['date'];

   if(isset($_POST['save'])){


 $Task_Interval =sqlsrv_query( $con ,"exec Task_Interval_Utilization_Daily 
  @date = '$mydate'   " );



 if($Task_Interval){
 echo '
  <div class="popup" id="message2">
<div class="content" name="done" ><h2>Task_Interval_Utilization_Dailly Done  <i class="fas fa-thumbs-up"></i> 2 </h2></div>
</div>
';}

else{
  echo'error in Task_Interval_Utilization_Dailly';
}



}}

?>

<script type="text/javascript">
  setTimeout(function() {
  document.getElementById("message2").style.display = 'none';
}, 5000);
</script>

<?php
//Task_Interval_Utilization_Onsite_Daily
if(isset($_POST['date'])){
$mydate = $_POST['date'];

   if(isset($_POST['send'])){


 $Onsite =sqlsrv_query( $con ,"exec Task_Interval_Utilization_Onsite_Daily 
  @date = '$mydate'   " );

 if($Onsite){
 echo '
  <div class="popup" id="message3">
<div class="content" name="done" ><h2>Task_Interval_Utilization_Onsite_Daily  Done  <i class="fas fa-thumbs-up"></i> 3</h2></div>
</div>
';}

else{
  echo'error in Utilization  Onsite';
}


}}

?>

<script type="text/javascript">
  setTimeout(function() {
  document.getElementById("message3").style.display = 'none';
}, 5000);
</script>

  </form>

<script type='text/javascript'>
  
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
      Arr.forEach.call(tables, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);
  
</script>
<script src="js/table2excel.js" type="text/javascript"></script>




</body>
</html>


