

<?php
require_once("inc/config.inc");
$self = $_SESSION['id'];
   $utiliz_query = sqlsrv_query( $con ,"SELECT  
      round (cast(Sum((DATEPART(hour, work_duration) * 3600) + (DATEPART(minute, work_duration) * 60) + DATEPART(second, work_duration)) as float) 
     / cast( Sum((DATEPART(hour, scheduled_duration) * 3600) + (DATEPART(minute, scheduled_duration) * 60) + DATEPART(second, scheduled_duration)) as float) * 100 , 0) 
      [utilization]
  FROM [Aya_Web_APP].[dbo].[utilization_table]
  where [utilization_table].username in ( select username from employee_web_table where manager = '$self') ");
      $getDATA = (sqlsrv_fetch_array($utiliz_query));
     $utiliz = $getDATA['utilization'];
 
////////////////Absenteeism

  $Absen_query = sqlsrv_query($con,"exec Absenteeism_Dashboard_manager 
    @id = '$self'");
   $getAbsen = (sqlsrv_fetch_array($Absen_query));
    $Absenteeism = $getAbsen['Absenteeism'];
       /////////////////
      $Aht_query = sqlsrv_query( $con ,"SELECT isnull ((
SELECT
cast(CAST(avg(CAST(([out_]-[In_])AS FLOAT)) AS datetime) as time) AHT
FROM [Aya_Web_APP].[dbo].[AHT_per_Ticket] a
LEFT JOIN [WorkforceDB_indexed].[dbo].[KPI_Status_RawData] KPI ON A.[RequestID]=KPI.RequestID
where Category in ('Global','Logical','Physical','Request')
and year([schedule_date]) = year(getdate())
and [Fake_Real] = 'Real Ticket'
and KPI.[RequestID] not in (SELECt [RequestID]
FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where [closure_reason] in ('Duplicated tickets')) 
and username in
( select username from employee_web_table where manager ='$self')  and (psd_number is null or Onsite_status='no')
group by
year([schedule_date])
,iif((psd_number is null or Onsite_status='no'),'No PSD','PSD')
),'00:00:00') AHT");
       $output_getAht = (sqlsrv_fetch_array($Aht_query));
        $get_Aht = $output_getAht['AHT']->format('H:i:s');

/////////////////
      $Aht_query = sqlsrv_query( $con ,"SELECT isnull ((SELECT
cast(CAST(avg(CAST(([out_]-[In_])AS FLOAT)) AS datetime) as time) AHT

FROM [Aya_Web_APP].[dbo].[AHT_per_Ticket] a

LEFT JOIN [WorkforceDB_indexed].[dbo].[KPI_Status_RawData] KPI ON A.[RequestID]=KPI.RequestID

where Category in ('Global','Logical','Physical','Request')
and year([schedule_date]) = year(getdate())

and [Fake_Real] = 'Real Ticket'

and KPI.[RequestID] not in (SELECt [RequestID]

FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]

where [closure_reason] in ('Duplicated tickets')) and username in
( select username from employee_web_table where manager ='$self')   and (psd_number is not null or Onsite_status='yes')

group by
year([schedule_date])

,iif((psd_number is not null or Onsite_status='yes'),'No PSD','PSD')),'00:00:00') [AHTT]");
       $output_getAht2 = (sqlsrv_fetch_array($Aht_query));
       $get_Aht2 = $output_getAht2['AHTT']->format('H:i:s');

  
      ////////////////////

      $MTTI_query = sqlsrv_query( $con ,"SELECT isnull ((SELECT 
   cast(CAST(avg(CAST(([First_category]- [creation_time])AS FLOAT)) AS datetime) as time) [MTTI]
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  left join employee_web_table on username = MTTI2_eng
  where  employee_web_table.manager ='$self'
  and year(creation_time) = year(getdate()) and Fake_Real = 'Real Ticket' 
  and ( closure_reason <> 'Duplicated tickets' or closure_reason is null) 
  and  IIF(Resolve_time is null,Final_close,Resolve_time) is not null and ( Ticket_group not in ('unmanaged','ESLM','ESOC','Onsite') or Ticket_group is null )
  and RequestID not in (SELECT distinct [RequestID]

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where request_mode ='Internal Reference')),'00:00:00') [MTTI]");
            $get_MTTI= (sqlsrv_fetch_array($MTTI_query));
            $MTTI = $get_MTTI['MTTI']->format('H:i:s');

            /////////////
      $MTTR_query = sqlsrv_query( $con ,"SELECT isnull ((SELECT 
   
   cast(CAST(avg(CAST(( IIF([Max_Out_Onsite] is null,Final_close,[Max_Out_Onsite])- [creation_time])AS FLOAT)) AS datetime) as time) [MTTR]

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
   left join employee_web_table on username = Last_engineer
  where employee_web_table.manager ='$self' and year(creation_time) = year(getdate()) and Fake_Real = 'Real Ticket' and ( closure_reason <> 'Duplicated tickets' or closure_reason is null) and 
  IIF([Max_Out_Onsite] is null,Final_close,[Max_Out_Onsite]) is not null and ( Ticket_group not in ('unmanaged','ESLM','ESOC','Onsite') or Ticket_group is null ) and RequestID not in (SELECT distinct [RequestID]

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where request_mode ='Internal Reference') ),'00:00:00') [MTTR] ");
       $output_mttr = (sqlsrv_fetch_array($MTTR_query));
       $get_MTTR = $output_mttr['MTTR']->format('H:i:s');

 //////////////////// MTTI2 % 7 g3

       $MTTI2_query= sqlsrv_query( $con ,"with MTTI2_count as ( select * from (SELECT 
year(creation_time) [year]
,MTTI2_eng
,[RequestID]
,iif(datediff(Minute,creation_time ,[First_category] )>=45,'exceed','Not exceed') SLA
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  left join employee_web_table a on a.username = MTTI2_eng
  where manager = '$self' and year(creation_time) = year(getdate()) and Fake_Real = 'Real Ticket' and ( closure_reason <> 'Duplicated tickets' or closure_reason is null) and 
  IIF(Resolve_time is null,Final_close,Resolve_time) is not null and ( Ticket_group  not in ('unmanaged','ESLM','ESOC','Onsite') or Ticket_group is null ) and RequestID not in (SELECT distinct [RequestID]

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where request_mode ='Internal Reference')
) t

PIVOT(
    COUNT([RequestID]) 
    FOR SLA IN (
        [Not exceed], 
        [exceed])
) AS pivot_table)

select isnull((

select 
round(cast(cast(sum(MTTI2_count.[Not exceed]) as float)/cast((sum(MTTI2_count.[exceed])+Sum(MTTI2_count.[Not exceed])) as float) as float),2)*100  [MTTI] 
from MTTI2_count
),0) [MTTI]");
       $output_mtti2 = (sqlsrv_fetch_array($MTTI2_query));
       $get_MTTI2 = $output_mtti2['MTTI'];

 ////////////// MTTR2 %

     $MTTR2_query= sqlsrv_query( $con,"with ticket_SLA as (select * from (SELECT 
year(creation_time) [year]
,Last_engineer
,[RequestID]
,iif(datediff(hour,creation_time ,IIF([Max_Out_Onsite] is null,Final_close,[Max_Out_Onsite]) )>24,'exceed','Not exceed') SLA
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  left join employee_web_table on username = Last_engineer
  where manager = '$self' and year(creation_time) = year(getdate()) and Fake_Real = 'Real Ticket' and ( closure_reason <> 'Duplicated tickets' or closure_reason is null) and 
  IIF([Max_Out_Onsite] is null,Final_close,[Max_Out_Onsite]) is not null and ( Ticket_group  not in ('unmanaged','ESLM','ESOC','Onsite') or Ticket_group is null ) and RequestID not in (SELECT distinct [RequestID]

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where request_mode ='Internal Reference')) t

PIVOT(
    COUNT([RequestID]) 
    FOR SLA IN (
       [Not exceed], 
        [exceed])
) AS pivot_table)

select isnull ((select 
round(cast(cast(sum(ticket_SLA.[Not exceed]) as float)/cast((sum(ticket_SLA.[exceed])+Sum(ticket_SLA.[Not exceed])) as float) as float),2)*100 [MTTR] 
from 
ticket_SLA),0) [MTTR]");
     $output_mttR2 = (sqlsrv_fetch_array($MTTR2_query));
       $get_MTTR2 = $output_mttR2['MTTR'];

//////////////
        $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkforceDB_indexed";
  
  $connectionInfo = array( "Database"=>"WorkforceDB_indexed" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $connect = sqlsrv_connect($DBhost, $connectionInfo);

    $not_exceed_query= sqlsrv_query( $connect,"with x as (
select * from (
SELECT[year],[month]
      ,[RequestID]
      ,[SLA]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_total_time_within_SD_pool_not_exceed_90_min]
  left join [Aya_Web_APP].dbo.employee_web_table on username = Last_Enginner
   where manager = '$self') t
PIVOT(
    COUNT([RequestID]) 
    FOR [SLA] IN (
        [Not Exceed], 
        [Exceed])
) AS pivot_table)

select cast([year] + '-' + [month] + '-01' as date) [month] , cast([Not Exceed] as float) / (cast([Not Exceed] as float)+cast([exceed]as float)) 'percentage'
from x" );
   
  $notExceed ='';
 while( $outpot_notExceed = sqlsrv_fetch_array($not_exceed_query) )
{
$notExceed .="{ percentages:'".floor(($outpot_notExceed['percentage'])*100).'%'."',date:'".$outpot_notExceed['month']->format('Y-m-d')."'},";
}
$notExceed = substr($notExceed, 0);
///////
/****** total tickets  ******/
   $global_tickets = sqlsrv_query( $connect ,"with x as (
select * from (
SELECT[year],[month]
      ,[RequestID]
      ,[SLA]
  FROM [WorkForce_Reporting_DB].[dbo].[tbl_93%_of_global_tickets_to_have_PSD_tickets]
  left join [Aya_Web_APP].dbo.employee_web_table on username = Last_Enginner
   where manager = '$self') t
PIVOT(
    COUNT([RequestID]) 
    FOR [SLA] IN (
        [Have PSD], 
        [Didnt Have PSD])
) AS pivot_table)

select cast([year] + '-' + [month] + '-01' as date) [month] , cast([Have PSD] as float) / (cast([Didnt Have PSD] as float)+cast([Have PSD]as float)) 'percentage'
from x");

 $global_ticke ='';
 while( $outpot_global_tickets = sqlsrv_fetch_array($global_tickets) )
{
$global_ticke .="{ percent:'".floor(($outpot_global_tickets['percentage'])*100).'%'."',dates:'".$outpot_global_tickets['month']->format('Y-m-d')."'},";
}
$global_ticke = substr($global_ticke, 0);


?>
