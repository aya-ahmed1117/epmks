

 <?php
      set_time_limit(400);
include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      ?>

<head>
      <title>Summary Per month</title>
<link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head> 
<style type="text/css">
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
</style>

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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Summary Per month
      <a href="mwd_reports.php">
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

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
<th><center>Ticket year</center></th>
<th><center>Ticket month</center></th>
<th><center>Ticket group</th>
    <?php if($_SESSION['role_id'] != 1 ){
        ?>
<th><center>subgroup</th>
<?php } ?>
<th><center>Total tickets</center> </th>
<th><center>Real tickets</th>
<th><center>Fake ticket</center></th>
<th><center>Absenteeism</center> </th>  
<th><center>utilization</center></th>
<th><center>Tasks</center> </th>  

		</tr>
		</thead>
	
  <tbody>

<?php

  $new_q= sqlsrv_query( $con , "SELECT 
  groups
    FROM [Employess_DB].[dbo].[tbl_Personal_info]
    left join Employess_DB.dbo.Tbl_Groups on Group_ID = [Group]
    where username = '$s_username'");
  $out_new = sqlsrv_fetch_array($new_q);
   $my_group = $out_new['groups'];

  if(($_SESSION['username'] == 'ahmed.mohamedbassal') ||
($_SESSION['username'] == 'mohamed.abdeltwab') ){

   $new_query=sqlsrv_query($con,"exec Summary_per_month_sharkawy_yassmin @group1 ='Private KAM' , @group2 = 'GDS(Global Partner)'");

      while($echo = sqlsrv_fetch_array($new_query) ){

       $rows = '<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_year'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_month'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['subgroup'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['total_tickets'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['real_tickets'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Fake_ticket'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($echo['Absenteeism'])*100).'%'.'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($echo['utilization'])*100).'%'.'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($echo['Tasks'])*100).'%'.'</td>';

      $rows .= '</tr>';
      echo $rows;

}
}
    if($_SESSION['role_id'] == 1 ){


        $new_queryM = sqlsrv_query( $con , "with total_tickets as (
SELECT distinct  RequestID ,year(creation_time) Ticket_year, month(creation_time) Ticket_month,iif(Ticket_group is null,'Not Assigned',Ticket_group) Ticket_group
,iif(subgroup is null,'Not Assigned',subgroup) subgroup
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]),

   real_tickets as (
SELECT distinct  RequestID , year(creation_time) Ticket_year,month(creation_time) Ticket_month,iif(Ticket_group is null,'Not Assigned',Ticket_group) Ticket_group
,subgroup
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where Requestid not in (
SELECT [RequestID]
FROM      [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
WHERE   [closure_reason] IN ('Duplicated tickets') OR
 [Fake_Real] = 'Fake Ticket') AND [ticket_status] = 
 'closed' AND year(creation_time) >= year(getdate())

  ),

total_tickets_1
as (
  select Ticket_year,Ticket_month, Ticket_group,subgroup, count(RequestID) total_tickets 
  from total_tickets
  group by Ticket_month, Ticket_group,Ticket_year,subgroup

  ),

  real_tickets_1 as (
   select Ticket_year,Ticket_month, Ticket_group,subgroup, count(RequestID) real_tickets 
  from real_tickets
  group by Ticket_month, Ticket_group,Ticket_year,subgroup
),

tbl_Sch as 
( SELECT 
lower([dbo].[schedule_table].[username]) 
[username], 
[schedule_table].[schedule_date], 
cast(IIF(([schedule_table].[shift_start] BETWEEN '12:00:00' AND '23:59:59' 
AND (cast(cast([schedule_table].[shift_end] AS datetime)
- cast([schedule_table].[shift_start] AS datetime) AS time) = '12:00:00')
OR
([schedule_table].[shift_start] BETWEEN '16:00:00' AND '23:59:59'))
, (cast([schedule_table].[shift_end] AS datetime) + DATEADD(day, 1, cast([schedule_table].[schedule_date] AS datetime)))
, (cast([schedule_table].[shift_end] AS datetime)
   + cast([schedule_table].[schedule_date] AS datetime)))
   - (cast([schedule_table].[shift_start] AS datetime) 
   + cast([schedule_table].[schedule_date] AS datetime)) AS float) [Sch_time]
                           
FROM     [schedule_table] 
              
WHERE  [schedule_table].[shift_start] <> 'off' and year([schedule_table].schedule_date) >= year(getdate())),


tbl_leave_deduc as (SELECT [leaves].[username], 

tbl_Sch.[schedule_date], 

sum(sch_time) [Leave_time]

FROM[Aya_Web_APP].[dbo].[leaves]
JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])
AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]

WHERE  [leaves].[type] = 'Sick Leave' 
AND [leaves].[status] = 'E-workforce and senior approve' 
 
GROUP BY [leaves].[username], tbl_Sch.[schedule_date]

union 
SELECT [leaves].[username], 

tbl_Sch.[schedule_date], 

sum(sch_time) [Leave_time]

FROM[Aya_Web_APP].[dbo].[leaves]
JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])
AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]

WHERE  [leaves].[type] = 'Annual Leave' 
AND [leaves].[status] = 'E-workforce and senior approve' 
and ([leaves].[creation_time] > [adate] or [leaves].[creation_time] > [bdate])

GROUP BY [leaves].[username], tbl_Sch.[schedule_date]


union


SELECT [leaves].[username],
tbl_Sch.[schedule_date],
Sum(DATEDIFF(second, starttime, endtime)) [Leave_time]
FROM [Aya_Web_APP].[dbo].[leaves] JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username]) AND tbl_Sch.[schedule_date] BETWEEN [adate] AND [bdate]
WHERE  [type] = 'Permission' 
AND [status] = 'E-workforce and senior approve' 
AND adate = tbl_Sch.schedule_date
GROUP BY [leaves].[username], tbl_Sch.[schedule_date]

union

SELECT [deduction].[username],
tbl_Sch.[schedule_date], 
sum(datepart(hour, [deduction].[a_time]) * 3600 + datepart(minute, [deduction].[a_time]) * 60 + datepart(second, [deduction].[a_time])) [Leave_time]
FROM [dbo].[deduction] 
JOIN
tbl_Sch 
ON (tbl_Sch.[username] = [deduction].[username]) 
AND tbl_Sch.[schedule_date] = [deduction].[a_date]
WHERE  tbl_Sch.[schedule_date] = [deduction].[a_date] AND [stat_added] = 'added' 
AND [item] NOT LIKE ('_orget to login out%')
GROUP BY [deduction].[username], tbl_Sch.[schedule_date]),


Final_absec as (

select tbl_Sch.username
,Sum(tbl_Sch.Sch_time) Sch_time
,month(tbl_Sch.schedule_date) Sch_month
,year(tbl_Sch.schedule_date) Sch_Year
,Sum(cast(dateadd(second, tbl_leave_deduc.Leave_time, '00:00:00') AS float)) Leave_time
--,round(iif(tbl_leave_deduc.Leave_time is null , 0 , Sum(cast(dateadd(second, tbl_leave_deduc.Leave_time, '00:00:00') AS float)) ) / Sum(tbl_Sch.Sch_time)  , 2) Absenteeism_daily
from  
tbl_Sch
left join tbl_leave_deduc 
on tbl_leave_deduc.username = tbl_Sch.username 
and tbl_leave_deduc.schedule_date = tbl_Sch.schedule_date
group by tbl_Sch.username,month(tbl_Sch.schedule_date),year(tbl_Sch.schedule_date)),

utiliz as
(
select year([date])util_year, month([date])Util_month ,iif(iif([Groups] is null , 'No Group',[Groups]) = 'ICT & Domain - Mail','ICT',iif([Groups] is null , 'No Group',[Groups])) [Groups]
,[utilization_table].sub_Group
,sum(cast(cast([work_duration] as datetime) as float)) [work_duration]
         ,sum(cast(cast([scheduled_duration] as datetime) as float)) [scheduled_duration]
         ,IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([work_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([work_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))) [utilization]
         ,iif(IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))) is null ,0,IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float))))) [Non-utilized]
       from [dbo].[utilization_table]
     left join [Employess_DB].[dbo].[tbl_Personal_info] on [utilization_table].username = [tbl_Personal_info].username 
left join [Employess_DB].[dbo].[Tbl_Groups] on [Group_ID] = [group]
       where year([date]) >= year(getdate())
       --and [username] <> 'amr.o.fouad'
       group by year([date]),month([date]),
     iif(iif([Groups] is null , 'No Group',[Groups]) = 'ICT & Domain - Mail','ICT',iif([Groups] is null , 'No Group',[Groups])),[utilization_table].sub_Group
       ),

     Absenteeism as (
select 
Sch_Year
,Sch_month
,iif(iif([Tbl_Groups].[Groups] is null , 'No Group',[Tbl_Groups].[Groups]) = 'ICT & Domain - Mail','ICT',iif([Tbl_Groups].[Groups] is null , 'No Group',[Tbl_Groups].[Groups])) [Groups]
,SubGroups
--,Sum(Sch_time ) Sch_time
--,Sum(Leave_time) Leave_time
--,Sum([work_duration])  [work_duration]
,iif((Sum(Leave_time) /Sum(Sch_time ))is  null ,0,(Sum(Leave_time) /Sum(Sch_time ))) Absenteeism 

--,iif(utilization is null,0,utilization) utilization
--,iif([Non-utilized] is null, 0,[Non-utilized])[Task's]
from 
Final_absec
full join utiliz on Sch_Year = util_year and Sch_month = Util_month 
left join [Employess_DB].[dbo].[tbl_Personal_info] on Final_absec.username = [tbl_Personal_info].username 
left join [Employess_DB].[dbo].[Tbl_Groups] on [Tbl_Groups].[Group_ID] = [tbl_Personal_info].[group]
left join [Employess_DB].[dbo].[Tbl_SubGroups] on [Tbl_SubGroups].SubGroup_ID = [tbl_Personal_info].sub_Group

where Sch_month<=month(getdate())  and Sch_Year <=year(getdate()) and Unit = 12
group by 
Sch_Year
,Sch_month
,iif(iif([Tbl_Groups].[Groups] is null , 'No Group',[Tbl_Groups].[Groups]) = 'ICT & Domain - Mail','ICT',
iif([Tbl_Groups].[Groups] is null , 'No Group',[Tbl_Groups].[Groups])),SubGroups)

  select total_tickets_1.Ticket_year,total_tickets_1.Ticket_month,total_tickets_1.Ticket_group,
  total_tickets_1.subgroup,total_tickets,real_tickets,total_tickets-real_tickets [Fake_ticket],Absenteeism
  ,utiliz.utilization
,utiliz.[Non-utilized] [Tasks]
  from total_tickets_1
  left join real_tickets_1 on
  total_tickets_1.Ticket_month = real_tickets_1.Ticket_month 
  and total_tickets_1.Ticket_group = real_tickets_1.Ticket_group
  and total_tickets_1.subgroup = real_tickets_1.subgroup
  and total_tickets_1.ticket_year = real_tickets_1.ticket_year
  left join Absenteeism on total_tickets_1.Ticket_month  = Sch_month 
  and total_tickets_1.ticket_year = Sch_Year
  and [Groups] = total_tickets_1.Ticket_group
  and total_tickets_1.subgroup = Absenteeism.SubGroups
  left join utiliz on total_tickets_1.Ticket_year = util_year 
  and total_tickets_1.Ticket_month = Util_month
  and total_tickets_1.Ticket_group = utiliz.Groups
    and total_tickets_1.subgroup = utiliz.Sub_group
    where total_tickets_1.Ticket_group in ('BS','TAM',
        'Resident',
        'KAM',
        'GDS',
        'Mega Projects',
        'GOV',
        'Private KAM & GDS ( Global partner )',
        'Private KAM',
        'GDS(Global Partner)',
        'Banking')
    and total_tickets_1.Ticket_year >=  year(getdate())
  order by 1,2,3");
              while($echo = sqlsrv_fetch_array($new_queryM) ){

           $rows = '<tr>';
      $rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$echo['Ticket_year'].'</td>';
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_month'].'</td>';
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
      $rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$echo['total_tickets'].'</td>';
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['real_tickets'].'</td>';
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Fake_ticket'].'</td>';
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($echo['Absenteeism'])*100).'%'.'</td>';
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($echo['utilization'])*100).'%'.'</td>';
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($echo['Tasks'])*100).'%'.'</td>';
            $rows .= '</tr>';
            echo $rows;
    }
    }
else{

   $new_query = sqlsrv_query( $con , "exec Summary_per_month 
    @group = '$my_group'");
		  while($echo = sqlsrv_fetch_array($new_query) ){

       $rows = '<tr>';
	$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_year'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_month'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['subgroup'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['total_tickets'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['real_tickets'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Fake_ticket'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($echo['Absenteeism'])*100).'%'.'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($echo['utilization'])*100).'%'.'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($echo['Tasks'])*100).'%'.'</td>';

	  	$rows .= '</tr>';
	  	echo $rows;

}}
  

?>
</tbody>
</table>
</div>
</div>

<script src="js/table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Summary_Per_month.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>

  
      