

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php 
require_once("inc/config.inc");
	if(isset($_POST['id'])){$id = $_POST['id'];}


	$s_username = $_SESSION['username'];
	$sqltime = date ("Y-m-d H:i:s");
  $chooseD= sqlsrv_query($con , "SELECT * FROM [WorkForce_Reporting_DB].[dbo].[missing_data]
  where id='$id' order by creation_time DESC ");
        $getData=sqlsrv_fetch_array($chooseD);
          $dateT = $getData['date_time']->format('Y-m-d');
          $dateID = $getData['ID'];
          ?>

 <?php

  $insertqry = sqlsrv_query( $con , "INSERT INTO 
    [WorkForce_Reporting_DB].[dbo].[missing_data_demo]
      SELECT * ,'$s_username','$sqltime'
      from 
      [WorkForce_Reporting_DB].[dbo].[missing_data] 
      WHERE ID = '$dateID'
      and date_time= '$dateT' ");


  
  //delete
    $delete_missing = sqlsrv_query($con , "DELETE 
            from 
      [WorkForce_Reporting_DB].[dbo].[missing_data] 
      where ID = '$id'
      and date_time= '$dateT' ");

    

     ?>