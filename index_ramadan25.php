<!DOCTYPE html>
<html lang="en">
<head>
      <link rel="icon" href="images/wee-Logo-d.png">

  <title>Home</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">
<!--   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 -->  
<!--   <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
 -->  <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Lateef&display=swap" rel="stylesheet">

    <?php
     ob_start();
 ?>
 <?php require_once("inc/config.inc");
//ini_set('session.gc_maxlifetime', 315360000);    //# 3 hours
       ?>
<link href="https://fonts.googleapis.com/css?family=Fira+Sans:900|Merriweather&display=swap" rel="stylesheet">
<link rel="stylesheet"type="text/css"href="fonts/iconic/css/material-design-iconic-font.min.css">
<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!-- <link rel="stylesheet" type="text/css" href="css/util.css">
 -->
 <link rel="stylesheet" type="text/css" href="css/mainlog.css">
<script type="text/javascript" src="jQuery/jquery-3.6.0.js"></script>
<script type="text/javascript" src="jQuery/package/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
</head>
<body>
    <style type="text/css">
   @font-face {
  font-family: 'Noto Sans Kufi Arabic';
  font-style: normal;
  font-weight: 400;
  src: url(//fonts.gstatic.com/ea/notosanskufiarabic/v2/NotoSansKufiArabic-Regular.eot);
  src: url(//fonts.gstatic.com/ea/notosanskufiarabic/v2/NotoSansKufiArabic-Regular.eot?#iefix) format('embedded-opentype'),
       url(//fonts.gstatic.com/ea/notosanskufiarabic/v2/NotoSansKufiArabic-Regular.woff2) format('woff2'),
       url(//fonts.gstatic.com/ea/notosanskufiarabic/v2/NotoSansKufiArabic-Regular.woff) format('woff'),
       url(//fonts.gstatic.com/ea/notosanskufiarabic/v2/NotoSansKufiArabic-Regular.ttf) format('truetype');
}
/*@font-face {
  font-family: 'Noto Sans Kufi Arabic';
  font-style: normal;
  font-weight: 700;
  src: url(//fonts.gstatic.com/ea/notosanskufiarabic/v2/NotoSansKufiArabic-Bold.eot);
  src: url(//fonts.gstatic.com/ea/notosanskufiarabic/v2/NotoSansKufiArabic-Bold.eot?#iefix) format('embedded-opentype'),
       url(//fonts.gstatic.com/ea/notosanskufiarabic/v2/NotoSansKufiArabic-Bold.woff2) format('woff2'),
       url(//fonts.gstatic.com/ea/notosanskufiarabic/v2/NotoSansKufiArabic-Bold.woff) format('woff'),
       url(//fonts.gstatic.com/ea/notosanskufiarabic/v2/NotoSansKufiArabic-Bold.ttf) format('truetype');
}*/
body {
  background-image: url("images/ramadan/ramadan-2024-meta.png");
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  height: 100vh;

    /* Set a specific height */
  /*min-height: 800px;*/

  /* Create the parallax scrolling effect */
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;

  -webkit-backdrop-filter: blur(5px);
  backdrop-filter: blur(3px);
}
.iconDetails {
    /*margin:0 2%;*/
    /*float:left;*/
    width:45%;
    background-color: white;
    border-radius: 50%;
    display: block;
    margin-left: auto;
    margin-right: auto;
    /*margin-top: -30px;*/
}
  /*.container2 {
    width:100%;
    height:auto;
    padding:1%;
}*/
.text {
    align-items: center;
    text-indent: 30px;
}

.text h4, .text p {

  width:15%;
  font-size:20px;
  margin:0px;
  line-height:1.5em;
  color:white;
  /*text-indent: 30px;*/
}
/*h4{
margin:0px;
margin-top:3%;
margin-left:50px;
color:white;
font-size: 15px;
}*/
.text p span {
    color:#fff;
}
.image-txt-container {
  margin-left: 20px;
  display: flex;
  align-items: center;
  flex-direction: row;
  border-style: dashed solid yellow;
}

.vl {
 border-bottom: 5px solid #fff;
 margin: 5px;
 margin-top: 10px;
 /*width: 55px;*/
 text-align: center;
  /*height: 100px;*/
  /*margin-left: 15px;*/
}
/*******/
.wrap-login1000 {
    width: 360px;
    border-radius: 10px;
    border-style: dashed;
    overflow: hidden;
    /*flex-wrap: wrap;*/
    justify-content: space-between;
    padding: 35px 35px 35px 35px;
   /* display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;*/
    box-shadow: 5px 5px 20px 0 rgba(0,0,0,0.7);
    opacity: 5.1;
    background-color: rgba(0,0,0,0.5);
  
    background-size: 100%;
    background-repeat: no-repeat;
    align-items: center;
    transform: translate(-20px);

}
 .u-icon-2 img{
    margin-left: 12px;
    vertical-align: -10px;

    position: relative;
    display: inline;
    line-height: inherit;
    /*font-size: 50px;*/
    width: 10%;
    fill: currentColor;
    vertical-align: middle;
    white-space: nowrap;
}
/*.wrap-login100:hover{
   background-color :#b224ef;
}*//*
.landing__container path{
       background: linear-gradient(to top left, #660033 16%, #ff0066 74%);
  }*/

  .landing__container {
    opacity: 1;
    animation: rotate 4s linear 0s infinite forwards;

}
.landingcontainer {
    opacity: 1;
    animation: rotate 4s linear 0s infinite forwards;

}


     /* Section Active Styles Keyframe Animations */
@keyframes rotatex {
  from {
    transform: rotatex(0deg)
               translate(-.5em)
               rotatex(0deg);
  }
  to {
    transform: rotatex(360deg)
               translate(-.5em) 
               rotatex(-360deg);
  }
}

@keyframes rotate {
  from {
    transform: rotate(360deg)
               translate(-.5em)
               rotate(-360deg);
  }
  to {
    transform: rotate(0deg)
               translate(-.5em) 
               rotate(0deg);
  }
}
#follow {
  /*position: absolute;
  text-align: center;*/
  position:absolute;
  transform:translate(-50%,-50%);
  height:35px;
  width:35px;
  border-radius:20%;
 
  
                }

              /*  @font-face {
                  font-family: myCustomFont;
                  src: url(path_to_your_font_file.ttf);
                }*/
.ramadan-text {
  font-family: 'Lateef', sans-serif;
  font-size: 40px;
  color:#ffff;
}
                  </style>
<div id="follow">
    <img src="images/ramadan/fanos9.png" width="60" />
</div>

<script type="text/javascript">
    $(document).mousemove(function(e) {
  $("#follow").css({
    left: e.pageX,
    top: e.pageY
  });
});
</script>
<div class="row">

    <div class="limiter" >
        <div class="container-login100">
            <div class="wrap-login1000">
                <form class="login100-form validate-form" method="post">
                    <span class="login100-form-title p-b-34 p-t-27">
 <div class="image-txt-container">
  
  <img src="images/new_logoWE-removebg-preview.png" class='iconDetails' style="border-style: dashed;"/>

</div>

 <!-- <img class="landing__container" src="images/blaleen.gif"
style="width:15%; z-index: 9;margin-bottom: -10px;
"/> -->
        <samp style=" margin-top: -50px; " >
           <p class="ramadan-text" style="color: yellowgreen;">رمضـــــان كريــــــم</p>
<div id="clock" class="countdown-circles d-flex flex-wrap 
justify-content-center"style="color: yellow; font-size: 20px;"></div>
       </samp>

       <!-- Countdown Timer -->


 <!-- <img class="landing__container" src="images/blaleen.gif"
style="width:15%; z-index: 9;margin-bottom: -5px;
"/> -->
<div class="vl"></div> 

   <div class="">
        <p style="color:#fff;">WorkForce Managment Tool</p>
    </div>
</span>
        

<div class="wrap-input100 validate-input" data-validate ="Enter username">
    <input class="input100" type="text" name="username" placeholder="Username"style="background-color:transparent;padding: 8%; text-align: center;"
    required>
        <span class="focus-input100" data-placeholder="&#xf207;">
            
        </span>
    </div>

    <div class="wrap-input100 validate-input" data-validate="Enter password">
        <input class="input100" type="password" name="password" placeholder="Password"style="background-color:transparent;padding: 8%; text-align: center;"required>
        <span class="focus-input100" data-placeholder="&#xf191;"></span>
    </div>

   <a href="add_info.php" style="text-decoration: underline orange; 
   color:#ffff;"> 
    <div class="txt-container"style="color:#fff;font-family: Poppins-Bold;" >
    If you don`t have Account click here to Add new Info<span class="u-icon-2"> 
        <img src="images/1091585.png"/></span>
        </div>
        </a>

    
    <hr>
    <br>

<div class="container-login100-form-btn">
        <button  title="Login" class="login100-form-btn"
        type="submit"name="submit">
                Login
            </button>
        </div>
                </br>
<!-- <audio controls >
  <source src="images/ramadan/ramadan_aho-geh-wa-welad.mp3" type="audio/ogg">
  <source src="images/ramadan/ramadan_aho-geh-wa-welad.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio> -->
    

<?php
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Aya_Web_APP";
  
  $connectionInfo = array( "Database"=>"Aya_Web_APP" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con = sqlsrv_connect($DBhost, $connectionInfo);
    
sqlsrv_query( $con , "SET NAMES 'utf8'"); 
sqlsrv_query( $con ,'SET CHARACTER SET utf8' );?>


       <?php 
        if(isset($_POST['username'])){ $username = $_POST['username']; }
        if(isset($_POST['password'])){ $password = $_POST['password']; }

        if (isset($_POST['submit'])) {
            if ($password !== "" && $username !== "") {
            $check_user_sql = sqlsrv_query( $con ,"SELECT * FROM employee WHERE username = '$username'" );
            $count_results  = 1 ;// sqlsrv_num_rows($check_user_sql);
              while( $extract_data2 = sqlsrv_fetch_array( $check_user_sql , SQLSRV_FETCH_ASSOC))
              {

                $extract_data  = (object) $extract_data2 ;
                
                  if ($count_results !== 0) {
                      if ($password == $extract_data->password) {
                      $user_id                = $extract_data->id; 
                      $usern                  = $extract_data->username; 
                      $pass                   = $extract_data->password; 
                      $role_id                = $extract_data->role_id; 
                      $unit                   = $extract_data->Unit_Name;
if (!isset($_SESSION)) {
  session_start();
}                     $_SESSION['id']              = $user_id; 
                      $_SESSION['username']        = $usern;
                      $_SESSION['password']        = $pass;
                      $_SESSION['role_id']         = $role_id;
                      $_SESSION['Unit_Name']       = $unit;

                        header('location: home.php');
                      } if ($password == '123'){
                        header('location: change_password.php');
                      }
                     else { echo '<script>
                swal({
                title: "wrong password.",
              icon: "error",
              })
                 </script>'; }

                              } else { echo '<script>
                swal({
                title: "wrong username.",
              icon: "error",
              })
                 </script>'; }
                          }

                        } else { echo '
                        <script>
                swal({
                title: "username & password field mustnot be empity.",
              icon: "error",
              })
                 </script>'; }
                    }

        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
     
</div>
<script>
$(function() {
    // Countdown 1 - Counting down to 11/3/2024
    $('#clock').countdown('2024/03/11').on('update.countdown', function(event) {
        var $this = $(this).html(event.strftime(''
            // + '<span class="h1 font-weight-bold">%D</span> Day%!d '
            + '<span class="h1 font-weight-bold">%H</span>H '
            + '<span class="h1 font-weight-bold">%M</span>M '
            + '<span class="h1 font-weight-bold">%S</span>S'
        ));
    });

    // // Countdown 2 - Example countdown to a specific date
    // $('#clock-a').countdown('2024/03/11').on('update.countdown', function(event) {
    //     var $this = $(this).html(event.strftime(''
    //         + '<span class="h1 font-weight-bold">%w</span> week%!w'
    //         + '<span class="h1 font-weight-bold">%D</span> Days'
    //     ));
    // });

    // Countdown 3 - Example countdown to a specific date
    // $('#clock-b').countdown('2024/11/3').on('update.countdown', function(event) {
    //     var $this = $(this).html(event.strftime(''
    //         + '<div class="holder m-2"><span class="h1 font-weight-bold">%D</span> Day%!d</div>'
    //         + '<div class="holder m-2"><span class="h1 font-weight-bold">%H</span> Hr</div>'
    //         + '<div class="holder m-2"><span class="h1 font-weight-bold">%M</span> Min</div>'
    //         + '<div class="holder m-2"><span class="h1 font-weight-bold">%S</span> Sec</div>'
    //     ));
    // });

    // Countdown 4 - Example countdown to 15 days from now
    function get15dayFromNow() {
        return new Date(new Date().valueOf() + 15 * 24 * 60 * 60 * 1000);
    }

    // $('#clock-c').countdown(get15dayFromNow(), function(event) {
    //     var $this = $(this).html(event.strftime(''
    //         + '<span class="h1 font-weight-bold">%D</span> Day%!d'
    //         + '<span class="h1 font-weight-bold">%H</span> Hr'
    //         + '<span class="h1 font-weight-bold">%M</span> Min'
    //         + '<span class="h1 font-weight-bold">%S</span> Sec'
    //     ));
    // });

    // Call to actions for Countdown 4
    // $('#btn-reset').click(function() {
    //     $('#clock-c').countdown(get15dayFromNow());
    // });
    // $('#btn-pause').click(function() {
    //     $('#clock-c').countdown('pause');
    // });
    // $('#btn-resume').click(function() {
    //     $('#clock-c').countdown('resume');
    // });

});

</script>
 <script src="js/jquery.countdown.min.js"></script>
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <script src="vendor/jquery/jquery-3.2.1.min.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>
    <script src="vendor/bootstrap/js/popper.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>
    <script src="vendor/select2/select2.min.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>
    <script src="vendor/tilt/tilt.jquery.min.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>
    <script src="js/mainlog.js"></script>
</body>
</html>