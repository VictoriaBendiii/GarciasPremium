<?php include '../includes/connection.php';
?>
<?php
session_start();
if (isset($_POST['add_supplier'])) {

    $supplier_name = mysqli_real_escape_string($conn, $_POST['supplier_name']);
    $contact_person = mysqli_real_escape_string($conn, $_POST['contact_person']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $status = 'active';

    
    //Check for duplicates
    $query_supplier = "SELECT * FROM supplier WHERE supplier_name='$supplier_name'";
    $result = mysqli_query($conn, $query_supplier);
    $suppliercount=mysqli_num_rows($result);
    if ($suppliercount > 0) {
        $_SESSION['message']="Supplier name ".$supplier_name." already exists!";
        $_SESSION['msg_type']="danger";
        header("location: addsupplier.php");
        die();
    }
    
    $query_cp = "SELECT * FROM supplier WHERE supplier_contact_person='$contact_person'";
    $result = mysqli_query($conn, $query_cp);
    $cpcount=mysqli_num_rows($result);
    if ($cpcount > 0) {
        $_SESSION['message']="Supplier name ".$contact_person." already exists!";
        $_SESSION['msg_type']="danger";
        header("location: addsupplier.php");
        die();
    }
    
    $query_number = "SELECT * FROM supplier WHERE contact_number='$contact_number'";
    $result = mysqli_query($conn, $query_number);
    $numcount=mysqli_num_rows($result);
    if ($numcount > 0) {
        $_SESSION['message']="Supplier number ".$contact_number." already exists!";
        $_SESSION['msg_type']="danger";
        header("location: addsupplier.php");
        die();
    }
    
    $sql = "INSERT INTO supplier (supplier_name, supplier_contact_person, contact_number, address, status) 
          VALUES('$supplier_name', '$contact_person', '$contact_number','$address', '$status')";

    mysqli_query($conn, $sql);
    $_SESSION['message']="Account of ".$supplier_name. " has been created!";
    $_SESSION['msg_type']="success";

    header('location: addsupplier.php'); 


    $conn->close();
}

?>
