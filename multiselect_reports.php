
 <?php
       include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
         $usernames="";
      if(isset($_POST['username'])){$usernames = $_POST['username'];}
        
        //$Units ="";
        $groups = "";
        $groups2 = "";
        $units="";
        $units2="";
        $schedule_date="";
        $schedule_date2="";
      ?>


<head>
  <title>Daily report</title>
</head>

<link href="css/bootstrap-multiselect.css" rel="stylesheet"/>

     <style>

  #sidebar .sidebar-header{
    background-color: #092834;

            }
.sidebar, .main-panel {
    overflow-x:  hidden;
    overflow-y:  hidden;
    
}

    .navbar {
    padding:.5px 1px;

    } 
  

 .card {
border-radius: 20px 20px 20px 20px;
width:57%;
text-shadow: 2px 2px 4px #eee;
margin-left: 19.5px;
position: relative;
display: -ms-flexbox;
display: flex;
-ms-flex-direction: column;
flex-direction: column;
word-wrap: break-word;
/*background-color: #fff;
min-width: 0;*/
background-clip: border-box;
border: 1px solid rgba(0,0,0,.125);
border-radius: .25rem;
}

.row {
    display: -ms-flexbox;
     display: flex; 
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
     margin-right: 0; 
     margin-left: -.5px; 
     padding: 10px;
     background-clip: border-box;
border: 1px solid rgba(0,0,0,.125);
border-radius: 5px;
background-color: #fff;
}

/*
.row {
    display: -ms-flexbox;
     display: flex; 
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
     margin-right: 0; 
     margin-left: -.5px; 
}*/
.table-responsive {
    display: block;
    width: 100%;    
  }
  
.card-header {
    background-color: #17a2b8;color: #fff;
}

#chkveg li {
    display: list-item;
    float: left;
     margin: 0;
    height: 50%;
    cursor: pointer;
    font-weight: 400;
    padding: 0px 20px 3px 40px;

}
#Groups2 li{
    display: list-item;
    float: left;
     
     margin-left:68%;
    height: 50%;
    cursor: pointer;
    font-weight: 400;
    padding: 0px 20px 3px 40px;

}

.wrapper {
    height:auto;}
    #GoUnits li{
      display: list-item;
    float: left;
     margin: 0;
    height: 50%;
    cursor: pointer;
    font-weight: 400;
    padding: 0px 20px 3px 4px;
font-stretch: expanded;
    font-size: 17px;
}

 .span{
  margin-left: -7%;
  font-size: 13px;
margin-top: -15px;
    
}
    </style>
       
        <!-- Sidebar  -->

    <div class="wrapper">       
 <div id="content">

 <nav class="navbar navbar-expand-lg navbar-light bg-light " style="font-size: 15px; backface-visibility: hidden; 
 border-radius: 0px 10px 10px 0px; margin-left:-1.5%; width: 105%; margin-top:-1.5%;">
                 <div class="container-fluid">
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">

     <ul>
  <img src="imag/logo.jpg" alt="logo.jpg"  style="
   width: 25px; margin-bottom: 3px; margin-left: -20%;">
  <span style="font-size:15px;font-family: Century Gothic; margin-right: 1px; ">
  WorkForce Managment Tool</span></ul> 
  <a href="theme.php" style="margin-left: -3.5%;">
                    <button type="button" id="sidebarCollapse" class="btn btn-info" >
                        <i class="fas fa-align-left"></i>Home
                    </button></a>
                        <ul class="nav navbar-nav ml-auto">
  
    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>


 <li ><a href="#" style="font-size: 9.5px;"><span class="glyphicon glyphicon-user"></span> login as <samp>:</samp>
        <?php echo $_SESSION["username"];?><h6 style="color: orange;font-size: 10px;text-align: justify;text-indent: 10px;letter-spacing: -.5px;line-height: 0.8;" ></h6></a></li>
        
<li><a href="?logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>

                        </ul>
                    </div>
                </div>
            </nav>


<div >
<center>
<div class="card-header">
           <h3 class="card-title">Reports H.C</h3>
           <a href="reports_per.php" style="background-color: #838487; color: white;width:35px;float: right; margin-top: -2.8%;
           padding: 5px; " target="_blanck">
                  <i class="fas fa-edit"></i> Edit
                </a>
              </div></center>
   
<?php
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);?>

<br>
<form method="post"  onsubmit="return compare()"style="text-align: center;margin-left:1%;"> 


<div class="col-sm-2" style="transform: translate(-10%);">
  <div  class="well" style="width: 100%;padding: 16.5%; ">
      <a href="?GoUnits">
    <img src="imag/hierarchical-structure.png" style="width:35%;float: left;margin-top: -11px;">
    <b style="font-size: 15px;text-align: center;  display: -ms-flexbox;
     display: flex; 
    -ms-flex-wrap: wrap;
    flex-wrap: wrap; ">Select by Units</b></a>
    </div>
    <div class="well" style="width: 100%;padding: 16.5%; ">
      <a href="?GoGroups">
        <img src="imag/teamwork (1).png" style="width:35%;float: left;margin-top: -18px;">
    <b style="font-size: 15px;text-align: center;  display: -ms-flexbox;
     display: flex; 
    -ms-flex-wrap: wrap;
    flex-wrap: wrap; ">Select by Groups</b></a>
    </div>

  </div>

<?php 
    if (isset($_GET['GoGroups']) || isset($_GET['GoUnits'])) {
 ?>
 <a href="multiselect_reports.php" title="close " >
    <img src="imag/Close-Icon-by-Valeree.png" style="width:5%; transform: translate(310px,10px); overflow-x:hidden;margin-right:0;"></a>


   <div class="card-body" style="float: right;color: white;width: 20%; ">
     <button  style="background-color: #ff9900; color: white;width:70%;"
      type='submit'  name='submit' class="btn btn-app">
                  <i class="fas fa-paper-plane"></i> Get Dta</button>
               

              </div>
     <div class="input">


        <div class="container">
<div class="form-row">
  <div class="col-4">
        <h3> <label style="color: white;float: left;font-size:15px;font-style: normal;font-family: Century Gothic;" >
Select From Date</label></h3>
        <input  type='date' class='form-control' id="adate" name='schedule_date' required style="padding:14px;"
      value='<?php if(isset($_POST['schedule_date'])) echo $_POST['schedule_date']; ?>'/>
    </div>
    <div class="col-4">
         <h3> <label style="color: white;float: left;font-size:15px;font-style: normal;font-family: Century Gothic;" >
Select To Date </label></h3>
          <input  type='date' class='form-control' id="bdate" name='schedule_date2' required style="padding:14px;"
      value='<?php if(isset($_POST['schedule_date2'])) echo $_POST['schedule_date2']; ?>'/>

    </div>
    </div>

 <?php 
}?>
    <br>
    <?php if(isset($_GET['GoGroups'])){
      ?>
<div class="form-row">
  <div class="col-4">
   <h3> <label style="color: white;float: left;font-size:15px;font-style: normal;font-family: Century Gothic;" >
Select Unit</label></h3>
  
    <select name="Units" id="Units" class="form-control" placeholder="Select Units..." >
<option value='<?php if(isset($_POST['Units'])) echo $_POST['Units']; ?>'  ><?php if(isset($_POST['Units'])) echo $_POST['Units']; ?></option>
<option value="Enterprise Service Desk">Enterprise Service Desk</option>
<option value="Enterprise Support Systems">Enterprise Support Systems</option>
<option value="Onsite Problem Management">Onsite Problem Management</option>
<option value="Problem Management and Service Optimization">Problem Management and Service Optimization</option>
<option value="Quality Management and Training">Quality Management and Training</option>
<option value="Workforce Management">Workforce Management</option>
</select>
<p id="chkveg" multiselect  name="Groups[]" class="col-md-12"  ></p>
</div>
<div class="col-4">
 <h3> <label style="color: white;float: left;font-size:15px;font-style: normal;font-family: Century Gothic;" >
Select Unit</label></h3>
  
    <select name="Units2" id="Units2" class="form-control" placeholder="Select Units..." >
<option value='<?php if(isset($_POST['Units2'])) echo $_POST['Units2']; ?>'  ><?php if(isset($_POST['Units2'])) echo $_POST['Units2']; ?></option>
<option value="Enterprise Service Desk">Enterprise Service Desk</option>
<option value="Enterprise Support Systems">Enterprise Support Systems</option>
<option value="Onsite Problem Management">Onsite Problem Management</option>
<option value="Problem Management and Service Optimization">Problem Management and Service Optimization</option>
<option value="Quality Management and Training">Quality Management and Training</option>
<option value="Workforce Management">Workforce Management</option>
</select>
  <p id="Groups2" multiselect  name="Groups2[]" class="col-md-12"style="margin-left:-4%;"  ></p>

</div>
</div>
<?php 
$genres_str ="";
      if(isset($_POST['Groups'])){$Groups = $_POST['Groups'];}
      if(isset($_GET['Groups'])){$Groupy = $_GET['Groups'];}
    
if (isset($_POST["Groups"])) 
    {

    $genres_str = "'" .implode( "','" ,$Groups ) ."'";//converts the array into 'gen1,gen2,gen3,..'  

    }
   
?>
<?php 
$genres_str2 ="";
      if(isset($_POST['Groups2'])){$Groups2 = $_POST['Groups2'];}
    
if (isset($_POST["Groups2"])) 
    {

    $genres_str2 = "'" .implode( "','" ,$Groups2 ) ."'";//converts the array into 'gen1,gen2,gen3,..'  

    }
    
   
?>
 </div>
<?php 
}
?>
  
     <?php if(isset($_GET['GoUnits'])) {
      ?>
    <label style="color: white;float: left;font-size:15px;font-style: normal;font-family: Century Gothic;"  >Select units
    <i class="fas fa-check-circle"></i></label>
<br>
<hr>
      <div class="col-sm-4" style="transform: translate(-10%);">
  <div  class="well" >
        <input  style="padding:2px 20px 3px 4px;margin-top:-8px;float: left;" type="checkbox"   name="GoUnits[]"
        value="Enterprise Service Desk"><span class="span">Enterprise Service Desk</span></div>
       <div  class="well" >
        <input style="padding:2px 20px 3px 4px;padding-top:15px;float: left;margin-top:-5px;" type="checkbox"   name="GoUnits[]"
        value="Enterprise Support Systems"><span class="span">Enterprise Support Systems</span></div>
      <div  class="well" >
        <input style="padding:2px 20px 3px 4px;padding-top:15px;float: left;margin-top:-5px;" type="checkbox"   name="GoUnits[]"
        value="Onsite Problem Management"><span class="span">Onsite Problem Management</span></div>
      </div>
    <div class="col-sm-4" style="transform: translate(5%);">
      <div  class="well" >
        <input style="padding:2px 20px 3px 4px;margin-top:-5px;float: left;padding-top:15px;" type="checkbox"  name="GoUnits[]"
        value="Problem Management and Service Optimization"><span class="span">Problem Management and Service Optimization</div>
      <div  class="well" >
        <input style="padding:2px 20px 3px 4px;padding-top:15px;float: left;" type="checkbox"  name="GoUnits[]"
        value="Quality Management and Training"><span class="span">Quality Management and Training</span></div>
       <div  class="well" >
        <input style="padding:2px 20px 3px 4px;padding-top:15px;float: left;" type="checkbox"  name="GoUnits[]"
        value="Workforce Management"><span class="span">Workforce Management</span>  </div>
</div>
</div>
<?php
if(isset($_POST['submit'])){
        if(isset($_POST['GoUnits'])){$GoUnits = $_POST['GoUnits'];}

    if (isset($_POST["GoUnits"])) {$GoUnit2 = "'" .implode( "', '" ,$GoUnits ) ."'"; }

    echo'

   <div style="transform: translate(0px,10px);width:auto;">
<h3 style="color: white;font-size:15px;font-style: normal;font-family: Century Gothic;margin-left:8%;
    padding:5px;background-color:#374954;border:3px solid lightgray;width:auto;" > 
      <label style="float:left;color:orange;">
           Selected Units:</label><span class="input-group-append"> '.$GoUnit2.'</span></h3>
</div>
<br>
    <!--a role="button" id="btnExport" value="Export to Excel"  onclick="Export()">
    <img src="imag/excel2.png" style="width:7%;float:right;transform: translate(0,-10px);"></a-->';}?>

    <?php 
}
?> 

<?php
if(isset($_GET['GoGroups'])) {
if(isset($_POST['submit'])){
    echo'
    <div class="col-4">
<h3 style="color: white;font-size:15px;font-style: normal;font-family: Century Gothic;width:auto;margin-left:8%;
    padding:5px;background-color:#374954;border:3px solid lightgray;" > 
      <label style="float:left;color:orange;">
            Selected Groups:</label><span class="input-group-append"> '.$genres_str,$genres_str2.'</span></h3></div>';}}?>

 
<!--input type='submit'  name='submit' class="btn btn-lg btn-warning" style="width:50%;margin-left:8%;
 font-weight: bold; font-size: 15px; font-stretch: expanded;color:white;" value='Get Data'/-->
</div>
</div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<?php 
if(isset($_POST['submit'])){
  if(isset($_POST['Units'])){$Units = $_POST['Units'];}
  if(isset($_POST['GoUnits'])){$GoUnits = $_POST['GoUnits'];}
  if(isset($_POST['Units2'])){$Units2 = $_POST['Units2'];}
  if(isset($_POST['Groups'])){$Groups = $_POST['Groups'];}
  if(isset($_POST['Groups2'])){$Groups2 = $_POST['Groups2'];}
  if(isset($_POST['schedule_date'])){$schedule_date = $_POST['schedule_date'];}
  if(isset($_POST['schedule_date2'])){$schedule_date2 = $_POST['schedule_date2'];

     //groups
             if(!empty($_POST["Groups2"])){
                // Array contains values, everything ok
                $yala= '-'. implode("','", $Groups2);
              } else {
                // Array is empty
                $yala= '-';
              }
//Groups 1
if(!empty($_POST["Groups"])){
                // Array contains values, everything ok
                $yalabena= '-'. implode("','", $Groups);
              } else {
                // Array is empty
                $yalabena= '-';
              }
   // units
              if(!empty($_POST["GoUnits"])){
                // Array contains values, everything ok
                $GoUnit= '-'. implode("','", $GoUnits);
              } else {
                // Array is empty
                $GoUnit= '-';
              }
              if (isset($_POST["GoUnits"])) {
      $GoUnit2 = "'" .implode( "', '" ,$GoUnits ) ."'"; }

echo '<style>
.wrapper {
    height: auto;}
    
      .table>thead>tr>th {
    vertical-align: bottom;color:white;
    border-bottom: 2px solid #ddd;
}
    </style>
    <a role="button" id="btnExport" value="Export to Excel"  onclick="Export()">
    <img src="imag/excel2.png" style="width:7%;float:right;transform: translate(0,-10px);"></a>
<div class="card-body table-responsive p-0" style="height:320px;background-color:white;overflow-x:auto; ">

         <table class="table table-head-fixed text-nowrap" id="tblCustomers" 
         style="border-color: inherit;">
                  <thead >
                    <tr style="background-color:#4d004d; width:100%;">

          <th  >Date </th>
          <th  >Units </th>
          <th  >Groups </th>
          <th >Week day </th>
          <th  >Morning</th>
          <th >Afte Noon</th>
          <th  >Evening </th>
          <th  >Overnight </th>
          <th  >OFF </th>
          <th  >Sick </th>
          <th  >Official Mission </th>
          <th  >Annual </th>
          <th  >Permission </th>
           <th  >Total </th>
          
          </tr>';
          if(isset($_GET['GoGroups'])) {
  $selected = sqlsrv_query($con,"with x1 as (SELECT  Units
,groups
      ,[schedule_date]
    ,[schedule_table].username
    ,DATENAME(dw,[schedule_date]) Day_name
    ,DATEPART(dw,[schedule_date]) Week_Num
    
    ,case
    when cast(shift_end as time) < cast(shift_start as time) then 'Overnight'
    when cast(shift_start as time) between '07:00:00' and '11:59:59' then 'Morning'
    when cast(shift_start as time) between '12:00:00' and '16:59:59' then 'Afternoon'
    when cast(shift_start as time) between '17:00:00' and '23:59:59' then 'Evening'
    end shift_name
    
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join [Employess_DB].[dbo].[tbl_Personal_info] ON [tbl_Personal_info].[username] = [schedule_table].[username]
  left join [Employess_DB].[dbo].Tbl_Units on Units_ID = Unit
  left join [Employess_DB].[dbo].Tbl_Groups on Group_ID = [Group]

     where   [schedule_date] between '$schedule_date' and '$schedule_date2' 
     and [groups] IN ('".$yalabena."','".$yala."' ) and [shift_start] <> 'Off'),

sch_without_off as (
  select * from x1

  pivot(count(username)
                    for shift_name in (Morning,Afternoon,Evening,Overnight)
                    ) as pivot_table),

sch_off as (

SELECT  Units
,groups
      ,[schedule_date]
    ,DATENAME(dw,[schedule_date]) Day_name
    ,DATEPART(dw,[schedule_date]) Week_Num
    
    ,count([schedule_table].username) Emp_off
    
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join [Employess_DB].[dbo].[tbl_Personal_info] ON [tbl_Personal_info].[username] = [schedule_table].[username]
  left join [Employess_DB].[dbo].Tbl_Units on Units_ID = Unit
  left join [Employess_DB].[dbo].Tbl_Groups on Group_ID = [Group]
  Where  [shift_start] = 'Off'
  group by 
   Units,groups
      ,[schedule_date]
    ,DATENAME(dw,[schedule_date])
    ,DATEPART(dw,[schedule_date]) ),

 leave as (SELECT Units
,Groups
      ,[leaves].[username]
      ,[adate]
      ,[bdate]
      ,[type]

  FROM [Aya_Web_APP].[dbo].[leaves]
 left join [Employess_DB].[dbo].[tbl_Personal_info] ON [tbl_Personal_info].[username] = [leaves].[username]
  left join [Employess_DB].[dbo].Tbl_Units on Units_ID = Unit
  left join [Employess_DB].[dbo].Tbl_Groups on Group_ID = [Group]
  where [status] = 'E-workforce and senior approve'),

  leaves as 
  (
  select * from leave
  pivot (count(username)for [type] in ([Annual Leave],Permission,[Official Mission],[Sick Leave])
                    ) as pivot_table )


select sch_without_off.units, sch_without_off.groups,sch_without_off.schedule_date,sch_without_off.day_name,sch_without_off.week_num,morning,afternoon,evening,overnight,iif(Emp_off is null,0,Emp_off) Emp_off
,iif(Sum([Annual Leave]) is null , 0 ,Sum([Annual Leave]))  [Annual_Leave] ,iif(sum(Permission) is null , 0 , sum(Permission)) Permission ,iif(Sum([Official Mission]) is null , 0, Sum([Official Mission])) [Official_Mission] ,iif(Sum([Sick Leave]) is null, 0 ,Sum([Sick Leave])) [Sick_Leave]
from sch_without_off
left join sch_off on sch_without_off.Units =sch_off.Units and  sch_without_off.groups = sch_off.groups and sch_without_off.schedule_date = sch_off.schedule_date and sch_without_off.day_name = sch_off.day_name and sch_without_off.week_num = sch_off.week_num
left join leaves on sch_without_off.units = leaves.units and sch_without_off.groups = leaves.groups and sch_without_off.schedule_date between [adate]and  bdate
group by 
sch_without_off.units, sch_without_off.groups,sch_without_off.schedule_date,sch_without_off.day_name,sch_without_off.week_num,morning,afternoon,evening,overnight,iif(Emp_off is null,0,Emp_off)

order by 3 ");}
if(isset($_GET['GoUnits'])) {
  $selected = sqlsrv_query($con,"with x1 as (SELECT  Units
,groups
      ,[schedule_date]
    ,[schedule_table].username
    ,DATENAME(dw,[schedule_date]) Day_name
    ,DATEPART(dw,[schedule_date]) Week_Num
    
    ,case
    when cast(shift_end as time) < cast(shift_start as time) then 'Overnight'
    when cast(shift_start as time) between '07:00:00' and '11:59:59' then 'Morning'
    when cast(shift_start as time) between '12:00:00' and '16:59:59' then 'Afternoon'
    when cast(shift_start as time) between '17:00:00' and '23:59:59' then 'Evening'
    end shift_name
    
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join [Employess_DB].[dbo].[tbl_Personal_info] ON [tbl_Personal_info].[username] = [schedule_table].[username]
  left join [Employess_DB].[dbo].Tbl_Units on Units_ID = Unit
  left join [Employess_DB].[dbo].Tbl_Groups on Group_ID = [Group]

      where   [schedule_date] between '$schedule_date' and '$schedule_date2' and [shift_start] <> 'Off' 
      and [units] IN ('".implode( "','" ,$GoUnits )."') ),

sch_without_off as (
  select * from x1

  pivot(count(username)
                    for shift_name in (Morning,Afternoon,Evening,Overnight)
                    ) as pivot_table),

sch_off as (

SELECT  Units
,groups
      ,[schedule_date]
    ,DATENAME(dw,[schedule_date]) Day_name
    ,DATEPART(dw,[schedule_date]) Week_Num
    
    ,count([schedule_table].username) Emp_off
    
  FROM [Aya_Web_APP].[dbo].[schedule_table]
  left join [Employess_DB].[dbo].[tbl_Personal_info] ON [tbl_Personal_info].[username] = [schedule_table].[username]
  left join [Employess_DB].[dbo].Tbl_Units on Units_ID = Unit
  left join [Employess_DB].[dbo].Tbl_Groups on Group_ID = [Group]
  Where  [shift_start] = 'Off'
  group by 
   Units,groups
      ,[schedule_date]
    ,DATENAME(dw,[schedule_date])
    ,DATEPART(dw,[schedule_date]) ),

 leave as (SELECT Units
,Groups
      ,[leaves].[username]
      ,[adate]
      ,[bdate]
      ,[type]

  FROM [Aya_Web_APP].[dbo].[leaves]
 left join [Employess_DB].[dbo].[tbl_Personal_info] ON [tbl_Personal_info].[username] = [leaves].[username]
  left join [Employess_DB].[dbo].Tbl_Units on Units_ID = Unit
  left join [Employess_DB].[dbo].Tbl_Groups on Group_ID = [Group]
  where [status] = 'E-workforce and senior approve'),

  leaves as 
  (
  select * from leave
  pivot (count(username)for [type] in ([Annual Leave],Permission,[Official Mission],[Sick Leave])
                    ) as pivot_table )


select sch_without_off.units, sch_without_off.groups,sch_without_off.schedule_date,sch_without_off.day_name,sch_without_off.week_num,morning,afternoon,evening,overnight,iif(Emp_off is null,0,Emp_off) Emp_off
,iif(Sum([Annual Leave]) is null , 0 ,Sum([Annual Leave]))  [Annual_Leave] ,iif(sum(Permission) is null , 0 , sum(Permission)) Permission ,iif(Sum([Official Mission]) is null , 0, Sum([Official Mission])) [Official_Mission] ,iif(Sum([Sick Leave]) is null, 0 ,Sum([Sick Leave])) [Sick_Leave]
from sch_without_off
left join sch_off on sch_without_off.Units =sch_off.Units and  sch_without_off.groups = sch_off.groups and sch_without_off.schedule_date = sch_off.schedule_date and sch_without_off.day_name = sch_off.day_name and sch_without_off.week_num = sch_off.week_num
left join leaves on sch_without_off.units = leaves.units and sch_without_off.groups = leaves.groups and sch_without_off.schedule_date between [adate]and  bdate
group by 
sch_without_off.units, sch_without_off.groups,sch_without_off.schedule_date,sch_without_off.day_name,sch_without_off.week_num,morning,afternoon,evening,overnight,iif(Emp_off is null,0,Emp_off)

order by 3 ");}
   while( $output_query = sqlsrv_fetch_array($selected)){

$rows  ='<tdody><tr>';
$rows .='<td style="color: DodgerBlue;font-size:13px;border: 1px solid #000000; ">'.$output_query["schedule_date"]->format('Y-m-d').'</td>';
$rows .='<td  style="font-size:15px ;border: 1px solid #000000;">'.$output_query["units"].'</td>';
$rows .='<td  style="font-size:13px ;border: 1px solid #000000;">'.$output_query["groups"].'</td>';
$rows .='<td  style="font-size:13px ;border: 1px solid #000000;background-color:#eee;">'.$output_query["week_num"].'</td>';
$rows .='<td style="font-size:13px ;border: 1px solid #000000;">'.$output_query["morning"].'</td>';
$rows .='<td style="font-size:13px ;border: 1px solid #000000;">'.$output_query["afternoon"].'</td>';
$rows .='<td  style="font-size:13px ;border: 1px solid #000000;">'.$output_query["evening"].'</td>';
$rows .='<td style="font-size:13px ;border: 1px solid #000000;">'.$output_query["overnight"].'</td>';
$rows .='<td style="font-size:13px ;border: 1px solid #000000;">'.$output_query["Emp_off"].'</td>';
$rows .='<td  style="font-size:13px ;border: 1px solid #000000;">'.$output_query["Sick_Leave"].'</td>';
$rows .='<td  style="font-size:13px ;border: 1px solid #000000;">'.$output_query["Official_Mission"].'</td>';
$rows .='<td style="font-size:13px ;border: 1px solid #000000;">'.$output_query["Annual_Leave"].'</td>';
$rows .='<td  style="font-size:13px ;border: 1px solid #000000;">'.$output_query["Permission"].'</td>';
 $total =
($output_query["morning"] +$output_query["afternoon"] +$output_query["evening"] +$output_query["overnight"]
  +$output_query["Emp_off"] +$output_query["Annual_Leave"] +$output_query["Sick_Leave"] +$output_query["Official_Mission"] 
   +$output_query["Permission"]);

$rows .='<td  style="font-size:13px ;border: 1px solid #000000;">'.$total.'</td>'; 
  $rows .='</tr>';
echo $rows;

}}
}
?>
</tbody>
</table>
<script type="text/javascript">
$(document).ready(function()
{
$("#Units").change(function()
{
var Units_ID=$(this).val();
var post_id = 'Units=' + Units_ID;
 
$.ajax
({
type: "POST",
url: "connect.php?Units",
data: post_id,
cache: false,
success: function(cities)
{
$("#chkveg").html(cities);
} 
});
 
});
});
/////////////
$(document).ready(function()
{
$("#Units2").change(function()
{
var Units_ID=$(this).val();
var post_id = 'Units2=' + Units_ID;
 
$.ajax
({
type: "POST",
url: "connect.php?Units2",
data: post_id,
cache: false,
success: function(cities)
{
$("#Groups2").html(cities);
} 
});
 
});
});
</script>

<script src="js/table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Reports.xls"
            });
        }
    </script>
    <script type="text/javascript">
  function myfunc(){
    var start = new Date($('#adate').val());
    var end = new Date($('#bdate').val());

// end - start returns difference in milliseconds 
var diff = new Date(end - start);

// get days
var days = diff/1000/60/60/24;
days = days+1
$('#countDays').val(Math.round(days));
    alert(Math.round(days));
}

</script>

<script type="text/javascript">

  function validateForm() {
  var x, adate;
  var y, bdate;

  // Get the value of the input field with id="numb"
  x = document.getElementById("numb").value;

  // If x is Not a Number or less than one or greater than 10
  if (isNaN(x) || x < 1 || x > 10) {
    text = "Input not valid";
  } else {
    text = "Input OK";
  }
  document.getElementById("demo").innerHTML = text;
}

function compare()
{
  debugger;
    var startDt = document.getElementById("adate").value;
    var endDt = document.getElementById("bdate").value;
    //var ptype = document.getElementById("inputGroupSelect01").value;
  if( (new Date(startDt).getTime() > new Date(endDt).getTime()))
    {
       alert("To Date should be greater than From date ");
       event.preventDefault();
    }

}
</script>


</div>
</div>
</div>
</div>
</form>
<script src="table-filter.js"></script>
  <script src="js/table2excel.js" type="text/javascript"></script>

    <?php

 include ("footer.html");

 ?>
