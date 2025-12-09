<?php
require_once("pages.php");
$this_year=date('Y');

?>
<head>
<title>Tables</title>

<link rel="stylesheet" type="text/css" href="font-awesome4/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="css/kpi_css.css">

<style type="text/css">
  .zoom:hover{
    transform: scale(1.5);
  }

  .pt-3-half {
    padding-top: 1.4rem;
  }

  @media (max-width: 576px) {

    [id^=dpl-],
    [class^=dpl-],
    .mobile-hidden {
      display: none !important;
    }
  }

.modal-content {
    background-color: #fefefe;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
    position: static;
    z-index: 10;

    
}
.modal-footer {
    display: flex;
    flex-wrap: wrap;
    flex-shrink: 0;
    align-items: center;
    justify-content: flex-end;
    padding: 0.75rem;
    border-top: 1px solid #dee2e6;
    border-bottom-right-radius: calc(0.3rem - 1px);
    border-bottom-left-radius: calc(0.3rem - 1px);
}

.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}
.close2 {
    float: right;
    font-size: 21px;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    filter: alpha(opacity=20);
    opacity: .2;
}
</style>
</head>

<div style="padding:20px;">

<?php
 

        if(isset($_GET['group'])){
    ?>

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Summary Kpi`s
                per Group
      <a href="Summary_kpi.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       
        <img src="images/aaa-removebg-preview.png" class="zoom"  
        style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter"data-table="order-table"placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
        <th><center>Year</center></th>
        <th><center>Month</center></th>
        <th><center>Group Name</center></th>
        <th><center>Utilization Without Resident Tam Day</center></th>
        <th><center>TAM_utilization_day</center></th>
        <th><center>Absenteeism</center></th>
        <th><center>AHT Logical Avg</center></th>
        <th><center>AHT Logical%</center></th>
        <th><center>AHT Other Avg</center></th>
        <th><center>AHT Other%</center></th>
        <th><center>MTTI1_avg</center> </th>
        <th><center>MTTI1%</center></th>
        <th><center>MTTI2_avg</center></th>
        <th><center>MTTI2%</center></th>
        <th><center>MTTV_avg</center></th>
        <th><center>MTTV%</center></th>
        <th><center>MTTR_Logical</center> </th>  
        <th><center>Wrong_node</center> </th>
        <th><center> <button type="button"  class="btn btn-warning view" data-toggle="modal" data-target="#smallM">Not_Assigned</button></center> </th>
        <th><center>global_tickets_have_PSD</center> </th> 
        <th><center>Performance_enhancement</center> </th> 
        <th><center>New_technology_awareness</center> </th> 
    </tr>
		</thead>

	
  <tbody>
 
<?php

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

    if($_SESSION['username'] == 'ahmed.mohamedbassal'){
    $new_query = sqlsrv_query( $con,"SELECT  [Year]
    ,[MONTH]
    ,k.[group_name]
    ,k.[utilization_without_Resident_TAM_day]
    ,k.[TAM_utilization_day]
    ,k.[Absenteeism]
    ,cast (SUBSTRING(k.[Absenteeism],1,LEN(k.[Absenteeism])-1)  as decimal (5,3)) m_absen
    ,[AHT_Logical_Avg]
    ,[AHT_Logical%]
    ,[AHT_Other_Avg]
    ,[AHT_Other%]
    ,cast ( SUBSTRING([AHT_Logical%],1,LEN([AHT_Logical%])-1)  as decimal(5,2)) [k_aht_Logical]
    ,[AHT_logical %]*100.00 [t_aht_logical]
    ,iif(cast ( SUBSTRING([AHT_Logical%],1,LEN([AHT_Logical%])-1)  as decimal(5,2)) < [AHT_logical %]*100.00,'colour red', 'colour green') [colour_code]
    ,cast ( SUBSTRING([AHT_Other%],1,LEN([AHT_Other%])-1)  as decimal(5,2)) [k_aht_Other]
    ,[AHT_other %]*100.00 [t_aht_Other]
    ,iif(cast ( SUBSTRING([AHT_Other%],1,LEN([AHT_Other%])-1)  as decimal(5,2)) < [AHT_other %]*100.00,'colour red', 'colour green') [colour_AHT_Other]
    ,[MTTI1_avg]
    ,[MTTI1%]
    ,iif(cast ( SUBSTRING([MTTI1%],1,LEN([MTTI1%])-1)  as decimal(5,2)) <[MTTI1 %] *100.00,'colour red', 'colour green') [colour_MTTI1]
    ,[MTTI2_avg]
    ,[MTTI2%]
    ,iif(cast ( SUBSTRING([MTTI2%],1,LEN([MTTI2%])-1)  as decimal(5,2)) <[MTTI2 %] *100.00,'colour red', 'colour green') [colour_MTTI2]
    ,[MTTV_avg]
    ,[MTTV%]
    ,iif(cast ( SUBSTRING([MTTV%],1,LEN([MTTV%])-1)  as decimal(5,2)) <[MTTV %] *100.00,'colour red', 'colour green') [colour_MTTV]
    ,[MTTR_Logical%]
    ,iif(cast ( SUBSTRING([MTTR_Logical%],1,LEN([MTTR_Logical%])-1)  as decimal(5,2)) <[MTTR Logical %]*100.00,'colour red', 'colour green') [colourLogical]
    ,[Wrong_node%]
    ,iif(cast ( SUBSTRING([Wrong_node%],1,LEN([Wrong_node%])-1)  as decimal(5,2)) <[Wrong_node %]*100.00,'colour red', 'colour green') [colourWrong_node]
    ,[Not_Assigned%]
    ,iif(cast ( SUBSTRING([Not_Assigned%],1,LEN([Not_Assigned%])-1)  as decimal(5,2)) <[Not Assigned %]*100.00,'colour red', 'colour green') [colour_Assigned]
    ,k.[global_tickets_have_PSD]
    ,iif(cast ( SUBSTRING(k.[global_tickets_have_PSD],1,LEN(k.[global_tickets_have_PSD])-1)  as decimal(5,2)) <t.[global_tickets_have_PSD]*100.00,'colour red', 'colour green') [colour_have_PSD]
    ,k.[Performance_enhancement]
    ,iif(cast ( SUBSTRING(k.[Performance_enhancement],1,LEN(k.[Performance_enhancement])-1)  as decimal(5,2)) <t.[Performance_enhancement]*20.00,'colour red', 'colour green') [colour_enhancement]
    ,k.[New_technology_awareness]
    ,iif(cast ( SUBSTRING(k.[New_technology_awareness],1,LEN(k.[New_technology_awareness])-1)  as decimal(5,2)) <t.[New_technology_awareness]*20.00,'colour red', 'colour green') [colour_awareness]

  FROM [WorkForce_Reporting_DB].[dbo].[Kpi_2023_new] k
  left join [WorkForce_Reporting_DB].[dbo].[KPI_target] t on k.group_name=t.Group_Name
where  (k.group_name  like 'private KAM%' or k.group_name like 'GDS%')
---(ticket_group like 'private KAM%' or ticket_group like 'GDS%')
    order by 1,len([MONTH]),2,3 ");
      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['group_name'].'</td>';
        //Private KAM
        if(($echo['group_name'] == 'Private KAM') && 
            ($echo['group_name'] !== 'GDS(Global Partner)') &&
             ($echo['utilization_without_Resident_TAM_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">
'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Private KAM') && ($echo['group_name'] !== 'GDS(Global Partner)')&& 
            ($echo['utilization_without_Resident_TAM_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">
    '.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
      //GDS(Global Partner)
        if(($echo['group_name'] == 'GDS(Global Partner)') && 
            ($echo['group_name'] != 'Private KAM')&&
             ($echo['utilization_without_Resident_TAM_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">
'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'GDS(Global Partner)') && 
            ($echo['group_name'] != 'Private KAM')&&
            ($echo['utilization_without_Resident_TAM_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">
    '.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
    //******************///TAM_Utilization_day
    if($echo['TAM_utilization_day'] >= '65%'){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:lightgreen;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
    if($echo['TAM_utilization_day'] < '65%'){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:#ff6666;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
    //null
    if($echo['TAM_utilization_day'] == 'null' ){
        $rows .='<td class="hovers" style="border: 1px solid #eee;">'.$echo['Utilization_without_Resident_TAM_day'].'</td>';
    }
     $persent = $echo['m_absen'];


   if($persent <=  5.000){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:lightgreen;">'.$echo['Absenteeism'].'</td>';
        }else{
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:#ff6666;">'.$echo['Absenteeism'].'</td>';   
        }
    //AHT_Logical_Avg
        if($echo["AHT_Logical%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';}
    if($echo["AHT_Logical%"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT_Logical_Avg']->format('H:i:s').'</td>';
    }

//AHT_Logical%
  if($echo["AHT_Logical%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }
if( ($echo['colour_code'] == 'colour red') && ($echo["AHT_Logical%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['AHT_Logical%'].'</td>';}
  if( ($echo['colour_code'] != 'colour red') && ($echo["AHT_Logical%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['AHT_Logical%'].'</td>';}
  //AHT_Other_Avg
  if($echo["AHT_Other_Avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }if
  ($echo["AHT_Other_Avg"] !== NULL ){
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT_Other_Avg']->format('H:i:s').'</td>';
}
  //[AHT_Other%]
   if($echo["AHT_Other%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }
if( ($echo['colour_AHT_Other'] == 'colour red') 
    && ($echo["AHT_Other%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['AHT_Other%'].'</td>';}
  if( ($echo['colour_AHT_Other'] != 'colour red') && ($echo["AHT_Other%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['AHT_Other%'].'</td>';}
//MTTI1_avg
      if($echo["MTTI1_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI1_avg']->format('H:i:s').'</td>';}

      //colour_MTTI1
    if($echo["MTTI1%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTI1'] == 'colour red') && ($echo["MTTI1%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTI1%'].'</td>';
    }
    if( ($echo['colour_MTTI1'] != 'colour red') && ($echo["MTTI1%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTI1%'].'</td>';
    }

  ///////////////////
    if($echo["MTTI2_avg"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_avg']->format('H:i:s').'</td>';
            }
        if($echo["MTTI2_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
            }
    if($echo["MTTI2%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTI2'] == 'colour red') && ($echo["MTTI2%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTI2%'].'</td>';
    }
    if( ($echo['colour_MTTI2'] != 'colour red') && ($echo["MTTI2%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTI2%'].'</td>';
    }
    //////////////
    if($echo["MTTV_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
    }else{
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_avg']->format('H:i:s').'</td>';
    }

    if($echo["MTTV%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTV'] == 'colour red') && ($echo["MTTV%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTV%'].'</td>';
    }
    if( ($echo['colour_MTTV'] != 'colour red') && ($echo["MTTV%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTV%'].'</td>';
    }
    //////////////
    //$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_Logical%'].'</td>';
    if($echo["MTTR_Logical%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colourLogical'] == 'colour red') && ($echo["MTTR_Logical%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTR_Logical%'].'</td>';
    }
    if( ($echo['colourLogical'] != 'colour red') && ($echo["MTTR_Logical%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTR_Logical%'].'</td>';
    }
    //////////////
    if($echo["Wrong_node%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen ; font-size:13px ;color:black;">0</td>';
    }
    else{
        $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Wrong_node%'].'</td>';
            }
////

  if($echo["Not_Assigned%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen ; font-size:13px ;color:black;">0</td>';
    }
    else{

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Not_Assigned%'].'</td>';
    }
    
    //////////////
    if($echo["global_tickets_have_PSD"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_have_PSD'] == 'colour red') && ($echo["global_tickets_have_PSD"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['global_tickets_have_PSD'].'</td>';
    }
    if( ($echo['colour_have_PSD'] != 'colour red') && ($echo["global_tickets_have_PSD"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['global_tickets_have_PSD'].'</td>';
    }
    ////////////// 
    if($echo["Performance_enhancement"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_enhancement'] == 'colour red') && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Performance_enhancement'].'</td>';
    }
    if( ($echo['colour_enhancement'] != 'colour red') && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['Performance_enhancement'].'</td>';
    }
    //////////////
     
     if($echo["New_technology_awareness"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_awareness'] == 'colour red') && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['New_technology_awareness'].'</td>';
    }
    if( ($echo['colour_awareness'] != 'colour red') && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['New_technology_awareness'].'</td>';
    }
    //////////////
    
        $rows .= '</tr>';
        echo $rows;
}
}

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);

if(($_SESSION['username'] == 'ahmed.akef') || ($_SESSION['role_id'] == 1) ){

   $new_query = sqlsrv_query( $con,"SELECT  [Year]
    ,[MONTH]
    ,k.[group_name]
    ,k.[utilization_without_Resident_TAM_day]
    ,k.[TAM_utilization_day]
    ,k.[Absenteeism]
    ,cast (SUBSTRING(k.[Absenteeism],1,LEN(k.[Absenteeism])-1)  as decimal (5,3)) m_absen
    ,[AHT_Logical_Avg]
    ,[AHT_Logical%]
    ,[AHT_Other_Avg]
    ,[AHT_Other%]
    ,cast ( SUBSTRING([AHT_Logical%],1,LEN([AHT_Logical%])-1)  as decimal(5,2)) [k_aht_Logical]
    ,[AHT_logical %]*100.00 [t_aht_logical]
    ,iif(cast ( SUBSTRING([AHT_Logical%],1,LEN([AHT_Logical%])-1)  as decimal(5,2)) < [AHT_logical %]*100.00,'colour red', 'colour green') [colour_code]
    ,cast ( SUBSTRING([AHT_Other%],1,LEN([AHT_Other%])-1)  as decimal(5,2)) [k_aht_Other]
    ,[AHT_other %]*100.00 [t_aht_Other]
    ,iif(cast ( SUBSTRING([AHT_Other%],1,LEN([AHT_Other%])-1)  as decimal(5,2)) < [AHT_other %]*100.00,'colour red', 'colour green') [colour_AHT_Other]
    ,[MTTI1_avg]
    ,[MTTI1%]
    ,iif(cast ( SUBSTRING([MTTI1%],1,LEN([MTTI1%])-1)  as decimal(5,2)) <[MTTI1 %] *100.00,'colour red', 'colour green') [colour_MTTI1]
    ,[MTTI2_avg]
    ,[MTTI2%]
    ,iif(cast ( SUBSTRING([MTTI2%],1,LEN([MTTI2%])-1)  as decimal(5,2)) <[MTTI2 %] *100.00,'colour red', 'colour green') [colour_MTTI2]
    ,[MTTV_avg]
    ,[MTTV%]
    ,iif(cast ( SUBSTRING([MTTV%],1,LEN([MTTV%])-1)  as decimal(5,2)) <[MTTV %] *100.00,'colour red', 'colour green') [colour_MTTV]
    ,[MTTR_Logical%]
    ,iif(cast ( SUBSTRING([MTTR_Logical%],1,LEN([MTTR_Logical%])-1)  as decimal(5,2)) <[MTTR Logical %]*100.00,'colour red', 'colour green') [colourLogical]
    ,[Wrong_node%]
    ,iif(cast ( SUBSTRING([Wrong_node%],1,LEN([Wrong_node%])-1)  as decimal(5,2)) <[Wrong_node %]*100.00,'colour red', 'colour green') [colourWrong_node]
    ,[Not_Assigned%]
    ,iif(cast ( SUBSTRING([Not_Assigned%],1,LEN([Not_Assigned%])-1)  as decimal(5,2)) <[Not Assigned %]*100.00,'colour red', 'colour green') [colour_Assigned]
    ,k.[global_tickets_have_PSD]
    ,iif(cast ( SUBSTRING(k.[global_tickets_have_PSD],1,LEN(k.[global_tickets_have_PSD])-1)  as decimal(5,2)) <t.[global_tickets_have_PSD]*100.00,'colour red', 'colour green') [colour_have_PSD]
    ,k.[Performance_enhancement]

    ,iif(cast ( SUBSTRING(k.[Performance_enhancement],1,LEN(k.[Performance_enhancement])-1)  as decimal(5,2)) <t.[Performance_enhancement]*20.00,'colour red', 'colour green') [colour_enhancement]
    ,k.[New_technology_awareness] 
    ,iif(cast ( SUBSTRING(k.[New_technology_awareness],1,LEN(k.[New_technology_awareness])-1)  as decimal(5,2)) <t.[New_technology_awareness]*20.00,'colour red', 'colour green') [colour_awareness]

  FROM [WorkForce_Reporting_DB].[dbo].[Kpi_2023_new] k
  left join [WorkForce_Reporting_DB].[dbo].[KPI_target] t on k.group_name=t.Group_Name
order by 1,len([MONTH]),2,3
 ");

      while($echo = sqlsrv_fetch_array($new_query) ){
         $rows = '<tr>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['group_name'].'</td>';
    //utilization without resident_day
    //GOV & Public
    if(($echo['group_name'] == 'GOV') && 
      ($echo['group_name'] != 'BS')&&
      ($echo['group_name'] != 'Banking')&&
      ($echo['group_name'] != 'Private KAM')&&
      ($echo['utilization_without_Resident_TAM_day'] > 62) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'GOV') && 
          ($echo['group_name'] != 'BS')&&
          ($echo['group_name'] != 'Banking')&&
          ($echo['group_name'] != 'Private KAM')&&
          ($echo['utilization_without_Resident_TAM_day'] <= 62) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
        //Private KAM
        if(($echo['group_name'] == 'Private KAM') && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization_without_Resident_TAM_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Private KAM')   && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization_without_Resident_TAM_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
       
        ///GDS(Global Partner)
        //Banking
        if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] >= 58 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] < 58 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
        //BS
      if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] >= 78 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
      }if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] < 78 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
   
   if(($echo['group_name'] == 'GDS(Global Partner)') ||
            ($echo['group_name'] == 'Mega Projects') ||
            ($echo['group_name'] == 'Local Loop') || ($echo['group_name'] =='Local Loop  ') ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; ">
    '.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }

    //******************///TAM_Utilization_day
        
    if(($echo['TAM_utilization_day'] >= '65%') && ($echo['TAM_utilization_day'] != NULL) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
    if(($echo['TAM_utilization_day'] < '65%') && ($echo['TAM_utilization_day'] != NULL) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
    if($echo['TAM_utilization_day'] == NULL){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
   

   $persent = $echo['m_absen'];


   if($persent <=  5.000){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:lightgreen;">'.$echo['Absenteeism'].'</td>';
        }else{
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:#ff6666;">'.$echo['Absenteeism'].'</td>';   
        }
//AHT_logical_Avg
    if($echo["AHT_Logical_Avg"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT_Logical_Avg']->format('H:i:s').'</td>';
            }
        if($echo["AHT_Logical_Avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
            }
//AHT_Logical%
  if($echo["AHT_Logical%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }
if( ($echo['colour_code'] == 'colour red') && ($echo["AHT_Logical%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['AHT_Logical%'].'</td>';}
  if( ($echo['colour_code'] != 'colour red') && ($echo["AHT_Logical%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['AHT_Logical%'].'</td>';}
  //AHT_Other_Avg
  if($echo["AHT_Other_Avg"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT_Other_Avg']->format('H:i:s').'</td>';
            }
        if($echo["AHT_Other_Avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
            }

  //[AHT_Other%]
   if($echo["AHT_Other%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }
if( ($echo['colour_AHT_Other'] == 'colour red') && ($echo["AHT_Other%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['AHT_Other%'].'</td>';}
  if( ($echo['colour_AHT_Other'] != 'colour red') && ($echo["AHT_Other%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['AHT_Other%'].'</td>';}
  //MTTI1_avg
      if($echo["MTTI1_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI1_avg']->format('H:i:s').'</td>';}

      //colour_MTTI1
    if($echo["MTTI1%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTI1'] == 'colour red') && ($echo["MTTI1%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTI1%'].'</td>';
    }
    if( ($echo['colour_MTTI1'] != 'colour red') && ($echo["MTTI1%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTI1%'].'</td>';
    }

  ///////////////////

    if($echo["MTTI2_avg"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_avg']->format('H:i:s').'</td>';
            }
        if($echo["MTTI2_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
            }

    if($echo["MTTI2%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTI2'] == 'colour red') && ($echo["MTTI2%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTI2%'].'</td>';
    }
    if( ($echo['colour_MTTI2'] != 'colour red') && ($echo["MTTI2%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTI2%'].'</td>';
    }
    if($echo["MTTV_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
    }else{
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_avg']->format('H:i:s').'</td>';
    }

    if($echo["MTTV%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTV'] == 'colour red') && ($echo["MTTV%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTV%'].'</td>';
    }
    if( ($echo['colour_MTTV'] != 'colour red') && ($echo["MTTV%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTV%'].'</td>';
    }
    //////////////
    //$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_Logical%'].'</td>';
    if($echo["MTTR_Logical%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colourLogical'] == 'colour red') && ($echo["MTTR_Logical%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTR_Logical%'].'</td>';
    }
    if( ($echo['colourLogical'] != 'colour red') && ($echo["MTTR_Logical%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTR_Logical%'].'</td>';
    }
    //////////////
    if($echo["Wrong_node%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen ; font-size:13px ;color:black;">0</td>';
    }
    else{
        $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Wrong_node%'].'</td>';
            }
////

  if($echo["Not_Assigned%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen ; font-size:13px ;color:black;">0</td>';
    }
    else{

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Not_Assigned%'].'</td>';
    }
    
    //////////////
    if($echo["global_tickets_have_PSD"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_have_PSD'] == 'colour red') && ($echo["global_tickets_have_PSD"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['global_tickets_have_PSD'].'</td>';
    }
    if( ($echo['colour_have_PSD'] != 'colour red') && ($echo["global_tickets_have_PSD"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['global_tickets_have_PSD'].'</td>';
    }
    ////////////// 
    
    $space = str_replace([" ","(",")"], ["_","_","_"], $echo["group_name"]);

    if($echo["Performance_enhancement"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;"><span id="'. $space . '_' . $echo["Year"] . '_' . $echo["MONTH"] .'_performance">Blank</span><span style="float:right;">
                <button type="button" title="UPDATE" class="btn btn view_data" data-toggle="modal" data-target="#centralModal"
                data-year="' . $echo["Year"] . '" 
                data-month="' . $echo["MONTH"] . '"
                data-column="Performance_enhancement" 
                data-value="' . $echo["Performance_enhancement"] . '"
                data-groupname="' . $echo["group_name"] . '"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                </button>
                </span></td>';
    }
    //red
    if( ($echo['Performance_enhancement'] < 20) && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;"><span
  id="'. $space . '_' . $echo["Year"] . '_' . $echo["MONTH"] .'_performance">'.$echo['Performance_enhancement'].'</span><span style="float:right;">
                <button type="button" title="UPDATE" class="btn btn view_data" data-toggle="modal" data-target="#centralModal"
                data-year="' . $echo["Year"] . '" 
                data-month="' . $echo["MONTH"] . '"
                data-column="Performance_enhancement" 
                data-value="' . $echo["Performance_enhancement"] . '"
                data-groupname="' . $echo["group_name"] . '"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                </button>
                </span></td>';
    }
    if( ($echo['Performance_enhancement'] >= 20) && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;"><span id="'. $space . '_' . $echo["Year"] . '_' . $echo["MONTH"] .'_performance">'.$echo['Performance_enhancement'].'</span><span style="float:right;">
              <button type="button" title="UPDATE" class="btn btn view_data" data-toggle="modal" data-target="#centralModal"
                data-year="' . $echo["Year"] . '" 
                data-month="' . $echo["MONTH"] . '"
                data-column="Performance_enhancement" 
                data-value="' . $echo["Performance_enhancement"] . '"
                data-groupname="' . $echo["group_name"] . '"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                </button>
                </span></td>';
    }
    //////////////
     
     if($echo["New_technology_awareness"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;"><span id="'. $space . '_' . $echo["Year"] . '_' . $echo["MONTH"] .'_new_technology">Blank</span><span style="float:right;">
                <button type="button" title="UPDATE" class="btn btn view_data" data-toggle="modal" data-target="#centralModal"
                data-year="' . $echo["Year"] . '" 
                data-month="' . $echo["MONTH"] . '"
                data-column="New_technology_awareness" 
                data-value="' . $echo["New_technology_awareness"] . '"
                data-groupname="' . $echo["group_name"] . '"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                </button></span></td>';
    }
    //red
    if( ($echo['New_technology_awareness'] < 20 ) && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;"><span id="'. $space . '_' . $echo["Year"] . '_' . $echo["MONTH"] .'_new_technology">'.$echo['New_technology_awareness'].'</span><span style="float:right;"><button type="button" title="UPDATE" class="btn btn view_data" data-toggle="modal" data-target="#centralModal"
                data-year="' . $echo["Year"] . '" 
                data-month="' . $echo["MONTH"] . '"
                data-column="New_technology_awareness" 
                data-value="' . $echo["New_technology_awareness"] . '"
                data-groupname="' . $echo["group_name"] . '">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg></button></span></td>';
    }
    //green
    if( ($echo['New_technology_awareness'] >= 20) && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td style="border: 1px solid lightgray;background-color:lightgreen;"><span id="'. $space . '_' . $echo["Year"] . '_' . $echo["MONTH"] .'_new_technology">'.$echo['New_technology_awareness'].'</span><span style="float:right;"><button type="button" title="UPDATE" class="btn btn view_data" data-toggle="modal" data-target="#centralModal"
                data-year="' . $echo["Year"] . '" 
                data-month="' . $echo["MONTH"] . '"
                data-column="New_technology_awareness" 
                data-value="' . $echo["New_technology_awareness"] . '"
                data-groupname="' . $echo["group_name"] . '">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                </button></span></td>';
    }
    //////////////

        $rows .= '</tr>';
        echo $rows;
}
}
else{

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

    $new_query = sqlsrv_query( $con , "SELECT  [Year]
        ,[MONTH]
        ,k.[group_name]
        ,k.[utilization_without_Resident_TAM_day]
        ,k.[TAM_utilization_day]
        ,k.[Absenteeism]
        ,cast (SUBSTRING(k.[Absenteeism],1,LEN(k.[Absenteeism])-1)  as decimal (5,3)) m_absen
        ,[AHT_Logical_Avg]
        ,[AHT_Logical%]
        ,[AHT_Other_Avg]
        ,[AHT_Other%]
        ,cast ( SUBSTRING([AHT_Logical%],1,LEN([AHT_Logical%])-1)  as decimal(5,2)) [k_aht_Logical]
        ,[AHT_logical %]*100.00 [t_aht_logical]
        ,iif(cast ( SUBSTRING([AHT_Logical%],1,LEN([AHT_Logical%])-1)  as decimal(5,2)) < [AHT_logical %]*100.00,'colour red', 'colour green') [colour_code]
        ,cast ( SUBSTRING([AHT_Other%],1,LEN([AHT_Other%])-1)  as decimal(5,2)) [k_aht_Other]
        ,[AHT_other %]*100.00 [t_aht_Other]
        ,iif(cast ( SUBSTRING([AHT_Other%],1,LEN([AHT_Other%])-1)  as decimal(5,2)) < [AHT_other %]*100.00,'colour red', 'colour green') [colour_AHT_Other]
        ,[MTTI1_avg]
        ,[MTTI1%]
        ,iif(cast ( SUBSTRING([MTTI1%],1,LEN([MTTI1%])-1)  as decimal(5,2)) <[MTTI1 %] *100.00,'colour red', 'colour green') [colour_MTTI1]
        ,[MTTI2_avg]
        ,[MTTI2%]
        ,iif(cast ( SUBSTRING([MTTI2%],1,LEN([MTTI2%])-1)  as decimal(5,2)) <[MTTI2 %] *100.00,'colour red', 'colour green') [colour_MTTI2]
        ,[MTTV_avg]
        ,[MTTV%]
        ,iif(cast ( SUBSTRING([MTTV%],1,LEN([MTTV%])-1)  as decimal(5,2)) <[MTTV %] *100.00,'colour red', 'colour green') [colour_MTTV]
        ,[MTTR_Logical%]
        ,iif(cast ( SUBSTRING([MTTR_Logical%],1,LEN([MTTR_Logical%])-1)  as decimal(5,2)) <[MTTR Logical %]*100.00,'colour red', 'colour green') [colourLogical]
        ,[Wrong_node%]
        ,iif(cast ( SUBSTRING([Wrong_node%],1,LEN([Wrong_node%])-1)  as decimal(5,2)) <[Wrong_node %]*100.00,'colour red', 'colour green') [colourWrong_node]
        ,[Not_Assigned%]
        ,iif(cast ( SUBSTRING([Not_Assigned%],1,LEN([Not_Assigned%])-1)  as decimal(5,2)) <[Not Assigned %]*100.00,'colour red', 'colour green') [colour_Assigned]
        ,k.[global_tickets_have_PSD]
        ,iif(cast ( SUBSTRING(k.[global_tickets_have_PSD],1,LEN(k.[global_tickets_have_PSD])-1)  as decimal(5,2)) <t.[global_tickets_have_PSD]*100.00,'colour red', 'colour green') [colour_have_PSD]
        ,k.[Performance_enhancement]
        ,iif(cast ( SUBSTRING(k.[Performance_enhancement],1,LEN(k.[Performance_enhancement])-1)  as decimal(5,2)) <t.[Performance_enhancement]*20.00,'colour red', 'colour green') [colour_enhancement]
        ,k.[New_technology_awareness]
        ,iif(cast ( SUBSTRING(k.[New_technology_awareness],1,LEN(k.[New_technology_awareness])-1)  as decimal(5,2)) <t.[New_technology_awareness]*20.00,'colour red', 'colour green') [colour_awareness]

  FROM [WorkForce_Reporting_DB].[dbo].[Kpi_2023_new] k
  left join [WorkForce_Reporting_DB].[dbo].[KPI_target] t on k.group_name=t.Group_Name
where  k.group_name like '$my_group%'
order by 1,len([MONTH]),2,3 ");
      while($echo = sqlsrv_fetch_array($new_query) ){
  
         $rows = '<tr>';
     $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['group_name'].'</td>';
    //utilization without resident_day
    //GOV & Public
    if(($echo['group_name'] == 'GOV') && 
      ($echo['group_name'] != 'BS')&&
      ($echo['group_name'] != 'Banking')&&
      ($echo['group_name'] != 'Private KAM')&&
      ($echo['utilization_without_Resident_TAM_day'] > 62) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'GOV') && 
          ($echo['group_name'] != 'BS')&&
          ($echo['group_name'] != 'Banking')&&
          ($echo['group_name'] != 'Private KAM')&&
          ($echo['utilization_without_Resident_TAM_day'] <= 62) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
        //Private KAM
        if(($echo['group_name'] == 'Private KAM') && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization_without_Resident_TAM_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Private KAM')   && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization_without_Resident_TAM_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
       
        ///GDS(Global Partner)
        //Banking
        if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] >= 58 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] < 58 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
        //BS
      if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] >= 78 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
      }if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] < 78 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
   
   if(($echo['group_name'] == 'GDS(Global Partner)') ||
            ($echo['group_name'] == 'Mega Projects') ||
            ($echo['group_name'] == 'Local Loop') || ($echo['group_name'] =='Local Loop  ') ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; ">
    '.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }

    //******************///TAM_Utilization_day
        
    if(($echo['TAM_utilization_day'] >= '65%') && ($echo['TAM_utilization_day'] != NULL) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
    if(($echo['TAM_utilization_day'] < '65%') && ($echo['TAM_utilization_day'] != NULL) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
    if($echo['TAM_utilization_day'] == NULL){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
   
$persent = $echo['m_absen'];


   if($persent <=  5.000){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:lightgreen;">'.$echo['Absenteeism'].'</td>';
        }else{
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:#ff6666;">'.$echo['Absenteeism'].'</td>';   
        }
        //AHT_Logical_Avg

    if($echo["AHT_Logical_Avg"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT_Logical_Avg']->format('H:i:s').'</td>';
            }
        if($echo["AHT_Logical_Avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
            }

//AHT_Logical%
  if($echo["AHT_Logical%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }
if( ($echo['colour_code'] == 'colour red') && ($echo["AHT_Logical%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['AHT_Logical%'].'</td>';}
  if( ($echo['colour_code'] != 'colour red') && ($echo["AHT_Logical%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['AHT_Logical%'].'</td>';}
  //AHT_Other_Avg
 if($echo["AHT_Other_Avg"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT_Other_Avg']->format('H:i:s').'</td>';
            }
        if($echo["AHT_Other_Avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
            }
  //[AHT_Other%]
   if($echo["AHT_Other%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }
if( ($echo['colour_AHT_Other'] == 'colour red') && ($echo["AHT_Other%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['AHT_Other%'].'</td>';}
  if( ($echo['colour_AHT_Other'] != 'colour red') && ($echo["AHT_Other%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['AHT_Other%'].'</td>';}
//MTTI1_avg
      if($echo["MTTI1_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI1_avg']->format('H:i:s').'</td>';}

      //colour_MTTI1
    if($echo["MTTI1%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTI1'] == 'colour red') && ($echo["MTTI1%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTI1%'].'</td>';
    }
    if( ($echo['colour_MTTI1'] != 'colour red') && ($echo["MTTI1%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTI1%'].'</td>';
    }

  ///////////////////
    if($echo["MTTI2_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if($echo["MTTI2_avg"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_avg']->format('H:i:s').'</td>';
    }

    if($echo["MTTI2%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTI2'] == 'colour red') && ($echo["MTTI2%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTI2%'].'</td>';
    }
    if( ($echo['colour_MTTI2'] != 'colour red') && ($echo["MTTI2%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTI2%'].'</td>';
    }
    if($echo["MTTV_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
    }else{
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_avg']->format('H:i:s').'</td>';
    }

    if($echo["MTTV%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTV'] == 'colour red') && ($echo["MTTV%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTV%'].'</td>';
    }
    if( ($echo['colour_MTTV'] != 'colour red') && ($echo["MTTV%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTV%'].'</td>';
    }
    //////////////
    //$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_Logical%'].'</td>';
    if($echo["MTTR_Logical%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colourLogical'] == 'colour red') && ($echo["MTTR_Logical%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTR_Logical%'].'</td>';
    }
    if( ($echo['colourLogical'] != 'colour red') && ($echo["MTTR_Logical%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTR_Logical%'].'</td>';
    }
    //////////////
    if($echo["Wrong_node%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen ; font-size:13px ;color:black;">0</td>';
    }
    else{
        $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Wrong_node%'].'</td>';
            }
////

  if($echo["Not_Assigned%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen ; font-size:13px ;color:black;">0</td>';
    }
    else{

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Not_Assigned%'].'</td>';
    }
    
    //////////////
    if($echo["global_tickets_have_PSD"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_have_PSD'] == 'colour red') && ($echo["global_tickets_have_PSD"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['global_tickets_have_PSD'].'</td>';
    }
    if( ($echo['colour_have_PSD'] != 'colour red') && ($echo["global_tickets_have_PSD"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['global_tickets_have_PSD'].'</td>';
    }
    ////////////// 
    if($echo["Performance_enhancement"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_enhancement'] == 'colour red') && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Performance_enhancement'].'</td>';
    }
    if( ($echo['colour_enhancement'] != 'colour red') && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['Performance_enhancement'].'</td>';
    }
    //////////////
     
     if($echo["New_technology_awareness"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_awareness'] == 'colour red') && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['New_technology_awareness'].'</td>';
    }
    if( ($echo['colour_awareness'] != 'colour red') && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['New_technology_awareness'].'</td>';
    }
    //////////////

        $rows .= '</tr>';
        echo $rows;
}
}
}
?>
</tbody>
</table>

<?php 
if(isset($_GET['Sub_group'])){
  ?>
 <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Summary Kpi`s
                Subgroup
      <a href="Summary_kpi.php">
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
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter"data-table="order-table"placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; ">
    <tr>

            <th><center>Year</center></th>
            <th><center>Month</center></th>
            <th><center>Group Name</center></th>
            <th><center>Sub Group</center></th>
            <th><center>utilization without resident_day</center></th>
            <th><center>TAM_utilization_day</center></th>
            <th><center>Absenteeism</center></th>
            <th><center>AHT Logical Avg</center></th>
            <th><center>AHT Logical%</center></th>
            <th><center>AHT Other Avg</center></th>
            <th><center>AHT Other%</center></th>
            <th><center>MTTI1_avg</center> </th>
            <th><center>MTTI1%</center></th>
            <th><center>MTTI2_avg</center></th>
            <th><center>MTTI2%</center></th>
            <th><center>MTTV_avg</center></th>
            <th><center>MTTV%</center></th>
            <th><center>MTTR_Logical</center> </th>  
            <th><center>Wrong_node</center> </th>
            <th><center>Not_Assigned</center> </th>
            <th><center>global_tickets_have_PSD</center> </th> 
            <th><center>Performance_enhancement</center> </th> 
            <th><center>New_technology_awareness</center> </th> 
   
    </tr>
    </thead>
  
  <tbody>

<?php 

if(($_SESSION['username'] == 'ahmed.mohamedbassal') ||
    ($_SESSION['username'] == 'mohamed.abdeltwab') ){

   $new_query = sqlsrv_query( $con , "SELECT  [Year]
        ,[MONTH]
        ,k.[group_name]
        ,[Sub_group]
        ,k.[utilization_without_Resident_TAM_day]
        ,k.[TAM_utilization_day]
        ,k.[Absenteeism]
        ,cast (SUBSTRING(k.[Absenteeism],1,LEN(k.[Absenteeism])-1)  as decimal (5,3)) m_absen
        ,[AHT_Logical_Avg]
        ,[AHT_Logical%]
        ,[AHT_Other_Avg]
        ,[AHT_Other%]
        ,cast ( SUBSTRING([AHT_Logical%],1,LEN([AHT_Logical%])-1)  as decimal(5,2)) [k_aht_Logical]
        ,[AHT_logical %]*100.00 [t_aht_logical]
        ,iif(cast ( SUBSTRING([AHT_Logical%],1,LEN([AHT_Logical%])-1)  as decimal(5,2)) < [AHT_logical %]*100.00,'colour red', 'colour green') [colour_code]
        ,cast ( SUBSTRING([AHT_Other%],1,LEN([AHT_Other%])-1)  as decimal(5,2)) [k_aht_Other]
        ,[AHT_other %]*100.00 [t_aht_Other]
        ,iif(cast ( SUBSTRING([AHT_Other%],1,LEN([AHT_Other%])-1)  as decimal(5,2)) < [AHT_other %]*100.00,'colour red', 'colour green') [colour_AHT_Other]
        ,[MTTI1_avg]
        ,[MTTI1%]
        ,iif(cast ( SUBSTRING([MTTI1%],1,LEN([MTTI1%])-1)  as decimal(5,2)) <[MTTI1 %] *100.00,'colour red', 'colour green') [colour_MTTI1]
        ,[MTTI2_avg]
        ,[MTTI2%]
        ,iif(cast ( SUBSTRING([MTTI2%],1,LEN([MTTI2%])-1)  as decimal(5,2)) <[MTTI2 %] *100.00,'colour red', 'colour green') [colour_MTTI2]
        ,[MTTV_avg]
        ,[MTTV%]
        ,iif(cast ( SUBSTRING([MTTV%],1,LEN([MTTV%])-1)  as decimal(5,2)) <[MTTV %] *100.00,'colour red', 'colour green') [colour_MTTV]
        ,[MTTR_Logical%]
        ,iif(cast ( SUBSTRING([MTTR_Logical%],1,LEN([MTTR_Logical%])-1)  as decimal(5,2)) <[MTTR Logical %]*100.00,'colour red', 'colour green') [colourLogical]
        ,[Wrong_node%]
        ,[Not_Assigned%]
        ,iif(cast ( SUBSTRING([Not_Assigned%],1,LEN([Not_Assigned%])-1)  as decimal(5,2)) <[Not Assigned %]*100.00,'colour red', 'colour green') [colour_Assigned]
        ,k.[global_tickets_have_PSD]
        ,iif(cast ( SUBSTRING(k.[global_tickets_have_PSD],1,LEN(k.[global_tickets_have_PSD])-1)  as decimal(5,2)) <t.[global_tickets_have_PSD]*100.00,'colour red', 'colour green') [colour_have_PSD]
        ,k.[Performance_enhancement]
        ,iif(cast ( SUBSTRING(k.[Performance_enhancement],1,LEN(k.[Performance_enhancement])-1)  as decimal(5,2)) <t.[Performance_enhancement]*20.00,'colour red', 'colour green') [colour_enhancement]
        ,k.[New_technology_awareness]
        ,iif(cast ( SUBSTRING(k.[New_technology_awareness],1,LEN(k.[New_technology_awareness])-1)  as decimal(5,2)) <t.[New_technology_awareness]*20.00,'colour red', 'colour green') [colour_awareness]
  FROM [WorkForce_Reporting_DB].[dbo].[kpi_2023_subgroup] k
  left join [WorkForce_Reporting_DB].[dbo].[KPI_target] t on k.group_name=t.Group_Name
  where  (k.group_name like 'private KAM%' or k.group_name like 'GDS%')
  order by 1,len([MONTH]),2,3");

      while($echo = sqlsrv_fetch_array($new_query) ){

     $rows = '<tr>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['group_name'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Sub_group'].'</td>';
    //utilization without resident_day
    //GOV & Public
      if(($echo['group_name'] == 'GOV') && 
    ($echo['group_name'] != 'BS')&&
    ($echo['group_name'] != 'Banking')&&
    ($echo['group_name'] != 'Private KAM')&&
    ($echo['utilization_without_Resident_TAM_day'] > 62) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
      }if(($echo['group_name'] == 'GOV') && 
    ($echo['group_name'] != 'BS')&&
    ($echo['group_name'] != 'Banking')&&
    ($echo['group_name'] != 'Private KAM')&&
    ($echo['utilization_without_Resident_TAM_day'] <= 62) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
      }
    //Private KAM
      if(($echo['group_name'] == 'Private KAM') && 
    ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization_without_Resident_TAM_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
      }if(($echo['group_name'] == 'Private KAM')   && 
    ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization_without_Resident_TAM_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
    }

        ///GDS(Global Partner)
        //Banking
        if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] >= 58 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] < 58 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
        //BS
      if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] >= 78 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
      }if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] < 78 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
   
   if(($echo['group_name'] == 'GDS(Global Partner)') ||
            ($echo['group_name'] == 'Mega Projects') ||
            ($echo['group_name'] == 'Local Loop') || ($echo['group_name'] =='Local Loop  ') ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; ">
    '.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
    //******************///TAM_Utilization_day
    if(($echo['TAM_utilization_day'] >= '65%') && ($echo['TAM_utilization_day'] != NULL) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
    if(($echo['TAM_utilization_day'] < '65%') && ($echo['TAM_utilization_day'] != NULL) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
    if($echo['TAM_utilization_day'] == NULL){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
   
    $persent = $echo['m_absen'];
   if($persent <=  5.000){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:lightgreen;">'.$echo['Absenteeism'].'</td>';
        }else{
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:#ff6666;">'.$echo['Absenteeism'].'</td>';   
        }
//AHT_Logical_Avg
    if($echo["AHT_Logical_Avg"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT_Logical_Avg']->format('H:i:s').'</td>';
            }
        if($echo["AHT_Logical_Avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
            }
//AHT_Logical%
  if($echo["AHT_Logical%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }
if( ($echo['colour_code'] == 'colour red') && ($echo["AHT_Logical%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['AHT_Logical%'].'</td>';}
  if( ($echo['colour_code'] != 'colour red') && ($echo["AHT_Logical%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['AHT_Logical%'].'</td>';}
  //AHT_Other_Avg
  if($echo["AHT_Other_Avg"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT_Other_Avg']->format('H:i:s').'</td>';
            }
        if($echo["AHT_Other_Avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
            }
  //[AHT_Other%]
   if($echo["AHT_Other%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }
if( ($echo['colour_AHT_Other'] == 'colour red') && ($echo["AHT_Other%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['AHT_Other%'].'</td>';}
  if( ($echo['colour_AHT_Other'] != 'colour red') && ($echo["AHT_Other%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['AHT_Other%'].'</td>';}
    //MTTI1_avg
          if($echo["MTTI1_avg"] == NULL ){
        $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
      }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI1_avg']->format('H:i:s').'</td>';}

      //colour_MTTI1
    if($echo["MTTI1%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTI1'] == 'colour red') && ($echo["MTTI1%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTI1%'].'</td>';
    }
    if( ($echo['colour_MTTI1'] != 'colour red') && ($echo["MTTI1%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTI1%'].'</td>';
    }

  ///////////////////

     if($echo["MTTI2_avg"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_avg']->format('H:i:s').'</td>';
            }
        if($echo["MTTI2_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
            }

    if($echo["MTTI2%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTI2'] == 'colour red') && ($echo["MTTI2%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTI2%'].'</td>';
    }
    if( ($echo['colour_MTTI2'] != 'colour red') && ($echo["MTTI2%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTI2%'].'</td>';
    }
    if($echo["MTTV_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
    }else{
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_avg']->format('H:i:s').'</td>';
    }

    if($echo["MTTV%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTV'] == 'colour red') && ($echo["MTTV%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTV%'].'</td>';
    }
    if( ($echo['colour_MTTV'] != 'colour red') && ($echo["MTTV%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTV%'].'</td>';
    }
    //////////////
    if($echo["MTTR_Logical%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colourLogical'] == 'colour red') && ($echo["MTTR_Logical%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTR_Logical%'].'</td>';
    }
    if( ($echo['colourLogical'] != 'colour red') && ($echo["MTTR_Logical%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTR_Logical%'].'</td>';
    }
    //////////////
    if($echo["Wrong_node%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen ; font-size:13px ;color:black;">0</td>';
    }
    else{
        $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Wrong_node%'].'</td>';
            }
////

  if($echo["Not_Assigned%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen ; font-size:13px ;color:black;">0</td>';
    }
    else{

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Not_Assigned%'].'</td>';
    }
    
    //////////////
    if($echo["global_tickets_have_PSD"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_have_PSD'] == 'colour red') && ($echo["global_tickets_have_PSD"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['global_tickets_have_PSD'].'</td>';
    }
    if( ($echo['colour_have_PSD'] != 'colour red') && ($echo["global_tickets_have_PSD"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['global_tickets_have_PSD'].'</td>';
    }
    ////////////// 
    if($echo["Performance_enhancement"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_enhancement'] == 'colour red') && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Performance_enhancement'].'</td>';
    }
    if( ($echo['colour_enhancement'] != 'colour red') && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['Performance_enhancement'].'</td>';
    }
    //////////////
     
     if($echo["New_technology_awareness"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_awareness'] == 'colour red') && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['New_technology_awareness'].'</td>';
    }
    if( ($echo['colour_awareness'] != 'colour red') && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['New_technology_awareness'].'</td>';
    }  
        $rows .= '</tr>';
        echo $rows;
}

}

if(($_SESSION['username'] == 'ahmed.akef') || ($_SESSION['role_id'] == 1) ){

   $new_query = sqlsrv_query( $con ,"SELECT  [Year]
    ,[MONTH]
    ,k.[group_name]
    ,[Sub_group]
    ,k.[utilization_without_Resident_TAM_day]
    ,k.[TAM_utilization_day]
    ,k.[Absenteeism]
    ,cast (SUBSTRING(k.[Absenteeism],1,LEN(k.[Absenteeism])-1)  as decimal (5,3)) m_absen
    ,[AHT_Logical_Avg]
    ,[AHT_Logical%]
    ,[AHT_Other_Avg]
    ,[AHT_Other%]
    ,cast ( SUBSTRING([AHT_Logical%],1,LEN([AHT_Logical%])-1)  as decimal(5,2)) [k_aht_Logical]
    ,[AHT_logical %]*100.00 [t_aht_logical]
    ,iif(cast ( SUBSTRING([AHT_Logical%],1,LEN([AHT_Logical%])-1)  as decimal(5,2)) < [AHT_logical %]*100.00,'colour red', 'colour green') [colour_code]
    ,cast ( SUBSTRING([AHT_Other%],1,LEN([AHT_Other%])-1)  as decimal(5,2)) [k_aht_Other]
    ,[AHT_other %]*100.00 [t_aht_Other]
    ,iif(cast ( SUBSTRING([AHT_Other%],1,LEN([AHT_Other%])-1)  as decimal(5,2)) < [AHT_other %]*100.00,'colour red', 'colour green') [colour_AHT_Other]
    ,[MTTI1_avg]
    ,[MTTI1%]
    ,iif(cast ( SUBSTRING([MTTI1%],1,LEN([MTTI1%])-1)  as decimal(5,2)) <[MTTI1 %] *100.00,'colour red', 'colour green') [colour_MTTI1]
    ,[MTTI2_avg]
    ,[MTTI2%]
    ,iif(cast ( SUBSTRING([MTTI2%],1,LEN([MTTI2%])-1)  as decimal(5,2)) <[MTTI2 %] *100.00,'colour red', 'colour green') [colour_MTTI2]
    ,[MTTV_avg]
    ,[MTTV%]
    ,iif(cast ( SUBSTRING([MTTV%],1,LEN([MTTV%])-1)  as decimal(5,2)) <[MTTV %] *100.00,'colour red', 'colour green') [colour_MTTV]
    ,[MTTR_Logical%]
    ,iif(cast ( SUBSTRING([MTTR_Logical%],1,LEN([MTTR_Logical%])-1)  as decimal(5,2)) <[MTTR Logical %]*100.00,'colour red', 'colour green') [colourLogical]
    ,[Wrong_node%]
    ,[Not_Assigned%]
    ,iif(cast ( SUBSTRING([Not_Assigned%],1,LEN([Not_Assigned%])-1)  as decimal(5,2)) <[Not Assigned %]*100.00,'colour red', 'colour green') [colour_Assigned]
    ,k.[global_tickets_have_PSD]
    ,iif(cast ( SUBSTRING(k.[global_tickets_have_PSD],1,LEN(k.[global_tickets_have_PSD])-1)  as decimal(5,2)) <t.[global_tickets_have_PSD]*100.00,'colour red', 'colour green') [colour_have_PSD]
    ,k.[Performance_enhancement]
    ,iif(cast ( SUBSTRING(k.[Performance_enhancement],1,LEN(k.[Performance_enhancement])-1)  as decimal(5,2)) <t.[Performance_enhancement]*20.00,'colour red', 'colour green') [colour_enhancement]
    ,k.[New_technology_awareness]
    ,iif(cast ( SUBSTRING(k.[New_technology_awareness],1,LEN(k.[New_technology_awareness])-1)  as decimal(5,2)) <t.[New_technology_awareness]*20.00,'colour red', 'colour green') [colour_awareness]
  FROM [WorkForce_Reporting_DB].[dbo].[kpi_2023_subgroup] k
  left join [WorkForce_Reporting_DB].[dbo].[KPI_target] t on k.group_name=t.Group_Name  where [Year] >='$this_year'
  order by 1,len([MONTH]),2,3  ");
      while($echo = sqlsrv_fetch_array($new_query) ){

     $rows = '<tr>';
   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['group_name'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Sub_group'].'</td>';
    //utilization without resident_day
    //GOV & Public
    if(($echo['group_name'] == 'GOV') && 
      ($echo['group_name'] != 'BS')&&
      ($echo['group_name'] != 'Banking')&&
      ($echo['group_name'] != 'Private KAM')&&
      ($echo['utilization_without_Resident_TAM_day'] > 62) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'GOV') && 
          ($echo['group_name'] != 'BS')&&
          ($echo['group_name'] != 'Banking')&&
          ($echo['group_name'] != 'Private KAM')&&
          ($echo['utilization_without_Resident_TAM_day'] <= 62) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
        //Private KAM
        if(($echo['group_name'] == 'Private KAM') && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization_without_Resident_TAM_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Private KAM')   && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization_without_Resident_TAM_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
       
        ///GDS(Global Partner)
        //Banking
        if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] >= 58 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] < 58 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
        //BS
      if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] >= 78 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
      }if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] < 78 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
   
   if(($echo['group_name'] == 'GDS(Global Partner)') ||
            ($echo['group_name'] == 'Mega Projects') ||
            ($echo['group_name'] == 'Local Loop') || ($echo['group_name'] =='Local Loop  ') ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; ">
    '.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
    //******************///TAM_Utilization_day
    if(($echo['TAM_utilization_day'] >= '65%') && ($echo['TAM_utilization_day'] != NULL) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
    if(($echo['TAM_utilization_day'] < '65%') && ($echo['TAM_utilization_day'] != NULL) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
    if($echo['TAM_utilization_day'] == NULL){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
   
    $persent = $echo['m_absen'];
   if($persent <=  5.000){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:lightgreen;">'.$echo['Absenteeism'].'</td>';
        }else{
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:#ff6666;">'.$echo['Absenteeism'].'</td>';   
        }
//AHT_Logical_Avg
    if($echo["AHT_Logical_Avg"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT_Logical_Avg']->format('H:i:s').'</td>';
            }
        if($echo["AHT_Logical_Avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
            }

//AHT_Logical%
  if($echo["AHT_Logical%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }
if( ($echo['colour_code'] == 'colour red') && ($echo["AHT_Logical%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['AHT_Logical%'].'</td>';}
  if( ($echo['colour_code'] != 'colour red') && ($echo["AHT_Logical%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['AHT_Logical%'].'</td>';}
  //AHT_Other_Avg
  if($echo["AHT_Other_Avg"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT_Other_Avg']->format('H:i:s').'</td>';
            }
        if($echo["AHT_Other_Avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
            }
  //[AHT_Other%]
   if($echo["AHT_Other%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }
if( ($echo['colour_AHT_Other'] == 'colour red') && ($echo["AHT_Other%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['AHT_Other%'].'</td>';}
  if( ($echo['colour_AHT_Other'] != 'colour red') && ($echo["AHT_Other%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['AHT_Other%'].'</td>';}
    //MTTI1_avg
          if($echo["MTTI1_avg"] == NULL ){
        $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
      }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI1_avg']->format('H:i:s').'</td>';}

      //colour_MTTI1
    if($echo["MTTI1%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTI1'] == 'colour red') && ($echo["MTTI1%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTI1%'].'</td>';
    }
    if( ($echo['colour_MTTI1'] != 'colour red') && ($echo["MTTI1%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTI1%'].'</td>';
    }

  ///////////////////
     if($echo["MTTI2_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
    }else{
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_avg']->format('H:i:s').'</td>';
    }

    if($echo["MTTI2%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTI2'] == 'colour red') && ($echo["MTTI2%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTI2%'].'</td>';
    }
    if( ($echo['colour_MTTI2'] != 'colour red') && ($echo["MTTI2%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTI2%'].'</td>';
    }
    if($echo["MTTV_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
    }else{
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_avg']->format('H:i:s').'</td>';
    }

    if($echo["MTTV%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTV'] == 'colour red') && ($echo["MTTV%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTV%'].'</td>';
    }
    if( ($echo['colour_MTTV'] != 'colour red') && ($echo["MTTV%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTV%'].'</td>';
    }
    //////////////
    if($echo["MTTR_Logical%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colourLogical'] == 'colour red') && ($echo["MTTR_Logical%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTR_Logical%'].'</td>';
    }
    if( ($echo['colourLogical'] != 'colour red') && ($echo["MTTR_Logical%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTR_Logical%'].'</td>';
    }
    //////////////
    if($echo["Wrong_node%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen ; font-size:13px ;color:black;">0</td>';
    }
    else{
        $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Wrong_node%'].'</td>';
            }
////

  if($echo["Not_Assigned%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen ; font-size:13px ;color:black;">0</td>';
    }
    else{

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Not_Assigned%'].'</td>';
    }
    
    //////////////
    if($echo["global_tickets_have_PSD"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_have_PSD'] == 'colour red') && ($echo["global_tickets_have_PSD"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['global_tickets_have_PSD'].'</td>';
    }
    if( ($echo['colour_have_PSD'] != 'colour red') && ($echo["global_tickets_have_PSD"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['global_tickets_have_PSD'].'</td>';
    }
    ////////////// 
    if($echo["Performance_enhancement"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_enhancement'] == 'colour red') && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Performance_enhancement'].'</td>';
    }
    if( ($echo['colour_enhancement'] != 'colour red') && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['Performance_enhancement'].'</td>';
    }
    //////////////
     
     if($echo["New_technology_awareness"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_awareness'] == 'colour red') && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['New_technology_awareness'].'</td>';
    }
    if( ($echo['colour_awareness'] != 'colour red') && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['New_technology_awareness'].'</td>';
    }
        $rows .= '</tr>';
        echo $rows;
}

}
else{

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
   $new_query = sqlsrv_query( $con , "SELECT  [Year]
    ,[MONTH]
    ,k.[group_name]
    ,[Sub_group]
    ,k.[utilization_without_Resident_TAM_day]
    ,k.[TAM_utilization_day]
    ,k.[Absenteeism]
    ,cast (SUBSTRING(k.[Absenteeism],1,LEN(k.[Absenteeism])-1)  as decimal (5,3)) m_absen
    ,[AHT_Logical_Avg]
    ,[AHT_Logical%]
    ,[AHT_Other_Avg]
    ,[AHT_Other%]
    ,cast ( SUBSTRING([AHT_Logical%],1,LEN([AHT_Logical%])-1)  as decimal(5,2)) [k_aht_Logical]
    ,[AHT_logical %]*100.00 [t_aht_logical]
    ,iif(cast ( SUBSTRING([AHT_Logical%],1,LEN([AHT_Logical%])-1)  as decimal(5,2)) < [AHT_logical %]*100.00,'colour red', 'colour green') [colour_code]
    ,cast ( SUBSTRING([AHT_Other%],1,LEN([AHT_Other%])-1)  as decimal(5,2)) [k_aht_Other]
    ,[AHT_other %]*100.00 [t_aht_Other]
    ,iif(cast ( SUBSTRING([AHT_Other%],1,LEN([AHT_Other%])-1)  as decimal(5,2)) < [AHT_other %]*100.00,'colour red', 'colour green') [colour_AHT_Other]
    ,[MTTI1_avg]
    ,[MTTI1%]
    ,iif(cast ( SUBSTRING([MTTI1%],1,LEN([MTTI1%])-1)  as decimal(5,2)) <[MTTI1 %] *100.00,'colour red', 'colour green') [colour_MTTI1]
    ,[MTTI2_avg]
    ,[MTTI2%]
    ,iif(cast ( SUBSTRING([MTTI2%],1,LEN([MTTI2%])-1)  as decimal(5,2)) <[MTTI2 %] *100.00,'colour red', 'colour green') [colour_MTTI2]
    ,[MTTV_avg]
    ,[MTTV%]
    ,iif(cast ( SUBSTRING([MTTV%],1,LEN([MTTV%])-1)  as decimal(5,2)) <[MTTV %] *100.00,'colour red', 'colour green') [colour_MTTV]
    ,[MTTR_Logical%]
    ,iif(cast ( SUBSTRING([MTTR_Logical%],1,LEN([MTTR_Logical%])-1)  as decimal(5,2)) <[MTTR Logical %]*100.00,'colour red', 'colour green') [colourLogical]
    ,[Wrong_node%]
    ,[Not_Assigned%]
    ,iif(cast ( SUBSTRING([Not_Assigned%],1,LEN([Not_Assigned%])-1)  as decimal(5,2)) <[Not Assigned %]*100.00,'colour red', 'colour green') [colour_Assigned]
    ,k.[global_tickets_have_PSD]
    ,iif(cast ( SUBSTRING(k.[global_tickets_have_PSD],1,LEN(k.[global_tickets_have_PSD])-1)  as decimal(5,2)) <t.[global_tickets_have_PSD]*100.00,'colour red', 'colour green') [colour_have_PSD]
    ,k.[Performance_enhancement]
    ,iif(cast ( SUBSTRING(k.[Performance_enhancement],1,LEN(k.[Performance_enhancement])-1)  as decimal(5,2)) <t.[Performance_enhancement]*20.00,'colour red', 'colour green') [colour_enhancement]
    ,k.[New_technology_awareness]
    ,iif(cast ( SUBSTRING(k.[New_technology_awareness],1,LEN(k.[New_technology_awareness])-1)  as decimal(5,2)) <t.[New_technology_awareness]*20.00,'colour red', 'colour green') [colour_awareness]
  FROM [WorkForce_Reporting_DB].[dbo].[kpi_2023_subgroup] k
  left join [WorkForce_Reporting_DB].[dbo].[KPI_target] t on k.group_name=t.Group_Name
  where k.group_name like '$my_group%'
  and [Year] >='$this_year'order by 1,len([MONTH]),2,3  ");
      while($echo = sqlsrv_fetch_array($new_query) ){

     $rows = '<tr>';
   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['group_name'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Sub_group'].'</td>';
    //utilization without resident_day
    //GOV & Public
    if(($echo['group_name'] == 'GOV') && 
      ($echo['group_name'] != 'BS')&&
      ($echo['group_name'] != 'Banking')&&
      ($echo['group_name'] != 'Private KAM')&&
      ($echo['utilization_without_Resident_TAM_day'] > 62) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'GOV') && 
          ($echo['group_name'] != 'BS')&&
          ($echo['group_name'] != 'Banking')&&
          ($echo['group_name'] != 'Private KAM')&&
          ($echo['utilization_without_Resident_TAM_day'] <= 62) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
        //Private KAM
        if(($echo['group_name'] == 'Private KAM') && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization_without_Resident_TAM_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Private KAM')   && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization_without_Resident_TAM_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
       
        ///GDS(Global Partner)
        //Banking
        if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] >= 58 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] < 58 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
        //BS
      if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] >= 78 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
      }if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization_without_Resident_TAM_day'] < 78 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
   
   if(($echo['group_name'] == 'GDS(Global Partner)') ||
            ($echo['group_name'] == 'Mega Projects') ||
            ($echo['group_name'] == 'Local Loop') || ($echo['group_name'] =='Local Loop  ') ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; ">
    '.$echo['utilization_without_Resident_TAM_day'].'</td>';
        }
    //******************///TAM_Utilization_day
    if(($echo['TAM_utilization_day'] >= '65%') && ($echo['TAM_utilization_day'] != NULL) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
    if(($echo['TAM_utilization_day'] < '65%') && ($echo['TAM_utilization_day'] != NULL) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
    if($echo['TAM_utilization_day'] == NULL){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['TAM_utilization_day'].'</td>';//65
    }
   
    $persent = $echo['m_absen'];
   if($persent <=  5.000){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:lightgreen;">'.$echo['Absenteeism'].'</td>';
        }else{
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:#ff6666;">'.$echo['Absenteeism'].'</td>';   
        }
//AHT_Logical_Avg
        if($echo["AHT_Logical_Avg"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT_Logical_Avg']->format('H:i:s').'</td>';
            }
        if($echo["AHT_Logical_Avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
            }

//AHT_Logical%
  if($echo["AHT_Logical%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }
if( ($echo['colour_code'] == 'colour red') && ($echo["AHT_Logical%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['AHT_Logical%'].'</td>';}
  if( ($echo['colour_code'] != 'colour red') && ($echo["AHT_Logical%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['AHT_Logical%'].'</td>';}
  //AHT_Other_Avg

  if($echo["AHT_Other_Avg"] !== NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT_Other_Avg']->format('H:i:s').'</td>';
            }
        if($echo["AHT_Other_Avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
            }
  //[AHT_Other%]
   if($echo["AHT_Other%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }
if( ($echo['colour_AHT_Other'] == 'colour red') && ($echo["AHT_Other%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['AHT_Other%'].'</td>';}
  if( ($echo['colour_AHT_Other'] != 'colour red') && ($echo["AHT_Other%"] !== NULL )){

  $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['AHT_Other%'].'</td>';}
    //MTTI1_avg
          if($echo["MTTI1_avg"] == NULL ){
        $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
      }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI1_avg']->format('H:i:s').'</td>';}

      //colour_MTTI1
    if($echo["MTTI1%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTI1'] == 'colour red') && ($echo["MTTI1%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTI1%'].'</td>';
    }
    if( ($echo['colour_MTTI1'] != 'colour red') && ($echo["MTTI1%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTI1%'].'</td>';
    }

  ///////////////////
    if($echo["MTTI2_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
    }else{
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_avg']->format('H:i:s').'</td>';
    }

    if($echo["MTTI2%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTI2'] == 'colour red') && ($echo["MTTI2%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTI2%'].'</td>';
    }
    if( ($echo['colour_MTTI2'] != 'colour red') && ($echo["MTTI2%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTI2%'].'</td>';
    }

     if($echo["MTTV_avg"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">Blank</td>';
    }else{
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV_avg']->format('H:i:s').'</td>';
    }

    if($echo["MTTV%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_MTTV'] == 'colour red') && ($echo["MTTV%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTV%'].'</td>';
    }
    if( ($echo['colour_MTTV'] != 'colour red') && ($echo["MTTV%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTV%'].'</td>';
    }
    //////////////
    if($echo["MTTR_Logical%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colourLogical'] == 'colour red') && ($echo["MTTR_Logical%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['MTTR_Logical%'].'</td>';
    }
    if( ($echo['colourLogical'] != 'colour red') && ($echo["MTTR_Logical%"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['MTTR_Logical%'].'</td>';
    }
    //////////////
    if($echo["Wrong_node%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen ; font-size:13px ;color:black;">0</td>';
    }
    else{
        $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Wrong_node%'].'</td>';
            }
////

  if($echo["Not_Assigned%"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen ; font-size:13px ;color:black;">0</td>';
    }
    else{

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Not_Assigned%'].'</td>';
    }
    
    //////////////
    if($echo["global_tickets_have_PSD"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_have_PSD'] == 'colour red') && ($echo["global_tickets_have_PSD"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['global_tickets_have_PSD'].'</td>';
    }
    if( ($echo['colour_have_PSD'] != 'colour red') && ($echo["global_tickets_have_PSD"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['global_tickets_have_PSD'].'</td>';
    }
    ////////////// 
    if($echo["Performance_enhancement"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_enhancement'] == 'colour red') && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['Performance_enhancement'].'</td>';
    }
    if( ($echo['colour_enhancement'] != 'colour red') && ($echo["Performance_enhancement"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['Performance_enhancement'].'</td>';
    }
    //////////////
     
     if($echo["New_technology_awareness"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
    }
    if( ($echo['colour_awareness'] == 'colour red') && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['New_technology_awareness'].'</td>';
    }
    if( ($echo['colour_awareness'] != 'colour red') && ($echo["New_technology_awareness"] !== NULL )){

    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['New_technology_awareness'].'</td>';
    }
    
        $rows .= '</tr>';
        echo $rows;
}
}
}

    ?>
    </tbody>
</table>
</div>
</div>
</div>


<div style="padding:20px;">
<div id="dataModal" tabindex="-1" role="dialog" >
    <div>
     <div class="modal mt-5" id="centralModal" >
      <div id="myOut" class="modal-content" >

        <h5 class="modal-title" >Update</h5>
         <div><button class="c" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
           </button></div>
        <label>group name</label>
            <input type="text" class="form-control  groupname"disabled="true" />
             <label class="form-control">month</label>
             <input type="text" class="form-control  month" disabled="true" />

                <div class="modal-body">
                <input id="group_name_input" type="hidden" value="" />
                 <input id="month_input" type="hidden" value="" />
                 <input id="year_input" type="hidden" value="" />
                  <br>
                  <div id="New_technology_awareness_div" class="input-group md-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        New_techno </span>
                    </div>
                    <input id="New_technology_awareness_input" class="form-control w-100 New_techno" autofocus="true" name="New_technology_awareness" type="number" placeholder="Update Performance" />

                  </div>

                  <br>
                  <div id="Performance_enhancement_div" class="input-group md-2">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        Performance enhancement</span>
                    </div>
                    
                     
                    <input id="Performance_enhancement_input" class="form-control w-100 Performan" name="Performance_enhancement" type="number" placeholder="Update New Technology" />

                  </div>
                  <br>
                </div>
          <div class="modal-footer">

          <button class="btn btn-primary submit">Submit</button>
             <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div>

<!-------------------->
 <div id="dataModal" tabindex="-1" role="dialog" >
    <div>
     <div class="modal mt-5" id="smallM" >
      <div id="myOut" class="modal-content" >

        <h5 class="modal-title" >Not Assigned Tickets</h5>
         
        
               <div class="modal-body">
                <input id="group_name_input" type="hidden" value="" />
                
                  <br>
                  <div id="" class="input-group md-2">
                    
                    <div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
<thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; ">
            <tr>
                <th >Year</th>
                <th >Month</th>
                <th >Not_Assigned</th>
            </tr>
        </thead>
        <tbody>
                            
                    <?php 
    $view =sqlsrv_query($con, "SELECT 
    year(creation_time) [year]
    ,month(creation_time) [Month]
    ,([RequestID]) [Not Assigned Tickets]
      FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   where ((Month(creation_time) =DATEPART(m, DATEADD(m, -1, getdate()))  AND year(creation_time) = DATEPART(yyyy, DATEADD(m, -1, getdate()))) or ((Month(creation_time)=MONTH(GETDATE()) AND year(creation_time) = year(getdate())))) and Fake_Real = 'Real Ticket' and (closure_reason not in ('Wrong Ticket') or closure_reason is null ) and (Ticket_group not in ('unmanaged','ESLM','ESOC','Onsite') or Ticket_group is null ) and ticket_status='closed'
   and RequestID not in (SELECT distinct [RequestID]
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where request_mode ='Internal Reference') and RequestID not in (SELECT distinct [Old PSC ID]
  FROM [172.29.29.77].[WorkforceDB].[dbo].[PSC_Merged_TKTs]) 
   and Ticket_group is null
   and RequestID not in (select requestid
from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where Category='request' and Subcategory='Report/Info' and Item='Information Request' and [request_closure_code]=311)");

                 while($notAss = sqlsrv_fetch_array($view)){
                  $viwY=$notAss['year'];
                  $viewM=$notAss['Month'];
                 $viewNot =$notAss['Not Assigned Tickets'];
                 ?>
                    <tr>
                               

        <td > <?php echo  $viwY;?></td>
        <td ><?php echo  $viewM;?></td>
        <td ><?php echo  $viewNot;?></td>

 </tr>
 <?php 
}
?>                </tbody>
                </table>
              </div>
              <br>
            </div>
          <div class="modal-footer">
             <button type="button" class="btn btn-secondary close" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
</div>
    </div>
</div>

    <!-- <div id="ayayay"></div>  -->
         
<script type="text/javascript">
    $(document).ready(function(){
        $('.view').click(function(){
            $('#smallM').modal('show');
        })
    })
    
    </script>  
          <script>
            $(document).ready(function() {
                function update_ajax(data) {
                    $.ajax({
                    url: 'update_monthly.php',
                    type: 'POST',
                    data: data,
                    cache: false,

                    success: function(data) {
                        swal({ title: "Done", icon: "success",}).then(function() {
                                window.location.href=window.location.href
                            });
                       // console.log(data);
                        //$('#ayayay').html(data);
                            


                    }
                  });
                }
        // let dataString = '';
        // dataString += 'group_name=' + 'BS';
        // dataString += 'year=' + '2023';
        // dataString += 'month=' + '10';
        // dataString += 'New_technology_awareness=' + '4562';


              //  update_ajax(dataString);

                // $(document).on('click', '.view_data', function() {
                $('.view_data').on('click', function() {
                    var year = $(this).data("year");
                    var group_name = $(this).data("groupname");
                    var MONTH = $(this).data("month");

                    var column = $(this).data("column");
                    var value = $(this).data("value");

                    var Performan =  $(this).data("Performan");
                    var New_techno = $(this).data("New_techno");   

                    if (column == 'Performance_enhancement') {
                      $('#Performance_enhancement_div').css("display", "block");
                      $('#New_technology_awareness_div').css("display", "none");
                      $('#Performance_enhancement_input').val(value);
                    }

                    if (column == 'New_technology_awareness') {
                      $('#Performance_enhancement_div').css("display", "none");
                      $('#New_technology_awareness_div').css("display", "block");
                      $('#New_technology_awareness_input').val(value);
                    }        

                    var Performan = $('.Performan').val();
                    var New_techno = $('.New_techno').val();

                    $('.groupname').val(group_name);
                    $('.month').val(MONTH);

                    $('#group_name_input').val(group_name);
                    $('#month_input').val(MONTH);
                    $('#year_input').val(year);
                });

                $('.submit').on('click', function(e) {
                    e.preventDefault();
                    $('.submit').prop('disabled', true);
                    let year = $('#year_input').val();
                    let group_name = $('#group_name_input').val();
                    let MONTH = $('#month_input').val();
                    let New_techno = $('#New_technology_awareness_input').val();
                    let Performan = $('#Performance_enhancement_input').val();
    // $('#ayayay').append('update_monthly.php');
                    // console.log(year)
      
                    var dataString = '';
                    dataString += (group_name !== undefined && group_name !== null && group_name !== '' ? 'group_name=' + group_name : '')
                    dataString += (year !== undefined && year !== null && year !== '' ? '&year=' + year : '')
                    dataString += (MONTH !== undefined && MONTH !== null && MONTH !== '' ? '&month=' + MONTH : '')
                    dataString += (New_techno !== undefined && New_techno !== null && New_techno !== '' ? '&New_technology_awareness=' + New_techno : '')
                    dataString += (Performan !== undefined && Performan !== null && Performan !== '' ? '&Performance_enhancement=' + Performan : '')

                    update_ajax(dataString)


                    $('.submit').prop('disabled', false);
                });
                return false;
            });
          </script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    var $j = jQuery.noConflict();
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="js/table2excel.js"></script>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Summary_kpi.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>

 
<footer class="text-center text-white" 
style="background: linear-gradient(to bottom, #45637d 0%, #006699 100%);">
  <div class="container">
      <div class="row d-flex justify-content-center">
       <div class="col item social">
       <img src="images/man-woman-businesspreview.png" style="width: 40%;"/>
       <i style="font-size: 50px;" class="fa fa-long-arrow-right"></i>
       <img src="images/Banner-imageremovebg-preview.png" style="width: 40%;"/>
</div>

      </div>
      WE Develop more ... to Achieve more
  </div>

  <div class="text-center p-3"style="background-color: rgba(0, 0, 0, 0.2);">
    © Copyrights 2021 Enterprice Workforce 

    <a class="text-white">Management</a><span style="color: rgba(0, 0, 0, 0.9);font-size: 10px; ">(Aya.abdelfattah)</span>
  </div>
</footer> 

