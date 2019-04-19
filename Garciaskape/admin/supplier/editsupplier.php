<?php include '../includes/connection.php'; ?>
<?php

if(isset($_POST['edit_supplier'])){
    $supplier_name = mysqli_real_escape_string($conn, $_POST['supplier_name']);
    $supplier_contact_person = mysqli_real_escape_string($conn, $_POST['supplier_contact_person']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $address = mysqli_real_escape_string($conn, $_POST['adress']);


    $sql = "UPDATE supplier SET supplier_name='$supplier_name', 
          supplier_contact_person='$supplier_contact_person', 
          contact_number='$contact_number',
          address='$address' 
      WHERE supplierid='$id'";

    mysqli_query($conn, $sql);
    header("location: supplier.php");  



    $conn->close();
}
?>