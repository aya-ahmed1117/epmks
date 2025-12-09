
<?php
//session_start();
set_time_limit(400);
include ("pages.php");
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
   $this_year = date('Y');

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
    if(($_SESSION['role_id'] == 5)  ||($_SESSION['role_id'] == 1) ) {
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
      <th ><center>TAM_utilization</center></th>
      <th ><center>Absen</center> </th>
      <th ><center>Aht Logical</center></th>
      <th ><center>Aht Other</center></th>
      <th ><center>Mtti1</center></th>
      <th ><center>Mtti2</center></th>
      <th ><center>Mttv %</center></th>
      <th ><center>MTTR_Log %</center></th>
      <th ><center>Wrong_Node</center> </th>  
      <th ><center>Not_Assigned</center> </th>  
      <th><center>Global_having_PSD</center></th>
      <th><center>Perf_Enh</center></th>
      <th><center>New_Tech_Awa</center></th>
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
if(
        ($_SESSION['username'] == 'ahmed.akef') || 
        ($_SESSION['username'] =='Ahmed.AbdelFattah' )||
        ($_SESSION['role_id'] == 1)
    ){

   $new_query = sqlsrv_query( $WorkForce , "WITH perc as (SELECT [Year]
      ,[MONTH]
      ,k.[group_name]
     -- ,k.[utilization_without_Resident_TAM_day]
    ,iif(cast ( SUBSTRING(k.[utilization_without_Resident_TAM_day],1,LEN(k.[utilization_without_Resident_TAM_day])-1)  as decimal (6,3))>=t.[utilization_without_Resident_TAM_day]*100.0,'100',cast ( SUBSTRING(k.[utilization_without_Resident_TAM_day],1,LEN(k.[utilization_without_Resident_TAM_day])-1)  as decimal (6,3))/T.[utilization_without_Resident_TAM_day])[utilization_without_Resident_TAM_day_perc]
     -- ,k.[TAM_utilization_day]
    ,iif(cast (SUBSTRING(k.[TAM_utilization_day],1,LEN(k.[TAM_utilization_day])-1)  as decimal (6,3))>=t.[TAM_utilization_day]*100.0,'100',cast ( SUBSTRING(k.[TAM_utilization_day],1,LEN(k.[TAM_utilization_day])-1)  as decimal (6,3))/T.[TAM_utilization_day])[TAM_utilization_day_per]
      --,k.[Absenteeism]
   ,iif(cast ( SUBSTRING(k.[Absenteeism],1,LEN(k.[Absenteeism])-1)  as decimal (6,3))<=t.[Absenteeism]*100.0,'100',iif(cast ( SUBSTRING(k.[Absenteeism],1,LEN(k.[Absenteeism])-1)  as decimal (6,3))>=10.00,0,(100-(cast ( SUBSTRING(k.[Absenteeism],1,LEN(k.[Absenteeism])-1)  as decimal (6,3))-t.[Absenteeism]*100.0)/t.Absenteeism)))[Abs_per]
      --,[AHT%]
       ,iif(cast (SUBSTRING(k.[AHT_Logical%],1,LEN(k.[AHT_Logical%])-1)  as decimal (6,3))>=95.00,100.00,cast (SUBSTRING(k.[AHT_Logical%],1,LEN(k.[AHT_Logical%])-1)  as decimal (6,3))/T.[AHT_logical %])[AHT_Logical_perc]
    ,iif(cast (SUBSTRING(k.[AHT_Other%],1,LEN(k.[AHT_Other%])-1)  as decimal (6,3))>=95.00,100.00,cast (SUBSTRING(k.[AHT_Other%],1,LEN(k.[AHT_Other%])-1)  as decimal (6,3))/T.[AHT_other %])[AHT_Other_perc]
       --,[MTTI1%]
    ,iif(cast (SUBSTRING(k.[MTTI1%],1,LEN(k.[MTTI1%])-1)  as decimal (6,3))>=95.00,100.00,cast (SUBSTRING(k.[MTTI1%],1,LEN(k.[MTTI1%])-1)  as decimal (6,3))/T.[MTTI1 %]) [MTT1_perc]
      --,[MTTI2%]
    ,iif(cast (SUBSTRING(k.[MTTI2%],1,LEN(k.[MTTI2%])-1)  as decimal (6,3))>=95.00,100.00,cast (SUBSTRING(k.[MTTI2%],1,LEN(k.[MTTI2%])-1)  as decimal (6,3))/T.[MTTI2 %]) [MTT2_perc]
      --,[MTTV%]
    ,iif(cast (SUBSTRING(k.[MTTV%],1,LEN(k.[MTTV%])-1)  as decimal (6,3))>=95.00,100.00,cast (SUBSTRING(k.[MTTV%],1,LEN(k.[MTTV%])-1)  as decimal (6,3))/T.[MTTV %]) [MTTV_perc]
      --,[MTTR_Logical%]
    ,iif(cast (SUBSTRING(k.[MTTR_Logical%],1,LEN(k.[MTTR_Logical%])-1)  as decimal (6,2))>=95.0,100.00,cast (SUBSTRING(k.[MTTR_Logical%],1,LEN(k.[MTTR_Logical%])-1)  as decimal (6,3))/T.[MTTR Logical %])[MTTR_Logical_perc]
      --,[Wrong_node%]
    ,iif(k.[Wrong_node%] is null, 100.00,100-cast (SUBSTRING(k.[Wrong_node%],1,LEN(k.[Wrong_node%])-1)  as decimal (6,3)))[Wrong_node_per]
      --,[Not_Assigned%]
    ,100-cast (SUBSTRING(k.[Not_Assigned%],1,LEN(k.[Not_Assigned%])-1)  as decimal (6,3)) [Not_Assigned_perc]
    ,cast (SUBSTRING(k.[global_tickets_have_PSD],1,LEN(k.[global_tickets_have_PSD])-1)  as decimal (6,3)) [global_tickets_have_PSD_per]
    ,cast (SUBSTRING(k.[Performance_enhancement],1,LEN(k.[Performance_enhancement])-1)  as decimal (6,3)) [Performance_enhancement]
      --,k.[Performance_enhancement]
      ,cast (SUBSTRING(k.[New_technology_awareness],1,LEN(k.[New_technology_awareness])-1)  as decimal (6,3)) [New_technology_awareness]
    --  ,k.[New_technology_awareness]
  FROM [WorkForce_Reporting_DB].[dbo].[Kpi_2023_new] k
  left join [dbo].[KPI_target] t on k.group_name=t.Group_Name) ,

Performance as(
  select 
    [Year]
    ,[MONTH]
    ,perc.[group_name]
    ,[utilization_without_Resident_TAM_day_perc]*[utilization_without_Resident_TAM_day] [Shared_utilization]
    ,[TAM_utilization_day_per]*[TAM_utilization_day] [TAM_utilization]
    ,[Abs_per]*[Absenteeism] [Absen]
    ,[AHT_Logical_perc]*[AHT_logical %][Aht_Logical]
    ,[AHT_Other_perc]*[AHT_other %][Aht_Other]
    ,[MTT1_perc]*[MTTI1 %] [Mtti1]
    ,[MTT2_perc]*[MTTI2 %] [Mtti2]
    ,[MTTV_perc]*[MTTV %] [Mttv]
    ,[MTTR_Logical_perc]*[MTTR Logical %] [MTTR_Log]
    ,[Wrong_node_per]*[Wrong_node %] [Wrong_Node]
    ,[Not_Assigned_perc]*[Not Assigned %] [Not_Assigned]
    ,[global_tickets_have_PSD_per]*[global_tickets_have_PSD] [Global_having_PSD]
        ,perc.[Performance_enhancement] [Perf_Enh]
    ,perc.[New_technology_awareness] [New_Tech_Awa]
    from perc left join [dbo].[KPI_Percent] P on perc.group_name=p.Group_Name)

    select *,(COALESCE([Shared_utilization],0)+COALESCE([TAM_utilization],0)+COALESCE([Absen],0)+COALESCE([Aht_Logical],0)+COALESCE([Aht_Other],0)+COALESCE([Mtti1],0)+COALESCE([Mtti2],0)+COALESCE([Mttv],0)+COALESCE([MTTR_Log],0)+COALESCE([Wrong_Node],0)+COALESCE([Not_Assigned],0)+COALESCE([Global_having_PSD],0)+COALESCE([Perf_Enh],0)+COALESCE([New_Tech_Awa],0)) [Total]
    from performance

   order by month,total desc ");
  
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
        '.round($echo['Aht_Logical'],2).'%'.'</td>';
         $rows .='<td class="hovers" style="border: 1px solid lightgray; ">
        '.round($echo['Aht_Other'],1).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['Mtti1'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['Mtti2'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['Mttv'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['MTTR_Log'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['Wrong_Node'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['Not_Assigned'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['Global_having_PSD'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['Perf_Enh'],2).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['New_Tech_Awa'],1).'%'.'</td>';
        $rows .='<td class="hovers" style="border: 1px solid lightgray; ">'.round($echo['Total'],1).'%'.'</td>';

    
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
                filename: "Monthy_report.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>


