

<?php 
	require_once("inc/config.inc");
	$s_username = $_SESSION['username'];
?>
<style type="text/css">

.hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
        tr:nth-child(even) {
  background-color: lightgray;
}


td {
  padding:9px;
  font-size: 15px;
  /*background-color: rgba(255,255,255,0.2);*/
  color: black;
}

  th {
  padding:9px;
  font-size: 15px;
  background-color: #55608f;
  color: white;

  }


 .well {
    background: none;
    height: 320px;
}

.table-scroll tbody {
    position: absolute;
    overflow-y: scroll;
    height: 250px;
}

.table-scroll tr {
    width: 50%;
    table-layout: fixed;
    display: inline-table;
}

.table-scroll thead > tr > th {
    border: none;
}
</style>

<br>
	<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>

<div class="col-xs-offset-2 well">
    <table class="table table-scroll table-striped">
        <thead>
            <tr>
           <th ><center>Type </center></th>
          <th ><center>From date</center></th>
          <th ><center>To date</center></th>
          <th ><center>From time</center></th>
          <th ><center>To time</center></th>
          <th ><center>Notes</center></th>
          <th ><center>Count </center></th>
          <th ><center>Status</center></th>
          <th ><center>Attach</center></th>
            </tr>
        </thead>
        
        

<tbody>
<?php 
   $s_username = $_SESSION['username'];
$first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE username ='$s_username' order by [creation_time] DESC ");
while($output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr >';
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query["type"].'</canter></td>';
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query["adate"]->format('Y-m-d').'</canter></td>';
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query["bdate"]->format('Y-m-d').'</canter></td>';
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query["starttime"]->format('H:i:s').'</canter></td>';
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query["endtime"]->format('H:i:s').'</canter></td>';
$rows .='<td class="cell100 column1 hovers" style="font-size:11px"><center>'.$output_query["notes"].'</canter></td>';
$rows .='<td class="cell100 column1 hovers"><center>'.$output_query["count"]. '</canter></td>';
$rows .='<td class="cell100 column1 hovers" style="color:green;"><canter>'.$output_query["status"].'</canter></td>';
if(($output_query["attach"] !== "uploads/") && ($output_query["attach"] !== " ") && ($output_query["type"] == "Sick Leave"  || $output_query["type"] == "Compassionate Leave"  || 
    $output_query["type"] == "Maternity Leave" || $output_query["type"] == "Paternity Leave")){
$rows .= '<td  class="cell100 column1 pt-3-half hovers" ><center><a href='.$output_query["attach_image"].' download><samp style="float:center;font-size:25px;"><i class="fa fa-paperclip hovers" style="color:orange;"></samp></i></a>'.'</canter></td>';
}
else{
  $rows .= '<td class="hovers"></td>';}

$rows .='</tr>';
       echo  $rows;
       '
';

}?>
</tbody>
    </table>
</div>



                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Table Head</strong>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">First</th>
                                      <th scope="col">Last</th>
                                      <th scope="col">Handle</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                 <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                 <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                 <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                 <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                 <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

