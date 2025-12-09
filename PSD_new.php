 <?php
  include ("pages.php");
  set_time_limit(500); 
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $unit = $_SESSION['Unit_Name'];
?>
<head>
  <title>Tracking</title>
  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>


<?php 
// weekly
if(isset($_GET['PsdNew'])){
    
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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >PSD Traking Board
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
    <th ><center>PSD_live</center></th>
    <th ><center>PSD his 76</center></th>
    <th ><center>PSD his 77</center> </th>
    <th ><center>PSD Sum 76</center> </th>
    <th ><center>PSD Sum 77</center> </th>
    <th ><center>Diff in His between Servers</center> </th>
    <th ><center>Diff in Sum between Servers</center> </th>
    <th ><center>Diff His tkt</center> </th>
    <th ><center>Diff Sum tkt</center></th>
  </tr>
  </thead> <tbody>
  <?php
  if(isset($_POST['submit'])){
  if(isset($_POST['date'])){$mydate = $_POST['date'];

   $new_query = sqlsrv_query( $con ,"with PSC_history_check as (
SELECT count(distinct a.[RequestID]) [num of PSC tickets in History table 76]
  FROM [WorkforceDB_indexed].[dbo].[TicketHistory_PSD_indexed] a
  left join [WorkforceDB_indexed].dbo.PSD_Live_tickets b on a.RequestID = b.Requestid
  where Creation_date = '$mydate'),

PSC_history_check_76 as (
SELECT count(distinct a.[RequestID]) [num of PSC tickets in History table 77]
  FROM [172.29.29.77].[WorkforceDB].[dbo].[TicketHistory_psd] a
  left join [WorkforceDB_indexed].dbo.PSD_Live_tickets b on a.RequestID = b.Requestid
  where Creation_date = '$mydate'),

PSC_Summary_check as (
SELECT count(distinct a.[Request ID]) [num of PSC tickets in Summary table 76]
      
  FROM [WorkforceDB_indexed].[dbo].[TicketSummary_PSD] a
  left join [WorkforceDB_indexed].dbo.PSD_Live_tickets b on a.[Request ID] = b.Requestid
  where Creation_date = '$mydate'),

PSC_Summary_check_77 as (
SELECT count(distinct a.[Request ID]) [num of PSC tickets in Summary table 77]
      
  FROM [172.29.29.77].[WorkforceDB].[dbo].[TicketSummary_psd] a
  left join [WorkforceDB_indexed].dbo.PSD_Live_tickets b on a.[Request ID] = b.Requestid
  where Creation_date = '$mydate'),

PSC_live_check as (
  Select count(distinct b.[RequestID]) [num of PSC tickets Live]
  from [WorkforceDB_indexed].dbo.PSD_Live_tickets b 
  where Creation_date ='$mydate')

  select [num of PSC tickets Live] [PSC_live] ,
  [num of PSC tickets in History table 76] [PSC his 76],
  [num of PSC tickets in History table 77] [PSC his 77] , 
  [num of PSC tickets in Summary table 76] [PSC Sum 76],
  [num of PSC tickets in Summary table 77] [PSC Sum 77]
  ,([num of PSC tickets in History table 77]-[num of PSC tickets in History table 76]) [Diff in His between Servers] ,
  ([num of PSC tickets in Summary table 77] -[num of PSC tickets in Summary table 76]) [Diff in Sum between Servers]
  ,([num of PSC tickets Live] - [num of PSC tickets in History table 76]) [Diff His tkt]
  ,([num of PSC tickets Live] - [num of PSC tickets in Summary table 76]) [Diff Sum tkt]
  from PSC_live_check ,PSC_history_check,PSC_Summary_check,PSC_history_check_76,PSC_Summary_check_77");
 
      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$mydate.'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['PSC_live'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['PSC his 76'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['PSC his 77'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['PSC Sum 76'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['PSC Sum 77'].'</td>';

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
        $secon_query = sqlsrv_query( $con , "with missing_tickets_psd_history as (

      SELECT distinct RequestID [Tickets missing in history]
  from  [WorkforceDB_indexed].dbo.PSD_Live_tickets 
  where creation_date = '$mydate' and RequestID not in (
  SELECt distinct a.RequestID
  FROM [WorkforceDB_indexed].[dbo].[TicketHistory_PSD_indexed] a
  left join [WorkforceDB_indexed].dbo.PSD_Live_tickets b on a.RequestID = b.Requestid
  where cast(Creation_date as date) = '$mydate'
  ))

  SELECT [Tickets missing in history]
       from missing_tickets_psd_history 
       union all
       SELECT 0 AS Status
       WHERE NOT EXISTS (select [Tickets missing in history]
       from missing_tickets_psd_history)");
        while($echo1 = sqlsrv_fetch_array($secon_query)){
         $data1 = $echo1['Tickets missing in history'];
         
     $three_query = sqlsrv_query( $con , "with missing_tickets_psd_Summary as (

      SELECT distinct RequestID [Tickets missing in Summary]
  from  [WorkforceDB_indexed].[dbo].[PSD_Live_tickets]
  where creation_date = '$mydate' and RequestID not in (
  SELECt distinct a.[Request ID]
  FROM [WorkforceDB_indexed].[dbo].[TicketSummary_PSD] a
  left join [WorkforceDB_indexed].dbo.[PSD_Live_tickets] b on a.[Request ID] = b.Requestid
  where cast(Creation_date as date) = '$mydate'
  ))
  
  select [Tickets missing in summary]
       from missing_tickets_psd_Summary
       union all
       SELECT 0 AS Status
       WHERE NOT EXISTS (select [Tickets missing in summary]
       from missing_tickets_psd_Summary)
");

       while($echo2 = sqlsrv_fetch_array($three_query)){
       //$echo2 = sqlsrv_fetch_array($three_query);
      $data2 = $echo2['Tickets missing in summary'];

    
     $four_query = sqlsrv_query( $con ,"with x as (
  select distinct RequestID [tickets missing updates]
  from  [WorkforceDB_indexed].[dbo].[PSD_Live_tickets_updates]
  where creation_date ='$mydate' and RequestID not in (
  SELECt distinct RequestID
  FROM [WorkforceDB_indexed].[dbo].[TicketHistory_PSD_indexed]
  where cast([OPERATION TIME] as date) = '$mydate'
  ))
  select [tickets missing updates]
  from X
   union all
       SELECT 0 AS Status
       WHERE NOT EXISTS (select [tickets missing updates]
  from X)
");
     while($echo3 = sqlsrv_fetch_array($four_query)){
$data3 = $echo3['tickets missing updates'];
$data1 = $echo1['Tickets missing in history'];
$data2 = $echo2['Tickets missing in summary'];

    //while($echo3 = sqlsrv_fetch_array($four_query,$three_query,$secon_query)){
   //while($echo3 = sqlsrv_fetch_array($four_query)){
  $rows = '<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" align="center">'.$mydate.'</td>';
if($data1 == '0'){
   $rows .='<td class="hovers" style="border: 1px solid lightgray; align="center"">blank</td>';
}if($data1 >0){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;" align="center">'.$data1.'</td>';
}
if($echo2['Tickets missing in summary'] == '0' ){
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
   }}}
 ?>
    </tbody>
  </table>
</form>


<?php 
}}
// psc Missingsummary
    
?>

  
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