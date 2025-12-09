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
Personal Informations <img src="images/person-with.png" 
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
      <select name="ID" id="empIdSelect" style="width:49%;padding:7px;" required>
        <option value="" >*Select</option> 
          <?php
          $gogo = sqlsrv_query( $con1 ,"SELECT DISTINCT [ID]
                FROM [Employess_DB].[dbo].[Training] T
                WHERE LTRIM(T.[status]) NOT LIKE 'delete%'
                  AND NOT EXISTS (
                    SELECT 1 
                    FROM [Employess_DB].[dbo].[tbl_Personal_info] P
                    WHERE P.ID = T.ID
                  )
                ORDER BY ID");
        while($index = sqlsrv_fetch_array($gogo)){
        $rows  = '<option ';
        $rows .= $index['ID'] ? "selected" : "";;
        $rows .= 'value="'.$index['ID'].'">'.$index['ID'].'</option>';
        echo $rows;}
        ?>
      </select>
    </td>
  </tr>

  <tr>
    <td class="colone">Employee Name:</td>
    <td class="coltwo">*</td>
    <td class="colthree">
      <input name="Employee_Name" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$"  type="text" style="width:49%;" required placeholder="Only English letters are allowed here..."></td>
  </tr>
  <tr>
    <td class="colone">Employee Type:</td>
    <td class="coltwo">*</td>
    <td class="colthree">
      <select name="Employee_Type" style="width:49%;padding:7px;" required>
      <option selected value="">select</option>
      <option value="Staff">Staff</option>
      <option value="OutSource">OutSource</option>
      </select>
    </td>
  </tr>
  <tr>
    <td class="colone">Education Qualifications:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$"  name="Education_Qualifications" placeholder="Only English letters are allowed here..."  type="text" style="width:49%;"required></td>
  </tr>
  <tr>
    <td class="colone">Faculty:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$"   name="faculty" type="text" placeholder="Only English letters are allowed here..." style="width:49%;"required></td>
  </tr><tr>
    <td class="colone">Major:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$"   name="Major" type="text" placeholder="Only English letters are allowed here..." minimum={5} style="width:49%;"required></td>
  </tr><tr>
    <td class="colone">Year of graduation:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input name="Year_of_Graduation" type="date" style="width:49%;"required></td>
  </tr>
  <tr>

    <td class="colone">National ID:</td>
    <td class="coltwo">*</td>
    <td class="colthree">
  <input name="National_ID" type="text" maxlength="14" style="width:49%;" pattern="\d{14}" 
  required title="14 characters minimum" ></td>
  </tr>


  <tr>
    <td class="colone">National ID expiration date:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input name="National_ID_Expiration_date" type="date" style="width:49%;"required></td>
  </tr><tr>
    <td class="colone">Username:</td>
    <td class="coltwo">*</td>
    <td class="colthree">
      <!-- <input name="UserName" type="text" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" placeholder="Only English letters are allowed here..." style="width:49%;"required> -->
      <input name="UserName" type="text"id="userNameDisplay" value="<?php if(isset($_POST['UserName'])) echo $_POST['UserName']; ?>" style="width:49%;background-color: lightgray;" readonly required>

    </td>
  </tr><tr>
    <td class="colone">Full /address 1:</td>
    <td class="coltwo">*</td>
    <td class="colthree">

      <input   name="Full_Address" type="text" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$"  style="width:49%;" placeholder="Only English letters are allowed here..." required />
   </td>
  </tr>

  <script ssrc="js/jquery-3.6.0.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <tr>
    <td class="colone">Full /address 2:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="Address_2" type="text" style="width:49%;"></td>
  </tr>

 <tr>
    <td class="colone">Address:</td>
    <td class="coltwo">*</td>
    <td class="colthree">
  <select name="Address"style="width:49%;padding:7px;" required>
        <option value="">*Select</option> 
     <?php
$gogo = sqlsrv_query( $con1 ,"  SELECT  * FROM [EDB].[dbo].[Sheet1]");
//while($outputs = $checks->fetch_array()){
  while($index = sqlsrv_fetch_array($gogo)){
  $rows = '<option ';
  $rows .= $output['id'] == $index['ID'] ? "selected" : "";;
  $rows .= 'value="'.$index['total'].'">'.$index['total'].'</option>';
  echo $rows;}?> 
</select>
    </td>
  </tr>

  <tr>
    <td class="colone">Hiring Date:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input name="Hiring_Date" type="date" style="width:49%;"></td>
  </tr><tr>
    <td class="colone">Operation Date:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input name="Operation_date" type="date" style="width:49%;"required></td>
  </tr><tr>
    <td class="colone">Birth Date:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input name="Birth_Date" type="date" style="width:49%;"required></td>
  </tr><tr>
    <td class="colone">Mobile Number 1:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input name="Mobile_Number" type="Number" style="width:49%;"required></td>
  </tr><tr>
    <td class="colone">Mobile Number 2:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="Mobile_2" type="number" style="width:49%;"></td>
  </tr>

    <tr>
    <td class="colone">Gender:</td>
    <td class="coltwo">*</td>
    <td class="colthree">
      <select name="Gender"style="width:49%;padding:7px;" required>
            <option value="" selected>selected</option>
      <option value="female">Female</option>
      <option value="male"> Male</option>
      </select>
    </td></tr>

 
   <tr>
    <td class="colone">E-mail:</td>
    <td class="coltwo">*</td>
    <td class="colthree">
      <input name="E-mail" type="email" type="email"
      id="emailDisplay" value="<?php if(isset($_POST['UserName'])) echo $_POST['UserName']; ?>" style="width:49%;background-color: lightgray;" required readonly></td>
  </tr>
   <tr>
    <td class="colone">Home Telephone:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input name="Home_Tel" type="text" style="width:49%;" required></td>
  </tr>
 
  <tr>
    <td class="colone">Mobile Allowance:</td>
    <td class="coltwo">*</td>
    <td class="colthree">
      <select name="Mobile_Allowance" style="width:49%;padding:7px;" required>
      <option value="" selected>selected</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      </select></td>
  </tr>

 <tr>
    <td class="colone">Transp.allowance_package:</td>
    <td class="coltwo">*</td>
    <td class="colthree">
      <select name="Transportation_allowance_package" style="width:49%;padding:7px;" required>
      <option value="" selected>selected</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
      </select>
    </td>
  </tr>

</table>
</div>
</div>
</div>
            <!--address>
Written by <a href="mailto:aya.abdelfattah@te.eg"><ins>AYA</ins></a>.<br> 

</address>

transform: translateX(50%) translateY(50%);
transform: translate(500px,-520px);


style="transform: translate(135% , -599%); width:40%;"
-->
<br/>

    <div class="panel panel-default">
      <div class="panel-heading"><a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
        <h4 class="panel-title" style="color: black;">
Promotion Informations
     <img src="images/Promotion.png" style="width:3.5%;float: right;margin-top: -10px;" > 
    </h4>
      </div> 
      <div id="collapse2" class="panel-collapse collapse in">
        <div class="panel-body"></a>

<table width="100%" style="border-collapse:collapse;margin-top:2%;">
  <tr>
    <td width="67%">
      <table border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
          <td class="colone">Senior promotion</td>
          <td class="colthree"><input class="text" name="Senior_Promotion" type="date" style="width:49%;"></td>
        </tr>
        <tr>
          <td class="colone">Supervisor promotion</td>
          <td class="colthree"><input class="text" name="Supervisor_Promotion" type="date" style="width:49%;"></td>
        </tr>
        <tr>
          <td class="colone">SectionHead promotion</td>
          <td class="colthree"><input class="text" name="SectionHead_Promotion" type="date" style="width:49%;"></td>
        </tr>
        <tr>
          <td class="colone">UnitManager promotion</td>
          <td class="colthree"><input class="text" name="UnitManager_Promotion" type="date" style="width:49%;"></td>
        </tr>
      </td>
        
      </table>
    </td>
  </tr>
</table>
</div>
</div>
</div>
<br>

<div class="panel panel-default">
      <div class="panel-heading"><a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
        <h4 class="panel-title"style="color: black;">
Medical Informations <img src="images/Midical.png" style="width:3.7%;float: right;margin-top: -10px;" ></button>
</h4>
      </div> 
      <div id="collapse3" class="panel-collapse collapse in">
        <div class="panel-body"></a>
 <table width="50%" style="border-collapse:collapse;margin-top:2%;">

  <tr>
    <!--td width="3%" style="padding-left:-50%; width:10%;">Current or Most Recent Employer:</td-->
    <td width="67%">
      <table border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
          <td class="colone">Employee Medical ID</td>
          <td class="colthree"><input class="text" name="Employee_Medical_ID" type="number" style="width:49%;" ></td>
        </tr>
        <tr>
          <td class="colone">Wife Medical ID</td>
          <td class="colthree"><input class="text" name="Wife_Medical_ID" type="number" style="width:49%;" ></td>
        </tr>
        <tr>
          <td class="colone">C1 Medical ID</td>
          <td class="colthree"><input class="text" name="C1_Medical_ID" type="number" style="width:49%;" ></td>
        </tr>
        <tr>
          <td class="colone">C2 Medical ID</td>
          <td class="colthree"><input class="text" name="C2_Medical_ID" type="number" style="width:49%;" ></td>
        </tr>
         <tr>
          <td class="colone">C3 Medical ID</td>
          <td class="colthree"><input class="text" name="C3_Medical_ID" type="number" style="width:49%;"></td>
     </tr>
      </td>
        
      </table>
    </td>
  </tr>
</table>
</div>
</div>
</div>
<br>

    <div class="panel panel-default">
      <div class="panel-heading"><a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
        <h4 class="panel-title" style="color: black;">
Department Informations: <img src="images/customer-data.png" style="width:4.3%;float: right;margin-top: -10px;" > 
    </h4>
      </div> 
      <div id="collapse4" class="panel-collapse collapse in">
        <div class="panel-body"></a>




   <table width="100%"  cellspacing="0" cellpadding="2" style="border-collapse:collapse;margin-top:2%;">
  <tr>
    <td width="67%">
      <table border="0" cellspacing="0" cellpadding="2" width="50%">
  <tr>
    <td class="coltwo" style="color: black;">Current Title</td>
        <td class="coltwo">*</td>
<td class="colthree"><input class="text" name="Current_Title" type="text" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" placeholder="Only English letters are allowed here..." style="width:150%;" required>
      <!--select name="Current_Title"style="width:200%;padding:7px;" required>
        <option value="">*Current Title</option> 
     <?php
$gogo = sqlsrv_query( $con1 ,"  SELECT  [ID],[Current_Title]
  FROM [EDB].[dbo].[Employess_DB]");
//while($outputs = $checks->fetch_array()){
  while($index = sqlsrv_fetch_array($gogo)){
  $rows = '<option ';
  $rows .= $output['username_id'] == $index['ID'] ? "selected" : "";;
  $rows .= 'value="'.$index['Current_Title'].'">'.$index['Current_Title'].'</option>';
  echo $rows;}?> 
</select>
</td--></tr>

        <tr>
        <td class="coltwo" style="color: black;">Grade</td>
        <td class="coltwo">*</td>
    <td class="colthree">
      <select name="Grade"style="width:150%;padding:7px;" required>
        <option value="">* Select </option>
        <option value="L8">L8</option>
        <option value="L7">L7</option>
        <option value="L6">L6</option>
        <option value="L5">L5</option>
        <option value="L4">L4</option>
        <option value="L3">L3</option>
        <option value="L2">L2</option>
        <option value="L9">L9</option>
        <option value="L9-A">L9-A</option>
        <option value="L9-B">L9-B</option>
        <option value="L9-C">L9-C</option>
        <option value="L9-D">L9-D</option>
        <option value="L9-E">L9-E</option>

 
</select>
</td></tr>
        <tr>
         <td class="coltwo"style="color: black;">Manager Name</td>
         <td class="coltwo">*</td>
    <td class="colthree">
      <select name="Manager_Name"style="width:150%;padding:7px;" required>
        <option value="">* Select Manager</option> 
     <?php
     /*
$gogo = sqlsrv_query( $con1 ,"SELECT [ID1]
      ,[ID]
      ,[Name]
      ,[SSMA_TimeStamp]
  FROM [EDB].[dbo].[Managers]");
//while($outputs = $checks->fetch_array()){
  while($index = sqlsrv_fetch_array($gogo)){
  $rows = '<option ';
  $rows .= $output['username'] == $index['ID1'] ? "selected" : "";;
  $rows .= 'value="'.$index['Name'].'">'.$index['Name'].'</option>';
  echo $rows;}*/?> 
   <?php
$gogo = sqlsrv_query( $con1 ,"SELECT id,username
from tbl_Personal_info
where  
((grade in ('l7','l6','l5','l4','l3','l2') ) Or (grade ='l8' and note ='act as leader' ))
and Employee_Status != 'Resigned' order by [username] ");
//while($outputs = $checks->fetch_array()){
  while($index = sqlsrv_fetch_array($gogo)){
  $rows = '<option ';
  $rows .= $output['username'] == $index['username'] ? "selected" : "";;
  $rows .= 'value="'.$index['username'].'">'.$index['username'].'</option>';
  echo $rows;}?> 
</select>
    </td>
  </tr>
        <tr>
         <td class="coltwo"style="color: black;">Department</td>
         <td class="coltwo">*</td>
    <td class="colthree" >
      <select name="Department" style="width:150%;padding:7px;" required>
     <option value="">* Select </option> 
     <?php
 

$gogo = sqlsrv_query( $con1 ,"SELECT distinct [Department]
  FROM [EDB].[dbo].[Deprtments]");
//while($outputs = $checks->fetch_array()){
  while($index = sqlsrv_fetch_array($gogo)){
  $rows = '<option ';
  $rows .= $output['username'] == $index['Department'] ? "selected" : "";;
  $rows .= 'value="'.$index['Department'].'">'.$index['Department'].'</option>';
  echo $rows;}?> 
</select>
</td>
  </tr>
         <tr>
         <td class="coltwo"style="color: black;">Unit</td>
<td class="coltwo">*</td>
    <td class="colthree">

      <select name="Unit" style="width:150%;padding:7px;"required >
  <option value="">* Select </option> 
     <?php

$gogo = sqlsrv_query( $con1 ,"SELECT  
      [Units] , [Units_ID]
  FROM [Employess_DB].[dbo].[Tbl_Units]");
//while($outputs = $checks->fetch_array()){
  while($index = sqlsrv_fetch_array($gogo)){
  $rows = '<option ';
  $rows .= $output['Unit_Name'] == $index['Units'] ? "selected" : "";;
  $rows .= 'value="'.$index['Units'].'">'.$index['Units'].'</option>';
  echo $rows;}?> 
</select>
    </td>
  </tr>
  <tr>
            <td class="coltwo"style="color: black;">Location</td>
            <td class="coltwo">*</td>
    <td class="colthree"  >
      <select name="Location" style="width:150%;padding:7px;" >
        <option value="">* Select </option> 
     <?php
  
$gogo = sqlsrv_query( $con1 ,"SELECT [Locations]
  FROM [EDB].[dbo].[Location_site]");
//while($outputs = $checks->fetch_array()){
  while($index = sqlsrv_fetch_array($gogo)){
  $rows = '<option ';
  $rows .= $output['id'] == $index['Locations'] ? "selected" : "";;
  $rows .= 'value="'.$index['Locations'].'">'.$index['Locations'].'</option>';
  echo $rows;}?> 
</select></td>
  </tr>
        <tr>
          
        <td class="coltwo"style="color: black;">Floor</td>
        <td class="coltwo">*</td>
    <td class="colthree">
      <select name="Floor"style="width:150%;padding:7px;" >
      <option value="">* Select </option> 
     <?php
  date_default_timezone_set('Africa/Cairo');
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);
sqlsrv_query( $con1 , "SET NAMES 'utf8'"); 
sqlsrv_query( $con1 ,'SET CHARACTER SET utf8' );

$gogo = sqlsrv_query( $con1 ,"SELECT  [Floors]
  FROM [EDB].[dbo].[Floor]");
//while($outputs = $checks->fetch_array()){
  while($index = sqlsrv_fetch_array($gogo)){
  $rows = '<option ';
  $rows .= $output['id'] == $index['Floors'] ? "selected" : "";;
  $rows .= 'value="'.$index['Floors'].'">'.$index['Floors'].'</option>';
  echo $rows;}?> 
</select>
    </td></tr>

        <tr>
          <td class="coltwo" style="color: black;">Room No.</td>
          <td class="coltwo">*</td>
          <td class="colthree"><input class="text" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" placeholder="Only English letters are allowed here..." name="Room_num" type="text" style="width:150%;"></td>
        </tr>

    <tr>
     <td class="coltwo"style="color: black;">Seat</td>
     <td class="coltwo">*</td>
<td class="colthree">
  <select name="Seat" style="width:150%;padding:7px;" >
  <option value="" selected>selected</option>
  <option value="shared">Shared</option>
  <option value="dedicated">Dedicated</option>
  </select></td>
</tr>

  <tr>
    <td class="coltwo" style="color: black;">In case Shared Seat mention ID</td>
    <td class="coltwo"></td>
    <td class="colthree">
      <select name="Seat_shared_ID"style="width:150%;padding:7px;" >
        <option value="">*Select</option> 
     <?php

$gogo = sqlsrv_query( $con1 ,"SELECT  [ID1],[EmpID],[UserName]
      ,[SSMA_TimeStamp]
  FROM [EDB].[dbo].[employess]");
//while($outputs = $checks->fetch_array()){
  while($index = sqlsrv_fetch_array($gogo)){
  $rows = '<option ';
  $rows .= $output['username_id'] == $index['EmpID'] ? "selected" : "";;
  $rows .= 'value="'.$index['EmpID'].'">'.$index['EmpID'].'</option>';
  echo $rows;}?> 
</select>
</tr>
      </td>
        
      </table>
    </td>
  </tr>
</table>
</div>
</div>
</div>
<br>
    <div class="panel panel-default">
      <div class="panel-heading"><a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
        <h4 class="panel-title" style="color: black;">
Certification Informations
     <img src="images/Diploma-PNG.png" style="width:3.7%;float: right;margin-top: -11.5px;" > 
    </h4>
      </div> 
      <div id="collapse6" class="panel-collapse collapse in">
        <div class="panel-body"></a>
<table width="100%" style="border-collapse:collapse;margin-top:2%;">

  <tr>
    <td width="67%">
      <table border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
 <td class="colone">1st Certified</td>
          <td class="colthree"><input class="text" placeholder="Only English letters are allowed" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" name="Certified1" type="text" style="width:49%;"></td>
        </tr>
        <tr>
          <td class="colone">2nd Certified</td>
          <td class="colthree"><input class="text" placeholder="Only English letters are allowed" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" name="Certified2" type="text" style="width:49%;"></td>
        </tr>
        <tr>
          <td class="colone">3rd Certified</td>
          <td class="colthree"><input class="text" placeholder="Only English letters are allowed" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" name="Certified3" type="text" style="width:49%;"></td>
        </tr>
        <tr>
          <td class="colone">4th Certified</td>
          <td class="colthree"><input class="text" placeholder="Only English letters are allowed" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" name="Certified4" type="text" style="width:49%;"></td>
        </tr>
         <tr>
          <td class="colone">5th Certified</td>
          <td class="colthree"><input class="text" placeholder="Only English letters are allowed" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" name="Certified5" type="text" style="width:49%;"></td>
      </tr>
      </td>
        
      </table>
    </td>
  </tr>
</table>
</div>
</div>
</div>
<br>

    <div class="panel panel-default">
      <div class="panel-heading"><a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
        <h4 class="panel-title" style="color: black;">
Attending cources 
      <img src="images/attendance-icon.png" style="width:4%;float: right;margin-top: -10px;" >
    </h4>
      </div> 
      <div id="collapse6" class="panel-collapse collapse in">
        <div class="panel-body"></a>
<table width="100%" style="border-collapse:collapse;margin-top:2%;">

  <tr>
    <td width="67%">
      <table border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
          <td class="colone">1st Cource</td>
          <td class="colthree"><input class="text" name="Attended Courses1" type="text" placeholder="Only English letters are allowed" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" style="width:49%;"></td>
        </tr>
        <tr>
          <td class="colone">2nd Cource</td>
          <td class="colthree"><input class="text" name="Attended Courses2" type="text" placeholder="Only English letters are allowed" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" style="width:49%;"></td>
        </tr>
        <tr>
          <td class="colone">3rd Cource</td>
          <td class="colthree"><input class="text" name="Attended Courses3" type="text" placeholder="Only English letters are allowed" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" style="width:49%;"></td>
        </tr>
        <tr>
          <td class="colone">4th Cource</td>
          <td class="colthree"><input class="text" name="Attended Courses4" type="text" placeholder="Only English letters are allowed" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" style="width:49%;"></td>
        </tr>
         <tr>
          <td class="colone">5th Cource</td>
          <td class="colthree"><input class="text" name="Attended Courses5" type="text" placeholder="Only English letters are allowed" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" style="width:49%;"></td>
      </tr>        
      </table>
    </td>
  </tr>
</table>
</div>
</div>
</div>
<br>

    <div class="panel panel-default">
      <div class="panel-heading"><a data-toggle="collapse" data-parent="#accordion" href="#collapse7">
        <h4 class="panel-title" style="color: black;">
Transfer informations:( in case of transfering from another department.)
          <img src="images/1-89-512.png" style="width:4%;float: right;margin-top: -10px;" >
    </h4>
      </div> 
      <div id="collapse7" class="panel-collapse collapse in">
        <div class="panel-body"></a>
<table width="100%" style="border-collapse:collapse;margin-top:2%;">

  <tr>
    <td width="67%">
      <table border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>
    <td class="colone">Previous Title:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="Tran_Title" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" placeholder="Only English letters are allowed" type="text" style="width:49%;"></td>
  </tr>
 <tr>
    <td class="colone">Grade</td>
        <td class="coltwo"></td>

    <td class="colthree">
      <select name="Tran_Grade"style="width:49%;padding:7px;" >
        <option value="">* Select </option>
        <option value="L8">L8</option>
        <option value="L7">L7</option>
        <option value="L6">L6</option>
        <option value="L5">L5</option>
        <option value="L4">L4</option>
        <option value="L3">L3</option>
        <option value="L2">L2</option>
 
</select>
</td></tr>
  <tr>
    <td class="colone">Manager Name:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="Tran_Manager" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" placeholder="Only English letters are allowed" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">Department:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="Tran_Department" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" placeholder="Only English letters are allowed" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">Unit:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="Tran_Unit" pattern="[a-zA-Z0-9$@$!%*?&#^-_. +]+$" placeholder="Only English letters are allowed" type="text" style="width:49%;"></td>
     </tr>
        
      </table>
    </td>
  </tr>
</table>
</div>
</div>
</div>
<br>
    <div class="panel panel-default">
      <div class="panel-heading"><a data-toggle="collapse" data-parent="#accordion" href="#collapse8">
        <h4 class="panel-title" style="color: black;">
Computer Spec. Informations:
              <img src="images/computer.png" style="width:3.5%;float: right;margin-top: -10px;" > 
    </h4>
      </div> 
      <div id="collapse8" class="panel-collapse collapse in">
        <div class="panel-body"></a>
<table width="100%" style="border-collapse:collapse;margin-top:2%;">

  <tr>
    <td width="67%">
      <table border="0" cellspacing="0" cellpadding="2" width="100%">
  <tr>
    <td class="colone">Computer Name:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input name="ComputerName" type="text" style="width:49%;" required></td>
  </tr><tr>
    <td class="colone">Domain UserName:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input name="DomainUserName" type="text" style="width:49%;" required></td>
  </tr>
  <tr>
    <td class="colone">Computer Type:</td>
    <td class="coltwo">*</td>
    <td class="colthree">
      <select name="Computer_type"style="width:49%;padding:7px;" required >
        <option value="">* Select </option>
        <option value="Desktop">Desktop</option>
        <option value="Laptop">Laptop</option>
      </select></tr>
    </td>
  <tr>
    <?php   
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

$ip = getUserIpAddr();
?>
    <td class="colone">Computer IP:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="Computer_IP" value="<?php echo $ip; ?>" disabled style="width:49%;" ></td>
  </tr>

<tr>
 <td class="colone">Processor Name:</td>

    <td class="coltwo">*</td>
    <td class="colthree">
      <select name="Processor"style="width:49%;padding:7px;" required>
      <option value="">* Select</option> 
     <?php
$gogo = sqlsrv_query( $con1 ,"SELECT [ID]
      ,[Processors]
      ,[Field1]
  FROM [EDB].[dbo].[Processors]");
//while($outputs = $checks->fetch_array()){
  while($index = sqlsrv_fetch_array($gogo)){
  $rows = '<option ';
  $rows .= $output['id'] == $index['ID'] ? "selected" : "";;
  $rows .= 'value="'.$index['Processors'].'">'.$index['Processors'].'</option>';
  echo $rows;}?> 
</select>
    </td>
  </tr>

<tr>
    <td class="colone">Ram:</td>
    <td class="coltwo">*</td>
    <td class="colthree">
      <select name="Ram"style="width:49%;padding:7px;" required>
        <option value="">* Select </option>
        <option value="1GB">1GB</option>
        <option value="2GB">2GB</option>
        <option value="4GB">4GB</option>
        <option value="5GB">5GB</option>
        <option value="6GB">6GB</option>
        <option value="7GB">7GB</option>
        <option value="8GB">8GB</option>
        <option value="9GB">9GB</option>
        <option value="10GB">10GB</option>
        <option value="11GB">11GB</option>
        <option value="12GB">12GB</option>
        <option value="13GB">13GB</option>
        <option value="14GB">14GB</option>
        <option value="15GB">15GB</option>
        <option value="16GB">16GB</option>
        <option value="32GB">32GB</option>
      </select></tr>
    </td>

  <tr>
    <td class="colone">Windows:</td>
   <td class="coltwo">*</td>
    <td class="colthree">
      <select name="Operation_System"style="width:49%;padding:7px;" required>
        <option value="">* Select </option>
        <option value="Windows XP">Windows XP</option>
        <option value="Windows vista">Windows vista</option>
        <option value="Windows 7">Windows 7</option>
        <option value="Windows 8">Windows 8</option>
        <option value="Windows 8.1">Windows 8.1</option>
        <option value="Windows 10">Windows 10</option>
      </select></tr>
    </td>
  <tr>
    <td class="colone">VPN-IP:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input name="VPN-IP" type="text" style="width:49%;"required></td>
  </tr>
  <tr>
    <td class="colone">Shared or Not Shared:</td>
     <td class="coltwo">*</td>
    <td class="colthree">
      <select name="Shared_or_Not_Shared"style="width:49%;padding:7px;" required>
        <option value="">* Select </option>
        <option value="Shared">Shared</option>
        <option value="No">No</option>
      </select>
    </td>
    </tr>
  <tr>
    <td class="colone">USB console:</td>
    <td class="coltwo">*</td>
      <td class="colthree">
      <select name="USB_console"style="width:49%;padding:7px;" required>
        <option value="">* Select </option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>
     </tr>
      </td>
        
      </table>
    </td>
  </tr>
</table>
</div>
</div>
</div>
<br>
    <div class="panel panel-default">
      <div class="panel-heading"><a data-toggle="collapse" data-parent="#accordion" href="#collapse9">
        <h4 class="panel-title"style="color: black;">
Avaya informations:<img src="images/avaya.png" style="width:4%;float: right;margin-top: -10px;" > 
    </h4>
      </div> 
      <div id="collapse9" class="panel-collapse collapse in">
        <div class="panel-body"></a>

<table width="100%" style="border-collapse:collapse;margin-top:2%;">

  <tr>
    <td width="67%">
      <table border="0" cellspacing="0" cellpadding="2" width="100%">
  <tr>
    <td class="colone">Avaya Extention:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input name="Avaya_Extention" type="number" style="width:49%;" required></td>
  </tr>
  <tr>
    <td class="colone">Avaya Login:</td>
    <td class="coltwo">*</td>
    <td class="colthree"><input name="Avaya_Login" type="number" style="width:49%;" required></td>
  </tr>

  <tr>
    <td class="colone">Avaya Mac:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="avaya_Mac" type="text" style="width:49%;" ></td>
  </tr>
  <tr>
    <td class="colone">Avaya Serial:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="avaya_Serial" type="text" style="width:49%;" ></td>
  </tr>

  <tr>
    <td class="colone">Have a Headset:</td>
    <td class="coltwo">*</td>
      <td class="colthree">
      <select name="Avaya_Headset"style="width:49%;padding:7px;" required>
        <option value="">* Select </option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select></tr>
    </td>

 <tr>
    <td class="colone">Avaya Soft/Hard:</td>
    <td class="coltwo">*</td>
      <td class="colthree">
      <select name="Avaya_Soft_hard"style="width:49%;padding:7px;" required>
        <option value="">* Select </option>
        <option value="Yes">Soft</option>
        <option value="Hard">Hard</option>
      </select>
           </tr>
      </td>
        
      </table>
    </td>
  </tr>
</table>
</div>
</div>
</div>
<br>
    <div class="panel panel-default">
      <div class="panel-heading"><a data-toggle="collapse" data-parent="#accordion" href="#collapse10">
<h4 class="panel-title"style="color: black;">
    Applications username:<img src="images/avatar-circle.png" style="width:3.5%;float: right;margin-top: -10px;" >
    </h4>
      </div> 
      <div id="collapse10" class="panel-collapse collapse in">
        <div class="panel-body"></a>

<table width="100%" style="border-collapse:collapse;margin-top:2%;">

  <tr>
    <td width="67%">
      <table border="0" cellspacing="0" cellpadding="2" width="100%">
  <tr>
    <td class="colone">PSD:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="PSD_user" type="text" style="width:49%;"></td>
  </tr><tr>
    <td class="colone">PSC:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="PSC_user" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">TACACS:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="MRTG_user" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">VRF_VLAN_portal:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="VRF_VLAN_portal_Username" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">MSAN_portal_Username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="MSAN_portal_Username" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">EPM_Portal_Username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="EPM_Portal_Username" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">Matrix username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="Matrix_Username" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">EMS username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="EMS_Username" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">ECRM username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="ECRM_Username" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">Ematrix username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="Ematrix_Username" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">UNMS username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="UNMS_Username" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">NOMS username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="NOMS_Username" type="text" style="width:49%;"></td>
  </tr>

  <tr>
    <td class="colone">CMS configuration:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="CMS_Configuration_Automation_Username" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">OGS username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="OGS_Username" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">IP server username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="IP_Server_Username" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">Shared folder username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="Shared_Folder_Username" type="text" style="width:49%;"></td>
  </tr>
  <tr>
    <td class="colone">Orecle username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="Oracle_Username" type="text" style="width:49%;"></td>
  </tr><tr>
    <td class="colone">Attendance username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="Attendance_Username" type="text" style="width:49%;"></td>
  </tr><tr>
    <td class="colone">ITHelp desk username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="ITHelp_desk_Username" type="text" style="width:49%;"></td>
  </tr><tr>
    <td class="colone">Aterm username:</td>
    <td class="coltwo"></td>
    <td class="colthree"><input name="Aterm_Username" type="text" style="width:49%;"></td>
     </tr>
      </td>
        
      </table>
    </td>
  </tr>
</table>
</div>
</div>
</div>
<br>
    <div class="panel panel-default">
      <div class="panel-heading">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse11">
        <h4 class="panel-title"style="color: black;">
        TE entry permit 
<img src="images/corporation.png" style="width:3.5%;float: right;margin-top: -10px;" >
    </h4>
      </div> 
      <div id="collapse11" class="panel-collapse collapse in">
        <div class="panel-body"></a>

<table width="100%" style="border-collapse:collapse;margin-top:2%;">
  <tr>
    <td width="67%">
      <table border="0" cellspacing="0" cellpadding="2" width="100%">
        <tr>

          <td class="colone">TE Entyr Permit Number</td>
          <td class="colthree"><input class="text" name="TE_Entry_Permit" type="text" style="width:49%;"></td>
        </tr>
        <tr>
          <td class="colone">TE Entry Permit Expiration Date</td>
          <td class="colthree"><input class="date" name="TE_Entry_Permit_Expiration_Date" type="date" style="width:49%;"></td>
       </tr>
      </td>
        
      </table>
    </td>
  </tr>
</table>
</div>
</div>
</div>

<hr>
 <!--tr>
    <td colspan="5" align="center" style="color: black;background-color: lightgray;">
      Thank You for taking the time to fill in all the information.<br />
      To Submit your information for consideration, click the SUBMIT Button below.<br />
      <p><input type="submit" value="Submit your information" name="send" style="background-color: tomato;color: #eee;width: 30%;"></p>
    </td>
</tr-->
</table>
<br>
<div class="input-group-btn col-md-6" >
  <p>Thank You for taking the time to fill in all the information.<br />
      To Submit your information for consideration, click the SUBMIT Button below.<br />
    </p>
      <button class="btn btn-primary col-md-6"type='submit' id="mySubmit" name='send'
 value="Submit your information" >Submit</button></div>
<br>

<?php
$DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "EDB";
  $connectionInfo = array( "Database"=>"EDB" , "UID"=>"Seniors" , "PWD"=>"123456789");
if(isset($_POST['send'])){

$Creation_time = date ("Y-m-d H:i:s");
if(isset($_POST['ID'])){$ID = $_POST['ID'];}
if(isset($_POST['Employee_Name'])){$Employee_Name = $_POST['Employee_Name'];}
if(isset($_POST['Employee_Type'])){$Employee_Type = $_POST['Employee_Type'];}
if(isset($_POST['Current_Title'])){$Current_Title = $_POST['Current_Title'];}
if(isset($_POST['Manager_Name'])){$Manager_Name = $_POST['Manager_Name'];}
if(isset($_POST['Hiring_Date'])){$Hiring_Date = $_POST['Hiring_Date'];}
if(isset($_POST['National_ID'])){$National_ID = $_POST['National_ID'];}
if(isset($_POST['National_ID_Expiration_date'])){$National_ID_Expiration_date = $_POST['National_ID_Expiration_date'];}
if(isset($_POST['Operation_date'])){$Operation_date = $_POST['Operation_date'];}
if(isset($_POST['UserName'])){$UserName = $_POST['UserName'];}
if(isset($_POST['Mobile_Number'])){$Mobile_Number = $_POST['Mobile_Number'];}
if(isset($_POST['E-mail'])){$E_mail = $_POST['E-mail'];}
if(isset($_POST['Birth_Date'])){$Birth_Date = $_POST['Birth_Date'];}
if(isset($_POST['Address'])){$Address = $_POST['Address'];}
if(isset($_POST['Full_Address'])){$Full_Address = $_POST['Full_Address'];}
if(isset($_POST['Home_Tel'])){$Home_Tel = $_POST['Home_Tel'];}
if(isset($_POST['Department'])){$Department = $_POST['Department'];}
if(isset($_POST['Unit'])){$Unit = $_POST['Unit'];}
if(isset($_POST['Location'])){$Location = $_POST['Location'];}
if(isset($_POST['Floor'])){$Floor = $_POST['Floor'];}
if(isset($_POST['Education_Qualifications'])){$Education_Qualifications = $_POST['Education_Qualifications'];}
if(isset($_POST['Senior_Promotion'])){$Senior_Promotion = $_POST['Senior_Promotion'];}
if(isset($_POST['Supervisor_Promotion'])){$Supervisor_Promotion = $_POST['Supervisor_Promotion'];}
if(isset($_POST['SectionHead_Promotion'])){$SectionHead_Promotion = $_POST['SectionHead_Promotion'];}
if(isset($_POST['UnitManager_Promotion'])){$UnitManager_Promotion = $_POST['UnitManager_Promotion'];}
if(isset($_POST['Gender'])){$Gender = $_POST['Gender'];}
if(isset($_POST['Employee_Medical_ID'])){$Employee_Medical_ID = $_POST['Employee_Medical_ID'];}
if(isset($_POST['Wife_Medical_ID'])){$Wife_Medical_ID = $_POST['Wife_Medical_ID'];}
if(isset($_POST['C1_Medical_ID'])){$C1_Medical_ID = $_POST['C1_Medical_ID'];}
if(isset($_POST['C2_Medical_ID'])){$C2_Medical_ID = $_POST['C2_Medical_ID'];}
if(isset($_POST['C3_Medical_ID'])){$C3_Medical_ID = $_POST['C3_Medical_ID'];}
if(isset($_POST['ComputerName'])){$ComputerName = $_POST['ComputerName'];}
if(isset($_POST['DomainUserName'])){$DomainUserName = $_POST['DomainUserName'];}
if(isset($_POST['Computer_type'])){$Computer_type = $_POST['Computer_type'];}
if(isset($_POST['Computer_IP'])){$$ip = $_POST['Computer_IP'];}
if(isset($_POST['Processor'])){$Processor = $_POST['Processor'];}
if(isset($_POST['Ram'])){$Ram = $_POST['Ram'];}
if(isset($_POST['Operation_System'])){$Operation_System = $_POST['Operation_System'];}
if(isset($_POST['VPN-IP'])){$VPN_IP = $_POST['VPN-IP'];}
if(isset($_POST['Avaya_Login'])){$Avaya_Login = $_POST['Avaya_Login'];}
if(isset($_POST['Avaya_Extention'])){$Avaya_Extention = $_POST['Avaya_Extention'];}
if(isset($_POST['Avaya_Headset'])){$Avaya_Headset = $_POST['Avaya_Headset'];}
if(isset($_POST['Avaya_Soft_hard'])){$Avaya_Soft_hard = $_POST['Avaya_Soft_hard'];}
if(isset($_POST['Grade'])){$Grade = $_POST['Grade'];}
if(isset($_POST['Tran_Title'])){$Tran_Title = $_POST['Tran_Title'];}
if(isset($_POST['Tran_Grade'])){$Tran_Grade = $_POST['Tran_Grade'];}
if(isset($_POST['Tran_Manager'])){$Tran_Manager = $_POST['Tran_Manager'];}
if(isset($_POST['Tran_Department'])){$Tran_Department = $_POST['Tran_Department'];}
if(isset($_POST['Tran_Unit'])){$Tran_Unit = $_POST['Tran_Unit'];}
if(isset($_POST['Certified1'])){$Certified1 = $_POST['Certified1'];}
if(isset($_POST['Certified2'])){$Certified2 = $_POST['Certified2'];}
if(isset($_POST['Certified3'])){$Certified3 = $_POST['Certified3'];}
if(isset($_POST['Certified4'])){$Certified4 = $_POST['Certified4'];}
if(isset($_POST['Certified5'])){$Certified5 = $_POST['Certified5'];}
if(isset($_POST['PSD_user'])){$PSD_user = $_POST['PSD_user'];}
if(isset($_POST['PSC_user'])){$PSC_user = $_POST['PSC_user'];}
if(isset($_POST['MRTG_user'])){$MRTG_user = $_POST['MRTG_user'];}
if(isset($_POST['Attended_Courses1'])){$Attended_Courses1 = $_POST['Attended_Courses1'];}
if(isset($_POST['Attended_Courses2'])){$Attended_Courses2 = $_POST['Attended_Courses2'];}
if(isset($_POST['Attended_Courses3'])){$Attended_Courses3 = $_POST['Attended_Courses3'];}
if(isset($_POST['Attended_Courses4'])){$Attended_Courses4 = $_POST['Attended_Courses4'];}
if(isset($_POST['Attended_Courses5'])){$Attended_Courses5 = $_POST['Attended_Courses5'];}
if(isset($_POST['TE_Entry_Permit'])){$TE_Entry_Permit = $_POST['TE_Entry_Permit'];}
if(isset($_POST['TE_Entry_Permit_Expiration_Date'])){$Expiration_Date = $_POST['TE_Entry_Permit_Expiration_Date'];}
if(isset($_POST['Shared_or_Not_Shared'])){$Shared_or_Not_Shared = $_POST['Shared_or_Not_Shared'];}
if(isset($_POST['faculty'])){$faculty = $_POST['faculty'];}
if(isset($_POST['Major'])){$Major = $_POST['Major'];}
if(isset($_POST['Year_of_Graduation'])){$Year_of_Graduation = $_POST['Year_of_Graduation'];}
if(isset($_POST['Address_2'])){$Address_2 = $_POST['Address_2'];}
if(isset($_POST['Mobile_2'])){$Mobile_2 = $_POST['Mobile_2'];}
if(isset($_POST['Seat'])){$Seat = $_POST['Seat'];}
if(isset($_POST['Room_num'])){$Room_num = $_POST['Room_num'];}
if(isset($_POST['Mobile_Allowance'])){$Mobile_Allowance = $_POST['Mobile_Allowance'];}
if(isset($_POST['Transportation_allowance_package'])){$allowance_package = $_POST['Transportation_allowance_package'];}
if(isset($_POST['USB_console'])){$USB_console = $_POST['USB_console'];}
if(isset($_POST['Aterm_Username'])){$Aterm_Username = $_POST['Aterm_Username'];}
if(isset($_POST['VRF_VLAN_portal_Username'])){$VRF_VLAN_portal_Username = $_POST['VRF_VLAN_portal_Username'];}
if(isset($_POST['MSAN_portal_Username'])){$MSAN_portal_Username = $_POST['MSAN_portal_Username'];}
if(isset($_POST['EPM_Portal_Username'])){$EPM_Portal_Username = $_POST['EPM_Portal_Username'];}
if(isset($_POST['Matrix_Username'])){$Matrix_Username = $_POST['Matrix_Username'];}
if(isset($_POST['EMS_Username'])){$EMS_Username = $_POST['EMS_Username'];}
if(isset($_POST['ECRM_Username'])){$ECRM_Username = $_POST['ECRM_Username'];}
if(isset($_POST['Ematrix_Username'])){$Ematrix_Username = $_POST['Ematrix_Username'];}
if(isset($_POST['UNMS_Username'])){$UNMS_Username = $_POST['UNMS_Username'];}
if(isset($_POST['NOMS_Username'])){$NOMS_Username = $_POST['NOMS_Username'];}
if(isset($_POST['CMS_Configuration_Automation_Username'])){$Automation_Username = $_POST['CMS_Configuration_Automation_Username'];}
if(isset($_POST['OGS_Username'])){$OGS_Username = $_POST['OGS_Username'];}
if(isset($_POST['IP_Server_Username'])){$IP_Server_Username = $_POST['IP_Server_Username'];}
if(isset($_POST['Shared_Folder_Username'])){$Shared_Folder_Username = $_POST['Shared_Folder_Username'];}
if(isset($_POST['Oracle_Username'])){$Oracle_Username = $_POST['Oracle_Username'];}
if(isset($_POST['Attendance_Username'])){$Attendance_Username = $_POST['Attendance_Username'];}
if(isset($_POST['ITHelp_desk_Username'])){$ITHelp_desk_Username = $_POST['ITHelp_desk_Username'];}
if(isset($_POST['Seat_shared_ID'])){$Seat_shared_ID = $_POST['Seat_shared_ID'];}
if(isset($_POST['avaya_Mac'])){$avaya_Mac = $_POST['avaya_Mac'];}
if(isset($_POST['avaya_Serial'])){$avaya_Serial = $_POST['avaya_Serial'];}

 //$escaped = $_POST['wfm_note']; $wfm_note = str_replace("'", "''", $escaped);

// استخدام prepared statement لتجنب SQL injection
$query = "SELECT ISNULL((SELECT [ID] FROM [EDB].[dbo].[Employess_DB] WHERE [ID] = ?), 'nothing') AS resultt";
$params = array($ID);
$stmt = sqlsrv_query($con, $query, $params);

// التحقق من النتيجة
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$error = sqlsrv_fetch_array($stmt);
$results = $error['resultt'];

if ($results !== 'nothing') {
    echo '<script>
            swal({
                title: "Data already exists",
                icon: "error",
            });
          </script>';
    echo "Data already exists";
} else {
    echo '<script>
            document.getElementById("mySubmit").disabled = true;
          </script>';


/////  Resignation role
  // $error_query = sqlsrv_query( $con ,"SELECT ISNULL((SELECT [ID]  
  // FROM [EDB].[dbo].[Employess_DB]
  // where [ID] = '$ID' ),'nothing') resultt");
    
  //     $error=sqlsrv_fetch_array($error_query);
  //     $results= $error['resultt'];
     
  // if($results !=='nothing'){
  //   echo '<script>
  //       swal({
  //       title: "Data already exists",
  //     icon: "error",
  //     })
  //    </script>';
  //    echo "Data already exists";

  // }if($results == 'nothing'){
  //  echo '<script>
  //   function myFunction() {
  //     document.getElementById("mySubmit").disabled = true;
  //   }
  //   </script>';


  $insert_query = sqlsrv_query( $con1 ,"INSERT INTO [EDB].[dbo].[Employess_DB]

    ( [ID],[Employee_Name],[Employee_Type],[Current_Title],[Manager_Name],[Hiring_Date],
      [National_ID],[National_ID_Expiration_date],[Operation_date],[UserName]
      ,[Mobile_Number],[E-mail],[Birth_Date],[Address],[Full_Address]
      ,[Home_Tel],[Department],[Unit],[Location],[Floor]
      ,[Education_Qualifications],[Senior_Promotion],[Supervisor_Promotion],[SectionHead_Promotion]
      ,[UnitManager_Promotion],[Gender],[Employee_Medical_ID],[Wife_Medical_ID]
      ,[C1_Medical_ID],[C2_Medical_ID],[C3_Medical_ID],[ComputerName],[DomainUserName]
      ,[Computer_type],[Computer_IP],[Processor],[Ram],[Operation_System],[VPN-IP]
      ,[Avaya_Login],[Avaya_Extention],[Avaya_Headset],[Avaya_Soft_hard],[Grade]
      ,[Tran_Title],[Tran_Grade],[Tran_Manager],[Tran_Department],[Tran_Unit]
      ,[Certified1],[Certified2],[Certified3],[Certified4],[Certified5]
      ,[PSD_user],[PSC_user],[MRTG_user],[Creation_time],[Attended_Courses1]
      ,[Attended_Courses2],[Attended_Courses3],[Attended_Courses4],[Attended_Courses5],[TE_Entry_Permit]
      ,[TE_Entry_Permit_Expiration_Date],[Shared_or_Not_Shared]
    ,[faculty],[Major],[Year_of_Graduation],[Address_2],[Mobile_2],[Seat]
      ,[Room_num],[Mobile_Allowance],[Transportation_allowance_package],[USB_console]
      ,[Aterm_Username],[VRF_VLAN_portal_Username]
      ,[MSAN_portal_Username],[EPM_Portal_Username],[Matrix_Username],[EMS_Username]
      ,[ECRM_Username],[Ematrix_Username],[UNMS_Username],[NOMS_Username]
      ,[CMS_Configuration_Automation_Username],[OGS_Username],[IP_Server_Username]
      ,[Shared_Folder_Username],[Oracle_Username],[Attendance_Username]

      ,[ITHelp_desk_Username],[Seat_shared_ID],[avaya_Mac],[avaya_Serial] )
     VALUES
     ('$ID', '$Employee_Name' , '$Employee_Type' , '$Current_Title' , '$Manager_Name' ,
      '$Hiring_Date' , '$National_ID', '$National_ID_Expiration_date' 
    , '$Operation_date' , '$UserName' , '$Mobile_Number','$E_mail','$Birth_Date'
    , '$Address' , '$Full_Address' , '$Home_Tel' 
    , '$Department' , '$Unit' , '$Location' 
    , '$Floor' , '$Education_Qualifications' , '$Senior_Promotion' 
    , '$Supervisor_Promotion' , '$SectionHead_Promotion' , '$UnitManager_Promotion' 
    , '$Gender' , '$Employee_Medical_ID' , '$Wife_Medical_ID' 
    , '$C1_Medical_ID' , '$C2_Medical_ID' , '$C3_Medical_ID' 
    , '$ComputerName' , '$DomainUserName' , '$Computer_type' 
    , '$ip' , '$Processor' , '$Ram' 
    , '$Operation_System' , '$VPN_IP' , '$Avaya_Login' 
    , '$Avaya_Extention' , '$Avaya_Headset' , '$Avaya_Soft_hard', '$Grade' 
    , '$Tran_Title' , '$Tran_Grade' , '$Tran_Manager' , '$Tran_Department' 
    , '$Tran_Unit' , '$Certified1' , '$Certified2' , '$Certified3' 
    , '$Certified4' , '$Certified5' , '$PSD_user' , '$PSC_user' 
    , '$MRTG_user' , '$Creation_time' , '$Attended_Courses1' , '$Attended_Courses2' 
    , '$Attended_Courses3' , '$Attended_Courses4' , '$Attended_Courses5' , '$TE_Entry_Permit' 
    , '$Expiration_Date' , '$Shared_or_Not_Shared' , '$faculty' , '$Major' 
    , '$Year_of_Graduation' , '$Address_2' , '$Mobile_2' , '$Seat' 
    , '$Room_num' , '$Mobile_Allowance' , '$allowance_package' , '$USB_console' 
    , '$Aterm_Username' , '$VRF_VLAN_portal_Username' , '$MSAN_portal_Username' , '$EPM_Portal_Username' 
    , '$Matrix_Username' , '$EMS_Username' , '$ECRM_Username' , '$Ematrix_Username' 
    , '$UNMS_Username' , '$NOMS_Username' , '$Automation_Username' , '$OGS_Username' 
    , '$IP_Server_Username' , '$Shared_Folder_Username' , '$Oracle_Username' , '$Attendance_Username' 
    , '$ITHelp_desk_Username' , '$Seat_shared_ID','$avaya_Mac' ,'$avaya_Serial' )");
if($insert_query){
  echo '<script>
    swal({
    title: "Your Data has been added",
  icon: "success",
  })
     </script>';
 }
}

}
?>

</div></div></div></div>
</table>

</form>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="jQuery/jquery-2.2.4.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="bootstrap.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="jQuery/jquery-2.2.4.js"></script>
<script type="text/javascript">
  import * as $ from 'jquery';
   //  $(function() {
   //    open_panel_count = <%= START_COLLAPSED %> ? 0 : $(".panel-collapse").length;
   //    function update_toggle_button() { 
   //      $('#toggle-btn').text((open_panel_count ? "Collapse" : "Expand") + " All")
   //    }
   //    update_toggle_button(); // Run once on page load to text #toggle-btn


   //    $('.panel-collapse').collapse({
   //      toggle: false
   //    });

   //    $('#toggle-btn').click(function() {
   //      $('.panel-collapse').collapse(open_panel_count ? 'hide' : 'show');
   //    });

   //    $('.panel-collapse').on('shown.bs.collapse', function () {
   //      open_panel_count++;
   //      update_toggle_button();
   //    });

   //    $('.panel-collapse').on('hidden.bs.collapse', function () {
   //      open_panel_count--;
   //      update_toggle_button();
   //    });
   // });
  </script>
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
<!-- 
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
 -->

<?php 

  include("footer.html");
?>
