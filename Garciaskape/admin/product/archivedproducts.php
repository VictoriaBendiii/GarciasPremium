<?php
session_start();
if(!isset($_SESSION['login_user'])){
  header('Location: ../index.php');
  exit;
}

include '../includes/connection.php';
include '../includes/header.php';
include 'update.php'; ?>

    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="divider"></div>
        <ul class="nav menu">
             <li><a href="../index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                <li><a href="../monitoring/product.php"><em class="fa fa-calendar">&nbsp;</em> Product Monitoring</a></li>
                <li><a href="../notification/notification.php"><em class="fa fa-bell">&nbsp;</em> Notification</a></li>
                <li><a href="../deliveries/adeliveries.php"><em class="fa fa-truck">&nbsp;</em> Order Request</a></li>
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
                    <li><a href="product.php">Products</a></li>
                    <li class="active">Archive Product</li>
                </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Archive Product</h1>
            </div>
        </div>
        <!--/.row-->
        <div class="btn-group" style="width:100%">
            <button onclick="location.href='product.php'" style="width:33.3%; border-radius: 30px;">Products</button>
            <button onclick="location.href='addproduct.php'" style="width:33.3%; border-radius: 30px;">Add Product</button>
            <button class="btn btn-primary active" onclick="location.href='archivedproducts.php'"
                style="width:33.3%;border-radius: 30px;">Archived Products</button>
        </div>
        <br><br>
        <!-- ALERT -->
        <?php require_once 'update.php' ?>
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
                <?php
                    $sql_product = "SELECT * from products WHERE status='deactivated'";
                    $result = mysqli_query($conn, $sql_product);
                    ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                if($result = mysqli_query($conn, $sql_product)) {
                                    while($row=mysqli_fetch_array($result)){
                                ?>
                            <tr>
                                <form action="update.php" method="POST">
                                    <td> <?php echo $row["productname"]; ?> </td>
                                    <td>
                                        <a href="update.php?activate=<?php echo $row['productid']; ?>"
                                            class="btn btn-warning"> Restore </a>
                                    </td>
                                </form>

                            </tr>
                            <?php
                                    }
                                }
                                ?>
                        </tbody>
                    </table>

                    <!--/.row-->

                </div>
                <!--/.row-->
            </div>
            <!--/.main-->


            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
            </script>
            <script src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/jquery-ui.js" type="text/javascript"></script>
            <link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.9/themes/blitzer/jquery-ui.css" rel="stylesheet"
                type="text/css" />
            <script type="text/javascript">
            $(function() {
                $("#dialog").dialog({
                    modal: true,
                    autoOpen: false,
                    title: "jQuery Dialog",
                    width: 300,
                    height: 150
                });
                $("#btnShow").click(function() {
                    $('#dialog').dialog('open');
                });
            });
            </script>

</body>

</html>
