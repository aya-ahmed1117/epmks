  <?php 
  
  include ("pages.php");
  $self = $_SESSION['id'];
  $role_id = $_SESSION['role_id'];
  $usernames="";
  if(isset($_POST['username'])){$usernames = $_POST['username'];}
  $self = $_SESSION['id'];
  $role_id = $_SESSION['role_id'];
  ?>
  <title>psc reports</title>

  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="fixed_s/vendor/animate/animate.css">
</head>
<center>

  <div class="col-md-9">
    <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
    border-radius: 20px 20px 20px 20px;">
    <div class="card-header user-header alt bg-light"
    style="border-radius: 20px 20px 0 0 ;">
    <div class="media">
      <div class="media-body">
        <h2 class="text-dark display-12">PSC Reports</h2>
        <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
      </div>
    </div>
  </div>
  <p style="background-color:#55608f;font-weight:bold;font-size:16px;
  color:white;">Here you can Find Open tickets Report - Closed Ticket reports and Bank Masr Report per Day</p>
</aside>
</div>
</center>

<div style="padding:20px;">


 <div class="content">
  <div class="animated fadeIn">
   <div class="row" style="width:100%; padding: 20px;">

    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">PSC Open</strong>
          <!-- <h6  style="text-align:right;transform: matrix(1, 0, 0, 1, 1, -28);margin-bottom: 0;padding:0px;">suspended</h6> -->
        </div>
        <a href="open_tickets.php" class="divlink">
          <div class="card-body">
            <img src="images/psc2.png" style="width:15%;float: right;margin-top: -14px;">
            <p class="card-text">Open Tickets</p>
          </div>
        </a>
      </div>     
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">PSC Closed</strong>
          <!-- <h6  style="text-align:right;transform: matrix(1, 0, 0, 1, 1, -28);margin-bottom: 0;padding:0px;">suspended</h6> -->
        </div>
        <a href="closed_yesterday.php"class="divlink">
          <div class="card-body">
            <img src="images/psc2.png" style="width:15%;float: right;margin-top: -14px;">
            <p class="card-text">Closed Yeterday</p>
          </div>
        </a>
      </div>
    </div>

    <?php 
    $new_q= sqlsrv_query( $con , "SELECT 
      groups
      FROM [Employess_DB].[dbo].[tbl_Personal_info]
      left join Employess_DB.dbo.Tbl_Groups on Group_ID = [Group]
      where username = '$s_username'");
    $out_new = sqlsrv_fetch_array($new_q);
    $my_group = $out_new['groups'];
    if(($my_group == 'Banking') || ($role_id == 1)){
      ?>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            <strong class="card-title">PSC Bank Masr</strong>
            <!-- <h6  style="text-align:right;transform: matrix(1, 0, 0, 1, 1, -28);margin-bottom: 0;padding:0px;">suspended</h6> -->
          </div>
          <div class="row" >
            <a href="banque_M.php"class="divlink">
              <div class="card-body">
                <img src="images/bank_misr.png" style="width:12%;float: right;margin-top: -10px;">
                <p class="card-text">Bank Masr</p>
              </div>
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<div class="content">
  <div class="animated fadeIn">
   <div class="row" style="width:100%; padding: 20px;">

    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">PSC NBE</strong>
          <!--  <h6  style="text-align:right;transform: matrix(1, 0, 0, 1, 1, -28);margin-bottom: 0;padding:0px;">suspended</h6> -->
        </div>
        <div class="row" >
          <a href="NBE_bank.php"class="divlink">
            <div class="card-body">
              <img src="images/NBE_ahly.png" style="width:10%;float: right;margin-top: -5px;">
              <p class="card-text">NBE Bank</p>

            </div>
          </a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <strong class="card-title">PSC HSBC</strong>
            </div>
        <div class="row" >
          <a href="hsbc_bank.php"class="divlink">
            <div class="card-body">
              <img src="images/hsbc.png" style="width:10%;float: right;margin-top: -5px;">
              <p class="card-text">HSBC Bank</p>

            </div>
          </a>
        </div>
      </div>
    </div>

    <?php 
  }
  ?>
</div>
</div>
</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
<script type="text/javascript">
//paste this code under the head tag or in a separate js file.
    // Wait for window load
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
      });
    </script>
    <script src="table-filter.js"></script>

    <?php
    include ("footer.html");
    ?>
