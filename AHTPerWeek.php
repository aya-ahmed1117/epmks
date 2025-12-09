
<?php
//session_start();
set_time_limit(400);
include ("pages.php");
?>
<head>
      <title>AHT_Per_Week</title>
      <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

<style type="text/css">
  .zoom:hover{
    transform: scale(1.5);
  }
</style>
<div style="padding:20px;">

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >AHT Weekly
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
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
        <th ><center>year</center></th>
        <th ><center>Week</center></th>
        <th ><center>username</center></th>
        <th><center>Manager</center></th>
        <th><center>Global_Avg</center> </th>
        <th><center>Logical_Avg</th>
        <th ><center>Physical_Avg_PSD</center></th>
        <th ><center>Physical_Avg_No_PSD</center> </th>  
        <th ><center>Request_Avg_PSD</center> </th>  
        <th ><center>Request_Avg_No_PSD</center> </th>  
        <th ><center>Total_Average_PSD</center> </th>  
        <th ><center>Total_Average_NO_PSD</center> </th> 
    </tr>
		</thead>
  <tbody>

<?php

if($_SESSION['role_id'] == 0){
  $_GET['week']="week";

include ("AHTyesterday.php");
 $GLOBALS["week"];
}else{
   $new_query = sqlsrv_query( $con , "with AHT_phase1 as (SELECT A.[RequestID]
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
,Ticket_group,Category

,iif(psd_number is null,'No PSD','PSD')),

Glo_Log as(
select *

from (select [year]
,[week]
,username

,cast (avg(cast (AHT as float)) as datetime) Average_AHT 

,Category
from AHT_phase1
group by [year]
,[week]
,username
,Category
) sourc
pivot (max(Average_AHT) for Category in ([Global]

,[Logical]


)) piv),


Phy_Req_PSD as (

select *
from (select [year]

,[week]


,username
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


[Physical]



,[Request]



)) piv



),



Phy_Req_No_PSD as (



select *



from (select [year]



,[week]
,username 

,cast (avg(cast (AHT as float)) as datetime) Average_AHT



,Category



from AHT_phase1



where PSD_status='No PSD'



group by [year]



,[week]



,username



,Category 

) sourc



pivot (max(Average_AHT) for Category in (



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
where year(schedule_date) >=year(getdate())
)


SELECT [Total_AHT_Final].[year],[Total_AHT_Final].[week],[Total_AHT_Final].[username]
,senior [Manager]
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

left join [Aya_Web_APP].dbo.employee_web_table a on a.username = [Total_AHT_Final].[username]

where manager = '$self'
order by 1,2,3
 ");
 	 while($echo = sqlsrv_fetch_array($new_query) ){
$rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['year'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['week'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['username'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Manager'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Global_Avg'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Logical_Avg'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Physical_Avg_PSD'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Physical_Avg_No_PSD'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Request_Avg_PSD'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Request_Avg_No_PSD'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Total_Average_PSD'].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$echo['Total_Average_NO_PSD'].'</td>';

$rows .= '</tr>';
echo $rows;

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
                filename: "AHT_Per_Week.xls"
            });
        }
    </script>
<<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>




