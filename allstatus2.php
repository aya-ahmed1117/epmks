<?php
include ("pages.php");
?>

  <title>All History</title>
<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='pragma' content='no-cache'>
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head> 
     
<div style="padding: 20px;">
    <?php

$engineer_id = $_SESSION['id'];

if($role_id == 2) {
    ?>
    <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >
                All History
      <a href="allstatus2.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">Leanes / Deductiona / Tasks</p></samp>
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
  <thead >
    <tr>
    <th style="font-weight:bold;font-size: medium;">Engineer Name</th>
    <th style="font-weight:bold;font-size: medium;">leaves status</th>
    <th style="font-weight:bold;font-size: medium;">Deduction status</th>
    <th style="font-weight:bold;font-size: medium;">Tasks status</th>
</tr>
  </thead>
  <tbody>
  <?php
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE manager_id = '$self' ");
while ($output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $rows ="<tr>";
  $rows.="<td style='border: 1px solid lightgray;font-size:18px;font-weight:bold;'>".$output_engineers['username']."</td>";

      $check_orders = sqlsrv_query( $con ,"SELECT * FROM deduction WHERE engineer_id = '$engineers_id'  and [creation_time]>='2024-01-01' ");
          //$orders_num2 = mysqli_num_rows($check_orders);
          $orders_num2 = 1;
    $check_orders = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE engineer_id = '$engineers_id' and [creation_time]>='2024-01-01' ");
         // $orders_num1 = mysqli_num_rows($check_orders);
          $orders_num1 =1;
          $check_orders = sqlsrv_query( $con ,"SELECT * FROM create_task WHERE engineer_id = '$engineers_id' and [cur_date] >='2024-01-01' ");
          $orders_num=1;

  $rows.="<td class='hovers' style='border: 1px solid lightgray;background-color:#55608f;'><a style='color:white;font-size:20px; font-weight:bold;' href='leavesstatus2.php?engineer_id=".$engineers_id."'>Leaves</a></td>";

  $rows.="<td class='hovers' style='border: 1px solid lightgray;background-color:#86558fb8;'><a style='color:black;font-size:20px;color:white;font-weight:bold;' href='deductionstatus2.php?engineer_id=".$engineers_id."'>Deduction</a></td>";

  $rows.="<td class='hovers' style='border: 1px solid lightgray;background-color:#24012ab8;'><a style='color:black;font-size:20px;font-weight:bold;color:white;' href='taskstatus2.php?engineer_id=".$engineers_id."'>Tasks</a></td>";


  $rows.="</tr>";
  echo $rows;

}
}
$engineer_id = $_SESSION['id'];
if($_SESSION['role_id'] == 3){
 ?>
    <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >
                All History
      <a href="allstatus2.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">Leanes / Deductiona / Tasks</p></samp>
    </aside>
  </div>
</center>
<br>
 <h2 style="color:; ">Table 3</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead >
    <tr>
  <th >engineer_Name</th>
  <th >All leaves status</th>
  <th >All Deduction status</th>
  <th>All Tasks status</th>
</tr>
  </thead>
  <tbody>
<?php 
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE super_id = '$self' ");
while ($output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $rows ="<tr>";
  $rows.="<td style='border: 1px solid lightgray;font-size:18px;'>".$output_engineers['username']."</td>";
      $check_orders = sqlsrv_query( $con ,"SELECT * FROM deduction WHERE engineer_id = '$engineers_id'  and [creation_time]>='2023-12-12' ");
          //$orders_num2 = mysqli_num_rows($check_orders);
          $orders_num2 = 1;
    $check_orders = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE engineer_id = '$engineers_id' and [creation_time]>='2023-12-12' ");
         // $orders_num1 = mysqli_num_rows($check_orders);
          $orders_num1 =1;
          $check_orders = sqlsrv_query( $con ,"SELECT * FROM create_task WHERE engineer_id = '$engineers_id'and [cur_date] >='2023-12-12'  ");
          $orders_num=1;

 $rows.="<td class='hovers' style='border: 1px solid lightgray;background-color:#55608f;'><a style='color:white;font-size:20px; font-weight:bold;' href='leavesstatus2.php?engineer_id=".$engineers_id."'>Leaves</a></td>";

  $rows.="<td class='hovers' style='border: 1px solid lightgray;background-color:#86558fb8;'><a style='color:black;font-size:20px;color:white;font-weight:bold;' href='deductionstatus2.php?engineer_id=".$engineers_id."'>Deduction</a></td>";

  $rows.="<td class='hovers' style='border: 1px solid lightgray;background-color:#24012ab8;'><a style='color:black;font-size:20px;font-weight:bold;color:white;' href='taskstatus2.php?engineer_id=".$engineers_id."'>Tasks</a></td>";


  $rows.="</tr>";
  echo $rows;

}

} ?>
</tbody>
</table>
<?php if($role_id == 1){
    ?>

    <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >
                All History
      <a href="allstatus2.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">Leanes / Deductiona / Tasks</p></samp>
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
  <thead >
    <tr>
        <th >Engineer Name</th>
        <th >All leaves status</th>
        <th >All Deduction status </th>
        <th >All Tasks status</th>
        <th >All Swap status</th>
    </tr>
  </thead>
  <tbody>
    <?php

    $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE role_id = 0");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){

  $engineers_id = $output_engineers['id'];

  $rows ="<tr>";
  $rows.= "<td class='hovers' style='border: 1px solid lightgray;' >".$output_engineers['username']."</td>";

   
 $rows.="<td class='hovers' style='border: 1px solid lightgray;background-color:#55608f;'><a style='color:white;font-size:20px; font-weight:bold;' href='leavesstatus2.php?engineer_id=".$engineers_id."'>Leaves</a></td>";

  $rows.="<td class='hovers' style='border: 1px solid lightgray;background-color:#86558fb8;'><a style='color:black;font-size:20px;color:white;font-weight:bold;' href='deductionstatus2.php?engineer_id=".$engineers_id."'>Deduction</a></td>";

  $rows.="<td class='hovers' style='border: 1px solid lightgray;background-color:#24012ab8;'><a style='color:black;font-size:20px;font-weight:bold;color:white;' href='taskstatus2.php?engineer_id=".$engineers_id."'>Tasks</a></td>";

  $rows.="<td class='hovers' style='border: 1px solid lightgray;background-color:#09568d;'><a style='color:white;font-size:13px;' href='Team_Swaps?engineer_id=".$engineers_id."'>Swap</a></td>";


  $rows.="</tr>";
  echo $rows;
}}

?>


  </tbody>
</table>
   
    </div>

</div>
<?php 
include("footer.html");
?>