<?php

include ("pages.php");
 ?>
<title>Employee Database</title>
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
  Employee_Status <> 'Resigned' 
    ", $params, $options );

$row_count = sqlsrv_num_rows( $stmt );
$row_count ==1;
$params2 = array();
$options2 =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$stmt2 = sqlsrv_query( $con1," SELECT * FROM [Employess_DB].[dbo].[tbl_Personal_info] where Employee_Type = 'OutSource' and   Employee_Status <> 'Resigned' 

 ", $params2, $options2 );

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
<th >Employee_Type</th>
<th>Manager_Name</th>
<th>Hiring_Date</th>
<th >Operation_date</th>
<th > UserName</th>
<th >Mobile_Number</th>
<th >Gender</th>
<th>Grade</th>
<th>Employee_Status</th>
<th>Department</th>
<th>Unit</th>
<th>Group</th>
<th>Sub Group</th>
</tr>
   </thead>
<tbody>

<?php 

$check_engineers2 = sqlsrv_query( $con1 ,"SELECT [tbl_Personal_info].[ID]
      ,[Employee_Type]
      ,[Manager_Name]
      ,[Manager_Name_L7]
      ,[Manager_Name_L6]
      ,[Hiring_Date]
      ,[Operation_date]
      ,[UserName]
      ,[Mobile_Number]
      ,[Gender]
      ,[Grade]
      ,[Employee_Status]
      ,[Tbl_departments].[Department]
      ,[Units]
      ,iif([Groups] is null,'',[Groups]) as 'Group'
      ,SubGroups
  FROM [Employess_DB].[dbo].[tbl_Personal_info] left join [dbo].[Tbl_departments] on ([Department_ID]=[tbl_Personal_info].[Department])
  left join [dbo].[Tbl_Units] on ([Units_ID] = Unit)
  left join [dbo].[Tbl_Groups] on ([Group_ID] = [group]) 
  left join [dbo].[Tbl_SubGroups] on ([SubGroup_ID] = [sub_Group]) 
  left join [dbo].[Tbl_manager_structure] on ([Tbl_manager_structure].[ID] = [tbl_Personal_info].[ID])

  where Employee_Status <> 'Resigned'  
  order by 16 ");
  while( $output_query = sqlsrv_fetch_array($check_engineers2)){
$rows ="<tr>";
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["ID"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Employee_Type"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Manager_Name"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Hiring_Date"]->format('Y-m-d').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Operation_date"]->format("Y-m-d").'</td>';//date ("Y-m-d H:i:s")
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["UserName"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Mobile_Number"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Gender"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Grade"].'</td>';
if($output_query["Employee_Status"] == 'Maternity')
  {
$rows .= '<td class="hovers" style="border: 1px solid lightgray;background-color:#fef963;">'.$output_query["Employee_Status"].'</td>';
  } 
if($output_query["Employee_Status"] == 'active' || $output_query["Employee_Status"] == 'Active' )
  {
    $rows .= '<td class="hovers" style="border: 1px solid lightgray;background-color:#A0DAA9;">'.$output_query["Employee_Status"].'</td>';
  }
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Department"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Units"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Group"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["SubGroups"].'</td>';

$rows .=  '</tr>';
echo $rows;
}
}
?>


</tbody>
</table>
 <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Personal_info.xls"
            });
        }
    </script>

</div>
</div>
    <script src="js/table2excel.js" type="text/javascript">
</script>

<?php
 include ("footer.html");
 ?>
