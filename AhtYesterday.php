


<link rel="stylesheet" type="text/css" href="css/kpi_css.css">
<style type="text/css">
.hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }</style>
<?php
$gett_year = date('Y');
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
 if(isset($_GET['yesterday'])){$someday = $_GET['yesterday'];
 
$someday = 'yesterday';
 if ($someday = 'yesterday'){
   //if($_SESSION['role_id'] == 0){
   $new_query = sqlsrv_query( $con ,"with AHT_phase1 as (SELECT A.[RequestID]
,[username]
, CAST(sum(CAST(([out_]-[In_])AS FLOAT)) AS DATETIME) AHT
,Ticket_group
,Category
,datepart(DAY,([schedule_date])) [Day]
,year([schedule_date]) [year]
,iif(psd_number is null,'No PSD','PSD')  PSD_status
FROM [Aya_Web_APP].[dbo].[AHT_per_Ticket] a
LEFT JOIN [WorkforceDB_indexed].[dbo].[KPI_Status_RawData] KPI ON A.[RequestID]=KPI.RequestID
where Category in  ('Global'
,'Logical'
,'Physical'
,'Request')
and cast([schedule_date] as date) =  cast(dateadd(day,-1,getdate()) as date)
and [Fake_Real] = 'Real Ticket'
and KPI.[RequestID] not in (SELECt  [RequestID]
FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
where [closure_reason] in ('Duplicated tickets'))
group by A.[RequestID]
,[username]
,datepart(DAY,([schedule_date]))
,year([schedule_date])
,Ticket_group
,Category
,iif(psd_number is null,'No PSD','PSD')),

Glo_Log as(
select *
from (select [year]
,[Day]
,username
    --,PSD_status
,cast (avg(cast (AHT as float)) as datetime) Average_AHT
,Category
from AHT_phase1
group by [year]
,[Day]
,username
,Category
--,PSD_status

) sourc

pivot (max(Average_AHT) for Category in ([Global]

,[Logical]
--,[Physical]
--,[Request]

 
)) piv),

 
Phy_Req_PSD as (
select *
from (select [year]
,[Day]
,username

 

    --,PSD_status

 

,cast (avg(cast (AHT as float)) as datetime) Average_AHT

 

,Category

 

from AHT_phase1

 

where PSD_status='PSD'

 

group by [year]

 

,[Day]

 

,username

 

,Category

 

--,PSD_status

 

) sourc

 

pivot (max(Average_AHT) for Category in (

 

--[Global]

 

--,[Logical]

 

--,

 

[Physical]

,[Request]


)) piv

 
),

 
Phy_Req_No_PSD as (

 

select *


from (select [year]


,[Day]
 
,username


    --,PSD_status

,cast (avg(cast (AHT as float)) as datetime) Average_AHT

 

,Category

 

from AHT_phase1

 

where PSD_status='No PSD'

 

group by [year]

 

,[Day]

 

,username

 

,Category

 

--,PSD_status

 

) sourc

 

pivot (max(Average_AHT) for Category in (

 

--[Global]

 

--,[Logical]

 

--,

 

[Physical]

 

,[Request]

 

)) piv),

 

 

Total_AHT_1 as(SELECT A.[RequestID]

 

,[username]

 

, CAST(sum(CAST(([out_]-[In_])AS FLOAT)) AS DATETIME) AHT

 

,datepart(Day,[schedule_date]) [Day]

 

,year([schedule_date]) [year]

 

,iif(psd_number is null,'No PSD','PSD')  PSD_status

 

FROM [Aya_Web_APP].[dbo].[AHT_per_Ticket] a

 

LEFT JOIN [WorkforceDB_indexed].[dbo].[KPI_Status_RawData] KPI ON A.[RequestID]=KPI.RequestID

 

where Category in  ('Global'

 
,'Logical'

 
,'Physical'

 
,'Request')

and cast([schedule_date] as date) =  cast(dateadd(day,-1,getdate()) as date)


and [Fake_Real] = 'Real Ticket'

 

and KPI.[RequestID] not in (SELECt  [RequestID]


FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]

 

where [closure_reason] in ('Duplicated tickets'))

 

group by A.[RequestID]

,[username]

,datepart(Day,[schedule_date])

,year([schedule_date])

,iif(psd_number is null,'No PSD','PSD')),


Total_AHT_Final as

( select *


from (select [year]

,[Day]

,username
 ,PSD_status

,cast (avg(cast (AHT as float)) as datetime) Average_AHT

 

from AHT_phase1


group by [year]

 

,[Day]

 

,username

 

,PSD_status

 

) sourc

 

pivot (max(Average_AHT) for PSD_Status in ([PSD]

 

,[No PSD]

 

)) piv

 

)

 
select cast(DATEADD(day,-1,getdate())as date) Yesterday,[Total_AHT_Final].[Day],[Total_AHT_Final].[username],senior [Manager]
--,PSD_status
,right('0' + convert(varchar(9),((datediff(second,0,[global])) / 3600 )),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,[global])) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,[global]))% 60 )),2) as [Global_Avg]
,right('0' + convert(varchar(9),((datediff(second,0,[logical])) / 3600 )),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,[logical])) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,[logical]))% 60 )),2) as [Logical_Avg]
,right('0' + convert(varchar(9),((datediff(second,0,x.[Physical])) / 3600 )),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,x.[Physical])) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,x.[Physical]))% 60 )),2) as[Physical_Avg_PSD]
,right('0' + convert(varchar(9),((datediff(second,0,y.[Physical])) / 3600 )),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,y.[Physical])) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,y.[Physical]))% 60 )),2) as[Physical_Avg_No_PSD]
,right('0' + convert(varchar(9),((datediff(second,0,x.[Request])) / 3600 )),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,x.[Request])) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,x.[Request]))% 60 )),2) as[Request_Avg_PSD]
,right('0' + convert(varchar(9),((datediff(second,0,y.[Request])) / 3600 )),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,y.[Request])) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,y.[Request]))% 60 )),2) as[Request_Avg_No_PSD]
,right('0' + convert(varchar(9),((datediff(second,0,[PSD])) / 3600 )),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,[PSD])) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,[PSD]))% 60 )),2) as[Total_Average_PSD]
,right('0' + convert(varchar(9),((datediff(second,0,[No PSD])) / 3600 )),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,[No PSD])) / 60) % 60 ),2) + ':'
+ right('0' + convert(varchar(2),((datediff(second,0,[No PSD]))% 60 )),2) as[Total_Average_NO_PSD]
from  Total_AHT_Final full join Glo_Log on Glo_Log.username=Total_AHT_Final.username and Glo_Log.[Day]=Total_AHT_Final.[Day] and Glo_Log.[year]=Total_AHT_Final.[year]
full join Phy_Req_PSD as x on x.username=Total_AHT_Final.username and x.[Day]=Total_AHT_Final.[Day] and x.[year]=Total_AHT_Final.[year]
full join Phy_Req_No_PSD as y on y.username=Total_AHT_Final.username and y.[Day]=Total_AHT_Final.[Day] and y.[year]=Total_AHT_Final.[year]
left join [Aya_Web_APP].[dbo].[schedule_table] on [schedule_table].username = [Total_AHT_Final].[username] and cast(DATEADD(day,-1,getdate())as date) = [schedule_table].schedule_date

where [schedule_table].username ='$s_username'

order by 1,2,3  ");
   while($echo = sqlsrv_fetch_array($new_query) ){
         $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Yesterday']->format('Y-m-d').'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Day'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['username'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Manager'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Global_Avg'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Logical_Avg'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Physical_Avg_PSD'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Physical_Avg_No_PSD'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Request_Avg_PSD'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Request_Avg_No_PSD'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Total_Average_PSD'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Total_Average_NO_PSD'].'</td>';
		$rows .= '</tr>';
		  	echo $rows;

}
}}
?>
<?php
if(isset($_GET['week'])){$week = $_GET['week'];
//session_start();
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];

//else{
//if(isset($_GET['week'])){
$week = 'week';

 //if ($somedayweek = 'week'){
//week
      $s_username = $_SESSION['username'];

$week_query = sqlsrv_query( $con , "with AHT_phase1 as (SELECT A.[RequestID]
      ,[username]
         , CAST(sum(CAST(([out_]-[In_])AS FLOAT)) AS DATETIME) AHT

         ,Ticket_group
         ,Category
         ,datepart(week,([schedule_date])) [week]
         ,year([schedule_date]) [year]
         ,iif(psd_number is null,'No PSD','PSD')  PSD_status
  FROM [Aya_Web_APP].[dbo].[AHT_per_Ticket] a
  LEFT JOIN [WorkforceDB_indexed].[dbo].[KPI_Status_RawData] KPI ON A.[RequestID]=KPI.RequestID
  where Category in  ('Global'
,'Logical'
,'Physical'
,'Request')
and cast([schedule_date] as date) between (SELECT cast(DATEADD(wk, DATEDIFF(wk, 6, '1/1/' + cast(year(getdate())as nvarchar)) + (datepart(week,getdate())-2), 6)as date)) and  dateadd(day,6,cast(DATEADD(wk, DATEDIFF(wk, 6, '1/1/' + cast(year(getdate())as nvarchar)) + (datepart(week,getdate())-2), 6)as date))

 

and [Fake_Real] = 'Real Ticket'

 

and KPI.[RequestID] not in (SELECt  [RequestID]

 

    

 

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]

 

  where [closure_reason] in ('Duplicated tickets'))

 

  group by A.[RequestID]

 

      ,[username]

 

      ,datepart(week,([schedule_date]))

 

         ,year([schedule_date])

 

         ,Ticket_group

 

         ,Category

 

             ,iif(psd_number is null,'No PSD','PSD')),

 

 

         Glo_Log as(

 

 

       select *

 

       from (select [year]

 

               ,[week]

 

                 ,username

 

                                 --,PSD_status

 

                    ,cast (avg(cast (AHT as float)) as datetime) Average_AHT

 

                   ,Category

 

         from AHT_phase1

 

         group by [year]

 

               ,[week]

 

               ,username

 

               ,Category

 

                       --,PSD_status

 

             ) sourc

 

             pivot (max(Average_AHT) for Category in ([Global]

 

,[Logical]

 

--,[Physical]

 

--,[Request]

 

)) piv),

 

 

Phy_Req_PSD as (

 

select *

 

       from (select [year]

 

               ,[week]

 

                    ,username

 

                                 --,PSD_status

 

                    ,cast (avg(cast (AHT as float)) as datetime) Average_AHT

 

                   ,Category

 

         from AHT_phase1

 

             where PSD_status='PSD'

 

         group by [year]

 

               ,[week]

 

               ,username

 

               ,Category

 

                       --,PSD_status

 

             ) sourc

 

             pivot (max(Average_AHT) for Category in (

 

--[Global]

 

--,[Logical]

 

--,

 

[Physical]

 

,[Request]

 

)) piv

 

),

 

Phy_Req_No_PSD as (

 

select *

 

       from (select [year]

 

               ,[week]

 

                    ,username

 

                                 --,PSD_status

 

                    ,cast (avg(cast (AHT as float)) as datetime) Average_AHT

 

                   ,Category

 

         from AHT_phase1

 

             where PSD_status='No PSD'

 

         group by [year]

 

               ,[week]

 

               ,username

 

               ,Category

 

                       --,PSD_status

 

             ) sourc

 

             pivot (max(Average_AHT) for Category in (

 

--[Global]

 

--,[Logical]

 

--,

 

[Physical]

 

,[Request]

 

)) piv),

 

 

Total_AHT_1 as(SELECT A.[RequestID]

 

      ,[username]

 

         , CAST(sum(CAST(([out_]-[In_])AS FLOAT)) AS DATETIME) AHT

 

         ,datepart(week,[schedule_date]) [week]

 

         ,year([schedule_date]) [year]

 

             ,iif(psd_number is null,'No PSD','PSD')  PSD_status

 

  FROM [Aya_Web_APP].[dbo].[AHT_per_Ticket] a

 

  LEFT JOIN [WorkforceDB_indexed].[dbo].[KPI_Status_RawData] KPI ON A.[RequestID]=KPI.RequestID

 

  where Category in  ('Global'

 

,'Logical'

 

,'Physical'

 

,'Request')

 

and cast([schedule_date] as date) between (SELECT cast(DATEADD(wk, DATEDIFF(wk, 6, '1/1/' + cast(year(getdate())as nvarchar)) + (datepart(week,getdate())-2), 6)as date)) and  dateadd(day,6,cast(DATEADD(wk, DATEDIFF(wk, 6, '1/1/' + cast(year(getdate())as nvarchar)) + (datepart(week,getdate())-2), 6)as date))

 

and [Fake_Real] = 'Real Ticket'

 

and KPI.[RequestID] not in (SELECt  [RequestID]

 

    

 

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]

 

  where [closure_reason] in ('Duplicated tickets'))

 

  group by A.[RequestID]

 

      ,[username]

 

      ,datepart(week,[schedule_date])

 

         ,year([schedule_date])

 

             ,iif(psd_number is null,'No PSD','PSD')),

 

 

Total_AHT_Final as

 

( select *

 

       from (select [year]

 

               ,[week]

 

                    ,username

 

                                 ,PSD_status

 

                    ,cast (avg(cast (AHT as float)) as datetime) Average_AHT

 

         from AHT_phase1

 

         group by [year]

 

               ,[week]

 

               ,username

 

                ,PSD_status

 

             ) sourc

 

             pivot (max(Average_AHT) for PSD_Status in ([PSD]

 

,[No PSD]

 

)) piv

 

),


sch as (

SELECT distinct datepart(week,([schedule_date])) [week]
,year([schedule_date]) [year]
      ,[username]
      ,[senior]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  where year(schedule_date) >='$gett_year'
)

 

 

 

select [Total_AHT_Final].[year],[Total_AHT_Final].[week],[Total_AHT_Final].[username],senior [Manager]

 

--,PSD_status

 

,right('0' + convert(varchar(9),((datediff(second,0,[global])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[global])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[global]))% 60 )),2) as [Global_Avg]

 

,right('0' + convert(varchar(9),((datediff(second,0,[logical])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[logical])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[logical]))% 60 )),2) as [Logical_Avg]

 

,right('0' + convert(varchar(9),((datediff(second,0,x.[Physical])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,x.[Physical])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,x.[Physical]))% 60 )),2) as[Physical_Avg_PSD]

 

,right('0' + convert(varchar(9),((datediff(second,0,y.[Physical])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,y.[Physical])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,y.[Physical]))% 60 )),2) as[Physical_Avg_No_PSD]

 

,right('0' + convert(varchar(9),((datediff(second,0,x.[Request])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,x.[Request])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,x.[Request]))% 60 )),2) as[Request_Avg_PSD]

 

,right('0' + convert(varchar(9),((datediff(second,0,y.[Request])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,y.[Request])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,y.[Request]))% 60 )),2) as[Request_Avg_No_PSD]

 

,right('0' + convert(varchar(9),((datediff(second,0,[PSD])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[PSD])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[PSD]))% 60 )),2) as[Total_Average_PSD]

 

,right('0' + convert(varchar(9),((datediff(second,0,[No PSD])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[No PSD])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[No PSD]))% 60 )),2) as[Total_Average_NO_PSD]

 

from  Total_AHT_Final full join Glo_Log on Glo_Log.username=Total_AHT_Final.username and Glo_Log.[week]=Total_AHT_Final.[week] and Glo_Log.[year]=Total_AHT_Final.[year]

 

full join Phy_Req_PSD as x on x.username=Total_AHT_Final.username and x.[week]=Total_AHT_Final.[week] and x.[year]=Total_AHT_Final.[year]

 

full join Phy_Req_No_PSD as y on y.username=Total_AHT_Final.username and y.[week]=Total_AHT_Final.[week] and y.[year]=Total_AHT_Final.[year]

 
left join sch on sch.username = [Total_AHT_Final].[username] and [Total_AHT_Final].[week] = sch.[week] and [Total_AHT_Final].[year] = sch.[year]
where sch.username ='$s_username'
order by 1,2,3
 ");
  

 		  while($echo2 = sqlsrv_fetch_array($week_query) ){

         $rows2 = '<tr>';
	$rows2 .='<td class="hovers" style="border: 1px solid #000000;">'.$echo2['year'].'</td>';
    $rows2 .='<td class="hovers" style="border: 1px solid #000000;">'.$echo2['week'].'</td>';
    $rows2 .='<td class="hovers" style="border: 1px solid #000000;">'.$echo2['username'].'</td>';
    $rows2 .='<td class="hovers" style="border: 1px solid #000000;">'.$echo2['Manager'].'</td>';
    $rows2 .='<td class="hovers" style="border: 1px solid #000000;">'.$echo2['Global_Avg'].'</td>';
    $rows2 .='<td class="hovers" style="border: 1px solid #000000;">'.$echo2['Logical_Avg'].'</td>';
    $rows2 .='<td class="hovers" style="border: 1px solid #000000;">'.$echo2['Physical_Avg_PSD'].'</td>';
    $rows2 .='<td class="hovers" style="border: 1px solid #000000;">'.$echo2['Physical_Avg_No_PSD'].'</td>';
    $rows2 .='<td class="hovers" style="border: 1px solid #000000;">'.$echo2['Request_Avg_PSD'].'</td>';
    $rows2 .='<td class="hovers" style="border: 1px solid #000000;">'.$echo2['Request_Avg_No_PSD'].'</td>';
    $rows2 .='<td class="hovers" style="border: 1px solid #000000;">'.$echo2['Total_Average_PSD'].'</td>';
    $rows2 .='<td class="hovers" style="border: 1px solid #000000;">'.$echo2['Total_Average_NO_PSD'].'</td>';
		  	$rows2 .= '</tr>';
		  	echo $rows2;
}}
//}
?>
<?php 
if(isset($_GET['month'])){$month = $_GET['month'];
 
$month = 'month';

$new_query = sqlsrv_query( $con , "with AHT_phase1 as (SELECT A.[RequestID]

 

  ,[username] , CAST(sum(CAST(([out_]-[In_])AS FLOAT)) AS DATETIME) AHT

 

  ,Ticket_group,Category ,month([schedule_date]) [month]

 

         ,year([schedule_date]) [year]

 

             ,iif(psd_number is null,'No PSD','PSD')  PSD_status

 

  FROM [Aya_Web_APP].[dbo].[AHT_per_Ticket] a

 

  LEFT JOIN [WorkforceDB_indexed].[dbo].[KPI_Status_RawData] KPI ON A.[RequestID]=KPI.RequestID

 

  where Category in  ('Global','Logical','Physical','Request')

 

and year([schedule_date]) >='$gett_year'

 

and [Fake_Real] = 'Real Ticket'

 

and KPI.[RequestID] not in (SELECt  [RequestID]

 

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]

 

  where [closure_reason] in ('Duplicated tickets'))

 

  group by A.[RequestID]

 

      ,[username]

 

      ,month([schedule_date])

 

         ,year([schedule_date])

 

         ,Ticket_group,Category

             ,iif(psd_number is null,'No PSD','PSD')),

 

         Glo_Log as(

       select *

 

       from (select [year]

 

               ,[month],username

                    ,cast (avg(cast (AHT as float)) as datetime) Average_AHT

 

                   ,Category

 

         from AHT_phase1

 

         group by [year],[month],username,Category

 

             ) sourc

 

             pivot (max(Average_AHT) for Category in ([Global]

 

,[Logical]

 

)) piv),

 

 

Phy_Req_PSD as (

 

select *

 

       from (select [year]

 

               ,[month] ,username

                    ,cast (avg(cast (AHT as float)) as datetime) Average_AHT

 

                   ,Category

 

         from AHT_phase1

 

             where PSD_status='PSD'

 

         group by [year]

 

               ,[month],username ,Category

 

             ) sourc

 

             pivot (max(Average_AHT) for Category in (

 

[Physical]

 

,[Request]

 

)) piv),

 

Phy_Req_No_PSD as (

 

select *

 

       from (select [year]

 

               ,[month],username

  ,cast (avg(cast (AHT as float)) as datetime) Average_AHT

 

                   ,Category

 

         from AHT_phase1

 

             where PSD_status='No PSD'

 

         group by [year]

 

               ,[month],username,Category

 

             ) sourc

 

             pivot (max(Average_AHT) for Category in (

[Physical],[Request]

 

)) piv),

 

Total_AHT_1 as(SELECT A.[RequestID]

 

      ,[username]

 

         , CAST(sum(CAST(([out_]-[In_])AS FLOAT)) AS DATETIME) AHT

 

         ,month([schedule_date]) [month]

 

         ,year([schedule_date]) [year]

 

             ,iif(psd_number is null,'No PSD','PSD')  PSD_status

 

  FROM [Aya_Web_APP].[dbo].[AHT_per_Ticket] a

 

  LEFT JOIN [WorkforceDB_indexed].[dbo].[KPI_Status_RawData] KPI ON A.[RequestID]=KPI.RequestID

 

  where Category in  ('Global','Logical','Physical','Request')

 

and year([schedule_date]) >='$gett_year'

 

and [Fake_Real] = 'Real Ticket'

 

and KPI.[RequestID] not in (SELECt  [RequestID]

  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]

 

  where [closure_reason] in ('Duplicated tickets'))

 

  group by A.[RequestID]

 

      ,[username],month([schedule_date]),year([schedule_date])

 

             ,iif(psd_number is null,'No PSD','PSD')),

 

Total_AHT_Final as

 

( select *

 

       from (select [year]

 

     ,[month],username,PSD_status

 

  ,cast (avg(cast (AHT as float)) as datetime) Average_AHT

 

         from AHT_phase1

 

         group by [year],[month],username ,PSD_status

 

             ) sourc

 

             pivot (max(Average_AHT) for PSD_Status in ([PSD]

 

,[No PSD]

 

)) piv),


sch as (

SELECT distinct month([schedule_date]) [Month]
,year([schedule_date]) [year]
      ,[username]
      ,[senior]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  where year(schedule_date) >='$gett_year'
)

 

select [Total_AHT_Final].[year],[Total_AHT_Final].[month],[Total_AHT_Final].[username] ,senior [Manager]

 

--,PSD_status

 

,right('0' + convert(varchar(9),((datediff(second,0,[global])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[global])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[global]))% 60 )),2) as [Global_Avg]

 

,right('0' + convert(varchar(9),((datediff(second,0,[logical])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[logical])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[logical]))% 60 )),2) as [Logical_Avg]

 

,right('0' + convert(varchar(9),((datediff(second,0,x.[Physical])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,x.[Physical])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,x.[Physical]))% 60 )),2) as[Physical_Avg_PSD]

 

,right('0' + convert(varchar(9),((datediff(second,0,y.[Physical])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,y.[Physical])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,y.[Physical]))% 60 )),2) as[Physical_Avg_No_PSD]

 

,right('0' + convert(varchar(9),((datediff(second,0,x.[Request])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,x.[Request])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,x.[Request]))% 60 )),2) as[Request_Avg_PSD]

 

,right('0' + convert(varchar(9),((datediff(second,0,y.[Request])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,y.[Request])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,y.[Request]))% 60 )),2) as[Request_Avg_No_PSD]

 

,right('0' + convert(varchar(9),((datediff(second,0,[PSD])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[PSD])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[PSD]))% 60 )),2) as[Total_Average_PSD]

 

,right('0' + convert(varchar(9),((datediff(second,0,[No PSD])) / 3600 )),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[No PSD])) / 60) % 60 ),2) + ':'

 

              + right('0' + convert(varchar(2),((datediff(second,0,[No PSD]))% 60 )),2) as[Total_Average_NO_PSD]

 

from  Total_AHT_Final full join Glo_Log on Glo_Log.username=Total_AHT_Final.username and Glo_Log.[month]=Total_AHT_Final.[month] and Glo_Log.[year]=Total_AHT_Final.[year]

 

full join Phy_Req_PSD as x on x.username=Total_AHT_Final.username and x.[month]=Total_AHT_Final.[month] and x.[year]=Total_AHT_Final.[year]

 

full join Phy_Req_No_PSD as y on y.username=Total_AHT_Final.username and y.[month]=Total_AHT_Final.[month] and y.[year]=Total_AHT_Final.[year]

 left join sch on sch.username = [Total_AHT_Final].[username] and [Total_AHT_Final].[month] = sch.[month] and [Total_AHT_Final].[year] = sch.[year]
where sch.username ='$s_username'

order by 1,2,3

 ");
   while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
		$rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['year'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['month'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['username'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Manager'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Global_Avg'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Logical_Avg'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Physical_Avg_PSD'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Physical_Avg_No_PSD'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Request_Avg_PSD'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Request_Avg_No_PSD'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Total_Average_PSD'].'</td>';
    $rows .='<td class="hovers" style="border: 1px solid #000000;">'.$echo['Total_Average_NO_PSD'].'</td>';
		  	$rows .= '</tr>';
		  	echo $rows;

}
}
?>