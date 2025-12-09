
 <?php
 header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
   //set_time_limit(400);
include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      ///////
    $DBhost = "172.29.29.76";
    $DBuser = "Seniors";
    $DBpass = "123456789";
    $DBname = "Employess_DB";
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
 ?>

<title>Quality</title>
<head>
<link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head> 
<style type="text/css">
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
  .zoom:hover{
    transform: scale(1.5);
  }
</style>
<div style="padding:20px;">

 <?php 
  if (isset($_GET['login'])) {
  ?>
<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >login & extension for all enterprise support engineers
      <a href="Quality.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
  
<div class="tableFixHead">

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
<th><center>ID</center></th>
<th ><center> UserName</center></th>
<th ><center> Units</center></th>
<th><center>Groups</center></th>
<th><center>Avaya_Login</center></th>
<th><center>Avaya_Extention</center></th>
    </tr>
    </thead>
  <tbody>

<?php 
// Quality Tools
     $distinct = sqlsrv_query($con1,"SELECT  [Tbl_Computers].[ID]
,UserName
,Units,[Groups],[Avaya_Login]
      ,[Avaya_Extention]
   
  FROM [Employess_DB].[dbo].[Tbl_Computers]
  left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].id = [Tbl_Computers].id
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
   left join Employess_DB.dbo.Tbl_Units on Tbl_Units.Units_ID = unit
   where Unit in (12,14,15) and grade = 'L8'
   order by 3,4 ");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["ID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["UserName"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Units"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Groups"].'</td>';
  if($output["Avaya_Login"] == 0){
    $rows .='<td style="border: 1px solid #000000;background-color:tomato;color:white;">No Avaya Found</td>';
  
  }else{
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Avaya_Login"].'</td>';}
  if(($output["Avaya_Extention"] == 0) || ($output["Avaya_Extention"] == NULL) ){
    $rows .='<td style="border: 1px solid #000000;background-color:tomato;color:white;">No Extention Found</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Avaya_Extention"].'</td>';}
$rows .='</tr>';
echo $rows;
  }

  ?>

  <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Avaya_Login.xls"
            });
        }
    </script>

</tbody>
</table>
</div>

<?php 
}
?>
  <?php 
  //////////////2
  if (isset($_GET['PSCPSD'])) {
  ?>
<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >PSC & PSD accounts for SD and onsite team members
      <a href="Quality.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
 
<div class="tableFixHead">

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
<th><center>ID</center></th>
<th><center> Employee_Name</center></th>
<th><center> userName</center></th>
<th><center>Employee_Type</center></th>
<th><center>sys</center></th>
    </tr>
    </thead>
  <tbody>

<?php

   $distinct = sqlsrv_query($con1,"
    SELECT  [ID]
    ,[Employee_Name]
    ,[userName]
        ,[Employee_Type]
        ,case
         when unit =12 then 'psc'
         else 'psd'end  [sys]
      FROM [Employess_DB].[dbo].[tbl_Personal_info]
      where Unit in (12,14,15)and Employee_Status<> 'resigned'and Grade='L8'
 ");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["ID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Employee_Name"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["userName"].'</td>';
  $rows .='<td style="font-size:15px;border: 1px solid #000000;">'.$output["Employee_Type"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["sys"].'</td>';
$rows .='</tr>';
echo $rows;
}
  ?>

  <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "PSC&PSD.xls"
            });
        }
    </script>


</tbody>
</table>
</div>

<?php 
}
  //////////////2
?>

<?php 
////////////////3
  if (isset($_GET['Resi'])) {
  ?>
 <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Employee Resignation
      <a href="Quality.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
   
<div class="tableFixHead">

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
<th ><center> Employee_ID </center></th>
<th ><center> User_Name</center></th>
<th ><center>Last_working_day </center></th>
<th ><center>Employee_Type</center></th>
<th><center>Employee_Manager</center></th> 
<th><center>unit</center></th>
    </tr>
    </thead>
  <tbody>

<?php

   $distinct = sqlsrv_query($con1,"
SELECT [Employee_ID]
      ,[User_Name]
      ,cast([Last_working_day] as date) [Last_working_day]
   
      ,[Employee_Type]
      ,[Employee_Manager]      ,case
      when [unit] = '12' then 'Enterprise Service Desk'
     when [unit] =  '15' then 'Problem Management and Service Optimization'
     when [unit] = '14' then 'Onsite Problem Management'
     else unit
     end [unit]
  from [Employess_DB].[dbo].[Resignation_Table]
  where [Status] = 'Confirmed' and unit in ('Problem Management and Service Optimization','Enterprise Service Desk','Onsite Problem Management','12','14','15')
  order by 3 desc
 ");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Employee_ID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["User_Name"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Last_working_day"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Employee_Type"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Employee_Manager"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["unit"].'</td>';
$rows .='</tr>';
echo $rows;
}
  ?>

  <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Resignation_Table.xls"
            });
        }
    </script>

</tbody>
</table>
</div>

<?php 
}
//////////////3
?>

<?php 
////////////////4
  if (isset($_GET['Outsource_Staff'])) {
  ?>
  <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Employee Transfer Outsource to Staff
      <a href="Quality.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
<th><center>Outsource_ID</center></th>
<th><center> Old_username</center></th>
<th><center>Effectivity_date </center></th>
<th><center> Employee_ID </center></th>
<th><center>New_username</center></th>
<th><center>units</center></th> 
<th><center>groups</center></th>

    </tr>
    </thead>
  <tbody>

<?php
   $distinct = sqlsrv_query($con1,"SELECT [Outsource_ID] 
      ,[Outsource_Staff].[Username] [Old_username]
      ,cast([Effectivity_date] as date)  [Effectivity_date]
      ,[Employee_ID]
      ,[New_username]
      ,units
      ,groups
  FROM [Employess_DB].[dbo].[Outsource_Staff]
   left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].id = [Outsource_Staff].employee_id
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
   left join Employess_DB.dbo.Tbl_Units on Tbl_Units.Units_ID = unit
   where unit in (12,14,15)
   order by 3 desc ");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Outsource_ID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Old_username"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Effectivity_date"]->format('Y/m/d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Employee_ID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["New_username"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["units"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["groups"].'</td>';

$rows .='</tr>';
echo $rows;
}
  ?>

  <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Outsource_Staff.xls"
            });
        }
    </script>


</tbody>
</table>
</div>

<?php 
}
//////////////4  Outsource_Staff
?>

<?php 
////////////////5
  if (isset($_GET['groups'])) {
  ?>
 <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Headcount For Quality
      <a href="Quality.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>    
 
<div class="tableFixHead">

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
<th ><center>Units</center></th>
<th ><center> Groups</center></th>
<th ><center>L8</center></th>
<th ><center> L7 </center></th>
<th ><center>L6</center></th>
<th ><center>L5</center></th> 
<th ><center>L4</center></th>
    </tr>
    </thead>
  <tbody>

<?php

   $distinct = sqlsrv_query($con1,"
    with x as (select * from (
SELECT [ID]
,Units
,[groups]
,Grade
   
  FROM [Employess_DB].[dbo].[tbl_Personal_info]
 
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
   left join Employess_DB.dbo.Tbl_Units on Tbl_Units.Units_ID = unit
   where unit in (12,14,15) and Employee_Status <> 'Resigned'
   ) t

   
PIVOT(
    COUNT(ID) 
    FOR Grade IN (
        [L8], 
        [L7],
        [L6],
        [L5],
        [L4])
) AS pivot_table)


select * from x
order by 1,2 ");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Units"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["groups"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["L8"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["L7"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["L6"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["L5"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["L4"].'</td>';
$rows .='</tr>';
echo $rows;
}
  ?>

  <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "headcount.xls"
            });
        }
    </script>


</tbody>
</table>
</div>

<?php 
}
//////////////5 headcount
?>

<?php 
////////////////6 structure
  if (isset($_GET['structure'])) {
  ?>
 <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Employee Structure
      <a href="Quality.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
    

<div class="tableFixHead">

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
<th class="column1"><center>
 id   
</center></th>
<th class="column1"><center> username
</center></th>
<th class="column1">
    <center>Grade </center></th>

<th class="column1"><center>
 Employee_Type   
</center></th>
<th class="column1">  <center>senior</center></th>
<th class="column1"><center>super</center></th> 
<th class="column1"><center>section</center></th>
<th class="column1"><center>unitmanager</center></th>
<th class="column1"><center>Unit_Name</center></th>
<th class="column1"><center>Employee_Status</center></th>
<th class="column1"><center>Database_Manager</center></th>
    </tr>
    </thead>
  <tbody>

<?php

   $distinct = sqlsrv_query($con1,"WITH tbl1
AS (
    SELECT a.[id]
        ,a.[username]
        ,a.role_id
        ,b.username senior
        ,a.[super_id]
        ,a.[section_id]
        ,a.[UnitManager_id]
        ,a.[Unit_Name]
        ,a.[username_id]
    FROM [Aya_Web_APP].[dbo].[employee] a
    JOIN [Aya_Web_APP].[dbo].[employee] b ON a.manager_id = b.id
    )
    ,tbl2
AS (
    SELECT a.[id]
        ,a.[username]
        ,b.username [super]
    FROM [Aya_Web_APP].[dbo].[employee] a
    JOIN [Aya_Web_APP].[dbo].[employee] b ON a.[super_id] = b.id
    )
    ,tbl3
AS (
    SELECT a.[id]
        ,a.[username]
        ,b.username [section]
    FROM [Aya_Web_APP].[dbo].[employee] a
    JOIN [Aya_Web_APP].[dbo].[employee] b ON a.[section_id] = b.id
    )
    ,tbl4
AS (
    SELECT a.[id]
        ,a.[username]
        ,b.username [unitmanager]
    FROM [Aya_Web_APP].[dbo].[employee] a
    JOIN [Aya_Web_APP].[dbo].[employee] b ON a.[UnitManager_id] = b.id
    )
SELECT 
[tbl_Personal_info].id
    ,tbl1.[username]
    ,iif(role_id=0,'L8',iif(role_id=2,'L7',iif(role_id=3,'L6',iif(role_id=4,'L5',iif(role_id=5,'L4',''))))) Grade
    --,iif(len([username_id]) > 4, 'Outsource', 'Staff') Employee_Status
    ,Employee_Type
    ,senior
    ,super
    ,section
    ,unitmanager
    ,Unit_Name
    ,iif(Employee_Status is null,'Active',Employee_Status) Employee_Status
    ,Manager_Name Database_Manager    
FROM tbl1
LEFT JOIN tbl2 ON tbl1.username = tbl2.username
LEFT JOIN tbl3 ON tbl1.username = tbl3.username
LEFT JOIN tbl4 ON tbl1.username = tbl4.username
LEFT JOIN [Employess_DB].[dbo].[tbl_Personal_info] ON [tbl_Personal_info].[username] = tbl1.[username]
where Unit_Name in ('Onsite Problem Management','Problem Management and Service Optimization','Enterprise Service Desk') and Employee_Status <> 'Resigned'
order by Unit_Name,senior,[username_id] ");
   while ($output = sqlsrv_fetch_array($distinct) ){
        $rows  ='<tr>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["id"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["username"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Grade"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Employee_Type"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["senior"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["super"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["section"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["unitmanager"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Unit_Name"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Employee_Status"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output["Database_Manager"].'</td>';
$rows .='</tr>';
echo $rows;
}
  ?>

  <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "structure.xls"
            });
        }
    </script>


</tbody>
</table>
</div>
<?php 
}
//////////////6
?>

<?php 
////////////////7 Onsite
  if (isset($_GET['Onsite'])) {
  ?>
  
 <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" > Onsite teams monthly schedules
      <a href="Quality.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
   

<div class="tableFixHead">

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
    <th class="column1">username</th>
    <th class="column1">Date</th>
    <th class="column1"> month</th>
    <th class="column1"><center>Shift Start</center></th>
    <th class="column1"><center>Shift End</center></th>
    <th class="column1">Units</th>
    <th class="column1">groups</th>
   

    </tr>
</thead>
  <tbody>

<?php

   $distinct = sqlsrv_query($con1,"SELECT
      schedule_table.[username]
      ,[schedule_table].[schedule_date]
      ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
    when [shift_start] = 'OFF' then 'OFF'
     when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
    when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
    else LEFT([shift_start], 2)

    end as nvarchar) [Start_Shift]
            ,cast(case
    when [shift_end] = 'OFF' then 'OFF'
     when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
    when  SUBSTRING([shift_end], 2, 1) = ':' then LEFT([shift_end], 1)
    else LEFT([shift_end], 2)

    end as nvarchar) [shift_end]
    ,Units
    ,[groups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date    
      ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
  left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join Employess_DB.dbo.Tbl_Units on Tbl_Units.Units_ID = unit
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where year([schedule_table].[schedule_date]) = year(getdate()) and month([schedule_table].[schedule_date]) >= month(getdate()) -1  and  Unit in (14) order by 1,2
");
   while ($output_query2 = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["username"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["schedule_date"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["month"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["Start_Shift"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["shift_end"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["Units"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["groups"].'</td>';

$rows .='</tr>';
echo $rows;
}
  ?>



</tbody>
</table>
</div>
<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Onsite.xls"
            });
        }
    </script>
<?php 
}
//////////////7
?>


<?php 
////////////////8 SD schedule 
  if (isset($_GET['SDschedule'])) {
  ?>
 <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >SD teams monthly schedules
      <a href="Quality.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>  

<div class="tableFixHead">

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
    <th class="column1">username</th>
    <th class="column1">schedule_date</th>
    <th class="column1">month </th>
    <th class="column1">Start Shift</th>
    <th class="column1">shift end</th>
    <th class="column1">Units</th>
    <th class="column1">Groups</th>
    <th class="column1">Sub Groups</th>
    </tr>
</thead>
  <tbody>

<?php

   $distinct = sqlsrv_query($con1,"SELECT
      schedule_table.[username]
      ,[schedule_table].[schedule_date]
      ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
    when [shift_start] = 'OFF' then 'OFF'
     when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
    when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
    else LEFT([shift_start], 2)

    end as nvarchar) [Start_Shift]
            ,cast(case
    when [shift_end] = 'OFF' then 'OFF'
     when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
    when  SUBSTRING([shift_end], 2, 1) = ':' then LEFT([shift_end], 1)
    else LEFT([shift_end], 2)

    end as nvarchar) [shift_end]
    ,Units
    ,[groups]
    ,[SubGroups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date    
      ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
  left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join Employess_DB.dbo.Tbl_Units on Tbl_Units.Units_ID = unit
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  left join [Employess_DB].[dbo].[Tbl_SubGroups] on [Employess_DB].[dbo].[Tbl_SubGroups].[SubGroup_ID] = [sub_Group]  
  where year([schedule_table].[schedule_date]) = year(getdate()) and month([schedule_table].[schedule_date]) >= month(getdate()) - 1 and  Unit in (12) order by 1 , 2
");
   while ($output_query2 = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["username"].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["schedule_date"]->format('Y-m-d').'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["month"].'</td>';
    $rows .= '<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["Start_Shift"].'</td>';
    $rows .= '<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["shift_end"].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["Units"].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["groups"].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["SubGroups"].'</td>';
    $rows .='</tr>';
echo $rows;
}
  ?>

  <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "SDschedule.xls"
            });
        }
    </script>


</tbody>
</table>
</div>
</div>
<?php 
}
//////////////7
?>


<?php 
////////////////9 Problem managment schedule 
  if (isset($_GET['ProblemM'])) {
  ?>
 <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Problem Management and Service Optimization
      <a href="Quality.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
    
 
<div class="tableFixHead">

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
    <th class="column1">username</th>
    <th class="column1">schedule_date</th>
    <th class="column1">month </th>
    <th class="column1">Start Shift</th>
    <th class="column1">shift end</th>
    <th class="column1">Units</th>
    <th class="column1">groups</th>
    
    </tr>
</thead>
  <tbody>

<?php

   $distinct = sqlsrv_query($con1,"SELECT
      schedule_table.[username]
      ,[schedule_table].[schedule_date]
      ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
    when [shift_start] = 'OFF' then 'OFF'
     when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
    when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
    else LEFT([shift_start], 2)

    end as nvarchar) [Start_Shift]
            ,cast(case
    when [shift_end] = 'OFF' then 'OFF'
     when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
    when  SUBSTRING([shift_end], 2, 1) = ':' then LEFT([shift_end], 1)
    else LEFT([shift_end], 2)

    end as nvarchar) [shift_end]
    ,Units
    ,[groups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date    
      ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
  left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join Employess_DB.dbo.Tbl_Units on Tbl_Units.Units_ID = unit
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where year([schedule_table].[schedule_date]) = year(getdate()) 
  and month([schedule_table].[schedule_date]) >= month(getdate()) - 1 and  Unit in (15) order by 1,2
");
   while ($output_query2 = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["username"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["schedule_date"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["month"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["Start_Shift"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["shift_end"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["Units"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$output_query2["groups"].'</td>';


$rows .='</tr>';
echo $rows;
}
  ?>

  <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Problem_Management.xls"
            });
        }
    </script>

</tbody>
</table>
</div>
<?php 
}
//////////////9
?>
  </div>
<script src="js/table2excel.js" type="text/javascript"></script>

<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>



