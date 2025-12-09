
<?php
include ("pages.php");
  //require_once("inc/config.inc");

?>
<title>Create Tasks</title>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap2.min.js"></script>
  <link href="css/my_table.css" rel="stylesheet">
</head>

<?php
  /* if($_SESSION['role_id'] == 0) {}

   if(($_SESSION['role_id'] == 2) ||($_SESSION['role_id'] == 3 ) ||($_SESSION['role_id'] == 4 ) ||($_SESSION['role_id'] == 5 )
    ||($_SESSION['role_id'] == 6 )) {}*/
  ?>
  <center> 
  <div class="col-md-8">
          <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
          border-radius: 20px 20px 20px 20px;">
              <div class="card-header user-header alt bg-light"
              style="border-radius: 20px 20px 0 0 ;">
              <div class="media">
              <div class="media-body">
                <h2 class="text-dark display-12" >Create Tasks</h2>
                <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
                </div>
            </div>
        </div>
         <p style="background-color:#55608f;font-weight:bold;font-size:16px;
         color:white;">Here you can create a tasks that counted or listed on the company Tools ( out of system Tasks )</p>
    </aside>
  </div>
</center>
 <section class="border p-4 d-flex justify-content-center mb-4">

<form method="POST" >
  <div>

   <div class="input-group md-2">	
  <span class="input-group-text" id="basic-addon1">Start Day</span>
  <input type="date" class="form-control cur_date" name="cur_date" 
  placeholder="Choose date" required="true" id="adate"
   min="<?php $tomorrow = date("Y-m-d", strtotime("-60 day"));echo $tomorrow; ?>" 
    aria-describedby="basic-addon1"value='<?php if(isset($_POST['cur_date'])) echo $_POST['cur_date']; ?>' />
</div>

      <br> 
<div class="input-group md-2">
  <span class="input-group-text" id="basic-addon1">Start Time</span>
  <input type="time" class="form-control stime" placeholder="Enter Start Time" name="stime" id="starttime"
    aria-describedby="basic-addon1" required/>
</div>

      <br> 
<div class="input-group md-2">
  <span class="input-group-text" id="basic-addon1">End Time</span>
  <input type="time" class="form-control etime" placeholder="Enter end Time" name="etime" id="endtime"
    aria-describedby="basic-addon1" required/>
</div>
<br>

<div  class="input-group"id="inputGroupSelect01div">
  <span class="input-group-text" id="basic-addon1">Choose</span>
  <select id="inputGroupSelect01" class="form-control sType" name="type"    required>
	<option action="none" value="" selected>Select Item....</option>
   <option value="escalated cases,outgoing calls">escalated cases,outgoing calls</option>
    <option value="proactive outgoing calls">proactive outgoing calls</option>
    <option value="Coaching">Coaching</option>
    <option value="reports">reports</option>
    <!--option value="PSC Down Time">PSC Down Time</option-->
    <?php 
    $unit = $_SESSION['Unit_Name'];
$checkme = sqlsrv_query( $con ,"SELECT  DISTINCT [Unit_Name]
  FROM [Aya_Web_APP].[dbo].[employee]
  where Unit_Name in 
  ( 'Enterprise Service Desk','Enterprise Support Systems',
  'Problem Management and Service Optimization' , 'Quality Management and Training'
  ,'Workforce Management','ONSITE PROBLEM MANAGEMENT') and id = '$self' ");
  $output = sqlsrv_fetch_array($checkme );
  $Unit_Name = $output['Unit_Name'];
  if ($unit !== $Unit_Name ){
// 12 13 14 15 16 17?>
    <option value="ON Call - Project Management">ON Call </option>
    <?php 
  }
  ?>
    <option value="Internal meeting">Internal meeting</option>
    <option value="Resources allocation in the expanded areas">Resources allocation in the expanded areas</option>
    <option value="Shift Leader task">Shift Leader task</option>
    <option value="TAM Outbound Call">TAM Outbound Call</option>
    <option value="TAM Database">TAM Database</option>
    <option value="Meeting with Customer">Meeting with Customer</option>
    <option value="No Available Laptop/PC">No Available Laptop/PC</option>
    <option value="Trainee/shadowing">Trainee/shadowing</option>
    <option value="Residents Database">Residents Database</option>
    <option value="Reviewing Concession reports">Reviewing Concession reports</option>
    <option value="Incoming calls">Incoming calls</option>
    <option value="Fixing Resident PC/Laptop with ITHELPDESK Team">Fixing Resident PC/Laptop with ITHELPDESK Team</option>
    <option value="Customer visit">Customer visit</option>
    <option value="Working at Lab">Working at Lab</option>
    <option value="Handling mails">Handling mails</option>
    <option value="PSD Down">PSD Down</option>
    <option value="Escalation">Escalation</option>
    <option value="Following with another party">Following with another party</option>
    <option value="Wimax and Fiber Database">Wimax and Fiber Database</option>
    <option value="Wimax and Fiber Approvals">Wimax and Fiber Approvals</option>
    <option value="Invoices">Invoices</option>
    <option value="Hardware testing">Hardware testing</option>
    <option value="Onsite Reports">Onsite Reports</option>
    <option value="Conference">Conference</option>
    <option value="Internal meeting">Internal meeting</option>
    <option value="Electricity down">Electricity down</option>
    <option value="Fixing internal problem(for any internal problem with engineer)">
    Fixing internal problem(for any internal problem with engineer)</option>
    <option value="Training">Training</option>
    <option value="Handover">Handover</option>
    <option value="Doing Configuration">Doing Configuration</option>
    <option value="Updating ECRM">Updating ECRM</option>
    <option value="Following with technician">Following with technician</option>
    <option value="Handling MSAN Share point">Handling MSAN Share point</option>
    <option value="Troubleshooting technical issue">Troubleshooting technical issue</option>
    <option value="Following with Operations">Following with Operations</option>
    <option value="Requesting Card in MSAN portal">Requesting Card in MSAN portal</option>
    <option value="Updating circuit in DB">Updating circuit in DB</option>
    <option value="Doing MSAN Schedule">Doing MSAN Schedule</option>
    <option value="Requesting Site contact">Requesting Site contact</option>
    <option value="Contacting Regions">Contacting Regions</option>
    <option value="Announcing customers with planned outage">Announcing customers with planned outage</option>
    <option value="Escalating Unplanned Actions with Regions">Escalating Unplanned Actions with Regions</option>
    <option value="System down">System down</option>
    <option value="Extracting Work Orders for PRI migration">Extracting Work Orders for PRI migration</option>
    <option value="following up With WE MSAN teams for PRI Migrations">following up With WE MSAN teams for PRI Migrations</option>
    <option value="Following up with WEdata MSAN Team for requesting cards/cabinets/shelves">Following up with WEdata MSAN Team for requesting cards/cabinets/shelves</option>
    <option value="Following up with WE MSAN Team for Dial tone service migration">Following up with WE MSAN Team for Dial tone service migration</option>
    <option value="Following up with WE-Data Tech team for MSAN migration">Following up with WE-Data Tech team for MSAN migration</option>
    <option value="Following up with WE Transmission team">Following up with WE Transmission team</option>
    <option value="Following up with WE O&M team">Following up with WE O&M team</option>
    <option value="Following up with WE-Sales team">Following up with WE-Sales team</option>
    <option value="Following up with WEData-Sales team">Following up with WEData-Sales team</option>
    <option value="Following up with epm-voice team">Following up with epm-voice team</option>
    <option value="Following up with Telcosupport team">Following up with Telcosupport team</option>
    <option value="Following up with customer">Following up with customer</option>
    <option value="Following up with customer vendor">Following up with customer vendor</option>
    <option value="Following up Mails">Following up Mails</option>
    <option value="Following up with ESOC team">Following up with ESOC team</option>
    <option value="Following up with Short Number Team">Following up with Short Number Team</option>
    <option value="Following up with VIP-customer care Team for IN services">Following up with VIP-customer care Team for IN services</option>
    <option value="Following up with VIP-customer care Team for Landlines issues">Following up with VIP-customer care Team for Landlines issues</option>
    <option value="Following up with WE-Data Tech team for physical issues">Following up with WE-Data Tech team for physical issues</option>
    <option value="Following up with Regions & Exchange managers">Following up with Regions & Exchange managers</option>
    <option value="Modems configuration">Modems configuration</option>
    <option value="Customer visit for PRI tester">Customer visit for PRI tester</option>
    <option value="Following up with pre-sales team for new solution">Following up with pre-sales team for new solution</option>

  </select>
</div>

<br>
<div id="FromTimeDiv">
<div  class="input-group" >
  <span class="input-group-text" id="basic-addon1">Choose</span>
  <select class="form-control evidence" name="evidence"required="true">
	<option value="0" selected>Evidence ...</option>
    <option  action="none" value="0" selected >Select Evidence</option>
    <option value="Mail"id="FromTimeDiv">Mail </option>
    <option value="Phone"id="FromTimeDiv">Phone Call</option>
</select>
 </div>
    <br>

 <div class="input-group md-2" id="ToTimeDiv">
  <span class="input-group-text" id="basic-addon1">Customer Name</span>
  <input type="text" class="form-control customer_name" placeholder="Enter text .." name="customer_name" id=""
    />
</div>
<br>

 <div class="input-group md-2" id="ToTimeDiv">
  <span class="input-group-text" id="basic-addon1">Order Num</span>
  <input type="number" class="form-control Order_number" placeholder="Enter Number.." name="Order_number"/>
</div>
</div>

<br>
 <div class="form-outline">
  <label class="input-group-text" for="textAreaExample">Notes..</label>
  <textarea class="form-control notes" name="notes" id="textAreaExample" rows="4"></textarea>
</div>

</div><!-- row -->
<br>

<button type="submit" class="btn btn-warning submit"  name="save" style="width: 30%;padding: 10px;color: #fff;font-size: 15px; border-radius: 20px 20px 20px 20px;" onclick="compare()">Create Task</button>

<script type="text/javascript">
  function compare()
{
  debugger;
    var strStartTime = document.getElementById("starttime").value;
    var strEndTime = document.getElementById("endtime").value;

    var startTime = new Date().setHours(GetHours(strStartTime), GetMinutes(strStartTime), 0);
    var endTime = new Date(startTime)
    endTime = endTime.setHours(GetHours(strEndTime), GetMinutes(strEndTime), 0);

    if(startTime > endTime)  {
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
  }
</script>
<script type="text/javascript">
  if($('#inputGroupSelect01').value != "ON Call - Project Management")
  {
    $('#ToTimeDiv').hide();
    $('#FromTimeDiv').hide();

  }
  $('#inputGroupSelect01').on('change' , function(){
    //alert(this.value);
    if(this.value == "ON Call - Project Management"){

      $('#ToTimeDiv').show();
      $('#FromTimeDiv').show();
    
    }
else{
  $('#ToTimeDiv').hide();
  $('#FromTimeDiv').hide(); 
  
}
});
</script>


</form>
</section>

<center>
<div class="col-md-8" >
	  <div class="tableFixHead" >

	<table >
    <thead style="border-radius:  30px 30px 0 0;">  
    <tr>    
          <!-- <th >ID</th>      -->
          <th >Date</th>
          <th >Start time </th>
          <th >End time </th>
          <th>Type</th>
          <th>evidence</th>
          <th>Customer Name </th>
          <th>order_num </th>
          <th >Notes </th>
      </tr>
</thead>
  <tbody id="logBoard" style="background-color:white;">
<?php
$this_year= date('Y');
$role_id = $_SESSION['role_id'];
$self = $_SESSION['id'];

$check_orders = sqlsrv_query( $con ,"SELECT top 55 * FROM create_task WHERE engineer_id= '$self' and cur_date >='$this_year' order by [creation_time] DESC");
while ($output_orders = sqlsrv_fetch_array($check_orders)) {

  $rows ="<tr>";
  $rows.= "<td class='hovers' style='display:none;'>".$output_orders['s_id']."</td>";
  $rows.= "<td class='hovers' style='width:20%;'>".$output_orders['cur_date']->format('Y-m-d')."</td>";
  $rows.= "<td class='hovers'>".$output_orders['stime']->format('H:i:s')."</td>";
  $rows.= "<td class='hovers'>".$output_orders['etime']->format('H:i:s')."</td>";
  $rows.= "<td class='hovers'>".$output_orders['type']."</td>";
  $rows.= "<td class='hovers'>".$output_orders['evidence']."</td>";
  $rows.= "<td class='hovers'>".$output_orders['customer_name']."</td>";
  $rows.= "<td class='hovers'>".$output_orders['Order_number']."</td>";
  $rows.= "<td class='hovers'>".$output_orders['notes']."</td>";
  $rows.="</tr>";
echo $rows;
}?>
</tbody>
</table>
</div>
</div>
</center>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="js/ajaxjquery.min.js"></script>

<script>
  
$(document).ready(function(){

  $('.submit').click(function(){
      var notes = $('.notes').val();
      var sType = $('.sType').val();
      var curdate = $('.cur_date').val();
      var stime = $('.stime').val();
      var etime = $('.etime').val();
      var Ordernumber = $('.Order_number').val();
      var customername= $('.customer_name').val();
      var evidence = $('.evidence').val();

  var dataString ='type='+sType+'&notes='+notes+'&cur_date='+curdate+
  '&etime='+etime+'&stime='+stime+'&Order_number='+Ordernumber+
  '&customer_name='+customername+'&evidence='+evidence;
if(sType == 0 || sType == ''){
  swal({ title: "*! Please Choose Type ", icon: "warning",});
}if(sType !== 0 && sType !== ''){
    $.ajax({
    url: 'ajax_tasks.php',
    type: 'POST',
    data:dataString,
    cache: false,
    success: function(data){ 
      //console.log(data);
      swal({ title: "Done ...:)", icon: "success",});
      $('#logBoard').html(data);
      $('.notes').val("");
      $('.sType').val("");
      $('.stime').val("");
      $('.etime').val("");
      $('.cur_date').val("");
    }, error: function(err){
          console.log(err);
        }
  });
    return false;
  }else{
      alert('empty date');    
    }
 });

});

</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<?php

 include ("footer.html");
 ?>
