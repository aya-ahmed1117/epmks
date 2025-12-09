
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

?>

 <?php
          include ("pages.php");

      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      ?>
      <head>
    <title>AHT_Per_month</title>
    <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>	
<style type="text/css">
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
  .zoom:hover{
    transform: scale(1.5);
  }
</style>
<div style="padding:20px;">

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >AHT Monthly
      <a href="mwd_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">

<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
  	<tr>
        <th><center>Year</center></th>
        <th><center>Month</center></th>
        <th><center>username</center></th>
        <th><center>Manager</center></th>
        <th><center>Global_Avg</center> </th>
        <th><center>Logical_Avg</th>
        <th><center>Physical_Avg_PSD</center></th>
        <th><center>Physical_Avg_No_PSD</center> </th>  
        <th><center>Request_Avg_PSD</center> </th>  
        <th><center>Request_Avg_No_PSD</center> </th>  
        <th><center>Total_Average_PSD</center> </th>  
        <th><center>Total_Average_NO_PSD</center> </th>  		
  	</tr>
   </thead>
  <tbody>
<?php

if($_SESSION['role_id'] == 0){
  //include "AHTyesterday.php"; 
      $_GET['month']="month";
include ("AHTyesterday.php");
 //if (($someday = 'yesterday') || ($somedayweek != 'week') ){
    global $month;
 
      }else{
   $new_query = sqlsrv_query( $con , "exec AHT_Monthly @id = '$self'");
   while($echo = sqlsrv_fetch_array($new_query) ){

$rows = '<tr>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['month'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['username'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Manager'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Global_Avg'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Logical_Avg'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Physical_Avg_PSD'].'</td>';
    $rows .='<td style="border: 1px solid lightgray;" class="hovers">'.$echo['Physical_Avg_No_PSD'].'</td>';
    $rows .='<td style="border: 1px solid lightgray;"class="hovers">'.$echo['Request_Avg_PSD'].'</td>';
    $rows .='<td style="border: 1px solid lightgray;"class="hovers">'.$echo['Request_Avg_No_PSD'].'</td>';
    $rows .='<td style="border: 1px solid lightgray;"class="hovers">'.$echo['Total_Average_PSD'].'</td>';
    $rows .='<td style="border: 1px solid lightgray;"class="hovers">'.$echo['Total_Average_NO_PSD'].'</td>';
$rows .= '</tr>';
echo $rows;

}
}
?>

 </tbody>
</table>
</div>
</div>

<script src="js/table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "AHT_Per_month.xls"
            });
        }
    </script>



  <?php

 include ("footer.html");
 ?>
