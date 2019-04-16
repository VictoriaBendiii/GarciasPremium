<?php include '../connection.php'; ?>
<?php

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

else if (isset($_GET['delete'])){

	$id = $_GET['delete'];
	$sql_query ="DELETE FROM accounts WHERE accountid=$id";
	mysqli_query($conn, $sql_query);
    header("location: accounts.php");
}


?>