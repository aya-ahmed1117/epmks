
<?php
    require_once("inc/config.inc");

  $check_down = sqlsrv_query( $con ,"with x1 as (SELECT 
   [Tool_name] ,max([Record_time]) max_time
  FROM [Aya_Web_APP].[dbo].[tbl_tool_status]
  group by [Tool_name])
  select 
  x1.Tool_name,Tool_Status ,[tbl_tool_status].Record_time
  from x1
  left join [Aya_Web_APP].[dbo].[tbl_tool_status] on 
  [tbl_tool_status].Tool_name = x1.Tool_name and x1.max_time = [tbl_tool_status].Record_time
  where [Tool_name] = '$Tool_name' ");
    while($get_down = sqlsrv_fetch_array($check_down)){
     echo $Tool_Status=$get_down['Tool_Status'];
     $Tool_Name=$get_down['Tool_name'];
    }


  $s_username = $_SESSION['username'];
  $sqltime = date ("Y-m-d H:i:s"); 
  if(isset($_POST['Tool_name'])){$Tool_name = $_POST['Tool_name'];}
  if(isset($_POST['Tool_Status'])){$Tool_Status = $_POST['Tool_Status'];}
  if(isset($_POST['datetime'])){$datetime = $_POST['datetime'];}

   $yourDate = date('Y-m-d H:i:s', strtotime($datetime));
  

     $insert_query = sqlsrv_query( $con ,"INSERT INTO [tbl_tool_status] 
   ([Username],[Tool_name],[Tool_Status],[Record_time],[auto_date] ) 
  VALUES
   ('$s_username','$Tool_name','$Tool_Status','$yourDate','$sqltime')");  

?>

  <?php
  	/*require_once("inc/config.inc");

  $check_down = sqlsrv_query( $con ,"with x1 as (SELECT 
   [Tool_name] ,max([Record_time]) max_time
  FROM [Aya_Web_APP].[dbo].[tbl_tool_status]
  group by [Tool_name])
  select 
  x1.Tool_name,Tool_Status ,[tbl_tool_status].Record_time
  from x1
  left join [Aya_Web_APP].[dbo].[tbl_tool_status] on 
  [tbl_tool_status].Tool_name = x1.Tool_name and x1.max_time = [tbl_tool_status].Record_time
  where [Tool_name] = '$Tool_name' ");
    while($get_down = sqlsrv_fetch_array($check_down)){
     echo $Tool_Status=$get_down['Tool_Status'];
     $Tool_Name=$get_down['Tool_name'];
    }


  $s_username = $_SESSION['username'];
  $sqltime = date ("Y-m-d H:i:s"); 
  if(isset($_POST['Tool_name'])){$Tool_name = $_POST['Tool_name'];}
  if(isset($_POST['Tool_Status'])){$Tool_Status = $_POST['Tool_Status'];}

     $insert_query = sqlsrv_query( $con ,"INSERT INTO [tbl_tool_status] 
   ([Username],[Tool_name],[Tool_Status],[Record_time] ) 
  VALUES
   ('$s_username','$Tool_name','$Tool_Status','$sqltime')");
  //echo "<meta http-equiv='refresh' content='1'>";
  
*/
?>
