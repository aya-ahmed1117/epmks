
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
  if (isset($_GET['PSD'])) {
  ?>

  <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Daily Average MTTR for all SD tickets either was escalated to onsite or not by mode‏

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
<th ><center>API</center></th>
<th ><center>E-mail</center></th>  
<th ><center>ESLM</center></th>
<th ><center>Internal Reference</center></th>
<th ><center>phone call</center></th>
<th ><center>sms</center></th>
<th ><center>twitter</center></th>
<th ><center>web form</center></th>
    </tr>
    </thead>
  <tbody>

<?php 
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

  if(isset($_POST['submit'])){
//date 1  
if(isset($_POST['date'])){$mydate = $_POST['date'];
// date 2
if(isset($_POST['date2'])){$mydate2 = $_POST['date2'];

if(($_SESSION['username'] == 'ahmed.mohamedbassal') ||
    ($_SESSION['username'] == 'mohamed.abdeltwab') ){

   $distinct = sqlsrv_query($con,"with x as (

select * from (SELECT
    cast(creation_time as date) [date]
    , cast(cast([Final_close] as datetime)-cast([creation_time] as datetime) as float) [MTTR]
    , Ticket_group
  ,subgroup
     , [Request_Mode]


  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [RequestID]  not in ( SELECT [RequestID]
     
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where  closure_reason  in ('Duplicated tickets')) and ticket_status like '%close%'
   ) t

   pivot(

   avg([MTTR])

   for [Request_Mode] in (
   [API],
   [E-mail],
   [ESLM],
   [Internal Reference],
   [phone call],
   [sms],
   [twitter],
   [web form]
   )) as pivot_table)

   select [date],ticket_group,subgroup,

right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([API] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([API] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([API] as float)) AS DATETIME)))% 60 )),2) as API
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([E-mail] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([E-mail] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([E-mail] as float)) AS DATETIME)))% 60 )),2) as [E-mail]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([ESLM] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([ESLM] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([ESLM] as float)) AS DATETIME)))% 60 )),2) as [ESLM]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([Internal Reference] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Internal Reference] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Internal Reference] as float)) AS DATETIME)))% 60 )),2) as [Internal Reference]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([phone call] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([phone call] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([phone call] as float)) AS DATETIME)))% 60 )),2) as [phone call]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([sms] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([sms] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([sms] as float)) AS DATETIME)))% 60 )),2) as [sms]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([twitter] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([twitter] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([twitter] as float)) AS DATETIME)))% 60 )),2) as [twitter]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([web form] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([web form] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([web form] as float)) AS DATETIME)))% 60 )),2) as [web form]
from x
where [date] BETWEEN '$mydate' AND '$mydate2'  and (ticket_group like 'private KAM%' or ticket_group like 'GDS%')

group by [date],ticket_group,subgroup
order by 1,2
 ");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["API"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["E-mail"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["ESLM"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Internal Reference"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["phone call"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["sms"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["twitter"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["web form"].'</td>';
$rows .='</tr>';
echo $rows;

}
}else{
    $distinct = sqlsrv_query($con,"with x as (

select * from (SELECT
    cast(creation_time as date) [date]
    , cast(cast([Final_close] as datetime)-cast([creation_time] as datetime) as float) [MTTR]
    , Ticket_group
  ,subgroup
     , [Request_Mode]


  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [RequestID]  not in ( SELECT [RequestID]
     
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where  closure_reason  in ('Duplicated tickets')) and ticket_status like '%close%'



   ) t

   pivot(

   avg([MTTR])

   for [Request_Mode] in (
   [API],
   [E-mail],
   [ESLM],
   [Internal Reference],
   [phone call],
   [sms],
   [twitter],
   [web form]
   )) as pivot_table)

   select [date],ticket_group,subgroup,

right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([API] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([API] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([API] as float)) AS DATETIME)))% 60 )),2) as API
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([E-mail] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([E-mail] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([E-mail] as float)) AS DATETIME)))% 60 )),2) as [E-mail]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([ESLM] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([ESLM] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([ESLM] as float)) AS DATETIME)))% 60 )),2) as [ESLM]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([Internal Reference] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Internal Reference] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Internal Reference] as float)) AS DATETIME)))% 60 )),2) as [Internal Reference]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([phone call] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([phone call] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([phone call] as float)) AS DATETIME)))% 60 )),2) as [phone call]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([sms] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([sms] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([sms] as float)) AS DATETIME)))% 60 )),2) as [sms]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([twitter] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([twitter] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([twitter] as float)) AS DATETIME)))% 60 )),2) as [twitter]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([web form] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([web form] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([web form] as float)) AS DATETIME)))% 60 )),2) as [web form]
from x
where [date] BETWEEN '$mydate' AND '$mydate2'  
and (('$my_group' = 'BS-CO' AND Ticket_group LIKE 'BS-CO%')
     OR ('$my_group' <> 'BS-CO' AND Ticket_group LIKE '$my_group%' AND Ticket_group NOT LIKE 'BS-CO%'))


group by [date],ticket_group,subgroup
order by 1,2
 ");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["API"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["E-mail"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["ESLM"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Internal Reference"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["phone call"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["sms"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["twitter"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["web form"].'</td>';
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
                filename: "AverageMTTR(SD+PSD).xls"
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
  if (isset($_GET['MTTR'])) {
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
                Daily Average MTTR for SD tickets which were not escalated to onsite group by mode‏

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


    <div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >
    Submit</button>
</div>

        </div>
    </div>
</div>


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
    <div style="padding: 20px;">
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead >
    <tr>
<th><center> Date</center></th>
<th><center> ticket_group</center></th>
<th><center> subgroup</center></th>
<th ><center>API</center></th>
<th ><center>E-mail</center></th>
<th ><center>ESLM</center></th> 
<th ><center>Internal Reference</center></th>
<th ><center>phone call</center></th>
<th ><center>sms</center></th>
<th ><center>twitter</center></th>
<th ><center>web form</center></th>
    </tr>
    </thead>
  <tbody>

<?php 
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

  if(isset($_POST['submit'])){
//date 1  
if(isset($_POST['date'])){$mydate = $_POST['date'];
// date 2
if(isset($_POST['date2'])){$mydate2 = $_POST['date2'];

if(($_SESSION['username'] == 'ahmed.mohamedbassal') ||
    ($_SESSION['username'] == 'mohamed.abdeltwab') ){


   $distinct = sqlsrv_query($con,"with x as (

select * from (SELECT
    cast(creation_time as date) [date]
    , cast(cast([Final_close] as datetime)-cast([creation_time] as datetime) as float) [MTTR]
    , Ticket_group,subgroup
     , [Request_Mode]

 FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [Onsite_status]='no' and [RequestID]  not in ( SELECT [RequestID]
     
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where  closure_reason  in ('Duplicated tickets')) and ticket_status like '%close%'



  ) t

  pivot(

  avg([MTTR])

  for [Request_Mode] in (
  [API],
  [E-mail],
  [ESLM],
  [Internal Reference],
  [phone call],
  [sms],
  [twitter],
  [web form]
  )) as pivot_table)

  select [date],ticket_group,subgroup,

right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([API] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([API] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([API] as float)) AS DATETIME)))% 60 )),2) as API
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([E-mail] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([E-mail] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([E-mail] as float)) AS DATETIME)))% 60 )),2) as [E-mail]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([ESLM] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([ESLM] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([ESLM] as float)) AS DATETIME)))% 60 )),2) as [ESLM]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([Internal Reference] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Internal Reference] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Internal Reference] as float)) AS DATETIME)))% 60 )),2) as [Internal Reference]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([phone call] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([phone call] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([phone call] as float)) AS DATETIME)))% 60 )),2) as [phone call]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([sms] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([sms] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([sms] as float)) AS DATETIME)))% 60 )),2) as [sms]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([twitter] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([twitter] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([twitter] as float)) AS DATETIME)))% 60 )),2) as [twitter]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([web form] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([web form] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([web form] as float)) AS DATETIME)))% 60 )),2) as [web form]

from x
where [date] BETWEEN '$mydate' AND '$mydate2'  and (ticket_group like 'private KAM%' or ticket_group like 'GDS%')
group by [date],ticket_group,subgroup
order by 1,2

 ");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td style="font-size:15px;border: 1px solid lightgray;">'.$output["date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["API"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["E-mail"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["ESLM"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Internal Reference"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["phone call"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["sms"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["twitter"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["web form"].'</td>';
$rows .='</tr>';
echo $rows;
}
}
else{
    $distinct = sqlsrv_query($con,"with x as (

select * from (SELECT
    cast(creation_time as date) [date]
    , cast(cast([Final_close] as datetime)-cast([creation_time] as datetime) as float) [MTTR]
    , Ticket_group,subgroup
     , [Request_Mode]


  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null 
   and [Onsite_status]='no' and [RequestID]  not in ( SELECT [RequestID]
     
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where  closure_reason  in ('Duplicated tickets')) and ticket_status like '%close%'



  ) t

  pivot(

  avg([MTTR])

  for [Request_Mode] in (
  [API],
  [E-mail],
  [ESLM],
  [Internal Reference],
  [phone call],
  [sms],
  [twitter],
  [web form]
  )) as pivot_table)

  select [date],ticket_group,subgroup,

right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([API] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([API] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([API] as float)) AS DATETIME)))% 60 )),2) as API
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([E-mail] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([E-mail] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([E-mail] as float)) AS DATETIME)))% 60 )),2) as [E-mail]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([ESLM] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([ESLM] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([ESLM] as float)) AS DATETIME)))% 60 )),2) as [ESLM]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([Internal Reference] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Internal Reference] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([Internal Reference] as float)) AS DATETIME)))% 60 )),2) as [Internal Reference]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([phone call] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([phone call] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([phone call] as float)) AS DATETIME)))% 60 )),2) as [phone call]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([sms] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([sms] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([sms] as float)) AS DATETIME)))% 60 )),2) as [sms]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([twitter] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([twitter] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([twitter] as float)) AS DATETIME)))% 60 )),2) as [twitter]
,right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast([web form] as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([web form] as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast([web form] as float)) AS DATETIME)))% 60 )),2) as [web form]

from x
where [date] BETWEEN '$mydate' AND '$mydate2'  
and (('$my_group' = 'BS-CO' AND Ticket_group LIKE 'BS-CO%')
     OR ('$my_group' <> 'BS-CO' AND Ticket_group LIKE '$my_group%' AND Ticket_group NOT LIKE 'BS-CO%'))

group by [date],ticket_group,subgroup
order by 1,2

 ");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td style="font-size:15px;border: 1px solid lightgray;">'.$output["date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["API"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["E-mail"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["ESLM"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Internal Reference"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["phone call"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["sms"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["twitter"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["web form"].'</td>';
$rows .='</tr>';
echo $rows;


}
}
}
}}
  ?>
</div>
</tbody>
</table>
</div>
</div>
<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Average_MTTR_SD.xls"
            });
        }
    </script>

<?php 
}
?>

  </form>

</div>
<script src="js/table2excel.js" type="text/javascript"></script>

<?php
 include ("footer.html");
 ?>

