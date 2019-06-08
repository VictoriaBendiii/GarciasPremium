<?php
session_start();
// Check if there is a user logged in
if(!isset($_SESSION['login_user'])){
  header('Location: ../index.php');
  exit;
}
include '../expired.php';
if(isLoginSessionExpired()) {
  header("Location:../index.php?session_expired=1");
}
$page = 'request'; ?>
<?php include('include/header.php'); ?>
<?php include('include/sidebar.php'); ?>
<style>
th, td{
	padding: 10px;
}
</style>

        <script type="text/javascript">
            function cloneRow(e) {
                e.preventDefault();
                var row = document.querySelector(".dropdowns:last-child");
                var tableBody = document.querySelector("#tableDrop tbody");
                var clone = row.cloneNode(true);
                var clonedDrop = clone.querySelector('.beansDrop');
                var lastDrop = row.querySelector('.beansDrop');
                clonedDrop.value = '';
                if (lastDrop.selectedIndex != -1) clonedDrop.options[lastDrop.selectedIndex].disabled = true;
                tableBody.appendChild(clone);
            }
            function RemoveOrder(ele) {
                var rownumber = document.getElementById("tableDrop").rows.length;
                if (rownumber == 2){
                    window.alert("You cannot remove the last order");
                }	else {
                    var row = ele.closest('tr');
                    var drop = row.querySelector('.beansDrop');
                    var alldrop = document.querySelectorAll('.beansDrop');
                    if (drop.selectedIndex != -1)
                        alldrop.forEach(ele => ele.options[drop.selectedIndex].disabled = false)
                    row.remove();
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
					REQUEST TO MARKET
				</button>
			<br>
			<br>
			<form action="request.php" method="POST">
				<div class="btn-group" role="group" aria-label="...">
					<button type="submit" class="btn btn-default" name="pending" id="pending">Order items</button>
					<button type="submit" class="btn btn-default" name="accepted" id="accepted">Delivery items</button>
				</div>
			</form>
			</div>

			<!-- Modal -->

			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Request Stock</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
						<form action="request.php" method="POST" class="form">
							<div class="table-responsive" style="overflow-x:auto;">
								<table id="tableDrop" class="table table-bordered table-striped">
									<tr>
										<th>Product</th>
										<th>Quantity (in KG)</th>
										<th>Action</th>
									</tr>
									<tr class="dropdowns">
										<td class="beansDropdown">								
											<select name="prodname[]" id="prodname" class="beansDrop">
												<?php
													$sql = "SELECT * FROM products WHERE status='Active'";
													$result = mysqli_query($conn, $sql);
													$row = mysqli_num_rows($result);
													while ($row = mysqli_fetch_array($result)) {
															echo "<option value='". $row['productid'] ."'>". $row['productname'] ."</option>";
															}
												?>
											</select>				
										</td>
										<td id="quantity">
											<input type="number" name="prodquan[]" id="prodquan" placeholder="Enter Quantity" min="50" max="1000" size="20">
										</td>
										<td id="remove">
											<input type="button" value="&#10006;" onclick="RemoveOrder(this)">
										</td>
									</tr>
								</table>
							</div>
							<table>
								<br>
								<tr>
									<td> <input type="button" onclick="cloneRow(event)" name="add" id="add" value="Add" class="btn btn-secondary"/> </td>
									<td> <button type="submit" class="btn btn-primary" name="sub" id="sub" onclick = "return confirm('Are you sure with the request?')">Submit</button> </td>
								</tr>
							</table>
						</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

		<?php

			if (isset($_POST['sub'])) {

				$status = "pending";

				$sql_req = "SELECT order_requestid from order_request order by order_requestid desc limit 1";
				$result = mysqli_query($conn, $sql_req);
				$row = mysqli_num_rows($result);
				$row = mysqli_fetch_array($result);
				$res1 = $row['order_requestid'];
				$res1++;

				$sql1 = "SELECT deliveryid from order_request order by deliveryid desc limit 1";
				$result1 = mysqli_query($conn, $sql1);
				$row = mysqli_num_rows($result1);
				$row = mysqli_fetch_array($result1);
				$res2 = $row['deliveryid'];
				$res2++;


				foreach (array_combine($_POST['prodname'], $_POST['prodquan']) as $prodname => $prodquan){

					$supplier = '2';
					$sql_sub = "INSERT INTO order_request(order_requestid, quantity, time, status, accountid, branchid, deliveryid, productid, supplierid)
							VALUES ('$res1', '$prodquan', SYSDATE(), '$status', '$accountid', '$branchid', '$res2', '$prodname', '$supplier')";

					mysqli_query($conn, $sql_sub);
					
				}
			}


		?>

		

		<?php
			if (isset($_POST['pending'])) {
				$sql_pending = "SELECT order_request.idnumber, products.productname, order_request.order_requestid, order_request.quantity, order_request.status, DATE_FORMAT(order_request.time, '%b %d, %Y %r') as time
				FROM order_request inner join products on order_request.productid = products.productid 
				WHERE order_request.branchid = $branchid AND order_request.status='pending' OR order_request.status='rejected' 
				ORDER BY order_request.time desc";
				$result = mysqli_query($conn, $sql_pending);
		?>

			<h2>Pending Orders</h2>

			<div class="table-responsive">
				<table class="table table-bordered table-striped table-sm">
						<tr>
							<th>Date & Time</th>
							<th>Product</th>
							<th>Quantity (in Kg)</th>
							<th>Status</th>
						</tr>

					<?php
						if($result = mysqli_query($conn, $sql_pending)) {
							while($row = mysqli_fetch_assoc($result)){
					?>
						<tr>
							<td> <?php echo $row["time"]; ?> </td>
							<td> <?php echo $row["productname"]; ?> </td>
							<td> <?php echo $row["quantity"]; ?> </td>
							<td> <?php echo $row["status"];?> </td>
						</tr>
					<?php
							}
						}
					?>
				</table>
			</div>
			<?php
				}
			?>

		<?php
			if (isset($_POST['accepted'])) { 
				$sql_accepted = "SELECT delivery.idnumber, products.productname, delivery.order_requestid, delivery.quantity, delivery.status, DATE_FORMAT(delivery.time, '%b %d, %Y %r') as time
				FROM delivery inner join products on delivery.productid = products.productid 
				WHERE delivery.branchid=$branchid AND delivery.status='pending'
				ORDER BY delivery.time desc";
				$result = mysqli_query($conn, $sql_accepted);
		?>

			<h2>Accepted/Rejected Orders</h2>

			<div class="table-responsive" style="overflow-x:auto;">
				<table class="table table-bordered table-striped table-sm">
						<tr>
							<th>Date & Time</th>
							<th>Product</th>
							<th>Quantity (in Kg)</th>
							<th>Status</th>
							<th>Action</th>
						</tr>

					<?php
						if($result = mysqli_query($conn, $sql_accepted)) {
							while($row = mysqli_fetch_assoc($result)){
					?>
						<tr>
							<td> <?php echo $row["time"]; ?> </td>
							<td> <?php echo $row["productname"]; ?> </td>
							<td> <?php echo $row["quantity"]; ?> </td>
							<td> <?php echo $row["status"]; ?> </td>
							<td>
								<a href="#edit<?php echo $row['idnumber']; ?>" data-toggle="modal" class="btn btn-success" data-toggle="modal">Accept</a>	
								<div id="edit<?php echo $row['idnumber']; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-lg">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Delivery</h4>
											</div>
									<form action="request.php" method="POST" class="form">
										<div class="modal-body">
											<div class="table-responsive" style="overflow-x:auto;">
												<table class="table table-bordered table-striped">
													<tr>
														<th>Date & Time</th>
														<th>Product</th>
														<th>Quantity (in KG)</th>
														<th>Status</th>
													</tr>
													<tr>
														<td>
															<input type="hidden" name="idnum" value="<?php echo $row['idnumber']; ?>">
															<input type="text" name="time" value="<?php echo $row['time'];?>" readonly>		
														</td>
														<td>
															<input type="text" name="prodname" value="<?php echo $row['productname'];?>" readonly>				
														</td>
														<td>
															<input type="number" name="recquan" id="recquan" placeholder="Enter Quantity" min="50" max="1000" required>
														</td>
														<td>
															<input type="text" name="status" value="<?php echo $row['status'];?>" readonly>					
														</td>
													</tr>
												</table>
											</div>
										</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary" name="sub1" id="sub1">Submit</button>
									</div>
									</form>
								</div>
								</div>
								</div>
							</td>
						</tr>
			<?php 
						}
					}
				}
			?>		
				</table>
			</div>

			<?php 
			
				if (isset($_POST['sub1'])) {	
					$id = mysqli_real_escape_string($conn, $_POST['idnum']);
					$prodquan = mysqli_real_escape_string($conn, $_POST['recquan']);
					$status = mysqli_real_escape_string($conn, $_POST['status']);
					$time = mysqli_real_escape_string($conn, $_POST['time']);


					$sql_get1 = "SELECT * FROM delivery WHERE idnumber=$id";
					$result1 = mysqli_query($conn, $sql_get1);
					$row = mysqli_num_rows($result1);
					$row = mysqli_fetch_array($result1);

					$sql_update = "UPDATE delivery SET status='delivered',time=SYSDATE(),quantity=$prodquan WHERE idnumber=$id";
					mysqli_query($conn, $sql_update);
		
		
					$sql_get2 = "SELECT delivery.idnumber, stock.stockid, stock.productid, stock.quantity FROM stock 
						inner join delivery on stock.productid = delivery.productid
						WHERE stock.branchid = $branchid AND delivery.idnumber=$id";
					$result2 = mysqli_query($conn, $sql_get2);
					$row = mysqli_num_rows($result2);
					$row = mysqli_fetch_array($result2);
					$stockquan = $row['quantity'];
					$prodid = $row['productid'];
		
					$fin = $prodquan+$stockquan;
		
					$sql_update2 = "UPDATE stock SET quantity=$fin,date_in=SYSDATE(),stockin=$prodquan WHERE productid=$prodid AND branchid=$branchid";
					mysqli_query($conn, $sql_update2);
		
		
				}
				?>
		<br>
		</main>

		</div><!--/.row-->
	</div>	<!--/.main-->

</body>
</html>
