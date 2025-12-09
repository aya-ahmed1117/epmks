

<?php
include ("pages.php");
$this_year = date('Y');
 //session_start(); 
date_default_timezone_set('Africa/Cairo');
set_time_limit(600);
$DBhost = "172.29.29.76";
$DBuser = "Seniors";
$DBpass = "123456789";
$DBname = "WorkForce_Reporting_DB";

$connectionInfo = array( "Database"=>"WorkForce_Reporting_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
$con_R = sqlsrv_connect($DBhost, $connectionInfo);

$DBhost = "172.29.29.76";
$DBuser = "Seniors";
$DBpass = "123456789";
$DBname = "Employess_DB";

$connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
$con1 = sqlsrv_connect($DBhost, $connectionInfo);
$check_group = sqlsrv_query( $con1,"SELECT [ID]
  ,[UserName]
  ,[Unit]
  ,[Groups],[SubGroups]
  FROM [Employess_DB].[dbo].[tbl_Personal_info]
  left join [Employess_DB].[dbo].[Tbl_Groups] on [Employess_DB].[dbo].[Tbl_Groups].[Group_ID]=[Group]
  left join [Employess_DB].[dbo].[Tbl_SubGroups] on [Employess_DB].[dbo].[Tbl_SubGroups].[subGroup_ID]=[sub_Group]
  where username ='$s_username' ");
$group = sqlsrv_fetch_array($check_group);
$my_group =$group['Groups']; 

?>
<title>Raw data per month</title>
<link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

<style type="text/css">

.tableFixHead         
{ 
  overflow-y: auto; height:500px; overflow-x: auto; 
}
.tableFixHead thead th 
{ 
  position: sticky; top: 0; 
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
        <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Raw data per month
          <a href="mwd_reports.php">
            <button type="button" id="sidebarCollapse" class="btn btn-warning" >
              <i class="fa fa-backward"></i> Back
            </button></a></h2>
          </div>
        </div>
      </div>
      <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       
        <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> 
      </a></p></samp>
    </aside>
  </div>
</center>
<br>


<div style="padding: 20px;">

 <form method="post" >

  <div class="row">
    <div class="col-lg-3">
      <div class="input-group col-2">
        <span class="input-group-text" id="basic-addon1">Choose Month</span>
        <input type="month" class="form-control"  id="months"
        name='month' aria-describedby="basic-addon1"
        value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>' required />
      </div>
    </div>

    <div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >
    Submit</button>
  </div>
</div>
</div>

<br>

</div>
<?php
if(isset($_POST['month'])){
  $myMonth = $_POST['month'];}
  if(isset($_POST['submit'])){

    ?>
    <div style="padding: 20px;">
      <h2 style="color:; ">Table Filter</h2>
      <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
      <br>
      <br>
      <div class="tableFixHead">
        <table class="table order-table"  cellspacing="0" id="tblCustomers" >
          <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
            <tr>
              <th ><center>Year</center></th>
              <th ><center>Month</center></th>
              <th ><center>RequestID</center></th>
              <th><center>PSD_number</center></th>
              <th><center>creation_time</center></th>
              <th><center>MTTI1</center></th>
              <th><center>MTTI1_eng</center></th>
              <th><center>MTTI2</center></th>
              <th><center>MTTI2_user</center></th>
              <th><center>MTTI</center></th>
              <th><center>MTTF</center></th>
              <th><center>MTTF user</center></th>
              <th><center>MTTV</center></th>
              <th><center>MTTV_eng</center></th>
              <th><center>MTTR</center></th>
              <th><center>Onhold_time</center></th>
              <th><center>Ticket_not_opened_time</center></th>
              <th><center>closure reason</center></th>
              <th><center>closure_Reason_Eng</center></th>
              <th><center>Support_Rep</center></th>
              <th><center>First_Resp_Time</center></th>
              <th><center>First_resp_eng</center></th>
              <th><center>Category</center></th>
              <th ><center>Subcategory</center></th>
              <th ><center>Item</center></th>
              <th ><center>nodeID</center></th>
              <th ><center>Ticket_group</center></th>
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
            if(($_SESSION['username'] == 'ahmed.mohamedbassal') ||
              ($_SESSION['username'] == 'mohamed.abdeltwab') ){
//month 
              if(isset($_POST['month'])){$myMonth= $_POST['month'];
//'$this_year'
            $newMonth = date('n', strtotime($myMonth));
            $newYear = date('Y', strtotime($myMonth));
            $mttr = sqlsrv_query($con_R,"SELECT DISTINCT  *
              FROM [WorkForce_Reporting_DB].[dbo].[MTTR_Raw_Data_Previous_Month]
              where [MONTH] = '$newMonth' and [YEAR] >='$newYear'

              and (TICKET_GROUP like 'private KAM%' or TICKET_GROUP like 'GDS%')
              ");

            while ($output = sqlsrv_fetch_array($mttr) ){
             $rows  ='<tr>';
             $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["YEAR"].'</td>';
             $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MONTH"].'</td>';
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
              $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
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
              $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Onsite_status"].'</td>';
              if($output["Min_In_Onsite"] == NULL ){
                $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#092834 ; font-size:13px ;color:white;">
                </td>';
              }else{
               $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Min_In_Onsite"]->format('Y-m-d H:i:s').'</td>';}
               if($output["Max_Out_Onsite"] == NULL ){
                $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#092834 ; font-size:13px ;color:white;">
                </td>';
              }else{
                $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Max_Out_Onsite"]->format('H:i:s').'</td>';}

                

                $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Pickup_Time"].'</td>';

                if($output["Waiting_Time"] == NULL ){
                  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#092834 ; font-size:13px ;color:white;">
                  </td>';
                }else{
                  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Waiting_Time"].'</td>';}


                  $rows .='</tr>';
                  echo $rows;

                }
              }
            }
 /* if($_SESSION['role_id'] == 1 ){
//month 
if(isset($_POST['month'])){$myMonth= $_POST['month'];}
//'$this_year'
$newMonth = date('n', strtotime($myMonth));
   $mttrM = sqlsrv_query($con_R,"SELECT DISTINCT  *
  FROM [WorkForce_Reporting_DB].[dbo].[MTTR_Raw_Data_Previous_Month]
  where [MONTH] = '$newMonth' and [YEAR] >='$this_year' and TICKET_GROUP in ('BS'
,'Banking'
,'GOV'
,'Mega Projects'
,'GDS(Global Partner)'
,'Private KAM')");


   while ($output = sqlsrv_fetch_array($mttrM) ){
   $rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["YEAR"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MONTH"].'</td>';
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
    $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
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
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Onsite_status"].'</td>';
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

$rows .='</tr>';
echo $rows;

    }
  }*/
  else{

    if(isset($_POST['month'])){$myMonth= $_POST['month'];
//'$this_yea
    $newMonth = date('n', strtotime($myMonth));
    $newYear = date('Y', strtotime($myMonth));

    $mttr = sqlsrv_query($con_R,"SELECT DISTINCT *
      FROM [WorkForce_Reporting_DB].[dbo].[MTTR_Raw_Data_Previous_Month]
      where [MONTH] ='$newMonth' and [YEAR] >= '$newYear' and 
      [TICKET_GROUP] like '$my_group%'");

    while ($output = sqlsrv_fetch_array($mttr) ){
     $rows  ='<tr>';
     $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["YEAR"].'</td>';
     $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MONTH"].'</td>';
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
      $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
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
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Onsite_status"].'</td>';
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

        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Pickup_Time"].'</td>';

        if($output["Waiting_Time"] == NULL ){
          $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#092834 ; font-size:13px ;color:white;">
          </td>';
        }else{
          $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Waiting_Time"].'</td>';}

          $rows .='</tr>';
          echo $rows;

        }
      }
    }
  }
  ?>

</tbody>
</table>
</div>
</div>
</form>
</div>

<script src="js/table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
  function Export() {
    $("#tblCustomers").table2excel({
      filename: "mttr_per_month.xls"
    });
  }
</script>
<script src="table-filter.js"></script>

<?php
include ("footer.html");
?>