
<?php
include ("pages.php");

?>
<title>Schedule summary</title>
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
              <h2 class="text-dark display-12" >Update Schedule For Employee</h2>
      <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">0......0</p>
  </aside>
</div>
</center>

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
<th class="cell100 column1"><center>Username</center></th>
<th class="cell100 column1"><center>schedule</center></th>

        </tr>
    </thead>
</table>
</div>
<div class="table100-body js-pscroll" style="text-align:center;">
    <table class="order-table table">
        <tbody>

<?php 
$engineer_id = $_SESSION['id'];
if($_SESSION['role_id'] == 1){
 
//admin can view all engineers ..
$check_engineers = $first_query = sqlsrv_query( $con ,"SELECT * FROM employee WHERE role_id = 0");
while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){

  $engineers_id = $output_engineers['id'];
 
  $rows ="<tr>";
  $rows.="<td class='cell100 column1'>
  ".$output_engineers['username']."</td>";

$check_orders = $first_query = sqlsrv_query( $con ,"SELECT distinct 
employee.[id],
      [schedule_table].[username]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  join employee on employee.username = [schedule_table].username

   engineer_id = '$engineers_id' ");
//$orders_num = mysqli_num_rows($check_orders);
$orders_num = 1 ;

  $rows.="<td class='cell100 column1 hovers'style='background-color:#55608f;'>
  <a style='color:yellow;font-size:13px;' href='schedule_update_demo.php?engineer_id=".$engineers_id."'>Schedule</a></td>";

  $rows.="</tr>";
  echo $rows;

}

}
?>


</table>
</tbody>
</div>

</div>
</div>
</div></div></div>
<script src="table-filter.js"></script>

<?php

 include ("footer.html");
 ?>