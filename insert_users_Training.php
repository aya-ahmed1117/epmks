

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php 
require_once("inc/config.inc");
	
   if(isset($_POST['ID'])){$ID = $_POST['ID'];}
   if(isset($_POST['EMP_NAME'])){$EMP_NAME = $_POST['EMP_NAME'];}
   if(isset($_POST['Username'])){$Username = $_POST['Username'];}
   if(isset($_POST['National_ID'])){$National_ID = $_POST['National_ID'];}
   if(isset($_POST['Mobile'])){$Mobile = $_POST['Mobile'];}
   if(isset($_POST['date_time'])){$ENTRY_DATE = $_POST['date_time'];}
	// if(!empty($date_time)){
	//INSERT
      $s_username = $_SESSION['username'];
      $sqltime = date ("Y-m-d H:i:s");
    $per_tech = sqlsrv_query($con,"INSERT INTO [Employess_DB].[dbo].[Training]
            ([ID]
            ,[EMP_NAME]
            ,[Username]
            ,[National ID]
            ,[Mobile]
            ,[ENTRY DATE]
            ,[Status]
            ,[creation_time]
            ,[creator_name]
            ,[added_from])
     VALUES
            ('$ID'
            ,'$EMP_NAME'
            ,'$Username'
            ,'$National_ID'
            ,'$Mobile'
            ,'$ENTRY_DATE'
            ,'manual_add'
            ,'$sqltime'
            ,'$s_username'
            ,'add_user_web')");
   

    


 // }
