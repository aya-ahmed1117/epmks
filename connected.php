
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/kpi_css.css">

<?php 
    require_once("inc/config.inc");
     if(isset($_POST['type'])){$type = $_POST['type'];}
        if(isset($_POST['username'])){$username = $_POST['username'];}
$this_year = date('Y');
    //$type = 'Permission';
$rows = '
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style=" background-color: #55608f;
    text-align: center;color: black;position: relative; ">
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Type</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Count</th>
          <th>wfm_note</th>
          <th>Status</th>
      </tr>
</thead>
<tbody>';
    //ID type start end status
$first_query = sqlsrv_query( $con ,"SELECT * FROM leaves WHERE 
    username ='$username' and [type] = '$type' and year([adate]) >='$this_year'  order by [creation_time] DESC ");

while($output_query = sqlsrv_fetch_array($first_query)){
$rows .='<tr >';
$rows .='<td class="sorting_1"style="border: 1px solid lightgray;">'.$output_query["id"].'</td>';
$rows .='<td class="sorting_1"style="border: 1px solid lightgray;">'.$output_query["username"].'</td>';

$rows .='<td class="sorting_1"style="border: 1px solid lightgray;">'.$output_query["type"].'</td>';
$rows .='<td class="sorting_1"style="border: 1px solid lightgray;">'.$output_query["adate"]->format('Y-m-d').'</td>';
$rows .='<td class="sorting_1"style="border: 1px solid lightgray;">'.$output_query["bdate"]->format('Y-m-d').'</td>';
$rows .='<td class="sorting_1"style="border: 1px solid lightgray;">'.$output_query["count"].'</td>';
$rows .='<td class="sorting_1"style="border: 1px solid lightgray;">'.$output_query["wfm_note"].'</td>';
if ($output_query["status"] == 'pending'){
$rows .='<td class="sorting_1"style="border: 1px solid lightgray;">'.$output_query["status"].'<span class="badge badge-warning pull-right" style="font-size:20px;color:yellow;">*</span></td>';
}
if ($output_query["status"] == 'E-workforce reject'){
$rows .='<td class="sorting_1"style="border: 1px solid lightgray;">'.$output_query["status"].'<span class="badge badge-danger pull-right" style="font-size:20px;color:red;">*</span></td>';
}
if ($output_query["status"] == 'senior reject'){
$rows .='<td class="sorting_1"style="border: 1px solid lightgray;">'.$output_query["status"].'<span class="badge badge-danger pull-right" style="font-size:20px;color:red;">*</span></td>';
}
if ($output_query["status"] == 'super reject'){
$rows .='<td class="sorting_1"style="border: 1px solid lightgray;">'.$output_query["status"].'<span class="badge badge-danger pull-right" style="font-size:20px;color:red;">*</span></td>';
}
if ($output_query["status"] == 'section reject'){
$rows .='<td class="sorting_1">'.$output_query["status"].'<span class="badge badge-danger pull-right" style="font-size:20px;color:red;">*</span></td>';
}
if ($output_query["status"] == 'Unit reject'){
$rows .='<td class="sorting_1"style="border: 1px solid lightgray;">'.$output_query["status"].'<span class="badge badge-danger pull-right" style="font-size:20px;color:red;">*</span></td>';
}

if ($output_query["status"] == 'E-workforce and senior approve'){
$rows .='<td class="sorting_1" style="border: 1px solid lightgray;">'.$output_query["status"].'<span class="badge badge-success pull-right" style="font-size:20px;color:green;">*</span></td>';
}
if ($output_query["status"] == 'senior approve'){
$rows .='<td class="sorting_1" style="border: 1px solid lightgray;">'.$output_query["status"].'<span class="badge badge-success pull-right" style="font-size:20px;color:green;">*</span></td>';
}
if ($output_query["status"] == 'super approve'){
$rows .='<td class="sorting_1" style="border: 1px solid lightgray;">'.$output_query["status"].'<span class="badge badge-success pull-right" style="font-size:20px;color:orange;">*</span></td>';
}
if ($output_query["status"] == 'section approve'){
$rows .='<td class="sorting_1" style="border: 1px solid lightgray;">'.$output_query["status"].'<span class="badge badge-success pull-right" style="font-size:20px;color:orange;">*</span></td>';
}
if ($output_query["status"] == 'Unit approve'){
$rows .='<td class="sorting_1" style="border: 1px solid lightgray;">'.$output_query["status"].'<span class="badge badge-success pull-right" style="font-size:20px;color:orange;">*</span></td>';
}
if ($output_query["status"] == 'On hold'){
$rows .='<td class="sorting_1" style="border: 1px solid lightgray;">'.$output_query["status"].'<span class="badge badge-warning pull-right" style="font-size:20px;color:orange;">*</span></td>';
}

$rows .='</tr>';
}
echo $rows;

?>
</tbody>

        </table>
