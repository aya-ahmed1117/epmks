<?php
include ("pages.php");
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
 <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
<style type="text/css">


.hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
/*setting for fixed columns*/
        table.trkFixTable tr td:nth-child(1), table.trkFixTable tr th:nth-child(1) {
            min-width: 150px;
        }

        table.trkFixTable tr td:nth-child(2), table.trkFixTable tr th:nth-child(2) {
            min-width: 150px;
        }

        table.trkFixTable thead th:nth-child(1), table.trkFixTable thead th:nth-child(2) {
            height: 80px;
            position: relative;
            z-index: 2;
        }

        table.trkFixTable tbody tr td:nth-child(1), table.trkFixTable tbody tr td:nth-child(2) {
            position: relative;
            height: 60px;
        }
        /*removing hover effect*/
        table.trkFixTable td:hover::after,
        table.trkFixTable th:hover::after {
            all: unset;
        }

        /*common styles*/
        table.trkFixTable {
            position: relative;
            overflow: hidden;
            /*width:100%;*/
            border-collapse: collapse;
            overflow: scroll;
        }

        table.trkFixTable thead {
            position: relative;
            display: block;
            width: 500px;
            overflow: visible;
        }

        table.trkFixTable thead th {
            height: 32px;
            background-color: #6afce2;
            text-align: center;
            border:1px solid black;
            min-width: 150px;
            
        }

        table.trkFixTable tbody {
            position: relative;
            display: block;
            width: 500px;
            overflow: scroll;
            height: 200px;
        }

        table.trkFixTable tbody td {
            min-width: 80px;
            border: 1px solid #222;
            background-color: #c1fff4;
            text-align: center;
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
              <h2 class="text-dark display-12" >Sign History</h2>
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This table shows the minume time of sign in  ( by day) and the Maximum time of sign out ( by Day)</p>
  </aside>
</div>
</center>
	<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">

     
   
    <div class="col-md-8">
    	<table class="table table-condensed table-freeze-multi table-bordered" 
    data-scroll-height="300"
    data-cols-number="2">
    <colgroup>
      <col>
      <col>
      <col>
      <col>
      <col>
      <col>
      <col>
      <col>
      <col>
      <col>
    </colgroup>
            <thead>
                <tr>
		<th rowspan="4" style="font-size: 14px;background-color:#002060;color:#eee;"><center>username</center></th>
		<th rowspan="4" style="font-size: 14px;background-color:#002060;color:#eee;"><center>Month</center></th>

		<th><center>1 </center></th>
		<th><center>2 </center></th>
		<th ><center>3</center></th>
		<th ><center>4</center></th>
		<th ><center>5</center></th>
		<th ><center>6</center></th>
		<th ><center>7</center></th>
		<th >8</th>
		<th >9</th>
		<th >10</th>
		<th >11</th>
		<th >12</th>
		<th >13</th>
		<th >14</th>
		<th >15</th>
		<th >16</th>
		<th >17</th>
		<th >18</th>
		<th >19</th>
		<th >20</th>
		<th >21</th>
		<th >22</th>
		<th >23</th>
		<th >24</th>
		<th >25</th>
		<th >26</th>
		<th >27</th>
		<th >28</th>
		<th >29</th>
		<th >30</th>
		<th >31</th>
      </tr>
    </thead>
    <tbody>
     <?php      

$engineer_id = $_SESSION['id'];
$s_username = $_SESSION['username'];
$first_query = sqlsrv_query( $con ,"declare @Group_name as nvarchar(250)
set @Group_name = 'bs'

select * from (
SELECT
      schedule_table.[username]
      ,datepart(day,schedule_table.[schedule_date]) [schedule_date]
	  ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
	when [shift_start] = 'OFF' then 'OFF'
	 when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
	when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
	else LEFT([shift_start], 2)
	end as nvarchar) [January]
	,[groups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date	
	  ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
  left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where year([schedule_table].[schedule_date]) = year(getdate()) and month([schedule_table].[schedule_date]) = 1 and groups = @Group_name
  ) t

 PIVOT (
  max([January])
  FOR [schedule_date]
  IN ( [1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12],[13],[14],[15],[16],[17],[18],[19],[20],[21],[22],[23],[24],[25],[26],[27],[28],[29],[30],[31])

  ) AS PivotTable

  union

  select * from (
SELECT
      schedule_table.[username]
      ,datepart(day,schedule_table.[schedule_date]) [schedule_date]
	  ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
	when [shift_start] = 'OFF' then 'OFF'
	 when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
	when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
	else LEFT([shift_start], 2)

	end as nvarchar) [February]
		,[groups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date
	
	  ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
    left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where year([schedule_table].[schedule_date]) = year(getdate()) and month([schedule_table].[schedule_date]) = 2 and groups = @Group_name
  ) t

 PIVOT (
  max(February)
  FOR [schedule_date]
  IN ( [1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12],[13],[14],[15],[16],[17],[18],[19],[20],[21],[22],[23],[24],[25],[26],[27],[28],[29],[30],[31])

  ) AS PivotTable

   union

  select * from (
SELECT
      schedule_table.[username]
      ,datepart(day,schedule_table.[schedule_date]) [schedule_date]
	  ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
	when [shift_start] = 'OFF' then 'OFF'
	 when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
	when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
	else LEFT([shift_start], 2)

	end as nvarchar) [March]
		,[groups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date
	
	  ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
    left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where year([schedule_table].[schedule_date]) = year(getdate()) and month([schedule_table].[schedule_date]) = 3 and groups = @Group_name
  ) t

 PIVOT (
  max(March)
  FOR [schedule_date]
  IN ( [1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12],[13],[14],[15],[16],[17],[18],[19],[20],[21],[22],[23],[24],[25],[26],[27],[28],[29],[30],[31])

  ) AS PivotTable

   union

  select * from (
SELECT
      schedule_table.[username]
      ,datepart(day,schedule_table.[schedule_date]) [schedule_date]
	  ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
	when [shift_start] = 'OFF' then 'OFF'
	 when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
	when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
	else LEFT([shift_start], 2)

	end as nvarchar) [April]
		,[groups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date
	
	  ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
    left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where year([schedule_table].[schedule_date]) = year(getdate()) and month([schedule_table].[schedule_date]) = 4 and groups = @Group_name
  ) t

 PIVOT (
  max(April)
  FOR [schedule_date]
  IN ( [1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12],[13],[14],[15],[16],[17],[18],[19],[20],[21],[22],[23],[24],[25],[26],[27],[28],[29],[30],[31])

  ) AS PivotTable

   union

  select * from (
SELECT
      schedule_table.[username]
      ,datepart(day,schedule_table.[schedule_date]) [schedule_date]
	  ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
	when [shift_start] = 'OFF' then 'OFF'
	 when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
	when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
	else LEFT([shift_start], 2)

	end as nvarchar) [May]
		,[groups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date
	
	  ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
    left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where year([schedule_table].[schedule_date]) = year(getdate()) and month([schedule_table].[schedule_date]) = 5 and groups = @Group_name
  ) t

 PIVOT (
  max(May)
  FOR [schedule_date]
  IN ( [1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12],[13],[14],[15],[16],[17],[18],[19],[20],[21],[22],[23],[24],[25],[26],[27],[28],[29],[30],[31])

  ) AS PivotTable

   union

  select * from (
SELECT
      schedule_table.[username]
      ,datepart(day,schedule_table.[schedule_date]) [schedule_date]
	  ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
	when [shift_start] = 'OFF' then 'OFF'
	 when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
	when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
	else LEFT([shift_start], 2)

	end as nvarchar) [June]
		,[groups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date
	
	  ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
    left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where year([schedule_table].[schedule_date]) = year(getdate()) and month([schedule_table].[schedule_date]) = 6 and groups = @Group_name
  ) t

 PIVOT (
  max(June)
  FOR [schedule_date]
  IN ( [1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12],[13],[14],[15],[16],[17],[18],[19],[20],[21],[22],[23],[24],[25],[26],[27],[28],[29],[30],[31])

  ) AS PivotTable

   union

  select * from (
SELECT
      schedule_table.[username]
      ,datepart(day,schedule_table.[schedule_date]) [schedule_date]
	  ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
	when [shift_start] = 'OFF' then 'OFF'
	 when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
	when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
	else LEFT([shift_start], 2)

	end as nvarchar) [July]
		,[groups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date
	
	  ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
    left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where year([schedule_table].[schedule_date]) = year(getdate()) and month([schedule_table].[schedule_date]) = 7 and groups = @Group_name
  ) t

 PIVOT (
  max(July)
  FOR [schedule_date]
  IN ( [1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12],[13],[14],[15],[16],[17],[18],[19],[20],[21],[22],[23],[24],[25],[26],[27],[28],[29],[30],[31])

  ) AS PivotTable

   union

  select * from (
SELECT
      schedule_table.[username]
      ,datepart(day,schedule_table.[schedule_date]) [schedule_date]
	  ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
	when [shift_start] = 'OFF' then 'OFF'
	 when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
	when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
	else LEFT([shift_start], 2)

	end as nvarchar) [August]
		,[groups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date
	
	  ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
    left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where year([schedule_table].[schedule_date]) = year(getdate()) and month([schedule_table].[schedule_date]) = 8 and groups = @Group_name
  ) t

 PIVOT (
  max(August)
  FOR [schedule_date]
  IN ( [1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12],[13],[14],[15],[16],[17],[18],[19],[20],[21],[22],[23],[24],[25],[26],[27],[28],[29],[30],[31])

  ) AS PivotTable

   union

  select * from (
SELECT
      schedule_table.[username]
      ,datepart(day,schedule_table.[schedule_date]) [schedule_date]
	  ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
	when [shift_start] = 'OFF' then 'OFF'
	 when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
	when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
	else LEFT([shift_start], 2)

	end as nvarchar) [September]
		,[groups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date
	
	  ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
    left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where year([schedule_table].[schedule_date]) = year(getdate()) and month([schedule_table].[schedule_date]) = 9 and groups = @Group_name
  ) t

 PIVOT (
  max(September)
  FOR [schedule_date]
  IN ( [1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12],[13],[14],[15],[16],[17],[18],[19],[20],[21],[22],[23],[24],[25],[26],[27],[28],[29],[30],[31])

  ) AS PivotTable

   union

  select * from (
SELECT
      schedule_table.[username]
      ,datepart(day,schedule_table.[schedule_date]) [schedule_date]
	  ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
	when [shift_start] = 'OFF' then 'OFF'
	 when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
	when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
	else LEFT([shift_start], 2)

	end as nvarchar) [October]
		,[groups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date
	
	  ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
    left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where year([schedule_table].[schedule_date]) = year(getdate()) and month([schedule_table].[schedule_date]) = 10 and groups = @Group_name
  ) t

 PIVOT (
  max(October)
  FOR [schedule_date]
  IN ( [1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12],[13],[14],[15],[16],[17],[18],[19],[20],[21],[22],[23],[24],[25],[26],[27],[28],[29],[30],[31])

  ) AS PivotTable

   union

  select * from (
SELECT
      schedule_table.[username]
      ,datepart(day,schedule_table.[schedule_date]) [schedule_date]
	  ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
	when [shift_start] = 'OFF' then 'OFF'
	 when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
	when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
	else LEFT([shift_start], 2)

	end as nvarchar) [November]
		,[groups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date
	
	  ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
    left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where year([schedule_table].[schedule_date]) = year(getdate()) and month([schedule_table].[schedule_date]) = 11 and groups = @Group_name
  ) t

 PIVOT (
  max(November)
  FOR [schedule_date]
  IN ( [1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12],[13],[14],[15],[16],[17],[18],[19],[20],[21],[22],[23],[24],[25],[26],[27],[28],[29],[30],[31])

  ) AS PivotTable


   union

  select * from (
SELECT
      schedule_table.[username]
      ,datepart(day,schedule_table.[schedule_date]) [schedule_date]
	  ,datename(mm,schedule_table.[schedule_date]) [month]
     ,cast(case
	when [shift_start] = 'OFF' then 'OFF'
	 when cast([type] as nvarchar) is not null then cast([type] as nvarchar)
	when  SUBSTRING([shift_start], 2, 1) = ':' then LEFT([shift_start], 1)
	else LEFT([shift_start], 2)

	end as nvarchar) [December]
		,[groups]
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join (
SELECT 
      [leaves].[username]
      ,schedule_date
	
	  ,[type]
  FROM [Aya_Web_APP].[dbo].[leaves]
   join [Aya_Web_APP].dbo.schedule_table 
  on schedule_table.username = [leaves].username and schedule_date between adate and bdate
  where [status] = 'E-workforce and senior approve' and year([adate]) = year(getdate()) 
  and [leaves].[type] in ('Paternity Leave','Pilgrimage Leave','Annual Leave','Unpaid Leave','Sick Leave','Compassionate leave','Maternity Leave','Instead of(HR)','official mission') ) 
  x on x.username =schedule_table.username and x.schedule_date = schedule_table.schedule_date
    left join [Employess_DB].[dbo].[tbl_Personal_info] on [tbl_Personal_info].username = [schedule_table].username
  left join [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
  where year([schedule_table].[schedule_date]) = year(getdate()) and month([schedule_table].[schedule_date]) = 12 and groups = @Group_name
  ) t

 PIVOT (
  max(December)
  FOR [schedule_date]
  IN ( [1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11],[12],[13],[14],[15],[16],[17],[18],[19],[20],[21],[22],[23],[24],[25],[26],[27],[28],[29],[30],[31])

  ) AS PivotTable  ");


  while( $output_query2 = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .='<td >'.$output_query2["username"].'</td>';
$rows .='<td >'.$output_query2["month"].'</td>';
$rows .='<td class="hovers">'.$output_query2["1"].'</td>';
$rows .='<td class="hovers">'.$output_query2["2"].'</td>';
$rows .='<td class="hovers">'.$output_query2["3"].'</td>';
$rows .='<td class="hovers">'.$output_query2["4"].'</td>';
$rows .='<td class="hovers">'.$output_query2["5"].'</td>';
$rows .='<td class="hovers">'.$output_query2["6"].'</td>';
$rows .='<td class="hovers">'.$output_query2["7"].'</td>';
$rows .='<td class="hovers">'.$output_query2["8"].'</td>';
$rows .='<td class="hovers">'.$output_query2["9"].'</td>';
$rows .='<td class="hovers">'.$output_query2["10"].'</td>';
$rows .='<td class="hovers">'.$output_query2["11"].'</td>';
$rows .='<td class="hovers">'.$output_query2["12"].'</td>';
$rows .='<td class="hovers">'.$output_query2["13"].'</td>';
$rows .='<td class="hovers">'.$output_query2["14"].'</td>';
$rows .='<td class="hovers">'.$output_query2["15"].'</td>';
$rows .='<td class="hovers">'.$output_query2["16"].'</td>';
$rows .='<td class="hovers">'.$output_query2["17"].'</td>';
$rows .='<td class="hovers">'.$output_query2["18"].'</td>';
$rows .='<td class="hovers">'.$output_query2["19"].'</td>';
$rows .='<td class="hovers">'.$output_query2["20"].'</td>';
$rows .='<td class="hovers">'.$output_query2["21"].'</td>';
$rows .='<td class="hovers">'.$output_query2["22"].'</td>';
$rows .='<td class="hovers">'.$output_query2["23"].'</td>';
$rows .='<td class="hovers">'.$output_query2["24"].'</td>';
$rows .='<td class="hovers">'.$output_query2["25"].'</td>';
$rows .='<td class="hovers">'.$output_query2["26"].'</td>';
$rows .='<td class="hovers">'.$output_query2["27"].'</td>';
$rows .='<td class="hovers">'.$output_query2["28"].'</td>';
$rows .='<td class="hovers">'.$output_query2["29"].'</td>';
$rows .='<td class="hovers">'.$output_query2["30"].'</td>';
$rows .='<td class="hovers">'.$output_query2["31"].'</td>';
		  	$rows .= '</tr>';
		  	echo $rows;

}

?>

      <!--tr>
        <td>Alan Brisingamen</td>
        <td>Alderley</td>
        <td>Cheshire</td>
        <td>352</td>
        <td>Arcanist</td>
        <td>A pile of gems</td>
        <td>Single</td>
        <td>0</td>
      </tr-->
   </tbody>
        </table>
    </div>
    <script type="text/javascript">
  var parentWidth = $('.fixedParent').width();

   $(document).ready(function () {
            $('tbody').scroll(function (e) {
            $('thead').width(parentWidth);
            $('tbody').width(parentWidth);
                $('tbody td:nth-child(1)').css("z-index", "1");
                $('tbody td:nth-child(2)').css("z-index", "1");

                $('thead').css("left", -$("tbody").scrollLeft());
                $('thead th:nth-child(1)').css("left", $("tbody").scrollLeft());
                $('tbody td:nth-child(1)').css("left", $("tbody").scrollLeft());

                $('thead th:nth-child(2)').css("left", $("tbody").scrollLeft());
                $('tbody td:nth-child(2)').css("left", $("tbody").scrollLeft());
            });

        });
      
    </script>


<script src="table-filter.js"></script>

	<?php
 include ("footer.html");
 ?>
