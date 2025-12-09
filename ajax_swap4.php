<?php
$username = isset($_POST['swaper_name']) ? $_POST['swaper_name'] : "";
$schedule_date = isset($_POST['schedule_date']) ? $_POST['schedule_date'] : "";
$reason = isset($_POST['reason']) ? $_POST['reason'] : "";
$senior = isset($_POST['senior']) ? $_POST['senior'] : "";
$shift_start = isset($_POST['shift_start']) ? $_POST['shift_start'] : "";
$shift_end = isset($_POST['shift_end']) ? $_POST['shift_end'] : "";

$data = "";
$data .= " + ".$username."<br>";
$data .= " + ".$schedule_date."<br>";
$data .= " + ".$reason."<br>";
$data .= " + ".$senior."<br>";
$data .= " + ".$shift_start."<br>";
$data .= " + ".$shift_end."<br>";
echo $data;
?>