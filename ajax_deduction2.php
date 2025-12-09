
<?php 
	require_once("inc/config.inc");

if(isset($_POST['id'])){$id = $_POST['id'];}
if(isset($_POST['type'])){$type = $_POST['type'];}
if(isset($_POST['status'])){$status = $_POST['status'];}

$engineer_id = $_SESSION['id'];
$s_username = $_SESSION['username'];
      //$rows = ''; 
$escaped = $_POST['note'];
$note = str_replace("'", "`", $escaped);
$first_query = sqlsrv_query( $con ,"SELECT * FROM deduction where id = '$id' ");
$output_query = sqlsrv_fetch_array($first_query);
$note2 =$output_query["note"];
$status = "pending";
$sqltime = date ("Y-m-d H:i:s");

$update_query =sqlsrv_query( $con, "UPDATE deduction 
  SET [engineer_id] = '$engineer_id',
 [type] = '$type',
 [note] = '$note'+' _ '+'$note2',
 [status] = '$status',
 [creation_time] = '$sqltime'
 WHERE username='$s_username' and id = '$id'");

if($update_query){
  echo '<script>
    swal({
    title: "Done",
  icon: "success",
  })
     </script>
     <meta http-equiv="refresh" content="1" >';}


?>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
