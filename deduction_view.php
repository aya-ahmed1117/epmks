
<?php
include ("pages.php");
?>

	<title>Schedule</title>

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
</style>
<div style="padding:20px;">
<center>
  
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Deduction</h2>
      <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This page shows all deduction added on you and thier status ( Pending manager approval / Rejected )</p>
  </aside>
  </div>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>    <br>


    <div class="col-md-8">
<div class="tableFixHead">

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color:#55608f;border: 1px solid white; ">
    <tr>
          <th style="color:#fff;">ID </th>
          <th style="color:#fff;">Day</th>
          <th style="color:#fff;">Item</th>
          <th style="color:#fff;">Time</th>
          <th style="color:#fff;">Approved by</th>
          <th style="color:#fff;">Comment </th>
          <th style="color:#fff;">Status </th>
</tr>
</thead>
<tbody style="background-color:white;">
<?php  
/*
senior approve
senior reject
super approve
section approve
Unit approve
*/    
$cur_year = date('Y');
$engineer_id = $_SESSION['id'];
$s_username = $_SESSION['username'];
$first_query = sqlsrv_query( $con ,"SELECT * FROM deduction WHERE 
	username ='$s_username' and year(a_date) >= '$cur_year' order by [a_date] desc ");
  while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["id"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["a_date"]->format('Y-m-d').'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["item"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["a_time"]->format('H:i:s').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["senior_approve"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["wfm_note"].'</td>';

if($output_query["status"] == '')
  {
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">Added
</td>';} 

if(($output_query["status"] == 'E-workforce reject') || ($output_query["status"] == 'senior reject')
  || ($output_query["status"] == 'super reject')
  || ($output_query["status"] == 'section reject')
  || ($output_query["status"] == 'Unit reject')
)
  {
$rows .= '<td class="hovers" style="border: 1px solid lightgray;background-color:tomato;color:white;">
'.$output_query["status"]."</td>";

  } 
if($output_query["status"] == 'pending')
  {
    $rows .= '<td class="hovers" style="border: 1px solid lightgray;background-color:#ffeb00e0;color:white;">'.$output_query["status"].'</td>';
  }
  if($output_query["status"] == 'On hold')
  {
    $rows .= '<td class="hovers" style="border: 1px solid lightgray;background-color:#f8a300;color:white;">'.$output_query["status"].'</td>';
  }
if($output_query["status"] == 'senior approve')
  {
    $rows .= '<td class="hovers" style="border: 1px solid lightgray;background-color:green;color:white;">'.$output_query["status"].'</td>';
  }
  if($output_query["status"] == 'super approve')
  {
    $rows .= '<td class="hovers" style="border: 1px solid lightgray;background-color:green;color:white;">'.$output_query["status"].'</td>';
  }
  if($output_query["status"] == 'section approve')
  {
    $rows .= '<td class="hovers" style="border: 1px solid lightgray;background-color:green;color:white;">'.$output_query["status"].'</td>';
  }
   if($output_query["status"] == 'Unit approve')
  {
    $rows .= '<td class="hovers" style="border: 1px solid lightgray;background-color:green;color:white;">'.$output_query["status"].'</td>';
  }
 if($output_query["status"] == 'E-workforce and senior approve'){
     $rows .= '<td class="hovers" style="border: 1px solid lightgray;background-color:#A0DAA9;">'.$output_query["status"].'</td>';
  }
$rows .= '</tr>';

echo $rows;
}
?>

</tbody>
</table>
</div>
</div>
</center>
</div>
  <script src="fixed_s/vendor/select2/select2.min.js"></script>



  <script src="table-filter.js"></script>
	<?php

 include ("footer.html");
 ?>

