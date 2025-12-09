<?php
 //session_start();
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
    

sqlsrv_query( $con1 , "SET NAMES 'utf8'"); 
sqlsrv_query( $con1 ,'SET CHARACTER SET utf8' );

      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
    if(isset($_GET['yesterday'])){$someday = $_GET['yesterday'];

      //yesterday
      $new_query = sqlsrv_query( $con , "with tbl_Sch as

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

              

WHERE  [schedule_table].[shift_start] <> 'off' and cast([schedule_table].schedule_date as date) = cast(dateadd(day,-2,getdate()) as date)),

tbl_leave_deduc as (

SELECT [leaves].[username],

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

and ([leaves].[creation_time] > [adate] or [leaves].[creation_time] > [bdate]) and id<>'173897'



GROUP BY [leaves].[username], tbl_Sch.[schedule_date]

union



SELECT [leaves].[username],

tbl_Sch.[schedule_date],

CAST(CONVERT(DATETIME,  CONVERT(varchar, DATEADD(ms, Sum(DATEDIFF(second, starttime, endtime)) * 1000, 0), 114)) AS FLOAT) [Leave_time]
FROM [Aya_Web_APP].[dbo].[leaves] JOIN

tbl_Sch ON (tbl_Sch.[username] = [leaves].[username]) AND tbl_Sch.[schedule_date] BETWEEN [adate] AND [bdate]

WHERE  [type] = 'Permission'

AND [status] = 'E-workforce and senior approve'

AND adate = tbl_Sch.schedule_date

GROUP BY [leaves].[username], tbl_Sch.[schedule_date]



union



SELECT [deduction].[username],

tbl_Sch.[schedule_date],

sum(cast(cast ([deduction].[a_time] as datetime) as float)) [Leave_time]

FROM [dbo].[deduction]

JOIN

tbl_Sch

ON (tbl_Sch.[username] = [deduction].[username])

AND tbl_Sch.[schedule_date] = [deduction].[a_date]

WHERE  tbl_Sch.[schedule_date] = [deduction].[a_date] AND [stat_added] = 'added'

AND [item] NOT LIKE ('forg%')

GROUP BY [deduction].[username], tbl_Sch.[schedule_date]),





Final_absec as (



select tbl_Sch.username

,Sum(tbl_Sch.Sch_time) Sch_time

,tbl_Sch.schedule_date Sch_day

--,Sum(cast(dateadd(second, tbl_leave_deduc.Leave_time, '00:00:00') AS float)) Leave_time

,Sum(tbl_leave_deduc.Leave_time) [Leave_time]

from 

tbl_Sch

left join tbl_leave_deduc

on tbl_leave_deduc.username = tbl_Sch.username

and tbl_leave_deduc.schedule_date = tbl_Sch.schedule_date

group by tbl_Sch.username,tbl_Sch.schedule_date),



utiliz as

(

select [date] Util_day,username

,sum(cast(cast([work_duration] as datetime) as float)) [work_duration]

         ,sum(cast(cast([scheduled_duration] as datetime) as float)) [scheduled_duration]

         ,IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([work_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([work_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))) [utilization]

         ,iif(IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))) is null ,0,IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float))))) [Non-utilized]

       from [dbo].[utilization_table]

       where cast([date] as date) = cast(dateadd(day,-2,getdate()) as date)

       group by username ,[date])



select



Sch_day

,Final_absec.username

,iif(Manager_Name is null, 'not in DB' ,Manager_Name) Manager_Name

,iif([Groups] is null , 'No Group',[Groups]) [Groups]
,iif(SubGroups is null , 'No SubGroups',SubGroups)  SubGroups

,iif((Leave_time / Sch_time)is  null ,0,(Leave_time / Sch_time)) Absenteeism

,utilization

,[Non-utilized] [Tasks]

from

Final_absec

Full join utiliz on  Sch_day = Util_day and Final_absec.username = utiliz.username

left join [Employess_DB].[dbo].[tbl_Personal_info] on Final_absec.username = 
[tbl_Personal_info].username

left join [Employess_DB].[dbo].[Tbl_Groups] on [Group_ID] = [group]
left join [Employess_DB].[dbo].[Tbl_SubGroups] on [Tbl_SubGroups].SubGroup_ID = [tbl_Personal_info].sub_Group
where [tbl_Personal_info].username ='$s_username'
order by 1,2,3


");
  

      while($echo = sqlsrv_fetch_array($new_query) ){

$rows = '<tr>';
  if($echo["Sch_day"] == NULL ){
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:lightgray ; font-size:13px ;color:black;">
  Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Sch_day']->format('Y-m-d').'</td>';}
  //$rows .='<td style="font-size:15px ;color:black; border: 1px solid #000000;">'.$echo['Sch_day']->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['username'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Manager_Name'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Groups'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['SubGroups'].'</td>';

  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:#6b5b95;">'.floor(($echo['Absenteeism'])*100).'%'.'</td>';
  //
  if($echo["utilization"] == NULL ){
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:lightgray ; font-size:13px ;color:black;">
  Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:#6b5b95;">'.floor(($echo['utilization'])*100).'%'.'</td>';}
  //
  if($echo["Tasks"] == NULL ){
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:lightgray; font-size:13px ;color:black;">
  Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:#6b5b95;">'.floor(($echo['Tasks'])*100).'%'.'</td>';}
$rows .= '</tr>';
 echo $rows;

}
}
?>
<?php 
// week
if(isset($_GET['week'])){$week = $_GET['week'];   
 $new_query = sqlsrv_query( $con , "with tbl_Sch as

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

             

WHERE  [schedule_table].[shift_start] <> 'off' and cast([schedule_table].schedule_date as date) between (SELECT cast(DATEADD(wk, DATEDIFF(wk, 6, '1/1/' + cast(year(getdate())as nvarchar)) + (datepart(week,getdate())-2), 6)as date)) and dateadd(day,6,cast(DATEADD(wk, DATEDIFF(wk, 6, '1/1/' + cast(year(getdate())as nvarchar)) + (datepart(week,getdate())-2), 6)as date))

)

,



tbl_leave_deduc as (

SELECT [leaves].[username],

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

and ([leaves].[creation_time] > [adate] or [leaves].[creation_time] > [bdate]) and id<>'173897'

GROUP BY [leaves].[username], tbl_Sch.[schedule_date]



union



SELECT [leaves].[username],

tbl_Sch.[schedule_date],

CAST(CONVERT(DATETIME,  CONVERT(varchar, DATEADD(ms, Sum(DATEDIFF(second, starttime, endtime)) * 1000, 0), 114)) AS FLOAT) [Leave_time]
FROM [Aya_Web_APP].[dbo].[leaves] JOIN

tbl_Sch ON (tbl_Sch.[username] = [leaves].[username]) AND tbl_Sch.[schedule_date] BETWEEN [adate] AND [bdate]

WHERE  [type] = 'Permission'

AND [status] = 'E-workforce and senior approve'

AND adate = tbl_Sch.schedule_date

GROUP BY [leaves].[username], tbl_Sch.[schedule_date]

union

SELECT [deduction].[username],

tbl_Sch.[schedule_date],

sum(cast(cast ([deduction].[a_time] as datetime) as float)) [Leave_time]

FROM [dbo].[deduction]

JOIN

tbl_Sch

ON (tbl_Sch.[username] = [deduction].[username])

AND tbl_Sch.[schedule_date] = [deduction].[a_date]

WHERE  tbl_Sch.[schedule_date] = [deduction].[a_date] AND [stat_added] = 'added'
AND [item] NOT LIKE ('forg%')

GROUP BY [deduction].[username], tbl_Sch.[schedule_date]),



Final_absec as (

select tbl_Sch.username

,Sum(tbl_Sch.Sch_time) Sch_time


,Sum(tbl_leave_deduc.Leave_time) [Leave_time]
--,Sum(cast(dateadd(second, tbl_leave_deduc.Leave_time, '00:00:00') AS float)) Leave_time

from

tbl_Sch

left join tbl_leave_deduc

on tbl_leave_deduc.username = tbl_Sch.username

and tbl_leave_deduc.schedule_date = tbl_Sch.schedule_date

group by tbl_Sch.username),

utiliz as

(

select username

,sum(cast(cast([work_duration] as datetime) as float)) [work_duration]

         ,sum(cast(cast([scheduled_duration] as datetime) as float)) [scheduled_duration]

         ,IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([work_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([work_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))) [utilization]

         ,iif(IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))) is null ,0,IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float))))) [Non-utilized]

       from [dbo].[utilization_table]

       where cast([date] as date)between (SELECT cast(DATEADD(wk, DATEDIFF(wk, 6, '1/1/' + cast(year(getdate())as nvarchar)) + (datepart(week,getdate())-2), 6)as date)) and dateadd(day,6,cast(DATEADD(wk, DATEDIFF(wk, 6, '1/1/' + cast(year(getdate())as nvarchar)) + (datepart(week,getdate())-2), 6)as date))

       group by username )

select

DATEPART(week, DATEADD(week, -1, getdate())) Weeknum

, DATEPART(yyyy, DATEADD(week, -1, getdate())) [Year]

,Final_absec.username

,iif(Manager_Name is null, 'not in DB' ,Manager_Name) Manager_Name

,iif([Groups] is null , 'No Group',[Groups]) [Groups]
,iif(SubGroups is null , 'No SubGroups',SubGroups)  SubGroups

,iif((Leave_time / Sch_time)is  null ,0,(Leave_time / Sch_time)) Absenteeism

,utilization

,[Non-utilized][Tasks]

from

Final_absec

full join utiliz on  Final_absec.username = utiliz.username

left join [Employess_DB].[dbo].[tbl_Personal_info] on Final_absec.username = 
[tbl_Personal_info].username

left join [Employess_DB].[dbo].[Tbl_Groups] on [Group_ID] = [group]
left join [Employess_DB].[dbo].[Tbl_SubGroups] on [Tbl_SubGroups].SubGroup_ID = [tbl_Personal_info].sub_Group
where [tbl_Personal_info].username ='$s_username'
order by 1,2,3

 ");
    while($echo = sqlsrv_fetch_array($new_query) ){

$rows = '<tr>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Weeknum'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Year'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['username'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Manager_Name'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Groups'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['SubGroups'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:#6b5b95;color:white;">'.floor(($echo['Absenteeism'])*100).'%'.'</td>';
  if($echo["utilization"] == NULL ){
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:lightgray ; font-size:13px ;color:black;">
  Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:#6b5b95;color:white;">'.floor(($echo['utilization'])*100).'%'.'</td>';}
  //
  if($echo["Tasks"] == NULL ){
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:lightgray; font-size:13px ;color:black;">
  Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:#6b5b95;color:white;">'.floor(($echo['Tasks'])*100).'%'.'</td>';}   

$rows .= '</tr>';
echo $rows;

}
}
?>
<?php 
// month
if(isset($_GET['month'])){$month = $_GET['month'];   
 $new_query = sqlsrv_query( $con , "with tbl_Sch as

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

              

WHERE  [schedule_table].[shift_start] <> 'off' and year([schedule_table].schedule_date) >= '2020'),





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

and ([leaves].[creation_time] > [adate] or [leaves].[creation_time] > [bdate]) and id<>'173897'



GROUP BY [leaves].[username], tbl_Sch.[schedule_date]

union


SELECT [leaves].[username],

tbl_Sch.[schedule_date],

CAST(CONVERT(DATETIME,  CONVERT(varchar, DATEADD(ms, Sum(DATEDIFF(second, starttime, endtime)) * 1000, 0), 114)) AS FLOAT) [Leave_time]
FROM [Aya_Web_APP].[dbo].[leaves] JOIN

tbl_Sch ON (tbl_Sch.[username] = [leaves].[username]) AND tbl_Sch.[schedule_date] BETWEEN [adate] AND [bdate]

WHERE  [type] = 'Permission'

AND [status] = 'E-workforce and senior approve'

AND adate = tbl_Sch.schedule_date

GROUP BY [leaves].[username], tbl_Sch.[schedule_date]



union

SELECT [deduction].[username],

tbl_Sch.[schedule_date],

sum(cast(cast ([deduction].[a_time] as datetime) as float)) [Leave_time]

FROM [dbo].[deduction]

JOIN

tbl_Sch

ON (tbl_Sch.[username] = [deduction].[username])

AND tbl_Sch.[schedule_date] = [deduction].[a_date]

WHERE  tbl_Sch.[schedule_date] = [deduction].[a_date] AND [stat_added] = 'added'

AND [item] NOT LIKE ('forg%')

GROUP BY [deduction].[username], tbl_Sch.[schedule_date]),


Final_absec as (

select tbl_Sch.username

,Sum(tbl_Sch.Sch_time) Sch_time

,month(tbl_Sch.schedule_date) Sch_month

,year(tbl_Sch.schedule_date) Sch_Year

--,Sum(cast(dateadd(second, tbl_leave_deduc.Leave_time, '00:00:00') AS float)) Leave_time

,Sum(tbl_leave_deduc.Leave_time) [Leave_time]

from 

tbl_Sch

left join tbl_leave_deduc

on tbl_leave_deduc.username = tbl_Sch.username

and tbl_leave_deduc.schedule_date = tbl_Sch.schedule_date

group by tbl_Sch.username,month(tbl_Sch.schedule_date),year(tbl_Sch.schedule_date)),



utiliz as

(

select year([date])util_year, month([date])Util_month,username

,sum(cast(cast([work_duration] as datetime) as float)) [work_duration]

         ,sum(cast(cast([scheduled_duration] as datetime) as float)) [scheduled_duration]

         ,IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([work_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([work_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))) [utilization]

         ,iif(IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))) is null ,0,IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float))))) [Non-utilized]

       from [dbo].[utilization_table]

       where year([date]) >= '2022'

       group by username ,year([date]),month([date]))



select

Sch_Year

,Sch_month

,Final_absec.username

,iif(Manager_Name is null, 'not in DB' ,Manager_Name) Manager_Name

,iif([Groups] is null , 'No Group',[Groups]) [Groups]
,iif(SubGroups is null , 'No SubGroups',SubGroups)  SubGroups

,iif((Leave_time / Sch_time)is  null ,0,(Leave_time / Sch_time)) Absenteeism

,utilization

,[Non-utilized] [Tasks]

from

Final_absec

full join utiliz on Sch_Year = util_year and Sch_month = Util_month and Final_absec.username = utiliz.username

left join [Employess_DB].[dbo].[tbl_Personal_info] on Final_absec.username = [tbl_Personal_info].username

left join [Employess_DB].[dbo].[Tbl_Groups] on [Group_ID] = [group]
left join [Employess_DB].[dbo].[Tbl_SubGroups] on [Tbl_SubGroups].SubGroup_ID = [tbl_Personal_info].sub_Group

--where Sch_month<=month(getdate())  and Sch_Year <=year(getdate())
where Sch_Year >= 2022

 and  [tbl_Personal_info].username ='$s_username'
order by 1,2,3
 ");
      while($echo = sqlsrv_fetch_array($new_query) ){

$rows = '<tr>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Sch_Year'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Sch_month'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['username'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Manager_Name'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Groups'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['SubGroups'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:#6b5b95;color:white;">'.floor(($echo['Absenteeism'])*100).'%'.'</td>';
  //
  if($echo["utilization"] == NULL ){
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:lightgray ; font-size:13px ;color:black;">
  Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:#6b5b95;color:white;">'.floor(($echo['utilization'])*100).'%'.'</td>';}
  //
  if($echo["Tasks"] == NULL ){
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:lightgray; font-size:13px ;color:black;">
  Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid #000000;background-color:#6b5b95;color:white;">'.floor(($echo['Tasks'])*100).'%'.'</td>';}   
$rows .= '</tr>';
echo $rows;

}
}
?>