
<link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
<?php 
	require_once("inc/config.inc");
	$s_username = $_SESSION['username'];
    $self =$_SESSION['id'];

		if(isset($_POST['type'])){$type = $_POST['type'];}	
    //$type = 'Permission';
$rows = '<div class="col-sm-12">
<table class="table table-hover table-bordered table-sm text-center dataTable" 
id="example" cellpadding="0" cellspacing="0" border="0" class="dataTable"
style="border-radius:  0 0 30px 30px;" width="100%" align="center">
    <thead>
    	<tr>
          <th>ID</th>
          <th>Type</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Count</th>
          <th>Status</th>
      </tr>
</thead>
<tbody>';

//senior
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE manager_id = '$self'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
   $engineers_id = $output_engineers['username_id'];
}
	//ID type start end status
$first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE engineer_id = '$engineers_id'   and type = '$type'");
echo "SELECT * FROM leaves WHERE engineer_id = '$engineers_id' and type = '$type'";

while($output_query = sqlsrv_fetch_array($first_query)){
$rows .='<tr >';
$rows .='<td class="sorting_1">'.$output_query["id"].'</td>';
$rows .='<td class="sorting_1">'.$output_query["Annual Leave"].'</td>';
/*
$rows .='<td class="sorting_1">'.$output_query["adate"]->format('Y-m-d').'</td>';
$rows .='<td class="sorting_1">'.$output_query["bdate"]->format('Y-m-d').'</td>';
$rows .='<td class="sorting_1">'.$output_query["count"].'</td>';
if ($output_query["status"] == 'pending'){
$rows .='<td class="sorting_1">'.$output_query["status"].'<span class="badge badge-warning pull-right">*</span></td>';
}
if ($output_query["status"] == 'E-workforce reject'){
$rows .='<td class="sorting_1">'.$output_query["status"].'<span class="badge badge-danger pull-right" >*</span></td>';
}
if ($output_query["status"] == 'senior reject'){
$rows .='<td class="sorting_1">'.$output_query["status"].'<span class="badge badge-danger pull-right" >*</span></td>';
}
if ($output_query["status"] == 'super reject'){
$rows .='<td class="sorting_1">'.$output_query["status"].'<span class="badge badge-danger pull-right" >*</span></td>';
}
if ($output_query["status"] == 'section reject'){
$rows .='<td class="sorting_1">'.$output_query["status"].'<span class="badge badge-danger pull-right" >*</span></td>';
}
if ($output_query["status"] == 'Unit reject'){
$rows .='<td class="sorting_1">'.$output_query["status"].'<span class="badge badge-danger pull-right" >*</span></td>';
}


if ($output_query["status"] == 'E-workforce and senior approve'){
$rows .='<td class="sorting_1" width="25%">'.$output_query["status"].'<span class="badge badge-success pull-right" >*</span></td>';
}
if ($output_query["status"] == 'senior approve'){
$rows .='<td class="sorting_1" width="25%">'.$output_query["status"].'<span class="badge badge-success pull-right" >*</span></td>';
}
if ($output_query["status"] == 'super approve'){
$rows .='<td class="sorting_1" width="25%">'.$output_query["status"].'<span class="badge badge-success pull-right" >*</span></td>';
}
if ($output_query["status"] == 'section approve'){
$rows .='<td class="sorting_1" width="25%">'.$output_query["status"].'<span class="badge badge-success pull-right" >*</span></td>';
}
if ($output_query["status"] == 'Unit approve'){
$rows .='<td class="sorting_1" width="25%">'.$output_query["status"].'<span class="badge badge-success pull-right" >*</span></td>';
}
if ($output_query["status"] == 'On hold'){
$rows .='<td class="sorting_1" width="25%">'.$output_query["status"].'<span class="badge badge-warning pull-right" >*</span></td>';
}
*/
$rows .='</tr>';
}//}
$rows  .= '</tbody>';
$rows  .= '<tfoot>
            <tr>
               <th>ID</th>
              <th>Type</th>
              <th>Start Date</th>
              <th>End Date</th>
              <th>Count</th>
              <th>Status</th>
            </tr>
        </tfoot>
        </table>
        </div>';
echo $rows;
?>
<script>

$(document).ready(function() {
$('#example').DataTable( {
"lengthMenu": [[5,10,25,50, -1], [5,10,25,50, "All"]],
"sPaginationType": "full_numbers",
        "oLanguage": {
            "sLengthMenu": "Beebop _MENU_ adoowop"
        }
} );
} );
</script>
