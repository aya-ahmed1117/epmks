

<?php
 //session_start(); 
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
  if($_SESSION['username'] == ''){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      ?>
<!DOCTYPE html>
<html>

<head>
      <title>Employee Violation</title>
      <link rel="icon" href="imag/logo.jpg">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
 
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome22.min.css">
<link rel="stylesheet" href="css/bootstrap2.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style4.css">
<link rel="stylesheet" href="css/bootstrap-3.1.1.min.css" type="text/css" />

    


</head>
<body >
	<div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul style="margin-left: -5%;">
      	<img src="imag/logo.jpg" alt="logo.jpg" style="padding-top: 1px; padding-left: 1px; width: 25px; margin-bottom: 3px; ">
      	<span style="font-size:15px;font-family: Century Gothic; ">
      WorkForce Managment Tool</span></ul>
      <a href="senior_home.php">
                    <button type="button" id="sidebarCollapse" class="btn btn-info" style="margin-left:11%;" > Home
                    </button></a>

                    <a href="mwd_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" style="margin-left:11%;" >
                      <i class="fas fa-backward"></i>  Back
                    </button></a> 
  
                        <ul class="nav navbar-nav ml-auto">
 <li ><a href="#" style="font-size: 9.5px;"><span class="glyphicon glyphicon-user"></span> login as     <samp>  :  </samp>
        <?php echo $_SESSION["username"];?><h6 style="color: orange;font-size: 10px;text-align: justify;text-indent: 10px;letter-spacing: -.5px;line-height: 0.8;" ></h6></a></li>
                          
<li><a href="?logout"><span class="glyphicon glyphicon-log-in "></span> Logout</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
     <style type="text/css">
           	.head{
           		font-size: 20px;
           		background-color:#002060;border: 1px solid #666;color:#eee;
           	}
           	
           	.wrapper {
    height: 100%;
    position: relative;
     overflow-y: hidden; 
     overflow-x: auto; 
}
.tableFixHead         
 { 
 	overflow-y: auto; height:500px; overflow-x: auto; width:100%;
 }
.tableFixHead thead th 
{ 
	position: sticky; top: 0; 
}
           </style>
		
<a role="button" id="btnExport" value="Export to Excel"  onclick="Export()">
    <img src="imag/excel2.png" style="width:7%;float:right;transform: translate(0,-10px);"></a>
 <div class="form-group">
           <label  style=" font-weight: bold;font-size: 20px;" >Employee Violation <spam style="color: orange;">yesterday</spam></label>
  
</div>
<br>
<br>
<br>

<form method="post" >
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">


<div class="tableFixHead" >

<table class="table table-hover order-table"  cellspacing="0" id="tblCustomers" align="center" >
	
  <thead  style="background-color:rgb(120, 120, 120); color: white; font-weight: bold; text-align: center;vertical-align: middle;" align="center">
  	<tr align="center">
  		<center>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>ID</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>username</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>manager</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTI1 Avg</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>mtti1 tickets</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTI2 Avg</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTI2 tickets</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTI Avg</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTI Tickets</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTI Violation</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTI viol</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTV Avg</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTV Tickets</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTV Violation</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTV viol</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTR Avg</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTR Tickets</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTR violation</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>MTTR viol</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Closure Tickets</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Closure Reason V</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Closure viol</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Node tickets</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>Node violation</center></th>
<th style="font-size: 14px;background-color:#002060;border: 1px solid #666;color:#eee;vertical-align: middle;text-align: center;"><center>% Node viol</th></center>
		
		</tr>
		</thead>
	</center>
  <tbody>

<?php
if($_SESSION['role_id'] == 0){
 //include "AHTyesterday.php";
      $_GET['yesterday']="yesterday";
include ("violations_ywm.php");
 //if (($someday = 'yesterday') || ($somedayweek != 'week') ){
    global $someday;
 

      }else{
   $new_query = sqlsrv_query($connect , "WITH Sch_tbl as (

SELECT [username]

      ,[schedule_date]

      ,[senior]

      ,dateadd(hour,-5,(cast([shift_start] as datetime)+cast([schedule_date] as datetime))) [Start_Shift]

      ,dateadd(hour,5,(IIF(([shift_start] between '12:00:00' and '23:59:59' and (cast(cast([shift_end] as datetime)-cast
    ([shift_start] as datetime) as time) ='12:00:00') or ([shift_start] between '16:00:00' and '23:59:59')),
    (cast([shift_end] as datetime)+DATEADD(day,1,cast([schedule_date] as datetime))),
    (cast([shift_end] as datetime)+cast([schedule_date] as datetime))) ))[End_Shift]

  FROM [Aya_Web_APP].[dbo].[schedule_table]

  WHERE [shift_start] <> 'off' and year([schedule_date])>=2020 and [username] in

  (SELECT distinct [username]

  FROM [Employess_DB].[dbo].[tbl_Personal_info]

  where [unit] = 12 and [Grade] = 'l8' )

  ),

 

MTTI_1 as (SELECT  [MTTI1_eng]

  ,[senior] [Manager]

  ,count(RequestID) MTTI1_Tickets

  ,CAST(AVG(CAST(( iIF([First_in_progress] is null,Null,iIF([Creation_Time]>[First_in_progress],0,
  [First_in_progress]-[Creation_Time]))) AS FLOAT)) AS DATETIME) MTTI1_Avg

  from (select distinct MTTI1_eng,creation_time,First_in_progress,RequestID,Fake_Real

from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B right join Sch_tbl on  [First_in_progress] 
between [Start_Shift] and [End_Shift] and [MTTI1_eng]=[username]

  where  Dateadd (dd, 0, DATEDIFF(dd, 0, First_in_progress))=DATEADD(day,-1,cast(getdate()as date))

  and Fake_Real = 'Real Ticket' and MTTI1_eng is not null

group by [MTTI1_eng], [senior] ),

 

Mtti_2 as

 (select   [MTTI2_eng]

,[senior] [Manager]

,CAST(AVG(CAST((iIF([First_category] is null,null,(iIF([First_in_progress] is null,null,iIF([First_in_progress]>
[First_category],null,[First_category]-[First_in_progress])))) )AS FLOAT)) AS DATETIME) MTTI2_Avg

,count( RequestID) MTTI2_Tickets

       from (select distinct MTTI2_eng,creation_time,First_in_progress,RequestID,Fake_Real,[First_category]

from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B  right join Sch_tbl on  [First_category] between
[Start_Shift] and [End_Shift] and [MTTI2_eng]=[username]

  where   Dateadd (dd, 0, DATEDIFF(dd, 0, [First_category]))= DATEADD(day,-1,cast(getdate()as date)) and
  Fake_Real = 'Real Ticket' and MTTI2_eng is not null

group by [MTTI2_eng],[senior] ), 

 

MTTI as

 (select

[MTTI2_eng] [MTTI_eng]

,[senior] Manager

,CAST(AVG(CAST((iIF([First_category] is null,null,IiF([creation_time]>[First_category],null,[First_category]-[creation_time]))) AS FLOAT)) AS DATETIME) MTTI_Avg

,count(requestID) MTTI_Tickets

from (select distinct MTTI2_eng,creation_time,RequestID,Fake_Real,[First_category]

from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B  right join Sch_tbl on  [First_category] between [Start_Shift] and [End_Shift] and [MTTI2_eng]=[username]

  where  Dateadd (dd, 0, DATEDIFF(dd, 0, [First_category]))= DATEADD(day,-1,cast(getdate()as date)) and Fake_Real = 'Real Ticket' and MTTI2_eng is not null

group by [MTTI2_eng],[senior] ),

 

 

Mttv as (

select [MTTV_eng]

,[senior] manager

,CAST(AVG(CAST((iIF([Final_close] is null,null,IiF([Resolve_time] is null ,null ,iIF([Resolve_time]>[Final_close],null,[Final_close]-[Resolve_time])))) AS FLOAT)) AS DATETIME) MTTV_avg

,count( requestID) MTTV_Tickets

from (select distinct MTTV_eng,creation_time,RequestID,Fake_Real,[Final_close],[Resolve_time]

from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B  right join Sch_tbl on  [Final_close] between [Start_Shift] and [End_Shift] and [MTTV_eng]=[username]

  where  Dateadd (dd, 0, DATEDIFF(dd, 0, [Final_close]))=DATEADD(day,-1,cast(getdate()as date)) and Fake_Real = 'Real Ticket' and MTTV_eng is not null

group by MTTV_eng,senior ),

 

MTTR as (select [Last_engineer] [MTTR_Eng]

          ,[senior] manager

         ,CAST(AVG(CAST((iIF([Final_close] is null,null,[Final_close]-[creation_time])) AS FLOAT)) AS DATETIME) MTTR_Avg

             ,count(RequestID) MTTR_Tickets

  from (select distinct [Last_engineer] ,creation_time,RequestID,Fake_Real,[Final_close] from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B  right join Sch_tbl on [Final_close] between [Start_Shift] and [End_Shift]  and [Last_engineer]=[username]

  where Dateadd (dd, 0, DATEDIFF(dd, 0, [Final_close]))= DATEADD(day,-1,cast(getdate()as date)) and Fake_Real = 'Real Ticket' and [Last_engineer] is not null

group by [Last_engineer],[senior] ),

 

Closure_Tickets as

( select [closure_Reason_Eng]

          ,[senior] manager

          ,count(RequestID) Closure_Tickets

   from (select distinct [closure_Reason_Eng] ,creation_time,RequestID,Fake_Real,ticket_status, [Final_close] from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B right join Sch_tbl on [Final_close] between [Start_Shift] and [End_Shift]  and [closure_Reason_Eng]=[username]

  where  Dateadd (dd, 0, DATEDIFF(dd, 0, [Final_close]))= DATEADD(day,-1,cast(getdate()as date)) and Fake_Real = 'Real Ticket' and [closure_Reason_Eng] is not null and ticket_status='closed'

group by [closure_Reason_Eng],[senior] ),

 

---node tickets

node_phase1 as (select distinct requestID,iif([nodeID] like '%hosting%' or nodeID like '%Non-support%' or nodeID like '%School Project%'or nodeid like '%NID-4G-%' or nodeid like '%NID-pending%'or nodeid like '%NID-L1%'or nodeid like '%NID-NA%',null,(iif ([closure_reason] = 'Duplicated tickets',0,(iif ([Trasmission_media] = '3g or 4g',null,(iif( [Category] = 'Request' and Subcategory in ('Monitoring','MRTG','TACACS'),null,1))))))) [nodeID_status]

  from [dbo].[KPI_Status_RawData] ),

 

Node_tickets as (

select [Last_engineer] [MTTR_Eng]

       ,[senior] manager

       ,count(RI) Node_Tickets

  from (select distinct [Last_engineer],creation_time,RequestID [RI],Fake_Real,ticket_status, [Final_close],nodeID,[closure_reason],[Trasmission_media],[Category],Subcategory from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B

  right join Sch_tbl on [Final_close] between [Start_Shift] and [End_Shift] and [Last_engineer]=[username]

  left join node_phase1 on node_phase1.requestID=RI

  where   Dateadd (dd, 0, DATEDIFF(dd, 0, [Final_close]))= DATEADD(day,-1,cast(getdate()as date))

  and Fake_Real = 'Real Ticket' and [Last_engineer] is not null and ticket_status='closed' and node_phase1.[nodeID_status]=1

group by [Last_engineer],[senior]),

------------------------------------------------------

violation as (SELECT distinct

      year([creation_time]) [Year]

      ,datepart(week,[creation_time]) [week]

      ,[RequestID]

      ,iIF([PSD_number] is null ,'no PSD',[PSD_number]) [PSD_number]

      ,[creation_time]

      ,iIF([First_in_progress] is null,Null,iIF([Creation_Time]>[First_in_progress],null,[First_in_progress]-[Creation_Time])) MTTI1

      ,[MTTI1_eng]

      ,iIF([First_category] is null,null,(iIF([First_in_progress] is null,null,iIF([First_in_progress]>[First_category],null,[First_category]-[First_in_progress])))) MTTI2

      ,[First_category]

      ,[MTTI2_eng]

      ,iIF([First_category] is null,null,IiF([creation_time]>[First_category],0,[First_category]-[creation_time])) MTTI

      ,iif((iIF([First_category] is null,null,IiF([creation_time]>[First_category],null,[First_category]-[creation_time])))>'1900-01-01 00:45:00.000',1,0) MTTI_Violated

      ,iIF([Resolve_time] is null ,Null,iIF([First_category] is null,null,iIF([First_category]>[Resolve_time],null,[Resolve_time]-[First_category]))) MTTF

      ,[MTTF_Eng]

      ,iIF([Final_close] is null,null,IiF([Resolve_time] is null ,null ,iIF([Resolve_time]>[Final_close],null,[Final_close]-[Resolve_time]))) MTTV

      ,[MTTV_eng]

      ,iif((iIF([Final_close] is null,null,IiF([Resolve_time] is null ,null ,iIF([Resolve_time]>[Final_close],null,[Final_close]-[Resolve_time]))))>'1900-01-01 00:30:00.000',1,0) MTTV_Violated

      ,iIF([Final_close] is null,null,[Final_close]-[creation_time]) MTTR

      ,[Final_close]

      ,iif((iIF([Final_close] is null,null,[Final_close]-[creation_time]))>'1900-01-02 00:00:00.000',1,0) MTTR_Violated

      ,[Reopen]

      ,[Category]

      ,[Ticket_group]

      ,[nodeID]

      , iif([nodeID] like '%NID-ICT%' or [nodeID] like '%schools_Project%' or [nodeID] like '%hosting%' or nodeID like '%Non-support%' or nodeID like '%School Project%',null,(iif ([closure_reason] = 'Duplicated tickets',null,(iif ([Trasmission_media] = '3g or 4g',null,(iif( [Category] = 'Request' and Subcategory in ('Monitoring','MRTG','TACACS'),null,(iif ([nodeID] in (SELECT distinct [NodeID]

         FROM [172.29.29.77].[WorkforceDB].[dbo].[all_nodes]),0,1))))))))) [nodeID_violation]

      ,[Item]

      ,[closure_reason]

      ,iif([closure_reason] is null or [closure_reason]='-',1,0) [Closure_violation]

    ,[closure_Reason_Eng]

      ,[Subcategory]

      ,[last_engineer]

 

  from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]

  where  Dateadd (dd, 0, DATEDIFF(dd, 0, [First_in_progress]))= DATEADD(day,-1,cast(getdate()as date))

  or  Dateadd (dd, 0, DATEDIFF(dd, 0, [First_category]))= DATEADD(day,-1,cast(getdate()as date))

  or Dateadd (dd, 0, DATEDIFF(dd, 0,[Final_close]))= DATEADD(day,-1,cast(getdate()as date)) and Fake_Real = 'Real Ticket')

  ,

 

   MTTI_Viol as

  (select MTTI2_eng ,[senior] [Manager], sum(MTTI_Violated) MTTI_Violation

  from (

  select distinct RequestID, MTTI2_eng,MTTI_Violated,First_category from violation

  where  Dateadd (dd, 0, DATEDIFF(dd, 0, [First_category]))=  DATEADD(day,-1,cast(getdate()as date))) M_V

right join Sch_tbl on  [M_V].[First_category] between [Sch_tbl]. [Start_Shift] and [Sch_tbl].[End_Shift] and [M_V].[MTTI2_eng]=[Sch_tbl].[username]

  where  MTTI2_eng is not null

  group by MTTI2_eng,[senior] ) ,

 

 

   MTTV_viol as

  (select MTTV_eng ,[senior] [Manager], sum(MTTV_Violated) MTTV_Violation

  from (select distinct RequestID, MTTV_eng,MTTV_Violated,[Final_close] from violation

  where  Dateadd (dd, 0, DATEDIFF(dd, 0, [Final_close]))=  DATEADD(day,-1,cast(getdate()as date)) )V_V

  right join Sch_tbl on [Final_close] between [Start_Shift] and End_Shift and [MTTV_eng]=[username]

  where MTTV_eng is not null

  group by MTTV_eng,[senior]),

 

  MTTR_viol as

  (select [Last_engineer] [MTTR_Eng],[senior] [Manager], sum(MTTR_violated) MTTR_violation

  from (select distinct RequestID,[last_engineer],MTTR_Violated,[final_close] from violation where

   Dateadd (dd, 0, DATEDIFF(dd, 0,[Final_close]))=  DATEADD(day,-1,cast(getdate()as date))  ) R

  right join Sch_tbl on  [Final_close] between [Start_Shift] and End_Shift and [Last_engineer]=[username]

  where [Last_engineer] is not null

  group by [last_engineer],[senior]),

 

  node_viol as

  (select [last_engineer] Node_Eng ,[senior] [Manager], sum(nodeID_violation) Node_violation

  from (select distinct RequestID,[last_engineer],nodeID_violation,[Final_close] from violation where  Dateadd (dd, 0, DATEDIFF(dd, 0, [Final_close]))=  DATEADD(day,-1,cast(getdate()as date))

  ) N_V

  right join [Sch_tbl] on  [Final_close] between [Start_Shift] and End_Shift and [Last_engineer]=[username] and [Final_close] is not null

  where [last_engineer] is not null

  group by [last_engineer],[senior] ),

 

  Closure_viol as

  (select closure_reason_eng,[senior] [manager],sum(closure_violation) Closure_Reason_violation

  from (select distinct RequestID,closure_reason_eng,Closure_violation,Final_close from violation where Dateadd (dd, 0, DATEDIFF(dd, 0, [Final_close]))=  DATEADD(day,-1,cast(getdate()as date))) c

  right join [Sch_tbl] on  [Final_close] between [Start_Shift] and End_Shift and closure_reason_eng=[username] and [Final_close] is not null

where closure_reason_eng is not null

  group by closure_Reason_Eng,senior

  ) ,

 

  Sch_senior as (

  select distinct Sch_tbl.username [eng],Sch_tbl.senior [manager]

  from Sch_tbl 

  where Dateadd (dd, 0, DATEDIFF(dd, 0, [schedule_date]))=  DATEADD(day,-1,cast(getdate()as date)))

 

select ID

,[username]

,Sch_senior.manager

 

,MTTI1_Avg = right('0' + convert(varchar(9),((datediff(second,0,MTTI1_Avg)) / 3600 )),2) + ':'

              + right('0' + convert(varchar(2),((datediff(second,0,MTTI1_Avg)) / 60) % 60 ),2) + ':'

              + right('0' + convert(varchar(2),((datediff(second,0,MTTI1_Avg))% 60 )),2)

,mtti1_tickets

,MTTI2_Avg = right('0' + convert(varchar(9),((datediff(second,0,MTTI2_Avg)) / 3600 )),2) + ':'

              + right('0' + convert(varchar(2),((datediff(second,0,MTTI2_Avg)) / 60) % 60 ),2) + ':'

              + right('0' + convert(varchar(2),((datediff(second,0,MTTI2_Avg))% 60 )),2)

,MTTI2_tickets

,MTTI_Avg = right('0' + convert(varchar(9),((datediff(second,0,MTTI_Avg)) / 3600 )),2) + ':'

              + right('0' + convert(varchar(2),((datediff(second,0,MTTI_Avg)) / 60) % 60 ),2) + ':'

              + right('0' + convert(varchar(2),((datediff(second,0,MTTI_Avg))% 60 )),2)

,MTTI_Tickets

,MTTI_Violation

,cast (round (MTTI_Violation*100.0/MTTI_Tickets,1 ) as decimal(10,2)) as [%MTTI_viol]

,MTTV_Avg = right('0' + convert(varchar(9),((datediff(second,0,MTTV_Avg)) / 3600 )),2) + ':'

              + right('0' + convert(varchar(2),((datediff(second,0,MTTV_Avg)) / 60) % 60 ),2) + ':'

              + right('0' + convert(varchar(2),((datediff(second,0,MTTV_Avg))% 60 )),2)

,MTTV_Tickets

,MTTV_Violation

,cast (round (MTTV_Violation*100.0/MTTV_Tickets,1 ) as decimal(10,2)) as [%MTTV_viol]

,MTTR_Avg = right('0' + convert(varchar(9),((datediff(second,0,MTTR_Avg)) / 3600 )),2) + ':'

              + right('0' + convert(varchar(2),((datediff(second,0,MTTR_Avg)) / 60) % 60 ),2) + ':'

              + right('0' + convert(varchar(2),((datediff(second,0,MTTR_Avg))% 60 )),2)

,MTTR_Tickets

,MTTR_violation

,cast (round (MTTR_violation*100.0/MTTR_Tickets,1 ) as decimal(10,2)) as [%MTTR_viol]

,Closure_Tickets

,Closure_Reason_violation

,cast (round (Closure_Reason_violation*100.0/Closure_Tickets,1 ) as decimal(10,2)) as [%Closure_viol]

,Node_tickets

, Node_violation

,cast (round (Node_violation*100.0/Node_tickets,1 ) as decimal(10,2)) as [%Node_viol]

from [Employess_DB].[dbo].[tbl_Personal_info]

left join Sch_senior on eng=UserName

left join MTTI_1 on MTTI_1.[MTTI1_eng]=[UserName] and MTTI_1.Manager=Sch_senior.manager

left join Mtti_2 on Mtti_2.[MTTI2_eng]=[username] and MTTI_2.Manager=Sch_senior.manager

left join MTTI on MTTI.[MTTI_eng]=[UserName] and MTTI.Manager=Sch_senior.manager

left join MTTI_Viol on MTTI_Viol.MTTI2_eng=[UserName] and MTTI_Viol.Manager=Sch_senior.manager

left join Mttv on Mttv.[MTTV_eng]=[UserName] and mttv.manager=Sch_senior.manager

left join MTTV_viol on MTTV_viol.MTTV_eng=[UserName] and MTTV_viol.Manager=Sch_senior.manager

left join MTTR on MTTR.[MTTR_Eng]=[UserName] and MTTR.manager=Sch_senior.manager

left join MTTR_viol on MTTR_viol.MTTR_Eng=[UserName] and MTTR_viol.Manager=Sch_senior.manager

left join Closure_Tickets on Closure_Tickets.[closure_Reason_Eng]=[UserName] and Closure_Tickets.manager=Sch_senior.manager

left join Node_tickets on Node_Tickets.MTTR_Eng=[UserName] and Node_tickets.manager=Sch_senior.manager

left join  Closure_viol on  Closure_viol.closure_Reason_Eng=UserName and Closure_viol.manager=Sch_senior.manager

left join node_viol on node_viol.Node_Eng=UserName and node_viol.Manager=Sch_senior.manager

where Employee_Status='active' and unit=12 and grade='L8' and note is null  and Sch_senior.manager is not null
");
  


 		  while($echo = sqlsrv_fetch_array($new_query) ){

        $rows = '<tr>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['ID'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['username'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['manager'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['MTTI1_Avg'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['mtti1_tickets'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['MTTI2_Avg'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['MTTI2_tickets'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['MTTI_Avg'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['MTTI_Tickets'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['MTTI_Violation'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;background-color:lightgray;">'.floor($echo['%MTTI_viol']).'%'.'</td>';
		  	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['MTTV_Avg'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['MTTV_Tickets'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['MTTV_Violation'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;background-color:lightgray;">'.floor($echo['%MTTV_viol']).'%'.'</td>';
		  	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['MTTR_Avg'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['MTTR_Tickets'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['MTTR_violation'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;background-color:lightgray;">'.floor($echo['%MTTR_viol']).'%'.'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['Closure_Tickets'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['Closure_Reason_violation'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;background-color:lightgray;">'.floor($echo['%Closure_viol']).'%'.'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['Node_tickets'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['Node_violation'].'</td>';
	$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;background-color:lightgray;">'.floor($echo['%Node_viol']).'%'.'</td>';
		  	$rows .= '</tr>';
		  	echo $rows;

}
}
?>
 </tbody>
</table>
</div>
</div>
<script type='text/javascript'>
  
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
      Arr.forEach.call(tables, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);
  
</script>

</form>
<script src="js/table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Employee_Violation_previous_month.xls"
            });
        }
    </script>
</body>
</html>
