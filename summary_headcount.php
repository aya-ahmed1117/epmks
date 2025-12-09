
 <?php
include ("pages.php");
      $usernames="";
      if(isset($_POST['username'])){$usernames = $_POST['username'];}
      $ticket_group="";
      if(isset($_POST['ticket_group'])){$ticket_group = $_POST['ticket_group'];}
    $DBhost = "172.29.29.76";
    $DBuser = "Seniors";
    $DBpass = "123456789";
    $DBname = "Employess_DB";
    $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
    $con1 = sqlsrv_connect($DBhost, $connectionInfo);
      ?>
<title>Resignation Data</title>
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

     <style type="text/css">
   
.tableFixHead         
 { 
  overflow-y: auto; height:auto; overflow-x: auto; width:100%;
 }
.tableFixHead thead th 
{ 
  position: sticky; top: 0; 
}
   </style>


 <div style="padding: 20px;">

   <form method="post" >
  <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
            <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Resignation Data
      <a href="Daily_reports.php">
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
    
 <div class="form-group">
     <label  style=" font-weight: bold;font-size: 20px;" >Summary <spam style="color: orange;">Headcount
           </spam></label>
</div>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead >
    <tr>
  		<th colspan="2"></th>
  		<th colspan="2" style="font-size:15px;"><center>Resignation</center></th>
  		<th colspan="2" style="font-size:15px;"><center>Promotion</center></th>

  	</tr>
    <tr>
        <th><center>Year</center> </th>
        <th><center>Number of transfer to staff</center></th>
        <th ><center>Outsource</center></th>
        <th ><center>staff </center></th>
        <th><center>Promotion_l7 </center></th>
        <th ><center>Promotion_l6 </center></th>
    </tr>
    </thead>
  <tbody>

<?php
if ($_SESSION['role_id'] == 1)  {
   $new_query = sqlsrv_query( $con1 , "with [x1] as (SELECT  count([ID]) Promotion_l7
      ,year([Senior_Promotion]) [year]
     
  FROM [Employess_DB].[dbo].[Tbl_Promotions_duration]
  --where year([Senior_Promotion]) in (2021,2020,2019,2018)
  group by  year([Senior_Promotion])),

  
[x2] as( SELECT  count([ID]) Promotion_l6
     ,year([Supervisor_Promotion] ) [year]
     
  FROM [Employess_DB].[dbo].[Tbl_Promotions_duration]
  --where year([Supervisor_Promotion]) in (2021,2020,2019,2018)
  group by  year([Supervisor_Promotion])),

  [x3] as (select x1.[year] 
       ,[promotion_l7]
       ,[Promotion_l6]
       from [x1]
       left join [x2] on [x1].[year]=[x2].[year]),

       [x4] as (select * from (SELECT
         year(Last_working_day) [Year]
          ,[Employee_Type]
          ,count([Employee_ID]) num

   
  FROM [Employess_DB].[dbo].[Resignation_Table]
  where [Status] = 'Confirmed' 

  group by [Employee_Type]
         ,year(Last_working_day) ) t

         PIVOT(
    sum(num) 
    FOR [Employee_Type] IN (
        [Outsource], 
        [staff])
) AS pivot_table) ,
[x5] as (select [x4].[year]
       ,Outsource
       ,staff
       ,[x3].Promotion_l7
       ,[x3].Promotion_l6

from [x4]
left join [x3] on [x3].[year]=[x4].[Year]),
[x6]as (SELECT year([Outsource-Staff].[Effectivity date]) [year]
,
count([Employee ID]) number_of_transfer_to_staff

  FROM [Employess_DB].[dbo].[Outsource-Staff]
  group by year([Effectivity date]))

select [x6].[year]
  ,[number_of_transfer_to_staff]
  ,Outsource
  ,staff
  ,Promotion_l7
  ,Promotion_l6
from [x6]
  left join [x5] on x5.[Year]=[x6].[year]");

      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['year'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['number_of_transfer_to_staff'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Outsource'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['staff'].'</center></td>';
$rows .='<td style="font-size:15px ;color:white; border: 1px solid #000000;background-color:#6b5b95;width:2%;"><center>'.$echo['Promotion_l7'].'</center></td>';
$rows .='<td style="font-size:15px ;color:white; border: 1px solid #000000;background-color:#6b5b95;width:2%;"><center>'.$echo['Promotion_l6'].'</center></td>';
        $rows .= '</tr>';
        echo $rows;
}}
?>
</tbody>
</table>
</div>

 <div class="form-group">
     <label  style=" font-weight: bold;font-size: 20px;" >Current <spam style="color: orange;">Headcount
           </spam></label>
</div>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter2" data-tables="order-table2" placeholder="Filter">

<div class="tableFixHead">

<table class="table table-hover order-table2"  cellspacing="0" id="tblCustomers" >
  <thead  style="background-color:rgb(120, 120, 120); color: white; font-weight: bold;">
    <tr>
        <th><center>HeadCount</center> </th>
        <th><center>Current</center></th>
        <th ><center>Needed</center></th>
        <th ><center>Remaning </center></th>
    </tr>
    </thead>

  <tbody>

<?php
if ($_SESSION['role_id'] == 1)  {
   $new_query = sqlsrv_query( $con1 , "with HC as (
SELECT  'Current outsource' [needs],count([ID]) num
     
  FROM [Employess_DB].[dbo].[tbl_Personal_info]
  where Employee_Status <> 'resigned'  and Employee_Type = 'Outsource' and ( Unit in ( 11,12,13,14,15,16,17,18) or (note like 'lo%'))

  union

  SELECT  'Current Staff' [needs],count([ID]) num
     
  FROM [Employess_DB].[dbo].[tbl_Personal_info]
  where Employee_Status <> 'resigned'  and Employee_Type = 'Staff' and (Unit in ( 11,12,13,14,15,16,17,18) or (note like 'lo%'))
  )

  select needs [Head_Count],num [Current],
  case
  when needs = 'Current outsource' then 184
when needs = 'Current Staff' then 259
end Needed
, case
  when needs = 'Current outsource' then 184 - num
when needs = 'Current Staff' then 259 - num
end Remaning
  from HC
  union
  select 'Training',count([ID]) num,0,0
  from [Employess_DB].[dbo].[Training]
where status='Training'");

      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Head_Count'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Current'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Needed'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Remaning'].'</center></td>';
        $rows .= '</tr>';
        echo $rows;


}}
?>
</tbody>
</table>
</div>


 <div class="form-group">
     <label  style=" font-weight: bold;font-size: 20px;" >Headcount  <spam style="color: orange;">per SD
           </spam></label>
</div>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter3" data-tables="order-table3" placeholder="Filter">

<div class="tableFixHead">

<table class="table table-hover order-table3"  cellspacing="0" id="tblCustomers" >
  <thead  style="background-color:rgb(120, 120, 120); color: white; font-weight: bold;">
    <tr>
 
 <th ><center>grade</center> </th>

 <th >
  <center>Employee_Type</center></th>

<th ><center>Banking</center></th>
  
<th ><center> BS</center></th>

<th ><center> GDS(Global Partner)</center></th>


<th ><center>GOV </center></th>

<th ><center>Mega Projects </center></th>

<th ><center>Private KAM </center></th>

<th ><center> Private KAM & GDS ( Global partner )</center></th>
    </tr>
    </thead>

  <tbody>

<?php
if ($_SESSION['role_id'] == 1)  {
   $new_query = sqlsrv_query( $con1 , "with X2 AS (SELECT 
        [grade]
       ,[Employee_Type]
     ,Groups
       ,ID
FROM [Employess_DB].[dbo].[tbl_Personal_info]
  left join [Employess_DB].[dbo].[Tbl_Units] on Unit =  [Employess_DB].[dbo].[Tbl_Units].Units_ID 
  left join [Employess_DB].[dbo].[Tbl_Groups] on [Group] = [Employess_DB].[dbo].[Tbl_Groups].Group_ID
  left join [Employess_DB].[dbo].[Tbl_departments] on [Employess_DB].[dbo].[tbl_Personal_info].[Department] = [Employess_DB].[dbo].[Tbl_departments].Department_ID
WHERE unit IN (12,13,14,15,16,17,18) AND Employee_Status <> 'Resigned'
)
SELECT * FROM (
        SELECT * FROM X2) T
        PIVOT ( COUNT(ID)
         FOR groups IN (
        [Banking], 
        [BS], 
        [GDS(Global Partner)], 
        [GOV], 
        [Mega Projects], 
        [Private KAM],
        [Private KAM & GDS ( Global partner )])
) AS pivot_table
          
    ORDER BY 1");

      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['grade'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Employee_Type'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Banking'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['BS'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['GDS(Global Partner)'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['GOV'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Mega Projects'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Private KAM'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Private KAM & GDS ( Global partner )'].'</center></td>';
        $rows .= '</tr>';
        echo $rows;


}}
?>
</tbody>
</table>
</div>

<div class="form-group">
     <label  style=" font-weight: bold;font-size: 20px;" >Headcount  <spam style="color: orange;">Per Onsite
           </spam></label>
</div>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter4" data-tables="order-table4" placeholder="Filter">

<div class="tableFixHead">

<table class="table table-hover order-table4"  cellspacing="0" id="tblCustomers" >
  <thead  style="background-color:rgb(120, 120, 120); color: white; font-weight: bold;">
    <tr>
 
 <th><center>grade</center> </th>
 <th><center>Employee_Type</center></th>
<th ><center> Admin</center></th>
<th ><center>Fiber</center></th>
<th ><center>Local Loop </center></th>
<th ><center>Msan</center></th>
<th ><center>Unmanaged</center></th>
<th ><center>WiMax + 3G or 4G</center></th>
    </tr>
    </thead>

  <tbody>

<?php
if ($_SESSION['role_id'] == 1)  {
   $new_query = sqlsrv_query( $con1 , "with X2 AS (SELECT 
        [grade]
       ,[Employee_Type]
     ,Groups
       ,ID
FROM [Employess_DB].[dbo].[tbl_Personal_info]
  left join [Employess_DB].[dbo].[Tbl_Units] on Unit =  [Employess_DB].[dbo].[Tbl_Units].Units_ID 
  left join [Employess_DB].[dbo].[Tbl_Groups] on [Group] = [Employess_DB].[dbo].[Tbl_Groups].Group_ID
  left join [Employess_DB].[dbo].[Tbl_departments] on [Employess_DB].[dbo].[tbl_Personal_info].[Department] = [Employess_DB].[dbo].[Tbl_departments].Department_ID

WHERE unit IN (12,13,14,15,16,17,18) AND Employee_Status <> 'Resigned'
)
SELECT * FROM (
        SELECT * FROM X2) T
        PIVOT ( COUNT(ID)
         FOR groups IN (
         
        [Admin], 
        [Fiber], 
        [Local Loop
], 
        [Msan
], 
        [Unmanaged], 
        [WiMax + 3G or 4G])
) AS pivot_table
          
    ORDER BY 1");

      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['grade'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Employee_Type'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Admin'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Fiber'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Local Loop
'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Msan
'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Unmanaged'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['WiMax + 3G or 4G'].'</center></td>';
        $rows .= '</tr>';
        echo $rows;


}}
?>
</tbody>
</table>
</div>
     <label  style=" font-weight: bold;font-size: 20px;" >Headcount  <spam style="color: orange;">Per Optimization
           </spam></label>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter5" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead >
    <tr>
        <th><center>grade</center> </th>
        <th ><center>Employee_Type</center></th>
        <th ><center> Eplanning</center></th>
        <th ><center>ESLM</center></th>
        <th ><center>SOC</center></th>
    </tr>
    </thead>

  <tbody>

<?php
if ($_SESSION['role_id'] == 1)  {
   $new_query = sqlsrv_query( $con1 , "with X2 AS (SELECT 
    [grade]
    ,[Employee_Type]
    ,Groups
    ,ID
FROM [Employess_DB].[dbo].[tbl_Personal_info]
  left join [Employess_DB].[dbo].[Tbl_Units] on Unit =  [Employess_DB].[dbo].[Tbl_Units].Units_ID 
  left join [Employess_DB].[dbo].[Tbl_Groups] on [Group] = [Employess_DB].[dbo].[Tbl_Groups].Group_ID
  left join [Employess_DB].[dbo].[Tbl_departments] on [Employess_DB].[dbo].[tbl_Personal_info].[Department] = [Employess_DB].[dbo].[Tbl_departments].Department_ID

WHERE unit IN (12,13,14,15,16,17,18) AND Employee_Status <> 'Resigned'

)
SELECT * FROM (
        SELECT * FROM X2) T
        PIVOT ( COUNT(ID)
         FOR groups IN (        
        [Eplanning
], 
        [ESLM], 
        [SOC
])
) AS pivot_table
          
    ORDER BY 1");

      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['grade'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Employee_Type'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Eplanning
'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['ESLM'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['SOC
'].'</center></td>';

        $rows .= '</tr>';
        echo $rows;


}}
?>
</tbody>
</table>
</div>

     <label  style=" font-weight: bold;font-size: 20px;" >Headcount  <spam style="color: orange;">Per Units
           </spam></label>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter6" data-table="order-table" placeholder="Filter"/>
    <br>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead >
    <tr>
 <th><center>grade</center> </th>
<th><center>Employee_Type</center></th>
<th ><center>Enterprise Service Desk</center></th>
<th ><center> Onsite Problem Management</center></th>
<th ><center>Problem Management and Service Optimization</center></th>
<th ><center>Enterprise Support Systems </center></th>
<th ><center>Quality Management and Training</center></th>
<th ><center>Workforce Management</center></th>
<th ><center>Planning and Performance Unit To Director</center></th>
    </tr>
    </thead>

  <tbody>

<?php
if ($_SESSION['role_id'] == 1)  {
   $new_query = sqlsrv_query( $con1 , "with X2 AS (SELECT 
        [grade]
       ,[Employee_Type]
       ,[Units]
       ,ID
FROM [Employess_DB].[dbo].[tbl_Personal_info]
  left join [Employess_DB].[dbo].[Tbl_Units] on Unit =  [Employess_DB].[dbo].[Tbl_Units].Units_ID 
  left join [Employess_DB].[dbo].[Tbl_Groups] on [Group] = [Employess_DB].[dbo].[Tbl_Groups].Group_ID
  left join [Employess_DB].[dbo].[Tbl_departments] on [Employess_DB].[dbo].[tbl_Personal_info].[Department] = [Employess_DB].[dbo].[Tbl_departments].Department_ID

WHERE unit IN (12,13,14,15,16,17,18) AND Employee_Status <> 'Resigned'

)
SELECT * FROM (
        SELECT * FROM X2) T
        PIVOT ( COUNT(ID)
         FOR units IN (
        [Enterprise Service Desk], 
        [Onsite Problem Management], 
        [Problem Management and Service Optimization], 
        [Enterprise Support Systems], 
        [Quality Management and Training], 
        [Workforce Management], 
        [Planning and Performance Unit To Director])
) AS pivot_table
    ORDER BY 1");

      while($echo = sqlsrv_fetch_array($new_query) ){

         $rows = '<tr>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['grade'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Employee_Type'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Enterprise Service Desk'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Onsite Problem Management'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Problem Management and Service Optimization'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Enterprise Support Systems'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Quality Management and Training'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Workforce Management'].'</center></td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;"><center>'.$echo['Planning and Performance Unit To Director'].'</center></td>';
        $rows .= '</tr>';
        echo $rows;


}}
?>
</tbody>
</table>
</div>
<script type='text/javascript'>
  
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
      Arr.forEach.call(tables, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);

///////
 
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables2 = document.getElementsByClassName(_input.getAttribute('data-tables'));
      Arr.forEach.call(tables2, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter2');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);
  
  ///////
 
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables2 = document.getElementsByClassName(_input.getAttribute('data-tables'));
      Arr.forEach.call(tables2, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter3');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);

///////
 
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables2 = document.getElementsByClassName(_input.getAttribute('data-tables'));
      Arr.forEach.call(tables2, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter4');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);

///////
 
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables2 = document.getElementsByClassName(_input.getAttribute('data-tables'));
      Arr.forEach.call(tables2, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter5');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);

///////
 
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables2 = document.getElementsByClassName(_input.getAttribute('data-tables'));
      Arr.forEach.call(tables2, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter6');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);
</script>
<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Headcount.xls"
            });
        }
    </script>
 </form>

</div>
<script src="js/table2excel.js" type="text/javascript"></script>

<?php
 include ("footer.html");
 ?>


