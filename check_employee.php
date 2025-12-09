
<?php
// check_employee.php
require_once("inc/config.inc"); // Include your database connection
// Initialize variables with default values to prevent 'undefined' notices
$Request_Type = isset($_POST['Request_Type']) ? $_POST['Request_Type'] : '';

$Employee_Username = isset($_POST['Employee_Username']) ? $_POST['Employee_Username'] : '';

// Check if the employee username is provided
if (isset($_POST['Employee_Username'])) {
    $Employee_Username = $_POST['Employee_Username'];

    // Perform the query to check if the employee is outsourced
    $error_query = sqlsrv_query($con, "SELECT ISNULL(
        (SELECT UserName FROM [Employess_DB].[dbo].[tbl_Personal_info]
         WHERE UserName = '$Employee_Username' AND Employee_Type = 'outsource'), 
         'nothing') AS resultt");
     $error=sqlsrv_fetch_array($error_query);
     $results= $error['resultt'];
     echo $error['resultt'];

 // echo"SELECT ISNULL(
 //        (SELECT UserName FROM [Employess_DB].[dbo].[tbl_Personal_info]
 //         WHERE UserName = '$Employee_Username' AND Employee_Type = 'outsource'), 'nothing') AS resultt";
    

}
?>
