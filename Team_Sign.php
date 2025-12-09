
<?php
include ("pages.php");
?>

	<title>My Team Sign</title>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fixed_s/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="fixed_s/vendor/select2/select2.min.css">
	
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head> 
<style type="text/css">
.table100.ver1 th {
    font-family: Lato-Bold;
    font-size: 18px;
    color: #fff;
    line-height: 1.4;
    background-color: #55608f;
    /* background-color: #6c7ae0; */
}

.table100-head th {
    padding-top: 18px;
    padding-bottom: 18px;
}
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
      font-size: 10px;
        }
  .zoom:hover{
    transform: scale(1.5);
  }
  tr:nth-child(even) {
    background-color: #dee2e6;
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
              <h2 class="text-dark display-12" >My team Attendance</h2>
      <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This table shows the minume time of sign in  ( by day) and the Maximum time of sign out(by Day)</p>

       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       
    <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> 
   </a></p></samp>
  </aside>
</div>
</center>


<form method="post" class="form-horizontal">  
<center>  

<div class="col-md-8" style="padding:20px;">
  <h2 style="color:;">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
    <div class="container-table100">
			<div class="wrap-table100">
		 	 <div class="table100 ver1 m-b-110">

 <div class="tableFixHead">

<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style=" background-color: #55608f;
    text-align: center;box-sizing: border-box;margin: 0px;
    padding: 0px;border-color: inherit;
    border-style: solid;
    border-width: 0;
  color: black; position: relative; ">
  <?php if($_SESSION['role_id'] > 1){?>
		<th style="color:#fff;"><center>Username</center></th>
		<th style="color:#fff;"><center> In Time</center></th>
		<th style="color:#fff;"><center>Out Time</center></th>
		<th style="color:#fff;"><center>Date</center></th>	
		<th style="color:#fff;"><center>IP user</center></th>
        <?php }?>
        <?php if($_SESSION['role_id'] == 1){?>
        <th style="color:#fff;"><center>Username</center></th>
        <th><center>Sign</center></th>
        <?php }?>
</tr>
 </thead>
  <tbody>
<?php 
$this_year = date('Y');
$engineer_id = $_SESSION['id'];
if($_SESSION['role_id'] == 1){
    /////
        $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE role_id = 0");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){

  $engineers_id = $output_engineers['id'];
  $rows="<tr>";
  $rows.= "<td class='cell100 column1' >".$output_engineers['username']."</td>";
//     $check_orders = sqlsrv_query( $con ,"SELECT distinct 
// employee.[id],
//       [in_and_out].[username]
//   FROM [Aya_Web_APP].[dbo].[in_and_out]
//   join employee on employee.username = [in_and_out].username  and engineer_id ='$engineers_id' order by [in_and_out].username");
//     /////


// 	$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE role_id = 0 ");
// 	while( $output_engineers = sqlsrv_fetch_array($check_engineers)){

// 	$engineers_id = $output_engineers['id'];
// 	$rows="<tr>";
// 	$rows.= "<td class='cell100 column1' >".$output_engineers['username']."</td>";
// 	 $check_orders = sqlsrv_query( $con ,"SELECT distinct 
// employee.[id],
//       [in_and_out].[username]
//   FROM [Aya_Web_APP].[dbo].[in_and_out]
//   join employee on employee.username = [in_and_out].username  and engineer_id ='$engineers_id' order by [in_and_out].username");

////////////////////////

  $rows.="<td class='cell100 column1 hovers' style='background-color:#212529;'><a style='color:#f3e5ab;font-size:13px;' href='attendance_sch.php?engineer_id=".$engineers_id."'>sign</a></td>";
  $rows.="</tr>";
  echo $rows;}

}
elseif($_SESSION['role_id'] == 2) {

 
//senior
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE manager_id = '$self'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  //orders numbers !!
$first_query = sqlsrv_query( $con ,"SELECT [username]
,cast([cur_date] as date ) [date]
      ,cast(min(IIF([type] = 'In',(cast([cur_date] as datetime) + cast([atime] as datetime)),null)) as time) [In]
      ,cast(max(IIF([type] = 'Out',(cast([cur_date] as datetime) + cast([atime] as datetime)),null)) as time) [Out],user_ip
    FROM [dbo].[in_and_out]
	where engineer_id = '$engineers_id'  and year([cur_date]) >='$this_year'
		group by [username],user_ip,cast([cur_date] as [date])  order by [cur_date]  DESC ");
  while( $output_query2 = sqlsrv_fetch_array($first_query)){
  	$rows ="<tr class='row100 body'>";
$rows.="<td class='cell100 column1'>".$output_query2['username']."</td>";
if ($output_query2["In"]== NULL){
	$rows .='<td class="cell100 column1 hovers">Blank</td>';
}else{
$rows .='<td class="cell100 column1 hovers">'.$output_query2["In"]->format('H:i:s').'</td>';}
if ($output_query2["Out"]== NULL){
	$rows .='<td class="cell100 column1 hovers">Blank</td>';
}else{
$rows .='<td class="cell100 column1 hovers">'.$output_query2["Out"]->format('H:i:s').'</td>';}
$rows .='<td class="cell100 column1 hovers">'.$output_query2["date"]->format('Y-m-d').'</td>';
$rows .= '<td class="cell100 column1 hovers">'.$output_query2["user_ip"].'</td>';
$rows .='</tr>';
echo $rows;
}
}}


if($_SESSION['role_id'] == 3){
     $user =$_SESSION["username"];
//super
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE super_id = '$self'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $super_id = $output_engineers['id'];

$check_orders = sqlsrv_query( $con ,"SELECT [username]
,cast([cur_date] as date ) [date]
      ,cast(min(IIF([type] = 'In',(cast([cur_date] as datetime) + cast([atime] as datetime)),null)) as time) [In]
      ,cast(max(IIF([type] = 'Out',(cast([cur_date] as datetime) + cast([atime] as datetime)),null)) as time) [Out],user_ip
    FROM [dbo].[in_and_out]
	where engineer_id = '$super_id'  and year([cur_date]) >='$this_year'
		group by [username],user_ip,cast([cur_date] as [date])  
		order by [cur_date]  DESC ");
  while( $output_query2 = sqlsrv_fetch_array($check_orders)){
  	$rows ="<tr class='row100 body'>";
$rows.="<td class='cell100 column1'>".$output_query2['username']."</td>";
if ($output_query2["In"]== NULL){
	$rows .='<td class="cell100 column1 hovers">Blank</td>';
}else{
$rows .='<td class="cell100 column1 hovers">'.$output_query2["In"]->format('H:i:s').'</td>';}
if ($output_query2["Out"]== NULL){
	$rows .='<td class="cell100 column1 hovers">Blank</td>';
}else{
$rows .='<td class="cell100 column1 hovers">'.$output_query2["Out"]->format('H:i:s').'</td>';}
$rows .='<td class="cell100 column1 hovers">'.$output_query2["date"]->format('Y-m-d').'</td>';
$rows .= '<td class="cell100 column1 hovers">'.$output_query2["user_ip"].'</td>';
$rows .='</tr>';
echo $rows;
}
}}
if($_SESSION['role_id'] == 4){
   $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE [section_id] = '$self'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  //orders numbers !!
$first_query = sqlsrv_query( $con ,"SELECT [username]
,cast([cur_date] as date ) [date]
      ,cast(min(IIF([type] = 'In',(cast([cur_date] as datetime) + cast([atime] as datetime)),null)) as time) [In]
      ,cast(max(IIF([type] = 'Out',(cast([cur_date] as datetime) + cast([atime] as datetime)),null)) as time) [Out],user_ip
    FROM [dbo].[in_and_out]
	where engineer_id = '$engineers_id'  and year([cur_date]) >='$this_year'
		group by [username],user_ip,cast([cur_date] as [date])  order by [cur_date]  DESC ");

  while( $output_query2 = sqlsrv_fetch_array($first_query)){
  	$rows ="<tr class='row100 body'>";
$rows.="<td class='cell100 column1'><center>".$output_query2['username']."</center></td>";
if ($output_query2["In"]== NULL){
	$rows .='<td class="cell100 column1 hovers"><center>Blank</td></center>';
}else{
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query2["In"]->format('H:i:s').'</center></td>';}
if ($output_query2["Out"]== NULL){
	$rows .='<td class="cell100 column1 hovers"><center>Blank</center></td>';
}else{
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query2["Out"]->format('H:i:s').'</center></td>';}
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query2["date"]->format('Y-m-d').'</center></td>';
$rows .= '<td class="cell100 column1 hovers"><center>'.$output_query2["user_ip"].'</center></td>';
$rows .='</tr>';
echo $rows;
}
}
}
if($_SESSION['role_id'] == 5){
   $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE [UnitManager_id] = '$self'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  //orders numbers !!
$first_query = sqlsrv_query( $con ,"SELECT [username]
,cast([cur_date] as date ) [date]
      ,cast(min(IIF([type] = 'In',(cast([cur_date] as datetime) + cast([atime] as datetime)),null)) as time) [In]
      ,cast(max(IIF([type] = 'Out',(cast([cur_date] as datetime) + cast([atime] as datetime)),null)) as time) [Out],user_ip
    FROM [dbo].[in_and_out]
	where engineer_id = '$engineers_id'  and year([cur_date]) >='$this_year'
		group by [username],user_ip,cast([cur_date] as [date])  order by [cur_date]  DESC ");

  while( $output_query2 = sqlsrv_fetch_array($first_query)){
  	$rows ="<tr class='row100 body'>";
$rows.="<td class='cell100 column1'>".$output_query2['username']."</td>";
if ($output_query2["In"]== NULL){
	$rows .='<td class="cell100 column1 hovers">Blank</td>';
}else{
$rows .='<td class="cell100 column1 hovers">'.$output_query2["In"]->format('H:i:s').'</td>';}
if ($output_query2["Out"]== NULL){
	$rows .='<td class="cell100 column1 hovers">Blank</td>';
}else{
$rows .='<td class="cell100 column1 hovers">'.$output_query2["Out"]->format('H:i:s').'</td>';}
$rows .='<td class="cell100 column1 hovers">'.$output_query2["date"]->format('Y-m-d').'</td>';
$rows .= '<td class="cell100 column1 hovers">'.$output_query2["user_ip"].'</td>';
$rows .='</tr>';
echo $rows;
}
}}

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


</form>

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
     <script src="js/table2excel.js" type="text/javascript">
</script>
<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "team-signs.xls"
            });
        }
    </script>
	<?php

 include ("footer.html");
 ?>
