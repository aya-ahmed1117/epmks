

<?php 
	require_once("inc/config.inc");
	$s_username = $_SESSION['username'];  
 //if(isset($_POST["id"])) 
if(isset($_POST['id'])){$myID = $_POST['id'];}
 
      $rows = ''; 
         $rows .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';   
    $first_query = sqlsrv_query( $con ,"SELECT * FROM deduction WHERE username ='$s_username'  AND 
  stat_added = 'added' and [id] = '$myID' ");
    while($output = sqlsrv_fetch_array($first_query))  
      { 
    
       
           $rows .= '  
                <tr>  
                     <td width="30%"><label>ID</label></td>  
                     <td width="70%">'.$output["id"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>username</label></td>  
                     <td width="70%">'.$output["username"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Start date</label></td>  
                     <td width="70%">'.$output["a_date"]->format('Y-m-d').'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Item</label></td>  
                     <td width="70%">'.$output["item"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>type</label></td>  
                     <td width="70%">'.$output["type"].'</td>  
                </tr>  
           ';  
      }  
      $rows .= '  
           </table>  
      </div>  
      ';  
      echo $rows;  
 
 ?>