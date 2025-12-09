
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
  if (isset($_GET['exceeded'])) {
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
    Daily Table with tkts exceeded 4 hours Mttr in SD only 
 including Eng.Name
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
<th ><center> Ticket_group</center></th>
<th ><center> subgroup</center></th>
<th ><center>RequestID</center></th>
<th ><center>creation_time</center></th>
<th ><center>Complete_time</center></th>
<th ><center>MTTR</center></th>
<th ><center>First_Resp_Time</center></th>   
<th ><center>Request_Mode</center></th> 
<th ><center>Category</center></th> 
<th ><center>Subcategory</center></th> 
<th ><center>Item</center></th> 
<th ><center>closure_reason</center></th> 
<th ><center>Support Rep</center></th> 

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

   $distinct = sqlsrv_query($con,"with x3 as (
SELECT 
cast(creation_time as date) [date]
,Ticket_group,subgroup
,[RequestID]
,creation_time
,Final_close [Complete_time]
,cast(cast([Final_close] as datetime)-cast([creation_time] as datetime) as float) [MTTR]
,First_Resp_Time
,cast(cast(First_Resp_Time as datetime)-cast([creation_time] as datetime) as float) [Resp_Time]
,Request_Mode
,Category
,Subcategory
,Item
,closure_reason

,[Last_engineer] [Support Rep]
FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [Onsite_status]='no' and [RequestID]  not in ( SELECT [RequestID]
FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where  closure_reason  in ('Duplicated tickets')) and ticket_status like '%close%' and  DATEDIFF(hour,[creation_time],[Final_close]) >4

)

select 
[date]
,Ticket_group,subgroup
,[RequestID]
,creation_time
,[Complete_time]
, right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME)))% 60 )),2) as [MTTR]
,First_Resp_Time
, right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([Resp_Time] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Resp_Time] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Resp_Time] as float)) AS DATETIME)))% 60 )),2) as [Resp_Time_duration]
,Request_Mode
,Category
,Subcategory
,Item
,closure_reason
,[Support Rep]
from x3
where [date] between '$mydate' and '$mydate2'  and (ticket_group like 'private KAM%' or ticket_group like 'GDS%')

group by 
[date]
,Ticket_group,subgroup
,[RequestID]
,creation_time
,[Complete_time]
,First_Resp_Time
,Request_Mode
,Category
,Subcategory
,Item
,closure_reason
,[Support Rep]");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>';

  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["RequestID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["creation_time"]->format('Y-m-d H:i:s').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Complete_time"]->format('Y-m-d H:i:s').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTR"].'</td>';
    if($output["First_Resp_Time"] == NULL ){
$rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["First_Resp_Time"]->format('Y-m-d H:i:s').'</td>';}
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Request_Mode"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Category"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Subcategory"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Item"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["closure_reason"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Support Rep"].'</td>';
 
$rows .='</tr>';
echo $rows;
}}else{
    $distinct = sqlsrv_query($con,"with x3 as (
SELECT 
cast(creation_time as date) [date]
,Ticket_group,subgroup
,[RequestID]
,creation_time
,Final_close [Complete_time]
,cast(cast([Final_close] as datetime)-cast([creation_time] as datetime) as float) [MTTR]
,First_Resp_Time
,cast(cast(First_Resp_Time as datetime)-cast([creation_time] as datetime) as float) [Resp_Time]
,Request_Mode
,Category
,Subcategory
,Item
,closure_reason

,[Last_engineer] [Support Rep]
FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [Onsite_status]='no' and [RequestID]  not in ( SELECT [RequestID]
FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where  closure_reason  in ('Duplicated tickets')) and ticket_status like '%close%' and  DATEDIFF(hour,[creation_time],[Final_close]) >4


)

select 
[date]
,Ticket_group,subgroup
,[RequestID]
,creation_time
,[Complete_time]
, right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([MTTR] as float)) AS DATETIME)))% 60 )),2) as [MTTR]
,First_Resp_Time
, right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([Resp_Time] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Resp_Time] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Resp_Time] as float)) AS DATETIME)))% 60 )),2) as [Resp_Time_duration]
,Request_Mode
,Category
,Subcategory
,Item
,closure_reason
,[Support Rep]
from x3
where [date] between '$mydate' and '$mydate2'  and Ticket_group like '$my_group%'

group by 
[date]
,Ticket_group,subgroup
,[RequestID]
,creation_time
,[Complete_time]
,First_Resp_Time
,Request_Mode
,Category
,Subcategory
,Item
,closure_reason
,[Support Rep]");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>';

  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["RequestID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["creation_time"]->format('Y-m-d H:i:s').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Complete_time"]->format('Y-m-d H:i:s').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTR"].'</td>';
    if($output["First_Resp_Time"] == NULL ){
$rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["First_Resp_Time"]->format('Y-m-d H:i:s').'</td>';}
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Request_Mode"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Category"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Subcategory"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Item"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["closure_reason"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Support Rep"].'</td>';
 
$rows .='</tr>';
echo $rows;
}}
}
}
}
  ?>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "tkts exceeded 4 hours Mttr in SD.xls"
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
  if (isset($_GET['open'])) {
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
   Daily tkts exceeded 24 hours open
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
<th ><center> ticket_group</center></th>
<th ><center> subgroup</center></th>
<th><center>RequestID</center></th>
<th><center>creation_time</center></th>
<th><center>First_Resp_Time</center></th> 
<th><center>Resp_Time_duration</center></th>
<th><center>Request_Mode</center></th> 
<th><center>Category</center></th>
<th><center>Subcategory</center></th> 
<th><center>Item</center></th>
<th><center>closure_reason</center></th>  
<th><center>Support Rep</center></th>  

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

   $distinct = sqlsrv_query($con,"with x3 as (
SELECT 
cast(creation_time as date) [date]
,Ticket_group,subgroup
,[RequestID]
,creation_time
,First_Resp_Time
,cast(cast(First_Resp_Time as datetime)-cast([creation_time] as datetime) as float) [Resp_Time]
,Request_Mode
,Category
,Subcategory
,Item
,closure_reason

,[Last_engineer] [Support Rep]
FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where [Fake_Real] = 'Real Ticket' and [RequestID]  not in ( SELECT [RequestID]
FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where  closure_reason  in ('Duplicated tickets')) and ticket_status not like '%close%' and  DATEDIFF(hour,[creation_time],getdate()) >24
)
select 
[date]
,Ticket_group,subgroup
,[RequestID]
,creation_time
,First_Resp_Time
, right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([Resp_Time] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Resp_Time] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Resp_Time] as float)) AS DATETIME)))% 60 )),2) as [Resp_Time_duration]
,Request_Mode
,Category
,Subcategory
,Item
,closure_reason
,[Support Rep]
from x3
where [date] between '$mydate' and '$mydate2'  and (ticket_group like 'private KAM%' or ticket_group like 'GDS%')
group by 
[date]
,Ticket_group,subgroup
,[RequestID]
,creation_time
,First_Resp_Time
,Request_Mode
,Category
,Subcategory
,Item
,closure_reason
,[Support Rep]

order by 1,2");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>';
  
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["RequestID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["creation_time"]->format('Y-m-d H:i:s').'</td>';
  if($output["First_Resp_Time"] == NULL ){
    $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["First_Resp_Time"]->format('Y-m-d H:i:s').'</td>';}
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Resp_Time_duration"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Request_Mode"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Category"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Subcategory"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Item"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["closure_reason"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Support Rep"].'</td>';
  

$rows .='</tr>';
echo $rows;
}}else{
    $distinct = sqlsrv_query($con,"with x3 as (
SELECT 
cast(creation_time as date) [date]
,Ticket_group,subgroup
,[RequestID]
,creation_time
,First_Resp_Time
,cast(cast(First_Resp_Time as datetime)-cast([creation_time] as datetime) as float) [Resp_Time]
,Request_Mode
,Category
,Subcategory
,Item
,closure_reason

,[Last_engineer] [Support Rep]
FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where [Fake_Real] = 'Real Ticket' and [RequestID]  not in ( SELECT [RequestID]
FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where  closure_reason  in ('Duplicated tickets')) and ticket_status not like '%close%' and  DATEDIFF(hour,[creation_time],getdate()) >24
)
select 
[date]
,Ticket_group,subgroup
,[RequestID]
,creation_time
,First_Resp_Time
, right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([Resp_Time] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Resp_Time] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Resp_Time] as float)) AS DATETIME)))% 60 )),2) as [Resp_Time_duration]
,Request_Mode
,Category
,Subcategory
,Item
,closure_reason
,[Support Rep]
from x3
where [date] between '$mydate' and '$mydate2'  and Ticket_group like '$my_group%'

group by 
[date]
,Ticket_group,subgroup
,[RequestID]
,creation_time
,First_Resp_Time
,Request_Mode
,Category
,Subcategory
,Item
,closure_reason
,[Support Rep]

order by 1,2");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>';
  
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["RequestID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["creation_time"]->format('Y-m-d H:i:s').'</td>';
  if($output["First_Resp_Time"] == NULL ){
    $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["First_Resp_Time"]->format('Y-m-d H:i:s').'</td>';}
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Resp_Time_duration"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Request_Mode"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Category"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Subcategory"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Item"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["closure_reason"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Support Rep"].'</td>';
$rows .='</tr>';
echo $rows;
}}
}
}
}
  ?>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Daily tkts exceeded 24 hours open.xls"
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