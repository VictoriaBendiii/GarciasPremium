<?php include '../includes/connection.php'; ?>
<?php

//echo "loaded process";
// REGISTER USER
if (isset($_POST['add_prod'])) {
    // receive all input values from the form
    $prodname = mysqli_real_escape_string($conn, $_POST['prodname']);
    //echo "received prodname";
    $status = "Active";
    //declare the status into "Active";
    $branchid = mysqli_real_escape_string($conn, $_POST['branchid']);
    //echo "received branchid";

    $sql = "INSERT INTO products (productname, branchid,status) 
          VALUES('$prodname','$branchid' ,'$status' )";

    //$_SESSION['username'] = $username;
    //$_SESSION['success'] = "You are now logged in";
    //header('location: index.php');

    if(mysqli_query($conn, $sql)) {
        header('location: product.php');
    } else {
        echo "failed" ;
    }

    $conn->close();
}

?>