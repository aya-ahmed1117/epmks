
<?php
//session_start();
include ("pages.php");
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
    

sqlsrv_query( $con1 , "SET NAMES 'utf8'"); 
sqlsrv_query( $con1 ,'SET CHARACTER SET utf8' );

      $s_username = $_SESSION['username'];
      $usernames="";
      if(isset($_POST['username'])){$usernames = $_POST['username'];}
      $group_name="";
      if(isset($_POST['group_name'])){$group_name = $_POST['group_name'];}
      ?>
<title>Utilization/Task</title>
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


  <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Tasks & Utilizations
      </h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       
        <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> 
       </a></p></samp>
    </aside>
  </div>
</center>
<?php 
if(($_SESSION['username'] == 'mohamed.badawy') || ($_SESSION['username'] == 'ismail.zaher') ||($_SESSION['username'] == 'emad.gebaly') || ($_SESSION['username'] == 'ehab.gamil') || ($_SESSION['role_id'] >= 1) ){
            ?>

<h4 class="alert alert-warning alert-dismissiblefade show" style="font-size:24px; border-radius: 10px 10px 10px 0; "> &#9888;Choose between Date from and Date To then select  Usename ...</h4>
<div style="padding: 20px;">
<form method="post" >

  <div class="row">

        <div class="col-lg-3">
<div class="input-group col-2">
  <span class="input-group-text"id="basic-addon1">Start Date</span>
  <input type="date" class="form-control" placeholder="From Date" aria-label="From Date" id="adate"
name='Date' aria-describedby="basic-addon1"
value='<?php if(isset($_POST['Date'])) echo $_POST['Date']; ?>' required />
</div>
</div>
<br>
    <div class="col-lg-3">
<div class="input-group col-2">
  <span class="input-group-text" 
  id="basic-addon1">End date</span>
  <input type="date" class="form-control" placeholder="To Date" aria-label="To Date" name="Date2" id="bdate"
    aria-describedby="basic-addon1"required
value='<?php if(isset($_POST['Date2'])) echo $_POST['Date2']; ?>'/>

    </div>
  </div>
</div>

<br>
<div class="row">
<div class="col col-md-10">
    <div class="input-group">
      <div  class="input-group"  id="username">
        <span class="input-group-text" id="basic-addon1"><samp><i class="fas fa-user-tie"></i>Users</samp></span>
        <select id="input2-group2" class="form-control" name="username"placeholder="Select username..." 
        value='<?php if($usernames != '') echo $usernames;?>' >
        <option action="none" value="0" selected>Select..</option>
     <?php

if ($_SESSION['role_id'] == 2){
      $user =$_SESSION["username"];
  $self = $_SESSION['id'];

// 
  $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE manager_id = '$self'");

    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
$engineers_id = $output_engineers['id'];
$checks = sqlsrv_query( $con ,"SELECT  distinct [username]
   
  FROM [Aya_Web_APP].[dbo].[utilization_table] 
  where engineer_id = '$engineers_id' order by 1 ");
  while($outputs = sqlsrv_fetch_array($checks)){
    $usernames = $outputs['username'];

        $rows = '<option ';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
   echo $rows;
}}}
if ($_SESSION['role_id'] == 3){
      $user =$_SESSION["username"];
  $self = $_SESSION['id'];

// 
  $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE super_id = '$self'");

    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];


$checks = sqlsrv_query( $con ,"SELECT distinct [username]
   
  FROM [Aya_Web_APP].[dbo].[utilization_table] 
  where  engineer_id = '$engineers_id' order by 1 ");
  while($outputs = sqlsrv_fetch_array($checks)){
    $usernames = $outputs['username'];

        $rows = '<option ';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
   echo $rows;
}}}
if ($_SESSION['role_id'] == 4){
      $user =$_SESSION["username"];
  $self = $_SESSION['id'];

// 
  $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE [section_id] = '$self'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
$checks = sqlsrv_query( $con ,"SELECT distinct [username]
   
  FROM [Aya_Web_APP].[dbo].[utilization_table] 
  where  engineer_id = '$engineers_id' order by 1 ");
  while($outputs = sqlsrv_fetch_array($checks)){
    $usernames = $outputs['username'];
        $rows = '<option ';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
   echo $rows;
}}}
if ($_SESSION['role_id'] == 5){
  $user =$_SESSION["username"];
  $self = $_SESSION['id'];

// 
  $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE [UnitManager_id] = '$self'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
$checks = sqlsrv_query( $con ,"SELECT distinct [username] 
  FROM [Aya_Web_APP].[dbo].[utilization_table] 
  where  engineer_id = '$engineers_id' order by 1 ");
  while($outputs = sqlsrv_fetch_array($checks)){
    $usernames = $outputs['username'];
        $rows = '<option ';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
   echo $rows;
}}}
  ?>
</select>
<div class="input-group-btn col-md-6">
  <button class="btn btn-primary"type='submit' name='save' value="Get data by user" >Submit</button>
</div>

      </div>
    </div>
  </div>
</div>

<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead >
    <tr>
      <th ><center>year</center></th>
      <th ><center>Month</center></th>
      <th ><center>date</th>
      <th ><center>username</center> </th>
      <th ><center>manager </th>
      <th ><center>scheduled_duration </center></th>
      <th ><center>work_duration </center></th>
      <th ><center>utilization </center></th>
      <th><center>group_name</center> </th>
      <th ><center>task_duration </center></th>
      <th ><center>Tasks</th>
    </tr>
    </thead>
    <tbody>
   <?php
//date 1
if(isset($_POST['Date'])){
$mydate = $_POST['Date'];}
// date 2
if(isset($_POST['Date2'])){
$mydate2 = $_POST['Date2'];}?>
  <tbody>

<?php
if(isset($_POST['save'])){

if(isset($_POST['username'])){$usernames = $_POST['username'];
if(isset($_POST['Date'])){$mydate = $_POST['Date'];
// date 2
if(isset($_POST['Date2'])){$mydate2 = $_POST['Date2'];

   $new_query = sqlsrv_query( $con , "SELECT year([date])[year]
       ,month([date]) [Month]
      ,[date]
      ,[username]
      ,[manager]
      ,[scheduled_duration]
      ,[work_duration]
      ,[utilization]
      ,[group_name]
      ,[task_duration]
      ,[non_utilized] [Task]
  FROM [Aya_Web_APP].[dbo].[utilization_table] 
  where username = '$usernames'and [date] between '$mydate' AND '$mydate2'
  order by [date] desc");
      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['year'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Month'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['date']->format('Y/m/d').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['username'].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['manager'].'</td>';
 $rows .='<td style="border: 1px solid lightgray;background-color:#6b5b95;color:white; ">
 '.$echo['scheduled_duration']->format('H:i:s').'</td>';
 $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#6b5b95;color:white; ">
 '.$echo['work_duration']->format('H:i:s').'</td>';
  //
//     if($echo["utilization"] == NULL ){
//     $rows .='<td class="hovers" style="border: 1px solid lightgray; font-size:13px ;color:black;">
// Blank</td>';
//   }else{
  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#6b5b95;color:white; ">'.floor(($echo['utilization'])*100).'%'.'</td>';
//}
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['group_name'].'</td>';
  
  if($echo["task_duration"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;font-size:13px ;color:black;">
Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['task_duration']->format('H:i:s').'</td>';
}
  //
    if($echo["Task"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray; font-size:13px ;color:black;">
Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#6b5b95;color:white; ">'.floor(($echo['Task'])*100).'%'.'</td>';}    

        $rows .= '</tr>';
        echo $rows;

}
}}}}
?>

 </tbody>
</table>
</div>
</div>
<?php 
}
?>
</div>
</form>


<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "utilization_Tasks.xls"
            });
        }
    </script>
</div>
<script src="js/table2excel.js" type="text/javascript"></script>

<?php
 include ("footer.html");
 ?>


