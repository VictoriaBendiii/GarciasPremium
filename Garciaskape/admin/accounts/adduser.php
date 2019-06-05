<?php include '../includes/connection.php'; ?>
<?php

if (isset($_POST['add_user'])) {

    //GET DATA FROM FORM
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
    
    // Contact number concatenation
    $cpCode = "+63";
    $finContact = $cpCode . $contact_number;

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
    $query_con = "SELECT * FROM accounts WHERE contact_number='$finContact'";
    $result = mysqli_query($conn, $query_con);
    $concount=mysqli_num_rows($result);
    if ($concount > 0) {
        $_SESSION['message']="Contact number ".$finContact." already exists!";
        $_SESSION['msg_type']="danger";
        header("location: addaccount.php");
        die();
    }

    //Branch Assignment
    if ($usertype == "sub-admin1") {
        $branchid =1;
    } elseif ($usertype == "sub-admin2") {
        $branchid =2;
    } else {
        $branchid =3;
    }
        
    // PASSWORD ENCRYPTION
    $ecnrypt_password = base64_encode($password);
    
  
    //Start of insertion to database
    $sql = "INSERT INTO accounts (username, email, password, user_type, firstname, middlename, lastname, contact_number,
        status, branchid)
        VALUES('$username', '$email', '$ecnrypt_password', '$usertype','$firstname', '$middlename', '$lastname',
        '$finContact', '$status', '$branchid')";
    $_SESSION['message']="Account ".$username. " created";
    $_SESSION['msg_type']="success";

    mysqli_query($conn, $sql);
    header("location: addaccount.php");
}
  

  ?>
