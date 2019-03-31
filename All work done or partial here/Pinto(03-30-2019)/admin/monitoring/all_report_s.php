<?php 
session_start();

$database = mysqli_connect('localhost', 'root', '', 'garciaspremiumcoffee');

$query = "SELECT accounts.firstname, products.productname, stock.stockid,stock.quantity, stock.stockin, stock.date_in, stock.stockout, stock.date_out
from ((stock left join accounts on stock.accountid = accounts.accountid)
left join products on stock.productid = products.productid)
where stock.branchid =2";


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

