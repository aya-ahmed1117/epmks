<?php
include ("pages.php");
    /* Include the ../src/fusioncharts.php file that contains functions to embed the charts.*/
?>
    <title>jquery-gauge demo</title>
    <meta name="viewport" content="width=1024, maximum-scale=1">
    <link href="includes/jquery-gauge.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="../src/jquery.jqplot.js"></script>
<script type="text/javascript" src="../src/plugins/jqplot.meterGaugeRenderer.js"></script>
<link rel="stylesheet" type="text/css" href="../src/jquery.jqplot.css" />
    <style>
        .demo1 {
            position: relative;
            width: 20vw;
            height: 20vw;
            box-sizing: border-box;
            float:left;
            margin:20px
        }

        .demo2 {
            position: relative;
            width: 40vw;
            height: 40vw;
            box-sizing: border-box;
            float:right;
            margin:20px
        }
      .wrapper {
      position: relative;
      width: 100%;
      height: 480px;
    }

 .box {
      width: 100%;
    }

    .container {
      width: 450px;
      margin: 0 auto;
      text-align: center;
    }

    .gauge {
      width: 100%;
      height: 240px;
    }

    .flexbox {
      display: flex;
      flex-wrap: wrap;
    }
    .flexbox>div {
      flex: 1 0 300px;
    }
    path[arrowWidth] {
    -webkit-tap-highlight-color: rgba(0, 0, 10, .90);
    stroke-linecap: square;
}

  </style>
</head>
<body>

<script type="text/javascript">
    $(document).ready(function(){
   s1 = [1];
 
   plot0 = $.jqplot('chart0',[s1],{
       title: 'Network Speed',
       seriesDefaults: {
           renderer: $.jqplot.MeterGaugeRenderer,
           rendererOptions: {
               label: 'MB/s'
           }
       }
   });
});

    $(document).ready(function(){
   s1 = [1];
 
   plot1 = $.jqplot('chart1',[s1],{
       seriesDefaults: {
           renderer: $.jqplot.MeterGaugeRenderer,
           rendererOptions: {
               showTickLabels: false,
               intervals:[2,3,4],
               intervalColors:['#66cc66', '#E7E658', '#cc6666']
           }
       }
   });
});

    $(document).ready(function(){
   s1 = [322];
 
   plot3 = $.jqplot('chart3',[s1],{
       seriesDefaults: {
           renderer: $.jqplot.MeterGaugeRenderer,
           rendererOptions: {
               min: 100,
               max: 500,
               intervals:[200, 300, 400, 500],
               intervalColors:['#66cc66', '#93b75f', '#E7E658', '#cc6666']
           }
       }
   });
});


$(document).ready(function(){
   s1 = [52200];
 
   plot4 = $.jqplot('chart4',[s1],{
       seriesDefaults: {
           renderer: $.jqplot.MeterGaugeRenderer,
           rendererOptions: {
               label: 'Metric Tons per Year',
               labelPosition: 'bottom',
               labelHeightAdjust: -5,
               intervalOuterRadius: 85,
               ticks: [10000, 30000, 50000, 70000],
               intervals:[22000, 55000, 70000],
               intervalColors:['#66cc66', '#E7E658', '#cc6666']
           }
       }
   });
});
</script>

    <div class="wrapper">
    <div class="flexbox">
      <div class="box">
        <div id="g1" class="gauge">1</div>
      </div>
  
    </div>


    <div id="g1" class="gauge1 demo1"></div>

    <div class="gauge2 demo2"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="includes/jquery-gauge.min.js"></script>
    <?php 
      $first_query = sqlsrv_query( $con ,"SELECT  
      round (cast(Sum((DATEPART(hour, work_duration) * 3600) + (DATEPART(minute, work_duration) * 60) + DATEPART(second, work_duration)) as float) 
     / cast( Sum((DATEPART(hour, scheduled_duration) * 3600) + (DATEPART(minute, scheduled_duration) * 60) + DATEPART(second, scheduled_duration)) as float) * 100 , 0) 
      [utilization]

  FROM [Aya_Web_APP].[dbo].[utilization_table]
  where [utilization_table].username = 'mahmoud.R70619' ");
      $getDATA = (sqlsrv_fetch_array($first_query));
      $utiliz = $getDATA['utilization'];
      echo $utiliz
  ?>
    <script>


        // first example
        var gauge = new Gauge($('.gauge1'), {value: <?php echo $utiliz;?>});

        // second example
        $('.gauge1').gauge({
            values: {
                0 : '0',
                20: '20',
                40: '40',
                60: '60',
                80: '80',
                100: '100'
            },
            colors: {
                0 : 'red',
                50 : 'yellow',
                80: 'orange',
                90: 'green',
                100: 'green'
            },
            angles: [
                180,
                360
            ],
            lineWidth: 10,
            arrowWidth: 'style=""',
            arrowColor: 'black',
            inset:true,
             pointer: true,
        gaugeWidthScale: 0.6,
        counter: true,
        relativeGaugeSize: true,

            value:  <?php echo $utiliz;?>
        });


    </script>
  
</body>
</html>


<!--


        id : string container element id
title : string gauge title text
titleFontColor : string color title text
value : int value gauge is showing
valueFontColor : string color of value text
min : int minimum value
max : int maximum value
showMinMax : bool hide or display min and max values
gaugeWidthScale : float width of the gauge element
gaugeColor : string background color of gauge element
label : string text to show below value
showInnerShadow : bool whether to display inner shadow
shadowOpacity : float shadow opacity, values 0 ~ 1
shadowSize : int inner shadow size
shadowVerticalOffset : int how much is shadow offset from top
levelColors : array of strings colors of indicator, from lower to upper, in hex format
levelColorsGradient : bool use gradual or sector-based color change
labelFontColor : string color of label showing label under value
startAnimationTime : int length of initial load animation
startAnimationType : string type of initial animation (linear, >, <, <>, bounce)
refreshAnimationTime : int length of refresh animation
refreshAnimationType : string type of refresh animation (linear, >, <, <>, bounce)
    -->

<?php 
include ("pages.php");
//require_once("inc/config.inc");
?>
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
    
    <title>JustGage Tutorial</title>
   <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.1/raphael-min.js"></script>
    <script src="js/justgage.js"></script>

</head>
<body>
    

  <style type="text/css">
      .wrapper {
      position: relative;
      width: 100%;
      height: 480px;
    }
  
    .box {
      width: 100%;
    }

    .container {
      width: 450px;
      margin: 0 auto;
      text-align: center;
    }

    .gauge {
      width: 100%;
      height: 240px;
    }

    .flexbox {
      display: flex;
      flex-wrap: wrap;
    }
    .flexbox>div {
      flex: 1 0 300px;
    }

    /*path{
    fill: "";
    stroke: none;
    d: path("M 6.846 48.1433 L 134.107 5.2274 L 13.42 20.4444 Z");
    stroke-width: 0;
    stroke-linecap: square;
}
path[Attributes Style] {
    fill: green;
    stroke: none;
    d: path("M 38 80 L 20 80 A 80 80 0 0 1 180 80 L 162 80 A 62 62 0 0 0 38 80 Z");
}*/
  </style>



<div class="wrapper">
    <div class="flexbox">

      <div class="box">
        <div id="g1" class="gauge">1</div>
      </div>

      <div class="box">
        <div id="g2" class="gauge">2</div>
      </div>
      
      <!--div class="box">
        <div id="g3" class="gauge">3</div>
      </div-->
      <div class="box">
        <div id="g4" class="gauge"></div>
      </div>
    </div>

<script type="text/javascript">

var g1 = new JustGage({
        id: 'g1',
        value: <?php echo  $utiliz;?>,
        min: 0,
        max: 100,
        symbol: '%',
        pointer: true,
        gaugeWidthScale: 0.6,
        counter: true,
        relativeGaugeSize: true
      });

/*
// Widget color range data
    $colorDataObj = array("color" => array(
        ["min" => "0", "max" => "50", "code" => "#F2726F"],
        ["min" => "50", "max" => "75", "code" => "#FFC533"],
        ["min" => "75", "max" => "100", "code" => "#62B58F"]
    ));

      var g2 = new JustGage({
        id: 'g2',
        value: 25,
        min: 0,
        max: 100,
        symbol: '%',
        pointer: true,
        pointerOptions: {
          toplength: -15,
          bottomlength: 10,
          bottomwidth: 12,
          color: '#8e8e93',
          stroke: '#ffffff',
          stroke_width: 3,
          stroke_linecap: 'round'
        },
        gaugeWidthScale: 0.6,
        counter: true,
        relativeGaugeSize: true
      });

      var g3 = new JustGage({
        id: 'g3',
        value: 40,
        min: 0,
        max: 100,
        symbol: 'kWh',
        pointer: true,
        gaugeWidthScale: 0.4,
        pointerOptions: {
          toplength: 10,
          bottomlength: 10,
          bottomwidth: 8,
          color: '#000'
        },
        counter: true,
        relativeGaugeSize: true
      });
      var g4 = new JustGage({
        id: 'g4',
        value: 100,
        min: 0,
        max: 100,
        symbol: '%',
        pointerOptions: {
          toplength: 100,
          bottomlength: -20,
          bottomwidth: 0,
          color: 'black'
        },
        gaugeWidthScale: 0.1,
        counter: true,
        relativeGaugeSize: true
      });
      ///////////////

<svg height="100%" version="1.1" width="100%" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;" viewBox="0 0 200 100" preserveAspectRatio="meet">
    <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with Raphaël 2.1.0</desc><defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><filter id="inner-shadow-g1"><feOffset dx="0" dy="3"></feOffset><feGaussianBlur result="offset-blur" stdDeviation="5"></feGaussianBlur><feComposite operator="out" in="SourceGraphic" in2="offset-blur" result="inverse"></feComposite><feFlood flood-color="black" flood-opacity="0.2" result="color"></feFlood><feComposite operator="in" in="color" in2="inverse" result="shadow"></feComposite><feComposite operator="over" in="shadow" in2="SourceGraphic"></feComposite></filter></defs><path fill="#edebeb" stroke="none" d="M38,80L20,80A80,80,0,0,1,180,80L162,80A62,62,0,0,0,38,80Z" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="#ff0000" stroke="none" d="M38,80L20,80A80,80,0,0,1,23.915478696387723,55.278640450004204L41.03449598970048,60.840946348753256A62,62,0,0,0,38,80Z" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><path fill="#000000" stroke="none" d="M54.33328352905242,63.05905990782891L53.09721555155264,66.86328597300952L17.258083082321647,53.115521489379574Z" stroke-width="0" stroke-linecap="square" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); stroke-linecap: square;"></path>
<path fill="#b9d409" stroke="none" d="M38,80L20,80A80,80,0,0,1,180,80L162,80A62,62,0,0,0,38,80Z" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
    <text x="100" y="78.43137254901961" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#010101" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: bold 16px Arial; fill-opacity: 1;" font-size="16px" font-weight="bold" font-family="Arial" fill-opacity="1"><tspan dy="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">50</tspan></text><text x="100" y="91.43137254901961" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#b3b3b3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 10px Arial; fill-opacity: 1;" font-size="10px" font-weight="normal" font-family="Arial" fill-opacity="1"><tspan dy="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></tspan></text><text x="29" y="91.43137254901961" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#b3b3b3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 10px Arial; fill-opacity: 1;" font-size="10px" font-weight="normal" font-family="Arial" fill-opacity="1"><tspan dy="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan></text><text x="171" y="91.43137254901961" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#b3b3b3" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font: 10px Arial; fill-opacity: 1;" font-size="10px" font-weight="normal" font-family="Arial" fill-opacity="1"><tspan dy="0" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">100</tspan></text></svg>
/////////////////
  <!--svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
  <style>
    path {
      fill: none;
      stroke-width: 4px;
      marker: url(#gauge);
    }
  </style>
  <path d="M 38 80 L 20 80 A 80 80 0 0 1 180 80 L 162 80 A 62 62 0 0 0 38 80 Z" stroke="red"/>
  <path d="M 30,70 v -20 h 40 v -20" stroke="green"/>
  <path d="M 38 80 L 20 80 A 80 80 0 0 1 180 80 L 162 80 A 62 62 0 0 0 38 80 Z" stroke="green"/>
  <marker id="gauge" markerWidth="12" markerHeight="12" refX="6" refY="6"
          markerUnits="userSpaceOnUse">
    <circle cx="6" cy="6" r="3"
            fill="white" stroke="context-stroke" stroke-width="2"/>
  </marker>
</svg-->
*/
   
  </script>

      </body>
</html>