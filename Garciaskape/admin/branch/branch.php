<?php 
    session_start();

    include('../includes/connection.php');

    // accept or reject

    if(isset($_REQUEST['accept'])){
        
        $accept_stat = $_REQUEST['accept'];
        $deliveryid = $_REQUEST['deliveryid'];
        
        $update_request_status = "UPDATE delivery SET status = '$accept_stat' WHERE deliveryid = $deliveryid";
        
        mysqli_query($conn, $update_request_status);
    }
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
                    <p> Eddie Garcia </p>


                </div>
            </div><!-- /.container-fluid -->
        </nav>
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="divider"></div>
            <ul class="nav menu">
                <li ><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li ><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li ><a href="../notification/notification.php"><em class="fa fa-bar-chart">&nbsp;</em> Notification</a></li>
                <li ><a href="../deliveries/adeliveries.php"><em class="fa fa-toggle-off">&nbsp;</em> Deliveries</a></li>
                <li ><a href="../inventory/inventory.php"><em class="fa fa-toggle-off">&nbsp;</em> Inventory</a></li>
                <li class="active"><a href="../branch/branch.php"><em class="fa fa-clone">&nbsp;</em> Stock Request </a></li>
                <li><a href="../product/addproduct.php"><em class="fa fa-toggle-off">&nbsp;</em> Products</a></li>
                <li><a href="../accounts/accounts.php"><em class="fa fa-clone">&nbsp;</em> Accounts </a></li>
                <li><a href="../supplier/addsupplier.php"><em class="fa fa-clone">&nbsp;</em> Suppliers </a></li>
                <li><a href="../../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
            </ul>
        </div><!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
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
        
<div>	<!--/.main-->
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
<div id="request_table">
        <table class="table table-dark table-striped">
            <thead class="thead-dark">
                <tr>
                        <th>Order ID</th>
                        <th>Product Name</th>
                        <th>From</th>
                        <th>to</th>
                        <th>Quantity</th>
                        <th>Date Requested</th>
                        <th>Status</th>
                        <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
          
                    // get requests
                
                    $get_branch_request = "SELECT orders.orderid, products.productname, supplier.supplier_name, branch.branchid, branch.branch_name, orders.quantity, orders.time, delivery.deliveryid, delivery.status from ((((orders inner join products on orders.productid = products.productid) inner join supplier on orders.supplierid = supplier.supplierid) inner join branch on orders.branchid = branch.branchid) inner join delivery on orders.deliveryid = delivery.deliveryid) where delivery.status = 'rejected' or delivery.status = 'pending' OR delivery.status = 'accepted'";
                
                    $result = mysqli_query($conn, $get_branch_request);
                
                    while($rows = mysqli_fetch_array($result)){
                ?>
                <tr>
                        <td><?php echo $rows['orderid']; ?></td>
                        <td><?php echo $rows['productname']; ?></td>
                        <td><?php echo $rows['supplier_name']; ?></td>
                        <td><?php echo $rows['branch_name']; ?></td> 
                        <td><?php echo $rows['quantity']; ?></td>
                        <td><?php echo $rows['time']; ?></td>
                        <td><?php echo $rows['status']; ?></td>
                        <td>
                        <a href="branch.php?accept=accepted&deliveryid=<?php echo $rows['deliveryid']; ?>" class="btn btn-success btn-sm">Accept</a>
                        <a href="branch.php?accept=rejected&deliveryid=<?php echo $rows['deliveryid']; ?>" class="btn btn-danger btn-sm">Reject</a>
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

</div>	<!--/.main-->
</div>	<!--/.main-->

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

</body>
</html>