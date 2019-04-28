<?php $page = 'request'; ?>
<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>
<style>
th, td{
	padding: 10px;
}
</style>

        <script type="text/javascript">
            function cloneRow(e) {
                e.preventDefault();
                var row = document.querySelector(".dropdowns:last-child");
                var tableBody = document.querySelector("#tableDrop tbody");
                var clone = row.cloneNode(true);
                var clonedDrop = clone.querySelector('.beansDrop');
                var lastDrop = row.querySelector('.beansDrop');
                clonedDrop.value = '';
                if (lastDrop.selectedIndex != -1) clonedDrop.options[lastDrop.selectedIndex].disabled = true;
                tableBody.appendChild(clone);
            }
            function RemoveOrder(ele) {
                var rownumber = document.getElementById("tableDrop").rows.length;
                if (rownumber == 2){
                    window.alert("You cannot remove the last order");
                }	else {
                    var row = ele.closest('tr');
                    var drop = row.querySelector('.beansDrop');
                    var alldrop = document.querySelectorAll('.beansDrop');
                    if (drop.selectedIndex != -1)
                        alldrop.forEach(ele => ele.options[drop.selectedIndex].disabled = false)
                    row.remove();
                }
            }
        </script>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Request</li>
			</ol>
		</div><!--/.row-->

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
				<h1 class="h2">Request</h1>

				<!-- Button trigger modal -->
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
					REQUEST TO ADMIN
				</button>
			<br>
			<br>
			<form action="request.php" method="POST">
				<div class="btn-group" role="group" aria-label="...">
					<button type="submit" class="btn btn-default" name="req" id="req">Request from Porta</button>
					<button type="submit" class="btn btn-default" name="pending" id="pending">Order items</button>
					<button type="submit" class="btn btn-default" name="accepted" id="accepted">Delivery items</button>
				</div>
			</form>
			</div>

			<!-- Modal -->

			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Request Stock</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<form action="request.php" method="POST" class="form">
							<div class="table-responsive" style="overflow-x:auto;">
								<table id="tableDrop" class="table table-bordered table-striped">
									<tr>
										<th>Product</th>
										<th>Quantity (in KG)</th>
										<th>Action</th>
									</tr>
									<tr class="dropdowns">
										<td class="beansDropdown">							
											<select name="prodname[]" id="prodname" class="beansDrop">
												<?php
													$sql = "SELECT * FROM products";
													$result = mysqli_query($conn, $sql);
													$row = mysqli_num_rows($result);
													while ($row = mysqli_fetch_array($result)) {
															echo "<option value='". $row['productid'] ."'>". $row['productname'] ."</option>";
															}
												?>
											</select>				
										</td>
										<td id="quantity">
											<input type="number" name="prodquan[]" id="prodquan" placeholder="Enter Quantity" min="50" max="1000" required>
										</td>
										<td id="remove">
											<input type="button" value="&#10006;" onclick="RemoveOrder(this)">
										</td>
									</tr>
								</table>
							</div>
							<table>
								<br>
								<tr>
									<td> <input type="button" onclick="cloneRow(event)" name="add" id="add" value="Add" class="btn btn-secondary"/> </td>
									<td> <button type="submit" class="btn btn-primary" name="sub" id="sub">Submit</button> </td>
								</tr>
							</table>
						</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

		<?php

			if (isset($_POST['sub'])) {

				$status = "pending";

				$sql_req = "SELECT order_requestid from order_request order by order_requestid desc limit 1";
				$result = mysqli_query($conn, $sql_req);
				$row = mysqli_num_rows($result);
				$row = mysqli_fetch_array($result);
				$res = $row['order_requestid'];
				$res++;


				foreach (array_combine($_POST['prodname'], $_POST['prodquan']) as $prodname => $prodquan){
					
					$sql_sub = "INSERT INTO order_requestid (order_requestid, productid, quantity, suplierid, branchid, accountid, time, status, deliveryid)
							VALUES ('$res', NULL, '$prodname', '$prodquan', NULL, NULL, NULL, '$branchid', '$accountid', SYSDATE(), '$status')";
					
					mysqli_query($conn, $sql_sub);
					
				}
			}
		?>


		<?php
			if (isset($_POST['req'])) {
				$sql_req = "SELECT products.productname, order_request.idnumber, order_request.quantity, order_request.time, order_request.status, branch.branch_name
				from ((order_request left join products on order_request.productid = products.productid)
				left join branch on order_request.branchid = branch.branchid)
				where order_request.branchid='2' and order_request.status='pending'";
				$result = mysqli_query($conn, $sql_req);
		?>

			<h2>Order Request of Porta</h2>

			<div class="table-responsive" style="overflow-x:auto;">
				<table class="table table-bordered table-striped table-sm">
						<tr>
							<th>Date & Time</th>
							<th>Product</th>
							<th>From</th>
							<th>Quantity (in Kg)</th>
							<th>Status</th>
							<th>Action</th>
						</tr>

					<?php
						if($result = mysqli_query($conn, $sql_req)) {
							while($row = mysqli_fetch_assoc($result)){
					?>
						<tr>
						<form action="request.php" method="POST">
							<td> <?php echo $row["time"]; ?> </td>
							<td> <?php echo $row["productname"]; ?> </td>
							<td> <?php echo $row["branch_name"]; ?> </td>
							<td> <?php echo $row["quantity"]; ?> </td>
							<td> <?php echo $row["status"];?> </td>
							<td>
								<a href="request.php?order=<?php echo $row['idnumber']; ?>"
                                	class="btn btn-success"> Accept </a>
							</td>
						</form>
						</tr>
					<?php
							}
						}
					?>
				</table>
			</div>
			<?php
				}
			?>

			<?php

			if (isset($_GET['order'])) {

				$id = $_GET['order'];

				$sql_get1 = "SELECT * FROM order_request WHERE idnumber=$id";
				$result1 = mysqli_query($conn, $sql_get1);
				$row = mysqli_num_rows($result1);
				$row = mysqli_fetch_array($result1);
				$orderquan = $row['quantity'];

				
				$sql_get2 = "SELECT order_request.idnumber, stock.stockid, stock.productid, stock.quantity FROM stock 
				inner join order_request on stock.productid = order_request.productid
				where stock.branchid = $branchid AND order_request.idnumber=$id";
				$result2 = mysqli_query($conn, $sql_get2);
				$row = mysqli_num_rows($result2);
				$row = mysqli_fetch_array($result2);
				$stockquan = $row['quantity'];
				$prodid = $row['productid'];


				$fin = $orderquan-$stockquan;

				
				$sql_update1 = "UPDATE order_request SET status='accepted',time=SYSDATE() WHERE idnumber=$id";
				mysqli_query($conn, $sql_update1);

				$sql_update2 = "UPDATE stock SET quantity=$fin,date_in=SYSDATE(),stockout=$orderquan WHERE productid=$prodid AND branchid=1";
				mysqli_query($conn, $sql_update2);


				$sql_req = "SELECT deliveryid from delivery order by deliveryid desc limit 1";
				$result3 = mysqli_query($conn, $sql_req);
				$row = mysqli_num_rows($result3);
				$row = mysqli_fetch_array($result3);
				$res = $row['deliveryid'];
				$res++;

				$sql = "SELECT * FROM (order_request left join delivery on order_request.deliveryid = delivery.deliveryid) where order_request.idnumber=$id";
				$result4 = mysqli_query($conn, $sql);
				$row = mysqli_num_rows($result4);
				$row = mysqli_fetch_array($result4);
				$supplier = $row['supplierid'];
				$branch = $row['branchid'];
				$order_req = $row['order_requestid'];
				$status = 'pending';
				$acctid = $row['accountid'];

				$sql_insert = "INSERT INTO delivery (deliveryid, productid, quantity, supplierid, branchid, order_requestid, time, status, accountid)
							   VALUES ('$res', '$prodid', '$orderquan', '$supplier', '$branch', '$order_req', SYSDATE(), '$status', '$acctid')";
				mysqli_query($conn, $sql_insert);		

		}
		?>



		

		<?php
			if (isset($_POST['pending'])) {
				$sql_pending = "SELECT products.productname, orders.orderid, orders.quantity, orders.status, orders.time FROM orders 
				inner join products on orders.productid = products.productid
				where orders.branchid = '1' and orders.status = 'pending'";
				$result = mysqli_query($conn, $sql_pending);
		?>

			<h2>Pending Orders</h2>

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-sm">
					<thead>
						<tr>
							<th>ID</th>
							<th>Date & Time</th>
							<th>Product</th>
							<th>Quantity (in Kg)</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>

					<?php
						if($result = mysqli_query($conn, $sql_pending)) {
							while($row = mysqli_fetch_assoc($result)){
					?>
						<tr>
							<td> <?php echo $row["orderid"]; ?> </td>
							<td> <?php echo $row["time"]; ?> </td>
							<td> <?php echo $row["productname"]; ?> </td>
							<td> <?php echo $row["quantity"]; ?> </td>
							<td> <?php echo $row["status"];?> </td>
						</tr>
					<?php
							}
						}
					?>
					</tbody>
				</table>
			</div>
			<?php
				}
			?>

		<?php
			if (isset($_POST['accepted'])) {
				$sql_pending = "SELECT products.productname, orders.stockid, orders.idnumber, orders.orderid, orders.quantity, orders.status, orders.time FROM orders 
				inner join products on orders.productid = products.productid
				where orders.branchid = '1' and orders.status = 'accepted'";
				$result = mysqli_query($conn, $sql_pending);
		?>

			<h2>Accepted/Rejected Orders</h2>

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-sm">
					<thead>
						<tr>
							<th>ID</th>
							<th>Date & Time</th>
							<th>Product</th>
							<th>Quantity (in Kg)</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					

					<?php
						if($result = mysqli_query($conn, $sql_pending)) {
							while($row = mysqli_fetch_array($result)){
					?>
						<tr>
						<form action="request.php" method="POST">
							<td> <?php echo $row["orderid"]; ?> </td>
							<td> <?php echo $row["time"]; ?> </td>
							<td> <?php echo $row["productname"]; ?> </td>
							<td> <?php echo $row["quantity"]; ?> </td>
							<td> <?php echo $row["status"];?> </td>
							<td>
								<a href="request.php?accept=<?php echo $row['idnumber']; ?>"
                                	class="btn btn-success"> Accept </a>
							</td>
							</form>
						</tr>
					<?php
							}
						}
					?>
					</tbody>
				</table>
			</div>
			<?php
				}
			?>

			<?php

			if (isset($_GET['accept'])) {

				$id = $_GET['accept'];

				$sql_get1 = "SELECT * FROM orders WHERE idnumber=$id";
				$result1 = mysqli_query($conn, $sql_get1);
				$row = mysqli_num_rows($result1);
				$row = mysqli_fetch_array($result1);
				$orderquan = $row['quantity'];

				
				$sql_get2 = "SELECT orders.idnumber, stock.stockid, stock.productid, stock.quantity FROM stock 
				inner join orders on stock.productid = orders.productid
				where stock.branchid = '1' AND orders.idnumber=$id";
				$result2 = mysqli_query($conn, $sql_get2);
				$row = mysqli_num_rows($result2);
				$row = mysqli_fetch_array($result2);
				$stockquan = $row['quantity'];
				$prodid = $row['productid'];


				$fin = $orderquan+$stockquan;

				
				$sql_update = "UPDATE orders SET status='delivered',time=SYSDATE() WHERE idnumber=$id";
				mysqli_query($conn, $sql_update);

				$sql_insert = "UPDATE stock SET quantity=$fin,date_in=SYSDATE(),stockin=$orderquan WHERE productid=$prodid AND branchid=$branchid";
				mysqli_query($conn, $sql_insert);
				

		}
		?>
		<br>
		</main>

		</div><!--/.row-->
	</div>	<!--/.main-->

</body>
</html>