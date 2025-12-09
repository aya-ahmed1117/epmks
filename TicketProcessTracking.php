

<?php 
include ("pages.php");
$usernames="";
  if(isset($_POST['username'])){$usernames = $_POST['username'];}
     $self = $_SESSION['id'];
?>
<title>Ticket Process Tracking</title>

  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">

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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Ticket Process Tracking Per User
          </h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">Here you can search for tickets that employee worked on it to see if you follow the process or not</p></samp>
    </aside>
  </div>
</center>
<div style="padding: 20px;">

<form method="post" >
    <div class="row">
        <div class="col-md-4">
<div class="input-group col-2">
  <span class="input-group-text" id="basic-addon1">Start Date</span>
  <input type="date" class="form-control" placeholder="From Date" aria-label="From Date" id="dates"name='Date' aria-describedby="basic-addon1"
value='<?php if(isset($_POST['Date'])) echo $_POST['Date']; ?>' required />
</div>
</div>
<br>
    <div class="col-md-4">
<div class="input-group col-2">
  <span class="input-group-text" 
  id="basic-addon1">End date</span>
  <input type="date" class="form-control" placeholder="To Date" aria-label="To Date" name="Date2" id="dates"    aria-describedby="basic-addon1"required
value='<?php if(isset($_POST['Date2'])) echo $_POST['Date2']; ?>'/>
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
  where role_id = 0  order by username");
  while($outputs = sqlsrv_fetch_array($checks)){
    //$usernames = $outputs['username'];
        $rows = '<option ';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
  echo $rows;
}}
if ($_SESSION['role_id'] >= 2){
  $self = $_SESSION['id'];

 

$checks = sqlsrv_query( $con ,"SELECT * from  employee
 where [USERNAME] in ( select username from [Aya_Web_APP].dbo.employee_web_table where manager = '$self') 
  order by 2");
  while($outputs = sqlsrv_fetch_array($checks)){
   // $usernames = $outputs['username'];
        $rows = '<option ';
  $rows .= $output['id'] == $outputs['id'] ? "selected" : "";;
  $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';

   echo $rows;
}}
/*
$rows = '<option ';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
        */
  ?>
</select>
       <div class="input-group-btn col-md-4"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >Submit</button></div>
        </div>
    </div>
</div>

<br>

</div>
  <?php
//date 1
if(isset($_POST['Date'])){$mydate = $_POST['Date'];}
// date 2
if(isset($_POST['Date2'])){$mydate2 = $_POST['Date2'];}

if(isset($_POST['submit'])){
?>


<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color:#55608f;border: 1px solid white; ">
    <tr>   
  <th><center>RequestID</center></th>
  <th><center>Date</center></th>
  <th><center>login Name</center></th>
  <th><center>Process_or_Not</center></th>
 		</tr>
		</thead>
  <tbody>

<?php 
//date 1
if(isset($_POST['Date'])){$mydate = $_POST['Date'];
//if(isset($_POST['login name'])){$usernames = $_POST['login name'];
// date 2
if(isset($_POST['Date2'])){$mydate2 = $_POST['Date2'];


$start = strtotime($mydate);
$end = strtotime($mydate2);

$days_between = ceil(abs($end - $start) / 86400);

if($days_between >7){

  echo "<h1 style='font-size:25px;border: 2px solid #5b9291;width:48%;
  border-radius: 4px 4px 5px 5px;'>&#x26A0;The time segment must be less than 7 days </h1>"; 
}
else{


   $distinct = sqlsrv_query($con,"SELECT distinct [TicketHistory_indexed].[RequestID],
Cast([TicketHistory_indexed].[OPERATION TIME] as date) [Date],

[login name], 

Iif(In_ is null,'No Process','Process') [Process_or_Not]
  
  FROM [WorkforceDB_indexed].[dbo].[TicketHistory_indexed]

  left join [Aya_Web_APP].[dbo].[AHT_per_Ticket] on

      [TicketHistory_indexed].RequestID = [AHT_per_Ticket].RequestID 

  and [TicketHistory_indexed].[login name] = [AHT_per_Ticket].username 

  and Cast([TicketHistory_indexed].[OPERATION TIME] as date) = cast([AHT_per_Ticket].In_ as date)

 where  cast([OPERATION TIME] as date) BETWEEN '$mydate' AND '$mydate2' and [login name] = '$usernames'

--  union

--  SELECT distinct [TicketHistory_PSD_indexed].[RequestID],
-- Cast([TicketHistory_PSD_indexed].[OPERATION TIME] as date) [Date],

-- [login name], 

-- Iif(In_ is null,'No Process','Process') [Process_or_Not]
  
--   FROM [WorkforceDB_indexed].[dbo].[TicketHistory_PSD_indexed]

--   left join [Aya_Web_APP].[dbo].[AHT_per_Ticket_onsite] on

--       [TicketHistory_PSD_indexed].RequestID = [AHT_per_Ticket_onsite].RequestID 

--   and [TicketHistory_PSD_indexed].[login name] = [AHT_per_Ticket_onsite].username 

--   and Cast([TicketHistory_PSD_indexed].[OPERATION TIME] as date) = cast([AHT_per_Ticket_onsite].In_ as date)

--  where  cast([OPERATION TIME] as date) BETWEEN '$mydate' AND '$mydate2' and [login name] = '$usernames' 
 order by [date] ");
 
   while ($output = sqlsrv_fetch_array($distinct) ){
$rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["RequestID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Date"]->format('Y-m-d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["login name"].'</td>';
  if($output["Process_or_Not"] == 'Process' ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#4CAF50; color:white;">'.$output["Process_or_Not"].'</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid lightgray;color:red;">'.$output["Process_or_Not"].'</td>';}
$rows .='</tr>';
echo $rows;
}
}
}
}
}
  ?>
</tbody>
</table>
</div>
</form>
</div>

<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>



