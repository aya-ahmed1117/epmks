

   <title>Leaves Approval</title>
    <head>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>
 <?php
          include ("pages.php");

      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      if(isset($_POST['id'])){$id = $_POST['id'];}  

    if(isset($_GET['admin'])){$sch_id = $_GET['admin'];
    if(isset($_GET['engineer_id'])){
        $engineer_id = $_GET['engineer_id'];}

      $check_engineers  = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_id' ");
      $output_q = sqlsrv_fetch_array($check_engineers);
      $Unit_Name = $output_q['Unit_Name'];
      $engineers_id = $output_q['id'];
      $eng_username = $output_q['username'];
      $sch_id = $_GET['admin'];
      $status = "E-workforce and senior approve";
      $admin_approve = $_SESSION['username'];
      $sqltime = date ("Y-m-d H:i:s");
      $ysterday =date('Y-m-d',strtotime("-1 days"));
      $ysterday2 =date('Y-m-d',strtotime("-2 days"));
      $first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE id = '$sch_id' ");
      $output_query = sqlsrv_fetch_array($first_query);
      //$mydate = $output_query["adate"]->format('Y-m-d');
      $usernames =$output_query["username"];

//$ysterday
if($Unit_Name == 'Enterprise Service Desk'){

if($mydate = $ysterday){

      if(isset($_GET['engineer_id'])){
        $engineer_id = $_GET['engineer_id'];}

      $check_engineers  = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_id'");
      while ($output_engineers = sqlsrv_fetch_array($check_engineers)){
        $engineers_id = $output_engineers['id'];
        $eng_username = $output_engineers['username'];
      }
           $ystday_query = sqlsrv_query($con ,"IF EXISTS(SELECT [id]
                      ,[engineer_id],[date]
                    ,iif( [id] >1,'Exist','not exist') x
                  FROM [Aya_Web_APP].[dbo].[utilization_table]
                where username = '$eng_username' and [date] = '$mydate') 
                SELECT 1 [exist]
                ELSE
                SELECT 0  [exist]");
         $ysterday_query = sqlsrv_fetch_array($ystday_query);
         $exist = $ysterday_query['exist'];
         // if no recorde approve
      if($exist == 0 ){
      $wfm_approve = sqlsrv_query( $con ,"UPDATE leaves SET status='$status' ,
       admin_approve = '$admin_approve',[wfm_approval_time] = '$sqltime'  WHERE id = '$sch_id' ");

      if($wfm_approve){
echo '<script>
    swal({
    title: "Approved",
  icon: "success",
  })
     </script>';}
        }
      // if 1 reqorde approve and reruning
        else {
          if($exist == 1 ){
            $admin_approve=$_SESSION['username'];
           $wfm_approve = sqlsrv_query( $con ,"UPDATE leaves SET status = '$status' , 
              admin_approve = '$admin_approve' ,[wfm_approval_time] = '$sqltime'  WHERE id = '$sch_id' ");
        //Attendance
        $Attendance =sqlsrv_query( $con ,"exec Attendance
        @date ='$mydate' , @username = '$usernames' , @user ='$admin_approve', @time='$sqltime'  " );

        //Total_Utilization
        $Utilization_sd =sqlsrv_query( $con ,"exec [dbo].[Total_Utilization]
        @date = '$mydate' , @username = '$usernames' , @user ='$admin_approve', @time ='$sqltime'  " );

        //[dbo].[Task_Interval_Utilization] 
        $Task_Interval =sqlsrv_query( $con ,"exec [dbo].[Task_Interval_Utilization]
        @date = '$mydate' , @username = '$usernames' , @user ='$admin_approve' , @time ='$sqltime'  " );
  if($Utilization_sd){
 /* echo'<div class="popup" id="message">
  <div class="content" name="done" ><h2>Utilization SD  Done  <i class="fas fa-thumbs-up"></i> </h2></div></div>';}*/
  echo '<script>
    swal({
    title: "Utilization SD  Done  ",
  icon: "success",
  })
     </script>';}

  else{echo'error in Utilization SD';}
  if($Task_Interval){
 /* echo'<div class="popup" id="message1">
  <div class="content" name="done" ><h2>Task_Interval_Utilization Done  1<i class="fas fa-thumbs-up"></i> </h2></div></div>';}*/
  echo '<script>
    swal({
    title: "Task Interval Utilization Done ",
  icon: "success",
  })
     </script>';}
  else{echo'error in Task_Interval SD';}
         
      }
      }
    }}
      $ysterday2 =date('Y-m-d',strtotime("-2 days"));
      $first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE id = '$sch_id' ");
      $output_query = sqlsrv_fetch_array($first_query);
      $mydate = $output_query["adate"]->format('Y-m-d');
      $usernames =$output_query["username"];
    
if($Unit_Name == 'Enterprise Service Desk'){
    if($mydate <= $ysterday2){
   
  $wfm_approve = sqlsrv_query( $con ,"UPDATE leaves SET status = '$status' , admin_approve = '$admin_approve' ,
[wfm_approval_time] = '$sqltime'  WHERE id = '$sch_id' ");
  //Attendance
  $Attendance =sqlsrv_query( $con ,"exec Attendance
  @date ='$mydate' , @username = '$usernames' , @user ='$admin_approve', @time='$sqltime'  " );

  //Total_Utilization
  $Utilization_sd =sqlsrv_query( $con ,"exec [dbo].[Total_Utilization]
  @date = '$mydate' , @username = '$usernames' , @user ='$admin_approve', @time ='$sqltime'  " );
  //[Task_Interval_Utilization] 
  $Task_Interval =sqlsrv_query( $con ,"exec [dbo].[Task_Interval_Utilization]
  @date = '$mydate' , @username = '$usernames' , @user ='$admin_approve' , @time ='$sqltime'  " );

  

 if($Utilization_sd){
  echo'<div class="popup" id="message2">
<div class="content" name="done" ><h2>Utilization SD  Done  <i class="fas fa-thumbs-up"></i> $mydate < $ysterday 2</h2></div></div>';}
else{echo'error in Utilization SD';}
 if($Task_Interval){
  echo'<div class="popup" id="message3">
<div class="content" name="done" ><h2>Task_Interval_Utilization Done  <i class="fas fa-thumbs-up"></i> $mydate < $ysterday 3</h2></div></div>';}
else{echo'error in Task_Interval SD';}

}
}
else{
  if($Unit_Name !== 'Enterprise Service Desk'){
    $wfm_approve = sqlsrv_query( $con ,"UPDATE leaves SET status = '$status' , admin_approve = '$admin_approve' ,
[wfm_approval_time] = '$sqltime'  WHERE id = '$sch_id' ");
  }
}
}


/*else{
  $wfm_approve = sqlsrv_query( $con ,"UPDATE leaves SET status = '$status' , admin_approve = '$admin_approve' ,
[wfm_approval_time] = '$sqltime'  WHERE id = '$sch_id' ");}*/
  

//admin reject
if(isset($_GET['admin2'])){
$admin_reject = $_SESSION['username'];
$sch_id = $_GET['admin2'];
$status = "E-workforce reject";
$sqltime2 = date ("Y-m-d H:i:s");


$admin_reject = sqlsrv_query( $con ,"UPDATE leaves SET [status] = '$status' , [admin_reject] = '$admin_reject' , [wfm_rejected_time] = '$sqltime2' WHERE id = '$sch_id'");
if($admin_reject){
echo '<script>
    swal({
    title: "Rejected",
  icon: "info",
  })
     </script>';}
}


//onnnnnnn holddddddddddd
if(isset($_GET['hold'])){
$Onhold_user = $_SESSION['username'];
$sch_id = $_GET['hold'];
$status = "On hold";
$sqltime2 = date ("Y-m-d H:i:s");


$on_hold = sqlsrv_query( $con ,"UPDATE leaves SET [status] = '$status' , [Onhold_user] = '$Onhold_user' , [wfm_hold_time] = '$sqltime2' WHERE id = '$sch_id'");

if($on_hold){
echo '<script>
    swal({
    title: "Ticket is On Hold",
  icon: "success",
  })
     </script>';}
}
  ?>
</head>
<?php //if($_SESSION['role_id'] == 1){
  ?>
  


  <!--div >    
    <h3 style="background-color:white; color:black; text-align: center ; border-radius: 0px 20px;
 border: 5px solid ; margin: 0px auto;padding-top: 20%;
   width: 30%; padding-top:5px; padding-left: 9px; padding-bottom: 130px; ">
<form  method="post" >
  <input enable="false"class="nav-link disabled" tabindex="-1" type="text" name="engineer_id" style="display: none;" value="<?php echo $_SESSION["username"]; ?>"></input>
  <input type="text" name="R_id" style="display: none;" value="<?php //if(isset($_GET["id2"])){echo $_GET["id2"] ;}?>">Deduction id num :<?php echo $_GET["id2"] ; ?>
  <label for="type" style="display: none;">Select </label><br>
 
  <label style="width: 30%; padding-left: 15px;float: left;margin-left: 11%;" required="true">Notes
        <textarea name="wfm_note" style="display: block; float: left;"></textarea>
        <br><br>
        <br><br>
  <input type="submit" name="formSubmit" value="submit" style="float: left;width: 255px;"/></label>
</form>
</h3>
</div-->

<?php
   //}
/*if(isset($_POST['formSubmit'])){

 if(isset($_GET['id2'])){$sch_id = $_GET['id2'];

$first_query = sqlsrv_query( $con ,"SELECT * FROM leaves where id = '$sch_id' ");
  $output_query = sqlsrv_fetch_array($first_query);
 $note2 =$output_query["wfm_note"];
  //if(isset($_POST['wfm_note'])){$wfm_note = $_POST['wfm_note'];}
$escaped = $_POST['wfm_note'];
 $wfm_note = str_replace("'", "`", $escaped);

  $update_query = sqlsrv_query( $con ,"UPDATE leaves SET wfm_note = '$wfm_note' +' _ '+'$note2' WHERE id = '$sch_id'");

if($update_query){
  echo '<script>
    swal({
    title: " Your note has been delivered :) ",
  icon: "success",
  })
     </script>';}else{ echo 'error';}

}
}*/
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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Approve / Reject Leaves
      <a href="admin_approve.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">0000</p>
    </aside>
  </div>
</center>
<br>

<center>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
    <form  method="post" onload="chat_load()">
<div class="tableFixHead" >

<table class="table order-table"  cellspacing="0"   >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white;
  overflow-x: auto; ">
    <tr>
            <th class="text-center">ID</th>
            <th class="text-center">username</th>
            <th class="text-center">Type</th>
            <th class="text-center">Start Date</th>
            <th class="text-center">End Date</th>
            <th class="text-center">Start Time</th>
            <th class="text-center">End Time</th>
            <th class="text-center">Creation time</th>
            <th class="text-center">Comment</th>
            <th class="text-center">Count</th>
            <th class="text-center">status</th>
            <th class="text-center">Senior Approve</th>
            <!-- <th class="text-center">admin_approve</th> -->
            <th class="text-center">On Hold</th>
            <th class="text-center">Action</th>
            <th class="text-center">Nots</th>
            <th class="text-center">Nots</th>
          </tr>
        </thead>

<tbody>

<?php      
 $engineer_id = $_SESSION['id'];

if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];
}

$check_engineers  = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_id'   ");
while ($output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'] ;


//$first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE engineer_id ='$engineer_id'   ");

if($_SESSION['role_id'] == 1)
{
  $first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE engineer_id ='$engineer_id'  
    AND [status] in 
  ('senior approve','super approve','section approve','Unit Approve','On hold') and [status] <> 'E-workforce and senior approve' and id not in (64589,54420)  ");
}

  while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["id"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["username"].'</td>';
 if($output_query["type"] == "Sick Leave"  || $output_query["type"] == "Compassionate Leave"  || 
    $output_query["type"] == "Maternity Leave" || $output_query["type"] == "Paternity Leave"){
  $rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["type"].'
<a href='.$output_query["attach_image"].' download="true"><samp style="float:right;font-size:15px;"><i class="fa fa-paperclip" style="color:red;width:35px;"></samp></i></a>'.'</td>';
}
else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["type"].'</td>';
}
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["adate"]->format('Y-m-d').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["bdate"]->format('Y-m-d').'</td>';
if($output_query["type"] == 'Permission' && $output_query["starttime"] == $output_query["endtime"] ){
$rows .= '<td class="hovers" style="border: 1px solid lightgray;color:white;background-color:red;">'.$output_query["starttime"]->format('H:i:s').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;color:white;background-color:red;">'.$output_query["endtime"]->format('H:i:s').'</td>';
}
elseif($output_query["starttime"] !== $output_query["endtime"] ){

$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["starttime"]->format('H:i:s').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["endtime"]->format('H:i:s').'</td>';
}
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["creation_time"]->format("Y-m-d H:i:s").'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["notes"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["count"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["status"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["approved_by"].'</td>';
// $rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["admin_approve"].'</td>';
// Hold new 
$rows .= '<td>
<a type="button" class="btn btn-outline-primary"
href="?hold='.$output_query["id"].'&engineer_id='.$engineer_id.'">On hold</a>
</td>';
// approve

$rows .='<td ><a type="button" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);" class="btn btn btn-outline-success" href="?admin='.$output_query["id"].'&engineer_id='.$engineer_id.'"><samp><i class="fa fa-check"></i> Approve</samp></a>

   <a type="button" name="senior reject" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);" class="btn btn-danger" href="?admin2='.$output_query["id"].'&engineer_id='.$engineer_id.'">Rejected</a></td>';

/*$rows .= '<td  style="padding:5px;font-size: 10px;margin-left:6.5%;">
<a type="button" class="btn btn-primary"  href="?id2='.$output_query["id"].'&engineer_id='.$output_query['engineer_id'].'">Notes</a></td>';*/
$rows .= '<td><button class="btn btn-primary btn-md" type="button" id="notification"
data-type="'.$output_query["id"].'" data-id="'.$output_query["id"].'"
 data-toggle="modal" data-target="#mediumModal" aria-haspopup="true" aria-expanded="false">
 Note</button></td>';

$rows .='<td id="logBoard" style="background-color:white; color:black;font-size:12px;">'.$output_query["wfm_note"].'</td>';
    
$rows .=  '</tr>';
echo $rows;
}
}
?>

<?php //}
?>
    
</tbody>
</table>

<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <div class="modal-body">
       <input type="text" value="" class="form-control id"  disabled="true" />
      <label required="true">Notes</label>
        <textarea class="form-control wfm_note" ></textarea>
        <br>
            <div class="modal-footer">
                <button class="btn btn-primary submit">Submit</button>
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>
</div>


<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <script>
$(document).ready(function(){

  $('#mediumModal').on('show.bs.modal', function (event) {
      var elem = $(event.relatedTarget);
      var modal = $(this);
      var id = elem.data('id');
      //var sType = $('.sType').val();
      $('.id').val(id);
      $('.wfm_note').val("");     
      //$('.sType').val("");
      $('.submit').click(function(){
      var id = $('.id').val();
      var wfm_note = $('.wfm_note').val();
      //var sType = $('.sType').val();

       $.ajax({
        url: 'ajax_approve_leave.php',
        type: 'POST',
        data:'id='+id+'&wfm_note='+wfm_note,  
        cache: false,
        success: function(data){ 
          $('#logBoard').html(data);
          
          modal.find('.close').click();
        }, error: function(err){

              console.log(err);
            }
      });
    return false;
      });
     });

    });

  </script>

</div>
</form>
</center>
</div>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> 
  <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script src="js/table2excel.js"></script>

  <?php

 include ("footer.html");

 ?>