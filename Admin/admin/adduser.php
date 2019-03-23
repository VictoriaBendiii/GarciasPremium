<?php include 'connect.php'; ?>
<?php

if (isset($_POST['add_user'])) {

  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
  $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
  $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
  $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
  $usertype = mysqli_real_escape_string($conn, $_POST['usertype']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  
  	$password = md5($password);

  	$sql = "INSERT INTO accounts (username, password, user_type, lastname, firstname, middlename, contact_number, email) 
          VALUES('$username', '$password', '$usertype','$firstname', '$middlename', '$lastname', '$contact_number', '$email')";
    
    mysqli_query($conn, $sql);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');


    $conn->close();
}

?>