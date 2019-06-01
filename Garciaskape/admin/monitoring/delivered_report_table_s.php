<?php 
session_start();
include '../includes/connection.php';

$query = "SELECT branch.branch_name, accounts.firstname, products.productname, supplier.supplier_name, order_request.quantity, delivery.quantity, Date_format(order_request.time, '%b %d, %Y %r') as time, DATE_FORMAT(delivery.time, '%b %d, %Y %r') as dtime, delivery.status
from (((((delivery 
left join order_request on delivery.idnumber = order_request.idnumber)
left join branch on delivery.branchid = branch.branchid)
left join accounts on delivery.accountid = accounts.accountid)
left join products on delivery.productid = products.productid)
left join supplier on delivery.supplierid = supplier.supplierid)
where branch.branchid = 2";


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

