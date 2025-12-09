 <?php

include ("pages.php");

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
 ?>
<title>Persolan info</title>
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

     <style type="text/css">
   
.tableFixHead         
 { 
    overflow-y: auto; height:500px; overflow-x: auto; 
 }
.tableFixHead thead th 
{ 
    position: sticky; top: 0; 
}
   </style>
<?php if($role_id >= 1){
    ?>
  

    <?php

$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt = sqlsrv_query( $con1," SELECT * FROM [Employess_DB].[dbo].[tbl_Personal_info] where Employee_Type = 'staff'and
 [UserName] in ( select username from [Aya_Web_APP].dbo.employee_web_table where manager = '$self') and  Employee_Status <> 'Resigned' 
    ", $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
$row_count ==1;
$params2 = array();
$options2 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt2 = sqlsrv_query( $con1," SELECT * FROM [Employess_DB].[dbo].[tbl_Personal_info] where Employee_Type = 'OutSource'and
 [UserName] in ( select username from [Aya_Web_APP].dbo.employee_web_table where manager = '$self') ", $params2, $options2 );

$row_count2 = sqlsrv_num_rows( $stmt2 );
   $row_count2 ==1;

' <div class="headerhome col-md-9">
    <h2 style="float: left;line-height: 10%;" >Staff Members :'.$row_count.'</h2>
     <h2  style="float: right;line-height: 10%;">OutSource Members :'.$row_count2.'</h2>
   </div>';
 
?>
  <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px; background-color: white;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
                <div class="media-body">
                    <h2 class="text-dark display-12" style="font-family:Century Gothic;" >
                    My Employees Information    </h2>
                  </div>
              </div>
          </div>

   <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       
    <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> 
   </a></p></samp>

           <div class="row form-group">
           <div class="col-md-5"> 
  <h2 style="font-size:20px;text-indent:30px;" >  Staff Members :<?php echo $row_count;?></h2>
</div>
<div class="col-md-6">
     <h2  style="font-size:20px;text-indent:80px;">  OutSource Members :<?php echo $row_count2;?></h2> 
 </div>
 </div>
    </aside>
  </div>
</center>
   <style type="text/css">
     .headerhome{
      transform: translate(270px,20px);
  width:55%;
  color: white;
  background: #524f81;
  text-align: center;
  padding:25px;
  border-radius: 10px 10px 10px 10px;
  border: 10px solid gray;
}
   </style>
  <div style="padding: 20px;">


<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">

<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
 
        <th >ID</th>
<th>Employee_Type</th>
<th>Current_Title</th>
<th>Manager_Name</th>
<th>Hiring_Date</th>
<th>Operation_date</th>
<th>UserName</th>
<th>Mobile_Number</th>
<th>E-mail</th>
<th>Grade</th>
<th>Employee_Status</th>
<th>Department</th>
<th>Unit</th>
<th>Group</th>
<th>Location</th>
<th>Floor</th>
<th>ComputerName</th>
<th>Computer_type</th>
<th>Computer_IP</th>
<th>VPN-IP</th>
<th>Avaya_Extention</th>
<th>Avaya_Soft_hard</th>
<th>Gender</th>
</tr>
   </thead>
<tbody>

<?php
if($self == 806 ){
 $get_epm = sqlsrv_query($con1 ,"SELECT [tbl_Personal_info].[ID]
      ,[tbl_Personal_info].[Employee_Type]
      ,[tbl_Personal_info].[Manager_Name]
      ,[tbl_Personal_info].[Hiring_Date]
      ,[tbl_Personal_info].[Operation_date]
      ,[tbl_Personal_info].[UserName]
      ,[tbl_Personal_info].[Mobile_Number]
      ,[tbl_Personal_info].Current_Title
      ,[tbl_Personal_info].[E-mail]
      ,[tbl_Personal_info].Home_Tel
      ,[tbl_Personal_info].[Grade]
      ,[tbl_Personal_info].[Gender]
      ,[tbl_Personal_info].[Employee_Status]
      ,[Tbl_departments].[Department]
      ,[Units]
      ,iif([Groups] is null,'',[Groups]) as 'Group'
      ,[EDB].[dbo].[Employess_DB].[Location] Location
      ,[EDB].[dbo].[Employess_DB].[Floor] Floor
      ,[EDB].[dbo].[Employess_DB].Education_Qualifications Education_Qualifications
      ,[dbo].[Tbl_Medical].Employee_Medical_ID
      ,[dbo].[Tbl_Computers].ComputerName
      ,[dbo].[Tbl_Computers].Computer_IP
      ,[dbo].[Tbl_Computers].Computer_type
      ,[dbo].[Tbl_Computers].[VPN-IP]
      ,[dbo].[Tbl_Computers].[Avaya_Extention]
      ,[dbo].[Tbl_Computers].[Avaya_Soft_hard] 
  FROM [Employess_DB].[dbo].[tbl_Personal_info] left join [dbo].[Tbl_departments] 
  on ([Department_ID]=[tbl_Personal_info].[Department])
  left join [dbo].[Tbl_Units] on ([Units_ID] = Unit)
  left join [dbo].[Tbl_Groups] on ([Group_ID] = [group]) 
  left join [dbo].[Tbl_manager_structure] on ([Tbl_manager_structure].[ID] =
  [tbl_Personal_info].[ID])
  left join [dbo].[Tbl_Computers] on ([dbo].[Tbl_Computers].ID = [tbl_Personal_info].[ID])
 left join [dbo].[Tbl_Medical] on ([dbo].[Tbl_Medical].ID = [tbl_Personal_info].[ID])
 left join [EDB].[dbo].[Employess_DB] on ([EDB].[dbo].[Employess_DB].ID = [tbl_Personal_info].[ID])
   
 where [dbo].[tbl_Personal_info].Employee_Status <> 'Resigned' and [Group_ID]
 ='1030'  order by 16 ");

      while( $output_q2 = sqlsrv_fetch_array($get_epm)){
$rows ="<tr>";
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["ID"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Employee_Type"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Current_Title"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Manager_Name"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Hiring_Date"]->format('Y-m-d').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Operation_date"]->format("Y-m-d").'</td>';//date ("Y-m-d H:i:s")
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["UserName"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Mobile_Number"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["E-mail"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Grade"].'</td>';
if($output_q2["Employee_Status"] == 'Maternity')
  {
$rows .= '<td class="hovers" style="border: 1px solid lightgray;background-color:#fef963;">'.$output_q2["Employee_Status"].'</td>';
  } 
if($output_q2["Employee_Status"] == 'Active' || $output_q2["Employee_Status"]=='active')
  {
    $rows .= '<td class="hovers" style="border: 1px solid lightgray;background-color:#A0DAA9;">'.$output_q2["Employee_Status"].'</td>';
  }
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Department"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Units"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Group"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Location"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Floor"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["ComputerName"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Computer_type"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Computer_IP"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["VPN-IP"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Avaya_Extention"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Avaya_Soft_hard"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Gender"].'</td>';
$rows .=  '</tr>';
echo $rows;
}
}else{

// $check = sqlsrv_query( $con1 ,"SELECT [Groups],[Units],[UserName]
//   FROM [Employess_DB].[dbo].[tbl_Personal_info] left join [dbo].[Tbl_departments] on ([Department_ID]=[tbl_Personal_info].[Department])
//   left join [dbo].[Tbl_Units] on ([Units_ID] = Unit)
//   left join [dbo].[Tbl_Groups] on ([Group_ID] = [group])");
//  //while( $output_q = sqlsrv_fetch_array($check)){
//     $output_q = sqlsrv_fetch_array($check);
//     $groups=$output_q['Groups'];
//     $units= $output_q['Units'];

// if($groups == 'EPM-Public' && 
//     $units == 'KAM Project Management and Service Delivery'){

// Address
// Home_Tel
// Senior_Promotion
// Supervisor_Promotion
// SectionHead_Promotion
// Year_of_Graduation
// Mobile_2
// Mobile_Allowance

    $get_epm = sqlsrv_query($con1 ,"SELECT [tbl_Personal_info].[ID]
    ,[tbl_Personal_info].[Employee_Name]
    ,[tbl_Personal_info].[Employee_Type]
    ,[tbl_Personal_info].[Manager_Name]
    ,[tbl_Personal_info].[Hiring_Date]
    ,[tbl_Personal_info].[Operation_date]
    ,[tbl_Personal_info].[UserName]
    ,[tbl_Personal_info].[Mobile_Number]
    ,[tbl_Personal_info].Current_Title
    ,[tbl_Personal_info].[E-mail]
    ,[tbl_Personal_info].[Birth_Date]
    ,[tbl_Personal_info].Address
    ,[tbl_Personal_info].Home_Tel
    ,[tbl_Personal_info].[National_ID]
       ,[National_ID_Expiration_date]
    --,[EDB].[dbo].[Employess_DB].National_ID_Expiration_date
    ,[tbl_Personal_info].[Grade]
    ,[tbl_Personal_info].[Gender]
    ,[tbl_Personal_info].[Employee_Status]
    ,[Tbl_departments].[Department]
    ,[Units]
    ,iif([Groups] is null,'',[Groups]) as 'Group'
       ,[Location]
       ,[Floor]
       ,[Education_Qualifications]
    --,[EDB].[dbo].[Employess_DB].[Location] Location
    --,[EDB].[dbo].[Employess_DB].[Floor] Floor
    --,[EDB].[dbo].[Employess_DB].Education_Qualifications Education_Qualifications
    ,[dbo].[Tbl_Medical].Employee_Medical_ID
    ,[dbo].[Tbl_Computers].ComputerName
    ,[dbo].[Tbl_Computers].Computer_IP
    ,[dbo].[Tbl_Computers].Computer_type
    ,[dbo].[Tbl_Computers].[VPN-IP]
    ,[dbo].[Tbl_Computers].[Avaya_Extention]
    ,[dbo].[Tbl_Computers].[Avaya_Soft_hard] 
FROM [Employess_DB].[dbo].[tbl_Personal_info] left join [dbo].[Tbl_departments] 
on ([Department_ID]=[tbl_Personal_info].[Department])
left join [dbo].[Tbl_Units] on ([Units_ID] = Unit)
left join [dbo].[Tbl_Groups] on ([Group_ID] = [group]) 
left join [dbo].[Tbl_manager_structure] on ([Tbl_manager_structure].[ID] =
[tbl_Personal_info].[ID])
left join [dbo].[Tbl_Computers] on ([dbo].[Tbl_Computers].ID = [tbl_Personal_info].[ID])
left join [dbo].[Tbl_Medical] on ([dbo].[Tbl_Medical].ID = [tbl_Personal_info].[ID])
--left join [EDB].[dbo].[Employess_DB] on ([EDB].[dbo].[Employess_DB].ID = [tbl_Personal_info].[ID])
 
where [dbo].[tbl_Personal_info].[UserName] in ( select username from [Aya_Web_APP].dbo.employee_web_table where manager = '$self') and  [dbo].[tbl_Personal_info].Employee_Status <> 'Resigned'  order by 16
");

      while( $output_q2 = sqlsrv_fetch_array($get_epm)){
$rows ="<tr>";
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["ID"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Employee_Type"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Current_Title"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Manager_Name"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Hiring_Date"]->format('Y-m-d').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Operation_date"]->format("Y-m-d").'</td>';//date ("Y-m-d H:i:s")
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["UserName"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Mobile_Number"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["E-mail"].'</td>';

$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Grade"].'</td>';
if($output_q2["Employee_Status"] == 'Maternity')
  {
$rows .= '<td class="hovers" style="border: 1px solid lightgray;background-color:#fef963;">'.$output_q2["Employee_Status"].'</td>';
  } 
if($output_q2["Employee_Status"] == 'Active' || $output_q2["Employee_Status"]=='active')
  {
    $rows .= '<td class="hovers" style="border: 1px solid lightgray;background-color:#A0DAA9;">'.$output_q2["Employee_Status"].'</td>';
  }
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Department"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Units"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Group"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Location"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Floor"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["ComputerName"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Computer_type"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Computer_IP"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["VPN-IP"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Avaya_Extention"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Avaya_Soft_hard"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_q2["Gender"].'</td>';
$rows .=  '</tr>';
echo $rows;



}
}
}
?>


</tbody>
</table>
</div>
</div>
    <script src="js/table2excel.js" type="text/javascript">
</script>
<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Employee_info.xls"
            });
        }
    </script>

<?php
 include ("footer.html");
 ?>
