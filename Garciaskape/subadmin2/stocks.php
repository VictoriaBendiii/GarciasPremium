<?php $page = 'stocks'; ?>
<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Stocks</li>
			</ol>
		</div><!--/.row-->

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
		<form action="stocks.php" method="POST">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
				<h1 class="h2">Stocks</h1>
				<h1 class="h4">Remarks: The color "RED" symobolized that the product is in critical level</h1>
				<label> Critical Value: <input type="number" name="crit" id="crit" min="0" max="1000" ></label>
				<button type="submit" class="btn btn-primary btn-sm" name="sub" id="sub">SUBMIT</button>
				<button type="submit" class="btn btn-danger btn-sm" name="res" id="res">RESET</button>
				<br>
				<br>
			</div>
		</form>

			<?php
				$sql = "SELECT * from ((stock left join products on stock.productid = products.productid)
				left join branch on stock.branchid = branch.branchid) where branch.branchid = $branchid ORDER BY productname";
				$result = mysqli_query($conn, $sql);
			?>

			<div class="table-responsive" style="overflow-x:auto;">
				<table class="table table-bordered table-striped table-sm">
						<tr>
							<th>Product</th>
							<th>Quantity (in Kg)</th>
						</tr>

					<?php
						if($result = mysqli_query($conn, $sql)) {
							while($row = mysqli_fetch_assoc($result)){
					?>
						<tr>
							<td> <?php echo $row["productname"]; ?> </td>
							<?php
									$value = '50';
								if(isset($_POST["sub"])){
									$value = $_POST['crit'] ;
								}
								if(isset($_POST["res"])){
									$value = '50';
								}
								if ($value >= $row['quantity']) {
									echo "<td style='background-color:#f9243f;'>". $row['quantity'] ."</td>";
								} else {
									echo "<td>". $row['quantity'] ."</td>";
								}									
							?> 
						</tr>
					<?php
							}
						}
					?>
				</table>
			</div>
		</main>
		</div><!--/.row-->
	</div>	<!--/.main-->

</body>
</html>
