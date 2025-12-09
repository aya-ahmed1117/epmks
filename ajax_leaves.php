
<?php
	require_once("inc/config.inc");

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
sqlsrv_query( $con1 , "SET NAMES 'utf8'"); 
sqlsrv_query( $con1 ,'SET CHARACTER SET utf8' );

   $s_username = $_SESSION['username'];

 $newannual  = sqlsrv_query($con1,"SELECT Annuel_days
  from Annuel_cal
  where Annuel_cal.UserName = '$s_username'");

   $outputs_query = sqlsrv_fetch_array($newannual);
      $Annuel_days = $outputs_query['Annuel_days'];
 if(isset($_POST['send'])){

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


$first_query = sqlsrv_query( $con ,"SELECT sum([count]) as countLeaves FROM leaves WHERE ( status  = 'E-workforce and senior approve' or status = 'PENDING') AND [username] = '". $s_username."' and YEAR([adate]) = ".$CurrentYear." and YEAR([bdate]) = ".$CurrentYear." and [type] = 'Annual Leave'");
//php -> output data from mysqli
  while($output_query = sqlsrv_fetch_array($first_query)){
    $countLeaves = $output_query["countLeaves"];
  }
   // if less than 21 
 
  if(($countLeaves+$interval  > $Annuel_days) && ($type == 'Annual Leave') && ($_SESSION['username'] !== 'x_test')) {
  echo "<b><h2 style='color: #cc0000; font-size=10px; border-radius: 4px 4px 5px 5px;box-sizing: border-box; border: 2px solid #cc0000;width:30%;'>Your Operation Couldn't be completed because you exceed the allowed ".$Annuel_days." annual days </h2></b>";
  }

  elseif($interval !== "0" )
  {
    $insert_query = sqlsrv_query( $con ,"INSERT INTO leaves ([username] , [engineer_id] , [adate] , [bdate] ,[starttime] , [endtime] , [type] , [notes] , [count] , [status] , [creation_time]) VALUES ('$s_username','$engineer_id' , '$adate' , '$bdate' , '$starttime' , '$endtime' , '$type', '$notes' , '$interval' , '$status' , '$sqltime' )");
  }
}

if($type == "Maternity Leave"  || $type == "Compassionate Leave"  || 
    $type == "Sick Leave" || $type == "Paternity Leave" && $interval !== "0" ){

if (file_exists($target_file)) {
     echo "<h4 style='background-color:lightgray ;color:red;width:30%;'>&#9760;Sorry, file already exists.</h4>";
    $uploadOk == 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
 echo "<h4 style='background-color:lightgray ;color:red;width:30%;'>&#9760;Sorry, your file is too large.</h4>";
    //$insert_query === 0;
 $uploadOk == 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "zip"
&& $imageFileType != "gif" && $imageFileType != "csv" && $imageFileType != "xlsx" && $imageFileType != "pdf" 
&& $imageFileType != "msg") {
    echo "<h4 style='background-color:lightgray ;color:red;width:30%;'>&#9760;Sorry, only JPG, JPEG, PNG , GIF , csv & xlsx files are allowed.</h4>";
    //$insert_query === 0;

}
else
{
    $uploadOk == 0;
}
if ((move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) && $uploadOk !== 0 ) {
        echo "<h4 style='background-color:lightgray ;color:black;width:30%;'>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.</h4>";
    } else {
        echo "<h4 style='background-color:lightgray ;color:red;width:30%;'>Sorry, there was an error uploading your file.</h4>";
        $uploadOk == 0;
    }
}
//////////////// end file upload file
 if($interval == 0 ) {
  echo "<b><h2 style='color: #cc0000; font-size=10px; border-radius: 4px 4px 5px 5px;box-sizing: border-box; border: 2px solid #cc0000;width:30%;'>Your Operation Couldn't be completed </h2></b>";
  }

elseif($type == "Maternity Leave"  || $type == "Compassionate Leave"  || 
    $type == "Sick Leave" || $type == "Paternity Leave" && $interval !== "0" ){

if ($uploadOk != 0)
  {
  $insert_query = sqlsrv_query( $con ,"INSERT INTO leaves ([username] , [engineer_id] , [adate] , [bdate] , [starttime] , [endtime] , [type] , [notes] , [count] , [status] , [creation_time]
    ,[attach] , [attach_image]) VALUES
     ('$s_username', '$engineer_id' , '$adate' , '$bdate' , '$starttime' , '$endtime' , '$type', '$notes' 
    , '$interval' , '$status' , '$sqltime','$target_file','$target_file' )");
  }


if ($uploadOk == 0) {
    echo "<h4 style='background-color:lightgray ;color:red;width:30%;'>Sorry, your file was not uploaded.</h4>";
// if everything is ok, try to upload file
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
 
  if($countUnpaid+$interval  > 5) {
  echo "<b><h2 style='color: #cc0000; font-size=10px; border-radius: 4px 4px 5px 5px;box-sizing: border-box; border: 2px solid #cc0000;width:30%;'>Your Operation Couldn't be completed because you exceed the 5 days (Unpaid Leave)</h2></b>";
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
  //($countLeaves+$interval  >10)
  if(($countLeaves > 10) && ($type == 'Sick Leave'))
  {
    echo "<h2 style='color: #cc0000; font-size=10px; border-radius: 4px 4px 5px 5px;box-sizing: border-box; border: 2px solid #cc0000;width:30%;'> Warning you have exceed the 10 sick leaves days so your salary will be affected  </h2>";
  }
}
//$type !== "Sick Leave" && $type !== "Paternity Leave"

if($type !== 'Annual Leave' && $type !== 'Sick Leave'  && $type !== 'Permission'  && $type !== 'Compassionate Leave'
&& $type !== 'Paternity Leave' && $type !== 'Unpaid Leave' ){

$insert_query = sqlsrv_query( $con ,"INSERT INTO leaves ([username] , [engineer_id] , [adate] , [bdate] , [starttime] , [endtime] , [type] , [notes] , [count] , [status] , [creation_time]) VALUES ('$s_username', '$engineer_id' , '$adate' , '$bdate' , '$starttime' , '$endtime' , '$type', '$notes' , '$interval' , '$status' , '$sqltime' )");

if($insert_query){
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
 echo "<h1 style='font-size:25px;border: 2px solid #5b9291;width:48%;
  border-radius: 4px 4px 5px 5px;'>&#x26A0; You create more than 4 hours </h1>"; 

// message exceed 4 hours    
  }
if($diffMinutes < 15 ){
  echo "<h2 style='color: #cc0000; font-size=10px; border-radius: 4px 4px 5px 5px;box-sizing: border-box; border: 2px solid #cc0000;width:30%;'>".'Wornning: It must be > 15M'."</h2>";
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

if($resUnits + $units > 240)
{
 /// messge 
 echo "<h1 style='font-size:29px;border: 2px solid tomato;width:48%;
  border-radius: 4px 4px 5px 5px; color:tomato;'>&#9760; You exceed 4 hours</h1>";
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
}
?>

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