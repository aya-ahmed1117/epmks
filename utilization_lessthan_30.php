 <?php 
  
include ("pages.php");
    $self = $_SESSION['id'];
    $role_id = $_SESSION['role_id'];
    $usernames="";
    if(isset($_POST['username'])){$usernames = $_POST['username'];}
    $self = $_SESSION['id'];
    $role_id = $_SESSION['role_id'];
    ?>
  <title>Utilization Less than 30%</title>
       
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fixed_s/vendor/animate/animate.css">
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
<center>
  
<div class="col-md-9">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Less Than 30%
              <a href="utilization_less_abusing.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a>
</h2>
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This shows the employee that have utilization less than 30 % in the past 30 days</p>
  </aside>
</div>
</center>

<div style="padding:20px;">

<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead >
    <tr>
        <th ><center>date</center></th>
        <th ><center>username</center></th>
        <th ><center>manager</center></th>
        <th ><center>utilization</center></th>
        <th ><center>tasks</center></th>
        <th ><center>comment</center></th>	
	</tr>
	</thead>
  <tbody>

<?php
   $new_query = sqlsrv_query($con ,"declare @date as date
set @date=dateadd(day,-30,cast(getdate() as date));
WITH Sch_tbl as (
SELECT [dbo].[schedule_table].[username]
      ,[schedule_date]
      ,dateadd(minute,-30,(cast([shift_start] as datetime)+cast([schedule_date] as datetime))) [Start_Shift]
      ,IIF(([shift_start] between '12:00:00' and '23:59:59' and (cast(cast([shift_end] as datetime)-cast([shift_start] as datetime) as time) ='12:00:00') or ([shift_start] between '16:00:00' and '23:59:59')),(cast([shift_end] as datetime)+DATEADD(day,1,cast([schedule_date] as datetime))),(cast([shift_end] as datetime)+cast([schedule_date] as datetime))) [End_Shift]
  FROM [schedule_table] 
  WHERE [shift_start] <> 'off' and [schedule_date] >= @date
  ),

  Tickets as (
  select [login name] username
  ,requestID
  from [WorkforceDB_indexed].[dbo].[TicketHistory_indexed] left join [Sch_tbl] on [login name]=[username]
where [login name] not in ( 'api.sd','api.sc') and [login name] is not null and [OPERATION TIME] between [start_shift] and [end_shift]),

X1 as(
Select username, requestid
from Tickets
except
select username, RequestID
from AHT_per_Ticket  
where [schedule_date]>=@date),

Final as (
select distinct username,'no process' [status]
from X1 

union

(select distinct username,'No Tickets'
from utilization_table
where [date]>=@date
except 
select distinct username,'No tickets'
from AHT_per_Ticket
where [schedule_date]>=@date)),

Final_Utilization as
( select [date], [utilization_table].[username],[manager],[utilization],iif([non_utilized] is null,'0',[non_utilized] ) as Tasks, iif ([status] is null, 'normal',[status]) [comment]
from utilization_table 
left join Final on [utilization_table].[username]=[Final].[username]
left join Employess_DB.dbo.tbl_personal_info a on a.username = utilization_table.username
where [utilization_table].[date]>=@date and unit in(14,12) and  utilization <= 0.30 )

select *
from Final_Utilization
where username in ( select username from employee_web_table where manager = '$self')
order by 1,2
");

	while($echo = sqlsrv_fetch_array($new_query) ){

        $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['date']->format('Y-m-d').'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['username'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['manager'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($echo['utilization'])*100).'%'.'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.floor(($echo['Tasks'])*100).'%'.'</td>';
if($echo['comment'] == 'Normal'){
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['comment'].'</td>';}
else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['comment'].'</td>';} 
$rows .= '</tr>';
	  	echo $rows;

 }?>
 </tbody>
</table>
</div>
</div>
  <?php

 include ("footer.html");
 ?>