


<?php
include ("pages.php");
        set_time_limit(650);

?>

	<title>Approve Team Requests</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css"href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fixed_s/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="fixed_s/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="fixed_s/vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" href="fixed_s/css/util.css">
	<link rel="stylesheet" href="fixed_s/css/main.css">

  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head> 
<style type="text/css">
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
      font-size: 10px;
        }
  .zoom:hover{
    transform: scale(1.5);
  }
   td {
  padding:4px;
  font-size: 13px;
  color: black;
}

th {
  text-align: center;
  white-space: nowrap;
  text-overflow: ellipsis;
  font-size: 13px;
  color: #fff;
  line-height: 1.1;
}
 
</style>
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



<form method="post" class="form-horizontal">  
<center>  
<div class="col-md-10">
<br>
	<h2>Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
		 	 <div class="table100 ver1 m-b-110">

	<div class="table100-head" >
		<table >
			<thead >
				<tr class="row100 head" >
<th class="cell100 column1"><center>Username</center></th>
<th class="cell100 column1"><center>Tasks</center></th>
<th class="cell100 column1"><center>LEAVES</center></th>
<th class="cell100 column1"><center>Deductions</th>
  <?php if ($_SESSION['role_id'] >= 2){?>

<th class="cell100 column1"><center>Swap</center></th>
<th class="cell100 column1"><center>On-Call</center></th>   
   <?php } ?>
		</tr>
	</thead>
</table>
</div>
<div class="table100-body js-pscroll" style="text-align:center;">
	<table class="order-table table">
		<tbody>
<?php
if($_SESSION['role_id'] == 1){
//admin can view all engineers ..
$check_engineers = sqlsrv_query( $con ,"SELECT id,role_id,username FROM employee WHERE role_id <>7 ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineer_ids = $output_engineers['id'];
  $eng_username = $output_engineers['username'];


  //tasks
$check_orders = sqlsrv_query( $con ,"SELECT count([s_id]) as create_task FROM create_task WHERE [status] like '%approve%' and [status] <> 'E-workforce and senior approve' and engineer_id 
  ='$engineer_ids' ");
 $output_query = sqlsrv_fetch_array($check_orders);
 $orders_num = $output_query["create_task"];

//leaves
$check_orders = sqlsrv_query( $con ,"SELECT count([id]) as leaves FROM leaves WHERE [status] like '%approve%' and [status] <> 'E-workforce and senior approve' and engineer_id ='$engineer_ids'  ");
  $output_query = sqlsrv_fetch_array($check_orders);
  $orders_num1 = $output_query["leaves"];
//deduction
$check_orders = sqlsrv_query( $con ,"SELECT count([id]) as deduction FROM deduction WHERE [status] like '%approve%' and [status] <> 'E-workforce and senior approve' and engineer_id ='$engineer_ids'  ");
$output_query = sqlsrv_fetch_array($check_orders);
$orders_num2 = $output_query["deduction"];




 if($orders_num > 0 || $orders_num1 > 0 || $orders_num2 > 0)
 {
 $rows ="<tr>";
 $rows.="<td style='border: 1px solid gray;font-size:13px;'>".$output_engineers['username']."</td>";
  //if ($orders_num > 0)
    {$rows.="<td style='border:1px solid gray;background-color:#a2b7be;'><h4 style='color:;'>$orders_num</h4>
  <a style='color:#3b5780;font-size:13px;' href='approve_tasks.php?engineer_id=".$engineers_id."'>
  <img src='images/task-iconpreview.png' style='width:55px;margin-bottom: 1px;'><samp> Task</a></samp></td>";}
  //approve_tasks
    {$rows.="<td style='border:1px solid gray;background-color:#3b5780;'><h4 style='color:lightgray;'>$orders_num1</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='leaves_approval.php?engineer_id=".$engineers_id."'><img src='images/leave-icon-0.jpg'style='width:35px;margin-bottom: 1px;'><samp> Leaves</a></samp></td>";}

    {$rows.="<td style='border:1px solid gray;background-color:#1f4b61'><h4 style='color:lightgray;'>$orders_num2</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='Approve_Deductions.php?engineer_id=".$engineers_id."'>
  <img src='images/deduct.png' style='width:34px;margin-bottom: 1px;'><samp> Deduction</a></samp></td>";}
  $rows.="</tr>";
  echo $rows;}}
}
//senior
if ($_SESSION['role_id'] == 2){

//senior
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE manager_id = '$self' ");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){

  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];
 //DEDuction
$check_orders = sqlsrv_query( $con ,"SELECT * FROM deduction WHERE [engineer_id] = '$engineers_id' and id <> 9954 AND [status] = 'pending'" , array() , array('Scrollable' =>'static'));
$orders_num2 = sqlsrv_num_rows($check_orders);

// leeeeeeeeeavessss
$check_orders = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE [engineer_id] = '$engineers_id' AND 
   id <> 54420 and [status] = 'pending' " , array() , array('Scrollable' =>'static'));
$orders_num1 = sqlsrv_num_rows($check_orders);
 
//taaaaaskssss
$check_orders = sqlsrv_query( $con ,"SELECT * FROM create_task WHERE engineer_id = '$engineers_id' AND status = 'pending' " , array() , array('Scrollable' =>'static') );

$orders_num = sqlsrv_num_rows($check_orders);
$check_orders = sqlsrv_query( $con ,"SELECT * FROM swaping WHERE [engineer_id] = '$engineers_id' AND [status] = 'pending' " , array() , array('Scrollable' =>'static'));
$orders_num0 = sqlsrv_num_rows($check_orders);

//oncall_sd
$check_orders = sqlsrv_query( $con ,"SELECT * FROM oncall_sd WHERE engineer_id = '$engineers_id' AND status = 'pending' " , array() , array('Scrollable' =>'static') );

$orders_num3 = sqlsrv_num_rows($check_orders);  
 if($orders_num > 0 || $orders_num1 > 0 || $orders_num2 > 0 || $orders_num0 > 0 || $orders_num3>0)
 {
 $rows ="<tr>";
  $rows.="<td style='border: 1px solid gray;font-size:13px;'>".$output_engineers['username']."</td>";

  //if ($orders_num > 0)    blaleen.gif
    {$rows.="<td style='border:1px solid gray;background-color:#65a2c3;'><h4 style='color:#f3e5ab;'>$orders_num</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='approve_tasks.php?engineer_id=".$engineers_id."'><img src='images/task-iconpreview.png' style='width:50px;margin-bottom: 1px;'><samp> Task</a></samp></td>";}

  //if ($orders_num1 > 0)
    {$rows.="<td style='border:1px solid gray;background-color:#2569a1;'><h4 style='color:lightgray;'>$orders_num1</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='Approve_Leaves.php?engineer_id=".$engineers_id."'><img src='images/leave-icon-0.jpg' style='width:50px;margin-bottom: 1px;'><samp> Leaves</a></samp></td>";}

  //if ($orders_num2 > 0)
    {$rows.="<td style='border:1px solid gray;background-color:#006699'><h4 style='color:lightgray;'>$orders_num2</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='Approve_Deductions.php?engineer_id=".$engineers_id."'>
  <img src='images/deduct.png' style='width: 50px;margin-bottom: 1px;'><samp> Deduction</a></samp> </td>";}
  // swap

{$rows.="<td style='border:1px solid gray;background-color:#78adc2'><h4 style='color:lightgray;'>
    $orders_num0</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='approve_swap.php?engineer_id=".$engineers_id."'>
  <img src='images/swapinggg.png' style='width:50px;margin-bottom: 1px;'><samp> Swap</a></samp></td>";}

// on call
  {$rows.="<td style='border:1px solid gray;'><h4 style='color:black;'>$orders_num3</h4>
  <a style='color:black;font-size:13px;' href='approve_OnCall.php?engineer_id=".$engineers_id."'>
  <img src='images/callpreview.png' style='width: 30px;margin-bottom: 1px;'><samp> On-Call</a></samp></td>";}


  $rows.="</tr>";
  echo $rows;
}
  
}

}

if($_SESSION['role_id'] == 3){
//Super
$check_engineers5 = sqlsrv_query( $con ,"SELECT * FROM employee WHERE super_id = '$self' ");
//while ($output_engineers = $check_engineers->fetch_array()){
    while( $output_engineers = sqlsrv_fetch_array($check_engineers5)){

  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];
//taaaaaskssss
$check_orders5 = sqlsrv_query( $con ,"SELECT * FROM create_task WHERE engineer_id = '$engineers_id' AND status = 'pending' " , array() , array('Scrollable' =>'static') );

$orders_num5 = sqlsrv_num_rows($check_orders5);

$check_orders5 = sqlsrv_query( $con ,"SELECT * FROM deduction WHERE [engineer_id] = '$engineers_id' and id <> 9954 AND [status] = 'pending'" , array() , array('Scrollable' =>'static'));
$orders_num6 = sqlsrv_num_rows($check_orders5);

// leeeeeeeeeavessss
$check_orders5 = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE [engineer_id] = '$engineers_id' AND [status] = 'pending' " , array() , array('Scrollable' =>'static'));
$orders_num7 = sqlsrv_num_rows($check_orders5);
// Swaaaaaaap
$check_orders = sqlsrv_query( $con ,"SELECT * FROM swaping WHERE [engineer_id] = '$engineers_id' AND [status] = 'pending' " , array() , array('Scrollable' =>'static'));
$orders_num8 = sqlsrv_num_rows($check_orders);
//oncall_sd
$check_orders = sqlsrv_query( $con ,"SELECT * FROM oncall_sd WHERE engineer_id = '$engineers_id' AND status = 'pending' " , array() , array('Scrollable' =>'static') );
$orders_num9 = sqlsrv_num_rows($check_orders);


  if($orders_num5 > 0 || $orders_num6 > 0 || $orders_num7 > 0 || $orders_num8 > 0 || $orders_num9 > 0)
 {
 $rows ="<tr>";
  $rows.="<td style='border: 1px solid gray;font-size:13px;'>".$output_engineers['username']."</td>";

  //if ($orders_num5 > 0)    task
    {$rows.="<td style='border:1px solid gray;background-color:#65a2c3;'><h4 style='color:#f3e5ab;'>
    $orders_num5</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='approve_tasks.php?engineer_id=".$engineers_id."'><img src='images/task-iconpreview.png' style='width:50px;margin-bottom: 1px;'><samp> Task</a></samp></td>";}

  //if ($orders_num1 > 0)
    {$rows.="<td style='border:1px solid gray;background-color:#2569a1;'><h4 style='color:lightgray;'>$orders_num7</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='Approve_Leaves.php?engineer_id=".$engineers_id."'><img src='images/leave-icon-0.jpg' style='width: 50px;margin-bottom: 1px;'><samp> Leaves</a></samp></td>";}

  //if ($orders_num6 > 0)  deduction
    {$rows.="<td style='border:1px solid gray;background-color:#006699'><h4 style='color:lightgray;'>
    $orders_num6</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='Approve_Deductions.php?engineer_id=".$engineers_id."'>
  <img src='images/deduct.png' style='width: 50px;margin-bottom: 1px;'><samp> Deduction</a></samp></td>";}

  {$rows.="<td style='border:1px solid gray;background-color:#66757F'><h4 style='color:lightgray;'>
    $orders_num8</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='approve_swap.php?engineer_id=".$engineers_id."'>
  <img src='images/swapinggg.png' style='width: 50px;margin-bottom: 1px;'><samp> Swap</a></samp></td>";}


// on call
  {$rows.="<td style='border:1px solid gray;'><h4 style='color:black;'>$orders_num9</h4>
  <a style='color:black;font-size:13px;' href='approve_OnCall.php?engineer_id=".$engineers_id."'>
  <img src='images/callpreview.png' style='width:50px;margin-bottom: 1px;'><samp> On-Call</a></samp></td>";}

  $rows.="</tr>";
  echo $rows;
}
  
}

}

$engineer_id = $_SESSION['id'];
if ($_SESSION['role_id'] == 4){
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE section_id = '$self' ");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];
 
//DEDuction
$check_orders = sqlsrv_query( $con ,"SELECT * FROM deduction WHERE [engineer_id] = '$engineers_id' AND [status] = 'pending'" , array() , array('Scrollable' =>'static'));
$orders_num3 = sqlsrv_num_rows($check_orders);
// leeeeeeeeeavessss
$check_orders = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE [engineer_id] = '$engineers_id' AND [status] = 'pending' " , array() , array('Scrollable' =>'static'));
$orders_num1 = sqlsrv_num_rows($check_orders);
//taaaaaskssss
$check_orders = sqlsrv_query( $con ,"SELECT * FROM create_task WHERE engineer_id = '$engineers_id' AND status = 'pending' " , array() , array('Scrollable' =>'static') );
$orders_num = sqlsrv_num_rows($check_orders);
// Swaaaaaaap
$check_orders = sqlsrv_query( $con ,"SELECT * FROM swaping WHERE [engineer_id] = '$engineers_id' AND [status] = 'pending' " , array() , array('Scrollable' =>'static'));
$orders_nums8 = sqlsrv_num_rows($check_orders);

//oncall_sd
$check_orders = sqlsrv_query( $con ,"SELECT * FROM oncall_sd WHERE engineer_id = '$engineers_id' AND status = 'pending' " , array() , array('Scrollable' =>'static') );

$orders_num2 = sqlsrv_num_rows($check_orders);

 if ($orders_num > 0 || $orders_num2 > 0 || $orders_num3 > 0 || $orders_num1 > 0 || $orders_nums8 > 0)
 {
 $rows ="<tr>";
  $rows.="<td style='border: 1px solid gray;font-size:13px;'>".$output_engineers['username']."</td>";

  //if ($orders_num > 0)
    {$rows.="<td style='border:1px solid gray;background-color:#65a2c3;'><h4 style='color:#f3e5ab;'>$orders_num</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='approve_tasks.php?engineer_id=".$engineers_id."'><img src='images/task-iconpreview.png' style='width: 50px;margin-bottom: 1px;'><samp> Task</a></samp></td>";}

  
  //if ($orders_num1 > 0)
    {$rows.="<td style='border:1px solid gray;background-color:#2569a1;'><h4 style='color:lightgray;'>$orders_num1</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='Approve_Leaves.php?engineer_id=".$engineers_id."'><img src='images/leave-icon-0.jpg' style='width:50px;margin-bottom: 1px;'><samp> Leaves</a></samp></td>";}

  //if ($orders_num3 > 0)
    {$rows.="<td style='border:1px solid gray;background-color:#006699'><h4 style='color:lightgray;'>$orders_num3</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='Approve_Deductions.php?engineer_id=".$engineers_id."'>
  <img src='images/deduct.png' style='width: 50px;margin-bottom: 1px;'><samp> Deduction</a></samp></td>";}

  {$rows.="<td style='border:1px solid gray;background-color:#66757F'><h4 style='color:lightgray;'>
    $orders_nums8</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='approve_swap.php?engineer_id=".$engineers_id."'>
  <img src='images/swapinggg.png' style='width: 50px;margin-bottom: 1px;'>
  <samp> Swap</a></samp></td>";}

  //if ($orders_num2 > 0)
    {$rows.="<td style='border:1px solid gray;background-color:#006699'><h4 style='color:lightgray;'>$orders_num2</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='approve_OnCall.php?engineer_id=".$engineers_id."'>
  <img src='images/callpreview.png' style='width: 50px;margin-bottom: 1px;'><samp> On-Call</a></samp></td>";}

  $rows.="</tr>";
  echo $rows;
}
  
}

}
// unit manager 
if ($_SESSION['role_id'] == 5){

//senior
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE UnitManager_id = '$self' ");
//while ($output_engineers = $check_engineers->fetch_array()){
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){

  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];

//taaaaaskssss
$check_orders = sqlsrv_query( $con ,"SELECT * FROM create_task WHERE engineer_id = '$engineers_id' AND status = 'pending' " , array() , array('Scrollable' =>'static') );

$orders_num = sqlsrv_num_rows($check_orders);

//oncall_sd
$check_orders = sqlsrv_query( $con ,"SELECT * FROM oncall_sd WHERE engineer_id = '$engineers_id' AND status = 'pending' " , array() , array('Scrollable' =>'static') );

$orders_num2 = sqlsrv_num_rows($check_orders);

//DEDuction
$check_orders = sqlsrv_query( $con ,"SELECT * FROM deduction WHERE [engineer_id] = '$engineers_id' and id <> 9954 AND [status] = 'pending'" , array() , array('Scrollable' =>'static'));
$orders_num3 = sqlsrv_num_rows($check_orders);
// Swaaaaaaap
$check_orders = sqlsrv_query( $con ,"SELECT * FROM swaping WHERE [engineer_id] = '$engineers_id' AND [status] = 'pending' " , array() , array('Scrollable' =>'static'));
$orders_nums8 = sqlsrv_num_rows($check_orders);

// leeeeeeeeeavessss
$check_orders = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE [engineer_id] = '$engineers_id' AND [status] = 'pending' " , array() , array('Scrollable' =>'static'));
$orders_num1 = sqlsrv_num_rows($check_orders);

 if ($orders_num > 0 || $orders_num2 > 0 || $orders_num3 > 0 || $orders_num1 > 0 || $orders_nums8 > 0)
 {
 $rows ="<tr>";
  $rows.="<td style='border: 1px solid gray;font-size:13px;'>".$output_engineers['username']."</td>";

 // if ($orders_num > 0)
    {$rows.="<td style='border:1px solid gray;background-color:#65a2c3;'><h4 style='color:#f3e5ab;'>$orders_num</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='approve_tasks.php?engineer_id=".$engineers_id."'><img src='images/task-iconpreview.png' style='width:50px;margin-bottom: 1px;'><samp> Task</a></samp></td>";}

  //if ($orders_num1 > 0)
    {$rows.="<td style='border:1px solid gray;background-color:#2569a1;'><h4 style='color:lightgray;'>$orders_num1</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='Approve_Leaves.php?engineer_id=".$engineers_id."'><img src='images/leave-icon-0.jpg' style='width:50px;margin-bottom: 1px;'><samp> Leaves</a></samp></td>";}

  //if ($orders_num2 > 0)
    {$rows.="<td style='border:1px solid gray;background-color:#006699'><h4 style='color:lightgray;'>$orders_num3</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='Approve_Deductions.php?engineer_id=".$engineers_id."'>
  <img src='images/deduct.png' style='width: 50px;margin-bottom: 1px;'><samp> Deduction</a></samp></td>";}

  {$rows.="<td style='border:1px solid gray;background-color:#2c5098'><h4 style='color:lightgray;'>
    $orders_nums8</h4>
  <a style='color:#f3e5ab;font-size:13px;' href='approve_swap.php?engineer_id=".$engineers_id."'>
  <img src='images/swapinggg.png' style='width: 50px;margin-bottom: 1px;'><samp> Swap</a></samp></td>";}

   //if ($orders_num2 > 0){
  {$rows.="<td style='border:1px solid gray;background-color:#2b3873;'><h4 style='color:#f3e5ab;'>$orders_num2</h4>
  <a style='color:#eee;font-size:13px;' href='approve_OnCall.php?engineer_id=".$engineers_id."'><img src='images/callpreview.png' style='width: 50px;margin-bottom: 1px;'><samp> On-Call</a></samp></td>";}
 
  $rows.="</tr>";
  echo $rows;
}
  
}

}
?>

</tbody>
      </table>
    </div>
  </div> 
</center>
</div>
 <script src="table-filter.js"></script>
  <script src="js/table2excel.js" type="text/javascript"></script>
  <script>
    $('.js-pscroll').each(function(){
      var ps = new PerfectScrollbar(this);

      $(window).on('resize', function(){
        ps.update();
      })
    });
      
    
  </script>
 


	<?php

 include ("footer.html");
 ?>