

<?php 
include ("pages.php");
$usernames="";
  if(isset($_POST['username'])){$usernames = $_POST['username'];}
     $self = $_SESSION['id'];
?>
<title>Utilization</title>

<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" href="css/ionicons.min.css">
<link rel="stylesheet" href="css/morris22.css">
<link rel="stylesheet" href="css/AdminLTE.min.css">
<link rel="stylesheet" href="css/_all-skins.min.css">
  </head>


  <?php
   //if(isset($_GET['utiliz'])){
    ?>
    <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Utilization per user
    </h2>
              </div>
          </div>
      </div>
       <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">Select Start date and end date and user to get data</p>
        <?php  if($_SESSION['username'] == 'y_test'){?>

<samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
        <?php  
      }?>



        </samp>
    </aside>
  </div>
</center>
<div style="padding: 20px;">

<form method="post" >
    <div class="row">
        <div class="col-md-3">
<div class="input-group col-2">
  <span class="input-group-text" id="basic-addon1">Start Date</span>
  <input type="date" class="form-control" placeholder="From Date" aria-label="From Date" id="dates"
name='date' aria-describedby="basic-addon1"
value='<?php if(isset($_POST['date'])) echo $_POST['date']; ?>' required />
</div>
</div>
<br>
    <div class="col-md-3">
<div class="input-group col-2">
  <span class="input-group-text" 
  id="basic-addon1">End date</span>
  <input type="date" class="form-control" placeholder="To Date" aria-label="To Date" name="date2" id="dates"
    aria-describedby="basic-addon1"required
value='<?php if(isset($_POST['date2'])) echo $_POST['date2']; ?>'/>
</div>
<br>
</div>
<br>
</div>
<div class="row">
<div class="col col-md-6">
        <div class="input-group">
<div  class="input-group"  id="username">
  <span class="input-group-text" id="basic-addon1"><samp><i class="fas fa-user-tie"></i>Username</samp></span>
  <select id="input2-group2"
class="form-control" name="username" value='<?php if($usernames != '') echo $usernames;?>' >
  <option action="none" value="0" selected>Select..</option>
<?php
    if ($_SESSION['role_id'] == 1){
  $checks = sqlsrv_query( $con ,"SELECT username from  employee 
  where role_id = 0 order by username");
  while($outputs = sqlsrv_fetch_array($checks)){
    $usernames = $outputs['username'];
        $rows = '<option ';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
  echo $rows;
}}
if ($_SESSION['role_id'] >= 2){
  $self = $_SESSION['id'];
$checks = sqlsrv_query( $con ,"SELECT * from  employee_web_table
  where manager = '$self' order by 2");
  while($outputs = sqlsrv_fetch_array($checks)){
    $usernames = $outputs['username'];
        $rows = '<option ';
        $rows .= $output['username'] == $outputs['username'] ? "selected" : " ";;
        $rows .= ' value="'.$outputs['username'].'">'.$outputs['username'].'</option>';
   echo $rows;
}}
  ?>
</select>

            <div class="input-group-btn col-md-6"><button class="btn btn-primary"type='submit' name='submit' value="Get data" >Submit</button></div>
        </div>
    </div>
</div>

<br>
</div>
</div>

<?php 

if(isset($_POST['date'])){
$mydate = $_POST['date'];}
if(isset($_POST['date2'])){
$mydate2 = $_POST['date2'];}
?>

       
<?php
  if(isset($_POST['submit'])){
  
?>

      <div class="row">
       <center>
           <div class="col-md-6">
          <div class="box box-success" style="background-color: #092834;">
            <div class="box-header with-border">
              <h3 class="box-title" style="color:#eee;">Utilization
              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body chart-responsive">
          <div class="chart" id="line-utiliz" style="height: 300px;"></div>
        </div>

        <div class="card-body">
    <div class="legend" style="color: white;">
    <i class="fa fa-circle text-primary" style="color:;"></i> utilized
    <i class="fa fa-circle text"style="color:#9dadb9;"></i> Non utilized
    </div>
    </div>

    <hr>
          <div class="table table-striped table-hover" style="overflow:scroll;overflow-x: hidden; height:350px;">
 <table  class="order-table table" id="tblCustomers"></div>
    <thead style="background-color: #092834;color: #B2D732;" >
  <th>Username</th>
  <th>Date</th>
  <th>utilized</th>
  <th>non utilized</th>
 
</thead>          
<tbody >
<?php
  if(isset($_POST['username'])){$usernames = $_POST['username'];}

  //date 1  
if(isset($_POST['date'])){$mydate = $_POST['date'];
// date 2
if(isset($_POST['date2'])){$mydate2 = $_POST['date2'];
  $first_query = sqlsrv_query( $con ,"SELECT [date]
      ,[username],[utilization],[non_utilized]
  FROM [Aya_Web_APP].[dbo].[employee_Utiliz_non_utiliz]
  where  username = '$usernames' and [date] BETWEEN '$mydate' AND '$mydate2'  order by 2,1 ");
  while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .= '<td width="5%" style="border: 1px solid #eee;color:#eee;">'.$output_query["username"].'</td>';
$rows .= '<td width="15%" style="border: 1px solid #eee;color:#eee;">'.$output_query["date"]->format('Y-m-d').'</td>';
if(floor(($output_query["utilization"])*100) >= 80)
  {
$rows .='<td style="width:10%;border:3px solid #eee;color:#eee; background-color:#64BA26;font-size:13px;">'.floor(($output_query["utilization"])*100).'%'.'</td>';
}
if(floor(($output_query["utilization"])*100) < 80)
  {
$rows .='<td style="width:10%; border: 3px solid #eee;color:#eee;background-color:#A30E00;font-size:13px ">'.floor(($output_query["utilization"])*100).'%'.'</td>';
}
$rows .='<td style="width:10%; border: 3px solid #eee;
background-color:lightgray ;font-size:13px;color:#092834; ">'.floor(($output_query["non_utilized"])*100).'%'.'</td>';
$rows .= '</tr>';
echo $rows;
}}
}
?>
</tbody>
</table>
</div>

          </div>
        </div>
      </div>
      <?php 
}

//end utilization 

?>

<?php
if(isset($_POST['submit'])){
/////utilization_table
 $first_query = sqlsrv_query( $con ,"SELECT * FROM utilization_table  where username ='$usernames' and[date] BETWEEN '$mydate' AND '$mydate2' order by 3 ");
  $chart_data22 ='';
 while( $output = sqlsrv_fetch_array($first_query)){
  $chart_data22 .="{ date22:'".$output['date']->format('Y-m-d')."',utilization:".floor(($output["utilization"])*100)."
  ,work_duration:'".$output['work_duration']->format('H:i:s')."',scheduled_duration:'".$output['scheduled_duration']->format('H:i:s')."'},";
}
$chart_data22 = substr($chart_data22, 0);

?>
<script src="js/bootstrap22.min.js"></script>
<script src="js/raphael22.min.js"></script>
<script src="js/morris22.min.js"></script>
<script src="js/fastclick22.js"></script>
<script src="js/adminlte22.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/morris.js"></script>
<script src="js/Chart.min"></script>

  <?php //if(isset($_GET['utiliz'])){?>

<script type="text/javascript">
     $(function () {
    "use strict";
//$utilization
var line = new Morris.Area({
      element: 'line-utiliz',
      resize: true,
      data: [<?php echo $chart_data22;?>],
      xkey: "date22",
      ykeys: ["utilization","non_utilized","user"],
      labels: ["utilization", "non_utilized","<?php echo $usernames?>"],
      hideHover: 'auto'
    });
});
</script>
<?php 
}
?>
 
</form>
<script src="js/table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "utilization_Per_user.xls"
            });
        }
    </script>
</div>
<?php 
include ("footer.html");
?>