
 <?php

    //  require_once("inc/config.inc");
      include ("pages.php");
  $self = $_SESSION['id'];
  $role_id = $_SESSION['role_id'];
  $from_date="";
  $week_num="";
  $Units ="";
  $Group_name="";
  $groups = "";
  $units="";

$unit = $_SESSION['Unit_Name'];


// Establish your database connection $con here

// IMPORTANT: Sanitize and validate $s_username if it comes from user input
// Even better, use parameterized queries to prevent SQL injection.

// Example of a prepared statement (recommended for security)
// This is a more secure way to execute queries with user input.

// if you need to build the query dynamically based on unit exclusion,
// you might need to build the parameter list dynamically too.
// For now, let's assume the 'unit not in' part is static.

$sql = "SELECT b.[username]
        FROM [Aya_Web_APP].[dbo].[employee] b
        LEFT JOIN Employess_DB.dbo.tbl_Personal_info a ON a.UserName = b.username
        WHERE unit NOT IN (11, 12, 13, 14, 15, 16, 17, 18) AND b.username = ?"; // Use '?' for parameter

$stmt = sqlsrv_prepare($con, $sql, array(&$s_username)); // Pass $s_username by reference

if ($stmt === false) {
    echo "Error preparing statement: ";
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_execute($stmt) === false) {
    echo "Error executing statement: ";
    die(print_r(sqlsrv_errors(), true));
}

$output = sqlsrv_fetch_array($stmt);

$Unit_username = null; // Initialize to null

if ($output && isset($output['username'])) {
    $Unit_username = $output['username'];
} else {
    echo "⚠️ لم يتم العثور على مستخدم مطابق.";
}

// Now you can safely use $Unit_username
if ($Unit_username) {
    echo "Welcome, " . htmlspecialchars($Unit_username) . "!";
    // Continue with your code that depends on Unit_username
} else {
    // Handle the case where the username was not found
    echo "User not found or not in allowed units.";
}

// Free the statement and close the connection when done
sqlsrv_free_stmt($stmt);
// sqlsrv_close($con); // Close connection when all operations are done
?>


  <title>ON Call SD</title>
<head>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css">
<script src="jQuery/jquery.min.js"></script>
<script src="jQuery/jquery-ui.js"></script>
<script src="js/jquery-ui.multidatespicker.js"></script>
<script src="js/bootstrap2.min.js"></script>
<link href="css/my_table.css" rel="stylesheet">

</head>
    <style type="text/css">
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

// 12 13 14 15 16 17
if ($Unit_username){
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
else{
$checkme = sqlsrv_query( $con ,"SELECT 
      b.[username]
  FROM [Aya_Web_APP].[dbo].[employee] b
  left join Employess_DB.dbo.tbl_Personal_info a on a.UserName = b.username
  where unit  in (12,13 ,14,15, 16 ,17)and b.username = '$s_username'  ");
  $output = sqlsrv_fetch_array($checkme );
  $in_username = $output['username'];
// 12 13 14 15 16 17
if ($in_username ){
}
?>

<script type="text/javascript">
  (function() {
  document.getElementById("message").style.display = "none";
});
</script>
      <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Create OnCall</h2>
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Please select ( days - month - year ) that you have taken a busniess call on it ( out of your working hours )</p>
  </aside>
</div>
</center>
<center>
<section >
 
<form>

    <div class="container">

  <div class="col-lg-8">
    <div class="input-group">
    <span class="input-group-text" id="basic-addon1">Choose multiple days </span>
  <input style="" id="multiple-date-select" autocomplete="off" name="days" class="form-control days" readonly="true" placeholder="choose days" required  ></input> 
</div>
</div>

<br>
<div class="col-md-8">
  <div>
   <div class="input-group">  
  <!--select class="browser-default custom-select"-->
  <span class="input-group-text" id="basic-addon1">Choose Month</span>
  <select name="month" id="month" class="form-control month"     required>
  <option action="none" value="" selected>Select Month....</option>
  <option value="1">January</option>
  <option value="2">February</option>
  <option value="3">March</option>
  <option value="4">April</option>
  <option value="5">May</option>
  <option value="6">June</option>
  <option value="7">July</option>
  <option value="8">August</option>
  <option value="9">September</option>
  <option value="10">October</option>
  <option value="11">November</option>
  <option value="12">December</option>
</select>
</div>

  <br>
<div class="input-group"> 
  <span class="input-group-text" id="basic-addon1">Choose year</span>
  <select name="year" id="year" class="form-control year" required>
    <option action="none" value="0" selected>Select Year....</option>
 <option value="<?php echo date('Y');?>" selected="selected"><?php echo date('Y');?></option>
<option value="<?php echo date('Y')+1;?>" disabled="true"><?php echo date('Y')+1;?></option>
  <?php 
  //if(date('Y') == 2025){
      //echo '<option value="echo date("Y")"></option>';}
   
  ?>
</select>
</div>

 <br>
 
    <div class="form-outline">
  <label class="input-group-text" for="textAreaExample">Notes..</label>
  <textarea class="form-control note" name="note" id="textAreaExample" rows="4"></textarea>
</div>
<br>
<center>
<button type="submit" value="save" class="btn btn-warning submit"  name="send" style="width: 30%;padding: 10px;color: #fff;font-size: 15px; border-radius: 20px 20px 20px 20px;">
  Create On Call
</button>
</center>

</div>

</form>
</section>
</center>
<br>
<center>
  <div class="col-md-8">
  <div class="tableFixHead" >

 <table style="border-radius: 30px 30px 0 0;">
    <thead >           
          <th>Type</th>
          <th>Days</th>
          <th>month</th>
          <th>year</th>
          <th >creation time</th>
          <th >Notes </th>
          <th >status </th>
</thead>
  <tbody id="logBoard" style="background-color:white;">
<?php

$role_id = $_SESSION['role_id'];
$self = $_SESSION['id'];
$check_orders = sqlsrv_query( $con ,"SELECT top 40 * FROM oncall_sd WHERE engineer_id= '$self' and [creation_time] >='2023-12-01'  order by [creation_time] DESC");
while ($output_orders = sqlsrv_fetch_array($check_orders)) {
  $rows ='<tr>';
  $rows.= '<td class="hovers">'.$output_orders['type'].'</td>';
  $rows.= '<td class="hovers"style="color:orange;">'.$output_orders['days'].'</td>';
  $rows.= '<td class="hovers"style="color:orange;">'.$output_orders['month'].'</td>';
  $rows.= '<td class="hovers">'.$output_orders['year'].'</td>';
  $rows.= '<td class="hovers">'.$output_orders['creation_time']->format('Y-m-d H:i:s').'</td>';
  $rows.= '<td class="hovers">'.$output_orders['note'].'</td>';
  $rows.= '<td class="hovers">'.$output_orders['status'].'</td>';
  $rows.='</tr>';
 echo $rows;
}?>

</tbody>
</table>
</div>
</div>
</center>

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

<script type="text/javascript">
 $("input[type=text]").datepicker({
  dateFormat: 'd-m-y',
  onSelect: function(dateText, inst) {
    $(inst).val(dateText); // Write the value in the input
  }
});

// Code below to avoid the classic date-picker
$("input[type=date]").on('click', function() {
  return false;
});
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

 <script ssrc="js/jquery-3.6.0.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script>
$(document).ready(function(){
  $('.days').keypress(function(e) {
    e.preventDefault();
});
  $('.submit').click(function(){
      var notes =$('.note').val();
      var days  =$('.days').val();
      var year  =$('.year').val();
      var month =$('.month').val();
      var table =$('.data').val();

     var dataString ='note='+notes+'&year='+year+'&month='+month+'&days='+days;
     if(month == ''){
            swal({ title: "*! Please Select month", icon: "warning",});
        }
     if(days !== "" && month != ''){
         $.ajax({
          url: 'ajax_onCall.php',
          type: 'POST',
          data:dataString,
          cache: false,
    success: function(data){ 
      swal({ title: "Done ...:)", icon: "success",});
      $('#logBoard').html(data);
        $('.note').val("");
        $('.days').val("");
        $('.month').val("");
        $('.data').val("");

      }, error: function(err){
          //console.log(err);
        }
   });
      return false;
      }else{
      alert('empty date');    
    }
   });
});

</script>


</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

 
<?php
 include ("footer.html");
}//}
 ?>

<?php
  /*if( ($_SESSION['Unit_Name'] <> 'Enterprise Service Desk') && ($_SESSION['Unit_Name'] <> 'Workforce Management') 
 && ($_SESSION['Unit_Name'] <> 'Enterprise Support Systems')
      && ($_SESSION['Unit_Name'] <> 'Problem Management and Service Optimization')
      && ($_SESSION['Unit_Name'] <> 'Quality Management and Training')){*/
//include ("footer.html");
  //}
?>
