<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>
<style>
th, td{
	padding: 10px;
}
</style>
<script type="text/javascript">
		function cloneRow(){
				var row = document.getElementById("dropdowns");
				var table = document.getElementById("tableDrop");
				var clone = row.cloneNode(true);
				clone.id = "dropdownsclone";
				table.appendChild(clone);
		}

		function RemoveOrder(){
			var rownumber = document.getElementById("tableDrop").rows.length;
			if (rownumber == 2){
				window.alert("You cannot remove the last order");
			}	else {
				var td = event.target.parentNode;
				var tr = td.parentNode;
				tr.parentNode.removeChild(tr);
			}
		}
</script>
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
			<form action="request.php" method="POST">
				<div class="btn-group" role="group" aria-label="...">
					<button type="submit" class="btn btn-default">Request from Porta</button>
					<button type="submit" class="btn btn-default"  name="pending" id="pending">Ordered items</button>
					<button type="submit" class="btn btn-default"  name="accepted" id="accepted">Delivered items</button>
				</div>
			</form>
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
								<table id="tableDrop">

									<thead>
										<tr>
											<th>Product</th>
											<th>Qty / Kg</th>

										</tr>
										<tr id="dropdowns">
											<th id="beans">
													<select name="beans[]">
															<option value="premExcelsa">Premium Barako Excelsa</option>
															<option value="arabmed">Arabica Medium Blend</option>
															<option value="barako">Barako Blend Coffee</option>
															<option value="benguet">Benguet</option>
															<option value="barako">Barako</option>
															<option value="sagdark">Sagada Dark</option>
															<option value="sagmed">Sagada Medium</option>
															<option value="housearab">House Blend Arabica</option>
															<option value="italesp">Italian Espresso</option>
															<option value="kalmed">Kalinga Medium</option>
															<option value="kaldark">Kalinga Dark</option>
															<option value="hazelnut">Hazelnut</option>
															<option value="mocha">Mocha</option>
															<option value="hazelvan">Hazelnut-Vanilla</option>
															<option value="vanilla">Vanilla</option>
															<option value="butterscotch">Butterscotch</option>
															<option value="macadamia">Macadamia</option>
															<option value="cinnamon">Cinnamon Nut</option>
															<option value="irish">Irish Cream</option>
															<option value="caramel">Caramel</option>
															<option value="cookiescream">Cookies and Cream</option>
															<option value="baileys">Baileys Irish Cream</option>
															<option value="doublechoco">Double Chocolate</option>
													</select>
											</th>
											<th id="quantity">
													<input type="number" name="beans[]" placeholder="Enter Quantity" min="1" max="1000" size="20">
											</th>
											<th id="remove">
													<input type="button" value="&#10006;" onclick="RemoveOrder()">
												</th>
										</tr>
									</thead>
									<tbody>



									</tbody>
								</table>
							</div>
						</div>
						<div class="modal-footer">
							<input type="button" onclick="cloneRow()" value="Add Order" class="btn btn-secondary"/>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Submit</button>

						</div>
					</div>
				</div>
			</div>

		<?php
			if (isset($_POST['pending'])) {
				$sql_pending = "SELECT delivery.orderid, products.productname, delivery.quantity, delivery.time, delivery.status, delivery.supplierid
				from ((delivery left join products on delivery.productid = products.productid)
				left join branch on delivery.branchid = branch.branchid) where branch.branchid = 1 and delivery.status = 'pending'";
				$result = mysqli_query($conn, $sql_pending);
		?>

			<h2>Pending Orders</h2>

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
						if($result = mysqli_query($conn, $sql_pending)) {
							while($row = mysqli_fetch_assoc($result)){
					?>
						<tr>
							<td> <?php echo $row["orderid"]; ?> </td>
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

		<?php
			if (isset($_POST['accepted'])) {
				$sql_pending = "SELECT delivery.orderid, products.productname, delivery.quantity, delivery.time, delivery.status, delivery.supplierid
				from ((delivery left join products on delivery.productid = products.productid)
				left join branch on delivery.branchid = branch.branchid) where branch.branchid = 1 and delivery.status = 'accepted'";
				$result = mysqli_query($conn, $sql_pending);
		?>

			<h2>Accepted/Rejected Orders</h2>

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
						if($result = mysqli_query($conn, $sql_pending)) {
							while($row = mysqli_fetch_assoc($result)){
					?>
						<tr>
							<td> <?php echo $row["orderid"]; ?> </td>
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

		</br>
		</main>

		</div><!--/.row-->
	</div>	<!--/.main-->

</body>
</html>
