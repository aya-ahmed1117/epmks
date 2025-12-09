

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Missing</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php  include ("pages.php");
?>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet"/>  
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <?php 
require_once("inc/config.inc");

  if($_SESSION['username'] == ''){ header("location: index.php"); }
      if(isset($_GET['logout'])){ session_destroy(); header("location: index.php"); }
   $self = $_SESSION['id'];
   $role_id = $_SESSION['role_id'];
   $s_username = $_SESSION['username'];
   $unit = $_SESSION['Unit_Name'];

 if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 2000)) {
// last request was more than 30 minutes ago
session_unset();     // unset $_SESSION variable for the run-time 
session_destroy();   // destroy session data in storage
header("location: index.php");
}
$_SESSION['LAST_ACTIVITY'] = time();
                    


if (isset($_SESSION['id'])) { $aya = $_SESSION['id']; }
$checkme = sqlsrv_query( $con ,"SELECT * FROM [employee] WHERE [id] = '$aya'");
$output = sqlsrv_fetch_array($checkme );
$Unit_Name = $output['Unit_Name'];
$username_id = $output['username_id'];

$self = $_SESSION['id'];
$check_request = sqlsrv_query($con,"SELECT * FROM employee_web_table
  where manager = '$self'");
while($outputing = sqlsrv_fetch_array($check_request)){
$employees = $outputing['id'];
}
$query = sqlsrv_query($con ,"with x as (

SELECT count(distinct deduction.[id]) as test   FROM deduction
      left join [dbo].[employee_web_table] on [dbo].[employee_web_table].id = deduction.[engineer_id]
 
  WHERE  [status] ='pending'and [manager] ='$self'
   
   union all

SELECT count(distinct leaves.[id]) as test  FROM leaves
        left join [dbo].[employee_web_table] on [dbo].[employee_web_table].id = leaves.[engineer_id]

 WHERE [status] ='pending'  and [manager] ='$self'
  union all

SELECT  count(distinct [s_id]) as test  FROM create_task 
      left join [dbo].[employee_web_table] on [dbo].[employee_web_table].id = create_task.[engineer_id]
  
  WHERE  [status] ='pending'and [manager] ='$self'
    union all

  SELECT  count(distinct [oncall_sd].[id]) as test  FROM  [dbo].[oncall_sd]
      left join [dbo].[employee_web_table] on [dbo].[employee_web_table].id = [oncall_sd].[engineer_id]

  WHERE  [status] ='pending'and [manager] ='$self'
    union all
  SELECT  count(distinct [swaping].[id]) as test  FROM  [dbo].[swaping]
      left join [dbo].[employee_web_table] on [dbo].[employee_web_table].id = [swaping].[engineer_id]
  
  WHERE  [status] ='pending'and [manager] ='$self'
  
  )
  SELECT sum(test) as counting from x");

 while($query_out = sqlsrv_fetch_array($query)){
 $count = $query_out['counting'];

}
?>
 <style>
  
    .navbar-brand img {
      max-width: 100px; /* Adjust the max-width of the logo */
    }
  </style>
</head>
<body>

 
<div class="content">
<center>
  
<div class="col-md-8">
        <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 0 0 ;">
            <div class="media">
            <div class="media-body">
              <h2 class="text-dark display-12" >Missing Data</h2>
              <p style="color:lightgray;">Welcome :
               <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Here you can see All the dates those are missing  </p>
  </aside>
</div>
</center>
</div>

<div class="body" style="padding:20px;">
  <div class="container-fluid">
      <aside class="profile-nav alt" style="border:1px solid rgba(0,0,0,.125);
        border-radius: 20px 20px 20px 20px;">
            <div class="card-header user-header alt bg-light"
            style="border-radius: 20px 20px 20px 20px ;">
            <div class="media"></div>
            <div class="media-body">

    <!-- Form for Date Selection -->
    <?php if($_SESSION['role_id'] == 1):?>

    <!-- <form  class="mt-4"> -->
      <div class="row">
        <div class="col-md-4">
          <div class="input-group">
            <span class="input-group-text" id="basic-addon1">Choose Date</span>
            <input type="date" class="form-control date_time"  id="dates" name='date_time' required />
            <button class="btn btn-primary sendDate"  
            name='sendDate' value="Get data">Submit</button>
          </div>
        </div>
      </div>

<?php  endif; //end roleID?>
          <!-- </form> -->

  <h2 class='mb-3'>Missing Data</h2>
    <table class="table table-hover table-bordered table-sm text-center dataTable"id="example" cellpadding="0" cellspacing="0" border="0" class="dataTable"
    style="border-radius:0 0 30px 30px;" width="100%" align="center">
      <thead>
        <tr>
          <th>ID number</th>
          <th>Date</th>
              <?php if($_SESSION['role_id'] == 1):?>

          <th>Delete</th> 
          <?php  endif; //end roleID?>
         
        </tr>
      </thead>
    <tbody>

<?php
      $chooseD= sqlsrv_query($con , "SELECT * FROM [WorkForce_Reporting_DB].[dbo].[missing_data] order by creation_time DESC");
        $counter = 0;
        while($getData=sqlsrv_fetch_array($chooseD)){ 
          $dateT = $getData['date_time']->format('Y-m-d');
          $dateID = $getData['ID'];
          $creator_name = $getData['creator_name'];
          $counter++; // Increment row counter

        ?>
        <tr data-rowid="<?php echo $dateID;?>">   
          <td><?php echo $counter;?></td>
          <td><?php echo $dateT;?></td>
        <?php if($_SESSION['role_id'] == 1):?>
          <td><a  name="deleted" class="view_data" 
            id="<?php echo $dateID;?>"><li class="fa fa-trash-o"></li></a></td>
          <?php  endif; ?>
        </tr>
        <?php }?>
          </tbody>
              <tfoot>
                <tr>
                  <th>ID Number</th>
                  <th>Date</th>
                <?php if($_SESSION['role_id'] == 1):?>
                  <th>Delete</th> 
                <?php  endif; ?>         
                </tr>
              </tfoot>
            </table>

        <script type="text/javascript">
        $(document).ready(function(){ 
            $(document).on('click', '.sendDate', function(){
                var date_time = $('.date_time').val(); 
                if(date_time != ''){
                 $.ajax({   
                    url: 'insert_missing.php',
                    type: 'POST',
                    data:'date_time='+date_time, 
                    cache: false,  
              success:function(data){
               
         swal({ title: "Done", icon: "success",}).
         then(function() {
                window.location.href=window.location.href
            });
 // console.log(date_time);
          }
                }); 
return false;
      } 
               }); 
        });
           </script>
        <script type="text/javascript">
            $(document).ready(function(){ 
               $(document).on('click', '.view_data', function(){  
           var id = $(this).attr("id"); 
           Swal.fire({
                title: 'Do you want to delete ID num :' + id,
                icon: 'question',
                iconHtml: '؟',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                showCancelButton: true,
                showCloseButton: true

              }).then((result) => {
                if (result.isConfirmed) {
                 $.ajax({   
                    url: 'delete_missing.php',
                    type: 'POST',
                    data:'id='+id, 
                    cache: false,  
              success:function(deleted){
                 $("tr[data-rowid='" + id +"']").fadeOut();
                 Swal.fire({
                title: 'done deleted',
                icon: 'success'
              }).
         then(function() {
                window.location.href=window.location.href
            });
 
          }
                });  
                  
                  }
              })
            });
          });

            </script>
             
        </div>
      </div>
    </aside>
  </div>
</div>
     
     
  
 <script type="text/javascript" src="jQuery/sweetalert.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="jQuery/bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>

  $(document).ready(function() {
  $('#example').DataTable( {
  "lengthMenu": [[5,10,25,50, -1], [5,10,25,50, "All"]],
  "sPaginationType": "full_numbers",
          "oLanguage": {
              "sLengthMenu": "Beebop _MENU_ adoowop"
        }
    } );
  } );
</script>

</body>
  <?php include ("footer.html");
     ?>
</html>