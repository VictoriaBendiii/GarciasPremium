<?php 
session_start();
include '../includes/connection.php';


$query = "SELECT accounts.firstname, products.productname, stock.stockid,stock.quantity, stock.stockin, DATE_FORMAT(stock.date_in,'%b %d, %Y %r') as date_in, stock.stockout,  DATE_FORMAT(stock.date_out,'%b %d, %Y %r') as date_out
from ((stock left join accounts on stock.accountid = accounts.accountid)
left join products on stock.productid = products.productid)
where stock.branchid =2";


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

