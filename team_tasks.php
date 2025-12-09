
<?php
include ("pages.php");
$this_year = date('Y');
?>

	<title>My Team Tasks</title>

  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head> 
<style type="text/css">
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
  .zoom:hover{
    transform: scale(1.5);
  }
   td {
  padding:4px;
  font-size: 13px;
  color: black;
}

th {
  text-align: center;
  white-space: nowrap;
  text-overflow: ellipsis;
  font-size: 13px;
  color: #fff;
  line-height: 1.1;
}
  .btn {
   
   font-size: 13px;
    
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
          <h2 class="text-dark display-12" >My Team Tasks</h2>
          <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
      
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Here you can check all tasks that counted or listed on the company Tools ( out of system Tasks )</p>
  </aside>
</div>
</center>

<div style="padding:20px;">
<center>
  <h2 style="color:;">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
 <div class="tableFixHead">

<table class="table order-table"  cellspacing="0" id="tblCustomers" style="border-radius:20px 20px 20px 20px ;">
  <thead style=" background-color: #55608f;
    text-align: center;
  color: black;
  position: relative; ">
    <tr> 
  <th style="color:#fff;"><center>ID Num</center></th>
  <th style="color:#fff;"><center>Username</center></th>
  <th style="color:#fff;"><center>Start Time</center></th>
  <th style="color:#fff;"><center>End Time</center></th>
  <th style="color:#fff;"><center>Date</center></th>
  <th style="color:#fff;"><center>Type</center></th>
  <th style="color:#fff;"><center>Status</center></th>
  <th style="color:#fff;"><center>Notes</center></th>
</tr>
 </thead>
  <tbody>
<?php  
if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];
} 

if($_SESSION['role_id'] == 1)
{
  $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE role_id = 0");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];

$first_query = sqlsrv_query( $con ,"SELECT * FROM [Aya_Web_APP].[dbo].[create_task] where year([cur_date]) >='$this_year'
and  engineer_id = '$engineer_id'  order by 6 ");
while($output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .='<td class="cell100 column1 hovers"width="5%"><center>'.$output_query["s_id"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["username"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["stime"]->format('H:i:s').'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["etime"]->format('H:i:s').'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["cur_date"]->format('Y-m-d').'</center></td>';
$rows .= '<td class="cell100 column1 hovers"width="5%"><center>'.$output_query["type"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["status"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["notes"].'</center></td>';
$rows .='</tr>';

echo $rows;
}}
}    


if($_SESSION['role_id'] == 2)
{
  $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE manager_id ='$self' ");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $users = $output_engineers['username'];
}
$first_query = sqlsrv_query( $con ,"SELECT * FROM [Aya_Web_APP].[dbo].[create_task] where year([cur_date]) >='$this_year'
and engineer_id = '$engineer_id'   order by 6 ");
while($output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .='<td class="cell100 column1 hovers"width="5%"><center>'.$output_query["s_id"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["username"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["stime"]->format('H:i:s').'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["etime"]->format('H:i:s').'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["cur_date"]->format('Y-m-d').'</center></td>';
$rows .= '<td class="cell100 column1 hovers"width="5%"><center>'.$output_query["type"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["status"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["notes"].'</center></td>';
$rows .='</tr>';

echo $rows;
}
//}
}




if($_SESSION['role_id'] == 3) {
  
//senior
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE [super_id] = '$self'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['username_id'];  
  $users = $output_engineers['username'];
$check_orders = sqlsrv_query( $con ,"SELECT *
  FROM [Aya_Web_APP].[dbo].[create_task] WHERE engineer_id = '$engineer_id' and year([cur_date]) >='$this_year' ");
 while( $output_query = sqlsrv_fetch_array($check_orders)){

$rows  ='<tr>';
$rows .='<td class="cell100 column1 hovers"width="5%"><center>'.$output_query["s_id"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["username"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["stime"]->format('H:i:s').'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["etime"]->format('H:i:s').'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["cur_date"]->format('Y-m-d').'</center></td>';
$rows .= '<td class="cell100 column1 hovers"width="5%"><center>'.$output_query["type"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["status"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["notes"].'</center></td>';
$rows .='</tr>';

echo $rows;
}
}}


if($_SESSION['role_id'] == 4)
{
  $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE [section_id] =  '$self'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $users = $output_engineers['username'];

$first_query = sqlsrv_query( $con ,"SELECT * FROM [Aya_Web_APP].[dbo].[create_task] where year([cur_date]) >='$this_year'
and  engineer_id = '$engineer_id'  order by 6 ");
while($output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .='<td class="cell100 column1 hovers"width="5%"><center>'.$output_query["s_id"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["username"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["stime"]->format('H:i:s').'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["etime"]->format('H:i:s').'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["cur_date"]->format('Y-m-d').'</center></td>';
$rows .= '<td class="cell100 column1 hovers"width="5%"><center>'.$output_query["type"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["status"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["notes"].'</center></td>';
$rows .='</tr>';

echo $rows;
}}
}


if($_SESSION['role_id'] == 5)
{
  $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE [UnitManager_id] =  '$self'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $users = $output_engineers['id'];

$first_query = sqlsrv_query( $con ,"SELECT * FROM [Aya_Web_APP].[dbo].[create_task] where year([cur_date]) >='$this_year'and  username = '$users'  order by 6 ");
while($output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .='<td class="cell100 column1 hovers"width="5%"><center>'.$output_query["s_id"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["username"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["stime"]->format('H:i:s').'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["etime"]->format('H:i:s').'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["cur_date"]->format('Y-m-d').'</center></td>';
$rows .= '<td class="cell100 column1 hovers"width="5%"><center>'.$output_query["type"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["status"].'</center></td>';
$rows .='<td class="cell100 column1 hovers" width="5%"><center>'.$output_query["notes"].'</center></td>';
$rows .='</tr>';

echo $rows;
}}
}
?>

</tbody>
</table>
</form>
       </tbody>
      </table>
    </div>
  </div> 
</center>
</div>

  <script>
    $('.js-pscroll').each(function(){
      var ps = new PerfectScrollbar(this);

      $(window).on('resize', function(){
        ps.update();
      })
    });
      
    
  </script>
  <script src="table-filter.js"></script>
  <script src="js/table2excel.js" type="text/javascript"></script>


	<?php

 include ("footer.html");
 ?>

