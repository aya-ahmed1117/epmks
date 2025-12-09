
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php
require_once("inc/config.inc");
$Requester_username = $_SESSION['username'];
$engineer_id = $_SESSION['id'];
$Creation_time = date("Y-m-d H:i:s");
$this_day = date("Y-m-d");

if(isset($_POST['Last_working_day'])) $Last_working_day = $_POST['Last_working_day'];
if(isset($_POST['SubGroups'])) $SubGroups = $_POST['SubGroups'];
if(isset($_POST['username'])) $usernames = trim($_POST['username']);

   
    if (empty($usernames)) {
       echo "<script>
                        Swal.fire({
                          icon: 'info',
                          title: 'warrning',
                          text: 'Please choose or enter a username.',
                          confirmButtonText: 'OK'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            location.reload();
                          }
                        });
                        </script>";


    } else {
        // Check if username exists
        $check_user = sqlsrv_query($con, "SELECT COUNT(*) AS count FROM employee WHERE username = ?", array($usernames));
        $user_exists = sqlsrv_fetch_array($check_user)['count'];

        if ($user_exists == 0) {
        	 echo "<script>
                        Swal.fire({
                          icon: 'info',
                          title: 'warrning',
                          text: 'Invalid username. No such user found.',
                          confirmButtonText: 'OK'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            location.reload();
                          }
                        });
                        </script>";
        } else {
           
            if ($Last_working_day > $this_day) {
                $insert = sqlsrv_query($con1, "INSERT INTO [dbo].[sub_Group_insert]
                    ([sub_Group], [username], [Last_working_day], [update_by], [update_time])
                    SELECT ?, ?, ?, ?, ?
                    WHERE NOT EXISTS (
                        SELECT 1 FROM [dbo].[sub_Group_insert]
                        WHERE [sub_Group] = ? AND [username] = ? AND [Last_working_day] = ?
                    )", array(
                        $SubGroups, $usernames, $Last_working_day, $Requester_username, $Creation_time,
                        $SubGroups, $usernames, $Last_working_day
                    ));

                if ($insert) {
                    echo "<script>
                        Swal.fire({
                          icon: 'success',
                          title: 'Success',
                          text: 'Data added successfully',
                          confirmButtonText: 'OK'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            location.reload();
                          }
                        });
                        </script>";


                } else {
                    echo "<script>
                        Swal.fire({
                          icon: 'error',
                          title: 'Invalid Username',
                          text: 'No such user found.',
                          confirmButtonText: 'OK'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            location.reload();
                          }
                        });
                        </script>";


                }

            } elseif ($Last_working_day == $this_day) {
                $update = sqlsrv_query($con1, "UPDATE [tbl_Personal_info]
                    SET [sub_Group] = ?, [update_by] = ?, [update_time] = ?
                    WHERE username = ?", array(
                        $SubGroups, $Requester_username, $Creation_time, $usernames
                    ));

                if ($update) {
                  echo "<script>
                        Swal.fire({
                          icon: 'success',
                          title: 'Success',
                          text: 'Sub group updated successfully.',
                          confirmButtonText: 'OK'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            location.reload();
                          }
                        });
                        </script>";

                } else {
                  echo "<script>
                      Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error while updating sub group.',
                        confirmButtonText: 'OK'
                      }).then((result) => {
                        if (result.isConfirmed) {
                          location.reload();
                        }
                      });
                      </script>";

                }

            } else {
            	 echo "<script>
                        Swal.fire({
                          icon: 'error',
                          title: 'Invalid Date',
                          text: 'Last working date cannot be in the past.',
                          confirmButtonText: 'OK'
                        }).then((result) => {
                          if (result.isConfirmed) {
                            location.reload();
                          }
                        });
                        </script>";
                echo '<div class="alert alert-danger">Last working date cannot be in the past.</div>';
            }
        }
    }

?>
