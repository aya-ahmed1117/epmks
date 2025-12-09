

<?php 
include ("pages.php");
?>
<title>Bank MASR</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.1/raphael-min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="js/justgage.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" href="css/ionicons.min.css">
<link rel="stylesheet" href="css/morris22.css">
<link rel="stylesheet" href="css/AdminLTE.min.css">
<link rel="stylesheet" href="css/_all-skins.min.css">
<link rel="stylesheet" type="text/css" href="css/kpi_css.css">
  </head>

 <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Bank Misr
      <a href="psc_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
     <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">Here you can Find Bank Masr Report per Day</p></samp>
    </aside>
  </div>
</center>
<center>
<br>
<div style="padding: 20px;">
  <form method="post" >

  <div class="row">
    <div class="col col-md-5">
       <div class="input-group">
         <div class="input-group" id="ticket_group">
  <span class="input-group-text" id="basic-addon1">Select Date</span>
  <input type="date" class="form-control" placeholder="From Date" aria-label="From Date" id="dates"
  name='date' aria-describedby="basic-addon1"
  value='<?php if(isset($_POST['date'])) echo $_POST['date']; ?>' required />

<br>
    <div class="input-group-btn"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >
    Submit</button></div>
        </div>
    </div>
</div>
</div>



<!--div class="col col-md-12">
        <div class="input-group">
<div  class="input-group"  id="ticket_group">
 <span class="input-group-text" id="basic-addon1">Start Date</span>
  <input type="date" class="form-control" placeholder="From Date" aria-label="From Date" id="dates"
  name='date' aria-describedby="basic-addon1"
  value='<?php if(isset($_POST['date'])) echo $_POST['date']; ?>' required />
<div class="input-group-btn col-md-4"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >
    Submit</button></div>
        </div>
    </div>
</div-->
 <?php
if(isset($_POST['date'])){
$mydate = $_POST['date'];}
if(isset($_POST['submit'])){
?>


  <div style="padding:20px;">
    <div class="card-header bg" style="width:65%; color: #eee;background-color: #00004d; padding:10px;">
           <h3 class="card-title" >Summary</h3>
              </div>
<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr> 
        <th style="color: white;">Num_days</th>
        <th style="color: white;">Unassigned </th>
        <th style="color: white;"> Banking</th>
  </tr>
  </thead>
  <tbody>
    <?php
   if(isset($_POST['submit'])){
//date 1  
if(isset($_POST['date'])){$mydate = $_POST['date'];
  $first_query = sqlsrv_query( $con ,"with Closed_tickets  as (select * from (

SELECT distinct requestid
    ,iif ( ticket_group is null,'Unassigned',ticket_group) ticket_group

    ,Iif(datediff(day,creation_time,getdate())=0,'less than 1 day',
  iif(datediff(day,creation_time,getdate()) between 1 and 2 ,'From 1 to 2 days',
    iif(datediff(day,creation_time,getdate()) between 2 and 3 , 'From 2 to 3 days' , 'More than 3 days'))) Num_days
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where  cast([creation_time] as date ) = '$mydate' 
  --and datediff(day,creation_time,getdate())<>0
   and ([nodeID] like '%BM%' and [nodeID] not like '%BMW%' and[nodeID] not like '%IBM%' ))
  t
  pivot (
  count (requestid)
  FOR ticket_group IN (
  [Unassigned],
  [Banking])
) AS pivot_table)
select * from Closed_tickets
order by case 
when Num_days = 'less than 1 day' then 1
when Num_days = 'From 1 to 2 days' then 2
when Num_days = 'From 2 to 3 days' then 3
else 4
end");
  
  while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Num_days"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Unassigned"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Banking"].'</td>';
$rows .= '</tr>';
echo $rows;
}}}
?>
</div>
</div>
</center>
</tbody>
</table>

<center>


  <div style="padding:20px;">
    <div class="card-header bg" style="width:65%; color: #eee;background-color: #00004d; padding:10px;">
           <h3 class="card-title" >Raw data</h3>
              </div>
    <div class="tableFixHead">
<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
  <th>Request_ID</th>
  <th>Subject </th>
  <th> Contact</th>
  <th>ticket_group </th>
  <th>ticket_status </th>
  <th>creation_time </th>
  <th>last_update </th>
  <th>Category </th>
  <th>Subcategory </th>
  <th >Item </th>
  <th > PSD_number</th>
  <th >Routecause_PSD </th>
  <th >OrderID </th>
  <th >completed date </th>
  <th >Duration </th>
  <th >Num_days </th>
  <th >closure_reason </th>
  </tr>
  </thead></div>
  <tbody >
    <?php   
    if(isset($_POST['submit'])){
//date 1  
if(isset($_POST['date'])){$mydate = $_POST['date'];
// date 2
//if(isset($_POST['date2'])){$mydate2 = $_POST['date2'];

  $first_query = sqlsrv_query( $con , "SELECT distinct [KPI_Status_RawData].requestid,[Subject],[Contact]
  ,iif ( ticket_group is null,'Unassigned',ticket_group) ticket_group
  ,ticket_status
  ,[creation_time]
  ,last_update
  ,[KPI_Status_RawData].Category
  ,[KPI_Status_RawData].[Subcategory]
  ,[KPI_Status_RawData].[Item]
  ,[PSD_number]
  ,[RoutecausePSD]
  ,[OrderID]
  ,[Final_close] [completed date]
  ,closure_reason
  ,iif([Final_close] is not null ,cast((creation_time-[Final_close]) as time),cast((getdate() - creation_time) as time)) Duration
       ,case
       when [Final_close] is not null then Iif(datediff(day,creation_time,[Final_close])=0,'less than 1 day',iif(datediff(day,creation_time,[Final_close]) between 1 and 2 ,'From 1 to 2 days',
    iif(datediff(day,creation_time,[Final_close]) between 2 and 3 , 'From 2 to 3 days' , 'More than 3 days')))
       when [Final_close] is null then Iif(datediff(day,creation_time,getdate())=0,'less than 1 day',iif(datediff(day,creation_time,getdate()) between 1 and 2 ,'From 1 to 2 days',
    iif(datediff(day,creation_time,getdate()) between 2 and 3 , 'From 2 to 3 days' , 'More than 3 days')))
       end Num_days

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  left join [WorkforceDB_indexed].[dbo].[TicketSummary_PSC_indexed] on [TicketSummary_PSC_indexed].requestid = [KPI_Status_RawData].requestid
  left join
  (
  SELECT RequestID
      ,max([OPERATION TIME]) last_update
  
  FROM [WorkforceDB_indexed].[dbo].[TicketHistory_indexed]
  where RequestID in (

SELECT distinct [KPI_Status_RawData].requestid
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  left join [WorkforceDB_indexed].[dbo].[TicketSummary_PSC_indexed] on [TicketSummary_PSC_indexed].requestid = [KPI_Status_RawData].requestid
  where  year([creation_time]) = year(getdate()) and  cast([creation_time] as date)>='2020-05-28' 
  and datediff(day,creation_time,getdate())<>0 and ([KPI_Status_RawData].[nodeID] like '%BM%' and [KPI_Status_RawData].[nodeID] not like '%BMW%' and [KPI_Status_RawData].[nodeID] not like '%IBM%' ))
  group by RequestID) t on t.RequestID = [KPI_Status_RawData].RequestID

  where  year([creation_time]) = year(getdate()) and  cast([creation_time] as date)= '$mydate' 
  and datediff(day,creation_time,getdate())<>0
 
  and ([KPI_Status_RawData].[nodeID] like '%BM%' and [KPI_Status_RawData].[nodeID] not like '%BMW%' and [KPI_Status_RawData].[nodeID] not like '%IBM%')  ");
    
  while( $output_query = sqlsrv_fetch_array($first_query)){
   
$rows  ='<tr>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["requestid"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;" >'.$output_query["Subject"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Contact"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["ticket_group"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["ticket_status"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["creation_time"]->format('Y/m/d H:i:s').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["last_update"]->format('Y/m/d H:i:s').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Category"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Subcategory"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Item"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["PSD_number"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["RoutecausePSD"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["OrderID"].'</td>';
if($output_query["completed date"] == NULL ){
    $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
Blank</td>';
  }else{
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["completed date"]->format('Y/m/d H:i:s').'</td>';}

$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Duration"]->format('H:i:s').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Num_days"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["closure_reason"].'</td>';
$rows .= '</tr>';

echo $rows;
}
} } 
?>
<script>
$(document).ready(function(){
  $("td:lang(ar)").css("background-color");
});
</script>
</tbody>
</table>
</div>

</center>
</div>
</div>

<br>
<br>
<br>
  <center>                
<div  style="width:65%;">
     <div class="box-body chart-responsive"style=" color: white;">
         <div class="chart" id="line-chart2"  ></div>
            <div class="card-body">
                <div class="legend" style="color: white; background-color: #00004d; padding:1.5%; border-radius: 5px 5px 5px 5px;">
                       
                          <i class="fa fa-circle text-primary"style="color:#9440ed;"></i> Unassigned
                          <i class="fa fa-circle text"style="color:#0b62a4;"></i> Banking
                      </div>
                      <hr>
                  </div>
              </div>

          </div>
</center>
<?php
if(isset($_POST['submit'])){
//date 1  
if(isset($_POST['date'])){$mydate = $_POST['date'];

  $first_query = sqlsrv_query( $con ,"with Closed_tickets  as (select * from (

SELECT distinct requestid
    ,iif ( ticket_group is null,'Unassigned',ticket_group) ticket_group

    ,Iif(datediff(day,creation_time,getdate())=0,'less than 1 day',
  iif(datediff(day,creation_time,getdate()) between 1 and 2 ,'From 1 to 2 days',
    iif(datediff(day,creation_time,getdate()) between 2 and 3 , 'From 2 to 3 days' , 'More than 3 days'))) Num_days
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where  cast([creation_time] as date ) = '$mydate' 
  --and datediff(day,creation_time,getdate())<>0
   and ([nodeID] like '%BM%' and [nodeID] not like '%BMW%' and[nodeID] not like '%IBM%' ))
  t
  pivot (
  count (requestid)
  FOR ticket_group IN (
  [Unassigned],
  [Banking])
) AS pivot_table)
select * from Closed_tickets
order by case 
when Num_days = 'less than 1 day' then 1
when Num_days = 'From 1 to 2 days' then 2
when Num_days = 'From 2 to 3 days' then 3
else 4
end");

  $chart_my_data ='';

 while( $output = sqlsrv_fetch_array($first_query) )
{
  $chart_my_data .="{ Num_days:'".$output['Num_days']."',Unassigned:".$output["Unassigned"].",Banking:".$output["Banking"]."},";
}
$chart_my_data = substr($chart_my_data, 0);
}}
}
?>

</table>
</tbody>
</div>

<script type="text/javascript">
     $(function () {
    "use strict";
      var line = new Morris.Bar({
      element: 'line-chart2',
      resize: true,
      data: [<?php echo $chart_my_data;?>],
      xkey: "Num_days",
      ykeys: ["Banking","Unassigned"],
      labels: ["Banking","Unassigned"],
      hideHover: 'auto'
    });
});
  </script>

</form>
</center></div>
<script src="js/jquery22.min.js"></script>
<script src="js/bootstrap22.min.js"></script>
<script src="js/raphael22.min.js"></script>
<script src="js/morris22.min.js"></script>
<script src="js/fastclick22.js"></script>
<script src="js/adminlte22.min.js"></script>
<script src="js/demo22.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
<script src="js/Chart.min"></script>
<?php 
include ("footer.html");

?>