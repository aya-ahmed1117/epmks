
<?php
 //session_start(); 
set_time_limit(400);
include ("pages.php");
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkforceDB_indexed";
  
  $connectionInfo = array( "Database"=>"WorkforceDB_indexed" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $connect = sqlsrv_connect($DBhost, $connectionInfo);
    

sqlsrv_query( $connect , "SET NAMES 'utf8'"); 
sqlsrv_query( $connect ,'SET CHARACTER SET utf8' );


        require_once("inc/config.inc");
      ?>
<head>
      <title>Employee Violation</title>
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

<style type="text/css">
  .zoom:hover{
    transform: scale(1.5);
  }
</style>
<div style="padding:20px;">

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Promotion
      <a href="headcount_reports.php">
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
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color:#55608f;border: 1px solid white; ">
    <tr>    

<th ><center>ID</center></th>
<th ><center>USERNAME</center></th>
<th ><center>Employee_Name</center></th>
<th ><center>Hiring_Date</center></th>
<th ><center>Units</center></th>
<th ><center>Grade</center></th>
<th ><center>Senior_Promotion</center></th>
<th ><center>Supervisor_Promotion</center></th>
<th ><center>SectionHead_Promotion</center></th>
<th ><center>UnitManager_Promotion</center></th>
<th ><center>Max_date</center></th>
<th ><center>Experience_years</center></th>
<th ><center>Experience_Months</center></th>
<th ><center>total promotion years</center></th>


		</tr>
		</thead>
	</center>
  <tbody>

<?php

   $new_query = sqlsrv_query($connect ,"SELECT [Tbl_Promotions_duration].[ID]
       ,[tbl_Personal_info].[UserName]
       ,[tbl_Personal_info].[Employee_Name]
       ,[tbl_Personal_info].[Hiring_Date]
       ,[Tbl_Units].[Units]
       ,[tbl_Personal_info].[Grade]
      ,[Senior_Promotion]
      ,[Supervisor_Promotion]
      ,[SectionHead_Promotion]
      ,[UnitManager_Promotion]
      ,[MostRecentDate] [Max_date]

  ,datediff (year, [tbl_Personal_info].[Hiring_Date], getdate()) as [Experience_years] 
  ,datediff (Month, [tbl_Personal_info].[Hiring_Date], getdate()) as [Experience_Months]
  --,DATEPART( 'MONTH',datediff (year, [tbl_Personal_info].[Hiring_Date], getdate())) as [Months]
  ,datediff (year, [MostRecentDate], getdate()) as [total promotion years]
 
  FROM [Employess_DB].[dbo].[Tbl_Promotions_duration]

  left join [Employess_DB].[dbo].[tbl_Personal_info]
    on [tbl_Personal_info].[ID]=[Tbl_Promotions_duration].[ID]
  left join [Employess_DB].[dbo].[Tbl_Units]
     on [Unit]=[Units_ID]


   CROSS APPLY (SELECT MAX(d) MostRecentDate
    FROM (VALUES ([Senior_Promotion]), ([Supervisor_Promotion]), ([SectionHead_Promotion]),([UnitManager_Promotion])) AS a(d)) md
    where
     unit in (12,14,15,13,16,17,18)
     and [Employee_Status]='Active'
     and [Employee_Type]='Staff'
     order by 4");
  
 		  while($echo = sqlsrv_fetch_array($new_query) ){


$rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['ID'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['UserName'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Employee_Name'].'</td>';

 if($echo["Hiring_Date"] == NULL ){
$rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
  }else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Hiring_Date']->format('Y-m-d').'</td>';}
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Units'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Grade'].'</td>';

 if($echo["Senior_Promotion"] == NULL ){
$rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
  }else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Senior_Promotion']->format('Y-m-d').'</td>';}


 if($echo["Supervisor_Promotion"] == NULL ){
$rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
  }else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Supervisor_Promotion']->format('Y-m-d').'</td>';}


 if($echo["SectionHead_Promotion"] == NULL ){
$rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
  }else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['SectionHead_Promotion']->format('Y-m-d').'</td>';}


 if($echo["UnitManager_Promotion"] == NULL ){
$rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
  }else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['UnitManager_Promotion']->format('Y-m-d').'</td>';}


 if($echo["Max_date"] == NULL ){
$rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
  }else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Max_date']->format('Y-m-d').'</td>';}



$rows .='<td class="hovers" style="border: 1px solid lightgray;">
'.$echo['Experience_years'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">
'.$echo['Experience_Months'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">
'.$echo['total promotion years'].'</td>';


$rows .= '</tr>';
echo $rows;

}

?>
 </tbody>
</table>
</div>
</div>
<script src="js/table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "table1.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>
