
<?php
//session_start();
set_time_limit(400);
include ("pages.php");
$this_year =date('Y');
?>
<head>
      <title>Summary Kpi`s</title>
      <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

<style type="text/css">
  .zoom:hover{
    transform: scale(1.5);
  }
</style>
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
      <th><center>utilization without resident_day</center></th>
      <th><center>Utilization_without_Resident_TAM_day</center></th>
      <th><center>TAM_Utilization_day</center></th>
      <th><center>Absenteeism</center></th>
      <th><center>MTTI2_Category</center></th>
      <th><center>MTTV</center> </th>
      <th><center>AHT</th>
      <th><center>MTTR</center></th>
      <th><center>MTTR_SD</center></th>
      <th><center>MTTI %</center></th>
      <th><center>MTTV %</center></th>
      <th><center>Correct Node Tickets</center> </th>  
      <th><center>Not Assigned Tickets</center> </th>
      <th><center>MTTR_SD_24hr</center> </th>
      <th><center>Global_tickets_linked_within 1 hour to parent_ticket</center> </th> 
      <th><center>SD_pool_not_exceed_90_min</center> </th> 
      <th><center>global_tickets_have_parent_ticket</center> </th> 
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
       
    if(($_SESSION['username'] == 'ahmed.mohamedbassal') || 
        ($_SESSION['username'] == 'Yasmeen.soltan') ){
       

   $new_query = sqlsrv_query( $con,"SELECT [Year]
      ,[MONTH]
      ,[group_name]
      ,[utilization without resident_day]
      ,[Utilization_without_Resident_TAM_day]
      ,[TAM_Utilization_day]
      ,[Absenteeism]
      ,[MTTI2_Category]
      ,[MTTV]
      ,[AHT]
      ,[MTTR]
      ,[MTTR_SD]
      ,[MTTI %]
      ,[MTTV %]
      ,[Correct Node Tickets]
      ,[Not Assigned Tickets]
      ,[MTTR_SD_24hr]
      ,[global_tickets_to_be_linked_to_PSC]
      ,[SD_pool_not_exceed_90_min]
      ,[global_tickets_have_PSD]
  FROM [WorkForce_Reporting_DB].[dbo].[KPIs_per_group]
    where  group_name  in ('GDS(Global Partner)','Private KAM')
    order by 1,len([MONTH]),2,3 ");
      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['group_name'].'</td>';
    //utilization without resident_day
     //Private KAM
        if(($echo['group_name'] == 'Private KAM') && 
            ($echo['group_name'] !== 'GDS(Global Partner)') &&
             ($echo['utilization without resident_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">
'.$echo['utilization without resident_day'].'</td>';
        }if(($echo['group_name'] == 'Private KAM') && ($echo['group_name'] !== 'GDS(Global Partner)')&& 
            ($echo['utilization without resident_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">
    '.$echo['utilization without resident_day'].'</td>';
        }
      //GDS(Global Partner)
        if(($echo['group_name'] == 'GDS(Global Partner)') && 
            ($echo['group_name'] != 'Private KAM')&&
             ($echo['utilization without resident_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">
'.$echo['utilization without resident_day'].'</td>';
        }if(($echo['group_name'] == 'GDS(Global Partner)') && 
            ($echo['group_name'] != 'Private KAM')&&
            ($echo['utilization without resident_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">
    '.$echo['utilization without resident_day'].'</td>';
        }
////////////Utilization_without_Resident_TAM_day
    
        //Private KAM
        if(($echo['group_name'] == 'Private KAM') && 
            ($echo['group_name'] !== 'GDS(Global Partner)') &&
             ($echo['Utilization_without_Resident_TAM_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">
'.$echo['Utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Private KAM') && ($echo['group_name'] !== 'GDS(Global Partner)')&& 
            ($echo['Utilization_without_Resident_TAM_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">
    '.$echo['Utilization_without_Resident_TAM_day'].'</td>';
        }
      //GDS(Global Partner)
        if(($echo['group_name'] == 'GDS(Global Partner)') && 
            ($echo['group_name'] != 'Private KAM')&&
             ($echo['Utilization_without_Resident_TAM_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">
'.$echo['Utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'GDS(Global Partner)') && 
            ($echo['group_name'] != 'Private KAM')&&
            ($echo['Utilization_without_Resident_TAM_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">
    '.$echo['Utilization_without_Resident_TAM_day'].'</td>';
        }
    //******************///TAM_Utilization_day
    if($echo['TAM_Utilization_day'] >= '65%'){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:lightgreen;">'.$echo['TAM_Utilization_day'].'</td>';//65
    }
    if($echo['TAM_Utilization_day'] < '65%'){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:#ff6666;">'.$echo['TAM_Utilization_day'].'</td>';//65
    }
    //null
    if($echo['TAM_Utilization_day'] == 'null' ){
        $rows .='<td class="hovers" style="border: 1px solid #eee;">'.$echo['Utilization_without_Resident_TAM_day'].'</td>';
    }
     //Absenteeism
   if($echo['Absenteeism'] <='5%'){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:lightgreen;">'.$echo['Absenteeism'].'</td>';
        }else{
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:#ff6666;">'.$echo['Absenteeism'].'</td>';   
        }
    // $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['utilization without resident_day'].'</td>';
    // $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Utilization_without_Resident_TAM_day'].'</td>';
    // $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['TAM_Utilization_day'].'</td>';

    // $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Absenteeism'].'</td>';
//MTTI2_Category
    if($echo["MTTI2_Category"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_Category']->format('H:i:s').'</td>';}
//MTTV
      if($echo["MTTV"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV']->format('H:i:s').'</td>';}
//AHT
      if($echo["AHT"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT']->format('H:i:s').'</td>';}
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_SD'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI %'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV %'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Correct Node Tickets'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Not Assigned Tickets'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_SD_24hr'].'</td>'; 
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['global_tickets_to_be_linked_to_PSC'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['SD_pool_not_exceed_90_min'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['global_tickets_have_PSD'].'</td>'; 
    
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

   $new_query = sqlsrv_query( $con,"SELECT [Year]
      ,[MONTH]
      ,[group_name]
      ,[utilization without resident_day]
      ,[Utilization_without_Resident_TAM_day]
      ,[TAM_Utilization_day]
      ,[Absenteeism]
      ,[MTTI2_Category]
      ,[MTTV]
      ,[AHT]
      ,[MTTR]
      ,[MTTR_SD]
      ,[MTTI %]
      ,[MTTV %]
      ,[Correct Node Tickets]
      ,[Not Assigned Tickets]
      ,[MTTR_SD_24hr]
      ,[global_tickets_to_be_linked_to_PSC]
      ,[SD_pool_not_exceed_90_min]
      ,[global_tickets_have_PSD]
  FROM [WorkForce_Reporting_DB].[dbo].[KPIs_per_group]

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
      ($echo['utilization without resident_day'] > 62) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization without resident_day'].'</td>';
        }if(($echo['group_name'] == 'GOV') && 
          ($echo['group_name'] != 'BS')&&
          ($echo['group_name'] != 'Banking')&&
          ($echo['group_name'] != 'Private KAM')&&
          ($echo['utilization without resident_day'] <= 62) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization without resident_day'].'</td>';
        }
        //Private KAM
        if(($echo['group_name'] == 'Private KAM') && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization without resident_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization without resident_day'].'</td>';
        }if(($echo['group_name'] == 'Private KAM')   && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization without resident_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization without resident_day'].'</td>';
        }
        //GDS(Global Partner)
      /*  if(($echo['group_name'] == 'GDS(Global Partner)') && 
            ($echo['group_name'] !== 'Private KAM') && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization without resident_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization without resident_day'].'</td>';
        }if(($echo['group_name'] == 'Private KAM') && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization without resident_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization without resident_day'].'</td>';
        }*/
        ///GDS(Global Partner)
        //Banking
        if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization without resident_day'] >= 58 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization without resident_day'].'</td>';
        }if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization without resident_day'] < 58 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization without resident_day'].'</td>';
        }
        //BS
      if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization without resident_day'] >= 78 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">'.$echo['utilization without resident_day'].'</td>';
      }if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization without resident_day'] < 78 ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">'.$echo['utilization without resident_day'].'</td>';
        }
   /*else if(($echo['group_name'] !== 'BS')&& ($echo['group_name'] !== 'GOV')&& ($echo['group_name'] !== 'Banking')&& ($echo['group_name'] !== 'Private KAM') && ($echo['group_name'] !== 'Mega Projects') ){
        $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['utilization without resident_day'].'</td>';
    }*/
   if(($echo['group_name'] == 'GDS(Global Partner)') ||
            ($echo['group_name'] == 'Mega Projects') ||
            ($echo['group_name'] == 'Local Loop') || ($echo['group_name'] =='Local Loop  ') ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; ">
    '.$echo['utilization without resident_day'].'</td>';
        }
    //******* Utilization_without_Resident_TAM_day
    /*$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Utilization_without_Resident_TAM_day'].'</td>';*/
    //GOV & Public
    
    //******* Utilization_without_Resident_TAM_day
    /*$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Utilization_without_Resident_TAM_day'].'</td>';*/

    if(($echo['group_name'] == 'GOV') && 
    ($echo['group_name'] != 'BS')&&
    ($echo['group_name'] != 'Banking')&&
    ($echo['group_name'] != 'Private KAM')&&($echo['group_name'] !== 'GDS(Global Partner)') &&
            ($echo['group_name'] !== 'Mega Projects') &&
            ($echo['group_name'] !== 'Local Loop')&& ($echo['group_name'] !='Local Loop  ')&&
    ($echo['Utilization_without_Resident_TAM_day'] > 62) ){
  $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">
  '.$echo['Utilization_without_Resident_TAM_day'].'</td>';
      }if(($echo['group_name'] == 'GOV') && 
        ($echo['group_name'] != 'BS')&&
        ($echo['group_name'] != 'Banking')&&
        ($echo['group_name'] != 'Private KAM')&&($echo['group_name'] !== 'GDS(Global Partner)') &&
            ($echo['group_name'] !== 'Mega Projects') &&
            ($echo['group_name'] !== 'Local Loop')&& ($echo['group_name'] !='Local Loop  ')&&
        ($echo['Utilization_without_Resident_TAM_day'] <= 62) ){
  $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">
  '.$echo['Utilization_without_Resident_TAM_day'].'</td>';
      }
      //Private KAM
      if(($echo['group_name'] == 'Private KAM') && ($echo['group_name'] !== 'GDS(Global Partner)') &&
            ($echo['group_name'] !== 'Mega Projects') &&
            ($echo['group_name'] !== 'Local Loop')&& ($echo['group_name'] !='Local Loop  ')&&
          ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking')
           && ($echo['Utilization_without_Resident_TAM_day'] >= 57) ){
  $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">
  '.$echo['Utilization_without_Resident_TAM_day'].'</td>';
      }if(($echo['group_name'] == 'Private KAM') && ($echo['group_name'] !== 'GDS(Global Partner)') &&
            ($echo['group_name'] !== 'Mega Projects') &&
            ($echo['group_name'] !== 'Local Loop')&& ($echo['group_name'] !='Local Loop  ')&&
          ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && 
          ($echo['Utilization_without_Resident_TAM_day'] < 57) ){
  $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">
  '.$echo['Utilization_without_Resident_TAM_day'].'</td>';
      }
      
      //Banking
      if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] !== 'GDS(Global Partner)') &&
            ($echo['group_name'] !== 'Mega Projects') &&
            ($echo['group_name'] !== 'Local Loop')&& ($echo['group_name'] !='Local Loop  ')&&
      ($echo['group_name'] != 'Private KAM') && $echo['Utilization_without_Resident_TAM_day'] >= 58 ){
  $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">
  '.$echo['Utilization_without_Resident_TAM_day'].'</td>';
      }if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] !== 'GDS(Global Partner)') &&
            ($echo['group_name'] !== 'Mega Projects') &&
            ($echo['group_name'] !== 'Local Loop')&& ($echo['group_name'] !='Local Loop  ')&&
      ($echo['group_name'] != 'Private KAM') && $echo['Utilization_without_Resident_TAM_day'] < 58 ){
  $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">
  '.$echo['Utilization_without_Resident_TAM_day'].'</td>';
      }
      //BS
    if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'GDS(Global Partner)') &&
            ($echo['group_name'] != 'Mega Projects') &&
            ($echo['group_name'] != 'Local Loop')&& ($echo['group_name'] !='Local Loop  ')&&
    ($echo['group_name'] != 'Private KAM') && $echo['Utilization_without_Resident_TAM_day'] >= 78 ){
  $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:lightgreen;">
  '.$echo['Utilization_without_Resident_TAM_day'].'</td>';
    }if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'GDS(Global Partner)')&& ($echo['group_name'] !='Local Loop  ') &&
            ($echo['group_name'] != 'Mega Projects') &&
            ($echo['group_name'] != 'Local Loop')&& ($echo['group_name'] !='Local Loop  ')&&
    ($echo['group_name'] != 'Private KAM')&& ($echo['group_name'] !='Local Loop  ') && $echo['Utilization_without_Resident_TAM_day'] < 78 ){
  $rows .='<td class="hovers" style="border: 1px solid lightgray; background-color:#ff6666;">
  '.$echo['Utilization_without_Resident_TAM_day'].'</td>';
      }
 /*else if(($echo['group_name'] !== 'BS')&& ($echo['group_name'] !== 'GOV')&& ($echo['group_name'] !== 'Banking')&& ($echo['group_name'] !== 'Private KAM') && ($echo['group_name'] !== 'Mega Projects') ){
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['utilization without resident_day'].'</td>';
  }*/
 
  if(($echo['group_name'] == 'GDS(Global Partner)') ||
            ($echo['group_name'] == 'Mega Projects') ||
            ($echo['group_name'] == 'Local Loop') || ($echo['group_name'] =='Local Loop  ') ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray; ">
    '.$echo['Utilization_without_Resident_TAM_day'].'</td>';
        }

   /*  if($echo['group_name'] == 'Mega Projects'){
        $rows .='<td class="hovers" style="border: 1px solid #eee;">
        '.$echo['Utilization_without_Resident_TAM_day'].'</td>';
    }*/
    //  else{
    //     $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightblue">'.$echo['Utilization_without_Resident_TAM_day'].'</td>';
    // }
    //******************///TAM_Utilization_day
    if(($echo['TAM_Utilization_day'] >= '65%') && ($echo['TAM_Utilization_day'] != NULL) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgreen;">'.$echo['TAM_Utilization_day'].'</td>';//65
    }
    if(($echo['TAM_Utilization_day'] < '65%') && ($echo['TAM_Utilization_day'] != NULL) ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:#ff6666;">'.$echo['TAM_Utilization_day'].'</td>';//65
    }
    if($echo['TAM_Utilization_day'] == NULL){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['TAM_Utilization_day'].'</td>';//65
    }
   
   if($echo['Absenteeism'] <='5%'){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:lightgreen;">'.$echo['Absenteeism'].'</td>';
        }else{
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:#ff6666;">'.$echo['Absenteeism'].'</td>';   
        }
//MTTI2_Category
    if($echo["MTTI2_Category"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_Category']->format('H:i:s').'</td>';}
//MTTV
      if($echo["MTTV"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV']->format('H:i:s').'</td>';}
//AHT
      if($echo["AHT"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT']->format('H:i:s').'</td>';}
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_SD'].'</td>';
     $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI %'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV %'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Correct Node Tickets'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Not Assigned Tickets'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_SD_24hr'].'</td>'; 
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['global_tickets_to_be_linked_to_PSC'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['SD_pool_not_exceed_90_min'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['global_tickets_have_PSD'].'</td>'; 
    
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

    $new_query = sqlsrv_query( $con , "SELECT [Year]
      ,[MONTH]
      ,[group_name]
      ,[utilization without resident_day]
      ,[Utilization_without_Resident_TAM_day]
      ,[TAM_Utilization_day]
      ,[Absenteeism]
      ,[MTTI2_Category]
      ,[MTTV]
      ,[AHT]
      ,[MTTR]
      ,[MTTR_SD]
      ,[MTTI %]
      ,[MTTV %]
      ,[Correct Node Tickets]
      ,[Not Assigned Tickets]
      ,[MTTR_SD_24hr]
      ,[global_tickets_to_be_linked_to_PSC]
      ,[SD_pool_not_exceed_90_min]
      ,[global_tickets_have_PSD]
  FROM [WorkForce_Reporting_DB].[dbo].[KPIs_per_group]
where  group_name ='$my_group'
order by 1,len([MONTH]),2,3 ");
      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['group_name'].'</td>';
    // $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['utilization without resident_day'].'</td>';
    // $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Utilization_without_Resident_TAM_day'].'</td>';
    // $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['TAM_Utilization_day'].'</td>';
//utilization without resident_day
    //GOV & Public
    if(($echo['group_name'] == 'GOV') && 
      ($echo['group_name'] != 'BS')&&
      ($echo['group_name'] != 'Banking')&&
      ($echo['group_name'] != 'Private KAM')&&
      ($echo['utilization without resident_day'] > 62) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$echo['utilization without resident_day'].'</td>';
        }if(($echo['group_name'] == 'GOV') && 
          ($echo['group_name'] != 'BS')&&
          ($echo['group_name'] != 'Banking')&&
          ($echo['group_name'] != 'Private KAM')&&
          ($echo['utilization without resident_day'] <= 62) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$echo['utilization without resident_day'].'</td>';
        }
        //Private KAM
        if(($echo['group_name'] == 'Private KAM') && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization without resident_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$echo['utilization without resident_day'].'</td>';
        }if(($echo['group_name'] == 'Private KAM') && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && ($echo['utilization without resident_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$echo['utilization without resident_day'].'</td>';
        }
        //Banking
        if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization without resident_day'] >= 58 ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$echo['utilization without resident_day'].'</td>';
        }if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization without resident_day'] < 58 ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$echo['utilization without resident_day'].'</td>';
        }
        //BS
      if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization without resident_day'] >= 78 ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$echo['utilization without resident_day'].'</td>';
      }if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['utilization without resident_day'] < 78 ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$echo['utilization without resident_day'].'</td>';
        }
 else if(($echo['group_name'] !== 'BS')&& ($echo['group_name'] !== 'GOV')&& ($echo['group_name'] !== 'Banking')&& ($echo['group_name'] !== 'Private KAM') ){
        $rows .='<td class="hovers" style="border: 1px solid #eee;">'.$echo['utilization without resident_day'].'</td>';
    }
    //******* Utilization_without_Resident_TAM_day
    /*$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Utilization_without_Resident_TAM_day'].'</td>';*/
    //GOV & Public
    if(($echo['group_name'] == 'GOV') && 
      ($echo['group_name'] != 'BS')&&
      ($echo['group_name'] != 'Banking')&&
      ($echo['group_name'] != 'Private KAM')&&
      ($echo['Utilization_without_Resident_TAM_day'] > 62) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$echo['utilization without resident_day'].'</td>';
        }if(($echo['group_name'] == 'GOV') && 
          ($echo['group_name'] != 'BS')&&
          ($echo['group_name'] != 'Banking')&&
          ($echo['group_name'] != 'Private KAM')&&
          ($echo['Utilization_without_Resident_TAM_day'] <= 62) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$echo['utilization without resident_day'].'</td>';
        }
        //Private KAM
        if(($echo['group_name'] == 'Private KAM') && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') &&
             ($echo['Utilization_without_Resident_TAM_day'] >= 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">
'.$echo['Utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Private KAM') && 
            ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Banking') && 
            ($echo['Utilization_without_Resident_TAM_day'] < 57) ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">
    '.$echo['Utilization_without_Resident_TAM_day'].'</td>';
        }
        //Banking
        if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['Utilization_without_Resident_TAM_day'] >= 58 ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$echo['Utilization_without_Resident_TAM_day'].'</td>';
        }if(($echo['group_name'] == 'Banking')&& ($echo['group_name'] != 'GOV') && ($echo['group_name'] != 'BS')&& ($echo['group_name'] != 'Private KAM') && $echo['Utilization_without_Resident_TAM_day'] < 58 ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$echo['Utilization_without_Resident_TAM_day'].'</td>';
        }
        //BS
      if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['Utilization_without_Resident_TAM_day'] >= 78 ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$echo['Utilization_without_Resident_TAM_day'].'</td>';
      }if(($echo['group_name'] == 'BS')&& ($echo['group_name'] != 'GOV')&& ($echo['group_name'] != 'Banking')&& ($echo['group_name'] != 'Private KAM') && $echo['Utilization_without_Resident_TAM_day'] < 78 ){
    $rows .='<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$echo['Utilization_without_Resident_TAM_day'].'</td>';
        }
  if($echo['Utilization_without_Resident_TAM_day'] == 'null' ){
        $rows .='<td class="hovers" style="border: 1px solid #eee;">'.$echo['Utilization_without_Resident_TAM_day'].'</td>';
    }
    //******************///TAM_Utilization_day
    if($echo['TAM_Utilization_day'] >= '65%'){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:lightgreen;">'.$echo['TAM_Utilization_day'].'</td>';//65
    }
    if($echo['TAM_Utilization_day'] < '65%'){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:#ff6666;">'.$echo['TAM_Utilization_day'].'</td>';//65
    }

   if($echo['Absenteeism'] <='5%'){
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:lightgreen;">'.$echo['Absenteeism'].'</td>';
        }else{
    $rows .='<td class="hovers" style="border: 1px solid #eee;background-color:#ff6666;">'.$echo['Absenteeism'].'</td>';   
        }
//MTTI2_Category
    if($echo["MTTI2_Category"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_Category']->format('H:i:s').'</td>';}
//MTTV
      if($echo["MTTV"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV']->format('H:i:s').'</td>';}
//AHT
      if($echo["AHT"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT']->format('H:i:s').'</td>';}
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_SD'].'</td>';

     $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI %'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV %'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Correct Node Tickets'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Not Assigned Tickets'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_SD_24hr'].'</td>'; 
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['global_tickets_to_be_linked_to_PSC'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['SD_pool_not_exceed_90_min'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['global_tickets_have_PSD'].'</td>'; 
        $rows .= '</tr>';
        echo $rows;
}
}
}
?>
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
<th><center>Day utilization</center></th>
<th><center>Absenteeism</center></th>
<th><center>MTTI2_Category</center></th>
<th><center>MTTV</center> </th>
<th><center>AHT</th>
<th><center>MTTR</center></th>
<th><center>MTTR_SD</center></th>
<th><center>MTTI %</center></th>
<th><center>MTTV %</center></th>
<th><center>Correct Node Tickets</center> </th>  
<th><center>Not Assigned Tickets</center> </th> 
<th><center>MTTR_SD_24hr</center> </th>
<th><center>Global_tickets_linked_within 1 hour to parent_ticket</center> </th> 
<th><center>SD_pool_not_exceed_90_min</center> </th> 
<th><center>global_tickets_have_parent_ticket</center> </th>  
   
    </tr>
    </thead>
  
  <tbody>

<?php 

if(($_SESSION['username'] == 'ahmed.mohamedbassal') ||
    ($_SESSION['username'] == 'Yasmeen.soltan') ){

   $new_query = sqlsrv_query( $con , "SELECT  [Year]
      ,[MONTH]
      ,[Ticket_group]
      ,[subgroup]
      ,[utilization without resident_day]
      ,[Absenteeism]
      ,[MTTI2_Category]
      ,[MTTV]
      ,[AHT]
      ,[MTTR]
      ,[MTTR_SD]
      ,[MTTI %]
      ,[MTTV %]
      ,[Correct Node Tickets]
      ,[Not Assigned Tickets]
      ,[MTTR_SD_24hr]
      ,[global_tickets_to_be_linked_to_PSC]
      ,[SD_pool_not_exceed_90_min]
      ,[global_tickets_have_PSD]
  FROM [WorkForce_Reporting_DB].[dbo].[KPIs_per_subgroup]
  where (ticket_group like 'private KAM%' or ticket_group like 'GDS%')
  --Ticket_group in ('GDS(Global Partner)','Private KAM')
  and [Year] >='$this_year'
order by 1,len([MONTH]),2,3  ");

      while($echo = sqlsrv_fetch_array($new_query) ){

     $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['subgroup'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['utilization without resident_day'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Absenteeism'].'</td>';
//MTTI2_Category
    if($echo["MTTI2_Category"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_Category']->format('H:i:s').'</td>';}
//MTTV
      if($echo["MTTV"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV']->format('H:i:s').'</td>';}
//AHT
      if($echo["AHT"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT']->format('H:i:s').'</td>';}
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_SD'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI %'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV %'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Correct Node Tickets'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Not Assigned Tickets'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_SD_24hr'].'</td>'; 
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['global_tickets_to_be_linked_to_PSC'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['SD_pool_not_exceed_90_min'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['global_tickets_have_PSD'].'</td>';     
        $rows .= '</tr>';
        echo $rows;
}

}

if(($_SESSION['username'] == 'ahmed.akef') || ($_SESSION['role_id'] == 1) ){

   $new_query = sqlsrv_query( $con , "SELECT  [Year]
      ,[MONTH]
      ,[Ticket_group]
      ,[subgroup]
      ,[utilization without resident_day]
      ,[Absenteeism]
      ,[MTTI2_Category]
      ,[MTTV]
      ,[AHT]
      ,[MTTR]
      ,[MTTR_SD]
      ,[MTTI %]
      ,[MTTV %]
      ,[Correct Node Tickets]
      ,[Not Assigned Tickets]
      ,[MTTR_SD_24hr]
      ,[global_tickets_to_be_linked_to_PSC]
      ,[SD_pool_not_exceed_90_min]
      ,[global_tickets_have_PSD]
  FROM [WorkForce_Reporting_DB].[dbo].[KPIs_per_subgroup]
  where [Year] >='$this_year'
order by 1,len([MONTH]),2,3  ");

      while($echo = sqlsrv_fetch_array($new_query) ){

     $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['subgroup'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['utilization without resident_day'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Absenteeism'].'</td>';
//MTTI2_Category
    if($echo["MTTI2_Category"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_Category']->format('H:i:s').'</td>';}
//MTTV
      if($echo["MTTV"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV']->format('H:i:s').'</td>';}
//AHT
      if($echo["AHT"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT']->format('H:i:s').'</td>';} 
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_SD'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI %'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV %'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Correct Node Tickets'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Not Assigned Tickets'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_SD_24hr'].'</td>'; 
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['global_tickets_to_be_linked_to_PSC'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['SD_pool_not_exceed_90_min'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['global_tickets_have_PSD'].'</td>';   
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
      ,[Ticket_group]
      ,[subgroup]
      ,[utilization without resident_day]
      ,[Absenteeism]
      ,[MTTI2_Category]
      ,[MTTV]
      ,[AHT]
      ,[MTTR]
      ,[MTTR_SD]
      ,[MTTI %]
      ,[MTTV %]
      ,[Correct Node Tickets]
      ,[Not Assigned Tickets]
      ,[MTTR_SD_24hr]
      ,[global_tickets_to_be_linked_to_PSC]
      ,[SD_pool_not_exceed_90_min]
      ,[global_tickets_have_PSD]
  FROM [WorkForce_Reporting_DB].[dbo].[KPIs_per_subgroup]
  where [Ticket_group] = '$my_group'
  and [Year] >='$this_year'
order by 1,len([MONTH]),2,3  ");

      while($echo = sqlsrv_fetch_array($new_query) ){

     $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Year'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MONTH'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Ticket_group'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['subgroup'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['utilization without resident_day'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Absenteeism'].'</td>';
//MTTI2_Category
    if($echo["MTTI2_Category"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI2_Category']->format('H:i:s').'</td>';}
//MTTV
      if($echo["MTTV"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV']->format('H:i:s').'</td>';}
//AHT
      if($echo["AHT"] == NULL ){
    $rows .='<td class="hovers" style="border: 1px solid lightgray;background-color:lightgray ; font-size:13px ;color:black;">Blank</td>';
  }else{
      $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['AHT']->format('H:i:s').'</td>';}
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_SD'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTI %'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTV %'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Correct Node Tickets'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Not Assigned Tickets'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['MTTR_SD_24hr'].'</td>'; 
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['global_tickets_to_be_linked_to_PSC'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['SD_pool_not_exceed_90_min'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['global_tickets_have_PSD'].'</td>'; 
    
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
<script src="js/table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Summary_kpi.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>

