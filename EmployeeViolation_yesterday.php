
<?php
 //session_start(); 
set_time_limit(400);
include ("pages.php");
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkforceDB_indexed";
  
  $connectionInfo = array( "Database"=>"WorkforceDB_indexed" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $connect = sqlsrv_connect($DBhost, $connectionInfo);
    

sqlsrv_query( $connect , "SET NAMES 'utf8'"); 
sqlsrv_query( $connect ,'SET CHARACTER SET utf8' );


        require_once("inc/config.inc");
      ?>
<head>
      <title>Employee Violation</title>
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

<style type="text/css">
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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Employee Violation Yesterday
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
  <thead style="color: white;font-size: 15px;background-color:#55608f;border: 1px solid white; ">
    <tr>    

<th ><center>ID</center></th>
<th ><center>USERNAME</center></th>
<th ><center>MANAGER</center></th>
<th ><center>Day</center></th>
<th ><center>MTTI1_AVG</center></th>
<th ><center>MTTI1_TICKETS</center></th>
<th ><center>MTTI2_AVG</center></th>
<th ><center>MTTI2_TICKETS</center></th>
<th ><center>MTTI_AVG</center></th>
<th ><center>MTTI_TICKETS</center></th>
<th ><center>MTTI_VIOLATION</center></th>
<th ><center>MTTI_VIOL</center></th>
<th ><center>MTTV_AVG</center></th>
<th ><center>MTTV_TICKETS</center></th>
<th ><center>MTTV_VIOLATION</center></th>
<th ><center>MTTV_VIOL</center></th>
<th ><center>MTTR_AVG</center></th>
<th ><center>MTTR_TICKETS</center></th>
<th ><center>MTTR_VIOLATION</center></th>
<th ><center>MTTR_VIOL</center></th>
<th ><center>CLOSURE_TICKETS</center></th>
<th ><center>CLOSURE_REASON_V</center></th>
<th ><center>CLOSURE_VIOL</center></th>
<th ><center>NODE_TICKETS</center></th>
<th ><center>NODE_VIOLATION</center></th>
<th ><center>NODE_VIOL</center></th>
		
		</tr>
		</thead>
	</center>
  <tbody>

<?php
if($_SESSION['role_id'] == 0){
 //include "AHTyesterday.php";
      $_GET['yesterday']="yesterday";
include ("violations_ywm.php");
 //if (($someday = 'yesterday') || ($somedayweek != 'week') ){
    global $someday;
      }else{
   $new_query = sqlsrv_query($connect , "SELECT * from [WorkForce_Reporting_DB].[dbo].[tbl_Employee_Violation_Daily]
    where [USERNAME] in ( select username from [Aya_Web_APP].dbo.employee_web_table where manager = '$self') ");
  
 		  while($echo = sqlsrv_fetch_array($new_query) ){

$rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['ID'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['USERNAME'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MANAGER'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['date']->format('Y-m-d').'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI1_AVG'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI1_TICKETS'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_AVG'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_TICKETS'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI_AVG'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI_TICKETS'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI_VIOLATION'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['MTTI_VIOL']).'%'.'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_AVG'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_TICKETS'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_VIOLATION'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['MTTV_VIOL']).'%'.'</td>';
$rows .='<td sclass="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_AVG'].'</td>';
$rows .='<td sclass="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_TICKETS'].'</td>';
$rows .='<td sclass="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_VIOLATION'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['MTTR_VIOL']).'%'.'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['CLOSURE_TICKETS'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['CLOSURE_REASON_V'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['CLOSURE_VIOL']).'%'.'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['NODE_TICKETS'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['NODE_VIOLATION'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['NODE_VIOL']).'%'.'</td>';
$rows .= '</tr>';
echo $rows;

}
}
?>
 </tbody>
</table>
</div>
</div>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Employee_Violation_previous_month.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>
