<?php include 'connection.php'; ?>
<?php

if (isset($_POST['add_user'])) {

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $con_password = mysqli_real_escape_string($conn, $_POST['con_password']);
  $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
  $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
  $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
  $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
  $usertype = mysqli_real_escape_string($conn, $_POST['usertype']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  if (empty($username)) { 
    array_push($errors, "Username is required");
  }
  
  if (empty($password)) {
    array_push($errors, "Password is required"); 
  }

  if ($password != $con_password) {
    array_push($errors, "The two passwords do not match");
  }

  	$sql = "INSERT INTO accounts (username, password, user_type, firstname, middlename, lastname, contact_number, email) 
          VALUES('$username', '$password', '$usertype','$firstname', '$middlename', '$lastname', '$contact_number', '$email')";
    
    mysqli_query($conn, $sql);
  	

  	header('location: ../index.php'); 


    $conn->close();
}

?>