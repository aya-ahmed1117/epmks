

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php 
require_once("inc/config.inc");
	if(isset($_POST['date_time'])){$date_time = $_POST['date_time'];}
	if(!empty($date_time)){
	//INSERT
      $s_username = $_SESSION['username'];
      $sqltime = date ("Y-m-d H:i:s");
    $per_tech = sqlsrv_query($con,"INSERT INTO 
   [WorkForce_Reporting_DB].[dbo].[missing_data]
            ([date_time]
            ,[creation_time]
            ,[creator_name])
     VALUES
           ('$date_time'
           ,'$sqltime'
           ,'$s_username')");

   //  echo "INSERT INTO 
   // [WorkForce_Reporting_DB].[dbo].[missing_data]
   //          ([date_time]
   //          ,[creation_time]
   //          ,[creator_name])
   //   VALUES
   //         ('$date_time'
   //         ,'$sqltime'
   //         ,'$s_username')";

 }
