<?php 
require_once("inc/config.inc");
$Requester_username = $_SESSION['username'];
$engineer_id = $_SESSION['id'];
$Creation_time = date("Y-m-d H:i:s");

if(isset($_POST['Employee_ID'])) { $Employee_new_id = $_POST['Employee_ID']; }
if(isset($_POST['Last_working_day'])) { $Last_working_date = $_POST['Last_working_day']; }
if(isset($_POST['Reason_of_leave'])) { $Reason_of_leave = $_POST['Reason_of_leave']; }

$insertqry2 = sqlsrv_query($con, "
    INSERT INTO [Aya_Web_APP].[dbo].[schedule_demo] 
    SELECT *, '$Creation_time', '$engineer_id', '$Requester_username', ' ' 
    FROM schedule_table 
    WHERE engineer_id = '$Employee_new_id' AND schedule_date >= '$Last_working_date'
");

$user_check_query = sqlsrv_query($con1, "SELECT UserName FROM tbl_Personal_info WHERE ID = '$Employee_new_id'");
$user_data = sqlsrv_fetch_array($user_check_query);

if (!$user_data || empty($user_data['UserName'])) {
    echo "no_user";
    exit;
}


$error_query = sqlsrv_query($con, "SELECT [User_Name] FROM [Employess_DB].[dbo].[Resignation_Table] WHERE [Employee_ID] = '$Employee_new_id' AND [Status] = 'Confirmed'");
$error = sqlsrv_fetch_array($error_query);

if ($error && !empty($error['User_Name'])) {
    echo "exists"; 
        exit;
}




// $error_query = sqlsrv_query($con1, "
//     SELECT ISNULL(
//         (SELECT [User_Name] FROM [Employess_DB].[dbo].[Resignation_Table] 
//          WHERE [Employee_ID] = '$Employee_new_id' AND [Status] = 'Confirmed'),
//     'nothing') AS resultt
// ");

// $error = sqlsrv_fetch_array($error_query);
// $results = $error['resultt'];

// if ($results != 'nothing') {
//     echo "exists";
//     exit;
// }

$insert_query = sqlsrv_query($con1, "
    INSERT INTO [Employess_DB].[dbo].[Resignation_Table]
    (
        [Employee_ID], [User_Name], [Last_working_day], [Hiring_date], [Reason_of_leave],
        [Employee_Type], [Employee_Manager], [Department], [unit], [Created_User], [Date_time], [Status]
    )
    VALUES
    (
        '$Employee_new_id',
        (SELECT UserName FROM tbl_Personal_info WHERE ID = '$Employee_new_id'),
        '$Last_working_date',
        (SELECT [Hiring_Date] FROM tbl_Personal_info WHERE ID = '$Employee_new_id'),
        '$Reason_of_leave',
        (SELECT Employee_Type FROM tbl_Personal_info WHERE ID = '$Employee_new_id'),
        (SELECT Manager_Name FROM tbl_Personal_info WHERE ID = '$Employee_new_id'),
        (SELECT Tbl_departments.Department 
         FROM tbl_Personal_info 
         JOIN Tbl_departments ON Department_ID = tbl_Personal_info.Department 
         WHERE ID = '$Employee_new_id'),
        (SELECT Unit 
         FROM tbl_Personal_info 
         JOIN Tbl_Units ON Unit = Units_ID 
         WHERE ID = '$Employee_new_id'),
        '$Requester_username',
        '$Creation_time',
        'Confirmed'
    );

    DELETE FROM [Aya_Web_APP].[dbo].[schedule_table] 
    WHERE [engineer_id] = '$Employee_new_id' AND [schedule_date] > '$Last_working_date'
");

if ($insert_query) {
    echo "success";
} else {
    echo "insert_error";
}

// if ($insertqry2) {
//     echo "|schedule_success";
// } else {
//     echo "|schedule_error";
// }

exit;
?>
