<?php 
include ("pages.php");
?>

<head>
	<title>Bank MASR</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.1/raphael-min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="js/justgage.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" href="css/ionicons.min.css">
<link rel="stylesheet" href="css/morris22.css">
<link rel="stylesheet" href="css/AdminLTE.min.css">
<link rel="stylesheet" href="css/_all-skins.min.css">
<link rel="stylesheet" type="text/css" href="css/kpi_css.css">
  </head>

 <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Bank Misr Reporting IP Problemside
      <a href="psc_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
     <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;"> To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>

</center>
<center>
 <div style="padding:20px;">
    
<table class="table order-table"cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr> 
        <th style="color: white;">Ticket_Number</th>
        <th style="color: white;">Site_Name </th>
        <th style="color: white;">IP </th>
        <th style="color: white;">Ticket_Date </th>
        <th style="color: white;">Ticket_Time </th>
        <th style="color: white;">Solve_Date </th>
        <th style="color: white;">Solve_Time </th>
        <th style="color: white;">Problem_Side </th>
        <th style="color: white;">Reason_Of_Problem </th>
  </tr>
  </thead>
  <tbody>
    <?php
   
  $first_query = sqlsrv_query($con,"SELECT  [ID]
      ,[Ticket_Number]
      ,[Site_Name]
      ,[IP]
      ,[Ticket_Date]
      ,[Ticket_Time]
      ,[Solve_Date]
      ,[Solve_Time]
      ,[Problem_Side]
      ,[Reason_Of_Problem]
  FROM [WorkForce_Reporting_DB].[dbo].[BM_Report_IP_Problemside]");
  
  while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .= '<td style="border: 1px solid lightgray;">'.$output_query["Ticket_Number"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Site_Name"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["IP"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Ticket_Date"]->format('Y-m-d').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Ticket_Time"]->format('H:i:s').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Solve_Date"]->format('Y-m-d').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Solve_Time"]->format('H:i:s').'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Problem_Side"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Reason_Of_Problem"].'</td>';
$rows .= '</tr>';
echo $rows;
}
?>
</tbody>
</table>
</div>
</center>
<script>
$(document).ready(function(){
  $("td:lang(ar)").css("background-color");
});
</script>
<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "BM_IP_problems.xls"
            });
        }
    </script>
<script src="js/jquery22.min.js"></script>
<script src="js/bootstrap22.min.js"></script>
<script src="js/raphael22.min.js"></script>
<?php 
include ("footer.html");

?>