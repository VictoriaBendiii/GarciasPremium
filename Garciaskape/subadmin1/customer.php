<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Customer</li>
			</ol>
		</div><!--/.row-->
		
		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
				<h1 class="h2">Customer</h1>
			</div>

			<?php
				$sql_cust = "SELECT * from ((stock left join products on stock.productid = products.productid)
				left join branch on stock.branchid = branch.branchid) where branch.branchid = 1";
				$result = mysqli_query($conn, $sql_cust);				
			?>

			<form class="form-inline" id="cust">
				<div class="form-group">
						<label for="inputState">Product</label>
						<select id="inputState" class="form-control">
							<option selected>Choose...</option>
					<?php
						if($result = mysqli_query($conn, $sql_cust)) {
							while($row = mysqli_fetch_assoc($result)){ 
					?>
							<option> <?php echo $row["productname"]; ?> </option>
					<?php
							}
						}
					?>
						</select>
					</div>
					<div class="form-group">
						<label for="inputState">Quantity / Kg</label>
						<input type ="number" step='0.01'> 
						
					</div>
					<div class="form-group">
							<label for="inputState">Options</label>
						<button type="button" class="btn"><em class="fa fa-plus" style="font-size: 30px"></em> </button>
						<button type="submit" class="btn"><em class="fa fa-remove" style="font-size: 30px; color: red;"></em> </button>
						</select>
					</div>
					<input type="submit">
				</div>
			</form>
			<input type="submit">

		</br>
		</main>
		
		</div><!--/.row-->
	</div>	<!--/.main-->
		
</body>
</html>