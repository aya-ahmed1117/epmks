


<?php 
	require_once("inc/config.inc");

if(isset($_POST['id'])){$id = $_POST['id'];}

$engineer_id = $_SESSION['id'];
$s_username = $_SESSION['username'];
      //$rows = '';
$escaped = $_POST['wfm_note'];
$note = str_replace("'", "`", $escaped);

$first_query = sqlsrv_query( $con ,"SELECT * FROM deduction where id = '$id' ");
  $output_query = sqlsrv_fetch_array($first_query);
 $note2 =$output_query["wfm_note"];
$escaped = $_POST['wfm_note'];
 $wfm_note = str_replace("'", "`", $escaped);
 $sqltime2 = date ("Y-m-d H:i:s");

 $update_query = sqlsrv_query( $con ,"UPDATE deduction SET wfm_note = '$wfm_note'+' _ '+'$note2', [wfm_hold_time] = '$sqltime2' WHERE id = '$id'");

if($update_query){
  echo '<script>
    swal({
    title: " Your note has been delivered :) ",
  icon: "success",
  })
     </script>
     <meta http-equiv="refresh" content="1" >';}


?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
