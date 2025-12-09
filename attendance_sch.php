
<?php
include ("pages.php");
 $this_year = date('Y');
?>

	<title>Attendance</title>

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fixed_s/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="fixed_s/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="fixed_s/vendor/perfect-scrollbar/perfect-scrollbar.css">
	<link rel="stylesheet" href="fixed_s/css/util.css">
	<link rel="stylesheet" href="fixed_s/css/main.css">
</head>
<style type="text/css">
	.hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
      tr:nth-child(even) {
  background-color: lightgray;
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
              <h2 class="text-dark display-12" >Attendance</h2>
      <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This table shows the minimum time of sign in (by day) and the Maximum time of sign out(by Day)</p>
  </aside>
</div>

<div class="col-md-8">
<br>
	<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">

	<div class="limiter">
		
		<div class="container-table100">
			<div class="wrap-table100">
		 	 <div class="table100 ver1 m-b-110">

	<div class="table100-head" >
		<table >
			<thead >
				<tr class="row100 head" >
					<th class="cell100 column1"><center>In Time</center></th>
					<th class="cell100 column1"><center>Out Time</center></th>
					<th class="cell100 column1"><center>Date</center></th>
					<th class="cell100 column1"><center>Month</center></th>				
				</tr>
			</thead>
		</table>
	</div>
					<div class="table100-body js-pscroll" style="text-align:center;">
						<table class="order-table table">
							<tbody>
							<?php      
$curr_year = date('Y');
$self = $_SESSION['id'];
$s_username = $_SESSION['username'];

if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];
}  

if($_SESSION['role_id'] == 1){
	$check_engineers  = $first_query = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_id'   ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'] ;
}

$first_query = sqlsrv_query( $con ,"SELECT [username]
,cast([cur_date] as date ) [date]
,month([cur_date]) [Month]
      ,cast(min(IIF([type] = 'In',(cast([cur_date] as datetime) + cast([atime] as datetime)),null)) as time) [In]
      ,cast(max(IIF([type] = 'Out',(cast([cur_date] as datetime) + cast([atime] as datetime)),null)) as time) [Out]
    FROM [dbo].[in_and_out]
	where username ='$eng_username' and year([cur_date]) >='$this_year'
		group by [username],cast([cur_date] as [date]) 
		order by [cur_date]  DESC ");
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
$rows .='<td class="cell100 column1 hovers">'.$output_query2["Month"].'</td>';

$rows .='</tr>';
echo $rows;

  }



	}
	$self = $_SESSION['id'];

	if($_SESSION['role_id'] !== 1){
$first_query = sqlsrv_query( $con ,"SELECT [username]
,cast([cur_date] as date ) [date]
,month([cur_date]) [Month]
      ,cast(min(IIF([type] = 'In',(cast([cur_date] as datetime) + cast([atime] as datetime)),null)) as time) [In]
      ,cast(max(IIF([type] = 'Out',(cast([cur_date] as datetime) + cast([atime] as datetime)),null)) as time) [Out]
    FROM [dbo].[in_and_out]
	where username ='$s_username' and year([cur_date]) >='$this_year'
		group by [username],cast([cur_date] as [date]) 
		order by [cur_date]  DESC ");

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
$rows .='<td class="cell100 column1 hovers">'.$output_query2["Month"].'</td>';

$rows .='</tr>';
echo $rows;
}
}
?>							
						</tbody>
						</table>
					</div>
				</div>				
				</div>
			</div>
		</div>		
	</div>
</center>

				
<script type='text/javascript'>
  
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
      Arr.forEach.call(tables, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);
  
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

