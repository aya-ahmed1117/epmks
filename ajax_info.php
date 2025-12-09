
<?php 
	require_once("inc/config.inc");

if(isset($_POST['ID'])){$ID = $_POST['ID'];}
if(isset($_POST['Mobile_Number'])){$Mobile_Number = $_POST['Mobile_Number'];}
if(isset($_POST['Mobile_2'])){$Mobile_2 = $_POST['Mobile_2'];}

if(isset($_POST['Avaya_Login'])){$Avaya_Login = $_POST['Avaya_Login'];}



$s_username = $_SESSION['username'];
$sqltime = date ("Y-m-d H:i:s");
 //sqlsrv_query( $con, 
$update_query =sqlsrv_query( $con,"UPDATE [Employess_DB].[dbo].[tbl_Personal_info] 
  SET [Mobile_Number] = '$Mobile_Number',
 [Mobile_2] = '$Mobile_2',
 [update_by] = '$s_username',
 [update_time] = '$sqltime'
 WHERE ID = '$ID' and UserName = '$s_username'");

if($update_query){
  echo '<script>
    swal({
    title: "Done 1",
    icon: "success",
    })
     </script>
     <!--meta http-equiv="refresh" content="1" -->
     ';}
$update_query2 =sqlsrv_query( $con,"UPDATE [Employess_DB].[dbo].[Tbl_Computers]
  SET [Avaya_Login] = '$Avaya_Login',
 [update_by] = '$s_username',
 [update_time] = '$sqltime'
 WHERE ID = '$ID' and [DomainUserName] = '$s_username'

 update [Aya_Web_APP].[dbo].[Avaya_LoginID_username]
 set [LoginID]  = '$Avaya_Login',
 [update_by] = '$s_username',
 [update_time] = '$sqltime'
 where [username]='$s_username'");

     if($update_query2){
  echo '<script>
    swal({
    title: "Done 2",
  icon: "success",
  })
     </script>
     <script>
       setTimeout(function(){
           window.location.href=window.location.href // then reload the page.(3)
      }, 2000);
      </script>';}




 //     $update_query3 =sqlsrv_query($con,"UPDATE [Aya_Web_APP].[dbo].[Avaya_LoginID_username]
 //  SET [LoginID] = '$LoginID'
 // WHERE LoginID = '$ID' and username = '$s_username'");

 //     if($update_query3){
 //  echo '<script>
 //    swal({
 //    title: "Done 3",
 //  icon: "success",
 //  })
 //     </script>
 //     ';}



?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
