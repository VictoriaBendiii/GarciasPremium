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
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Product</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Product</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="btn-group" style="width:100%">
        <button class="btn btn-primary active" onclick="location.href='product.php'"
            style="width:33.3%;border-radius: 30px;">Products</button>
        <button onclick="location.href='addproduct.php'" style="width:33.3%; border-radius: 30px;">Add Product</button>
        <button onclick="location.href='archivedproducts.php'" style="width:33.3%; border-radius: 30px;">Archived
            Products</button>
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
                    $sql_product = "SELECT * from products WHERE status='active'";
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
                                    <a href="#edit<?php echo $row['productid'];?>" data-toggle="modal"
                                        class="btn btn-success" data-toggle="modal">Edit</a>
                                    <a href="update.php?deactivate=<?php echo $row['productid']; ?>"
                                        class="btn btn-warning"> Archive </a>
                                    <!-- Modal -->
                                    <div id="edit<?php echo $row['productid']; ?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Edit Product</h4>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <input type="hidden" name="productid"
                                                            value="<?php echo $row['productid']; ?>">
                                                        <label>Product Name</label>
                                                        <span id="popover-username"
                                                            class="popname hide pull-right block-help"><i
                                                                class="fa fa-info-circle text-danger"
                                                                aria-hidden="true"></i> Product name must not contain
                                                            any special characters</span>
                                                        <input type="text" name="productname"
                                                            class="prodname form-control"
                                                            value="<?php echo $row['productname']; ?>"
                                                            placeholder="Enter Product Name">

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="sub btn btn-success"
                                                            name="edit_product" id="edit_product ">Update</button>

                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End of Modal -->

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

        <script>
        $(document).ready(function() {
            $('.prodname').blur(function() {
                var regex =
                    /[&\/\\#,+=()@^$~%.'":*?<>{}]/;
                var isProductNameCorrect = $(this).val().match(regex);
                $('.modal:visible').find('.popname').toggleClass('hide', !isProductNameCorrect);
                $('.sub').prop('disabled', isProductNameCorrect);
            });
        });
        </script>


                    </body>


                    </html>
