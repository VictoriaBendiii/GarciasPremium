<?php 
session_start();
include '../includes/connection.php';


$query = "SELECT products.productname, branch.branchid, branch.branch_name, orders.quantity, supplier.supplier_name, delivery.deliveryid, accounts.firstname, DATE_FORMAT(orders.time,'%b %d, %Y %r') as time, delivery.status
from (((((orders inner join products on orders.productid = products.productid) 
left join branch on orders.branchid = branch.branchid) 
left join supplier on orders.supplierid = supplier.supplierid)
left join delivery on orders.deliveryid = delivery.deliveryid)
left join accounts on orders.accountid = accounts.accountid) 
where branch.branchid = 1 and delivery.branchid = 1";


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

