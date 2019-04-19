<?php include '../includes/connection.php'; ?>
<?php

if (isset($_POST['add_user'])) {

  $supplier_name = mysqli_real_escape_string($conn, $_POST['supplier_name']);
  $supplier_contact_person = mysqli_real_escape_string($conn, $_POST['supplier_contact_person']);
  $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
 
  
  
  if (empty($supplier_name)) { 
    array_push($errors, "Supplier Name is required");
  }
  
  if (empty($supplier_contact_person)) {
    array_push($errors, "supplier Contact Number is required"); 
  }

  if (empty($contact_number)) {
    array_push($errors, "Contact Number is required");
  }
  if (empty($address)) {
    array_push($errors, "Address is required");
  }
  
  

  	$sql = "INSERT INTO supplier (supplier_name, supplier_contact_person, contact_number, address) 
          VALUES('$supplier_name', '$supplier_contact_person', '$contact_number', '$address')";
    
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
      header('Location: ../supplier/supplier.php');
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
    $conn->close();
}

?>