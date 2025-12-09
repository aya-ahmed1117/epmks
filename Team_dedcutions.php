
<?php
include ("pages.php");
  //require_once("inc/config.inc");

?>
<title>My Team Deduction</title>
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="fixed_s/vendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="fixed_s/vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="fixed_s/vendor/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" href="fixed_s/css/util.css">
  <link rel="stylesheet" href="fixed_s/css/main.css">

  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head> 
<style type="text/css">
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
      font-size: 10px;
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

</style>

<center> 
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
      <h2 class="text-dark display-12" >My Team Deduction</h2>
      <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This table shows the minume time of sign in ( by day) and the Maximum time of sign out(by Day)</p>
  </aside>
</div>
</center>
<form method="post" class="form-horizontal">  
<center>  
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
        
          <th class="cell100 column1"><center>ID Num</center></th>
          <th class="cell100 column1"><center>Username</center></th>
          <th class="cell100 column1"><center>Date</center></th>
          <th class="cell100 column1"><center>Item</center></th>
          <th class="cell100 column1"><center>Duration</center></th>
          <th class="cell100 column1">Complain reason</th>
          <th class="cell100 column1"><center>Status</center></th>
         
    </tr>
  </thead>
</table>
</div>
<div class="table100-body js-pscroll" style="text-align:center;">
  <table class="order-table table">
    <tbody>
<?php 
if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];
}     

if($_SESSION['role_id'] == 1)
{

//$engineer_id = $_SESSION['id'];
$s_username = $_SESSION['username'];
$check_engineers  = $first_query = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_id'   ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'] ;
}

$first_query = $first_query = sqlsrv_query( $con ,"SELECT * FROM deduction WHERE username ='$eng_username' ");
  while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  = '<tr >';
$rows .='<td class="cell100 column1 ">'.$output_query["id"].'</td>';
$rows .='<td class="cell100 column1 hovers">'.$output_query["username"].'</td>';
$rows .='<td class="cell100 column1 hovers">'.$output_query["a_date"]->format('Y-m-d').'</td>';
$rows .='<td class="cell100 column1 hovers">'.$output_query["item"].'</td>';
$rows .= '<td class="cell100 column1 hovers">'.$output_query["a_time"]->format('H:i:s').'</td>';
$rows .= '<td class="cell100 column1 hovers">'.$output_query["type"].'</td>';
if($output_query["status"] == '')
  {
$rows .= '<td class="cell100 column1 hovers" style="background-color: #cc0000;color:white;">Added
</td>';} 

if($output_query["status"] == 'E-workforce reject')
  {
$rows .= '<td class="cell100 column1 hovers" style="background-color: #cc0000;color:white;">
'.$output_query["status"]."</td>";

  } 
if($output_query["status"] == 'pending')
  {
    $rows .= '<td class="cell100 column1 hovers" width="2%" style="
    border: 1px solid #eee;font-size:15px;background-color:#f8a300;color:white;">'.$output_query["status"].'</td>';
  }
if($output_query["status"] == 'senior approve')
  {
    $rows .= '<td class="cell100 column1 hovers" style="background-color:green;color:white;">'.$output_query["status"].'</td>';
  }
 if($output_query["status"] == 'E-workforce and senior approve'){
     $rows .= '<td class="cell100 column1 hovers"
    style="border: 1px solid #eee;font-size:15px;background-color:#A0DAA9;" class="hovers">'.$output_query["status"].'</td>';
  }
$rows .= '</tr>';

echo $rows;

  }}
if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];
}   
if($_SESSION['role_id'] >= 2){
 $check_engineers  = $first_query = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_id'  ");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){

  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'] ;
}

$first_query = sqlsrv_query( $con ,"SELECT * FROM deduction WHERE username ='$eng_username' and a_date > '2021-01-01' order by  a_date desc");
//php -> output data from mysqli
  while( $output_query = sqlsrv_fetch_array($first_query)){
 $rows  ='<tr >';
 $rows .='<td class="cell100 column1">'.$output_query["id"].'</td>';
$rows .='<td class="cell100 column1">'.$output_query["username"].'</td>';
$rows .='<td class="cell100 column1 hovers">'.$output_query["a_date"]->format('Y-m-d').'</td>';
$rows .='<td class="cell100 column1 hovers">'.$output_query["item"].'</td>';
$rows .='<td class="cell100 column1 hovers">'.$output_query["a_time"]->format('H:i:s').'</td>';
$rows .='<td class="cell100 column1 hovers">'.$output_query["type"].'</td>';
if($output_query["status"] == '')
  {
$rows .= '<td class="cell100 column1 hovers" style="background-color: #cc0000;color:white;">Added
</td>';} 

if($output_query["status"] == 'E-workforce reject')
  {
$rows .= '<td class="cell100 column1 hovers" style="background-color: #cc0000;color:white;">
'.$output_query["status"]."</td>";

  } 
if($output_query["status"] == 'pending')
  {
    $rows .= '<td class="cell100 column1 hovers" width="2%" style="
    border: 1px solid #eee;font-size:15px;background-color:#f8a300;color:white;">'.$output_query["status"].'</td>';
  }
if($output_query["status"] == 'senior approve')
  {
    $rows .= '<td class="cell100 column1 hovers" style="background-color:green;color:white;">'.$output_query["status"].'</td>';
  }
 if($output_query["status"] == 'E-workforce and senior approve'){
     $rows .= '<td class="cell100 column1 hovers"
    style="border: 1px solid #eee;font-size:15px;background-color:#A0DAA9;" class="hovers">'.$output_query["status"].'</td>';
  }
$rows .= '</tr>';

echo $rows;

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

  <script src="table-filter.js"></script>
	<?php

 include ("footer.html");
 ?>

