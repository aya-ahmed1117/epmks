


<?php 
include ("pages.php");
/*
utiliz
Absence
*/
?>
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
  </head>
      <div class="row">
       <center>
           <div class="col-md-6">
          <div class="box box-warning" style="background-color: #092834;">

            <div class="box-header with-border">
              <h3 class="box-title" style="color:#eee;">Absence
              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div><!-- header -->

            <div class="box-body chart-responsive">
          <div class="chart" id="line-Absence"style="height: 300px;"></div>
        </div><!-- responsive -->
        <div class="card-body">
    <div class="legend" style="color: white;">
    <i class="fa fa-circle text-primary" style="color:;"></i> Absence
    </div>
    </div>

    <hr>
    <div class="table table-striped table-hover" style="overflow:scroll;overflow-x: hidden; height:350px;">
 <table  class="order-table table"></div>
    <thead style="background-color: #092834;color: #B2D732;" >
  <th >Username</th>
  <th >Date</th>
  <th> Absence</th>
 
</thead>          
   
<tbody >
<?php

  $first_query = sqlsrv_query( $con ,"SELECT [username]
      ,[schedule_date]
      ,[Absence]
  FROM [Aya_Web_APP].[dbo].[Absence_per_day]
  where username = '$s_username' 
  order by 1,2  ");
  while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .='<td width="50%" style="border: 1px solid #eee;color:#eee;">'.$output_query["username"].'</td>';
$rows .= '<td width="50%" style="border: 1px solid #eee;color:#eee;">'.$output_query["schedule_date"]->format('Y-m-d').'</td>';
if(floor(($output_query["Absence"])*100) > 5)
  {

$rows.='<td width="20%"style="border: 1px solid #6666;color:#eee; background-color:tomato;">'.floor(($output_query['Absence'])*100).'%'.'</td>';
}
if(floor(($output_query["Absence"])*100) <5 )
  {

$rows.='<td width="20%"style="border: 1px solid #6666;color:#eee; background-color:#009966;">'.floor(($output_query['Absence'])*100).'%'.'</td>';
}
$rows .=   '</tr>';
echo $rows;
}
?>
</tbody>
</table>
</div>

          </div>
        </div>
      </center>
      </div>
 
<?php
/////utilization_table
 $first_query = sqlsrv_query( $con ,"SELECT * FROM utilization_table  where username ='$s_username' and [date] 
    BETWEEN '2021-06-01' AND '2021-06-22' order by 3 ");

  $chart_data22 ='';

 while( $output = sqlsrv_fetch_array($first_query)){
  $chart_data22 .="{ date22:'".$output['date']->format('Y-m-d')."',utilization:".floor(($output["utilization"])*100)."
  ,work_duration:'".$output['work_duration']->format('H:i:s')."',scheduled_duration:'".$output['scheduled_duration']->format('H:i:s')."'},";
}
$chart_data22 = substr($chart_data22, 0);
/// Absence
    $Absence = sqlsrv_query( $con ,"SELECT [username]
      ,[schedule_date]
      ,[Absence]
  FROM [Aya_Web_APP].[dbo].[Absence_per_day]
  where username = '$s_username' 
  order by 1,2  ");
   $Line_absence ='';
 while( $Absence_out = sqlsrv_fetch_array($Absence) ){
$Line_absence .="{ Absence:'".floor(($Absence_out['Absence'])*100)."',date202:'".$Absence_out['schedule_date']->format('Y-m-d')."'},";
}
$Line_absence = substr($Line_absence, 0);
?>
<script src="js/jquery22.min.js"></script>
<script src="js/bootstrap22.min.js"></script>
<script src="js/raphael22.min.js"></script>
<script src="js/morris22.min.js"></script>
<script src="js/fastclick22.js"></script>
<script src="js/adminlte22.min.js"></script>
<script src="js/demo22.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/raphael-min.js"></script>
<script src="js/morris.js"></script>
<script src="js/Chart.min"></script>

<script type="text/javascript">
     $(function () {
    "use strict";
//$utilization

var line = new Morris.Bar({
      element: 'line-utiliz',
      resize: true,
      data: [<?php echo $chart_data22;?>],
      xkey: "date22",
      ykeys: ["utilization","non_utilized"],
      labels: ["utilizedss", "non_utilizeds"],
      hideHover: 'auto'
    });
//$Absence

var line = new Morris.Area({
      element: 'line-Absence',
      resize: true,
      data: [<?php echo $Line_absence;?>],
      xkey: 'date202',
      ykeys: ['Absence'],
      labels: ['Absence'],
      lineColors: ['#a0d0e0','#3c8dbc'],
      hideHover: 'auto'
    });

   });
  </script>

<?php 
include ("footer.html");
?>