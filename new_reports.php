

<?php 
include ("pages.php");
/*
waliid 
mttr + summary reports
*/
?>
<title>Reports</title>
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
<link rel="stylesheet" type="text/css" href="css/kpi_css.css">
  </head>
<?php
include ("mttr_summary.php");
?>
<style type="text/css">
.bodys{
    padding: 1px 50px 1px 50px;
    /*height: 100%;*/
    height: auto;
  }</style>
 <center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >....
      <a href="psc_reports.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a></h2>
              </div>
          </div>
      </div>
     <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" 
      value="Export to Excel" onclick="Export()">       
        <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> 
       </a></p></samp>
    </aside>
  </div>
</center>
 
<form method="post" class="bodys" >

  <div class="row">

        <div class="col-lg-3">
<div class="input-group col-2">
  <span class="input-group-text"id="basic-addon1">Start Date</span>
    <input type="month" class="form-control" placeholder="From Month"id="months"
name='month' aria-describedby="basic-addon1"
value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>' required />
</div>
</div>
<br>
    <div class="col-lg-3">
<div class="input-group col-2">
  <span class="input-group-text" 
  id="basic-addon1">End date</span>
  <input type="month" class="form-control" placeholder="To Month" aria-label="To Month" name="month2" id="months"
    aria-describedby="basic-addon1"required
value='<?php if(isset($_POST['month2'])) echo $_POST['month2']; ?>'/>
    </div>
  </div>
</div>

<br>
<div class="input-group-btn col-md-6">
  <button class="btn btn-primary"type='submit' name='save'>Submit</button>
</div>

      </div>
    </div>
  </div>
</div>

<br>


<?php 

if(isset($_POST['month'])){
$mydate = $_POST['month'];}
if(isset($_POST['month2'])){
$mydate2 = $_POST['month2'];}
?>

       
<?php
  //if(isset($_POST['submit'])){
  
?>
<center>
  <div style="padding:20px;">
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <thead style="color: white;font-size: 15px;background-color: #55608f;border: 1px solid white; ">
    <tr>  
 <th >Num_days</th>
  <th >BS </th>
  <th >UNMANAGED </th>
  <th >Unassigned </th>
  <th >Mega Projects </th>
  <th >GOV/Public&Security </th>
  <th >Business Sales </th>
  <th style="font-size:10px;">Private KAM & GDS ( Global partner ) </th>
  <th>Private KAM </th>
  <th>GDS(Global Partner) </th>
  <th> Banking</th>
  </tr>
  </thead>
  <tbody >
    <?php

  $first_query = sqlsrv_query( $con ,"with Closed_tickets  as (select * from (SELECT distinct requestid
    ,iif ( ticket_group is null,'Unassigned',ticket_group) ticket_group
    ,Iif(datediff(day,creation_time,getdate())=0,'less than 1 day',iif(datediff(day,creation_time,getdate()) between 1 and 2 ,'From 1 to 2 days',
    iif(datediff(day,creation_time,getdate()) between 2 and 3 , 'From 2 to 3 days' , 'More than 3 days'))) Num_days
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where ticket_status <>  'closed' and   cast([creation_time] as date)>='2020-05-28' 
  and datediff(day,creation_time,getdate())<>0)
  t
  pivot (
  count (requestid)
  FOR ticket_group IN (
  [BS],
  [GDS],
  [ICT],
  [KAM],
  [RESIDENT],
  [TAM],
  [UNMANAGED],
  [Unassigned],
  [Mega Projects],
  [GOV/Public&Security],
  [Business Sales],
  [Private KAM & GDS ( Global partner )],
  [Private KAM],
  [GDS(Global Partner)],
  [Banking]

  )
) AS pivot_table)


select * from Closed_tickets
order by case 
when Num_days = 'less than 1 day' then 1
when Num_days = 'From 1 to 2 days' then 2
when Num_days = 'From 2 to 3 days' then 3
else 4
end
  ");
  
  while( $output_query = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Num_days"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["BS"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["UNMANAGED"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Unassigned"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Mega Projects"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["GOV/Public&Security"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Business Sales"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Private KAM & GDS ( Global partner )"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Private KAM"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["GDS(Global Partner)"].'</td>';
$rows .= '<td class="hovers" style="border: 1px solid lightgray;">'.$output_query["Banking"].'</td>';
$rows .= '</tr>';

echo $rows;
}//}
?>
</tbody>
</table>
</div>

  <div class="row bodys">

          <div class="col-lg-3">
              <div class="card">
                <div class="card-header bg-secondary">
                  <strong class="card-title text-light">
                  Utilization</strong>
                        </div>
                <div class="card-body text-secondary">
                   <div id="g1" class="gauge"></div>
                  </div>
                  
              </div>
          </div>
                    
               <div class="col-lg-3">
            <div class="card">
              <div class="card-header bg-secondary"style="background-color: #55608f;">
                <strong class="card-title text-light" >
                Absenteeism</strong>
                      </div>
              <div class="card-body text-secondary">
                 <div id="g2" class="gauge"></div>
                </div>
                
            </div>
        </div>

         <div class="col-lg-3">
            <div class="card">
              <div class="card-header bg-secondary">
                <strong class="card-title text-light">
                  MTTI %
                </strong>
                      </div>
              <div class="card-body text-secondary">
                 <div id="g3" class="gauge"></div>
                </div>
                
            </div>
        </div>

         <div class="col-lg-3">
            <div class="card">
              <div class="card-header bg-secondary">
                <strong class="card-title text-light">
                MTTR %
              </strong>
                      </div>
              <div class="card-body text-secondary">
                 <div id="g4" class="gauge"></div>
                </div>
                
            </div>
        </div>
      </div>
<br>
                  
<div  style="width:90%;">
  <div class="box-body chart-responsive"style=" color: white;">
    <div class="chart" id="line-chart2"   ></div>

      <div class="card-body">
              <div class="legend" style="color: white; background-color: #00004d; padding:1.5%; border-radius: 5px 5px 5px 5px;">
                  <i class="fa fa-circle text-primary" style="color:#6f30a0;"></i> BS             
                  <i class="fa fa-circle text"style="color:#9dadb9;"></i> UNMANAGED
                  <i class="fa fa-circle text-green"style="color:#9dadb9;"></i> Unassigned
                  <i class="fa fa-circle text-info"style="color:#9dadb9;"></i>Mega Projects 
                  <i class="fa fa-circle text-warning"style="color:#9dadb9;"></i> GOV/Public&Security
                  <i class="fa fa-circle text-danger"style="color:#9dadb9;"></i> Business Sales

            <i class="fa fa-circle text-#9440ed"style="color:#9440ed; font-size: 9px;"></i> Private KAM & GDS ( Global partner )
                  <i class="fa fa-circle text-primary"style="color:#6f30a0;"></i> Private KAM
                  <i class="fa fa-circle text"style="color:#9dadb9;"></i> GDS(Global Partner)
                  <i class="fa fa-circle text-green"style="color:#9dadb9;"></i> Banking
              </div>
              <hr>
          </div>
      </div>


  </div>
</center>

<?php
  //daily 1
  $first_query = sqlsrv_query( $con ,"with Closed_tickets  as (select * from (SELECT distinct requestid
    ,iif ( ticket_group is null,'Unassigned',ticket_group) ticket_group
    ,Iif(datediff(day,creation_time,getdate())=0,'less than 1 day',iif(datediff(day,creation_time,getdate()) between 1 and 2 ,'From 1 to 2 days',
    iif(datediff(day,creation_time,getdate()) between 2 and 3 , 'From 2 to 3 days' , 'More than 3 days'))) Num_days
  FROM [WorkforceDB_indexed].[dbo].[KPI_Status_RawData]
  where ticket_status <>  'closed' and   cast([creation_time] as date)>='2020-05-28' 
  and datediff(day,creation_time,getdate())<>0)
  t
  pivot (
  count (requestid)
  FOR ticket_group IN (
  [BS],
  [GDS],
  [ICT],
  [KAM],
  [RESIDENT],
  [TAM],
  [UNMANAGED],
  [Unassigned],
   [Mega Projects],
  [GOV/Public&Security],
  [Business Sales],
  [Private KAM & GDS ( Global partner )],
  [Private KAM],
  [GDS(Global Partner)],
  [Banking]
)
) AS pivot_table)


select * from Closed_tickets
order by case 
when Num_days = 'less than 1 day' then 1
when Num_days = 'From 1 to 2 days' then 2
when Num_days = 'From 2 to 3 days' then 3
else 4
end
  ");

  $chart_my_data ='';

 while( $output = sqlsrv_fetch_array($first_query) )
{

   $chart_my_data .="{ Num_days:'".$output['Num_days']."',BS:".$output["BS"].",UNMANAGED:".$output["UNMANAGED"].",Unassigned:".$output["Unassigned"]."
  ,'Mega Projects':".$output["Mega Projects"].",'GOV/Public&Security':".$output["GOV/Public&Security"].",
  'Business Sales':".$output["Business Sales"].",'Private KAM & GDS ( Global partner )':".$output["Private KAM & GDS ( Global partner )"].",'Private KAM':".$output["Private KAM"].",'GDS(Global Partner)':".$output["GDS(Global Partner)"].",

  'Banking':".$output["Banking"]."

    },";
}
$chart_my_data = substr($chart_my_data, 0);

?>
<?php 
//}
?>
</form>
  <script type="text/javascript">
     $(function () {
    "use strict";
      var line = new Morris.Bar({
      element: 'line-chart2',
      resize: true,
      data: [<?php echo $chart_my_data;?>],
      xkey: "Num_days",
      ykeys: ["BS","UNMANAGED","Unassigned", "Mega Projects","GOV/Public&Security",
  "Business Sales","Private KAM & GDS ( Global partner )","Private KAM","GDS(Global Partner)","Banking"],
      labels: ["BS","UNMANAGED","Unassigned", "Mega Projects","GOV/Public&Security",
  "Business Sales","Private KAM & GDS ( Global partner )","Private KAM","GDS(Global Partner)","Banking"],
      hideHover: 'auto'
    });
});
  </script>

<script type="text/javascript">
   <script type="text/javascript">
var g2 = new JustGage({
        id: 'g2',
        value: <?php echo $Absenteeism;?>, 
        min: 0,
        max: 100,
        symbol: '%',
        pointer: true,
        pointerOptions: {
          toplength: 20,
          bottomlength: 20,
          bottomwidth: 4,
          color:"black"
            },
        gaugeWidthScale: 0.6,
        counter: true,
        relativeGaugeSize: true
      });
</script>
<script type="text/javascript">
var g3 = new JustGage({
        id: 'g3',
        value: <?php echo $get_MTTI2 ;?>,   
        min: 0,
        max: 100,
        symbol: '%',
        pointer: true,
        pointerOptions: {
          toplength: 15,
          bottomlength: 15,
          bottomwidth: 4,
          color:"black"
            },
        gaugeWidthScale: 0.6,
        counter: true,
        relativeGaugeSize: true
      });

</script>
<script type="text/javascript">
var g4 = new JustGage({
        id: 'g4',
        value: <?php echo $get_MTTR2 ;?>,   
        min: 0,
        max: 100,
        symbol: '%',
        pointer: true,
        pointerOptions: {
          toplength: 15,
          bottomlength: 15,
          bottomwidth: 4,
          color:"black"
            },
        gaugeWidthScale: 0.6,
        counter: true,
        relativeGaugeSize: true
      });

 

  </script>
</script>

</div>
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
<?php 
include ("footer.html");
?>