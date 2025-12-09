
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
  if (isset($_GET['Mail'])) {
  ?>

  <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Daily Average response time for Mail 
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
</div>

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
<th ><center>Average Response time</center></th>

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


   $distinct = sqlsrv_query($con,"with x as (SELECT
    cast(creation_time as date) [date]
   
    , Ticket_group,subgroup
   , avg(cast(cast(First_Resp_Time as datetime)-cast([creation_time] as datetime) as float)) Resp_Time
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [RequestID]  not in ( SELECT [RequestID]
     
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where  closure_reason  in ('Duplicated tickets')) and Request_Mode = 'E-Mail'
   group by  cast(creation_time as date),     Ticket_group,subgroup)

   select [date],Ticket_group,subgroup,
   right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast(Resp_Time as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast(Resp_Time as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast(Resp_Time as float)) AS DATETIME)))% 60 )),2) as [Average Response time]
   from x
   where [date] BETWEEN '$mydate' AND '$mydate2'  and (ticket_group like 'private KAM%' or ticket_group like 'GDS%')
   group by[date],Ticket_group,subgroup
   order by 1,2
 ");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>';

  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Average Response time"].'</td>';

$rows .='</tr>';
echo $rows;
}
}else{
  $distinct = sqlsrv_query($con,"with x as (SELECT
    cast(creation_time as date) [date]
   
    , Ticket_group,subgroup
   , avg(cast(cast(First_Resp_Time as datetime)-cast([creation_time] as datetime) as float)) Resp_Time
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [RequestID]  not in ( SELECT [RequestID]
     
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where  closure_reason  in ('Duplicated tickets','Wrong Ticket')) and Request_Mode = 'E-Mail'
   group by  cast(creation_time as date),     Ticket_group,subgroup)

   select [date],Ticket_group,subgroup,
   right('0' + convert(varchar(9),((datediff(second,0,CAST(sum(cast(Resp_Time as float)) AS DATETIME))) / 3600 )),3) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast(Resp_Time as float)) AS DATETIME))) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,CAST(sum(cast(Resp_Time as float)) AS DATETIME)))% 60 )),2) as [Average Response time]
   from x
   where [date] BETWEEN '$mydate' AND '$mydate2'  and 
   (('$my_group' = 'BS-CO' AND Ticket_group LIKE 'BS-CO%')
      OR ('$my_group' <> 'BS-CO' AND Ticket_group 
      LIKE '$my_group%' AND Ticket_group NOT LIKE 'BS-CO%'))
   group by[date],Ticket_group,subgroup
   order by 1,2 


                    ");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>';

  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Average Response time"].'</td>';

$rows .='</tr>';
echo $rows;
}
}
}
}}
  ?>

  <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Average response time for Mai.xls"
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
  if (isset($_GET['Mail2'])) {
  ?>
   
<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Daily No. of tkts for each mode ( API – Mail – Phone call )
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
</div>

            <div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >Submit</button></div>
   
<br>


<!-- </div> -->
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
<th ><center>phone call</center></th>
<th ><center>API</center></th>
<th ><center>E-mail</center></th> 
<th ><center>web form</center></th>
<th ><center>ESLM</center></th>
<th ><center>Internal Reference</center></th>
<th ><center>sms</center></th>
<th ><center>twitter</center></th>

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

$distinct = sqlsrv_query($con,"with x as (select * from (SELECT cast(creation_time as date) [date]
,[Ticket_group],subgroup
    ,[Request_Mode]
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [RequestID]  not in ( SELECT [RequestID]
      
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where  closure_reason  in ('Duplicated tickets')) 

 -- group by Ticket_group,cast(creation_time as date)
 ) t

  pivot (count([Request_Mode])
  for [Request_Mode] in (
  [Phone Call],
  [API],
  [E-Mail],
  [Web Form],
  [ESLM],
  [Internal Reference],
  [SMS],
  [Twitter])
  ) AS pivot_table)

  select * from x
    where [date] BETWEEN '$mydate' AND '$mydate2'  and (ticket_group like 'private KAM%' or ticket_group like 'GDS%')
  order by 1

 ");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>';

  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Phone Call"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["API"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["E-Mail"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Web Form"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["ESLM"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Internal Reference"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["SMS"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Twitter"].'</td>';
$rows .='</tr>';
echo $rows;
}}
  else{
   $distinct = sqlsrv_query($con,"with x as (select * from (SELECT cast(creation_time as date) [date]
  
,[Ticket_group],subgroup
    ,[Request_Mode]
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where [Fake_Real] = 'Real Ticket' and [Ticket_group] is not null and [RequestID]  not in ( SELECT [RequestID]
      
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where  closure_reason  in ('Duplicated tickets')) 

 -- group by Ticket_group,cast(creation_time as date)
 ) t

  pivot (count([Request_Mode])
  for [Request_Mode] in (
  [Phone Call],
  [API],
  [E-Mail],
  [Web Form],
  [ESLM],
  [Internal Reference],
  [SMS],
  [Twitter])
  ) AS pivot_table)

  select * from x
    where [date] BETWEEN '$mydate' AND '$mydate2'  
    and (('$my_group' = 'BS-CO' AND Ticket_group LIKE 'BS-CO%')
     OR ('$my_group' <> 'BS-CO' AND Ticket_group LIKE '$my_group%' AND Ticket_group NOT LIKE 'BS-CO%'))

  order by 1

 ");
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Ticket_group"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["subgroup"].'</td>';

  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Phone Call"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["API"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["E-Mail"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Web Form"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["ESLM"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Internal Reference"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["SMS"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Twitter"].'</td>';
$rows .='</tr>';
echo $rows;
}}
}
}}
  ?>

  <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "No. of tkts for each mode.xls"
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
<script src="js/table2excel.js" type="text/javascript">
</script>

<?php
 include ("footer.html");
 ?>

