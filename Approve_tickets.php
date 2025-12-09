
<?php
include ("pages.php");

     $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
      $s_username = $_SESSION['username'];
      ?>
    <title>Approve ticket</title>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/my_table.css">

</head>
 
<div style="padding:20px;">
<center>
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Ticketing System</h2>
              <p style="color:lightgray;"> <?php
              $time = date("H");
              if ($time < "12") {
        echo "<img src='images/morning.png' style='width:50px;' > Good morning : $s_username";
    }if ($time >= "12" && $time < "17") {
        echo "<img src='images/afternoon.png' style='width:50px;margin-top:-15px;' > Good afternoon : $s_username";
    }if ($time >= "17" && $time < "19") {
        echo "<img src='images/evening.png' style='width:50px;' > Good evening : $s_username";
    } if ($time >= "19") {
        echo "<img src='images/night.png' style='width:50px;' > Good night : $s_username";
    }
  ?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Here you can find all requests pending workforce action</p>
    </aside>
  </div>
</center>
  
</div>
<br>
<br>
<?php

$self = $_SESSION['id'];

if ($_SESSION['role_id'] == 1) {

    // الحالات المطلوبة وعدد التذاكر لكل حالة
    $statuses = [
        'Open' => 0,
        'in progress' => 0,
        'closed' => 0,
        'pending to requester' => 0,
        'pending to admin' => 0,
        'on hold' => 0
    ];

    // قراءة كل الحالات وعد القيم
    $query = "SELECT Request_status, COUNT(*) as count 
          FROM tbl_Ticketing_system 
          WHERE Creation_time >= '2025-01-01'
          GROUP BY Request_status";

    $result = sqlsrv_query($con, $query);

    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $status = strtolower($row['Request_status']);
        foreach ($statuses as $key => $val) {
            if (strtolower($key) == $status) {
                $statuses[$key] = $row['count'];
            }
        }
    }

    // عرض الكروت
    echo '<div class="content">
            <div class="animated fadeIn">
              <div class="row" style="width:100%; padding: 20px;">';

    function createCard($title, $count, $param)
    {
        return '
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">' . $title . '</strong>
                </div>
                <a href="approve_ticket.php?' . $param . '" class="divlink">
                    <div class="card-body">
                        <p class="card-text">' . $count . '</p>
                    </div>
                </a>
            </div>
        </div>';
    }

    echo createCard('Open', $statuses['Open'], 'status=Open');
    echo createCard('In Progress', $statuses['in progress'], 'status=in+progress');
    echo createCard('Pending to Requester', $statuses['pending to requester'], 'status=pending+to+requester');

    echo '</div></div></div>';

    echo '<div class="content">
            <div class="animated fadeIn">
              <div class="row" style="width:100%; padding: 20px;">';

    echo createCard('Pending to Admin', $statuses['pending to admin'], 'status=pending+to+admin');
    echo createCard('On Hold', $statuses['on hold'], 'status=on+hold');
    echo createCard('Closed', $statuses['closed'], 'status=closed');

    echo '</div></div></div>';
}
?>

 

</div>
    <?php

 include ("footer.html");
 ?>
