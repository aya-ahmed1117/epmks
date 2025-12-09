

<?php
include ("pages.php");
$this_year = 2023;// date('Y');

      ?>
<title>Resignations</title>
 
  <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

<style type="text/css">
   
/*.tableFixHead         
 { 
  overflow-y: auto; height:500px; overflow-x: auto; 
 }
.tableFixHead thead th 
{ 
  position: sticky; top: 0; 
}*/
   </style>
<?php if($role_id == 1){ ?>
          <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Resignations
      <!-- <a href="mwd_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a> -->
  </h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       
        <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> 
       </a></p></samp>
    </aside>
  </div>
</center>


 <!--div style="padding: 20px;">

           <form method="post" >

  <div class="row">
        <div class="col-lg-3">
<div class="input-group col-2">
  <span class="input-group-text" id="basic-addon1">Choose Month</span>
  <input type="month" class="form-control"  id="months"
name='month' aria-describedby="basic-addon1"
value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>' required />
</div>
</div>

<div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >
Submit</button>
</div>
        </div>
    </div-->
 <?php
  /*if(isset($_POST['month'])){
  $myMonth = $_POST['month'];}
  if(isset($_POST['submit'])){}*/

  ?>
<div style="padding: 20px;">
 <h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" 
    data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
    <center>
<div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size:15px;background-color: #55608f;border: 1px solid white; ">
    <tr>
  <th ><center>year</center></th>
  <th ><center>month</center></th>
  <th ><center>Employee ID</center></th>
  <th><center>User Name</center></th>
  <th><center>Mobile Number</center></th>
  <th><center>Employee Name</center></th>
  <th><center>Last working day</center></th>
  <th><center>Hiring date</center></th>
  <th><center>Employee Type</center></th>
  <th><center>Employee_Manager</center></th>
  <th><center>Department</center></th>
  <th><center>Units</center></th>
  <th><center>Status</center></th> 
      </tr>
    </thead>
  <tbody>

<?php 

   $mttr = sqlsrv_query($con,"SELECT year([Last_working_day]) [year]
  ,month ([Last_working_day])[month]
  ,[Resignation_Table].[Employee_ID]
  ,[Resignation_Table].[User_Name]
  ,[Mobile_Number]
  ,[Employee_Name]
  ,[Resignation_Table].[Last_working_day]
  ,[Resignation_Table].[Hiring_date]
  ,[Resignation_Table].[Employee_Type]
  ,[Resignation_Table].[Employee_Manager]
  ,[Resignation_Table].[Department]
  ,[Tbl_Units].[Units]
  ,[Resignation_Table].[Status]

         FROM [Employess_DB].[dbo].[Resignation_Table]

         left join [Employess_DB].[dbo].[tbl_Personal_info] 
     on[Resignation_Table].[Employee_ID]=[tbl_Personal_info].ID

         left join [Employess_DB].[dbo].[Tbl_Groups]
     on[Group]=[Group_ID]
         left join [Employess_DB].[dbo].[Tbl_Units]
     on [Tbl_Units].[Units_id]= [tbl_Personal_info].[Unit]
  where
  ((month ([Last_working_day]) =DATEPART(m, DATEADD(m, -1, getdate()))  AND year([Resignation_Table].[Last_working_day]) = DATEPART(yyyy, DATEADD(m, -1, getdate())))or (month ([Last_working_day])=MONTH(GETDATE()) AND (year ([Resignation_Table].[Last_working_day]) = year(getdate())))) 

and[Resignation_Table].[Status] ='Confirmed' 

and [tbl_Personal_info].Department in (1,4)
and [tbl_Personal_info].unit in (11,12,14,15,13,16,17,18)
and[Resignation_Table]. [Employee_Type]='outsource'
order by 1,2");

   while ($output = sqlsrv_fetch_array($mttr) ){
   $rows  ='<tr>';
   $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["year"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["month"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Employee_ID"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["User_Name"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Mobile_Number"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Employee_Name"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Last_working_day"]->format('Y:m:d H:i:s').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Hiring_date"]->format('Y:m:d H:i:s').'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Employee_Type"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Employee_Manager"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Department"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Units"].'</td>';
  $rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output["Status"].'</td>';
  

$rows .='</tr>';
echo $rows;

      }
    
  ?>
          </tbody>
        </table>
        </div>
      </div>
<?php } ?>


<script src="js/table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "Resignation_Table.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>