
<?php   
	require_once("inc/config.inc");
  function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
	}
	$s_username = $_SESSION['username'];
	$engineer_id = $_SESSION['id'];

	if(isset($_POST['type'])){$type = $_POST['type'];}
	$date = date('Y-m-d');
	$atime = date('H:i:s');

	$ip = getUserIpAddr();

	if(($_SESSION['username'] === '') || ($_SESSION['id'] === ''))
	{
		echo '<h5 style="color:red; background-color:black; font-size:17px;">error</h5>';
	}else{
		//sqlsrv_query( $con ,
		$insert_query = sqlsrv_query( $con ,"INSERT INTO in_and_out ([username], [engineer_id], [cur_date], [type], [atime] , [user_ip] ) VALUES ('$s_username', '$engineer_id', '$date','$type','$atime','$ip')");
	}
	?>

	<div class="col-md-12" id="logBoard" style="padding:20p;">
 <div class="tableFixHead">
<table class="table order-table"  cellspacing="0" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>  
          <th style="color:#fff;">Type</th>
          <th style="color:#fff;"> Day</th>
          <th style="color:#fff;">Time </th>
        </tr>
</thead>
<tbody>
	<?php
	
	$first_query = sqlsrv_query( $con ,"SELECT top 20 * FROM in_and_out WHERE  [engineer_id] = '$engineer_id' or username ='$s_username'  order by 4 DESC ,5 desc ");
  while( $output_query2 = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output_query2["type"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output_query2["cur_date"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output_query2["atime"]->format('H:i:s').'</td>';
$rows .='</tr>';
echo $rows;
}


	?>
</tbody>
</table>
</div>
</div>