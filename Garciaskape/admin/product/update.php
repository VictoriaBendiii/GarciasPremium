<?php include '../includes/connection.php'; ?>
<?php

session_start();

if (isset($_GET['edit'])){

	$id = $_GET['edit'];
	$sql_query ="SELECT * FROM products WHERE productid=$id";
	$result = mysqli_query($conn, $sql_query);

	if (count($result) == 1) {
		$row = mysqli_fetch_array($result);
		$productname= $row['productname'];
	}
	mysqli_query($conn, $sql_query);
    header("location: product.php");
}

if (isset($_GET['delete'])){

	$id = $_GET['delete'];
	$sql_query ="DELETE FROM products WHERE productid=$id";
	mysqli_query($conn, $sql_query);
	$_SESSION['message'] = "Account has been deleted!";
	$_SESSION['msg_type'] = "danger";

    header("location: product.php");
} 

if(isset($_POST['edit_product'])){
	$id = mysqli_real_escape_string($conn, $_POST['productid']);
    $productname = mysqli_real_escape_string($conn, $_POST['productname']);
     
    
          $sql = "UPDATE products SET productname='$productname' WHERE productid='$id'";
        
		mysqli_query($conn, $sql);
		header("location: product.php");  
 
    
    
        $conn->close();
    }

 

?>