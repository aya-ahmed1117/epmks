
<script type="text/javascript" src="jQuery/sweetalert.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="js/table2excel.js"></script>
<?php
 //include ("pages.php");
require_once("inc/config.inc");

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
      if(isset($_POST['pc_ip'])){$pc_ip = $_POST['pc_ip'];}
      if(isset($_POST['date_shift'])){$date_shift = $_POST['date_shift'];}
      if(isset($_POST['Unit'])){$Unit = $_POST['Unit'];}
      if(isset($_POST['Group_Name'])){$Group_Name = $_POST['Group_Name'];}
      if(isset($_POST['shift_start'])){$shift_start = $_POST['shift_start'];}
            $s_username = $_SESSION['username'];
        $sqltime = date ("Y-m-d H:i:s");
/////  Resignation role
  $error_query = sqlsrv_query( $con1 ,"SELECT ISNULL((SELECT  pc_ip
  FROM [Employess_DB].[dbo].[pop_reserve]
  where pc_ip = '$pc_ip' and [date_shift] = '$date_shift'),'nothing') resultt");
    
      $error=sqlsrv_fetch_array($error_query);
      $error_aya= $error['resultt'];
     
  if($error_aya !='nothing'){

     echo '
     <script>
    swal({
    title: "Data already exists",
  icon: "success",
  });
     </script>';

  }
  if($error_aya == 'nothing'){
 $insert_query = sqlsrv_query( $con1 ,"INSERT INTO [Employess_DB].[dbo].[pop_reserve] 
        ([pc_ip] , [Username] , [Unit] , [Group_Name] ,[shift_start] , [date_shift],[creation_time] ) 
      VALUES ('$pc_ip','$s_username' , (SELECT Units from tbl_Personal_info join Tbl_Units on Unit = Units_ID where UserName='$s_username'),(select groups from tbl_Personal_info join [Tbl_Groups] on Group_ID=[group] where UserName='$s_username' ),(select [shift_start] from [Aya_Web_APP].[dbo].[schedule_table] where UserName='$s_username' and schedule_date='$date_shift'),
      '$date_shift','$sqltime' )");


if($insert_query){
       echo '<script>
    swal({
    title: "Insert Done",
  icon: "success",
  });
     </script>';
     }
 }
  ?>

<script type="text/javascript" src="jQuery/sweetalert.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="js/table2excel.js"></script>