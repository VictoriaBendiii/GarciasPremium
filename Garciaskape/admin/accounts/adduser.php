<?php include '../includes/connection.php'; ?>
<?php

if (isset($_POST['add_user'])) {

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
  $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
  $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
  $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
  $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
  $usertype = mysqli_real_escape_string($conn, $_POST['usertype']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $status = "Active";
  $branchid;
  if ($usertype == "sub-admin1") {
    $branchid =1;
    
  } else if ($usertype == "sub-admin2") {
    $branchid =2;
    
  } else {
    $branchid =3;
    
  }
  if (empty($username)) { 
    array_push($errors, "Username is required");
  }
  
  if (empty($password)) {
    array_push($errors, "Password is required"); 
  }

  if ($password != $confirm_password) {
    array_push($errors, "The two passwords do not match");
  }

  // for encryption
  
  $ecnrypt_password = base64_encode($password);

  	$sql = "INSERT INTO accounts (username, email, password, user_type, firstname, middlename, lastname, contact_number, status, branchid) 
          VALUES('$username', '$email', '$ecnrypt_password', '$usertype','$firstname', '$middlename', '$lastname', '$contact_number',  '$status', '$branchid')";
    $_SESSION['message']="Account ".$username. " created";
    $_SESSION['msg_type']="success";

    mysqli_query($conn, $sql);
    header("location: account.php");
}

?>