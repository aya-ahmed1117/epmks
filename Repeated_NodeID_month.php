
 

  <?php
      set_time_limit(400);
include ("pages.php");
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];


  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkforceDB_indexed";
  
  $connectionInfo = array( "Database"=>$DBname , "UID"=>$DBuser, "PWD"=>"123456789");
  $con_indexed = sqlsrv_connect($DBhost, $connectionInfo);
    
$new_q= sqlsrv_query( $con , "SELECT  groups
    FROM [Employess_DB].[dbo].[tbl_Personal_info]
    left join Employess_DB.dbo.Tbl_Groups on Group_ID = [Group]
    where username = '$s_username'");
  $out_new = sqlsrv_fetch_array($new_q);
  $my_group = $out_new['groups'];
 /// $my_group = isset($_SESSION['my_group']) ? $_SESSION['my_group'] : '';


      ?>
<head>
      <title>Repeated_NodeID_month</title>
<link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head> 
<style type="text/css">
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }

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
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Repeated NodeID Per Month
      <a href="mwd_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
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
<div style="padding: 20px;">

           <form method="post" >
        

            <div class="alert alert-info">
  <strong>Info!</strong> Choose between dates to get your data
</div>
 <br>
<div class="row">
        <div class="col-lg-3">
<div class="input-group col-2">
  <span class="input-group-text" id="basic-addon1">Start Date</span>
  <input type="date" class="form-control" 
  placeholder="From Date" aria-label="From Date" id="dates"
    name='date' aria-describedby="basic-addon1"
    value='<?php if(isset($_POST['date'])) echo $_POST['date']; ?>' required />
    </div>
</div>

    <div class="col-lg-3">
<div class="input-group col-2">
  <span class="input-group-text" 
  id="basic-addon1">End date</span>
  <input type="date" class="form-control" placeholder="To Date" aria-label="To Date" name="date2" id="dates"
    aria-describedby="basic-addon1"required
value='<?php if(isset($_POST['date2'])) echo $_POST['date2']; ?>'/>
</div>
</div>

    <div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >
    Submit</button>
            </div>
        </div>

</div>
</form>
<?php   if(isset($_POST['submit'])){
?>
<br>
<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">

<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color:#55608f;border: 1px solid white; ">
        <tr>
          <th><center>NodeID</center></th>
          <th><center>Ticket_group</center></th>
          <th><center>Category</center> </th>
          <th><center>Repeat</center></th>
          <th><center>RequestID</center></th>
          <th><center> Subgroup</center></th>
          <th><center> Item</center></th>
        </tr>
        </thead>
    
  <tbody>
<?php
// Validate input dates
$start = isset($_POST['date']) ? trim($_POST['date']) : null;
$end = isset($_POST['date2']) ? trim($_POST['date2']) : null;

if (!$start || !$end) {
    die("Invalid date input. Please enter valid dates.");
}

// Check database connection
if (!$con_indexed) {
    die("Database connection error.");
}


// Determine query condition based on user role
$query_condition = "";

if (($_SESSION['username'] == 'ahmed.mohamedbassal') ||
 ($_SESSION['username']=='mohamed.abdeltwab' ) ){
    $query_condition = "AND (Ticket_group LIKE 'private KAM%' OR Ticket_group LIKE 'GDS%')";
} elseif ($_SESSION['username'] == 'ahmed.akef' || $_SESSION['role_id'] == 1) {
    $query_condition = ""; // No additional condition
} else {
    if (!isset($my_group)) {
        die("Error: 'my_group' variable is undefined.");
    }
    $query_condition = "AND Ticket_group LIKE '$my_group%'";
}


// SQL Query
  $query = "with repetition as
    (select nodeID,Category,count(requestID)[Repeat]
    from [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
    where cast(creation_time as date) between '$start' and '$end'
    and Request_Mode <>'Internal Reference' and (Ticket_group not in ('unmanaged','ESLM','ESOC','Onsite') or
    Ticket_group is null) and ( closure_reason <> 'Duplicated tickets' or closure_reason is null) and nodeID 
    not in ('NID-NA','NID-4G') and nodeID not like 'NID-%-Bulk'

    group by nodeID,Category
    having count(requestID)>=2)

    select distinct repetition.NodeID,
    Ticket_group,repetition.Category,
    repetition.[Repeat],
    RequestID,
    Subgroup,
    Item,
    creation_time
    from repetition
    left join [WorkforceDB_indexed].[dbo].[KPI_Status_RawData] KPI on repetition.nodeID=KPI.nodeID and repetition.category=KPI.Category
    where cast(creation_time as date) between '$start' and '$end'
    and Request_Mode <>'Internal Reference' and (Ticket_group not in ('unmanaged','ESLM','ESOC','Onsite') 
    or Ticket_group is null) and ( closure_reason <> 'Duplicated tickets' or closure_reason is null)
        $query_condition
    ORDER BY Ticket_group, [Repeat] DESC";

$params = [$start, $end, $start, $end];

$new_query = sqlsrv_query($con_indexed, $query, $params);

if ($new_query === false) {
    die(print_r(sqlsrv_errors(), true)); // Display SQL errors
}


// Fetch and display data
while ($echo = sqlsrv_fetch_array($new_query, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td style='border: 1px solid lightgray;'>{$echo['NodeID']}</td>";
    echo "<td style='border: 1px solid lightgray;'>{$echo['Ticket_group']}</td>";
    echo "<td style='border: 1px solid lightgray;'>{$echo['Category']}</td>";
    echo "<td style='border: 1px solid lightgray;'>{$echo['Repeat']}</td>";
    echo "<td style='border: 1px solid lightgray;'>{$echo['RequestID']}</td>";
    echo "<td style='border: 1px solid lightgray;'>{$echo['Subgroup']}</td>";
    echo "<td style='border: 1px solid lightgray;'>{$echo['Item']}</td>";

    // Check and format creation_time
    // echo "<td style='border: 1px solid lightgray;'>";
    // if ($echo['creation_time'] instanceof DateTime) {
    //     echo $echo['creation_time']->format('Y-m-d H:i:s');
    // } else {
    //     echo "Not Available";
    // }
    echo "</td>";

    echo "</tr>";
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
                filename: "Repeated_NodeID_month.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>
 