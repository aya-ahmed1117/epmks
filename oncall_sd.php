<html>

 
 <?php
        require_once("inc/config.inc");
        
  if($_SESSION['username'] == ''){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }

      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
   
   $from_date="";
        $week_num="";
        $Units ="";
        $Group_name="";
        $groups = "";
        $units="";
?>

<head>
  <title>ON Call SD</title>

 <link rel="stylesheet" id="wp-block-library-css" href="https://mdbootstrap.com/wp-includes/css/dist/block-library/style.min.css?ver=5.2.3" type="text/css" media="all">
<link rel="stylesheet" id="wc-block-style-css" href="https://mdbootstrap.com/wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/style.css?ver=2.3.0" type="text/css" media="all">
<link rel="stylesheet" id="contact-form-7-css" href="https://mdbootstrap.com/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=5.1.4" type="text/css" media="all">
<style id="woocommerce-inline-inline-css" type="text/css">
.woocommerce form .form-row .required { visibility: visible; }
</style>
<link rel="stylesheet" id="wsl-widget-css" href="https://mdbootstrap.com/wp-content/plugins/wordpress-social-login/assets/css/style.css?ver=5.2.3" type="text/css" media="all">
<link rel="stylesheet" id="compiled.css-css" href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/css/compiled-4.8.10.min.css?ver=4.8.10" type="text/css" media="all">
 
<noscript>
  <style>.woocommerce-product-gallery{ opacity: 1 !important; }</style></noscript>
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
      <script src="js/jquery-1.12.4.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
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


    <style type="text/css">
    /*.ui-widget-content {
    border: 1px solid #d9d6c4;
    background: #eceadf url(images/ui-bg_fine-grain_10_eceadf_60x60.png) 50% 50% repeat;
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
}*/
    </style>

    <?php
   
$unit = $_SESSION['Unit_Name'];
$checkme = sqlsrv_query( $con ,"SELECT  DISTINCT [Unit_Name]
  FROM [Aya_Web_APP].[dbo].[employee]
  where Unit_Name in 
  ( 'Enterprise Service Desk','Enterprise Support Systems',
  'Problem Management and Service Optimization' , 'Quality Management and Training' ,'Workforce Management') and id = '$self' ");
  $output = sqlsrv_fetch_array($checkme );
  $Unit_Name = $output['Unit_Name'];
// 12 13 14 15 16 17
if ($unit !== $Unit_Name ){
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

if ($unit == $Unit_Name ){

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
  <div class="input"> 
    <h2 style="display: none;"><label name="username" style="color: black ;display: none; ">User name : <?php echo $_SESSION['username']; ?></label></h2>
    <strong>
       <input enable="false" class="nav-link disabled" tabindex="-1" type="text" name="engineer_id" style="display: none;" value="<?php echo $_SESSION['username']; ?>"></input></strong>

      <h3 style="color: #6b5b95;float: left;padding-right: 80px;min-width: 25px;font-style: normal; font-family: Century Gothic;">
       <label> Choose multiple days </label></h3>
       <form name="select-multiple" >
  <input id="multiple-date-select" autocomplete="off" type="text" name="days" class="form-control" readonly="true"   required style="width:30%;margin-left:28%;" 
  onclick="function(select)" />

</form>
<!--table id="table-data" border="1"></table!-->
<br>
<div class="col-md-8">
  <div>
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
$check_orders = sqlsrv_query( $con ,"SELECT top 40 * FROM oncall_sd WHERE engineer_id= '$self' order by [creation_time] DESC");
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
</script>
<script type="text/javascript">
     $('#multiple-date-select').on('click', function(select) {
show('#ui-datepicker-title');
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
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
     <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>

 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="js/ajaxjquery.min.js"></script>
   <script>
$(document).ready(function(){
  $('.days').keypress(function(e) {
    e.preventDefault();
});
  $('.submit').click(function(){
      var notes = $('.note').val();
      var days = $('.days').val();
      var year = $('.year').val();
      var month = $('.month').val();
      var table =$('.data').val();

     var dataString ='note='+notes+'&year='+year+'&month='+month+'&days='+days;

     if(month == ''){
            swal({ title: "*! Please Select month", icon: "warning",});
        }
        else{
    $.ajax({
    url: 'ajax_onCall.php',
    type: 'POST',
    data:dataString,
    cache: false,
    success: function(data){ 
      swal({ title: "Done ... :)", icon: "success",});
      $('#logBoard').html(data);
        $('.note').val("");
        $('.days').val("");
        $('.month').val("");
        $('.data').val("");

      }, error: function(err){
          console.log(err);
        }
 });
    return false;
  }
 });

});

</script>


</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
  
</script>
 

<?php
 //include ("footer.html");
}//}
 ?>