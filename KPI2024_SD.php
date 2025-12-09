
<?php
 include ("pages.php");
set_time_limit(400);
date_default_timezone_set('Africa/Cairo');


  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "WorkForce_Reporting_DB";
  
  $connectionInfo = array( "Database"=>$DBname , "UID"=>$DBuser, "PWD"=>$DBpass);
  $connect = sqlsrv_connect($DBhost, $connectionInfo);

  $DBname2 = "Employess_DB";
  
  $connectionInfo = array( "Database"=>$DBname2 , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
$username = $_SESSION['username'];
  $check_group = sqlsrv_query( $con1,"SELECT [ID]
    ,[UserName]
    ,[Unit]
    ,[Groups],[SubGroups]
    FROM [Employess_DB].[dbo].[tbl_Personal_info]
    left join [Employess_DB].[dbo].[Tbl_Groups] on [Employess_DB].[dbo].[Tbl_Groups].[Group_ID]=[Group]
    left join [Employess_DB].[dbo].[Tbl_SubGroups] on [Employess_DB].[dbo].[Tbl_SubGroups].[subGroup_ID]=[sub_Group]
    where username ='$username' ");
    $group = sqlsrv_fetch_array($check_group);
    $my_group =$group['Groups']; 
     $myMonth = isset($_POST['month']) ? $_POST['month'] : '';

        $newMonth = $myMonth ? date('n', strtotime($myMonth)) : '';
        $this_year = $myMonth ? date('Y', strtotime($myMonth)) : '';
?>
<head>
  <title>KPI 2024</title>
  <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
</head>

<style type="text/css">
  .zoom:hover{
    transform: scale(1.5);
  }
</style>
<div style="padding:20px;">

<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" > KPI 2024 SD
                <a href="Summary_kpi.php">
                  <button type="button"id="sidebarCollapse"class="btn btn-warning" >
                  <i class="fa fa-backward"></i> Back
                  </button></a>
                </h2>
              </div>
          </div>
      </div>
       <samp>
        <p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button
          <a role="button" id="btnExport" value="Export to Excel" onclick="Export()" >
        <img src="images/aaa-removebg-preview.png" 
        class="zoom"  style="width:10%;"/> 
         </a>
        </p>
       </samp>
        
    </aside>
  </div>
</center>
<br>
<?php 

if($_SESSION['role_id'] > 0){
  include('target_2024.php');
  ?>

<div style="padding: 20px;">
  <!-- <form method="post" style="">
    <div class="row">
      <div class="col col-md-4">
        <div class="input-group">
          <span class="input-group-text" id="basic-addon1">Choose Month</span>
          <input name="month" type="month" id="month" class="form-control" aria-describedby="basic-addon1"
          required="" value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>'>
            <button class="btn btn-primary"type='submit' name='submit' value="Get data" style="width: 20%;" >Submit</button>
        </div>   
      </div>
    </div>
 -->
 <?php
}

         $myMonth = date('Y-m-d');
         $this_year= date('Y', strtotime($myMonth));
         $newMonth = date('n', strtotime($myMonth));


  if(isset($_POST['submit'])){

     $selec_group = isset($_POST['Group_Name']) ? $_POST['Group_Name'] : '';
        $myMonth = isset($_POST['month']) ? $_POST['month'] : '';

        $newMonth = $myMonth ? date('n', strtotime($myMonth)) : '';
        $this_year = $myMonth ? date('Y', strtotime($myMonth)) : '';

?>

<h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter"data-table="order-table"placeholder="Filter"/>
    <br>
    <br>
<div class="tableFixHead">

<?php
//month 
if(isset($_POST['month'])){$myMonth= $_POST['month'];

  $newMonth = date('n', strtotime($myMonth));
  $this_year =  date('Y', strtotime($myMonth));
}
$this_year = date('Y'); // If you want the current year

// Get the month from the URL or default to the current month if not set
$myMonth = isset($_GET['month']) ? $_GET['month'] : date('F');
?>
<table class="table order-table"  cellspacing="0" id="tblCustomers" >
  <?php 
  /*if(isset($_GET['month'])){
    $myMonth= $_GET['month'];
     }
  $newMonth = date('n', strtotime($myMonth));
      $results = sqlsrv_query($connect , "SELECT DISTINCT *
  FROM [WorkForce_Reporting_DB].[dbo].[SD_Kpi_2024]
  where [MONTH] ='$newMonth' and [YEAR] >=$this_year");

     
      if ($results === false) {
        die(print_r(sqlsrv_errors(), true));
      }
      while($row = sqlsrv_fetch_array($results,SQLSRV_FETCH_ASSOC) ){
        // $uwr =$row['utilization_without_Resident_TAM_day'];
        // $group =$row['group_name'];
        $data[] =  $row;
      // print_r($row);
      }
      

      ? if(empty($data)){
        $data[] ='';
          */
        ?>
        <?php 

$results = sqlsrv_query($connect , "SELECT DISTINCT *
  FROM [WorkForce_Reporting_DB].[dbo].[SD_Kpi_2024]
  where [MONTH] ='$newMonth' and [YEAR] >=$this_year");

if ($results === false) {
    die(print_r(sqlsrv_errors(), true));
}

$data = array();
while ($row = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

?>

<?php if(empty($data)): ?>
    <h2>No Data Found</h2>
<?php endif; ?>
      <thead style="color: white;font-size: 15px;background-color:#55608f;border: 1px solid white; ">
        <tr>
       <?php 
// foreach(array_keys($data[0]) as $column) {
       if (!empty($data)) {
        foreach (array_keys($data[0]) as $column) {
  
    if ($column == 'utilization_without_Resident_TAM_day') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $TAM_u_d . '</span></th>';
    } elseif ($column == 'TAM_utilization_day') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $TAM_util_day . '</span></th>';
    } elseif ($column == 'Absenteeism') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $Abs . '</span></th>';
    } elseif ($column == 'AHT_violation_ESP%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $AHT_vio_E . '</span></th>';
    } elseif ($column == 'AHT_violation_logical%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $AHT_vio_lo . '</span></th>';
    } elseif ($column == 'AHT_violation_Global%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $AHT_vio_Gl . '</span></th>';
    } elseif ($column == 'AHT_violation_Phy_yes_onsite%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $AHT_vio_yes . '</span></th>';
    } elseif ($column == 'AHT_violation_Phy_no_onsite%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $AHT_vio_no . '</span></th>';
    } elseif ($column == 'AHT_violation_Request%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $AHT_vio_Req . '</span></th>';
    }  elseif ($column == 'MTTI%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $MTTI . '</span></th>';
    }  elseif ($column == 'MTTV%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $MTTV . '</span></th>';
    } elseif ($column == 'MTTR_ESP%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $MTTR_ESP . '</th>';
    } elseif ($column == 'MTTR_Logical%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $MTTR_Log . '</th>';
    } elseif ($column == 'MTTR_Global%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $MTTR_Glo . '</th>';
    } elseif ($column == 'MTTR_Physical%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $MTTR_Phy . '</th>';
    } elseif ($column == 'MTTR_Request%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $MTTR_Reque . '</th>';
    } elseif ($column == 'P1%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $p1 . '</span></th>';
    } elseif ($column == 'P2%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $p2 . '</span></th>';
    } elseif ($column == 'AVG_Ring_Time') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $AVG_R_Ti . '</span></th>';
    } elseif ($column == 'AVG_Call_Time') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $AVG_H_Ti . '</span></th>';
    } elseif ($column == 'AVG_Hold_Time') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $AVG_H_Ti . '</span></th>';
    } elseif ($column == 'Aban%') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $Aban . '</span></th>';
    } elseif ($column == 'AVG_Hold_By_Eng') {
        echo '<th>' . $column . ' <span style="color:yellow;">' . $AVG_Hold . '</span></th>';
    } else {
        echo '<th>' . $column . '</th>';
    }


  }
}
     // foreach( array_keys($data[0]) as $column)
        //   echo'<th>'.$column.'</th>';

        ?>
      </tr>
      </thead>
      <tbody>
          <?php 
          //echo '<pre>';
        foreach( $data as $row){
          $full_data = $row;
          
          // echo "<pre>";
          // var_dump($key);
          // var_dump();
          // echo "</pre>";

          echo'<tr>';


          foreach( $row as $key =>$value){
            if ($value != "" || $value != null) {

              if($value instanceof DateTime){
                echo'<td>'.$value->format('H:i:s').'</td>';
              }
               else if($value instanceof Time){
                echo'<td>'.$value->format('H:i:s').'</td>'; 
              }
               else if($value instanceof Date){
                echo'<td>'.$value->format('Y-m-d').'</td>'; 
              } else {

                if ($key == "utilization_without_Resident_TAM_day") {
                  if ($full_data["group_name"] == "Banking" && $value >= 58) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value >= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "BS" && $value >= 78) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value >= 62) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value >= 57) {echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                } 

                  elseif ($key == "TAM_utilization_day") {
                  if ($full_data["group_name"] == "Banking" && $value >= 65) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value >= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value >= 65) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value >= 65) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value >= 65) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value >= 65) {echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                } 
                  //TAM_utilization_day
                 elseif ($key == "TAM_utilization_day") {
                  if ($full_data["group_name"] == "Banking" && $value <= 65) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value <= 65) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value >= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value <= 65) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value <= 65) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value <= 65) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }
            //Absenteeism
                  elseif ($key == "Absenteeism") {
                  if ($full_data["group_name"] == "Banking" && $value <= 5) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value <= 5) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value <= 5) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value <= 5) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value <= 5) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value <= 5) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }
            //MTTI
                elseif ($key == "MTTI%") {
                  if ($full_data["group_name"] == "Banking" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }
                }

                  elseif ($key == "MTTV%") {
                  if ($full_data["group_name"] == "Banking" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }
                }


                elseif ($key == "MTTR_ESP%") {
                  if ($full_data["group_name"] == "Banking" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value <= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }
                }

              elseif ($key == "MTTR_Logical%") {
                  if ($full_data["group_name"] == "Banking" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }
                elseif ($key == "MTTR_Global%") {
                  if ($full_data["group_name"] == "Banking" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }
                elseif ($key == "MTTR_Physical%") {
                  if ($full_data["group_name"] == "Banking" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }

                elseif ($key == "MTTR_Request%") {
                  if ($full_data["group_name"] == "Banking" && $value >= 98) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value >= 98) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value >= 98) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value >= 98) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value >= 98) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value >= 98) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }
                elseif ($key == "AHT_violation_Request%") {
                  if ($full_data["group_name"] == "Banking" && $value >= 98) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value >= 98) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value >= 98) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value >= 98) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value >= 98) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value >= 98) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }

//AHT_violation_ESP
                elseif ($key == "AHT_violation_ESP%") {
                  if ($full_data["group_name"] == "Banking" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }
//AHT_violation_logical
                elseif ($key == "AHT_violation_logical%") {
                  if ($full_data["group_name"] == "Banking" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }
//AHT_violation_Global
                elseif ($key == "AHT_violation_Global%") {
                  if ($full_data["group_name"] == "Banking" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }
//AHT_violation_Phy_yes_onsite
                elseif ($key == "AHT_violation_Phy_yes_onsite%") {
                  if ($full_data["group_name"] == "Banking" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }
//AHT_violation_Phy_no_onsite
                elseif ($key == "AHT_violation_Phy_no_onsite%") {
                  if ($full_data["group_name"] == "Banking" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value >= 95) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }

                  elseif ($key == "AVG_Ring_Time") {
                  if ($full_data["group_name"] == "Banking" && $value <= 10) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value <= 10) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value <= 10) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value <= 10) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value <= 10) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value <= 10) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }

                elseif ($key == "AVG_Call_Time") {
                  if ($full_data["group_name"] == "Banking" && $value <= 240) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value <= 240) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value <= 240) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value <= 240) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value <= 240) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value <= 240) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }

                elseif ($key == "AVG_Hold_Time") {
                  if ($full_data["group_name"] == "Banking" && $value <= 20) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value <= 20) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value <= 20) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value <= 20) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value <= 20) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value <= 20) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }

                elseif ($key == "Aban%") {
                  if ($full_data["group_name"] == "Banking" && $value <= 5) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value <= 5) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value <= 5) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value <= 5) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value <= 5) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value <= 5) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($value == 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee; ">'.$value.'</td>';
                  }else {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                  }
                }
                  //AVG_Hold_By_Eng
                  
                elseif ($key == "AVG_Hold_By_Eng") {
                  if ($full_data["group_name"] == "Banking" && $value <= 240) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value <= 240) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value<= 240) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value <= 240) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value <= 240) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value <= 240) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }
                  else {
                  echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                }

                } 

                elseif ($key == "P1%") {
                  if ($full_data["group_name"] == "Banking" && $value <= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value <= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value<= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value <= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value <= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value <= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }
                  else {
                  echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                }

                } 

                elseif ($key == "P2%") {
                  if ($full_data["group_name"] == "Banking" && $value <= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  } elseif ($full_data["group_name"] == "BS" && $value <= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GDS(Global Partner)" && $value<= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "GOV" && $value <= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Mega Projects" && $value <= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }elseif ($full_data["group_name"] == "Private KAM" && $value <= 0) {
                    echo'<td class="hovers" style="border: 1px solid #eee; background-color:lightgreen;">'.$value.'</td>';
                  }
                  else {
                  echo'<td class="hovers" style="border: 1px solid #eee; background-color:#ff6666;">'.$value.'</td>';
                }

                } 

                  else {
                  echo'<td >'.$value.'</td>';
                }

               
              
              }

            } else {
              echo'<td>N/A</td>';
            }
        
         }
         echo'</tr>';
       }
     }
        ?>

           </tbody>
          </table>
            </div>
          <!-- </form> -->
        </div>
      </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        $(".se-pre-con").fadeOut("slow");;
    });
</script>
<script src="js/table2excel.js" type="text/javascript"></script>
   <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "kpi_2024_SD.xls"
            });
        }
    </script>
<script src="js/excel_zip.js" type="text/javascript"></script>
<script src="table-filter.js"></script>

  <?php
 include ("footer.html");
 ?>
