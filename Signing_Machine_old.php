
<?php

 include ("pages.php");
?>
<title>Signing Machine</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/ionicons.min.css">
  <link rel="stylesheet" href="css/dialogbox.css">
</head>
 <style type="text/css">

 .a{
  display: block;
  width: 250px;
  height: 50px;
  line-height: 50px;
  font-weight: bold;
  text-decoration: none;
  background: #333;
  text-align: center;
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 1px;
  border: 3px solid #333;
  transition: all .35s;
}

.icon{
  width: 50px;
  height: 50px;
  border: 3px solid transparent;
  position: absolute;
  transform: rotate(45deg);
  right: 0;
  top: 0;
  z-index: -1;
  transition: all .35s;
}

.icon svg{
  width: 30px;
  position: absolute;
  top: calc(50% - 15px);
  left: calc(50% - 15px);
  transform: rotate(-45deg);
  fill: #2ecc71;
  transition: all .35s;
}

.a:hover{
  width: 200px;
  border: 3px solid #2ecc71;
  background: transparent;
  color: #2ecc71;
}

.a:hover + .icon{
  border: 3px solid #2ecc71;
  right: -25%;
}

/*   doar*/


.btn--doar {
 padding: 15px;
font-weight: 700;
font-size: 2rem;
text-decoration: none;
text-align: center;
transition: all .5s ease;
margin-left: 0;
margin-right: 0;
color: #fff;
padding-right: 0;
background-color: #ee5c42;
-webkit-clip-path: polygon(0% 0%, 100% 0, 100% 70%, 90% 100%, 0% 100%);
clip-path: polygon(0 0, 100% 0, 100% 50%, 75% 100%, 0 100%);

}
 

.btn--doar:hover { 
  -webkit-clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
  clip-path: polygon(0 0, 100% 0, 100% 100%, 100% 100%, 0 100%);  
}

.btn--doar:after {
  content: "\f011";
  color: black;
  width: 25%;
  font-family: FontAwesome;
  display: inline-block;
  position: relative;
  right: -220px;
  transition: all 0.2s ease;
}

.btn--doar:hover:after {
  margin: -20px 25px 0 40px;
  right: 0px;
}
.in{
  background-color: #2e8b57;
}
.in:after{
content: "\f118";

  }
/*
tr:hover {
  background: linear-gradient(45deg, #49a09d, #5f2c82);
}
td, th {
  position: relative;
}*
td:hover::after,
th:hover::after {
  content: "";
  position: absolute;
  background: linear-gradient(45deg, #49a09d, #5f2c82);
  left: 0;
  top: -550px;
  min-height: auto;
  width: 100%;
  z-index: -1;
  overflow-z: hidden;
}*/
  table {
  border-collapse: collapse;
  overflow: hidden;
  box-shadow: 0 0 2px rgba(0,0,0,0.1);
  text-align: center;
  background-color: white;
}
tr:nth-child(even) {
  background-color: lightgray;
}

td {
  padding:15px;
  background-color: rgba(255,255,255,0.2);
  color: black;
  position: relative;
}

  th {
    padding:15px;
    background-color: #55608f;
    text-align: center;
  color: black;
  position: relative;

  }


tr:hover{
  color: #fff;
}

.hover2{
  color: blue;
  background-color: #333d6b;

}
.hover {
      background: #333d6b;
      color: #fff;
      border-radius:20px 20px 20px 20px ;

        }
.tableFixHead {
      table-layout: fixed;
      border-collapse: collapse;
    }
      .tableFixHead tbody {
      display: block;
      overflow: auto;
      height: 250px;
      background-color: white;
    }
    .tableFixHead thead  {
      display: block;
    }
    .tableFixHead th,
    .tableFixHead  td{
      width: 500px;
    }
 </style>
<?php
date_default_timezone_set('Africa/Cairo');
  $DBhost = "172.29.29.76";
  $DBuser = "Seniors";
  $DBpass = "123456789";
  $DBname = "Employess_DB";
  $connectionInfo = array( "Database"=>"Employess_DB" , "UID"=>"Seniors" , "PWD"=>"123456789");
  $con1 = sqlsrv_connect($DBhost, $connectionInfo);

      $check_engineers = sqlsrv_query( $con1 ," SELECT distinct [ID],[Gender]
      FROM [Employess_DB].[dbo].[tbl_Personal_info]
      where UserName ='$s_username'");
      $output_query = sqlsrv_fetch_array($check_engineers);

      $Gender = $output_query['Gender'];

?>
<!--div class="col-md-2">
      <aside class="profile-nav alt">
          <section class="card" style="padding:0;margin: auto;">
      
  <ul class="list-group list-group-flush">
    <?php 
    //deduction
       if($_SESSION['role_id'] == 0){
$Notification = sqlsrv_query($con ,"SELECT *FROM deduction
where username = '$s_username'  and [stat_added] = 'Added'  and year(a_date ) >= year(getdate())  order by 5"  , array() , array('Scrollable' =>'static'));

$Notifi_num = sqlsrv_num_rows($Notification);
if ($Notifi_num  >0){?>
      <li class="list-group-item">
          <a href="#"> <i class="fa fa-envelope-o"></i>Deduction
            <span class="badge pull-right" style="color:blue;"><img src="images/ImpoliteVapidGuanaco.gif" width="29" height="29"/><?php  $Notifi_num;}}?>
</span></a>
      </li>
      <li class="list-group-item">
          <a href="#"> <i class="fa fa-tasks"></i> Chat<span class="badge badge-success pull-right">15</span></a>
      </li>
      <li class="list-group-item">
          <a href="#"> <i class="fa fa-bell-o"></i>Rejected<span class="badge badge-danger pull-right">11</span></a>
      </li>
   </ul>
                          </section>
                        </aside>
                    </div-->


<center>
  
<div class="col-md-6">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
                <div class="card-header user-header alt bg-light"style="border-radius: 20px 20px 0 0 ;">
                    <div class="media">
                        <?php
if($Gender =='Female'){
?>
    <img class="align-self rounded-circle mr-3" 
    style="width:85px; height:85px;" alt="" src="images/profile-icon-female.png">
    <?php
  }
    ?>
    <?php
      if($Gender =='Male'){
    ?>
    <img class="align-self rounded-circle mr-3" 
    style="width:85px; height:85px;" src="images/admin.png">
    <?php
  }
    ?>
            <div class="media-body">
      <h2 class="text-dark display-12" >Signing Machine <span><img src="images/finger.png"style="width:55px;"></span></h2>

      <p style="color:lightgray;">Welcome : <?php echo $_SESSION["username"];?></p>
          </div>
      </div>
  </div>

<br>
  <div class="row form-group"> 

<div class="col-md-6 content">
<button class="btn btn--doar in" value="in">IN</button>
</div>

<br>
<div class="col-md-6 content">
  <center>
<button class="btn btn--doar" id="out"  value="out">Out</button>

</div>
</center>
</div>


</section>
</div>
</center>
<br>

<center>
  <div class="col-sm-6" id="logBoard">
  <div class="tableFixHead" >

 <table style="border-radius: 30px 30px 0 0; background-color: white;">
  
    <thead>
          <th style="color:#fff;">Type</th>
          <th style="color:#fff;"> Day</th>
          <th style="color:#fff;">Time </th> 
</thead>
</table>
<table style="border-radius:  0 0 30px 30px;" >
<tbody>
<?php      

$engineer_id = $_SESSION['id'];
$s_username = $_SESSION['username'];
$first_query = sqlsrv_query( $con ,"SELECT top 20 * FROM in_and_out WHERE  [engineer_id] = '$engineer_id' or username ='$s_username'  order by 4 DESC ,5 desc ");
  while( $output_query2 = sqlsrv_fetch_array($first_query)){
$rows  ='<tr>';
$rows .='<td>'.$output_query2["type"].'</td>';
$rows .='<td>'.$output_query2["cur_date"]->format('Y-m-d').'</td>';
$rows .='<td>'.$output_query2["atime"]->format('H:i:s').'</td>';
$rows .='</tr>';

echo $rows;
}
?>

</tbody>
</table>
</div>
</div>
</center>

<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script type="text/javascript">
    $('table tr td').hover(function() {
    $('table th td ').eq($(this).index()).add(this).toggleClass('hover');
    /*$('table th').eq($(this).index()).add(this).toggleClass('hover2');*/
});
    
  </script>
<script type="text/javascript">
$(document).ready(function(){
//in
$(".btn btn--doar in").click(function(){
  var atype = $(this).val();
  var dataString = 'type='+atype;
  //if(atype == 'in'){
    $.ajax({
    type:"post", 
    url:"ajax_load.php",
    data: dataString,
    cache: false,
     beforeSend: function(){ 
        //$('.logBoard').html("loading");
      },
        success: function(data){
          $('#logBoard').html(data);
          //$('.alert alert-success').html(data);

        },
        error: function(err){
          console.log(err);
        }
    });
        });

//out
  $(".btn--doar").click(function(){
  var btype = $(this).val();
  var dataString2 = 'type='+btype;

    $.ajax({
    type: "post", 
    url: "ajax_load.php",
    data: dataString2,
    cache: false,
        beforeSend: function(){ 
        //$('.logBoard').html("loading");
      },
        success: function(data){
          $('#logBoard').html(data);
          //swal("Good by");
        },
        error: function(err){
          console.log(err);
        }
    });
        return false;

  });

});
</script>



<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <!--script src="//cdn.jsdelivr.net/npm/less@3.13" ></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script-->

<?php

 include ("footer.html");
 ?>
