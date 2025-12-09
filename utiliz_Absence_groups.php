




<?php 
include ("pages.php");
/*
utiliz
Absence
*/
?>
<title>Utilization & Absennce</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.1/raphael-min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="js/justgage.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" href="css/ionicons.min.css">
<link rel="stylesheet" href="css/morris22.css">
<link rel="stylesheet" href="css/AdminLTE.min.css">
<link rel="stylesheet" href="css/_all-skins.min.css">
  </head>

  <?php if(isset($_GET['Utilizgroup'])){?>
    <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Utilization </h2>
    <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">Utilization Per group</p></samp>
    </aside>
  </div>
</center>
      <div class="row">
       <center>
           <div class="col-md-9">
          <div class="box box-success" style="background-color: #092834;">
            <div class="box-header with-border">
              <h3 class="box-title" style="color:#eee;">Utilization
              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body chart-responsive">
          <div class="chart" id="line-utiliz" style="height: 300px;"></div>
        </div>

        <div class="card-body">
    <div class="legend" style="color: white;">
    <i class="fa fa-circle text-primary" style="color:;"></i> utilized
    <i class="fa fa-circle text"style="color:#9dadb9;"></i> Non utilized
  </div>
</div>

    <hr>
          <div class="table table-striped table-hover" style="overflow:scroll;overflow-x: hidden; height:350px;">
 <table  class="order-table table"></div>
    <thead style="background-color: #092834;color: #B2D732;" >
  <th>Date</th>
  <th>Groups</th>
  <th>utilized</th>
  <th>non utilized</th>
 
</thead>          
<tbody >
<?php
$CurrentYear =  date("Y");
  $first_query = sqlsrv_query( $con ,"SELECT [date],Groups [Group name]
         ,IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([work_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([work_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))) [utilization]
         ,iif(IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))) is null ,0,IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float))))) [Tasks]
       from [dbo].[utilization_table] b
     left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
     left join Employess_DB.dbo.Tbl_Groups on Group_ID = [Group]
       where year([date]) >='$CurrentYear' and b.username in ( select username from [Aya_Web_APP].dbo.employee_web_table where manager = '$self')
       and [date] >='2024-12-01'
       group by[date], Groups 
     order by 1,2");
  while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .= '<td width="15%" style="border: 1px solid #eee;color:#eee;">'.$output_query["date"]->format('Y-m-d').'</td>';
$rows .= '<td width="15%" style="border: 1px solid #eee;color:#eee;">'.$output_query["Group name"].'</td>';
if(floor(($output_query["utilization"])*100) >= 80)
  {
$rows .='<td style="width:10%;border:3px solid #eee;color:#eee; background-color:#64BA26;font-size:13px;">'.floor(($output_query["utilization"])*100).'%'.'</td>';
}
if(floor(($output_query["utilization"])*100) < 80)
  {
$rows .='<td style="width:10%; border: 3px solid #eee;color:#eee;background-color:#A30E00;font-size:13px ">'.floor(($output_query["utilization"])*100).'%'.'</td>';
}
$rows .='<td style="width:10%; border: 3px solid #eee;
background-color:lightgray ;font-size:13px;color:#092834; ">'.floor(($output_query["Tasks"])*100).'%'.'</td>';
$rows .= '</tr>';
echo $rows;
}
?>
</tbody>
</table>
</div>

          </div>
        </div>
      </center>
      </div>
      <?php 
}
?>


  <?php if(isset($_GET['Absence'])){?>
    <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Absence </h2>
        <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>      
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">Absenteeism Per group</p></samp>
    </aside>
  </div>
</center>
      <div class="row">
       <center>
           <div class="col-md-8">
          <div class="box box-warning" style="background-color: #092834;">

            <div class="box-header with-border">
              <h3 class="box-title" style="color:#eee;">Absence
              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>

            <div class="box-body chart-responsive">
          <div class="chart" id="line-Absence"style="height: 300px;"></div>
        
        <div class="card-body">
    <div class="legend" style="color: white;">
    <i class="fa fa-circle text-primary" style="color:;"></i> Absence
    </div>
    </div>
</div>
    <hr>
      <div class="table table-striped table-hover" style="overflow:scroll;overflow-x: hidden; height:350px;">
 <table  class="order-table table"></div>
    <thead style="background-color: #092834;color: #B2D732;" >
  <th> Date</th>
  <th> Groups</th>
  <th> Absence</th>
  
</thead>          
   
<tbody >
<?php
$new_q= sqlsrv_query( $con , "SELECT 
  groups
    FROM [Employess_DB].[dbo].[tbl_Personal_info]
    left join Employess_DB.dbo.Tbl_Groups on Group_ID = [Group]
    where username = '$s_username'");
  $out_new = sqlsrv_fetch_array($new_q);
  $my_group = $out_new['groups'];


  $cur_year =date('Y');
  if(($_SESSION['username'] == 'ahmed.mohamedbassal') ||
($_SESSION['username'] == 'mohamed.abdeltwab') ){

  $Absence2 = sqlsrv_query( $con ,"with tbl_Sch as

( SELECT

lower([dbo].[schedule_table].[username])

[username],
[groups]
,[schedule_table].[schedule_date],

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

                        
FROM  [schedule_table]
left join Employess_DB.dbo.tbl_Personal_info on tbl_Personal_info.UserName = [schedule_table].username
left join Employess_DB.dbo.Tbl_Groups on Group_ID = [Group]
WHERE  [schedule_table].[shift_start] <> 'off' and year([schedule_table].schedule_date ) = year(getdate())),

tbl_leave_deduc as (
SELECT [leaves].[username],
[groups]
,tbl_Sch.[schedule_date],
sum(sch_time) [Leave_time]
FROM[Aya_Web_APP].[dbo].[leaves]
JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])
AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]

WHERE  [leaves].[type] = 'Sick Leave'
AND [leaves].[status] = 'E-workforce and senior approve'
GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]

union

SELECT [leaves].[username],
[groups],
tbl_Sch.[schedule_date],
sum(sch_time) [Leave_time]
FROM[Aya_Web_APP].[dbo].[leaves]
JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])
AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]
WHERE  [leaves].[type] = 'Annual Leave'
AND [leaves].[status] = 'E-workforce and senior approve'
and ([leaves].[creation_time] > [adate] or [leaves].[creation_time] > [bdate])

GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]
union

SELECT [leaves].[username],
[groups],
tbl_Sch.[schedule_date],

CAST(CONVERT(DATETIME,  CONVERT(varchar, DATEADD(ms, Sum(DATEDIFF(second, starttime, endtime)) * 1000, 0), 114)) AS FLOAT) [Leave_time]

FROM [Aya_Web_APP].[dbo].[leaves] JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username]) AND tbl_Sch.[schedule_date] BETWEEN [adate] AND [bdate]
WHERE  [type] = 'Permission'
AND [status] = 'E-workforce and senior approve'
AND adate = tbl_Sch.schedule_date
GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]

union

SELECT [deduction].[username],
[groups],
tbl_Sch.[schedule_date],

   sum(cast(cast ([deduction].[a_time] as datetime) as float)) [Leave_time]

--sum(datepart(hour, [deduction].[a_time]) * 3600 + datepart(minute, [deduction].[a_time]) * 60 + 
--datepart(second, [deduction].[a_time])) [Leave_time]

FROM [dbo].[deduction]
JOIN
tbl_Sch
ON (tbl_Sch.[username] = [deduction].[username])
AND tbl_Sch.[schedule_date] = [deduction].[a_date]
WHERE  tbl_Sch.[schedule_date] = [deduction].[a_date] AND [stat_added] = 'added'
AND [item] NOT LIKE ('forg%')
GROUP BY [deduction].[username], tbl_Sch.[schedule_date],[groups]),

Final_absec as (

select tbl_Sch.username
,tbl_Sch.Groups
,Sum(tbl_Sch.Sch_time) Sch_time

,tbl_Sch.schedule_date Sch_day

 --,Sum(cast(dateadd(second, tbl_leave_deduc.Leave_time, '00:00:00') AS float)) Leave_time
 ,Sum(tbl_leave_deduc.Leave_time) [Leave_time]

from 

tbl_Sch

left join tbl_leave_deduc

on tbl_leave_deduc.username = tbl_Sch.username

and tbl_leave_deduc.schedule_date = tbl_Sch.schedule_date

group by tbl_Sch.username,tbl_Sch.schedule_date,tbl_Sch.Groups,tbl_Sch.[groups])


select

Sch_day
,Final_absec.Groups
--,iif(Manager_Name is null, 'not in DB' ,Manager_Name) Manager_Name


,iif((sum(Leave_time) / Sum(Sch_time))is  null ,0,(sum(Leave_time) / Sum(Sch_time))) Absenteeism


from

Final_absec
--left join [Employess_DB].[dbo].[tbl_Personal_info] on Final_absec.username = [tbl_Personal_info].username
--left join [Employess_DB].[dbo].[Tbl_Groups] on [Group_ID] = [group]

where Final_absec.Groups in ('Private KAM' ,'GDS(Global Partner)')
group by Sch_day,Final_absec.Groups
order by 1 , 2");
   while( $output_query = sqlsrv_fetch_array($Absence2)){
$rows  ='<tr >';
$rows .='<td style="border: 1px solid #eee;color:#eee;">'.$output_query["Sch_day"]->format('Y-m-d').'</td>';
$rows .='<td style="border: 1px solid #eee;color:#eee;">'.$output_query["Groups"].'</td>';

if(floor(($output_query["Absenteeism"])*100) > 5)
  {

$rows.='<td style="border: 1px solid #6666;color:#eee; background-color:tomato;">'.floor(($output_query['Absenteeism'])*100).'%'.'</td>';
}
if(floor(($output_query["Absenteeism"])*100) <= 5 )
  {

$rows.='<td style="border: 1px solid #6666;color:#eee; background-color:#009966;">'.floor(($output_query['Absenteeism'])*100).'%'.'</td>';
}

echo $rows;
}
}
if(($_SESSION['username'] == 'ahmed.akef') || ($_SESSION['role_id'] == 1) ){
   $Absence2 = sqlsrv_query( $con ,"with tbl_Sch as

( SELECT

lower([dbo].[schedule_table].[username])

[username],
[groups]
,[schedule_table].[schedule_date],

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

                        
FROM  [schedule_table]
left join Employess_DB.dbo.tbl_Personal_info on tbl_Personal_info.UserName = [schedule_table].username
left join Employess_DB.dbo.Tbl_Groups on Group_ID = [Group]
WHERE  [schedule_table].[shift_start] <> 'off' and year([schedule_table].schedule_date ) =year(getdate()))

,

tbl_leave_deduc as (
SELECT [leaves].[username],
[groups]
,tbl_Sch.[schedule_date],
sum(sch_time) [Leave_time]
FROM[Aya_Web_APP].[dbo].[leaves]
JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])
AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]

WHERE  [leaves].[type] = 'Sick Leave'
AND [leaves].[status] = 'E-workforce and senior approve'
GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]

union

SELECT [leaves].[username],
[groups],
tbl_Sch.[schedule_date],
sum(sch_time) [Leave_time]
FROM[Aya_Web_APP].[dbo].[leaves]
JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])
AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]
WHERE  [leaves].[type] = 'Annual Leave'
AND [leaves].[status] = 'E-workforce and senior approve'
and ([leaves].[creation_time] > [adate] or [leaves].[creation_time] > [bdate])

GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]
union

SELECT [leaves].[username],
[groups],
tbl_Sch.[schedule_date],

CAST(CONVERT(DATETIME,  CONVERT(varchar, DATEADD(ms, Sum(DATEDIFF(second, starttime, endtime)) * 1000, 0), 114)) AS FLOAT) [Leave_time]

FROM [Aya_Web_APP].[dbo].[leaves] JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username]) AND tbl_Sch.[schedule_date] BETWEEN [adate] AND [bdate]
WHERE  [type] = 'Permission'
AND [status] = 'E-workforce and senior approve'
AND adate = tbl_Sch.schedule_date
GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]

union

SELECT [deduction].[username],
[groups],
tbl_Sch.[schedule_date],

--sum(datepart(hour, [deduction].[a_time]) * 3600 + datepart(minute, [deduction].[a_time]) * 60 + 
--datepart(second, [deduction].[a_time])) [Leave_time]

sum(cast(cast ([deduction].[a_time] as datetime) as float)) [Leave_time]


FROM [dbo].[deduction]
JOIN
tbl_Sch
ON (tbl_Sch.[username] = [deduction].[username])
AND tbl_Sch.[schedule_date] = [deduction].[a_date]
WHERE  tbl_Sch.[schedule_date] = [deduction].[a_date] AND [stat_added] = 'added'
AND  [item] NOT LIKE ('forg%') 
--[item] NOT LIKE ('_orget to login out%')

GROUP BY [deduction].[username], tbl_Sch.[schedule_date],[groups]),

Final_absec as (

select tbl_Sch.username
,tbl_Sch.Groups
,Sum(tbl_Sch.Sch_time) Sch_time

,tbl_Sch.schedule_date Sch_day

 -- ,Sum(cast(dateadd(second, tbl_leave_deduc.Leave_time, '00:00:00') AS float)) Leave_time

 ,Sum(tbl_leave_deduc.Leave_time) [Leave_time]
from 

tbl_Sch

left join tbl_leave_deduc

on tbl_leave_deduc.username = tbl_Sch.username

and tbl_leave_deduc.schedule_date = tbl_Sch.schedule_date

group by tbl_Sch.username,tbl_Sch.schedule_date,tbl_Sch.Groups,tbl_Sch.[groups])


select

Sch_day
,Final_absec.Groups
,iif((sum(Leave_time) / Sum(Sch_time))is  null ,0,(sum(Leave_time) / Sum(Sch_time))) Absenteeism


from

Final_absec
--left join [Employess_DB].[dbo].[tbl_Personal_info] on Final_absec.username = [tbl_Personal_info].username
--left join [Employess_DB].[dbo].[Tbl_Groups] on [Group_ID] = [group]
group by Sch_day,Final_absec.Groups
order by 1");
   while( $output_query = sqlsrv_fetch_array($Absence2)){
$rows  ='<tr >';
$rows .='<td style="border: 1px solid #eee;color:#eee;">'.$output_query["Sch_day"]->format('Y-m-d').'</td>';
$rows .='<td style="border: 1px solid #eee;color:#eee;">'.$output_query["Groups"].'</td>';
if(floor(($output_query["Absenteeism"])*100) > 5)
  {

$rows.='<td style="border: 1px solid #6666;color:#eee; background-color:tomato;">'.floor(($output_query['Absenteeism'])*100).'%'.'</td>';
}
if(floor(($output_query["Absenteeism"])*100) <= 5 )
  {

$rows.='<td style="border: 1px solid #6666;color:#eee; background-color:#009966;">'.floor(($output_query['Absenteeism'])*100).'%'.'</td>';
}

echo $rows;
}

}
else{
  $Absence2 = sqlsrv_query( $con ,"with tbl_Sch as

( SELECT

lower([dbo].[schedule_table].[username])

[username],
[groups]
,[schedule_table].[schedule_date],

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

                        
FROM  [schedule_table]
left join Employess_DB.dbo.tbl_Personal_info on tbl_Personal_info.UserName = [schedule_table].username
left join Employess_DB.dbo.Tbl_Groups on Group_ID = [Group]
WHERE  [schedule_table].[shift_start] <> 'off' and year([schedule_table].schedule_date ) =year(getdate()))

,

tbl_leave_deduc as (
SELECT [leaves].[username],
[groups]
,tbl_Sch.[schedule_date],
sum(sch_time) [Leave_time]
FROM[Aya_Web_APP].[dbo].[leaves]
JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])
AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]

WHERE  [leaves].[type] = 'Sick Leave'
AND [leaves].[status] = 'E-workforce and senior approve'
GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]

union

SELECT [leaves].[username],
[groups],
tbl_Sch.[schedule_date],
sum(sch_time) [Leave_time]
FROM[Aya_Web_APP].[dbo].[leaves]
JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])
AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]
WHERE  [leaves].[type] = 'Annual Leave'
AND [leaves].[status] = 'E-workforce and senior approve'
and ([leaves].[creation_time] > [adate] or [leaves].[creation_time] > [bdate])

GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]
union

SELECT [leaves].[username],
[groups],
tbl_Sch.[schedule_date],

CAST(CONVERT(DATETIME,  CONVERT(varchar, DATEADD(ms, Sum(DATEDIFF(second, starttime, endtime)) * 1000, 0), 114)) AS FLOAT) [Leave_time]

FROM [Aya_Web_APP].[dbo].[leaves] JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username]) AND tbl_Sch.[schedule_date] BETWEEN [adate] AND [bdate]
WHERE  [type] = 'Permission'
AND [status] = 'E-workforce and senior approve'
AND adate = tbl_Sch.schedule_date
GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]

union

SELECT [deduction].[username],
[groups],
tbl_Sch.[schedule_date],

--sum(datepart(hour, [deduction].[a_time]) * 3600 + datepart(minute, [deduction].[a_time]) * 60 + 
--datepart(second, [deduction].[a_time])) [Leave_time]

sum(cast(cast ([deduction].[a_time] as datetime) as float)) [Leave_time]


FROM [dbo].[deduction]
JOIN
tbl_Sch
ON (tbl_Sch.[username] = [deduction].[username])
AND tbl_Sch.[schedule_date] = [deduction].[a_date]
WHERE  tbl_Sch.[schedule_date] = [deduction].[a_date] AND [stat_added] = 'added'
AND  [item] NOT LIKE ('forg%') 

GROUP BY [deduction].[username], tbl_Sch.[schedule_date],[groups]),

Final_absec as (

select tbl_Sch.username
,tbl_Sch.Groups
,Sum(tbl_Sch.Sch_time) Sch_time

,tbl_Sch.schedule_date Sch_day

 -- ,Sum(cast(dateadd(second, tbl_leave_deduc.Leave_time, '00:00:00') AS float)) Leave_time

 ,Sum(tbl_leave_deduc.Leave_time) [Leave_time]
from 

tbl_Sch

left join tbl_leave_deduc

on tbl_leave_deduc.username = tbl_Sch.username

and tbl_leave_deduc.schedule_date = tbl_Sch.schedule_date

group by tbl_Sch.username,tbl_Sch.schedule_date,tbl_Sch.Groups,tbl_Sch.[groups])


select

Sch_day
,Final_absec.Groups
,iif((sum(Leave_time) / Sum(Sch_time))is  null ,0,(sum(Leave_time) / Sum(Sch_time))) Absenteeism


from

Final_absec
--left join [Employess_DB].[dbo].[tbl_Personal_info] on Final_absec.username = [tbl_Personal_info].username
--left join [Employess_DB].[dbo].[Tbl_Groups] on [Group_ID] = [group]

where Final_absec.Groups = '$my_group'
group by Sch_day,Final_absec.Groups
order by 1");
   while( $output_query = sqlsrv_fetch_array($Absence2)){
$rows  ='<tr >';
$rows .='<td style="border: 1px solid #eee;color:#eee;">'.$output_query["Sch_day"]->format('Y-m-d').'</td>';
if(floor(($output_query["Absenteeism"])*100) > 5)
  {

$rows.='<td style="border: 1px solid #6666;color:#eee; background-color:tomato;">'.floor(($output_query['Absenteeism'])*100).'%'.'</td>';
}
if(floor(($output_query["Absenteeism"])*100) <= 5 )
  {

$rows.='<td style="border: 1px solid #6666;color:#eee; background-color:#009966;">'.floor(($output_query['Absenteeism'])*100).'%'.'</td>';
}

echo $rows;
}
}
?>
</tbody>
</table>
</div>

          </div>
        </div>
      </center>
      </div>
      <?php 
}
?>

<?php
/////utilization_table
$CurrentYear =  date("Y");
if(isset($_GET['Utilizgroup'])){

//if(isset($_GET['utilization'])){

  $first_query = sqlsrv_query( $con ,"SELECT [date],Groups [Group name]
         ,IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([work_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([work_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))) [utilization]
         ,iif(IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))) is null ,0,IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float))))) [Tasks]
       from [dbo].[utilization_table] b
     left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
     left join Employess_DB.dbo.Tbl_Groups on Group_ID = [Group]
       where year([date]) >='$CurrentYear' and b.username in ( select username from [Aya_Web_APP].dbo.employee_web_table where manager = '$self')
       group by[date], Groups 
     order by 1,2");

  $chart_data ='';

 while( $output = sqlsrv_fetch_array($first_query) )

{

  $chart_data .="{date22:'".$output['date']->format('Y-m-d')."',utilization:".floor(($output["utilization"])*100).",non_utilized:".floor(($output["Tasks"])*100)."},";
}
$chart_data = substr($chart_data, 0);
$out_user=$output['username'];
//$charts= ($chart_data .''. $chart_data2);
}
$new_q= sqlsrv_query( $con , "SELECT 
  groups
    FROM [Employess_DB].[dbo].[tbl_Personal_info]
    left join Employess_DB.dbo.Tbl_Groups on Group_ID = [Group]
    where username = '$s_username'");
  $out_new = sqlsrv_fetch_array($new_q);
  $my_group = $out_new['groups'];
/// Absence
 if(($_SESSION['username'] == 'ahmed.mohamedbassal') ||
($_SESSION['username'] == 'Mohamed.abdeltwab') ){

  $Absence = sqlsrv_query( $con ,"with tbl_Sch as

( SELECT

lower([dbo].[schedule_table].[username])

[username],
[groups]
,[schedule_table].[schedule_date],

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

                        
FROM  [schedule_table]
left join Employess_DB.dbo.tbl_Personal_info on tbl_Personal_info.UserName = [schedule_table].username
left join Employess_DB.dbo.Tbl_Groups on Group_ID = [Group]
WHERE  [schedule_table].[shift_start] <> 'off' and year([schedule_table].schedule_date ) = year(getdate())),

tbl_leave_deduc as (
SELECT [leaves].[username],
[groups]
,tbl_Sch.[schedule_date],
sum(sch_time) [Leave_time]
FROM[Aya_Web_APP].[dbo].[leaves]
JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])
AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]

WHERE  [leaves].[type] = 'Sick Leave'
AND [leaves].[status] = 'E-workforce and senior approve'
GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]

union

SELECT [leaves].[username],
[groups],
tbl_Sch.[schedule_date],
sum(sch_time) [Leave_time]
FROM[Aya_Web_APP].[dbo].[leaves]
JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])
AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]
WHERE  [leaves].[type] = 'Annual Leave'
AND [leaves].[status] = 'E-workforce and senior approve'
and ([leaves].[creation_time] > [adate] or [leaves].[creation_time] > [bdate])

GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]
union

SELECT [leaves].[username],
[groups],
tbl_Sch.[schedule_date],
CAST(CONVERT(DATETIME,  CONVERT(varchar, DATEADD(ms, Sum(DATEDIFF(second, starttime, endtime)) * 1000, 0), 114)) AS FLOAT) [Leave_time]

FROM [Aya_Web_APP].[dbo].[leaves] JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username]) AND tbl_Sch.[schedule_date] BETWEEN [adate] AND [bdate]
WHERE  [type] = 'Permission'
AND [status] = 'E-workforce and senior approve'
AND adate = tbl_Sch.schedule_date
GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]

union

SELECT [deduction].[username],
[groups],
tbl_Sch.[schedule_date],

sum(cast(cast ([deduction].[a_time] as datetime) as float)) [Leave_time]


FROM [dbo].[deduction]
JOIN
tbl_Sch
ON (tbl_Sch.[username] = [deduction].[username])
AND tbl_Sch.[schedule_date] = [deduction].[a_date]
WHERE  tbl_Sch.[schedule_date] = [deduction].[a_date] AND [stat_added] = 'added'
AND [item] NOT LIKE ('forg%') 
GROUP BY [deduction].[username], tbl_Sch.[schedule_date],[groups]),

Final_absec as (

select tbl_Sch.username
,tbl_Sch.Groups
,Sum(tbl_Sch.Sch_time) Sch_time

,tbl_Sch.schedule_date Sch_day

--,Sum(cast(dateadd(second, tbl_leave_deduc.Leave_time, '00:00:00') AS float)) Leave_time

,Sum(tbl_leave_deduc.Leave_time) [leave_time]

from 

tbl_Sch

left join tbl_leave_deduc

on tbl_leave_deduc.username = tbl_Sch.username

and tbl_leave_deduc.schedule_date = tbl_Sch.schedule_date

group by tbl_Sch.username,tbl_Sch.schedule_date,tbl_Sch.Groups,tbl_Sch.[groups])


select

Sch_day
,Final_absec.Groups
--,iif(Manager_Name is null, 'not in DB' ,Manager_Name) Manager_Name


,iif((sum(Leave_time) / Sum(Sch_time))is  null ,0,(sum(Leave_time) / Sum(Sch_time))) Absenteeism


from

Final_absec
--left join [Employess_DB].[dbo].[tbl_Personal_info] on Final_absec.username = [tbl_Personal_info].username
--left join [Employess_DB].[dbo].[Tbl_Groups] on [Group_ID] = [group]

where Final_absec.Groups in ('Private KAM' ,'GDS(Global Partner)')
group by Sch_day,Final_absec.Groups
order by 1");
   $Line_absence ='';
 while( $Absence_out = sqlsrv_fetch_array($Absence) ){
$Line_absence .="{ Absenteeism:'".floor(($Absence_out['Absenteeism'])*100)."',date202:'".$Absence_out['Sch_day']->format('Y-m-d')."'},";

}
$Line_absence = substr($Line_absence, 0);
}else{
  $Absence = sqlsrv_query( $con ,"with tbl_Sch as

( SELECT

lower([dbo].[schedule_table].[username])

[username],
[groups]
,[schedule_table].[schedule_date],

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

                        
FROM  [schedule_table]
left join Employess_DB.dbo.tbl_Personal_info on tbl_Personal_info.UserName = [schedule_table].username
left join Employess_DB.dbo.Tbl_Groups on Group_ID = [Group]
WHERE  [schedule_table].[shift_start] <> 'off' and year([schedule_table].schedule_date ) = year(getdate()))

,

tbl_leave_deduc as (
SELECT [leaves].[username],
[groups]
,tbl_Sch.[schedule_date],
sum(sch_time) [Leave_time]
FROM[Aya_Web_APP].[dbo].[leaves]
JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])
AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]

WHERE  [leaves].[type] = 'Sick Leave'
AND [leaves].[status] = 'E-workforce and senior approve'
GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]

union

SELECT [leaves].[username],
[groups],
tbl_Sch.[schedule_date],
sum(sch_time) [Leave_time]
FROM[Aya_Web_APP].[dbo].[leaves]
JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])
AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]
WHERE  [leaves].[type] = 'Annual Leave'
AND [leaves].[status] = 'E-workforce and senior approve'
and ([leaves].[creation_time] > [adate] or [leaves].[creation_time] > [bdate])

GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]
union

SELECT [leaves].[username],
[groups],
tbl_Sch.[schedule_date],

CAST(CONVERT(DATETIME,  CONVERT(varchar, DATEADD(ms, Sum(DATEDIFF(second, starttime, endtime)) * 1000, 0), 114)) AS FLOAT) [Leave_time]


FROM [Aya_Web_APP].[dbo].[leaves] JOIN
tbl_Sch ON (tbl_Sch.[username] = [leaves].[username]) AND tbl_Sch.[schedule_date] BETWEEN [adate] AND [bdate]

WHERE  [type] = 'Permission'
AND [status] = 'E-workforce and senior approve'
AND adate = tbl_Sch.schedule_date
GROUP BY [leaves].[username], tbl_Sch.[schedule_date],[groups]

union

SELECT [deduction].[username],
[groups],
tbl_Sch.[schedule_date],
-- sum(datepart(hour, [deduction].[a_time]) * 3600 + datepart(minute, [deduction].[a_time]) * 60 + 
-- datepart(second, [deduction].[a_time])) [Leave_time]
 sum(cast(cast ([deduction].[a_time] as datetime) as float)) [Leave_time]


FROM [dbo].[deduction]
JOIN
tbl_Sch
ON (tbl_Sch.[username] = [deduction].[username])
AND tbl_Sch.[schedule_date] = [deduction].[a_date]
WHERE  tbl_Sch.[schedule_date] = [deduction].[a_date] AND [stat_added] = 'added'
AND [item] NOT LIKE ('forg%') 
GROUP BY [deduction].[username], tbl_Sch.[schedule_date],[groups]),

Final_absec as (

select tbl_Sch.username
,tbl_Sch.Groups
,Sum(tbl_Sch.Sch_time) Sch_time

,tbl_Sch.schedule_date Sch_day

,Sum(tbl_leave_deduc.Leave_time) [leave_time]
 ---,Sum(cast(dateadd(second, tbl_leave_deduc.Leave_time, '00:00:00') AS float)) Leave_time

from 

tbl_Sch

left join tbl_leave_deduc

on tbl_leave_deduc.username = tbl_Sch.username

and tbl_leave_deduc.schedule_date = tbl_Sch.schedule_date

group by tbl_Sch.username,tbl_Sch.schedule_date,tbl_Sch.Groups,tbl_Sch.[groups])


select

Sch_day
,Final_absec.Groups
--,iif(Manager_Name is null, 'not in DB' ,Manager_Name) Manager_Name


,iif((sum(Leave_time) / Sum(Sch_time))is  null ,0,(sum(Leave_time) / Sum(Sch_time))) Absenteeism


from

Final_absec
--left join [Employess_DB].[dbo].[tbl_Personal_info] on Final_absec.username = [tbl_Personal_info].username
--left join [Employess_DB].[dbo].[Tbl_Groups] on [Group_ID] = [group]

where Final_absec.Groups ='$my_group'
group by Sch_day,Final_absec.Groups
order by 1");
   $Line_absence ='';
 while( $Absence_out = sqlsrv_fetch_array($Absence) ){
$Line_absence .="{ Absenteeism:'".floor(($Absence_out['Absenteeism'])*100)."',date202:'".$Absence_out['Sch_day']->format('Y-m-d')."'},";
}
$Line_absence = substr($Line_absence, 0);

}
?>
<script src="js/jquery22.min.js"></script>
<script src="js/bootstrap22.min.js"></script>
<script src="js/raphael22.min.js"></script>
<script src="js/morris22.min.js"></script>
<script src="js/fastclick22.js"></script>
<script src="js/adminlte22.min.js"></script>
<script src="js/demo22.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
<script src="js/Chart.min"></script>

  <?php if(isset($_GET['Utilizgroup'])){?>

<script type="text/javascript">
     $(function () {
    "use strict";
//$utilization
var line = new Morris.Area({
      element: 'line-utiliz',
      resize: true,
      data: [<?php echo $chart_data;?>],
      xkey: "date22",
      ykeys: ["utilization","non_utilized"],
      labels: ["utilizedss", "non_utilized"],
      hideHover: 'auto'
    });
});
</script>
<?php 
}
?>
 <?php if(isset($_GET['Absence'])){?>
<script type="text/javascript">
  //$Absence
     $(function () {
    "use strict";
var line = new Morris.Area({
      element: 'line-Absence',
      resize: true,
      data: [<?php echo $Line_absence;?>],
      xkey: 'date202',
      ykeys: ['Absenteeism'],
      labels: ['Absence'],
      lineColors: ['#3c8dbc','#a0d0e0'],
      hideHover: 'auto'
    });

   });
  </script>
<?php 
}
?>

<?php 
include ("footer.html");
?>