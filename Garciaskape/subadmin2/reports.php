<?php
session_start();
// Check if there is a user logged in
if(!isset($_SESSION['login_user'])){
  header('Location: ../index.php');
  exit;
}
include '../expired.php';
if(isLoginSessionExpired()) {
  header("Location:../index.php?session_expired=1");
}
$page = 'reports'; ?>
<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Reports</li>
			</ol>
		</div><!--/.row-->

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
				<h1 class="h2">Reports</h1>
			<form action="reports.php" method="POST">
				<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<div class="btn-group" role="group">
					  <button type="submit" class="btn btn-primary" name="ord_rep" id="ord_rep"> ORDER </button>
					</div>
					<div class="btn-group" role="group">
					  <button type="submit" class="btn btn-primary" name="del_rep" id="del_rep"> DELIVERY </button>
					</div>
					<div class="btn-group" role="group">
					  <button type="submit" class="btn btn-primary" name="sold_rep" id="sold_rep"> SOLD </button>
					</div>
					<div class="btn-group" role="group">
					  <button type="submit" class="btn btn-primary" name="order_req" id="order_req"> ORDER REQUEST </button>
					</div>
				  </div>
				</form>
			</div>

		<br>

		<?php
			if (isset($_POST['ord_rep'])) {
				$sqlord = "SELECT DATE_FORMAT(orders.time,'%b %d, %Y %r') as time, products.productname, orders.quantity
				FROM ((orders left join products on orders.productid = products.productid)
				left join branch on orders.branchid = branch.branchid)
				WHERE orders.branchid = $branchid ORDER BY orders.time desc";
				$result = mysqli_query($conn, $sqlord);
		?>

			<h2>Order Reports</h2>

			<div class="table-responsive" style="overflow-x:auto;">
				<table class="table table-bordered table-striped table-sm">
					<thead>
						<tr>
							<th>Product</th>
							<th>Quantity (in Kg)</th>
							<th>Date & Time</th>
						</tr>
					</thead>
					<tbody>

					<?php
						if($result = mysqli_query($conn, $sqlord)) {
							while($row = mysqli_fetch_assoc($result)){
					?>
						<tr>
							<td> <?php echo $row["productname"]; ?> </td>
							<td> <?php echo $row["quantity"]; ?> </td>
							<td> <?php echo $row["time"]; ?> </td>
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
			if (isset($_POST['del_rep'])) {
				$sqldel = "SELECT DATE_FORMAT(delivery.time,'%b %d, %Y %r') as time, products.productname, supplier.supplier_name, delivery.quantity, delivery.status
				FROM ((delivery left join products on delivery.productid = products.productid)
				left join supplier on delivery.supplierid = supplier.supplierid) 
				WHERE delivery.branchid = $branchid ORDER BY delivery.time desc";

				$result = mysqli_query($conn, $sqldel);
		?>

			<h2>Delivery Reports</h2>

			<div class="table-responsive" style="overflow-x:auto;">
				<table class="table table-bordered table-striped table-sm">
					<thead>
						<tr>
							<th>Product</th>
							<th>Quantity (in Kg)</th>
							<th>From</th>
							<th>Status</th>
							<th>Date & Time</th>
						</tr>
					</thead>
					<tbody>

					<?php
						if($result = mysqli_query($conn, $sqldel)) {
							while($row = mysqli_fetch_assoc($result)){
					?>
						<tr>
							<td> <?php echo $row["productname"]; ?> </td>
							<td> <?php echo $row["quantity"]; ?> </td>
							<td> <?php echo $row["supplier_name"];?> </td>
							<td> <?php echo $row["status"];?> </td>
							<td> <?php echo $row["time"]; ?> </td>
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
			if (isset($_POST['sold_rep'])) {
				$sqlsold = "SELECT DATE_FORMAT(solditem.time,'%b %d, %Y %r') as time, products.productname, solditem.quantity, solditem.status
				FROM ((solditem left join products on solditem.productid = products.productid)
				left join branch on solditem.branchid = branch.branchid)
				WHERE solditem.branchid = $branchid ORDER BY solditem.time desc";
				$result = mysqli_query($conn, $sqlsold);
		?>

			<h2>Sold Reports</h2>

			<div class="table-responsive" style="overflow-x:auto;">
				<table class="table table-bordered table-striped table-sm">
					<thead>
						<tr>
							<th>Product</th>
							<th>Quantity (in Kg)</th>
							<th>Status</th>
							<th>Date & Time</th>
						</tr>
					</thead>
					<tbody>

					<?php
						if($result = mysqli_query($conn, $sqlsold)) {
							while($row = mysqli_fetch_assoc($result)){
					?>
						<tr>
							<td> <?php echo $row["productname"]; ?> </td>
							<td> <?php echo $row["quantity"]; ?> </td>
							<td> <?php echo $row["status"];?> </td>
							<td> <?php echo $row["time"]; ?> </td>
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
			if (isset($_POST['order_req'])) {
				$sqlreq = "SELECT DATE_FORMAT(order_request.time,'%b %d, %Y %r') as time, products.productname, order_request.quantity, order_request.status, supplier.supplier_name
				FROM ((order_request left join products on order_request.productid = products.productid)
				left join supplier on order_request.supplierid = supplier.supplierid)
				WHERE order_request.branchid = $branchid ORDER BY order_request.time desc";
				$result = mysqli_query($conn, $sqlreq);
		?>

			<h2>Order Request</h2>

			<div class="table-responsive" style="overflow-x:auto;">
				<table class="table table-bordered table-striped table-sm">
						<tr>
							<th>Product</th>
							<th>Quantity (in Kg)</th>
							<th>Supplier</th>
							<th>Status</th>
							<th>Date & Time</th>
						</tr>

					<?php
						if($result = mysqli_query($conn, $sqlreq)) {
							while($row = mysqli_fetch_assoc($result)){
					?>
						<tr>
							<td> <?php echo $row["productname"]; ?> </td>
							<td> <?php echo $row["quantity"]; ?> </td>
							<td> <?php echo $row["supplier_name"]; ?> </td>
							<td> <?php echo $row["status"];?> </td>
							<td> <?php echo $row["time"]; ?> </td>
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
		</main>

		</div><!--/.row-->
	</div>	<!--/.main-->

</body>
</html>
