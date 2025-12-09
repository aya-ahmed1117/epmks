
<?php 
include ("pages.php");


      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];
         $usernames="";
      if(isset($_POST['username'])){$usernames = $_POST['username'];}
        $from_date="";
        $to_date="";
        $mydate ="";
        $mydate2 ="";
        //$Units ="";
        $groups = "";
        $groups2 = "";
        $units="";
        $units2="";
        $schedule_date="";
        $schedule_date2="";
    ?>
    <head>
      <title>WFM reports</title>

    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  </head>
          <style type="text/css">
        .body{
            padding: 10px 70px 10px 70px;
            height:100%;
          }
         .stat-icon{
          font-size: 60px;
          }
          .flat-color-1 {
            color: #00c292;   
        }
        .flat-color-2 {
        color: #6610f2;
          }
        .icon:hover{
          content: "";
        transform: scale(1.5);
        }
         i .fa-heartbeat{
        font-size: 4em;
        right: 0;
        left: 0;
        bottom: 0;
        top: 0;

        }

        .bg-flat-color-9{
        	background-color: #0067a5;
        }

        .bg-flat-color-11{
            background-color: #f6a600;
        }

        .bg-flat-color-13 ,.card1{
            background-color: #d0748b;
        }

        .bg-flat-color-14{
            background-color: #5490c4;
        }
        /**********/

          /************* flib box*/
          .flip-box {
            background-color: transparent;
        
            height: 200px;
            border: 1px solid #f1f1f1;
            perspective: 1000px;
            display: block;
            
          }
          
          .flip-box-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
          }
          
          .flip-box:hover .flip-box-inner {
            transform: rotateY(180deg);
          }
          
          .flip-box-front, .flip-box-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
          }
          
          .flip-box-front {
            background-color: #bbb;
            color: black;
          }
          
          .flip-box-back {
            background-color: dodgerblue;
            color: white;
            transform: rotateY(180deg);
          }

          /*********/
                    
          /* Float four columns side by side */
          .column {
            float: left;
            width: 25%;
            padding: 0 10px;
          }

          /* Remove extra left and right margins, due to padding */
          .row {margin: 0 -5px;
        
          padding: 20px;
        }

          /* Clear floats after the columns */
          .row:after {
            content: "";
            display: table;
            clear: both;
          }

          /* Responsive columns */
          @media screen and (max-width: 600px) {
            .column {
              width: 100%;
              display: block;
              margin-bottom: 20px;
            }
          }

          /* Style the counter cards */
          .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 16px;
            text-align: center;
            background-color: #f1f1f1;
          }
          /************ box*/
          .flip-card {
            /*background-color: transparent;*/
            width: 300px;
            height: 200px;
            border: 1px solid #f1f1f1;
            perspective: 1000px; /* Remove this if you don't want the 3D effect */
          }

          /* This container is needed to position the front and back side */
          .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
          }

          /* Do an horizontal flip when you move the mouse over the flip box container */
          .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg);
          }

          /* Position the front and back side */
          .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden; /* Safari */
            backface-visibility: hidden;
          }

          /* Style the front side (fallback if image is missing) */
          .flip-card-front {
           /* background-color: #bbb;
            color: black;*/
          }

          /* Style the back side */
          .flip-card-back {
            background-color: dodgerblue;
            color: white;
            transform: rotateY(180deg);
          }
          /*************************/
          /* Font */
@import url('https://fonts.googleapis.com/css?family=Quicksand:400,700');

/* Design */
*,
*::before,
*::after {
  box-sizing: border-box;
}


.main{
  max-width: 1200px;
  margin: 0 auto;
}

h1 {
    font-size: 24px;
    font-weight: 400;
    text-align: center;
}

img {
  height: auto;
  max-width: 100%;
  vertical-align: middle;
}

.btn {
  color: #ffffff;
  padding: 0.8rem;
  font-size: 14px;
  text-transform: uppercase;
  border-radius: 4px;
  font-weight: 400;
  display: block;
  width: 100%;
  cursor: pointer;
  border: 1px solid rgba(255, 255, 255, 0.2);
  background: transparent;
}

.btn:hover {
  background-color: rgba(255, 255, 255, 0.12);
}

.cards {
  display: flex;
  flex-wrap: wrap;
  list-style: none;
  margin: 0;
  padding: 0;
}

.cards_item {
  display: flex;
  padding: 1rem;
}

@media (min-width: 40rem) {
  .cards_item {
    width: 50%;
  }
}

@media (min-width: 56rem) {
  .cards_item {
    width: 33.3333%;
  }
}

.card {
  background-color: transparent;
  border-radius: 0.25rem;
  box-shadow: 0 20px 40px -14px rgba(0, 0, 0, 0.25);
  display: flex;
  flex-direction: column;
  overflow: hidden;
}

.card_content {
  padding: 1rem;
  /*background: linear-gradient(to bottom left, #EF8D9C 40%, #FFC39E 100%);*/
  background: linear-gradient(to bottom, #45637d 0%, #006699 100%);
}
}

.card_title {
  color: #ffffff;
  font-size: 1.1rem;
  font-weight: 700;
  letter-spacing: 1px;
  text-transform: capitalize;
  margin: 0px;
}

.card_text {
  color: #ffffff;
  font-size: 0.875rem;
  line-height: 1.5;
  margin-bottom: 1.25rem;    
  font-weight: 400;
}
.made_by{
  font-weight: 400;
  font-size: 13px;
  margin-top: 35px;
  text-align: center;
}
  .landing__container path{
       background: linear-gradient(to top left, #660033 16%, #ff0066 74%);
  }

  /********zoooom*/
  .zoom {
  /*padding: 50px;
  width: 200px;
  height: 200px;
  margin: 0 auto;*/
    transition: all 0.2s ease .2s;

}

.zoom:hover {
  -ms-transform: scale(1.05); /* IE 9 */
  -webkit-transform: scale(1.05); /* Safari 3-8 */
  transform: scale(1.05); 
}
        </style>

  <svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1400 320" style="margin-top:-100px;z-index: -5s; "  
    preserveAspectRatio="none"
    shape-rendering="auto">
  <path fill="#55608f" fill-opacity="1" d="M0,288L18.5,277.3C36.9,267,74,245,111,218.7C147.7,192,185,160,222,138.7C258.5,117,295,107,332,122.7C369.2,139,406,181,443,213.3C480,245,517,267,554,261.3C590.8,256,628,224,665,202.7C701.5,181,738,171,775,154.7C812.3,139,849,117,886,112C923.1,107,960,117,997,133.3C1033.8,149,1071,171,1108,165.3C1144.6,160,1182,128,1218,112C1255.4,96,1292,96,1329,106.7C1366.2,117,1403,139,1422,149.3L1440,160L1440,0L1421.5,0C1403.1,0,1366,0,1329,0C1292.3,0,1255,0,1218,0C1181.5,0,1145,0,1108,0C1070.8,0,1034,0,997,0C960,0,923,0,886,0C849.2,0,812,0,775,0C738.5,0,702,0,665,0C627.7,0,591,0,554,0C516.9,0,480,0,443,0C406.2,0,369,0,332,0C295.4,0,258,0,222,0C184.6,0,148,0,111,0C73.8,0,37,0,18,0L0,0Z"></path>
</svg>
<img class="landing__container" src="images/repor_gifff.gif"style="width: 20%; z-index: 99;margin-top:-100px; 
">
 <!-- <svg class="landing__container" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" style="width: 20%; z-index: 99;margin-top:-100px; 
">
     <path fill="#55608f" d="M54.4,-47.7C67.8,-41,74.1,-20.5,71.4,-2.7C68.6,15.1,56.9,30.2,43.6,43C30.2,55.8,15.1,66.3,2.3,63.9C-10.4,61.6,-20.8,46.4,-35.9,33.6C-51,20.8,-70.8,10.4,-72.4,-1.6C-74,-13.5,-57.3,-27.1,-42.2,-33.8C-27.1,-40.5,-13.5,-40.4,3.5,-43.9C20.5,-47.4,41,-54.5,54.4,-47.7Z" 
     transform="translate(80 80)" />
</svg> -->
<center>

<div class="col-md-8" style="margin-top:-180px; z-index: 99;">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;z-index: 99;">
        <div class="card-header user-header alt bg-light"
        style="border-radius: 20px 20px 0 0 ;">
        <div class="media">
        <div class="media-body">
          <h2 class="text-dark display-12" >WFM Reports</h2>
          <p style="color:lightgray;">Welcome :
           <?php echo $_SESSION["username"];?></p>
          </div>
      </div>
  </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">This report is generated on daily bases</p>
  </aside>
</div>
</center>
<!-- <center>
   <svg class="landing__container" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" style="width: 20%; z-index: 99;">
     <path fill="#55608F" d="M54.4,-47.7C67.8,-41,74.1,-20.5,71.4,-2.7C68.6,15.1,56.9,30.2,43.6,43C30.2,55.8,15.1,66.3,2.3,63.9C-10.4,61.6,-20.8,46.4,-35.9,33.6C-51,20.8,-70.8,10.4,-72.4,-1.6C-74,-13.5,-57.3,-27.1,-42.2,-33.8C-27.1,-40.5,-13.5,-40.4,3.5,-43.9C20.5,-47.4,41,-54.5,54.4,-47.7Z" 
     transform="translate(80 80)" />
</svg>
</center> -->
<div class="main">
  <h1>Responsive Card Grid Layout</h1>
  <ul class="cards">
    <li class="cards_item">
      <div class="card">
        <div class="card_image zoom">
          <img src="images/new_logoWE-removebg-preview.png"></div>
        <div class="card_content">
          <h2 class="card_title">Card Grid Layout</h2>
          <p class="card_text">Demo of pixel perfect pure CSS simple responsive card grid layout</p>
          <a href="promotion_q.php">
          <button class="btn card_btn">Promotion</button></a>
        </div>
      </div>
    </li>

    <li class="cards_item">
      <div class="card">
        <div class="card_image">
          <img src="images/new_logoWE-removebg-preview.png"></div>
        <div class="card_content">
          <h2 class="card_title">Card Grid Layout</h2>
          <p class="card_text">Demo of pixel perfect pure CSS simple responsive card grid layout</p>
          <button class="btn card_btn">Read More</button>
        </div>
      </div>
    </li>
    <li class="cards_item">
      <div class="card">
        <div class="card_image">
          <img src="images/2019092409A.gif"></div>
        <div class="card_content">
          <h2 class="card_title">Card Grid Layout</h2>
          <p class="card_text">Demo of pixel perfect pure CSS simple responsive card grid layout</p>
          <button class="btn card_btn">Read More</button>
        </div>
      </div>
    </li>
  </ul>
</div>
<div class="your-container">
  <svg
    class="css-waves"
    xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    viewBox="0 24 150 28"
    preserveAspectRatio="none"
    shape-rendering="auto"  >
    <defs>
      <path
        id="wave-pattern"
        d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"
      ></path>
    </defs>
    <g class="animated-waves">
      <use href="#wave-pattern" x="0" y="0"fill="#55608f"></use>
      <use href="#wave-pattern" x="48" y="3" fill="#55608f"></use>
      <use href="#wave-pattern" x="0" y="5" fill="#55608f"></use>
      <use href="#wave-pattern" x="48" y="7" fill="#55608f"></use>
    </g>
  </svg>
</div>

<div class="main">
  <ul class="cards">

    <li class="cards_item">
      <div class="card">
        <div class="card_image">
          <img src="https://picsum.photos/500/300/?image=14" class="zoom"></div>
        <div class="card_content">
          <h2 class="card_title">Card Grid Layout</h2>
          <p class="card_text">Demo of pixel perfect pure CSS simple responsive card grid layout</p>
          <button class="btn card_btn">Read More</button>
        </div>
      </div>
    </li>
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="https://picsum.photos/500/300/?image=17"></div>
        <div class="card_content">
          <h2 class="card_title">Card Grid Layout</h2>
          <p class="card_text">Demo of pixel perfect pure CSS simple responsive card grid layout</p>
          <button class="btn card_btn">Read More</button>
        </div>
      </div>
    </li>
    <li class="cards_item">
      <div class="card">
        <div class="card_image"><img src="https://picsum.photos/500/300/?image=2"></div>
        <div class="card_content">
          <h2 class="card_title">Card Grid Layout ♡♡</h2>
          <p class="card_text">Demo of pixel perfect pure CSS simple responsive card grid layout</p>
          <button class="btn card_btn">Read More</button>
        </div>
      </div>
    </li>
  </ul>
</div>

<h3 class="made_by">Made with ♡</h3>


  <style type="text/css">

      .landing__container {
    opacity: 1;
    animation: rotate 4s linear 0s infinite forwards;
}


     /* Section Active Styles Keyframe Animations */
@keyframes rotate {
  from {
    transform: rotate(0deg)
               translate(-1em)
               rotate(0deg);
  }
  to {
    transform: rotate(360deg)
               translate(-1em) 
               rotate(-360deg);
  }
}


/*********/
.css-waves {
  position: relative;
  width: 100%;
  height: 15vh;
  margin-bottom: -7px; 
  min-height: 100px;
  max-height: 150px;
}

/* Here we declare the SVG node that we wish to animate. */

.animated-waves > use {
  animation: infinite-waves 25s cubic-bezier(0.55, 0.5, 0.45, 0.5) infinite;
}
.animated-waves > use:nth-child(1) {
  animation-delay: -2s;
  animation-duration: 7s;
}
.animated-waves > use:nth-child(2) {
  animation-delay: -3s;
  animation-duration: 10s;
}
.animated-waves > use:nth-child(3) {
  animation-delay: -4s;
  animation-duration: 13s;
}
.animated-waves > use:nth-child(4) {
  animation-delay: -5s;
  animation-duration: 20s;
}
@keyframes infinite-waves {
  0% {
    transform: translate3d(-90px, 0, 0);
  }
  100% {
    transform: translate3d(85px, 0, 0);
  }
}
/* Mobile Optimization */
@media (max-width: 768px) {
  .css-waves {
    height: 40px;
    min-height: 40px;
  }
}


  </style>

  <!--   
  <svg class="landing__container" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" style="width:30%;vertical-align: middle;    overflow: hidden;overflow-clip-margin: content-box;">
     <path fill="#55608F" d="M54.4,-47.7C67.8,-41,74.1,-20.5,71.4,-2.7C68.6,15.1,56.9,30.2,43.6,43C30.2,55.8,15.1,66.3,2.3,63.9C-10.4,61.6,-20.8,46.4,-35.9,33.6C-51,20.8,-70.8,10.4,-72.4,-1.6C-74,-13.5,-57.3,-27.1,-42.2,-33.8C-27.1,-40.5,-13.5,-40.4,3.5,-43.9C20.5,-47.4,41,-54.5,54.4,-47.7Z" />
</svg> -->

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}
</script>
   <script type="text/javascript">
     $('.popover-dismiss').popover({
  trigger: 'focus'
})
$('#example').popover(options)
$('#element').popover('show')
$('#myPopover').on('hidden.bs.popover', function () {
  // do something…
})
   </script>
</div></div>
   <?php
 include ("footer.html");
 ?>