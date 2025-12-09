

<?php
include ("pages.php");
    /* Include the ../src/fusioncharts.php file that contains functions to embed the charts.*/
    include("includes/fusioncharts.php");
?>

        <title>Charts</title>

        <script src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
        <script src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
        <g transform="translate(18,222.68)" fill="#b1b2b7" cursor="pointer" pointer-events="bounding-box" style="display:none;"></g>
    </head>

      <?php 
      $first_query = sqlsrv_query( $con ,"SELECT  
      round (cast(Sum((DATEPART(hour, work_duration) * 3600) + (DATEPART(minute, work_duration) * 60) + DATEPART(second, work_duration)) as float) 
     / cast( Sum((DATEPART(hour, scheduled_duration) * 3600) + (DATEPART(minute, scheduled_duration) * 60) + DATEPART(second, scheduled_duration)) as float) * 100 , 0) 
      [utilization]

  FROM [Aya_Web_APP].[dbo].[utilization_table]
  where [utilization_table].username = 'mahmoud.R70619' ");
      $getDATA = (sqlsrv_fetch_array($first_query));
      $utiliz = $getDATA['utilization'];
  ?>
<?php
// Widget appearance configuration
$arrChartConfig = array(
"chart" => array(
"caption" => "Utilization for,$s_username",
"lowerLimit" => "0",
"upperLimit" => "100",
"showValue" => "1",
"numberSuffix" => "%",
"theme" => "fusion",
"showToolTip" => "0"
)
);

    // Widget color range data
    $colorDataObj = array("color" => array(
        ["minValue" => "0", "maxValue" => "50", "code" => "#F2726F"],
        ["minValue" => "50", "maxValue" => "75", "code" => "#FFC533"],
        ["minValue" => "75", "maxValue" => "100", "code" => "#62B58F"]
    ));

    // Dial array
    $dial = array();

    // Widget dial data in array format, multiple values can be separated by comma e.g. ["81", "23", "45",...]
    // hena b7aded en el chart et7arak 
    $widgetDialDataArray = array($utiliz);
    for($i = 0; $i < count($widgetDialDataArray); $i++) {
        array_push($dial,array("value" => $widgetDialDataArray[$i]));
    }

    $arrChartConfig["colorRange"] = $colorDataObj;
    $arrChartConfig["dials"] = array( "dial" => $dial);

    // JSON Encode the data to retrieve the string containing the JSON representation of the data in the array.
    $jsonEncodedData = json_encode($arrChartConfig);

    // Widget object
    $Widget = new FusionCharts("angulargauge", "MyFirstWidget" , "400", "250", "widget-container", "json", $jsonEncodedData);

    // Render the Widget
    $Widget->render();

?>

<center>
<div id="widget-container"></div>
  <style type="text/css">
 g path .raphael-group-CsootHMA{
  display: none;
}
    </style>

</center>

<g transform="translate(18,222.68)" fill="#b1b2b7" cursor="pointer" pointer-events="bounding-box" style="display:none;"></g>



<?php
 include ("footer.html");
 ?>