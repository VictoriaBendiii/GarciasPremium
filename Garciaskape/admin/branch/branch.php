<?php
    include '../includes/connection.php';
    include '../includes/header.php';
?>

        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="divider"></div>
            <ul class="nav menu">
                <li ><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li><a href="../notification/notification.php"><em class="fa fa-bell">&nbsp;</em> Notification</a></li>
                <li><a href="../deliveries/adeliveries.php"><em class="fa fa-truck">&nbsp;</em> Delivery</a></li>
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
                
                    $get_branch_request = "SELECT orders.orderid, products.productname, supplier.supplier_name, branch.branchid, orders.quantity, DATE_FORMAT(orders.time,'%b %d, %Y %r') as time, orders.status from (((orders inner join products on orders.productid = products.productid) inner join supplier on orders.supplierid = supplier.supplierid) inner join branch on orders.branchid = branch.branchid) where orders.status = 'rejected' or orders.status = 'pending' or orders.status = 'accepted';";
                
                    $result = mysqli_query($conn, $get_branch_request);
                
                    while($rows = mysqli_fetch_array($result)){
                ?>
                <tr>
                        
                        <td><?php echo $rows['productname']; ?></td>
                        <td><?php echo $rows['supplier_name']; ?></td>
                        
                        <td><?php echo $rows['quantity']; ?></td>
                        <td><?php echo $rows['time']; ?></td>
                        <td><span id="status-<?php echo $rows['orderid']; ?>"><?php echo $rows['status']; ?></span></td>
                        <td>
                        <button data-id="<?php echo $rows['orderid']; ?>" class="btn btn-success btn-sm acceptbtn">Accept</button>
                        <button data-id="<?php echo $rows['orderid']; ?>" class="btn btn-danger btn-sm rejectbtn">Reject</button>
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

<script src="../js/status.js"></script>


</body>
</html>