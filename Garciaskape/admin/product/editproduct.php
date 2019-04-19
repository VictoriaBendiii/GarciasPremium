<?php include '../includes/connection.php'; ?>
<?php

if(isset($_POST['edit_product'])){ 
    $id = mysqli_real_escape_string($conn, $_POST['productid']);
    $productname = mysqli_real_escape_string($conn, $_POST['productname']);


    $sql = "UPDATE products SET productname='$productname' WHERE productid='$id'";

    mysqli_query($conn, $sql);
    header("location: product.php");  



    $conn->close();
}
?>