 <?php 
  
include ("pages.php");
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
  overflow-y: auto; height:350px; overflow-x: auto; 
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
              <h2 class="text-dark display-12" >Abnormal Behavior
              <a href="utilization_less_abusing.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">here you can see that the employee exceed more than 3 hours in the same ticket directly in the past 30 days</p>
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
<th ><center>RequestID</center></th>
<th ><center>Username</center></th>
<th ><center>Manager_Name</center></th>
<th ><center>Schedule Date</center></th>
<th ><center>Utilization hours</center></th>
<th ><center>Schedule hours</center></th>		
		</tr>
		</thead>
  <tbody>
<?php
   $new_query = sqlsrv_query($con,"with tbl_Sch as
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
, datediff(hour,((cast([schedule_table].[shift_start] AS datetime)
   + cast([schedule_table].[schedule_date] AS datetime)))
   , (cast([schedule_table].[shift_end] AS datetime)
   + cast([schedule_table].[schedule_date] AS datetime)))) AS int) [Sch_time]
                          
FROM     [schedule_table]
              
WHERE  [schedule_table].[shift_start] <> 'off' --and cast([schedule_table].schedule_date as date) = '2020-07-11'
 
),

x as (

SELECT [RequestID]
      ,[AHT_per_Ticket].[username]
    ,[AHT_per_Ticket].schedule_date
    ,DATEDIFF(hour,[In_],[out_]) Utilization
    ,iif([Sch_time]>12,12,[Sch_time]) [Sch_time]
  FROM [Aya_Web_APP].[dbo].[AHT_per_Ticket]
  left join tbl_Sch on [AHT_per_Ticket].[username] = tbl_Sch.username and [AHT_per_Ticket].schedule_date = tbl_Sch.schedule_date
  where [AHT_per_Ticket].schedule_date >= dateadd(day,-30,cast(getdate() as date)) 

  union 

  SELECT [RequestID]
      ,[AHT_per_Ticket_onsite].[username]
    ,[AHT_per_Ticket_onsite].schedule_date
    ,DATEDIFF(hour,[In_],[out_]) Utilization
    ,iif([Sch_time]>12,12,[Sch_time]) [Sch_time]
  FROM [Aya_Web_APP].[dbo].[AHT_per_Ticket_onsite]
  left join tbl_Sch on [AHT_per_Ticket_onsite].[username] = tbl_Sch.username and [AHT_per_Ticket_onsite].schedule_date = tbl_Sch.schedule_date
  where [AHT_per_Ticket_onsite].schedule_date >= dateadd(day,-30,cast(getdate() as date)) 

)

select RequestID,x.username,Manager_Name,schedule_date,Utilization ,Sch_time from x 
left join [Employess_DB].dbo.tbl_Personal_info a  on a.UserName = x.username
where Utilization >=4 and  x.username in ( select username from employee_web_table where manager = '$self')
order by 4 desc");
    while($echo = sqlsrv_fetch_array($new_query) ){
    $rows = '<tr>';
	$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['RequestID'].'</td>';
	$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['username'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Manager_Name'].'</td>';
	$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['schedule_date']->format('Y-m-d').'</td>';
	$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Utilization'].' h'.'</td>';
	$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Sch_time'].' h'.'</td>';	
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