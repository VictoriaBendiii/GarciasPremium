<?php $page = 'request'; ?>
<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>
<style>
th, td{
	padding: 10px;
}
</style>

<script type="text/javascript">
		function cloneRow(){
				var row = document.getElementById("dropdowns");
				var table = document.getElementById("tableDrop");
				var clone = row.cloneNode(true);
				clone.id = "dropdownsclone";
				table.appendChild(clone);
		}
		function RemoveOrder(){
			var rownumber = document.getElementById("tableDrop").rows.length;
			if (rownumber == 2){
				window.alert("You cannot remove the last order");
			}	else {
				var td = event.target.parentNode;
				var tr = td.parentNode;
				tr.parentNode.removeChild(tr);
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
					REQUEST TO MARKET
				</button>
			<br>
			<br>
			<form action="request.php" method="POST">
				<div class="btn-group" role="group" aria-label="...">
					<button type="submit" class="btn btn-default" name="pending" id="pending">Order items</button>
					<button type="submit" class="btn btn-default" name="accepted" id="accepted">Delivery items</button>
				</div>
			</form>
			</div>

			<!-- Modal -->

			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Request Stock</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="request.php" method="POST" class="form">
						<div class="table-responsive">
							<table id="tableDrop" class="table table-bordered table-striped table-sm">
								<thead>
									<tr>
										<th>Product</th>
										<th>Quantity (in KG)</th>
										<th>Action</th>
									</tr>
									<tr id="dropdowns">
										<td id="beans">							
											<select name="prodname[]" id="prodname">
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
											<input type="number" name="prodquan[]" id="prodquan" placeholder="Enter Quantity" min="1" max="1000" size="20">
										</td>
										<th id="action">
											<input type="button" value="&#10006;" onclick="RemoveOrder()">
											<input type="button" onclick="cloneRow()" name="add" id="add" value="Add" class="btn btn-secondary"/>
										</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary" name="sub" id="sub">Submit</button>
						</div>
						</form>
					</div>
				</div>
			</div>

		<?php

			if (isset($_POST['sub'])) {

				$status = "pending";

				$sql_req = "SELECT orderid from orders order by orderid desc limit 1";
				$result = mysqli_query($conn, $sql_req);
				$row = mysqli_num_rows($result);
				$row = mysqli_fetch_array($result);
				$res = $row['orderid'];
				$res++;


				foreach (array_combine($_POST['prodname'], $_POST['prodquan']) as $prodname => $prodquan){
					
					$sql_sub = "INSERT INTO orders (orderid, stockid, productid, quantity, solditemid, deliveryid, supplierid, branchid, accountid, time, status)
							VALUES ('$res', NULL, '$prodname', '$prodquan', NULL, NULL, NULL, '$branchid', '$accountid', SYSDATE(), '$status')";
					
					mysqli_query($conn, $sql_sub);
					
				}
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