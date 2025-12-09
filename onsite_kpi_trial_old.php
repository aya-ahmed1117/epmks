
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
  <title>Violation per month</title>
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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Onsite KPI
      <!-- <a href="mwd_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a>-->
    
  </h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" href="onsite_kpi_excel.php?export&month=<?php if(isset($_POST['month'])) echo $_POST['month']; ?>" download="Onsite_kpi.xls">
        <img src="images/aaa-removebg-preview.png" 
        class="zoom"  style="width:10%;"/> </a></p></samp>
         
    </aside>
  </div>
</center>
<br>
<?php 
// if($_SESSION['username'] == 'aya.abdelfattah'){
// $this_year = date('Y');
// echo '<input type="date" value="' . $this_year->format('Y-m') . '" />';
// }
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
if($_SESSION['username'] == 'aya.abdelfattah'){

  $tableName = "[Preperaing_DB].[dbo].[onsite_new_kpi_trial]";
$query = "SELECT * FROM [Preperaing_DB].[dbo].[onsite_new_kpi_trial] ";

$result = sqlsrv_query($connect, $query);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}
echo '<pre>';
print_r( sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC));

//$columnNames = array();
// while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
//    // $columnNames[] = $row['COLUMN_NAME'];
// }
//print_r($columnNames);
 }  


 if(isset($_POST['submit'])){
?>

<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter"data-table="order-table"placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color:#55608f;border: 1px solid white; ">
    
<?php
      $_GET['month']="month";
    global $month;
  echo '<tr>  
      <th ><center>requestid</center></th>
      <th ><center>creation_time</center></th>
      <th ><center>Trasmission_media</center></th>
      <th ><center>ECRM_Product</center></th>
      <th ><center>OrderID</center></th>
      <th ><center>CustomerZone</center></th>
      <th ><center>Reopen</center></th>
      <th ><center>Min_In_Onsite</center></th>
      <th ><center>Max_Out_Onsite</center></th>
      <th ><center>onsite_Escatation_times</center></th>
      <th ><center>previous_group</center></th>
      <th ><center>onsite_durations</center></th>
      <th ><center>onsite_engineer</center></th>
      <th ><center>eng_checked</center></th>
      <th ><center>checking_durations</center></th>
      <th ><center>Checking_timess</center></th>
      <th ><center>In_Onsite</center></th>
      <th ><center>In_Onsite_times</center></th>
      <th ><center>Out_onsite</center></th>
    </tr>';?>
    </thead>
  <tbody>
<?php
//month 
if(isset($_POST['month'])){$myMonth= $_POST['month'];

  $newMonth = date('n', strtotime($myMonth));
  $newYear =  date('Y', strtotime($myMonth));

  $new_query = sqlsrv_query($connect , "SELECT top 100 *
  FROM [Preperaing_DB].[dbo].[onsite_new_kpi_trial]
  where month([creation_time]) = '$newMonth' ");
  //and [year] ='$newYear'
  
 		  while($echo = sqlsrv_fetch_array($new_query) ){

 $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['requestid'].'</td>';
$rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$echo['creation_time']->format('Y-m-d H:i:s').'</td>';
$rows .='<td class="hovers"style="border: 1px solid lightgray;">'.$echo['Trasmission_media'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['ECRM_Product'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['OrderID'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['CustomerZone'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Reopen'].'</td>';
if($echo['Min_In_Onsite'] == NULL){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;"></td>';
}else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Min_In_Onsite']->format('Y-m-d H:i:s').'</td>';
}
if($echo['Max_Out_Onsite'] == NULL){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;"></td>';
}else{
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Max_Out_Onsite']->format('Y/m/d').'</td>';
}
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['onsite_Escatation_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['previous_group'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['onsite_durations'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.$echo['onsite_engineer'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['eng_checked'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['checking_durations'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Checking_timess'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.$echo['In_Onsite'].'</td>';
$rows .='<td sclass="hovers" style="border: 1px solid lightgray;">'.$echo['In_Onsite_times'].'</td>';
$rows .='<td sclass="hovers" style="border: 1px solid lightgray;">'.$echo['Out_onsite'].'</td>';

$rows .= '</tr>';
		  	echo $rows;

    }
  }
}
?>
                </tbody>
              </table>
            </div>
          </form>
        </div>
      </div>

<script type="text/javascript">
    /*    function Export() {
            $("#tblCustomers").table2excel({
                filename: "onsite_kpi_month.xls"
            });
        }*/
    </script>

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
