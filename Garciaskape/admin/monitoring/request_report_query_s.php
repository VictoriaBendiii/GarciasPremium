<?php 
session_start();
include '../includes/connection.php';

$query = "SELECT quantity, DATE_FORMAT(time,'%b %d, %Y %r') as time, order_request.status, accounts.firstname, branch.branch_name, products.productname, supplier.supplier_name
from ((order_request
left join accounts on accounts.accountid = order_request.accountid)
left join branch on branch.branchid = order_request.branchid
left join products on products.productid = order_request.productid
left join supplier on supplier.supplierid = order_request.supplierid)
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


