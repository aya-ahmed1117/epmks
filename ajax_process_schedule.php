<?php
require_once("inc/config.inc");


$self = $_SESSION['id'];
$s_username = $_SESSION['username'];

if(isset($_POST['date']))    { $mydate   = $_POST['date']; }
if(isset($_POST['date2']))   { $mydate2  = $_POST['date2']; }
if(isset($_POST['time']))    { $myTime   = $_POST['time']; }
if(isset($_POST['time2']))   { $myTime2  = $_POST['time2']; }
if(isset($_POST['username'])){ $usernames = $_POST['username']; }
if(isset($_POST['days']))    { $days     = $_POST['days']; }

$myTimes2 = date('H:i:00', strtotime($myTime));
$myTimes5 = date('H:i:00', strtotime($myTime2));

$start_date = strtotime($mydate);
$end_date   = strtotime($mydate2);
$diff       = ($end_date - $start_date) / 60 / 60 / 24;

if($diff >= 31){
  echo "<script>
    swal({ title: 'Max range is 30 days', icon: 'info' });
  </script>";
  exit;
}

$sqltime = date("Y-m-d H:i:s");

// Insert into demo table
sqlsrv_query($con, "EXEC Insert_Schtable_demo
  @user_name='$usernames',
  @Start_time='$myTimes2',
  @end_time='$myTimes5',
  @Date_from='$mydate',
  @Date_end='$mydate2',
  @Date_off='$days',
  @session_user='$s_username',
  @session_id='$self'
");

// Insert into new_Schtable
$insert_query = sqlsrv_query($con, "EXEC Insert_new_Schtable
  @user_name='$usernames',
  @Start_time='$myTimes2',
  @end_time='$myTimes5',
  @Date_from='$mydate',
  @Date_end='$mydate2',
  @Date_off='$days',
  @session_user='$s_username',
  @session_id='$self',
  @creation_time='$sqltime'
");

// Update schedule_table
$update_schedule = sqlsrv_query($con, "EXEC update_schedule_table
  @user_name='$usernames',
  @Start_time='$myTimes2',
  @end_time='$myTimes5',
  @Date_from='$mydate',
  @Date_end='$mydate2',
  @Date_off='$days',
  @session_user='$s_username',
  @session_id='$self',
  @creation_time='$sqltime'
");

if($insert_query || $update_schedule){
  echo "<script>
    swal({
      title: 'Schedule updated successfully',
      icon: 'success'
    }).then(function() {
      location.reload();
    });
  </script>";
} else {
  echo "<script>
    swal({
      title: 'Something went wrong',
      icon: 'error'
    });
  </script>";
}
?>
