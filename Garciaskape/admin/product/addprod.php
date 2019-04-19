<?php include '../includes/connect.php'; ?>
<?php


if (isset($_POST['add_prod'])) {

  $prodname = mysqli_real_escape_string($conn, $_POST['prodname']);

  $status = "Active";

  $branchid = 3;


  	$sql = "INSERT INTO products (name, status, branchid) 
          VALUES('$prodname', '$status', '$branchid')";
          
          mysqli_query($conn, $sql_query);
          header("location: addproduct.php");

    $conn->close();
}

?>