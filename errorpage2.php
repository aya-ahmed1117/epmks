<html>

 
 <?php
        require_once("inc/config.inc");
        
  if($_SESSION['username'] == ''){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }

      $self = $_SESSION['id'];
      $role_id = $_SESSION['role_id'];  ?>

<?php
  $unit = $_SESSION['Unit_Name'];
$checkme = sqlsrv_query( $con ,"SELECT  DISTINCT [Unit_Name]
  FROM [Aya_Web_APP].[dbo].[employee]
  where Unit_Name not in 
  ( 'Enterprise Service Desk','Workforce Management') and id = '$self' ");
  $output = sqlsrv_fetch_array($checkme );
   $Unit_Name = $output['Unit_Name'];
if ($unit == $Unit_Name ){

//include('mwd_reports.php');
 //"PHP continues.\n";
die();
 //"Not after a die, however.\n";
}
?>


<head>
  <title>Blank page</title>
  </head>
    <style>
     
    img {
        max-width: 100%;
        height: auto;
    }

    

    .flex {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    }

    .flex-column {
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
    }

    .full-width {
        width: 100%;
    }

    .align-items-center {
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    .justify-content-evenly {
        justify-content: space-evenly;
    }

    .justify-content-center {
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .bg-black {
        background-color: #212121;
    }

    .text-bold {
        font-weight: bold;
    }

    .text-center {
        text-align: center;
    }

    .text-white {
        color: #fff;
    }

    .logo-holder {
        position: absolute;
        width: 17%;
        margin-top: 3.25vh;
        margin-bottom: 6vh;
    }

    .top-section {
        margin-bottom: 50px;
    }

    .heading-1 {
        font-size: 3rem;
        line-height: 1.25;
    }

    .mb-30 {
        margin-bottom: 30px;
    }

    .mr-30 {
        margin-right: 30px;
    }

    .image-holder {
        position: relative;
        width: 100%;
        height: 70vh;

    }

    /* ----- Corgi Background Styling Start ----- */

    .error-code-bg {
        position: absolute;
        bottom: 100px;
        font-size: 8vw;
        color: transparent;
        background-color: rgba(0, 0, 0,.7);
        height: auto;
        text-align: center;
        line-height: 1em;
        z-index: 0;
        top: 0;
        -webkit-text-stroke-width: 1px;
        -webkit-text-stroke-color: #b2b9bc;
        -ms-text-stroke-width: 1px;
        -ms-text-stroke-color: #b2b9bc;
    }

    .corgi {
        position: absolute;
        z-index: 2;
        bottom: 10px;
        width: 15vw;
    }

    .corgi__spotlight {
        position: absolute;
        z-index: 1;
        bottom: 0;
        width: 28vw;
    }

    .corgi--default {
        width: 100%;
    }

    .corgi--hover {
        display: none;
    }

    .corgi:hover .corgi--default {
        display: none;
    }

    .corgi:hover .corgi--hover {
        display: block;
        width: 100%;
    }

  
        .top-section {
            -ms-flex-positive: 1;
            -webkit-flex-grow: 1;
            flex-grow: 1;
            margin: 0;
        }
        .container:hover .corgi--default {
            display: none;
        }
        .container:hover .corgi--hover {
            display: block;
        }
    }

    </style>
       
                <div class="image-holder flex justify-content-center">
                    <img src="https://cdn.000webhost.com/000webhost/000webhost-pages/corgi-spotlight.svg" class="corgi__spotlight" alt="Dog spotlight">
                </div>
            <span class="error-code-bg text-bold" style="text-transform: uppercase;"><br>You are not allowed to open this page.</span>
 <?php
 include ("footer.html");

 ?>
