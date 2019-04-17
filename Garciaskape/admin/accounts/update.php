<?php include '../connection.php'; ?>
<?php

session_start();
$firstname='';
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
	$_SESSION['message'] = "Account has been deleted!";
	$_SESSION['msg_type'] = "danger";

    header("location: accounts.php");
}

else if (isset($_GET['edit'])){

	$id = $_GET['edit'];
	$sql_query ="SELECT * FROM accounts WHERE accountid=$id";
	$result = mysqli_query($conn, $sql_query);

	if (count(result) == 1) {
		$rows = mysqli_fetch_array($result);
		$firstname = $row['firstname'];
		$lastname = $row['lastname'];
		$user_type = $row['user_type'];
		

	}
	mysqli_query($conn, $sql_query);
    header("location: accounts.php");
}


?>