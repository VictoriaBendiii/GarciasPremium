<?php include '../includes/connection.php'; ?>
<?php

session_start();

if (isset($_GET['activate'])) {
    $id = $_GET['activate'];
    $sql_query = "UPDATE accounts SET status='Active' WHERE accountid=$id";
    mysqli_query($conn, $sql_query);
    $_SESSION['message']="Account of has been activated!";
    $_SESSION['msg_type']="success";
    header("location: accounts.php");
}

if (isset($_GET['deactivate'])) {
    $id = $_GET['deactivate'];
    $sql_query ="UPDATE accounts SET status='Deactivated' WHERE accountid=$id";
    mysqli_query($conn, $sql_query);
    $_SESSION['message'] = "Account has been deactivated!";
    $_SESSION['msg_type'] = "danger";
    header("location: accounts.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql_query ="DELETE FROM accounts WHERE accountid=$id";
    mysqli_query($conn, $sql_query);
    $_SESSION['message'] = "Account permanently deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: deac_accounts.php");
}

if (isset($_POST['edit_account'])) {
    $id = mysqli_real_escape_string($conn, $_POST['accountid']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $usertype = mysqli_real_escape_string($conn, $_POST['usertype']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    // VALIDATION of USERNAME
    if (preg_match("/^[a-zA-Z][0-9]/", $username)) {
        $_SESSION['message']="username must be alphabhets only!";
        $_SESSION['msg_type']="danger";
        header("location: addaccount.php");
        die();
    }

    //Check username for duplicates
    $query_username = "SELECT * FROM accounts WHERE username='$username'";
    $result = mysqli_query($conn, $query_username);
    $usercount=mysqli_num_rows($result);
    if ($usercount > 0) {
        $_SESSION['message']="Username ".$username." already exists!";
        $_SESSION['msg_type']="danger";
        header("location: addaccount.php");
        die();
    }
    //Check email for duplicates
    $query_email = "SELECT * FROM accounts WHERE email='$email'";
    $result = mysqli_query($conn, $query_email);
    $emailcount=mysqli_num_rows($result);
    if ($emailcount > 0) {
        $_SESSION['message']="Email ".$email." already exists!";
        $_SESSION['msg_type']="danger";
        header("location: addaccount.php");
        die();
    }

    //Check contact number for duplicates
    $query_con = "SELECT * FROM accounts WHERE contact_number='$contact_number'";
    $result = mysqli_query($conn, $query_con);
    $concount=mysqli_num_rows($result);
    if ($concount > 0) {
        $_SESSION['message']="Contact number ".$contact_number." already exists!";
        $_SESSION['msg_type']="danger";
        header("location: addaccount.php");
        die();
    }
    //Check password length
    if (strlen($confirm_password) < 10 && strlen($confirm_password) > 8) {
        $_SESSION['message']="Contact number ".$contact_number." already exists!";
        $_SESSION['msg_type']="danger";
        header("location: accounts.php");
        die();
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