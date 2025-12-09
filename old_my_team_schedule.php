
<?php
include ("pages.php");
?>

	<title>Team Schedule</title>
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fixed_s/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="fixed_s/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="fixed_s/vendor/perfect-scrollbar/perfect-scrollbar.css">
  
</thead>

<style type="text/css">
.hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
 .tableFixHead .column1{
   font-size:14px;
   background-color:#55608f;
   color: white;
 }

.tableFixHead         
 { 
 	overflow-y: auto; height:400px; overflow-x: auto; 
    background-color: #fff;
 }
.tableFixHead thead th 
{ 
	position: sticky; top: 0; 

}
      .tableFixHead tbody  td:nth-child(1)
{ 
    position: sticky; 
    width: 100px;
    background: #fff;
    /*border: 1px solid gray;*/
    left: 0;

}

  .tableFixHead tbody  td:nth-child(2)
{ 
    position: sticky; 
    width: 100px;
    background: #eee;
    /*border: 1px solid gray;*/
   

}
.tableFixHead thead th:nth-child(1)
{ 
    position: sticky;
    left: 0;
    z-index: 10;
    width: 100px;
    background: #55608f;  
}
.tableFixHead thead th:nth-child(2)
{ 
    z-index: 10;
    position: sticky; 
    width: 100px;
    background: #55608f;
}
/*

.tableFixHead tbody  td:nth-child(2) {
    background-color: #99a;
    position: unset;
    border: 1px solid gray; 
    left: 0;

}


.tableFixHead thead th:nth-child(2)
{ 
    position: sticky;
    left: 7%;
    z-index: 10;
}
*/
 tr:nth-child(even) {
  background-color: #e9ecef;
}
  </style>
<style type="text/css">
.scroller {
  max-width: 100px;
  overflow: auto;
}

table, table * {
  box-sizing: border-box;
  }
/*
table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
}*/

th {
  text-align: center;
  white-space: nowrap;
  text-overflow: ellipsis;
    font-size: 18px;
    color: #fff;
    line-height: 1.4;
}

/* borders should be on th/td so the table can collapse them */
th, td {
    border-top: 1px solid lightgray;
    padding: 0; /* Default padding should be removed */
    white-space: nowrap;
    text-overflow: ellipsis;
    font-size: 15px;
    text-align: center;
    /* color: #808080; */
    line-height: 1.4;
    padding-top: 10px;
    padding-bottom: 10px;
}

/* padding, overflow ellipses etc behaves better if
   content is wrapped in an inner element */
.inner-cell {
    background: #55608f;
    padding: 5px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    width: auto;
    color: #fff;
    font-size: 15px;
    text-align: center;
    /* color: #808080; */
    line-height: 1.4;
}

.sticky {
  position: sticky;
  width: 100px;
  left: 0;

}
.sticky-2 {
    left: 12em;
    width: 100px;
    padding: 15px;
    background-color: #55608f;
}
.sticky-3 {
  left: 11em;
}
/* Behaves better if width is set on inner el (or it moves 1px when scrolling) */
.sticky .inner-cell {
  width: 11em;
}



</style>

<center>
  
<div class="col-md-9">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >My Team Schedule</h2>
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Shows you team Sch time and leaves</p>
  </aside>
</div>
</center>

<center>
<div class="col-md-8">
	<h2 style="color:; ">Table Filter</h2>
        <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">
<br>
<br>
<div class="tableFixHead" style="border-radius: 20px 20px 20px 20px;">
	<table class="table order-table">
      <thead>
       <tr>
    <!-- rowspan="1" style="font-size: 14px;background-color:#002060;color:#eee;" -->
        <th class="sticky sticky-1"><div class="inner-cell">Username</div></th>
        <th class="sticky sticky-2"><div class="inner-cell">Month</div></th>
        <th  class="column1"><center>1 </center></th>
        <th  class="column1"><center>2 </center></th>
        <th class="column1"><center>3</center></th>
        <th class="column1"><center>4</center></th>
        <th class="column1"><center>5</center></th>
        <th class="column1"><center>6</center></th>
        <th class="column1"><center>7</center></th>
        <th class="column1">8</th>
        <th class="column1">9</th>
        <th class="column1">10</th>
        <th class="column1">11</th>
        <th class="column1">12</th>
        <th class="column1">13</th>
        <th class="column1">14</th>
        <th class="column1">15</th>
        <th class="column1">16</th>
        <th class="column1">17</th>
        <th class="column1">18</th>
        <th class="column1">19</th>
        <th class="column1">20</th>
        <th class="column1">21</th>
        <th class="column1">22</th>
        <th class="column1">23</th>
        <th class="column1">24</th>
        <th class="column1">25</th>
        <th class="column1">26</th>
        <th class="column1">27</th>
        <th class="column1">28</th>
        <th class="column1">29</th>
        <th class="column1">30</th>
        <th class="column1">31</th>
    
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

$engineer_id = $_SESSION['id'];
$s_username = $_SESSION['username'];
/*
if($role_id == 0){
    $self = $_SESSION['id'];

$check_engineers1 = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id = '$self' ");
     while( $output_engineers = sqlsrv_fetch_array($check_engineers1)){

  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];
  $username_id = $output_engineers['username_id'];
$check_engineers = sqlsrv_query( $con1 ,"SELECT distinct [ID]
      ,[Employee_Name]
      ,[UserName],[Birth_Date],[groups]
 FROM [Employess_DB].[dbo].[tbl_Personal_info] 
 left join  [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
 where [UserName] = '$s_username'  ");
$output_query = sqlsrv_fetch_array($check_engineers);
  $groups = $output_query["groups"];

}

  $user_query = sqlsrv_query( $con ,"EXEC MyTeamSch_junior 
    @groups = '$groups' ");

  
  while( $output_query2 = sqlsrv_fetch_array($user_query)){
$rows  ='<tr class="row100 body">';
$rows .='<td class="sticky sticky-1">'.$output_query2["username"].'</td>';
$rows .='<td class="sticky sticky-2">'.$output_query2["month"].'</td>';
if ($output_query2["1"] == 'Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["1"].'</td>';
}if($output_query2["1"] == 'Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["1"].'</td>';
}
if ($output_query2["1"] == 'Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["1"].'</td>';
}if ($output_query2["1"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["1"].'</td>';
}
elseif(($output_query2["1"] <>'OFF') && ($output_query2["1"] <>'Sick Leave')
&&($output_query2["1"] <>'Official Mission') && ($output_query2["1"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["1"].'</td>';
}
if ($output_query2["2"] == 'Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["2"].'</td>';
}if($output_query2["2"] == 'Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["2"].'</td>';
}
if ($output_query2["2"] == 'Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["2"].'</td>';
}if ($output_query2["2"] == 'OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["2"].'</td>';
}
elseif(($output_query2["2"] <>'OFF') && ($output_query2["2"] <>'Sick Leave')
&&($output_query2["2"] <>'Official Mission') && ($output_query2["2"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["2"].'</td>';
}
//3
if ($output_query2["3"] == 'Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["3"].'</td>';
}if($output_query2["3"] == 'Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["3"].'</td>';
}
if ($output_query2["3"] == 'Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["3"].'</td>';
}if ($output_query2["3"] == 'OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["3"].'</td>';
}
elseif(($output_query2["3"] <>'OFF') && ($output_query2["3"] <>'Sick Leave')
&&($output_query2["3"] <>'Official Mission') && ($output_query2["3"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["3"].'</td>';
}
//4
if ($output_query2["4"] == 'Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["4"].'</td>';
}if($output_query2["4"] == 'Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["4"].'</td>';
}
if ($output_query2["4"] == 'Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["4"].'</td>';
}if ($output_query2["4"] == 'OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["4"].'</td>';
}
elseif(($output_query2["4"] <>'OFF') && ($output_query2["4"] <>'Sick Leave')
&&($output_query2["4"] <>'Official Mission') && ($output_query2["4"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["4"].'</td>';
}
//5
if ($output_query2["5"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["5"].'</td>';
}elseif($output_query2["5"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["5"].'</td>';
}
elseif ($output_query2["5"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["5"].'</td>';
}elseif ($output_query2["5"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["5"].'</td>';
}
elseif(($output_query2["5"] <>'OFF') && ($output_query2["5"] <>'Sick Leave')
&&($output_query2["5"] <>'Official Mission') && ($output_query2["5"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["5"].'</td>';
}
//6
if ($output_query2["6"] == 'Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["6"].'</td>';
}elseif($output_query2["6"] == 'Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["6"].'</td>';
}
elseif ($output_query2["6"] == 'Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["6"].'</td>';
}elseif ($output_query2["6"] == 'OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["6"].'</td>';
}
elseif(($output_query2["6"] <>'OFF') && ($output_query2["6"] <>'Sick Leave')
&&($output_query2["6"] <>'Official Mission') && ($output_query2["6"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["6"].'</td>';
}
//7
if ($output_query2["7"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["7"].'</td>';
}if($output_query2["7"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["7"].'</td>';
}
if ($output_query2["7"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["7"].'</td>';
}if ($output_query2["7"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["7"].'</td>';
}
elseif(($output_query2["7"] <>'OFF') && ($output_query2["7"] <>'Sick Leave')
&&($output_query2["7"] <>'Official Mission') && ($output_query2["7"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["7"].'</td>';
}
//8
if ($output_query2["8"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["8"].'</td>';
}if($output_query2["8"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["8"].'</td>';
}
if ($output_query2["8"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["8"].'</td>';
}if ($output_query2["8"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["8"].'</td>';
}
elseif(($output_query2["8"] <>'OFF') && ($output_query2["8"] <>'Sick Leave')
&&($output_query2["8"] <>'Official Mission') && ($output_query2["8"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["8"].'</td>';
}
//9
if ($output_query2["9"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["9"].'</td>';
}if($output_query2["9"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["9"].'</td>';
}
if ($output_query2["9"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["9"].'</td>';
}if ($output_query2["9"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["9"].'</td>';
}
elseif(($output_query2["9"] <>'OFF') && ($output_query2["9"] <>'Sick Leave')
&&($output_query2["9"] <>'Official Mission') && ($output_query2["9"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["9"].'</td>';
}
//10
if ($output_query2["10"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["10"].'</td>';
}if($output_query2["10"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["10"].'</td>';
}
if ($output_query2["10"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["10"].'</td>';
}if ($output_query2["10"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["10"].'</td>';
}
elseif(($output_query2["10"] <>'OFF') && ($output_query2["10"] <>'Sick Leave')
&&($output_query2["10"] <>'Official Mission') && ($output_query2["10"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["10"].'</td>';
}
//11
if ($output_query2["11"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["11"].'</td>';
}if($output_query2["11"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["11"].'</td>';
}
if ($output_query2["11"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["11"].'</td>';
}if ($output_query2["11"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["11"].'</td>';
}
elseif(($output_query2["11"] <>'OFF') && ($output_query2["11"] <>'Sick Leave')
&&($output_query2["11"] <>'Official Mission') && ($output_query2["11"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["11"].'</td>';
}
//12
if ($output_query2["12"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["12"].'</td>';
}if($output_query2["12"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["12"].'</td>';
}
if ($output_query2["12"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["12"].'</td>';
}if ($output_query2["12"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["12"].'</td>';
}
elseif(($output_query2["12"] <>'OFF') && ($output_query2["12"] <>'Sick Leave')
&&($output_query2["12"] <>'Official Mission') && ($output_query2["12"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["12"].'</td>';
}
//13
if ($output_query2["13"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["13"].'</td>';
}if($output_query2["13"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["13"].'</td>';
}
if ($output_query2["13"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["13"].'</td>';
}if ($output_query2["13"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["13"].'</td>';
}
elseif(($output_query2["13"] <>'OFF') && ($output_query2["13"] <>'Sick Leave')
&&($output_query2["13"] <>'Official Mission') && ($output_query2["13"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["13"].'</td>';
}
//14
if ($output_query2["14"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["14"].'</td>';
}if($output_query2["14"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["14"].'</td>';
}
if ($output_query2["14"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["14"].'</td>';
}if ($output_query2["14"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["14"].'</td>';
}
elseif(($output_query2["14"] <>'OFF') && ($output_query2["14"] <>'Sick Leave')
&&($output_query2["14"] <>'Official Mission') && ($output_query2["14"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["14"].'</td>';
}
//15
if ($output_query2["15"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["15"].'</td>';
}if($output_query2["15"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["15"].'</td>';
}
if ($output_query2["15"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["15"].'</td>';
}if ($output_query2["15"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["15"].'</td>';
}
elseif(($output_query2["15"] <>'OFF') && ($output_query2["15"] <>'Sick Leave')
&&($output_query2["15"] <>'Official Mission') && ($output_query2["15"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["15"].'</td>';
}
//16
if ($output_query2["16"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["16"].'</td>';
}if($output_query2["16"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["16"].'</td>';
}
if ($output_query2["16"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["16"].'</td>';
}if ($output_query2["16"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["16"].'</td>';
}
elseif(($output_query2["16"] <>'OFF') && ($output_query2["16"] <>'Sick Leave')
&&($output_query2["16"] <>'Official Mission') && ($output_query2["16"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["16"].'</td>';
}
//17
if ($output_query2["17"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["17"].'</td>';
}if($output_query2["17"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["17"].'</td>';
}
if ($output_query2["17"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["17"].'</td>';
}if ($output_query2["17"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["17"].'</td>';
}
elseif(($output_query2["17"] <>'OFF') && ($output_query2["17"] <>'Sick Leave')
&&($output_query2["17"] <>'Official Mission') && ($output_query2["17"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["17"].'</td>';
}
//18
if ($output_query2["18"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["18"].'</td>';
}if($output_query2["18"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["18"].'</td>';
}
if ($output_query2["18"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["18"].'</td>';
}if ($output_query2["18"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["18"].'</td>';
}
elseif(($output_query2["18"] <>'OFF') && ($output_query2["18"] <>'Sick Leave')
&&($output_query2["18"] <>'Official Mission') && ($output_query2["18"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["18"].'</td>';
}
//19
if ($output_query2["19"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["19"].'</td>';
}if($output_query2["19"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["19"].'</td>';
}
if ($output_query2["19"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["19"].'</td>';
}if ($output_query2["19"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["19"].'</td>';
}
elseif(($output_query2["19"] <>'OFF') && ($output_query2["19"] <>'Sick Leave')
&&($output_query2["19"] <>'Official Mission') && ($output_query2["19"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["19"].'</td>';
}
//20
if ($output_query2["20"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["20"].'</td>';
}if($output_query2["20"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["20"].'</td>';
}
if ($output_query2["20"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["20"].'</td>';
}if ($output_query2["20"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["20"].'</td>';
}
elseif(($output_query2["20"] <>'OFF') && ($output_query2["20"] <>'Sick Leave')
&&($output_query2["20"] <>'Official Mission') && ($output_query2["20"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["20"].'</td>';
}
//21
if ($output_query2["21"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["21"].'</td>';
}if($output_query2["21"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["21"].'</td>';
}
if ($output_query2["21"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["21"].'</td>';
}if ($output_query2["21"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["21"].'</td>';
}
elseif(($output_query2["21"] <>'OFF') && ($output_query2["21"] <>'Sick Leave')
&&($output_query2["21"] <>'Official Mission') && ($output_query2["21"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["21"].'</td>';
}
//22
if ($output_query2["22"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["22"].'</td>';
}if($output_query2["22"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["22"].'</td>';
}
if ($output_query2["22"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["22"].'</td>';
}if ($output_query2["22"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["22"].'</td>';
}
elseif(($output_query2["22"] <>'OFF') && ($output_query2["22"] <>'Sick Leave')
&&($output_query2["22"] <>'Official Mission') && ($output_query2["22"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["22"].'</td>';
}
//23
if ($output_query2["23"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["23"].'</td>';
}if($output_query2["23"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["23"].'</td>';
}
if ($output_query2["23"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["23"].'</td>';
}if ($output_query2["23"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["23"].'</td>';
}
elseif(($output_query2["23"] <>'OFF') && ($output_query2["23"] <>'Sick Leave')
&&($output_query2["23"] <>'Official Mission') && ($output_query2["23"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["23"].'</td>';
}
//24
if ($output_query2["24"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["24"].'</td>';
}if($output_query2["24"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["24"].'</td>';
}
if ($output_query2["24"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["24"].'</td>';
}if ($output_query2["24"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["24"].'</td>';
}
elseif(($output_query2["24"] <>'OFF') && ($output_query2["24"] <>'Sick Leave')
&&($output_query2["24"] <>'Official Mission') && ($output_query2["24"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["24"].'</td>';
}
//25
if ($output_query2["25"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["25"].'</td>';
}if($output_query2["25"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["25"].'</td>';
}
if ($output_query2["25"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["25"].'</td>';
}if ($output_query2["25"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["25"].'</td>';
}
elseif(($output_query2["25"] <>'OFF') && ($output_query2["25"] <>'Sick Leave')
&&($output_query2["25"] <>'Official Mission') && ($output_query2["25"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["25"].'</td>';
}
//26
if ($output_query2["26"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["26"].'</td>';
}if($output_query2["26"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["26"].'</td>';
}
if ($output_query2["26"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["26"].'</td>';
}if ($output_query2["26"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["26"].'</td>';
}
elseif(($output_query2["26"] <>'OFF') && ($output_query2["26"] <>'Sick Leave')
&&($output_query2["26"] <>'Official Mission') && ($output_query2["26"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["26"].'</td>';
}
//27
if ($output_query2["27"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["27"].'</td>';
}if($output_query2["27"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["27"].'</td>';
}
if ($output_query2["27"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["27"].'</td>';
}if ($output_query2["27"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["27"].'</td>';
}
elseif(($output_query2["27"] <>'OFF') && ($output_query2["27"] <>'Sick Leave')
&&($output_query2["27"] <>'Official Mission') && ($output_query2["27"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["27"].'</td>';
}
//28
if ($output_query2["28"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["28"].'</td>';
}if($output_query2["28"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["28"].'</td>';
}
if ($output_query2["28"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["28"].'</td>';
}if ($output_query2["28"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["28"].'</td>';
}
elseif(($output_query2["28"] <>'OFF') && ($output_query2["28"] <>'Sick Leave')
&&($output_query2["28"] <>'Official Mission') && ($output_query2["28"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["28"].'</td>';
}
//29
if ($output_query2["29"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["29"].'</td>';
}if($output_query2["29"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["29"].'</td>';
}
if ($output_query2["29"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["29"].'</td>';
}if ($output_query2["29"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["29"].'</td>';
}
elseif(($output_query2["29"] <>'OFF') && ($output_query2["29"] <>'Sick Leave')
&&($output_query2["29"] <>'Official Mission') && ($output_query2["29"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["29"].'</td>';
}
//30
if ($output_query2["30"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["30"].'</td>';
}if($output_query2["30"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["30"].'</td>';
}
if ($output_query2["30"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["30"].'</td>';
}if ($output_query2["30"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["30"].'</td>';
}
elseif(($output_query2["30"] <>'OFF') && ($output_query2["30"] <>'Sick Leave')
&&($output_query2["30"] <>'Official Mission') && ($output_query2["30"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["30"].'</td>';
}
//31
if ($output_query2["31"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["31"].'</td>';
}if($output_query2["31"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["31"].'</td>';
}
if ($output_query2["31"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["31"].'</td>';
}if ($output_query2["31"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["31"].'</td>';
}
elseif(($output_query2["31"] <>'OFF') && ($output_query2["30"] <>'Sick Leave')
&&($output_query2["31"] <>'Official Mission') && ($output_query2["31"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["31"].'</td>';
}   $rows .= '</tr>';
            echo $rows;

}}*/
if($role_id > 0){
$first_query = sqlsrv_query( $con ,"EXEC MyTeamSch 
    @manager_ID= '$engineer_id'");

  while( $output_query2 = sqlsrv_fetch_array($first_query)){
$rows  ='<tr class="row100 body">';
$rows .='<td class="sticky sticky-1">'.$output_query2["username"].'</td>';
$rows .='<td class="sticky sticky-2">'.$output_query2["month"].'</td>';

if ($output_query2["1"] == 'Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["1"].'</td>';
}if($output_query2["1"] == 'Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["1"].'</td>';
}
if ($output_query2["1"] == 'Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["1"].'</td>';
}if ($output_query2["1"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["1"].'</td>';
}
elseif(($output_query2["1"] <>'OFF') && ($output_query2["1"] <>'Sick Leave')
&&($output_query2["1"] <>'Official Mission') && ($output_query2["1"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["1"].'</td>';
}
if ($output_query2["2"] == 'Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["2"].'</td>';
}if($output_query2["2"] == 'Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["2"].'</td>';
}
if ($output_query2["2"] == 'Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["2"].'</td>';
}if ($output_query2["2"] == 'OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["2"].'</td>';
}
elseif(($output_query2["2"] <>'OFF') && ($output_query2["2"] <>'Sick Leave')
&&($output_query2["2"] <>'Official Mission') && ($output_query2["2"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["2"].'</td>';
}
//3
if ($output_query2["3"] == 'Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["3"].'</td>';
}if($output_query2["3"] == 'Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["3"].'</td>';
}
if ($output_query2["3"] == 'Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["3"].'</td>';
}if ($output_query2["3"] == 'OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["3"].'</td>';
}
elseif(($output_query2["3"] <>'OFF') && ($output_query2["3"] <>'Sick Leave')
&&($output_query2["3"] <>'Official Mission') && ($output_query2["3"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["3"].'</td>';
}
//4
if ($output_query2["4"] == 'Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["4"].'</td>';
}if($output_query2["4"] == 'Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["4"].'</td>';
}
if ($output_query2["4"] == 'Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["4"].'</td>';
}if ($output_query2["4"] == 'OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["4"].'</td>';
}
elseif(($output_query2["4"] <>'OFF') && ($output_query2["4"] <>'Sick Leave')
&&($output_query2["4"] <>'Official Mission') && ($output_query2["4"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["4"].'</td>';
}
//5
if ($output_query2["5"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["5"].'</td>';
}elseif($output_query2["5"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["5"].'</td>';
}
elseif ($output_query2["5"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["5"].'</td>';
}elseif ($output_query2["5"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["5"].'</td>';
}
elseif(($output_query2["5"] <>'OFF') && ($output_query2["5"] <>'Sick Leave')
&&($output_query2["5"] <>'Official Mission') && ($output_query2["5"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["5"].'</td>';
}
//6
if ($output_query2["6"] == 'Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["6"].'</td>';
}elseif($output_query2["6"] == 'Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["6"].'</td>';
}
elseif ($output_query2["6"] == 'Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["6"].'</td>';
}elseif ($output_query2["6"] == 'OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["6"].'</td>';
}
elseif(($output_query2["6"] <>'OFF') && ($output_query2["6"] <>'Sick Leave')
&&($output_query2["6"] <>'Official Mission') && ($output_query2["6"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["6"].'</td>';
}
//7
if ($output_query2["7"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["7"].'</td>';
}if($output_query2["7"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["7"].'</td>';
}
if ($output_query2["7"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["7"].'</td>';
}if ($output_query2["7"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["7"].'</td>';
}
elseif(($output_query2["7"] <>'OFF') && ($output_query2["7"] <>'Sick Leave')
&&($output_query2["7"] <>'Official Mission') && ($output_query2["7"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["7"].'</td>';
}
//8
if ($output_query2["8"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["8"].'</td>';
}if($output_query2["8"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["8"].'</td>';
}
if ($output_query2["8"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["8"].'</td>';
}if ($output_query2["8"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["8"].'</td>';
}
elseif(($output_query2["8"] <>'OFF') && ($output_query2["8"] <>'Sick Leave')
&&($output_query2["8"] <>'Official Mission') && ($output_query2["8"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["8"].'</td>';
}
//9
if ($output_query2["9"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["9"].'</td>';
}if($output_query2["9"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["9"].'</td>';
}
if ($output_query2["9"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["9"].'</td>';
}if ($output_query2["9"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["9"].'</td>';
}
elseif(($output_query2["9"] <>'OFF') && ($output_query2["9"] <>'Sick Leave')
&&($output_query2["9"] <>'Official Mission') && ($output_query2["9"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["9"].'</td>';
}
//10
if ($output_query2["10"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["10"].'</td>';
}if($output_query2["10"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["10"].'</td>';
}
if ($output_query2["10"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["10"].'</td>';
}if ($output_query2["10"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["10"].'</td>';
}
elseif(($output_query2["10"] <>'OFF') && ($output_query2["10"] <>'Sick Leave')
&&($output_query2["10"] <>'Official Mission') && ($output_query2["10"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["10"].'</td>';
}
//11
if ($output_query2["11"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["11"].'</td>';
}if($output_query2["11"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["11"].'</td>';
}
if ($output_query2["11"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["11"].'</td>';
}if ($output_query2["11"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["11"].'</td>';
}
elseif(($output_query2["11"] <>'OFF') && ($output_query2["11"] <>'Sick Leave')
&&($output_query2["11"] <>'Official Mission') && ($output_query2["11"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["11"].'</td>';
}
//12
if ($output_query2["12"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["12"].'</td>';
}if($output_query2["12"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["12"].'</td>';
}
if ($output_query2["12"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["12"].'</td>';
}if ($output_query2["12"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["12"].'</td>';
}
elseif(($output_query2["12"] <>'OFF') && ($output_query2["12"] <>'Sick Leave')
&&($output_query2["12"] <>'Official Mission') && ($output_query2["12"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["12"].'</td>';
}
//13
if ($output_query2["13"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["13"].'</td>';
}if($output_query2["13"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["13"].'</td>';
}
if ($output_query2["13"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["13"].'</td>';
}if ($output_query2["13"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["13"].'</td>';
}
elseif(($output_query2["13"] <>'OFF') && ($output_query2["13"] <>'Sick Leave')
&&($output_query2["13"] <>'Official Mission') && ($output_query2["13"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["13"].'</td>';
}
//14
if ($output_query2["14"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["14"].'</td>';
}if($output_query2["14"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["14"].'</td>';
}
if ($output_query2["14"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["14"].'</td>';
}if ($output_query2["14"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["14"].'</td>';
}
elseif(($output_query2["14"] <>'OFF') && ($output_query2["14"] <>'Sick Leave')
&&($output_query2["14"] <>'Official Mission') && ($output_query2["14"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["14"].'</td>';
}
//15
if ($output_query2["15"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["15"].'</td>';
}if($output_query2["15"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["15"].'</td>';
}
if ($output_query2["15"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["15"].'</td>';
}if ($output_query2["15"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["15"].'</td>';
}
elseif(($output_query2["15"] <>'OFF') && ($output_query2["15"] <>'Sick Leave')
&&($output_query2["15"] <>'Official Mission') && ($output_query2["15"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["15"].'</td>';
}
//16
if ($output_query2["16"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["16"].'</td>';
}if($output_query2["16"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["16"].'</td>';
}
if ($output_query2["16"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["16"].'</td>';
}if ($output_query2["16"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["16"].'</td>';
}
elseif(($output_query2["16"] <>'OFF') && ($output_query2["16"] <>'Sick Leave')
&&($output_query2["16"] <>'Official Mission') && ($output_query2["16"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["16"].'</td>';
}
//17
if ($output_query2["17"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["17"].'</td>';
}if($output_query2["17"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["17"].'</td>';
}
if ($output_query2["17"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["17"].'</td>';
}if ($output_query2["17"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["17"].'</td>';
}
elseif(($output_query2["17"] <>'OFF') && ($output_query2["17"] <>'Sick Leave')
&&($output_query2["17"] <>'Official Mission') && ($output_query2["17"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["17"].'</td>';
}
//18
if ($output_query2["18"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["18"].'</td>';
}if($output_query2["18"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["18"].'</td>';
}
if ($output_query2["18"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["18"].'</td>';
}if ($output_query2["18"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["18"].'</td>';
}
elseif(($output_query2["18"] <>'OFF') && ($output_query2["18"] <>'Sick Leave')
&&($output_query2["18"] <>'Official Mission') && ($output_query2["18"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["18"].'</td>';
}
//19
if ($output_query2["19"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["19"].'</td>';
}if($output_query2["19"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["19"].'</td>';
}
if ($output_query2["19"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["19"].'</td>';
}if ($output_query2["19"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["19"].'</td>';
}
elseif(($output_query2["19"] <>'OFF') && ($output_query2["19"] <>'Sick Leave')
&&($output_query2["19"] <>'Official Mission') && ($output_query2["19"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["19"].'</td>';
}
//20
if ($output_query2["20"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["20"].'</td>';
}if($output_query2["20"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["20"].'</td>';
}
if ($output_query2["20"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["20"].'</td>';
}if ($output_query2["20"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["20"].'</td>';
}
elseif(($output_query2["20"] <>'OFF') && ($output_query2["20"] <>'Sick Leave')
&&($output_query2["20"] <>'Official Mission') && ($output_query2["20"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["20"].'</td>';
}
//21
if ($output_query2["21"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["21"].'</td>';
}if($output_query2["21"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["21"].'</td>';
}
if ($output_query2["21"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["21"].'</td>';
}if ($output_query2["21"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["21"].'</td>';
}
elseif(($output_query2["21"] <>'OFF') && ($output_query2["21"] <>'Sick Leave')
&&($output_query2["21"] <>'Official Mission') && ($output_query2["21"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["21"].'</td>';
}
//22
if ($output_query2["22"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["22"].'</td>';
}if($output_query2["22"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["22"].'</td>';
}
if ($output_query2["22"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["22"].'</td>';
}if ($output_query2["22"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["22"].'</td>';
}
elseif(($output_query2["22"] <>'OFF') && ($output_query2["22"] <>'Sick Leave')
&&($output_query2["22"] <>'Official Mission') && ($output_query2["22"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["22"].'</td>';
}
//23
if ($output_query2["23"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["23"].'</td>';
}if($output_query2["23"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["23"].'</td>';
}
if ($output_query2["23"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["23"].'</td>';
}if ($output_query2["23"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["23"].'</td>';
}
elseif(($output_query2["23"] <>'OFF') && ($output_query2["23"] <>'Sick Leave')
&&($output_query2["23"] <>'Official Mission') && ($output_query2["23"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["23"].'</td>';
}
//24
if ($output_query2["24"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["24"].'</td>';
}if($output_query2["24"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["24"].'</td>';
}
if ($output_query2["24"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["24"].'</td>';
}if ($output_query2["24"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["24"].'</td>';
}
elseif(($output_query2["24"] <>'OFF') && ($output_query2["24"] <>'Sick Leave')
&&($output_query2["24"] <>'Official Mission') && ($output_query2["24"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["24"].'</td>';
}
//25
if ($output_query2["25"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["25"].'</td>';
}if($output_query2["25"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["25"].'</td>';
}
if ($output_query2["25"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["25"].'</td>';
}if ($output_query2["25"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["25"].'</td>';
}
elseif(($output_query2["25"] <>'OFF') && ($output_query2["25"] <>'Sick Leave')
&&($output_query2["25"] <>'Official Mission') && ($output_query2["25"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["25"].'</td>';
}
//26
if ($output_query2["26"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["26"].'</td>';
}if($output_query2["26"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["26"].'</td>';
}
if ($output_query2["26"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["26"].'</td>';
}if ($output_query2["26"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["26"].'</td>';
}
elseif(($output_query2["26"] <>'OFF') && ($output_query2["26"] <>'Sick Leave')
&&($output_query2["26"] <>'Official Mission') && ($output_query2["26"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["26"].'</td>';
}
//27
if ($output_query2["27"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["27"].'</td>';
}if($output_query2["27"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["27"].'</td>';
}
if ($output_query2["27"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["27"].'</td>';
}if ($output_query2["27"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["27"].'</td>';
}
elseif(($output_query2["27"] <>'OFF') && ($output_query2["27"] <>'Sick Leave')
&&($output_query2["27"] <>'Official Mission') && ($output_query2["27"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["27"].'</td>';
}
//28
if ($output_query2["28"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["28"].'</td>';
}if($output_query2["28"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["28"].'</td>';
}
if ($output_query2["28"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["28"].'</td>';
}if ($output_query2["28"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["28"].'</td>';
}
elseif(($output_query2["28"] <>'OFF') && ($output_query2["28"] <>'Sick Leave')
&&($output_query2["28"] <>'Official Mission') && ($output_query2["28"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["28"].'</td>';
}
//29
if ($output_query2["29"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["29"].'</td>';
}if($output_query2["29"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["29"].'</td>';
}
if ($output_query2["29"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["29"].'</td>';
}if ($output_query2["29"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["29"].'</td>';
}
elseif(($output_query2["29"] <>'OFF') && ($output_query2["29"] <>'Sick Leave')
&&($output_query2["29"] <>'Official Mission') && ($output_query2["29"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["29"].'</td>';
}
//30
if ($output_query2["30"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["30"].'</td>';
}if($output_query2["30"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["30"].'</td>';
}
if ($output_query2["30"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["30"].'</td>';
}if ($output_query2["30"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["30"].'</td>';
}
elseif(($output_query2["30"] <>'OFF') && ($output_query2["30"] <>'Sick Leave')
&&($output_query2["30"] <>'Official Mission') && ($output_query2["30"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["30"].'</td>';
}
//31
if ($output_query2["31"] =='Annual Leave'){
$rows .='<td class="hovers" style="background-color:#0d6efd;color:#eee;">'.$output_query2["31"].'</td>';
}if($output_query2["31"] =='Official Mission'){
$rows .='<td class="hovers" style="background-color:#198754; color:white;">'.$output_query2["31"].'</td>';
}
if ($output_query2["31"] =='Sick Leave'){
$rows .='<td class="hovers" style="background-color:#ffc107;color:black;">'.$output_query2["31"].'</td>';
}if ($output_query2["31"] =='OFF'){
$rows .='<td class="hovers" style="color:red;">'.$output_query2["31"].'</td>';
}
elseif(($output_query2["31"] <>'OFF') && ($output_query2["30"] <>'Sick Leave')
&&($output_query2["31"] <>'Official Mission') && ($output_query2["31"] <>'Annual Leave') ){
$rows .='<td class="hovers">'.$output_query2["31"].'</td>';
}	$rows .= '</tr>';
		  	echo $rows;

      }
    }


?>
 </tbody>
</table>
</div>
</div>			
				
</center>
    <script src="fixed_s/js/mainss.js"></script>

	<?php
 include ("footer.html");
 ?>
