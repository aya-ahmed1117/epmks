

<?php   
	require_once("inc/config.inc");
$engineers_id = $_SESSION['id'];
$s_username = $_SESSION['username'];

$status = 'Pending';//Pending
$sqltime = date ("Y-m-d H:i:s");

$swaper_name = isset($_POST['swaper_name']) ? $_POST['swaper_name'] : "";
$mydate = isset($_POST['user_covering_date_from']) ? $_POST['user_covering_date_from'] : "";
$reason = isset($_POST['reason']) ? str_replace("'", "`", $_POST['reason']) : "";
$user_manager = isset($_POST['user_manager']) ? $_POST['user_manager'] : "";
$senior_s = isset($_POST['swaper_manager']) ? $_POST['swaper_manager'] : "";

$swaper_shift_start = isset($_POST['swaper_shift_start']) ? $_POST['swaper_shift_start'] : "";
$swaper_shift_end = isset($_POST['swaper_shift_end']) ? $_POST['swaper_shift_end'] : "";

$user_covering_shift_start = isset($_POST['user_covering_shift_start']) ? $_POST['user_covering_shift_start'] : "";
$user_covering_shift_end = isset($_POST['user_covering_shift_end']) ? $_POST['user_covering_shift_end'] : "";

$engineer_id_swaper = isset($_POST['engineer_id_swaper']) ? $_POST['engineer_id_swaper'] : "";


//sqlsrv_query( $con , 
$insert_query = "INSERT INTO swaping ([username] , [engineer_id] ,[user_covering_date_from] , [user_covering_shift_start] ,
 [user_covering_shift_end],[user_manager],[engineer_id_swaper] , [swaper_name], 
 [swaper_date_from],[swaper_shift_start],[swaper_shift_end],
 [swaper_manager], [reason], [status] ,[creation_time] ) 

 VALUES ('$s_username','$engineers_id','$mydate',
 '$user_covering_shift_start','$user_covering_shift_end','$user_manager',
 '$engineer_id_swaper','$swaper_name',
  '$mydate','$swaper_shift_start','$swaper_shift_end',
  '$senior_s','$reason','$status', '$sqltime')";//);

  echo $insert_query = "INSERT INTO swaping ([username] , [engineer_id] ,[user_covering_date_from] , [user_covering_shift_start] ,
 [user_covering_shift_end],[user_manager],[engineer_id_swaper] , [swaper_name], 
 [swaper_date_from],[swaper_shift_start],[swaper_shift_end],
 [swaper_manager], [reason], [status] ,[creation_time] ) 

 VALUES ('$s_username','$engineers_id','$mydate',
 '$user_covering_shift_start','$user_covering_shift_end','$user_manager',
 '$engineer_id_swaper','$swaper_name',
  '$mydate','$swaper_shift_start','$swaper_shift_end',
  '$senior_s','$reason','$status', '$sqltime')";

  if($insert_query){
    echo "done . inserted";
  }else{
    echo "error . not inserted";
  }
  

	?> 