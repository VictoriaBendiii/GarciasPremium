<?php include '../includes/connection.php'; ?>
<?php
session_start();
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

    // VALIDATION of USERNAME
    if (preg_match("/^[a-zA-Z][0-9]/", $username)) {
        $_SESSION['message']="username must be alphabhets only!";
        $_SESSION['msg_type']="danger";
        header("location: addaccount.php");
        die();
    }
    
    //VALIDATION of FIRST, MIDDLE, AND LAST NAME
    if (preg_match("/^[a-zA-Z][0-9]/", $firstname)) {
        $_SESSION['message']="First name must be alphabhets only!";
        $_SESSION['msg_type']="danger";
        header("location: addaccount.php");
        die();
    }
    if (preg_match("/^[a-zA-Z][0-9]/", $middlename)) {
        $_SESSION['message']="Middle name must be alphabhets only!";
        $_SESSION['msg_type']="danger";
        header("location: addaccount.php");
        die();
    }
    if (preg_match("/^[a-zA-Z][0-9]/", $lastname)) {
        $_SESSION['message']="Last name must be alphabhets only!";
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
        '$contact_number', '$status', '$branchid')";
    $_SESSION['message']="Account ".$username. " created";
    $_SESSION['msg_type']="success";

    mysqli_query($conn, $sql);
    header("location: addaccount.php");
}
  

  ?>