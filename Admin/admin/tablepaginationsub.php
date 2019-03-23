<?php 
session_start();

$database = mysqli_connect('localhost', 'root', '', 'garciaspremiumcoffee');

$query = "select * from orders join products on orders.productid = products.productid
 where orders.branchid = 2";


$result = $database->query($query) or die($database->error . __LINE__);
$fetch_data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fetch_data[] = $row;
    }
}
$jResponse = json_encode($fetch_data);
echo $jResponse;

?>

