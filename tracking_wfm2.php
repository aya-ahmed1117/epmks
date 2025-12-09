 <?php
  include ("pages.php");
  set_time_limit(700); 
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $unit = $_SESSION['Unit_Name'];
?>
<head>
  <title>Tracking</title>
  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>
  <link rel="stylesheet"type="text/css"href="css/kpi_css.css">
</head>



<?php 
// weekly
if(isset($_GET['pscNew'])){
    
?>
<div style="padding:20px;">

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >PSC Traking Board
      <a href="tracking_wfm.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">
        <img src="images/aaa-removebg-preview.png" 
        class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
           <form method="post" >

<div class="row">
        <div class="col-md-4">
<div class="input-group col-2">
  <span class="input-group-text" id="basic-addon1">Start Date</span>
  <input type="date" class="form-control col-md-8" placeholder="From Date" aria-label="From Date" id="dates"
name='date' aria-describedby="basic-addon1"
value='<?php if(isset($_POST['date'])) echo $_POST['date']; ?>' required /><button class="btn btn-primary"type='submit' name='submit' value="Get data" >Submit</button></div>
</div>

<br>
</div>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead" style="height:100px;">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; ">
    <tr> 
    <th ><center>Date</center></th>
    <th ><center>PSC_live</center></th>
    <th ><center>PSC his 76</center></th>
    <th ><center>PSC his 77</center> </th>
    <th ><center>PSC Sum 76</center> </th>
    <th ><center>PSC Sum 77</center> </th>
    <th ><center>kpi tickets</center> </th>

    <th ><center>Diff in His between Servers</center> </th>
    <th ><center>Diff in Sum between Servers</center> </th>
    <th ><center>Diff His tkt</center> </th>
    <th ><center>Diff Sum tkt</center></th>
    <th ><center>Diff Kpi tkt</center></th>

  </tr>
  </thead> <tbody>
  <?php
    $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkforceDB_indexed";
  
  $connectionInfo = array( "Database"=>"WorkforceDB_indexed" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $connect = sqlsrv_connect($DBhost, $connectionInfo);

  if(isset($_POST['submit'])){
  if(isset($_POST['date'])){$mydate = $_POST['date'];

   $new_query = sqlsrv_query( $connect , "with His as (select distinct RequestID
from [WorkforceDB_indexed].[dbo].[TicketHistory_indexed]
where cast ([OPERATION TIME] as date)='$mydate'),

His_op as (
select his.requestid,min(cast([OPERATION TIME] as date))  T
from his left join [WorkforceDB_indexed].[dbo].[TicketHistory_indexed] i on his.requestid=i.requestid
group by his.requestid)

,PSC_history_check as (
select count(requestid) [num of PSC tickets in History table 76]
from His_op
where T='$mydate')

,His_77 as (select distinct [RequestID]
from  [172.29.29.77].[Workforce].[dbo].[TicketHistory]
where cast ([OPERATION TIME] as date)='$mydate')

,His_op_77 as (
select His_77.requestid
,min(cast([OPERATION TIME] as date))  T
from His_77 left join [172.29.29.77].[Workforce].[dbo].[TicketHistory] i 
on His_77.requestid=i.requestid
group by His_77.requestid)

,PSC_history_check_76 as (
SELECT count(requestid) [num of PSC tickets in History table 77]
  FROM His_op_77
where T='$mydate'),

PSC_Summary_check as (
SELECT count(distinct a.[RequestID]) [num of PSC tickets in Summary table 76]
  FROM [WorkforceDB_indexed].[dbo].[TicketSummary_PSC_indexed] a
  where cast(a.CreatedTime as date) = '$mydate' ),

PSC_Summary_check_77 as (
SELECT count(distinct a.[RequestID]) [num of PSC tickets in Summary table 77]
  FROM [172.29.29.77].[Workforce].[dbo].[TicketSummary] a
  where cast(a.CreatedTime as date) = '$mydate'),

PSC_live_check as (
  Select count(distinct b.[RequestID]) [num of PSC tickets Live]
  from [WorkforceDB_indexed].dbo.PSC_Live_tickets b 
  where Creation_date = '$mydate'),

Kpi_tickets_check as(
select count(distinct k.RequestID) [num of tickets from kpi]
from [KPI_Status_RawData] k

where cast(k.creation_time as date)  = '$mydate')
  
  select [num of PSC tickets Live] [PSC_live] ,
  [num of PSC tickets in History table 76] [PSC his 76],
  [num of PSC tickets in History table 77] [PSC his 77] , 
  [num of PSC tickets in Summary table 76] [PSC Sum 76],
  [num of PSC tickets in Summary table 77] [PSC Sum 77],
  [num of tickets from kpi] [kpi tickets]
  ,([num of PSC tickets in History table 77]-[num of PSC tickets in History table 76]) [Diff in His between Servers] ,
  ([num of PSC tickets in Summary table 77] -[num of PSC tickets in Summary table 76]) [Diff in Sum between Servers]
  ,([num of PSC tickets Live]-[num of tickets from kpi])[Diff Kpi tkt]
  ,([num of PSC tickets Live] - [num of PSC tickets in History table 76]) [Diff His tkt]
  ,([num of PSC tickets Live] - [num of PSC tickets in Summary table 76]) [Diff Sum tkt]
  from PSC_live_check ,PSC_history_check,PSC_Summary_check,PSC_history_check_76,PSC_Summary_check_77,Kpi_tickets_check
");
 
      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$mydate.'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['PSC_live'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['PSC his 76'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['PSC his 77'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['PSC Sum 76'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['PSC Sum 77'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['kpi tickets'].'</td>';
  

if($echo['Diff in His between Servers'] != 0){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:tomato;">'.$echo['Diff in His between Servers'].'</td>';}else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Diff in His between Servers'].'</td>';
  }
  if($echo['Diff in Sum between Servers'] != 0){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:tomato;">'.$echo['Diff in Sum between Servers'].'</td>';}
  else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Diff in Sum between Servers'].'</td>';
  }
  if($echo['Diff His tkt'] != 0){
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:tomato;">
'.$echo['Diff His tkt'].'</td>';
  }
  else{
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Diff His tkt'].'</td>';
    }
  if($echo['Diff Sum tkt'] != 0){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:tomato;">'.$echo['Diff Sum tkt'].'</td>';}
  else{
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Diff Sum tkt'].'</td>';
  }
//Diff Kpi tkt
  if($echo['Diff Kpi tkt'] != 0){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:tomato;">'.$echo['Diff Kpi tkt'].'</td>';}
  else{
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Diff Kpi tkt'].'</td>';
  }
  $rows .= '</tr>';
  echo $rows;

}
}
}
if(isset($_POST['submit'])){
?>
</tbody>
</table>
</div>
</div>

<div style="padding:20px;">
<div class="tableFixHead" style="height:550px;">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; ">
    <tr> 
    <th ><center>Date</center></th>
    <th ><center>Tickets missing in history</center> </th>
    <th ><center>Tickets missing in summary</center></th>
    <th ><center>tickets missing updates</center></th>
    
  </tr>
    </thead>
      <tbody>
        <?php 
          $secon_query = sqlsrv_query( $con , "with missing_tickets_psc_history as (

select distinct RequestID [Tickets missing in history]
  from  [WorkforceDB_indexed].dbo.PSC_Live_tickets 
  where creation_date ='$mydate' and RequestID not in (
  SELECt distinct a.RequestID
  FROM [WorkforceDB_indexed].[dbo].[TicketHistory_indexed] a))

  select * from missing_tickets_psc_history ");
        while($echo1 = sqlsrv_fetch_array($secon_query)){
         $data1 = $echo1['Tickets missing in history'];
         
     $three_query = sqlsrv_query( $con , "with missing_tickets_psc_Summary as (

      select distinct RequestID [Tickets missing in Summary]
  from  [WorkforceDB_indexed].dbo.PSC_Live_tickets 
  where creation_date = '$mydate' and RequestID not in (
  SELECt distinct a.RequestID
  FROM [WorkforceDB_indexed].[dbo].[TicketSummary_PSC_indexed] a
  where cast(a.CreatedTime as date) = '$mydate'))

  select * from 
   missing_tickets_psc_Summary
");

       while($echo2 = sqlsrv_fetch_array($three_query)){
       //$echo2 = sqlsrv_fetch_array($three_query);
      $data2 = $echo2['Tickets missing in Summary'];

    
     $four_query = sqlsrv_query( $con ,"with x as (
  select distinct RequestID [tickets missing updates]
  from  [WorkforceDB_indexed].dbo.PSC_Live_tickets_updates 
  where creation_date = '$mydate' and RequestID not in (
  SELECt distinct RequestID
  FROM [WorkforceDB_indexed].[dbo].[TicketHistory_indexed]
  where cast([OPERATION TIME] as date) = '$mydate'
  ))
  select [tickets missing updates]
  from X ");
     while($echo3 = sqlsrv_fetch_array($four_query)){
     //$echo3 = sqlsrv_fetch_array($four_query);
$data3 = $echo3['tickets missing updates'];
$data1 = $echo1['Tickets missing in history'];
$data2 = $echo2['Tickets missing in Summary'];
//}
    //while($echo3 = sqlsrv_fetch_array($four_query,$three_query,$secon_query)){
   //while($echo3 = sqlsrv_fetch_array($four_query)){
  $rows = '<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" align="center">'.$mydate.'</td>';
if($data1 == '0'){
   $rows .='<td class="hovers" style="border: 1px solid lightgray; align="center"">blank</td>';
}if($data1 >0){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" align="center">'.$data1.'</td>';
}
if($echo2['Tickets missing in Summary'] == '0' ){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" align="center">blank</td>';
}if($data2 >0){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" align="center">'.$data2.'</td>';
  } 
if($echo3['tickets missing updates'] == '0' ){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" align="center">blank</td>';
}if($data3 >0){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" align="center">'.$data3.'</td>';
}
  
  $rows .= '</tr>';

      echo  $rows;
   }}
  }
 ?>
    </tbody>
  </table>
</div>
</div>
</form>

<?php 
}}

    
?>

</div>


<?php 

if(isset($_GET['PSDMissing'])){
  ?>
  <div style="padding:20px;">

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >PSD Missing Summary
      <a href="tracking_wfm.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">
        <img src="images/aaa-removebg-preview.png" 
        class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>

<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
        <th ><center>Creation_date</center></th>
  </tr>
  </thead> <tbody>
<?php
  }?>
</tbody>
</table>
</div>
</div>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Tracking.xls"
            });
        }
    </script>


</div>
</div>
<script src="table-filter.js"></script>
<script src="js/table2excel.js" type="text/javascript"></script>
  <?php
 include ("footer.html");
 ?>