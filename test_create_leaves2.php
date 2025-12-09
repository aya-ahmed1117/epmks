
<?php
include ("pages.php");

      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      ?>
    <title>Create Leaves</title>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/my_table.css">

</head>
 
<style> 

tr:nth-child(even) {
  background-color: lightgray;
}

.overlay:before {
  content:"";
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  display: block;
  background: rgba(0, 0, 0, 0.6);
  position: fixed;
  z-index: 9;
}
.overlay .popup {
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: fixed;
  top: 0;
  left: 35%;
  padding: 25px;
  margin: 100px auto;
  z-index: 10;
  -webkit-transition: all 0.6s ease-in-out;
  -moz-transition: all 0.6s ease-in-out;
  transition: all 0.6s ease-in-out;
}
.overlay:target .popup {
    top: 100%;
    left: -50%;
}

@media screen and (max-width: 768px){
  .box{
    width: 70%;
  }
  .overlay .popup{
    width: 70%;
    left: 15%;
  }
}

.deleteMeetingClose {
    font-size: 1.5em;
    cursor: pointer;
    position: absolute;
    right: 10px;
    top: 5px;
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
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">here you can chosse you leave type and duration from to and add your notes and attachement if needed </p>
  </aside>
</div>
</center>
<section class="border p-4 d-flex justify-content-center mb-4">

<form method="POST" onsubmit="return compare()" 
 enctype="multipart/form-data">
  <div >
 <div class="input-group mb-3" id="upload"> 
  <input type="file" name="fileToUpload" class="form-control" id="fileToUpload" />
  <span class="input-group-text">Upload</span>

</div>

   <div class="input-group md-2">
  <span class="input-group-text" id="basic-addon1">Start Date</span>
  <input type="date" class="form-control" placeholder="From Date" aria-label="From Date" name="adate" id="adate"required
    aria-describedby="basic-addon1"/>
</div>

      <br> 
<div class="input-group md-2">
  <span class="input-group-text" id="basic-addon1">End date</span>
  <input type="date" class="form-control" placeholder="To Date" aria-label="To Date" name="bdate" id="bdate"required
    aria-describedby="basic-addon1"/>
</div>

 <br>
<div class="input-group md-2" id="FromTimeDiv">
  <span class="input-group-text" id="basic-addon1">From Time</span>
  <input type="time" class="form-control"
  aria-label="To Date" 
  name="starttime"  id="starttime" placeholder="Enter start time"
    aria-describedby="basic-addon1"/>
</div>
 
<br>
<div class="input-group" id="ToTimeDiv">
  <span class="input-group-text" id="basic-addon1">To Time</span>
  <input type="time" class="form-control"aria-label="From Time" 
  name="endtime"  id="endtime" placeholder="Enter end time"
    aria-describedby="basic-addon1"/>
</div>

<br>

<div  class="input-group md-2" id="inputGroupSelect01div">
  <span class="input-group-text" id="basic-addon1">Choose</span>
  <select class="form-control sType" name="type" id="inputGroupSelect01"  required="true">
    <option value="">Choose...</option>
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
//echo $Unit_Name .'hear';
if ($Unit_Name <> 12 ){
  ?>
    <option value="Instead of(HR)">Instead of(HR)</option>
  <?php }
  ?>
    <option value="Compassionate Leave">Compassionate Leave</option>
    <option value="Maternity Leave">Maternity Leave</option>
    <option value="Pilgrimage Leave">Pilgrimage Leave</option>
    <option value="Official Mission">Official Mission</option>
    <option value="Paternity Leave">Paternity Leave</option>
    <option value="Permission">Permission</option>
    <option value="Unpaid Leave">Unpaid Leave</option>
    <option value="Maternity on duty leave">Maternity on duty leave</option>
  </select>

</div>
   <br>
<div class="input-group" >
  <span class="input-group-text" id="basic-addon1">Counting</span>
  <input name="count" id="countDays" placeholder="calculate days" class="nav-link form-control" 
    aria-describedby="basic-addon1" required="true" readonly="true"/>
    <button onclick="event.preventDefault();myfunc()" 
  style="width: 20%;" class="btn btn-warning">Count</button>
</div>

<br>
  
<br>
 <div class="form-outline">
  <label class="input-group-text" for="textAreaExample">Notes..</label>
  <textarea class="form-control notes" name="notes" id="textAreaExample" rows="4"></textarea>
</div>
<br>

<input type="submit" class="btn btn-primary submit" onclick="compare()"
 name="send" value="create leave"style="width:30%;" />

<br>
<?php
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
sqlsrv_query( $con1 , "SET NAMES 'utf8'"); 
sqlsrv_query( $con1 ,'SET CHARACTER SET utf8' );

  $s_username = $_SESSION['username'];
 $newannual  = sqlsrv_query($con,"SELECT Annuel_days
  from Annuel_cal
  where Annuel_cal.UserName = '$s_username'");

  $outputs_query = sqlsrv_fetch_array($newannual);
  $Annuel_days = $outputs_query['Annuel_days'];
      

if(isset($_POST['send'])){

  if(empty($_POST["type"])){
    //echo 'data is not found';
    echo '<script>alert("Please Select type name to proceed");   </script>';
  }

            
if(isset($_FILES['fileToUpload'])){

$target_dir = "uploads/";
$target_file =  strtotime("now");
$image= $_FILES["fileToUpload"];
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($_FILES['fileToUpload']["name"],PATHINFO_EXTENSION));

$target_dir = "uploads/";
$target_file =  strtolower($target_dir.basename(strtotime("now").'.'.$imageFileType));

//echo $target_file.'-----2----<br/>' ;

  $s_username = $_SESSION['username'];
  $engineer_id = $_SESSION['id'];
  if(isset($_POST['adate'])){$adate = $_POST['adate'];}
  if(isset($_POST['bdate'])){$bdate = $_POST['bdate'];}
  if(isset($_POST['starttime'])){$starttime = $_POST['starttime'];}
  if(isset($_POST['endtime'])){$endtime= $_POST['endtime'];}
  if(isset($_POST['type'])){$type = $_POST['type'];}
  //if(isset($_POST['notes'])){$notes = $_POST['notes'];}
/////////////////////
 //  if($type == 'Official Mission'){
  $qryshift =  sqlsrv_query( $con ,"SELECT [shift_start],[shift_end]
  ,IIF(([shift_start] between 
  '12:00:00' and '23:59:59' and 
  (cast(cast([shift_end] as datetime)-cast([shift_start] as datetime) as time) ='12:00:00')
  or ([shift_start] between '16:00:00' 
  and '23:59:59'))
         ,'open'
         ,'error') result
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  where username = '$s_username' and schedule_date = '$adate' " );

$output_queryshift = sqlsrv_fetch_array($qryshift);
   $resshift_start = $output_queryshift['shift_start'];
  echo $resshift_end = $output_queryshift['shift_end'];
  echo $resultss = $output_queryshift['result'];
//}

////////////////////////
 $escaped = $_POST['notes'];
 $notes = str_replace("'", "`", $escaped);

  if(isset($_POST['count'])){$interval = $_POST['count'];}
$status='pending';
$sqltime = date ("Y-m-d H:i:s");
//[creation_time]

$CurrentYear =  date("Y");
$NextYear = date("Y", strtotime('+1 month'));

$CurrentMonth = date("m");
$NextMonth = date("m", strtotime('+1 month'));
//fffffffffffffffffffffffffffffff
if($type == 'Annual Leave')
{
 $s_username = $_SESSION['username'];
 $engineer_id = $_SESSION['id'];
 $first_query = sqlsrv_query( $con ,"SELECT sum([count]) as countLeaves FROM leaves WHERE (status in ('PENDING','pending','E-workforce and senior approve') and [type] = 'Annual Leave' AND [username] = '$s_username' and YEAR([adate]) = '$CurrentYear' and YEAR([bdate]) = '$CurrentYear' )");
//php -> output data from mysqli
  while($output_query = sqlsrv_fetch_array($first_query)){
    $countLeaves = $output_query["countLeaves"];
   
  }
   // if less than 21 

  if(($countLeaves + $interval  > $Annuel_days) && ($type == 'Annual Leave') ) {
  echo '
<br>
<div id="message22" class="overlay">
  <div class="popup">
    <h2> Sorry '.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
<br/>
    <div class="content">
       Your Operation Couldn`t be completed because your allowed annual days is : '.$Annuel_days.' 
    </div>
  </div>
</div>
<script type="text/javascript">
  (function() {
  document.getElementById("message22").style.display = "none";
});

  $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
    //close action
    document.getElementById("message22").style.display = "none";
});
</script>';
 }
    $s_username = $_SESSION['username'];
  $newannual  = sqlsrv_query($con,"SELECT Annuel_days
  from Annuel_cal
  where Annuel_cal.UserName = '$s_username'");

  $outputs_query = sqlsrv_fetch_array($newannual);
    $totalss = $countLeaves + $interval  > $Annuel_days;
$total =($countLeaves+$interval);
  
     //$total =($countLeaves+$interval);
  //else{
    if(($interval > 0) && ($total <= $Annuel_days )){
    //sqlsrv_query( $con ,
    $insert_query = sqlsrv_query( $con ,"INSERT INTO leaves ([username] , [engineer_id] , [adate] , [bdate] ,[starttime] , [endtime] , [type] , [notes] , [count] , [status] , [creation_time]) VALUES ('$s_username','$engineer_id' , '$adate' , '$bdate' , '$starttime' , '$endtime' , '$type', '$notes' , '$interval' , '$status' , '$sqltime' )");
    $total =($countLeaves+$interval);

     //echo ($elba2y = $Annuel_days - $total).' elba2y';
     
    //if($interval >= ){
      echo '<div id="message" class="overlay">
  <div class="popup">
    <h2>  '.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
    <div class="content"> Now you have 
       ( '.($elba2y = $Annuel_days - $total).' ) Annual days
    </div>
  </div>
</div>
<script type="text/javascript">
  (function() {
  document.getElementById("message").style.display = "none";
});

  $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
    document.getElementById("message").style.display = "none";
});
</script>';

echo '<script>
    swal({
    title: "Done",
  icon: "success",
  })
     </script>';}
  //}
}
//elseif($interval <= 0)  {
if($type == "Maternity Leave"  || $type == "Compassionate Leave"  || 
    $type == "Sick Leave" || $type == "Paternity Leave"){

if (file_exists($target_file)) {
     echo '<div id="message7" class="overlay">
  <div class="popup">
    <h2> Sorry '.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
<br/>
    <div class="content">
       &#9760;The file is already exists..
    </div>
  </div>
</div>
<script type="text/javascript">
  (function() {
  document.getElementById("message7").style.display = "none";
});

  $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
    document.getElementById("message7").style.display = "none";
});
</script>';
    $uploadOk == 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
 echo '<div id="messagesss8" class="overlay">
  <div class="popup">
    <h2> Sorry '.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
<br/>
    <div class="content">
       &#9760;Your file is too large...
    </div>
  </div>
</div><script type="text/javascript">
  (function() {
  document.getElementById("messagesss8").style.display = "none";
});

  $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
    document.getElementById("messagesss8").style.display = "none";
});
</script>';

    //$insert_query === 0;
 $uploadOk == 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "zip"
&& $imageFileType != "gif" && $imageFileType != "csv" && $imageFileType != "xlsx" && $imageFileType != "pdf" 
&& $imageFileType != "msg") {
    echo '<div id="messagesss9" class="overlay">
  <div class="popup">
    <h2> Sorry '.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
<br/>
    <div class="content">
       &#9760;Only JPG, JPEG, PNG , GIF , csv & xlsx files are allowed...
    </div>
  </div>
</div>
<script type="text/javascript">
  (function() {
  document.getElementById("messagesss9").style.display = "none";
});

  $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
    //close action
    document.getElementById("messagesss9").style.display = "none";
});
</script>';
    //$insert_query === 0;
}


if ((move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) && $uploadOk !== 0 ) {
         '<div id="message" class="overlay">
  <div class="popup">
    <h2> Thanks'.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
<br/>
    <div class="content">
       The file '. basename( $_FILES["fileToUpload"]["name"]). ' has been uploaded.
    </div>
  </div>
</div>';
    } else {
        echo '<div id="message6" class="overlay">
  <div class="popup">
    <h2> Sorry '.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
<br/>
    <div class="content">
       &#9760;There is an error uploading your file...
    </div>
  </div>
</div>
<script type="text/javascript">
  (function() {
  document.getElementById("message6").style.display = "none";
});

  $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
    //close action
    document.getElementById("message6").style.display = "none";
});
</script>';
  $uploadOk == 0;
    }
}
/////end file upload file
// if($type == 0 ) {
//   echo '<div id="meessagesss" class="overlay">
//   <div class="popup">
//     <h2> Sorry last '.$s_username.'</h2>
//     <span class="deleteMeetingClose">&times;</span>
//     <br>
//     <div class="content">
//        Your Operation Couldn`t be completed (no type) ...
//     </div>
//   </div>
// </div>
// <script type="text/javascript">
//   (function() {
//   document.getElementById("meessagesss").style.display = "none";
// });

//   $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
//     document.getElementById("meessagesss").style.display = "none";
// });
// </script>';
// $uploadOk == 0;
// }

if($interval > 0){
if($type == "Maternity Leave"  || $type == "Compassionate Leave"  ||
    $type == "Sick Leave" || $type == "Paternity Leave" ){

   //if ($uploadOk != 0)  {
  $insert_query = sqlsrv_query( $con ,"INSERT INTO leaves ([username] , [engineer_id] , [adate] , [bdate] , [starttime] , [endtime] , [type] , [notes] , [count] , [status] , [creation_time]
    ,[attach] , [attach_image]) VALUES
     ('$s_username', '$engineer_id' , '$adate' , '$bdate' , '$starttime' , '$endtime' , '$type', '$notes' 
    , '$interval' , '$status' , '$sqltime','$target_file','$target_file' )");
  if($insert_query){
echo '<script>
    swal({
    title: "Done",
  icon: "success",
  })
     </script>';}
  }


if ($uploadOk == 0) {
  echo '<div id="messagesss7" class="overlay">
  <div class="popup">
    <h2> Sorry '.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
<br/>
    <div class="content">
       &#9760;Your file was not uploaded...
    </div>
  </div>
</div>
<script type="text/javascript">
  (function() {
  document.getElementById("messagesss7").style.display = "none";
});

  $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
    //close action
    document.getElementById("messagesss7").style.display = "none";
});
</script>';
   
}

}

// Unpaid leave
if($type == 'Unpaid Leave')
{
 $s_username = $_SESSION['username'];
 $engineer_id = $_SESSION['id'];

$unpaid_query = sqlsrv_query( $con ,"SELECT sum([count]) as countUnpaid FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING') AND [username] = '". $s_username."' and YEAR([adate]) = ".$CurrentYear." and YEAR([bdate]) = ".$CurrentYear." and [type] = 'Unpaid Leave'");
//php -> output data from mysqli
  while($output_unpaid = sqlsrv_fetch_array($unpaid_query)){
    $countUnpaid = $output_unpaid["countUnpaid"];
  }
   // if less than 21
  
  if($countUnpaid + $interval  > 5) {
    echo '<div id="messagess1" class="overlay">
  <div class="popup">
    <h2> Sorry '.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
<br/>
    <div class="content">
       &#9760;Your Operation Couldn`t be completed because you exceed the 5 days (Unpaid Leave)...
    </div>
  </div>
</div>
<script type="text/javascript">
  (function() {
  document.getElementById("messagess1").style.display = "none";
});

  $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
    document.getElementById("messagess1").style.display = "none";
});
</script>';

  }
if($interval <= 0 ) {
  echo '<div id="messagesss1" class="overlay">
  <div class="popup">
    <h2> Sorry '.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
<br/>
    <div class="content">
       Your Operation Couldn`t be completed because you exceed the 5 days (Unpaid Leave)...
    </div>
  </div>
</div>
<script type="text/javascript">
  (function() {
  document.getElementById("messagesss1").style.display = "none";
});

  $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
    document.getElementById("messagesss1").style.display = "none";
});
</script>';
}

   else
  {
    $insert = sqlsrv_query( $con ,"INSERT INTO leaves ([username] , [engineer_id] , [adate] , [bdate] ,[starttime] , [endtime] , [type] , [notes] , [count] , [status] , [creation_time]) VALUES ('$s_username','$engineer_id' , '$adate' , '$bdate' , '$starttime' , '$endtime' , '$type', '$notes' , '$interval' , '$status' , '$sqltime' )");
    if($insert){
echo '<script>
    swal({
    title: "Done",
  icon: "success",
  })
     </script>';}
  }
}
//Sick Leave

if($type == 'Sick Leave')
{

  $first_query = sqlsrv_query( $con ,"SELECT sum([count]) as countLeaves FROM leaves WHERE [username] = '". $s_username."' and YEAR([adate]) = ".$CurrentYear." and YEAR([bdate]) = ".$CurrentYear." 
    and [type] = 'Sick Leave' 
  and ( status  = 'E-workforce and senior approve' or status = 'pending' or status = 'senior approve' )");

//php -> output data from mysqli
  while($output_query = sqlsrv_fetch_array($first_query )){
    $countLeaves = $output_query["countLeaves"];
  }
  //($countLeaves+$interval  >10)if ($interval <= 0) {
  if(($countLeaves > 10) && ($type == 'Sick Leave'))
  {
    echo '<div id="message5" class="overlay">
  <div class="popup">
    <h2> Sorry '.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
<br/>
    <div class="content">
       You have exceeded the 10 days sick leaves, so your salary will be affected
    </div>
  </div>
</div>
<script type="text/javascript">
  (function() {
  document.getElementById("message5").style.display = "none";
});

  $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
    //close action
    document.getElementById("message5").style.display = "none";
});
</script>';

  }
}
// if($type == 0 ) {
//   echo '<div id="messaggesss" class="overlay">
//   <div class="popup">
//     <h2> Sorry last '.$s_username.'</h2>
//     <span class="deleteMeetingClose">&times;</span>
//     <br>
//     <div class="content">
//        Your Operation Couldn`t be completed (no type) ...
//     </div>
//   </div>
// </div>
// <script type="text/javascript">
//   (function() {
//   document.getElementById("messaggesss").style.display = "none";
// });

//   $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
//     document.getElementById("messaggesss").style.display = "none";
// });
// </script>';
// $uploadOk == 0;
// }
if($interval <= 0 ) {
  echo '<div id="messagesss" class="overlay">
  <div class="popup">
    <h2> Sorry last '.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
    <br>
    <div class="content">
       &#9760;Your Operation Couldn`t be completed ...
    </div>
  </div>
</div>
<script type="text/javascript">
  (function() {
  document.getElementById("messagesss").style.display = "none";
});

  $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
    document.getElementById("messagesss").style.display = "none";
});
</script>';
}
else
{

//$type !== "Sick Leave" && $type !== "Paternity Leave"
if($type !== 'Annual Leave' && $type !== 'Sick Leave'  && $type !== 'Permission'  && $type !== 'Compassionate Leave' 
&& $type !== 'Paternity Leave' && $type !== 'Unpaid Leave' && $type !== "Maternity Leave" && $interval > 0  ){

$insert_query = sqlsrv_query( $con ,"INSERT INTO leaves ([username] , [engineer_id] , [adate] , [bdate] , [starttime] , [endtime] , [type] , [notes] , [count] , [status] , [creation_time]) VALUES ('$s_username', '$engineer_id' , '$adate' , '$bdate' , '$starttime' , '$endtime' , '$type', '$notes' , '$interval' , '$status' , '$sqltime' )");

if($insert_query){
echo '<script>
    swal({
    title: "Done",
  icon: "success",
  })
     </script>';}

     }
}
}

if(isset($_POST['send'])){
  if(isset($_POST['type'])){$type = $_POST['type'];}
  if(isset($_POST['adate'])){$adate = $_POST['adate'];}
  if(isset($_POST['bdate'])){$bdate = $_POST['bdate'];}
  if(isset($_POST['starttime'])){$starttime = $_POST['starttime'];}
  if(isset($_POST['endtime'])){$endtime= $_POST['endtime'];}
   $s_username = $_SESSION['username'];

$qryshift =  sqlsrv_query( $con ,"SELECT [shift_start]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  where username = '$s_username' and schedule_date = '$adate' " );

while($output_queryshift = sqlsrv_fetch_array($qryshift)){
  $resshift_start = $output_queryshift['shift_start'];
}

//   if($resultss == 'error'){
//   //open
//   echo '<div id="messagesss607" class="overlay">
//   <div class="popup">
//     <h2> Attention '.$s_username.'</h2>
//     <span class="deleteMeetingClose">&times;</span>
// <br/>
//     <div class="content">
//       hena fe moshkela your end shift is : '.$resshift_end.'
//     </div>
//   </div>
// </div>
// <script type="text/javascript">
//   (function() {
//   document.getElementById("messagesss607").style.display = "none";
// });

//   $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
//     //close action
//     document.getElementById("messagesss607").style.display = "none";
// });
// </script>';
// }

//if(($resultss == 'open') && ($resshift_end >= '00:00:00')  && ($type == 'Official Mission')){
//    $time_query = sqlsrv_query( $con ,"INSERT INTO leaves ([username] , [engineer_id] , [adate] , [bdate] , [starttime] , [endtime] , [type] , [notes] , [count] , [status] , [creation_time]) VALUES ('$s_username', '$engineer_id' , '$adate' , '$bdate' , '$starttime' , '$endtime' , '$type', '$notes' , '$interval' , '$status' , '$sqltime' )");
//   if($time_query){
// echo '<script>
//     swal({
//     title: "Done",
//   icon: "success",
//   })
//      </script>';}else{
//       echo '<script>
//     swal({
//     title: "Error",
//   icon: "Wornning",
//   })
//      </script>';

//      }


 // }
// }
// }
if($type == 'Permission'){

  $CurrentYear = date("Y",strtotime($adate));
  $CurrentMonth = date("m",strtotime($adate));

  $NextYear = date("Y", strtotime('+1 month',strtotime($adate)));
  $NextMonth = date("m", strtotime('+1 month',strtotime($adate)));

if (date("d",strtotime($adate)) < 14 ) {
  $CurrentYear = date("Y",strtotime('-1 month',strtotime($adate)));
  $CurrentMonth = date("m",strtotime('-1 month',strtotime($adate)));

  $NextYear = date("Y", strtotime($adate));
  $NextMonth = date("m", strtotime($adate));
}
else
{
  $CurrentYear = date("Y",strtotime($adate));
  $CurrentMonth = date("m",strtotime($adate));

  $NextYear = date("Y", strtotime('+1 month',strtotime($adate)));
  $NextMonth = date("m", strtotime('+1 month',strtotime($adate)));

}
    
$today = date("Y-m-d"); // 2012-01-30
$next_month = date("Y-m-d", strtotime("$today +1 month"));

$diff = abs(strtotime($bdate) - strtotime($adate));

$new_date = date_format(date_create($adate), 'Y-m-d');

$new_time = date('H:i:s', strtotime($starttime));

$new_dateto = date_format(date_create($bdate), 'Y-m-d');
//$new_timeto = time_format(time_create($endtime), 'Y-m-d H:i:s');
$new_timeto = date('H:i:s', strtotime($endtime));


    $fdatetime = strtotime( $adate ." ".$starttime )  ; 
    $tdatetime = strtotime($bdate ." ". $endtime); 

    if (strtotime($adate.' '.$resshift_start) == strtotime($adate.' '.$starttime)  ) {
      $fdatetime = $fdatetime + 900 ;
    }

    // Formulate the Difference between two dates 
    $diff = abs($tdatetime - $fdatetime) ;

$diffMinutes = $diff / 60 ;   // transform to minutes 


    if ($diffMinutes /60 > 4){   //// check if exceed 4 hours 
 echo '<div id="messagesss3" class="overlay">
  <div class="popup">
    <h2> Attention '.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
<br/>
    <div class="content">
       You created more than 4 hours
    </div>
  </div>
</div>
<script type="text/javascript">
  (function() {
  document.getElementById("messagesss3").style.display = "none";
});

  $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
    document.getElementById("messagesss3").style.display = "none";
});
</script>';

// message exceed 4 hours    
  }
if($diffMinutes < 15 ){
  echo '<div id="messagesss4" class="overlay">
  <div class="popup">
    <h2> Attention '.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
<br/>
    <div class="content">
       Wornning:Permission must be > 15M
    </div>
  </div>
</div>
<script type="text/javascript">
  (function() {
  document.getElementById("messagesss4").style.display = "none";
});

  $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
    //close action
    document.getElementById("messagesss4").style.display = "none";
});
</script>';
}
  else{
   
     $units =  $diffMinutes ;

$qryUnits =  sqlsrv_query( $con ,"SELECT sum([count]) as countUnits
  FROM [Aya_Web_APP].[dbo].[leaves]
  where adate >= '".$CurrentYear."-".$CurrentMonth."-15 00:00:00' and bdate <= '".$NextYear."-".$NextMonth."-14 23:59:00' 
  and username = '$s_username' and type = 'Permission'
  and ( status  = 'E-workforce and senior approve' or status = 'PENDING' or status ='senior approve')" );

while($output_queryU = sqlsrv_fetch_array($qryUnits)){
   $resUnits = $output_queryU['countUnits'];
}

if($resUnits + $units > 245)
{
echo '<div id="messagesss5" class="overlay">
  <div class="popup">
    <h2> Attention '.$s_username.'</h2>
    <span class="deleteMeetingClose">&times;</span>
<br/>
    <div class="content">
       &#9760; You exceed 4 hours
    </div>
  </div>
</div>
<script type="text/javascript">
  (function() {
  document.getElementById("messagesss5").style.display = "none";
});

  $("#overlay, .deleteMeetingCancel, .deleteMeetingClose").click(function () {
    document.getElementById("messagesss5").style.display = "none";
});
</script>';
}
else
{
//insert query +  units 
  $time_query = sqlsrv_query( $con ,"INSERT INTO leaves ([username] , [engineer_id] , [adate] , [bdate] , [starttime] , [endtime] , [type] , [notes] , [count] , [status] , [creation_time]) VALUES ('$s_username', '$engineer_id' , '$adate' , '$bdate' , '$starttime' , '$endtime' , '$type', '$notes' , '$units' , '$status' , '$sqltime' )");
  if($time_query){
echo '<script>
    swal({
    title: "Done",
  icon: "success",
  })
     </script>';}else{
      echo '<script>
    swal({
    title: "Error",
  icon: "Wornning",
  })
     </script>';

     }
}

}
}
}}

?>

</div>
</form>
</section>
        <center>
      <div class="col-md-8">
        <div class="tableFixHead" >
           <table style="border-radius: 30px 30px 0 0;">
        <thead >
        <tr>
          <th ><center>Type </center></th>
          <th ><center>From date</center></th>
          <th ><center>To date</center></th>
          <th ><center>From time</center></th>
          <th ><center>To time</center></th>
          <th ><center>Notes  </center></th>
          <th ><center>Count </center></th>
          <th ><center>Status</center></th>
          <th ><center>Attach</center></th>
    </tr>
    </thead>
  <tbody style="background-color:white;">

<?php 
$s_username = $_SESSION['username'];
$first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE username ='$s_username' order by [creation_time] DESC ");
while($output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr >';
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query["type"].'</canter></td>';
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query["adate"]->format('Y-m-d').'</canter></td>';
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query["bdate"]->format('Y-m-d').'</canter></td>';
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query["starttime"]->format('H:i:s').'</canter></td>';
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query["endtime"]->format('H:i:s').'</canter></td>';
$rows .='<td class="cell100 column1 hovers" style="font-size:11px"><center>'.$output_query["notes"].'</canter></td>';
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query["count"]. '</canter></td>';
$rows .='<td class="cell100 column1 hovers" style="color:green;"><canter>'.$output_query["status"].'</canter></td>';
if(($output_query["attach"] !== "uploads/") && ($output_query["attach"] !== " ") && ($output_query["type"] == "Sick Leave"  || $output_query["type"] == "Compassionate Leave"  || 
    $output_query["type"] == "Maternity Leave" || $output_query["type"] == "Paternity Leave")){
$rows .= '<td  class="cell100 column1 pt-3-half hovers" ><center><a href='.$output_query["attach_image"].' download><samp style="float:center;font-size:25px;"><i class="fa fa-paperclip hovers" style="color:orange;"></samp></i></a>'.'</canter></td>';
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
        </div>        
     
</center>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
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
    var test = "<?php echo $resultss; ?>";
    // var shift_s = "<?php echo $resshift_start; ?>";
    // var shift_e = "<?php echo $resshift_end; ?>";
//alert(test,shift_e);
console.log(test);
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
    var test = "<?php echo $resultss; ?>";
    var startDt = document.getElementById("adate").value;
    var endDt = document.getElementById("bdate").value;
    var ptype = document.getElementById("inputGroupSelect01").value;

    var strStartTime = document.getElementById("starttime").value;
    var strEndTime = document.getElementById("endtime").value;

    var startTime = new Date().setHours(GetHours(strStartTime), GetMinutes(strStartTime), 0);
    var endTime = new Date(startTime)
    endTime = endTime.setHours(GetHours(strEndTime), GetMinutes(strEndTime), 0);

    if( (startTime > endTime) && (ptype == "Permission" || ptype == "Official Mission" ) && (test === 'error')) {
        alert("Start Time is greater than end time");
        event.preventDefault();
    }

     if(ptype == ''){
      alert("Please Select type ya bnty");  
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

  if( ( new Date(startDt).getTime()) > new Date(endDt).getTime() && 
    (ptype == document.getElementById("inputGroupSelect01").value ) )
    {
       alert("To Date should be greater than From date ");
       event.preventDefault();
    }
  if( (new Date(startDt).getTime() != new Date(endDt).getTime())  && (ptype == "Permission" || 
  ptype == "Official Mission" ) && (test == 'error'))
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
