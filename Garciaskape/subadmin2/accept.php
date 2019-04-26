<?php
if (isset($_POST['accept'])){
  include 'include/connection.php';

  $sql_accepted = "SELECT orderid from (((orders inner join products on orders.productid = products.productid)
  inner join supplier on orders.supplierid = supplier.supplierid )  inner join branch on orders.branchid = branch.branchid)
  where orders.status = 'accepted' and orders.orderid = '". $row['orderid'] ."';  ";
  $result1 = mysqli_query($conn, $sql_accepted);
  $result_orderid = mysqli_fetch_array($result1,MYSQLI_NUM);

  $sql_update = "UPDATE garciaspremiumcoffee.orders SET status = 'delivered' WHERE orderid = '" . $result_orderid['orderid'] . "'";
  $result2 = mysqli_query($conn, $sql_update);

  $sql_insert = "INSERT INTO garciaspremiumcoffee.delivery (deliveryid, productid, quantity, supplierid, branchid, orderid, time, status)
                  SELECT deliveryid, productid, quantity, supplierid, branchid, orderid, time, status
                  FROM garciaspremiumcoffee.orders
                  WHERE delivery.orderid = '" . $result_orderid['orderid'] . "';";
  $result2 = mysqli_query($conn, $sql_insert);






  // $sql_delivered = "UPDATE orders SET status = 'delivered' where orderid = ''";
  // $result2 = mysqli_query($conn, $sql_delivered);
  // echo "window.alert('accepted!');";

} else{
  echo "mali";
}




 ?>
