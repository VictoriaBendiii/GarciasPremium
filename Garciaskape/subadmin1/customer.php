<?php 
session_start();
if(!isset($_SESSION['login_user'])){
  header('Location: ../index.php');
  exit;
}
include '../expired.php';
if(isLoginSessionExpired()) {
  header("Location:../index.php?session_expired=1");
}
$page = 'customer'; ?>
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
				<li class="active">Customer</li>
			</ol>
		</div><!--/.row-->
		
		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
				<h1 class="h2">Customer's Order</h1>
			</div>
						
		<form action="customer.php" method="POST">
        <?php
				$sqlsold = "SELECT * FROM ((stock left join products on stock.productid = products.productid)
				left join branch on stock.branchid = branch.branchid)
				WHERE stock.branchid = $branchid AND products.status='Active'";
				$result = mysqli_query($conn, $sqlsold);
		?>

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

					$sql1 = "SELECT quantity, stockid FROM stock WHERE productid=$prodname and branchid=$branchid";
					$result1 = mysqli_query($conn, $sql1);
					$row = mysqli_num_rows($result1);
					$row = mysqli_fetch_array($result1);
					$res = $row['quantity'];
					$stock = $row['stockid'];
					$fin = $res-$prodquan;

					$status = "sold";

					$sql_cust = "UPDATE stock SET quantity=$fin,stockout=$prodquan,date_out=SYSDATE() WHERE productid=$prodname and branchid=$branchid";
					
					mysqli_query($conn, $sql_cust);

					$sql_update1 = "INSERT INTO solditem (solditemid, quantity, time, status, accountid, branchid, orderid, productid, stockid)
									VALUES('$res1', '$prodquan', SYSDATE(), '$status', '$accountid', '$branchid', '$res2', '$prodname', '$stock')";
					
					mysqli_query($conn, $sql_update1);

					$sql_update2 = "INSERT INTO orders (orderid, quantity, time, accountid, branchid, productid, stockid)
					VALUES('$res2', '$prodquan', SYSDATE(), '$accountid', '$branchid', '$prodname', '$stock')";

					mysqli_query($conn, $sql_update2);

				}
			}
	?>
		
		</main>

		</div><!--/.row-->
	</div>	<!--/.main-->
		
</body>
</html>