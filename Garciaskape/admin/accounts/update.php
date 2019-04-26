<?php include '../includes/connection.php'; ?>
<?php

if (isset($_GET['activate'])){

    $id = $_GET['activate'];
    $sql_query = "UPDATE accounts SET status='active' WHERE accountid=$id";
    mysqli_query($conn, $sql_query);
    $_SESSION['message']="Account of has been activated!";
    $_SESSION['msg_type']="success";
   header("location: accounts.php");

} else if (isset($_GET['deactivate'])){

    $id = $_GET['deactivate'];
    $sql_query ="UPDATE accounts SET status='deactivated' WHERE accountid=$id";
    mysqli_query($conn, $sql_query);
    $_SESSION['message'] = "Account has been deactivated!";
    $_SESSION['msg_type'] = "danger";
    header("location: accounts.php");
}

else if (isset($_GET['delete'])){

    $id = $_GET['delete'];
    $sql_query ="DELETE FROM accounts WHERE accountid=$id";
    mysqli_query($conn, $sql_query);
    $_SESSION['message'] = "Account has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: accounts.php");
}

if(isset($_POST['edit_account'])){
    $id = mysqli_real_escape_string($conn, $_POST['accountid']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $usertype = mysqli_real_escape_string($conn, $_POST['usertype']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

      
    if ($password != $confirm_password) {
        array_push($errors, "The two passwords do not match");
      }
    
      $ecnrypt_password = base64_encode($password);
    
          $sql = "UPDATE accounts SET username='$username', 
          password='$ecnrypt_password', 
          firstname='$firstname',
          lastname='$lastname', 
          user_type='$usertype',
          contact_number='$contact_number',
          email='$email' 
          WHERE accountid='$id'";
        
        mysqli_query($conn, $sql);
        $_SESSION['message']="Account of ".$firstname. " has been edited!";
        $_SESSION['msg_type']="success";
        header("location: accounts.php");  
 
    
    
        $conn->close();
    }

?>