
<?php
 //session_start();
set_time_limit(400);
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkforceDB_indexed";
  
  $connectionInfo = array( "Database"=>"WorkforceDB_indexed" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $connect = sqlsrv_connect($DBhost, $connectionInfo);

include ("pages.php");
?>
<head>
  <title>Violation per month</title>
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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Employee Violation Monthly
      <a href="mwd_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">
        <img src="images/aaa-removebg-preview.png" 
        class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<?php 
// if($_SESSION['username'] == 'aya.abdelfattah'){
// $this_year = date('Y');
// echo '<input type="date" value="' . $this_year->format('Y-m') . '" />';
// }
if($_SESSION['role_id'] > 0){
  ?>
<div style="padding: 20px;">
  <form method="post" >
    <div class="row">
      <div class="col col-md-4">
        <div class="input-group">
  <span class="input-group-text" id="basic-addon1">Choose Month</span>
  <input name="month" type="month" id="month" class="form-control" aria-describedby="basic-addon1"
  required="" value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>'>
    <button class="btn btn-primary"type='submit' name='submit' value="Get data" style="width: 20%;" >Submit</button>
</div>

    
  </div>
</div>

<br>
 <?php
if(isset($_POST['month'])){
$myWeek = $_POST['month'];}

}?>

<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter"data-table="order-table"placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color:#55608f;border: 1px solid white; ">
    <tr>	
      <th ><center>ID</center></th>
      <?php if($_SESSION['role_id'] > 0){?>
      <th ><center>Month</center></th>
      <th ><center>Year</center></th>
    <?php } ?>
      <th ><center>username</center></th>
      <th ><center>manager</center></th>
      <th ><center>MTTI1 Avg</center></th>
      <th ><center>mtti1 tickets</center></th>
      <th ><center>MTTI2 Avg</center></th>
      <th ><center>MTTI2 tickets</center></th>
      <th ><center>MTTI Avg</center></th>
      <th ><center>MTTI Tickets</center></th>
      <th ><center>MTTI Violation</center></th>
      <th ><center>MTTI viol</center></th>
      <th ><center>MTTV Avg</center></th>
      <th ><center>MTTV Tickets</center></th>
      <th ><center>MTTV Violation</center></th>
      <th ><center>MTTV viol</center></th>
      <th ><center>MTTR Avg</center></th>
      <th ><center>MTTR Tickets</center></th>
      <th ><center>MTTR violation</center></th>
      <th ><center>MTTR viol</center></th>
      <th ><center>Closure Tickets</center></th>
      <th ><center>Closure Reason V</center></th>
      <th ><center>Closure viol</center></th>
      <th ><center>Node tickets</center></th>
      <th ><center>Node violation</center></th>
      <th ><center>% Node viol</th></center>
		</tr>
		</thead>
  <tbody>
    <!--div class="se-pre-con"></div-->
<?php
if($_SESSION['role_id'] == 0){
 //include "AHTyesterday.php";
      $_GET['month']="month";
include ("violations_ywm.php");
 //if (($someday = 'yesterday') || ($somedayweek != 'week') ){
    global $month;
 
      }else{
if(isset($_POST['submit'])){

//month 
if(isset($_POST['month'])){$myMonth= $_POST['month'];

  $newMonth = date('n', strtotime($myMonth));
  $newYear = date('Y', strtotime($myMonth));

  $new_query = sqlsrv_query($connect , "SELECT  distinct [ID]
      ,[USERNAME]
      ,[MANAGER]
      ,[Month]
      ,[MTTI1_AVG]
      ,[MTTI1_TICKETS]
      ,[MTTI2_AVG]
      ,[MTTI2_TICKETS]
      ,[MTTI_AVG]
      ,[MTTI_TICKETS]
      ,[MTTI_VIOLATION]
      ,[MTTI_VIOL]
      ,[MTTV_AVG]
      ,[MTTV_TICKETS]
      ,[MTTV_VIOLATION]
      ,[MTTV_VIOL]
      ,[MTTR_AVG]
      ,[MTTR_TICKETS]
      ,[MTTR_VIOLATION]
      ,[MTTR_VIOL]
      ,[CLOSURE_TICKETS]
      ,[CLOSURE_REASON_V]
      ,[CLOSURE_VIOL]
      ,[NODE_TICKETS]
      ,[NODE_VIOLATION]
      ,[NODE_VIOL]
      ,[year]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_Employee_Violation_previous_month]
  where [Month] = '$newMonth' and [year] ='$newYear'   and  [USERNAME] in ( select username from [Aya_Web_APP].dbo.employee_web_table where manager = '$self') ");
  //and [year] ='$newYear'
 		  while($echo = sqlsrv_fetch_array($new_query) ){

 $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['ID'].'</td>';
$rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$echo['Month'].'</td>';
$rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$echo['year'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['USERNAME'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MANAGER'].'</td>';
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
}}
}
?>

 </tbody>
</table>
</center>
<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Violation_previous_month.xls"
            });
        }
    </script>
</div>

</div>

</div>
</form>

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
<script src="js/table2excel.js" type="text/javascript"></script>
<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>
