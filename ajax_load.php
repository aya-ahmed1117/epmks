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
		$insert_query = "INSERT INTO in_and_out ([username], [engineer_id], [cur_date], [type], [atime] , [user_ip] ) VALUES ('$s_username', '$engineer_id', '$date','$type','$atime','$ip')";//);
	}
	echo '<div class="tableFixHead" >

 <table style="border-radius: 30px 30px 0 0;">
  
    <thead>
          <th style="color:#fff;">Type</th>
          <th style="color:#fff;"> Day</th>
          <th style="color:#fff;">Time </th>
        
</thead>
</table>
<table style="border-radius:  0 0 30px 30px;" >
<tbody>';
	
	$first_query = sqlsrv_query( $con ,"SELECT top 20 * FROM in_and_out WHERE  [engineer_id] = '$engineer_id' or username ='$s_username'  order by 4 DESC ,5 desc ");
  while( $output_query2 = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .='<td >'.$output_query2["type"].'</td>';
$rows .='<td >'.$output_query2["cur_date"]->format('Y-m-d').'</td>';
$rows .='<td >'.$output_query2["atime"]->format('H:i:s').'</td>';
$rows .='</tr>';
echo $rows;

}
'</tbody>
</table>';
/*if($type == 'in'){
		echo '<script>
		swal({
		title: "Welcome ...:)",
  icon: "success",

     //swal({"You are in", "success") warning;
  })
     </script>';

	}


if($type == 'out'){
		echo '<script>
     /swal("Good by","success");*
     swal({
		title: "Good bye",
  icon: "success",
  img:"images/logo_we.jpg",
  })

     </script>';

	}*/

	?>
	<!--script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script-->
	<script type="text/javascript">
    $('table tr td').hover(function() {
    $('table th td ').eq($(this).index()).add(this).toggleClass('hover');
    /*$('table th').eq($(this).index()).add(this).toggleClass('hover2');*/

});
    
  </script>
