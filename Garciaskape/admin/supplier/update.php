<?php include '../includes/connection.php'; ?>
<?php

session_start();

if (isset($_GET['activate'])){

	$id = $_GET['activate'];
	$sql_query = "UPDATE accounts SET status='Active' WHERE accountid=$id";
	mysqli_query($conn, $sql_query);
   header("location: accounts.php");

} else if (isset($_GET['deactivate'])){

	$id = $_GET['deactivate'];
	$sql_query ="UPDATE accounts SET status='Deactivated' WHERE accountid=$id";
	mysqli_query($conn, $sql_query);
    header("location: accounts.php");
}
if (isset($_GET['delete'])){

	$id = $_GET['delete'];
	$sql_query ="DELETE FROM supplier WHERE supplierid=$id";
	mysqli_query($conn, $sql_query);
	$_SESSION['message'] = "Account has been deleted!";
	$_SESSION['msg_type'] = "danger";

    header("location: supplier.php");
}

else if (isset($_GET['edit'])){

	$id = $_GET['edit'];
	$sql_query ="SELECT * FROM supplier WHERE supplierid=$id";
	$result = mysqli_query($conn, $sql_query);


	if (count($result) == 1) {
		$row = mysqli_fetch_array($result);
		$supplier_name= $row['supplier_name'];
		$supplier_contact_person = $row['supplier_contact_person'];
		$contact_number = $row['contact_number'];
		$address = $row['address'];
	}
	mysqli_query($conn, $sql_query);
    header("location: supplier.php");
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
		header("location: supplier.php");  
 
    
    
        $conn->close();
    }

?>