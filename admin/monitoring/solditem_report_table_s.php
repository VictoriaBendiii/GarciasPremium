<?php 
session_start();

$database = mysqli_connect('localhost', 'root', '', 'garciaspremiumcoffee');

$query = "SELECT products.productname, branch.branchid, branch.branch_name, solditem.quantity, accounts.firstname, solditem.time
from (((solditem left join products on solditem.productid = products.productid)
left join branch on solditem.branchid = branch.branchid)
left join accounts on solditem.accountid = accounts.accountid) where branch.branchid = 2";


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

