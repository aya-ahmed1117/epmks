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
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <?php
  ob_start();
  ?>
  <?php
  $remote_user = $_SERVER['REMOTE_USER'] ?? '';

echo $_SERVER['REMOTE_USER'];


echo '<pre>';
print_r($_SERVER);
echo '</pre>';

$user = isset($_SERVER['REMOTE_USER']) ? $_SERVER['REMOTE_USER'] : 'غير معروف';
echo "المستخدم: $user";

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
</head>
<body>
  <style type="text/css">
    * {
      padding:0;
      margin:0;

    }
    body {
      background-image: url("images/tecnologe.jpg");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center center;
      height: 100%;

      /* Set a specific height */
      /*min-height: 800px;*/

      /* Create the parallax scrolling effect */
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;

      -webkit-backdrop-filter: blur(5px);
      backdrop-filter: blur(5px);
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
  }

  .vl {
   border-bottom: 5px solid #fff;
   margin: 5px;
   /*width: 55px;*/
   text-align: center;
   /*height: 100px;*/
   /*margin-left: 15px;*/
 }
 /*******/
 .wrap-login1000 {
  width: 400px;
  border-radius: 10px;
  overflow: hidden;
  /*flex-wrap: wrap;*/
  justify-content: space-between;
  padding: 35px 35px 35px 35px;
     /* display: -webkit-box;
      display: -webkit-flex;
      display: -moz-box;
      display: -ms-flexbox;
      display: flex;*/
      box-shadow: 5px 5px 20px 0 rgba(0,0,0,0.9);
      opacity: 5.1;
      background-color: rgba(20,0,70,0.7);

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
     }*/
   </style>

   <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login1000">
        <form class="login100-form validate-form" method="post">
          <span class="login100-form-title p-b-34 p-t-27">
      <!--background-image: url('images/Adosize_restricted.gif');
      div class="img-circle" >
        <img src="images/logo.jpg"style="width:15%;font-size:9px;">WorkForce Managment Tool
   </div>
      
 </span-->
 <div class="image-txt-container">
  <img src="images/new_logoWE-removebg-preview.png" class='iconDetails'/>
</div>
<div class="vl"></div> 
<div class="">
  <p style="color:#fff;">WorkForce Managment Tool</p>

</div>

<!-- <div class="vl"></div> -->
      <!--div class='container2'>
      <img src="images/logo.jpg"  class='iconDetails' />

      <div class="text">
          <h4>WorkForce Managment Tool</h4>
      
      </div>
    </div-->
  </span>
  <br/>       


  <div class="wrap-input100 validate-input" data-validate ="Enter username">
    <input class="input100" type="text" name="username" placeholder="Username"style="background-color:transparent;padding: 8%; text-align: center; " autofocus="true" required>
    <span class="focus-input100" data-placeholder="&#xf207;"></span>
  </div>

  <div class="wrap-input100 validate-input" data-validate="Enter password">
    <input class="input100" type="password" name="password" placeholder="Password"style="background-color:transparent;padding: 8%; text-align: center;"required>
    <span class="focus-input100" data-placeholder="&#xf191;"></span>
  </div>

  <a href="add_info.php" style="text-decoration: underline orange; color:#ffff;"> <div class="txt-container"style="color:#fff;font-family: Poppins-Bold;" >If you don`t have Account click here to Add new Info<span class="u-icon-2"> <img src="images/1091585.png"></span></a>

  </div>
  <hr>
  <br>

  <div class="container-login100-form-btn">
    <button  title="Login" class="login100-form-btn"type="submit"name="submit">
      Login
    </button>
  </div>
</br>
             <?php
if (isset($_POST['username'])) {
    $username = trim($_POST['username']);
}
if (isset($_POST['password'])) {
    $password = trim($_POST['password']);
}

if (isset($_POST['submit'])) {
    if ($username !== "" && $password !== "") {
        $check_user_sql = sqlsrv_query($con, "SELECT * FROM employee WHERE username = ?", [$username]);

        if ($check_user_sql && $user_data = sqlsrv_fetch_array($check_user_sql, SQLSRV_FETCH_ASSOC)) {
            $user = (object) $user_data;

            if (password_verify($password, $user->password)) {
                if (!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION['id']         = $user->id;
                $_SESSION['username']   = $user->username;
                $_SESSION['password']   = $user->password;
                $_SESSION['role_id']    = $user->role_id;
                $_SESSION['Unit_Name']  = $user->Unit_Name;

                // 👉 Redirect to change password if user logged in using default password
                if ($password === '123') {
                    header('Location: change_password.php');
                    exit;
                }

                // Else go to home
                header('Location: home.php');
                exit;

            } else {
                echo '<script>
                    swal({
                        title: "Wrong password.",
                        icon: "error"
                    });
                </script>';
            }
        } else {
            echo '<script>
                swal({
                    title: "Username not found.",
                    icon: "error"
                });
            </script>';
        }
    } else {
        echo '<script>
            swal({
                title: "Username and password must not be empty.",
                icon: "error"
            });
        </script>';
    }
}
?>


<!-- 
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

                    ?> -->
                  </form>
                </div>
              </div>
            </div>

            <!--div id="dropDownSelect1"></div-->
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