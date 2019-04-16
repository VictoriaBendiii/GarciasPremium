<?php include 'connect.php'; ?>
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

  	$sql = "INSERT INTO products (name, status, branchid) 
          VALUES('$prodname', '$status', '$branchid')";
          
  	//$_SESSION['username'] = $username;
  	//$_SESSION['success'] = "You are now logged in";
  	//header('location: index.php');
 
    if(mysqli_query($conn, $sql)) {
       header('location: index.php');
    } else {
        echo "failed" ;
    }

    $conn->close();
}

?>