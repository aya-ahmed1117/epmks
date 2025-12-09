
<?php
//session_start();
set_time_limit(400); 
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
    

sqlsrv_query( $con1 , "SET NAMES 'utf8'"); 
sqlsrv_query( $con1 ,'SET CHARACTER SET utf8' );
$this_year =date('Y');

?>

 <?php
        require_once("inc/config.inc");
  if($_SESSION['username'] == ''){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      ?>
<!DOCTYPE html>
<html>

<head>
      <title>MTTR Raw data_week</title>
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
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
  <link rel="stylesheet" href="css/bootstrap22.min.css">
  <link rel="stylesheet" href="css/font-awesome22.min.css">
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
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
        <ul style="margin-left: -5%;"><img src="imag/logo.jpg" alt="logo.jpg" style="padding-top: 1px; padding-left: 1px; width: 25px; margin-bottom: 3px; ">
          <span style="font-size:15px;font-family: Century Gothic; ">WorkForce Managment Tool</span></ul>
          <a href="senior_home.php">
                    <button type="button" id="sidebarCollapse" class="btn btn-info" style="margin-left:18%;" >
                        Home
                    </button></a>
                    <a href="mwd_reports.php">
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
           		background-color:#002060;border: 1px solid #666;color:#eee;
           	}
           	
           	.wrapper {
    height: 100%;
    position: relative;
     overflow-y: hidden; 
     overflow-x: auto; 
}
.tableFixHead         
 { 
 	overflow-y: auto; height:500px; overflow-x: auto; width:100%;
 }
.tableFixHead thead th 
{ 
	position: sticky; top: 0; 
}
           </style>

   <?php 
   $time = date("H:i");
$start = "12:15";
$end = "13:00";
$now = date('H:i');
if ($start > $end)
{
if ($now >= $start && $now <= $end)
{
echo' <form   method="post" >
  <center><h4 style="width:25%; font-size: 17px;font-weight: bold;">
    <span style="background-color:#ffff4d;
  border-radius: 10px 10px 10px 10px;padding:5px; ">
  <i class="fas fa-exclamation-triangle"></i>  Data is uploading from 12:15 pm Till 01:00 pm</span></h4></center>
</form>'; 
}
else
{
    echo "";
}}
else if ($start < $end)
{
if ($now >= $start && $now <= $end)
    {
      echo' <form   method="post" >
  <center><h4 style="width:25%; font-size: 17px;font-weight: bold;">
    <span style="background-color:#ffff4d;
  border-radius: 10px 10px 10px 10px;padding:5px; ">
  <i class="fas fa-exclamation-triangle"></i>  Data is uploading from 12:15 pm Till 01:00 pm</span></h4></center>
</form>'; 
}}
else
{
    echo "";
}

    ?>
           <form   method="post" >



  <a role="button" href="MTTR_week_excel.php?export" download="mttr_per_week.xls" >

    <img src="imag/excel2.png" style="width:7%;float:right;transform: translate(0,-24px);">
  <h4 style="width:20%;float:right;transform: translate(-5px,-10px); font-size: 17px;font-weight: bold;">
    <span style="background-color: orange;
  border-radius: 10px 10px 10px 10px;padding: 10px; ">
  <i class="fas fa-exclamation-triangle"></i> 
  Press this button to download full report 
  <i class="fas fa-arrow-alt-circle-right"></i></span></h4></a>
  
 <div class="form-group">
      <label style=" font-weight: bold;font-size: 20px;" >MTTR Raw data<spam style="color: orange;"> Per week </spam></label>
  
</div>
<br>
<br>
<br>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">
<div class="tableFixHead">

<table class="table table-hover order-table"  cellspacing="0" width="150%" id="tblCustomers" >
  <thead  style="background-color:rgb(120, 120, 120); color: white; font-weight: bold;font-variant: normal;">
  	<tr>
  
    <th><center>Year</center></th>
  <th><center>Week_num</center></th>
  <th><center>RequestID</center></th>
  <th><center>PSD_number</center></th>
  <th><center>creation_time</center></th>
  <th><center>MTTI1</center></th>
  <th><center>MTTI1_eng</center></th>
  <th><center>MTTI2</center></th>
  <th><center>MTTI2_user</center></th>
  <th><center>MTTI</center></th>
  <th><center>MTTF</center></th>
  <th><center>MTTF_user</center></th>
  <th><center>MTTV</center></th>
  <th><center>MTTV_eng</center></th>
  <th><center>MTTR</center></th>
  
  <th><center>Onhold_time</center></th>
  <th><center>Ticket_not_opened_time</center></th>

  <th><center>closure_reason</center></th>
  <th><center>closure_Reason_Eng</center></th>
  <th><center>Support_Rep</center></th>
  <th><center>First_Resp_Time</center></th>
  <th><center>First_resp_eng</center></th>
  <th><center>Category</center></th>
  <th><center>Subcategory</center></th>
  <th><center>Item</center></th>
  <th><center>nodeID</center></th>
  <th><center>Ticket_group</center></th>
  <th><center>subgroup</center></th>
  <th><center>Reopen</center></th>
  <th><center>Request_Mode</center></th>

  

		</tr>
		</thead>
	
  <tbody>

<?php
require_once("inc/config.inc");

date_default_timezone_set('Africa/Cairo');
 $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkForce_Reporting_DB";
  
  $connectionInfo = array( "Database"=>"WorkForce_Reporting_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con76 = sqlsrv_connect($DBhost, $connectionInfo);
    

sqlsrv_query( $con76 , "SET NAMES 'utf8'"); 
sqlsrv_query( $con76 ,'SET CHARACTER SET utf8' );

   $new_query = sqlsrv_query( $con76 , "SELECT *  FROM 
    [WorkForce_Reporting_DB].[dbo].[MTTR_Raw_Data_Previous_Month]
    where [YEAR] >='$this_year'");
  

 		  while($output = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
	$rows .='<td style="font-size:15px;border: 1px solid #000000;">'.$output["YEAR"].'</td>';
  $rows .='<td style="font-size:15px;border: 1px solid #000000;">'.$output["MONTH"].'</td>';
  $rows .='<td style="font-size:15px;border: 1px solid #000000;">'.$output["REQUESTID"].'</td>';
  $rows .='<td style="font-size:15px;border: 1px solid #000000;">'.$output["PSD_NUMBER"].'</td>';
  $rows .='<td style="font-size:15px;border: 1px solid #000000;">'.$output["CREATION_TIME"]->format('Y:m:d H:i:s').'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["MTTI1"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["MTTI1_ENG"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["MTTI2"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["MTTI2_USER"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["MTTI"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["MTTF"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["MTTF_USER"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["MTTV"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["MTTV_ENG"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["MTTR"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["ONHOLD_TIME"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["TICKET_NOT_OPENED_TIME"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["CLOSURE_REASON"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["CLOSURE_REASON_ENG"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["SUPPORT_REP"].'</td>';
  
  if($output["FIRST_RESP_TIME"] == NULL ){
    $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
Blank</td>';
  }else{
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["FIRST_RESP_TIME"]->format('Y:m:d H:i:s').'</td>';}
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["FIRST_RESP_ENG"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["CATEGORY"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["SUBCATEGORY"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["ITEM"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["NODEID"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["TICKET_GROUP"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["SUBGROUP"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["REOPEN"].'</td>';
  $rows .='<td style="font-size:15px ;border: 1px solid #000000;">'.$output["REQUEST_MODE"].'</td>';
		  	$rows .= '</tr>';
		  	echo $rows;

}

?>
 </tbody>
</table>
</div>
</div>
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
</form>
<script src="js/table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
  
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "mttr_per_week.xls"
            });
        }
    </script>
</body>
</html>


