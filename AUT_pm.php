
      
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
    

sqlsrv_query( $con1 , "SET NAMES 'utf8'"); 
sqlsrv_query( $con1 ,'SET CHARACTER SET utf8' );

$this_year = date('Y');
?>

<head>
       <title>Absens/utiliz/task Monthly</title>
   <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Absenteeism / utilization / Task's Monthly
      <a href="mwd_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()"><img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
  <th ><center>Sch Year</center></th>
  <th ><center>Sch month</center></th>
  <th ><center>username</center></th>
  <th ><center>Manager Name</center> </th>
  <th ><center>Groups </center></th>
  <th ><center>subgroup </center></th>
  <th ><center>Absenteeism </center></th>
  <th ><center>utilization</center> </th>
  <th ><center>Task's</center></th>	
		</tr>
		</thead>
	
  <tbody>

<?php

        if($_SESSION['role_id'] == 0){
         //include "AHTyesterday.php";
           $_GET['month']="month";
        include ("aut_perUser.php");
            global $month;
        }
      if($_SESSION['role_id'] == 1){
        $new_queryM = sqlsrv_query( $con , "with tbl_Sch as

( SELECT

lower([dbo].[schedule_table].[username])

[username],

[schedule_table].[schedule_date],

cast(IIF(([schedule_table].[shift_start] BETWEEN '12:00:00' AND '23:59:59'

AND (cast(cast([schedule_table].[shift_end] AS datetime)

- cast([schedule_table].[shift_start] AS datetime) AS time) 
= '12:00:00')

OR

([schedule_table].[shift_start] BETWEEN '16:00:00'
AND '23:59:59'))

, (cast([schedule_table].[shift_end] AS datetime) + DATEADD(day, 1, cast([schedule_table].[schedule_date] AS datetime)))

, (cast([schedule_table].[shift_end] AS datetime)

   + cast([schedule_table].[schedule_date] AS datetime)))

   - (cast([schedule_table].[shift_start] AS datetime)

   + cast([schedule_table].[schedule_date] AS datetime))
   AS float) [Sch_time]

                          

FROM     [schedule_table]

              

WHERE  [schedule_table].[shift_start] <> 'off' 
and year([schedule_table].schedule_date) >= '$this_year'and schedule_date not in ('2024-04-12','2024-04-28')),
tbl_leave_deduc as (SELECT [leaves].[username],



tbl_Sch.[schedule_date],



sum(sch_time) [Leave_time]



FROM[Aya_Web_APP].[dbo].[leaves]

JOIN

tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])

AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]

WHERE  [leaves].[type] = 'Sick Leave'

AND [leaves].[status] = 'E-workforce and senior approve'
and leaves.id not in('139272','140076','141916','143972')


GROUP BY [leaves].[username], tbl_Sch.[schedule_date]



union

SELECT [leaves].[username],



tbl_Sch.[schedule_date],



sum(sch_time) [Leave_time]



FROM[Aya_Web_APP].[dbo].[leaves]

JOIN

tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])

AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] 
AND [leaves].[bdate]



WHERE  [leaves].[type] = 'Annual Leave'

AND [leaves].[status] = 'E-workforce and senior approve'

and ([leaves].[creation_time] > [adate] or 
[leaves].[creation_time] > [bdate]) and id<>'173897'

GROUP BY [leaves].[username], tbl_Sch.[schedule_date]


union

SELECT [leaves].[username],

tbl_Sch.[schedule_date],

CAST(CONVERT(DATETIME,  CONVERT(varchar, 
DATEADD(ms, Sum(DATEDIFF(second, starttime, endtime))
* 1000, 0), 114)) AS FLOAT) [Leave_time]

FROM [Aya_Web_APP].[dbo].[leaves] JOIN

tbl_Sch ON (tbl_Sch.[username] = [leaves].[username]) 
AND tbl_Sch.[schedule_date] BETWEEN [adate] AND [bdate]

WHERE  [type] = 'Permission'

AND [status] = 'E-workforce and senior approve'

AND adate = tbl_Sch.schedule_date

GROUP BY [leaves].[username], tbl_Sch.[schedule_date]



union



SELECT [deduction].[username],

tbl_Sch.[schedule_date],

sum(cast(cast ([deduction].[a_time] as datetime) as float))
[Leave_time]

FROM [dbo].[deduction]

JOIN

tbl_Sch

ON (tbl_Sch.[username] = [deduction].[username])

AND tbl_Sch.[schedule_date] = [deduction].[a_date]

WHERE  tbl_Sch.[schedule_date] = [deduction].[a_date] 
AND [stat_added] = 'added'

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

group by tbl_Sch.username,month(tbl_Sch.schedule_date),
year(tbl_Sch.schedule_date)),



utiliz as

(

select year([date])util_year, month([date])Util_month,username

,sum(cast(cast([work_duration] as datetime) as float)) [work_duration]

         ,sum(cast(cast([scheduled_duration] as datetime) as float)) [scheduled_duration]

         ,IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([work_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([work_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))) [utilization]

         ,iif(IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))) is null ,0,IIF(IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float)))>1,1,IIF(sum(cast(cast([scheduled_duration] as datetime) as float)) = 0,0,sum(cast(cast([task_duration] as datetime) as float))/sum(cast(cast([scheduled_duration] as datetime) as float))))) [Non-utilized]

       from [dbo].[utilization_table]

       where year([date]) >= '$this_year'
       group by username ,year([date]),month([date]))

select

Sch_Year

,Sch_month

,Final_absec.username

,iif(Manager_Name is null, 'not in DB' ,
Manager_Name) Manager_Name

,iif([Groups] is null , 'No Group',
[Groups]) [Groups]
,iif(SubGroups is null , 'No SubGroups',SubGroups)  SubGroups

,iif((Leave_time / Sch_time)is  null ,0,(Leave_time / Sch_time)) Absenteeism

,utilization

,[Non-utilized] [Tasks]

from

Final_absec

full join utiliz on Sch_Year = util_year and
Sch_month = Util_month and Final_absec.username =
utiliz.username

left join [Employess_DB].[dbo].[tbl_Personal_info]
on Final_absec.username = [tbl_Personal_info].username

left join [Employess_DB].[dbo].[Tbl_Groups] 
on [Group_ID] = [group]
left join [Employess_DB].[dbo].[Tbl_SubGroups] 
on [Tbl_SubGroups].SubGroup_ID = [tbl_Personal_info].sub_Group

-----where Sch_month <= month(getdate())  and Sch_Year =year(getdate())
where Sch_Year >= $this_year
--and Final_absec.username in ( select username 
--from [Aya_Web_APP].dbo.employee_web_table where
--manager = '$self') 

order by 1,2,3");
while($echo = sqlsrv_fetch_array($new_queryM) ){

$rows = '<tr>';
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$echo['Sch_Year'].'</td>';
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$echo['Sch_month'].'</td>';
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$echo['username'].'</td>';
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$echo['Manager_Name'].'</td>';
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$echo['Groups'].'</td>';
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$echo['SubGroups'].'</td>';
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;background-color:#6b5b95;">'.floor(($echo['Absenteeism'])*100).'%'.'</td>';
  if($echo["utilization"] == NULL ){
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">
  Blank</td>';
  }else{
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;background-color:#6b5b95;">'.floor(($echo['utilization'])*100).'%'.'</td>';}
  //
  if($echo["Tasks"] == NULL ){
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;background-color:lightgray; font-size:13px ;color:black;">
  Blank</td>';
  }else{
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;background-color:#6b5b95;">'.floor(($echo['Tasks'])*100).'%'.'</td>';}   
$rows .= '</tr>';
echo $rows;

            }
      }
      else{
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

              

WHERE  [schedule_table].[shift_start] <> 'off' and year([schedule_table].schedule_date) >= '$this_year'and schedule_date not in ('2024-04-12','2024-04-28')),
tbl_leave_deduc as (SELECT [leaves].[username],



tbl_Sch.[schedule_date],



sum(sch_time) [Leave_time]



FROM[Aya_Web_APP].[dbo].[leaves]

JOIN

tbl_Sch ON (tbl_Sch.[username] = [leaves].[username])

AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]

WHERE  [leaves].[type] = 'Sick Leave'

AND [leaves].[status] = 'E-workforce and senior approve'
and leaves.id not in('139272','140076','141916','143972')


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

       where year([date]) >= '$this_year'
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

-----where Sch_month <= month(getdate())  and Sch_Year =year(getdate())
where Sch_Year >= '$this_year'
and Final_absec.username in ( select username from [Aya_Web_APP].dbo.employee_web_table where manager = '$self') 

order by 1,2,3");while($echo = sqlsrv_fetch_array($new_query) ){

$rows = '<tr>';
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$echo['Sch_Year'].'</td>';
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$echo['Sch_month'].'</td>';
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$echo['username'].'</td>';
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$echo['Manager_Name'].'</td>';
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$echo['Groups'].'</td>';
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$echo['SubGroups'].'</td>';
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;background-color:#6b5b95;">'.floor(($echo['Absenteeism'])*100).'%'.'</td>';
  if($echo["utilization"] == NULL ){
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">
  Blank</td>';
  }else{
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;background-color:#6b5b95;">'.floor(($echo['utilization'])*100).'%'.'</td>';}
  //
  if($echo["Tasks"] == NULL ){
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;background-color:lightgray; font-size:13px ;color:black;">
  Blank</td>';
  }else{
  $rows .='<td  class="hovers" style="border: 1px solid lightgray;background-color:#6b5b95;">'.floor(($echo['Tasks'])*100).'%'.'</td>';}   
$rows .= '</tr>';
echo $rows;

}
}
?>
 </tbody>
</table>

</div>
</div>

<script src="js/table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Absenteeism_utilization_Tasks.xls"
            });
        }
    </script>
 <script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>


