
<?php
include ("pages.php");
$engineers_id = $_SESSION['id'];
$s_username = $_SESSION['username'];

 if(isset($_POST['swaper_name'])){$swaper_name = $_POST['swaper_name'];}
if(isset($_POST['schedule_date'])){$mydate = $_POST['schedule_date'];}


if(($role_id == 1) || ($role_id == 0)){
$check = sqlsrv_query( $con ,"SELECT * FROM [employee] 
	where [id] = '$engineers_id'  ");
$output = sqlsrv_fetch_array($check );
$senior = $output['manager_id'];
$super = $output['super_id'];
$section_id = $output['section_id'];
//[[section_id]]
$username_id = $output['username_id'];
$orders_num = 1;}
?>
<title>swap</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
              <h2 class="text-dark display-12" >Create Swap</h2>
              <p style="color:lightgray;">Hi : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;
       font-size:16px; color:white;">&#9888; Please be sure to click (SEARCH) button after choosing any member and check the below schedule .</p>
  </aside>
</div>
</center>
<div>
   <section class="border p-4 d-flex justify-content-center mb-4">
<form >
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
  <input type="date" class="form-control mydate" placeholder="From Date" aria-label="From Date" name="schedule_date" id="mydate"
  value='<?php if(isset($_POST['schedule_date'])) echo $_POST['schedule_date']; ?>'
    aria-describedby="basic-addon1" required/>
</div>
 </div>
  </div>

 
  <?php
  /*
 if(isset($_POST['schedule_date'])){
  $check = sqlsrv_query( $con ,"SELECT * FROM Sch_mode where schedule_date ='$mydate' and username = '$s_username' ");
$output = sqlsrv_fetch_array($check );
$orders_num = 1;
$shift_start = $output['shift_start'];
$shift_end = $output['shift_end'];
}*/?>
       <span class="input-group-text" style="width:40%;
     align: center;">Swap with</span>
  <div  class="input-group">
  <span class="input-group-text" >Users</span>
  <select class="form-control swaper" name="swaper_name" id="inputGroupSelect01"  required="true">
	<option value="0" onchange="run()" id="resultColorValue" selected>Choose User ...</option>
<?php

//onchange="run()" 

if(($role_id == 1) || ($role_id == 0)){
$checks = sqlsrv_query( $con ,"SELECT * from  employee 
  where section_id = '$section_id' and username <> '$s_username' and role_id <> 2  ");
  while($outputs = sqlsrv_fetch_array($checks)){
        $rows = '<option';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
  echo $rows; 
}}
?>
</select>
</div>
<script type="text/javascript">
  function run() {
    document.getElementById("resultColorValue").innerHTML = document.getElementById("swaper_name").value;
}
</script>
 <br> 

 <div class="col-md-6">

        <button name="search"  
        class="btn btn-primary btn-block mb-4 search">
      <i class="fa fa-search"></i> Search
    </button>
    </div>


<br>

 <div id="tables"  class="row">

  <div class="col-md-6">
 <table >
  
          <tbody id="self_swap">
</tbody>
</table>
</div>

  <div class="col-md-6">
 <table >
    <tbody  id="swaper_table">
   
</tbody>
</table>

</div>
 </div>



</form>
</section>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 <script type="text/javascript">
   	
$(document).ready(function(){

  
$(".search").click(function(){
  var swaper = $('.swaper').val();
  var mydate = $('.mydate').val();
  var reason = $('.reason').val();
  var dataString ='swaper_name='+swaper+'&schedule_date='+mydate;

  if(mydate !== ""){
  	$.ajax({
      type:"POST", 
      url:"test_swap.php",
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
});
</script>

   <?php
 include ("footer.html");
 ?>