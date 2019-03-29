<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Others </li>
			</ol>
		</div><!--/.row-->
		
		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
				<h1 class="h2">Others</h1>
				<form action="others.php" method="POST">
				<div class="btn-group" role="group" aria-label="...">
					<button type="submit" class="btn btn-default" name="spoil" id="spoil">Spoilage</button>
					<button type="submit" class="btn btn-default" name="loss" id="loss">Loss</button>
					<button type="submit" class="btn btn-default" name="return" id="return">Return / Exchange</button>
					<button type="submit" class="btn btn-default" name="physical" id="physical">Physical Count??</button>
				</div>
				</form>
			</div>

		<?php
			if (isset($_POST['spoil'])) {
				$sqlspoil = "SELECT * FROM products INNER JOIN stock ON products.productid = stock.productid";
				$result = mysqli_query($conn, $sqlspoil);
		?>
			<form class="form-inline">
				<h3>Spoilage sample</h3>
				<div class="form-group">
						<label for="inputState">Product</label>
						<select id="inputState" class="form-control">
						<?php
							if($result = mysqli_query($conn, $sqlspoil)) {
								while($row = mysqli_fetch_assoc($result)){ 
						?>
							<option selected>Choose...</option>
							<option> <?php echo $row["productname"]; ?> </option>
						<?php
								}
							}
						?>
						</select>
				</div>
					<div class="form-group">
						<label for="inputState">Quantity / Kg	</label>
						<select id="inputState" class="form-control">
							<option selected>Choose...</option>
							<option>1</option>
							<option>2</option>
						</select>
					</div>
					<div class="form-group">
							<label for="inputState">Options</label>
						<button type="submit" class="btn"><em class="fa fa-plus" style="font-size: 30px"></em> </button>
						<button type="submit" class="btn"><em class="fa fa-remove" style="font-size: 30px; color: red;"></em> </button>
						</select>
					</div> 	
			</form>
		<?php
			}
		?>

		<?php
			if (isset($_POST['loss'])) {
				$sqlloss = "SELECT * FROM products INNER JOIN stock ON products.productid = stock.productid";
				$result = mysqli_query($conn, $sqlloss);
		?>

			<form class="form-inline">
				<h3>Loss sample</h3>
				<div class="form-group">
						<label for="inputState">Product</label>
						<select id="inputState" class="form-control">
						<?php
							if($result = mysqli_query($conn, $sqlloss)) {
								while($row = mysqli_fetch_assoc($result)){ 
						?>
							<option selected>Choose...</option>
							<option> <?php echo $row["productname"]; ?> </option>
						<?php
								}
							}
						?>
						</select>
				</div>
					<div class="form-group">
						<label for="inputState">Quantity / Kg	</label>
						<select id="inputState" class="form-control">
							<option selected>Choose...</option>
							<option>1</option>
							<option>2</option>
						</select>
					</div>
					<div class="form-group">
							<label for="inputState">Options</label>
						<button type="submit" class="btn"><em class="fa fa-plus" style="font-size: 30px"></em> </button>
						<button type="submit" class="btn"><em class="fa fa-remove" style="font-size: 30px; color: red;"></em> </button>
						</select>
					</div>
			</form>
		<?php
			}
		?>

		<?php
			if (isset($_POST['return'])) {
		?>

			<form class="form-inline">
				<h3>Return / Exchange sample</h3>
				<div class="form-group">
						<label for="inputState">Item</label>
						<select id="inputState" class="form-control">
							<option selected>Choose...</option>
							<option>SOLD ID 1</option>
							<option>SOLD ID 2</option>
						</select>
					</div>
				<div class="form-group">
						<label for="inputState">Product</label>
						<select id="inputState" class="form-control">
							<option selected>Choose...</option>
							<option>Arabica</option>
							<option>Robusta</option>
						</select>
					</div>
					<div class="form-group">
						<label for="inputState">Quantity / Kg	</label>
						<select id="inputState" class="form-control">
							<option selected>Choose...</option>
							<option>1</option>
							<option>2</option>
						</select>
					</div>
					<div class="form-group">
							<label for="inputState">Options</label>
						<button type="submit" class="btn"><em class="fa fa-plus" style="font-size: 30px"></em> </button>
						<button type="submit" class="btn"><em class="fa fa-remove" style="font-size: 30px; color: red;"></em> </button>
						</select>
					</div>

				<h3>To</h3>
				<div class="form-group">
						<label for="inputState">Item</label>
						<select id="inputState" class="form-control">
							<option selected>Choose...</option>
							<option>SOLD ID 1</option>
							<option>SOLD ID 2</option>
						</select>
					</div>
				<div class="form-group">
						<label for="inputState">Product</label>
						<select id="inputState" class="form-control">
							<option selected>Choose...</option>
							<option>Arabica</option>
							<option>Robusta</option>
						</select>
					</div>
					<div class="form-group">
						<label for="inputState">Quantity / Kg	</label>
						<select id="inputState" class="form-control">
							<option selected>Choose...</option>
							<option>1</option>
							<option>2</option>
						</select>
					</div>
					<div class="form-group">
							<label for="inputState">Options</label>
						<button type="submit" class="btn"><em class="fa fa-plus" style="font-size: 30px"></em> </button>
						<button type="submit" class="btn"><em class="fa fa-remove" style="font-size: 30px; color: red;"></em> </button>
						</select>
					</div>
			</form>

		<?php
			}
		?>

		</main>
		
		</div><!--/.row-->
	</div>	<!--/.main-->
		
</body>
</html>