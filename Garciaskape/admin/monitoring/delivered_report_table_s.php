<?php 
session_start();
include '../includes/connection.php';

$query = "SELECT products.productname, branch.branchid, branch.branch_name, order_request.quantity, delivery.quantity, supplier.supplier_name, delivery.deliveryid, accounts.firstname, DATE_FORMAT(order_request.time,'%b %d, %Y %r') as time, DATE_FORMAT(delivery.time,'%b %d, %Y %r') as dtime, delivery.status
from (((((delivery 
left join order_request on delivery.order_requestid = order_request.order_requestid)
inner join products on delivery.productid = products.productid) 
left join branch on delivery.branchid = branch.branchid) 
left join supplier on delivery.supplierid = supplier.supplierid)
left join accounts on delivery.accountid = accounts.accountid) 
where delivery.branchid = 2";


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

