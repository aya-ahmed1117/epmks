  <?php


include ("pages.php");
$curr_year = date('Y'); 
if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];
}
?>

    <title>Tasks History</title>

<link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

<style type="text/css">
  .zoom:hover{
    transform: scale(1.5);
  }
</style>
<div style="padding:20px;">  
 <?php      
if(isset($_GET['engineer_id'])){$engineer_id = $_GET['engineer_id'];}
if($_SESSION['role_id'] == 1)
{
    ?>

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Tasks History
      <a href="allstatus2.php">
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
    <th>ID Number</th>
    <th>Username</th>
    <th >Start time</th>
    <th >End Time</th>
    <th >Date</th>
    <th >Type</th>
    <th >Notes</th>
    <th >Status</th>
    <th  >E-workforce approve</th>
    <th  >Senior approved </th>
    <th  >Senior rejected</th>
    <th  >workforce reject</th>
</tr>

  </thead>
  <tbody>
<?php
$check_engineers  = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_id'   ");
 while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'] ;
}

$first_query = sqlsrv_query( $con ,"SELECT * FROM create_task WHERE engineer_id ='$engineer_id'
and year([cur_date]) >='$curr_year'   ");
   while( $output_query = sqlsrv_fetch_array($first_query)){

$rows ="<tr>";
$rows .='<td style="border: 1px solid lightgray;" >'.$output_query["s_id"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["username"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["stime"]->format('H:i:s').'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["etime"]->format('H:i:s').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["cur_date"]->format('Y-m-d').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["type"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;word-spacing: 1px;width: 2px;
  height: 2px;text-align: justify;">'.$output_query["notes"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["status"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["admin_approve"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["approved_by"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["rejected_by"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;color:#b30000;">'.$output_query["admin_reject"].'</td>';


$rows .=  '</tr>';
echo $rows;
}
}elseif($_SESSION['role_id'] >= 2){
?>


<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Tasks History
      <a href="allstatus2.php">
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

    <th>Username</th>
    <th >Start time</th>
    <th >End Time</th>
    <th >Date</th>
    <th >Type</th>
    <th >Notes</th>
    <th >Status</th>

</tr>

  </thead>
  <tbody>
    <?php

$check_engineers  = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_id'   ");
 while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'] ;
}

$first_query = sqlsrv_query( $con ,"SELECT * FROM create_task WHERE engineer_id ='$engineer_id'
and  year([cur_date]) >='$curr_year'  ");

 while( $output_query = sqlsrv_fetch_array($first_query)){
$rows ="<tr>";
$rows .='<td style="display:none;" >'.$output_query["s_id"].'</td>';
$rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$output_query["username"].'</td>';
$rows.=    '<td class="hovers"style="border: 1px solid lightgray;">'.$output_query["stime"]->format('H:i:s').'</td>';
$rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$output_query["etime"]->format('H:i:s').'</td>';
$rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$output_query["cur_date"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$output_query["type"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;word-spacing: 1px;width: 2px;
  height: 2px;text-align: justify;">'.$output_query["notes"].'</td>';
$rows .='<td class="hovers"style="border: 1px solid lightgray;color:green;">'.$output_query["status"].'</td>';

$rows .=  '</tr>';
echo $rows;
}
}


?>
</tbody>
</table>
</div>

</div>
<script src="js/table2excel.js" type="text/javascript"></script>
 <script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>
