

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Add Users</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php  include ("pages.php");
?>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet"/>  
  <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style type="text/css">
  .coltwo {
  color:red;
  text-align: left;
  vertical-align: top;
  padding-top:9px;
}</style>

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
/*$check_request = sqlsrv_query($con,"SELECT * FROM employee_web_table
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

}*/
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
              <h2 class="text-dark display-12" >Add Users To Training Table</h2>
              <p style="color:lightgray;">Welcome :
               <?php echo $_SESSION["username"];?></p>
              </div>
          </div>
      </div>
       <p style="background-color:#55608f;font-weight:bold;font-size:16px;
       color:white;">Here you can add users to allow them to add thire personal info  </p>
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
            <div class="media"style="border:1px solid rgba(0,0,0,.125);background-color: lightgreen;
        border-radius: 20px 20px 20px 20px;padding: 20px 20px 20px 20px;text-align: center;">
              <span class="text-center" style="display: block; width: 100%; font-weight: bold; font-size:25px;color: #ffff; ">Add Data</span>
          </div>
            <div class="media-body" >

    <!-- Form for Date Selection -->
    <?php if($_SESSION['role_id'] == 1):?>

    <!-- <form  class="mt-4"> -->
    <div class="row">
      <div class="col-xl">
        <div class="mt-4">
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Choose Entry Date</span>
            <input type="date" class="form-control date_time"  id="dates" 
            name='date_time'  />
          </div>
             <div class="input-group mb-3" id="ID"> 
              <span class="input-group-text">ID <samp class="coltwo">*</samp> </span>
                <input type="number" name="ID" 
                class="form-control ID" id="ID" required/>
              </div>
          <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Employee Name <samp class="coltwo">*</samp> </span>
            <input type="text" class="form-control EMP_NAME"  id="EMP_NAME" name='EMP_NAME' required />
          </div>
        </div>
      </div>
      <div class="col-xl">
        <div class="mt-4">
 
           <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">
            <span class="coltwo">*</span>
          Username  </span>
            <input type="text" class="form-control Username"  id="Username" name='Username' required />
          </div>
           <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">National_ID</span>
            <input type="number"  class="form-control National_ID" id="National_ID" name='National_ID'  />
          </div>
           <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Mobile</span>
            <input type="number" class="form-control Mobile"  id="Mobile" name='Mobile'  />
          </div>


          <br>

          </div>
        </div>
        <button class="btn btn-primary sendDate" width="100%" 
            name='sendDate' value="Get data">Submit</button>
      </div>
<hr>
<?php  endif; //end roleID?>
          <!-- </form> -->

  <h2 class='mb-3'>Add users</h2>
    <table class="table table-hover table-bordered table-sm text-center dataTable"id="example" cellpadding="0" cellspacing="0" border="0" class="dataTable"
    style="border-radius:0 0 30px 30px;" width="100%" align="center">
      <thead>
        <tr>
          <th>ID </th>
          <th>Username </th>
          <th>User ID </th>
          <th>ENTRY DATE </th>
          <th>Delete </th>         
        <!--      <?php if($_SESSION['role_id'] == 1):?>

          <th>Delete</th> 
          <?php  endif; //end roleID?>
          -->
        </tr>
      </thead>
    <tbody>

<?php
      $chooseD= sqlsrv_query($con , "SELECT * FROM [Employess_DB].[dbo].[Training] where [status] not like 'delet%' Order by [creation_time] desc");
        $counter = 0;
        while($getData=sqlsrv_fetch_array($chooseD)){ 
          $ID = $getData['ID'];
          $id_num = $getData['id_num'];
          $Username = $getData['Username'];
          $National_ID = $getData['National ID'];
          $ENTRY_DATE = $getData['creation_time'];
          $Status = $getData['Status'];
          $Mobile = $getData['Mobile'];
          $creator_name= $getData['creator_name'];
          $counter++; // Increment row counter

        ?>
        <tr data-rowid="<?php echo $id_num;?>">   
          <td><?php echo $counter;?></td>
          <td><?php echo $ID;?></td>
          <td><?php echo $Username;?></td>
          <!-- <td><?php echo $Username;?></td> -->
          <td><?php echo $ENTRY_DATE->format('Y-m-d H:i:s');?></td>


          <?php if($_SESSION['role_id'] == 1):?>
            <td>
  <a name="deleted" class="view_data" 
     id="<?php echo $id_num;?>" 
     data-username="<?php echo htmlspecialchars($Username); ?>">
    <li class="fa fa-trash-o"></li>
  </a>
</td>


         <!--  <td><a name="deleted" class="view_data" 
            id="<?php echo $id_num;?>" >
            <li class="fa fa-trash-o"></li>
          </a></td> -->
          <?php  endif; ?>


        </tr>
        <?php }?>
          </tbody>
              <tfoot>
                <tr>
                  <th>ID </th>
                  <th>Username </th>
                  <th>User ID </th>
                  <th>ENTRY DATE </th>
                  <th>Delete </th>        
                </tr>
              </tfoot>
            </table>

           </div>
         </aside>
       </div>
      </div>
     </div>

        <script type="text/javascript">
        $(document).ready(function(){ 
            $(document).on('click', '.sendDate', function(){
                var  date_time = $('.date_time').val(); 
                var  ID= $('.ID').val(); 
                var  EMP_NAME= $('.EMP_NAME').val(); 
                var  Username= $('.Username').val(); 
                var  National_ID= $('.National_ID').val(); 
                var  Mobile= $('.Mobile').val(); 
          var alldata = 'date_time='+date_time+'&ID='+ID+'&EMP_NAME='+EMP_NAME+'&Username='+Username+'&National_ID='+National_ID+'&Mobile='+Mobile    

                if((Username != '') && (ID != '')){
                 $.ajax({   
                    url: 'insert_users_Training.php',
                    type: 'POST',
                    data: alldata, 
                    cache: false,  
              success:function(data){             
         swal({ title: "Done", icon: "success",}).
         then(function() {
                window.location.href=window.location.href
              });
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
    var id_num = $(this).attr("id"); 
    var Username = $(this).data("username"); // Get username from data-attribute

    Swal.fire({
      title: 'Do you want to delete user: ' + Username + ' (ID: ' + id_num + ')?',
      icon: 'question',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes',
      cancelButtonText: 'No',
      showCancelButton: true,
      showCloseButton: true
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({   
          url: 'delete_user.php',
          type: 'POST',
          data: 'id_num=' + id_num, 
          cache: false,  
          success: function(deleted){
            $("tr[data-rowid='" + id_num + "']").fadeOut();
            Swal.fire({
              title: 'User deleted',
              icon: 'success'
            }).then(function() {
              window.location.href = window.location.href;
            });
          },
          error: function(err) {
            Swal.fire("Error", "Could not delete user.", "error");
          }
        });
      }
    });
  });
});
</script>

             <!--  <script type="text/javascript">
            $(document).ready(function(){ 
               $(document).on('click', '.view_data', function(){  
           var id_num = $(this).attr("id"); 
           var  Username= $('.Username').val();
           Swal.fire({
                title: 'Do you want to delete id num :' + Username,
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
                    url: 'delete_user.php',
                    type: 'POST',
                    data:'id_num='+id_num, 
                    cache: false,  
              success:function(deleted){
                 $("tr[data-rowid='" + id_num +"']").fadeOut();
                 Swal.fire({
                title: 'Done deleted',
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

            </script> -->

             
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