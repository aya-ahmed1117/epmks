



<?php 
include ("pages.php");
$usernames="";
  if(isset($_POST['username'])){$usernames = $_POST['username'];}
     $self = $_SESSION['id'];
     $user =$_SESSION["username"];
$username = isset($_POST['username']) ? $_POST['username'] : '';
$myMonth = isset($_POST['month']) ? $_POST['month'] : '';
$newMonth = $myMonth ? date('n', strtotime($myMonth)) : '';



?>
<title>Electricity down Report</title>

<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" href="css/ionicons.min.css">
<link rel="stylesheet" href="css/morris22.css">
<link rel="stylesheet" href="css/AdminLTE.min.css">
<link rel="stylesheet" href="css/_all-skins.min.css">
<link rel="stylesheet" type="text/css" href="css/kpi_css.css">
<style type="text/css">
    .hovers:hover {
      background-color: #333d6b ;
      color: white;
      border-radius:20px 20px 20px 20px ;
        }
  .zoom:hover{
    transform: scale(1.5);
  }
</style>
  </head>

    <center>
	<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" style="font-family:Century Gothic;" >Monthly electricity report
              	<a href="Summary_kpi.php">
    <button type="button" id="sidebarCollapse" class="btn btn-warning" >
    <i class="fa fa-backward"></i> Back
    </button></a>
			    </h2>
              </div>
          </div>
      </div>

        <samp><p style="background-color:#55608f;font-weight:bold;font-size:16px;color:white;padding:2%;">To Download this table please click Excel button<a role="button" id="btnExport" value="Export to Excel" onclick="Export()"> 
        	<img src="images/aaa-removebg-preview.png" class="zoom"  style="width:10%;"/> </a></p></samp>
    </aside>
  </div>
</center>

<div style="padding: 20px;">

	<form method="post" >
	    <div class="row">
	    	<!-- Month Selection -->
	        <div class="col-md-6">
	            <div class="input-group mb-3">
	                <span class="input-group-text" id="month-addon">Choose Month</span>
	                <input name="month" type="month" required id="month" class="form-control" value='<?php if(isset($_POST['month'])) echo $_POST['month']; ?>'>
	            </div>
	        </div>
	     
		
	<!-- 	</div>
	<div class="row"> -->
	<!-- <div class="col-md-6">
        <div class="input-group mb-3">
            <span class="input-group-text" id="group-addon"><i class="fas fa-user-tie"></i> Select username</span>
            <select class="form-control"  id="username" name="username">
                <option value="" selected>Select username</option> -->
	
			<?php
			   /* if ($_SESSION['role_id'] == 1){

           $checks = sqlsrv_query( $con ,"SELECT DISTINCT username FROM
           	[tranning_Database].[dbo].[Report_Electricity_down_Zoz] where username !=' '");

                while($outputs = sqlsrv_fetch_array($checks)) {
                    $selected = (isset($_POST['username']) && $_POST['username'] == $outputs['username']) ? 'selected' : '';
                    echo '<option value="'.$outputs['username'].'" '.$selected.'>'.$outputs['username'].'</option>';}
                 } //$_SESSION['role_id'] == 1  end
			    $user =$_SESSION["username"];
			    $self = $_SESSION['id'];
			    //senior
			if ($_SESSION['role_id'] == 2){
			    $check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE manager_id = '$self'");
       while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
			$engineers_id = $output_engineers['id'];

			$checks = sqlsrv_query( $con ,"SELECT DISTINCT username FROM
           	[tranning_Database].[dbo].[Report_Electricity_down_Zoz] where username !=' ' and  ID = '$engineers_id'");
                while($outputs = sqlsrv_fetch_array($checks)) {
                    $selected = (isset($_POST['username']) && $_POST['username'] == $outputs['username']) ? 'selected' : '';
                    echo '<option value="'.$outputs['username'].'" '.$selected.'>'.$outputs['username'].'</option>';
			    }
			  }
			}
		
			}*/

			  ?>
			   <!-- </select>
            </div>
        </div> -->

      <div class="input-group-btn col-md-4">
       	<button class="btn btn w-50"type='submit' style="background-color:#55608f;color:white;" name='submit' value="Get data" ><i class="fa fa-check"></i> Submit</button>
       </div>

	        </div>
	    </div>
<br>


       
<?php
  if(isset($_POST['submit'])){
?>
<div style="padding: 20px;">

 <h2 style="color:; ">Table Filter</h2>
    <input type="search" class="light-table-filter"data-table="order-table"placeholder="Filter"/>
    <br>
    <br>
		<div class="tableFixHead">
		  <table class="table order-table"  cellspacing="0" id="tblCustomers" >
 <thead style="color: white;font-size: 15px;background-color:#55608f;border: 1px solid white; ">
 		  <th>Username</th>
		  <th>Month</th>
		  <th>Electricity down </th>
		</thead>          
   
		<tbody>
			 <?php
			$this_year = date('Y');
			if ($_SESSION['role_id'] == 1){//Admin
			$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE role_id = 0");
			    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
			$engineers_id = $output_engineers['id'];
		
		
			$first_query = sqlsrv_query( $con ,"SELECT * FROM
           	[tranning_Database].[dbo].[Report_Electricity_down_Zoz] where username !=' ' and  ID = '$engineers_id'and [TaskMonth] = '$newMonth'  AND TaskYear='$this_year' ");
       	
			  while( $output_query = sqlsrv_fetch_array($first_query)){
			$rows  ='<tr>';
			$rows .='<td class="hovers" style="border: 1px solid #eee;">'.$output_query["username"].'</td>';
			$rows .='<td class="hovers" style="border: 1px solid #eee;">'.$output_query["TaskMonth"].'</td>';
			$rows .= '<td class="hovers" style="border: 1px solid #eee;">'.$output_query["task_time"]->format('h:i:s').'</td>';
		
			$rows .='</tr>';
			echo $rows;
				
			}
		}
	   }//role end
	   if ($_SESSION['role_id'] == 2){//senior
			$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE manager_id = '$self'");
			    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
			$engineers_id = $output_engineers['id'];
		
		
			$first_query = sqlsrv_query( $con ,"SELECT * FROM
           	[tranning_Database].[dbo].[Report_Electricity_down_Zoz] where username !=' ' and  ID = '$engineers_id'and [TaskMonth] = '$newMonth'  AND TaskYear='$this_year' ");
       	
			  while( $output_query = sqlsrv_fetch_array($first_query)){
			$rows  ='<tr>';
			$rows .='<td class="hovers" style="border: 1px solid #eee;">'.$output_query["username"].'</td>';
			$rows .='<td class="hovers" style="border: 1px solid #eee;">'.$output_query["TaskMonth"].'</td>';
			$rows .= '<td class="hovers" style="border: 1px solid #eee;">'.$output_query["task_time"]->format('h:i:s').'</td>';
		
			$rows .='</tr>';
			echo $rows;
				
			}
		}
	   }//role end
			if ($_SESSION['role_id'] == 3){//super
			$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE super_id = '$self'");
			    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
			$engineers_id = $output_engineers['id'];
		
		
			$first_query = sqlsrv_query( $con ,"SELECT * FROM
           	[tranning_Database].[dbo].[Report_Electricity_down_Zoz] where username !=' ' and  ID = '$engineers_id'and [TaskMonth] = '$newMonth'  AND TaskYear='$this_year' ");
       	
			  while( $output_query = sqlsrv_fetch_array($first_query)){
			$rows  ='<tr>';
			$rows .='<td class="hovers" style="border: 1px solid #eee;">'.$output_query["username"].'</td>';
			$rows .='<td class="hovers" style="border: 1px solid #eee;">'.$output_query["TaskMonth"].'</td>';
			$rows .= '<td class="hovers" style="border: 1px solid #eee;">'.$output_query["task_time"]->format('h:i:s').'</td>';
		
			$rows .='</tr>';
			echo $rows;
				
			}
		}
	   }//role end
	   if ($_SESSION['role_id'] == 4){//super
			$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE section_id = '$self'");
			    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
			$engineers_id = $output_engineers['id'];
		
		
			$first_query = sqlsrv_query( $con ,"SELECT * FROM
           	[tranning_Database].[dbo].[Report_Electricity_down_Zoz] where username !=' ' and  ID = '$engineers_id'and [TaskMonth] = '$newMonth'  AND TaskYear='$this_year' ");
       	
			  while( $output_query = sqlsrv_fetch_array($first_query)){
			$rows  ='<tr>';
			$rows .='<td class="hovers" style="border: 1px solid #eee;">'.$output_query["username"].'</td>';
			$rows .='<td class="hovers" style="border: 1px solid #eee;">'.$output_query["TaskMonth"].'</td>';
			$rows .= '<td class="hovers" style="border: 1px solid #eee;">'.$output_query["task_time"]->format('h:i:s').'</td>';
		
			$rows .='</tr>';
			echo $rows;
				
			}
		}
	   }//role end
	   if ($_SESSION['role_id'] == 5){//super
			$check_engineers = sqlsrv_query( $con ,"SELECT * FROM employee WHERE UnitManager_id = '$self'");
			    while( $output_engineers = sqlsrv_fetch_array($check_engineers)){
			$engineers_id = $output_engineers['id'];
		
		
			$first_query = sqlsrv_query( $con ,"SELECT * FROM
           	[tranning_Database].[dbo].[Report_Electricity_down_Zoz] where username !=' ' and  ID = '$engineers_id'and [TaskMonth] = '$newMonth'  AND TaskYear='$this_year' ");
       	
			  while( $output_query = sqlsrv_fetch_array($first_query)){
			$rows  ='<tr>';
			$rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$output_query["username"].'</td>';
			$rows .='<td  class="hovers" style="border: 1px solid lightgray;">'.$output_query["TaskMonth"].'</td>';
			$rows .= '<td  class="hovers" style="border: 1px solid lightgray;">'.$output_query["task_time"]->format('h:i:s').'</td>';
		
			$rows .='</tr>';
			echo $rows;
				
			}
		}
	   }//role end

	}//submit
		
			?>
						</tbody>
					</table>
				</div>
			</div>
		</form>
	</div>

				


<script src="js/bootstrap22.min.js"></script>
<script src="js/raphael22.min.js"></script>
<script src="js/morris22.min.js"></script>
<script src="js/fastclick22.js"></script>
<script src="js/adminlte22.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/morris.js"></script>
<script src="js/Chart.min"></script>
<script src="js/table2excel.js" type="text/javascript"></script>

<script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "monthly_electricity_report.xls"
            });
        }
    </script>
<script src="table-filter.js"></script>

<?php 
include ("footer.html");
?>
