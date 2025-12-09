

<html>

 
 <?php
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
$checkme = sqlsrv_query( $con ,"SELECT  DISTINCT [Unit_Name]
  FROM [Aya_Web_APP].[dbo].[employee]
  where Unit_Name in 
  ( 'Enterprise Service Desk','Enterprise Support Systems','Onsite Problem Management',
  'Problem Management and Service Optimization' , 'Quality Management and Training' ,'Workforce Management') and id = '$self' ");
  $output = sqlsrv_fetch_array($checkme );
   $Unit_Name = $output['Unit_Name'];


if ($unit == $Unit_Name ){

header('location: errorpage.php');
 //"PHP continues.\n";
die();
 //"Not after a die, however.\n";
}
?>
<head>
  <title>ON Call SD</title>

<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.js"></script>
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
       color:white;">0.....0</p>
  </aside>
</div>
</center>
<center>
<section >
 
<form method="POST" >

    <div class="container">

  <div class="col-md-8">
    <div class="input-group md-2">
    <span class="input-group-text" id="basic-addon1">Choose multiple days </span>
<form name="select-multiple" >
  <div style="" id="multiple-date-select" autocomplete="off" name="days" class="form-control days"   required  ></div> 
  <table id="table-data"></table>
</form>
</div>
<br>
  <div >
   <div class="input-group">	
  <!--select class="browser-default custom-select"-->
  <span class="input-group-text" id="basic-addon1">Choose Month</span>
  <select name="month" id="month" class="form-control month"     required>
  <option action="none" value="0" selected>Select Month....</option>
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
 <option value="2021" selected="selected">2021</option>
<option value="2022" disabled="true">2022</option>
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
  <div class="col-sm-6">
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
  <tbody id="logBoard">
<?php

$role_id = $_SESSION['role_id'];
$self = $_SESSION['id'];
$check_orders = sqlsrv_query( $con ,"SELECT top 10 * FROM oncall_sd WHERE engineer_id= '$self' order by [creation_time] DESC");
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
     $("input[type=text]").datepicker({
  dateFormat: 'dd-mm-yy',
  onSelect: function(dateText, inst) {
    $(inst).val(dateText); // Write the value in the input
  }
});

// Code below to avoid the classic date-picker
$("input[type=date]").on('click', function() {
  return false;
});

var arr = [];

function removeRow(r) {
  var index = arr.indexOf(r);
  if (index > -1) {
    arr.splice(index, 1);
  }
}
$('#multiple-date-select').multiDatesPicker({
  onSelect: function(datetext) {
    let table = $('#table-data');
    let rowLast = table.data('lastrow');
    let rowNext = rowLast + 1;
    let r = table.find('tr').filter(function() {
      return ($(this).data('date') == datetext);
    }).eq(0);
    // a little redundant checking both here 
    if (!!r.length && arr.includes(datetext)) {
      removeRow(datetext);
      r.remove();
    } else {
      // not found so add it
      let col = $('<td></td>').html(datetext);
      let row = $('<tr></tr>');
      row.data('date', datetext);
      row.attr('id', 'newrow' + rowNext);
      row.append(col).appendTo(table);
      table.data('lastrow', rowNext);
      arr.push(datetext);
    }
  }
});
// set start, first row will be 0 could be in markup
$('#table-data').data('lastrow', -1); 
 </script>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="js/ajaxjquery.min.js"></script>
   <script>
$(document).ready(function(){
  $('.submit').click(function(){
      var notes = $('.note').val();
      var days = $('.days').val();
      var year = $('.year').val();
      var month = $('.month').val();
      var table =$('#table-data').val();

     var dataString ='note='+notes+'&year='+year+'&month='+month+'&days='+days;
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
        $('#table-data').val("");

      }, error: function(err){
          console.log(err);
        }
 });
    return false;
 });

});

</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 

<?php
 include ("footer.html");
 ?>

<!--

<html>

 
 <?php
 /*
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
$checkme = sqlsrv_query( $con ,"SELECT  DISTINCT [Unit_Name]
  FROM [Aya_Web_APP].[dbo].[employee]
  where Unit_Name in 
  ( 'Enterprise Service Desk','Enterprise Support Systems','Onsite Problem Management',
  'Problem Management and Service Optimization' , 'Quality Management and Training' ,'Workforce Management') and id = '$self' ");
  $output = sqlsrv_fetch_array($checkme );
   $Unit_Name = $output['Unit_Name'];


if ($unit == $Unit_Name ){

header('location: errorpage.php');
 //"PHP continues.\n";
die();
 //"Not after a die, however.\n";
}*/
?>
<head>
  <title>ON Call SD</title>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.js"></script>

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
       color:white;">0.....0</p>
  </aside>
</div>
</center>
<center>
<section >
 
<form method="POST" >
  <div class="col-md-8">

   <div class="input-group md-2">
        <span class="input-group-text" id="basic-addon1">Choose multiple days </span>
    <form name="select-multiple">
  <input id="multiple-date-select" autocomplete="off" type="text" name="days" class="form-control"  required  />
</form>
</div>
<br>
  <div >
   <div class="input-group">  
  <-select class="browser-default custom-select"->
  <span class="input-group-text" id="basic-addon1">Choose Month</span>
  <select name="month" id="month" class="form-control sType" required="true">
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
  <select name="year" id="year" class="form-control sType" required>
    <option action="none" value="0" selected>Select Year....</option>
 <option value="2021" selected="selected">2021</option>
<option value="2022" disabled="true">2022</option>
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
<?php
/*
if(isset($_POST['send'])){
 $engineer_id = $_SESSION['id'];
  $s_username = $_SESSION['username'];
  $type = "ON-Call";
  $status = "pending";
   $escaped = $_POST['note'];
   $notes = str_replace("'", "''", $escaped); 

  if(isset($_POST['year'])){$year = $_POST['year'];}
  if(isset($_POST['month'])){$month = $_POST['month'];}
  if(isset($_POST['days'])){$days = $_POST['days'];}

 $sqltime = date ("Y-m-d H:i:s");  
//[creation_time]
  $insert_query = sqlsrv_query( $con ,"INSERT INTO oncall_sd 
    ([username],[engineer_id],[type],[days],[month],[year],[status],[note],[creation_time] ) 

    VALUES ('$s_username','$engineer_id','$type','$days','$month','$year','$status' ,'$notes','$sqltime' )");

  if($insert_query){
 echo '<script> window.onload = function() 
 {
  swal({
    title: "Done",
  icon: "success",});
 }; 
 </script>';
 }

  }*/
?>
</div>

</form>
</section>
</center>
<br>
<center>
  <div class="col-sm-6" id="logBoard">
  <div class="tableFixHead" >

 <table style="border-radius: 30px 30px 0 0;">
    <thead >           
          <th >Type</th>
          <th>Days</th>
          <th>month</th>
          <th>year</th>
          <th >creation time</th>
          <th >Notes </th>
          <th >status </th>
</thead>
  <tbody>
<?php
/*
$role_id = $_SESSION['role_id'];
$self = $_SESSION['id'];

$check_orders = sqlsrv_query( $con ,"SELECT top 10 * FROM oncall_sd WHERE engineer_id= '$self' order by [creation_time] DESC");
while ($output_orders = sqlsrv_fetch_array($check_orders)) {

  $rows ="<tr>";
  $rows.= '<td class="hovers">'.$output_orders['type'].'</td>';
  $rows.= '<td class="hovers"style="color:orange;">'.$output_orders['days'].'</td>';
  $rows.= '<td class="hovers" style="color:orange;">'.$output_orders['month'].'</td>';
  $rows.= '<td class="hovers">'.$output_orders['year'].'</td>';
  $rows.= '<td class="hovers">'.$output_orders['creation_time']->format('Y-m-d H:i:s').'</td>';
  $rows.= '<td class="hovers">'.$output_orders['note'].'</td>';
  $rows.= '<td class="hovers">'.$output_orders['status'].'</td>';
  $rows.="</tr>";
 echo $rows;
}*/?>

</tbody>
</table>
</div>
</div>
</center>



<script type="text/javascript">
     $("input[type=text]").datepicker({
  dateFormat: 'dd-mm-yy',
  onSelect: function(dateText, inst) {
    $(inst).val(dateText); // Write the value in the input
  }
});

// Code below to avoid the classic date-picker
$("input[type=date]").on('click', function() {
  return false;
});

var arr = [];

function removeRow(r) {
  var index = arr.indexOf(r);
  if (index > -1) {
    arr.splice(index, 1);
  }
}
$('#multiple-date-select').multiDatesPicker({
  onSelect: function(datetext) {
    let table = $('#table-data');
    let rowLast = table.data('lastrow');
    let rowNext = rowLast + 1;
    let r = table.find('tr').filter(function() {
      return ($(this).data('date') == datetext);
    }).eq(0);
    // a little redundant checking both here 
    if (!!r.length && arr.includes(datetext)) {
      removeRow(datetext);
      r.remove();
    } else {
      // not found so add it
      let col = $('<td></td>').html(datetext);
      let row = $('<tr></tr>');
      row.data('date', datetext);
      row.attr('id', 'newrow' + rowNext);
      row.append(col).appendTo(table);
      table.data('lastrow', rowNext);
      arr.push(datetext);
    }
  }
});
// set start, first row will be 0 could be in markup
$('#table-data').data('lastrow', -1); 
</script> 

-->