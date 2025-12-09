

<?php
session_start();
date_default_timezone_set('Africa/Cairo');

  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "tranning_Database";
  $CharacterSet = "UTF-8";

  
  $connectionInfo = array( "Database"=>$DBname , "UID"=>"Seniors" ,"CharacterSet" => "UTF-8", "PWD"=>"123456789");
  $conT = sqlsrv_connect($DBhost, $connectionInfo);
 

?>


<html>
<body>
<div id="wrapper">
 <form method="post"  enctype="multipart/form-data">
  <input type="file" name="file"/>
  <input type="submit" name="submit_file" value="Submit"/>
 </form>
</div>
</body>
</html>



<?php

if(isset($_POST["submit_file"]))
{
  $file = $_FILES["file"]["tmp_name"];
  $csvFile = fopen($file, 'r');

    if ($csvFile !== false) {
    $dataArray = array();
    $columns = fgetcsv($csvFile);
    while (($data = fgetcsv($csvFile)) !== false) {
        $row = array(); 
      
        foreach ($columns as $index => $columnName) {
            $row[$columnName] = $data[$index];
        }

        $dataArray[] = $row;
    //print_r(count($dataArray));

    //foreach ($dataArray as $row) {
       $keys = implode(", ", array_map(function ($key) {
        return "[$key]";
      }, array_keys($row)));

      // $values = implode(", ", array_map(function($value){
      //   return "'$value'";
/*
       $values = implode(",", array_map(function($value){
        return "'".str_replace(" ' ", "`",$value)."'";

      },array_values($row)));*/
      $values = implode(",", array_map(function($value){
        return "'" . str_replace("'", "`", $value) . "'";
        }, array_values($row)));


      $q = "INSERT INTO
       [tranning_Database].[dbo].[EPM] (" . $keys . ") VALUES (". $values ." )";
      $result = sqlsrv_query($conT, $q);
     
         //svar_dump($q);
    // }

    // print_r($dataArray);
    // print_r($keys);
     //print_r($dataArray);
    echo "</pre>";
    }
    fclose($csvFile);

    echo "<pre>";

    } else {
    echo "Failed to open the CSV file.";
    }
 }
 
?> 
