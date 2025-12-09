<?php
require_once("inc/config.inc");


$s_username = $_SESSION['username'] ?? 'system';

$username     = trim($_POST['username'] ?? '');
$password     = trim($_POST['password'] ?? '');
$repassword   = trim($_POST['repassword'] ?? '');
$role_id      = trim($_POST['role_id'] ?? '');
$manager_id   = trim($_POST['manager_id'] ?? '');
$Unit_Name    = trim($_POST['Unit_Name'] ?? '');
$username_id  = trim($_POST['username_id'] ?? '');
$add_Dtime    = date("Y-m-d H:i:s");

if (
    $username === '' || $password === '' || $repassword === '' ||
    $role_id === '' || $manager_id === '' || $Unit_Name === '' || $username_id === ''
) {
    echo "All fields are required.";
    exit;
}

if ($password !== $repassword) {
    echo "Passwords do not match.";
    exit;
}

$checkStmt = sqlsrv_query($con, "SELECT id FROM employee WHERE username = ?", [$username]);
if (sqlsrv_has_rows($checkStmt)) {
    echo "Username already exists.";
    exit;
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO employee (
    username, password, role_id, manager_id, super_id, section_id, UnitManager_id,
    Unit_Name, username_id, updated_by, creation_time, creator_user, add_Dtime
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, NULL, ?, ?)";

// $sql = sqlsrv_query( $con ,"INSERT INTO employee (
//     username, password, role_id, manager_id, super_id, section_id, UnitManager_id,
//     Unit_Name, username_id, updated_by, creation_time, creator_user, add_Dtime
// ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NULL, NULL, '$s_username', '$add_Dtime')");


$params = [
    $username, $hashed_password, $role_id, $manager_id, 
    null, null, null, $Unit_Name, $username_id, 
    $s_username, $add_Dtime
];

$stmt = sqlsrv_prepare($con, $sql, $params);

if (sqlsrv_execute($stmt)) {
    echo "success";
} else {
    echo "Database insert failed.";
}
