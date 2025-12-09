
<?php 
include ("pages.php");
//require_once("inc/config.inc");
?>
       <?php 
      $utiliz_query = sqlsrv_query( $con ,"SELECT  
      round (cast(Sum((DATEPART(hour, work_duration) * 3600) + (DATEPART(minute, work_duration) * 60) + DATEPART(second, work_duration)) as float) 
     / cast( Sum((DATEPART(hour, scheduled_duration) * 3600) + (DATEPART(minute, scheduled_duration) * 60) + DATEPART(second, scheduled_duration)) as float) * 100 , 0) 
      [utilization]
  FROM [Aya_Web_APP].[dbo].[utilization_table]
  where [utilization_table].username = 'mahmoud.R70619' ");
      $getDATA = (sqlsrv_fetch_array($utiliz_query));
      $utiliz = $getDATA['utilization'];

      $Absen_query = sqlsrv_query( $con ,"exec Absenteeism_Dashboard
        @username = 'Hossam.A.Ramadan'");
       $getAbsen = (sqlsrv_fetch_array($Absen_query));
      $Absenteeism = $getAbsen['Absenteeism'];
  ?>
    
    <title>JustGage Tutorial</title>
    <IfModule mod_expires.c>
    # Enable expirations
    ExpiresActive On 
    # Default directive
    ExpiresDefault "access plus 1 month"
    # My favicon
    ExpiresByType image/x-icon "access plus 1 year"
    # Images
    ExpiresByType image/gif "access plus 1 month"
    ExpiresByType image/png "access plus 1 month"
    ExpiresByType image/jpg "access plus 1 month"
    ExpiresByType image/jpeg "access plus 1 month"
    # CSS
    ExpiresByType text/css "access plus 1 month"
    # Javascript
    ExpiresByType application/javascript "access plus 1 year"
</IfModule>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.1/raphael-min.js"></script>
    <script src="js/justgage.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
</head>    
  <style type="text/css">
  
      .wrapper {
      position: relative;
      width: 70%;
      height: auto;
    }
  
    .box {
      width: 70%;
    }
    /*.container {
      width: 350px;
      margin: 0 auto;
      text-align: center;
    }*/
   
    .gauge {
      width: 70%;
      height: auto;

    }

    .flexbox {
      display: flex;
      flex-wrap: wrap;
    }
    .flexbox>div {
      flex: 1 0 300px;
    }
     .stat-icon{
  font-size: 60px;
  }
 
.bg-flat-color-1{
    background-color: #00a1c2;
}
/*.Utiliz:before {
    content: "\f012"; /*--You can add font icon code here--*
    font-family: FontAwesome;
    color: white;
}*/

  </style>

<div class="wrapper">
    <div class="flexbox">
      <div class="box">
        <div id="g1" class="gauge"></div>
      </div>
      <div class="box">
        <div id="g2" class="gauge"></div>
      </div>
      <!--div class="box">
        <div id="g3" class="gauge">3</div>
      </div-->
      <div class="box">
        <div id="g4" class="gauge"></div>
      </div>
    </div>
</div>


<script type="text/javascript">

var g1 = new JustGage({
        id: 'g1',
        value: <?php echo $utiliz;?>,
        min: 0,
        max: 100,
        symbol: '%',
        pointer: true,
        gaugeWidthScale: 0.6,
        counter: true,
        relativeGaugeSize: true
      });

var g2 = new JustGage({
        id: 'g2',
        value: <?php echo $Absenteeism;?>,   
        min: 0,
        max: 100,
        symbol: '%',
        pointer: true,
        pointerOptions: {
          toplength: 10,
          bottomlength: 10,
          bottomwidth: 8,
          color:"black"
            },
        gaugeWidthScale: 0.6,
        counter: true,
        relativeGaugeSize: true
      });

var g3 = new JustGage({
        id: 'g3',
        value: 50,   
        min: 0,
        max: 100,
        symbol: '%',
        pointer: true,
        pointerOptions: {
          toplength: 10,
          bottomlength: 10,
          bottomwidth: 8,
          color:"black"
            },
        gaugeWidthScale: 0.6,
        counter: true,
        relativeGaugeSize: true
      });


var g4 = new JustGage({
        id: 'g4',
        value: 100,   
        min: 0,
        max: 100,
        symbol: '%',
        pointer: true,
        pointerOptions: {
          toplength: 10,
          bottomlength: 8,
          bottomwidth: 8,
          color:"black"
            },
        gaugeWidthScale: 0.6,
        counter: true,
        relativeGaugeSize: true
      });

  </script>
<?php
 //include ("footer.html");
 ?>
