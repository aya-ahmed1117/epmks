
<?php
 //session_start();
set_time_limit(400);
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkforceDB_indexed";
  
  $connectionInfo = array( "Database"=>"WorkforceDB_indexed" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $connect = sqlsrv_connect($DBhost, $connectionInfo);

include ("pages.php");
?>
<head>
  <title>Onsite_kpi_trial</title>
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

<style type="text/css">
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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Onsite KPI</h2>
              </div>
          </div>
      </div>
       <samp>
        <p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button
          <a role="button" id="btnExport" value="Export to Excel" href="onsite_kpi_trial_new.php?export&month=<?php if(isset($_POST['month'])) echo $_POST['month']; ?>" download="Onsite_kpi.xls">
        <img src="images/aaa-removebg-preview.png" 
        class="zoom"  style="width:10%;"/> 
         </a>
        </p>
       </samp>
         
    </aside>
  </div>
</center>
<br>
<?php 

if($_SESSION['role_id'] > 0){
  ?>
<div style="padding: 20px;">
  <form method="post" >
    <div class="row">
      <div class="col col-md-4">
        <div class="input-group">
  <span class="input-group-text" id="basic-addon1">Choose Month</span>
  <input name="month" type="month" id="month" class="form-control" aria-describedby="basic-addon1"
  required="" value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>'>
    <button class="btn btn-primary"type='submit' name='submit' value="Get data" style="width: 20%;" >Submit</button>
</div>

    
  </div>
</div>

<br>
 <?php
if(isset($_POST['month'])){
$myWeek = $_POST['month'];}

}


 if(isset($_POST['submit'])){
?>

<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter"data-table="order-table"placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">

<?php
//month 
if(isset($_POST['month'])){$myMonth= $_POST['month'];

  $newMonth = date('n', strtotime($myMonth));
  $newYear =  date('Y', strtotime($myMonth));
}
?>
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <?php 
  if(isset($_GET['month'])){
    $myMonth= $_GET['month'];
     }


  $newMonth = date('n', strtotime($myMonth));

  

 
  $result = sqlsrv_query($connect , "SELECT top 100 *
    FROM [Preperaing_DB].[dbo].[onsite_new_kpi_trial]
    where month([creation_time]) = '$newMonth' and year([creation_time]) ='$newYear' order by creation_time ");
    if ($result === false) {
      die(print_r(sqlsrv_errors(), true));
      }
    while($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC) ){
      $data[] =  $row;
    // print_r($row);
    }
    // Check if data is empty
      if (empty($data)) {
          echo '<div class="alert alert-warning">No data found</div>';
      } else {
       

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
}
    ?>

       </tbody>
      </table>
    <?php }?>
            </div>
          </form>
        </div>
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
 include ("footer.html");
 ?>
