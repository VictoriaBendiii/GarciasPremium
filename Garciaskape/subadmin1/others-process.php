<?php include('others.php'); ?>

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
					
					mysqli_query($conn, $sql_spoil);
				}
			}
	?>

	
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