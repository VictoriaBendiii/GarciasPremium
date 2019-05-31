<?php $page = 'others'; ?>
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

									
					$(document).ready(function() {
					var button = $('#crit');
					$(button).prop('disabled', true);

					$('#edit').click(function() {
						if ($(button).prop('disabled')) $(button).prop('disabled', false);
						else $(button).prop('disabled', true);
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
				$sqlspoil = "SELECT * from ((stock left join products on stock.productid = products.productid)
				left join branch on stock.branchid = branch.branchid) where branch.branchid = $branchid AND products.status='Active'";
				$result = mysqli_query($conn, $sqlspoil);
		?>
			<h2>Product Spoilage</h2>

			<div class="table-responsive" style="overflow-x:auto;">
				<table id="tableDrop" class="table table-bordered table-striped table-sm">
						<tr>
							<th>Product</th>
							<th>Quantity (in KG)</th>
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
				$sqlloss = "SELECT * from ((stock left join products on stock.productid = products.productid)
				left join branch on stock.branchid = branch.branchid) where branch.branchid = $branchid AND products.status='Active'";
				$result = mysqli_query($conn, $sqlloss);
		?>
			<h2>Product Loss</h2>		

		<div class="table-responsive" style="overflow-x:auto;">
				<table id="tableDrop" class="table table-bordered table-striped table-sm">
						<tr>
							<th>Product</th>
							<th>Quantity (in KG)</th>
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

<form action="others-process.php" method="POST">
    <?php
			if (isset($_POST['return'])) {
				$sqlreturn = "SELECT DATE_FORMAT(solditem.time,'%b %d, %Y %r') as time, products.productname, solditem.solditemid, solditem.productid, solditem.quantity, solditem.branchid FROM 
				(solditem left join products on solditem.productid = products.productid) where solditem.branchid=$branchid and solditem.time > DATE_SUB(NOW(), INTERVAL 24 HOUR)";
				$result1 = mysqli_query($conn, $sqlreturn);

				$sqlexchange = "SELECT * from ((stock left join products on stock.productid = products.productid)
				left join branch on stock.branchid = branch.branchid) where branch.branchid = $branchid";
				$result2 = mysqli_query($conn, $sqlexchange);
		?>

			<h2>Customer's Order</h2>		

			<div class="table-responsive">
				<table id="tableDrop" class="table table-bordered table-striped table-sm">
						<tr>
							<th>Time</th>
							<th>Product</th>
							<th>Quantity (in KG)</th>
                            <th>Action</th>
						</tr>
						<tr class="dropdowns">
						<td class="beansDropdown">							
								<select name="order[]" id="order" class="beansDrop">
									<?php
										$row = mysqli_num_rows($result1);
										while ($row = mysqli_fetch_array($result1)) {
												echo "<option value='". $row['solditemid'] ."'>". $row['time'] ."</option>";
											}

									?>
								</select>				
							</td>
							<td class="beansDropdown">							
								<select name="prodname[]" id="prodname" class="beansDrop">
									<?php

											$sql_order = "SELECT * FROM (stock left join products on stock.productid = products.productid) WHERE stock.branchid=$branchid";
											$result3 = mysqli_query($conn, $sql_order);
											$row = mysqli_num_rows($result3);
											while ($row = mysqli_fetch_array($result3)) {

												echo "<option value='". $row['productid'] ."'>". $row['productname'] ."</option>";
												}
										
									?>
								</select>			
							</td>
							<td id="quantity">
								<input type="number" name="prodquan[]" id="prodquan" placeholder="Enter Quantity" min="1" max="1000" required>
							</td>
							<td id="remove">
								<input type="button" value="&#10006;" onclick="RemoveOrder(this)">
							</td>
						</tr>
				</table>
			</div>
			<div class="form-inline">
				<input type="button" onclick="cloneRow(event)" name="add" id="add" value="Add" class="btn btn-secondary"/>
			</div>

			<h2>Exchange to</h2>				

			
			<div class="table-responsive">
				<table id="TableDrop" class="table table-bordered table-striped table-sm">
						<tr>
							<th>Product</th>
							<th>Quantity (in KG)</th>
                            <th>Action</th>
						</tr>
						<tr class="Dropdowns">
							<td class="BeansDropdown">							
								<select name="prodname[]" id="prodname" class="BeansDrop">
									<?php
										$row = mysqli_num_rows($result2);
										while ($row = mysqli_fetch_array($result2)) {
												echo "<option value='". $row['productid'] ."'>". $row['productname'] ."</option>";
												}
									?>
								</select>				
							</td>
							<td id="quantity">
								<input type="number" name="prodquan[]" id="prodquan" placeholder="Enter Quantity" min="1" max="1000" required>
							</td>
							<td id="remove">
								<input type="button" value="&#10006;" onclick="removeOrder(this)">
							</td>
						</tr>
				</table>
			</div>

			<div class="form-inline">
				<input type="button" onclick="CloneRow(event)" name="add" id="add" value="Add" class="btn btn-secondary"/>
				<button type="submit" class="btn btn-primary" name="return" id="return">Submit</button>
			</div>
			<?php	
				}
			?>
	</form>

	

			<?php
				if (isset($_POST['recon'])) {
					$sql = "SELECT * from ((stock left join products on stock.productid = products.productid)
					left join branch on stock.branchid = branch.branchid) where branch.branchid = $branchid ORDER BY productname";
					$result = mysqli_query($conn, $sql);
			?>
			<form action="others-process.php" method="POST">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
					<label> Time of reconciling: <input type="time" name="time" id="time"></label>
					<button type="submit" class="btn btn-success btn-sm" name="sub" id="sub">Submit</button>
					<br>
					<br>
			</div>
			</form>

			<div class="table-responsive" style="overflow-x:auto;">
				<table class="table table-bordered table-striped table-sm">
						<tr>
							<th>Product</th>
							<th>Quantity (in Kg)</th>
							<th>Action</th>
						</tr>
					<tbody>

					<?php
						if($result = mysqli_query($conn, $sql)) {
							while($row = mysqli_fetch_assoc($result)){
					?>
						<tr>
							<td> <?php echo $row["productname"]; ?> </td>
							<td><input type="number" name="crit" id="crit" value="<?php echo $row["quantity"]; ?>" disabled></td>
							<td><button type="button" name="edit" id="edit"><i class="fa fa-edit"></i></button></td>
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
		</main>

</div><!--/.row-->
</div>	<!--/.main-->

</body>
</html>