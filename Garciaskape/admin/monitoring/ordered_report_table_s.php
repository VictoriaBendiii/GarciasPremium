<?php 
session_start();
include '../includes/connection.php';

$query ="SELECT products.productname, quantity, time, accounts.firstname, branch.branch_name
from(((orders
left join products on orders.productid = products.productid)
left join accounts on orders.accountid = accounts.accountid)
left join branch on orders.branchid = branch.branchid)
where branch.branchid = '2'";


$result = $conn->query($query) or die($conn->error . __LINE__);
$fetch_data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fetch_data[] = $row;
    }
}
$jResponse = json_encode($fetch_data);
echo $jResponse;

?>

