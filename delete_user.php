<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php 
require_once("inc/config.inc");

$s_username = $_SESSION['username'];
$sqltime = date ("Y-m-d H:i:s");
$name ="";
    if(isset($_POST['id_num'])){$id_num = $_POST['id_num'];}
//delete
    // $delete_missing = sqlsrv_query($con , "UPDATE
    //     [Employess_DB].[dbo].[Training] 
    //  set status = 'deleted'
    // where ID = '$id'  ");



$insertqry = sqlsrv_query($con ," INSERT INTO [Employess_DB].[dbo].[Training_Demo]
([ID], [EMP_NAME], [Username], [National ID],
[Mobile], [ENTRY DATE], [Status], [creation_time],
[creator_name], [added_from],  last_update_user,
             last_update_time) 
             SELECT 
 *, '$s_username', '$sqltime'
 FROM [Employess_DB].[dbo].[Training]
WHERE id_num = '$id_num';");
//delete 
$deleteqry = sqlsrv_query($con,"DELETE  from [Employess_DB].[dbo].[Training] 
where id_num = '$id_num' ");



?>
