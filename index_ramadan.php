<!DOCTYPE html>
<?php
     ob_start();
 ?>
 <?php require_once("inc/config.inc");
//ini_set('session.gc_maxlifetime', 315360000);    //# 3 hours
       ?>
<html>
<head>
    <title>Workforce Login</title>
       <link rel="icon" href="imag/logo.jpg">

<meta charset="UTF-8">
  <script src="js/jquery-3.3.1.slim.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/snowflakes.js"></script>

<meta name="viewport" content="width=device-width, initial-scale=1">
 <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Yellowtail" />
<link rel="stylesheet" href="css/bootstrap.min.css">

<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/loginphp.css">
<link rel="stylesheet" type="text/css" href="css/main2.css">
 <link rel="stylesheet" type="text/css" href="assetss/css/slicknav.css">
<link rel="stylesheet" type="text/css" href="assetss/css/vegas.min.css">
    <link rel="stylesheet" type="text/css" href="assetss/css/animate.css">
<link rel="stylesheet" type="text/css" href="assetss/css/responsive.css"> 
   <link rel="stylesheet" type="text/css" href="assetss/css/menu_sideslide.css">
    <!-- background: linear-gradient(to right, #7f7fd5, #86a8e7, #91eae4); -->
<style>
    .countdown {
    text-transform: uppercase;
    font-weight: bold;
}

.countdown span {
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    font-size: 3rem;
    margin-left: 0.8rem;
}

.countdown span:first-of-type {
    margin-left: 0;
}

.countdown-circles {
    text-transform: uppercase;
    font-weight: bold;
}

.countdown-circles span {
    width: 100px;
    height: 100px;
    border-radius: 30px 30px 30px 30px;
    background: rgba(255, 255, 255, 0.20);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.9);
}

.countdown-circles span:first-of-type {
    margin-left: 0;
}

body{
   /* background-image: url("images/ramadan/tri---ramadangidribbble.gif");
    background-repeat: no-repeat;
    background-size: cover;*/
  /*
  height: 100%;
  font-family: 'Quicksand', sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;*/
}

.bg-gradient-1 {
    background: #7f7fd5;
    background: -webkit-linear-gradient(to right, #7f7fd5, #86a8e7, #91eae4);
    background: linear-gradient(to right, #7f7fd5, #86a8e7, #91eae4);
}

.bg-gradient-2 {
    background: #654ea3;
    background: -webkit-linear-gradient(to right, #654ea3, #eaafc8);
    background: linear-gradient(to right, #654ea3, #eaafc8);
}

.bg-gradient-3 {
    background: #ff416c;
    background: -webkit-linear-gradient(to right, #ff416c, #ff4b2b);
    background: linear-gradient(to right, #ff416c, #ff4b2b);
}

.bg-gradient-4 {
    background: #007991;
    background: -webkit-linear-gradient(to right, #007991, #78ffd6);
    background: linear-gradient(to right, #007991, #78ffd6);
}

.rounded {
    border-radius: 1rem !important;
}

.btn-demo {
    padding: 0.5rem 2rem !important;
    border-radius: 30rem !important;
    background: rgba(255, 255, 255, 0.3);
    color: #fff;
    text-transform: uppercase;
    font-weight: bold !important;
}

.btn-demo:hover, .btn-demo:focus {
    color: #fff;
    background: rgba(255, 255, 255, 0.5);
}
samp{
  font-size: 35px;
}

#follow {
  /*position: absolute;
  text-align: center;*/
  position:absolute;
  transform:translate(-50%,-50%);
  height:35px;
  width:35px;
  border-radius:50%;
 
  
                }
</style>
</head>

            <style type="text/css">
            .iconDetails {
                /*margin:0 2%;*/
                /*float:left;*/
                width:45%;
                background-color: white;
                border-radius: 50%;
                display: block;
                margin-left: auto;
                margin-right: auto;
                margin-top: -30px;
            }
            .wrap-login1000 {
    width: 500px;
    border-radius: 10px;
    overflow: hidden;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 35px 35px 35px 35px;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    box-shadow: 5px 5px 20px 0 rgba(0,0,0,0.7);
    opacity: 5.1;
    background-color: rgba(0,0,0,0.5);
  
    background-size: 100%;
    background-repeat: no-repeat;
    align-items: center;

}
/*
    .login,
.image {
  min-height: 100vh;
}

.bg-image {
    background-image:  url(imag/Pipeline.jpg);
  background-size: cover;
  background-position: center center;

  background: linear-gradient(to right, #7f7fd5, #86a8e7, #91eae4)
}*/

 /* #snowflakeContainer {
    position: absolute;
    left: 0px;
    top: 0px;
    display: none;
  }

  .snowflake {
    position: fixed;
     #ccc 
    background-color: #ccc;
    user-select: none;
    z-index: 1000;
    pointer-events: none;
    border-radius: 50%;
    width: 10px;
    height: 10px;
  }

 p { font-family: Rochester; font-size: 24px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 26.4px; } h3 { font-family: Rochester; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 700; line-height: 15.4px; } p { font-family: Rochester; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 20px; } blockquote { font-family: Rochester; font-size: 21px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 30px; } pre { font-family: Rochester; font-size: 13px; font-style: normal; font-variant: normal; font-weight: 400; line-height: 18.5714px; }
.message {
    position: absolute;
    left: 50%;
    top: 50%;
    margin-top: 80px;
    -webkit-transform: translateX(-50%);
    -moz-transform: translateX(-50%);
    -ms-transform: translateX(-50%);
    -o-transform: translateX(-50%);
    transform: translateX(-50%);
    color: #f8e7dc;
    font-family: 'Mountains of Christmas';
}
.message p {
    font-style: normal;
    font-size: 75px;
    margin-bottom: 0;
    white-space: nowrap;
}*/
</style>

<!--div id="snowflakeContainer">
  <span class="snowflake"></span>
</div-->

<!--div class="message">
<h1></h1>
<h2 class="copyright">  <a href="https://twitter.com/alireza29675" target="_blank"></a></h2>
</div-->
<body id="example" class="slider opacity-50 vegas-container"
 style="background-image:  url('images/ramadan/image_processing202.gif');
 background-size: cover; background-repeat: no-repeat;" >
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<div id="follow"><img src="images/ramadan/lamp20.gif" width="60" />
</div>

<script type="text/javascript">
    $(document).mousemove(function(e) {
  $("#follow").css({
    left: e.pageX,
    top: e.pageY
  });
});
</script>
<!-- <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Dropdown button
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <input type="checkbox" class="dropdown-item" name="">Action
    <input type="checkbox" class="dropdown-item" name="">Something
    <input type="checkbox" class="dropdown-item" name="">aya
  </div>
</div>

<script>
$(document).ready(function(){
  $(".dropdown-toggle").dropdown();
});
</script> -->


    <div class="container py-15.5">
    <div class="py-5" >
        <div class="row"  >
            <div class="col-lg-8 mx-auto"style="transform: translate(-25%,10%);">

                <!-- Countdown    
 style="transform: translate(48px,100px);"
#FC6F03
f6c700
background-color: #b3e6ff;
background-color: #cce6ff;
                 1-->
    <div class="rounded bg-gradient-1 text-white shadow p-5 text-center mb-5" style="background : rgba(0,0,0,.7);border-radius: 50px 50px 50px 50px; ">
        <p class="mb-4 font-weight-bold" style="color: white;font-weight: bold;font-size:25px;">
         <img src="images/ramadan/ramadan-kareem.png"style="width:20%;"> Counting 
         <!--img src="New_year/christmas-tree.png"style="width:6%;"-->
  Down To <samp style="color:#c55a83;">R</samp><samp style="color:#f6aa51;">A</samp><samp style="color:#45a56a; ">M</samp><samp style="color:#3871ac; ">A</samp><samp style="color:#795f91; ">D</samp><samp style="color:#358792; ">A</samp>
  <samp style="color:#fcc51a;">N</samp><img src="images/ramadan/fanoos202.png"style="width:15%;">  
        <!--2<img src="New_year/snow.png"style="width:6%;">2<img src="New_year/snow.png"style="width:6%;"--></p>

                    <div id="clock-b" class="countdown-circles d-flex flex-wrap justify-content-center pt-4" 
                    style="color: #00b359;"></div>

                    <?php include('ramadan_2021.php');
                    ?>
                </div>
            </div>
    <div class="no-gutter">
        <!-- The image half -->
        <!-- <div class="col-md-6 d-none d-md-flex bg-image"></div> -->


        <!-- The content half -->
            <div class="login d-flex align-items-center">

                <!-- Demo content-->
                <div class="container" >
                    <!-- <div class="row"> -->
                        <div class="col-lg-2">

  <form class="login100-form validate-form text-center mb-5" method="post" style="
  box-shadow: 5px 5px 20px 0 rgba(0,0,0,0.7);opacity: 5.1; width: 350px;
    background-color: rgba(0,0,0,0.5);padding: 5px 35px 55px 35px;" >
<span class="login100-form-title">
    <div class="img-circle"style="margin-top: -5%;" >
     <!--  <img src="images/new_logoWE-removebg-preview.png"class="img-circle" style=" margin-left:-7.5%; "> -->
      <img src="images/new_logoWE-removebg-preview.png" class='iconDetails' style="border-style: dashed;" />
 </div>
<h4 class="text-center" 
style="font-weight: bold;width: 94%;margin-left:3%;color: white;font-size: 20px;">WorkForce Managment Tool</h4>   

    <h2 class="text-center" style="font-weight: bold;color: white;font-size: 20px;color:#fcc51a;
           font-family: 'Noto Sans Kufi Arabic';"> رمضان كريم ♥</h2></span>

<div class="wrap-input100 validate-input" >
<input  class="input100" type="text" name="username" placeholder="Username" required="required" title='Username'
style="background-color: lightgray;margin-top: -8%;padding: 8%; text-align: center;"/>
<span class="focus-input100"></span>
<span class="symbol-input100">
    <i class="fas fa-user"style="margin-left:-8%;" ></i>
</span>
</div>
<br>
<br>
<br>
<div class="wrap-input100 validate-input" >
<input class="input100" type="password" name="password"title='Password' placeholder="Password" required="required"
style="background-color: lightgray;margin-top: -8%;padding: 8%; text-align: center;">
<span class="focus-input100"></span>
<span class="symbol-input100">
<i class="fa fa-lock" style="margin-left:-8%;"></i>
</span>
</div>
<div class="container-login100-form-btn">
<input type="submit"  
    name="submit" value="Login"class="login100-form-btn"/>
    <br>
</div>
    <div class="container-login100-form-btn">

<input type="reset" style="background-color:  #ed7f15;font-family: 'Quicksand', sans-serif;font-weight: 700;
    font-size: 18px;
    color: #fff;" 
 value="Reset" class="login100-form-btn"/>
        </div>
    </div>
  </div>
  
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
                      $user_id                     = $extract_data->id; 
                      $usern                       = $extract_data->username; 
                      $pass                        = $extract_data->password; 
                      $role_id                   = $extract_data->role_id; 
if (!isset($_SESSION)) {
  session_start();
}                      $_SESSION['id']              = $user_id; 
                      $_SESSION['username']        = $usern;
                      $_SESSION['password']        = $pass;
                      $_SESSION['role_id']       = $role_id;

                      header('location: senior_home.php');
                      } else { echo '<h2 style="font-size:16px;color:red;">wrong password.</h2>'; }

                  } else { echo '<h2 style="font-size:16px;color:red;">wrong username.</h2>'; }
              }

            } else { echo '<h2 style="font-size:16px;color:red;">username & password field mustnot be empity.</h2>'; }
        }

        ?>
                                       </form>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>



<script src="vendor/jquery/jquery-3.2.1.min.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>

<script src="vendor/bootstrap/js/popper.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>

<script src="vendor/select2/select2.min.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>

<script src="vendor/tilt/tilt.jquery.min.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>
<script type="20f1e2767bf4d7db5bfe8337-text/javascript">
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>
<script type="20f1e2767bf4d7db5bfe8337-text/javascript">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

<script src="js/main.js" type="20f1e2767bf4d7db5bfe8337-text/javascript"></script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/95c75768/cloudflare-static/rocket-loader.min.js" data-cf-settings="20f1e2767bf4d7db5bfe8337-|49" defer=""></script>

    <!-- Header Area wrapper End -->

    <!-- Count Bar Start -->
  <!--   <section id="count">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-10">
            <div class="count-wrapper text-center">
              <div class="time-countdown wow fadeInUp" data-wow-delay="0.2s">
                <div id="clock" class="time-count"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <!-- Count Bar End -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 <script src="assetss/js/jquery-min.js"></script>
    <script src="assetss/js/popper.min.js"></script>
    <script src="assetss/js/bootstrap.min.js"></script>
    <script src="assetss/js/jquery.countdown.min.js"></script>
    <script src="assetss/js/waypoints.min.js"></script>
    <script src="assetss/js/jquery.counterup.min.js"></script>
    <script src="assetss/js/jquery.nav.js"></script>
    <script src="assetss/js/jquery.easing.min.js"></script>
    <script src="assetss/js/vegas.min.js"></script>
    <script src="assetss/js/classie.js"></script>
 <!--    script src="assetss/js/wow.js"></script>
    <script src="assetss/js/nivo-lightbox.js"></script>
    <script src="assetss/js/video.js"></script>
    <script src="assetss/js/main.js"></script   -->

    <!-- <script type="text/javascript">
      $("#example").vegas({
          timer: false,
          delay: 6000,
          transitionDuration: 2100,
          transition: "blur",
          slides: [
            
            { src: "images/ramadan/tri---ramadangidribbble.gif" },
            { src: "images/ramadan/ramadan2023.jpeg" },
            { src: "images/ramadan/رمضان_كريم2.jpg" },
            { src: "images/ramadan/image_processing202.gif" }
          ]
      });
    </script>  -->
<script type="text/javascript">
    $(function () {


    /* =========================================
        COUNTDOWN 1
     ========================================= */
    $('#clock').countdown('2023/3/23').on('update.countdown', function(event) {
      var $this = $(this).html(event.strftime(''
        + '<span class="h1 font-weight-bold">%D</span> Day%!d'
        + '<span class="h1 font-weight-bold">%H</span> Hr'
        + '<span class="h1 font-weight-bold">%M</span> Min'
        + '<span class="h1 font-weight-bold">%S</span> Sec'));
    });

    /* =========================================
        COUNTDOWN 2
     ========================================= */
    $('#clock-a').countdown('2023/3/23').on('update.countdown', function(event) {
      var $this = $(this).html(event.strftime(''
        + '<span class="h1 font-weight-bold">%w</span> week%!w'
        + '<span class="h1 font-weight-bold">%D</span> Days'));
    });

    /* =========================================
        COUNTDOWN 3
     ========================================= */
    $('#clock-b').countdown('2023/3/23').on('update.countdown', function(event) {
      var $this = $(this).html(event.strftime(''
        + '<div class="holder m-2"><span class="h1 font-weight-bold">%D</span> Day%!d</div>'
        + '<div class="holder m-2"><span class="h1 font-weight-bold">%H</span> Hr</div>'
        + '<div class="holder m-2"><span class="h1 font-weight-bold">%M</span> Min</div>'
        + '<div class="holder m-2"><span class="h1 font-weight-bold">%S</span> Sec</div>'));
    });


    /* =========================================
        COUNTDOWN 4
     ========================================= */
    function get15dayFromNow() {
        return new Date(new Date().valueOf() + 15 * 24 * 60 * 60 * 1000);
    }

    $('#clock-c').countdown(get15dayFromNow(), function(event) {
      var $this = $(this).html(event.strftime(''
        + '<span class="h1 font-weight-bold">%D</span> Day%!d'
        + '<span class="h1 font-weight-bold">%H</span> Hr'
        + '<span class="h1 font-weight-bold">%M</span> Min'
        + '<span class="h1 font-weight-bold">%S</span> Sec'));
    });

    /* =========================================
        CALL TO ACTIONS FOR COUNTDOWN 4
     ========================================= */
    $('#btn-reset').click(function() {
        $('#clock-c').countdown(get15dayFromNow());
    });
    $('#btn-pause').click(function() {
        $('#clock-c').countdown('pause');
    });
    $('#btn-resume').click(function() {
        $('#clock-c').countdown('resume');
    });

});
</script>

         
s
</body>
</html>
