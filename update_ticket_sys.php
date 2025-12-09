

<?php
include ("pages.php");

?>
	<title>Ticketing System </title>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/my_table.css">

    </head>
<?php

if (isset($_GET['Request_ID'])) { $id = $_GET['Request_ID']; }
$id = $_GET['Request_ID'];

 $checks = sqlsrv_query( $con ,"SELECT *,
CASE
    WHEN sub_group ='1' THEN 'phone'
    WHEN sub_group ='2' THEN 'Resident'
    WHEN sub_group ='3' THEN 'Mail'
    WHEN sub_group ='4' THEN 'TAM'
    WHEN sub_group ='5' THEN 'Schools'
    WHEN sub_group ='6' THEN 'Mega Projects'
   else ''
        END sub_group2
         FROM [tbl_Ticketing_system] where Request_ID = '$id' ");
  $output_query = sqlsrv_fetch_array($checks);

?>
<?php 

 if (isset($_GET['Employee_app_Id'])) { $aya = $_GET['Employee_app_Id']; }
 if (isset($_GET['Request_ID'])) { $id = $_GET['Request_ID']; }
 ?>
 <style type="text/css">
   
.input-group{
 /* width: 70%;*/
  padding: 10px;

}
</style>
<center>
<div class="col-md-10">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Ticketing System History
              <a href="ticketingSys_history.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
  
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This page shows all swaps that takes place upon your requests</p>
  </aside>
</div>
</center>
<div style="padding: 20px;">
   <form method="post" class="form-control"style="background-color: #55608f; " >
<h2 style="color: white;"><img src="images/Tickets-icon.png"
  style="float: left;width:50px;"> Update your ticket (<?php echo $output_query['Request_Type'];  ?>)</h2>

                <?php 
if($output_query['Request_Type'] == 'Change schedule'){
    ?>


        <div >

<div style="padding-bottom: 18px;" >Ticket Subject<br/>
<input name="Ticket_Subject"  value="<?php echo $output_query["Ticket_Subject"];?>" />
</div>


<div style="padding-bottom: 18px; word-wrap: break-word;" >Update note<br/>
<textarea name="Note"  style="width :100%;border: 2px solid gray;padding:5%;padding-left:0;
  text-align: justify;color:black;" ></textarea>
</div>



<div style="padding-bottom: 18px; word-wrap: break-word;" disabled >Update note<br/>
<textarea name="Note" disabled readonly style="width :100%;border: 2px solid gray;padding:5%;padding-left:0;
  text-align: justify;color:black;"  
  value="<?php echo $output_query["Note"];?>"> <?php echo $output_query["Note"];?></textarea>
</div>


    <?php 
}
if($output_query['Request_Type'] == 'Delete recored'){
     ?>
     <div class="input-group sm-5" id="Ticket_Subject">
  <span class="input-group-text" id="basic-addon1"><i class="fa fa-user-secret"></i>Ticket Subject</span>
  <input value="<?php echo $output_query["Ticket_Subject"];?>"  class="form-control"
  name="Ticket_Subject" disabled
    aria-describedby="basic-addon1"/>
</div>

<div class="input-group sm-5" >
  <label class="input-group-text" for="textAreaExample">
  Update Notes</label>
  <textarea class="form-control" name="Note" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" rows="4" ></textarea>
</div>


<div class="input-group sm-2" >
  <label class="input-group-text" for="textAreaExample">Old Notes</label>
  <textarea class="form-control notes" name="Note" disabled readonly rows="1" value="<?php echo$output_query["Note"];?>">
    <?php echo $output_query["Note"];?></textarea>
</div>

<?php
}
if(($output_query['Request_Type'] == 'Employee Promotion') || ($output_query['Request_Type'] == 'Change Management')
  || ($output_query['Request_Type'] == 'Resign employees') || ($output_query['Request_Type'] == 'Change from OutSource to Staff') ){

 echo'
<div  class="input-group"  id="Employee_Username">
  <span class="input-group-text" id="basic-addon1">Username</span>
  <select class="form-control" 
  name="Employee_Username" >
  <option value="'.$output_query["Employee_Username"].'">'.$output_query["Employee_Username"].'</option>';
    $checks = sqlsrv_query( $con ,"SELECT * from  employee where role_id <> 1  ");
   //$swaper_names= $outputs['username'];
  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
    $rows .= $output['username'] == $outputs['Employee_Username'] ? "selected" : "";;
  $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
  
  echo $rows;
}
?> 
</select>
</div>



<?php }
if($output_query['Request_Type'] == 'Change Management'){
?>

<div  class="input-group"  id="Employee_new_manager">
  <span class="input-group-text" id="basic-addon1"><samp> <i class="fa fa-user-tie"></i> New Manager</samp></span>
  <select class="form-control sType" 
  name="Employee_new_manager" value="<?php echo $output_query["Employee_new_manager"];?>">
  <option value="<?php echo $output_query["Employee_new_manager"];?>"><?php echo $output_query["Employee_new_manager"];?></option>
  <?php 
    $checks = sqlsrv_query( $con ,"SELECT * from  employee where role_id = 2  ");
   //$swaper_names= $outputs['username'];
  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
    $rows .= $output['username'] == $outputs['Employee_new_manager'] ? "selected" : "";;
  $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
  
  echo $rows;
}

?>
</select>
</div>


   <div class="input-group sm-5" id="Last_working_date"> 
  <span class="input-group-text" id="basic-addon1">
    <samp><i class="fa fa-clock-o"></i> Last Working date</samp></span>
  <input type="date" class="form-control cur_date" name="Last_working_date" value="<?php echo 
$output_query["Last_working_date"]->format('Y-m-d');?>"
    aria-describedby="basic-addon1"/>
</div>

<!--div class="input-group sm-5" >
    <label class="input-group-text">Update Subject</label>
<input class="form-control" name="Ticket_Subject"  value="<?php  $output_query["Ticket_Subject"];?>" />
</div-->

<div class="input-group sm-5" >
  <label class="input-group-text" for="textAreaExample">
  Update Notes</label>
  <textarea class="form-control" name="Note" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" rows="4" ></textarea>
</div>


<div class="input-group sm-2" >
  <label class="input-group-text" for="textAreaExample">Old Notes</label>
  <textarea class="form-control notes" name="Note" disabled readonly rows="1" value="<?php echo$output_query["Note"];?>">
    <?php echo $output_query["Note"];?></textarea>
</div>

  <?php 
}
if($output_query['Request_Type'] == 'Resign employees'){
?>
 <div class="input-group sm-5" id="Last_working_date"> 
  <span class="input-group-text" id="basic-addon1">
    <samp><i class="fa fa-clock-o"></i> Last Working date</samp></span>
  <input type="date" class="form-control cur_date" name="Last_working_date" value="<?php echo 
$output_query["Last_working_date"]->format('Y-m-d');?>"
    aria-describedby="basic-addon1"/>
</div>

<div  class="input-group"  id="Reason_of_leave">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fa fa-sign-out" ></i> Reason of leave</samp></span>
  <select class="form-control sType" 
  name="Reason_of_leave" value="<?php echo $output_query["Reason_of_leave"];?>">
  <option value="<?php echo $output_query["Reason_of_leave"];?>" selected>Select..</option>

<option value="Relationship With the Boss">Relationship With the Boss</option>
<option value="Bored and Unchallenged by the Work Itself"> Bored and Unchallenged by the Work Itself</option>
<option value="Relationships With Coworkers">Relationships With Coworkers </option>
<option value="Opportunities to Use Their Skills and Abilities">Opportunities to Use Their Skills and Abilities </option>
<option value="Contribution of Their Work to the Organizations Business Goals">Contribution of Their Work to the Organization’s Business Goals </option>
<option value="Autonomy and Independence on the Job">Autonomy and Independence on the Job </option>
<option value="Meaningfulness of the Employees Job">Meaningfulness of the Employees Job </option>
<option value="Knowledge About Your Organizations Financial Stability">Knowledge About Your Organizations Financial Stability </option>
<option value="Overall Corporate Culture"> Overall Corporate Culture</option>
<option value="Managements Recognition of Employee Job Performance">Managements Recognition of Employee Job Performance </option>
</select>
</div>


<div class="input-group sm-5" >
  <label class="input-group-text" for="textAreaExample">
  Update Notes</label>
  <textarea class="form-control" name="Note" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" rows="4" ></textarea>
</div>


<div class="input-group sm-2" >
  <label class="input-group-text" for="textAreaExample">Old Notes</label>
  <textarea class="form-control notes" name="Note" disabled readonly rows="1" value="<?php echo$output_query["Note"];?>">
    <?php echo $output_query["Note"];?></textarea>
</div>


  <?php 
}
if($output_query['Request_Type'] == 'Change from OutSource to Staff'){
?>

<div class="input-group sm-5" id="Employee_new_username">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fa fa-user-secret"></i> New username</samp></span>
  <input type="text" class="form-control"
  name="Employee_new_username" value="<?php echo $output_query["Employee_new_username"];?>"
    aria-describedby="basic-addon1"/>
</div>


 <div class="input-group sm-5" id="Last_working_date"> 
  <span class="input-group-text" id="basic-addon1">
    <samp><i class="fa fa-clock-o"></i> Last Working date</samp></span>
  <input type="date" class="form-control cur_date" name="Last_working_date" value="<?php echo 
$output_query["Last_working_date"]->format('Y-m-d');?>"
    aria-describedby="basic-addon1"/>
</div>


<div class="input-group sm-5" id="Employee_new_id">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fa fa-id-card"></i> Employee new id</samp></span>
  <input type="number" class="form-control"
  value="<?php echo $output_query["Employee_new_id"];?>"
  name="Employee_new_id" placeholder="Enter Number"
    aria-describedby="basic-addon1"/>
</div>


<div class="input-group sm-5" >
  <label class="input-group-text" for="textAreaExample">
  Update Notes</label>
  <textarea class="form-control" name="Note" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" rows="4" ></textarea>
</div>


<div class="input-group sm-2" >
  <label class="input-group-text" for="textAreaExample">Old Notes</label>
  <textarea class="form-control notes" name="Note" disabled readonly rows="1" value="<?php echo$output_query["Note"];?>">
    <?php echo $output_query["Note"];?></textarea>
</div>

   <?php
}
   //if (isset($_GET['Request_ID'])) {  
if($output_query['Request_Type'] == 'Employee Promotion'){
?>

 <div class="input-group sm-5" id="Last_working_date"> 
  <span class="input-group-text" id="basic-addon1">
    <samp><i class="fa fa-clock-o"></i> Last Working date</samp></span>
  <input type="date" class="form-control cur_date" name="Last_working_date" value="<?php echo $output_query["Last_working_date"]->format('Y-m-d');?>"
    aria-describedby="basic-addon1"/>
</div>

<div  class="input-group" id="Employee_grade">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fa fa-sort-numeric-up"></i> Update Grade</samp></span>
  <select class="form-control sType" 
  name="Employee_grade">
  <option value="<?php echo $output_query["Employee_grade"];?>" selected><?php 
  echo $output_query["Employee_grade"];?></option>
  <option value="L9">L9 </option>
  <option value="L8">L8</option>
  <option value="L7">L7</option>
  <option value="L6">L6</option>
  <option value="L5">L5</option>
  <option value="L4">L4</option>
  <option value="L3">L3</option>
  <option value="L2">L2</option>
  <option value="L1">L1</option>
</select>
</div>


<div class="input-group sm-5" >
  <label class="input-group-text" for="textAreaExample">
  Update Notes</label>
  <textarea class="form-control" name="Note" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" rows="4" ></textarea>
</div>


<div class="input-group sm-2" >
  <label class="input-group-text" for="textAreaExample">Old Notes</label>
  <textarea class="form-control notes" name="Note" disabled readonly rows="1" value="<?php echo$output_query["Note"];?>">
    <?php echo $output_query["Note"];?></textarea>
</div>

<?php }
//sub_group
if($output_query['Request_Type'] == 'Change sub_group'){

?>
 <div class="input-group sm-5" id="Last_working_date"> 
  <span class="input-group-text" id="basic-addon1">
    <samp><i class="fa fa-clock-o"></i> Last Working date</samp></span>
  <input type="date" class="form-control cur_date" name="Last_working_date" 
  value="<?php echo 
$output_query["Last_working_date"]->format('Y-m-d');?>"
    aria-describedby="basic-addon1"/>
</div>
<div  class="input-group" id="sub_group">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fa fa-users"></i> Sub group</samp></span>

  <select class="form-control" 
  name="sub_group">
<option value="<?php echo $output_query["sub_group"];?>" selected><?php 
  echo $output_query["sub_group2"];?></option>
        <option value="1">Phone </option>
        <option value="2">Resident </option>
        <option value="3">Mail </option>
        <option value="4">TAM </option>
        <option value="5">Schools</option>
        <option value="6">Mega Projects</option>
      </select>
    </div>
    <div class="input-group sm-5" >
  <label class="input-group-text" for="textAreaExample">
  Update Notes</label>
  <textarea class="form-control" name="Note" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" rows="4" ></textarea>
</div>


    <div class="input-group sm-2" >
  <label class="input-group-text" for="textAreaExample">Old Notes</label>
  <textarea class="form-control notes" name="Note" disabled readonly rows="1" value="<?php echo$output_query["Note"];?>">
    <?php echo $output_query["Note"];?></textarea>
</div>
<?php
}
?>


<br>
<center>
<div>
<a  href="?done">
  <button type="submit" class="btn btn-warning submit"  name="formSubmit" style="width: 30%;padding: 10px;color: #fff;font-size: 15px; border-radius: 20px 20px 20px 20px;" >Update Ticket</button>
</a>
</div>
</center>

</div></div>
  <?php
if(isset($_POST['formSubmit'])){
  
if (isset($_GET['Request_ID'])) { $idRequest = $_GET['Request_ID']; }
if(isset($_POST['Request_Type'])){$Request_Type = $_POST['Request_Type'];}
$thistime = date('Y-m-d H:i:s');
$hisuser = $_SESSION['username'];
/*
$escaped = $_POST['Ticket_Subject'];
$Ticket_Subject = str_replace("'", "''", $escaped);*/

$escaped_str = $_POST['Note'];
 $Note = str_replace("'", "`", $escaped_str);
 $note2 =$output_query["Note"];

if(isset($_POST['Request_status'])){$Request_status = $_POST['Request_status'];}
if(isset($_POST['Employee_Username'])){$Employee_Username = $_POST['Employee_Username'];}
if(isset($_POST['Last_working_date'])){$Last_working_date = $_POST['Last_working_date'];}
if(isset($_POST['Employee_new_username'])){$Employee_new_username = $_POST['Employee_new_username'];}
if(isset($_POST['Employee_new_id'])){$Employee_new_id = $_POST['Employee_new_id'];}
if(isset($_POST['Employee_new_manager'])){$Employee_new_manager = $_POST['Employee_new_manager'];}
if(isset($_POST['Reason_of_leave'])){$Reason_of_leave = $_POST['Reason_of_leave'];}
if(isset($_POST['Employee_grade'])){$Employee_grade = $_POST['Employee_grade'];}
if(isset($_POST['sub_group'])){$sub_group = $_POST['sub_group'];}



if($output_query['Request_Type'] == 'Change schedule'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Request_status] = 'pending to admin',
  [Note] = '$Note'+' _ '+'$note2', Pending_to_workforce_time = '$thistime' 
  , [Pending_to_workforce_Username] = '$hisuser'
       WHERE Request_ID = '$idRequest' ");}

if($output_query['Request_Type'] == 'Delete recored'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Request_status] = 'pending to admin',
  [Note] = '$Note'+' _ '+'$note2',Pending_to_workforce_time = '$thistime' 
  , [Pending_to_workforce_Username] = '$hisuser'
     WHERE Request_ID = '$idRequest' ");}


if($output_query['Request_Type'] == 'Resign employees'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system 
  SET [Request_status] = 'pending to admin', 
    [WFM_Update_note] = '$WFM_Update_note', 
    [Reason_of_leave] = '$Reason_of_leave',[Note] = '$Note'+' _ '+'$note2', Pending_to_workforce_time = '$thistime' 
  , [Pending_to_workforce_Username] = '$hisuser'
       WHERE Request_ID = '$idRequest' ");}
     
 
if($output_query['Request_Type'] == 'Change from OutSource to Staff'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Request_status] = 'pending to admin',
  [Employee_Username] = '$Employee_Username', [Employee_new_id]='$Employee_new_id',[Last_working_date] = '$Last_working_date',
[Employee_new_username] = '$Employee_new_username' ,[Note] = '$Note'+' _ '+'$note2' , Pending_to_workforce_time = '$thistime' 
, [Pending_to_workforce_Username] = '$hisuser'
     WHERE Request_ID = '$idRequest' ");}

if($output_query['Request_Type'] == 'Employee Promotion'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Employee_Username] = '$Employee_Username', 
    [Last_working_date] = '$Last_working_date',[Request_status] = 'pending to admin',[Note] = '$Note',
    [Employee_grade] = '$Employee_grade', Pending_to_workforce_time = '$thistime' 
    , [Pending_to_workforce_Username] = '$hisuser'
       WHERE Request_ID = '$idRequest' "); }

if($output_query['Request_Type'] == 'Change Management'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET [Request_status] = 'pending to admin',
 [Employee_Username] = '$Employee_Username',[Last_working_date] = '$Last_working_date',
    [Employee_new_manager] = '$Employee_new_manager',[Note] = '$Note' +' _ '+'$note2' , Pending_to_workforce_time = '$thistime' , [Pending_to_workforce_Username] = '$hisuser'
     WHERE Request_ID = '$idRequest' ");}

//sub_group
if($output_query['Request_Type'] == 'Change sub_group'){
$update_query = sqlsrv_query( $con ,"UPDATE tbl_Ticketing_system SET 
      [Request_status] = 'pending to admin',
      [Last_working_date] = '$Last_working_date',
      [sub_group] = '$sub_group',
      [Note] = '$Note' +' _ '+'$note2' , 
      [Pending_to_workforce_time] = '$thistime' , 
      [Pending_to_workforce_Username] = '$hisuser'
     WHERE Request_ID = '$idRequest' ");}

///////////


     if($update_query){
echo '<script>
    swal({
    title: "Updated",
  icon: "success",
  })
     </script>';}
}
//}
?>



  
</form>
</div>
</div>

    <script src="fixed_s/js/mainss.js"></script>
    <?php

 include ("footer.html");

 ?>
