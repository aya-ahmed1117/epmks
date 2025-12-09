

<?php
include ("pages.php");
$id = $_SESSION['id'];


if(($role_id == 1) || ($role_id == 0)){
if (isset($_GET['id'])) { $id = $_GET['id']; }
$check = sqlsrv_query( $con ,"SELECT * FROM [employee] where [id] = '$id'  ");
//$output = $check->fetch_array();
$output = sqlsrv_fetch_array($check );
$senior = $output['manager_id'];
$super = $output['super_id'];
$section_id = $output['section_id'];
//[[section_id]]
$username_id = $output['username_id'];
$orders_num = 1;}?>
<title>Create Swap</title>
  <link href="css/my_table.css" rel="stylesheet">
</head>

  <center>
  
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Swaping Request</h2>
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Swap Request : you can change your schedule with another college with a certain date</p>
  </aside>
</div>
</center>

<div>
   <section class="border p-4 d-flex justify-content-center mb-4">

<form method="post">
  <div class="row mb-4">

    <div class="col-md-4">
      <div class="input-group">
        <input type="text" id="form6Example1" name="username" class="form-control username" disabled value="<?php echo $s_username; ?>" />
        <label class="form-label" for="form6Example1"></label>
      </div>
    </div>

  <div class="col-md-8">
    <div class="input-group">
  <span class="input-group-text" id="dates basic-addon1">Start Date</span>
  <input type="date" class="form-control mydate" placeholder="From Date" aria-label="From Date" name="schedule_date" id="mydate" min="<?php $tomorrow = date("Y-m-d", strtotime("0 day"));
                  echo $tomorrow ; ?>"
  value='<?php if(isset($_POST['schedule_date'])) echo $_POST['schedule_date']; ?>'
    aria-describedby="basic-addon1" required/>
</div>
 </div>
  </div>

 
 
  <?php
       if(isset($_POST['schedule_date'])){$mydate = $_POST['schedule_date'];}
     
if(isset($_POST['schedule_date'])){
  $check = sqlsrv_query( $con ,"SELECT * FROM Sch_mode where schedule_date =
       '$mydate' and username = '$s_username' ");
$output = sqlsrv_fetch_array($check );
$orders_num = 1;
$shift_start = $output['shift_start'];
$shift_end = $output['shift_end'];
}?>

      <span class="input-group-text" style="width:40%;
     align: center;">Swap with</span>
  <!--div  class="input-group" >
<select name="swaper_name" style="padding: 8px; font-size:15px;width: 35%;" id="swaper_name" onchange="run()">
      <option id="resultColorValue"  value="0">Select</option--> 

      <div  class="input-group">
  <span class="input-group-text" >Users</span>
  <select onchange="run()" class="form-control swaper" name="swaper_name"  required="true" 
  value='<?php if(isset($_POST['swaper_name'])) echo $_POST['swaper_name']; ?>'>
  <option value="0" id="resultColorValue" selected>Choose User ...</option>
 
<?php
 if(isset($_POST['swaper_name'])){$swaper_name = $_POST['swaper_name'];}
if(($role_id == 1) || ($role_id == 0)){
$checks = sqlsrv_query( $con ,"SELECT * from  employee 
  where section_id = '$section_id' and username <> '$s_username' and role_id <> 2  ");
//while($outputs = $checks->fetch_array()){
  while($outputs = sqlsrv_fetch_array($checks)){
    $swaper_name= $outputs['username'];
        $rows = '<option';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
  echo $rows;
  $shift_start_swaper = $outputs['shift_start'];
  $shift_end_swaper = $outputs['shift_end'];
}} ?>

</select>
</div>
 <br> 

 <div class="col-md-6">
        <button  type="submit" name="search" 
        class="btn btn-primary btn-block mb-4 search">
      <i class="fa fa-search"></i> Search
    </button>
    </div>

<br>
<script type="text/javascript">
  function run() {
    document.getElementById("resultColorValue").innerHTML = document.getElementById("swaper_name").value;
}
</script>
<?php if(isset($_POST['search'])){
 // if(isset($_POST['schedule_date'])){
$mydate = $_POST['schedule_date'];
// session
 if(isset($_POST['schedule_date'])){$mydate = $_POST['schedule_date'];}
if(isset($_POST['swaper_name'])){$swaper_name = $_POST['swaper_name'];}


$engineers_id = $_SESSION['id'];
$s_username = $_SESSION['username'];
$check = sqlsrv_query( $con ,"SELECT * FROM [employee] 
  where [id] = '$engineers_id'  ");
$output = sqlsrv_fetch_array($check );
$senior = $output['manager_id'];
$super = $output['super_id'];
$section_id = $output['section_id'];
$username_id = $output['username_id'];

  $check = sqlsrv_query( $con ,"SELECT * FROM Sch_mode where schedule_date =
       '$mydate' and username = '$s_username' ");
$output = sqlsrv_fetch_array($check );
$shift_start = $output['shift_start'];
$shift_end = $output['shift_end'];

  echo'<div class="col-md-5">

 <table class="refresh">
  <thead >
  <tr>
          <th> engineer_id</th>
          <th> Username</th>
          <th> Shift_start</th>
          <th> Shift_end</th>
          <th> Day</th>
       </tr>
          </thead>
          <tbody id="self_swap">';  
  $check = sqlsrv_query( $con ,"SELECT * FROM Sch_mode where schedule_date = '$mydate' and username = '$s_username' ");
$output = sqlsrv_fetch_array($check );
$rows  ='<tr>';
$rows .='<td class="hovers">'.$output["engineer_id"].'</td>';
$rows .='<td class="hovers">'.$output["username"].'</td>';
$rows .='<td class="hovers">'.$output["shift_start"].'</td>';
$rows .='<td class="hovers">'.$output["shift_end"].'</td>';
$rows .='<td class="hovers">'.$mydate.'</td>';
$rows  .='</tr>';
echo $rows;
echo '</tbody>
</table>
</div>';

  echo'<br>
<div class="col-md-4">
 <table class="refresh">
  <thead>
      <tr>
          <th> engineer_id</th>
          <th> Username</th>
          <th> Shift_start</th>
          <th> Shift_end</th>
          <th> Day</th>
        </tr>
          </thead>
          <tbody id="swaper_table">';

  $schedule = sqlsrv_query($con , "SELECT  * FROM [Aya_Web_APP].[dbo].[Sch_mode] where username = 
    '$swaper_name'
   and schedule_date = '$mydate' ");
  $output_query = sqlsrv_fetch_array($schedule);   
$rows ='<tr>';
$rows .='<td class="hovers">'.$output_query["engineer_id"].'</td>';
$rows .='<td class="hovers">'.$output_query["username"].'</td>';
$rows .='<td class="hovers">'.$output_query["shift_start"].'</td>';
$rows .='<td class="hovers">'.$output_query["shift_end"].'</td>';
$rows .='<td class="hovers">'.$mydate.'</td>';
$rows  .='</tr>';
 echo $rows;
echo '</tbody>
</table>
</div>';

 echo'<center>
 <div class="message">
    <label for="message" class="h4 ">Message</label>
    <textarea id="message" name="reason" class="form-control reason" rows="5" placeholder="Enter your message" ></textarea>
  </div>
  <br>
  <br>
<button class="btn btn-warning save" data-sshift_end="'.$output['shift_end'].'" 
data-s_senior="'.$output['senior'].'"  data-sshift_start="'.$output['shift_start'].'" data-swaper_name="'.$output_query["username"].'" data-shift_start="'.$output_query["shift_start"].'" data-shift_end="'.$output_query["shift_end"].'" data-schedule_date="'.$mydate.'" data-swaper_manager="'.$output_query["senior"].'" data-engineer_id = "'.$output_query["engineer_id"].'"

  style="width: 30%;padding: 10px; color: #fff;font-size: 15px; border-radius: 20px 20px 20px 20px;">Swap</button>';
}?>

<br>
<?php
/*
 if(isset($_POST['save'])){

if(isset($_POST['swaper_name'])){
$swaper_name = $_POST['swaper_name'];

  $schedules = sqlsrv_query($con , "SELECT  * FROM [Aya_Web_APP].[dbo].[Sch_mode] where username = '$swaper_name'
   and schedule_date = '$mydate' ");
     $output_query = sqlsrv_fetch_array($schedules);
        $echo_user = $output_query["username"];
        $echo_engineer_id = $output_query["engineer_id"];
        $echo_shift_start = $output_query["shift_start"];
        $echo_shift_end = $output_query["shift_end"];
        $echo_senior = $output_query["senior"];
    }
  // ely taleb el swap 
  if(isset($_POST['user_covering_shift_start'])){$shift_start = $_POST['user_covering_shift_start'];}
  if(isset($_POST['user_covering_shift_end'])){$shift_end = $_POST['user_covering_shift_end'];}
 
  $escaped_str = $_POST['reason'];
 //addslashes($notes) ;
 $reason = str_replace("'", "''", $escaped_str);

$status = 'test';
$sqltime = date ("Y-m-d H:i:s");
$engineers_id =$_SESSION['id'];
$covering_date_from = $_POST['schedule_date'];
$swaper_date_from = $_POST['schedule_date'];

$check = sqlsrv_query( $con ,"SELECT * FROM [employee] where [id] = '$engineers_id'  ");
$output = sqlsrv_fetch_array($check );
    $senior = $output['manager_id'];
    //sqlsrv_query( $con ,
$insert_query =sqlsrv_query( $con , "INSERT INTO swaping 
  ([username] , [engineer_id] ,[user_covering_date_from] , [user_covering_shift_start] ,

 [user_covering_shift_end],[user_manager] ,[engineer_id_swaper] , [swaper_name] , 
 [swaper_date_from],[swaper_shift_start],[swaper_shift_end],
 [swaper_manager], [reason], [status] ,[creation_time] ) 


 VALUES ('$s_username','$engineers_id','$covering_date_from',
 '$shift_start','$shift_end','$senior','$echo_engineer_id','$echo_user',
  '$swaper_date_from','$echo_shift_start','$echo_shift_end',
  '$echo_senior','$reason','$status','$sqltime')" );

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

</form>
</section>
</div>
<script src="js/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 <script type="text/javascript">
 /*   
$(document).ready(function(){

  
$(".save").click(function(){
  var swaper = $('.swaper').val();
  var mydate = $('.mydate').val();
  var reason = $('.reason').val();
  var dataString ='swaper_name='+swaper+'&schedule_date='+mydate+'&reason='+reason;

  if(mydate !== ""){
    $.ajax({
      type:"POST", 
      url:"ajax_swap.php",
      data: dataString,
      cache: false,
      success: function(data){
        console.log(dataString);
        $('#self_swap').html(data);
        $('#swaper_table').html(data);
        $('#tables').html(data);
          },
          error: function(err){
            console.log(err);
          }
       });

       return false;  
  }else{
    alert('empty date');    
  }
    });
});*/

  $(".save").dblclick(function(e){
    e.preventDefault();
  });

$(document).ready(function(){

  $(".save").click(function(){
    var swaper_name = $(this).data('swaper_name');  
    var s_shift_start = $(this).data('sshift_start');
    var s_shift_end = $(this).data('sshift_end');
    var shift_start = $(this).data('shift_start');
    var shift_end = $(this).data('shift_end');
    var mydate = $(this).data('schedule_date');
    var swaper_manager = $(this).data('swaper_manager');
    var engineer_id_swaper = $(this).data('engineer_id');
    var s_senior = $(this).data('s_senior');
    var reason = $(".reason").val();

    var dataString ='swaper_name='+swaper_name+'&user_covering_date_from='+mydate+'&swaper_date_from='+mydate+'&reason='+reason+'&swaper_manager='+swaper_manager+'&swaper_shift_start='+shift_start+'&swaper_shift_end='+shift_end+'&user_covering_shift_start='+s_shift_start+'&user_covering_shift_end='+s_shift_end+'&user_manager='+s_senior+'&engineer_id_swaper='+engineer_id_swaper;

      if(swaper_name !== "") {
    $.ajax({
      type:"POST", 
      url:"test_ajax_swap.php",
      data: dataString,
      cache: false,
      success: function(data){
       swal({ title: "Done ...:)", icon: "success",});
            console.log(dataString);
        $(".refresh").hide();
        $(".message").hide();
        $(".save").hide();

        $('.swaper').val("");
        $('.mydate').val("");
        $('.reason').val(""); 
      },

      error: function(err){
        console.log(err);
      }
    });
return false;
    }else{
    alert('empty data');    
  }
 });

});

</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script type="text/javascript">
  /*
  setTimeout(function() {
  document.getElementById("message").style.display = 'none';
}, 1900);*/
</script>

<?php

 include ("footer.html");
 ?>
