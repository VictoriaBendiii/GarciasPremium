<?php
session_start();
// Check if there is a user logged in
if(!isset($_SESSION['login_user'])){
  header('Location: ../index.php');
  exit;
}

$page = 'dashboard'; ?>
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
			$sql = "SELECT DATE_FORMAT(stock.date_in,'%b %d, %Y %r') as time, stock.quantity, products.status, products.productname
					from ((stock left join products on stock.productid = products.productid)
					left join branch on stock.branchid = branch.branchid) where branch.branchid = $branchid ORDER BY date_in desc limit 5";
				$result = mysqli_query($conn, $sql);
		?>

			<h2>Stocks In</h2>

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
			$sql = "SELECT DATE_FORMAT(stock.date_out,'%b %d, %Y %r') as time, stock.quantity, products.status, products.productname
					from ((stock left join products on stock.productid = products.productid)
					left join branch on stock.branchid = branch.branchid) where branch.branchid = $branchid ORDER BY date_out desc limit 5";
				$result = mysqli_query($conn, $sql);
		?>

			<h2>Stocks Out</h2>

			<div class="table-responsive" style="overflow-x:auto;">
				<table class="table table-bordered table-striped table-sm">
					<thead>
						<tr>
							<th>Product</th>
							<th>Quantity (in Kg)</th>
							<th>Status</th>
							<th>Date out</th>
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
