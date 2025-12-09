
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

   //include ("pages.php");
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
if(isset($_GET['month'])){
$myWeek = $_GET['month'];}
if(isset($_get['export']))
  ?>


<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color:#55608f;border: 1px solid white; ">
    
<?php
    //   $_GET['month']="month";
    // global $month;
 //if(isset($_POST['submit'])){
  echo '<tr>  
      <th>requestid</th>
      <th>creation_time</th>
      <th>Trasmission_media</th>
      <th>ECRM_Product</th>
      <th>OrderID</th>
      <th>CustomerZone</th>
      <th>Reopen</th>
      <th>Min_In_Onsite</th>
      <th>Max_Out_Onsite</th>
      <th>onsite_Escatation_times</th>
      <th>previous_group</th>
      <th>onsite_durations</th>
      <th>onsite_engineer</th>
      <th>eng_checked</th>
      <th>checking_durations</th>
      <th>Checking_timess</th>
      <th>In_Onsite</th>
      <th>In_Onsite_times</th>
      <th>Out_onsite</th>
      <th>Out_onsite_times</th>
      <th>TE fiber Team is working</th>
      <th>TE fiber Team is working_times</th>
      <th>Tech to CO .5 hours</th>
      <th>Tech to CO .5 hours_times</th>
      <th>Tech to CO 1 hours</th>
      <th>Tech to CO 1 hours_times</th>
      <th>Tech to CO 1.5 hours</th>
      <th>Tech to CO 1.5 hours_times</th>
      <th>Tech to CO 2 hours</th>
      <th>Tech to CO 2 hours_times</th>
      <th>Tech to CO 2.5 hours</th>
      <th>Tech to CO 2.5 hours_times</th>
      <th>Tech to CO 3 hours</th>
      <th>Tech to CO 3 hours_times</th>
      <th>Tech to CO 3.5 hours</th>
      <th>Tech to CO 3.5 hours_times</th>
      <th>Tech to CO 4 hours</th>
      <th>Tech to CO 4 hours_times</th>
      <th>Tech to CUS .5 hours</th>
      <th>Tech to CUS .5 hours_times</th>
      <th>Tech to CUS 1 hours</th>
      <th>Tech to CUS 1 hours_times</th>
      <th>Tech to CUS 1.5 hours</th>
      <th>Tech to CUS 1.5 hours_times</th>
      <th>Tech to CUS 2 hours</th>
      <th>Tech to CUS 2 hours_times</th>
      <th>Tech to CUS 2.5 hours</th>
      <th>Tech to CUS 2.5 hours_times</th>
      <th>Tech to CUS 3 hours</th>
      <th>Tech to CUS 3 hours_times</th>
      <th>Tech to CUS 3.5 hours</th>
      <th>Tech to CUS 3.5 hours_times</th>
      <th>Tech to CUS 4 hours</th>
      <th>Tech to CUS 4 hours_times</th>
      <th>Waiting for devices to reach LAB At HQ</th>
      <th>Waiting for devices to reach LAB At HQ_times</th>
      <th>Waiting Tower labor Availability</th>
      <th>Waiting Tower labor Availability_times</th>
      <th>Checking</th>
      <th>Checking_times</th>
      <th>Checking with TE fiber Team</th>
      <th>Checking with TE fiber Team_times</th>
      <th>Confirmation</th>
      <th>Confirmation_times</th>
      <th>Device Ready</th>
      <th>Device Ready_times</th>
      <th>Friday</th>
      <th>Friday_times</th>
      <th>Invalid</th>
      <th>Invalid_times</th>
      <th>Monday</th>
      <th>Monday_times</th>
      <th>Monitor</th>
      <th>Monitor_times</th>
      <th>MSAN</th>
      <th>MSAN_times</th>
      <th>Need Technician</th>
      <th>Need Technician_times</th>
      <th>No available tech.</th>
      <th>No available tech._times</th>
      <th>Operation Configuration</th>
      <th>Operation Configuration_times</th>
      <th>Pending customer Action</th>
      <th>Pending customer Action_times</th>
      <th>Saturday</th>
      <th>Saturday_times</th>
      <th>Sunday</th>
      <th>Sunday_times</th>
      <th>Tech on way after ticket</th>
      <th>Tech on way after ticket_times</th>
      <th>Tech waiting dispatching devices</th>
      <th>Tech waiting dispatching devices_times</th>
      <th>Tech waiting shipped devices</th>
      <th>Tech waiting shipped devices_times</th>
      <th>Tech work same area</th>
      <th>Tech work same area_times</th>
      <th>Tech work same pop</th>
      <th>Tech work same pop_times</th>
      <th>Telecom Egypt Problem</th>
      <th>Telecom Egypt Problem_times</th>
      <th>Thursday</th>
      <th>Thursday_times</th>
      <th>Tomorrow</th>
      <th>Tomorrow_times</th>
      <th>Tuesday</th>
      <th>Tuesday_times</th>
      <th>Waiting account manager</th>
      <th>Waiting account manager_times</th>
      <th>Waiting another Party</th>
      <th>Waiting another Party_times</th>
      <th>Waiting CUS Feedback</th>
      <th>Waiting CUS Feedback_times</th>
      <th>Waiting Device from Stock</th>
      <th>Waiting Device from Stock_times</th>
      <th>Waiting Device shipping</th>
      <th>Waiting Device shipping_times</th>
      <th>Waiting ESOC</th>
      <th>Waiting ESOC_times</th>
      <th>Waiting ESP</th>
      <th>Waiting ESP_times</th>
      <th>Waiting for fiber vendor</th>
      <th>Waiting for fiber vendor_times</th>
      <th>Waiting HG Approval</th>
      <th>Waiting HG Approval_times</th>
      <th>Waiting LAB</th>
      <th>Waiting LAB_times</th>
      <th>Waiting Permission</th>
      <th>Waiting Permission_times</th>
      <th>Waiting SD</th>
      <th>Waiting SD_times</th>
      <th>Waiting Stock</th>
      <th>Waiting Stock_times</th>
      <th>Waiting Wireless Vendor</th>
      <th>Waiting Wireless Vendor_times</th>
      <th>Wednesday</th>
      <th>Wednesday_times</th>
      <th>Working After 4</th>
      <th>Working After 4_times</th>
      <th>Working now</th>
      <th>Working now_times</th>
    </tr>
    </thead>
  <tbody>';

//month 
if(isset($_GET['month'])){$myMonth= $_GET['month'];

  $newMonth = date('n', strtotime($myMonth));
  //$newYear = date('Y', strtotime($myMonth));

  $new_query = sqlsrv_query($connect , "SELECT  *
  FROM [Preperaing_DB].[dbo].[onsite_new_kpi_trial]
  where month([creation_time]) = '$newMonth'");
  
  
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
$rows .='<td sclass="hovers" style="border: 1px solid lightgray;">'.$echo['Out_onsite_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.$echo['TE fiber Team is working'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['TE fiber Team is working_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO .5 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray;">'.$echo['Tech to CO .5 hours_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO 1 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO 1 hours_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO 1.5 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO 1.5 hours_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO 2 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO 2 hours_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO 2.5 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO 2.5 hours_times'].'</td>';

$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO 3 hours'].'</td>';

$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO 3 hours_times'].'</td>';

$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO 3.5 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO 3.5 hours_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO 4 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CO 4 hours_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS .5 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS .5 hours_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS 1 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS 1 hours_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS 1.5 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS 1.5 hours_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS 2 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS 2 hours_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS 2.5 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS 2.5 hours_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS 3 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS 3 hours_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS 3.5 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS 3.5 hours_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS 4 hours'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech to CUS 4 hours_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting for devices to reach LAB At HQ'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting for devices to reach LAB At HQ_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting Tower labor Availability'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting Tower labor Availability_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Checking'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Checking_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Checking with TE fiber Team'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Checking with TE fiber Team_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Confirmation'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Confirmation_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Device Ready'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Device Ready_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Friday'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Friday_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Invalid'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Invalid_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Monday'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Monday_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Monitor'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Monitor_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MSAN'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MSAN_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Need Technician'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Need Technician_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['No available tech.'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['No available tech._times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Operation Configuration'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Operation Configuration_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Pending customer Action'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Pending customer Action_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Saturday'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Saturday_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Sunday'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Sunday_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech on way after ticket'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech on way after ticket_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech waiting dispatching devices'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech waiting dispatching devices_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech waiting shipped devices'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech waiting shipped devices_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech work same area'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech work same area_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech work same pop'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tech work same pop_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Telecom Egypt Problem'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Telecom Egypt Problem_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Thursday'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Thursday_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tomorrow'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tomorrow_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tuesday'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Tuesday_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting account manager'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting account manager_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting another Party'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting another Party_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting CUS Feedback'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting CUS Feedback_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting Device from Stock'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting Device from Stock_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting Device shipping'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting Device shipping_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting ESOC'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting ESOC_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting ESP'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting ESP_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting for fiber vendor'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting for fiber vendor_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting HG Approval'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting HG Approval_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting LAB'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting LAB_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting Permission'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting Permission_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting SD'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting SD_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting Stock'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting Stock_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting Wireless Vendor'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Waiting Wireless Vendor_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Wednesday'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Wednesday_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Working After 4'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Working After 4_times'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Working now'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Working now_times'].'</td>';

$rows .= '</tr>';
		  	echo $rows;

    }
  
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
