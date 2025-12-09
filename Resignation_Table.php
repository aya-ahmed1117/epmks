
 <?php
include ("pages.php");
      $usernames="";
      if(isset($_POST['username'])){$usernames = $_POST['username'];}
      $ticket_group="";
      if(isset($_POST['ticket_group'])){$ticket_group = $_POST['ticket_group'];}
     $DBhost = "172.29.29.76";
    $DBuser = "Seniors";
    $DBpass = "123456789";
    $DBname = "Employess_DB";
    $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
    $con1 = sqlsrv_connect($DBhost, $connectionInfo);
      ?>
<title>Resignation Data</title>
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

     <style type="text/css">
   
.tableFixHead         
 { 
  overflow-y: auto; height:500px; overflow-x: auto; 
 }
.tableFixHead thead th 
{ 
  position: sticky; top: 0; 
}
   </style>


 <div style="padding: 20px;">

   <form method="post" >
  <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Resignation Data
      <a href="Daily_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       
        <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> 
       </a></p></samp>
    </aside>
  </div>
</center>
 <br>
<div class="row">
        <div class="col-lg-3">
<div class="input-group col-2">
  <span class="input-group-text" id="basic-addon1">Start Date</span>
  <input type="date" class="form-control" placeholder="From Date" aria-label="From Date" id="dates"
name='date' aria-describedby="basic-addon1"
value='<?php if(isset($_POST['date'])) echo $_POST['date']; ?>' required />
</div>
</div>
<br>
    <div class="col-lg-3">
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
<br>
<div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >Submit</button></div>
<br>

</div>
 <?php
if(isset($_POST['date'])){
$mydate = $_POST['date'];}
if(isset($_POST['date2'])){
$mydate2 = $_POST['date2'];}

 if(isset($_POST['submit'])){
  ?>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead >
    <tr>
      <th><center>Employee_ID</center> </th>
      <th><center>User_Name</center></th>
      <th><center>Employee_Type</center></th>
      <th><center>Grade</center></th>
      <th><center>Last_working_day</center></th>
      <th><center>Employee_Manager </center></th>
      <th><center>unit </center></th>   
    </tr>
    </thead>
  <tbody> 
<?php


//date 1  
if(isset($_POST['date'])){$mydate = $_POST['date'];
// date 2
if(isset($_POST['date2'])){$mydate2 = $_POST['date2'];

   $new_query = sqlsrv_query( $con1 , "SELECT  [Employee_ID]
      ,[User_Name]
      ,[Last_working_day]
      ,a.[Hiring_date]
      ,[Reason_of_leave]
      ,a.[Employee_Type]
      ,[Grade]
      ,[Employee_Manager]
      ,a.[Department]
      ,[units]
      ,[Created_User]
      ,[Date_time]
      ,[Status]
      ,a.[SSMA_TimeStamp]
  FROM [Employess_DB].[dbo].[Resignation_Table] a
  left join [dbo].[tbl_Personal_info] on [dbo].[tbl_Personal_info].UserName = a.[User_Name]
  left join [dbo].[Tbl_Units] on [dbo].[Tbl_Units].Units_ID =[dbo].[tbl_Personal_info].Unit

  where [Last_working_day] BETWEEN '$mydate' AND '$mydate2' and Status ='Confirmed'
  order by 3");
      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Employee_ID'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['User_Name'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Employee_Type'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Grade'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Last_working_day']->format('Y-m-d').'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Employee_Manager'].'</td>';

$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#6b5b95;color:white;">'.$echo['units'].'</td>';
        $rows .= '</tr>';
        echo $rows;
}}

?>


<?php 
}
?>

</tbody>
</table>
</div>
</div>
<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Resignation_Table.xls"
            });
        }
    </script>

<?php 
}
?>

  </form>

</div>
<script src="js/table2excel.js" type="text/javascript"></script>

<?php
 include ("footer.html");
 ?>



