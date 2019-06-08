<?php
session_start();
// Check if there is a user logged in
if(!isset($_SESSION['login_user'])){
  header('Location: ../index.php');
  exit;
}

include('others.php'); ?>

	<?php

		if (isset($_POST['subspoil'])) {
				foreach (array_combine($_POST['prodname'] , $_POST['prodquan']) as $prodname => $prodquan){

					$sql = "SELECT * FROM stock WHERE productid=$prodname AND branchid=$branchid";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_num_rows($result);
					$row = mysqli_fetch_array($result);
					$res1 = $row['quantity'];
					$res2 = $row['stockid'];
					$res3 = $row['accountid'];
					$res4 = $row['productid'];
					$fin = $res1-$prodquan;

					$rem = 'This is spoilage';
					$status = 'Spoilage';

					$sql_spoilage = "INSERT INTO reconciliation (logical_count, physical_count, time, remarks, status, accountid, branchid, productid, stockid)
					VALUES ('$res1', '$fin', SYSDATE(), '$rem', '$status', '$res3', '$branchid', '$res4', '$res2')";
					mysqli_query($conn, $sql_spoilage);
					
					$sql_spoil = "UPDATE stock SET quantity=$fin,stockout=$prodquan,date_out=SYSDATE() WHERE productid=$prodname and branchid=$branchid";
					mysqli_query($conn, $sql_spoil);


				}
			}
	?>

	
	<?php

		if (isset($_POST['subloss'])) {
				foreach (array_combine($_POST['prodname'] , $_POST['prodquan']) as $prodname => $prodquan){

					$sql = "SELECT * FROM stock WHERE productid=$prodname AND branchid=$branchid";
					$result = mysqli_query($conn, $sql);
					$row = mysqli_num_rows($result);
					$row = mysqli_fetch_array($result);
					$res1 = $row['quantity'];
					$res2 = $row['stockid'];
					$res3 = $row['accountid'];
					$res4 = $row['productid'];
					$fin = $res1-$prodquan;

					$rem = 'This is loss';
					$status = 'Loss';

					$sql_loss1 = "INSERT INTO reconciliation (logical_count, physical_count, time, remarks, status, accountid, branchid, productid, stockid)
					VALUES ('$res1', '$fin', SYSDATE(), '$rem', '$status', '$res3', '$branchid', '$res4', '$res2')";
					mysqli_query($conn, $sql_loss1);
					
					$sql_loss = "UPDATE stock SET quantity=$fin,stockout=$prodquan,date_out=SYSDATE() WHERE productid=$prodname and branchid=$branchid";
					mysqli_query($conn, $sql_loss);

	
				}
			}
	?>

		<?php

			if (isset($_POST['subreturn'])) {
				$id = mysqli_real_escape_string($conn, $_POST['idnum']);
				$prodquan = mysqli_real_escape_string($conn, $_POST['recquan']);
				$status = mysqli_real_escape_string($conn, $_POST['status']);
				$time = mysqli_real_escape_string($conn, $_POST['time']);
				$prodname = mysqli_real_escape_string($conn, $_POST['prodname']);


				$sql_get1 = "SELECT stock.stockid, stock.productid, stock.quantity, stock.stockin, stock.date_in, stock.branchid, solditem.idnumber
				FROM ((solditem left join products on solditem.productid = products.productid)
				left join stock on solditem.branchid = stock.branchid) WHERE stock.branchid = $branchid AND solditem.idnumber = $id AND stock.productid=$prodname";
				$result2 = mysqli_query($conn, $sql_get1);
				$row = mysqli_num_rows($result2);
				$row = mysqli_fetch_array($result2);
				$stockquan = $row['quantity'];
				$stock = $row['stockid'];
				$final1 = $stockquan-$prodquan;


				$sql_get2 = "SELECT stock.stockid, stock.branchid, products.productname, solditem.branchid, solditem.productid, solditem.quantity, solditem.idnumber
				FROM ((solditem left join products on solditem.productid = products.productid)
				left join stock on solditem.stockid = stock.stockid) WHERE solditem.branchid = $branchid AND solditem.idnumber = $id";
				$result3 = mysqli_query($conn, $sql_get2);
				$row = mysqli_num_rows($result3);
				$row = mysqli_fetch_array($result3);
				$soldname = $row['productid'];
				$stock2 = $row['stockid'];

				$sql_get3 = "SELECT stock.productid, stock.branchid, stock.quantity, solditem.idnumber
				FROM ((stock left join products on stock.productid = products.productid)
				left join solditem on stock.stockid = solditem.stockid) WHERE stock.branchid = $branchid AND solditem.idnumber = $id";
				$result4 = mysqli_query($conn, $sql_get3);
				$row = mysqli_num_rows($result4);
				$row = mysqli_fetch_array($result4);
				$stockquan1 = $row['quantity'];

				$sql_get4 = "SELECT stock.productid, stock.branchid, solditem.quantity, solditem.idnumber
				FROM ((stock left join products on stock.productid = products.productid)
				left join solditem on stock.stockid = solditem.stockid) WHERE stock.branchid = $branchid AND solditem.idnumber = $id";
				$result5 = mysqli_query($conn, $sql_get4);
				$row = mysqli_num_rows($result5);
				$row = mysqli_fetch_array($result5);
				$soldquan = $row['quantity'];
				$final2 = $stockquan1+$soldquan;

					$sql_update1 = "UPDATE stock SET quantity=$final2,stockin=$soldquan,date_in=SYSDATE() WHERE branchid=$branchid AND productid=$soldname AND stockid=$stock2";
					mysqli_query($conn, $sql_update1);

					$sql_update2 = "UPDATE stock SET quantity=$final1,stockout=$prodquan,date_out=SYSDATE() WHERE branchid=$branchid AND productid=$prodname";
					mysqli_query($conn, $sql_update2);
					
					$sql_update3 = "UPDATE solditem SET quantity=$prodquan,time=SYSDATE(),productid=$prodname,stockid=$stock WHERE branchid=$branchid AND idnumber=$id";
					mysqli_query($conn, $sql_update3);
			}
			?>

		<?php 
			
			if (isset($_POST['subrecon'])) {	
				$id = mysqli_real_escape_string($conn, $_POST['stocknum']);
				$prodquan = mysqli_real_escape_string($conn, $_POST['reconquan']);

				$sql_get1 = "SELECT * FROM stock WHERE stockid=$id";
				$result1 = mysqli_query($conn, $sql_get1);
				$row = mysqli_num_rows($result1);
				$row = mysqli_fetch_array($result1);
				$stockquan = $row['quantity'];
				$res2 = $row['stockid'];
				$res3 = $row['accountid'];
				$res4 = $row['productid'];


				$rem = 'This is reconcile';
				$status = 'Reconcile';
				$sql_recon1 = "INSERT INTO reconciliation (logical_count, physical_count, time, remarks, status, accountid, branchid, productid, stockid)
				VALUES ('$stockquan', '$prodquan', SYSDATE(), '$rem', '$status', '$res3', '$branchid', '$res4', '$res2')";
				mysqli_query($conn, $sql_recon1);

				$sql_update = "UPDATE stock SET quantity=$prodquan,date_in=SYSDATE() WHERE stockid=$id";
				mysqli_query($conn, $sql_update);	
	
		}
		?>



		</main>

</div><!--/.row-->
</div>	<!--/.main-->

</body>
</html>