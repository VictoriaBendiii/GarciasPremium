<?php 
session_start();
include '../includes/connection.php';

$query="SELECT branch.branch_name, accounts.firstname, products.productname, solditem.quantity, DATE_FORMAT(orders.time, '%b %d , %Y %r') as ordertime, DATE_FORMAT(solditem.time, '%b %d , %Y %r') as time, solditem.status
from ((((solditem
left join orders on solditem.idnumber = orders.idnumber)
left join branch on solditem.branchid = branch.branchid)
left join accounts on solditem.accountid = accounts.accountid)
left join products on solditem.productid = products.productid)
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

