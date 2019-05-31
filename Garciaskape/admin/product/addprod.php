<?php include '../includes/connection.php'; ?>
<?php
session_start();
if (isset($_POST['add_prod'])) {
    $prodname = mysqli_real_escape_string($conn, $_POST['prodname']);
    $status = "Active";
    $branchid = 3;
    // check for existing product
    $query_uproductname = "SELECT * FROM products WHERE productname='$prodname'";
    $result = mysqli_query($conn, $query_uproductname);
    $productcount=mysqli_num_rows($result);
    if ($productcount > 0) {
        $_SESSION['message']="Product or product name already exists!";
        $_SESSION['msg_type']="danger";
        header("location: addproduct.php");
        die();
    }

    // adding of product to database
    $sql = "INSERT INTO products (productname, branchid,status) 
          VALUES('$prodname','$branchid' ,'$status' )";
    mysqli_query($conn, $sql);
    $_SESSION['message']="New product has been added to Market and Porta Vaga!";
    $_SESSION['msg_type']="success";

    header('location: addproduct.php'); 

    $conn->close();
}

?>