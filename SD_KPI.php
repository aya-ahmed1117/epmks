

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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >SD_Kpi_2024
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
  <th ><center>Group name</center></th>
  <th><center>utilization_without_Resident_TAM_day</center></th>
  <!--<th><center>creation_time</center></th>
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
  <th><center>Waiting Time</center></th> -->


        </tr>
        </thead>
  <tbody>

<?php 
if(($_SESSION['username'] == 'ahmed.akef') || 
        ($_SESSION['role_id'] == 1)
            ){
/*//month 
if(isset($_POST['month'])){$myMonth= $_POST['month'];
//'$this_year'
$newMonth = date('n', strtotime($myMonth));
$newYear = date('Y', strtotime($myMonth));
   $mttr = sqlsrv_query($con_R,"SELECT DISTINCT  *
  FROM [WorkForce_Reporting_DB].[dbo].[MTTR_Raw_Data_Previous_Month]
  where [MONTH] = '$newMonth' and [YEAR] >='$newYear'

  and [TICKET_GROUP] in 
  ('GDS(Global Partner)','Private KAM') ");

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
 
else{
*/
  if(isset($_POST['month'])){$myMonth= $_POST['month'];
//'$this_yea
$newMonth = date('n', strtotime($myMonth));
$mttr = sqlsrv_query($con_R,"WITH perc as (
SELECT [Year]
      ,[MONTH]
      ,k.[group_name]
     -- ,k.[utilization_without_Resident_TAM_day]
    ,iif(cast ( SUBSTRING(k.[utilization_without_Resident_TAM_day],1,LEN(k.[utilization_without_Resident_TAM_day])-1)  as decimal (6,3))>=t.[utilization_without_Resident_TAM_day]*100.0,'100',cast ( SUBSTRING(k.[utilization_without_Resident_TAM_day],1,LEN(k.[utilization_without_Resident_TAM_day])-1)  as decimal (6,3))/T.[utilization_without_Resident_TAM_day])[utilization_without_Resident_TAM_day_perc]
     -- ,k.[TAM_utilization_day]
    ,iif(cast (SUBSTRING(k.[TAM_utilization_day],1,LEN(k.[TAM_utilization_day])-1)  as decimal (6,3))>=t.[TAM_utilization_day]*100.0,'100',cast ( SUBSTRING(k.[TAM_utilization_day],1,LEN(k.[TAM_utilization_day])-1)  as decimal (6,3))/T.[TAM_utilization_day])[TAM_utilization_day_per]
      --,k.[Absenteeism]
   ,iif(cast ( SUBSTRING(k.[Absenteeism],1,LEN(k.[Absenteeism])-1)  as decimal (6,3))<=t.[Absenteeism]*100.0,'100',iif(cast ( SUBSTRING(k.[Absenteeism],1,LEN(k.[Absenteeism])-1)  as decimal (6,3))>=10.00,0,(100-(cast ( SUBSTRING(k.[Absenteeism],1,LEN(k.[Absenteeism])-1)  as decimal (6,3))-t.[Absenteeism]*100.0)/t.Absenteeism)))[Abs_per]
   --,[AHT%]
     ,iif(((k.[AHT_violation_ESP%] is null) or (cast (SUBSTRING(k.[AHT_violation_ESP%],1,LEN(k.[AHT_violation_ESP%])-1)  as decimal (6,3))>=T.[AHT_violation_ESP %]*100.0)),100.00,cast (SUBSTRING(k.[AHT_violation_ESP%],1,LEN(k.[AHT_violation_ESP%])-1)  as decimal (6,3))/T.[AHT_violation_ESP %])[AHT_ESP_perc]
       ,iif(((k.[AHT_violation_logical%] is null) or (cast (SUBSTRING(k.[AHT_violation_logical%],1,LEN(k.[AHT_violation_logical%])-1)  as decimal (6,3))>=T.[AHT_violation_logical %]*100.0)),100.00,cast (SUBSTRING(k.[AHT_violation_logical%],1,LEN(k.[AHT_violation_logical%])-1)  as decimal (6,3))/T.[AHT_violation_logical %])[AHT_Logical_perc]
       ,iif(((k.[AHT_violation_Global%] is null) or (cast (SUBSTRING(k.[AHT_violation_Global%],1,LEN(k.[AHT_violation_Global%])-1)  as decimal (6,3))>=T.[AHT_violation_Global %]*100.0)),100.00,cast (SUBSTRING(k.[AHT_violation_Global%],1,LEN(k.[AHT_violation_Global%])-1)  as decimal (6,3))/T.[AHT_violation_Global %])[AHT_Global_perc]
       ,iif(((k.[AHT_violation_Phy_yes_onsite%] is null) or (cast (SUBSTRING(k.[AHT_violation_Phy_yes_onsite%],1,LEN(k.[AHT_violation_Phy_yes_onsite%])-1)  as decimal (6,3))>=T.[AHT_violation_Phy_yes_onsite %]*100.0)),100.00,cast (SUBSTRING(k.[AHT_violation_Phy_yes_onsite%],1,LEN(k.[AHT_violation_Phy_yes_onsite%])-1)  as decimal (6,3))/T.[AHT_violation_Phy_yes_onsite %])[AHT_Phy_yes_onsite_perc]
       ,iif(((k.[AHT_violation_Phy_no_onsite%] is null) or (cast (SUBSTRING(k.[AHT_violation_Phy_no_onsite%],1,LEN(k.[AHT_violation_Phy_no_onsite%])-1)  as decimal (6,3))>=T.[AHT_violation_Phy_no_onsite %]*100.0)),100.00,cast (SUBSTRING(k.[AHT_violation_Phy_no_onsite%],1,LEN(k.[AHT_violation_Phy_no_onsite%])-1)  as decimal (6,3))/T.[AHT_violation_Phy_no_onsite %])[AHT_Phy_no_onsite_perc]
         ,iif(((k.[AHT_violation_Request%] is null) or (cast (SUBSTRING(k.[AHT_violation_Request%],1,LEN(k.[AHT_violation_Request%])-1)  as decimal (6,3))>=T.[AHT_violation_Request %]*100.0)),100.00,cast (SUBSTRING(k.[AHT_violation_Request%],1,LEN(k.[AHT_violation_Request%])-1)  as decimal (6,3))/T.[AHT_violation_Request %])[AHT_Request_perc]
         ----MTTI
         ,iif((([MTTI%] is null) or (cast (SUBSTRING(k.[MTTI%],1,LEN(k.[MTTI%])-1) as decimal (6,3))>=T.[MTTI %]*100.0)),100.00,cast (SUBSTRING(k.[MTTI%],1,LEN(k.[MTTI%])-1)  as decimal (6,3))/T.[MTTI %]) [MTTI_perc]
         --,[MTTV%]
    ,iif(((k.[MTTV%] is null) or (cast (SUBSTRING(k.[MTTV%],1,LEN(k.[MTTV%])-1)  as decimal (6,3))>=T.[MTTV %]*100.0)),100.00,cast (SUBSTRING(k.[MTTV%],1,LEN(k.[MTTV%])-1)  as decimal (6,3))/T.[MTTV %]) [MTTV_perc]
       -----[MTTR_ESP%]
       ,iif(((k.[MTTR_ESP%] is null) or (cast (SUBSTRING(k.[MTTR_ESP%],1,LEN(k.[MTTR_ESP%])-1)  as decimal (6,2))>=T.[MTTR_ESP %]*100.0)),100.00,cast (SUBSTRING(k.[MTTR_ESP%],1,LEN(k.[MTTR_ESP%])-1)  as decimal (6,3))/T.[MTTR_ESP %])[MTTR_ESP_perc]
       -------[MTTR_Logical%]
       ,iif(((k.[MTTR_Logical%] is null) or (cast (SUBSTRING(k.[MTTR_Logical%],1,LEN(k.[MTTR_Logical%])-1)  as decimal (6,2))>=T.[MTTR_Logical %]*100.0)),100.00,cast (SUBSTRING(k.[MTTR_Logical%],1,LEN(k.[MTTR_Logical%])-1)  as decimal (6,3))/T.[MTTR_Logical %])[MTTR_Logical_perc]
       ------[MTTR_Global%]
       ,iif(((k.[MTTR_Global%] is null) or (cast (SUBSTRING(k.[MTTR_Global%],1,LEN(k.[MTTR_Global%])-1)  as decimal (6,2))>=T.[MTTR_Global %]*100.0)),100.00,cast (SUBSTRING(k.[MTTR_Global%],1,LEN(k.[MTTR_Global%])-1)  as decimal (6,3))/T.[MTTR_Global %])[MTTR_Global_perc]
       ---------[MTTR_Physical%]
       ,iif(((k.[MTTR_Physical%] is null) or (cast (SUBSTRING(k.[MTTR_Physical%],1,LEN(k.[MTTR_Physical%])-1)  as decimal (6,2))>=T.[MTTR_Physical %]*100.0)),100.00,cast (SUBSTRING(k.[MTTR_Physical%],1,LEN(k.[MTTR_Physical%])-1)  as decimal (6,3))/T.[MTTR_Physical %])[MTTR_Physical_perc]
       ------[MTTR_Request%]
       ,iif(((k.[MTTR_Request%] is null) or (cast (SUBSTRING(k.[MTTR_Request%],1,LEN(k.[MTTR_Request%])-1)  as decimal (6,2))>=T.[MTTR_Request %]*100.0)),100.00,cast (SUBSTRING(k.[MTTR_Request%],1,LEN(k.[MTTR_Request%])-1)  as decimal (6,3))/T.[MTTR_Request %])[MTTR_Request_perc]
       --------p1,p2 if p1 greater than 100, 100 else he did well its inverse 
           ,iif(cast ( SUBSTRING(k.[P1%],1,LEN(k.[P1%])-1)  as decimal (6,3)) is null,'100',iif(cast ( SUBSTRING(k.[P1%],1,LEN(k.[P1%])-1)  as decimal (6,3))>=100.00,0,(100-(cast ( SUBSTRING(k.[P1%],1,LEN(k.[P1%])-1)  as decimal (6,3))))))[P1_per]
             ,iif(cast ( SUBSTRING(k.[P2%],1,LEN(k.[P2%])-1)  as decimal (6,3)) is null,'100',iif(cast ( SUBSTRING(k.[P2%],1,LEN(k.[P2%])-1)  as decimal (6,3))>=100.00,0,(100-(cast ( SUBSTRING(k.[P2%],1,LEN(k.[P2%])-1)  as decimal (6,3))))))[P2_per]
             --------avaya
             ,iif((k.[AVG_Ring_Time]<=t.[AVG_Ring_Time %]) or (k.[AVG_Ring_Time] is null) ,'100',iif(k.[AVG_Ring_Time] >=2*t.[AVG_Ring_Time %],0,100-(k.[AVG_Ring_Time]-t.[AVG_Ring_Time %])*100.0/t.[AVG_Ring_Time %]))[AVG_Ring_per]
             ,iif((k.[AVG_Call_Time]<=t.[AVG_Call_Time %]) or (k.[AVG_Call_Time] is null) ,'100',iif(k.[AVG_Call_Time] >=2*t.[AVG_Call_Time %],0,100-(k.[AVG_Call_Time]-t.[AVG_Call_Time %])*100.0/t.[AVG_Call_Time %]))[AVG_call_per]
             ,iif((k.[AVG_Hold_Time]<=t.[AVG_Hold_Time %]) or (k.[AVG_Hold_Time] is null) ,'100',iif(k.[AVG_Hold_Time] >=2*t.[AVG_Hold_Time %],0,100-(k.[AVG_Hold_Time]-t.[AVG_Hold_Time %])*100.0/t.[AVG_Call_Time %]))[AVG_Hold_per]
             ,iif((k.[Aban%]<=t.[Aban %]) or (k.[Aban%] is null) ,'100',iif(k.[Aban%] >=2*t.[Aban %],0,100-(k.[Aban%]-t.[Aban %])*100.0/t.[Aban %]))[Aban_per]
             ,iif((k.[AVG_Hold_By_Eng]<=t.[AVG_Hold_By_Eng %]) or (k.[AVG_Hold_By_Eng] is null) ,'100',iif(k.[AVG_Hold_By_Eng] >=2*t.[AVG_Hold_By_Eng %],0,100-(k.[AVG_Hold_By_Eng]-t.[AVG_Hold_By_Eng %])*100.0/t.[AVG_Hold_By_Eng %]))[AVG_Hold_By_Eng_per]

   FROM [WorkForce_Reporting_DB].[dbo].[SD_Kpi_2024] k
  left join [WorkForce_Reporting_DB].[dbo].[KPI_target_2024] t on k.group_name=t.Group_Name)
  ,

  Performance as(
  select 
    [Year]
    ,[MONTH]
    ,perc.[group_name]
    ,[utilization_without_Resident_TAM_day_perc]*[utilization_without_Resident_TAM_day] [Shared_utilization]
    ,[TAM_utilization_day_per]*[TAM_utilization_day] [TAM_utilization]
    ,[Abs_per]*[Absenteeism] [Absen]
       ,[AHT_ESP_perc]*[AHT_violation_ESP %] [AHT_ESP]
       ,[AHT_Logical_perc]*[AHT_violation_logical %][Aht_Logical]
    ,[AHT_Global_perc]*[AHT_violation_Global %] [AHT_Gloal]
       ,[AHT_Phy_yes_onsite_perc]*[AHT_violation_Phy_yes_onsite %][AHT_Phy_yes_onsite]
       ,[AHT_Phy_no_onsite_perc]*[AHT_violation__Phy_no_onsite %][AHT_Phy_no_onsite]
       ,[AHT_Request_perc]*[AHT_violation_Request %][AHT_Request]
       ,[MTTI_perc]*[MTTI %][MTTI]
       ,[MTTV_perc]*[MTTV %][MTTV]
       ,[MTTR_ESP_perc]*[MTTR_ESP %][MTTR_ESP]
       ,[MTTR_Logical_perc]*[MTTR_Logical %][MTTR_Logical]
       ,[MTTR_Global_perc]*[MTTR_Global %][MTTR_Global]
       ,[MTTR_Physical_perc]*[MTTR_Physical %][MTTR_Physical]
       ,[MTTR_Request_perc]*[MTTR_Request %][MTTR_Request]
       ,[P1_per]*[P1 %][P1]
       ,[P2_per]*[P2 %][P2]
       ,[AVG_Ring_per]*[AVG_Ring_Time %][AVG_Ring]
       ,[AVG_call_per]*[AVG_Call_Time ][Avg_call]
       ,[AVG_Hold_per]*[AVG_Hold_Time %][AVG_Hold]
       ,[Aban_per]*[Aban % ][Aban]
       ,[AVG_Hold_By_Eng_per]*[AVG_Hold_By_Eng %][Avg_Hold_Eng]
    from perc left join [WorkForce_Reporting_DB].[dbo].[KPI_Percent_2024] P on perc.group_name=p.Group_Name)

       select *
       ,(COALESCE([Shared_utilization],0)+COALESCE([TAM_utilization],0)+ [Absen]+ [AHT_ESP] +[Aht_Logical]+ [AHT_Gloal]+ [AHT_Phy_yes_onsite]+ [AHT_Phy_no_onsite]+ [AHT_Request] + [MTTI]+ [MTTV]+ [MTTR_ESP] + [MTTR_Logical]+ [MTTR_Global]+ [MTTR_Physical] + [MTTR_Request] + [P1] + [P2] +[AVG_Ring] + [Avg_call] +  [AVG_Hold] + [Aban] + [Avg_Hold_Eng] ) [Total]
       from performance
           order by month,total desc

  where [MONTH] ='$newMonth' and [YEAR] >=$this_year");

   while ($output = sqlsrv_fetch_array($mttr) ){
   $rows  ='<tr>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Year"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["MONTH"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["group_name"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">
  '.$output["utilization_without_Resident_TAM_day"].'</td>';
  
  
//   if($output["FIRST_RESP_TIME"] == NULL ){
//     $rows .='<td width=".5%" style="border: 1px solid #eee;background-color:#092834 ; font-size:13px ;color:white;">
// Blank</td>';
//   }else{
//   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["FIRST_RESP_TIME"]->format('Y:m:d H:i:s').'</td>';}
 

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