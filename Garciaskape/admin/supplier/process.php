<?php include '../includes/connection.php'; ?>
<?php

if (isset($_POST['add_supplier'])) {

    $supplier_name = mysqli_real_escape_string($conn, $_POST['supplier_name']);
    $contact_person = mysqli_real_escape_string($conn, $_POST['contact_person']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $status = 'active';


    if (empty($supplier_name)) { 
        array_push($errors, "Supplier name is required!");
    }

    if (empty($contact_person)) {
        array_push($errors, "Contact Person is required!"); 
    }

    if (empty($contact_number)) {
        array_push($errors, "Contact Number is needed!"); 
    }

    if (empty($address)) {
        array_push($errors, "Address is needed!"); 
    }

    $sql = "INSERT INTO supplier (supplier_name, supplier_contact_person, contact_number, address, status) 
          VALUES('$supplier_name', '$contact_person', '$contact_number','$address', '$status')";

    mysqli_query($conn, $sql);


    header('location: addsupplier.php'); 


    $conn->close();
}

?>