
   <?php 
  //include ("pages.php");



session_start();
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Aya_Web_APP";
  $CharacterSet = "UTF-8";

  
  $connectionInfo = array( "Database"=>"Aya_Web_APP" , "UID"=>"Seniors" ,"CharacterSet" => "UTF-8", "PWD"=>"123456789");
  $con = sqlsrv_connect($DBhost, $connectionInfo);
    

sqlsrv_query( $con , "SET NAMES 'utf8'"); 
sqlsrv_query( $con ,'SET CHARACTER SET utf8' );
   // $self = $_SESSION['id'];
   // $role_id = $_SESSION['role_id'];
   // $s_username = $_SESSION['username'];
   // $unit = $_SESSION['Unit_Name'];
    ?>
    <!DOCTYPE html>
<html lang="en">
  <title>Survey Page</title>
<head>
  <link rel="icon" href="images/logo_we.jpg">
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap2.min.js"></script> -->
  <script src="jquery/sweetalert.min.js"></script>
  <link href="css/google_css.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
  <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets2/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets2/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets2/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets2/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets2/css/style.css" rel="stylesheet">
  
<!-- <link href="/TEDataResources/images/te.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="css/font-awesome.css">
<link rel="stylesheet" href="css/bootstrap2.min.css"> 
<meta http-equiv="x-ua-compatible" content="IE=edge"/>
<meta property="og:image" content="http://te.eg/images/TE-Logo.jpg" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap2.min.js"></script> -->
  </head>
<style>


  section {
  padding: 100px 0 0 0;
  display: block;
  overflow: hidden;
}
body{
  background-image: url('images/professional-images-for-websit.jpg');
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  height: auto;
 }
     .home {
    width: 100%;
    height: 60vh;
    background-image: url('images/Pipeline.jpg');
    background-position: center top;
  background-size:cover;
}

.texter{
  width: 100%;
    padding: 10px/*up*/ 0/*right*/ 10px 0/*left*/;
    font-size: 15px;
    font-weight: 490;
    line-height: 1.0;
    color: #212529;
    text-align: center;
    white-space: nowrap;
    background-color: #e9ecef;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
  }
textarea {
  width: 100%;
  min-height: 100px;
  background: url(http://i.imgur.com/2cOaJ.png) top -12px left / auto no-repeat, 
              linear-gradient(#F1F1F1 50%, #F9F9F9 50%) top left / 100% 32px;
  border: 1px solid #CCC;
  box-sizing: border-box;
  padding: 0 0 0 30px;
  resize: vertical;
  line-height: 16px;
  font-size: 13px;
}

  </style>
<body>

  <div class="se-pre-con"></div>
<div>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
<img src="images/Untitled3-removebg-preview.png" 
style="margin-left: -45%;">
      </a>

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto" 
          style="font-size: 18px;margin-left: -10px;padding-right:30px;"
           href="home.php"><i class="fa fa-home"></i> Home</a>
        </li>
      </ul> 
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
</div>

  
 <section >
       <!--div class="home" style="width: 100%;
    height:60vh;
    background-position: center top;
  background-size:cover;">
    </div-->
    </section>
  <br>
  
  <div style="padding: 20px;">
   <center> <h1 class="alert alert-warning alert-dismissiblefade show" style="font-size: 30px;color: ;text-align: center;border-radius: 20px 20px 20px 20px;
 border:1px solid gray;width: 20%;"> Survey</h1></center>
  <div class="bs-example"> 
    <div class="alert alert-warning alert-dismissible fade show">
        <h4 class="alert-heading"><span class="warn warning">&#9888;</span> Note!</h4>
        <p>Please Answer  the below questions Please Confirm that Message [Done] Appeared to Confirming saving your Survey.</p>
        <hr>
        <p class="mb-0">Once you have filled all the details, click on the 'Save' button to send data.</p>
    </div>
</div>
<!-- </div>

<div style="padding: 20px;" id="page"> -->

<center>
<form  method="post" class="container" >
       <div class="col-lg-7 floats">
            <div class="card">

  <div class="card-header">
    <img src="images/survey-icon-12.png"width="50" height="50" style="float: left;
    vertical-align: sub; bottom: 0; top: 0;"/>
    <h5 style="float: left;font-size:20px;color:white;padding:15.9px;text-align: left;
    height: 40%;width: 40%;"></h5>
  </div>

      <div class="card-body card-block">

 <div class="form-group">
    <div class="input-group">
        <div class="input-group-addon" style="text-align: justify;">1. On a scale of 1 to 10, how much fun do you get in your work environment? And what activities do you have fun doing?</div>
    <textarea rows="3" cols="30" class="Q1"id="Q1_What_was_done_well" 
    name="q1"></textarea>
            </div>
        </div>
        <br>

  <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon" style="text-align: justify;">2. What motivates you to go above and beyond at work? Please name three motivation triggers that work for you.</div>
             <textarea rows="3"cols="30"class="Q2"name="q2"></textarea>
        </div>
    </div>

        <br>

      <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon" style="text-align: justify;">3. Do you feel like you're progressing professionally at this organization? (Yes/No) Please address three aspects that are moving you forward or holding you back.</div>
 <textarea rows="3" cols="30"class="Q3" name="q3"></textarea>
 
            </div>
        </div>

            <br>

<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon" style="float:left;">4. What else could be improved?</div>
     
        <textarea rows="5" cols="40"  name="q4" class="Q4"></textarea>
    </div>
</div>  
      <br>   
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon" style="text-align: justify;">5. Name three things you don’t like about your work environment (feel free to add more).</div>
     
        <textarea rows="3" cols="30" name="q5" ></textarea>
    </div>
</div> 
 <br> 
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon" style="float:left;">6. Do you have the resources you need to be successful?</div>
    <!--  Do you have access to non material resources you need to do your work properly (information, training, support, data, knowledge, etc) -->
        <textarea rows="3" cols="30" name="q6" class="Q6"></textarea>
    </div>
</div>  
 <br>
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon" style=" text-align: justify;">7. Do you have access to non material resources you need to do your work properly (information, training, support, data, knowledge, etc)? </div>
     
        <textarea rows="3" cols="30" name="q7" class="Q7"></textarea>
    </div>
</div>  
<br> 
<div class="form-group">
    <div class="input-group">
        <div class="input-group-addon" style="text-align: justify;">8. Name three processes that we can improve here and explain how (feel free to add more).</div>
     
        <textarea rows="3" cols="30" name="q8"class="Q4"></textarea>
    </div>
</div> 
<br>  
<div class="form-group">
    <div class="input-group">
       <div class="input-group-addon" style="text-align: justify;">9. On a scale of 1 to 10, how transparent is the management team?
       </div>
     
        <textarea rows="3" cols="30" name="q9"class="Q9"></textarea>
    </div>
</div> 
<br> 
<div class="form-group">
    <div class="input-group">
      <div class="input-group-addon" style="text-align: justify;">
      10. Are there any questions you would like to be addressed by the speaker at this event?</div>
     
        <textarea rows="3" cols="30" name="q10"class="Q10"></textarea>
    </div>
</div>  

<br>

 <div class="form-outline">
  <label class="input-group-text" for="textAreaExample" style="background-color: lightblue;">Notes..</label>
          <textarea rows="3" cols="10" name="notes"></textarea>
</div>

<br>
<div style="clear: both;">
      <button type="submit" class="btn btn-warning submit"  name="save" id="submitID" 
      onclick="myFunction()"
      style="width: 30%;padding: 10px;color: #fff;font-size: 15px; border-radius: 20px 20px 20px 20px;" title="Add New Order">Add</button>
</div>

<br>
                        </div>
                    </div>
                </div>
</form>
</center>
</div>
<?php
if(isset($_POST['save'])){

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
  echo$ip = 'User Real IP - '.getUserIpAddr();
//echo $ip;


$sqltime = date ("Y-m-d H:i:s");


    //$interval = $_SESSION['number'];
  if(isset($_POST['q1'])){$q1 = $_POST['q1'];}
  if(isset($_POST['q2'])){$q2 = $_POST['q2'];}
  if(isset($_POST['q3'])){$q3 = $_POST['q3'];}
  if(isset($_POST['q4'])){$q4 = $_POST['q4'];}
  if(isset($_POST['q5'])){$q5 = $_POST['q5'];}
  if(isset($_POST['q6'])){$q6 = $_POST['q6'];}
  if(isset($_POST['q7'])){$q7 = $_POST['q7'];}
  if(isset($_POST['q8'])){$q8 = $_POST['q8'];}
  if(isset($_POST['q9'])){$q9 = $_POST['q9'];}
  if(isset($_POST['q10'])){$q10 = $_POST['q10'];}
  if(isset($_POST['q11'])){$q11 = $_POST['q11'];}

 // $escaped_Su2 = $_POST['Q2_What_wasnt_done_well'];
 //  $Q22 = str_replace("'", "`", $escaped_Su2);

  if(isset($_POST['notes'])){$notes = $_POST['notes'];}

  if(isset($_POST['user_ip'])){$user_ip = $_POST['user_ip'];}
  //if(isset($_POST[''])){$ = $_POST[''];}

$ip = getUserIpAddr();
 $error_query = sqlsrv_query( $con ,"SELECT ISNULL((SELECT user_ip
  
  FROM [Aya_Web_APP].[dbo].[survey_project2]
  where user_ip='$ip'),'nothing') resultt");
      $error=sqlsrv_fetch_array($error_query);
      $results= $error['resultt'];
     
  if($results !='nothing'){
echo '<script>
    swal({
    title: "Data already exists",
  icon: "error",
  })
     </script>';

  }if($results == 'nothing'){



$result = sqlsrv_query( $con ,"INSERT INTO survey_project2 
  ([user_ip],[q1],[q2],[q3],[q4],[q5],[q6],[q7],[q8],[q9],[q10],[notes],[creation_time])  
  VALUES 
  ('$ip',N'$q1',N'$q2',N'$q3',N'$q4',N'$q5',N'$q6',N'$q7',N'$q8',N'$q9',N'$q10',
    N'$notes','$sqltime') ");
if($result){
  echo '<script>
    swal({
    title: "Done",
  icon: "success",
  })
     </script>';}
   }
 }
if(isset($_POST['save'])){
  echo '<meta http-equiv="refresh" content="4">';}

  ?>

</div>


<script type="text/javascript"  src="jQuery/jquery-3.6.0.js"></script>
<script type="text/javascript" src="jQuery/jquery-2.2.4.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!--script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script!-->
<script type="text/javascript">
//paste this code under the head tag or in a separate js file.
    // Wait for window load
    $(window).load(function() {
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");;
    });
</script>
</body>
</html>

<?php 
include ("footer.html");

?>