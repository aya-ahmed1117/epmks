
<?php
include ("pages.php");
?>

	<title>Schedule</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="css/ionicons.min.css">
     <link rel="stylesheet" href="css/dialogbox.css">
</head>
<style>
table {
  border-collapse: collapse;
  overflow: hidden;
  box-shadow: 0 0 2px rgba(0,0,0,0.1);
  text-align: center;
  background-color: white;
}
tr:nth-child(even) {
  background-color: lightgray;
}

td {
  padding:15px;
  background-color: rgba(255,255,255,0.2);
  color: black;
  position: relative;
}

  th {
    padding:15px;
    background-color: #55608f;
    text-align: center;
  color: black;
  position: relative;

  }


tr:hover{
  color: #fff;
}

.hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
.hover {
      background: #333d6b;
      color: #fff;
      border-radius:20px 20px 20px 20px ;

        }
.tableFixHead {
      table-layout: fixed;
      border-collapse: collapse;
    }
      .tableFixHead tbody {
      display: block;
      overflow: auto;
      height: 250px;
      background-color: white;
    }
    .tableFixHead thead  {
      display: block;
    }
   
    .tableFixHead th, .tableFixHead td {
    width: 250px;
}
 </style>

<center>
  
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Tasks history</h2>
      
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This page shows all the tasks  duration that has been created from your side and approved</p>
  </aside>
</div>

<br>
	<h2 style="">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">
    </center>
    <br>

	<center>
  <div class="col-md-8">
  <div class="tableFixHead" >

 <table  style="border-radius: 30px 30px 0 0; background-color: white;">
  
    <thead >
      <th style="color:#fff; margin: auto; text-align:center"><center>ID</center></th>
      <th style="color:#fff; margin: auto; text-align:center"><center>Username</center></th>
			<th style="color:#fff; margin: auto; text-align:center"><center>Date</center></th>
			<th style="color:#fff; margin: auto; text-align:center"><center>Type</center></th>
			<th style="color:#fff; margin: auto; text-align:center"><center>Task`s Time</center></th>
      <th style="color:#fff; margin: auto; text-align:center"><center>Status</center></th>
        
</thead>
</table>
<table class="order-table">
<tbody>
<?php      
$s_username = $_SESSION['username'];
$first_query = sqlsrv_query( $con ,"SELECT distinct 
  [create_task].[UserName] [username]
  ,s_id ,[status]
 ,[cur_date][Date],[create_task].[type]
 ,cast(cast(sum(cast(cast([etime] as datetime)-cast([stime] as datetime) as float)) as datetime) as time) [task_time]
FROM  [Aya_Web_APP].[dbo].[create_task]
where [UserName] = '$s_username'
--and [status]='E-workforce and senior approve'
and [cur_date] >='2024-09-01'
group by [create_task].[UserName]
,[cur_date],[type],s_id,[status]
order by 2 DESC ");
  while( $output_query2 = sqlsrv_fetch_array($first_query)){
$rows  ='<tr >';
$rows .='<td class="hovers">'.$output_query2["s_id"].'</td>';
$rows .='<td class="hovers">'.$output_query2["username"].'</td>';
$rows .='<td class="hovers">'.$output_query2["Date"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers">'.$output_query2["type"].'</td>';
$rows .='<td class="hovers">'.$output_query2["task_time"]->format('H:i:s').'</td>';
$rows .='<td class="hovers">'.$output_query2["status"].'</td>';
$rows .='</tr>';

echo $rows;
}
?>

</tbody>
</table>
</div>
</div>
</div>
</center>
	

	<script src="table-filter.js"></script>

	<?php

 include ("footer.html");
 ?>

