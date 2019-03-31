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
					  <button type="button" class="btn btn-default" name="all_rep" id="all_rep">All Reports</button>
					</div>
					<div class="btn-group" role="group">
					  <button type="button" class="btn btn-default" name="ord_rep" id="ord_rep">Ordered Reports</button>
					</div>
					<div class="btn-group" role="group">
					  <button type="button" class="btn btn-default" name="del_rep" id="del_rep">Delivered Reports</button>
					</div>
					<div class="btn-group" role="group">
						<button type="submit" class="btn btn-default" name="sold_rep" id="sold_rep">Sold Reports</button>
					  </div>
				  </div>
				</form>
			</div>

		</br>

		<?php
			if (isset($_POST['sold_rep'])) {
				$sqlsold = "SELECT solditem.solditemid, products.productname, solditem.quantity, solditem.time, solditem.status
				from ((solditem left join products on solditem.productid = products.productid)
				left join branch on solditem.branchid = branch.branchid) where branch.branchid = 1";
				$result = mysqli_query($conn, $sqlsold);
		?>

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-sm">
					<thead>
						<tr>
							<th>ID</th>
							<th>Date & Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>

					<?php
						if($result = mysqli_query($conn, $sqlsold)) {
							while($row = mysqli_fetch_assoc($result)){ 
					?>
						<tr>
							<td> <?php echo $row["solditemid"]; ?> </td>
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


			
		</main>
		
		</div><!--/.row-->
	</div>	<!--/.main-->
		
</body>
</html>