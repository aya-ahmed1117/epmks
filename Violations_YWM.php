<link rel="stylesheet" type="text/css" href="css/kpi_css.css">
<style type="text/css">
.hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }</style>
<?php
$this_year = date('Y');
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


      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];

      // yesterday

       if(isset($_GET['yesterday'])){$someday = $_GET['yesterday'];

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

  WHERE [shift_start] <> 'off' and year([schedule_date])>='$this_year' and [username] in

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

node_phase1 as (select distinct requestID,iif([nodeID] like '%hosting%' or nodeID like '%Non-support%' or nodeID like '%School Project%'or nodeid like '%NID-4G%' or nodeid like '%NID-pending%'or nodeid like '%NID-L1%'or nodeid like '%NID-NA%',null,(iif ([closure_reason] = 'Duplicated tickets',0,(iif ([Trasmission_media] = '3g or 4g',null,(iif( [Category] = 'Request' and Subcategory in ('Monitoring','MRTG','TACACS'),null,1))))))) [nodeID_status]

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

      , iif([nodeID] like '%NID-ICT%' or [nodeID] like '%schools_Project%' or [nodeID] like '%hosting%' or nodeID like '%Non-support%' or nodeID like '%School Project%' or nodeid like '%NID-4G%' or nodeid like '%NID-pending%'or nodeid like '%NID-L1%'or nodeid like '%NID-NA%' ,null,(iif ([closure_reason] = 'Duplicated tickets',null,(iif ([Trasmission_media] = '3g or 4g',null,(iif( [Category] = 'Request' and Subcategory in ('Monitoring','MRTG','TACACS'),null,(iif ([nodeID] in (SELECT distinct [NodeID]

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

where Employee_Status='active' and unit=12 and grade='L8' and note is null  and Sch_senior.manager is not null and username ='$s_username'
");
  


      while($echo = sqlsrv_fetch_array($new_query) ){

$rows = '<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['ID'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['username'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['manager'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI1_Avg'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['mtti1_tickets'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_Avg'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_tickets'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI_Avg'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI_Tickets'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI_Violation'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%MTTI_viol']).'%'.'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_Avg'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_Tickets'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_Violation'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%MTTV_viol']).'%'.'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_Avg'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_Tickets'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_violation'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%MTTR_viol']).'%'.'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Closure_Tickets'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Closure_Reason_violation'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%Closure_viol']).'%'.'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Node_tickets'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Node_violation'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%Node_viol']).'%'.'</td>';
$rows .= '</tr>';
echo $rows;

}
}
?>
<?php
//week
if(isset($_GET['week'])){$week = $_GET['week'];
 $new_query = sqlsrv_query($connect , "
   WITH Sch_tbl as (
SELECT [username]
      ,[schedule_date]
      ,[senior]
      ,dateadd(hour,-5,(cast([shift_start] as datetime)+cast([schedule_date] as datetime))) [Start_Shift]
      ,dateadd(hour,5,(IIF(([shift_start] between '12:00:00' and '23:59:59' and (cast(cast([shift_end] as datetime)-cast([shift_start] as datetime) as time) ='12:00:00') or ([shift_start] between '16:00:00' and '23:59:59')),(cast([shift_end] as datetime)+DATEADD(day,1,cast([schedule_date] as datetime))),(cast([shift_end] as datetime)+cast([schedule_date] as datetime))) ))[End_Shift]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  WHERE [shift_start] <> 'off' and  DATEPART(week, schedule_date) = DATEPART(week, DATEADD(week, -1, getdate()))
  AND DATEPART(yyyy, schedule_date) >= '$this_year'
  and [username] in 
  (SELECT distinct [username]
  FROM [Employess_DB].[dbo].[tbl_Personal_info]
  where [unit] = 12 and [Grade] = 'l8' )
  ),

MTTI_1 as (SELECT  [MTTI1_eng]
  ,[senior] [Manager]
  ,count(RequestID) MTTI1_Tickets
  ,CAST(AVG(CAST(( iIF([First_in_progress] is null,Null,iIF([Creation_Time]>[First_in_progress],0,[First_in_progress]-[Creation_Time]))) AS FLOAT)) AS DATETIME) MTTI1_Avg
  from (select distinct MTTI1_eng,creation_time,First_in_progress,RequestID,Fake_Real
from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B right join Sch_tbl on  [First_in_progress] between [Start_Shift] and [End_Shift] and [MTTI1_eng]=[username]
  where   DATEPART(week, [First_in_progress]) = DATEPART(week, DATEADD(week, -1, getdate()))--D DATEPART(yyyy, [First_in_progress]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
  and Fake_Real = 'Real Ticket' and MTTI1_eng is not null 
group by [MTTI1_eng], [senior] 
),

Mtti_2 as 
 (select   [MTTI2_eng]
,[senior] [Manager]
,CAST(AVG(CAST((iIF([First_category] is null,null,(iIF([First_in_progress] is null,null,iIF([First_in_progress]>[First_category],null,[First_category]-[First_in_progress])))) )AS FLOAT)) AS DATETIME) MTTI2_Avg
,count( RequestID) MTTI2_Tickets
       from (select distinct MTTI2_eng,creation_time,First_in_progress,RequestID,Fake_Real,[First_category]
from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B  right join Sch_tbl on  [First_category] between [Start_Shift] and [End_Shift] and [MTTI2_eng]=[username]
  where   DATEPART(week, [First_category]) = DATEPART(week, DATEADD(week, -1, getdate()))
  --D DATEPART(yyyy, [First_category]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
  and Fake_Real = 'Real Ticket' and MTTI2_eng is not null
group by [MTTI2_eng],[senior] ),  

MTTI as 
 (select
[MTTI2_eng] [MTTI_eng]
,[senior] Manager
,CAST(AVG(CAST((iIF([First_category] is null,null,IiF([creation_time]>[First_category],null,[First_category]-[creation_time]))) AS FLOAT)) AS DATETIME) MTTI_Avg
,count(requestID) MTTI_Tickets
from (select distinct MTTI2_eng,creation_time,RequestID,Fake_Real,[First_category]
from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B  right join Sch_tbl on  [First_category] between [Start_Shift] and [End_Shift] and [MTTI2_eng]=[username]
  where   DATEPART(week, [First_category]) = DATEPART(week, DATEADD(week, -1, getdate()))
  --D DATEPART(yyyy, [First_category]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
  and Fake_Real = 'Real Ticket' and MTTI2_eng is not null
group by [MTTI2_eng],[senior] ) ,


Mttv as (
select [MTTV_eng]
,[senior] manager
,CAST(AVG(CAST((iIF([Final_close] is null,null,IiF([Resolve_time] is null ,null ,iIF([Resolve_time]>[Final_close],null,[Final_close]-[Resolve_time])))) AS FLOAT)) AS DATETIME) MTTV_avg
,count( requestID) MTTV_Tickets
from (select distinct MTTV_eng,creation_time,RequestID,Fake_Real,[Final_close],[Resolve_time]
from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B  right join Sch_tbl on  [Final_close] between [Start_Shift] and [End_Shift] and [MTTV_eng]=[username]
  where   DATEPART(week, [Final_close]) = DATEPART(week, DATEADD(week, -1, getdate()))
  --D DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
  and Fake_Real = 'Real Ticket' and MTTV_eng is not null
group by MTTV_eng,senior ),

MTTR as (select [Last_engineer] [MTTR_Eng]
          ,[senior] manager
         ,CAST(AVG(CAST((iIF([Final_close] is null,null,[Final_close]-[creation_time])) AS FLOAT)) AS DATETIME) MTTR_Avg
             ,count(RequestID) MTTR_Tickets
  from (select distinct [Last_engineer] ,creation_time,RequestID,Fake_Real,[Final_close] from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B  right join Sch_tbl on [Final_close] between [Start_Shift] and [End_Shift]  and [Last_engineer]=[username]
  where   DATEPART(week, [Final_close]) = DATEPART(week, DATEADD(week, -1, getdate()))
  --D DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
  and Fake_Real = 'Real Ticket' and [Last_engineer] is not null
group by [Last_engineer],[senior] ),

Closure_Tickets as
( select [closure_Reason_Eng]
          ,[senior] manager
          ,count(RequestID) Closure_Tickets
   from (select distinct [closure_Reason_Eng] ,creation_time,RequestID,Fake_Real,ticket_status, [Final_close] from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B right join Sch_tbl on [Final_close] between [Start_Shift] and [End_Shift]  and [closure_Reason_Eng]=[username]
  where   DATEPART(week, [Final_close]) = DATEPART(week, DATEADD(week, -1, getdate()))
  --D DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
  and Fake_Real = 'Real Ticket' and [closure_Reason_Eng] is not null and ticket_status='closed'
group by [closure_Reason_Eng],[senior] ),

---node tickets
node_phase1 as (select distinct requestID,iif([nodeID] like '%hosting%' or nodeID like '%Non-support%' or nodeID like '%School Project%'or nodeid like '%NID-4G%' or nodeid like '%NID-pending%'or nodeid like '%NID-L1%'or nodeid like '%NID-NA%',null,(iif ([closure_reason] = 'Duplicated tickets',0,(iif ([Trasmission_media] = '3g or 4g',null,(iif( [Category] = 'Request' and Subcategory in ('Monitoring','MRTG','TACACS'),null,1))))))) [nodeID_status]
  from [dbo].[KPI_Status_RawData] )
  ,

Node_tickets as (
select [Last_engineer] [MTTR_Eng]
       ,[senior] manager
       ,count(RI) Node_Tickets
  from (select distinct [Last_engineer],creation_time,RequestID [RI],Fake_Real,ticket_status, [Final_close],nodeID,[closure_reason],[Trasmission_media],[Category],Subcategory from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B 
  right join Sch_tbl on [Final_close] between [Start_Shift] and [End_Shift] and [Last_engineer]=[username]
  left join node_phase1 on node_phase1.requestID=RI
  where   DATEPART(week, [Final_close]) = DATEPART(week, DATEADD(week, -1, getdate()))
  --D DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
  and Fake_Real = 'Real Ticket' and [Last_engineer] is not null and ticket_status='closed' and node_phase1.[nodeID_status]=1
group by [Last_engineer],[senior])

,
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
      , iif([nodeID] like '%NID-ICT%' or [nodeID] like '%schools_Project%' or [nodeID] like '%hosting%' or nodeID like '%Non-support%' or nodeID like '%School Project%' or nodeid like '%NID-4G%' or nodeid like '%NID-pending%'or nodeid like '%NID-L1%'or nodeid like '%NID-NA%',null,(iif ([closure_reason] = 'Duplicated tickets',null,(iif ([Trasmission_media] = '3g or 4g',null,(iif( [Category] = 'Request' and Subcategory in ('Monitoring','MRTG','TACACS'),null,(iif ([nodeID] in (SELECT distinct [NodeID]
         FROM [172.29.29.77].[WorkforceDB].[dbo].[all_nodes]),0,1))))))))) [nodeID_violation]
      ,[Item]
      ,[closure_reason]
      ,iif([closure_reason] is null or [closure_reason]='-',1,0) [Closure_violation]
     ,[closure_Reason_Eng]
      ,[Subcategory]
      ,[last_engineer]

  from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where ( DATEPART(week, [First_in_progress]) = DATEPART(week, DATEADD(week, -1, getdate()))--D DATEPART(yyyy, [First_in_progress]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
  or  DATEPART(week, [First_category]) = DATEPART(week, DATEADD(week, -1, getdate()))
  --D DATEPART(yyyy, [First_category]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
  or  DATEPART(week, [Final_close]) = DATEPART(week, DATEADD(week, -1, getdate()))
  --D DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
)
  and Fake_Real = 'Real Ticket')

  ,

   MTTI_Viol as
  (select MTTI2_eng ,[senior] [Manager], sum(MTTI_Violated) MTTI_Violation
  from (select distinct RequestID, MTTI2_eng,MTTI_Violated,First_category from violation 
  where  DATEPART(week, [First_category]) = DATEPART(week, DATEADD(week, -1, getdate()))
  --D DATEPART(yyyy, [First_category]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
  ) M_V
  right join Sch_tbl on  [First_category] between Start_Shift and End_Shift and [MTTI2_eng]=[username]
  where MTTI2_eng is not null
  group by MTTI2_eng,[senior] ),


   MTTV_viol as 
  (select MTTV_eng ,[senior] [Manager], sum(MTTV_Violated) MTTV_Violation
  from (select distinct RequestID, MTTV_eng,MTTV_Violated,[Final_close] from violation 
  where  DATEPART(week, [Final_close]) = DATEPART(week, DATEADD(week, -1, getdate()))
  --D DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
  )V_V
  right join Sch_tbl on [Final_close] between [Start_Shift] and End_Shift and [MTTV_eng]=[username]
  where MTTV_eng is not null
  group by MTTV_eng,[senior]),
  
  MTTR_viol as 
  (select [Last_engineer] [MTTR_Eng],[senior] [Manager], sum(MTTR_violated) MTTR_violation
  from (select distinct RequestID,[last_engineer],MTTR_Violated,[final_close] from violation where DATEPART(week, [Final_close]) = DATEPART(week, DATEADD(week, -1, getdate()))
  --D DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
  ) R
  right join Sch_tbl on  [Final_close] between [Start_Shift] and End_Shift and [Last_engineer]=[username]
  where [Last_engineer] is not null
  group by [last_engineer],[senior]),
  
  node_viol as
  (select [last_engineer] Node_Eng ,[senior] [Manager], sum(nodeID_violation) Node_violation
  from (select distinct RequestID,[last_engineer],nodeID_violation,[Final_close] from violation where DATEPART(week, [Final_close]) = DATEPART(week, DATEADD(week, -1, getdate()))
  --D DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
  ) N_V
  right join [Sch_tbl] on  [Final_close] between [Start_Shift] and End_Shift and [Last_engineer]=[username] and [Final_close] is not null
  where [last_engineer] is not null
  group by [last_engineer],[senior] ),

  Closure_viol as
  (select closure_reason_eng,[senior] [manager],sum(closure_violation) Closure_Reason_violation
  from (select distinct RequestID,closure_reason_eng,Closure_violation,Final_close from violation where DATEPART(week, [Final_close]) = DATEPART(week, DATEADD(week, -1, getdate()))
  --D DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
  ) c
  right join [Sch_tbl] on  [Final_close] between [Start_Shift] and End_Shift and closure_reason_eng=[username] and [Final_close] is not null
where closure_reason_eng is not null
  group by closure_Reason_Eng,senior
  ),

  Sch_senior as ( 
  select distinct Sch_tbl.username [eng],Sch_tbl.senior [manager]
  from Sch_tbl  
  where DATEPART(week, [schedule_date]) = DATEPART(week, DATEADD(week, -1, getdate()))
  --D DATEPART(yyyy, [schedule_date]) = DATEPART(yyyy, DATEADD(week, -1, getdate())) 
  )

select ID
,[username]
,DATEPART(week, DATEADD(week, -1, getdate())) Weeknum
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
where Employee_Status='active' and unit=12 and grade='L8'
 and username ='$s_username'

 ");

      while($echo = sqlsrv_fetch_array($new_query) ){

        $rows = '<tr>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Weeknum'].'</td>';
    $rows .='<td style="border: 1px solid lightgray;">'.$echo['ID'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['username'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['manager'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI1_Avg'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['mtti1_tickets'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_Avg'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_tickets'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI_Avg'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI_Tickets'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI_Violation'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%MTTI_viol']).'%'.'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_Avg'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_Tickets'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_Violation'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%MTTV_viol']).'%'.'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_Avg'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_Tickets'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_violation'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%MTTR_viol']).'%'.'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Closure_Tickets'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Closure_Reason_violation'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%Closure_viol']).'%'.'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Node_tickets'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Node_violation'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%Node_viol']).'%'.'</td>';
    $rows .= '</tr>';
    echo $rows;

}
}
?>
<?php 
// month
if(isset($_GET['month'])){$month = $_GET['month'];  
$new_query = sqlsrv_query($connect , "WITH Sch_tbl as (
SELECT [username]
      ,[schedule_date]
                 ,[senior]
      ,dateadd(hour,-5,(cast([shift_start] as datetime)+cast([schedule_date] as datetime))) [Start_Shift]
      ,dateadd(hour,5,(IIF(([shift_start] between '12:00:00' and '23:59:59' and (cast(cast([shift_end] as datetime)-cast([shift_start] as datetime) as time) ='12:00:00') or ([shift_start] between '16:00:00' and '23:59:59')),(cast([shift_end] as datetime)+DATEADD(day,1,cast([schedule_date] as datetime))),(cast([shift_end] as datetime)+cast([schedule_date] as datetime))) ))[End_Shift]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  WHERE [shift_start] <> 'off' and year([schedule_date])>='$this_year' and [username] in 
  (SELECT distinct [username]
  FROM [Employess_DB].[dbo].[tbl_Personal_info]
  where [unit] = 12 and [Grade] = 'l8' )
  ),

MTTI_1 as (SELECT  [MTTI1_eng]
  ,[senior] [Manager]
  ,count(RequestID) MTTI1_Tickets
  ,CAST(AVG(CAST(( iIF([First_in_progress] is null,Null,iIF([Creation_Time]>[First_in_progress],0,[First_in_progress]-[Creation_Time]))) AS FLOAT)) AS DATETIME) MTTI1_Avg
  from (select distinct MTTI1_eng,creation_time,First_in_progress,RequestID,Fake_Real
from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B right join Sch_tbl on  [First_in_progress] between [Start_Shift] and [End_Shift] and [MTTI1_eng]=[username]
  where   DATEPART(m, [First_in_progress]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [First_in_progress]) = DATEPART(yyyy, DATEADD(m, -1, getdate())) 
  and Fake_Real = 'Real Ticket' and MTTI1_eng is not null 
group by [MTTI1_eng], [senior] 
),

Mtti_2 as 
 (select   [MTTI2_eng]
,[senior] [Manager]
,CAST(AVG(CAST((iIF([First_category] is null,null,(iIF([First_in_progress] is null,null,iIF([First_in_progress]>[First_category],null,[First_category]-[First_in_progress])))) )AS FLOAT)) AS DATETIME) MTTI2_Avg
,count( RequestID) MTTI2_Tickets
       from (select distinct MTTI2_eng,creation_time,First_in_progress,RequestID,Fake_Real,[First_category]
from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B  right join Sch_tbl on  [First_category] between [Start_Shift] and [End_Shift] and [MTTI2_eng]=[username]
  where   DATEPART(m, [First_category]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [First_category]) = DATEPART(yyyy, DATEADD(m, -1, getdate())) 
  and Fake_Real = 'Real Ticket' and MTTI2_eng is not null
group by [MTTI2_eng],[senior] ),  

MTTI as 
 (select
[MTTI2_eng] [MTTI_eng]
,[senior] Manager
,CAST(AVG(CAST((iIF([First_category] is null,null,IiF([creation_time]>[First_category],null,[First_category]-[creation_time]))) AS FLOAT)) AS DATETIME) MTTI_Avg
,count(requestID) MTTI_Tickets
from (select distinct MTTI2_eng,creation_time,RequestID,Fake_Real,[First_category]
from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B  right join Sch_tbl on  [First_category] between [Start_Shift] and [End_Shift] and [MTTI2_eng]=[username]
  where   DATEPART(m, [First_category]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [First_category]) = DATEPART(yyyy, DATEADD(m, -1, getdate()))
  and Fake_Real = 'Real Ticket' and MTTI2_eng is not null
group by [MTTI2_eng],[senior] ) ,


Mttv as (
select [MTTV_eng]
,[senior] manager
,CAST(AVG(CAST((iIF([Final_close] is null,null,IiF([Resolve_time] is null ,null ,iIF([Resolve_time]>[Final_close],null,[Final_close]-[Resolve_time])))) AS FLOAT)) AS DATETIME) MTTV_avg
,count( requestID) MTTV_Tickets
from (select distinct MTTV_eng,creation_time,RequestID,Fake_Real,[Final_close],[Resolve_time]
from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B  right join Sch_tbl on  [Final_close] between [Start_Shift] and [End_Shift] and [MTTV_eng]=[username]
  where   DATEPART(m, [Final_close]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(m, -1, getdate())) 
  and Fake_Real = 'Real Ticket' and MTTV_eng is not null
group by MTTV_eng,senior ),

MTTR as (select [Last_engineer] [MTTR_Eng]
          ,[senior] manager
         ,CAST(AVG(CAST((iIF([Final_close] is null,null,[Final_close]-[creation_time])) AS FLOAT)) AS DATETIME) MTTR_Avg
             ,count(RequestID) MTTR_Tickets
  from (select distinct [Last_engineer] ,creation_time,RequestID,Fake_Real,[Final_close] from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B  right join Sch_tbl on [Final_close] between [Start_Shift] and [End_Shift]  and [Last_engineer]=[username]
  where   DATEPART(m, [Final_close]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(m, -1, getdate()))
  and Fake_Real = 'Real Ticket' and [Last_engineer] is not null
group by [Last_engineer],[senior] ),

Closure_Tickets as
( select [closure_Reason_Eng]
          ,[senior] manager
          ,count(RequestID) Closure_Tickets
   from (select distinct [closure_Reason_Eng] ,creation_time,RequestID,Fake_Real,ticket_status, [Final_close] from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B right join Sch_tbl on [Final_close] between [Start_Shift] and [End_Shift]  and [closure_Reason_Eng]=[username]
  where   DATEPART(m, [Final_close]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(m, -1, getdate())) 
  and Fake_Real = 'Real Ticket' and [closure_Reason_Eng] is not null and ticket_status='closed'
group by [closure_Reason_Eng],[senior] ),

---node tickets
node_phase1 as (select distinct requestID,iif([nodeID] like '%hosting%' or nodeID like '%Non-support%' or nodeID like '%School Project%' or nodeid like '%NID-4G%' or nodeid like '%NID-pending%'or nodeid like '%NID-L1%'or nodeid like '%NID-NA%',null,(iif ([closure_reason] = 'Duplicated tickets',0,(iif ([Trasmission_media] = '3g or 4g',null,(iif( [Category] = 'Request' and Subcategory in ('Monitoring','MRTG','TACACS'),null,1))))))) [nodeID_status]
  from [dbo].[KPI_Status_RawData] ),

Node_tickets as (
select [Last_engineer] [MTTR_Eng]
       ,[senior] manager
       ,count(RI) Node_Tickets
  from (select distinct [Last_engineer],creation_time,RequestID [RI],Fake_Real,ticket_status, [Final_close],nodeID,[closure_reason],[Trasmission_media],[Category],Subcategory from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]) B 
  right join Sch_tbl on [Final_close] between [Start_Shift] and [End_Shift] and [Last_engineer]=[username]
  left join node_phase1 on node_phase1.requestID=RI
  where   DATEPART(m, [Final_close]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(m, -1, getdate())) 
  and Fake_Real = 'Real Ticket' and [Last_engineer] is not null and ticket_status='closed' and node_phase1.[nodeID_status]=1
group by [Last_engineer],[senior]),
------------------------------------------------------
violation as (SELECT distinct
      year([creation_time]) [Year]
      ,month([creation_time]) [Month]
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
      , iif([nodeID] like '%NID-ICT%' or [nodeID] like '%schools_Project%' or [nodeID] like '%hosting%' or nodeID like '%Non-support%' or nodeID like '%School Project%' or nodeid like '%NID-4G%' or nodeid like '%NID-pending%'  or nodeid like '%NID-NA%' or nodeid like '%NID-L1%',null,(iif ([closure_reason] = 'Duplicated tickets',null,(iif ([Trasmission_media] = '3g or 4g',null,(iif( [Category] = 'Request' and Subcategory in ('Monitoring','MRTG','TACACS'),null,(iif ([nodeID] in (SELECT distinct [NodeID]
         FROM [172.29.29.77].[WorkforceDB].[dbo].[all_nodes]),0,1))))))))) [nodeID_violation]
      ,[Item]
      ,[closure_reason]
      ,iif([closure_reason] is null or [closure_reason]='-',1,0) [Closure_violation]
      ,[closure_Reason_Eng]
      ,[Subcategory]
      ,[last_engineer]

  from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where ( DATEPART(m, [First_in_progress]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [First_in_progress]) = DATEPART(yyyy, DATEADD(m, -1, getdate()))
  or  DATEPART(m, [First_category]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [First_category]) = DATEPART(yyyy, DATEADD(m, -1, getdate()))
  or  DATEPART(m, [Final_close]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(m, -1, getdate()))
)
  and Fake_Real = 'Real Ticket'),

   MTTI_Viol as
  (select MTTI2_eng ,[senior] [Manager], sum(MTTI_Violated) MTTI_Violation
  from (select distinct RequestID, MTTI2_eng,MTTI_Violated,First_category from violation 
  where  DATEPART(m, [First_category]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [First_category]) = DATEPART(yyyy, DATEADD(m, -1, getdate()))
  ) M_V
  right join Sch_tbl on  [First_category] between Start_Shift and End_Shift and [MTTI2_eng]=[username]
  where MTTI2_eng is not null
  group by MTTI2_eng,[senior] ),


   MTTV_viol as 
  (select MTTV_eng ,[senior] [Manager], sum(MTTV_Violated) MTTV_Violation
  from (select distinct RequestID, MTTV_eng,MTTV_Violated,[Final_close] from violation 
  where  DATEPART(m, [Final_close]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(m, -1, getdate()))
  )V_V
  right join Sch_tbl on [Final_close] between [Start_Shift] and End_Shift and [MTTV_eng]=[username]
  where MTTV_eng is not null
  group by MTTV_eng,[senior]),
  
  MTTR_viol as 
  (select [Last_engineer] [MTTR_Eng],[senior] [Manager], sum(MTTR_violated) MTTR_violation
  from (select distinct RequestID,[last_engineer],MTTR_Violated,[final_close] from violation where DATEPART(m, [Final_close]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(m, -1, getdate()))
  ) R
  right join Sch_tbl on  [Final_close] between [Start_Shift] and End_Shift and [Last_engineer]=[username]
  where [Last_engineer] is not null
  group by [last_engineer],[senior]),
  
  node_viol as
  (select [last_engineer] Node_Eng ,[senior] [Manager], sum(nodeID_violation) Node_violation
  from (select distinct RequestID,[last_engineer],nodeID_violation,[Final_close] from violation where DATEPART(m, [Final_close]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(m, -1, getdate()))
  ) N_V
  right join [Sch_tbl] on  [Final_close] between [Start_Shift] and End_Shift and [Last_engineer]=[username] and [Final_close] is not null
  where [last_engineer] is not null
  group by [last_engineer],[senior] )

  ,

  Closure_viol as
  (select closure_reason_eng,[senior] [manager],sum(closure_violation) Closure_Reason_violation
  from (select distinct RequestID,closure_reason_eng,Closure_violation,Final_close from violation where DATEPART(m, [Final_close]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(m, -1, getdate()))
  ) c
  right join [Sch_tbl] on  [Final_close] between [Start_Shift] and End_Shift and closure_reason_eng=[username] and [Final_close] is not null
where closure_reason_eng is not null
  group by closure_Reason_Eng,senior
  ),

  Sch_senior as ( 
  select distinct Sch_tbl.username [eng],Sch_tbl.senior [manager]
  from Sch_tbl  
  where DATEPART(m, [schedule_date]) = DATEPART(m, DATEADD(m, -1, getdate()))
  --AND DATEPART(yyyy, [schedule_date]) = DATEPART(yyyy, DATEADD(m, -1, getdate())) 
  )

select ID
--,[Month]
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
where Employee_Status='active' and unit=12 and grade='L8'
and username ='$s_username'
order by 3,2 ");
  
      while($echo = sqlsrv_fetch_array($new_query) ){
$rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['ID'].'</td>';
//$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Month'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['username'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['manager'].'</td>';
$rows .='<td sclass="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI1_Avg'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['mtti1_tickets'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_Avg'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_tickets'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI_Avg'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI_Tickets'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI_Violation'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%MTTI_viol']).'%'.'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_Avg'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_Tickets'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_Violation'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%MTTV_viol']).'%'.'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_Avg'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_Tickets'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_violation'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%MTTR_viol']).'%'.'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Closure_Tickets'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Closure_Reason_violation'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%Closure_viol']).'%'.'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Node_tickets'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Node_violation'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.floor($echo['%Node_viol']).'%'.'</td>';
$rows .= '</tr>';
        echo $rows;

}
}
?>