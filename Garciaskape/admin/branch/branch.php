<?php
session_start();
if(!isset($_SESSION['login_user'])){
  header('Location: ../index.php');
  exit;
}

include '../includes/connection.php';
$updatestat = '';
include 'updatestatus.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Garcias Premium Coffee</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/font-awesome.min.css" rel="stylesheet">
        <link href="../css/datepicker3.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
        <link href="../css/add.css" rel="stylesheet">


        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.12/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.10.0/ui-bootstrap-tpls.min.js"></script>
        <!-- <link href="../css/add.css" rel="stylesheet"> -->
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
                <li ><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li><a href="../notification/notification.php"><em class="fa fa-bell">&nbsp;</em> Notification</a></li>
                <li><a href="../deliveries/adeliveries.php"><em class="fa fa-truck">&nbsp;</em> Order Request</a></li>
                <li><a href="../inventory/inventory.php"><em class="fa fa-edit">&nbsp;</em> Inventory</a></li>
                <li class="active"><a href="../branch/branch.php"><em class="fa fa-inbox">&nbsp;</em> Stock Request </a></li>
                <li><a href="../product/product.php"><em class="fa fa-product-hunt">&nbsp;</em> Products</a></li>
                <li><a href="../accounts/accounts.php"><em class="fa fa-user">&nbsp;</em> Accounts </a></li>
                <li><a href="../supplier/supplier.php"><em class="fa fa-shopping-cart">&nbsp;</em> Suppliers </a></li>
                <li><a href="../../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
            </ul>
        </div><!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="branch.php">
                        <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active">Branch Stock Request</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Branch Stock Request</h1>
                </div>
            </div><!--/.row-->

        </div><!--/.row-->

<div>   <!--/.main-->
 <div>
    <div role="main" class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

        </div>
    </div>
</div>
<!-- Modal -->

<!-- update status -->
<?php
        if($updatestat === 1){
?>
        <div class="alert alert-success" role="alert">
          Status has been updated!
        </div>
<?php
        }
?>
<!-- update status -->

<div id="request_table">
        <table class="table table-dark table-striped">
            <thead class="thead-dark">
                <tr>

                        <th>Product Name</th>
                        <th>From</th>

                        <th>Quantity(kg)</th>
                        <th>Date Requested</th>
                        <th>Status</th>
                        <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <?php

                    // get requests

                    $get_branch_request = "SELECT products.productname, supplier.supplier_name, order_request.quantity, order_request.time, order_request.status, order_request.order_requestid from ((order_request inner join products on order_request.productid = products.productid) inner join supplier on order_request.supplierid = supplier.supplierid) WHERE order_request.status = 'accepted' OR order_request.status = 'rejected' OR order_request.status = 'pending'";

                    $result = mysqli_query($conn, $get_branch_request);

                    while($rows = mysqli_fetch_array($result)){
                ?>
                <tr>

                        <td><?php echo $rows['productname']; ?></td>
                        <td><?php echo $rows['supplier_name']; ?></td>

                        <td><?php echo $rows['quantity']; ?></td>
                        <td><?php echo $rows['time']; ?></td>
                        <td><span id="status-<?php echo $rows['order_requestid']; ?>"><?php echo $rows['status']; ?></span></td>
                        <td>


                        <a href="branch.php?accept=<?php echo $rows['order_requestid']; ?>" class="btn btn-success"> Accept </a>

                        <a href="branch.php?reject=<?php echo $rows['order_requestid']; ?>" class="btn btn-danger"> Reject </a>




                        </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
    </div>
</div><!--/.row-->

</div>  <!--/.main-->
</div>  <!--/.main-->

<script src="../js/jquery-1.11.1.min.js"></script>
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
        window.myLine = new Chart(chart1).Line(lineCharthata, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc"
        });
    };
</script>

<script src="../js/status.js"></script>


</body>
</html>
