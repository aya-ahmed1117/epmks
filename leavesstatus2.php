

<?php
include ("pages.php");
?>

    <title>Leaves History</title>
    <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
    </head>
<style type="text/css">
  .zoom:hover{
    transform: scale(1.5);
  }
</style>
<div style="padding:20px;">
  
<?php  
$curr_year = date('Y');    
if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];
}
//mysqli -> select data from table 


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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >All history leaves
      <a href="allstatus2.php">
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
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
        <th >ID</th>
        <th >Username</th>
        <th >Type</th>
        <th  >From Date</th>
        <th >To Date</th>
        <th >From Time</th>
        <th >To Time</th>
        <th >Notes</th>
        <th >Count</th>
        <th >Status</th>
        <th >E-workforce approve</th>
        <th >Senior approved </th>
        <th>Senior rejected</th>
        <th >workforce reject</th>
        <th >wfm_note</th>
    </tr>
  </thead>

  <tbody>
<?php
$check_engineers  = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_id'   ");
while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'] ;
}
//='$curr_year'
$first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE engineer_id ='$engineer_id' and year(adate) >='2024'  ");
//php -> output data from mysqli

while($output_query = sqlsrv_fetch_array($first_query)){

$rows  ='<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["id"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["username"].'</td>';
 if(($output_query["attach_image"] !== "uploads/") && ($output_query["attach_image"] !== "null") && ($output_query["attach"] !== "uploads/") && ($output_query["attach"] !== " ") && ($output_query["type"] == "Sick Leave"  || $output_query["type"] == "Compassionate Leave"  || 
    $output_query["type"] == "Maternity Leave" || $output_query["type"] == "Paternity Leave")){
$rows .='<td  class="pt-3-half" ><a href='.$output_query["attach"].' ll><samp style="float:right;font-size:15px;"><i class="fas fa-paperclip" style="color:red;width:35px;"></samp></i>
</a>'.$output_query["type"].'</td>';}
else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["type"].'</td>';
}
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["adate"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["bdate"]->format('Y-m-d').'</td>';
if($output_query["starttime"] == NULL){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';

}else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["starttime"]->format('H:i:s').'</td>';
}

if($output_query["starttime"] == NULL){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
}else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["endtime"]->format('H:i:s').'</td>';
}
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["notes"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["count"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["status"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;color:green;">'.$output_query["admin_approve"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;color:green;">'.$output_query["approved_by"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;color:red;">'.$output_query["rejected_by"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;color:red;">'.$output_query["admin_reject"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["wfm_note"].'</td>';
  $rows.="</tr>";
  echo $rows;
}
?>
</tbody>
</table>
</div>
<?php }
?>
<?php if(($_SESSION['role_id'] == 2) || ($_SESSION['role_id'] == 3) ) {
    ?>
  <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >All history leaves seniors
      <a href="allstatus2.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;"></p></samp>
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
        <th >ID</th>
        <th >Username</th>
        <th >Type</th>
        <th >From Date</th>
        <th >To Date</th>
        <th >From Time</th>
        <th >To Time</th>
        <th >Notes</th>
        <th >Count</th>
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

$first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE engineer_id ='$engineer_id' and year(adate) >='$curr_year' ");

while( $output_query = sqlsrv_fetch_array($first_query)){

$rows ="<tr>";
$rows .='<td style="border: 1px solid lightgray;">'.$output_query["id"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["username"].'</td>';
  if(($output_query["attach_image"] !== "uploads/") && ($output_query["attach_image"] !== "null") && ($output_query["attach"] !== "uploads/") && ($output_query["attach"] !== " ") && ($output_query["type"] == "Sick Leave"  || $output_query["type"] == "Compassionate Leave"  || 
    $output_query["type"] == "Maternity Leave" || $output_query["type"] == "Paternity Leave")){
$rows .= '<td  class="hovers" style="border: 1px solid lightgray;"><a href='.$output_query["attach_image"].' download><samp style="float:right;font-size:15px;"><i class="fas fa-paperclip" style="color:red;width:35px;"></samp></i>
</a>'.$output_query["type"].'</td>';}

 else{
$rows.='<td class="hovers"style="border: 1px solid lightgray;">'.$output_query["type"].'</td>';
}
$rows.='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["adate"]->format('Y-m-d').'</td>';
$rows.='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["bdate"]->format('Y-m-d').'</td>';
$rows.='<td class="hovers" style="border: 1px solid lightgray;color:blue;">'.$output_query["starttime"]->format('H:i:s').'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;color:blue;">'.$output_query["endtime"]->format('H:i:s').'</td>';
$rows.='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["notes"].'</td>';
$rows.='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["count"].'</td>';
$rows.='<td class="hovers" style="border: 1px solid lightgray;color:green;">'.$output_query["status"].'</td>';

$rows .=  '</tr>';
echo $rows;
}
}
 
?>

</tbody>
</table>
</div>
<?php //}
?>
</div>

<script src="js/table2excel.js" type="text/javascript"></script>
 <script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>