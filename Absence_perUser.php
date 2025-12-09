

<?php 
include ("pages.php");
$usernames="";
  if(isset($_POST['username'])){$usernames = $_POST['username'];}
     $self = $_SESSION['id'];?>
<title>Utilization & Absennce</title>

<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" href="css/ionicons.min.css">
<link rel="stylesheet" href="css/morris22.css">
<link rel="stylesheet" href="css/AdminLTE.min.css">
<link rel="stylesheet" href="css/_all-skins.min.css">
  </head>

  <?php //if(isset($_GET['Absence'])){?>
    <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Absence per user
    </h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">Select Start date and end date and user to get data</p></samp>
    </aside>
  </div>
</center>
<div style="padding: 20px;">

<form method="post" >
    <div class="row">
        <div class="col-md-4">
<div class="input-group col-2">
  <span class="input-group-text" id="basic-addon1">Start Date</span>
  <input type="date" class="form-control" placeholder="From Date" aria-label="From Date" id="dates"
name='date' aria-describedby="basic-addon1"
value='<?php if(isset($_POST['date'])) echo $_POST['date']; ?>' required />
</div>
</div>
<br>
    <div class="col-md-4">
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
</div>
<div class="row">
<div class="col col-md-7">
        <div class="input-group">
<div  class="input-group"  id="username">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fas fa-user-tie"></i>Username</samp></span>
  <select id="input2-group2"
class="form-control" name="username"value='<?php if($usernames != '') echo $usernames;?>' >
  <option action="none" value="0" selected>Select..</option>
<?php
    if ($_SESSION['role_id'] == 1){
  $checks = sqlsrv_query( $con ,"SELECT username from  employee 
  where role_id = 0 order by username ");
  while($outputs = sqlsrv_fetch_array($checks)){
    $usernames = $outputs['username'];
        $rows = '<option ';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
  echo $rows;
}}

/**************/
    $user =$_SESSION["username"];
    $self = $_SESSION['id'];
    //senior
if ($_SESSION['role_id'] == 2){
    $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE manager_id = '$self'");

    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
$engineers_id = $output_engineers['id'];
$checks = sqlsrv_query( $con ,"SELECT  distinct [username]
   
  FROM [Aya_Web_APP].[dbo].[utilization_table] 
  where engineer_id = '$engineers_id' order by 1 ");
  while($outputs = sqlsrv_fetch_array($checks)){
    $usernames = $outputs['username'];

        $rows = '<option ';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
   echo $rows;
    }
  }
}
//super
if ($_SESSION['role_id'] == 3){
  
// 
  $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE super_id = '$self'");

    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
$engineers_id = $output_engineers['id'];
$checks = sqlsrv_query( $con ,"SELECT  distinct [username]
   
  FROM [Aya_Web_APP].[dbo].[utilization_table] 
  where engineer_id = '$engineers_id' order by 1 ");
  while($outputs = sqlsrv_fetch_array($checks)){
    $usernames = $outputs['username'];

        $rows = '<option ';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
   echo $rows;
    }
  }
}
//section 
if ($_SESSION['role_id'] == 4){
  
// 
  $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE section_id = '$self'");

    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
$engineers_id = $output_engineers['id'];
$checks = sqlsrv_query( $con ,"SELECT  distinct [username]
   
  FROM [Aya_Web_APP].[dbo].[utilization_table] 
  where engineer_id = '$engineers_id' order by 1 ");
  while($outputs = sqlsrv_fetch_array($checks)){
    $usernames = $outputs['username'];

        $rows = '<option ';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
   echo $rows;
    }
  }
}

  ?>
</select>
       <div class="input-group-btn col-md-4"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >Submit</button></div>
        </div>
    </div>
</div>

<br>

</div>

<?php 

if(isset($_POST['date'])){
$mydate = $_POST['date'];}
if(isset($_POST['date2'])){
$mydate2 = $_POST['date2'];}
?>

       
<?php
  if(isset($_POST['submit'])){
  
?>
  <div class="row">
       <center>
           <div class="col-md-6">
          <div class="box box-warning" style="background-color: #092834;">

            <div class="box-header with-border">
              <h3 class="box-title" style="color:#eee;">Absence
              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div><!-- header -->

            <div class="box-body chart-responsive">
          <div class="chart" id="line-Absence"style="height: 300px;"></div>
        
        <div class="card-body">
    <div class="legend" style="color: white;">
    <i class="fa fa-circle text-primary" style="color:;"></i> Absence
    </div>
    </div>
</div><!-- responsive -->
    <hr>
          <div class="table table-striped table-hover" style="overflow:scroll;overflow-x: hidden; height:350px;">
 <table  class="order-table table"></div>
    <thead style="background-color: #092834;color: #B2D732;" >
  <th>Username</th>
  <th>Date</th>
  <th>Absence</th>
 
</thead>          
   
<tbody >
 <?php
 $this_year = date('Y');
   if(isset($_POST['username'])){$usernames = $_POST['username'];}
  //date 1  
if(isset($_POST['date'])){$mydate = $_POST['date'];
// date 2
if(isset($_POST['date2'])){$mydate2 = $_POST['date2'];
  $first_query = sqlsrv_query( $con ,"with tbl_Sch as

( SELECT

lower([Aya_Web_APP].[dbo].[schedule_table].[username]) [username],

[Aya_Web_APP].[dbo].[schedule_table].[schedule_date],

cast(IIF(([Aya_Web_APP].[dbo].[schedule_table].[shift_start] BETWEEN '12:00:00' AND '23:59:59'

AND (cast(cast([Aya_Web_APP].[dbo].[schedule_table].[shift_end] AS datetime)

- cast([Aya_Web_APP].[dbo].[schedule_table].[shift_start] AS datetime) AS time) = '12:00:00')

OR

([Aya_Web_APP].[dbo].[schedule_table].[shift_start] BETWEEN '16:00:00' AND '23:59:59'))

, (cast([schedule_table].[shift_end] AS datetime) + DATEADD(day, 1, cast([schedule_table].[schedule_date] AS datetime)))

, (cast([schedule_table].[shift_end] AS datetime)

   + cast([schedule_table].[schedule_date] AS datetime)))

   - (cast([schedule_table].[shift_start] AS datetime)

   + cast([schedule_table].[schedule_date] AS datetime)) AS float) [Sch_time]

FROM     [Aya_Web_APP].[dbo].[schedule_table]
left join [Employess_DB].[dbo].[tbl_Personal_info] on [schedule_table].username = [tbl_Personal_info].username

left join [Employess_DB].[dbo].[Tbl_Groups] on [Group_ID] = [group]
              

WHERE  [Aya_Web_APP].[dbo].[schedule_table].[shift_start] <> 'off' and year([schedule_table].schedule_date) = year(getdate()) and unit in(14, 12) ),

tbl_leave_deduc as (
SELECT 
--tbl_Sch.[Groups],
tbl_Sch.username,
tbl_Sch.[schedule_date],
sum(sch_time) [Leave_time]
FROM[Aya_Web_APP].[dbo].[leaves]
JOIN tbl_Sch ON (tbl_Sch.[username] = [leaves].[username]) AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]



WHERE  [leaves].[type] = 'Sick Leave' AND [leaves].[status] = 'E-workforce and senior approve'

GROUP BY 
tbl_Sch.[schedule_date],tbl_Sch.username



union

SELECT
tbl_Sch.username,
tbl_Sch.[schedule_date],
sum(sch_time) [Leave_time]
FROM[Aya_Web_APP].[dbo].[leaves]
JOIN tbl_Sch ON (tbl_Sch.[username] = [leaves].[username]) AND tbl_Sch.[schedule_date] BETWEEN [leaves].[adate] AND [leaves].[bdate]


WHERE  [leaves].[type] = 'Annual Leave'

AND [leaves].[status] = 'E-workforce and senior approve'

and ([leaves].[creation_time] > [adate] or [leaves].[creation_time] > [bdate])
and id not in ('165412','173897')


GROUP BY 
tbl_Sch.[schedule_date],tbl_Sch.username



union


SELECT 
tbl_Sch.username,

tbl_Sch.[schedule_date],


CAST(CONVERT(DATETIME,  CONVERT(varchar, DATEADD(ms, Sum(DATEDIFF(second, starttime, endtime)) * 1000, 0), 114)) AS FLOAT) [Leave_time]
FROM [Aya_Web_APP].[dbo].[leaves] JOIN tbl_Sch ON (tbl_Sch.[username] = [leaves].[username]) AND tbl_Sch.[schedule_date] BETWEEN [adate] AND [bdate]



WHERE  [type] = 'Permission'

AND [status] = 'E-workforce and senior approve'

AND adate = tbl_Sch.schedule_date

GROUP BY  
tbl_Sch.[schedule_date],tbl_Sch.username

union

SELECT

tbl_Sch.username,

tbl_Sch.[schedule_date],

sum(cast(cast ([deduction].[a_time] as datetime) as float)) [Leave_time]

FROM [Aya_Web_APP].[dbo].[deduction]

JOIN

tbl_Sch

ON (tbl_Sch.[username] = [deduction].[username])

AND tbl_Sch.[schedule_date] = [deduction].[a_date]

WHERE  tbl_Sch.[schedule_date] = [deduction].[a_date] AND [stat_added] = 'added'

AND [item] NOT LIKE ('forg%')

GROUP BY 

tbl_Sch.[schedule_date],tbl_Sch.username),

Final_absec as (

select 
tbl_Sch.username
,tbl_Sch.schedule_date
, Sch_time
,[leave_time]
from tbl_Sch left join tbl_leave_deduc
on tbl_leave_deduc.username = tbl_Sch.username
and tbl_leave_deduc.schedule_date = tbl_Sch.schedule_date)

,

Absenteeism as (

select
username
,schedule_date


, cast(round (iif((Leave_time / Sch_time)is  null ,0,(Leave_time / Sch_time)) * 100 , 0) as nvarchar )
     + '%' [Absence]

from

Final_absec

where 
  username = '$usernames'

  and
  [schedule_date] BETWEEN '$mydate' AND '$mydate2'   )

select *
from Absenteeism  
 ");
  while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .='<td width="50%" style="border: 1px solid #eee;color:#eee;">'.$output_query["username"].'</td>';
$rows .= '<td width="50%" style="border: 1px solid #eee;color:#eee;">'.$output_query["schedule_date"]->format('Y-m-d').'</td>';
if($output_query["Absence"]>= 5)
  {

$rows.='<td width="20%"style="border: 1px solid #6666;color:#eee; background-color:#C63927;">'.$output_query['Absence'].'</td>';
}
if($output_query["Absence"] <5 )
  {

$rows.='<td width="20%"style="border: 1px solid #6666;color:#eee; background-color:#009966;">'.$output_query['Absence'].'</td>';
}
$rows .='</tr>';
echo $rows;
}
}
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
if(isset($_POST['submit'])){
/// Absence
    $Absence = sqlsrv_query( $con ,"SELECT [username]
      ,[schedule_date]
      ,[Absence]
  FROM [Aya_Web_APP].[dbo].[Absence_per_day]
  where username = '$usernames' and[schedule_date] BETWEEN '$mydate' AND '$mydate2' order by 1,2  ");
   $Line_absence ='';
 while( $Absence_out = sqlsrv_fetch_array($Absence) ){
$Line_absence .="{ Absence:'".floor(($Absence_out['Absence'])*100)."',date202:'".$Absence_out['schedule_date']->format('Y-m-d')."'},";
}
$Line_absence = substr($Line_absence, 0);

?>
<script src="js/bootstrap22.min.js"></script>
<script src="js/raphael22.min.js"></script>
<script src="js/morris22.min.js"></script>
<script src="js/fastclick22.js"></script>
<script src="js/adminlte22.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/morris.js"></script>
<script src="js/Chart.min"></script>

<script type="text/javascript">
  //$Absence
    $(function () {
    "use strict";
var line = new Morris.Area({
      element: 'line-Absence',
      resize: true,
      data: [<?php echo $Line_absence;?>],
      xkey: 'date202',
      ykeys: ['Absence'],
      labels: ['Absence'],
      lineColors: ['#3c8dbc','#a0d0e0'],
      hideHover: 'auto'
    });

   });
  </script>
<?php 
}

?>
</form>
</div>
<?php 
include ("footer.html");
?>