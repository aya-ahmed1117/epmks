
<?php
include ("pages.php");
$curr_year = date('Y'); 
if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];
}  

$check_engineers  = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_id'   ");
   while( $output_engineers = sqlsrv_fetch_array($check_engineers)){

  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'] ;
}

$sql = "SELECT * FROM swaping where  username ='$eng_username'  ORDER BY 1 desc ";
$result = sqlsrv_query($con, $sql);


?>

	<title>Team Swapm</title>

  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">

</head> 
<style type="text/css">
table.table-striped tbody tr:nth-of-type(odd) {
      background-color: #fcfcfc;
  }
  table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
  }
    table.table td a {
        color: #2196f3;
    }

 
 table {
  box-shadow: 0 0 2px rgba(0,0,0,0.1);
  text-align: center;
  overflow: auto;
  overflow-x: auto;
  border-radius: 30px 30px 0  0;
  padding:20px;
}
.tableFixHead tbody {
      /*height: 150px;*/
      background-color: white;
      
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
              <h2 class="text-dark display-12" >Swap history</h2>
  
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This page shows all swaps that takes place upon your requests</p>
  </aside>
</div>
</center>
<br/>
<br/>

<center>
 <div style="padding:20px;">
        
  <div class="tableFixHead">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
      <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
      <tr >  
        <th class="tthh" ><strong>Swap ID</strong></th>
        <th class="tthh" ><strong>Username</strong></th>
        <th class="tthh"><strong>Date</strong></th> 
        <th class="tthh"><strong>Note</strong></th> 
        <th class="tthh"><strong>Status</strong></th> 
        <th class="tthh"><strong>More Details</strong></th>
    </tr> 
      </thead>
                 <tbody>               

                <?php
                $j = 1;
                while ($row = sqlsrv_fetch_array($result)) {
                    ?> 
                    <tr>
    <td class="hovers" style="border: 1px solid lightgray;" width="1%"><?php echo $row['id'];// $j; ?></td>
<td style="border: 1px solid lightgray;" class=""width="1%"><?php echo $row['username']; ?></td>

    <td class="hovers" style="border: 1px solid lightgray;" class="counterCell"  width="13%"><?php echo $row["user_covering_date_from"]->format("Y-m-d");  //$j; ?></td>
    <!--td style="border: 1px solid lightgray;" class=""  width="19%" ><?php  $row["creation_time"]->format("Y-m-d H:i:s"); ?></td-->
    <td style="border: 1px solid lightgray;" class=""  width="19%"><?php echo $row['wfm_note']; ?></td>
        <!--td style="border: 1px solid lightgray;" class=""  width="19%"><?php  $row['status']; ?></td-->
        <?php
       
if($row["status"] == 'Pending'){
  echo  '<td width="2%" class="hovers" style="
    border: 1px solid #eee;font-size:15px;background-color:#f8a300;color:white;">'.$row["status"].'</td>';}
if($row["status"] == 'Swap Done'){
   echo '<td width="2%" class="hovers" 
    style="border: 1px solid #eee;font-size:15px;background-color:green;color:white;">'.$row["status"].'</td>';}
   if($row["status"] == 'Reject'){
echo '<td class="hovers" width="2%" style="background-color: #cc0000; font-size=10px; border-radius: 4px 4px 5px 5px;box-sizing: border-box; border: 2px solid #eee;color:white;">
'.$row["status"]."</td>";} 

?>
 <td  style="border: 1px solid lightgray;">
      <button type="button" class="btn btn-xs bg-maroon" 
      style="width:25% ;border: 1px solid lightgray;" data-toggle="collapse" data-target="#divCol_<?php echo $j; ?>">Details 
          <i class="fa fa-plus"></i>

      </button>&emsp;<?php // $row['status']; ?>

  <div class="collapse" id="divCol_<?php echo $j; ?>">
  
<?php 

  echo'
<div data-status="all" class="table table-striped table-hover" >';
echo'  <table class="order-table table"  data-status="all" style="width:100%;border-radius: 20px 20px 20px 20px;">
            <thead data-status="all">
                <tr data-status="all">
    <th style="background-color: #55608f;color:white;">Swaper name</th>
    <th style="background-color: #55608f;color:white;">New Date</th>
    <th style="background-color: #55608f;color:white;">New Shift start</th>
    <th style="background-color: #55608f;color:white;">New Shift end</th>
    <th style="background-color: #55608f;color:white;">Reason</th>
                </tr>
            </thead><tbody >';
            $fofo=$row['id'];
$recored = sqlsrv_query( $con ,"SELECT * FROM 
  swaping where id  = '$fofo'   order by 1 DESC  ");
     while ( $output_query= sqlsrv_fetch_array($recored)){
$rows  ='<tr  >';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["swaper_name"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["swaper_date_from"]->format('Y/m/d').'</td>';
$rows .='<td class="hovers"   style="border: 1px solid lightgray;">'.$output_query["user_covering_shift_start"].'</td>';
$rows .='<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["user_covering_shift_end"].'</td>';
$rows .='<td class="hovers"  style="border: 1px solid lightgray;">'.$output_query["reason"].'</td>';
  $rows.="</tr>";
  echo $rows;
echo'</tbody></table>
</div>
';}

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
        </center>     
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
   <?php

 include ("footer.html");
 ?>
