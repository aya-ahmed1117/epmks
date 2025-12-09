<!DOCTYPE html>
<html>
<head>
<?php require_once("inc/config.inc"); ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.toggleSwitch span span {
  display: none;
}

@media only screen {
  .toggleSwitch {
    display: inline-block;
    height: 18px;
    position: relative;
    overflow: visible;
    padding: 0;
    margin-left: 50px;
    cursor: pointer;
    width: 40px
  }
  .toggleSwitch * {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }
  .toggleSwitch label,
  .toggleSwitch > span {
    line-height: 20px;
    height: 20px;
    vertical-align: middle;
  }
  .toggleSwitch input:focus ~ a,
  .toggleSwitch input:focus + label {
    outline: none;
  }
  .toggleSwitch label {
    position: relative;
    z-index: 3;
    display: block;
    width: 100%;
  }
  .toggleSwitch input {
    position: absolute;
    opacity: 0;
    z-index: 5;
  }
  .toggleSwitch > span {
    position: absolute;
    left: -50px;
    width: 100%;
    margin: 0;
    padding-right: 50px;
    text-align: left;
    white-space: nowrap;
  }
  .toggleSwitch > span span {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 5;
    display: block;
    width: 50%;
    margin-left: 50px;
    text-align: left;
    font-size: 0.9em;
    width: 100%;
    left: 15%;
    top: -1px;
    opacity: 0;
  }
  .toggleSwitch a {
    position: absolute;
    right: 50%;
    z-index: 4;
    display: block;
    height: 100%;
    padding: 0;
    left: 2px;
    width: 18px;
    background-color: #fff;
    border: 1px solid #CCC;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease-out;
    -moz-transition: all 0.2s ease-out;
    transition: all 0.2s ease-out;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
  }
  .toggleSwitch > span span:first-of-type {
    color: #ccc;
    opacity: 1;
    left: 45%;
  }
  .toggleSwitch > span:before {
    content: '';
    display: block;
    width: 100%;
    height: 100%;
    position: absolute;
    left: 50px;
    top: -2px;
    background-color: #fafafa;
    border: 1px solid #ccc;
    border-radius: 30px;
    -webkit-transition: all 0.2s ease-out;
    -moz-transition: all 0.2s ease-out;
    transition: all 0.2s ease-out;
  }
  .toggleSwitch input:checked ~ a {
    border-color: #fff;
    left: 100%;
    margin-left: -8px;
  }
  .toggleSwitch input:checked ~ span:before {
    border-color: #0097D1;
    box-shadow: inset 0 0 0 30px #0097D1;
  }
  .toggleSwitch input:checked ~ span span:first-of-type {
    opacity: 0;
  }
  .toggleSwitch input:checked ~ span span:last-of-type {
    opacity: 1;
    color: #fff;
  }
  /* Switch Sizes */
  .toggleSwitch.large {
    width: 60px;
    height: 27px;
  }
  .toggleSwitch.large a {
    width: 27px;
  }
  .toggleSwitch.large > span {
    height: 29px;
    line-height: 28px;
  }
  .toggleSwitch.large input:checked ~ a {
    left: 41px;
  }
  .toggleSwitch.large > span span {
    font-size: 1.1em;
  }
  .toggleSwitch.large > span span:first-of-type {
    left: 50%;
  }
  .toggleSwitch.xlarge {
    width: 80px;
    height: 36px;
  }
  .toggleSwitch.xlarge a {
    width: 36px;
  }
  .toggleSwitch.xlarge > span {
    height: 38px;
    line-height: 37px;
  }
  .toggleSwitch.xlarge input:checked ~ a {
    left: 52px;
  }
  .toggleSwitch.xlarge > span span {
    font-size: 1.4em;
  }
  .toggleSwitch.xlarge > span span:first-of-type {
    left: 50%;
  }
} 
/*  End Toggle Switch  */
</style>
</head>
<body>
  
<div style="overflow:scroll; overflow-x:hidden;">

 <table align="center" class="order-table table" style="color: gray; flex-wrap: wrap;position: relative;font-style: normal;border: 2px solid #eee; margin-left:3%;
  font-family: Century Gothic;">
    <thead style="background-color: #3366ff;color: #eee;border: 2px solid #eee;">
           <th width="1%"style="border: 2px solid #eee;" > Username</th>
          <th width="1%"style="border: 2px solid ;">Type</th>
          <th width="1%"style="border: 2px solid ;" > Day</th>
          <th width="1%"style="border: 2px solid ;">Time </th>
        
</thead>
<tbody class="logBoard">
<?php
   $engineer_id = $_SESSION['id'];
 $s_username = $_SESSION['username'];

$first_query = sqlsrv_query( $con ,"SELECT top 5 * FROM in_and_out WHERE  [engineer_id] = '$engineer_id' or username ='$s_username'  order by 4 DESC ,5 desc ");
  while( $output_query2 = sqlsrv_fetch_array($first_query)){

$rows  ='<tr>';
$rows .='<td width="1%" style="display:none;background-color: #eee;">'.$output_query2["engineer_id"].'</td>';
$rows .='<td width="1%" style="border: 1px solid ;font-size:12px;background-color: #eee;">'.$output_query2["username"].'</td>';
$rows .='<td width="1%" style="border: 1px solid ;background-color: #eee;">'.$output_query2["type"].'</td>';
$rows .='<td width="1%" style="border: 1px solid ;background-color: #eee;">'.$output_query2["cur_date"]->format('Y-m-d').'</td>';
$rows .='<td width="1%" style="border: 1px solid ;background-color: #eee;">'.$output_query2["atime"]->format('H:i:s').'</td>';

$rows .='</tr>';

echo $rows;
}
?>
</div>
</tbody>
</table>
<h2>Toggle Switch</h2>

<!--label class="toggleSwitch xlarge"onclick="">
  <input class="logoutchk" type="submit" name="type" value="in" >
  <span class="slider round"></span>
</label>
<label class="toggleSwitch xlarge"onclick="">
  <input class="loginchk" type="checkbox" name="type" value="out" />
  <span class="slider round"></span>
</label-->
  <label class="toggleSwitch xlarge">
        <input class="bt loginBtn" type="submit" value="in" />
        <span>
            <span>In </span>
            <span>In </span>
        </span>
        <a></a>
    </label>
     <label class="toggleSwitch xlarge">
        <span> <input class="logoutBtn" type="checkbox" value="out" />
       
            <span value="In">In </span>
            <span value="out">Out </span>
        </span>
        <a></a>
    </label>
<div class="notify"></div>
<script type="text/javascript">
  
(function(document) {
  'use strict';

  var LightTableFilter = (function(Arr) {

    var _input;

    function _onInputEvent(e) {
      _input = e.target;
      var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
      Arr.forEach.call(tables, function(table) {
        Arr.forEach.call(table.tBodies, function(tbody) {
          Arr.forEach.call(tbody.rows, _filter);
        });
      });
    }

    function _filter(row) {
      var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
      row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
    }

    return {
      init: function() {
        var inputs = document.getElementsByClassName('light-table-filter');
        Arr.forEach.call(inputs, function(input) {
          input.oninput = _onInputEvent;
        });
      }
    };
  })(Array.prototype);

  document.addEventListener('readystatechange', function() {
    if (document.readyState === 'complete') {
      LightTableFilter.init();
    }
  });

})(document);
  
</script>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function(){
  //var id = $('.spanId').data('id');
  $(".loginBtn").click(function(){
  var atype = $(this).val();
  var dataString = 'type='+atype;
  
    $.ajax({
    type: "post", 
    url: "ajax_load.php",
    data: dataString,
    cache: false,
        beforeSend: function(){ 
        //$('.logBoard').html("loading");
      },
        success: function(data){
          $('.logBoard').html(data);
        },
        error: function(err){
          console.log(err);
        }
    }); 
  });
  $(".logoutBtn").click(function(){
  var atype = $(this).val();
  var dataString = 'type='+atype;
    $.ajax({
    type: "post", 
    url: "ajax_load.php",
    data: dataString,
    cache: false,
        beforeSend: function(){ },
        success: function(data){
          $('.logBoard').html(data);
        },
        error: function(err){
          console.log(err);
        }
    });
  });

});
</script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   
      <!-- Popper.JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
      <!-- Bootstrap JS -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>
</html>