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
$page = 'others'; ?>
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
                    window.alert("You cannot remove the last item.");
                }	else {
                    var row = ele.closest('tr');
                    var drop = row.querySelector('.beansDrop');
                    var alldrop = document.querySelectorAll('.beansDrop');
                    if (drop.selectedIndex != -1)
                        alldrop.forEach(ele => ele.options[drop.selectedIndex].disabled = false)
                    row.remove();
                }
            }

			function CloneRow(e) {
                e.preventDefault();
                var row = document.querySelector(".Dropdowns:last-child");
                var tableBody = document.querySelector("#TableDrop tbody");
                var clone = row.cloneNode(true);
                var clonedDrop = clone.querySelector('.BeansDrop');
                var lastDrop = row.querySelector('.BeansDrop');
                clonedDrop.value = '';
                if (lastDrop.selectedIndex != -1) clonedDrop.options[lastDrop.selectedIndex].disabled = true;
                tableBody.appendChild(clone);
            }
            function removeOrder(ele) {
                var rownumber = document.getElementById("TableDrop").rows.length;
                if (rownumber == 2){
                    window.alert("You cannot remove the last item.");
                }	else {
                    var row = ele.closest('tr');
                    var drop = row.querySelector('.BeansDrop');
                    var alldrop = document.querySelectorAll('.BeansDrop');
                    if (drop.selectedIndex != -1)
                        alldrop.forEach(ele => ele.options[drop.selectedIndex].disabled = false)
                    row.remove();
                }
            }

									
				$(document).ready(function(){
				$("#input").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#table tr").filter(function() {
					$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				});
				});
				
			</script>

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
				<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<div class="btn-group" role="group">
					  <button type="submit" class="btn btn-primary" name="spoil" id="spoil"> Spoilage </button>
					</div>
					<div class="btn-group" role="group">
					  <button type="submit" class="btn btn-primary" name="loss" id="loss"> Loss </button>
					</div>
					<div class="btn-group" role="group">
					  <button type="submit" class="btn btn-primary" name="return" id="return"> Return/Exchange </button>
					</div>
					<div class="btn-group" role="group">
					  <button type="submit" class="btn btn-primary" name="recon" id="recon"> Reconciliation </button>
					</div>
				</div>
				</form>
			</div>
			<br>

	<form action="others-process.php" method="POST">
        <?php
			if (isset($_POST['spoil'])) {
				$sqlspoil = "SELECT * FROM ((stock left join products on stock.productid = products.productid)
				left join branch on stock.branchid = branch.branchid)
				WHERE stock.branchid = $branchid AND products.status='Active'";
				$result = mysqli_query($conn, $sqlspoil);
				$status = 'Spoilage';
		?>
			<h2>Product Spoilage</h2>

			<div class="table-responsive" style="overflow-x:auto;">
				<table id="tableDrop" class="table table-bordered table-striped table-sm">
						<tr>
							<th>Product</th>
							<th>Quantity (in KG)</th>
							<th>Status</th>
                            <th>Action</th>
						</tr>
						<tr class="dropdowns">
							<td class="beansDropdown">							
								<select name="prodname[]" id="prodname" class="beansDrop">
									<?php
										$row = mysqli_num_rows($result);
										while ($row = mysqli_fetch_array($result)) {
												echo "<option value='". $row['productid'] ."'>". $row['productname'] ."</option>";
												}
									?>
								</select>				
							</td>
							<td id="quantity">
								<input type="number" name="prodquan[]" id="prodquan" placeholder="Enter Quantity" min="1" max="1000" required>
							</td>
							<td id="status">
								<?php echo $status; ?>
							</td>
							<td id="remove">
								<input type="button" value="&#10006;" onclick="RemoveOrder(this)">
							</td>
						</tr>
				</table>
			</div>

			<div class="form-inline">
				<input type="button" onclick="cloneRow(event)" name="add" id="add" value="Add" class="btn btn-secondary"/>
				<button type="submit" class="btn btn-primary" name="subspoil" id="subspoil">Submit</button>
			</div>
			<?php
				}
			?>
	</form>

	<form action="others-process.php" method="POST">
        <?php
			if (isset($_POST['loss'])) {
				$sqlloss = "SELECT * FROM ((stock left join products on stock.productid = products.productid)
				left join branch on stock.branchid = branch.branchid)
				WHERE stock.branchid = $branchid AND products.status='Active'";
				$result = mysqli_query($conn, $sqlloss);
				$status = 'Loss';
		?>
			<h2>Product Loss</h2>		

		<div class="table-responsive" style="overflow-x:auto;">
				<table id="tableDrop" class="table table-bordered table-striped table-sm">
						<tr>
							<th>Product</th>
							<th>Quantity (in KG)</th>
							<th>Status</th>
                            <th>Action</th>
						</tr>
						<tr class="dropdowns">
							<td class="beansDropdown">							
								<select name="prodname[]" id="prodname" class="beansDrop">
									<?php
										$row = mysqli_num_rows($result);
										while ($row = mysqli_fetch_array($result)) {
												echo "<option value='". $row['productid'] ."'>". $row['productname'] ."</option>";
												}
									?>
								</select>				
							</td>
							<td id="quantity">
								<input type="number" name="prodquan[]" id="prodquan" placeholder="Enter Quantity" min="1" max="1000" required>
							</td>
							<td id="status">
								<?php echo $status; ?>
							</td>
							<td id="remove">
								<input type="button" value="&#10006;" onclick="RemoveOrder(this)">
							</td>
						</tr>
				</table>
			</div>

			<div class="form-inline">
				<input type="button" onclick="cloneRow(event)" name="add" id="add" value="Add" class="btn btn-secondary"/>
				<button type="submit" class="btn btn-primary" name="subloss" id="subloss">Submit</button>
			</div>
			<?php
				}
			?>
	</form>

	<?php

		if (isset($_POST['return'])) {
				$sql_accepted = "SELECT solditem.idnumber, products.productname, products.productid, solditem.solditemid, solditem.quantity, solditem.status, DATE_FORMAT(solditem.time, '%b %d, %Y %r') as time
				FROM solditem inner join products on solditem.productid = products.productid 
				WHERE solditem.branchid=$branchid AND solditem.status='sold' AND solditem.time > DATE_SUB(NOW(), INTERVAL 24 HOUR)
				ORDER BY solditem.time desc";
				$result = mysqli_query($conn, $sql_accepted);
	?>
			<h2>Customer's Order</h2>		

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
								<a href="#edit<?php echo $row['idnumber']; ?>" data-toggle="modal" class="btn btn-primary" data-toggle="modal">Edit</a>	
								<div id="edit<?php echo $row['idnumber']; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog modal-lg">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Return</h4>
											</div>
											<form action="others-process.php" method="POST" class="form">
									<div class="modal-body">
											<div class="table-responsive" style="overflow-x:auto;">
												<table class="table table-bordered table-striped">
													<tr>
														<th>Date & Time</th>
														<th>Product</th>
														<th>Quantity (in KG)</th>
													</tr>
													<tr>
														<td>
															<input type="hidden" name="idnum" value="<?php echo $row['idnumber']; ?>">
															<input type="hidden" name="status" value="<?php echo $row['status'];?>" readonly>	
															<input type="text" name="time" value="<?php echo $row['time'];?>" readonly>		
														</td>
														<td>
														<select name="prodname" id="prodname">
																<?php
																		$sqlsold = "SELECT * FROM (stock left join products on stock.productid = products.productid)
																		WHERE stock.branchid = $branchid AND products.status='Active'";
																		$result1 = mysqli_query($conn, $sqlsold);
																		$row = mysqli_num_rows($result1);
																		while ($row = mysqli_fetch_array($result1)) {
																	
																			echo "<option value='". $row['productid'] ."'>". $row['productname'] ."</option>";
																		}
																?>
															</select>						
														</td>
														<td>
															<input type="number" name="recquan" id="recquan" placeholder="Enter Quantity" min="1" max="1000" required>
														</td>
													</tr>
												</table>
											</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary" name="subreturn" id="subreturn">Submit</button>
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
					?>		
				</table>
			</div>
		<?php 
			}
		?>
	

			<?php
				if (isset($_POST['recon'])) {
					$sql = "SELECT * FROM ((stock left join products on stock.productid = products.productid)
					left join branch on stock.branchid = branch.branchid) WHERE stock.branchid = $branchid ORDER BY productname";
					$result = mysqli_query($conn, $sql);
			?>
			
			<div class="table-responsive" style="overflow-x:auto;">
				<table class="table table-bordered table-striped table-sm">
						<tr>
							<th>Product</th>
							<th>Quantity (in Kg)</th>
							<th>Action</th>
						</tr>
					<tbody id="table">

					<?php
						if($result = mysqli_query($conn, $sql)) {
							while($row = mysqli_fetch_assoc($result)){
					?>
						<tr>
							<td> <?php echo $row["productname"]; ?> </td>
							<td> <?php echo $row["quantity"]; ?> </td>
							<td>
							<?php 
								date_default_timezone_set('Asia/Manila');
								$date = date('H:i:s');
								$date1 = ("21:00:00");
								$date2 = ("23:00:00");
								if ($date > $date1 && $date < $date2) {
							?>	
								<a href="#edit<?php echo $row['stockid']; ?>" data-toggle="modal" id="time" class="btn btn-primary" data-toggle="modal">Edit</a>	
							<?php 
								} else {
							?>
								<button type="button" class="btn btn-primary" disabled> Edit </button>
							<?php 
								} 
							?>
								<div id="edit<?php echo $row['stockid']; ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Reconciliation</h4>
											</div>
											<form action="others-process.php" method="POST" class="form">
									<div class="modal-body">
											<div class="table-responsive" style="overflow-x:auto;">
												<table class="table table-bordered table-striped">
													<tr>
														<th>Product</th>
														<th>Quantity (in KG)</th>
													</tr>
													<tr>
														<td>
															<input type="hidden" name="stocknum" value="<?php echo $row['stockid']; ?>">	
															<?php echo $row['productname']; ?>
														</td>
														<td>
															<input type="number" name="reconquan" id="reconquan" placeholder="Enter Quantity" min="1" max="1000" required>
														</td>
													</tr>
												</table>
											</div>
									</div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary" name="subrecon" id="subrecon">Submit</button>
									</div>
									</form>
								</div>
								</div>
								</div>
							</td>
						</tr>
					</tbody>

					<?php
							}
						}
					?>
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