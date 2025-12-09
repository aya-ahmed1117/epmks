<!DOCTYPE html>
<html lang="en">
<head>
	<title>Loading Data</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
 <link href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css" rel="stylesheet">
 <!--link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/body2021.css"->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css"-->
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/font-awesome22.min.css">

<?php 
require_once("inc/config.inc");

	 if($_SESSION['username'] == ''){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }
     $self = $_SESSION['id'];
$role_id = $_SESSION['role_id'];
$s_username = $_SESSION['username'];
/*
     if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 2800)) {
// last request was more than 30 minutes ago
session_unset();     // unset $_SESSION variable for the run-time 
session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time();
       */             

if (isset($_SESSION['id'])) { $aya = $_SESSION['id']; }
$checkme = sqlsrv_query( $con ,"SELECT * FROM [employee] WHERE [id] = '$aya'");
$output = sqlsrv_fetch_array($checkme );
$Unit_Name = $output['Unit_Name'];
$username_id = $output['username_id'];
      ?>


</head>
<body>
<style type="text/css">
@import url('images/Pipeline.jpg');
html,
body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Quicksand", sans-serif;
    /*font-size: 62.5%;*/
    font-size: 10px;
}
.nav {
  margin: 0;
    padding: 0;
    width: 100%;
    height: 65px;
    position: fixed;
    line-height: 65px;
    text-align: center;
}

.nav div.logo {
  margin: 0;
    padding: 0;
    float: left;
    width: auto;
    height: auto;
    /*padding-left: 3rem;*/
}


.nav div.logo a {
    text-decoration: none;
    color: #fff;
   
    padding: 0;
    float: left;
    margin: auto;
    font-size: 15px;
}

.nav div.logo a:hover {
    color: tomato;
    float: left;
}

.nav div.main_list {
    height: 65px;
    float: right;
}

.nav div.main_list ul {
    width: 100%;
    height: 65px;
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav div.main_list ul li {
    width: auto;
    height: 5px;
    padding: 0;
    
}

.nav div.main_list ul li a {
    text-decoration: none;
    color: #fff;
    line-height: 65px;
    font-size: 15px;
}


.nav div.main_list ul li a:hover {
    color: #00E676;
}


.navTrigger {
    display: none;
}

.nav {
    padding-top: auto;
    padding-bottom: 20px;
    -webkit-transition: all 0.4s ease;
    transition: all 0.3s ease;
    background-color:rgb(0, 0,0,0.5);
}

 .nav div.main_list {
    height: 65px;
    float: right;
}

.nav div.main_list ul {
    width: 100%;
    height: 65px;
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav div.main_list ul li {
    width: auto;
    height: 65px;
    padding: 0;
    padding-right: 13px;
}

.nav div.main_list ul li a {
    text-decoration: none;
    color: #fff;
    line-height: 65px;
    font-size: 18px;
}

.nav div.main_list ul li a:hover {
    color: #00E676;
}

/* Media qurey section */

@media screen and (min-width: 768px) and (max-width: 1024px) {
    .container {
        margin: 0;
    }
}

@media screen and (max-width:768px) {

.nav div.logo ul {
    text-decoration: none;
    color: #fff;
    width: auto;
    height: auto;
    padding: 0;
    float: left;
    margin: auto;
    font-size: 15px;
}

.navTrigger {
    cursor: pointer;
    width: 30px;
    height: 25px;
    margin: auto;
    position: absolute;
    right: 30px;
    top: 0;
    bottom: 0;
}

.navTrigger i {
    background-color: #fff;
    border-radius: 2px;
    content: '';
    display: block;
    width: 100%;
    height: 4px;
}

.navTrigger i:nth-child(1) {
    -webkit-animation: outT 0.8s backwards;
    animation: outT 0.8s backwards;
    -webkit-animation-direction: reverse;
    animation-direction: reverse;
}

.navTrigger i:nth-child(2) {
    margin: 5px 0;
    -webkit-animation: outM 0.8s backwards;
    animation: outM 0.8s backwards;
    -webkit-animation-direction: reverse;
    animation-direction: reverse;
}

.navTrigger i:nth-child(3) {
    -webkit-animation: outBtm 0.8s backwards;
    animation: outBtm 0.8s backwards;
    -webkit-animation-direction: reverse;
    animation-direction: reverse;
}

.navTrigger.active i:nth-child(1) {
    -webkit-animation: inT 0.8s forwards;
    animation: inT 0.8s forwards;
}

.navTrigger.active i:nth-child(2) {
    -webkit-animation: inM 0.8s forwards;
    animation: inM 0.8s forwards;
}

.navTrigger.active i:nth-child(3) {
    -webkit-animation: inBtm 0.8s forwards;
    animation: inBtm 0.8s forwards;
}


    .navTrigger {
        display: block;
    }
    .nav div.logo {
        
        max-width:50%;
        float: left;
    }
    .nav div.main_list {
        width: 100%;
        height: 0;
        overflow: hidden;
    }
    .nav div.show_list {
        height: auto;
        display: none;
    }
    .nav div.main_list ul {
        flex-direction: column;
        width: 100%;
        height: 100vh;
        right: 0;
        left: 0;
        bottom: 0;
        background-color: #111;
        /*same background color of navbar*/
        background-position: center top;
    }
    .nav div.main_list ul li {
        width: 100%;
        text-align: right;
    }
    .nav div.main_list ul li a {
        text-align: center;
        width: 100%;
        font-size: 20px;
        padding: 20px;
    }
    .nav div.media_button {
        display: block;
    }

 .nav div.main_list ul li {
    width: auto;
    height: 2.5px;
    padding: 3.5%;
    
}}

/* Animation */
/* Inspiration taken from Dicson https://codemyui.com/simple-hamburger-menu-x-mark-animation/ */

.navTrigger {
    cursor: pointer;
    width: 30px;
    height: 25px;
    margin: auto;
    position: absolute;
    right: 30px;
    top: 0;
    bottom: 0;
}



.affix {
    padding: 0;
    background-color: #111;

}

.myH2 {
  text-align:center;
  font-size: 20px;
}
.myP {
  text-align: justify;
  padding-left:15%;
  padding-right:15%;
  font-size: 20px;
}
@media all and (max-width:900px){
  .myP {
    padding:2%;
  }
}
/*************************/
	
.header-menu {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: end;
      -ms-flex-pack: end;
          justify-content: flex-end; }
 
 /* 
.dropdown {
  float: left;
  overflow: hidden;
}*/

/* Style The Dropdown Button */
.dropbtn {
  
  padding: 4px;
  font-size: 16px;
  cursor: pointer;
  color: #fff;
    background-color: #6c757d;
    border-color: #6c757d;

    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    /*button */
    appearance: auto;
    -webkit-writing-mode: horizontal-tb !important;
    text-rendering: auto;
    color: -internal-light-dark(black, white);
   border-top: .3em solid;
    border-right: .3em solid transparent;
    border-bottom: 0;
    border-left: .3em solid transparent;

}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  /*min-width: 105px;
  z-index: 1;*/
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 9px 20px;
  width: 100%;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {
	background-color: #f1f1f1;
}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;
}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: #6c757d;
}

.dropdown-toggle {
    white-space: nowrap;
}
.dropdown-item {
  display: block;
  width: 100%;
  padding: 0.25rem 1.5rem;
  clear: both;
  font-weight: 400;
  color: #212529;
  text-align: inherit;
  white-space: nowrap;
  background-color: transparent;
  border: 0;
}

.dropdown-item:first-child {
  border-top-left-radius: calc(0.25rem - 1px);
  border-top-right-radius: calc(0.25rem - 1px);
}

.dropdown-item:last-child {
  border-bottom-right-radius: calc(0.25rem - 1px);
  border-bottom-left-radius: calc(0.25rem - 1px);
}

.dropdown-item:hover, .dropdown-item:focus {
  color: #16181b;
  text-decoration: none;
  background-color: #f8f9fa;
}
</style>

<nav class="nav">
	<!--nav class="navbar__menu"<form method="post">-->
            <div class="logo">
                <a href="Loading.php"><img src="images/logo.jpg" style="width: 25px;">
     WorkForce M Tool</a>
            </div>
 <div class="dropdown">
  <button class="dropbtn  ">Dropdown</button>
  <div class="dropdown-content">
    <a class="dropdown-item" href="#">Link 1</a>
    <a class="dropdown-item" href="#">Link 2</a>
    <a class="dropdown-item" href="#">Link 3</a>
  </div>
</div>
            <div id="mainListDiv" class="main_list">
            	
          <ul class="navlinks">  	

                <li><a href="?Attendance" name="Attendance"id="Change"
                 value="Attendance">Attendance</a></li>
                <li><a href="#">Portfolio</a></li>
				<li><a href="?Signing" name="Signing">Signing Machine</a></li>
				<li title="Unit:<?php echo $output["Unit_Name"];?>">
					<a href="#" style="font-size:15px;">
	<span  class="glyphicon glyphicon-user"><i class="far fa-users"></i></span>
	 Welcome<samp>:</samp>
        <?php echo $_SESSION["username"];?>
        	</a></li>
			<li><a href="?logout"><span style="font-size:15px;"><i class="fas fa-sign-out-alt"></i></span>log out</a></li>
			
                
            
    </ul>
   
                <span class="navTrigger">
                <i></i>
                <i></i>
                <i></i>
            </span>
            </div>
        
 
    </nav>
<script>

    $(function(){
      //$("#nav-placeholder").load("ramadan_2020.php");
      $('#upload').show();
      $('#Attendance').hide();
      $('#Signing').hide();
    });
    </script>

<div id="upload">

    <section >
    	 <div class="home" id="myDiv" style="width: 100%;
    height:60vh;
    background-image: url(images/Pipeline.jpg);
    background-position: center top;
  background-size:cover;">
    </div>
    </section>
        <div style="height: 1000px">
        <!-- just to make scrolling effect possible -->
			<h2 class="myH2">What is this ?</h2>
			<p class="myP">This is a responsive fixed navbar animated on scroll</p>
			</p>
			<p class="myP">I HOPE YOU FIND THIS USEFULL</p>
			<p class="myP">Albi</p>
		
    </div>
</div>
<div id="Attendance">
<section >
    	 <div class="home" id="myDiv" style="width: 100%;
    height:60vh;
    background-image: url(images/ramadan2021-1.jpg);
    background-position: center top;
  background-size:cover;">
    </div>
    </section>
</div>

  <?php
     if (isset($_GET['Attendance'])) {
   
     	include ("ramadan_2021.php");
     	?>
    <script>

    $(function(){
      //$("#nav-placeholder").load("ramadan_2020.php");
      $('#upload').hide();
      $('#Signing').hide();
      $('#Attendance').show();
    });
    </script>

<?php 
}
?>

<div id="Signing">
<section >
    	 <div class="home" id="myDiv" style="width: 100%;
    height:40vh;
    background-image: url(images/Pipeline.jpg);
    background-position: center top;
  background-size:cover;">
    </div>
    </section>
</div>

  <?php
     if (isset($_GET['Signing'])) {
   
     	include ("Signing Machine.php");
     	?>
    <script>

    $(function(){
      //$("#nav-placeholder").load("ramadan_2020.php");
      $('#upload').hide();
      $('#Attendance').hide();
      $('#Signing').show();
    });
    </script>

<?php 
}
?>

<script>
/*	$(document).ready(function(){
  $("#Change").click(function(){
$.ajax({
 type: "POST",
 url: "ramadan_2021.php",
 data: dataString,

});
$('#upload').hide();
    
  });
});

$(document).ready(function() {
    $.ajax({
        type:  'POST',
        url:   window.location.href,
        data: { load_content_b: 'true' },
        success: function( html ) {
            document.open();
            document.write(html);
            document.close();
        }
    });
});*/

</script>

<!-- Jquery needed -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script src="js/clicky-menus.js"></script>


    <script src="js/scripts.js"></script>

<!-- Function used to shrink nav bar removing paddings and adding black background -->
    <script>
        $(window).scroll(function() {
            if ($(document).scrollTop() > 50) {
                $('.nav').addClass('affix');
                console.log("OK");
            } else {
                $('.nav').removeClass('affix');
            }
        });
    </script>
  <script type="text/javascript">
  	$('.navTrigger').click(function () {
    $(this).toggleClass('active');
    console.log("Clicked menu");
    $("#mainListDiv").toggleClass("show_list");
    $("#mainListDiv").fadeIn();

});
  </script>

<script type="text/javascript">
	jQuery( document ).ready( function($) {
  $( window ).scroll( function () {
    if ( $(document).scrollTop() > 150 ) {
      // Navigation Bar
      $('.navbar').removeClass('fadeIn');
      $('body').addClass('shrink');
      $('.navbar').addClass('animated fadeInDown');
    } else {
      $('.navbar').removeClass('fadeInDown');
      $('body').removeClass('shrink');
      $('.navbar').addClass('animated fadeIn');
    }
  });
});
</script>

</div>
</body>
</html>