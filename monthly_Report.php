
<?php
//session_start();
set_time_limit(400);
include ("pages.php");
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
   $this_year =date('Y');

?>
<head>
      <title>Monthly Report</title>
      <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

<style type="text/css">
  .zoom:hover{
    transform: scale(1.5);
  }
</style>

s
 <?php 
    if(($_SESSION['role_id'] == 5)  ||($_SESSION['role_id'] == 1) ) {
      ?>
<div style="padding:20px;">

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
        <div class="media">
          <div class="media-body">
            <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Summary Kpi`s
            <a href="Summary_kpi.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a>
  </h2>
            <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
            </div>
        </div>
    </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       
        <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter"data-table="order-table"placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; padding: 3px;
  word-wrap: break-word; ">
    <tr>
     
      <th ><center>Year</center></th>
      <th ><center>Month</center></th>
      <th ><center>utilization without resident_Mega_GDS(day)</center></th>
      <th ><center>Absenteeism</center></th>
      <th ><center>MTTI2_Category</center></th>
      <th ><center>MTTV</center> </th>
      <th ><center>AHT</center></th>
      <th ><center>MTTR</center></th>
      <th ><center>MTTR_SD</center></th>
      <th ><center>MTTI %</center></th>
      <th ><center>MTTV %</center></th>
      <th ><center>Correct Node Tickets</center> </th>  
      <th ><center>Not Assigned Tickets</center> </th>  
      <th><center>MTTR_SD_24hr</center></th>
      <th><center>Global_tickets_linked_within 1 hour to parent_ticket</center></th>
      <th><center>SD_pool_not_exceed_90_min</center></th>
      <th><center>global_tickets_have_parent_ticket</center></th>
    </tr>
		</thead>
	
  <tbody>
 
<?php
if(($_SESSION['role_id'] == 5) ||($_SESSION['role_id'] == 1) ){

   $new_query = sqlsrv_query( $con , "SELECT  [Year]
      ,[MONTH]
      ,[utilization without resident_day]
      ,[Absenteeism]
      ,[MTTI2_Category]
      ,[MTTV]
      ,[AHT]
      ,[MTTR]
      ,[MTTR_SD]
      ,[MTTI %]
      ,[MTTV %]
      ,[Correct Node Tickets]
      ,[Not Assigned Tickets]
      ,[MTTR_SD_24hr]
      ,[global_tickets_to_be_linked_to_PSC]
      ,[SD_pool_not_exceed_90_min]
      ,[global_tickets_have_PSD]
  FROM [WorkForce_Reporting_DB].[dbo].[KPIs_per_SD]
    order by len(month) , month");
  
 		  while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
		$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
    
    if($echo['utilization without resident_day'] >= '85%'){
          $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen; ">'.$echo['utilization without resident_day'].'</td>';

    }

  else{$rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:tomato;">
   '.$echo['utilization without resident_day'].'</td>';}

    if($echo['Absenteeism'] <= 10){
		$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['Absenteeism'].'</td>';
       }
       else{$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:tomato;">
       '.$echo['Absenteeism'].'</td>';
       }
    //MTTI2_Category
    if($echo["MTTI2_Category"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;">'.$echo['MTTI2_Category']->format('H:i:s').'</td>';}
//MTTV
      if($echo["MTTV"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:lightgreen;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;">'.$echo['MTTV']->format('H:i:s').'</td>';}

   if($echo['AHT'] == NULL){
        $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;">Blank</td>';}
else{
  if($echo['AHT']->format('i') < 32){
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:lightgreen;">
      '.$echo['AHT']->format('H:i:s').'</td>';}

       if($echo['AHT']->format('i') >= 32){
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:tomato;">
      '.$echo['AHT']->format('H:i:s').'</td>';}
}
  
//////MTTR
    if($echo['MTTR'] >='90%' ){
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:lightgreen;">'.$echo['MTTR'].'</td>';
    }
    else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:tomato;">'.$echo['MTTR'].'</td>';
    }
    //[MTTR_SD] 
    if($echo['MTTR_SD'] >='90%' ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:lightgreen;">'.$echo['MTTR_SD'].'</td>';
    }
    else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:tomato;">'.$echo['MTTR_SD'].'</td>';
    }
    
    if($echo['MTTI %'] >='90%' ){
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:lightgreen;">'.$echo['MTTI %'].'</td>';
    }
    else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:tomato;">'.$echo['MTTI %'].'</td>';
    }
    
     if($echo['MTTV %'] >=90 ){
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:lightgreen;">'.$echo['MTTV %'].'</td>';
    }
    else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:tomato;">'.$echo['MTTV %'].'</td>';
    }

    if($echo['Correct Node Tickets'] >=90 ){
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:lightgreen;">'.$echo['Correct Node Tickets'].'</td>';
    }
    else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:tomato;">
      '.$echo['Correct Node Tickets'].'</td>';
    }

    if($echo['Not Assigned Tickets'] < 5 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:lightgreen;">
      '.$echo['Not Assigned Tickets'].'</td>';
    }
    elseif($echo['Not Assigned Tickets'] >= 5 ){
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:tomato;">
      '.$echo['Not Assigned Tickets'].'</td>';
    }    

    if($echo['MTTR_SD_24hr'] >=90){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:lightgreen;">
      '.$echo['MTTR_SD_24hr'].'</td>';
    }
    else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:tomato;">
      '.$echo['MTTR_SD_24hr'].'</td>';
    }

if($echo['global_tickets_to_be_linked_to_PSC'] >=93 ){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:lightgreen;">
      '.$echo['global_tickets_to_be_linked_to_PSC'].'</td>';
    }
else{
     $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:tomato;">
      '.$echo['global_tickets_to_be_linked_to_PSC'].'</td>';
    }

if($echo['SD_pool_not_exceed_90_min'] >=93 ){

   $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:lightgreen;">
      '.$echo['SD_pool_not_exceed_90_min'].'</td>';
    }
    else{
       $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:tomato;">
      '.$echo['SD_pool_not_exceed_90_min'].'</td>';
    }

if($echo['global_tickets_have_PSD'] >= 98){
   $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:lightgreen;">
      '.$echo['global_tickets_have_PSD'].'</td>';
}
  else{
    $rows .='<td class="hovers" style="border: 1px solid lightgray;color:black;background-color:tomato;">
      '.$echo['global_tickets_have_PSD'].'</td>';
  }

		  	$rows .= '</tr>';

		  	echo $rows;

}
}
}
?>
 

    </tbody>
</table>
</div>

</center>
</div>
<script src="js/table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Monthy_report.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>


