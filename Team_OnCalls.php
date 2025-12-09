
<?php
include ("pages.php");
?>

	<title>OnCall View</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
     <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="css/ionicons.min.css">
     <link rel="stylesheet" href="css/dialogbox.css">
</head>
<style>
table {
  border-collapse: collapse;
  overflow: hidden;
  box-shadow: 0 0 2px rgba(0,0,0,0.1);
  text-align: center;
  background-color: white;
}
tr:nth-child(even) {
  background-color: lightgray;
}

td {
  padding:15px;
  background-color: rgba(255,255,255,0.2);
  color: black;
  position: relative;
}

  th {
    padding:15px;
    background-color: #55608f;
    text-align: center;
  color: black;
  position: relative;

  }


tr:hover{
  color: #fff;
}

.hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
.hover {
      background: #333d6b;
      color: #fff;
      border-radius:20px 20px 20px 20px ;

        }
.tableFixHead {
      table-layout: fixed;
      border-collapse: collapse;
    }
      .tableFixHead tbody {
      display: block;
      overflow: auto;
      height: 250px;
      background-color: white;
    }
    .tableFixHead thead  {
      display: block;
    }
    .tableFixHead th,
    .tableFixHead  td{
      width: 250px;
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
              <h2 class="text-dark display-12" >On Call History</h2>
      
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This is the final calulation for the on call after approval</p>
  </aside>
</div>
</center>


<center>
  <h2 style="color:;">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
  <div class="col-md-8">
      <div class="tableFixHead" >

         <table  style="border-radius: 30px 30px 0 0; background-color: white;">
    <thead >
      <th style="color:#fff; text-align:center;"><center>Username</center></th>
      <th style="color:#fff; text-align:center;"><center>Employee Type</center></th>
      <th style="color:#fff; margin:0; text-align:center;"><center>Week Day</center></th>
      <th style="color:#fff; margin:0; text-align:center;"><center>Week End</center></th>
      <th style="color:#fff; margin:0; text-align:center;"><center>Month</center></th>
      <th style="color:#fff; margin:0; text-align:center;"><center>Year</center></th>
        
</thead>
</table>
<table class="order-table">
<tbody>
<?php      
if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];
}
$check_engineers  = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id = '$engineer_id'  ");
   while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];

$first_query = sqlsrv_query( $con ,"with [x1] as (SELECT distinct case
    when tbl_personal_info.ID is null  and  d.username=x.Username then Outsource_ID
    else tbl_personal_info.ID
    end  [id1]
        
        ,case
            when d.username=x.Username then x.Username
            else d.username
            end [username1]
      ,iif(len(case
    when tbl_personal_info.ID is null  and  d.username=x.Username then Outsource_ID
    else tbl_personal_info.ID
    end )>4,'Outsource','Staff') [Employee_type1]
      ,iif (tbl_personal_info.manager_name is null , x.Manager_Name,tbl_personal_info.manager_name) [manager]
   

          ,S.a.value('(/H/r)[1]', 'VARCHAR(100)') AS date1
   ,S.a.value('(/H/r)[2]', 'VARCHAR(100)')  AS date2
   , S.a.value('(/H/r)[3]', 'VARCHAR(100)') AS date3
   , S.a.value('(/H/r)[4]', 'VARCHAR(100)') AS date4
   , S.a.value('(/H/r)[5]', 'VARCHAR(100)') AS date5
   , S.a.value('(/H/r)[6]', 'VARCHAR(100)') AS date6
    , S.a.value('(/H/r)[7]', 'VARCHAR(100)') AS date7
     , S.a.value('(/H/r)[8]', 'VARCHAR(100)') AS date8
      , S.a.value('(/H/r)[9]', 'VARCHAR(100)') AS date9
       , S.a.value('(/H/r)[10]', 'VARCHAR(100)') AS date10
       , S.a.value('(/H/r)[11]', 'VARCHAR(100)') AS date11
        , S.a.value('(/H/r)[12]', 'VARCHAR(100)') AS date12
    ,[month]
    ,[year]
  FROM (
SELECT *
     ,CAST (N'<H><r>' + REPLACE([days], ',', '</r><r>')  + '</r></H>' AS XML) AS [vals]
FROM [Aya_Web_APP].[dbo].[oncall_sd]

) d 
CROSS APPLY d.[vals].nodes('/H/r') S(a)
  left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = d.username
  left join (
SELECT  [Employee_ID]
      ,[Outsource_Staff].[Username]
    ,Manager_Name
      ,[Effectivity_date]
      ,[Outsource_ID]
   
      ,[update_user]
      ,[date_time]
      ,[New_username]
  FROM [Employess_DB].[dbo].[Outsource_Staff]
  left join [Employess_DB].dbo.tbl_Personal_info on [Employee_ID] = ID) X on  d.[username]=x.[username]
 
  where [status] like '%approve%' ),
 [x2] as (
  select case 
  when  username1=UserName  and id1 is null then  ID
  else id1
  end  [id]
  , username1
  ,case 
  when username1=username and manager is null then tbl_personal_info.Manager_Name
  else manager
  end  [manager] 
,[Employee_type1]
  ,[date1]
  ,[date2]
  ,[date3]
  ,[date4]
  ,[date5]
  ,[date6]
  ,[date7]
  ,[date8]
  ,[date9]
  ,[date10]
  ,[date11]
  ,[date12]
  ,[month]
  ,[year]
  from [x1]
  left join Employess_DB.dbo.tbl_personal_info on username1=[tbl_personal_info].[username]
  where (month(CONVERT(date,[Date1],104)) = [month] or month(CONVERT(date,[Date1],104)) is null )
 and  (month(CONVERT(date,[Date2],104)) = [month] or month(CONVERT(date,[Date2],104)) is null ) 
  and ( month(CONVERT(date,[Date3],104)) = [month] or month(CONVERT(date,[Date3],104)) is null )
   and (  month(CONVERT(date,[Date4],104)) = [month] or month(CONVERT(date,[Date4],104)) is null )
    and ( month(CONVERT(date,[Date5],104)) = [month] or month(CONVERT(date,[Date5],104)) is null )
   and ( month(CONVERT(date,[Date6],104)) = [month] or month(CONVERT(date,[Date6],104)) is null )
    and ( month(CONVERT(date,[Date7],104)) = [month] or month(CONVERT(date,[Date7],104)) is null )
     and ( month(CONVERT(date,[Date8],104)) = [month] or month(CONVERT(date,[Date8],104)) is null )
      and ( month(CONVERT(date,[Date9],104)) = [month] or month(CONVERT(date,[Date9],104)) is null )
     and(  month(CONVERT(date,[Date10],104)) = [month] or month(CONVERT(date,[Date10],104)) is null )
      and ( month(CONVERT(date,[Date11],104)) = [month] or month(CONVERT(date,[Date11],104)) is null )
       and(  month(CONVERT(date,[Date12],104)) = [month] or month(CONVERT(date,[Date12],104)) is null )
  )
  ,
  [final] as(select 
  id
  ,username1
  ,Employee_type1
  ,manager
,sum(case
 when DATename(WEEKDAY,CONVERT(date,[Date1],104)) in ('Friday','Saturday')then 1 else 0 end +
 case
    when DATename(WEEKDAY,CONVERT(date,[date2],104)) in ('Friday','Saturday')then 1 else 0 end +
  case
    when DATename(WEEKDAY,CONVERT(date,[date3],104)) in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date4],104)) in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date5],104)) in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date6],104)) in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date7],104)) in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date8],104)) in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date9],104)) in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date10],104)) in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date11],104)) in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date12],104)) in ('Friday','Saturday')then 1 else 0 end ) [week_end1]
,sum(case
 when DATename(WEEKDAY,CONVERT(date,[Date1],104)) not in ('Friday','Saturday')then 1 else 0 end +
 case
    when DATename(WEEKDAY,CONVERT(date,[date2],104)) not in ('Friday','Saturday')then 1 else 0 end +
  case
    when DATename(WEEKDAY,CONVERT(date,[date3],104)) not  in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date4],104))not in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date5],104))not in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date6],104))not in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date7],104)) not in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date8],104))not in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date9],104)) not in('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date10],104))not in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date11],104))not in ('Friday','Saturday')then 1 else 0 end +
case    when DATename(WEEKDAY,CONVERT(date,[date12],104)) not in ('Friday','Saturday')then 1 else 0 end )[week_day]
,[MONTH]
,[year]
  from [x2]
  group by  id
  ,username1
  ,Employee_type1
  ,manager
  ,[MONTH]
,[year]),
 
 diff_table as (
  
 select id
    ,username1
    ,employee_type1
    
    ,week_day
    ,case when [week_end1] >=10 then 10
     else [week_end1]
    end week_end
  , [month]
  , [year]
 
    from [final]  
)
 select 
 diff_table.id
    ,diff_table.username1
    ,diff_table.employee_type1
  ,diff_table.week_day 
  ,diff_table.week_end
  ,diff_table.[month]
  ,diff_table.[year]
  ,[Aya_Web_APP].[dbo].[employee].[id] [engineer_id]
 from diff_table
 left join [Aya_Web_APP].[dbo].[employee] on [Aya_Web_APP].[dbo].[employee].username =diff_table.username1
 where username1 = '$eng_username' order by [year] DESC , [month]  DESC
 ");
  while( $output_query = sqlsrv_fetch_array($first_query)){
$rows = '<tr >';
$rows .='<td class="hovers"><center>'.$output_query["username1"].'</center></td>';
$rows .= '<td class="hovers"><center>'.$output_query["employee_type1"].'</center></td>';
$rows .= '<td class="hovers"><center>'.$output_query["week_day"].'</center></td>';
$rows .= '<td class="hovers"><center>'.$output_query["week_end"].'</center></td>';
$rows .= '<td class="hovers"><center>'.$output_query["month"].'</center></td>';
$rows .= '<td class="hovers"><center>'.$output_query["year"].'</center></td>';
$rows .= '</tr>';
echo $rows;
}}
?>

              </tbody>
            </table>
          </div>
        </div>        
      
</center>

<script src="fixed_s/vendor/jquery/jquery-3.2.1.min.js"></script>
  <script src="fixed_s/vendor/bootstrap/js/popper.js"></script>
  <script src="fixed_s/vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="fixed_s/vendor/select2/select2.min.js"></script>
  <script src="fixed_s/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
  <script>
    $('.js-pscroll').each(function(){
      var ps = new PerfectScrollbar(this);

      $(window).on('resize', function(){
        ps.update();
      })
    });
      
    
  </script>
  <script src="table-filter.js"></script>

	<?php

 include ("footer.html");
 ?>

