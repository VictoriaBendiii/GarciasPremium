<?php
header('Content-Type: application/json');
include '../includes/connection.php';
//query to get data from the table
$query = sprintf("SELECT products.productname, stock.quantity from 
((stock inner join products on stock.productid = products.productid) 
inner join branch on stock.branchid = branch.branchid) 
where products.branchid=3 and stock.branchid ='1' and products.status != 'deactivated'");

//execute query
$result = $conn->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$conn->close();

//now print the data
print json_encode($data);
