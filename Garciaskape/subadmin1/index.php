<?php $page = 'dashboard'; ?>
<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
				<h1 class="h2">Hi Sub Admin!</h1>
			</div>

		<?php
				$sqlrep = "SELECT DATE_FORMAT(orders.time,'%b %d, %Y %r') as time, orders.orderid, products.productname, orders.quantity, orders.status
				from ((orders left join products on orders.productid = products.productid)
				left join branch on orders.branchid = branch.branchid) where branch.branchid = $branchid order by orders.time desc limit 5";
				$result = mysqli_query($conn, $sqlrep);
		?>

			<h2>Reports</h2>

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
						if($result = mysqli_query($conn, $sqlrep)) {
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
			$sql = "SELECT * from ((stock left join products on stock.productid = products.productid)
					left join branch on stock.branchid = branch.branchid) where branch.branchid = $branchid ORDER BY date_in desc limit 5";
				$result = mysqli_query($conn, $sqlrep);
		?>

			<h2>Stocks</h2>

			<div class="table-responsive" style="overflow-x:auto;">
				<table class="table table-bordered table-striped table-sm">
					<thead>
						<tr>
							<th>Product</th>
							<th>Quantity (in Kg)</th>
							<th>Status</th>
							<th>Date in</th>
						</tr>
					</thead>
					<tbody>

					<?php
						if($result = mysqli_query($conn, $sql)) {
							while($row = mysqli_fetch_assoc($result)){
					?>
						<tr>
							<td> <?php echo $row["productname"]; ?> </td>
							<td> <?php echo $row["quantity"]; ?> </td>
							<td> <?php echo $row["status"];?> </td>
							<td> <?php echo $row["date_in"]; ?> </td>
						</tr>
					<?php
							}
						}
					?>
					</tbody>
				</table>
			</div>

		</main>

		</div><!--/.row-->
	</div>	<!--/.main-->

</body>
</html>
