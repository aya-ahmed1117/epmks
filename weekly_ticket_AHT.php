      <?php
      set_time_limit(400);
include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      ?>
<head>
      <title>weekly ticket AHT</title>
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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" > AHT Ticket per week
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
  <thead style="color:white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
        <th><center>Week</center></th>
        <th><center>RequestID</center></th>
        <th><center>AHT</th>
        <th><center>Ticket_group</center> </th>
        <th><center>subgroup</center> </th>
        <th><center>Category</th>
        <th><center>nodeID</center></th>
        <th><center>PSD_status</center> </th>  
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


  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);


if($_SESSION['username'] == 'ahmed.mohamedbassal') {
   $new_query = sqlsrv_query( $con , "With AHT1 as 
(select RequestID
, CAST(sum(CAST(([out_]-[In_])AS FLOAT)) AS DATETIME) AHT
FROM [Aya_Web_APP].[dbo].[AHT_per_Ticket]
group by RequestID),

AHT_Details as
(select datepart(week,([final_close])) [week]

,AHT1.RequestID
,right('0' + convert(varchar(9),((datediff(second,0,AHT1.AHT)) / 3600 )),3) + ':'

  + right('0' + convert(varchar(2),((datediff(second,0,AHT1.AHT)) / 60) % 60 ),2) + ':'

  + right('0' + convert(varchar(2),((datediff(second,0,AHT1.AHT))% 60 )),2) AHT
,Ticket_group
,subgroup
,Category
,nodeID
,iif(psd_number is null,'No PSD','PSD')  PSD_status
from AHT1  LEFT JOIN [WorkforceDB_indexed].[dbo].[KPI_Status_RawData] KPI ON AHT1.[RequestID]=KPI.RequestID
where Datepart(week,[Final_close])=DATEPART(week, DATEADD(week, -1, getdate()))AND DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
and [Fake_Real] = 'Real Ticket')


select *
from AHT_Details
where  (ticket_group like 'private KAM%' or ticket_group like 'GDS%')
 ");
  

 		  while($echo = sqlsrv_fetch_array($new_query) ){

     $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['week'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['RequestID'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['subgroup'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Category'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['nodeID'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['PSD_status'].'</td>';
    $rows .= '</tr>';
		  	echo $rows;

}
}else{
  $new_query = sqlsrv_query( $con , "With AHT1 as 
(select RequestID
, CAST(sum(CAST(([out_]-[In_])AS FLOAT)) AS DATETIME) AHT
FROM [Aya_Web_APP].[dbo].[AHT_per_Ticket]
group by RequestID),

AHT_Details as
(select datepart(week,([final_close])) [week]

,AHT1.RequestID
,right('0' + convert(varchar(9),((datediff(second,0,AHT1.AHT)) / 3600 )),3) + ':'

  + right('0' + convert(varchar(2),((datediff(second,0,AHT1.AHT)) / 60) % 60 ),2) + ':'

  + right('0' + convert(varchar(2),((datediff(second,0,AHT1.AHT))% 60 )),2) AHT
,Ticket_group
,subgroup
,Category
,nodeID
,iif(psd_number is null,'No PSD','PSD')  PSD_status
from AHT1  LEFT JOIN [WorkforceDB_indexed].[dbo].[KPI_Status_RawData] KPI ON AHT1.[RequestID]=KPI.RequestID
where Datepart(week,[Final_close])=DATEPART(week, DATEADD(week, -1, getdate()))AND DATEPART(yyyy, [Final_close]) = DATEPART(yyyy, DATEADD(week, -1, getdate()))
and [Fake_Real] = 'Real Ticket')

select *
from AHT_Details

where (('$my_group' = 'BS-CO' AND Ticket_group LIKE 'BS-CO%')
       OR ('$my_group' <> 'BS-CO' AND Ticket_group LIKE '$my_group%' AND Ticket_group NOT LIKE 'BS-CO%'))


 ");
   while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['week'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['RequestID'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['subgroup'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Category'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['nodeID'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['PSD_status'].'</td>';
    
        $rows .= '</tr>';
        echo $rows;

}
}

?>
 </tbody>
</table>
</div>
</div>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "weekly_ticket_AHT.xls"
            });
        }
    </script>

<script src="js/table2excel.js" type="text/javascript"></script>
<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>
 


