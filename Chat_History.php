

<?php

 include ("pages.php");
 ?>
    <title>Chating</title>
<link rel="icon" href="images/logo_we.jpg">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<script src="table-filter.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
<link rel="stylesheet"href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
<link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
<link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
  

</head>
<style type="text/css">
body{
    background-image: url('images/whats-app-background.jpg');
}
 .messenger-box .msg-box {
    margin-left: 84px;
    margin-right: 84px; }
      .messenger-box .msg-sent .msg-box {
    margin-right: 85px; }
    
  .messenger-box .inner-box {
    position: relative;
    border-radius: 10px;
    background-color: #f1f2f7;
    font-size: 14px;
    color: #9aa0a4;
    padding: 14px 20px; }
    .messenger-box .inner-box .name {
      font-size: 16px;
      text-align: left;
      padding-bottom: 10px; }
      .meg{
        text-align: left;
      }
      .messenger-box .inner-box .nameWFM {
      font-size: 16px;
      text-align: right;
      padding-bottom: 10px; }
      .megWFM{
        text-align: right;
      }
    .messenger-box .inner-box:after {
      content: "";
      position: absolute;
      top: 10px;
      left: -18px;
      width: 18px;
      height: 18px;
      border-style: solid;
      border-width: 9px;
      border-color: transparent #f1f2f7 transparent transparent; }
  .messenger-box .msg-sent .avatar {
    float: right; }
  .messenger-box .msg-sent .msg-box {
    margin-right: 85px; }
  .messenger-box .msg-sent .inner-box:after {
    left: inherit;
    right: -18px;
    border-color: transparent transparent transparent #f1f2f7; }
     .messenger-box .send-mgs {
    margin-top: 20px;
    margin-bottom: 9px;
    position: relative; }
    .messenger-box .send-mgs .yourmsg {
      margin-right: 55px; }
      .messenger-box .send-mgs .yourmsg input {
        border: 1px solid #eceff1;
        height: 40px;
        line-height: 40px;
        font-size: 14px;
        border-radius: 7px; }

.small-device .right-panel {
  margin-left: 83px; }

.messenger-box {
  padding-top: 15px; }
  .messenger-box ul {
    padding-left: 0;
    display: inline-block;
    width: 100%;
    padding-bottom: 15px; }
  .messenger-box li {
    list-style: none;
    padding-bottom: 20px; }
  .messenger-box .avatar {
    width: 64px;
    float: left; }
    .messenger-box .avatar img {
      border-radius: 100%; }
    .messenger-box .avatar .send-time {
      font-size: 11px;
      /*text-align: center;*/
      padding-top: 5px; }
      .messenger-box .send-mgs .msg-send-btn {
    background: #03a9f3;
    color: #fff;
    font-size: 28px;
    border-radius: 7px;
    padding: 0;
    /*text-align: center;*/
    height: 40px;
    width: 40px;
    position: absolute;
    right: 0;
    top: 0;
}

aside.left-panel:hover {
    overflow-x: scroll; }

.open aside.left-panel:hover {
  overflow-x: inherit; }

.small-device .right-panel {
  margin-left: 83px; }
[class*=" pe-7s-"], [class^=pe-7s-] {
    display: inline-block;
    font-family: Pe-icon-7-stroke;
    speak: none;
    font-style: normal;
    font-weight: 400;
    font-variant: normal;
    text-transform: none;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.messenger-box .send-mgs .msg-send-btn {
    background: #03a9f3;
    color: #fff;
    font-size: 28px;
    border-radius: 7px;
    padding: 0;
    text-align: center;
    height: 40px;
    width: 40px;
    position: absolute;
    right: 0;
    top: 0;
}
.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}
.btn:focus, .btn:hover {
    text-decoration: none;
}
.btn, .button {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-transition: all .15s ease-in-out;
    transition: all .15s ease-in-out;
    border-radius: 3;
    cursor: pointer;
}
.btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
a, button {
    text-decoration: none;
    outline: none !important;
    color: #878787;
    -webkit-transition: all 0.25s ease;
    transition: all 0.25s ease;
}
button, select {
    text-transform: none;
}
button, input, optgroup, select, textarea {
    margin: 0;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
}
button, select {
    text-transform: none;
}
button, input, optgroup, select, textarea {
    font-family: inherit;
    font-size: 100%;
    line-height: 1.15;
    margin: 0;
}
button {
    -webkit-writing-mode: horizontal-tb !important;
    text-rendering: auto;
    color: -internal-light-dark(black, white);
    letter-spacing: normal;
    word-spacing: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
    text-align: center;
    cursor: default;
    font: 400 13.3333px Arial;
}
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;
}
</style>

 <br>
 
<?php 
$engineer_id = $_SESSION['id'];


if(($_SESSION['role_id'] == 1) || ($_SESSION['role_id'] == 7)){
?>
<center>
 
 <form method="post" class="content" >   
   <h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter"data-table="order-table" placeholder="Filter">

 
 <div class="col-lg-7">
    <div class="card">
      <div class="card-body" >
        <h4 class="card-title box-title">
          <img src="images/200w.gif" style="width:80px;">Live Chat History</h4>
          <div class="card-content">    
            <div  style="overflow-y:auto;height:320px; ">
              <div class="messenger-box" id="ChatBox">
                <ul>

   <table class="order-table table">
    <tbody>
  <?php
$check_engineers = sqlsrv_query( $con ,"SELECT distinct [dbo].[employee].[id],[when_time],[dbo].[employee].[username],[employee].[role_id]
 FROM [Aya_Web_APP].[dbo].[chat_box]  join [dbo].[employee] on ([send_from] = [employee].[id])
WHERE employee.role_id <> 7  order by [when_time] desc");
$orders_num = sqlsrv_num_rows($check_engineers);

while ( $output_engineers = sqlsrv_fetch_array($check_engineers)){
  //$output_engineers = $check_engineers->fetch_array()){
  $engineers_id = $output_engineers['id'];
  $eng_username = $output_engineers['username'] ;
  
   // if ($orders_num > 0){
  $rows ="<tr><td>";
      $rows.='<li><div class="msg-sent msg-container">
        <div class="avatar">
          <a href="chating2.php?engineer_id='.$engineers_id.'">

               <img src="images/309666chat.png" style="padding-bottom: 1px;margin-right: 1px;padding-top: 8px; width: 30px; margin-bottom: 1px;">
              </a>
        </div>
        <div class="msg-box">
            <div class="inner-box">
            <a href="chating2.php?engineer_id='.$engineers_id.'">
                <div class="name" style="color:green;">

                  '.$eng_username.'
                </div>

                <div class="meg">               
                
                View Chat
                  </div>
</a>
                </div>

            </div>

        </div></li>
        ';
    $rows.="</td></tr>";
  echo $rows;
}
}
?>

</tbody>
</table>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>

</form>
<script src="table-filter.js"></script>

</center>

<?php 
include("footer.html");

?>