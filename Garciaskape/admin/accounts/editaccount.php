<?php include '../connection.php'; ?>
<?php

if(isset($_POST['edit_account'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $usertype = mysqli_real_escape_string($conn, $_POST['usertype']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    if ($password != $confirm_password) {
        array_push($errors, "The two passwords do not match");
      }
    
      $hash_password = password_hash($password, PASSWORD_DEFAULT);
    
          $sql = "UPDATE accounts WHERE username='$username', 
          password='$hash_password', 
          firstname='$firstname',
          lastname='$username', 
          user_type='$usertype',
          contact_number='$contact_number',
          email='$email'";
        
        mysqli_query($conn, $sql);
        header("location: accounts.php");  
 
    
    
        $conn->close();
    }
    ?>