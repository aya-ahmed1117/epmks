
 <?php
        require_once("pages.php");
  ?>
<head>
      <title>AHT_Per_Week</title>
      <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

            <form method="post" class="form-horizontal">    
<div style="padding:20px;">

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >approve tickets
      <a href="approve_tickets.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">0...0</p></samp>
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
  <thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; ">
    <tr>

<th >ID</th>
<th >Type</th>
<th >username</th>
<th >Item</th>
<th >Creation time</th>
<th>Status</th>
      </tr>
       
  </thead>
<tbody>
<?php 
if(isset($_GET['Open'])){
if($_SESSION['role_id'] == 1){
  
$Employee_app_Id = $_SESSION['id'];

if(isset($_GET['Employee_app_Id'])){
  $Employee_app_Id = $_GET['Employee_app_Id'];}


$check_engineers  = $first_query = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$Employee_app_Id'   ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];
}

$Employee_app = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system WHERE Employee_app_Id ='$Employee_app_Id'   ");

$first_queryy = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system WHERE  [Request_status] = 'Open'  order by 1 DESC   ");


  while( $output_query = sqlsrv_fetch_array($first_queryy)){

$rows ="<tr>";
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Request_ID"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Request_Type"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Requester_username"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Ticket_Subject"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Creation_time"]->format("Y-m-d H:i:s").'</td>';
//
if( $output_query['Request_Type'] == 'Change schedule'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" 
href="view_ticket.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&schedule">schedule Modification </a>
</td>'; }

//
if( $output_query['Request_Type'] == 'Delete recored'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" 
href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&recored">Delete recored</a>
</td>'; }

//
if( $output_query['Request_Type'] == 'Change Management'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Management ">Change Management approve</a>
</td>'; }
//
if( $output_query['Request_Type'] == 'Change from OutSource to Staff'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Staff">OutSource to Staff</a>
</td>'; }
//Resign employees
if( $output_query['Request_Type'] == 'Resign employees'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Resign">Resign employees</a>
</td>'; }
//Employee Promotion
if( $output_query['Request_Type'] == 'Employee Promotion'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Promotion">Employee Promotion</a>
</td>'; }
//Swap
if( $output_query['Request_Type'] == 'Swap'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Swap">Swap approve</a>
</td>'; }
//sub_group
if( $output_query['Request_Type'] == 'Change sub_group'){
  $rows .='<td style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&sub_group">sub group </a>
</td>'; }


$rows .=  '</tr>';
echo $rows;
 }
}
}
?>

<?php 
if(isset($_GET['progress'])){
if($_SESSION['role_id'] == 1){
$Employee_app_Id = $_SESSION['id'];
if(isset($_GET['Employee_app_Id'])){
  $Employee_app_Id = $_GET['Employee_app_Id'];}
$check_engineers  = $first_query = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$Employee_app_Id'   ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];
}

$Employee_app = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system WHERE Employee_app_Id ='$Employee_app_Id'   ");

$first_queryy = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system WHERE  [Request_status] = 'in progress'  order by 1    ");


  while( $output_query = sqlsrv_fetch_array($first_queryy)){

$rows ="<tr>";
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Request_ID"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Request_Type"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Requester_username"].'</td>';

$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Ticket_Subject"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Creation_time"]->format("Y-m-d H:i:s").'</td>';
//
if( $output_query['Request_Type'] == 'Change schedule'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" 
href="view_ticket.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&schedule">schedule Modification</a>
</td>'; }

if( $output_query['Request_Type'] == 'Delete recored'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" 
href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&recored">Delete recored</a>
</td>'; }

//
if( $output_query['Request_Type'] == 'Change Management'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Management">Change Management approve</a>
</td>'; }
//
if( $output_query['Request_Type'] == 'Change from OutSource to Staff'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Staff">OutSource to Staff</a>
</td>'; }
//Resign employees
if( $output_query['Request_Type'] == 'Resign employees'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Resign">Resign employees</a>
</td>'; }
//Employee Promotion
if( $output_query['Request_Type'] == 'Employee Promotion'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Promotion">Employee Promotion</a>
</td>'; }
//Swap
if( $output_query['Request_Type'] == 'Swap'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Swap='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Swap">Swap approve</a>
</td>'; }
//sub_group
if( $output_query['Request_Type'] == 'Change sub_group'){
  $rows .='<td style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&sub_group">sub group </a>
</td>'; }

$rows .=  '</tr>';
echo $rows;
 }
}
}

?>
<?php 
if(isset($_GET['Hold'])){
if($_SESSION['role_id'] == 1){
$Employee_app_Id = $_SESSION['id'];
if(isset($_GET['Employee_app_Id'])){
  $Employee_app_Id = $_GET['Employee_app_Id'];}
$check_engineers  = $first_query = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$Employee_app_Id'   ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];
}

$Employee_app = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system WHERE Employee_app_Id ='$Employee_app_Id'   ");

$first_queryy = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system WHERE  [Request_status] = 'on hold'  order by 1    ");


  while( $output_query = sqlsrv_fetch_array($first_queryy)){

$rows ="<tr>";
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Request_ID"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Request_Type"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Requester_username"].'</td>';

$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Ticket_Subject"].'</td>';
//$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Employee_Username"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Creation_time"]->format("Y-m-d H:i:s").'</td>';
//
if( $output_query['Request_Type'] == 'Change schedule'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" 
href="view_ticket.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&schedule">schedule Modification </a>
</td>'; }

if( $output_query['Request_Type'] == 'Delete recored'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" 
href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&recored">Delete recored</a>
</td>'; }

//
if( $output_query['Request_Type'] == 'Change Management'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Management">Change Management approve</a>
</td>'; }
//
if( $output_query['Request_Type'] == 'Change from OutSource to Staff'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Staff">OutSource to Staff</a>
</td>'; }
//Resign employees
if( $output_query['Request_Type'] == 'Resign employees'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Resign">Resign employees</a>
</td>'; }
//Employee Promotion
if( $output_query['Request_Type'] == 'Employee Promotion'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Promotion">Employee Promotion</a>
</td>'; }
//Swap
if( $output_query['Request_Type'] == 'Swap'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Swap">Swap approve</a>
</td>'; }
//sub_group
if( $output_query['Request_Type'] == 'Change sub_group'){
  $rows .='<td style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&sub_group">sub group </a>
</td>'; }

$rows .=  '</tr>';
echo $rows;
 }
}
}

?>
<?php 
if(isset($_GET['pendindA'])){
if($_SESSION['role_id'] == 1){
$Employee_app_Id = $_SESSION['id'];
if(isset($_GET['Employee_app_Id'])){
  $Employee_app_Id = $_GET['Employee_app_Id'];}
$check_engineers  = $first_query = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$Employee_app_Id'   ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];
}

$Employee_app = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system WHERE Employee_app_Id ='$Employee_app_Id'   ");

$first_queryy = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system WHERE  [Request_status] = 'pending to admin'  order by 1    ");


  while( $output_query = sqlsrv_fetch_array($first_queryy)){

$rows ="<tr>";
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Request_ID"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Request_Type"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Requester_username"].'</td>';

$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Ticket_Subject"].'</td>';
//$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Employee_Username"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Pending_to_workforce_time"]->format("Y-m-d H:i:s").'</td>';
//
if( $output_query['Request_Type'] == 'Change schedule'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" 
href="view_ticket.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&schedule">schedule Modification </a>
</td>'; }

if( $output_query['Request_Type'] == 'Delete recored'){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" 
href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&recored">Delete recored</a>
</td>'; }

//
if( $output_query['Request_Type'] == 'Change Management'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Management">Change Management approve</a>
</td>'; }
//
if( $output_query['Request_Type'] == 'Change from OutSource to Staff'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Staff">OutSource to Staff</a>
</td>'; }
//Resign employees
if( $output_query['Request_Type'] == 'Resign employees'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Resign">Resign employees</a>
</td>'; }
//Employee Promotion
if( $output_query['Request_Type'] == 'Employee Promotion'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Promotion">Employee Promotion</a>
</td>'; }
//Swap
if( $output_query['Request_Type'] == 'Swap'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Swap">Swap approve</a>
</td>'; }
//sub_group
if( $output_query['Request_Type'] == 'Change sub_group'){
  $rows .='<td style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&sub_group">sub group </a>
</td>'; }

$rows .=  '</tr>';
echo $rows;
 }
}
}

?>
<?php 
if(isset($_GET['pendindR'])){
if($_SESSION['role_id'] == 1){
$Employee_app_Id = $_SESSION['id'];
if(isset($_GET['Employee_app_Id'])){
  $Employee_app_Id = $_GET['Employee_app_Id'];}
$check_engineers  = $first_query = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$Employee_app_Id'   ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];
}

$Employee_app = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system WHERE Employee_app_Id ='$Employee_app_Id'   ");

$first_queryy = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system WHERE [Request_status] = 'pending to requester' order by 1  ");

  while( $output_query = sqlsrv_fetch_array($first_queryy)){

$rows ="<tr>";
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Request_ID"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Request_Type"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Requester_username"].'</td>';

$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Ticket_Subject"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Creation_time"]->format("Y-m-d H:i:s").'</td>';
//
if( $output_query['Request_Type'] == 'Change schedule'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" 
href="view_ticket.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&schedule">schedule Modification </a>
</td>'; }

//
if( $output_query['Request_Type'] == 'Change Management'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Management">Change Management approve</a>
</td>'; }

if( $output_query['Request_Type'] == 'Delete recored'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" 
href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&recored">Delete recored</a>
</td>'; }
//
if( $output_query['Request_Type'] == 'Change from OutSource to Staff'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Staff">OutSource to Staff</a>
</td>'; }
//Resign employees
if( $output_query['Request_Type'] == 'Resign employees'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Resign">Resign employees</a>
</td>'; }
//Employee Promotion
if( $output_query['Request_Type'] == 'Employee Promotion'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Promotion">Employee Promotion</a>
</td>'; }
//Swap
if( $output_query['Request_Type'] == 'Swap'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Swap">Swap approve</a>
</td>'; }
//sub_group
if( $output_query['Request_Type'] == 'Change sub_group'){
  $rows .='<td style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&sub_group">sub group </a>
</td>'; }

$rows .=  '</tr>';
echo $rows;
 }
}
}

?>
<?php 
if(isset($_GET['closed'])){
if($_SESSION['role_id'] == 1){
$Employee_app_Id = $_SESSION['id'];
if(isset($_GET['Employee_app_Id'])){
  $Employee_app_Id = $_GET['Employee_app_Id'];}
$check_engineers  = $first_query = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$Employee_app_Id'  ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];
}

$Employee_app = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system WHERE Employee_app_Id ='$Employee_app_Id'   ");

$first_queryy = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system WHERE  [Request_status] = 'closed' and 
  [Creation_time] >'2023-01-01'  order by [Creation_time] desc    ");


  while( $output_query = sqlsrv_fetch_array($first_queryy)){

$rows ="<tr>";
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Request_ID"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Request_Type"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Requester_username"].'</td>';
$rows .='<td width="2px" class="hovers" style="border: 1px solid lightgray;">'.$output_query["Ticket_Subject"].'</td>';
$rows .= '<td  class="hovers" style="border: 1px solid lightgray;">'.$output_query["Creation_time"]->format("Y-m-d H:i:s").'</td>';
if( $output_query['Request_Type'] == 'Change schedule'){
  $rows .='<td style="border: 1px solid lightgray;" >
<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" 
href="view_ticket.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&schedule">schedule Modification </a>
</td>'; }

//
if( $output_query['Request_Type'] == 'Change Management'){
  $rows .='<td style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Management">Change Management approve</a>
</td>'; }

if( $output_query['Request_Type'] == 'Delete recored'){
  $rows .='<td style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" 
href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&recored">Delete recored</a>
</td>'; }
//
if( $output_query['Request_Type'] == 'Change from OutSource to Staff'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Staff">OutSource to Staff</a>
</td>'; }
//Resign employees
if( $output_query['Request_Type'] == 'Resign employees'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Resign">Resign employees</a>
</td>'; }
//Employee Promotion
if( $output_query['Request_Type'] == 'Employee Promotion'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&Promotion">Employee Promotion</a>
</td>'; }
//Swap
if( $output_query['Request_Type'] == 'Swap'){
  $rows .='<td  style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'">Swap approve</a>
</td>'; }
//sub_group
if( $output_query['Request_Type'] == 'Change sub_group'){
  $rows .='<td style="border: 1px solid lightgray;" >

<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="approve_ticket2.php?Request_ID='.$output_query["Request_ID"].'&Employee_app_Id='.$output_query["Employee_app_Id"].'&sub_group">sub group </a>
</td>'; }

$rows .=  '</tr>';
echo $rows;
 }
}
}

?>

</tbody>
</table>

</div>
</form>
</div>
    <?php

 include ("footer.html");
 ?>
