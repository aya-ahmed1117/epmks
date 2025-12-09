
 

  <?php
      set_time_limit(400);
include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      ?>

      <title>Add & Edit schedule</title>
      <head>
        <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.js"></script>

        <script src="js/bootstrap2.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
        <link href="css/my_table.css" rel="stylesheet">
</head> 
<style type="text/css">
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }

  .zoom:hover{
    transform: scale(1.5);
  }

     .ui-widget-content {
    border: 1px solid #d9d6c4;
    background: #eceadf 50% 50% repeat;
    color: #1f1f1f;
    width: 30%;
}

table.ui-datepicker-calendar {
    border-collapse: separate;
    width: 100%;
}
.ui-datepicker table {
    width: 100%;
    font-size: 1.2em;
    border-collapse: collapse;
    margin: 0 0 .4em;
}

.ui-datepicker .ui-datepicker-title {
    margin: 0 2.3em;
    line-height: 1.8em;
    text-align: center;
}
</style>

 <?php 
//          if($role_id >=1){
    $new_querys= sqlsrv_query( $con ,"exec view_add_edit_sch_username 
     @username =  '$s_username'");
              $out_new = sqlsrv_fetch_array($new_querys);
            $my_username = $out_new['username'];
         
            if($s_username <> $my_username){
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
        <u><h2>Hi : '.$s_username.'</h2></u>
      <span class="error-code-bg text-bold" style="text-transform: uppercase;"><br> <i class="fa fa-exclamation-triangle"></i> Sorry You are not allowed to open this page Please Go to create task page to creat your OnCall task.</span>
        </div>
    </div>';
}
                ?>


       <?php 
          if($role_id >=1){
    $new_querys= sqlsrv_query( $con ,"exec view_add_edit_sch_username 
     @username =  '$s_username'");
              $out_new = sqlsrv_fetch_array($new_querys);
            $my_username = $out_new['username'];
         
            if($my_username){
                ?>
<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >
              Add / Edit Schedule</h2>
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Here you can add a new schedule for the employee or edit the current schedule with max 31 days in one operation</p>
    </aside>
  </div>
</center>


<section class="border p-4 d-flex justify-content-center mb-5">

<div style="padding:20px;">
  <form method="post"  onsubmit="return compare()" >

          <div class="row">

    <div class="col-lg-6">
      <div class="input-group mb-5">
        <span class="input-group-text" id="basic-addon1">Start Date</span>
        <input type="date" class="form-control" placeholder="From Date" aria-label="From Date" id="adate" min="<?php $tomorrow = date("Y-m-d", strtotime("+1 day"));
                  echo $tomorrow ; ?>" 
      name='date' aria-describedby="basic-addon1"
      value='<?php if(isset($_POST['date'])) echo $_POST['date']; ?>' required />
      </div>
    </div>
<br>
    <div class="col-lg-6">
      <div class="input-group mb-5">
        <span class="input-group-text" 
        id="basic-addon1">End date</span>
        <input type="date" class="form-control" placeholder="To Date" aria-label="To Date" name="date2" id="bdate" min="<?php $tomorrow = date("Y-m-d", strtotime("+1 day"));
                  echo $tomorrow ; ?>"
          aria-describedby="basic-addon1"required
      value='<?php if(isset($_POST['date2'])) echo $_POST['date2']; ?>'/>
  </div>
</div>

  </div> <!-- close row-->

      <div class="row">

     <div class="col-lg-6">
      <div class="input-group mb-5">
        <span class="input-group-text" id="basic-addon1">Start Time</span>
        <input type="time" id="time" step="4"
         class="form-control" placeholder="From Time" aria-label="From Time" id="times"
      name='time' aria-describedby="basic-addon1"
      value='<?php if(isset($_POST['time'])) echo $_POST['time'];?>' required />
    </div>
  </div>
<br>
     <div class="col-lg-6">
      <div class="input-group mb-5">
        <span class="input-group-text" 
        id="basic-addon1">End Time</span>
        <input type="time" step="4" class="form-control" placeholder="To Time" aria-label="To Time" name="time2" id="time2"
          aria-describedby="basic-addon1"required
      value='<?php if(isset($_POST['time2'])) echo $_POST['time2']; ?>'/>
    </div>
  </div>
</div>
  <div class="col-md-8">
    <div class="input-group col-md-8">
    <span class="input-group-text" id="basic-addon1">Choose (off) days </span>
    <input type="text" id="multiple-date-select" autocomplete="off" name="days" class="form-control days" readonly="true" placeholder="choose days" required="true"  ></input> 
    </div>   
    </div>
<br>
<div class="col col-8">
        <div class="input-group">
<div  class="input-group"  id="username">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fas fa-user-tie"></i>User</samp></span>
  <select id="input2-group2"required
class="form-control" name="username"value='<?php if($username != '') echo $username;?>' >
  <option action="none" value="0" selected>Select..</option>
  <?php
$usernames = $_SESSION['username'];
$checks = sqlsrv_query( $con ,"SELECT 
  username from [Aya_Web_APP].dbo.employee_web_table where manager = '$self'
   ");
  while($outputs = sqlsrv_fetch_array($checks)){
    $usernames = $outputs['username'];
        $rows = '<option ';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
  echo $rows;}
?> 
</select>

</div>
</div>

</div>


<br>

<!--center>
<div class="input-group-btn col-md-10">
  <button class="btn btn-primary"type='submit' name='submit' value="Get data" >Submit
  </button>
</div>
</div>
</center-->

<center>
<button type="submit" value="submit" class="btn btn-warning submit" onclick="compare()" name="submit" style="width: 50%;padding: 10px;color: #fff;font-size: 15px; border-radius: 20px 20px 20px 20px;">
  submit
</button>
</center>

</section>
</div>

<script type="text/javascript">

$( "#multiple-date-select" ).datepicker({
    dateFormat: 'dd-mm-yy',

    altField  : '#alternate',
    onSelect  : function() {
    
        // proof
        console.log( $('#alternate').val() );
    }
});
</script>

 <?php

if(isset($_POST['date'])){$mydate = $_POST['date'];}
if(isset($_POST['date2'])){$mydate2 = $_POST['date2'];}
if(isset($_POST['time'])){$myTime = $_POST['time'];}
if(isset($_POST['time2'])){$myTime2 = $_POST['time2'];}
if(isset($_POST['username'])){$usernames = $_POST['username'];}
if(isset($_POST['days'])){$days = $_POST['days'];}

if(isset($_POST['submit'])){

$myTimes2 = date('H:i:00', strtotime($_POST['time']));

$myTimes5 = date('H:i:00', strtotime($_POST['time2']));

    
           // $total_days = $mydate2 - $mydate ;

 

$start_date = strtotime($mydate);
$end_date = strtotime($mydate2);
  
// Get the difference and divide into 
// total no. seconds 60/60/24 to get 
// number of days
$diff = ($end_date - $start_date)/60/60/24;
//echo $diff;
//$tomorrow = date('d',strtotime("+1 days"));

        // echo date('Y-m',$tomorrow); 

?>


    <div style="padding:20px;">
        <div class="tableFixHead">


    <table class="table order-table"cellspacing="0" id="tblCustomers">
      <thead style="color: white;font-size: 15px;background-color:#55608f;border: 1px solid white; ">
        <tr>
          <th ><center>Username</center></th>
          <th><center>Start Time</th>
          <th><center>End Time</center> </th>
          <th><center>Date </th>
          <th><center>Senior</th>
          <th><center>Super</center></th>
          <th><center>Section</center></th>
        </tr>
        </thead>
      
      <tbody>

    <?php 
if($diff >= 31){
  echo '<script>
    swal({
    title: "Days must be less than 31 days",
  icon: "info",
  })
     </script>';
}else{
    $self = $_SESSION['id'];
    $s_username = $_SESSION['username'];


if(isset($_POST['date'])){$mydate = $_POST['date'];}
if(isset($_POST['date2'])){$mydate2 = $_POST['date2'];}
if(isset($_POST['time'])){$myTime = $_POST['time'];}
if(isset($_POST['time2'])){$myTime2 = $_POST['time2'];}
if(isset($_POST['username'])){$usernames = $_POST['username'];}
if(isset($_POST['days'])){$days = $_POST['days'];}

     $user_query = sqlsrv_query( $con ,"EXEC Auto_sch_update_edit  @user_name='$usernames' 
, @Start_time='$myTimes2'
, @end_time='$myTimes5'
, @Date_from='$mydate'
, @Date_end='$mydate2'
, @Date_off='$days'
, @session_user='$s_username'
, @session_id='$self' ");

      while($echo = sqlsrv_fetch_array($user_query)){
    $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Username'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['start'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['end'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Date_from']->format('Y-m-d').'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['senior'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['super'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['section'].'</td>';

      $rows .= '</tr>';
        echo $rows;
      }
}
      // insert 1
      $creator_id=$_SESSION['id'];
$sqltime = date ("Y-m-d H:i:s");

/*
@user_name='$usernames' 
, @Start_time='$myTime'
, @end_time='$myTime2'
, @Date_from='$mydate'
, @Date_end='$mydate2'
, @Date_off='$days'
, @session_user='$s_username'
, @session_id='$self'
*/
//demo

 $insert_demo =sqlsrv_query( $con ," EXEC Insert_Schtable_demo
    @user_name='$usernames' 
, @Start_time='$myTimes2'
, @end_time='$myTimes5'
, @Date_from='$mydate'
, @Date_end='$mydate2'
, @Date_off='$days'
, @session_user='$s_username'
, @session_id='$self'
    ");

   if($insert_demo){
echo '<script>
    swal({
    title: "The schedule has been added/updated successfully",
  icon: "success",
  })
     </script>';}

  //new_Schtable
$insert_query = sqlsrv_query( $con ,"EXEC Insert_new_Schtable
@user_name='$usernames' 
, @Start_time='$myTimes2'
, @end_time='$myTimes5'
, @Date_from='$mydate'
, @Date_end='$mydate2'
, @Date_off='$days'
, @session_user='$s_username'
, @session_id='$self'

  ");

if($insert_query){
echo '<script>
    swal({
    title: "Insert Done",
  icon: "success",
  })
     </script>';}

  

     //update_schedule_table
     $update_schedule=sqlsrv_query( $con ," EXEC update_schedule_table
    @user_name='$usernames' 
, @Start_time='$myTimes2'
, @end_time='$myTimes5'
, @Date_from='$mydate'
, @Date_end='$mydate2'
, @Date_off='$days'
, @session_user='$s_username'
, @session_id='$self'
    ");

   if($update_schedule){
echo '<script>
    swal({
    title: "The schedule has been added/updated successfully",
  icon: "success",
  })
     </script>';}



}
}}
    ?>

    </tbody>
</table>

<!--div class="tableFixHead">

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
      <th></th>
    </tr>

    </tbody>
</table>
</div-->
</div>

</form>
</div>

<script type="text/javascript">
 $("input[type=text]").datepicker({
  dateFormat: 'd-m-y',
  onSelect: function(dateText, inst) {
    $(inst).val(dateText); // Write the value in the input
  }
});

// Code below to avoid the classic date-picker
/*$("input[type=date]").on('click', function() {
  return false;
});*/
</script>
<script>
    var arr = [];
    $('#multiple-date-select').multiDatesPicker({onSelect:function(datetext){

        if(arr.includes(datetext)){
            var table = document.getElementById('table-data');
            var data = document.getElementById(datetext);
            data.remove(); 
            arr.splice(datetext,1)
        }else{
            arr.push(datetext)
            var table = document.getElementById('table-data');
            var row = document.createElement('tr');
            var col = document.createElement('th');
            row.setAttribute('id',datetext);
            col.innerHTML = datetext;
            row.appendChild(col);
            table.appendChild(row);         
        }   
    }});        
 </script>
 <script type="text/javascript">
  function compare()
{
  var start_date = document.getElementById("adate").value;
  var end_date = document.getElementById("bdate").value;

  if( (new Date(start_date).getTime() > new Date(end_date).getTime()))
    {
       alert("End Date should be greater than Start date ");
       event.preventDefault();
    }
 /* if( (new Date(start_date).getTime() != new Date(end_date).getTime()))
  {
      alert("End Date should be equal Start date ");
       event.preventDefault();
  }  */
}
</script>
 <script src="js/jquery-3.6.0.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="js/ajaxjquery.min.js"></script>
<script src="js/table2excel.js" type="text/javascript"></script>

  <?php
 include ("footer.html");
 ?>
 