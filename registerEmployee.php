<!DOCTYPE html> 
<html dir="rtl">
<head>
    <link rel="icon" href="imag/logo.jpg">
    <?php 
    //require_once("inc/config.inc");
        require_once("inc/config.inc");?>
        <title>WorkForce Team</title>
         <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
<?php
if($_SESSION['role_id'] == 1){
  echo '<link rel="stylesheet" type="text/css" href="css/loginCss.css">

<body class="register" style="background-image:  url(imag/wallpaper.jpg);" class="col-sm-6">
    <!--          background-image:   url(imag/wallpaper.jpg);    -->      
         <nav class="menu">
        <ul>
            <!--li><a href="employee.php">Employee</a></li!-->
            <li><a href="welcome.php">Back</a></li>
            <li><a href="employee.php">employee</a></li>
            <!--li><a href="Gochat.php">Chat</a></li>
            <li><a href="chating2.php">Chat</a></li-->
            <!--li><a href="chatbox/index.php">Contact Us</a></li!-->
            
            
         </ul>
             
             <form class="search-form">
             <input type="text" placeholder="search">
             <button>Search</button>
            
             </form>
        </nav>
           
        </nav>
           
       <div id="content" class="col-sm-6" ></div>
       <center>
          <div class id="banner" ; ></div>
            <h3 id="firstHeading" class="firstHeading";>
                Workforce"WE_TE data" <img src="imag/we3.png" alt="we3.png"></h3> </center>
                  
        <div class="box">
          
        <h2>Login</h2>
        
     
             <form method="post" action="" class="col-md-2">
             
                 <div class="inputBox" >
                 <input type="text" name="username" placeholder="Enter Username" >
                     <label for="username" >Username</label>
                 </div>
                 <br>

                 <!--<div class="inputBox">
                 <input type="text" name="email_address" placeholder="Enter email_address">
                     <label for="email_address">Emailaddress</label>
                 </div> -->
                 
                 <div class="inputBox" >
                 <input type="number"  name="role_id" value="0" placeholder="Enter 0">
                     <label for="role_id"></label>
                 </div>

                 <div class="inputBox" >
                 <input type="number" style="display: none;"  name="manager_id" value="0" placeholder="Enter manager_id">
                     <label for="manager_id"></label>
                 </div>

                 <br>

                 <div class="inputBox" >
                 <input type="password" name="password" placeholder="Enter Password">
                     <label for="password">Password</label>
                 </div>
                 <br>

                 <div class="inputBox" >
                 <input type="password" name="repassword" placeholder="renter Password">
                     <label for="repassword" >Retype password</label>
                 </div>
   
             <input type="submit" name="signup" value="SignUP" class="btn-login">
                 <input type="reset" value="reset">

            <a class="btn-back" href="edit_password.php">Chane Password</a>
             
             </form>
        

        </div>';}

        ?>
         <?php 
 
        if(isset($_POST['username'])){ $username = $_POST['username']; }
       // if(isset($_POST['email_address'])){ $email_address = $_POST['email_address']; }
        if(isset($_POST['password'])){ $password = $_POST['password']; }
        if(isset($_POST['repassword'])){ $repassword = $_POST['repassword']; }
        if(isset($_POST['role_id'])){$role_id = $_POST['role_id'];}
        if(isset($_POST['manager_id'])){$manager_id = $_POST['manager_id'];}

        if (isset($_POST['signup'])) {
            if ($password !== "" && $username !== "" && $role_id !== "" && $manager_id !== "" && $repassword !== "") {
                if ($password == $repassword)
{sqlsrv_query( $con ,"INSERT INTO employee ([username], [password], [role_id], [manager_id]) VALUES ('$username', '$password', '$role_id', '$manager_id')");

    echo "<h3 style='background-color:white; color:black; text-align: center ; border-radius: 0px 20px 0px 20px;
  border: 5px solid ; margin: 0px auto;
  width: 10%; padding:30px;'> Done...</h3>";}
                } else { echo 'password input fields donot match.'; }
            } else { echo 'required field mustnot be empty.'; }
        
//$con->query("INSERT INTO employee (username, passwor) VALUES ('$username', '$password')");

        ?>     
    </body>
    
</html>







