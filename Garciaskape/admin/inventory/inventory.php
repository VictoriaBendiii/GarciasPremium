<?php
session_start();
if(!isset($_SESSION['login_user'])){
  header('Location: ../index.php');
  exit;
}

include '../../expired.php';
if(isLoginSessionExpired()) {
  header("Location:../../index.php?session_expired=1");
}

include '../includes/connection.php';
include '../includes/header.php';
include 'critical.php';
include 'query.php';
?>

<?php
//fetch query
$sql = "SELECT products.productname, products.productid as pid, stock.quantity as stock, branch.branchid, products.status
from ((stock left join products on stock.productid = products.productid)
left join branch on stock.branchid = branch.branchid) where (branch.branchid = 1  OR branch.branchid = 3)
AND products.status = 'Active' ORDER BY products.productname ASC  ";
$result = mysqli_query($conn, $sql);


?>
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="divider"></div>
            <ul class="nav menu">
                <li ><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li><a href="../notification/notification.php"><em class="fa fa-bell">&nbsp;</em> Notification</a></li>
                <li><a href="../deliveries/adeliveries.php"><em class="fa fa-truck">&nbsp;</em> Order Request</a></li>
                <li class="active"><a href="../inventory/inventory.php"><em class="fa fa-edit">&nbsp;</em> Inventory</a></li>
                <li><a href="../branch/branch.php"><em class="fa fa-inbox">&nbsp;</em> Stock Request </a></li>
                <li><a href="../product/product.php"><em class="fa fa-product-hunt">&nbsp;</em> Products</a></li>
                <li><a href="../accounts/accounts.php"><em class="fa fa-user">&nbsp;</em> Accounts </a></li>
                <li><a href="../supplier/supplier.php"><em class="fa fa-shopping-cart">&nbsp;</em> Suppliers </a></li>
                <li><a href="../../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
            </ul>
        </div><!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="inventory.php">
                        <em class="fa fa-home"></em>
                        </a></li>
                    <li><a href="inventory.php">Inventory</a></li>
                    <li class="active">Market</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Inventory <?php echo $row['branch_name']; ?> </h1>
                </div>

            </div><!--/.row-->
            <div class="btn-group" style="width:100%">
                <button onclick="location.href='inventory.php'"; style="width:33.3%; border-radius: 30px;">Market</button>
                <button onclick="location.href='inventoryporta.php'"; style="width:33.3%; border-radius: 30px;">Porta</button>
            </div>
            <br>
            <br>
            <form action = "" method = "POST">
            Critical Value: <input type="text" name="critical" autocomplete="off">
            <input type="submit" name = "submitcritical" class ="btn btn-success btn-sm acceptbtn" value="Change Value">
            </form>

            <br>
            <br>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tr>
                    <th>Name</th>
                    <th>Total Stock (kg)</th>
                    <th> Status </th>
                </tr>
                <tr>


                    <?php

                    If($result->num_rows > 0)
                    {
                        while($row=mysqli_fetch_array($result))
                        {
                    ?>

                    <td><?php echo $row['productname']; ?></td>
                    <td <?php if($row['stock'] <= $value): ?> style="background-color:#f9243f" <?php endif; ?>><?php echo $row['stock']; ?></td>
                    <td> <button type="submit"  class="btn btn-success btn-sm acceptbtn " name="archive" > <?php echo $row['status']; ?></button>
                    </td>
                </tr>

                <?php

                        }
                    }
                ?>

                </tr>
            </table>
        </div>

    </div><!--/.row-->
</div>	<!--/.main-->


<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>



<script>

    window.onload = function () {
        var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc"
        });
    };

</script>


</body>
</html>
