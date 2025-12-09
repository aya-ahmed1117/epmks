<?php
require_once("inc/config.inc");

// Check if the EmpID is set and is a valid number
if (isset($_POST['EmpID']) && is_numeric($_POST['EmpID'])) {
    $selectedEmpId = $_POST['EmpID'];

    $query = "SELECT [Username]
  FROM [Employess_DB].[dbo].[Training] WHERE ID = ?";
    $params = array($selectedEmpId);

    $stmt = sqlsrv_query($con1, $query, $params);

    if ($stmt !== false) {
        $row = sqlsrv_fetch_array($stmt);
        if ($row !== false) {
            echo $row['Username'];
        } else {
            echo "User not found.";
        }
    } else {
        echo "Error retrieving user name.";
    }
} else {
    echo "Empty Username.";
}
?>
