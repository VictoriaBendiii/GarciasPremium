<?php include '../includes/connection.php'; ?>
<?php

if (isset($_POST['add_supplier'])) {

    $supplier_name = mysqli_real_escape_string($conn, $_POST['supplier_name']);
    $contact_person = mysqli_real_escape_string($conn, $_POST['contact_person']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $status = 'active';

    $sql = "INSERT INTO supplier (supplier_name, supplier_contact_person, contact_number, address, status) 
          VALUES('$supplier_name', '$contact_person', '$contact_number','$address', '$status')";

    mysqli_query($conn, $sql);
    $_SESSION['message']="Account of ".$supplier_name. " has been created!";
    $_SESSION['msg_type']="success";

    header('location: addsupplier.php'); 


    $conn->close();
}

?>