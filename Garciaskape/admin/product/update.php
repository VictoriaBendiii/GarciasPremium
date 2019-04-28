<?php include '../includes/connection.php'; ?>

<?php

if(!isset($_SESSION))
    {
        session_start();
    } 

if(isset($_POST['edit_product'])){
    $id = mysqli_real_escape_string($conn, $_POST['productid']);
    $productname = mysqli_real_escape_string($conn, $_POST['productname']);


    $sql = "UPDATE products SET productname='$productname' WHERE productid='$id'";
    mysqli_query($conn, $sql);
    $_SESSION['message']="".$productname." has been edited!";
    $_SESSION['msg_type']="success";

    header('location: product.php');
}

if (isset($_GET['activate'])){

    $id = $_GET['activate'];
    $sql_query ="UPDATE products SET status='active' WHERE productid=$id";
    mysqli_query($conn, $sql_query);
    $_SESSION['message'] = "Product has been restored!";
    $_SESSION['msg_type'] = "success";
    header("location: archivedproducts.php");
}

if (isset($_GET['deactivate'])){

    $id = $_GET['deactivate'];
    $sql_query ="UPDATE products SET status='deactivated' WHERE productid=$id";
    mysqli_query($conn, $sql_query);
    $_SESSION['message'] = "Product has been archived!";
    $_SESSION['msg_type'] = "danger";
    header("location: product.php");
}

if (isset($_GET['delete'])){

    $id = $_GET['delete'];
    $sql_query ="DELETE FROM products WHERE productid=$id";
    mysqli_query($conn, $sql_query);
    $_SESSION['message'] = "Product permanently deleted!";
    $_SESSION['msg_type'] = "danger";
    header("location: archivedproducts.php");
}


?>
