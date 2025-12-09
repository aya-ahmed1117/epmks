
<?php
//session_start();
set_time_limit(400);
include ("pages.php");
date_default_timezone_set('Africa/Cairo');

  
  // $DBname = "Employess_DB";

  // $con1 = sqlsrv_connect($DBhost, $connectionInfo);
   $this_year = date('Y');

     $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkForce_Reporting_DB";
  
  $connectionInfo = array( "Database"=>$DBname , "UID"=>$DBuser, "PWD"=>$DBpass);
  $connect = sqlsrv_connect($DBhost, $connectionInfo);

  $username = $_SESSION['username'];
  $check_group = sqlsrv_query( $con,"SELECT [ID]
    ,[UserName]
    ,[Unit]
    ,[Groups],[SubGroups]
    FROM [Employess_DB].[dbo].[tbl_Personal_info]
    left join [Employess_DB].[dbo].[Tbl_Groups] on [Employess_DB].[dbo].[Tbl_Groups].[Group_ID]=[Group]
    left join [Employess_DB].[dbo].[Tbl_SubGroups] on [Employess_DB].[dbo].[Tbl_SubGroups].[subGroup_ID]=[sub_Group]
    where username ='$username' ");
    $group = sqlsrv_fetch_array($check_group);
    $my_group =$group['Groups']; 


?>
<head>
      <title>Monthly Report</title>
      <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

<style type="text/css">
  .zoom:hover{
    transform: scale(1.5);
  }
</style>



 <?php 
    if(($_SESSION['role_id'] >= 3)  ||($_SESSION['role_id'] == 1) ) {
      ?>
<div style="padding:20px;">

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
        <div class="media">
          <div class="media-body">
            <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Performance
            <a href="Summary_kpi.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a>
  </h2>
            <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
            </div>
        </div>
    </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       
        <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
 
<!-- <div class="col col-md-6">
        <div class="input-group">
<div  class="input-group"  id="Group_Name">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fas fa-user-tie"></i>Username</samp></span>
  <select id="input2-group2"
class="form-control" name="Group_Name" >
  <option action="none" value="0" selected>Select..</option>
<?php
  
    $checks = sqlsrv_query($connect , "SELECT * from[WorkForce_Reporting_DB].[dbo].[KPI_Percent_2024] 
                where Group_Name in ('Private KAM','GDS(Global Partner)')");
  while($outputs = sqlsrv_fetch_array($checks)){
    $usernames = $outputs['Group_Name'];
        $rows = '<option ';
        $rows .= $output['Group_Name'] == $outputs['Group_Name'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['Group_Name'].'">'.$outputs['Group_Name'].'</option>';
  echo $rows;
}

  ?>
</select>

            <div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >Submit</button></div>
        </div>
    </div>
</div>
 -->
  <?php 
  //}
  include('percen_table.php');
  ?>

<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter"data-table="order-table"placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; padding: 3px;
  word-wrap: break-word; ">
    <tr>
     
      <th ><center>Year</center></th>
      <th ><center>Month</center></th>
      <th ><center>Group Name</center></th>
      <th ><center>Shared_utilization</center></th>
      <th ><center>TAM_utilization <span style="color:yellow;">(<?php echo $TAM_u_d;?>)</span></center></th>
      <th ><center>Absen <span style="color:yellow;">(<?php echo $Abs;?>)</span></center> </th>
      <th ><center>AHT_ESP <span style="color:yellow;">(<?php echo $AHT_vio_E;?>)</span></center></th>
      <th ><center>Aht_viol_Logical <span style="color:yellow;">(<?php echo $AHT_vio_lo;?>)</span></center></th>
      <th ><center>AHT_Gloal <span style="color:yellow;">(<?php echo $AHT_vio_Gl;?>)</span></center></th>
      <th ><center>AHT_Phy_yes_onsite <span style="color:yellow;">(<?php echo $AHT_vio_yes;?>)</span></center></th>
      <th ><center>AHT_Phy_no_onsite <span style="color:yellow;">(<?php echo $AHT_vio_no;?>)</span></center></th>
      <th ><center>AHT_Request <span style="color:yellow;">(<?php echo $AHT_vio_Req;?>)</span></center></th>
      <th ><center>MTTI <span style="color:yellow;">(<?php echo $MTTI;?>)</span></center> </th>  
      <th ><center>MTTV <span style="color:yellow;">(<?php echo $MTTV;?>)</span></center> </th>  
      <th><center>MTTR_ESP <span style="color:yellow;">(<?php echo $MTTR_ESP;?>)</span></center></th>
      <th><center>MTTR_Logical <span style="color:yellow;">(<?php echo $MTTR_Log;?>)</span></center></th>
      <th><center>MTTR_Global <span style="color:yellow;">(<?php echo $MTTR_Glo;?>)</span></center></th>
      <th ><center>MTTR_Physical <span style="color:yellow;">(<?php echo $MTTR_Phy;?>)</span></center> </th>  
      <th><center>MTTR_Request <span style="color:yellow;">(<?php echo $MTTR_Reque;?>)</span></center></th>
      <th><center>P1<span style="color:yellow;">(<?php echo $p1;?>)</</center></th>
      <th><center>P2<span style="color:yellow;">(<?php echo $p2;?>)</span></center></th>
      <th><center>AVG_Ring <span style="color:yellow;">(<?php echo $AVG_R_Ti;?>)</span></center></th>
      <th><center>Avg_call <span style="color:yellow;">(<?php echo $AVG_C_Ti;?>)</span></center></th>
      <th><center>AVG_Hold <span style="color:yellow;">(<?php echo $AVG_H_Ti;?>)</span></center></th>
      <th><center>Aban <span style="color:yellow;">(<?php echo $Aban;?>)</span></center></th>
      <th><center>Avg_Hold_Eng <span style="color:yellow;">(<?php echo $AVG_Hold;?>)</span></center></th>
      <th><center>Total</center></th>
    </tr>
		</thead>
	     <tbody>
 
<?php
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkForce_Reporting_DB";
  
  $connectionInfo = array( "Database"=>$DBname , "UID"=>"Seniors" , "PWD"=>"123456789");
  $WorkForce = sqlsrv_connect($DBhost, $connectionInfo);
// if(($_SESSION['role_id'] == 5) ||($_SESSION['role_id'] == 1) ){
  if(($role_id == 1) || ($role_id >= 3) ){
   $new_query = sqlsrv_query( $WorkForce,"WITH perc as (
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
      from perc left join [WorkForce_Reporting_DB].[dbo].[KPI_Percent_2024] P 
      on perc.group_name=p.Group_Name)

      select *
      ,(COALESCE([Shared_utilization],0)+COALESCE([TAM_utilization],0)+ [Absen]+ [AHT_ESP] +[Aht_Logical]+ [AHT_Gloal]+ [AHT_Phy_yes_onsite]+ [AHT_Phy_no_onsite]+ [AHT_Request] + [MTTI]+ [MTTV]+ [MTTR_ESP] + [MTTR_Logical]+ [MTTR_Global]+ [MTTR_Physical] + [MTTR_Request] + [P1] + [P2] +[AVG_Ring] + [Avg_call] +  [AVG_Hold] + [Aban] + [Avg_Hold_Eng] ) [Total]
      from performance 
      where [Year] >= '$this_year'
      order by month,total desc");
 		  while($echo = sqlsrv_fetch_array($new_query) ){

     // $test = round($tax,0);'.floor(($echo["Aht"])*100).'%'.'

         $rows = '<tr>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.$echo['group_name'].'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">
        '.round($echo ['Shared_utilization'],2).'%'.'</td>';
        // $rows .='<td class="hovers" style="border: 1px solid lightgray; ">
        // '.floor($echo ['Shared_utilization']).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo ['TAM_utilization'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.floor($echo ['Absen']).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">
        '.round($echo['AHT_ESP'],2).'%'.'</td>';
        
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">
        '.round($echo['Aht_Logical'],2).'%'.'</td>';
         $rows .='<td class="hovers" style="border: 1px solid lightgray; ">
        '.round($echo['AHT_Gloal'],1).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['AHT_Phy_yes_onsite'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['AHT_Phy_no_onsite'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['AHT_Request'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['MTTI'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['MTTV'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['MTTR_ESP'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['MTTR_Logical'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['MTTR_Global'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['MTTR_Physical'],1).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['MTTR_Request'],1).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['P1'],1).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['P2'],1).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['AVG_Ring'],1).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['Avg_call'],1).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['AVG_Hold'],1).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['Aban'],1).'%'.'</td>';
         $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['Avg_Hold_Eng']).'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['Total']).'</td>';
        $rows .='';

		  	$rows .= '</tr>';

		  	echo $rows;

        }
      }
    }
?>
 

    </tbody>
   
</table>
</div>

</center>
</div>
<script src="js/table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "perfomance2024.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>




