

 <?php
      set_time_limit(400);
include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      ?>
<head>
      <title>Wrong NodeID</title>
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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Monthly wrong NodeID
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
      <th ><center>Year</center></th>
      <th ><center>Month</center></th>
      <th ><center>RequestID</center></th>
      <th ><center>Ticket_group</center> </th>
      <th ><center>nodeID</center> </th>
      <th ><center>last_engineer</th>
      <th ><center>Subgroup</center></th>
    </tr>
		</thead>	
  <tbody>

<?php
date_default_timezone_set('Africa/Cairo');
 $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkForce_Reporting_DB";
  
  $connectionInfo = array( "Database"=>"WorkForce_Reporting_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con76 = sqlsrv_connect($DBhost, $connectionInfo);
    

sqlsrv_query( $con76 , "SET NAMES 'utf8'"); 
sqlsrv_query( $con76 ,'SET CHARACTER SET utf8' );
if($role_id == 0){
  $new_query = sqlsrv_query( $con76 , "SELECT[Year]
      ,[Month]
      ,[RequestID]
      ,[Ticket_group]
      ,[NodeID]
      ,[Last_Assigned_Eng]
      ,Subgroup
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_Wrong_node_ID]
  where (([Year] >= year(dateadd(month,-1,getdate())) and [Month] >= month(dateadd(month,-1,getdate())) ) or ([Year]=year(getdate()) and [month]=month(getdate())))
   and Last_Assigned_Eng ='$s_username'order by [Year], [Month] ");
      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Month'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['RequestID'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['NodeID'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Last_Assigned_Eng'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Subgroup'].'</td>';

        $rows .= '</tr>';
        echo $rows;

}
}
 $self;
if(($role_id > 0) && ($_SESSION['username'] != 'Ahmed.AbdelFattah')){
  
  $new_query = sqlsrv_query( $con76 , "SELECT[Year]
      ,[Month]
      ,[RequestID]
      ,[Ticket_group]
      ,[NodeID]
      ,[Last_Assigned_Eng]
      ,Subgroup
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_Wrong_node_ID]
  where (([Year] >= year(dateadd(month,-1,getdate())) and [Month] >= month(dateadd(month,-1,getdate())) ) or ([Year]=year(getdate()) and [month]=month(getdate())))
  and  Last_Assigned_Eng in ( select username from [Aya_Web_APP].dbo.employee_web_table where manager = '$self') order by [Year], [Month] ");

      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Month'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['RequestID'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['NodeID'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Last_Assigned_Eng'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Subgroup'].'</td>';


        $rows .= '</tr>';
        echo $rows;

}
}
if($_SESSION['username'] == 'Ahmed.AbdelFattah'){
  $new_query = sqlsrv_query( $con76 , "SELECT[Year]
      ,[Month]
      ,[RequestID]
      ,[Ticket_group]
      ,[NodeID]
      ,[Last_Assigned_Eng]
      ,Subgroup
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_Wrong_node_ID]
  where (([Year] >= year(dateadd(month,-1,getdate())) and [Month] >= month(dateadd(month,-1,getdate())) ) or ([Year]=year(getdate()) and [month]=month(getdate())))
  and 
  Last_Assigned_Eng in ( select username from [Aya_Web_APP].dbo.employee_web_table ) order by [Year], [Month] ");
      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Month'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['RequestID'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['NodeID'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Last_Assigned_Eng'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Subgroup'].'</td>';

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
                filename: "wrong NodeID.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>


