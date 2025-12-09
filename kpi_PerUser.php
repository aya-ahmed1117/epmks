
<?php
 //session_start(); 
set_time_limit(400);

include ("pages.php");
    date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
      $check_group = sqlsrv_query( $con1,"SELECT [ID]
      ,[UserName]
      ,[Unit]
      ,[Groups],[SubGroups]
  FROM [Employess_DB].[dbo].[tbl_Personal_info]
  left join [Employess_DB].[dbo].[Tbl_Groups] on [Employess_DB].[dbo].[Tbl_Groups].[Group_ID]=[Group]
  left join [Employess_DB].[dbo].[Tbl_SubGroups] on [Employess_DB].[dbo].[Tbl_SubGroups].[subGroup_ID]=[sub_Group]
  where username ='$s_username' ");
       $group = sqlsrv_fetch_array($check_group);
       $my_group =$group['Groups']; 
      /////////////
   date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkforceDB_indexed";
  
  $connectionInfo = array( "Database"=>"WorkforceDB_indexed" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $connect = sqlsrv_connect($DBhost, $connectionInfo);
  $this_year = date('Y');

      ?>
<title>Row Data Per day</title>
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


 <div style="padding: 20px;">

           <form method="post" >
           <?php 
  if (isset($_GET['GoDay'])) {
  ?>

  <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Daily Per Username  
      <a href="new_kpi.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       
        <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> 
       </a></p></samp>
    </aside>
  </div>
</center>
 <br>
<div class="row">
        <div class="col-lg-3">
<div class="input-group col-2">
  <span class="input-group-text" id="basic-addon1">Start Date</span>
  <input type="date" class="form-control" placeholder="From Date" aria-label="From Date" id="dates"
name='date' aria-describedby="basic-addon1"
value='<?php if(isset($_POST['date'])) echo $_POST['date']; ?>' required />
</div>
</div>
<br>
    <div class="col-lg-3">
<div class="input-group col-2">
  <span class="input-group-text" 
  id="basic-addon1">End date</span>
  <input type="date" class="form-control" placeholder="To Date" aria-label="To Date" name="date2" id="dates"
    aria-describedby="basic-addon1"required
value='<?php if(isset($_POST['date2'])) echo $_POST['date2']; ?>'/>
</div>
<br>
</div>
<br>
    <div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >
    Submit</button></div>
        </div>
    </div>
</div>


</div>
 <?php
if(isset($_POST['date'])){
$mydate = $_POST['date'];}
if(isset($_POST['date2'])){
$mydate2 = $_POST['date2'];}?>
 <div style="padding: 20px;">

<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
    <div class="tableFixHead">
       <table class="table order-table"  cellspacing="0" id="username_daily">
          <thead >
            <tr>
        <th ><center>Year</center></th>
        <th ><center>month</center></th>
        <th ><center>Week</center></th>
        <th ><center>Date</center></th>
        <th ><center>Ticket_group</center></th>
        <th ><center>Sub_group</center></th>
        <th ><center>Last_enginner</center></th>
        <th ><center>KPI_Name</center></th>
        <th ><center>Not Exceed</center></th>
        <th ><center>Exceed</center></th>
        <th ><center>Target</center></th>
        <th ><center>percentage</center></th>
            </tr>
            </thead>
          <tbody>
<?php 
  if(isset($_POST['submit'])){
if(($_SESSION['username'] == 'ahmed.mohamedbassal') ||
    ($_SESSION['username'] == 'mohamed.abdeltwab') ){
    //in ('GDS(Global Partner)','Private KAM')
//date 1  
if(isset($_POST['date'])){$mydate = $_POST['date'];
// date 2
if(isset($_POST['date2'])){$mydate2 = $_POST['date2'];
   $distinct = sqlsrv_query($con,"with x as (
SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'98%' [Target]
      ,'98% for total_time_within_SD_pool_not_exceed_90_min' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_total_time_within_SD_pool_not_exceed_90_min]
where [Date] BETWEEN '$mydate' AND '$mydate2' and  Ticket_group in ('GDS(Global Partner)','Private KAM')
---(ticket_group like 'private KAM%' or ticket_group like 'GDS%')
 union 

 SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,iif([SLA] = 'Have PSD','not exceed','Exceed')
      ,'93%' [Target]
      ,'98%_global_tickets_have_parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_have_PSD_tickets]
where [Date] BETWEEN '$mydate' AND '$mydate2' and  Ticket_group in ('GDS(Global Partner)','Private KAM')
---(ticket_group like 'private KAM%' or ticket_group like 'GDS%')
 union 

  SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'90%' [Target]
      ,'90% of all tickets that not escalated to onsite or global to be resolved within 24 hours' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_MTTR_SD_24hr]
where [Date] BETWEEN '$mydate' AND '$mydate2' and  Ticket_group in ('GDS(Global Partner)','Private KAM')
---(ticket_group like 'private KAM%' or ticket_group like 'GDS%')
union

   SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'93%' [Target]
      ,'Global_tickets_linked_within 1 hour to parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_be_linked_to_PSC_within_45hr]
where [Date] BETWEEN '$mydate' AND '$mydate2' and  Ticket_group in ('GDS(Global Partner)','Private KAM')
---(ticket_group like 'private KAM%' or ticket_group like 'GDS%')
 ),

 final as (
 select * from (
 select 
 [year],[month],[week],[date],[Ticket_group],[Sub_group],Last_enginner,Requestid,[Target],
 [SLA],
 [KPI_Name]
 
 from x ) t

 PIVOT(
    COUNT([Requestid]) 
    FOR [SLA] IN (
        [Not Exceed], 
        [Exceed])
) AS pivot_table)

select 
 [Year],[month],[Week],[Date],[Ticket_group],[Sub_group],Last_enginner,[KPI_Name],[Not Exceed], [Exceed],[Target],round(iif([Not Exceed] = 0 and [Exceed] = 0,0,cast([Not Exceed] as float) / (cast([Not Exceed] as float)+cast([Exceed] as float))),2) [percentage]
from final
order by [date],[KPI_Name],[Sub_group]
");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Year"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["month"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Week"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Sub_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Last_enginner"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["KPI_Name"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Not Exceed"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Exceed"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Target"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">
  '.floor(($output["percentage"])*100).'%'.'</td>';
$rows .='</tr>';
echo $rows;
}
}
}
}if($_SESSION['username'] == 'ahmed.akef'){
    if(isset($_POST['date'])){$mydate = $_POST['date'];
// date 2
if(isset($_POST['date2'])){$mydate2 = $_POST['date2'];
   $distinct = sqlsrv_query($con,"with x as (
SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'98%' [Target]
      ,'98% for total_time_within_SD_pool_not_exceed_90_min' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_total_time_within_SD_pool_not_exceed_90_min]
where [Date] BETWEEN '$mydate' AND '$mydate2' 
 union 

 SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,iif([SLA] = 'Have PSD','not exceed','Exceed')
      ,'93%' [Target]
      ,'98%_global_tickets_have_parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_have_PSD_tickets]
where [Date] BETWEEN '$mydate' AND '$mydate2' 
 union 

  SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'90%' [Target]
      ,'90% of all tickets that not escalated to onsite or global to be resolved within 24 hours' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_MTTR_SD_24hr]
where [Date] BETWEEN '$mydate' AND '$mydate2' 
union

   SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'93%' [Target]
      ,'Global_tickets_linked_within 1 hour to parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_be_linked_to_PSC_within_45hr]
where [Date] BETWEEN '$mydate' AND '$mydate2' 
 ),

 final as (
 select * from (
 select 
 [year],[month],[week],[date],[Ticket_group],[Sub_group],Last_enginner,Requestid,[Target],
 [SLA],
 [KPI_Name]
 
 from x ) t

 PIVOT(
    COUNT([Requestid]) 
    FOR [SLA] IN (
        [Not Exceed], 
        [Exceed])
) AS pivot_table)

select 
 [Year],[month],[Week],[Date],[Ticket_group],[Sub_group],Last_enginner,[KPI_Name],[Not Exceed], [Exceed],[Target],round(iif([Not Exceed] = 0 and [Exceed] = 0,0,cast([Not Exceed] as float) / (cast([Not Exceed] as float)+cast([Exceed] as float))),2) [percentage]
from final
order by [date],[KPI_Name],[Sub_group]
");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Year"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["month"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Week"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Sub_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Last_enginner"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["KPI_Name"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Not Exceed"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Exceed"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Target"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">
  '.floor(($output["percentage"])*100).'%'.'</td>';
$rows .='</tr>';
echo $rows;
}
}
}
}else{
    //date 1  
if(isset($_POST['date'])){$mydate = $_POST['date'];
// date 2
if(isset($_POST['date2'])){$mydate2 = $_POST['date2'];
   $distinct = sqlsrv_query($con,"with x as (
SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'98%' [Target]
      ,'98% for total_time_within_SD_pool_not_exceed_90_min' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_total_time_within_SD_pool_not_exceed_90_min]
where [Date] BETWEEN '$mydate' AND '$mydate2' and  Ticket_group like '$my_group%'
 union 

 SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,iif([SLA] = 'Have PSD','not exceed','Exceed')
      ,'93%' [Target]
      ,'98%_global_tickets_have_parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_have_PSD_tickets]
where [Date] BETWEEN '$mydate' AND '$mydate2' and  Ticket_group like '$my_group%'
 union 

  SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'90%' [Target]
      ,'90% of all tickets that not escalated to onsite or global to be resolved within 24 hours' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_MTTR_SD_24hr]
where [Date] BETWEEN '$mydate' AND '$mydate2' and  Ticket_group like '$my_group%'
union

   SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'93%' [Target]
      ,'Global_tickets_linked_within 1 hour to parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_be_linked_to_PSC_within_45hr]
where [Date] BETWEEN '$mydate' AND '$mydate2' and  Ticket_group like '$my_group%'
 ),

 final as (
 select * from (
 select 
 [year],[month],[week],[date],[Ticket_group],[Sub_group],Last_enginner,Requestid,[Target],
 [SLA],
 [KPI_Name]
 
 from x ) t

 PIVOT(
    COUNT([Requestid]) 
    FOR [SLA] IN (
        [Not Exceed], 
        [Exceed])
) AS pivot_table)

select 
 [Year],[month],[Week],[Date],[Ticket_group],[Sub_group],Last_enginner,[KPI_Name],[Not Exceed], [Exceed],[Target],round(iif([Not Exceed] = 0 and [Exceed] = 0,0,cast([Not Exceed] as float) / (cast([Not Exceed] as float)+cast([Exceed] as float))),2) [percentage]
from final
order by [date],[KPI_Name],[Sub_group]
");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Year"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["month"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Week"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Sub_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Last_enginner"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["KPI_Name"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Not Exceed"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Exceed"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Target"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">
  '.floor(($output["percentage"])*100).'%'.'</td>';
$rows .='</tr>';
echo $rows;
}
}
}
}
}
  ?>
    <script type="text/javascript">
        function Export() {
            $("#Username_daily").table2excel({
                filename: "Username_daily.xls"
            });
        }
    </script>
</tbody>
</table>
</div>
</div>


<?php 
}//////////////// end day
?>
  <?php 
  if (isset($_GET['GoWeek'])) {
    //////// start week
  ?>
  <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Weekly Per Username 
      <a href="new_kpi.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       
        <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> 
       </a></p></samp>
    </aside>
  </div>
</center>
 <br>

  <div class="row">
        <div class="col-lg-3">
<div class="input-group col-2">
  <span class="input-group-text" id="basic-addon1">Choose Week</span>
  <input type="week" class="form-control"id="Week"
name='Week' aria-describedby="basic-addon1"
value='<?php if(isset($_POST['Week'])) echo $_POST['Week']; ?>' required />
</div>
</div>
 
<div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >
Submit</button>
</div>
        </div>
    </div>
</div>

</div>
 <?php
if(isset($_POST['Week'])){
$myWeek = $_POST['Week'];}
if(isset($_POST['Week2'])){
$myWeek2 = $_POST['Week2'];}?>

 <div style="padding: 20px;">

<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
   <div class="tableFixHead">
     <table class="table order-table"cellspacing="0" 
     id="Username_week" >
      <thead >
        <tr>
        <th ><center>Year</center></th>
        <th ><center>month</center></th>
        <th ><center>Week</center></th>
        <th ><center>Ticket_group</center></th>
        <th ><center>Sub_group</center></th>
        <th ><center>Last_enginner</center></th>
        <th ><center>KPI_Name</center></th>
        <th ><center>Not Exceed</center></th>
        <th ><center>Exceed</center></th>
        <th ><center>Target</center></th>
        <th ><center>percentage</center></th>

        </tr>
        </thead>
      <tbody>

<?php 
  if(isset($_POST['submit'])){
if(($_SESSION['username'] == 'ahmed.mohamedbassal') ||
    ($_SESSION['username'] == 'mohamed.abdeltwab') ){
    //in ('GDS(Global Partner)','Private KAM')
//week
if(isset($_POST['Week'])){$myWeek = $_POST['Week'];
// date 2
   $newWeeks = date('W', strtotime($myWeek));
   $newYear = date('Y', strtotime($myMonth));
   $myweeks = sqlsrv_query($con,"with x as (
SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'98%' [Target]
      ,'98% for total_time_within_SD_pool_not_exceed_90_min' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_total_time_within_SD_pool_not_exceed_90_min]
 where  [Week] = '$newWeeks' and Ticket_group in ('GDS(Global Partner)','Private KAM') and [Year]>='$this_year'
 ---(ticket_group like 'private KAM%' or ticket_group like 'GDS%')

 union 

 SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,iif([SLA] = 'Have PSD','not exceed','Exceed')
      ,'93%' [Target]
      ,'98%_global_tickets_have_parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_have_PSD_tickets]
 where  [Week] = '$newWeeks' and Ticket_group in ('GDS(Global Partner)','Private KAM') and [Year]>='$this_year'
 ---(ticket_group like 'private KAM%' or ticket_group like 'GDS%')

 union 

  SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'90%' [Target]
      ,'90% of all tickets that not escalated to onsite or global to be resolved within 24 hours' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_MTTR_SD_24hr]
 where  [Week] = '$newWeeks' and Ticket_group in ('GDS(Global Partner)','Private KAM') and [Year]>='$this_year'
 ---(ticket_group like 'private KAM%' or ticket_group like 'GDS%')

union

   SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'93%' [Target]
      ,'Global_tickets_linked_within 1 hour to parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_be_linked_to_PSC_within_45hr]
 where  [Week] = '$newWeeks' and Ticket_group in ('GDS(Global Partner)','Private KAM') and [Year]>='$this_year'
 ---(ticket_group like 'private KAM%' or ticket_group like 'GDS%')
 ),
 final as (
 select * from (
 select 
 [Year],[month],[Week],[Ticket_group],[Sub_group],Last_enginner,Requestid,[Target],
 [SLA],
 [KPI_Name]
 
 from x ) t

 PIVOT(
    COUNT([Requestid]) 
    FOR [SLA] IN (
        [Not Exceed], 
        [Exceed])
) AS pivot_table)

select 
 [Year],[month],[Week],[Ticket_group],[Sub_group],Last_enginner,[KPI_Name],[Not Exceed], [Exceed],[Target],round(iif([Not Exceed] = 0 and [Exceed] = 0,0,cast([Not Exceed] as float) / (cast([Not Exceed] as float)+cast([Exceed] as float))),2) [percentage]
from final
order by [Week],[KPI_Name],[Sub_group]
 ");
 
   while ($output = sqlsrv_fetch_array($myweeks) ){
$rows  ='<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Year"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["month"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Week"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Sub_group"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Last_enginner"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["KPI_Name"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Not Exceed"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Exceed"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Target"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">
 '.floor(($output["percentage"])*100).'%'.'</td>';
$rows .='</tr>';
echo $rows;
}
}
}if($_SESSION['username'] == 'ahmed.akef'){
    if(isset($_POST['Week'])){$myWeek = $_POST['Week'];
// date 2
$newWeeks = date('W', strtotime($myWeek));
   $myweeks = sqlsrv_query($con,"with x as (
SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'98%' [Target]
      ,'98% for total_time_within_SD_pool_not_exceed_90_min' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_total_time_within_SD_pool_not_exceed_90_min]
 where  [Week] = '$newWeeks' and [Year]>='$this_year'

 union 

 SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,iif([SLA] = 'Have PSD','not exceed','Exceed')
      ,'93%' [Target]
      ,'98%_global_tickets_have_parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_have_PSD_tickets]
 where  [Week] = '$newWeeks' and [Year]>='$this_year'

 union 

  SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'90%' [Target]
      ,'90% of all tickets that not escalated to onsite or global to be resolved within 24 hours' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_MTTR_SD_24hr]
 where  [Week] = '$newWeeks' and [Year]>='$this_year'

union

   SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'93%' [Target]
      ,'Global_tickets_linked_within 1 hour to parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_be_linked_to_PSC_within_45hr]
 where  [Week] = '$newWeeks' and [Year]>='$this_year'

 ),

 final as (
 select * from (
 select 
 [Year],[month],[Week],[Ticket_group],[Sub_group],Last_enginner,Requestid,[Target],
 [SLA],
 [KPI_Name]
 
 from x ) t

 PIVOT(
    COUNT([Requestid]) 
    FOR [SLA] IN (
        [Not Exceed], 
        [Exceed])
) AS pivot_table)

select 
 [Year],[month],[Week],[Ticket_group],[Sub_group],Last_enginner,[KPI_Name],[Not Exceed], [Exceed],[Target],round(iif([Not Exceed] = 0 and [Exceed] = 0,0,cast([Not Exceed] as float) / (cast([Not Exceed] as float)+cast([Exceed] as float))),2) [percentage]
from final
order by [Week],[KPI_Name],[Sub_group]
 ");
 
   while ($output = sqlsrv_fetch_array($myweeks) ){
$rows  ='<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Year"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["month"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Week"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Sub_group"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Last_enginner"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["KPI_Name"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Not Exceed"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Exceed"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Target"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">
 '.floor(($output["percentage"])*100).'%'.'</td>';
$rows .='</tr>';
echo $rows;
}
}
}else{
    //week
if(isset($_POST['Week'])){$myWeek = $_POST['Week'];
// date 2
$newWeeks = date('W', strtotime($myWeek));
   $myweeks = sqlsrv_query($con,"with x as (
SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'98%' [Target]
      ,'98% for total_time_within_SD_pool_not_exceed_90_min' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_total_time_within_SD_pool_not_exceed_90_min]
 where  [Week] = '$newWeeks' and [Year]>='$this_year' and Ticket_group like '$my_group%'

 union 

 SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,iif([SLA] = 'Have PSD','not exceed','Exceed')
      ,'93%' [Target]
      ,'98%_global_tickets_have_parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_have_PSD_tickets]
 where  [Week] = '$newWeeks'and [Year]>='$this_year' and Ticket_group like '$my_group%'

 union 

  SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'90%' [Target]
      ,'90% of all tickets that not escalated to onsite or global to be resolved within 24 hours' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_MTTR_SD_24hr]
 where  [Week] = '$newWeeks'and [Year]>='$this_year' and Ticket_group 
 like '$my_group%'

union

   SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'93%' [Target]
      ,'Global_tickets_linked_within 1 hour to parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_be_linked_to_PSC_within_45hr]
 where  [Week] = '$newWeeks'and [Year]>='$this_year' and Ticket_group like '$my_group%'

 ),

 final as (
 select * from (
 select 
 [Year],[month],[Week],[Ticket_group],[Sub_group],Last_enginner,Requestid,[Target],
 [SLA],
 [KPI_Name]
 
 from x ) t

 PIVOT(
    COUNT([Requestid]) 
    FOR [SLA] IN (
        [Not Exceed], 
        [Exceed])
) AS pivot_table)

select 
 [Year],[month],[Week],[Ticket_group],[Sub_group],Last_enginner,[KPI_Name],[Not Exceed], [Exceed],[Target],round(iif([Not Exceed] = 0 and [Exceed] = 0,0,cast([Not Exceed] as float) / (cast([Not Exceed] as float)+cast([Exceed] as float))),2) [percentage]
from final
order by [Week],[KPI_Name],[Sub_group]
 ");
 
   while ($output = sqlsrv_fetch_array($myweeks) ){
$rows  ='<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Year"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["month"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Week"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Sub_group"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Last_enginner"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["KPI_Name"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Not Exceed"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Exceed"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Target"].'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;">
 '.floor(($output["percentage"])*100).'%'.'</td>';
$rows .='</tr>';
echo $rows;
}
}
}
}
  ?>

 <script type="text/javascript">
        function Export() {
            $("#Username_week").table2excel({
                filename: "Username_week.xls"
            });
        }
    </script>
 </tbody>
</table>
</div>
</div>

    <?php } ?>
  <?php 
  if (isset($_GET['GoMonth'])) {
  ?>
  <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Monthly Per Username 
      <a href="new_kpi.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       
        <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> 
       </a></p></samp>
    </aside>
  </div>
</center>
 <br>

  <div class="row">
        <div class="col-lg-3">
<div class="input-group col-2">
  <span class="input-group-text" id="basic-addon1">Choose Month</span>
  <input type="month" class="form-control"  id="months"
name='month' aria-describedby="basic-addon1"
value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>' required />
</div>
</div>

<div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >
Submit</button>
</div>
        </div>
    </div>
</div>

<br>

</div>
 <?php
if(isset($_POST['month'])){
$myMonth = $_POST['month'];}
?>

  <div style="padding: 20px;">
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
    <div class="tableFixHead">
     <table class="table order-table"cellspacing="0" 
     id="Username_Monthly" >

  <thead>
    <tr>
        <th ><center>Year</center></th>
        <th ><center>month</center></th>
        <th ><center>Ticket_group</center></th>
        <th ><center>Sub_group</center></th>
        <th ><center>Last_enginner</center></th>
        <th ><center>KPI_Name</center></th>
        <th ><center>Not Exceed</center></th>
        <th ><center>Exceed</center></th>
        <th ><center>Target</center></th>
        <th ><center>percentage</center></th>
    </tr>
    </thead>
  <tbody>

<?php 
  if(isset($_POST['submit'])){
if(($_SESSION['username'] == 'ahmed.mohamedbassal') ||
    ($_SESSION['username'] == 'mohamed.abdeltwab') ){
    //in ('GDS(Global Partner)','Private KAM')
//month  
if(isset($_POST['month'])){$myMonth= $_POST['month'];
$newMonth = date('n', strtotime($myMonth));
$newYear = date('Y', strtotime($myMonth));
   $mymonths = sqlsrv_query($con,"with x as (
SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'98%' [Target]
      ,'98% for total_time_within_SD_pool_not_exceed_90_min' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_total_time_within_SD_pool_not_exceed_90_min]
 where [month] = '$newMonth' and (ticket_group like 'private KAM%' or ticket_group like 'GDS%') and [Year] >='$newYear'

 union 

 SELECT [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,iif([SLA] = 'Have PSD','not exceed','Exceed')
      ,'93%' [Target]
      ,'98%_global_tickets_have_parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_have_PSD_tickets]
 where [month] = '$newMonth' and (ticket_group like 'private KAM%' or ticket_group like 'GDS%') and [Year] >='$newYear'

 union 

  SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'90%' [Target]
      ,'90% of all tickets that not escalated to onsite or global to be resolved within 24 hours' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_MTTR_SD_24hr]
 where [month] = '$newMonth' and (ticket_group like 'private KAM%' or ticket_group like 'GDS%') and [Year] >='$newYear'

union

   SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'93%' [Target]
      ,'Global_tickets_linked_within 1 hour to parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_be_linked_to_PSC_within_45hr]
 where [month] = '$newMonth' and (ticket_group like 'private KAM%' or ticket_group like 'GDS%') and [Year] >='$newYear'

 ),

 final as (
 select * from (
 select 
 [year],[month],[Ticket_group],[Sub_group],Last_enginner,Requestid,[Target],
 [SLA],
 [KPI_Name]
 
 from x ) t

 PIVOT(
    COUNT([Requestid]) 
    FOR [SLA] IN (
        [Not Exceed], 
        [Exceed])
) AS pivot_table)

select 
 [Year],[month],[Ticket_group],[Sub_group],Last_enginner,[KPI_Name],[Not Exceed], [Exceed],[Target],round(iif([Not Exceed] = 0 and [Exceed] = 0,0,cast([Not Exceed] as float) / (cast([Not Exceed] as float)+cast([Exceed] as float))),2) 
 [percentage]
from final
order by [month],[KPI_Name],[Sub_group]");
  while ($output = sqlsrv_fetch_array($mymonths) ){
$rows  ='<tr>';
   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Year"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["month"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Sub_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Last_enginner"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["KPI_Name"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Not Exceed"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Exceed"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Target"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">
  '.floor(($output["percentage"])*100).'%'.'</td>';
echo $rows;
}
}
}if($_SESSION['username'] == 'ahmed.akef'){
    if(isset($_POST['month'])){$myMonth= $_POST['month'];
$newMonth = date('n', strtotime($myMonth));
$newYear = date('Y', strtotime($myMonth));

   $mymonths = sqlsrv_query($con,"with x as (
SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'98%' [Target]
      ,'98% for total_time_within_SD_pool_not_exceed_90_min' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_total_time_within_SD_pool_not_exceed_90_min]
 where [month] = '$newMonth' and [Year] >='$newYear'

 union 

 SELECT [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,iif([SLA] = 'Have PSD','not exceed','Exceed')
      ,'93%' [Target]
      ,'98%_global_tickets_have_parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_have_PSD_tickets]
 where [month] = '$newMonth'and [Year] >='$newYear'

 union 

  SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'90%' [Target]
      ,'90% of all tickets that not escalated to onsite or global to be resolved within 24 hours' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_MTTR_SD_24hr]
 where [month] = '$newMonth' and [Year] >='$newYear'

union

   SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'93%' [Target]
      ,'Global_tickets_linked_within 1 hour to parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_be_linked_to_PSC_within_45hr]
 where [month] = '$newMonth'and [Year] >='$newYear'

 ),

 final as (
 select * from (
 select 
 [year],[month],[Ticket_group],[Sub_group],Last_enginner,Requestid,[Target],
 [SLA],
 [KPI_Name]
 
 from x ) t

 PIVOT(
    COUNT([Requestid]) 
    FOR [SLA] IN (
        [Not Exceed], 
        [Exceed])
) AS pivot_table)

select 
 [Year],[month],[Ticket_group],[Sub_group],Last_enginner,[KPI_Name],[Not Exceed], [Exceed],[Target],round(iif([Not Exceed] = 0 and [Exceed] = 0,0,cast([Not Exceed] as float) / (cast([Not Exceed] as float)+cast([Exceed] as float))),2) 
 [percentage]
from final
order by [month],[KPI_Name],[Sub_group]");
  while ($output = sqlsrv_fetch_array($mymonths) ){
$rows  ='<tr>';
   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Year"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["month"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Sub_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Last_enginner"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["KPI_Name"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Not Exceed"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Exceed"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Target"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">
  '.floor(($output["percentage"])*100).'%'.'</td>';
echo $rows;
}
}
}else{
    //month  
if(isset($_POST['month'])){$myMonth= $_POST['month'];
$newMonth = date('n', strtotime($myMonth));
$newYear = date('Y', strtotime($myMonth));
   $mymonths = sqlsrv_query($con,"with x as (
SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'98%' [Target]
      ,'98% for total_time_within_SD_pool_not_exceed_90_min' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_total_time_within_SD_pool_not_exceed_90_min]
 where [month] = '$newMonth' and Ticket_group like '$my_group%' and [Year] >='$newYear'

 union 

 SELECT [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,iif([SLA] = 'Have PSD','not exceed','Exceed')
      ,'93%' [Target]
      ,'98%_global_tickets_have_parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_have_PSD_tickets]
 where [month] = '$newMonth' and Ticket_group like '$my_group%' and [Year] >='$newYear'

 union 

  SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'90%' [Target]
      ,'90% of all tickets that not escalated to onsite or global to be resolved within 24 hours' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_MTTR_SD_24hr]
 where [month] = '$newMonth' and Ticket_group like '$my_group%' and [Year] >='$newYear'

union

   SELECT  [Year]
      ,[month]
      ,[Week]
      ,[Date]
      ,[Ticket_group]
      ,[Sub_group]
      ,[Last_Enginner]
      ,[RequestID]
      ,[SLA]
      ,'93%' [Target]
      ,'Global_tickets_linked_within 1 hour to parent_ticket' [KPI_Name]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_be_linked_to_PSC_within_45hr]
 where [month] = '$newMonth' and Ticket_group like '$my_group%' and [Year] >='$newYear'

 ),

 final as (
 select * from (
 select 
 [year],[month],[Ticket_group],[Sub_group],Last_enginner,Requestid,[Target],
 [SLA],
 [KPI_Name]
 
 from x ) t

 PIVOT(
    COUNT([Requestid]) 
    FOR [SLA] IN (
        [Not Exceed], 
        [Exceed])
) AS pivot_table)

select 
 [Year],[month],[Ticket_group],[Sub_group],Last_enginner,[KPI_Name],[Not Exceed], [Exceed],[Target],round(iif([Not Exceed] = 0 and [Exceed] = 0,0,cast([Not Exceed] as float) / (cast([Not Exceed] as float)+cast([Exceed] as float))),2) 
 [percentage]
from final
order by [month],[KPI_Name],[Sub_group]");
  while ($output = sqlsrv_fetch_array($mymonths) ){
$rows  ='<tr>';
   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Year"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["month"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Sub_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Last_enginner"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["KPI_Name"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Not Exceed"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Exceed"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Target"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">
  '.floor(($output["percentage"])*100).'%'.'</td>';
echo $rows;
}
}
}
}
  ?>
  <script type="text/javascript">
        function Export() {
            $("#Username_Monthly").table2excel({
                filename: "Username_Monthly.xls"
            });
        }
    </script>
</tbody>
</table>
</div>
</div>
<?php } ?>
<script src="js/table2excel.js" type="text/javascript"></script>

<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>
