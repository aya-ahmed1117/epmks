
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
<div style="padding:20px;">

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Repeated NodeID Per Day
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
  <th><center>creation time</center></th>
  <th><center>nodeID</th>
  <th><center>Request Mode</center> </th>
  <th><center>Repeated node</th>
  <th><center>Ticket group</center></th>
  <th><center>subgroup</center></th>
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

   $new_query = sqlsrv_query( $con , "with x1 as (
        SELECT Distinct requestID
    , cast([creation_time] as date) [creation_time]
    ,[nodeID]
    ,Request_Mode
    ,[Ticket_group]
    ,subgroup
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData])

  select
  [creation_time]
  ,nodeID
  ,Request_Mode
  ,COUNT(nodeID) Repeated_node
  ,[Ticket_group]
  ,subgroup
  from x1
  where creation_time = cast(dateadd(day,-1,getdate()) as date)
  and (ticket_group like 'private KAM%' or ticket_group like 'GDS%')

  group by
  [creation_time]
  ,nodeID
  ,Request_Mode
  ,[Ticket_group]
  ,subgroup
  order by 1,4 desc ");
  
 	  while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['creation_time']->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['nodeID'].'</td>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['Request_Mode'].'</td>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['Repeated_node'].'</td>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['subgroup'].'</td>';
		  	$rows .= '</tr>';
		  	echo $rows;

}
}else{
    $new_query = sqlsrv_query( $con , "with x1 as (
SELECT Distinct requestID
     , cast([creation_time] as date) [creation_time]
      ,[nodeID]
         ,Request_Mode
         ,[Ticket_group]
              ,subgroup

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData])

  select
  [creation_time]
  ,nodeID
  ,Request_Mode
  ,COUNT(nodeID) Repeated_node
  ,[Ticket_group]
  ,subgroup
  from x1
  where creation_time = cast(dateadd(day,-1,getdate()) as date)
  and Ticket_group like '$my_group%'
  group by
  [creation_time]
  ,nodeID
  ,Request_Mode
  ,[Ticket_group]
  ,subgroup
  order by 1,4 desc ");

          while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['creation_time']->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['nodeID'].'</td>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['Request_Mode'].'</td>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['Repeated_node'].'</td>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
  $rows .='<td class="hovers" style="border:1px solid lightgray;">'.$echo['subgroup'].'</td>';
            $rows .= '</tr>';
            echo $rows;

}

}

?>
 </tbody>
</table>
</div>
</div>
</tbody>
</table>
</div>
</div>

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


