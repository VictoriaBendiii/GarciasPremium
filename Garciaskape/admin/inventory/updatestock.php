<?php include '../includes/connection.php'; ?>
<?php


if(isset($_POST['edit_product'])){
    $id = mysqli_real_escape_string($conn, $_POST['productid']);
    $quantity = $_POST['productstock'];


    $sql = "UPDATE stock SET quantity='$quantity' WHERE productid='$id' AND branchid = '1'";
    mysqli_query($conn, $sql);
    $_SESSION['message']="".$quantity." has been edited!";
    $_SESSION['msg_type']="success";

    header('location: inventory.php');
}

if(isset($_POST['edit_productporta'])){
    $id = mysqli_real_escape_string($conn, $_POST['productidporta']);
    $quantity = $_POST['productstockporta'];


    $sql = "UPDATE stock SET quantity='$quantity' WHERE productid='$id' AND branchid = '2'";
    mysqli_query($conn, $sql);
    $_SESSION['message']="".$quantity." has been edited!";
    $_SESSION['msg_type']="success";

    header('location: inventoryporta.php');
}