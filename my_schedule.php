

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
$check_engineers = sqlsrv_query($con, "SELECT * FROM new_sch_view WHERE username = '$s_username'");
$schedule_data = [];

if ($check_engineers !== false) {
    while ($row = sqlsrv_fetch_array($check_engineers, SQLSRV_FETCH_ASSOC)) {
        if (isset($row['schedule_date'])) {
            $date_key = $row['schedule_date']->format('Y-m-d');
            $schedule_data[$date_key] = [
                'shift_start' => $row['shift_start'] ?? '',
                'shift_end'   => $row['shift_end'] ?? ''
            ];
        }
    }
}

// إعدادات التقويم
$ymd = isset($_GET['ymd']) ? $_GET['ymd'] . '-01' : date('Y-m-d');
$timestamp = strtotime($ymd);
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
$html_title = date('Y / m', $timestamp);
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
$day_count = date('t', $timestamp);
$weeks = [];
$week = '';

$week .= str_repeat('<td style="height: 50px;background-color:lightgray;"></td>', $str);

for ($day = 1; $day <= $day_count; $day++, $str++) {
    $year = date('Y', $timestamp);
    $month = date('m', $timestamp);
    $calenderDay = date('Y-m-d', strtotime("$year-$month-$day"));

    $shift_start = $schedule_data[$calenderDay]['shift_start'] ?? '';
    $shift_end = $schedule_data[$calenderDay]['shift_end'] ?? '';
    $this_day = date('Y-m-d');

    if ($this_day == $calenderDay) {
        $week .= '<td style="height: 50px;border:2px solid #fff;background-color:#fec589;" class="today hovers" title="shift end ' . $shift_end . '">Today
        <p style="color:gray;">(' . $shift_start . ')</p>
        <span style="font-size:10px; color:darkblue;">' . $shift_end . '</span></td>';
    } elseif (strtolower($shift_start) == 'off') {
        $week .= '<td class="hovers">' . $calenderDay . '<p style="color:orange;">(' . $shift_start . ')</p></td>';
    } elseif ($shift_start == 'Annual Leave') {
        $week .= '<td style="height: 50px;border:2px solid #fff;background-color:#0d6efd;color:#eee;" class="hovers">' . $calenderDay . '<p>(' . $shift_start . ')</p></td>';
    } elseif ($shift_start == 'Official Mission') {
        $week .= '<td style="height: 50px;border:2px solid #fff;background-color:#198754;color:#eee;" class="hovers">' . $calenderDay . '<p>(' . $shift_start . ')</p></td>';
    } elseif ($shift_start == 'Sick Leave') {
        $week .= '<td style="height: 50px;border:2px solid #fff;background-color:#ffc107;color:black;" class="hovers">' . $calenderDay . '<p>(' . $shift_start . ')</p></td>';
    } elseif (in_array($shift_start, ['Paternity Leave', 'Pilgrimage Leave', 'Unpaid Leave', 'Compassionate leave', 'Maternity Leave', 'Instead of(HR)'])) {
        $week .= '<td class="hovers">' . $calenderDay . '<p style="color:orange;">(' . $shift_start . ')</p></td>';
    } elseif (!empty($shift_start)) {
        $week .= '<td class="hovers" title="shift end ' . $shift_end . '">' . $calenderDay . '<p style="color:gray;">(' . $shift_start . ')</p>
        <span style="font-size:10px; color:lightgray;">' . $shift_end . '</span></td>';
    } else {
        $week .= '<td>' . $calenderDay . '</td>';
    }

    if ($str % 7 == 6 || $day == $day_count) {
        if ($day == $day_count) {
            $week .= str_repeat('<td style="height: 50px;" ></td>', 6 - ($str % 7));
        }
        $weeks[] = '<tr>' . $week . '</tr>';
        $week = '';
    }
}
?>

<!-- التقويم -->
<div class="container col-md-8">
<div style="background-color: rgba(0, 0, 0, .5);">
    <table class="table table-sm">
        <thead>
        <tr>
            <th class="prev" data-action="previous">
                <a href="?ymd=<?php echo $prev; ?>" style="color: white;">
                    <i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i>
                </a>
            </th>
            <th style="font-size:20px; color: white; font-weight: bold;" align="center">
                <center><?php echo $html_title ?> </center>
            </th>
            <th class="next" data-action="next">
                <a href="?ymd=<?php echo $next; ?>" style="color: white; float: right;">
                    <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i>
                </a>
            </th>
        </tr>
        </thead>
    </table>
</div>

<table class="table table-bordered">
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
        <?php foreach ($weeks as $week) echo $week; ?>
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

   