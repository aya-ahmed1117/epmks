
<?php 
	require_once("inc/config.inc");

if(isset($_POST['group_name'])){$group_name = $_POST['group_name'];}
if(isset($_POST['year'])){$year = $_POST['year'];}
if(isset($_POST['month'])){$month = $_POST['month'];}

if(isset($_POST['Performance_enhancement'])){$Performan = $_POST['Performance_enhancement'];}
if(isset($_POST['New_technology_awareness'])){$New_techno = $_POST['New_technology_awareness'];}

if(isset($_POST['ID'])){$ID = $_POST['ID'];}
//
 
$s_username = $_SESSION['username'];
$sqltime = date ("Y-m-d H:i:s");
//updated_P_T
$updated_P_T='';

//
if (isset($Performan)) {
   $updated_P_T ='Performan';
}
if (isset($New_techno)) {
   $updated_P_T ='New_techno';
}
// insert 
  $insertqry = sqlsrv_query( $con , "INSERT INTO 
    [WorkForce_Reporting_DB].[dbo].[Kpi_2023_new_demo]
      SELECT * ,'$s_username','$sqltime' from [WorkForce_Reporting_DB].[dbo].[Kpi_2023_new] WHERE  
      group_name= '$group_name' and year= '$year'  and 
      month= '$month'");
if (isset($Performan)) {

  // new insert
  $per_tech = sqlsrv_query($con,"INSERT INTO 
   [WorkForce_Reporting_DB].[dbo].[Perf_Tech]
            ([Year]
           ,[Month]
           ,[Group_]
           ,[Performance]
           ,[updated_P_T]
           ,[creation_time])
     VALUES
           ('$year'
           ,'$month'
           ,'$group_name'
           ,'$Performan%'
           ,'$updated_P_T'
           ,'$sqltime')");
 }
 // 
if (isset($New_techno)) {
  // New_techno
  $per_tech = sqlsrv_query($con,"INSERT INTO 
   [WorkForce_Reporting_DB].[dbo].[Perf_Tech]
            ([Year]
           ,[Month]
           ,[Group_]
           ,[Technology]
           ,[updated_P_T]
           ,[creation_time])
     VALUES
           ('$year'
           ,'$month'
           ,'$group_name'
           ,'$New_techno%'
           ,'$updated_P_T'
           ,'$sqltime')");
}


  $update_query = "UPDATE TOP (1) 
  [WorkForce_Reporting_DB].[dbo].[Kpi_2023_new] SET ";
if (isset($Performan)) {
    $update_query .= "[Performance_enhancement] = '$Performan%'";
}
if (isset($New_techno)) {
    if (isset($Performan)) {
        $update_query .= ", ";
    }
    $update_query .= "[New_technology_awareness] = 
    '$New_techno%'";
}
$update_query .= " WHERE group_name = '$group_name' AND year = '$year' AND month = '$month'";
sqlsrv_query($con, $update_query);

$stmt = sqlsrv_query($con, "SELECT [Performance_enhancement], [New_technology_awareness], [group_name], [month], [year]    from
  [WorkForce_Reporting_DB].[dbo].[Kpi_2023_new] 
  WHERE group_name = '$group_name' AND year = '$year' AND month = '$month'");
$data = sqlsrv_fetch_array($stmt);
 // $data["group_name"] = str_replace([" ","(",")"], ["_","_","_"], $data["group_name"]);

echo json_encode($data);
 
?>

