<!DOCTYPE html>
<html>
<head>
  <title>export excel</title>
  <?php   //require_once("inc/config1.inc");
session_start();
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
$DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
    

sqlsrv_query( $con1 , "SET NAMES 'utf8'"); 
sqlsrv_query( $con1 ,'SET CHARACTER SET utf8' );
  ?>
</head>
<body>

<?php
if(isset($_get['export'])){}

 if (($_SESSION['role_id'] == 1) || ($_SESSION['username'] == 'Ahmed.AbdelFattah') ){
echo'

<div  class="table table-striped table-hover" style="overflow:scroll; overflow-y: auto;height:550px;background-color: #eee;width: 120%;">

 <table align="center" class="order-table table" style="color: #702283; border: 5px solid #eee;  flex-wrap: wrap;
  text-transform: uppercase;
  position: relative; 
  font-style: normal; 
  font-family: Century Gothic;
   width: 80%;  grid-template-columns: auto auto auto auto; grid-gap: 15px; " >
    <thead style="background-color: #3b6879; width: 90%; word-wrap: break-word ; border: 3px solid white;color:#fff;font-size:12px;">
 
<th width="1%" style="border:  1px solid #660066;"  class="form-horizontal" >ID</th>
<th style="border:  1px solid #660066;text-align: justify;" class="form-horizontal" >Employee_Name</th>
<th width="1%"  style="border:  1px solid #660066;" class="form-horizontal" >Employee_Type</th>
<th width="1%" style="border:  1px solid #660066;"  class="form-horizontal" >Manager_Name</th>
<th width="1%" style="border:  1px solid #660066;"  class="form-horizontal" >Hiring_Date</th>
<th width="1%"  style="text-align: justify;border:  1px solid #660066;"  class="form-horizontal" >Operation_date</th>
<th width="1%"  style="text-align: justify;border:  1px solid #660066;"  class="form-horizontal" > UserName</th>
<th width="1%"class="form-horizontal" style="border: 1px solid #660066;">Mobile_Number</th>
<th width="1%"class="form-horizontal" style="border: 1px solid #660066;">Address</th>
<th width="1%"class="form-horizontal" style="border: 1px solid #660066;">Full_Address</th>
<th width="1%" style="border:  1px solid #660066;"class="form-horizontal" >E-mail</th>
<th width="1%" style="border:  1px solid #660066;"class="form-horizontal" >Birth_Date</th>
 <th width="1%" style="border: 1px solid #660066;" class="form-horizontal" >National_ID</th>
 <th width="1%" style="border: 1px solid #660066;" class="form-horizontal" >Gender</th>
 <th width="1%" style="border: 1px solid #660066;" class="form-horizontal" >Grade</th>
 <th width="1%" style="border: 1px solid #660066;" class="form-horizontal" >Employee_Status</th>
 <th width="1%" style="border: 1px solid #660066;" class="form-horizontal" >Department</th>
 <th width="1%" style="border: 1px solid #660066;" class="form-horizontal" >Unit</th>
 <th width="1%" style="border: 1px solid #660066;" class="form-horizontal" >Group</th>
   </thead>
<tbody>';}
?>
<?php   

$engineer_id = $_SESSION['id'];

if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];}

$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$out = sqlsrv_query( $con1," SELECT [L4]
      ,[L5]
      ,[L6]
      ,[L7]
      ,[L8_Insource]
      ,[L8_Outsource]
      ,[Units]
      ,[Total]
  FROM [Employess_DB].[dbo].[Total_HC_Per_unit]
  where Units <> 'Enterprise Solutions Planning and Provisioning & ESPT' ", $params, $options );
$output_query = sqlsrv_fetch_array($out);


$check_engineers = sqlsrv_query( $con1 ," SELECT distinct [ID]
      ,[Employee_Name]
      ,[Employee_Type]
      ,[Manager_Name]
      ,[Hiring_Date]
      ,[Operation_date]
      ,[UserName]
      ,[Mobile_Number]
      ,[Address]
      ,[Full_Address]
      ,[E-mail]
      ,[Birth_Date]
      ,[National_ID]
      ,[Gender]
      ,[Grade]
      ,[Employee_Status]
      ,[Tbl_departments].[Department]
      ,[Units]
      ,iif([Groups] is null,'',[Groups]) as 'Group'
  FROM [Employess_DB].[dbo].[tbl_Personal_info] left join [dbo].[Tbl_departments] on ([Department_ID]=[tbl_Personal_info].[Department])
  left join [dbo].[Tbl_Units] on ([Units_ID] = Unit)
  left join [dbo].[Tbl_Groups] on ([Group_ID] = [group]) where Employee_Status = 'Active'  order by 14 ");

 $grade5 = ($check_engineers['Grade'] == 'L5' && $check_engineers['Units'] == 'Enterprise Service Desk' );
  while( $output_query = sqlsrv_fetch_array($check_engineers)){
  
$rows ="<tr>";
$rows .= '<td width="1%" style="border: 1px solid #660066; font-size: 10px;">'.$output_query["ID"].'</td>';
$rows .= '<td width="0" style="border: 1px solid #660066;font-size: 10px;">'.$output_query["Employee_Name"].'</td>';
$rows .='<td width="1%" style="border: 1px solid #660066; font-size: 10px;">'.$output_query["Employee_Type"].'</td>';
$rows .='<td width="1%" style="border: 1px solid #660066; font-size: 10px;">'.$output_query["Manager_Name"].'</td>';
$rows .= '<td width="1%" style="border: 1px solid #660066; font-size: 10px;">'.$output_query["Hiring_Date"]->format('Y-m-d').'</td>';
$rows .= '<td width="1%" style="border: 1px solid #660066; font-size: 10px;text-align: justify;">'.$output_query["Operation_date"]->format("Y-m-d").'</td>';//date ("Y-m-d H:i:s")
$rows .= '<td width="1%" style="border: 1px solid #660066; padding:1px;font-size: 10px;text-align: justify;">'.$output_query["UserName"].'</td>';
$rows .= '<td width="1%" style="border: 1px solid #660066; padding:1px;font-size: 10px;text-align: justify;">'.$output_query["Mobile_Number"].'</td>';
$rows .= '<td width="1%" style="border: 1px solid #660066; padding:1px;font-size: 10px;text-align: justify;">'.$output_query["Address"].'</td>';
$rows .= '<td width="1%" style="border: 1px solid #660066; padding:1px;font-size: 10px;text-align: justify;">'.$output_query["Full_Address"].'</td>';

$rows .= '<td width="1%" style="border: 1px solid #660066; padding:1px;font-size: 10px;">'.$output_query["E-mail"].'</td>';
$rows .=  '<td width="1%" style="border: 1px solid #660066;">'.$output_query["Birth_Date"].'</td>';

$rows .='<td width="1%" style=" border: 1px solid #660066;">'.$output_query["National_ID"].'</td>';
$rows .='<td width="1%" style=" border: 1px solid #660066;">'.$output_query["Gender"].'</td>';
$rows .='<td width="1%" style=" border: 1px solid #660066;">'.$output_query["Grade"].'</td>';
if($output_query["Employee_Status"] == 'Resigned')
  {
$rows .= '<td width="1%" style="border: 1px solid #660066;background-color:#cc0000;color:white;">'.$output_query["Employee_Status"].'</td>';

  } 

if($output_query["Employee_Status"] == 'Active')
  {
    $rows .= '<td width="1%" style="border: 1px solid #660066;background-color:green;color:white;">'.$output_query["Employee_Status"].'</td>';
  }
$rows .='<td width="1%" style=" border: 1px solid #660066;">'.$output_query["Department"].'</td>';
$rows .='<td width="1%" style=" border: 1px solid #660066;">'.$output_query["Units"].'</td>';
$rows .='<td width="1%" style=" border: 1px solid #660066;">'.$output_query["Group"].'</td>';

$rows .=  '</tr>';
echo $rows;

}
//if($output_query["Birth_Date"]= date("Y-m-d") ){
  // ???????}
?>
</body>
</html>