<?php include('others.php'); ?>
<?php include('include/sidebar.php'); ?>

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
	
	<form action="others-process.php" method="POST">
        <?php
			if (isset($_POST['spoil'])) {
				$sqlspoil = "SELECT * from ((stock left join products on stock.productid = products.productid)
				left join branch on stock.branchid = branch.branchid) where branch.branchid = 1";
				$result = mysqli_query($conn, $sqlspoil);
		?>

			<div class="table-responsive">
				<table id="tableDrop" class="table table-bordered table-striped table-sm">
					<thead>
						<tr>
							<th>Product</th>
							<th>Qty / Kg</th>
                            <th>Action</th>
						</tr>
						<tr id="dropdowns">
							<th id="beans">							
								<select name="prodname[]" id="prodname">
									<?php
										$row = mysqli_num_rows($result);
										while ($row = mysqli_fetch_array($result)) {
												echo "<option value='". $row['productid'] ."'>". $row['productname'] ."</option>";
												}
									?>
								</select>				
							</th>
							<th id="quantity">
								<input type="number" name="prodquan[]" id="prodquan" placeholder="Enter Quantity" min="1" max="1000" size="20">
							</th>
							<th id="action">
								<input type="button" value="&#10006;" onclick="RemoveOrder()">
                            	<input type="button" onclick="cloneRow()" name="add" id="add" value="Add Order" class="btn btn-secondary"/>
							</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary" name="subspoil" id="subspoil">Submit</button>
						</div>
			<?php
				}
			?>
	</form>

	<?php

		if (isset($_POST['subspoil'])) {
				foreach (array_combine($_POST['prodname'] , $_POST['prodquan']) as $prodname => $prodquan){

					$sql = "SELECT quantity FROM stock WHERE productid=$prodname";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_num_rows($result);
					$row = mysqli_fetch_array($result);
					$res = $row['quantity'];
					$fin = $res-$prodquan;
					
					$sql_spoil = "UPDATE stock SET quantity=$fin,stockout=$prodquan,date_out=SYSDATE() WHERE productid=$prodname and branchid=$branchid";
					
					//mysqli_query($conn, $sql_spoil);

					if ($conn->query($sql_spoil) === TRUE) {
						echo "New record created successfully";
					} else {
						echo "Error: " . $sql_spoil . "<br>" . $conn->error;
					}	
				}
			}
	?>




	<form action="others-process.php" method="POST">
        <?php
			if (isset($_POST['loss'])) {
				$sqlloss = "SELECT * from ((stock left join products on stock.productid = products.productid)
				left join branch on stock.branchid = branch.branchid) where branch.branchid = 1";
				$result = mysqli_query($conn, $sqlloss);
		?>

			<div class="table-responsive">
				<table id="tableDrop" class="table table-bordered table-striped table-sm">
					<thead>
						<tr>
							<th>Product</th>
							<th>Qty / Kg</th>
                            <th>Action</th>
						</tr>
						<tr id="dropdowns">
							<th id="beans">							
								<select name="prodname[]" id="prodname">
									<?php
										$row = mysqli_num_rows($result);
										while ($row = mysqli_fetch_array($result)) {
												echo "<option value='". $row['productid'] ."'>". $row['productname'] ."</option>";
												}
									?>
								</select>				
							</th>
							<th id="quantity">
								<input type="number" name="prodquan[]" id="prodquan" placeholder="Enter Quantity" min="1" max="1000" size="20">
							</th>
							<th id="action">
								<input type="button" value="&#10006;" onclick="RemoveOrder()">
                            	<input type="button" onclick="cloneRow()" name="add" id="add" value="Add Order" class="btn btn-secondary"/>
							</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary" name="subloss" id="subloss">Submit</button>
						</div>
			<?php	
				}
			?>
	</form>

	
	<?php

		if (isset($_POST['subloss'])) {
				foreach (array_combine($_POST['prodname'] , $_POST['prodquan']) as $prodname => $prodquan){

					$sql = "SELECT quantity FROM stock WHERE productid=$prodname";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_num_rows($result);
					$row = mysqli_fetch_array($result);
					$res = $row['quantity'];
					$fin = $res-$prodquan;
					
					$sql_loss = "UPDATE stock SET quantity=$fin,stockout=$prodquan,date_out=SYSDATE() WHERE productid=$prodname and branchid=$branchid";
					
					//mysqli_query($conn, $sql_spoil);

					if ($conn->query($sql_loss) === TRUE) {
						echo "New record created successfully";
					} else {
						echo "Error: " . $sql_loss . "<br>" . $conn->error;
					}	
				}
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
					<br>
					<br>
					<div class="text-center">
                            <button type="submit" class="btn btn-start-order" name="sub_return" id="sub_return">Submit</button>
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