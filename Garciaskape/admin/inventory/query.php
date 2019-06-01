<?php

$query = "SELECT branch_name from branch where branchid = 1";
$result = $conn->query($query) or die($conn->error . __LINE__);
$row = mysqli_fetch_array($result);

$query1 = "SELECT branch_name from branch where branchid = 2";
$result1 = $conn->query($query1) or die($conn->error . __LINE__);
$row1 = mysqli_fetch_array($result1);


?>
