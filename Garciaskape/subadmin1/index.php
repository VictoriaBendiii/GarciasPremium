<?php
 $page = 'dashboard';
session_start();

$username = $_SESSION['u_name'];
$branchid = $_SESSION['branch_id'];


?>
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
				$sqlrep = "SELECT orders.orderid, orders.time, products.productname, orders.quantity, orders.status
				from ((orders left join products on orders.productid = products.productid)
				left join branch on orders.branchid = branch.branchid) where branch.branchid = 1 order by orders.time desc limit 10";
				$result = mysqli_query($conn, $sqlrep);
		?>

			<h2>Reports</h2>

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-sm">
					<thead>
						<tr>
							<th>Product</th>
							<th>Quantity</th>
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

		</main>

		</div><!--/.row-->
	</div>	<!--/.main-->

</body>
</html>
