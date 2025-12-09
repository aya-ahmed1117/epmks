
     <?php
    include ("pages.php");
          $usernames="";
          if(isset($_POST['username'])){$usernames = $_POST['username'];}
          $ticket_group="";
          if(isset($_POST['ticket_group'])){$ticket_group = $_POST['ticket_group'];}
          /////////////
       date_default_timezone_set('Africa/Cairo');

      $DBhost = "172.29.29.76";
      $DBuser = "Seniors";
      $DBpass = "123456789";
      $DBname = "WorkforceDB_indexed";
      
      $connectionInfo = array( "Database"=>$DBname , "UID"=>$DBuser , "PWD"=>"123456789");
      $connect = sqlsrv_connect($DBhost, $connectionInfo);

        $myMonth = isset($_POST['month']) ? $_POST['month'] : '';
        $newMonth = $myMonth ? date('n', strtotime($myMonth)) : '';
        $this_year = $myMonth ? date('Y', strtotime($myMonth)) : '';

        $username = $_SESSION['username'];
        $check_group = sqlsrv_query( $con,"SELECT [ID]
        ,[UserName]
        ,[Unit]
        ,[Groups],[SubGroups]
        FROM [Employess_DB].[dbo].[tbl_Personal_info]
        left join [Employess_DB].[dbo].[Tbl_Groups] on [Employess_DB].[dbo].[Tbl_Groups].[Group_ID]=[Group]
        left join [Employess_DB].[dbo].[Tbl_SubGroups] on [Employess_DB].[dbo].[Tbl_SubGroups].[subGroup_ID]=[sub_Group]
        where username ='$username' ");
        $group = sqlsrv_fetch_array($check_group);
         $my_group =$group['Groups'];
          ?>
    <title>Monthly raw data</title>
      <link rel="stylesheet" type="text/css" href="css/kpi_css.css">
    </head>

         <style type="text/css">
       
        .tableFixHead         
         { 
         	overflow-y: auto; height:500px; overflow-x: auto; 
         }
        .tableFixHead thead th 
        { 
        	position: sticky; top: 0; 
        }
       </style>


     <div style="padding: 20px;">

       <form method="post" >

               <?php 
      if (isset($_GET['MTTI'])) {
      ?>

      <center>
    <div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Monthly MTTI raw data

          <a href="KPI_rawdata.php">
        <button type="button" id="sidebarCollapse" class="btn btn-warning" >
        <i class="fa fa-backward"></i> Back
        </button></a></h2>
                  </div>
              </div>
          </div>
           <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       
            <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> 
           </a></p></samp>
        </aside>
      </div>
    </center>
     <br>
     <div class="row">
         <div class="col-md-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="month-addon">Choose Month</span>
                    <input name="month" type="month" required id="month" class="form-control" value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>'>
                </div>
            </div> 
        <div class="input-group-btn col-md-6">
          <button class="btn btn-primary"type='submit'
          name='submit' value="Get data"><i class="fa fa-check"></i> Submit</button>
        </div>
            </div>
     <?php

      $myMonth = isset($_POST['month']) ? $_POST['month'] : '';
      // $newMonth = $myMonth ? date('n', strtotime($myMonth)) : '';
      $myMonth = isset($_GET['month']) ? $_GET['month'] : date('F');
          if(isset($_POST['submit'])){ ?>

    <br>
    <h2 style="color:; ">Table Filter</h2>
        <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
        <br>
        <br>
    <div class="tableFixHead">
    <table class="table order-table"  cellspacing="0" id="tblCustomers" >
      <thead >
        <tr>
            <th ><center>year</center></th>
            <th ><center>Month</center></th>
            <th ><center>Request ID</center></th>
            <th ><center>Creation time</center></th>
            <th ><center>Ticket Group</center></th>
            <th ><center>SLA</center></th>

        </tr>
        </thead>
      <tbody>
    <?php 
    // MTTI

    // **✅ تحديد الاستعلام بناءً على المستخدم**
    if (($_SESSION['username'] == 'ahmed.mohamedbassal')||($_SESSION['username']=='mohamed.abdeltwab')) {
        $query = "SELECT * 
                  FROM [WorkForce_Reporting_DB].[dbo].[raw_data_mtti]
                  WHERE [Month] = '$newMonth' 
                  AND [Year] = '$this_year' 
                  AND (Ticket_group LIKE 'private KAM%' OR Ticket_group LIKE 'GDS%') ";
    } else {
        $query = "SELECT * 
                  FROM [WorkForce_Reporting_DB].[dbo].[raw_data_mtti]
                  WHERE [Month] = '$newMonth' 
                  AND [Year] = '$this_year' 
                  AND Ticket_group = '$my_group' ";
    }

    $MTTI1 = sqlsrv_query($connect, $query);

    if ($MTTI1 === false) {
        die(print_r(sqlsrv_errors(), true)); // عرض الأخطاء إن وجدت
    }

    while ($output = sqlsrv_fetch_array($MTTI1, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td class='hovers' style='border: 1px solid lightgray;text-align:center;'>{$output['year']}</td>";
        echo "<td class='hovers' style='border: 1px solid lightgray;text-align:center;'>{$output['Month']}</td>";
        echo "<td class='hovers' style='border: 1px solid lightgray;text-align:center;'>{$output['RequestID']}</td>";
        
        // **✅ التحقق من صحة تاريخ الإنشاء**
        echo "<td class='hovers' style='border: 1px solid lightgray;text-align:center;'>";
        if ($output['creation_time'] instanceof DateTime) {
            echo $output['creation_time']->format('Y-m-d H:i:s');
        } else {
            echo "Not Available";
        }
        echo "</td>";

        echo "<td class='hovers' style='border: 1px solid lightgray;text-align:center;'>{$output['Ticket_group']}</td>";
        echo "<td class='hovers' style='border: 1px solid lightgray;text-align:center;'>{$output['SLA']}</td>";
        echo "</tr>";
    }
    }
    ?>

      <script type="text/javascript">
            function Export() {
                $("#tblCustomers").table2excel({
                    filename: "MTTR.xls"
                });
            }
        </script>
    </div>
    </tbody>
    </table>
    </div>


    <?php 
    }

      if (isset($_GET['MTTR'])) {
      ?>
      <center>
    <div class="col-md-8">
       <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
            border-radius: 20px 20px 20px 20px;">
          <div class="card-header user-header alt bg-light"
                style="border-radius: 20px 20px 0 0 ;">
           <div class="media">
             <div class="media-body">
                  <h2 class="text-dark display-12" style="font-family:Century Gothic;" >
                    Monthly MTTR raw data
          <a href="KPI_rawdata.php">
        <button type="button" id="sidebarCollapse" class="btn btn-warning" >
        <i class="fa fa-backward"></i> Back
        </button></a>
    </h2>
                  </div>
              </div>
          </div>
           <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button
            <a role="button" id="btnExport" value="Export to Excel" onclick="Export()">       
            <img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> 
           </a>
       </p>
    </samp>
        </aside>
      </div>
    </center>
     <br>

      <div class="row">
         <div class="col-md-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="month-addon">Choose Month</span>
                    <input name="month" type="month" required id="month" class="form-control" value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>'>
                </div>
            </div> 
    <br>
       <div class="input-group-btn col-md-6">
          <button class="btn btn-primary"type='submit'
          name='submit' value="Get data"><i class="fa fa-check"></i> Submit</button>
        </div>

            </div>
     <?php
     //MTTI
       if(isset($_POST['submit'])){?>

    <br>
    <h2 style="color:; ">Table Filter</h2>
        <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
        <br>
        <br>
        <div style="padding: 20px;">
    <div class="tableFixHead">
    <table class="table order-table"  cellspacing="0" id="tblCustomers" >
      <thead >
        <tr>
            <th ><center>Year</center></th>
            <th ><center>Month</center></th>
            <th ><center>Request ID</center></th>
            <th ><center>Creation time</center></th>
            <th ><center>Ticket Group</center></th>
            <th ><center>SLA</center></th>
            <th ><center>Category</center></th>
            <th ><center>MTTR</center></th>
        </tr>
        </thead>
      <tbody>
        <tr>

    <?php 
    if(($_SESSION['username'] == 'ahmed.mohamedbassal')||($_SESSION['username']=='mohamed.abdeltwab')){

                $distincts = sqlsrv_query($connect,"SELECT *
      FROM [WorkForce_Reporting_DB].[dbo].[raw_data_MTTR]
      where [Month] ='$newMonth' and [Year] ='$this_year' 
      and (Ticket_group like 'private KAM%' or Ticket_group like 'GDS%') ");

        }else{
        $distincts = sqlsrv_query($connect,"SELECT *
          FROM [WorkForce_Reporting_DB].[dbo].[raw_data_MTTR]
          WHERE [Month] ='$newMonth' and [Year] ='$this_year' and 
            (('$my_group' = 'BS-CO' AND Ticket_group LIKE 'BS-CO%')
                OR ('$my_group' <> 'BS-CO' AND Ticket_group LIKE '$my_group%' AND Ticket_group NOT LIKE 'BS-CO%')) ");
        }

    if ($distincts === false) {
        die(print_r(sqlsrv_errors(), true)); 
    }

        while ($output = sqlsrv_fetch_array($distincts, SQLSRV_FETCH_ASSOC)) {
        $rows  ='<tr>';
          $rows .='<td style="font-size:15px;border: 1px solid lightgray;text-align:center;">'.$output["Year"].'</td>';
          $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["Month"].'</td>';
           $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["requestid"].'</td>';
           $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["creation_time"]->format('Y-m-d H:i:s').'</td>';
           $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["Ticket_group"].'</td>';
           $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["SLA"].'</td>';
           $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["Category"].'</td>';
          $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["MTTR"].'</td>';
          

    echo $rows;
            }
        }
      ?>
      </tr>
    </tbody>
    </table>
    </div>
    </div>

    <script type="text/javascript">
            function Export() {
                $("#tblCustomers").table2excel({
                    filename: "MTTR_SD.xls"
                });
            }
        </script>

        <?php 
        }

          if (isset($_GET['MTTV'])) {
          ?>
      <center>
    <div class="col-md-8">
       <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
            border-radius: 20px 20px 20px 20px;">
          <div class="card-header user-header alt bg-light"
                style="border-radius: 20px 20px 0 0 ;">
           <div class="media">
             <div class="media-body">
                <h2 class="text-dark display-12" style="font-family:Century Gothic;" >
                    Monthly MTTV raw data

                    <a href="KPI_rawdata.php">
                        <button type="button" id="sidebarCollapse" class="btn btn-warning" >
                        <i class="fa fa-backward"></i> Back
                        </button>
                    </a>
                </h2>
                  </div>
              </div>
          </div>
       <samp>
        <p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button
            <a role="button" id="btnExport" value="Export to Excel" onclick="Export()">      
            <img src="images/aaa-removebg-preview.png" class="zoom"style="width:10%;"/> 
           </a>
       </p>
      </samp>
        </aside>
      </div>
    </center>
     <br>
      <div class="row">
         <!-- Month Selection -->
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="month-addon">Choose Month</span>
                    <input name="month" type="month" required id="month" class="form-control" value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>'>
                </div>
            </div> 
    <br>
        <div class="input-group-btn col-md-6">
          <button class="btn btn-primary"type='submit'
          name='submit' value="Get data"><i class="fa fa-check"></i> Submit</button>
        </div>

      </div>
       
     <?php
     //MTTV
       if(isset($_POST['submit'])){?>

    <br>
    <h2 style="color:; ">Table Filter</h2>
        <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
        <br>
        <br>
        <div style="padding: 20px;">
    <div class="tableFixHead">
    <table class="table order-table"  cellspacing="0" id="tblCustomers" >
      <thead >
        <tr>
            <th ><center>Year</center></th>
            <th ><center>Month</center></th>
            <th ><center>Creation time</center></th>
            <th ><center>Ticket Group</center></th>
            <th ><center>RequestID</center></th>
            <th ><center>SLA</center></th>
        </tr>
        </thead>
      <tbody>
        <tr>

    <?php 
    if(($_SESSION['username'] == 'ahmed.mohamedbassal')||($_SESSION['username']=='mohamed.abdeltwab')){

                $distincts = sqlsrv_query($connect,"SELECT * 
          FROM [WorkForce_Reporting_DB].[dbo].[raw_data_mttv]
       where [Month] ='$newMonth' and [year] ='$this_year' and 
             (Ticket_group like 'private KAM%' or Ticket_group like 'GDS%') ");

        }else{
        $distincts = sqlsrv_query($connect,"SELECT * 
          FROM [WorkForce_Reporting_DB].[dbo].[raw_data_mttv]
       WHERE [Month] ='$newMonth' and [year] ='$this_year' and 
    (('$my_group' = 'BS-CO' AND Ticket_group LIKE 'BS-CO%')
        OR ('$my_group' <> 'BS-CO' AND Ticket_group LIKE '$my_group%' AND Ticket_group NOT LIKE 'BS-CO%'))");
        }

    if ($distincts === false) {
        die(print_r(sqlsrv_errors(), true)); 
    }

        while ($output = sqlsrv_fetch_array($distincts, SQLSRV_FETCH_ASSOC)) {

    $rows  ='<tr>';
      $rows .='<td style="font-size:15px;border: 1px solid lightgray;text-align:center;">'.$output["year"].'</td>';
      $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["Month"].'</td>';
      $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["creation_time"]->format('Y-m-d H:i:s').'</td>';
      $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["Ticket_group"].'</td>';
      $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["RequestID"].'</td>';
      $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["SLA"].'</td>';

    echo $rows;
            }
        }
      ?>
      </tr>
    </tbody>
    </table>
    </div>
    </div>

    <script type="text/javascript">
            function Export() {
                $("#tblCustomers").table2excel({
                    filename: "Average_MTTR_SD.xls"
                });
            }
        </script>

            <?php 
            }


          if (isset($_GET['AHT'])) {
          ?>
      <center>
    <div class="col-md-8">
       <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
            border-radius: 20px 20px 20px 20px;">
          <div class="card-header user-header alt bg-light"
                style="border-radius: 20px 20px 0 0 ;">
           <div class="media">
             <div class="media-body">
                  <h2 class="text-dark display-12" style="font-family:Century Gothic;" >
                    Monthly AHT raw data

          <a href="KPI_rawdata.php">
            <button type="button" id="sidebarCollapse" class="btn btn-warning" >
                <i class="fa fa-backward"></i> Back
            </button>
          </a>
        </h2>
                  </div>
              </div>
          </div>
       <samp>
        <p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button
            <a role="button" id="btnExport" value="Export to Excel" onclick="Export()">
            <img src="images/aaa-removebg-preview.png" class="zoom" style="width:10%;"/>
           </a>
       </p>
      </samp>
     </aside>
    </div>

    </center>
     <br>

      <div class="row">
            <!-- Month Selection -->
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="month-addon">Choose Month</span>
                    <input name="month" type="month" required id="month" class="form-control" value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>'>
                </div>
            </div>
        <br>
        <div class="input-group-btn col-md-6">
          <button class="btn btn-primary"type='submit'
          name='submit' value="Get data"><i class="fa fa-check"></i> Submit</button>
        </div>
     </div>
     <?php
     //AHT


       if(isset($_POST['submit'])){
        $myMonth   = isset($_POST['month']) ? $_POST['month'] : '';/////////
        $newMonth  = $myMonth ? date('n', strtotime($myMonth)) : '';
        $this_year = $myMonth ? date('Y', strtotime($myMonth)) : '';

        ?>

    <br>
    <h2 style="color:; ">Table Filter</h2>
        <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
        <br>
        <br>
        <div style="padding: 20px;">
    <div class="tableFixHead">
        <table class="table order-table"  cellspacing="0" id="tblCustomers" >
          <thead >
            <tr>
                <th ><center>Year</center></th>
                <th ><center>Month</center></th>
                <th ><center>Request ID</center></th>
                <th ><center>Ticket Group</center></th>
                <th ><center>SLA</center></th>
                <th ><center>category</center></th>
                <th ><center>AHT</center></th>
                <th ><center>Creation Time</center></th>

            </tr>
            </thead>
          <tbody>
            <tr>

    <?php 
        if(($_SESSION['username'] == 'ahmed.mohamedbassal')||($_SESSION['username']=='mohamed.abdeltwab')){

                    $distinAHT = sqlsrv_query($connect,"SELECT * 
              FROM [WorkForce_Reporting_DB].[dbo].[raw_data_aht]
               where [Month] ='$newMonth' and [year] ='$this_year' and 
                 (Ticket_group like 'private KAM%' or Ticket_group like 'GDS%') ");

            }else{
            $distinAHT = sqlsrv_query($connect,"SELECT *
                FROM [WorkForce_Reporting_DB].[dbo].[raw_data_aht]
                WHERE [Month] ='$newMonth' and [year] ='$this_year' and 
                (('$my_group' = 'BS-CO' AND Ticket_group LIKE 'BS-CO%')
                    OR ('$my_group' <> 'BS-CO' AND Ticket_group LIKE '$my_group%' AND Ticket_group NOT LIKE 'BS-CO%'))");


            }

        if ($distinAHT === false) {
            die(print_r(sqlsrv_errors(), true)); 
        }

            while ($output = sqlsrv_fetch_array($distinAHT, SQLSRV_FETCH_ASSOC)) {

        $rows  ='<tr>';
          $rows .='<td style="font-size:15px;border: 1px solid lightgray;text-align:center;">'.$output["year"].'</td>';
          $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["Month"].'</td>';
           $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["RequestID"].'</td>';
          $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["Ticket_group"].'</td>';
          $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["SLA"].'</td>';
           $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["category"].'</td>';
          $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["AHT"].'</td>';
          $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["creation_time"]->format('Y-m-d H:i:s').'</td>';

        echo $rows;
                }
            }
          ?>
              </tr>
            </tbody>
        </table>
      </div>
    </div>
    <script type="text/javascript">
            function Export() {
                $("#tblCustomers").table2excel({
                    filename: "Average_MTTR_SD.xls"
                });
            }
        </script>

    <?php 
            }


          if (isset($_GET['P1'])) {
          ?>
      <center>
    <div class="col-md-8">
       <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
            border-radius: 20px 20px 20px 20px;">
          <div class="card-header user-header alt bg-light"
                style="border-radius: 20px 20px 0 0 ;">
           <div class="media">
             <div class="media-body">
                  <h2 class="text-dark display-12" style="font-family:Century Gothic;" >
                    Monthly P1 raw data

          <a href="KPI_rawdata.php">
        <button type="button" id="sidebarCollapse" class="btn btn-warning" >
        <i class="fa fa-backward"></i> Back
        </button></a>
    </h2>
                  </div>
              </div>
          </div>
           <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button
            <a role="button" id="btnExport" value="Export to Excel" onclick="Export()">
            <img src="images/aaa-removebg-preview.png" class="zoom" style="width:10%;"/> 
           </a>
       </p>
    </samp>
        </aside>
      </div>
    </center>
     <br>

      <div class="row">
            <!-- Month Selection -->
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="month-addon">Choose Month</span>
                    <input name="month" type="month" required id="month" class="form-control" value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>'>
                </div>
            </div>
        <br>
            <div class="input-group-btn col-md-6">
              <button class="btn btn-primary"type='submit'
              name='submit' value="Get data"><i class="fa fa-check"></i> Submit</button>
            </div>
     </div>
     <?php
     //P1
       if(isset($_POST['submit'])){
        $newMonth = $myMonth ? date('n', strtotime($myMonth)) : '';
        $newMonth = $myMonth ? date('n', strtotime($myMonth)) : '';
        $this_year = $myMonth ? date('Y', strtotime($myMonth)) : '';
        ?>

    <br>
        <h2 style="color:; ">Table Filter</h2>
            <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
            <br>
        <br>
      <div style="padding: 20px;">
        <div class="tableFixHead">
            <table class="table order-table"  cellspacing="0" id="tblCustomers" >
              <thead >
                <tr>
                    <th ><center>Year</center></th>
                    <th ><center>Month</center></th>
                    <th ><center>Ticket Group</center></th>
                    <th ><center>NodeId</center></th>

                </tr>
                </thead>
              <tbody>
                <tr>
    <?php 
             if(($_SESSION['username'] == 'ahmed.mohamedbassal')||($_SESSION['username']=='mohamed.abdeltwab')){

                    $distinP1 = sqlsrv_query($connect,"SELECT * 
              FROM [WorkForce_Reporting_DB].[dbo].[raw_data_p1]
               where [Month] ='$newMonth' and [year] ='$this_year' and 
                 (Ticket_group like 'private KAM%' or Ticket_group like 'GDS%') ");

            }else{
            $distinP1 = sqlsrv_query($connect,"SELECT * 
              FROM [WorkForce_Reporting_DB].[dbo].[raw_data_p1]
               WHERE [Month] ='$newMonth' and [year] ='$this_year' and 
                (('$my_group' = 'BS-CO' AND Ticket_group LIKE 'BS-CO%')
                    OR ('$my_group' <> 'BS-CO' AND Ticket_group LIKE '$my_group%' AND Ticket_group NOT LIKE 'BS-CO%'))");
            }

        if ($distinP1 === false) {
            die(print_r(sqlsrv_errors(), true)); 
        }

            while ($output = sqlsrv_fetch_array($distinP1, SQLSRV_FETCH_ASSOC)) {
        $rows  ='<tr>';
          $rows .='<td style="font-size:15px;border: 1px solid lightgray;text-align:center;">'.$output["year"].'</td>';
          $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["month"].'</td>';
          $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["Ticket_group"].'</td>';
          $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["nodeid"].'</td>';
          // $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["creation_time"]->format('Y-m-d H:i:s').'</td>';

        echo $rows;
                }
            }
          ?>
              </tr>
            </tbody>
        </table>
      </div>
    </div>
    <script type="text/javascript">
            function Export() {
                $("#tblCustomers").table2excel({
                    filename: "p1_rawdata.xls"
                });
            }
        </script>

    <?php 
      }


          if (isset($_GET['P2'])) {
          ?>
      <center>
    <div class="col-md-8">
       <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
            border-radius: 20px 20px 20px 20px;">
          <div class="card-header user-header alt bg-light"
                style="border-radius: 20px 20px 0 0 ;">
           <div class="media">
             <div class="media-body">
                <h2 class="text-dark display-12" style="font-family:Century Gothic;" >
                    Monthly P2 raw data
                  <a href="KPI_rawdata.php">
                    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
                        <i class="fa fa-backward"></i> Back
                    </button>
                  </a>
                </h2>
             </div>
            </div>
          </div>
           <samp>
            <p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button
                <a role="button"id="btnExport"value="Export to Excel"onclick="Export()">
                 <img src="images/aaa-removebg-preview.png"class="zoom"
                      style="width:10%;">
               </a>
              </p>
            </samp>
          </aside>
        </div>
    </center>
     <br>

      <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="month-addon">Choose Month</span>
                    <input name="month" type="month" required id="month" class="form-control" value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>'>
                </div>
            </div>
        <br>
        <div class="input-group-btn col-md-6">
          <button class="btn btn-primary"type='submit'
          name='submit' value="Get data"><i class="fa fa-check"></i> Submit</button>
        </div>
     </div>
     <?php
     //P2
       if(isset($_POST['submit'])){
        // $myMonth = isset($_POST['month']) ? $_POST['month'] : '';/////////
        $newMonth = $myMonth ? date('n', strtotime($myMonth)) : '';
        $this_year = $myMonth ? date('Y', strtotime($myMonth)) : '';

        ?>

    <br>
    <h2 style="color:; ">Table Filter</h2>
        <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter"/>
        <br>
        <br>
        <div style="padding: 20px;">
     <div class="tableFixHead">
        <table class="table order-table"  cellspacing="0" id="tblCustomers" >
          <thead >
            <tr>
                <th ><center>Year</center></th>
                <th ><center>Month</center></th>
                <th ><center>Ticket Group</center></th>
                <th ><center>NodeId</center></th>

            </tr>
            </thead>
          <tbody>
            <tr>
    <?php 
            if(($_SESSION['username'] == 'ahmed.mohamedbassal')||($_SESSION['username']=='mohamed.abdeltwab')){

                    $distinP2 = sqlsrv_query($connect,"SELECT * 
              FROM [WorkForce_Reporting_DB].[dbo].[raw_data_p2]
               where [month] ='$newMonth' and [year] ='$this_year'  and 
                 (Ticket_group like 'private KAM%' or Ticket_group like 'GDS%') ");

            }else{
            $distinP2 = sqlsrv_query($connect,"SELECT * 
              FROM [WorkForce_Reporting_DB].[dbo].[raw_data_p2]
               WHERE [Month] ='$newMonth' and [year] ='$this_year' and 
    (('$my_group' = 'BS-CO' AND Ticket_group LIKE 'BS-CO%')
        OR ('$my_group' <> 'BS-CO' AND Ticket_group LIKE '$my_group%' AND Ticket_group NOT LIKE 'BS-CO%'))");
            }

        if ($distinP2 === false) {
            die(print_r(sqlsrv_errors(), true)); 
        }

            while ($output = sqlsrv_fetch_array($distinP2, SQLSRV_FETCH_ASSOC)) {

        $rows  ='<tr>';
          $rows .='<td style="font-size:15px;border: 1px solid lightgray;text-align:center;">'.$output["year"].'</td>';
          $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["month"].'</td>';
          $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["Ticket_group"].'</td>';
          $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["nodeid"].'</td>';
        //   if ($output["creation_time"] == NULL){
        //     $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">Blank</td>';
        // }else{
        //   $rows .='<td class="hovers" style="border: 1px solid lightgray;text-align:center;">'.$output["creation_time"]->format('Y-m-d H:i:s').'</td>';
        // }

        echo $rows;
                }
            }
          ?>
              </tr>
            </tbody>
        </table>
      </div>
    </div>
    <script type="text/javascript">
            function Export() {
                $("#tblCustomers").table2excel({
                    filename: "p2_rawdata.xls"
                });
            }
        </script>

    <?php 
    }
    ?>
      </form>

    </div>
    <script src="js/table2excel.js" type="text/javascript"></script>

    <?php
     include ("footer.html");
     ?>

