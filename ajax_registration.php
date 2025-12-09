 <?php 
 
        if(isset($_POST['username'])){ $username = $_POST['username']; }
        if(isset($_POST['password'])){ $password = $_POST['password']; }
        if(isset($_POST['repassword'])){ $repassword = $_POST['repassword']; }
        if(isset($_POST['role_id'])){$role_id = $_POST['role_id'];}
        if(isset($_POST['manager_id'])){$manager_id = $_POST['manager_id'];}
        if(isset($_POST['Unit_Name'])){$Unit_Name = $_POST['Unit_Name'];}
        if(isset($_POST['username_id'])){$username_id = $_POST['username_id'];}


      
	if ($password !== "" && $username !== "" && $role_id !== "" && $manager_id !== "" && $repassword !== "") {
	    if ($password == $repassword){
//sqlsrv_query( $con ,
	$insert_q = "INSERT INTO employee ([username], [password], [role_id], [manager_id] , [Unit_Name] , 
  [username_id]) 
  VALUES ('$username', '$password', '$role_id', '$manager_id' ,'$Unit_Name' , '$username_id')";//);

  // echo  "INSERT INTO employee ([username], [password], [role_id], [manager_id] , [Unit_Name] , 
  // [username_id]) 
  // VALUES ('$username', '$password', '$role_id', '$manager_id' ,'$Unit_Name' , '$username_id')";

		if($insert_q){

		}

		else { echo 'password input fields donot match.'; }
      
        

        ?> 