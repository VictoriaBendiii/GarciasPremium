<?php include '../connection.php'; ?>
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
    echo 'OK';
  } else if ($usertype == "sub-admin2") {
    $branchid =2;
    echo 'OK';
  } else {
    $branchid =3;
    echo 'OK';
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

  $hash_password = password_hash($password, PASSWORD_DEFAULT);
echo 'OK';
  

  	$sql = "INSERT INTO accounts (username, email, password, user_type, firstname, middlename, lastname, contact_number, status, branchid) 
          VALUES('$username', '$email', '$hash_password', '$usertype','$firstname', '$middlename', '$lastname', '$contact_number',  '$status', '$branchid')";
    
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
    $conn->close();
}

?>