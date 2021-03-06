<?php include '../includes/connection.php'; ?>
<?php


if (isset($_GET['activate'])){

    $id = $_GET['activate'];
    $sql_query = "UPDATE supplier SET status='Active' WHERE supplierid=$id";
    mysqli_query($conn, $sql_query);
    $_SESSION['message']="Supplier account activated";
    $_SESSION['msg_type']="success";
    header("location: deac_supplier.php");


}
if (isset($_GET['deactivate'])){

    $id = $_GET['deactivate'];
    $sql_query ="UPDATE supplier SET status='Deactivated' WHERE supplierid=$id";
    mysqli_query($conn, $sql_query);
    $_SESSION['message']="Supplier account deactivated";
    $_SESSION['msg_type']="danger";
    header("location: supplier.php");
    die();
}
if (isset($_GET['delete'])){

    $id = $_GET['delete'];
    $sql_query ="DELETE FROM supplier WHERE supplierid=$id";
    mysqli_query($conn, $sql_query);
    $_SESSION['message'] = "Supplier account has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: deac_supplier.php");
}


if(isset($_POST['edit_supplier'])){
    $id = mysqli_real_escape_string($conn, $_POST['supplierid']);
    $supplier_name = mysqli_real_escape_string($conn, $_POST['supplier_name']);
    $supplier_contact_person = mysqli_real_escape_string($conn, $_POST['supplier_contact_person']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);




    $sql = "UPDATE supplier SET supplier_name='$supplier_name',
          supplier_contact_person='$supplier_contact_person',
          contact_number='$contact_number',
          address='$address'
		  WHERE supplierid='$id'";

    mysqli_query($conn, $sql);
    $_SESSION['message']="Account of ".$supplier_name. " has been edited!";
    $_SESSION['msg_type']="success";
    header("location: supplier.php");



    $conn->close();
}

?>
