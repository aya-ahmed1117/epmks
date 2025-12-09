
  <?php
      set_time_limit(400);
include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      ?>
<head>
      <title>Repeated_NodeID_month</title>
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
 <div style="padding: 20px;">

           

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Check Schedule
      <a href="mwd_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <p>.......</p>
    </aside>
  </div>
</center>
<br>
<form method="post" >
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
<div class="input-group-btn col-md-6">
    <button class="btn btn-primary"type='submit' name='submit' value="Get data" >Submit</button></div>
 
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

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;
  border: 1px solid white; ">
    <tr>
  <th><center>ID</center></th>
  <th><center>UserName</center></th>
  <th><center>count_shift</center> </th>
  <th><center>count_off</center></th>
  <th><center>shift_rotation</center></th>
  <th><center>Last_working_day</center></th>
  <th><center>status</center></th>
  <th><center>senior</center></th>
  <th><center>super</center></th>
  <th><center>section</center></th>
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

if(isset($_POST['submit'])){
    if(isset($_POST['date'])){$mydate = $_POST['date'];
if(isset($_POST['date2'])){$mydate2 = $_POST['date2'];
$startD = strtotime($mydate);
$endD =strtotime($mydate2);


$startTimeStamp = strtotime($mydate);
$endTimeStamp = strtotime($mydate2);

$timeDiff = abs($endTimeStamp - $startTimeStamp);

$numberDays = $timeDiff/86400;  // 86400 seconds in one day

// and you might want to convert to integer
 echo $numberDays = intval($numberDays)+1 .' new';



$new_query = sqlsrv_query( $con1 ,"with [x] as (
SELECT [ID],[UserName] ,[Manager_Name],'Onsite' [status]
  FROM [Employess_DB].[dbo].[tbl_Personal_info]
 where grade='l8' and employee_status not in ('resigned','maternity') and note is null and Unit=14

union
  
  
  SELECT  [ID],[UserName],[Manager_Name],'Mega'
  FROM [Employess_DB].[dbo].[tbl_Personal_info]
 where grade='l8' and employee_status not in ('resigned','maternity') and note is null  and Unit=12 and [Group]=21
  
  union

  SELECT  [ID],[UserName],[Manager_Name],'Resident'
  FROM [Employess_DB].[dbo].[tbl_Personal_info]
  where grade='l8' and employee_status not in ('resigned','maternity') and note is null 
  and Unit=12 and sub_Group=2 and [Group]<>21
        union 

SELECT  [ID],[UserName],[Manager_Name],'Service Optimization'
  FROM [Employess_DB].[dbo].[tbl_Personal_info]
  where grade='l8' and employee_status not in ('resigned','maternity') and note is null 
  and Unit= 15 and Employee_Type='outsource' 

union 

SELECT [ID],[UserName],[Manager_Name],'loan'
     
  FROM [Employess_DB].[dbo].[tbl_Personal_info]
  where grade='l8'and note like '%loan%'  and employee_status not in ('resigned','maternity')),
  [off] as (
SELECT engineer_id
  ,username
  ,senior
  ,count(shift_start) [count_off]
  from Aya_Web_APP.dbo.schedule_table
  where shift_start='off' and schedule_date between '$mydate' and '$mydate2'
  group by engineer_id
  ,username
  ,senior),

[sch] as(  SELECT engineer_id
  ,username
  ,senior
  ,count(username) [count_shift]
  from Aya_Web_APP.dbo.schedule_table
  where  schedule_date between '$mydate' and '$mydate2'
  group by engineer_id
  ,username
  ,senior),
  [final_sch] as(
 SELECT sch.engineer_id
        ,sch.username
        ,count_shift
        ,count_off
         from [sch]
 left join [off] on sch.engineer_id=[off].engineer_id and [off].username=sch.username),

 [final] as (SELECT x.ID
,x.UserName
,x.Manager_Name
,x.[status]
,[count_shift]
,[count_off]

 from [x]

 left join [final_sch] on [x].UserName=final_sch.username and engineer_id=ID),

[resign] as( SELECT [User_Name]
 ,last_working_day
 from Resignation_Table
 where [Status]='Confirmed'),
 
 [info]  as (SELECT distinct
      x1. [ID]
     ,x1.[UserName]
     ,iif ( x2.[grade]='L7', x1.[Manager_Name],iif(x2.username is null,x1.[Manager_Name],iif (x2.[grade]='L8'  and x2.note is not null,x1.[Manager_Name],' '))) [senior]
     ,IIF (x2.[grade]='L6', x1.[Manager_Name],iif( x3.[grade]='L6', x2.[Manager_Name],' ')) [super]
     ,iif (x2.[grade]='L5', x1.[Manager_Name],IIF (x3.[grade]='L5',x2.[Manager_Name],iif (x4.[grade]='L5',x3.[manager_Name],' '))) [section]
     ,[Units]
     ,[Groups]
     ,[SubGroups]
     ,x1.Note
       ,x1.[grade]
  FROM [Employess_DB].[dbo].[tbl_Personal_info] x1 
  left join [Employess_DB].[dbo].[tbl_Personal_info] x2 on x1.[Manager_Name]=x2.[UserName]
  left join  [Employess_DB].[dbo].[tbl_Personal_info] x3 on x2.[Manager_Name]=x3.[UserName] 
 left join [Employess_DB].[dbo].[tbl_Personal_info] x4 on x3.[Manager_Name]=x4.[UserName] 
  left join Tbl_Units on x1.Unit=Units_ID
  left join Tbl_Groups on x1.[Group]=[Group_ID]
  left join Tbl_SubGroups on x1.sub_Group=SubGroup_ID

  where
  x1.[grade]='l8'

  and x1.[Employee_Status] in ('active','Maternity_On_Duty') ),

  [time] as (select engineer_id, username
,cast(schedule_date as datetime)+ cast(shift_start as datetime) [start]
,case when shift_start in('16:00:00','20:00:00') then cast(shift_end as datetime) +(cast( schedule_date as datetime)+1)
 when shift_start='12:00:00' and shift_end='0:00:00' then cast(shift_end as datetime) +(cast( schedule_date as datetime)+1)
else cast(shift_end as datetime)+cast(schedule_date as datetime)
end [end]
,schedule_date

from aya_web_app.dbo.schedule_table
where shift_start<>'off'), 

[rotation] as (

select distinct  username,  datediff(HOUR,[start],[end]) [shift_rotation]


from [time]
 where schedule_date between '$mydate' and '$mydate2')


 select final.ID
 ,final.UserName
  ,count_shift
 ,count_off
 ,[shift_rotation]
,Last_working_day
,[status]
 ,info.senior
 ,info.super
 ,info.section

 from final 
 left join resign on [user_name]=final.UserName
 left join info on  info.UserName=final.username 
 left join [rotation] on [rotation].username=final.username
 order by 3,4,5,7,1");
  
 	  while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['ID'].'</td>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['UserName'].'</td>';
  $count_off =$echo['count_shift'] ;
  //70911
  if($count_off != $numberDays){
    $rows .='<td class="hovers" style="border:1px solid lightgray; background-color:yellow;">'.$echo['count_shift'].' /=/ '.$numberDays.'</td>';

  }else{
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['count_shift'].'</td>';
}
// /////////////////////////////////////
//  $numberDays = intval($numberDays)+1;
//    $count_off =$echo['count_off'] ;
// if($count_off <> $numberDays){
// $rows .='<td class="hovers" style="border:1px solid #eee; background-color:blue;">'.$echo['count_off'].'</td>';
// }
// // if($echo['count_off'] >= $numberDays){
// // $rows .='<td class="hovers" style="border:1px solid #eee; background-color:yellow;">'.$echo['count_off'].'</td>';
// // }
if($echo['count_off'] == NULL){
$rows .='<td class="hovers" style="border:1px solid #eee; background-color:lightblue;"></td>';
  }else{
  $rows .='<td class="hovers" style="border:1px solid #eee;">'.$echo['count_off'].'</td>';}
  if($echo['shift_rotation'] == NULL){
$rows .='<td class="hovers" style="border:1px solid #eee; background-color:lightgreen;"></td>';
  }else{
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['shift_rotation'].'</td>';}
  if($echo['Last_working_day'] == NULL){
 $rows .='<td class="hovers"style="border:1px solid lightgray;">Active</td>';
  }else{
  $rows .='<td class="hovers"style="border:1px solid lightgray;">'.$echo['Last_working_day']->format('Y-m-d').'</td>';}
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['status'].'</td>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['senior'].'</td>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['super'].'</td>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['section'].'</td>';


		  	$rows .= '</tr>';
		  	echo $rows;

}
}
}}

?>

</tbody>
</table>
</div>
</div>
</center>
</form>
<script src="js/table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Repeated_NodeID_yesterday.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>


