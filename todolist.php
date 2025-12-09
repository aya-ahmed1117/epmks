

    <?php
//include ("pages.php");

        ?>
        <?php
// Multiple recipients
$to = 'aya.abdelfattah@te.eg, e-workforce@outlook.com'; // note the comma

// Subject
$subject = 'Birthday Reminders for August';

// Message
$message = '
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body>
  <p>Here are the birthdays upcoming in August!</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Johny</td><td>10th</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';
echo
// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'To: Mary <aya.abdelfattah@te.eg>, Kelly <kelly@example.com>';
$headers[] = 'From: Birthday Reminder <e-workforce@outlook.com>';
$headers[] = 'Cc: belal.ezza@te.eg';
$headers[] = 'Bcc: birthdaycheck@example.com';

// Mail it
 echo mail($to, $subject, $message, implode("\r\n", $headers));
?>


<!--form action="" method="post">
    <input type="submit" value="Send details to embassy" name="value" />
    <input type="hidden" name="button_pressed" value="1" />
</form>

<form method="POST" id="myForm" >
  <input type="text" name="sender_name" placeholder="Name" required="">
  <input type="text" name="sender_em‌​ail‌​" placeholder="Email" required="">
  <input type="text" name="subject" placeholder="Subject" required="">
  <textarea placeholder="Message" name="message" required=""></textarea>
  <input type="submit" name="send" value="SEND"/>
</form>--->

<?php
/*
if(isset($_POST['send'])){
$to      = 'aya.abdelfattah@te.eg';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: aya.abdelfattah@te.eg' . "\r\n" .
    'Reply-To: belal.ezzat@te.eg' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
}*/
?>

<!--form action="mailto:aya.abdelfattah@te.eg" method="post" enctype="text/plain" >
FirstName:<input type="text" name="FirstName">
Email:<input type="text" name="Email">
<input type="submit" name="submit" value="Submit">
</form-->

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript">



  $(document).ready(function(){
    $("#myForm").on('submit', function(event) {
        event.preventDefault(); 
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: 'process.php',
            dataType: "json",
            data: formData,
            success: function(response) { 
                alert(response.success); 
            },
            error: function(xhr, status, error){
                console.log(xhr); 
            }
        });
    });
});
</script>

<?php
$to      = 'aya.abdelfattah@te.eg'; 
?>
<?php
/*
if(isset($_POST['value'])){
if(sqlsrv_real_escape_string($_POST['value']=='1')){
$ownerid=mysql_real_escape_string($_POST['ownerid']);
$email=mysql_real_escape_string($_POST['email']);
$phone=mysql_real_escape_string($_POST['phone']);
$activate=mysql_query("update pgowner set activate='1' where tmp_id='$ownerid'");
$reactivatepg=mysql_query("update pg_details set approved='1' where owner='$ownerid' and approved='0' and publish='1'");

$to=$email;
$subject = "Profile Activation Mail";
$message = "
<html>
<head>
<p>Dear user,</p>
<p>Thank you for registering!</p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "X-Priority: 1 (Highest)\n";
$headers .= "X-MSMail-Priority: High\n";
$headers .= "Importance: High\n";

// More headers
$headers .= 'From: <info@servername.com>' . "\r\n";

if(mail($to,$subject,$message,$headers)){ ?>
<p style="display:none;">Sent</p>
<?php 
} else { ?>
<p style="display:none;">Unsent</p>
<?php }
}
}
*/
?>
<script type="text/javascript">
  function sendMail() {
    var link = "mailto:aya.abdelfattah@te.eg"
             + "?cc=belal.ezzat@te.eg"
             + "&subject=" + encodeURIComponent("This is my subject")
             + "&body=" + encodeURIComponent(document.getElementById('myText').value)
    ;
    
    window.location.href = link;
}
</script>

<!--DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>


<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

    $(".submit").click(function(){
      var name1 = $(".name").val();
      var email1 = $(".email").val();

      var varData ="name="+ name1 + "&email="+ email1 ;
      console.log(varData);

      $.ajax({
        type:"POST",
        URL:"process.php",
        data:varData,
        success:function(){
          alert("good gooooooob");
        }


      });

  });
  });


</script>


<input type="text" class="name" name="name" />
<label for="name">Name</label>
    <input type="text" name="email" class="email" />
    <label for="email">E Mail</label>
    <div class="submit" style="background-color: gray; color: white;"> click me </div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>





        </body>
</html>
-->