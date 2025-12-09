<!DOCTYPE html>
<html>
<head>
  <title>export excel</title>
  <?php  require_once("inc/config.inc");
  ?>
</head>
<body>
<style type="text/css">
body {
  font-family: "Lato", sans-serif;
  background-color:#eee;
}
  .table-wrapper {
    width: 100%;
    margin: -100px -30px auto;
        background: #fff;
        padding: 25px; 
        padding-top: 25px;
        padding-bottom: 15px; 
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
    }
    .table-title h2 {
        margin: 6px 0 0;
        font-size: 22px;
    }
    .table-title .add-new {
        float: right;
    height: 50px;
    font-weight: bold;
    font-size: 12px;
    text-shadow: none;
    min-width: 100px;
    border-radius: 50px;
    line-height: 13px;
    }
  .table-title .add-new i {
    margin-right: 4px;
  }
    table.table {
        table-layout: fixed;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;

    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }
    table.table th:last-child {
        width: 100px;
    }
    table.table td a {
    cursor: pointer;
        display: inline-block;
        margin: 0 5px;
    min-width: 24px;
    }    
  table.table td a.add {
        color: #27C46B;
    }
    table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #E34724;
    }
    table.table td i {
        font-size: 19px;
    }
  table.table td a.add i {
        font-size: 24px;
      margin-right: -1px;
        position: relative;
        top: 3px;
    }    
    table.table .form-control {
        height: 32px;
        line-height: 32px;
        box-shadow: none;
        border-radius: 2px;
    }
  table.table .form-control.error {
    border-color: #f50000;
  }
  table.table td .add {
    display: none;
  }
</style>

<?php
if(isset($_get['export'])){}
  echo'
<div class="container" >

        <div class="table-wrapper" style="background-color:#eee; " >
            <div class="table-title" >
                <div class="row" style="background-color:#E47A2E; ">
             <div class="col-sm-8" ><h2 style=" color:#eee;">Resignation <b style="color:black;">Report</b></h2></div>  
                </div>
            </div>
            <div class="table table-bordered table-hover" style="overflow:scroll;overflow-x: hidden; height:350px;width: 100%;">

            <table class="table table-bordered">

                <thead >
                    <tr>
<th width="27%" style="background-color:#92B558;"   class="table table-bordered" >Employee_ID</th>
<th width="7%"   class="table table-bordered"style="background-color:#92B558; "  >username</th>
<th width="7%"  class="table table-bordered"style="background-color:#92B558; " >Last_working_day</th>

                    </tr>
                </thead>
                <tbody>';?>

<?php  
   $retval = sqlsrv_query( $con ,"SELECT [Employee_ID]
      ,[User_Name]
      ,cast([Last_working_day] as date) Resignation_date
  FROM [Employess_DB].[dbo].[Resignation_Table]
  where Employee_Type = 'Outsource' 
  and Last_working_day 
  between DATEADD(MONTH, DATEDIFF(MONTH, 0, GETDATE()) - 1, 14) AND DATEADD(MONTH, 
                  DATEDIFF(MONTH, 0, GETDATE()) + 1,-1 )
and Date_time >= DATEADD(MONTH, DATEDIFF(MONTH, 0, GETDATE()) - 1, 14)
  order by 3");

//$orders_num2 = sqlsrv_num_rows($retval);

 while( $output_query = sqlsrv_fetch_array($retval)){
$rows  = '<tr>';
$rows .= '<td width="5%" style="border: 1px solid #eee;">'.$output_query["Employee_ID"].'</td>';
$rows .= '<td width="5%" style="border: 1px solid #eee;">'.$output_query["User_Name"].'</td>';
$rows .= '<td width="5%" style="border: 1px solid #eee;">'.$output_query["Resignation_date"]->format('Y-m-d').'</td>';

$rows .='</tr>';
echo $rows;
}

//->format('Y-m-d')
?>
</body>
</html>