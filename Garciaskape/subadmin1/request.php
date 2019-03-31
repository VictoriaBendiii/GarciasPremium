<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>

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
					Request Stock
				</button>
			</br> 
			</br>
				<div class="btn-group" role="group" aria-label="...">
					<button type="button" class="btn btn-default">Request from Porta</button>
					<button type="button" class="btn btn-default">Ordered items</button>
					<button type="button" class="btn btn-default">Delivered items</button>
				</div>
			</div>

			<!-- Modal -->
			<?php
				$sqlreq = "SELECT * FROM products";
				$result = mysqli_query($conn, $sqlreq);				
			?>

			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-sm">
									<thead>
										<tr>
											<th>Product</th>
											<th>Qty / Kg</th>
										</tr>
									</thead>
									<tbody>

									<?php
										if($result = mysqli_query($conn, $sqlreq)) {
											while($row = mysqli_fetch_assoc($result)){ 
									?>
										<tr>
											<td> <?php echo $row["productname"]; ?> </td>
											<td> 
											<div class="form-group">
												<select id="inputState" class="form-control">
													<option selected>Choose...</option>
													<option>5</option>
													<option>10</option>
												</select>
											</div>
											</td>
										</tr>

									<?php
											}
										}
									?>

									</tbody>
								</table>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Submit</button>
						</div>
					</div>
				</div>
			</div>

		</br>
		</main>
		
		</div><!--/.row-->
	</div>	<!--/.main-->
		
</body>
</html>