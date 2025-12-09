
<?php
include ("pages.php");
?>

	<title>Team Schedule</title>
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fixed_s/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="fixed_s/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="fixed_s/vendor/perfect-scrollbar/perfect-scrollbar.css">
  
</thead>

    <style type="text/css">
    .hovers:hover {
          background-color: #333d6b ;
          color: white;
          border-radius:20px 20px 20px 20px ;
            }
     .tableFixHead .column1{
       font-size:14px;
       background-color:#55608f;
       color: white;
     }

    .tableFixHead         
     { 
     	overflow-y: auto; height:400px; overflow-x: auto; 
        background-color: #fff;
     }
    .tableFixHead thead th 
    { 
    	position: sticky; top: 0; 

    }
          .tableFixHead tbody  td:nth-child(1)
    { 
        position: sticky; 
        width: 100px;
        background: #fff;
        /*border: 1px solid gray;*/
        left: 0;

    }

      .tableFixHead tbody  td:nth-child(2)
    { 
        position: sticky; 
        width: 100px;
        background: #eee;
        /*border: 1px solid gray;*/
       

    }
    .tableFixHead thead th:nth-child(1)
    { 
        position: sticky;
        left: 0;
        z-index: 10;
        width: 100px;
        background: #55608f;  
    }
    .tableFixHead thead th:nth-child(2)
    { 
        z-index: 10;
        position: sticky; 
        width: 100px;
        background: #55608f;
    }

     tr:nth-child(even) {
      background-color: #e9ecef;
    }
      </style>
    <style type="text/css">
    .scroller {
      max-width: 100px;
      overflow: auto;
    }

    table, table * {
      box-sizing: border-box;
      }

    th {
      text-align: center;
      white-space: nowrap;
      text-overflow: ellipsis;
        font-size: 18px;
        color: #fff;
        line-height: 1.4;
    }

    /* borders should be on th/td so the table can collapse them */
    th, td {
        border-top: 1px solid lightgray;
        padding: 0; /* Default padding should be removed */
        white-space: nowrap;
        text-overflow: ellipsis;
        font-size: 15px;
        text-align: center;
        /* color: #808080; */
        line-height: 1.4;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    /* padding, overflow ellipses etc behaves better if
       content is wrapped in an inner element */
    .inner-cell {
        background: #55608f;
        padding: 5px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        width: auto;
        color: #fff;
        font-size: 15px;
        text-align: center;
        /* color: #808080; */
        line-height: 1.4;
    }

    .sticky {
      position: sticky;
      width: 100px;
      left: 0;

    }
    .sticky-2 {
        left: 12em;
        width: 100px;
        padding: 15px;
        background-color: #55608f;
    }
    .sticky-3 {
      left: 11em;
    }
    /* Behaves better if width is set on inner el (or it moves 1px when scrolling) */
    .sticky .inner-cell {
      width: 11em;
    }



    </style>

<center>
  
<div class="col-md-9">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >My Team Schedule</h2>
              <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Shows you team Sch time and leaves</p>
  </aside>
</div>
</center>

<center>
<div class="col-md-8">
    <h2 style="color:;">Table Filter</h2>
    <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter">
    <br><br>
    <div class="tableFixHead" style="border-radius: 20px 20px 20px 20px;">
        <table class="table order-table">
            <thead>
                <tr>
                    <th class="sticky sticky-1">
                        <div class="inner-cell">Username</div>
                    </th>
                    <th class="sticky sticky-2">
                        <div class="inner-cell">Month</div>
                    </th>
                    <?php for ($day = 1; $day <= 31; $day++) { ?>
                        <th class="column1"><center><?php echo $day; ?></center></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php    
             
                
                $engineer_id = $_SESSION['id'];
                $s_username = $_SESSION['username'];
                
                if($role_id >= 0){
                    $self = $_SESSION['id'];

                    $check_engineers1 = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id = '$self' ");
                         while( $output_engineers = sqlsrv_fetch_array($check_engineers1)){

                      $engineers_id = $output_engineers['id'];
                      $eng_username = $output_engineers['username'];
                      $username_id = $output_engineers['username_id'];
                    $check_engineers = sqlsrv_query( $con1 ,"SELECT distinct [ID]
                          ,[Employee_Name]
                          ,[UserName],[Birth_Date],[groups]
                     FROM [Employess_DB].[dbo].[tbl_Personal_info] 
                     left join  [Employess_DB].dbo.Tbl_Groups on Group_ID = [group]
                     where [UserName] = '$s_username'  ");
                 
                      $output_query = sqlsrv_fetch_array($check_engineers);
                      $groups = $output_query["groups"];


                    }
                    
                    $user_query = sqlsrv_query($con, "EXEC MyTeamSch_junior @groups = '$groups'");
                    while($output_query2 = sqlsrv_fetch_array($user_query)){
                        echo '<tr class="row100 body">';
                        echo '<td class="sticky sticky-1">' . $output_query2["username"] . '</td>';
                        echo '<td class="sticky sticky-2">' . $output_query2["month"] . '</td>';
                        
                        for ($day = 1; $day <= 31; $day++) {
                            $status = $output_query2[$day];
                            $color = "";
                            switch ($status) {
                                case 'Annual Leave':
                                    $color = "background-color:#0d6efd;color:#eee;";
                                    break;
                                case 'Official Mission':
                                    $color = "background-color:#198754;color:white;";
                                    break;
                                case 'Sick Leave':
                                    $color = "background-color:#ffc107;color:black;";
                                    break;
                                case 'OFF':
                                    $color = "color:red;";
                                    break;
                            }
                            echo '<td class="hovers" style="' . $color . '">' . $status . '</td>';
                        }
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</center>

    <script src="fixed_s/js/mainss.js"></script>

	<?php
 include ("footer.html");
 ?>
