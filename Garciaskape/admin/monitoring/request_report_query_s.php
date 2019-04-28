<?php 
session_start();
include '../includes/connection.php';

$query = "SELECT order_request.order_requestid, products.productname, branch.branchid, branch.branch_name, order_request.quantity as quantity, supplier.supplier_name, delivery.deliveryid, accounts.firstname, order_request.time as time, order_request.status
from (((((order_request
inner join delivery on order_request.deliveryid = delivery.deliveryid)
inner join products on order_request.productid = products.productid) 
left join branch on order_request.branchid = branch.branchid) 
left join supplier on order_request.supplierid = supplier.supplierid)
left join accounts on order_request.accountid = accounts.accountid) 
where order_request.branchid = 2";


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


