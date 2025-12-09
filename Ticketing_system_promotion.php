

<?php
include ("pages.php");
if($role_id >=1){
?>
  <title>Ticketing System </title>
  
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="css/my_table.css">
    </head>
 <center>
  
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Ticketing System</h2>
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Here you can Create a Ticket to the Workforce to ( Delete Record , Promote Employee , .......etc)</p>
  </aside>
</div>

<br>

<style>
  .grhdr {
  padding: 15px;
  height: 64px;background-color: #55608f;
  margin-top:0.1%;
  }
.button {
  font-size: 1em;
  padding: 10px;
  color: #fff;
  border: 2px solid #06D85F;
  border-radius: 20px/50px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  background: #06D85F;
}

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.input-group{
 /* width: 70%;*/
  padding: 10px;

}
#myDIV {
  -webkit-animation: mymove 5s infinite;
  animation: mymove 4s infinite;
}

@keyframes mymove {
  60% {text-shadow:10px 10px 20px yellow;}
  60% {color: red;}

}

</style>
<div style="padding: 20px;">

<form method="post" id="form" style="width:80%;border: 2px solid gray; 
    border-collapse: separate;background-color: #F9F9F9; 
    border-color: rgb(204, 204, 204);" >


<div class="grhdr">
  <img src="images/Tickets-icon.png"
  style="float: left;width:50px;">
 <h5 style="float: left;font-size:20px;color:white;font-style:initial;padding:5px;font-weight: bold;">Ticketing system</h5>
  <a href="ticketingSys_history.php" >
 <i class="fa fa-ticket-alt" style="float: right; size: 20px;font-size:30px;color: white;white-space: pre;"> </i>
<h5 id="myDIV" style="float: right;font-size:20px;color:white;font-style:initial;white-space: pre;font-weight: bolder;line-height:inherit;">  View old ticket .. </h5></a>  

</div>
 

  <div  class="input-group"  id="inputGroupSelect01div">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fa fa-choose"></i> Choose your type</samp></span>
  <select name="Request_Type" required class="form-control" id="Request_Type">
    <option value="0"  selected>Select..</option>
    <option value="Change Management">Change Management</option>
    <option value="Change from OutSource to Staff">Change from OutSource to Staff</option>
    <option value="Resign employees">Resign employees</option>
    <option value="Employee Promotion">Employee Promotion</option>
    <option value="Delete recored">Delete recored</option>
</select>
</div>

   <div class="input-group sm-5" id="Last_working_date"> 
  <span class="input-group-text" id="basic-addon1">
    <samp><i class="fa fa-stopwatch"></i> Last Working date</samp></span>
  <input type="date" class="form-control cur_date" name="Last_working_date" placeholder="Choose date"  id="adate"
    aria-describedby="basic-addon1"/>
</div>


<div  class="input-group" id="Employee_Username">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fa fa-users"></i> Username</samp></span>
  <select class="form-control" 
  name="Employee_Username">
  <option action="none" value="0" selected>Select....</option>
<?php
if($_SESSION['role_id'] == 2){
$checks = sqlsrv_query( $con ,"SELECT * from  employee where role_id != 1 and manager_id = '$aya'  ");
  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
    $rows .= $output['id'] == $outputs['id'] ? "selected" : "";;
  $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
  
  echo $rows;}}
?> 
<?php
if($_SESSION['role_id'] > 2){
$checks = sqlsrv_query( $con ,"SELECT * from  employee where role_id != 1 order by username  ");
  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
    $rows .= $output['id'] == $outputs['id'] ? "selected" : "";;
  $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
  echo $rows;}}
?> 
</select>
</div>

<div class="input-group sm-5" id="Employee_new_username">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fa fa-user-secret"></i> New username</samp></span>
  <input type="text" class="form-control"
  name="Employee_new_username" placeholder="Enter Number"
    aria-describedby="basic-addon1"/>
</div>


<div class="input-group sm-5" id="Employee_new_id">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fa fa-id-card"></i> Employee new id</samp></span>
  <input type="number" class="form-control"
  aria-label="To Date" 
  name="Employee_new_id" placeholder="Enter Number"
    aria-describedby="basic-addon1"/>
</div>


<div  class="input-group" id="Employee_grade">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fa fa-sort-numeric-up"></i> Choose Grade</samp></span>
  <select class="form-control sType" 
  name="Employee_grade">
  <option action="none" value="0" selected>Select....</option>
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

<div  class="input-group"  id="Employee_new_manager">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fa fa-user-tie"></i> New Manager</samp></span>
  <select class="form-control sType" 
  name="Employee_new_manager" >
  <option action="none" value="0" selected>Select..</option>
  <?php
$usernames = $_SESSION['username'];
$checks = sqlsrv_query( $con ,"SELECT * from  employee where role_id  not in (1,0,7) and username not in ('y_test','Z_test') ");
  while($outputs = sqlsrv_fetch_array($checks)){
  $rows = '<option ';
    $rows .= $output['id'] == $outputs['id'] ? "selected" : "";;
  $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
  
  echo $rows;}
?> 
</select>
</div>


<div  class="input-group"  id="Reason_of_leave">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fa fa-door-open"></i> Reason of leave</samp></span>
  <select class="form-control sType" 
  name="Reason_of_leave" >
  <option action="none" value="0" selected>Select..</option>
<option value="Relationship With the Boss">Relationship With the Boss</option>
<option value="Bored and Unchallenged by the Work Itself"> Bored and Unchallenged by the Work Itself</option>
<option value="Relationships With Coworkers">Relationships With Coworkers </option>
<option value="Opportunities to Use Their Skills and Abilities">Opportunities to Use Their Skills and Abilities </option>
<option value="Contribution of Their Work to the Organizations Business Goals">Contribution of Their Work to the Organization’s Business Goals </option>
<option value="Autonomy and Independence on the Job">Autonomy and Independence on the Job </option>
<option value="Meaningfulness of the Employees Job">Meaningfulness of the Employee's Job </option>
<option value="Knowledge About Your Organizations Financial Stability">Knowledge About Your Organization’s Financial Stability </option>
<option value="Overall Corporate Culture"> Overall Corporate Culture</option>
<option value="Managements Recognition of Employee Job Performance">Management's Recognition of Employee Job Performance </option>
</select>
</div>

<div class="input-group sm-5" id="Ticket_Subject">
  <span class="input-group-text" id="basic-addon1"><samp>  <i class="fa fa-user-secret"></i> Subject</samp></span>
  <input type="text" class="form-control"
  name="Ticket_Subject" placeholder="Enter Subject"
    aria-describedby="basic-addon1"/>
</div>

<div class="input-group sm-5" >
  <label class="input-group-text" for="textAreaExample">Notes</label>
  <textarea class="form-control notes" name="Note" id="textAreaExample"  placeholder="Write your Notes..." pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" rows="4"></textarea>
</div>
<br>
<center>
<div>
<a  href="?done">
  <button type="submit" class="btn btn-warning submit"  name="save" style="width: 30%;padding: 10px;color: #fff;font-size: 15px; border-radius: 20px 20px 20px 20px;" >Submit Ticket</button>
</a>
</div>
</center>
<br>

<?php

$Requester_username = $_SESSION['username'];
$engineer_id = $_SESSION['id'];
$Request_status = 'Open';
$Creation_time = date ("Y-m-d H:i:s");

if(isset($_POST['save'])){
  
if(isset($_POST['Request_Type'])){$Request_Type = $_POST['Request_Type'];}
if(isset($_POST['Ticket_Subject'])){$Ticket_Subject = $_POST['Ticket_Subject'];}

$escaped_str = $_POST['Note'];
 $Note = str_replace("'", "`", $escaped_str);

if(isset($_POST['Request_status'])){$Request_status = $_POST['Request_status'];}
if(isset($_POST['Employee_Username'])){$Employee_Username = $_POST['Employee_Username'];}
if(isset($_POST['Last_working_date'])){$Last_working_date = $_POST['Last_working_date'];}
if(isset($_POST['Employee_new_username'])){$Employee_new_username = $_POST['Employee_new_username'];}
if(isset($_POST['Employee_new_id'])){$Employee_new_id = $_POST['Employee_new_id'];}
if(isset($_POST['Employee_new_manager'])){$Employee_new_manager = $_POST['Employee_new_manager'];}
if(isset($_POST['Reason_of_leave'])){$Reason_of_leave = $_POST['Reason_of_leave'];}
if(isset($_POST['Employee_grade'])){$Employee_grade = $_POST['Employee_grade'];}


if($Request_Type == '0'){
  echo '<script>
  alert("Type Is Impty Choose Type Please")
  </script>';
  echo '<script>
    swal({
    title: "Type Is Impty Choose Type Please",
  icon: "info",
  })
     </script>';

}
if($Request_Type == 'Employee Promotion'){
// declare @us as nvarchar(max),
// @grade as nvarchar(max)
// set @us='x_test'
// set @grade='L7'
  if(isset($_POST['Employee_grade'])){$Employee_grade = $_POST['Employee_grade'];}
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);


$Request_Type='Employee Promotion';
$Requester_username = $_SESSION['username'];
$engineer_id = $_SESSION['id'];
$Request_status = 'Open';
$Creation_time = date ("Y-m-d H:i:s");
  $promotion = sqlsrv_query($con1 ,"SELECT case 
     when grade='L8' and grade='L7' then 'ok' 
     when Grade='L7' and '$Employee_grade'='L6' then 'ok'
     when Grade='L6' and '$Employee_grade'='L5' then 'ok'
     when Grade='L5' and '$Employee_grade'='L4' then 'ok'
     when Grade='L4' and '$Employee_grade'='L3' then 'ok'
     else 'no'
     end [grade_approval]
from [Employess_DB].[dbo].[tbl_Personal_info]
where UserName='$Employee_Username'"); 
  //while( $outputs = sqlsrv_fetch_array($promotion)){
    $outputs = sqlsrv_fetch_array($promotion);
       $first= $outputs['grade_approval'];
       if($first == 'no'){
       echo '<script>
    swal({
    title: "Wrong Selected Level",
    icon: "warning",
  })
     </script>';
    
}
        if($first == 'ok'){
    $result=sqlsrv_query($con,"SELECT employee_username,Employee_grade
    from tbl_Ticketing_system
    where Request_Type='Employee Promotion' and 
    Employee_Username='$Employee_Username' and Employee_grade='$Employee_grade'", array(), array( "Scrollable" => 'static' ));
    //$result=sqlsrv_query($con,$sql, array(), array( "Scrollable" => 'static' ));
    $count=sqlsrv_num_rows($result);
    if($count >= 1){

         echo '<script>
    swal({
    title: "Duplicated Record!",
    icon: "warning",
  })
     </script>';
    }
    else{
      //  echo "Database does not exist!"
         echo '<script>
    swal({
    title: "Done",
  icon: "success",
  })
     </script>';;
    $insert_promot =sqlsrv_query($con,"INSERT INTO [Aya_Web_APP].[dbo].[tbl_Ticketing_system] 
   ( [Request_Type],[Requester_username],[Note]
      ,[Request_status],[Creation_time],[Ticket_Subject]
      ,[Employee_Username],[Last_working_date],[Employee_new_id],[Employee_new_username]
      ,[Employee_grade] , [Employee_app_Id])

  VALUES ( '$Request_Type', '$Requester_username', '$Note' , '$Request_status', '$Creation_time', '$Ticket_Subject',
'$Employee_Username','$Last_working_date','$Employee_new_id','$Employee_new_username'
 ,'$Employee_grade' , '$engineer_id')");

    }
   }
}if(($Request_Type !== 'Employee Promotion') && ($Request_Type !== '0')){
//sqlsrv_query( $con ,
$insert_query = sqlsrv_query( $con ,"INSERT INTO [Aya_Web_APP].[dbo].[tbl_Ticketing_system] 
   ( [Request_Type],[Requester_username],[Note]
      ,[Request_status],[Creation_time],[Ticket_Subject]
      ,[Employee_Username],[Last_working_date],[Employee_new_manager],[Employee_new_id],[Employee_new_username]
      ,[Reason_of_leave] , [Employee_grade] , [Employee_app_Id])

  VALUES ( '$Request_Type', '$Requester_username', '$Note' , '$Request_status', '$Creation_time', '$Ticket_Subject',
'$Employee_Username','$Last_working_date','$Employee_new_manager','$Employee_new_id','$Employee_new_username'
 , '$Reason_of_leave' , '$Employee_grade' , '$engineer_id')");
//);


if($insert_query){
 echo '<script>
    swal({
    title: "Done",
  icon: "success",
  })
     </script>';}

}
}
?>

 </div>
</div>

<script>


  if($('#Request_Type').value = "undefined")
  {
    $('#Employee_Username').hide();
    $('#Last_working_date').hide(); 
    $('#Employee_new_username').hide();
    $('#Employee_new_id').hide();
    $('#Employee_new_manager').hide();
    $('#Reason_of_leave').hide();
    $('#Employee_grade').hide();
    $('#upload').hide();


  }
  $('#Request_Type').on('change' , function(){
    //alert(this.value);
    if(this.value == "Change Management"){

      $('#Employee_Username').show();
      $('#Last_working_date').show();
      $('#Employee_new_manager').show();
      
      $('#Employee_new_username').hide();
      $('#Employee_new_id').hide();
      $('#Reason_of_leave').hide();
      $('#Employee_grade').hide();
      $('#upload').hide();
    }      
else if(this.value == "Resign employees"){

        $('#Employee_Username').show();
        $('#Last_working_date').show();
        $('#Reason_of_leave').show();

        $('#Employee_new_username').hide();
        $('#Employee_new_id').hide();
        $('#Employee_new_manager').hide();
        $('#Employee_grade').hide();
        $('#upload').hide();
    }
 else if(this.value == "Change from OutSource to Staff"){

        $('#Employee_Username').show();
        $('#Last_working_date').show();
        $('#Employee_new_username').show();
        $('#Employee_new_id').show();
        $('#Employee_new_manager').hide();
        $('#Reason_of_leave').hide();
        $('#Employee_grade').hide();
        $('#upload').hide();
    }

else if(this.value == "Employee Promotion"){

        $('#Employee_Username').show();
        $('#Last_working_date').show();
        $('#Employee_grade').show();
        $('#Employee_new_username').hide();
        $('#Employee_new_id').hide();
        $('#Employee_new_manager').hide();
        $('#Reason_of_leave').hide();
        $('#upload').hide();
    }

//
else if(this.value == "Change schedule"){
        $('#upload').show();
        $('#Employee_Username').hide();
        $('#Last_working_date').hide();
        $('#Employee_grade').hide();
        $('#Employee_new_username').hide();
        $('#Employee_new_id').hide();
        $('#Employee_new_manager').hide();
        $('#Reason_of_leave').hide();
    }

//upload
    else
    {
      $('#Employee_Username').hide();
      $('#Last_working_date').hide(); 
      $('#Employee_new_username').hide();
      $('#Employee_new_id').hide();
      $('#Employee_new_manager').hide();
      $('#Reason_of_leave').hide();
      $('#Employee_grade').hide();
      $('#upload').hide();
    }

});
</script>

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="js/ajaxjquery.min.js"></script>
   <script>


$('#form').validate({

    //... your validation rules come here,

    submitHandler: function(form) {
        $.ajax({
            url: form.action,
            type: form.method,
            data: $(form).serialize(),
            success: function(response) {
                $('#Request_Type').html(response);
            }            
        });
    }
});
   
</script>
</form>

</section>
</div>
</center>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <?php
 include ("footer.html");
}
 ?>