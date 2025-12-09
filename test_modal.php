 <?php  
 //$connect = mysqli_connect("localhost", "root", "", "testing");  
// $query = "SELECT * FROM tbl_employee ORDER BY id DESC";  
// $result = mysqli_query($connect, $query); 
          include ("pages.php");
?>
 
           <title>Approve deduction</title>  
<!--     <link rel="stylesheet" href="bootstrap.min.css" />  
 --> 
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>
<?php

      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      if(isset($_POST['id'])){$id = $_POST['id'];}  

    if(isset($_GET['engineer_id'])){
        $engineer_id = $_GET['engineer_id'];}
    
  set_time_limit(600);
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
//admin ok
if(isset($_GET['admin'])){
$sch_id = $_GET['admin'];
$status = "E-workforce and senior approve";
$stat_added = "removed";
$eworkforce_approve=$_SESSION['username'];

$sqltime = date ("Y-m-d H:i:s");
$eworkforce_approve = sqlsrv_query( $con ,"UPDATE deduction SET status = '$status' , eworkforce_approve = '$eworkforce_approve' , stat_added = '$stat_added' , [wfm_approval_time] = '$sqltime' WHERE id = '$sch_id'");

if($eworkforce_approve){
echo '<script>
    swal({
    title: "Approved",
  icon: "success",
  })
     </script>

<script type="text/javascript">
 setTimeout(function(){
           window.location="Approve_Deductions.php?engineer_id='.$engineer_id.'"
      }, 1900); 
</script>';}

}
//admin reject
if(isset($_GET['admin2'])){
$eworkforce_reject = $_SESSION['username'];
$sch_id = $_GET['admin2'];
$status = "E-workforce reject";
$sqltime = date ("Y-m-d H:i:s");
$eworkforce_reject = sqlsrv_query( $con ,"UPDATE deduction SET status = '$status' , eworkforce_reject = '$eworkforce_reject' , [wfm_rejected_time] = '$sqltime' WHERE id = '$sch_id'");

if($eworkforce_reject){
      echo '<script>
    swal({
    title: "Rejected",
  icon: "info",
  })
          </script>

<script type="text/javascript">
 setTimeout(function(){
           window.location="Approve_Deductions.php?engineer_id='.$engineer_id.'"
      }, 1900); 
</script>';}

}
//onnnnnnn holddddddddddd
if(isset($_GET['hold'])){
$Onhold_user = $_SESSION['username'];
$sch_id = $_GET['hold'];
$status = "On hold";
$sqltime2 = date ("Y-m-d H:i:s");


$on_hold = sqlsrv_query( $con ,"UPDATE deduction SET [status] = '$status' , [Onhold_user] = '$Onhold_user' , [wfm_hold_time] = '$sqltime2' WHERE id = '$sch_id'");

if($on_hold){
echo '<script>
    swal({
    title: "Ticket is On Hold",
  icon: "success",
  })
     </script>

<script type="text/javascript">
 setTimeout(function(){
           window.location="Approve_Deductions.php?engineer_id='.$engineer_id.'"
      }, 1900); 
</script>';}

}

//senior old
if(isset($_GET['senior'])){
$sch_id = $_GET['senior'];
$status = "senior approve";
$senior_approve=$_SESSION['username'];
$sqltime = date ("Y-m-d H:i:s");
$senior_approve = sqlsrv_query( $con ,"UPDATE deduction SET status = '$status' , senior_approve = '$senior_approve' , [senior_approval_time] = '$sqltime' WHERE id = '$sch_id'");
if($senior_approve){
echo '<script>
    swal({
    title: "Approved",
  icon: "success",
  })
     </script>';}
}
//senior reject
if(isset($_GET['senior2'])){
$senior_reject = $_SESSION['username'];
$sch_id = $_GET['senior2'];
$status = "senior reject";
$sqltime = date ("Y-m-d H:i:s");
$senior_reject = sqlsrv_query( $con ,"UPDATE deduction SET status = '$status' , senior_reject = '$senior_reject' , [senior_rejected_time] = '$sqltime'  WHERE id = '$sch_id'");
if($senior_reject){
      echo '<script>
    swal({
    title: "Rejected",
  icon: "info",
  })
     </script>';

     }
}

//Super2 approve
if(isset($_GET['Super'])){
$sch_id = $_GET['Super'];
$status = "super approve";
$senior_approve=$_SESSION['username'];
$sqltime = date ("Y-m-d H:i:s");
$super_approve = sqlsrv_query( $con ,"UPDATE deduction SET status = '$status' , senior_approve = '$senior_approve' , [senior_approval_time] = '$sqltime' WHERE id = '$sch_id'");
if($super_approve){
echo '<script>
    swal({
    title: "Done",
  icon: "success",
  })
     </script>';}
}
////Super2 reject
if(isset($_GET['Super2'])){
$senior_reject = $_SESSION['username'];
$sch_id = $_GET['Super2'];
$status = "super reject";
$sqltime = date ("Y-m-d H:i:s");
$super_reject = sqlsrv_query( $con ,"UPDATE deduction SET status = '$status' , senior_reject = '$senior_reject' , [senior_rejected_time] = '$sqltime'  WHERE id = '$sch_id'");
if($super_reject){
echo '<script>
    swal({
    title: "Rejected",
  icon: "info",
  })
     </script>';}
}
//section approve
if(isset($_GET['section'])){
$sch_id = $_GET['section'];
$status = "section approve";
$senior_approve = $_SESSION['username'];
$sqltime = date ("Y-m-d H:i:s");
$section_approve = sqlsrv_query( $con ,"UPDATE deduction SET status = '$status' , senior_approve = '$senior_approve' , [senior_approval_time] = '$sqltime' WHERE id = '$sch_id'");

if($section_approve){
echo '<script>
    swal({
    title: "Done",
  icon: "success",
  })
     </script>';}

}
//section reject
if(isset($_GET['section2'])){
$rejected_by = $_SESSION['username'];
$sch_id = $_GET['section2'];
$status = "section reject";
$sqltime = date ("Y-m-d H:i:s");
$section_reject = sqlsrv_query( $con ,"UPDATE deduction SET status = '$status' , senior_reject = '$rejected_by' , [senior_rejected_time] = '$sqltime'  WHERE id = '$sch_id'");
if($section_reject){
echo '<script>
    swal({
    title: "Rejected",
  icon: "info",
  })
     </script>';}
}

//UnitManager  approve
if(isset($_GET['UnitManager'])){
$sch_id = $_GET['UnitManager'];
$status = "Unit approve";
$senior_approve = $_SESSION['username'];
$sqltime = date ("Y-m-d H:i:s");
$Unit_approve = sqlsrv_query( $con ,"UPDATE deduction SET status = '$status' , senior_approve = '$senior_approve' , [senior_approval_time] = '$sqltime' WHERE id = '$sch_id'");
if($Unit_approve){
echo '<script>
    swal({
    title: "Done",
  icon: "success",
  })
     </script>';}

}
//UnitManager  reject
if(isset($_GET['UnitManager2'])){
$rejected_by = $_SESSION['username'];
$sch_id = $_GET['UnitManager2'];
$status = "Unit reject";
$sqltime = date ("Y-m-d H:i:s");
$Unit_reject = sqlsrv_query( $con ,"UPDATE deduction SET status = '$status' , senior_reject = '$rejected_by' , [senior_rejected_time] = '$sqltime'  WHERE id = '$sch_id'");
  if($Unit_reject){
   echo '<script>
    swal({
    title: "Rejected",
  icon: "info",
  })
     </script>';}
}
   
 ?>  


<style type="text/css">
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
  .zoom:hover{
    transform: scale(1.5);
  }
  .order-table tr:nth-child(even) {
    background-color: #f8f6ff;
}
/*
.modal-content {
 background-color: #fefefe;
  margin: 20px auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
  position: static;
  z-index: 10; 

}

   * Add Animation *
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}
.modal-header {
    display: flex;
    flex-shrink: 0;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1rem;
    border-bottom: 1px solid #dee2e6;
    border-top-left-radius: calc(0.3rem - 1px);
    border-top-right-radius: calc(0.3rem - 1px);
}
.modal-title {
    margin-bottom: 0;
    line-height: 1.5;
}
*/
.modal-title {
    margin: 0;
    line-height: 1.42857143;
}
.modal-content, #caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}
.modal-content {
    background-color: #fefefe;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #888;
    width: 30%;
    position: static;
    z-index: 10;
}

/*.modal-content {
    position: relative;
    background-color: #fff;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    border: 1px solid #999;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: 6px;
    outline: 0;
    -webkit-box-shadow: 0 3px 9px rgb(0 0 0 / 50%);
    box-shadow: 0 3px 9px rgb(0 0 0 / 50%);
}*/

label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: 700;
}

h1, h2, h3, h4, h5, h6 {
    font-family: "Nunito", sans-serif;
}
.h5, h5 {
    font-size: 1.25rem;
}


[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
    cursor: pointer;
}

textarea.form-control {
    min-height: calc(1.5em + 0.75rem + 2px);
}
.modal-footer {
    display: flex;
    flex-wrap: wrap;
    flex-shrink: 0;
    align-items: center;
    justify-content: flex-end;
    padding: 0.75rem;
    border-top: 1px solid #dee2e6;
    border-bottom-right-radius: calc(0.3rem - 1px);
    border-bottom-left-radius: calc(0.3rem - 1px);
}
button:not(:disabled) {
    cursor: pointer;
}


.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}
/*button.close {
    -webkit-appearance: none;
    padding: 0;
    cursor: pointer;
    background: 0 0 50px;
    border: 0;
}
*/
.close2 {
    float: right;
    font-size: 21px;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: .2;
}
/*.form-control[disabled], fieldset[disabled] .form-control {
    cursor: not-allowed;
}*/
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #eee;
    opacity: 1;
}
</style>
</head> 
      <body> 
      <?php

if ($_SESSION['role_id'] == 0){
  echo'
<style>
.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }
}
</style>

<div id="message" class="overlay">
  <div class="popup">
    <h2>Hi '.$s_username.'</h2>
<br/>
    <div class="content">
      Sorry You are not allowed to open me...
    </div>
  </div>
</div>';
}
else{
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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >hya de ela saf7a 
      <a href="admin_approve.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;"></p>
    </aside>
  </div>
</center>
</div>

<div style="padding:20px;">

  <form  method="post">
<br>

<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" 
    data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
    <center>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; ">
     <tr>
      <?php   if ($_SESSION['role_id'] > 1){
  ?>
      <th ><center>ID num</center></th>
      <th ><center>Engineer</center></th>
      <th ><center>Type</center></th>
      <th ><center>Item</center></th>
      <th ><center>Date</center></th>      
      <th ><center>Time</center></th>
      <th ><center>Creation time</center></th> 
      <th ><center>Comment</center></th>
      <th ><center>Status</center></th>
      <th ><center>Approve/Reject</center></th> 
<?php   }   if ($_SESSION['role_id'] == 1){
  ?>
      <th ><center>ID num</center></th>
      <th ><center>Engineer</center></th>
      <th ><center>Type</center></th>
      <th ><center>Item</center></th>
      <th ><center>Date</center></th>      
      <th ><center>Time</center></th>
      <th ><center>Creation time</center></th> 
      <th ><center>User Comment</center></th>
      <th ><center>reject by</center></th>
      <th ><center>Hold</center></th>
      <th ><center>Approve/Reject</center></th> 
      <th ><center>Notes</center></th>
      <th ><center>Comment</center></th>

<?php }
?>
          
     </tr>
 </thead>
  <tbody style="background-color:#fff;" align="center">
<?php      
if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];
}


$check_engineers  = $first_query = sqlsrv_query( $con ,"SELECT [username],[id] FROM employee WHERE id ='$engineer_id'");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];
}

$first_query = sqlsrv_query( $con ,"SELECT  [id]
      ,[username]
      ,[a_date]
      ,[item]
      ,[a_time]
      ,[status]
      ,[note]
      ,[type]
      ,[creation_time]
      ,[wfm_note]
  FROM [Aya_Web_APP].[dbo].[deduction] WHERE engineer_id ='$engineer_id'   ");


if($_SESSION['role_id'] == 2)
{

$first_query = sqlsrv_query( $con ,"SELECT  [id]
      ,[username]
      ,[a_date]
      ,[item]
      ,[a_time]
      ,[status]
      ,[note]
      ,[type]
      ,[creation_time]
      ,[wfm_note]
  FROM [Aya_Web_APP].[dbo].[deduction] WHERE engineer_id ='$engineer_id' and id <> 9954 AND status = 'pending'  ");
}
if($_SESSION['role_id'] == 1)
{


if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];}

 $first_query = sqlsrv_query( $con ,"SELECT  [id]
      ,[username]
      ,[a_date]
      ,[item]
      ,[a_time]
      ,[note]
      ,[type]
      ,status
      ,[creation_time]
      ,[wfm_note]
      ,senior_reject
  FROM [Aya_Web_APP].[dbo].[deduction] WHERE engineer_id ='$engineer_id' and id <> 9954  AND status in 
  ('SENIOR APPROVE','section approve','Unit Approve','super approve' ,'On hold')  ");
}
if($_SESSION['role_id'] == 3)
{
 $first_query = sqlsrv_query( $con ,"SELECT  [id]
      ,[username]
      ,[a_date]
      ,[item]
      ,[a_time]
      ,[status]
      ,[note]
      ,[type]
      ,[creation_time]
      ,[wfm_note]
  FROM [Aya_Web_APP].[dbo].[deduction] WHERE engineer_id ='$engineer_id' and id <> 9954 AND status = 'pending' ");
}


/////// new
if($_SESSION['role_id'] == 4)
{
  $first_query = sqlsrv_query( $con ,"SELECT  [id]
      ,[username]
      ,[a_date]
      ,[item]
      ,[a_time]
      ,[status]
      ,[note]
      ,[type]
      ,[creation_time]
      ,[wfm_note]
  FROM [Aya_Web_APP].[dbo].[deduction] WHERE engineer_id ='$engineer_id'  AND status = 'pending'  ");
}

if($_SESSION['role_id'] == 5)
{
  $first_query = sqlsrv_query( $con ,"SELECT  [id]
      ,[username]
      ,[a_date]
      ,[item]
      ,[a_time]
      ,[status]
      ,[note]
      ,[type]
      ,[creation_time]
      ,[wfm_note]
  FROM [Aya_Web_APP].[dbo].[deduction] WHERE engineer_id ='$engineer_id'  AND status = 'pending'  ");
}

//php -> output data from mysqli
  while( $output_query = sqlsrv_fetch_array($first_query)){
  
$rows ="<tr>";
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["id"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["username"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["type"].'</td>';
$rows .=  '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["item"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["a_date"]->format('Y-m-d').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["a_time"]->format('H:i:s').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["creation_time"]->format("Y-m-d H:i:s").'</td>';//date ("Y-m-d H:i:s")
$rows .= '<td width="5%" class="hovers" style="border: 1px solid lightgray;">'.$output_query["note"].'</td>';
if($_SESSION['role_id'] >1){
$rows .= '<td class="hovers" style="border: 1px solid lightgray;color:green;">'.$output_query["status"].'</td>';
}
if($_SESSION['role_id'] == 1){
$rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$output_query["senior_reject"].'</td>';}

$rows .= '<td><a type="button" class="btn btn-outline-primary"
href="?hold='.$output_query["id"].'&engineer_id='.$engineer_id.'">On hold</a>
</td>';

if($output_query['status'] == 1){

  if($_SESSION['role_id'] == 2){
  $rows .='<td >Senior Accepted</td>';

  }elseif ($_SESSION['role_id'] == 2) {
  $rows .='<td ><a href="?senior='.$output_query["id"].'&engineer_id='.$engineer_id.'">Senior Accepted</a>
                 </td>';}
}elseif($output_query['status'] == 4){
    if($_SESSION['role_id'] == 2){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">Senior Rejected</td>';

  }elseif ($_SESSION['role_id'] == 2) {
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">
    <a type="button" name="senior reject" class="btn btn-danger" href="?senior='.$output_query["id"].'&engineer_id='.$engineer_id.'">Rejected</a></td>';
  }
}elseif($output_query['status'] == 2){

  if($_SESSION['role_id'] == 1){
  }elseif ($_SESSION['role_id'] == 1) {
  $rows .='<td>
   </td>';
  }
}else{
  if($_SESSION['role_id'] == 1){
    if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];
}
$rows .= '<td  style="border: 1px solid lightgray;">
<a type="button" width="1%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="?admin='.$output_query["id"].'&engineer_id='.$engineer_id.'"><samp><i class="fa fa-check"></i> Approve</samp></a>

<a type="button" width="1%" name="admin reject" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);" class="btn btn-outline-danger" href="?admin2='.$output_query["id"].'&engineer_id='.$engineer_id.'">Rejected</a></td>';
/*
$rows .='<td style="border: 1px solid lightgray;padding:5px;font-size: 10px;margin-left:6.5%;">
<a type="button" class="btn btn-primary"  href="?id2='.$output_query["id"].'&engineer_id='.$engineer_id.'">Notes</a></td>';*/

// $rows .= '<td><button class="btn btn-danger btn-md view_data" type="button" id="notification"
//  data-type="'.$output_query["id"].'" data-id="'.$output_query["id"].'" id="'.$output_query["id"].'"
//  data-toggle="modal" data-target="#mediumModal" aria-haspopup="true" aria-expanded="false">
//  Note</button></td>';

 $rows .= '<td><input type="button" name="view" value="view" id="'.$output_query["id"].'" class="btn btn-info btn-xs view_data" /></td>';
 $rows .='<td width="10%"id="logBoard" style="border: 1px solid lightgray;">'.$output_query["wfm_note"].'</td>';

  }
if($_SESSION['role_id'] == 3){
  $rows .='<td width="5%" class="hovers" style="border: 1px solid lightgray;">
<a type="button" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"class="btn btn btn-outline-success" href="?Super='.$output_query["id"].'&engineer_id='.$engineer_id.'"><samp><i class="fa fa-check"></i> Approve</samp></a>

<a type="button" name="senior reject" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);" class="btn btn-outline-danger" href="?Super2='.$output_query["id"].'&engineer_id='.$engineer_id.'">Rejected</a></td>';


  }elseif ($_SESSION['role_id'] == 2) {
  $rows .='<td class="hovers" style="border: 1px solid lightgray;"><a type="button" class="btn btn btn-outline-success" href="?senior='.$output_query["id"].'&engineer_id='.$engineer_id.'"><samp><i class="fa fa-check"></i> Approve</samp></a>

<a name="senior reject" type="button"  class="btn btn-danger" href="?senior2='.$output_query["id"].'&engineer_id='.$engineer_id.'">Rejected</a></td>';}

   
   // section 
  if($_SESSION['role_id'] == 4){
  $rows .='<td width="5%">
<a type="button" class="btn btn-outline-success" href="?section='.$output_query["id"].'&engineer_id='.$engineer_id.'"><samp><i class="fa fa-check"></i> Approve</samp></a>

<a type="button" name="section reject" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);" class="btn btn-outline-danger button3" href="?section2='.$output_query["id"].'&engineer_id='.$engineer_id.'">Rejected</a></td>';}

// UnitManager 
  elseif($_SESSION['role_id'] == 5){
  $rows .='<td>
<a type="button" class="btn btn-outline-success" href="?UnitManager='.$output_query["id"].'&engineer_id='.$engineer_id.'"><samp><i class="fa fa-check"></i> Approve</samp></a>

<a type="button"name="UnitManager reject" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);" class="btn btn-outline-danger button3" href="?UnitManager2='.$output_query["id"].'&engineer_id='.$engineer_id.'">Rejected</a></td>';}

}

$rows .=  '</tr>';
echo $rows;
}

?>

</tbody>
</table> 
  <script src="table-filter.js"></script>

                    </div>
               </center>
 
<?php //if ($_SESSION['role_id'] == 1){
  //if(isset($_GET['id2']) ){  ?>
<div id="dataModal" tabindex="-1" role="dialog" >
    <div>
     <div class="modal" id="message21" >
      <div id="myOut" class="modal-content" >

        <h5 class="modal-title" >Deduction id num</h5>
         <div ><button class="close2" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
           </button></div>
         <input type="text" class="form-control id"  disabled="true" />
         <?php //echo  ?>
      
        <br>
      <label required="true">Notes</label>
        <textarea class="form-control wfm_note" ></textarea>
        <br>
          <div class="modal-footer">
          </label>
          <button class="btn btn-primary submit">Submit</button>
             <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
    <!--/div-->
    <script type="text/javascript">
      $(".close").click(function () {
    //close action
      document.getElementById("message21").style.display = "none";
          });
    </script>
          
 <script>  

     $(document).ready(function(){  
       var modal = $(this);
     $(document).on('click', '.view_data', function(){  
           var id = $(this).attr("id"); 
           var wfm_note = $('.wfm_note').val(); 
        var dataString = 'id='+id+'&wfm_note='+wfm_note;
          $('.id').val(id);
          $('.wfm_note').val("");

                    $.ajax({   
                    //url: 'ajax_note_deduction.php',
                    //type: 'POST',
                    data:dataString,
                    cache: false,  
                     success:function(data){   
                          $('#message21').modal('show');  
                     }  
                });  
     $('.submit').on('click',function(){
      var id = $('.id').val();
      var wfm_note = $('.wfm_note').val();
         if(wfm_note != ''){  
                $.ajax({   
                    url: 'ajax_note_deduction.php',
                    type: 'POST',
                    data:'id='+id+'&wfm_note='+wfm_note,
                    cache: false,  
                     success:function(data){ 
      $('#logBoard').html(data); 
                          //$('#employee_detail').html(data);
                          //$('#message21').html(data);
   $('#message21').modal(data);
                         // $('#message21').modal('show');  
                     }  
                });  
                  
      return false;
      }          
     }); 
 });

   });
  
 </script>

         </form>
     </div>
</body>
</html>


<?php }
?>