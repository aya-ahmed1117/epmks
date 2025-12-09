

<?php
include ("pages.php");
?>

	<title>Schedule</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fixed_s/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="fixed_s/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="fixed_s/vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" href="fixed_s/css/util.css">
	<link rel="stylesheet" href="fixed_s/css/main.css">
	<link href="assets2/css/style.css" rel="stylesheet">
</head>
<?php
 if ($unit =='Quality Management and Training'){
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
        <h2>Hi '.$s_username.'</h2>
<br/>
        <div class="content">
            Sorry You don`t have Schedule...
        </div>
    </div>
</div>

';
}else{
?>
<style type="text/css">
	.hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
 
</style>

<!--center>
  
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Sign History</h2>
              <p style="color:lightgray;">Welcome : <?php  $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This table shows the minume time of sign in  ( by day) and the Maximum time of sign out ( by Day)</p>
  </aside>
</div>

<div class="col-md-8">
	<div class="limiter">
		
		<div class="container-table100">
			<div class="wrap-table100">
		 	 <div class="table100 ver1 m-b-110">

	<div class="table100-head">
		<table>
			<thead>
				<tr class="row100 head">
					<th class="cell100 column1">In Time</th>
					<th class="cell100 column1">Out Time</th>
					<th class="cell100 column1">Date</th>
					
				</tr>
			</thead>
		</table>
	</div>
		<div class="table100-body js-pscroll">
			<table>
				<tbody>
							<?php      
/*
$engineer_id = $_SESSION['id'];
$s_username = $_SESSION['username'];
$first_query = sqlsrv_query( $con ,"
	exec Schedule_convertion_per_user 
	@user = '$s_username'
	");
  while( $output_query2 = sqlsrv_fetch_array($first_query)){
$rows  ='<tr class="row100 body">';
if ($output_query2["In"]== NULL){
	$rows .='<td class="cell100 column1 hovers">Blank</td>';
}else{
$rows .='<td class="cell100 column1 hovers">'.$output_query2["In"]->format('H:i:s').'</td>';}
if ($output_query2["Out"]== NULL){
	$rows .='<td class="cell100 column1 hovers">Blank</td>';
}else{
$rows .='<td class="cell100 column1 hovers">'.$output_query2["Out"]->format('H:i:s').'</td>';}
$rows .='<td class="cell100 column1 hovers">'.$output_query2["date"]->format('Y-m-d').'</td>';
$rows .='</tr>';

echo $rows;
}*/
?>							
						</tbody>
						</table>
					</div>
				</div>				
				</div>
			</div>
		</div>		
	</div>
</center-->
<style type="text/css">
	.hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }

.column1{
	height: 50px;border:2px solid #fff;
	 background-color:white;
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
              <h2 class="text-dark display-12" >Schedule</h2>
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">My Schedule...</p>
  </aside>
</div>
</center>

  
<?php if ($_SESSION['role_id'] == 0){

	?>
<?php 
  // if(isset($_GET['schedule_date'])){$schedule_date=$_get['schedule_date'];}
   // if(isset($_GET['shift_start'])){$shift_starts=$_get['shift_start'];}
    $check_engineers = sqlsrv_query( $con ,"SELECT * FROM new_sch_view 
    	WHERE  username = '$s_username'  ");

while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $schedule_date = $output_engineers['schedule_date']->format('Y-m-d');
  $shift_start =$output_engineers['shift_start'];
}
/************************************************************/
if (isset($_GET['ymd'])) {
    $ymd = $_GET['ymd'].'-01';
} else {
    $ymd = date('Y-m-d');
}
$today = date('Y-m-d');
$timestamp = strtotime($ymd);
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
// For H3 title
$html_title = date('Y / m ', $timestamp);
// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));

$day_count = date('t', $timestamp);
// Create Calendar!!
$date = date('j');
$weeks = array();
$week = '';
// Add empty cell


$week .= str_repeat('<td style="height: 50px;background-color:lightgray;" name="schedule_date"><a href="?schedule_date='.$schedule_date.'"></td></a>', $str);
// if (empty($output_engineers['schedule_date'])){
//     $output_engineers['schedule_date'] == date('Y-m-d');
// }
//if (!empty($output_engineers['schedule_date']))
for ( $day = 1; $day <= $day_count; $day++,$str++) {
     
    $year  = date('Y', strtotime($ymd));
	$month = date('m', strtotime($ymd)); 

    $calenderDay = $year.'-'.$month.'-'.$day;

 if(isset($_GET['schedule_date'])){$schedule_date=$_get['schedule_date'];}
 if(isset($_GET['shift_start'])){$shift_start=$_get['shift_start'];}

  $check_orders = sqlsrv_query( $con ,"SELECT * FROM new_sch_view WHERE  username = '$s_username' and schedule_date='$calenderDay'   " , array() , array('Scrollable' =>'static'));
 $output_engineers = sqlsrv_fetch_array($check_engineers);
  //$schedule_date = $output_engineers['schedule_date']->format('Y-m-d');
  $shift_start =$output_engineers['shift_start'];

$orders_num = sqlsrv_num_rows($check_orders); 
if($orders_num == 0 ){
$calenderDay == '10/10/2005';
$shift_start == '10:10:00';
}

 $check_shift_end = sqlsrv_query( $con ,"SELECT username , shift_end,shift_start,schedule_date
FROM [Aya_Web_APP].[dbo].[schedule_table] 
 WHERE  username = '$s_username'  and schedule_date='$calenderDay' ");
while ( $output_shift_end = sqlsrv_fetch_array($check_shift_end)){
  $shift_end =$output_shift_end['shift_end'];
  if($shift_end ==  ''){
     $shift_end = 'blank';
}
}
if($output_shift_end['shift_end'] ==  ''){
     $shift_end = 'blank';
}



    $check_engineers = sqlsrv_query( $con ,"SELECT * FROM new_sch_view WHERE  username = '$s_username'  and schedule_date='$calenderDay'  ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $schedule_date = $output_engineers['schedule_date']->format('Y-m-d');
  $shift_start =$output_engineers['shift_start'];
}
//if($schedule_date <> NULL){

    if(!empty($schedule_date)){

$this_day = date('Y-m-d');
  //$week .= '<td class="hovers"  >'.$calenderDay.'';
    if($this_day == $schedule_date){
        $week .= '<td style="height: 50px;border:2px solid #fff;background-color:#fec589;"
        class="today hovers" title="shift end '.$shift_end.'">Today
        <p style="color:gray;">('.$shift_start.')</p>
        <span style="font-siza:5px; color:darkblue;">'.$shift_end.'</span></td>';
    }else{
    
    if(($shift_start == 'off') || ($shift_start == 'OFF')){

$week .= '<td class="hovers">'.$calenderDay.'<p style="color:orange;">('.$shift_start.')</p></td>';

    //$week .= '<p style="color:orange;">'.$shift_start.'</p>';
     }
       if($shift_start == 'Annual Leave'){
            $week .= '<td style="height: 50px;border:2px solid #fff;background-color:#0d6efd;color:#eee;"
        class="hovers">'.$calenderDay.'<p >('.$shift_start.')</p>
        </td>';
        }

         if($shift_start == 'Official Mission'){
            $week .= '<td style="height: 50px;border:2px solid #fff;background-color:#198754;color:#eee;"
        class="hovers">'.$calenderDay.'<p>('.$shift_start.')</p></td>';
        }
         if($shift_start == 'Sick Leave'){
            $week .= '<td style="height: 50px;border:2px solid #fff;background-color:#ffc107;color:black;"
        class="hovers">'.$calenderDay.'<p>('.$shift_start.')</p></td>';
        }
     /*     if($shift_start=='OFF'){
            $week .= '<p style="background-color:#198754;color:#eee;">('.$shift_start.')</p>';}      

*/

        if(
    	($shift_start=='Paternity Leave')||
    	($shift_start=='Pilgrimage Leave')||
    	($shift_start=='Unpaid Leave')||
    	($shift_start=='Compassionate leave')||
    	($shift_start=='Maternity Leave')||
    	($shift_start=='Instead of(HR)')){
     	$week .= '<td
        class="hovers">'.$calenderDay.'<p style="color:orange;">('.$shift_start.')</p></td>';
     }
   
        if(
        ($shift_start !== 'Paternity Leave')&&
        ($shift_start !== 'Pilgrimage Leave')&&
        ($shift_start !== 'Unpaid Leave')&&
        ($shift_start !== 'Compassionate leave')&&
        ($shift_start !== 'Maternity Leave')&&
        ($shift_start !== 'Instead of(HR)')&&
        ($shift_start !==  'off')&&
        ($shift_start !==  'OFF')&&
        ($shift_start !==  'Annual Leave')&&
        ($shift_start !==  'Official Mission')&&
        ($shift_start !==  'Sick Leave')&&
        ($shift_start !==  '')&&
        ($shift_end !==  '')){
    $week .= '<td
        class="hovers" title="shift end '.$shift_end.'">'.$calenderDay.'<p style="color:gray;">('.$shift_start.')</p>
        <span style="font-siza:5px; color:lightgray;">'.$shift_end.'</span></td>';
     }

     
    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {
        if ($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td style="height: 50px;" ></td>', 6 - ($str % 7));
        }
        $weeks[] = '<tr>' . $week . '</tr>';
        // Prepare for new week
        $week = '';
    }
}
}
}

?>


<div class="container col-md-8" >
<div  style="background-color: rgba(0, 0, 0, .5);">

    <table class="table table-sm" >
    <thead>
    <tr>
    <th class="prev" data-action="previous" >
     <a  href="?ymd=<?php echo $prev;?>" style="color: white;" >
     	<i class="fa fa-chevron-left"></i>
     	<i class="fa fa-chevron-left"></i>
     </a></th>
<th style="font-size:20px; color: white; font-weight: bold;" align="center">
	<center><?php echo $html_title ?> </center></th>
	<?php 
	$thismonth = date('m')+1;
	$ym =date('Y-m');
	$month = date('m'); 

	if ($ymd <= $ym){
echo'  <th class="next" data-action="next"><a href="?ymd='.$next.'"  style="color: white; float: right;">
      <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a></th>';
}else if ($ymd == $ym){
	echo '<th class="next" data-action="next">
	<a  href="?ymd='.$prev.'" style="color: white;" >
	<i class="fa fa-chevron-left"></i><i class="fa fa-chevron-right"></i>
	</a></th>';
}else{
	echo '<th class="next" data-action="next" >
	<i class="fa fa-chevron-right"style="float: right;"></i><i class="fa fa-chevron-right"style="float: right;"></i>
	</th>';
}
/*if ($thismonth >$month){
	echo '<th class="next" data-action="next"><i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i></th>';
}*/
?>
  </tr>
</thead>
</table>
</div>


        <table class="table table-bordered"  >
          <tbody style="color: #55608f;background-color:white;">
            <tr style="color: white;background-color: #55608f;">

                <th>Sn</th>
                <th>M</th>
                <th>T</th>
                <th>W</th>
                <th>T</th>
                <th>F</th>
                <th style="width:15%;">S</th>
            </tr>

            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
          </tbody>
        </table>
</div>
<?php
}
}
    if ($_SESSION['role_id'] <> 0){
    //if($unit =='Quality Management and Training'){
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
		<h2>Hi '.$s_username.'</h2>
<br/>
		<div class="content">
			Sorry You don`t have Schedule...
		</div>
	</div>
</div>

';
}
?>

<!--
    <div class="container" style="width:80%;" >
      <label  style="background-color:#17a2b8; font-size: 18px; font-weight: bold;" > 
      	<a href="?ymd=<?php echo $prev;?>" style="color: white;" class="btn btn-info">&lt;&lt;</a> 
        	<?php echo $html_title ?>
 <a href="?ymd=<?php echo $next; ?>" class="btn btn-info"  style="color: white;">&gt;&gt;</a></label>
 <h4 style="text-align: center;margin-top: -4%;">Choose per day</h4>
<br>
<br>
<style type="text/css">
	thead ,th{
		background-color:#17a2b8;
	}

</style>

        <table class="table table-bordered">
        	<thead>
            <tr>
                <th>S</th>
                <th>M</th>
                <th>T</th>
                <th>W</th>
                <th>T</th>
                <th>F</th>
                <th>S</th>
            </tr>
            </thead>
            <?php
                foreach ($weeks as $week) {
                     $week;
                }
            ?>
        </table>
    </div>
   -->

<script type="text/javascript">
  (function() {
  document.getElementById("message").style.display = 'none';
});
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
				

	<script src="fixed_s/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="fixed_s/vendor/bootstrap/js/popper.js"></script>
	<script src="fixed_s/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="fixed_s/vendor/select2/select2.min.js"></script>
	<script src="fixed_s/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})
		});	
	</script>
	<script src="fixed_s/js/mainss.js"></script>
	<?php
 include ("footer.html");
 ?>

