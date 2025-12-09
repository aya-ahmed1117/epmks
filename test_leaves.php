
<?php
include ("pages.php");

     $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      ?>
    <title>Create Leaves</title>
    <link href="css/my_table.css" rel="stylesheet">

</head>
 
<style> 
.hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }

tr:nth-child(even) {
  background-color: lightgray;
}

.input-group {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 55%;
}
  .input-group-text{
  	width: auto;
  }
  .row{
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin: auto;
    width: auto;
    /*margin-left: -15px;
    margin-right: -15px;*/
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
              <h2 class="text-dark display-12" >Create Leaves</h2>
              <p style="color:lightgray;">Hi : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">...</p>
  </aside>
</div>
</center>
<!--  container-fluid
style="background-image:url('images/beautiful-technology.jpg');"
-->
<div class="form-control" style="
padding: 15px;
    align-content: center; background-color: rgba(0,0,0,.125);
    " >
          <div class="row">

<form method="post" class="content" onsubmit="return compare()" 
 enctype="multipart/form-data">  

 <div class="form-control">

 <div class="input-group mb-3" id="upload">
 	    
  <input type="file" name="fileToUpload" class="form-control file" id="fileToUpload" />

  <label class="input-group-text">Upload</label>
  <span class="input-group-text">Select image to upload (it must be less than 1 mega):</span>
</div>


   <div class="input-group">
  <span class="input-group-text" id="basic-addon1">Start date</span>
  <input type="date" class="form-control adate" placeholder="From Date" aria-label="From Date" name="adate" id="adate"
    aria-describedby="basic-addon1"/>
</div>

      <br> 
<div class="input-group">
  <span class="input-group-text" id="basic-addon1">End date</span>
  <input type="date" class="form-control bdate" placeholder="To Date" aria-label="To Date" name="bdate" id="bdate"
    aria-describedby="basic-addon1"/>
</div>

 <br>
<div class="input-group" id="FromTimeDiv">
  <span class="input-group-text" id="basic-addon1">From Time</span>
  <input type="time" class="form-control Stime"
  aria-label="To Date" 
  name="starttime"  id="starttime" placeholder="Enter start time"
    aria-describedby="basic-addon1"/>
</div>
 
<br>
<div class="input-group" id="ToTimeDiv">
  <span class="input-group-text" id="basic-addon1">From Time</span>
  <input type="time" class="form-control Etime"aria-label="From Time" 
  name="endtime"  id="endtime" placeholder="Enter end time"
    aria-describedby="basic-addon1"/>
</div>

</div>
<br>
    <span class="input-group-text" style="width:10%;">Choose Leave Type</span>
<br>
  <div  class="input-group"id="inputGroupSelect01div">
  <span class="input-group-text" id="basic-addon1">Leave Type</span>
  <select class="form-control sType" name="type" id="inputGroupSelect01"  required="true">
	<option value="0" selected>Choose Leave ...</option>
    <option value="Annual Leave">Annual Leave</option>
    <option value="Sick Leave">Sick Leave</option>

    <?php
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);

  //$unit = $_SESSION['Unit_Name'];
$checkme = sqlsrv_query( $con1 ,"SELECT [Unit]
  FROM [Employess_DB].[dbo].[tbl_Personal_info] where username = '$s_username'");
  $output = sqlsrv_fetch_array($checkme );
   $Unit_Name = $output['Unit'];
echo $Unit_Name .'hear';
if ($Unit_Name <> 12 ){
  ?>
    <option value="Instead of(HR)">Instead of(HR)</option>
  <?php }
  ?>
    <option value="Compassionate Leave">Compassionate Leave</option>
    <option value="Maternity Leave">Maternity Leave</option>
    <option value="Pilgrimage Leave">Pilgrimage Leave</option>
    <option value="Official Mission" >Official Mission</option>
    <option value="Paternity Leave" >Paternity Leave</option>
    <option value="Permission" >Permission</option>
    <option value="Unpaid Leave">Unpaid Leave</option>
    <option value="Maternity on duty leave">Maternity on duty leave</option>
  </select>

</div>
   <br>
<div class="input-group" >
  <span class="input-group-text" id="basic-addon1">Counting</span>
  <input class="form-control" id="countDays"
  aria-label="From Time" name="count" placeholder="calculate"
    aria-describedby="basic-addon1" required/>
    <button onclick="event.preventDefault();myfunc()" 
  style="width: 20%;" class="btn btn-warning">Count</button>
</div>

<br>
  
<div class="form-outline">
  <textarea class="form-control notes" name="notes" id="textAreaExample" rows="4"></textarea>
  <label class="form-label" for="textAreaExample">Message</label>
</div>
<br>


<input type="submit" class="btn btn-primary submit" onclick="compare()" name="send" value="create leave"style="width:30%;" />
<br>
</form>
</div>
</div>

<center>
<div class="tableFixHead col-8">
<table style="border-radius:30px 30px 30px 30px;" >
    <thead >
   
          <th >Type </th>
          <th >From date</th>
          <th >To date</th>
          <th >From time</th>
          <th >To time</th>
          <th >Notes </th>
          <th >Count </th>
          <th >Status</th>
          <th >Attach</th>
</thead>
<tbody id="logBoard">
<?php      
$s_username = $_SESSION['username'];
$first_query = sqlsrv_query( $con ,"SELECT top 8 * FROM leaves WHERE username ='$s_username' order by [creation_time] DESC ");
while($output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .='<td class="hovers">'.$output_query["type"].'</td>';
$rows .='<td class="hovers">'.$output_query["adate"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers">'.$output_query["bdate"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers">'.$output_query["starttime"]->format('H:i:s').'</td>';
$rows .='<td class="hovers">'.$output_query["endtime"]->format('H:i:s').'</td>';
$rows .='<td class="hovers">'.$output_query["notes"].'</td>';
$rows .='<td class="hovers">'.$output_query["count"]. '</td>';
$rows .='<td class="hovers" style="color:green;">'.$output_query["status"].'</td>';
if(($output_query["attach"] !== "uploads/") && ($output_query["attach"] !== " ") && ($output_query["type"] == "Sick Leave"  || $output_query["type"] == "Compassionate Leave"  || 
    $output_query["type"] == "Maternity Leave" || $output_query["type"] == "Paternity Leave")){
$rows .= '<td  class="pt-3-half hovers" ><a href='.$output_query["attach_image"].' download><samp style="float:right;font-size:15px;"><i class="fas fa-paperclip hovers" style="color:red;width:35px;"></samp></i></a>'.'</td>';
}
else{
  $rows .= '<td class="hovers"></td>';}

$rows .='</tr>';

echo $rows;
}
?>

</tbody>
</table>
</div>
</center>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
      
 	$('.submit').click(function(){
      var notes = $('.notes').val();
      var sType = $('.sType').val();
      var adate = $('.adate').val();
      var bdate = $('.bdate').val();
      var Stime = $('.Stime').val();
      var Etime = $('.Etime').val();
     dataString ='type='+sType+'&notes='+notes+'&adate='+adate+'&bdate='+bdate+'&starttime='+Stime+'&endtime='+Etime;

   $.ajax({
    url: 'ajax_leaves.php',
    type: 'POST',
  	data:dataString,
  	cache: false,
    success: function(data){ 
    	$('#logBoard').html(data);
      swal({ title: "Done ...:)", icon: "success",});
     
    }, error: function(err){
      swal({ title: "Error", icon: "warning",});
          console.log(err);
        }
  });

   return false;
 });

});
</script>
    <!-- Popper.JS -->
<script type="text/javascript">
  function myfunc(){
    var start = new Date($('#adate').val());
    var end = new Date($('#bdate').val());

// end - start returns difference in milliseconds 
var diff = new Date(end - start);

// get days
var days = diff/1000/60/60/24;
days = days+1
$('#countDays').val(Math.round(days));
    alert(Math.round(days));
}

</script>
<script type="text/javascript">
  if($('#inputGroupSelect01').value != "Permission" && $('#inputGroupSelect').value != "Official Mission")
  {
    $('#ToTimeDiv').hide();
    $('#FromTimeDiv').hide(); 
  }
  $('#inputGroupSelect01').on('change' , function(){
    //alert(this.value);
    if(this.value == "Permission" || this.value == "Official Mission"){

      $('#ToTimeDiv').show();
      $('#FromTimeDiv').show();
    }
else{
  $('#ToTimeDiv').hide();
  $('#FromTimeDiv').hide();  
}
});
</script>

    <script type="text/javascript">
  if($('#inputGroupSelect01').value != "Permission" && $('#inputGroupSelect').value != "Official Mission")
  {
    
    $('#upload').hide(); 
  }
  $('#inputGroupSelect01').on('change' , function(){
    //alert(this.value);
    if(this.value == "Sick Leave" || this.value == "Compassionate Leave" || this.value == "Maternity Leave"|| this.value == "Paternity Leave"){

      $('#upload').show();
    }
else{
  $('#upload').hide();
}
});
</script>

<script type="text/javascript">
  function validateForm() {
  var x, adate;
  var y, bdate;

  // Get the value of the input field with id="numb"
  x = document.getElementById("numb").value;

  // If x is Not a Number or less than one or greater than 10
  if (isNaN(x) || x < 1 || x > 10) {
    text = "Input not valid";
  } else {
    text = "Input OK";
  }
  document.getElementById("demo").innerHTML = text;
}

function compare()
{
  debugger;
    var startDt = document.getElementById("adate").value;
    var endDt = document.getElementById("bdate").value;
    var ptype = document.getElementById("inputGroupSelect01").value;

    var strStartTime = document.getElementById("starttime").value;
    var strEndTime = document.getElementById("endtime").value;

    var startTime = new Date().setHours(GetHours(strStartTime), GetMinutes(strStartTime), 0);
    var endTime = new Date(startTime)
    endTime = endTime.setHours(GetHours(strEndTime), GetMinutes(strEndTime), 0);

    if( (startTime > endTime) && (ptype == "Permission" || ptype == "Official Mission" ) ) {
        alert("Start Time is greater than end time");
        event.preventDefault();
    }

function GetHours(d) {
    var h = parseInt(d.split(':')[0]);
    if (d.split(':')[1].split(' ')[1] == "PM") {
        h = h + 12;
    }
    return h;
}
function GetMinutes(d) {
    return parseInt(d.split(':')[1].split(' ')[0]);
}
/////////

  if( (new Date(startDt).getTime() > new Date(endDt).getTime()))
    {
       alert("To Date should be greater than From date ");
       event.preventDefault();
    }
  if( (new Date(startDt).getTime() != new Date(endDt).getTime())  && (ptype == "Permission" || 
  ptype == "Official Mission" ) )
  {
      alert("To Date should be equal From date ");
       event.preventDefault();
  }   
}
</script>


<script type="text/javascript">
  function myfunc(){
    var start = new Date($('#adate').val());
    var end = new Date($('#bdate').val());

// end - start returns difference in milliseconds 
var diff = new Date(end - start);

// get days
var days = diff/1000/60/60/24;
days = days+1
$('#countDays').val(Math.round(days));
    alert(Math.round(days));
}

</script>
<script type="text/javascript">
  if($('#inputGroupSelect01').value != "Permission" && $('#inputGroupSelect').value != "Official Mission")
  {
    $('#ToTimeDiv').hide();
    $('#FromTimeDiv').hide(); 
  }
  $('#inputGroupSelect01').on('change' , function(){
    //alert(this.value);
    if(this.value == "Permission" || this.value == "Official Mission"){

      $('#ToTimeDiv').show();
      $('#FromTimeDiv').show();
    }
else{
  $('#ToTimeDiv').hide();
  $('#FromTimeDiv').hide();  
}
});
</script>

<?php

 include ("footer.html");
 ?>
