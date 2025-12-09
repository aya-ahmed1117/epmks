
 

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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Repeated NodeID Per Month
      <a href="mwd_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
                  <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>

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
  <thead style="color: white;font-size: 15px;background-color:#55608f;border: 1px solid white; ">
    <tr>
  <th ><center>year</center></th>
  <th><center>month</th>
  <th><center>nodeID</center> </th>
  <th><center>Ticket_group</th>
  <th><center>subgroup</th>
  <th><center> API</center></th>
  <th><center> E-Mail</center></th>
  <th><center> Phone Call</center></th>
  <th><center>TWeb Form</center></th>
  <th><center>ESLM</center></th>
  <th><center>Internal Reference</center></th>
  <th><center>SMS</center></th>
	
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
    ($_SESSION['username'] == 'Yasmeen.soltan') ){

   $new_query = sqlsrv_query( $con , "WITH x1 as (
        SELECT Distinct requestID
             , cast([creation_time] as date) [creation_time]
              ,[nodeID]
             ,Request_Mode
             ,[Ticket_group]
             ,subgroup

          FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData])

        select * from (
        select
          year([creation_time]) Node_year
           ,month([creation_time]) Node_month

          ,nodeID
          ,Request_Mode
          ,count(nodeID) Num_Repated
          ,[Ticket_group]
          ,subgroup

          from x1
          where   DATEPART(m, [creation_time]) = DATEPART(m, DATEADD(m, -1, getdate()))AND DATEPART(yyyy, [creation_time]) = DATEPART(yyyy, DATEADD(m, -1, getdate()))
          and (ticket_group like 'private KAM%' or ticket_group like 'GDS%')

          group by
        month([creation_time])
        ,year([creation_time])
          ,nodeID
          ,Request_Mode
          ,[Ticket_group]
          ,subgroup)
          t
          pivot(
          
          max(Num_Repated)
          for Request_Mode in ([API],[E-Mail],[Phone Call],[Web Form],[ESLM],[Internal Reference],[SMS]))
          as pivot_table");

 		  while($echo = sqlsrv_fetch_array($new_query) ){

    $rows = '<tr>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Node_year'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Node_month'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['nodeID'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['subgroup'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['API'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['E-Mail'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Phone Call'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Web Form'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['ESLM'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Internal Reference'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['SMS'].'</td>';
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

    select * from (
    select
      year([creation_time]) Node_year
      ,month([creation_time]) Node_month
      ,nodeID
      ,Request_Mode
      ,count(nodeID) Num_Repated
      ,[Ticket_group]
      ,subgroup

      from x1
      where   DATEPART(m, [creation_time]) = DATEPART(m, DATEADD(m, -1, getdate()))AND DATEPART(yyyy, [creation_time]) = DATEPART(yyyy, DATEADD(m, -1, getdate()))
      and Ticket_group='$my_group' 
      group by
    month([creation_time])
      ,year([creation_time])
      ,nodeID
      ,Request_Mode
      ,[Ticket_group]
      ,subgroup)
      t
      pivot(
      
      max(Num_Repated)
      for Request_Mode in ([API],[E-Mail],[Phone Call],[Web Form],[ESLM],[Internal Reference],[SMS]))
      as pivot_table");
   while($echo = sqlsrv_fetch_array($new_query) ){

    $rows = '<tr>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Node_year'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Node_month'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['nodeID'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['subgroup'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['API'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['E-Mail'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Phone Call'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Web Form'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['ESLM'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Internal Reference'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['SMS'].'</td>';
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
                filename: "Repeated_NodeID_month.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>

  <?php include ("footer.html"); ?>
 