

        <?php
   require_once("inc/config.inc");

        ?>

<?php     

$role_id = $_SESSION['role_id'];

if(isset($_GET['engineer_id'])){
  $engineer_id = $_GET['engineer_id'];


$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_id'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'] ;
}

  $my_id = $_SESSION['id'];
  $username = $_SESSION['username'];
  $send_to = $_GET['engineer_id'];

$first_query = sqlsrv_query( $con ,"SELECT * FROM chat_box WHERE (([send_to] ='$send_to' AND [send_from] = '$my_id') OR ([send_to] ='$my_id' AND [send_from] = '$send_to')) order by [when_time] DESC ");
  while( $output_query = sqlsrv_fetch_array($first_query)){
$rows ='<li>';

if($output_query["username"] == $_SESSION['username']){
    echo '<div class="msg-received msg-container">

            <div class="avatar">
               <img src="images/chat11.png" style="padding-bottom: 1px;margin-right: 1px;padding-top: 8px; width: 30px; margin-bottom: 1px;">
               <div class="send-time">'.$output_query["when_time"]->format("Y:m:d H:i:s").'
               </div>
            </div>

          <div class="msg-box">

            <div class="inner-box">

              <div class="name" style="color:red;">
                  '.$output_query["username"].'
                </div>

                <div class="meg">               
                '.$output_query["message"].'
                  </div>

                </div>

            </div>

        </div>';
}
else{
   echo'<div class="msg-sent msg-container">
        <div class="avatar">
            
           <img src="images/chat8.png" style="padding-bottom: 1px;margin-right: 1px;padding-top: 8px; width: 30px; margin-bottom: 1px;">
           <div class="send-time">
            '.$output_query["when_time"]->format("Y:m:d H:i:s").'
          </div>
        </div>
        <div class="msg-box">
            <div class="inner-box">
                <div class="nameWFM" style="color:green;">
            '.$output_query["username"].'
                </div>
                <div class="megWFM">
                 '.$output_query['message'].'
                </div>

            </div>
        </div>
    </div>';
}
$rows .='</li>';

echo $rows;
}
}
?>

    <!--     <?php
   require_once("inc/config.inc");
  if($_SESSION['username'] == ''){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }
        ?>
<table>
 <tr>
<td>
 <div  class='msg_cotainer_send' style="display: none;">
      from <?php echo $my_id; ?>
    </div>
</td>

<td>  
  <div  class='msg_cotainer' style="display: none;">
      to <?php echo $send_to; ?>
    </div>
</td>

</tr>

    </table>
            <?php     
$role_id = $_SESSION['role_id'];
if(isset($_GET['engineer_id'])){
$engineer_id = $_GET['engineer_id'];
$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE id ='$engineer_id'");
    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'];
}
  $my_id = $_SESSION['id'];
  $username = $_SESSION['username'];
  $send_to = $_GET['engineer_id'];

$first_query = sqlsrv_query( $con ,"SELECT * FROM chat_box WHERE (([send_to] ='$send_to' AND [send_from] = '$my_id') OR ([send_to] ='$my_id' AND [send_from] = '$send_to')) order by [when_time] DESC ");
  while( $output_query = sqlsrv_fetch_array($first_query)){
if($output_query["username"] == $_SESSION['username']){
  ?><li>
          <div class="msg-received msg-container">
            <div class="avatar">
               <img src="images/chat11.png" style='padding-bottom: 1px;margin-right: 1px;padding-top: 8px; width: 30px; margin-bottom: 1px;'>
               <div class="send-time"> <?php echo $output_query["when_time"]->format("Y:m:d H:i:s");?></div>
            </div>
      <div class="msg-box">
            <div class="inner-box">
                <div class="name" style="color:red;">
                  <?php echo $output_query["username"];?>
                </div>
                <div class="meg">
                  <?php echo $output_query['message'];?>
                </div>

                </div>

            </div>
        </div>
    </li>
    <?php }else{?>
    <li>
    <div class="msg-sent msg-container">
        <div class="avatar">
           <img src="images/chat8.png" style='padding-bottom: 1px;margin-right: 1px;padding-top: 8px; width: 30px; margin-bottom: 1px;'>
           <div class="send-time">
            <?php echo $output_query["when_time"]->format("Y:m:d H:i:s");?></div>
        </div>
        <div class="msg-box">
            <div class="inner-box">
                <div class="nameWFM" style="color:green;">
            <?php echo $output_query["username"];?>
                </div>
                <div class="megWFM">
                  <?php echo $output_query['message'];?>
                </div>

            </div>
            <?php }}}?>
        </li>
       </div>
    </div> 

 -->