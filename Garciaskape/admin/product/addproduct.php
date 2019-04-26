<?php include '../includes/connection.php';
include '../includes/header.php';
include 'addprod.php';?>

    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="divider"></div>
        <ul class="nav menu">
                <li><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li><a href="../notification/notification.php"><em class="fa fa-bell">&nbsp;</em> Notification</a></li>
                <li><a href="../deliveries/adeliveries.php"><em class="fa fa-truck">&nbsp;</em> Delivery</a></li>
                <li><a href="../inventory/inventory.php"><em class="fa fa-edit">&nbsp;</em> Inventory</a></li>
                <li><a href="../branch/branch.php"><em class="fa fa-inbox">&nbsp;</em> Stock Request </a></li>
                <li class="active"><a href="../product/product.php"><em class="fa fa-product-hunt">&nbsp;</em> Products</a></li>
                <li><a href="../accounts/accounts.php"><em class="fa fa-user">&nbsp;</em> Accounts </a></li>
                <li><a href="../supplier/supplier.php"><em class="fa fa-shopping-cart">&nbsp;</em> Suppliers </a></li>
                <li><a href="../../includes/logout.inc.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
        </ul>
    </div>
    <!--/.sidebar-->

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                    <li><a href="product.php">
                        <em class="fa fa-home"></em>
                        </a></li>
                    <li><a href="product.php">Product</a></li>
                    <li class="active">Add Product</li>
                </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Product</h1>
            </div>
        </div>
        <!--/.row-->
        <div class="btn-group" style="width:100%">
            <button onclick="location.href='product.php'" style="width:33.3%; border-radius: 30px;">Products</button>
            <button class="btn btn-primary active" onclick="location.href='addproduct.php'" style="width:33.3%; border-radius: 30px;">Add
                Product</button>
            <button onclick="location.href='archivedproducts.php'" style="width:33.3%; border-radius: 30px;">Archived Products</button>
        </div>
        <br><br>

        <!-- ALERT -->
        <?php require_once 'addprod.php' ?>
        <?php
         if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']); 
                        ?>
        </div>
        <?php endif ?>
        <!-- ALERT -->

        <div class="row">
            <div class="col-lg-12">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3">
                    <form id="contact-form" class="form" action="addprod.php" method="POST" role="form">
                        <div class="form-group">
                            <label class="form-label" for="name">Product Name</label>
                            <input type="text" class="form-control" id="name" name="prodname" placeholder="Product Name"
                                tabindex="1" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="branchid">Branch</label>
                            <input type="text" class="form-control" value="Market and Porta" tabindex="1" disabled>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-start-order" name="add_prod" id="add_prod">ADD NEW
                                PRODUCT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/.row-->

    </div>
    <!--/.row-->
    </div>
    <!--/.main-->


</body>

</html>