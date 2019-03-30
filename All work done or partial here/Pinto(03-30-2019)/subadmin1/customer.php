<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>
<?php include 'connection.php'; ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Customer</li>
			</ol>
		</div><!--/.row-->
		<?php
        if(isset($_POST['submitform'])) {
            $sql = "INSERT INTO table1 (product) VALUES ('".$_POST['productname']."')";
            $conn->query($sql);
        }
    ?>
		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
				<h1 class="h2">Customer</h1>
			</div>

			<form class="form-inline">
				<div class="form-group">
						<label for="inputState">Product</label>
						<select id="inputState" class="form-control">
							<option selected>Choose...</option>
							<option>Arabica</option>
							<option>Robusta</option>
						</select>
					</div>
					<div class="form-group">
						<label for="inputState">Quantity / Kg</label>
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
				</div>
			</form>

		</br>
		</main>
		
		</div><!--/.row-->
	</div>	<!--/.main-->
		
</body>
</html>