<?php include('others.php'); ?>
<?php include('include/sidebar.php'); ?>

	
	<form action="others-process.php" method="POST">
        <?php
			if (isset($_POST['spoil'])) {
				$sqlspoil = "SELECT * from ((stock left join products on stock.productid = products.productid)
				left join branch on stock.branchid = branch.branchid) where branch.branchid = $branchid";
				$result = mysqli_query($conn, $sqlspoil);
		?>
			<h2>Product Spoilage</h2>

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
				left join branch on stock.branchid = branch.branchid) where branch.branchid = $branchid";
				$result = mysqli_query($conn, $sqlloss);
		?>
			<h2>Product Loss</h2>		

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
					
					mysqli_query($conn, $sql_loss);
	
				}
			}
	?>


	<form action="others-process.php" method="POST">
        <?php
			if (isset($_POST['return'])) {
				$sqlreturn = "SELECT products.productname, solditem.solditemid, solditem.productid, solditem.quantity, solditem.branchid FROM 
				(solditem left join products on solditem.productid = products.productid) where solditem.branchid=$branchid and solditem.time > DATE_SUB(NOW(), INTERVAL 24 HOUR)";
				$result1 = mysqli_query($conn, $sqlreturn);

				$sqlexchange = "SELECT * from ((stock left join products on stock.productid = products.productid)
				left join branch on stock.branchid = branch.branchid) where branch.branchid = $branchid";
				$result2 = mysqli_query($conn, $sqlexchange);
		?>

			<h2>Customer's Item</h2>		

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
								<select name="returnname[]" id="returnname">
								<?php
								$row = mysqli_num_rows($result1);
								while ($row = mysqli_fetch_array($result1)) {
						?>
									<?php 
										echo "<option value='". $row['productid'] ."'> ".$row['productname'] ."</option>";				
										}
									?>
								</select>				
							</td>
							<td id="quantity">

								<input type="number" name="returnquan[]" id="returnquan" placeholder="Enter Quantity" min="1" max="1000" size="20" >
											

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

			<h2>Exchange to</h2>				

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
								<select name="exchangename[]" id="returnname">
								<?php
								$row = mysqli_num_rows($result2);
								while ($row = mysqli_fetch_array($result2)) {
						?>
									<?php 
										echo "<option value='". $row['productid'] ."'> ".$row['productname'] ."</option>";				
										}
									?>
								</select>				
							</td>
							<td id="quantity">

								<input type="number" name="exchangequan[]" id="returnquan" placeholder="Enter Quantity" min="1" max="1000" size="20" >
											

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
							<button type="submit" class="btn btn-primary" name="subreturn" id="subreturn">Submit</button>
						</div>
			<?php	
				}
			?>
	</form>

	<?php

		if (isset($_POST['subreturn'])) {
			$name = $_POST['returnname'];
			$quan = $_POST['returnquan'];	
				foreach ($name AS $key => $returnname){

					$returnquan = $quan[$key];

					$sql1 = "SELECT quantity FROM solditem WHERE productid=$returnname and branchid=$branchid";
					$result1 = mysqli_query($conn, $sql1);
					$row1 = mysqli_num_rows($result1);
					$row1 = mysqli_fetch_array($result1);
					$res1 = $row1['quantity'];
					$fin1 = $res1+$returnquan;
					
					$sql_return = "UPDATE stock SET quantity=$fin1,stockout=$returnquan,date_in=SYSDATE() WHERE productid=$returnname and branchid=$branchid";
					
					mysqli_query($conn, $sql_return);
	

				}
				foreach (array_combine($_POST['exchangename'] , $_POST['exchangequan']) as $exchangename => $exchangequan){

					$sql2 = "SELECT * from solditem INNER JOIN products on solditem.productid = products.productid) 
					WHERE solditem.productid=$returnname and branchid=$branchid";
					$result2 = mysqli_query($conn, $sql2);

					$row2 = mysqli_num_rows($result2);
					$row2 = mysqli_fetch_array($result2);
					$res2 = $row2['quantity'];
					$fin2 = $res2-$exchangequan;

					$status= 'Return/Exchange';
					
					$sql_return1 = "UPDATE stock SET quantity=$fin2,stockout=$returnquan,date_out=SYSDATE() WHERE productid=$returnname and branchid=$branchid";
					$sql_return2 = "UPDATE solditem SET productid=$exchangename,quantity=$returnquan,date_out=SYSDATE(),status=$status WHERE productid=$name and branchid=$branchid";
					
					mysqli_query($conn, $sql_return1);
					mysqli_query($conn, $sql_return2);
	
				}
			
			}
	?>
		</main>

</div><!--/.row-->
</div>	<!--/.main-->

</body>
</html>