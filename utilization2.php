
 <?php
        require_once("inc/config.inc");
  if($_SESSION['username'] == ''){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }
      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      ?>
<!DOCTYPE html>
<html>

<head>

<link rel="stylesheet" href="css/style4.css">


</head>
<body>

<form method="post" class="form-horizontal">

<a role="button" href="Ticket_Process_Tracking.php" >

  <h4 style="width:20%;float:right;transform: translate(-5px,-10px); font-size: 17px;font-weight: bold;">
    <span style="background-color: orange;
  border-radius: 10px 10px 10px 10px;padding: 10px; ">
  <i class="fas fa-exclamation-triangle"></i> 
  Press this button to Tracking your Tickets
  <i class="fas fa-arrow-alt-circle-right"></i></span></h4></a>
<br>
<br>

<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">
    <tbody>
      <div id="" style="overflow:scroll;overflow-x: hidden; height:350px;">
<table align="center" class="order-table table" style="color: #702283; flex-wrap: wrap;
  position: relative; margin-left:3%;
  font-style: normal; width: 125%;
  border: 2px solid #7386D5;
  font-family: Century Gothic;
   grid-template-columns: auto auto auto auto; grid-gap: 15px; ">
    <thead style=" background-color: #7386D5; color: #eee;">
    
    
          <th style=" border: 1px solid rgb(102, 0, 102); padding: 8px ;font-size: 11px;"  >date</th>
          <th style=" border: 1px solid rgb(102, 0, 102); padding: 8px ;font-size: 11px;" >username</th>
          <th style=" border: 1px solid rgb(102, 0, 102); padding: 8px ;font-size: 11px;">manager</th>
          <th style=" border: 1px solid rgb(102, 0, 102); padding: 8px ;font-size: 11px;">shift start </th>
          <th style=" border: 1px solid rgb(102, 0, 102); padding: 8px ;font-size: 11px;"> end start</th>
          <th style=" border: 1px solid rgb(102, 0, 102); padding: 8px ;font-size: 11px;"> shift_duration</th>
          <th style=" border: 1px solid rgb(102, 0, 102); padding: 8px ;font-size: 11px;"> work_duration</th>
          <th style=" border: 1px solid rgb(102, 0, 102); padding: 8px ;font-size: 11px;" > utilization</th>
         
</thead>
  <tbody>
<?php    
$s_username = $_SESSION['username'];
$self = $_SESSION['id'];
//mysqli -> select data from table 
//SELECT * FROM utilization_table WHERE username ='$s_username' order by 3 

  $first_query = sqlsrv_query( $con ," SELECT * FROM utilization_table WHERE engineer_id ='$self' or username='$s_username' order by 3 ");
  while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .='<td width="6%" style="border: 3px solid #eee;background-color:lightgray ;font-size:13px ">'.$output_query["date"]->format('Y-m-d').'</td>';
$rows .='<td width="2%" style="border: 3px solid #eee;background-color:lightgray ;font-size:13px ">'.$output_query["username"].'</td>';
$rows .='<td width="2%" style="border: 3px solid #eee;background-color:lightgray ;font-size:13px ">'.$output_query["manager"].'</td>';
$rows .='<td width="5%" style="border: 3px solid #eee;background-color:lightgray ;font-size:13px ">'.$output_query["shift_start"]->format('H:i:s').'</td>';
$rows .='<td width="2%" style="border: 3px solid #eee;background-color:lightgray ;font-size:13px ">'.$output_query["shift_end"]->format('H:i:s').'</td>';
$rows .='<td width="2%" style="border: 3px solid #eee;background-color:lightgray ;font-size:13px ">'.$output_query["scheduled_duration"]->format('H:i:s').'</td>';
$rows .='<td width="1%" style="border: 3px solid #eee;background-color:lightgray ;font-size:13px ">'.$output_query["work_duration"]->format('H:i:s').'</td>';
//$rows .='<td width="3%" style="border: 3px solid #eee;background-color:lightgray ;">'.$output_query["utilization"].'%'.'</td>';
$rows .='<td width="3%" style="border: 3px solid #eee;background-color:lightgray ;font-size:13px ">'.floor(($output_query["utilization"])*100).'%'.'</td>';

//"<a href='utilization.php?id=" .$output['utilization']."' target=_blank> edit</a>".'</td>';
$rows .='</tr>';

echo $rows;
}
?>


</tbody>
</table>
</form>
</div>
<script type='text/javascript'>
  
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
      Arr.forEach.call(tables, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);
  
</script>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
    </div>
</body>

</html>
