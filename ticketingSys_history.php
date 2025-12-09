
<?php
include ("pages.php");
if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];
}  
$Employee_app_Id = $_SESSION['id'];
$Requester = $_SESSION['username'];

if(isset($_GET['Employee_app_Id'])){
  $Employee_app_Id = $_GET['Employee_app_Id'];}

$sql = "SELECT * FROM tbl_Ticketing_system where  Requester_username = '$Requester'  and creation_time >='2023-01-01'ORDER by creation_time  desc";

$result = sqlsrv_query($con, $sql);

?>
<?php

$sql = "SELECT * FROM tbl_Ticketing_system where  Requester_username = '$Requester'and creation_time >='2023-01-01' ORDER by creation_time desc";
$result = sqlsrv_query($con, $sql);

// Numeric array
//$row = mysqli_fetch_array($result);
?>

	<title>Ticketing System History</title>
    <link rel="stylesheet" href="css/my_table.css"></head> 
    <link rel="stylesheet" type="text/css" href="css/kpi_css.css">

<style type="text/css">
table {
  border-collapse: collapse;
  overflow: hidden;
  overflow-x: auto;
  box-shadow: 0 0 2px rgba(0,0,0,0.1);
  text-align: center;
  background-color: white;
}
tr:nth-child(even) {
  background-color: #f8f6ff;
}

td {
  padding:5px;
  background-color: rgba(255,255,255,0.2);
  color: black;
  position: relative;
}

  th {
    padding:10px;
    background-color: #55608f;
    text-align: center;
  color: white;


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
      height: 350px;
      background-color: white;
      overflow-x: auto;
    }
   
    .tableFixHead thead  {
      display: block;
    }
   
    .tableFixHead th, .tableFixHead td {
    width: 250px;
}
    table.table-striped  tr:nth-of-type(odd) {
      background-color: #f8f6ff;
  }
  table.table-striped.table-hover  tr:hover {
    background: #f8f6ff;
  }
    table.table td a {
        color: #2196f3;
    }


</style> 
<center>
<div class="col-md-10">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Ticketing System History
              <a href="ticketing_system.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
  
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This page shows all swaps that takes place upon your requests</p>
  </aside>
</div>
</center>
<br>
         
<?php 
 $pending = sqlsrv_query($con," SELECT count([Request_ID]) refund
    FROM tbl_Ticketing_system
  where Request_status = 'pending to requester' and Requester_username ='$Requester'  ");
  
  $total_refund = sqlsrv_fetch_array($pending);
   $total = $total_refund['refund'];
   ?>
    <div class="table-wrapper"style="margin-bottom: 25px;">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-12"><h2>
<?php if($total_refund['refund'] >0){?>
  <div class="alert alert-warning" role="alert">
     <i class="fa fa-exclamation-triangle"></i>   You have pending request
  <samp> = <?php  echo $total ; ?></samp>
<?php } ?></h2>
            </div>            
        </div>
    </div>
</div>
  <center>
    <div style="padding:20px;">
 <div class="tableFixHead col-md-8">
        
  <table id="yourEvent" cellspacing="0"id="tblCustomers" style="border-radius:30px 30px 30px 30px;" >
      <thead style="color: white; font-weight: bold; text-align: center; ">
      <tr > 
                <th style="width: 10%;"><strong>ID</strong></th>
                <th><strong>Type</strong></th> 
                <th><strong>Creation time</strong></th> 
                <th ><strong>WFM note</strong></th> 
                <th><strong>Status</strong></th> 
                <th><strong>Details</strong></th> 
   </tr>
    </thead>

<tbody>
                <?php
                $j = 1;
                while ($row = sqlsrv_fetch_array($result)) {
                    ?> 
                    <tr>
    <td class="hovers" style="border: 1px solid lightgray;width: 10%;" 
    ><?php echo $row['Request_ID'];// $j; ?></td>

    <td class="hovers" style="border: 1px solid lightgray;"   width="13%"><?php echo $row["Request_Type"] //$j; ?></td>
    <td class="hovers" style="border: 1px solid lightgray;" ><?php echo $row["Creation_time"]->format("Y-m-d H:i:s"); ?></td>

    <td style="border: 1px solid lightgray;" class="hovers" 
    width="5px"><?php echo $row['WFM_Update_note']; ?></td>
<?php 
if( $row['Request_status'] == 'pending to requester'){
echo  $rows ='<td style="color:red; color:#b30000; border: 1px solid #lightgray;"class="hovers" value=" '.$row["Request_status"].'">
<a type="button" width="5%" style="box-shadow: 0 8px 16px 0 rgba(0,0,0,0.9), 0 6px 22px 0 rgba(0,0,0,0.20);"
class="btn btn btn-outline-success" 
href="update_ticket_sys.php?Request_ID='.$row["Request_ID"].'&Employee_app_Id='.$row["Employee_app_Id"].'
&Request_Type='.$row["Request_Type"].' ">
Update</a>
</td>'; }
 if($row['Request_status']== 'closed'){
  echo
'<td style="width:10%;background-color:black; color:#eee; border: 1px solid #lightgray;" class="hovers"
value=" '.$row["Request_status"].' ">'. $row["Request_status"].'</td>'; }
if($row['Request_status']== 'in progress'){
echo'<td style="width:5%;background-color:orange; color:black; border: 1px solid #lightgray;" 
value=" '.$row["Request_status"].' ">'.$row["Request_status"].'
</td>';}
if($row['Request_status']== 'pending to admin'){
  echo'<td style="width:5%; background-color:yellow; color:black; border: 1px solid #lightgray;" 
value=" '.$row["Request_status"].' ">'.$row["Request_status"].'
</td>'; }
if($row['Request_status']== 'on hold'){
  echo'<td style="width:5%;background-color:yellow; color:clack; border: 1px solid #lightgray;" 
value=" '.$row["Request_status"].' ">'.$row["Request_status"].'
</td>'; }
if( $row['Request_status'] == 'Open'){
  echo
'<td style="width:5%;background-color:green; color:#eee; border: 1px solid #lightgray;" 
value=" '.$row["Request_status"].' ">'. $row["Request_status"].'</td>'; }
 ?>
    <td class="collapses">
      <button type="button" class="btn btn-xs bg-maroon" 
      style="border: 1px solid lightgray;"data-toggle="collapse" data-target="#divCol_<?php echo $j; ?>">Details 
          <i class="fa fa-plus"></i>
      </button>&emsp;<?php  $row['Request_Type']; ?>

  <div class="collapse" id="divCol_<?php echo $j; ?>">
  
 <?php 
  if($row['Request_Type'] == 'Change schedule'){
  echo'
<div data-status="all" class="table table-striped table-hover" >';
echo'  <table  data-status="all" style="width:100%;">
            <thead data-status="all">
                <tr data-status="all">
                    <th background-color:#eee;>Note</th>
                    <th background-color:#eee;>Ticket Subject</th>
                </tr>
            </thead><tbody style="height:auto;">';
            $fofo=$row['Request_ID'];
$recored = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system where Request_ID  = '$fofo'   order by 1 DESC  ");
     while ( $row= sqlsrv_fetch_array($recored)){
$rows  ='<tr>';
$rows .='<td style="border: 1px solid lightgray;color:black;">'.$row["Note"].'</td>';
$rows .='<td style="border: 1px solid lightgray;color:black;">'.$row["Ticket_Subject"].'</td>';
  $rows.="</tr>";

  echo $rows;
echo'</tbody></table></div>';}}
?>
   <?php 
  if($row['Request_Type'] == 'Delete recored'){
echo'  
<div data-status="all" class="table table-striped table-hover" >';
echo'  <table style="width:100%;">
            <thead>
                <tr>
                    <th>Note</th>
                    <th>Ticket Subject</th>
                </tr>
            </thead><tbody style="height:auto;">';
            $fofo=$row['Request_ID'];
$recored = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system where Request_ID  = '$fofo'   order by 1 DESC  ");
     while ( $row= sqlsrv_fetch_array($recored)){
$rows  ='<tr>';
$rows .='<td width="5" style="border: 1px solid lightgray;color:black;">'.$row["Note"].'</td>';
$rows .='<td  style="border: 1px solid lightgray;color:black;">'.$row["Ticket_Subject"].'</td>';
  $rows.="</tr>";

  echo $rows;
echo'</tbody></table></div>';}}
?>
 <?php 
 if($row['Request_Type'] == 'Change Management'){
 '<td name="Management"><button type="button" class="btn btn-xs bg-maroon" style="width: 20px" data-toggle="collapse" data-target="#divCol_'.$j.'">
      <a href="php.php?Request_ID='.$row["Request_ID"].'&Management">'.$row["Request_Type"].'</a></button> '; 
  echo'
<div data-status="all" class="table table-striped table-hover" >';
echo'  <table >
            <thead >
                <tr>
          <th>Employee Username</th>
          <th>Last working date</th>
          <th>Employee_new_manager</th>
          <th>Note</th>
          <th>Ticket Subject</th>
                </tr>
            </thead><tbody style="height:auto;">';
            $fofo=$row['Request_ID'];
$recored = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system where Request_ID  = '$fofo'   order by 1 DESC  ");
     while ( $row= sqlsrv_fetch_array($recored)){
$rows  ='<tr >';
$rows .='<td  style="border: 1px solid lightgray;color:black;">'.$row["Employee_Username"].'</td>';
$rows .='<td  style="border: 1px solid lightgray;color:black;">'.$row["Last_working_date"]->format('Y/m/d').'</td>';
$rows .='<td  style="border: 1px solid lightgray;color:black;">'.$row["Employee_new_manager"].'</td>';
$rows .='<td width="5"style="border: 1px solid lightgray;color:black;">'.$row["Note"].'</td>';
$rows .='<td style="border: 1px solid lightgray;color:black;">'.$row["Ticket_Subject"].'</td>';
  $rows.="</tr>";
  echo $rows;
echo'</tbody></table>
</div>';}}
?>
 <?php 
  if($row['Request_Type'] == 'Change from OutSource to Staff'){
   echo'
<div data-status="all" class="table table-striped table-hover" >';
echo'  <table>
        <thead>
            <tr>
                <th>Employee Username</th>
                <th>Last working date</th>
                <th>Employee_new_username</th>
                <th>Employee_new_id</th>
                <th>Note</th>
                <th>Ticket Subject</th>
            </tr>
            </thead><tbody style="height:auto;">';
            $fofo=$row['Request_ID'];
$recored = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system where Request_ID  = '$fofo'   order by 1 DESC  ");
     while ( $output_query= sqlsrv_fetch_array($recored)){
$rows  ='<tr data-status="all" >';
$rows .='<td style="border: 1px solid lightgray;color:;">'.$output_query["Employee_Username"].'</td>';
$rows .='<td   style="border: 1px solid lightgray;color:;">'.$output_query["Last_working_date"]->format('Y/m/d').'</td>';
$rows .='<td style="border: 1px solid lightgray;color:;">'.$output_query["Employee_new_username"].'</td>';
$rows .='<td style="border: 1px solid lightgray;color:;">'.$output_query["Employee_new_id"].'</td>';
$rows .='<td style="border: 1px solid lightgray;color:;">'.$output_query["Note"].'</td>';
$rows .='<td  style="border: 1px solid lightgray;color:;">'.$output_query["Ticket_Subject"].'</td>';
  $rows.="</tr>";

  echo $rows;
echo'</tbody></table>
</div>';}}
?>
 <?php 
 '<td name="Resign"><button type="button" class="btn btn-xs bg-maroon" style="width: 20px" data-toggle="collapse" data-target="#divCol_'.$j.'">
      <a href="php.php?Request_ID='.$row["Request_ID"].'&Resign">'.$row["Request_Type"].'</a></button> '; 
 //if(isset($_GET['recored'])){
  if($row['Request_Type'] == 'Resign employees'){
  echo'
<div data-status="all" class="table table-striped table-hover" >';
echo'  <table >
            <thead >
                <tr>
    <th>Employee Username</th>
    <th>Last working date</th>
    <th>Reason of leave</th>
    <th>Note</th>
    <th>Ticket Subject</th>
                </tr>
            </thead><tbody style="height:auto;">';
            $fofo=$row['Request_ID'];
$recored = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system where Request_ID  = '$fofo'   order by 1 DESC  ");
     while ( $output_query= sqlsrv_fetch_array($recored)){
$rows  ='<tr >';
$rows .='<td   style="border: 1px solid lightgray;color:;">'.$output_query["Employee_Username"].'</td>';
$rows .='<td style="border: 1px solid lightgray;color:;">'.$output_query["Reason_of_leave"].'</td>';
$rows .='<td   style="border: 1px solid lightgray;color:black;">'.$output_query["Last_working_date"]->format('Y/m/d').'</td>';
$rows .='<td style="border: 1px solid lightgray;color:black;">'.$output_query["Note"].'</td>';
$rows .='<td  style="border: 1px solid lightgray;color:black;">'.$output_query["Ticket_Subject"].'</td>';
  $rows.="</tr>";

  echo $rows;
echo'</tbody></table>
</div>
';}}
?>
<?php 
 '<td name="Promotion"><button type="button" class="btn btn-xs bg-maroon"data-toggle="collapse" data-target="#divCol_'.$j.'">
      <a href="php.php?Request_ID='.$row["Request_ID"].'&Promotion">'.$row["Request_Type"].'</a></button> '; 
  if($row['Request_Type'] == 'Employee Promotion'){
  echo'
<div data-status="all" class="table table-striped table-hover" >';
echo'  <table class="order-table table"  data-status="all" >
            <thead data-status="all">
                <tr data-status="all">
    <th>Employee Username</th>
    <th>Last working date</th>
    <th>Grade</th>
    <th>Note</th>
    <th>Ticket Subject</th>
                </tr>
            </thead><tbody style="height:auto;">';
            $fofo=$row['Request_ID'];
$recored = sqlsrv_query( $con ,"SELECT * FROM tbl_Ticketing_system where Request_ID  = '$fofo'   order by 1 DESC  ");
     while ( $output_query= sqlsrv_fetch_array($recored)){
$rows  ='<tr  >';
$rows .='<td style="border: 1px solid lightgray;">'.$output_query["Employee_Username"].'</td>';
$rows .='<td style="border: 1px solid lightgray;color:black;">'.$output_query["Last_working_date"]->format('Y/m/d').'</td>';
$rows .='<td style="border: 1px solid lightgray;color:black;">'.$output_query["Employee_grade"].'</td>';
$rows .='<td style="border: 1px solid lightgray;color:black;">'.$output_query["Note"].'</td>';
$rows .='<td  style="border: 1px solid lightgray;color:black;">'.$output_query["Ticket_Subject"].'</td>';
  $rows.="</tr>";
  echo $rows;
echo'</tbody></table>
</div>
';}}
?>          

<?php 
//sub_group
'<td name="Promotion"><button type="button" class="btn btn-xs bg-maroon"data-toggle="collapse" data-target="#divCol_'.$j.'">
<a href="php.php?Request_ID='.$row["Request_ID"].'&Promotion">'.$row["Request_Type"].'</a></button> '; 
  if($row['Request_Type'] == 'Change sub_group'){
  echo'
<div data-status="all" class="table table-striped table-hover" >';
echo'  <table class="order-table table"  data-status="all" >
            <thead data-status="all">
                <tr data-status="all">
    <th>Employee Username</th>
    <th>Last working date</th>
    <th>sub_group</th>
    <th>Note</th>
    <th>Ticket Subject</th>
                </tr>
            </thead><tbody style="height:auto;">';
            $fofo=$row['Request_ID'];
$recored = sqlsrv_query( $con ,"SELECT *,
CASE
    WHEN sub_group ='1' THEN 'phone'
    WHEN sub_group ='2' THEN 'Resident'
    WHEN sub_group ='3' THEN 'Mail'
    WHEN sub_group ='4' THEN 'TAM'
    WHEN sub_group ='5' THEN 'Schools'
    WHEN sub_group ='6' THEN 'Mega Projects'
   else ''
        END sub_group2
 FROM tbl_Ticketing_system where Request_ID  = '$fofo'   order by 1 DESC  ");
     while ( $output_query= sqlsrv_fetch_array($recored)){
$rows  ='<tr  >';
$rows .='<td style="border: 1px solid lightgray;">'.$output_query["Employee_Username"].'</td>';
$rows .='<td style="border: 1px solid lightgray;color:black;">'.$output_query["Last_working_date"]->format('Y/m/d').'</td>';
$rows .='<td style="border: 1px solid lightgray;color:black;">'.$output_query["sub_group2"].'</td>';
$rows .='<td style="border: 1px solid lightgray;color:black;">'.$output_query["Note"].'</td>';
$rows .='<td  style="border: 1px solid lightgray;color:black;">'.$output_query["Ticket_Subject"].'</td>';
  $rows.="</tr>";
  echo $rows;
echo'</tbody></table>
</div>
';}}
?>  

</div>

                        </td>

                    </tr>
                    <?php
                    $j++;
                }
                ?>  
     
</tbody>
</table>
</div>
</div>
</div>
</center>
    

   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
   <?php

 include ("footer.html");
 ?>
