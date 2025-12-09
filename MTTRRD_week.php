
      <title>MTTR Raw data_week</title>
   <?php
      set_time_limit(400);
include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      $this_year =date('Y');
      ?>
<head>
<link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head> 
<style type="text/css">
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
</style>

<style type="text/css">
  .zoom:hover{
    transform: scale(1.5);
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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Mttr Per Week
      <a href="mwd_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>

<div style="padding: 20px;">
    <form method="post" >

    <div class="row">
      <div class="col col-md-4">
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1">Choose Week</span>
          <input type="week" class="form-control"  id="Week"
        name='week' aria-describedby="basic-addon1"
        value='<?php if(isset($_POST['week'])) echo $_POST['week']; ?>' required />        
      <div class="input-group-btn col-md-2">
        <button class="btn btn-primary"type='submit' name='submit' value="Get data" >Submit</button></div>
        
        </div>
      </div>
    </div>

<br>
</div>
<?php 
if(isset($_POST['week'])){
$myWeek = $_POST['week'];}
if(isset($_POST['submit'])){
  ?>
  <div style="padding: 20px;">
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
  
  <th><center>Year</center></th>
  <th><center>Week_num</center></th>
  <th><center>RequestID</center></th>
  <th><center>PSD_number</center></th>
  <th><center>creation_time</center></th>
  <th><center>MTTI1</center></th>
  <th><center>MTTI1_eng</center></th>
  <th><center>MTTI2</center></th>
  <th><center>MTTI2_user</center></th>
  <th><center>MTTI</center></th>
  <th><center>MTTF</center></th>
  <th><center>MTTF_user</center></th>
  <th><center>MTTV</center></th>
  <th><center>MTTV_eng</center></th>
  <th><center>MTTR</center></th>
  <th><center>Onhold_time</center></th>
  <th><center>Ticket_not_opened_time</center></th>
  <th><center>closure_reason</center></th>
  <th><center>closure_Reason_Eng</center></th>
  <th><center>Support_Rep</center></th>
  <th><center>First_Resp_Time</center></th>
  <th><center>First_resp_eng</center></th>
  <th><center>Category</center></th>
  <th><center>Subcategory</center></th>
  <th><center>Item</center></th>
  <th><center>nodeID</center></th>
  <th><center>Ticket_group</center></th>
  <th><center>subgroup</center></th>
  <th><center>Reopen</center></th>
  <th><center>Request_Mode</center></th>
  <th><center>lev</center></th>
  <th><center>onsite_status</center></th>
  <th><center>Min_In_Onsite</center></th>
  <th><center>Max_Out_Onsite</center></th>

  <th><center>Pickup Time</center></th>
  <th><center>Waiting Time</center></th>
		</tr>
		</thead>
	
  <tbody>

<?php
$new_q= sqlsrv_query( $con , "SELECT 
  groups
    FROM [Employess_DB].[dbo].[tbl_Personal_info]
    left join Employess_DB.dbo.Tbl_Groups on Group_ID = [Group]
    where username = '$s_username'");
  $out_new = sqlsrv_fetch_array($new_q);
  $my_group = $out_new['groups'];

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkForce_Reporting_DB";
  
  $connectionInfo = array( "Database"=>"WorkForce_Reporting_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con76 = sqlsrv_connect($DBhost, $connectionInfo);


if(($_SESSION['username'] == 'ahmed.mohamedbassal') ||
    ($_SESSION['username'] == 'mohamed.abdeltwab') ){
if(isset($_POST['week'])){$myWeek = $_POST['week'];
$newWeeks = date('W', strtotime($myWeek));
$year_week = date('Y', strtotime($myWeek));
   $new_query = sqlsrv_query( $con76 , "SELECT *  FROM [WorkForce_Reporting_DB].[dbo].[MTTR_Raw_Data_Week]
    where (ticket_group like 'private KAM%' or ticket_group like 'GDS%')
    and [WEEK_NUM] = '$newWeeks' and [YEAR] = '$year_week' ");

 		  while($output = sqlsrv_fetch_array($new_query) ){

      $rows = '<tr>';
	$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["YEAR"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["WEEK_NUM"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["REQUESTID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["PSD_NUMBER"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["CREATION_TIME"]->format('Y:m:d H:i:s').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTI1"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTI1_ENG"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTI2"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTI2_USER"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTI"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTF"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTF_USER"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTV"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTV_ENG"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTR"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["ONHOLD_TIME"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["TICKET_NOT_OPENED_TIME"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["CLOSURE_REASON"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["CLOSURE_REASON_ENG"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["SUPPORT_REP"].'</td>';
  
  if($output["FIRST_RESP_TIME"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#092834 ; font-size:13px ;color:white;">
Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["FIRST_RESP_TIME"]->format('Y:m:d H:i:s').'</td>';}
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["FIRST_RESP_ENG"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["CATEGORY"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["SUBCATEGORY"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["ITEM"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["NODEID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["TICKET_GROUP"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["SUBGROUP"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["REOPEN"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["REQUEST_MODE"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Lev"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Onsite_Status"].'</td>';
if($output["Min_In_Onsite"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#092834 ; font-size:13px ;color:white;">
</td>';
  }else{
   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Min_In_Onsite"]->format('Y-m-d H:i:s').'</td>';}
if($output["Max_Out_Onsite"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#092834 ; font-size:13px ;color:white;">
</td>';
  }else{
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Max_Out_Onsite"]->format('Y-m-d H:i:s').'</td>';}
///
  

    if($output["Pickup_Time"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#092834 ; font-size:13px ;color:white;">
      </td>';
        }else{
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Pickup_Time"].'</td>';}

       if($output["Waiting_Time"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#092834 ; font-size:13px ;color:white;">
      </td>';
        }else{
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Waiting_Time"].'</td>';}

        $rows .= '</tr>';
        echo $rows;

}
}
}else{
  
  if(isset($_POST['week'])){$myWeek = $_POST['week'];
$newWeeks = date('W', strtotime($myWeek));
$year_week = date('Y', strtotime($myWeek));

  $new_query = sqlsrv_query( $con76,"SELECT * FROM [WorkForce_Reporting_DB].[dbo].[MTTR_Raw_Data_Week]
    where 
    [YEAR] = '$year_week' and [WEEK_NUM] = '$newWeeks'
    and (('$my_group' = 'BS-CO' AND Ticket_group LIKE 'BS-CO%')
                    OR ('$my_group' <> 'BS-CO' AND Ticket_group LIKE '$my_group%' AND Ticket_group NOT LIKE 'BS-CO%'))

    ");

      while($output = sqlsrv_fetch_array($new_query) ){
         $rows = '<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["YEAR"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["WEEK_NUM"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["REQUESTID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["PSD_NUMBER"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["CREATION_TIME"]->format('Y:m:d H:i:s').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTI1"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTI1_ENG"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTI2"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTI2_USER"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTI"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTF"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTF_USER"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTV"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTV_ENG"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MTTR"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["ONHOLD_TIME"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["TICKET_NOT_OPENED_TIME"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["CLOSURE_REASON"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["CLOSURE_REASON_ENG"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["SUPPORT_REP"].'</td>';
  
  if($output["FIRST_RESP_TIME"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#092834 ; font-size:13px ;color:white;">
Blank</td>';
  }else{
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["FIRST_RESP_TIME"]->format('Y:m:d H:i:s').'</td>';}
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["FIRST_RESP_ENG"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["CATEGORY"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["SUBCATEGORY"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["ITEM"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["NODEID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["TICKET_GROUP"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["SUBGROUP"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["REOPEN"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["REQUEST_MODE"].'</td>';
   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Lev"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Onsite_Status"].'</td>';

if($output["Min_In_Onsite"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#092834 ; font-size:13px ;color:white;">
</td>';
  }else{
   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Min_In_Onsite"]->format('Y-m-d H:i:s').'</td>';}
if($output["Max_Out_Onsite"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#092834 ; font-size:13px ;color:white;">
</td>';
  }else{
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Max_Out_Onsite"]->format('Y-m-d H:i:s').'</td>';}
    ///
   
    // if($output["Pickup_Time"] == NULL ){
    // $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#092834 ; font-size:13px ;color:white;">
    //   </td>';
    //     }else{
    // $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Pickup_Time"]->format('H:i:s').'</td>';}

    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Pickup_Time"].'</td>';

      if($output["Waiting_Time"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#092834 ; font-size:13px ;color:white;">
      </td>';
        }else{
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Waiting_Time"].'</td>';}


        $rows .= '</tr>';
        echo $rows;
}
}
}}
?>
 </tbody>
</table>
</div>
</div>

</form>
</div>

<?php 

?>
<script type="text/javascript">
  
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "mttr_per_week.xls"
            });
        }
    </script>


<script src="js/table2excel.js" type="text/javascript"></script>

<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>
