
 <?php

include ("pages.php");
      $usernames="";
      if(isset($_POST['username'])){$usernames = $_POST['username'];}
      $ticket_group="";
      if(isset($_POST['ticket_group'])){$ticket_group = $_POST['ticket_group'];}
      /////////////
   date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkforceDB_indexed";
  
  $connectionInfo = array( "Database"=>"WorkforceDB_indexed" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $connect = sqlsrv_connect($DBhost, $connectionInfo);


  $connectionInfo = array( "Database"=>"WorkforceDB_indexed" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $connect = sqlsrv_connect($DBhost, $connectionInfo);

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
      ?>
<title>Daily Average</title>
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
  if (isset($_GET['Summary'])) {
  ?>
 
  <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >
                Daily Summary
      <a href="Daily_reports.php">
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

<div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >Submit</button></div>
 
<br>

</div>
 <?php
if(isset($_POST['date'])){
$mydate = $_POST['date'];}
if(isset($_POST['date2'])){
$mydate2 = $_POST['date2'];}?>

<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead >
    <tr>
<th ><center>Date</center></th>
<th ><center>Ticket group</center></th>
<th ><center>Subgroup</center></th>
<th ><center>Total_no_tickets_SD+SD_onsite</center></th>
<th ><center>MTTR_Violated_Tickets_SD</center></th>
<th ><center>Avg_MTTR_SD</center></th>
<th ><center>AVG_MTTR_SD_SDtoOnsite</center></th>
    </tr>
    </thead>
  <tbody>

<?php 
  if(isset($_POST['submit'])){
//date 1  
if(isset($_POST['date'])){$mydate = $_POST['date'];
// date 2
if(isset($_POST['date2'])){$mydate2 = $_POST['date2'];

if(($_SESSION['username'] == 'ahmed.mohamedbassal') ||
    ($_SESSION['username'] == 'mohamed.abdeltwab') ){
    //in  ('GDS(Global Partner)','Private KAM')

   $distinct = sqlsrv_query($con,"with [Total_no_Tickets_SD+PSD] as (SELECT cast(creation_time as date) [date]
,[Ticket_group],subgroup
,count([RequestID]) [Total_no_Tickets_SD+PSD]
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [RequestID]  not in ( SELECT [RequestID]
      
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where  closure_reason  in ('Duplicated tickets'))
   group by cast(creation_time as date),[Ticket_group],subgroup
),


[MTTR_Violated_Tickets_SD] as (

SELECT 
cast(creation_time as date) [date]
,Ticket_group
,subgroup
, count([RequestID]) [MTTR_Violated_Tickets_SD]
FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [Onsite_status]='no' and [RequestID]  not in ( SELECT [RequestID]
FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where  closure_reason  in ('Duplicated tickets')) and ticket_status like '%close%' and cast(cast([Final_close] as datetime) -cast ([creation_time] as  datetime)as time)>='04:00:00'
group by cast(creation_time as date) 
,Ticket_group,subgroup),



x as (

SELECT
    cast(creation_time as date) [date]
    , avg(cast(cast([Final_close] as datetime)-cast([creation_time] as datetime) as float)) [MTTR]
    , Ticket_group


  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where [Fake_Real] = 'Real Ticket' and [Onsite_status]='no' and [Ticket_group] is not null and [RequestID]  not in ( SELECT [RequestID]
     
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where  closure_reason  in ('Duplicated tickets')) and ticket_status like '%close%'
   group by   cast(creation_time as date),Ticket_group),

    x_total as (

SELECT
    cast(creation_time as date) [date]
    , avg(cast(cast([Final_close] as datetime)-cast([creation_time] as datetime) as float)) [MTTR]
    , Ticket_group


  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [RequestID]  not in ( SELECT [RequestID]
     
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where  closure_reason  in ('Duplicated tickets')) and ticket_status like '%close%'
   group by   cast(creation_time as date),Ticket_group),

   avg_mttr_sd as (

   select [date], Ticket_group,
   right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME)))% 60 )),2) as [MTTR]
from x
group by [date], Ticket_group

),

    avg_mttr_sd_PSD as (

   select [date], Ticket_group,
   right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME)))% 60 )),2) as [MTTR]
from x_total
group by [date], Ticket_group)

select 
 [Total_no_Tickets_SD+PSD].[date]
,[Total_no_Tickets_SD+PSD].[Ticket_group]
,[Total_no_Tickets_SD+PSD].[subgroup]
,[Total_no_Tickets_SD+PSD][Total_no_tickets_SD+SD_onsite]
,[MTTR_Violated_Tickets_SD]
,avg_mttr_sd.[MTTR] [Avg_MTTR_SD]
,avg_mttr_sd_PSD.[MTTR] [AVG_MTTR_SD_SDtoOnsite]

from [Total_no_Tickets_SD+PSD]
left join [MTTR_Violated_Tickets_SD] on [MTTR_Violated_Tickets_SD].[date] = [Total_no_Tickets_SD+PSD].[date] and [MTTR_Violated_Tickets_SD].Ticket_group = [Total_no_Tickets_SD+PSD].Ticket_group and [Total_no_Tickets_SD+PSD].subgroup=[MTTR_Violated_Tickets_SD].subgroup
left join avg_mttr_sd on avg_mttr_sd.[date] = [Total_no_Tickets_SD+PSD].[date] and  avg_mttr_sd.Ticket_group = [Total_no_Tickets_SD+PSD].Ticket_group
left join avg_mttr_sd_PSD on avg_mttr_sd_PSD.[date] = [Total_no_Tickets_SD+PSD].[date] and  avg_mttr_sd_PSD.Ticket_group = [Total_no_Tickets_SD+PSD].Ticket_group


  where [Total_no_Tickets_SD+PSD].[date] BETWEEN '$mydate' AND '$mydate2'  and ([Total_no_Tickets_SD+PSD].[Ticket_group] LIKE 'private KAM%' 
       OR [Total_no_Tickets_SD+PSD].[Ticket_group] LIKE 'GDS%')  order by [date]
  ");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["date"]->format('Y/m/d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>';
  $rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$output["Total_no_tickets_SD+SD_onsite"].'</td>';
  $rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$output["MTTR_Violated_Tickets_SD"].
  '</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Avg_MTTR_SD"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["AVG_MTTR_SD_SDtoOnsite"].'</td>';
 
$rows .='</tr>';
echo $rows;
}}else{
    $distinct = sqlsrv_query($con,"with [Total_no_Tickets_SD+PSD] as (SELECT cast(creation_time as date) [date]
,[Ticket_group],subgroup
,count([RequestID]) [Total_no_Tickets_SD+PSD]
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [RequestID]  not in ( SELECT [RequestID]
      
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where  closure_reason  in ('Duplicated tickets'))
   group by cast(creation_time as date),[Ticket_group],subgroup
),


[MTTR_Violated_Tickets_SD] as (

SELECT 
cast(creation_time as date) [date]
,Ticket_group
,subgroup
, count([RequestID]) [MTTR_Violated_Tickets_SD]
FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [Onsite_status]='no' and [RequestID]  not in ( SELECT [RequestID]
FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where  closure_reason  in ('Duplicated tickets')) and ticket_status like '%close%' and cast(cast([Final_close] as datetime) -cast ([creation_time] as  datetime)as time)>='04:00:00'
group by cast(creation_time as date) 
,Ticket_group,subgroup),



x as (

SELECT
    cast(creation_time as date) [date]
    , avg(cast(cast([Final_close] as datetime)-cast([creation_time] as datetime) as float)) [MTTR]
    , Ticket_group


  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where [Fake_Real] = 'Real Ticket' and [Onsite_status]='no' and [Ticket_group] is not null and [RequestID]  not in ( SELECT [RequestID]
     
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where  closure_reason  in ('Duplicated tickets')) and ticket_status like '%close%'
   group by   cast(creation_time as date),Ticket_group),

    x_total as (

SELECT
    cast(creation_time as date) [date]
    , avg(cast(cast([Final_close] as datetime)-cast([creation_time] as datetime) as float)) [MTTR]
    , Ticket_group


  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [RequestID]  not in ( SELECT [RequestID]
     
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where  closure_reason  in ('Duplicated tickets')) and ticket_status like '%close%'
   group by   cast(creation_time as date),Ticket_group),

   avg_mttr_sd as (

   select [date], Ticket_group,
   right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME)))% 60 )),2) as [MTTR]
from x
group by [date], Ticket_group

),

    avg_mttr_sd_PSD as (

   select [date], Ticket_group,
   right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME)))% 60 )),2) as [MTTR]
from x_total
group by [date], Ticket_group)

select 
 [Total_no_Tickets_SD+PSD].[date]
,[Total_no_Tickets_SD+PSD].[Ticket_group]
,[Total_no_Tickets_SD+PSD].[subgroup]
,[Total_no_Tickets_SD+PSD][Total_no_tickets_SD+SD_onsite]
,[MTTR_Violated_Tickets_SD]
,avg_mttr_sd.[MTTR] [Avg_MTTR_SD]
,avg_mttr_sd_PSD.[MTTR] [AVG_MTTR_SD_SDtoOnsite]

from [Total_no_Tickets_SD+PSD]
left join [MTTR_Violated_Tickets_SD] on [MTTR_Violated_Tickets_SD].[date] = [Total_no_Tickets_SD+PSD].[date] and [MTTR_Violated_Tickets_SD].Ticket_group = [Total_no_Tickets_SD+PSD].Ticket_group and [Total_no_Tickets_SD+PSD].subgroup=[MTTR_Violated_Tickets_SD].subgroup
left join avg_mttr_sd on avg_mttr_sd.[date] = [Total_no_Tickets_SD+PSD].[date] and  avg_mttr_sd.Ticket_group = [Total_no_Tickets_SD+PSD].Ticket_group
left join avg_mttr_sd_PSD on avg_mttr_sd_PSD.[date] = [Total_no_Tickets_SD+PSD].[date] and  avg_mttr_sd_PSD.Ticket_group = [Total_no_Tickets_SD+PSD].Ticket_group

   where [Total_no_Tickets_SD+PSD].[date] BETWEEN '$mydate' AND '$mydate2'  and [Total_no_Tickets_SD+PSD].[Ticket_group] like '$my_group%' order by [date]");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["date"]->format('Y/m/d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>';
  $rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$output["Total_no_tickets_SD+SD_onsite"].'</td>';
  $rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$output["MTTR_Violated_Tickets_SD"].
  '</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Avg_MTTR_SD"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["AVG_MTTR_SD_SDtoOnsite"].'</td>';
 
$rows .='</tr>';
echo $rows;

}
}}
}
}
  ?>
  <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Daily Summary.xls"
            });
        }
    </script>
</div>
</tbody>
</table>
</div>

<?php 
}
?>
  <?php 
  if (isset($_GET['statistics'])) {
  ?>
  
  <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >
                Daily API statistics
      <a href="Daily_reports.php">
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


            <div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >Submit</button></div>

<br>

</div>
 <?php
if(isset($_POST['date'])){
$mydate = $_POST['date'];}
if(isset($_POST['date2'])){
$mydate2 = $_POST['date2'];}?>

<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead >
    <tr>
<th style="border: 1px solid lightgray;"><center>Date</center></th>
<th style="border: 1px solid lightgray;"><center>ticket_group</center></th>
<th style="border: 1px solid lightgray;"><center> subgroup</center></th>
<th style="border: 1px solid lightgray;"><center>Total API tkts(with all closure reasons )</center></th>
<th style="border: 1px solid lightgray;"><center>Handled (with closure reason not(customer not respond or duplicated))</center></th>
<th style="border: 1px solid lightgray;"><center>Not Handled (with closure reason(customer not respond or duplicated))</center></th>  

    </tr>
    </thead>
  <tbody>

<?php 
  if(isset($_POST['submit'])){
//date 1  
if(isset($_POST['date'])){$mydate = $_POST['date'];
// date 2
if(isset($_POST['date2'])){$mydate2 = $_POST['date2'];


if(($_SESSION['username'] == 'ahmed.mohamedbassal') ||
    ($_SESSION['username'] == 'mohamed.abdeltwab') ){
    //in  ('GDS(Global Partner)','Private KAM')

   $distinct = sqlsrv_query($con,"with not_handled as (
SELECT 
cast(Final_close as date) [Date]
,Ticket_group,subgroup
,count([RequestID]) [Not Handled (with closure reason (customer not respond or duplicated))]


  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where closure_reason  in ('Customer not Respond','Duplicated tickets') and Ticket_group is not null and [ticket_status]  like '%Close%' and request_mode = 'API'
  group by cast(Final_close as date),Ticket_group,subgroup
),

Total as (
SELECT 
cast(Final_close as date) [Date]
,Ticket_group,subgroup
,count([RequestID]) [Total API tkts (with all closure reasons )]

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where  Ticket_group is not null and [ticket_status]  like '%Close%' and request_mode = 'API'
  group by cast(Final_close as date),Ticket_group,subgroup
)


select Total.[Date]
,Total.Ticket_group,total.subgroup
,[Total API tkts (with all closure reasons )]
,[Total API tkts (with all closure reasons )] - [Not Handled (with closure reason (customer not respond or duplicated))]  [Handled (with closure reason not (customer not respond or duplicated))]

,[Not Handled (with closure reason (customer not respond or duplicated))]
from Total
left join not_handled on not_handled.[Date] = Total.[date] and not_handled.Ticket_group = Total.Ticket_group
where  Total.[Date] between '$mydate' and '$mydate2' and ([Total_no_Tickets_SD+PSD].[Ticket_group] LIKE 'private KAM%' 
       OR [Total_no_Tickets_SD+PSD].[Ticket_group] LIKE 'GDS%')
");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Date"]->format('Y/m/d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>'; 
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Total API tkts (with all closure reasons )"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Handled (with closure reason not (customer not respond or duplicated))"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Not Handled (with closure reason (customer not respond or duplicated))"].'</td>';

$rows .='</tr>';
echo $rows;
}}else{
    $distinct = sqlsrv_query($con,"with not_handled as (
SELECT 
cast(Final_close as date) [Date]
,Ticket_group,subgroup
,count([RequestID]) [Not Handled (with closure reason (customer not respond or duplicated))]


  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where closure_reason  in ('Customer not Respond','Duplicated tickets') and Ticket_group is not null and [ticket_status]  like '%Close%' and request_mode = 'API'
  group by cast(Final_close as date),Ticket_group,subgroup
),

Total as (
SELECT 
cast(Final_close as date) [Date]
,Ticket_group,subgroup
,count([RequestID]) [Total API tkts (with all closure reasons )]

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where  Ticket_group is not null and [ticket_status]  like '%Close%' and request_mode = 'API'
  group by cast(Final_close as date),Ticket_group,subgroup
)


select Total.[Date]
,Total.Ticket_group,total.subgroup
,[Total API tkts (with all closure reasons )]
,[Total API tkts (with all closure reasons )] - [Not Handled (with closure reason (customer not respond or duplicated))]  [Handled (with closure reason not (customer not respond or duplicated))]

,[Not Handled (with closure reason (customer not respond or duplicated))]
from Total
left join not_handled on not_handled.[Date] = Total.[date] and not_handled.Ticket_group = Total.Ticket_group
where  Total.[Date] between '$mydate' and '$mydate2' and Total.Ticket_group like '$my_group%'
");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Date"]->format('Y/m/d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>'; 
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Total API tkts (with all closure reasons )"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Handled (with closure reason not (customer not respond or duplicated))"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Not Handled (with closure reason (customer not respond or duplicated))"].'</td>';

$rows .='</tr>';
echo $rows;
}
}}
}
}
  ?>
  <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "API statistics.xls"
            });
        }
    </script>
</div>
</tbody>
</table>
</div>

<?php 
}
?>
  </form>
</div>
<script src="js/table2excel.js" type="text/javascript"></script>

<?php
 include ("footer.html");
 ?>


