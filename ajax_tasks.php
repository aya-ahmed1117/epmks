 
<?php
  require_once("inc/config.inc");
  if(isset($_POST['stime'])){$stime = $_POST['stime'];}
  if(isset($_POST['etime'])){$etime = $_POST['etime'];}
    if(isset($_POST['cur_date'])){$cur_date = $_POST['cur_date'];}
  if(isset($_POST['type'])){$type = $_POST['type'];}

 $escaped = $_POST['notes'];
 $notes = str_replace("'", "`", $escaped);

  if(isset($_POST['evidence'])){$evidence = $_POST['evidence'];}
  if(isset($_POST['customer_name'])){$customer_name = $_POST['customer_name'];}
  if(isset($_POST['Order_number'])){$Order_number = $_POST['Order_number'];}
$sqltime = date ("Y-m-d H:i:s");
$status = "pending";
 $engineer_id = $_SESSION['id'];
  $s_username = $_SESSION['username'];  
//[creation_time] 
  $insert_query = sqlsrv_query( $con ,"INSERT INTO create_task ([engineer_id], [username], [stime], [etime], 
    [cur_date], [type],[notes], [status], [manager_id], [approved_by] , [creation_time] , [evidence] ,[customer_name], 
    [Order_number] ) 
    VALUES 
    ('$engineer_id', '$s_username', '$stime', '$etime', '$cur_date', '$type', '$notes', '$status' , 
    '0','0','$sqltime','$evidence' ,'$customer_name','$Order_number' )");


$this_year= date('Y');
$check_orders = sqlsrv_query( $con ,"SELECT top 5 * FROM create_task WHERE engineer_id= '$engineer_id'and cur_date >='$this_year'  order by [creation_time] DESC");
while ($output_orders = sqlsrv_fetch_array($check_orders)) {

  $rows ="<tr>";
  $rows.= "<td class='hovers'>".$output_orders['cur_date']->format('Y-m-d')."</td>";
  $rows.= "<td class='hovers'>".$output_orders['stime']->format('H:i:s')."</td>";
  $rows.= "<td class='hovers'>".$output_orders['etime']->format('H:i:s')."</td>";
  $rows.= "<td class='hovers'>".$output_orders['type']."</td>";
  $rows.= "<td class='hovers'>".$output_orders['evidence']."</td>";
  $rows.= "<td class='hovers'>".$output_orders['customer_name']."</td>";
  $rows.= "<td class='hovers'>".$output_orders['Order_number']."</td>";
  $rows.= "<td class='hovers'>".$output_orders['notes']."</td>";
  $rows.="</tr>";
echo $rows;
}
  
?>