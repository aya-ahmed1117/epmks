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
    

sqlsrv_query( $conT , "SET NAMES 'utf8'"); 
sqlsrv_query( $conT ,'SET CHARACTER SET utf8' );

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
/*
// Database Structure 
CREATE TABLE 'employee' (
 'name' text NOT NULL,
 'age' text NOT NULL,
 'country' text NOT NULL,
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1
*/
if(isset($_POST["submit_file"]))
{
 $file = $_FILES["file"]["tmp_name"];
 $file_open = fopen($file,"r");
 while(($csv = fgetcsv($file_open, 105000, ",")) !== false)
 {
 echo $ID = $csv[0];

 echo $name = $csv[1];
  echo$age = $csv[2];
  echo$country = $csv[3];
  $insert = sqlsrv_query($conT,"INSERT INTO [tranning_Database].[dbo].[submit_file] 
  	([ID],[name],[age],[country])
  	VALUES 
  	('$ID','$name','$age','$country')");
  if($insert){
	$view = sqlsrv_query($conT ,"SELECT * from 
		[tranning_Database].[dbo].[submit_file] ");
 $outputs = sqlsrv_fetch_array($view);
    echo $IDss = $outputs['ID'];
    echo $names = $outputs['name'];
    echo $ages = $outputs['age'];
    echo $countries = $outputs['country'];

}

 }
}

?> 
<?php
//include 'db.php';
/*if(isset($_POST["Imsubmit_fileport"])){
 
 
		echo $filename=$_FILES["file"]["tmp_name"];
 
 
		 if($_FILES["file"]["size"] > 0)
		 {
 
		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
 
	          //It wiil insert a row to our subject table from our csv file`
	           $sql = "INSERT into subject (`SUBJ_CODE`, `SUBJ_DESCRIPTION`, `UNIT`, `PRE_REQUISITE`,COURSE_ID, `AY`, `SEMESTER`) 
	            	values('$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]','$emapData[7]')";
	         //we are using mysql_query function. it returns a resource on true else False on error
	          $result = sqlsrv_query( $conT, $sql );
				if(! $result )
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"import_file.php\"
						</script>";
 
				}
 
	         }
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
 
 
 
			 //close of connection
			mysqli_close($conn); 
 
 
 
		 }
	}	*/ 
?>
<!-- <?php
//$connect = mysqli_connect("localhost", "root", "", "test");
$output = '';
if(isset($_POST["import"]))
{
 $extension = end(explode(".", $_FILES["excel"]["name"])); // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  include("PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

  $output .= "<label class='text-success'>Data Inserted</label><br /><table class='table table-bordered'>";
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   for($row=2; $row<=$highestRow; $row++)
   {
    $output .= "<tr>";
    $name = sqlsrv_real_escape_string($conT, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $email = sqlsrv_real_escape_string($conT, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    $query = "INSERT INTO [tranning_Database].[dbo].[submit_file] VALUES ('".$name."', '".$email."')";
    sqlsrv_query($conT, $query);
    $output .= '<td>'.$name.'</td>';
    $output .= '<td>'.$email.'</td>';
    $output .= '</tr>';
   }
  } 
  $output .= '</table>';

 }
 else
 {
  $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
 }
}
?>

<html>
 <head>
  <title>Import Excel to Mysql using PHPExcel in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:700px;
   border:1px solid #ccc;
   background-color:#fff;
   border-radius:5px;
   margin-top:100px;
  }
  
  </style>
 </head>
 <body>
  <div class="container box">
   <h3 align="center">Import Excel to Mysql using PHPExcel in PHP</h3><br />
   <form method="post" enctype="multipart/form-data">
    <label>Select Excel File</label>
    <input type="file" name="excel" />
    <br />
    <input type="submit" name="import" class="btn btn-info" value="Import" />
   </form>
   <br />
   <br />
   <?php
   echo $output;
   ?>
  </div>
 </body>
</html> -->