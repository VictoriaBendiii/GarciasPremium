<?php include '../includes/connection.php'; ?>
<?php

session_start();
if (isset($_POST['add_prod'])) {
    $prodname = mysqli_real_escape_string($conn, $_POST['prodname']);

    $status = "Active";

    $branchid = 3;


    $sql = "INSERT INTO products (productname, branchid,status) 
          VALUES('$prodname','$branchid' ,'$status' )";
    mysqli_query($conn, $sql);
    $_SESSION['message']="Product has been added to Market and Porta Vaga!";
    $_SESSION['msg_type']="success";

    header('location: addproduct.php'); 


    $conn->close();

    $conn->close();
}

?>