

    <?php 
    include ("pages.php");
    //if($_SESSION['username'] !=='amani.ahmed'){
//if(isset($_GET['engineer_id'])){  $engineer_id = $_GET['engineer_id'];}  
?>
   <title>update demo</title>
   <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php if(isset($_GET['id'])){ ?>
<?php
if (isset($_GET['id'])) { $id = $_GET['id']; }

$s_username = $_SESSION['username'];
  if(isset($_POST['username'])){$username = $_POST['username'];}
 $checks = sqlsrv_query($con,"SELECT [id]
      ,[engineer_id]
      ,[username]
      ,[shift_start]
      ,[shift_end]
      ,[schedule_date]
      ,[senior]
      ,[super]
      ,[section]
      ,[creator_name]
      ,[creation_times] FROM [schedule_table] where  id = '$id' ");
//$output = $check->fetch_array();
$output = sqlsrv_fetch_array($checks);
  $creator_name=$output['creator_name'];
  $creation_times=$output['creation_times'];
  if ($creation_times == NULL){$creation_times=$output['creation_times'];}
  if ($output['creation_times'] != NULL){$creation_times=$output['creation_times']->format('Y-m-d H:i:s');}
?>
<div class="container">
  <form method="post" >
    <input enable="false"style="display: none;" class="nav-link disabled" tabindex="-1" type="text" name="engineer_id"  value="<?php echo $_SESSION['username']; ?>"></input>
      <input type="text"style="display: none;" name="demo_id" class="nav-link disabled" tabindex="-1" value="<?php if(isset($_GET['id'])){echo $_GET['id'] ;} ?>">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
             <div class="col-sm-8"><h2>Update <b>Schedule</b></h2></div>  
                </div>
            </div>

<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
        <th>ID</th>
        <th>Engineer</th>
        <th>Shift start</th>
        <th>Shift end</th>
        <th>Date</th>
        <th>Senior</th>
        <th>super</th>
        <th>Section</th>
        </tr>
    </thead>
    <tbody>
    <tr style="width:125%;">
<td ><input type="text"  class="form-control" disabled="true" value="<?php echo $output["id"];?>"></input></td>
<td><input type="text" name="username" readonly="true" class="form-control"  value="<?php echo $output["username"];?>"></input></td>
<td><input type="text"class="form-control" name="shift_start" value="<?php echo $output["shift_start"];?>"></input></td>
<td><input type="text"class="form-control" name="shift_end" value="<?php echo $output["shift_end"];?>"></input></td>
<td><input type="text"class="form-control" name="schedule_date" value="<?php echo $output["schedule_date"]->format('Y-m-d');?>"></input> </td>
<td  ><input type="text" class="form-control" readonly="true" name="senior" value="<?php echo $output["senior"];?>" ></input> </td>
<td ><input type="text" class="form-control" readonly="true" name="super"  value="<?php echo $output["super"];?>"></input></td>
<td ><input type="text" class="form-control" readonly="true" name="section" value="<?php echo $output["section"];?>"></input> </td>
                   
</tr>     
  </tbody>
  
</table>
<input type="hidden" class="form-control id" name="opr" value="update" ></input>
<div class="col-sm-4">
<input type="submit" class="btn btn-info add-new" name="send"  />
 
 <?php
 if(isset($_GET['engineer_id'])){$engineer_ids = $_GET['engineer_id'];}
    $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_ids'  ");
  while ($output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $check_orders = sqlsrv_query($con , "SELECT * FROM schedule_table 
    WHERE engineer_id = '$engineers_id' and [schedule_date] >='2025-01-01' ");
    $orders_num = 1;
      }
      ?>

          </div>
        </div>
    </div>

<?php
}
if(isset($_POST['send'])){ 
  $id = $_POST['demo_id'];
  if(isset($_POST['shift_start'])){$shift_start = $_POST['shift_start'];}
 if(isset($_POST['shift_end'])){$shift_end = $_POST['shift_end'];}
 if(isset($_POST['senior'])){$senior = $_POST['senior'];}
 if(isset($_POST['super'])){$super = $_POST['super'];}
 if(isset($_POST['section'])){$section = $_POST['section'];}

 if(isset($_POST['note'])){$note = $_POST['note'];}

 if(isset($_POST['username'])){$username_post = $_POST['username'];}
$sqltime = date ("Y-m-d H:i:s");

$engineer_id = $_SESSION['id'];
$user = $_SESSION['username'];
$update_query = sqlsrv_query($con ,"UPDATE schedule_table SET 
  [shift_start] = '$shift_start' , 
  [shift_end] = '$shift_end' , [senior] = '$senior' , [super] ='$super'
  ,[section]='$section'
  ,[creator_name]='$s_username'
      ,[creation_times] ='$sqltime'
  WHERE id = '$id' 
  and username = '$username_post' " );
  
if($update_query){
    echo '<script>
    swal({
    title: "The Update action is done &#10004;",
  icon: "success",
  })
     </script>';}
     else{ echo 'error';}
}

?> 
</form>
</div>
<?php if(isset($_GET['id'])){ ?>
  <?php
     if (isset($_GET['id'])) { $id = $_GET['id']; }

$s_username = $_SESSION['username'];
  if(isset($_POST['username'])){$username = $_POST['username'];}

$checks = sqlsrv_query( $con ,"SELECT * FROM [schedule_table] where id = '$id' ");
//$output = $check->fetch_array();
$output = sqlsrv_fetch_array($checks);
$orders_num = 1;
?>
  <div>
    <h3 style='background-color:white; color:black; text-align: center ; border-radius: 0px 20px;
 border: 5px solid ; margin: 0px auto;padding-top: 20%;
   width: 70%; padding-top:5px; padding-left: 3px; padding-bottom: 120px;display: none; '>
<form method="post"style="display: none;"  style="display: none;">
 
   <input style="display: none;" type="text" name="username"  value="<?php echo $_SESSION['username']; ?>"></input>
  <input type="text" name="demo_id" style="display: none;" value="<?php if(isset($_GET['id'])){echo $_GET['id'] ;} 
?>">
<input type="text"style="display: none;"name="username"value="<?php echo $output['username']; ?>"/>
<input type="text"style="display: none;"name="engineer_id"value="<?php echo $output['engineer_id']; ?>"/>
<input type="text"style="display: none;"name="shift_start"value="<?php echo $output['shift_start']; ?>"/>
<input type="text" style="display: none;"name="shift_end"value="<?php echo $output['shift_end']; ?>"/>
<input type="date" style="display: none;"name="schedule_date"value="<?php echo $output["schedule_date"]->format('Y-m-d'); ?>"/>
<input  type="text"class="nav-link disabled" tabindex="-1" name="shift_start"  value="<?php echo $output['shift_start'];?>"/>
<input type="text"class="nav-link disabled" tabindex="-1" name="shift_end"value="<?php echo $output['shift_end']; ?>"/></h3>
<hr>
<?php
}
if(isset($_POST['opr']) != 'update')
{
if(isset($_GET['id'])){
//if(isset($_GET['insert'])){
$demo_id = $_GET['id'];
$s_username = $_SESSION['username'];
    if(isset($output['username'])){$username = $output['username'];}
    if(isset($output['id'])){$schedule_id = $output['id'];}
    if(isset($output['engineer_id'])){$schedule_engineer_id = $output['engineer_id'];}
    if(isset($output['shift_start'])){$shift_start =$output['shift_start'];}
    if(isset($output['shift_end'])){$shift_end = $output['shift_end'];}
    if(isset($output['schedule_date'])){$schedule_date = $output['schedule_date']->format('Y-m-d');}
    if(isset($output['note'])){$note = $output['note'];}
    if(isset($output['senior'])){$senior = $output['senior'];}
    if(isset($output['super'])){$super = $output['super'];}
    if(isset($output['section'])){$section = $output['section'];}


  $creator_id=$_SESSION['id'];
$sqltime = date ("Y-m-d H:i:s");

//update_demo
$insert_query = sqlsrv_query( $con ,"INSERT INTO [schedule_demo]
  ([id_schedule], [engineer_id],[username],[shift_start],[shift_end],[schedule_date]
      ,[senior],[super],[section],[creator_id],[creator_name],[creation_time],[note] )
      VALUES
  ('$demo_id','$schedule_engineer_id','$username','$shift_start','$shift_end','$schedule_date','$senior','$super','$section','$creator_id','$creator_name','$creation_times','update_demo')");



  if($insert_query){
echo '<script>
    swal({
    title: "Done insert_query ",
  icon: "success",
  })
     </script>'; }

  else{ echo '<h4 style="color:red;background-color:black;font-size:30px;">ERRORRRRRRRR</h4>';}

}
}
?>

<?php 
$self = $_SESSION['id'];

if(isset($_GET['engineer_id'])){
  $engineer_ids = $_GET['engineer_id'];
}
if($_SESSION['role_id'] == 1)
{
 ?>
<div style="padding:20px;">

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Update schedule
      <a href="schedule_update.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">0000</p>
    </aside>
  </div>
</center>
<br>
<center>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
    <form  method="post" >
<div class="tableFixHead">

<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
    <th >ID</th>
    <th>Engineer</th>
    <th>Username</th>
    <th>Shift start</th>
    <th>Shift end</th>
    <th>Date</th>
    <th >Senior</th>
    <th>super</th>
    <th>Update</th>
</tr>
  </thead>
 <tbody>
    <?php

$engineer_ids = $_GET['engineer_id'];

$check_engineers  = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_ids'   ");
// echo "SELECT * FROM employee WHERE id ='$engineer_ids'   ";
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'] ;
}
$first_query = sqlsrv_query( $con ,"SELECT [id]
,[engineer_id]
      ,[username]
      ,[shift_start]
      ,[shift_end]
      ,[schedule_date]
      ,[senior]
      ,[super]
      ,[section]  FROM schedule_table WHERE username ='$eng_username' 
  and [schedule_date] >='2025-01-01' order by 6");
   while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  =   '<tr>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["id"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["engineer_id"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["username"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["shift_start"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["shift_end"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["schedule_date"]->format('Y-m-d').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["senior"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["super"].'</td>';
//$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["section"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;" name="insert" ><a type="submit" class="btn btn-info"
  href="?id='.$output_query["id"].'&engineer_id='.$engineer_ids.'" >Update</a></td>';
$rows .=   '</tr>';
  echo $rows;
}
}
?>

</tbody>
</table>
</div>
</form>
</center>
</div>


<script type="text/javascript">
  /*public function getCreated() {
return $yourarray->created->date;
 }

public function getid(){
   return $yourarray->id
}*/
</script>


<script>
    /*
  function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
    $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }
  if(is_ajax_request()){
    echo "ajax response";
   }else{
    echo "non ajax";
   }*/
   </script>
   <script>
    /*
    function  schedule_insert()
{
var msg = $('#msg_txt').val();
$.ajax({
    method:"POST", 
    url:"update_demo.php", 
     data:{send:true, message:msg}, 
   success:function(data)
   {   
   //console.log('success'); 
    $('#msg_txt').val("");
    updateChatBox();
   }
  });
}

function updateChatBox(){
  $.ajax({
    url:'update_demo.php?engineer_id='+engineer_id ,
    method:"GET",   
   success:function(data)
   {   
   
    $('#ChatBox').html(data);
   }
  });
 }

  var url_string = window.location.href ;
var url = new URL(url_string);
var engineer_id = url.searchParams.get("engineer_id");
  $(function(){
setInterval(updateChatBox,3000);
  })
*/
</script>
<?php
 //}
 include ("footer.html");
 ?>