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
include 'critical.php';
include 'query.php';
?>
<?php
$sql = "SELECT products.productid, products.productname, stock.quantity as stock, branch.branchid, products.status
from ((stock left join products on stock.productid = products.productid)
left join branch on stock.branchid = branch.branchid) where (branch.branchid = 2  OR branch.branchid = 3)
AND products.status = 'Active' ORDER BY products.productname ASC  ";
$result = mysqli_query($conn, $sql);



?>


<!DOCTYPE HTML>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Garcias Premium Coffee</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/font-awesome.min.css" rel="stylesheet">
        <link href="../css/datepicker3.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
        <link href="../css/add.css" rel="stylesheet">


        <!--Custom Font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

    </head>
    <body>
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span></button>
                    <a class="navbar-brand" href="#"><span></span>Admin</a>
                    <br>
                    <p> <?php $f_name = $_SESSION['firstname']; $l_name = $_SESSION['lastname'];  echo "$f_name $l_name "; ?></p>


                </div>
            </div><!-- /.container-fluid -->
        </nav>
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="divider"></div>
            <ul class="nav menu">
               <li><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
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
                    <li><a href="#">
                        <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active">Inventory</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Inventory <?php echo $row1['branch_name']; ?> </h1>
                </div>

            </div><!--/.row-->
            <div class="btn-group" style="width:100%">
                <button onclick="location.href='inventory.php'"; style="width:33.3%; border-radius: 30px;">Market</button>
                <button class ="btn btn-primary active" onclick="location.href='inventoryporta.php'"; style="width:33.3%; border-radius: 30px;">Porta</button>
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
                        <th>Action</th>
                    </tr>
                    <tr>


                        <?php

                        If($result->num_rows > 0)
                        {
                            while($row=mysqli_fetch_array($result))
                            {

                        ?>



                    <form action = "updatestock.php" method ="POST">
                    <td><?php echo $row['productname']; ?></td>
                    <td <?php if($row['stock'] <= $value): ?> style="background-color:#f9243f" <?php endif; ?>><?php echo $row['stock']; ?></td>

                    <td> <a href="#edit<?php echo $row['productid'];?>" data-toggle="modal" class="btn btn-primary active" data-toggle="modal">Edit stock</a>
                    <div id="edit<?php echo $row['productid']; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Edit Product Stock</h4>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <input type="hidden" name="productidporta"
                                                            value="<?php echo $row['productid']; ?>">
                                                        <label>Product Stock</label>
                                                        <input type="number" step="0.01" name="productstockporta"
                                                            class="prodname form-control"
                                                            value="<?php echo $row['stock']; ?>"
                                                            placeholder="Enter Product Stock">

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="sub btn btn-success"
                                                            name="edit_productporta" id="edit_product">Update</button>

                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End of Modal -->
                    </td>
                </tr>
                            </form>
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
<script src="../js/bootstrap.min.js"></script>
<script src="../js/chart.min.js"></script>
<script src="../js/chart-data.js"></script>
<script src="../js/easypiechart.js"></script>
<script src="../js/easypiechart-data.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>
<script src="../js/custom.js"></script>

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
