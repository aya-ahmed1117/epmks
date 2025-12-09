

<?php
  require_once("inc/config.inc");

  if(isset($_POST['year'])){$year = $_POST['year'];}
  if(isset($_POST['month'])){$month = $_POST['month'];}
  if(isset($_POST['days'])){$days = $_POST['days'];}




/*echo implode("-", array_reverse(explode("/", $var)));

 $old_date = explode('/', $days); 
$new_data = $old_date[1].'-'.$old_date[0].'-'.$old_date[2];

$date = DateTime::createFromFormat('d/m/Y', $days);
echo $date->format('d-m-y'); // => 2013-12-24


$date = str_replace('/', '-', $days);
echo date('d-m-y', strtotime($date));*/


	$engineer_id = $_SESSION['id'];
	$s_username = $_SESSION['username'];
	$type = "ON-Call";
	$status = "pending";
	$escaped = $_POST['note'];
	$notes = str_replace("'", "`", $escaped);
	$sqltime = date ("Y-m-d H:i:s");  
//[creation_time]
  
  $insert_query = sqlsrv_query( $con ,"INSERT INTO oncall_sd 
    ([username],[engineer_id],[type],[days],[month],[year],[status],[note],[creation_time] ) 

    VALUES ('$s_username','$engineer_id','$type','$days','$month','$year','$status' ,'$notes','$sqltime' )");

  
/////// select 
$role_id = $_SESSION['role_id'];
$self = $_SESSION['id'];

$check_orders = sqlsrv_query( $con ,"SELECT top 10 * FROM oncall_sd WHERE engineer_id= '$self' and [creation_time] >='2023-12-01' order by [creation_time] DESC");
while ($output_orders = sqlsrv_fetch_array($check_orders)) {
  $rows ='<tr>';
  $rows.= '<td class="hovers">'.$output_orders['type'].'</td>';
  $rows.= '<td class="hovers" style="color:orange;">'.$output_orders['days'].'</td>';
  $rows.= '<td class="hovers" style="color:orange;">'.$output_orders['month'].'</td>';
  $rows.= '<td class="hovers">'.$output_orders['year'].'</td>';
  $rows.= '<td class="hovers">'.$output_orders['creation_time']->format('Y-m-d H:i:s').'</td>';
  $rows.= '<td class="hovers">'.$output_orders['note'].'</td>';
  $rows.= '<td class="hovers">'.$output_orders['status'].'</td>';
  $rows.='</tr>';
 echo $rows;
}
?>