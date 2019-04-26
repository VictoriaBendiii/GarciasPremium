<?php $page = 'customer'; ?>
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
				<li class="active">Customer</li>
			</ol>
		</div><!--/.row-->
		
		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
				<h1 class="h2">Customer's Order</h1>
			</div>
						
		<form action="customer.php" method="POST">
        <?php
				$sqlspoil = "SELECT * from ((stock left join products on stock.productid = products.productid)
				left join branch on stock.branchid = branch.branchid) where branch.branchid = $branchid";
				$result = mysqli_query($conn, $sqlspoil);
		?>

			<div class="table-responsive">
				<table id="tableDrop" class="table table-bordered table-striped table-sm">
					<thead>
						<tr>
							<th>Product</th>
							<th>Quantity (in KG)</th>
                            <th>Action</th>
						</tr>
						<tr id="dropdowns">
							<td id="beans">							
								<select name="prodname[]" id="prodname">
									<?php
										$row = mysqli_num_rows($result);
										while ($row = mysqli_fetch_array($result)) {
												echo "<option value='". $row['productid'] ."'>". $row['productname'] ."</option>";
												}
									?>
								</select>				
							</td>
							<td id="quantity">
								<input type="number" name="prodquan[]" id="prodquan" placeholder="Enter Quantity" min="1" max="1000" size="20">
							</td>
							<th id="action">
								<input type="button" value="&#10006;" onclick="RemoveOrder()">
                            	<input type="button" onclick="cloneRow()" name="add" id="add" value="Add" class="btn btn-secondary"/>
							</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary" name="cust" id="cust">Submit</button>
						</div>
	</form>

	<?php

		if (isset($_POST['cust'])) {

				$sql2 = "SELECT solditemid from solditem order by solditemid desc limit 1";
				$result2 = mysqli_query($conn, $sql2);
				$row = mysqli_num_rows($result2);
				$row = mysqli_fetch_array($result2);
				$res1 = $row['solditemid'];
				$res1++;

				$sql3 = "SELECT orderid from solditem order by orderid desc limit 1";
				$result3 = mysqli_query($conn, $sql3);
				$row = mysqli_num_rows($result3);
				$row = mysqli_fetch_array($result3);
				$res2 = $row['orderid'];
				$res2++;

				foreach (array_combine($_POST['prodname'] , $_POST['prodquan']) as $prodname => $prodquan){

					$sql1 = "SELECT quantity FROM stock WHERE productid=$prodname";
					$result1 = mysqli_query($conn, $sql1);
					$row = mysqli_num_rows($result1);
					$row = mysqli_fetch_array($result1);
					$res = $row['quantity'];
					$fin = $res-$prodquan;


					$status = "sold";

					
					$sql_cust = "UPDATE stock SET quantity=$fin,stockout=$prodquan,date_out=SYSDATE() WHERE productid=$prodname and branchid=$branchid";
					$sql_update = "INSERT INTO solditem (solditemid, productid, quantity, orderid, branchid, accountid, time, status)
									VALUES('$res1', '$prodname', '$prodquan', '$res2', '$branchid', '$accountid', SYSDATE(), '$status')";
					
					mysqli_query($conn, $sql_cust);
					mysqli_query($conn, $sql_update);

				}
			}
	?>
		
		</main>
		
		</div><!--/.row-->
	</div>	<!--/.main-->
		
</body>
</html>