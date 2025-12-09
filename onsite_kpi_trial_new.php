<?php
set_time_limit(400);
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkforceDB_indexed";
  
  $connectionInfo = array( "Database"=>"WorkforceDB_indexed" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $connect = sqlsrv_connect($DBhost, $connectionInfo);
?>
<head>
  <title>Onsite kpi trial</title>
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

<style type="text/css">
  .zoom:hover{
    transform: scale(1.5);
  }
</style>
    
 <?php
 $data =[];

 if(isset($_get['export']))
  ?>


<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <?php 
  if(isset($_GET['month'])){
    $myMonth= $_GET['month'];
    }

  $newMonth = date('n', strtotime($myMonth));
  $newYear =  date('Y', strtotime($myMonth));

 
  $result = sqlsrv_query($connect , "SELECT  *
  FROM [Preperaing_DB].[dbo].[onsite_new_kpi_trial]
    where month([creation_time]) = '$newMonth' and year([creation_time]) ='$newYear' order by creation_time");
  if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
    }
  while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC) ){
    $data[] =  $row;
  // print_r($row);
  }
  

  ?>
  <thead style="color: white;font-size: 15px;background-color:#55608f;border: 1px solid white; ">
    <tr>
    <?php 
    foreach( array_keys($data[0]) as $column)
      echo'<th>'.$column.'</th>';

    ?>
  </tr>
  </thead>
  <tbody>
      <?php 
      //echo '<pre>';
    foreach( $data as $row){
      echo'<tr>';
      foreach( $row as $value){
        if ($value != "" || $value != null) {
          if($value instanceof DateTime){
            echo'<td>'.$value->format('Y-m-d H:i:s').'</td>';
          } else if($value instanceof Date){
            echo'<td>'.$value->format('Y-m-d').'</td>'; 
          } else {
            echo'<td>'.$value.'</td>';
          }
        } else {
          echo'<td>N/A</td>';
        }
    
     }
     echo'</tr>';
   }

    ?>

       </tbody>
      </table>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        $(".se-pre-con").fadeOut("slow");;
    });
</script>
<script src="js/excel_zip.js" type="text/javascript"></script>
<script src="table-filter.js"></script>

  <?php

 //include ("footer.html");
 ?>
