<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    
 <?php
 require_once("inc/config.inc");
if (isset($_GET['id'])){$idd = $_GET['id']; }
$check = sqlsrv_query( $con ,"SELECT * FROM [employee] ");
$output = sqlsrv_fetch_array($check );
$orders_num = 1;
$username_id = $output['username_id'];
$_POST['UserName'] ='';
//  date_default_timezone_set('Africa/Cairo');
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
      ?>
  <title>Personal </title>
  <link rel="icon" href="images/logo_we.jpg">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="language" content="English">
  <meta http-equiv="content-language" content="en">
  <meta http-equiv="Content-Type" content="text/html; charset=windows-1256">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="bootstrap.min.js"></script>
  <script src="jQuery/sweetalert.min.js"></script>
  <link rel="stylesheet" href="Fonts/css/font-awesome.css">
  <link rel="stylesheet" href="css/bootstrap2.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<!-- <script src="jQuery/bootstrap.min.css"></script>
 -->        
 <link src="jQuery/bootstrap.css"></link>
<!--   <link rel="stylesheet" href="css/style4.css">
 -->  
 <link rel="stylesheet" href="Fonts/css/font-awesome.min.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
<!--   <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
 -->  <link href="assets2/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets2/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets2/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets2/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets2/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets2/css/style.css" rel="stylesheet">
</head>
<style>
body, p, table, th, td, div {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 12px;
}
th {
  background-color:#0080C0;
  color:white;
  font-weight:bold;
  font-size:18px;
  border: 1px solid #0080C0;
}
input.text, textarea {
  font-family: Arial, Helvetica, sans-serif;
  font-size: 11px;
  width: 99%;
}
.text:focus, textarea:focus {
  background-color: #FFFACC;
  border: 1px solid #000000;
}
#mydiv {

  margin-left: auto ;
  margin-right: auto ;
  width: 600px;
  text-align: left;
  transform: translateX(-57%) translateY(-2%);
}
#mydiv2 {
  margin-left: auto ;
  margin-right: auto ;
  width: 600px;
  text-align: left;
transform: translate(108%,-142.6%);}
td.colone {
  text-align: right ;
  vertical-align: top;
  padding-top:6px;
  width:30%;

}
td.coltwo {
  color:red;
  text-align: left;
  vertical-align: top;
  padding-top:9px;
}
td.colthree {

}
table.border {
  border: 1px solid #0080C0;
  border-collapse: collapse;
}
caption {
  text-align:center;
  font-size:18px;
  font-weight:bold;
}

.popup {

  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  border-radius: 5px;
  width: 100%;
  position: fixed;
  background: rgba(0, 0, 0, 0.7);
}
.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}

.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  background-color: #eee;
  width: 39%;
  margin: 200px 0 10px 30%;
  text-align: center;
  padding: 45px;
  border: 2px solid rgba(0, 0, 10, 0.7);
  border-radius: 20px/50px;
  font-size: 40px;
  color: black;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  
  .popup{
    width: 70%;
  }
}


</style>
<body>      
    <div class="wrapper">
 <style>

.navbar {
    padding: 2px 7px;
    margin-bottom: 10px;
  }
</style>

 <div id="content">

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul><img src="images/logo_we.jpg" style="padding: 1px; padding-bottom: 1px; margin-right: 1px; padding-top: 1px; padding-left: 1px; width: 25px; margin-bottom: 3px; "><span style="font-size:15px;font-family: Century Gothic; margin-right: 1px;">WorkForce Managment Tool (Adding Employee Info)</span></ul> 
                        <ul class="nav navbar-nav ml-auto">

                        </ul>
                    </div>
                </div>
            </nav>

<div class="container">
        <div class="panel-group" id="accordion">

      <form method="POST"  enctype="multipart/form-data" >
      
<h4 class="alert alert-warning alert-dismissiblefade show" style="font-size:24px; "> &#9888; Please Fill All the Data Below and if there is an (*) mark this is a requred data.</h4>
    <div class="panel panel-default" >
      <div class="panel-heading">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
        <h4 class="panel-title" style="color: black;">
Personal Informations
 <img src="images/person-with.png" 
style="width:4%;float: right;margin-top: -10px;" >
        </h4>
         </a>
    </div>
     

      <div id="collapse1" class="panel-collapse collapse in"style="padding-top:-40%;">
        <div class="panel-body">
 <table class="border" width="100%" cellpadding="2" cellspacing="0">
  <tr>
    <td class="colone">ID</td>
        <td class="coltwo">*</td>
    <td class="colthree">

<!--   <input list="empIdSelect" name="ID" placeholder="Select id" type="number" value="" id="aya" style="width:49%;padding:5px;" oninput="fetchUserName()" required /> -->
<select name="ID" id="empIdSelect" style="width:49%;padding:7px;" required>
  <option value="" >*Select</option> 
    <?php
    $gogo = sqlsrv_query( $con1 ,"SELECT  [ID]
  FROM [Employess_DB].[dbo].[Training] order by ID");
  while($index = sqlsrv_fetch_array($gogo)){
  $rows  = '<option ';
  $rows .= $index['ID'] ? "selected" : "";;
  $rows .= 'value="'.$index['ID'].'">'.$index['ID'].'</option>';
  echo $rows;}
 // $gogo = sqlsrv_query( $con1 ,"SELECT  [ID]
 //  FROM [Employess_DB].[dbo].[Training] order by ID");
 //    while ($index = sqlsrv_fetch_array($gogo)) {
 //        echo '<option value="' . $index['ID'] . '">' . $index['ID'] . '</option>';
 //    }
    ?>
</select>
</td>
</tr>


<tr>
    <td class="colone">Username:</td>
    <td class="coltwo">*</td>
    <td class="colthree">
      <input name="UserName" type="text"
      id="userNameDisplay" value="<?php if(isset($_POST['UserName'])) echo $_POST['UserName']; ?>" readonly required></td>
  </tr>

   <tr>
    <td class="colone">E-mail:</td>
    <td class="coltwo">*</td>
    <td class="colthree">
      <input name="E-mail" type="email"
      id="emailDisplay" value="<?php if(isset($_POST['UserName'])) echo $_POST['UserName']; ?>" style="width:49%;"readonly required></td>
  </tr>
 </table>
              </div>
            </div>
          </div>
<div class="input-group-btn col-md-6" >
  <p>Thank You for taking the time to fill in all the information.<br/>
      To Submit your information for consideration, click the SUBMIT Button below.<br/>
    </p>
      <button class="btn btn-primary col-md-6"type='submit' id="mySubmit" name='send'
 value="Submit your information" >Submit</button></div>
          <?php 
       
if(isset($_POST['ID'])){$ID = $_POST['ID'];}
if(isset($_POST['UserName'])){$UserName = $_POST['UserName'];}

        if(isset($_POST['send'])){
          echo "INSERT INTO [EDB].[dbo].[Employess_DB]

          ( [ID],[UserName])
           VALUES
           ('$ID','$UserName')";

          }

            ?>
       </form>
      </div>
    </div>
  </div>
</div>


<!-- <div id="userNameDisplay"></div> -->

<!-- <div id="userNameDisplay">()</div> -->

  <script ssrc="js/jquery-3.6.0.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f"crossorigin="anonymous">
</script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="jQuery/jquery-2.2.4.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- <script src="bootstrap.min.js"></script> -->
<script src="js/bootstrap.min.js"></script>
  <script src="jQuery/jquery-2.2.4.js"></script>

<script type="text/javascript">
  var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'))
var collapseList = collapseElementList.map(function (collapseEl) {
  return new bootstrap.Collapse(collapseEl)
})
</script>

    <script type="text/javascript">
  $(document).ready(function () {
    // $('#aya').on('input',function () {
    $('#empIdSelect').change(function () {
        var selectedEmpId = $(this).val();
        var mail = '@te.eg';

        $.ajax({
            method: "POST",
            url: "getUserName.php", // replace with the correct URL for your server-side script
            data: { EmpID: selectedEmpId },
            success: function (data) {
                $('#userNameDisplay').val(data);
                $('#emailDisplay').val(data+mail);
            }
        });
    });
});
</script>

<?php 

  include("footer.html");
?>
