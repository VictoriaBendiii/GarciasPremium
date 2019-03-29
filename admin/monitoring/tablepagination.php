<?php 
session_start();

$database = mysqli_connect('localhost', 'root', '', 'garciaspremiumcoffee');

$query = "SELECT products.productname, branch.branchid, branch.branch_name, supplier.supplier_name, accounts.firstname, stock.quantity as stock, orders.quantity as qty, solditem.quantity as sold, orders.time
from ((((((orders left join products on orders.productid = products.productid)
left join branch on orders.branchid = branch.branchid)
left join supplier on orders.supplierid = supplier.supplierid)
left join accounts on orders.accountid = accounts.accountid)
left join stock on orders.stockid = stock.stockid)
left join solditem on orders.solditemid = solditem.solditemid) 
where branch.branchid =1";


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

