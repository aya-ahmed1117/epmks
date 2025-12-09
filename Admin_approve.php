


<?php
include ("pages.php");
       // set_time_limit(650);

?>

	<title>Approve Requests</title>
  <head>
    <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head> 

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
          <h2 class="text-dark display-12" >Pending Requests</h2>
          <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
      
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Here you can approve/reject your team Requests</p>
  </aside>
</div>
</center>


<div style="padding:20px;">

<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead" style="overflow-x: hidden;">

<table class="table order-table"  cellspacing="0" id="tblCustomers">
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
<th><center>Username</center></th>
<th><center>Tasks</center></th>
<th><center>LEAVES</center></th>
<th><center>Deductions</th>
		</tr>
	</thead>
		<tbody>
<?php
if($_SESSION['role_id'] == 1){

/*
 $check_engineers = sqlsrv_query( $con ,"SELECT id,username FROM employee ");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineer_ids = $output_engineers['id'];
  $usernamess = $output_engineers['username'];
  //tasks
$check_orders = sqlsrv_query( $con ,"SELECT count([s_id]) as create_task FROM create_task WHERE [status] like '%approve%' and [status] <> 'E-workforce and senior approve' and engineer_id 
  ='$engineer_ids' ");
 $output_query = sqlsrv_fetch_array($check_orders);
 $create_task = $output_query["create_task"];
//leaves
$check_orders = sqlsrv_query( $con ,"SELECT count([id]) as leaves FROM leaves WHERE [status] like '%approve%' and [status] <> 'E-workforce and senior approve' and engineer_id ='$engineer_ids'  ");
  $output_query = sqlsrv_fetch_array($check_orders);
  $leaves = $output_query["leaves"];
//deduction
$check_orders = sqlsrv_query( $con ,"SELECT count([id]) as deduction FROM deduction WHERE [status] like '%approve%' and [status] <> 'E-workforce and senior approve' and engineer_id ='$engineer_ids'  ");

 $output_query = sqlsrv_fetch_array($check_orders);
 $deduction = $output_query["deduction"];*/





$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];
// DEDUCtion
  $check_orders = sqlsrv_query( $con ,"SELECT * FROM deduction WHERE username = '$eng_username' and id <> 9954 AND [status] in 
  ('SENIOR APPROVE','super approve','section approve','Unit Approve','senior approve','On hold') " , array() , array('Scrollable' =>'static'));
$orders_num2 = sqlsrv_num_rows($check_orders);
// TASkssss
$check_orders = sqlsrv_query( $con ,"SELECT * FROM create_task WHERE engineer_id = '$engineers_id' AND status in 
  ('SENIOR APPROVE','super approve','section approve','Unit Approve','senior approve') " , array() , array('Scrollable' =>'static') );
$orders_num = sqlsrv_num_rows($check_orders);
    // LEAvesssss
  $check_orders = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE [engineer_id] = '$engineers_id' AND [status] in 
  ('SENIOR APPROVE','senior approve','super approve','section approve','Unit Approve','On hold') and id <> 54420   " , array() , array('Scrollable' =>'static'));
$orders_num1 = sqlsrv_num_rows($check_orders);

 if($orders_num > 0 || $orders_num1 > 0 || $orders_num2 > 0)
 {
 $rows ="<tr>";
  $rows.="<td style='border: 1px solid gray;font-size:13px;'>".$output_engineers['username']."</td>";
    {$rows.="<td style='border: 2px solid gray;background-color:#a2b7be;'><h4 style='color:;'>$orders_num</h4>
  <a style='color:#3b5780;font-size:13px;' href='approve_tasks.php?engineer_id=".$engineers_id."'>
  <img src='imag/attendance.png' style='margin-bottom: 1rem;width: 35px;margin-bottom: 1px;'><samp>Task</a></samp></td>";}
    {$rows.="<td style='border: 2px solid gray;background-color:#3b5780;'><h4 style='color:lightgray;'>$orders_num1</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='leaves_approval.php?engineer_id=".$engineers_id."'>
  <img src='imag/permission.png'style='margin-bottom: 1rem;width:35px;margin-bottom: 1px;'>Leaves </a></td>";}
    {$rows.="<td style='border: 2px solid gray;background-color:#1f4b61'><h4 style='color:lightgray;'>$orders_num2</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='Approve_Deductions.php?engineer_id=".$engineers_id."'>
  <img src='imag/deductions.png' style='margin-bottom: 1rem;width:34px;margin-bottom: 1px;'>Deduction </a></td>";}
  $rows.="</tr>";
  echo $rows;
}}
}
?>
        </tbody>
      </table>
    </div>
  </div> 
</div>
 <script src="table-filter.js"></script>
  <script src="js/table2excel.js" type="text/javascript"></script>

	<?php

 include ("footer.html");

 ?>